<?php
/**
 * @file    /adm/eyoom_admin/core/config/countdown_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "100990";

check_demo();

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();

$cd_use     = clean_xss_tags($_POST['cd_use']);
$cd_title   = get_text($_POST['cd_title']);
$cd_skin    = clean_xss_tags($_POST['cd_skin']);

/**
 * 오픈 예정일
 */
$cd_date = clean_xss_tags(str_replace('-', '', $_POST['cd_date']));
$cd_hour = clean_xss_tags($_POST['cd_hour']);
$cd_time = clean_xss_tags($_POST['cd_time']);
$open_date = $cd_date . $cd_hour . $cd_time;

/**
 * 공사중 설정/해제
 */
if ($cd_use == 'y') {
    if (strtotime($open_date) < time()) {
        alert("오픈 예정일은 현재 시간보다 미래의 시간이여야 합니다.\\n\\n정확히 입력해 주세요.");
    }
    $msg = "공사중 설정을 적용하였습니다.";
} else {
    $cd_title   = '';
    $cd_skin    = '';
    $open_date  = '';
    $msg = "공사중 설정을 해제하였습니다.";
}

/**
 * POST 변수 할당
 */
$countdown['cd_title']      = $cd_title;
$countdown['cd_use']        = $cd_use;
$countdown['cd_skin']       = $cd_skin;
$countdown['cd_opendate']   = $open_date;
$countdown['cd_1_subj']     = $_POST['cd_1_subj'];
$countdown['cd_2_subj']     = $_POST['cd_2_subj'];
$countdown['cd_3_subj']     = $_POST['cd_3_subj'];
$countdown['cd_4_subj']     = $_POST['cd_4_subj'];
$countdown['cd_5_subj']     = $_POST['cd_5_subj'];
$countdown['cd_6_subj']     = $_POST['cd_6_subj'];
$countdown['cd_7_subj']     = $_POST['cd_7_subj'];
$countdown['cd_8_subj']     = $_POST['cd_8_subj'];
$countdown['cd_9_subj']     = $_POST['cd_9_subj'];
$countdown['cd_10_subj']    = $_POST['cd_10_subj'];
$countdown['cd_1']          = $_POST['cd_1'];
$countdown['cd_2']          = $_POST['cd_2'];
$countdown['cd_3']          = $_POST['cd_3'];
$countdown['cd_4']          = $_POST['cd_4'];
$countdown['cd_5']          = $_POST['cd_5'];
$countdown['cd_6']          = $_POST['cd_6'];
$countdown['cd_7']          = $_POST['cd_7'];
$countdown['cd_8']          = $_POST['cd_8'];
$countdown['cd_9']          = $_POST['cd_9'];
$countdown['cd_10']         = $_POST['cd_10'];

/**
 * 공사중 설정파일
 */
$countdown_config_file = G5_DATA_PATH . '/eyoom.countdown.php';

/**
 * 설정파일 저장
 */
$qfile->save_file('countdown', $countdown_config_file, $countdown);

/**
 * 페이지 리턴
 */
alert($msg, G5_ADMIN_URL.'/?dir=config&amp;pid=countdown');