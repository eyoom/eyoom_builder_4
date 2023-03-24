<?php
/**
 * @file    /adm/eyoom_admin/core/seo/meta_seo_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "330100";

check_demo();

auth_check_menu($auth, $sub_menu, "w");

check_admin_token();

/**
 * $seocfg 변수파일 재정의
 */
unset($seocfg);
$seocfg_file = G5_DATA_PATH . '/eyoom.seocfg.php';
@include($seocfg_file);


/**
 * 예외 처리 변수
 */
$except = array('token');
foreach ($_POST as $key => $val) {
    if (in_array($key, $except)) continue;
    if ($key != 'mt_verification') {
        $val = preg_replace('/\r\n|\r|\n/', '', $val);
    }
    $seocfg[$key] = htmlspecialchars($val);
}

/**
 * 설정정보 업데이트
 */
$qfile->save_file('seocfg', $seocfg_file, $seocfg);

alert('메타태그 설정을 적용하였습니다.', G5_ADMIN_URL.'/?dir=seo&amp;pid=meta_seo');