<?php
/**
 * core file : /eyoom/core/shop/main.50.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * item_list 클래스내에서 실행되는 파일로 글로벌 선언이 필요함
 */
global $skin_dir, $shop;

/**
 * 상품리스트 공통
 */
include($skin_dir.'/list.skin.php');

/**
 * 스킨 출력
 */
include(EYOOM_THEME_SHOP_SKIN_PATH.'/main.50.skin.html.php');