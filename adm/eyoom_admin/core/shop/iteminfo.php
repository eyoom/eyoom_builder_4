<?php
/**
 * @file    /adm/eyoom_admin/core/shop/iteminfo.php
 */
include_once('./_common.php');
include_once(G5_LIB_PATH.'/iteminfo.lib.php');

if($it['it_id']) {
    //$it_id = $it['it_id'];
    $gubun = $it['it_info_gubun'];
} else {
    $it_id = trim($_POST['it_id']);
    $gubun = $_POST['gubun'] ? $_POST['gubun'] : 'wear';

    $sql = " select it_id, it_info_gubun, it_info_value from {$g5['g5_shop_item_table']} where it_id = '$it_id' ";
    $it = sql_fetch($sql);
}

if($it['it_info_value'])
    $info_value = unserialize($it['it_info_value']);
$article = $item_info[$gubun]['article'];
if ($article) {
    // $el_no : 분류적용, 전체적용을 한번만 넣기 위해, $el_length : 수직병합할 셀 값 - 지운아빠 2013-05-20
    $el_no = 0;
    $el_length = count($article);
    $k=0;
    foreach($article as $key=>$value) {
        $itinfo[$k]['el_name']    = $key;
        $itinfo[$k]['el_title']   = $value[0];
        $itinfo[$k]['el_example'] = $value[1];
        $el_value = '상품페이지 참고';

        if($gubun == $it['it_info_gubun'] && $info_value[$key])
            $el_value = $info_value[$key];

        $itinfo[$k]['el_value'] = $el_value;
        $k++;
    }
}

/**
 * 페이지 출력
 */
include_once(EYOOM_ADMIN_THEME_PATH . "/skin/shop/iteminfo.html.php");