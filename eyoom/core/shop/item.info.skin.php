<?php
/**
 * core file : /eyoom/core/shop/item.info.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 관련상품
 */
if ($default['de_rel_list_use']) {
    $rel_skin_file = $skin_dir.'/'.$default['de_rel_list_skin'];
    if(!is_file($rel_skin_file))
        $rel_skin_file = G5_SHOP_SKIN_PATH.'/'.$default['de_rel_list_skin'];

    $sql = " select b.* from {$g5['g5_shop_item_relation_table']} a left join {$g5['g5_shop_item_table']} b on (a.it_id2=b.it_id) where a.it_id = '{$it['it_id']}' and b.it_use='1' ";
    $list = new item_list($rel_skin_file, $default['de_rel_list_mod'], 0, $default['de_rel_img_width'], $default['de_rel_img_height']);
    $list->set_query($sql);
    $rel_list = $list->run();
}

/**
 * 상품 정보 고시
 */
if ($it['it_info_value']) {
    $info_data = $eb->mb_unserialize(stripslashes($it['it_info_value']));

    if (is_array($info_data)) {
        $gubun = $it['it_info_gubun'];
        $info_array = $item_info[$gubun]['article'];
        $i=0;
        foreach ($info_data as $key => $val) {
            $ii_info[$i]['title'] = $info_array[$key][0];
            $ii_info[$i]['value'] = $val;
            $i++;
        }
    }
}

/**
 * 스킨 출력
 */
include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/item.info.skin.html.php');