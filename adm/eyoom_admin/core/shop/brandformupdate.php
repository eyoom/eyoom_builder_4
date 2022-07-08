<?php
/**
 * @file    /adm/eyoom_admin/core/shop/brandformupdate.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400350";

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], 'w');

check_admin_token();

$br_no = (int) clean_xss_tags(trim($_POST['br_no']));
$br_code = (int) clean_xss_tags(trim($_POST['br_code']));
$br_name = clean_xss_tags(trim($_POST['br_name']));
$br_basic = clean_xss_tags(trim($_POST['br_basic']));
$br_open = clean_xss_tags(trim($_POST['br_open']));

if (!$br_code) alert("브랜드 코드는 필수항목 입니다.");

$sql_common = " br_name = '{$br_name}', br_basic = '{$br_basic}', br_open = '{$br_open}', ";

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
    $sql = "select * from {$g5['eyoom_brand']} where br_no = '{$br_no}' limit 1";
    $br = sql_fetch($sql);
    $br_img = $br['br_img'];
}

/**
 * 디렉토리가 없다면 생성
 */
@mkdir(G5_DATA_PATH.'/brand/', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/brand/', G5_DIR_PERMISSION);

/**
 * 이미지 삭제
 */
if ($w == 'u') {
    $br_imgfile = G5_DATA_PATH.'/brand/'.$br_img;
    if ($_POST['del_br_img'] && file_exists($br_imgfile) && !is_dir($br_imgfile)) {
        @unlink($br_imgfile);
        $br_img = '';
    }
}

/**
 * 이미지 업로드
 */
$file_upload_msg = '';
$upload = array();
if (is_uploaded_file($_FILES['br_img']['tmp_name'])) {
    $ext = $qfile->get_file_ext($_FILES['br_img']['name']);
    $file_name = md5(time().$_FILES['br_img']['name']).".".$ext;
    if (!preg_match("/\.(jpg|gif|png)$/i", $_FILES['br_img']['name'])) {
        $file_upload_msg .= $_FILES['br_img']['name'] . '은(는) jpg/gif/png 파일이 아닙니다.\\n';
    } else {
        $dest_path = G5_DATA_PATH.'/brand/'.$file_name;

        move_uploaded_file($_FILES['br_img']['tmp_name'], $dest_path);
        chmod($dest_path, G5_FILE_PERMISSION);

        if (file_exists($dest_path)) {
            $size = getimagesize($dest_path);
            $br_img = $file_name;
        }
    }
}

/**
 * 브랜드 대표이미지 정보
 */
$sql_common .= " br_img = '" . $br_img . "', ";

if ($w == '') {
    $max = sql_fetch("select max(br_sort) as snum from {$g5['eyoom_brand']} where 1 ");
    $br_sort = $max['snum'] + 1;
    $sql_common .= " br_code = '{$br_code}', br_sort = '{$br_sort}', ";
    $sql = " insert into {$g5['eyoom_brand']} set {$sql_common} br_regdt = '".G5_TIME_YMDHIS."'"; 
    sql_query($sql);
    $br_no = sql_insert_id();
    $msg = "새로운 브랜드를 추가하였습니다.";

} else if ($w == 'u') {
    $br_sort = clean_xss_tags(trim($_POST['br_sort']));
    $sql_common .= " br_sort = '{$br_sort}', ";
    $sql = " update {$g5['eyoom_brand']} set {$sql_common} br_regdt=br_regdt where br_no = '{$br_no}' ";
    sql_query($sql);
    $msg = "브랜드 정보를 수정하였습니다.";

} else {
    alert('제대로 된 값이 넘어오지 않았습니다.');
}

$qstr .= $page ? '&amp;page='.$page: '';

alert($msg, G5_ADMIN_URL . '/?dir=shop&amp;pid=brandform&amp;'.$qstr.'&amp;w=u&amp;br_no='.$br_no);