<?php
/**
 * core file : /eyoom/core/shop/list.30.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * item_list 클래스내에서 실행되는 파일로 글로벌 선언이 필요함
 */
global $skin_dir, $shop;

/**
 * 상품리스트 공통
 */
@include_once($skin_dir.'/list.skin.php');

/**
 * 스킨 출력
 */
include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/list.30.skin.html.php');