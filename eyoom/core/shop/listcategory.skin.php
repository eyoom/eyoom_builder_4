<?php
/**
 * core file : /eyoom/core/shop/listcategory.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 카테고리 정보 가져오기
 */
$listcategory = $shop->get_listcategory($ca['ca_id']);

/**
 * 스킨 출력
 */
include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/listcategory.skin.html.php');