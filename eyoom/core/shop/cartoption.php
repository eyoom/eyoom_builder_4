<?php
/**
 * core file : /eyoom/core/shop/cartoption.php
 */
if (!defined('_EYOOM_')) exit;

$pattern = '#[/\'\"%=*\#\(\)\|\+\&\!\$~\{\}\[\]`;:\?\^\,]#';
$it_id  = preg_replace($pattern, '', $_POST['it_id']);

$sql = " select * from {$g5['g5_shop_item_table']} where it_id = '" . sql_real_escape_string($it_id) . "' and it_use = '1' ";
$it = sql_fetch($sql);
$it_point = get_item_point($it);

if(!$it['it_id'])
    die('no-item');

// 장바구니 자료
$cart_id = get_session('ss_cart_id');
$sql = " select * from {$g5['g5_shop_cart_table']} where od_id = '$cart_id' and it_id = '" . sql_real_escape_string($it_id) . "' order by io_type asc, ct_id asc ";
$result = sql_query($sql);

// 판매가격
$sql2 = " select ct_price, it_name, ct_send_cost from {$g5['g5_shop_cart_table']} where od_id = '$cart_id' and it_id = '" . sql_real_escape_string($it_id) . "' order by ct_id asc limit 1 ";
$row2 = sql_fetch($sql2);

if(!sql_num_rows($result))
    die('no-cart');
    
/**
 * 이윰 테마파일 출력
 */
include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/cartoption.skin.html.php');