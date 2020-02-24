<?php
/**
 * core file : /eyoom/core/faq/list.skin.php
 */
if (!defined('_EYOOM_')) exit;

$i=0;
foreach ($faq_master_list as $k => $v ){
    $category_msg = '';
    $category_option = '';
    if($v['fm_id'] == $fm_id){ // 현재 선택된 카테고리라면
        $category_option = ' id="bo_cate_on"';
        $category_msg = '<span class="sound_only">열린 분류 </span>';
    }
    $faq_master[$i] = $v;
    $faq_master[$i]['category_option'] = $category_option;
    $faq_master[$i]['category_msg'] = $category_msg;
    $i++;
}

/**
 * 페이징
 */
$paging = $eb->set_paging('faq', '', $qstr);


/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/faq/list.skin.php');

/**
 * 출력
 */
include_once($eyoom_skin_path['faq'].'/list.skin.html.php');