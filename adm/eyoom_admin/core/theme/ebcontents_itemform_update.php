<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebcontents_itemform_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999610";

auth_check_menu($auth, $sub_menu, 'w');

check_demo();

$iw                 = isset($_POST['iw']) ? clean_xss_tags(trim($_POST['iw'])) : '';
$ci_no              = isset($_POST['ci_no']) ? clean_xss_tags(trim($_POST['ci_no'])) : '';

$post_ec_code       = isset($_POST['ec_code']) ? clean_xss_tags(trim($_POST['ec_code'])) : '';
$post_ci_state      = isset($_POST['ci_state']) ? clean_xss_tags(trim($_POST['ci_state'])) : '';
$post_ci_sort       = isset($_POST['ci_sort']) ? clean_xss_tags(trim($_POST['ci_sort'])) : '';
$post_ci_theme      = isset($_POST['theme']) ? clean_xss_tags(trim($_POST['theme'])) : '';
$post_ci_period     = isset($_POST['ci_period']) ? clean_xss_tags(trim($_POST['ci_period'])) : '1';
$post_ci_start      = isset($_POST['ci_start']) ? clean_xss_tags(trim($_POST['ci_start'])) : '';
$post_ci_end        = isset($_POST['ci_end']) ? clean_xss_tags(trim($_POST['ci_end'])) : '';
$post_ci_view_level = isset($_POST['ci_view_level']) ? clean_xss_tags(trim($_POST['ci_view_level'])) : 1;
$post_ci_subject    = isset($_POST['ci_subject']) && is_array($_POST['ci_subject']) ? serialize($_POST['ci_subject']) : '';
$post_ci_text       = isset($_POST['ci_text']) && is_array($_POST['ci_text']) ? serialize($_POST['ci_text']) : '';
$post_ci_link       = isset($_POST['ci_link']) && is_array($_POST['ci_link']) ? $_POST['ci_link'] : array();
$post_ci_target     = isset($_POST['ci_target']) && is_array($_POST['ci_target']) ? $_POST['ci_target'] : array();
$post_ci_content    = isset($_POST['ci_content']) ? trim($_POST['ci_content']) : '';

/**
 * 노출 기간
 */
if ($post_ci_period  == '1')  {
    $post_ci_start   = '';
    $post_ci_end     = '';
} else {
    $post_ci_start   = $post_ci_start ? date('Ymd', strtotime($post_ci_start)) : '';
    $post_ci_end     = $post_ci_end ? date('Ymd', strtotime($post_ci_end)) : '';
}

/**
 * 링크정보 및 타겟 정보
 */
if (is_array($post_ci_link)) {
    foreach ($post_ci_link as $k => $link) {
        $ci_link[$k]= $eb->filter_url($link);
        $ci_target[$k] = $post_ci_target[$k];
    }
}

// 컨텐츠 내용
$ci_content = '';
if ($post_ci_content) {
    $ci_content = substr(trim($post_ci_content),0,65536);
    $ci_content = preg_replace("#[\\\]+$#", "", $ci_content);
}

$sql_common = "
    ec_code = '{$post_ec_code}',
    ci_state = '{$post_ci_state}',
    ci_sort = '{$post_ci_sort}',
    ci_subject = '{$post_ci_subject}',
    ci_text = '{$post_ci_text}',
    ci_content = '{$ci_content}',
    ci_link = '" . serialize($ci_link) . "',
    ci_target = '" . serialize($ci_target) . "',
    ci_theme = '{$post_ci_theme}',
    ci_period = '{$post_ci_period }',
    ci_start = '{$post_ci_start}',
    ci_end = '{$post_ci_end}',
    ci_view_level = '{$post_ci_view_level}',
";

/**
 * 이미지 업로드
 */
$upload_max_filesize = ini_get('upload_max_filesize');

if (empty($_POST)) {
    alert("파일 또는 글내용의 크기가 서버에서 설정한 값을 넘어 오류가 발생하였습니다.\\npost_max_size=".ini_get('post_max_size')." , upload_max_filesize=".$upload_max_filesize."\\n게시판관리자 또는 서버관리자에게 문의 바랍니다.");
}

/**
 * 파일개수 체크
 */
$file_count   = 0;
$upload_count = count((array)$_FILES['ci_img']['name']);

for ($i=0; $i<$upload_count; $i++) {
    if($_FILES['ci_img']['name'][$i] && is_uploaded_file($_FILES['ci_img']['tmp_name'][$i]))
        $file_count++;
}

/**
 * 기존 파일정보
 */
if ($iw == 'u') {
    $ci = sql_fetch("select ci_img from {$g5['eyoom_contents_item']} where ci_no = '{$ci_no}' ");
    $ci_img = $eb->mb_unserialize($ci['ci_img']);
}

/**
 * 디렉토리가 없다면 생성
 */
$qfile->make_directory(G5_DATA_PATH.'/ebcontents/'.$post_ci_theme.'/img/');

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

/**
 * 이미지 삭제
 */
if ($iw == 'u') {
    $ci_img_del = isset($_POST['ci_img_del']) ? $_POST['ci_img_del']: '';
    if($ci_img_del && is_array($ci_img_del)) {
        foreach ($ci_img_del as $i => $chk) {
            $ebcontents_file = G5_DATA_PATH.'/ebcontents/'.$post_ci_theme.'/img/'.$del_img_name[$i];
            if ($chk && file_exists($ebcontents_file) && !is_dir($ebcontents_file)) {
                @unlink($ebcontents_file);
            }
            $ci_img[$i] = '';
        }
    }
}

/**
 * 이미지 업로드
 */
$file_upload_msg = '';
for ($i=0; $i<count((array)$_FILES['ci_img']['name']); $i++) {
    $allowed_mimetype = ['image/jpeg', 'image/png', 'image/gif'];
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

    $uploaded_file = $_FILES['ci_img']['tmp_name'][$i];
    if ($uploaded_file) {
        $file_mimetype = mime_content_type($uploaded_file);
        $file_ext = $qfile->get_file_ext($_FILES['ci_img']['name'][$i]);
        if (in_array($file_mimetype, $allowed_mimetype) && in_array($file_ext, $allowed_ext)) {
            if (is_uploaded_file($uploaded_file)) {
                $file_name = md5(time().$_FILES['ci_img']['name'][$i]).".".$file_ext;
                $dest_path = G5_DATA_PATH.'/ebcontents/'.$post_ci_theme.'/img/'.$file_name;
    
                move_uploaded_file($uploaded_file, $dest_path);
                
                if (file_exists($dest_path)) {
                    chmod($dest_path, G5_FILE_PERMISSION);
                    $ci_img[$i] = $file_name;
                }
            }
        }
    }
}

if (isset($ci_img) && is_array($ci_img)) {
    $sql_common .= " ci_img = '" . serialize($ci_img) . "', ";
}

if ($iw == '') {
    $sql = "insert into {$g5['eyoom_contents_item']} set {$sql_common} ci_regdt = '".G5_TIME_YMDHIS."'";
    sql_query($sql);
    $ci_no = sql_insert_id();
    $msg = "EB컨텐츠 아이템을 추가하였습니다.";

} else if ($iw == 'u') {
    $sql = " update {$g5['eyoom_contents_item']} set {$sql_common} ci_regdt=ci_regdt where ci_no = '{$ci_no}' ";
    sql_query($sql);
    $msg = "EB컨텐츠 아이템을 정상적으로 수정하였습니다.";

} else {
    alert('제대로 된 값이 넘어오지 않았습니다.');
}

/**
 * 설정된 정보를 파일로 저장 - 캐쉬 기능
 */
$thema->save_ebcontents_item($post_ec_code, $post_ci_theme);

alert($msg, G5_ADMIN_URL . "/?dir=theme&amp;pid=ebcontents_itemlist&amp;ec_code={$post_ec_code}&amp;thema='{$post_ci_theme}'&amp;w=u&amp;wmode=1");
