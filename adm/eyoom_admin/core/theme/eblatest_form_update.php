<?php
/**
 * @file    /adm/eyoom_admin/core/theme/eblatest_form_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999620";

auth_check_menu($auth, $sub_menu, 'w');

check_demo();

$el_code        = isset($_POST['el_code']) ? clean_xss_tags(trim($_POST['el_code'])) : '';
$el_theme       = isset($_POST['theme']) ? clean_xss_tags(trim($_POST['theme'])) : '';
$el_state       = isset($_POST['el_state']) ? clean_xss_tags(trim($_POST['el_state'])) : '';
$el_subject     = isset($_POST['el_subject']) ? clean_xss_tags(trim($_POST['el_subject'])) : '';
$el_skin        = isset($_POST['el_skin']) ? clean_xss_tags(trim($_POST['el_skin'])) : '';
$el_cache       = isset($_POST['el_cache']) ? clean_xss_tags(trim($_POST['el_cache'])) : '';
$el_new         = isset($_POST['el_new']) ? clean_xss_tags(trim($_POST['el_new'])) : '';
$el_link        = isset($_POST['el_link']) ? $eb->filter_url($_POST['el_link']) : '';
$el_target      = isset($_POST['el_target']) ? clean_xss_tags(trim($_POST['el_target'])) : '';

$sql_common = "
    el_code = '{$el_code}',
    el_theme = '{$el_theme}',
    el_state = '{$el_state}',
    el_subject = '{$el_subject}',
    el_skin = '{$el_skin}',
    el_cache = '{$el_cache}',
    el_new = '{$el_new}',
    el_link = '{$el_link}',
    el_target = '{$el_target}',
";


if ($w == '') {
    sql_query(" insert into {$g5['eyoom_latest']} set {$sql_common} el_regdt = '".G5_TIME_YMDHIS."'");
    $el_no = sql_insert_id();
    $msg = "EB최신글 마스터를 추가하였습다.";

} else if ($w == 'u') {

    $sql = " update {$g5['eyoom_latest']} set {$sql_common} el_regdt=el_regdt where el_code = '{$el_code}' ";
    sql_query($sql);
    $msg = "EB최신글 마스터를 수정하였습니다.";

} else {
    alert('제대로 된 값이 넘어오지 않았습니다.');
}

/**
 * EB최신글 경로
 */
$eblatest_path = G5_DATA_PATH.'/eblatest/'.$el_theme;

/**
 * 디렉토리가 없다면 생성
 */
if (!is_dir($eblatest_path)) {
    @mkdir($eblatest_path, G5_DIR_PERMISSION);
    @chmod($eblatest_path, G5_DIR_PERMISSION);
}

/**
 * EB최신글 master 파일 경로
 */
$master_file = $eblatest_path.'/el_master_'.$el_code.'.php';

/**
 * g5_eyoom_latest 테이블에서 정보 추출
 */
$el_master = $latest->get_master($el_code);

/**
 * 파일 캐시
 */
$qfile->save_file('el_master', $master_file, $el_master);

/**
 * 모달창 닫고 리로드하기
 */
if ($wmode) {
    echo "<script>window.parent.close_modal_and_reload();</script>";
    exit;
}

alert($msg, G5_ADMIN_URL . '/?dir=theme&amp;pid=eblatest_form&amp;'.$qstr.'&amp;w=u&amp;el_code='.$el_code);