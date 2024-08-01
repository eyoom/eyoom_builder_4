<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebbanner_itemform_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999630";

auth_check_menu($auth, $sub_menu, 'w');

$iw             = isset($_POST['iw']) ? clean_xss_tags(trim($_POST['iw'])) : '';
$bi_no          = isset($_POST['bi_no']) ? clean_xss_tags(trim($_POST['bi_no'])) : '';
$bn_code        = isset($_POST['bn_code']) ? clean_xss_tags(trim($_POST['bn_code'])) : '';
$bi_state       = isset($_POST['bi_state']) ? clean_xss_tags(trim($_POST['bi_state'])) : '';
$bi_sort        = isset($_POST['bi_sort']) ? clean_xss_tags(trim($_POST['bi_sort'])) : '';
$bi_type        = isset($_POST['bi_type']) ? clean_xss_tags(trim($_POST['bi_type'])) : '';
$bi_title       = isset($_POST['bi_title']) ? clean_xss_tags(trim($_POST['bi_title'])) : '';
$bi_subtitle    = isset($_POST['bi_subtitle']) ? clean_xss_tags(trim($_POST['bi_subtitle'])) : '';
$bi_link        = isset($_POST['bi_link']) ? clean_xss_tags(trim($_POST['bi_link'])) : '';
$bi_target      = isset($_POST['bi_target']) ? clean_xss_tags(trim($_POST['bi_target'])) : '';
$bi_theme       = isset($_POST['theme']) ? clean_xss_tags(trim($_POST['theme'])) : '';
$bi_period      = isset($_POST['bi_period']) ? clean_xss_tags(trim($_POST['bi_period'])) : '';
$bi_start       = isset($_POST['bi_start']) ? clean_xss_tags(trim($_POST['bi_start'])) : '';
$bi_end         = isset($_POST['bi_end']) ? clean_xss_tags(trim($_POST['bi_end'])) : '';
$bi_view_level  = isset($_POST['bi_view_level']) ? clean_xss_tags(trim($_POST['bi_view_level'])) : '';

if ($bi_link) {
    $bi_link = substr($bi_link,0,1000);
    $bi_link = trim(strip_tags($bi_link));
    $bi_link = preg_replace("#[\\\]+$#", "", $bi_link);
}

$bi_script = '';
if (isset($_POST['bi_script'])) {
    $bi_script = substr(trim($_POST['bi_script']),0,65536);
    $bi_script = preg_replace("#[\\\]+$#", "", $bi_script);
}

/**
 * 노출 기간
 */
if ($bi_period == '1')  {
    $bi_start   = '';
    $bi_end     = '';
} else {
    $bi_start   = $bi_start ? date('Ymd', strtotime($bi_start)) : '';
    $bi_end     = $bi_end ? date('Ymd', strtotime($bi_end)) : '';
}

$sql_common = "
    bn_code = '{$bn_code}',
    bi_state = '{$bi_state}',
    bi_sort = '{$bi_sort}',
    bi_type = '{$bi_type}',
    bi_title = '{$bi_title}',
    bi_subtitle = '{$bi_subtitle}',
    bi_script = '{$bi_script}',
    bi_link = '{$bi_link}',
    bi_target = '{$bi_target}',
    bi_theme = '{$bi_theme}',
    bi_period = '{$bi_period}',
    bi_start = '{$bi_start}',
    bi_end = '{$bi_end}',
    bi_view_level = '{$bi_view_level}',
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
$upload_count = count($_FILES['bi_img']['name']);

for ($i=0; $i<$upload_count; $i++) {
    if($_FILES['bi_img']['name'][$i] && is_uploaded_file($_FILES['bi_img']['tmp_name'][$i]))
        $file_count++;
}

/**
 * 기존 파일정보
 */
if ($iw == 'u') {
    $bi = sql_fetch("select bi_img from {$g5['eyoom_banner_item']} where bi_no = '{$bi_no}' ");
    $bi_img = isset($bi['bi_img']) ? $eb->mb_unserialize($bi['bi_img']): array();
}

/**
 * 디렉토리가 없다면 생성
 */
@mkdir(G5_DATA_PATH.'/ebbanner/'.$bi_theme.'/img/', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/ebbanner/'.$bi_theme.'/img/', G5_DIR_PERMISSION);

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

/**
 * 이미지 삭제
 */
if ($iw == 'u') {
    if(is_array($bi_img_del)) {
        foreach ($bi_img_del as $i => $chk) {
            $ebbammer_file = G5_DATA_PATH.'/ebbanner/'.$bi_theme.'/img/'.$del_img_name[$i];
            if ($chk && file_exists($ebbammer_file)) {
                @unlink($ebbammer_file);
                $bi_img[$i] = '';
            }
        }
    }
}

/**
 * 이미지 업로드
 */
$file_upload_msg = '';
$upload = array();
for ($i=0; $i<count((array)$_FILES['bi_img']['name']); $i++) {
    if (is_uploaded_file($_FILES['bi_img']['tmp_name'][$i])) {
        $allowed_mimetype = ['image/jpeg', 'image/png', 'image/gif'];
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
    
        $uploaded_file = $_FILES['bi_img']['tmp_name'][$i];
        if ($uploaded_file) {
            $file_mimetype = mime_content_type($uploaded_file);
            $file_ext = $qfile->get_file_ext($_FILES['bi_img']['name'][$i]);
            if (in_array($file_mimetype, $allowed_mimetype) && in_array($file_ext, $allowed_ext)) {
                $file_name = md5(time().$_FILES['bi_img']['name'][$i]).".".$file_ext;
                $dest_path = G5_DATA_PATH.'/ebbanner/'.$bi_theme.'/img/'.$file_name;
    
                move_uploaded_file($uploaded_file, $dest_path);
    
                if (file_exists($dest_path)) {
                    chmod($dest_path, G5_FILE_PERMISSION);
                    $bi_img[$i] = $file_name;
                }
            }
        }
    }
}

if (is_array($bi_img)) {
    $sql_common .= " bi_img = '" . serialize($bi_img) . "', ";
}

if ($iw == '') {
    $sql = "insert into {$g5['eyoom_banner_item']} set {$sql_common} bi_regdt = '".G5_TIME_YMDHIS."'";
    sql_query($sql);
    $bi_no = sql_insert_id();
    $msg = "EB배너 아이템을 추가하였습니다.";

} else if ($iw == 'u') {
    $sql = " update {$g5['eyoom_banner_item']} set {$sql_common} bi_regdt=bi_regdt where bi_no = '{$bi_no}' ";
    sql_query($sql);
    $msg = "EB배너 아이템을 정상적으로 수정하였습니다.";

} else {
    alert('제대로 된 값이 넘어오지 않았습니다.');
}

/**
 * 설정된 정보를 파일로 저장 - 캐쉬 기능
 */
$thema->save_ebbanner_item($bn_code, $bi_theme);

/**
 * 모달창 닫고 리로드하기
 */
if ($wmode) {
    echo "<script>window.parent.close_modal_and_reload();</script>";
    exit;
}