<?php
/**
 * core file : /eyoom/core/shop/personalpayform.sub.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 결재수단 초기설정
 */
$multi_settle = 0;
$checked = '';

$escrow_title = "";
if ($default['de_escrow_use']) {
    $escrow_title = "에스크로<br>";
}

/**
 * 이윰 테마파일 출력
 */
include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/personalpayform.sub.skin.html.php');