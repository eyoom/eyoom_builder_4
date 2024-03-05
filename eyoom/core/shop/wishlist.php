<?php
/**
 * core file : /eyoom/core/shop/wishlist.php
 */
if (!defined('_EYOOM_')) exit;

if (!$is_member)
    goto_url(G5_BBS_URL."/login.php?url=".urlencode(G5_SHOP_URL.'/wishlist.php'));

/**
 * 상단 디자인
 */
include_once('./_head.php');

/**
 * 위시리스트 정보 가져오기
 */
$sql  = " select a.wi_id, a.wi_time, b.* from {$g5['g5_shop_wish_table']} a left join {$g5['g5_shop_item_table']} b on ( a.it_id = b.it_id ) ";
$sql .= " where a.mb_id = '{$member['mb_id']}' order by a.wi_id desc ";
$result = sql_query($sql);
$list = array();
for ($i=0; $row = sql_fetch_array($result); $i++) {

    $out_cd = '';
    $sql = " select count(*) as cnt from {$g5['g5_shop_item_option_table']} where it_id = '{$row['it_id']}' and io_type = '0' ";
    $tmp = sql_fetch($sql);
    if(isset($tmp['cnt']) && $tmp['cnt'])
        $out_cd = 'no';

    $it_price = get_price($row);

    if ($row['it_tel_inq']) $out_cd = 'tel_inq';

    $image = get_it_image($row['it_id'],500, 0);

    $list[$i]['it_id'] = $row['it_id'];
    $list[$i]['it_name'] = $row['it_name'];
    $list[$i]['wi_time'] = $row['wi_time'];
    $list[$i]['wi_id'] = $row['wi_id'];
    $list[$i]['out_cd'] = $out_cd;
    $list[$i]['image'] = $image;
}

/**
 * 이윰 테마파일 출력
 */
include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/wishlist.skin.html.php');

/**
 * 하위 디자인
 */
include_once('./_tail.php');