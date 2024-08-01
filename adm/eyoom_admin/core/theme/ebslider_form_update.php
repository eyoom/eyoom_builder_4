<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebslider_form_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999600";

auth_check_menu($auth, $sub_menu, 'w');

check_demo();

$es_master['es_code'] = $es_code = isset($_POST['es_code']) ? clean_xss_tags(trim($_POST['es_code'])) : '';
$es_master['es_theme']      = isset($_POST['theme']) ? clean_xss_tags(trim($_POST['theme'])) : '';
$es_master['es_state']      = isset($_POST['es_state']) ? clean_xss_tags(trim($_POST['es_state'])) : '';
$es_master['es_subject']    = isset($_POST['es_subject']) ? clean_xss_tags(trim($_POST['es_subject'])) : '';
$es_master['es_skin']       = isset($_POST['es_skin']) ? clean_xss_tags(trim($_POST['es_skin'])) : '';
$es_master['es_text']       = isset($_POST['es_text']) ? clean_xss_tags(trim($_POST['es_text'])) : '';
$es_master['es_ytplay']     = isset($_POST['es_ytplay']) ? clean_xss_tags(trim($_POST['es_ytplay'])) : '';
$es_master['es_ytmauto']    = isset($_POST['es_ytmauto']) ? clean_xss_tags(trim($_POST['es_ytmauto'])) : '';
$es_master['es_link_cnt']   = isset($_POST['es_link_cnt']) ? clean_xss_tags(trim($_POST['es_link_cnt'])) : '';
$es_master['es_image_cnt']  = isset($_POST['es_image_cnt']) ? clean_xss_tags(trim($_POST['es_image_cnt'])) : '';
$es_master['es_link']       = isset($_POST['es_link']) ? $eb->filter_url($_POST['es_link']) : '';
$es_master['es_target']     = isset($_POST['es_target']) ? clean_xss_tags(trim($_POST['es_target'])) : '';

$sql_common = "
    es_code = '{$es_master['es_code']}',
    es_theme = '{$es_master['es_theme']}',
    es_state = '{$es_master['es_state']}',
    es_subject = '{$es_master['es_subject']}',
    es_skin = '{$es_master['es_skin']}',
    es_text = '{$es_master['es_text']}',
    es_ytplay = '{$es_master['es_ytplay']}',
    es_ytmauto = '{$es_master['es_ytmauto']}',
    es_link_cnt = '{$es_master['es_link_cnt']}',
    es_image_cnt = '{$es_master['es_image_cnt']}',
    es_link = '{$es_master['es_link']}',
    es_target = '{$es_master['es_target']}',
";

/**
 * 이미지 업로드
 */
$upload_max_filesize = ini_get('upload_max_filesize');

if (empty($_POST)) {
    alert("파일 또는 글내용의 크기가 서버에서 설정한 값을 넘어 오류가 발생하였습니다.\\npost_max_size=".ini_get('post_max_size')." , upload_max_filesize=".$upload_max_filesize."\\n게시판관리자 또는 서버관리자에게 문의 바랍니다.");
}

/**
 * 기존 파일정보
 */
if ($w == 'u') {
    $es = sql_fetch("select es_image from {$g5['eyoom_slider']} where es_no = '{$es_no}' ");
    $es_image = $es['es_image'];
}

/**
 * 디렉토리가 없다면 생성
 */
@mkdir(G5_DATA_PATH.'/ebslider/'.$es_master['es_theme'].'/', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/ebslider/'.$es_master['es_theme'].'/', G5_DIR_PERMISSION);

@mkdir(G5_DATA_PATH.'/ebslider/'.$es_master['es_theme'].'/img/', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/ebslider/'.$es_master['es_theme'].'/img/', G5_DIR_PERMISSION);

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

/**
 * 이미지 삭제
 */
if ($w == 'u') {
    $ebslider_file = G5_DATA_PATH.'/ebslider/'.$es_master['es_theme'].'/img/'.$del_image_name;
    if ($_POST['es_image_del'] && file_exists($ebslider_file) && !is_dir($ebslider_file)) {
        @unlink($ebslider_file);
        $es_image = '';
    }
}

/**
 * 이미지 업로드
 */
$file_upload_msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['es_image']) && $_FILES['es_image']['tmp_name']) {
    $allowed_mimetype = ['image/jpeg', 'image/png', 'image/gif'];
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

    $uploaded_file = $_FILES['es_image']['tmp_name'];
    if ($uploaded_file) {
        $file_mimetype = mime_content_type($uploaded_file);
        $file_ext = $qfile->get_file_ext($_FILES['es_image']['name']);
        if (in_array($file_mimetype, $allowed_mimetype) && in_array($file_ext, $allowed_ext)) {
            if (is_uploaded_file($uploaded_file)) {
                $file_name = md5(time().$_FILES['es_image']['name']).".".$file_ext;
                $dest_path = G5_DATA_PATH.'/ebslider/'.$es_master['es_theme'].'/img/'.$file_name;
    
                move_uploaded_file($uploaded_file, $dest_path);
    
                if (file_exists($dest_path)) {
                    chmod($dest_path, G5_FILE_PERMISSION);
                    $es_image = $file_name;
                }
            }
        } else {
            $file_upload_msg .= $_FILES['es_image']['name'] . '은(는) jpg/gif/png 파일이 아닙니다.\\n';
            alert($file_upload_msg);
        }
    }
}

/**
 * 슬라이더 대표이미지 정보
 */
$sql_common .= " es_image = '" . $es_image . "', ";
$es_master['es_image'] = $es_image;

if ($w == '') {
    $sql = " insert into {$g5['eyoom_slider']} set {$sql_common} es_regdt = '".G5_TIME_YMDHIS."'";
    sql_query($sql);
    $es_no = sql_insert_id();
    $msg = "EB슬라이더 마스터를 추가하였습다.";

} else if ($w == 'u') {
    $sql = " update {$g5['eyoom_slider']} set {$sql_common} es_regdt=es_regdt where es_code = '{$es_code}' ";
    sql_query($sql);
    $msg = "EB슬라이더 마스터를 수정하였습니다.";

} else {
    alert('제대로 된 값이 넘어오지 않았습니다.');
}

/**
 * 디렉토리가 없다면 생성
 */
@mkdir(G5_DATA_PATH.'/ebslider/'.$es_master['es_theme'].'/', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/ebslider/'.$es_master['es_theme'].'/', G5_DIR_PERMISSION);

/**
 * EB슬라이더 마스터 설정파일
 */
$eb_master_file = G5_DATA_PATH . '/ebslider/'.$es_master['es_theme'].'/es_master_' . $es_code . '.php';

/**
 * 설정파일 저장
 */
$qfile->save_file('es_master', $eb_master_file, $es_master);

/**
 * 모달창 닫고 리로드하기
 */
if ($wmode) {
    echo "<script>window.parent.close_modal_and_reload();</script>";
    exit;
}

alert($msg, G5_ADMIN_URL . '/?dir=theme&amp;pid=ebslider_form&amp;'.$qstr.'&amp;w=u&amp;es_code='.$es_code);