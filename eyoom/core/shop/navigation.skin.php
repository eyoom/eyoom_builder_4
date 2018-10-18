<?php
/**
 * core file : /eyoom/core/shop/navigation.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 네비게이션 정보 가져오기
 */
$navigation = $shop->get_navigation($ca['ca_id']);

/**
 * 스킨 출력
 */
include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/navigation.skin.html.php');