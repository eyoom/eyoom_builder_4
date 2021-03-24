<?php
/**
 * core file : /eyoom/core/shop/orderaddress.php
 */
if (!defined('_EYOOM_')) exit;

if(!$is_member)
    alert_close('회원이시라면 회원로그인 후 이용해 주십시오.');

if($w == 'd') {
    $sql = " delete from {$g5['g5_shop_order_address_table']} where mb_id = '{$member['mb_id']}' and ad_id = '$ad_id' ";
    sql_query($sql);
    goto_url($_SERVER['SCRIPT_NAME']);
}

$sql_common = " from {$g5['g5_shop_order_address_table']} where mb_id = '{$member['mb_id']}' ";

$sql = " select count(ad_id) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select *
            $sql_common
            order by ad_default desc, ad_id desc
            limit $from_record, $rows";

$result = sql_query($sql);

if(!sql_num_rows($result))
    alert_close('배송지 목록 자료가 없습니다.');

$order_action_url = G5_HTTPS_SHOP_URL.'/orderaddressupdate.php';

$g5['title'] = '배송지 목록';
include_once(G5_PATH.'/head.sub.php');

$sep = chr(30);
$list = array();
for($i=0; $row=sql_fetch_array($result); $i++) {
    $addr = $row['ad_name'].$sep.$row['ad_tel'].$sep.$row['ad_hp'].$sep.$row['ad_zip1'].$sep.$row['ad_zip2'].$sep.$row['ad_addr1'].$sep.$row['ad_addr2'].$sep.$row['ad_addr3'].$sep.$row['ad_jibeon'].$sep.$row['ad_subject'];
    $addr = get_text($addr);
    
	$list[$i]['addr'] = $addr;
	$list[$i]['ad_id'] = $row['ad_id'];
	$list[$i]['ad_subject'] = $row['ad_subject'];
	$list[$i]['ad_default'] = $row['ad_default'];
	$list[$i]['ad_name'] = $row['ad_name'];
	$list[$i]['ad_tel'] = $row['ad_tel'];
	$list[$i]['ad_hp'] = $row['ad_hp'];
	$list[$i]['ad_addr1'] = $row['ad_addr1'];
	$list[$i]['ad_addr2'] = $row['ad_addr2'];
	$list[$i]['ad_addr3'] = $row['ad_addr3'];
	$list[$i]['ad_jibeon'] = $row['ad_jibeon'];
	$list[$i]['del_href'] = $_SERVER['SCRIPT_NAME'] .'?w=d&amp;ad_id='.$row['ad_id'];
}
$count = count((array)$list);

/**
 * 페이징
 */
$paging = $eb->set_paging('orderaddress', '', $qstr);

/**
 * 스킨 출력
 */
include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/orderaddress.skin.html.php');

include_once(G5_PATH.'/tail.sub.php');