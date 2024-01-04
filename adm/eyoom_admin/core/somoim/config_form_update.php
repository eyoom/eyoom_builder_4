<?php
/**
 * @file    /adm/eyoom_admin/core/somoim/config_form_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "350100";

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], 'w');

check_admin_token();

unset($_POST['token']);

if (!isset($sm_bo_table)) exit;

/**
 * POST 변수 필터
 */
foreach ($_POST as $key => $val) {
    $somo[$key] = clean_xss_tags(trim($val));
}

/**
 * data 폴더에 각 테마폴더 생성
 */
$somo_config_file = G5_DATA_PATH . '/somoim/somo_config.php';
$qfile->save_file('somo', $somo_config_file, $somo, false);

alert('설정을 저장하였습니다.', G5_ADMIN_URL."/?dir=somoim&pid=config_form");