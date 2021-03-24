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
$category_tab = array();
for ($i=0; $i<count((array)$categories); $i++) {
    $category = trim($categories[$i]);
    if ($category=='') continue;
    $category_tab[$i]['category'] = $category;
    $category_tab[$i]['href'] = $category_href."?sca=".urlencode($category);
}

/**
 * 1:1문의 설정관리 링크 수정
 */
$admin_href = '';
if($is_admin) {
    $is_checkbox = true;
    $admin_href = G5_ADMIN_URL.'/?dir=board&pid=qa_config';
}

/**
 * 페이징
 */
$paging = $eb->set_paging('qalist', '', $qstr);

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/qa/list.skin.php');

/**
 * 출력
 */
include_once($eyoom_skin_path['qa'].'/list.skin.html.php');