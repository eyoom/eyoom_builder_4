<?php
/**
 * core file : /eyoom/core/shop/couponzone.10.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 다운로드 쿠폰
 */
$sql = " select * $sql_common and cz_type = '0' $sql_order ";
$result = sql_query($sql);

$coupon = '';
$dn_list = array();
for($i=0; $row=sql_fetch_array($result); $i++) {
    if(!$row['cz_file'])
        continue;

    $dn_list[$i] = $row;

    $img_file = G5_DATA_PATH.'/coupon/'.$row['cz_file'];
    if(!is_file($img_file))
        continue;

    $subj = get_text($row['cz_subject']);

    switch($row['cp_method']) {
        case '0':
            $sql3 = " select it_id, it_name from {$g5['g5_shop_item_table']} where it_id = '{$row['cp_target']}' ";
            $row3 = sql_fetch($sql3);
            $dn_list[$i]['link_href'] = shop_item_url($row3['it_id']);
            $dn_list[$i]['link_text'] = get_text($row3['it_name']);
            break;
        case '1':
            $sql3 = " select ca_id, ca_name from {$g5['g5_shop_category_table']} where ca_id = '{$row['cp_target']}' ";
            $row3 = sql_fetch($sql3);
            $dn_list[$i]['link_href'] = shop_category_url($row3['ca_id']);
            $dn_list[$i]['link_text'] = get_text($row3['ca_name']);
            break;
        case '2':
            $dn_list[$i]['cp_target'] = '주문금액할인';
            break;
        case '3':
            $dn_list[$i]['cp_target'] = '배송비할인';
            break;
    }

    // 다운로드 쿠폰인지
    $disabled = '';
    if(is_coupon_downloaded($member['mb_id'], $row['cz_id']))
        $disabled = ' disabled';

    $dn_list[$i]['coupon_img'] = str_replace(G5_PATH, G5_URL, $img_file);
    $dn_list[$i]['coupon_tit'] = $subj;
    $dn_list[$i]['btn_disabled'] = $disabled;
}
$dn_count = count((array)$dn_list);

/**
 * 포인트 쿠폰
 */
$sql = " select * $sql_common and cz_type = '1' $sql_order ";
$result = sql_query($sql);

$coupon = '';
$po_list = array();
for($i=0; $row=sql_fetch_array($result); $i++) {
    if(!$row['cz_file'])
        continue;

    $po_list[$i] = $row;

    $img_file = G5_DATA_PATH.'/coupon/'.$row['cz_file'];
    if(!is_file($img_file))
        continue;

    $subj = get_text($row['cz_subject']);

    switch($row['cp_method']) {
        case '0':
            $sql3 = " select it_id, it_name from {$g5['g5_shop_item_table']} where it_id = '{$row['cp_target']}' ";
            $row3 = sql_fetch($sql3);
            $po_list[$i]['link_href'] = shop_item_url($row3['it_id']);
            $po_list[$i]['link_text'] = get_text($row3['it_name']);
            break;
        case '1':
            $sql3 = " select ca_id, ca_name from {$g5['g5_shop_category_table']} where ca_id = '{$row['cp_target']}' ";
            $row3 = sql_fetch($sql3);
            $po_list[$i]['link_href'] = shop_category_url($row3['ca_id']);
            $po_list[$i]['link_text'] = get_text($row3['ca_name']);
            break;
        case '2':
            $po_list[$i]['cp_target'] = '주문금액할인';
            break;
        case '3':
            $po_list[$i]['cp_target'] = '배송비할인';
            break;
    }

    // 다운로드 쿠폰인지
    $disabled = '';
    if(is_coupon_downloaded($member['mb_id'], $row['cz_id']))
        $disabled = ' disabled';

    $po_list[$i]['coupon_img'] = str_replace(G5_PATH, G5_URL, $img_file);
    $po_list[$i]['coupon_tit'] = $subj;
    $po_list[$i]['btn_disabled'] = $disabled;
}
$po_count = count((array)$po_list);

/**
 * 이윰 테마파일 출력
 */
include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/couponzone.10.skin.html.php');