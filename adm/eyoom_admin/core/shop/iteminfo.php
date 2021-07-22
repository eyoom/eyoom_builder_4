<?php
/**
 * @file    /adm/eyoom_admin/core/shop/iteminfo.php
 */
include_once('./_common.php');
include_once(G5_LIB_PATH.'/iteminfo.lib.php');

if(isset($it['it_id']) && $it['it_id']) {
    //$it_id = $it['it_id'];
    $gubun = $it['it_info_gubun'];
} else {
    $it_id = isset($_POST['it_id']) ? safe_replace_regex($_POST['it_id'], 'it_id') : '';
    $gubun = isset($_POST['gubun']) ? clean_xss_tags($_POST['gubun'], 1, 1) : 'wear';
    
    if ( $it_id ){
        $sql = " select it_id, it_info_gubun, it_info_value from {$g5['g5_shop_item_table']} where it_id = '$it_id' ";
        if( $items = sql_fetch($sql) ) {
            $it = $items;
        }
    }
}

if(isset($it['it_info_value']) && $it['it_info_value'])
    $info_value = unserialize($it['it_info_value']);

$article = isset($item_info[$gubun]['article']) ? $item_info[$gubun]['article'] : array();
$itinfo = array();
if ($article) {
    // $el_no : 분류적용, 전체적용을 한번만 넣기 위해, $el_length : 수직병합할 셀 값 - 지운아빠 2013-05-20
    $el_no = 0;
    $el_length = count($article);
    $it_info_gubun = isset($it['it_info_gubun']) ? $it['it_info_gubun'] : '';

    foreach($article as $key=>$value) {
        $el_name    = $key;
        $el_title   = $value[0];
        $el_example = $value[1];
        $el_value = '상품페이지 참고';

        if($gubun == $it['it_info_gubun'] && $info_value[$key])
            $el_value = $info_value[$key];

        $itinfo[$k]['el_name']      = $el_name;
        $itinfo[$k]['el_title']     = $el_title;
        $itinfo[$k]['el_example']   = $el_example;
        $itinfo[$k]['el_value']     = $el_value;
        $k++;
    }
}

/**
 * 페이지 출력
 */
include_once(EYOOM_ADMIN_THEME_PATH . "/skin/shop/iteminfo.html.php");