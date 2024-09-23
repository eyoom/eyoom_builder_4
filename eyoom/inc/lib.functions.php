<?php
/**
 * file : /eyoom/inc/lib.functions.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 라이브러리 함수 타겟
 */
$lib_target['latest']   = $eyoom['use_gnu_latest'] == 'y'   ? G5_LIB_PATH: EYOOM_LIB_PATH;
$lib_target['outlogin'] = $eyoom['use_gnu_outlogin'] == 'y' ? G5_LIB_PATH: EYOOM_LIB_PATH;
$lib_target['poll']     = $eyoom['use_gnu_poll'] == 'y'     ? G5_LIB_PATH: EYOOM_LIB_PATH;
$lib_target['visit']    = $eyoom['use_gnu_visit'] == 'y'    ? G5_LIB_PATH: EYOOM_LIB_PATH;
$lib_target['connect']  = $eyoom['use_gnu_connect'] == 'y'  ? G5_LIB_PATH: EYOOM_LIB_PATH;
$lib_target['popular']  = $eyoom['use_gnu_popular'] == 'y'  ? G5_LIB_PATH: EYOOM_LIB_PATH;

/**
 * 라이브러리 함수 인크루드
 */
include_once($lib_target['latest']      . '/latest.lib.php');
include_once($lib_target['outlogin']    . '/outlogin.lib.php');
include_once($lib_target['poll']        . '/poll.lib.php');
include_once($lib_target['visit']       . '/visit.lib.php');
include_once($lib_target['connect']     . '/connect.lib.php');
include_once($lib_target['popular']     . '/popular.lib.php');
unset($lib_target);

/**
 * 이윰 라이브러리 함수
 */
@include_once(EYOOM_LIB_PATH . '/common.lib.php');
@include_once(EYOOM_LIB_PATH . '/nameview.lib.php');
@include_once(EYOOM_LIB_PATH . '/tagmenu.lib.php');
@include_once(EYOOM_LIB_PATH . '/paging.lib.php');
@include_once(EYOOM_LIB_PATH . '/ranking.lib.php');
@include_once(EYOOM_LIB_PATH . '/ebslider.lib.php');
@include_once(EYOOM_LIB_PATH . '/ebcontents.lib.php');
@include_once(EYOOM_LIB_PATH . '/ebgoods.lib.php');
@include_once(EYOOM_LIB_PATH . '/ebbanner.lib.php');
@include_once(EYOOM_LIB_PATH . '/uri.lib.php');
@include_once(EYOOM_LIB_PATH . '/visit.lib.php');
@include_once(EYOOM_LIB_PATH . '/brand.lib.php');

/**
 * 쇼핑몰 이윰 라이브러리 함수
 */
if (defined('G5_USE_SHOP') && G5_USE_SHOP) {
    @include_once(EYOOM_LIB_PATH . '/mainbanner.lib.php');
}