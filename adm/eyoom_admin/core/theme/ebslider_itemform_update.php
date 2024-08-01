<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebslider_itemform_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999600";

auth_check_menu($auth, $sub_menu, 'w');

check_demo();

$iw             = isset($_POST['iw']) ? clean_xss_tags(trim($_POST['iw'])) : '';
$ei_no          = isset($_POST['ei_no']) ? clean_xss_tags(trim($_POST['ei_no'])) : '';
$es_code        = isset($_POST['es_code']) ? clean_xss_tags(trim($_POST['es_code'])) : '';
$ei_state       = isset($_POST['ei_state']) ? clean_xss_tags(trim($_POST['ei_state'])) : '';
$ei_sort        = isset($_POST['ei_sort']) ? clean_xss_tags(trim($_POST['ei_sort'])) : '';
$ei_title       = isset($_POST['ei_title']) ? clean_xss_tags(trim($_POST['ei_title'])) : '';
$ei_subtitle    = isset($_POST['ei_subtitle']) ? clean_xss_tags(trim($_POST['ei_subtitle'])) : '';
$ei_links       = isset($_POST['ei_link']) ? (array) $_POST['ei_link'] : '';
$ei_target      = isset($_POST['ei_target']) ? (array) $_POST['ei_target'] : '';
$ei_text        = isset($_POST['ei_text']) ? clean_xss_tags(trim($_POST['ei_text'])) : '';
$ei_theme       = isset($_POST['theme']) ? clean_xss_tags(trim($_POST['theme'])) : '';
$ei_period      = isset($_POST['ei_period']) ? clean_xss_tags(trim($_POST['ei_period'])) : '';
$ei_start       = isset($_POST['ei_start']) ? clean_xss_tags(trim($_POST['ei_start'])) : '';
$ei_end         = isset($_POST['ei_end']) ? clean_xss_tags(trim($_POST['ei_end'])) : '';
$ei_view_level  = isset($_POST['ei_view_level']) ? clean_xss_tags(trim($_POST['ei_view_level'])) : '';

/**
 * 노출 기간
 */
if ($ei_period == '1')  {
    $ei_start   = '';
    $ei_end     = '';
} else {
    $ei_start   = $ei_start ? date('Ymd', strtotime($ei_start)) : '';
    $ei_end     = $ei_end ? date('Ymd', strtotime($ei_end)) : '';
}

/**
 * 링크정보 및 타겟 정보
 */
if (is_array($ei_links)) {
    foreach ($ei_links as $k => $link) {
        $ei_link[$k]= $eb->filter_url($link);
    }
}

$sql_common = "
    es_code = '{$es_code}',
    ei_state = '{$ei_state}',
    ei_sort = '{$ei_sort}',
    ei_title = '{$ei_title}',
    ei_subtitle = '{$ei_subtitle}',
    ei_text = '{$ei_text}',
    ei_link = '" . serialize($ei_link) . "',
    ei_target = '" . serialize($ei_target) . "',
    ei_theme = '{$ei_theme}',
    ei_period = '{$ei_period}',
    ei_start = '{$ei_start}',
    ei_end = '{$ei_end}',
    ei_view_level = '{$ei_view_level}',
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
$upload_count = count($_FILES['ei_img']['name']);

for ($i=0; $i<$upload_count; $i++) {
    if($_FILES['ei_img']['name'][$i] && is_uploaded_file($_FILES['ei_img']['tmp_name'][$i]))
        $file_count++;
}

/**
 * 기존 파일정보
 */
if ($iw == 'u') {
    $ei = sql_fetch("select ei_img from {$g5['eyoom_slider_item']} where ei_no = '{$ei_no}' ");
    $ei_img = isset($ei['ei_img']) ? $eb->mb_unserialize($ei['ei_img']): array();
}

/**
 * 디렉토리가 없다면 생성
 */
@mkdir(G5_DATA_PATH.'/ebslider/'.$ei_theme.'/img/', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/ebslider/'.$ei_theme.'/img/', G5_DIR_PERMISSION);

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

/**
 * 이미지 삭제
 */
if ($iw == 'u') {
    if(is_array($ei_img_del)) {
        foreach ($ei_img_del as $i => $chk) {
            $ebslider_file = G5_DATA_PATH.'/ebslider/'.$ei_theme.'/img/'.$del_img_name[$i];
            if ($chk && file_exists($ebslider_file)) {
                @unlink($ebslider_file);
                $ei_img[$i] = '';
            }
        }
    }
}

/**
 * 이미지 업로드
 */
$file_upload_msg = '';
for ($i=0; $i<count((array)$_FILES['ei_img']['name']); $i++) {
    if (is_uploaded_file($_FILES['ei_img']['tmp_name'][$i])) {
        $allowed_mimetype = ['image/jpeg', 'image/png', 'image/gif'];
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
    
        $uploaded_file = $_FILES['ei_img']['tmp_name'][$i];
        if ($uploaded_file) {
            $file_mimetype = mime_content_type($uploaded_file);
            $file_ext = $qfile->get_file_ext($_FILES['ei_img']['name'][$i]);
            if (in_array($file_mimetype, $allowed_mimetype) && in_array($file_ext, $allowed_ext)) {
                $file_name = md5(time().$_FILES['ei_img']['name'][$i]).".".$file_ext;
                $dest_path = G5_DATA_PATH.'/ebslider/'.$ei_theme.'/img/'.$file_name;
    
                move_uploaded_file($uploaded_file, $dest_path);
    
                if (file_exists($dest_path)) {
                    chmod($dest_path, G5_FILE_PERMISSION);
                    $ei_img[$i] = $file_name;
                }
            }
        }
    }
}

if (is_array($ei_img)) {
    $sql_common .= " ei_img = '" . serialize($ei_img) . "', ";
}

if ($iw == '') {
    $sql = "insert into {$g5['eyoom_slider_item']} set {$sql_common} ei_regdt = '".G5_TIME_YMDHIS."'";
    sql_query($sql);
    $ei_no = sql_insert_id();
    $msg = "EB슬라이더 아이템을 추가하였습니다.";

} else if ($iw == 'u') {
    $sql = " update {$g5['eyoom_slider_item']} set {$sql_common} ei_regdt=ei_regdt where ei_no = '{$ei_no}' ";
    sql_query($sql);
    $msg = "EB슬라이더 아이템을 정상적으로 수정하였습니다.";

} else {
    alert('제대로 된 값이 넘어오지 않았습니다.');
}

/**
 * 설정된 정보를 파일로 저장 - 캐쉬 기능
 */
$thema->save_ebslider_item($es_code, $ei_theme);

/**
 * 모달창 닫고 리로드하기
 */
if ($wmode) {
    echo "<script>window.parent.close_modal_and_reload();</script>";
    exit;
}

//alert($msg, G5_ADMIN_URL . '/?dir=theme&amp;pid=ebslider_itemform&amp;es_code='.$es_code.'&amp;'.$qstr.'&amp;thema='.$ei_theme.'&amp;w=u&amp;iw=u&amp;wmode=1&amp;ei_no='.$ei_no);
