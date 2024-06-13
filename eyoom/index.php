<?php
/**
 * file : /eyoom/index.php
 */
define('_INDEX_', true);

/**
 * 개별페이지 접근 불가
 */
if (!defined('_EYOOM_')) exit;

/**
 * 메인주소를 쇼핑몰로 사용
 */
if (isset($eyoom['use_shop_index']) && $eyoom['use_shop_index'] == 'y') {
    @include_once(G5_THEME_SHOP_PATH.'/index.php');
    return;
}

/**
 * 메인에서 쇼핑몰 유형별 상품 출력
 */
if (isset($eyoom['use_shop_itemtype']) && $eyoom['use_shop_itemtype'] == 'y') {
    @include_once(G5_THEME_SHOP_PATH.'/itemtype.php');
}

/**
 * 헤더 디자인 출력
 */
include_once(EYOOM_PATH . '/head.php');

/**
 * 팝업창
 */
if (!$is_myhome) {
    if ($eyoom['use_gnu_newwin'] == 'n') {
        @include_once(EYOOM_CORE_PATH.'/newwin/newwin.inc.php');
    }
    else {
        @include_once(G5_BBS_PATH.'/newwin.inc.php');
    }
}

/**
 * 메인 디자인 출력
 */
$eb->print_mainpage();

/**
 * 이윰 테마파일 출력
 */
include_once(EYOOM_PATH . '/tail.php');