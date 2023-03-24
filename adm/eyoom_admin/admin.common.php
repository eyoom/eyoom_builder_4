<?php
/**
 * @file    admin.common.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 그누관리자 모드로 활성화되어 있는지 체크
 */
if ($eyoom['use_eyoom_admin'] == 'n' || $use_eyoom_builder === false) return;

/**
 * 관리자모드 라이브러리 파일
 */
@include_once(G5_ADMIN_PATH.'/admin.lib.php');

if( isset($token) ){
    $token = @htmlspecialchars(strip_tags($token), ENT_QUOTES);
}

/**
 * 이벤트 후킹
 */
run_event('admin_common');

/**
 * 영카트5 인가?
 */
$is_youngcart = false;
if (defined('G5_USE_SHOP') && G5_USE_SHOP) {
    $is_youngcart = true;

    /**
     * 쇼핑몰 라이브러리 파일
     */
    include_once(EYOOM_ADMIN_LIB_PATH.'/shop.lib.php');
}

/**
 * 이윰 관리자모드 라이브러리 파일
 */
@include_once(EYOOM_ADMIN_LIB_PATH.'/admin.lib.php');

/**
 * $dir 변수 정의
 */
if($_REQUEST['dir']) {
    $dir = preg_replace('/[^a-z0-9_]/i', '', trim($_REQUEST['dir']));
    $dir = substr($dir, 0, 20);
}

/**
 * $pid 변수 정의
 */
if($_REQUEST['pid']) {
    $pid = preg_replace('/[^a-z0-9_|]/i', '', trim($_REQUEST['pid']));
    $pid = substr($pid, 0, 50);
}