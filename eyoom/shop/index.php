<?php
/**
 * core file : /eyoom/shop/index.php
 */
define("_INDEX_", TRUE);

/**
 * 개별페이지 접근 불가
 */
if (!defined('_EYOOM_')) exit;

/**
 * 모바일
 */
if (G5_IS_MOBILE && $eyoom['use_shop_mobile'] == 'y') {
    include_once(EYOOM_MSHOP_PATH.'/index.php');
    return;
}

/**
 * 헤더 디자인 출력
 */
include_once(EYOOM_SHOP_PATH . '/shop.head.php');

/**
 * 팝업창
 */
if ($eyoom['use_gnu_newwin'] == 'y') {
    @include_once(G5_BBS_PATH.'/newwin.inc.php');
}

/**
 * 쇼핑몰 메인
 * 이윰 테마파일 출력
 */
include_once(EYOOM_THEME_SHOP_PATH.'/index.html.php');

/**
 * 이윰 테마파일 출력
 */
include_once(EYOOM_SHOP_PATH . '/shop.tail.php');