<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebgoods_form_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999500";

auth_check_menu($auth, $sub_menu, 'w');

check_demo();

$eg_code        = isset($_POST['eg_code']) ? clean_xss_tags(trim($_POST['eg_code'])) : '';
$eg_theme       = isset($_POST['theme']) ? clean_xss_tags(trim($_POST['theme'])) : '';
$eg_state       = isset($_POST['eg_state']) ? clean_xss_tags(trim($_POST['eg_state'])) : '';
$eg_subject     = isset($_POST['eg_subject']) ? clean_xss_tags(trim($_POST['eg_subject'])) : '';
$eg_skin        = isset($_POST['eg_skin']) ? clean_xss_tags(trim($_POST['eg_skin'])) : '';
$eg_link        = isset($_POST['eg_link']) ? $eb->filter_url($_POST['eg_link']) : '';
$eg_target      = isset($_POST['eg_target']) ? clean_xss_tags(trim($_POST['eg_target'])) : '';

$sql_common = "
    eg_code = '{$eg_code}',
    eg_theme = '{$eg_theme}',
    eg_state = '{$eg_state}',
    eg_subject = '{$eg_subject}',
    eg_skin = '{$eg_skin}',
    eg_link = '{$eg_link}',
    eg_target = '{$eg_target}',
";

if ($w == '') {
    sql_query(" insert into {$g5['eyoom_goods']} set {$sql_common} eg_regdt = '".G5_TIME_YMDHIS."'");
    $eg_no = sql_insert_id();
    $msg = "EB상품추출 마스터를 추가하였습다.";

} else if ($w == 'u') {
    $sql = " update {$g5['eyoom_goods']} set {$sql_common} eg_regdt=eg_regdt where eg_code = '{$eg_code}' ";
    sql_query($sql);
    $msg = "EB상품추출 마스터를 수정하였습니다.";

} else {
    alert('제대로 된 값이 넘어오지 않았습니다.');
}

/**
 * EB상품추출 경로
 */
$ebgoods_path = G5_DATA_PATH.'/ebgoods/'.$eg_theme;

/**
 * 디렉토리가 없다면 생성
 */
if (!is_dir($ebgoods_path)) {
    @mkdir($ebgoods_path, G5_DIR_PERMISSION);
    @chmod($ebgoods_path, G5_DIR_PERMISSION);
}

/**
 * EB상품추출 master 파일 경로
 */
$master_file = $ebgoods_path.'/eg_master_'.$eg_code.'.php';

/**
 * g5_eyoom_goods 테이블에서 정보 추출
 */
$eg_master = sql_fetch("select * from {$g5['eyoom_goods']} where (1) and eg_code = '{$eg_code}' limit 1 ");

/**
 * 파일 캐시
 */
$qfile->save_file('eg_master', $master_file, $eg_master);

/**
 * 모달창 닫고 리로드하기
 */
if ($wmode) {
    echo "<script>window.parent.close_modal_and_reload();</script>";
    exit;
}

alert($msg, G5_ADMIN_URL . '/?dir=theme&amp;pid=ebgoods_form&amp;'.$qstr.'&amp;w=u&amp;eg_code='.$eg_code);