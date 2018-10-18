<?php
if (!defined('_EYOOM_')) exit;

// 커뮤니티 레이아웃을 쇼핑몰에 적용하기
if(isset($eyoom['use_layout_community']) && $eyoom['use_layout_community'] == 'y') {
    @include_once(EYOOM_PATH.'/tail.php');
    return;
}

/**
 * 로딩 시간 계산
 */
$run_time = get_microtime() - $start_time;

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_SHOP_PATH . '/shop.tail.php');

/**
 * 이윰 테마파일 출력
 */
include_once(EYOOM_THEME_SHOP_PATH . '/shop.tail.html.php');

/**
 * 이윰 테마파일 출력
 */
include_once(EYOOM_PATH."/tail.sub.php");