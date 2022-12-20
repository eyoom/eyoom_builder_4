<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebbanner_form_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999630";

auth_check_menu($auth, $sub_menu, 'w');

check_demo();

$bn_master['bn_code'] = $bn_code = isset($_POST['bn_code']) ? clean_xss_tags(trim($_POST['bn_code'])) : '';
$bn_master['bn_theme']      = isset($_POST['theme']) ? clean_xss_tags(trim($_POST['theme'])) : '';
$bn_master['bn_state']      = isset($_POST['bn_state']) ? clean_xss_tags(trim($_POST['bn_state'])) : '';
$bn_master['bn_subject']    = isset($_POST['bn_subject']) ? clean_xss_tags(trim($_POST['bn_subject'])) : '';
$bn_master['bn_skin']       = isset($_POST['bn_skin']) ? clean_xss_tags(trim($_POST['bn_skin'])) : '';

$sql_common = "
    bn_code = '{$bn_master['bn_code']}',
    bn_theme = '{$bn_master['bn_theme']}',
    bn_state = '{$bn_master['bn_state']}',
    bn_subject = '{$bn_master['bn_subject']}',
    bn_skin = '{$bn_master['bn_skin']}',
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
    $es = sql_fetch("select bn_image from {$g5['eyoom_banner']} where bn_no = '{$bn_no}' ");
    $bn_image = $es['bn_image'];
}

/**
 * 디렉토리가 없다면 생성
 */
@mkdir(G5_DATA_PATH.'/ebbanner/'.$bn_master['bn_theme'].'/', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/ebbanner/'.$bn_master['bn_theme'].'/', G5_DIR_PERMISSION);

@mkdir(G5_DATA_PATH.'/ebbanner/'.$bn_master['bn_theme'].'/img/', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/ebbanner/'.$bn_master['bn_theme'].'/img/', G5_DIR_PERMISSION);

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

/**
 * 이미지 삭제
 */
if ($w == 'u') {
    $ebbanner_file = G5_DATA_PATH.'/ebbanner/'.$bn_master['bn_theme'].'/img/'.$del_image_name;
    if ($_POST['bn_image_del'] && file_exists($ebbanner_file) && !is_dir($ebbanner_file)) {
        @unlink($ebbanner_file);
        $bn_image = '';
    }
}

/**
 * 이미지 업로드
 */
$file_upload_msg = '';
$upload = array();
if (is_uploaded_file($_FILES['bn_image']['tmp_name'])) {
    $ext = $qfile->get_file_ext($_FILES['bn_image']['name']);
    $file_name = md5(time().$_FILES['bn_image']['name']).".".$ext;
    if (!preg_match("/\.(jpg|jpeg|gif|png|webp)$/i", $_FILES['bn_image']['name'])) {
        $file_upload_msg .= $_FILES['bn_image']['name'] . '은(는) jpg/gif/png/webp 파일이 아닙니다.\\n';
    } else {
        $dest_path = G5_DATA_PATH.'/ebbanner/'.$bn_master['bn_theme'].'/img/'.$file_name;

        move_uploaded_file($_FILES['bn_image']['tmp_name'], $dest_path);
        chmod($dest_path, G5_FILE_PERMISSION);

        if (file_exists($dest_path)) {
            $size = getimagesize($dest_path);
            $bn_image = $file_name;
        }
    }
}

/**
 * 배너 대표이미지 정보
 */
$sql_common .= " bn_image = '" . $bn_image . "', ";
$bn_master['bn_image'] = $bn_image;

if ($w == '') {
    $sql = " insert into {$g5['eyoom_banner']} set {$sql_common} bn_regdt = '".G5_TIME_YMDHIS."'";
    sql_query($sql);
    $bn_no = sql_insert_id();
    $msg = "EB배너 마스터를 추가하였습다.";

} else if ($w == 'u') {
    $sql = " update {$g5['eyoom_banner']} set {$sql_common} bn_regdt=bn_regdt where bn_code = '{$bn_code}' ";
    sql_query($sql);
    $msg = "EB배너 마스터를 수정하였습니다.";

} else {
    alert('제대로 된 값이 넘어오지 않았습니다.');
}

/**
 * EB배너 마스터 설정파일
 */
$eb_master_file = G5_DATA_PATH . '/ebbanner/'.$bn_master['bn_theme'].'/bn_master_' . $bn_code . '.php';

/**
 * 설정파일 저장
 */
$qfile->save_file('bn_master', $eb_master_file, $bn_master);

/**
 * 모달창 닫고 리로드하기
 */
if ($wmode) {
    echo "<script>window.parent.close_modal_and_reload();</script>";
    exit;
}

alert($msg, G5_ADMIN_URL . '/?dir=theme&amp;pid=ebbanner_form&amp;'.$qstr.'&amp;w=u&amp;bn_code='.$bn_code);