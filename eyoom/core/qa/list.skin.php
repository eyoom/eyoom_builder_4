<?php
/**
 * core file : /eyoom/core/qa/list.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 선택옵션으로 인해 셀합치기가 가변적으로 변함
 */
$colspan = 6;

if ($is_checkbox) $colspan++;

for ($i=0; $i<count($categories); $i++) {
    $category = trim($categories[$i]);
    if ($category=='') continue;
    $category_tab[$i]['category'] = $category;
    $category_tab[$i]['href'] = $category_href."?sca=".urlencode($category);
}

/**
 * 페이징
 */
$paging = $eb->set_paging('./qalist.php?'.$qstr.'&amp;page=');

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/qa/list.skin.php');

/**
 * 출력
 */
include_once($eyoom_skin_path['qa'].'/list.skin.html.php');