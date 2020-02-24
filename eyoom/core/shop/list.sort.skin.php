<?php
/**
 * core file : /eyoom/core/shop/list.sort.skin.php
 */
if (!defined('_EYOOM_')) exit;

$sct_sort_href = $_SERVER['SCRIPT_NAME'].'?';

if($ca_id) {
    $shop_category_url = shop_category_url($ca_id);
    $sct_sort_href = (strpos($shop_category_url, '?') === false) ? $shop_category_url.'?1=1' : $shop_category_url;
} else if($ev_id) {
    $sct_sort_href .= 'ev_id='.$ev_id;
}
    
if($skin)
    $sct_sort_href .= '&amp;skin='.$skin;
$sct_sort_href .= '&amp;sort=';

/**
 * 스킨 출력
 */
include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/list.sort.skin.html.php');