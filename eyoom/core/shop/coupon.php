<?php
/**
 * core file : /eyoom/core/shop/coupon.php
 */
if (!defined('_EYOOM_')) exit;

if ($is_guest)
    alert_close('회원만 조회하실 수 있습니다.');

$g5['title'] = $member['mb_nick'].' 님의 쿠폰 내역';
include_once(G5_PATH.'/head.sub.php');

$sql = " select cp_id, cp_subject, cp_method, cp_target, cp_start, cp_end, cp_type, cp_price
            from {$g5['g5_shop_coupon_table']}
            where mb_id IN ( '{$member['mb_id']}', '전체회원' )
              and cp_start <= '".G5_TIME_YMD."'
              and cp_end >= '".G5_TIME_YMD."'
            order by cp_no ";
$result = sql_query($sql);

$cp_count = 0;
$k=0;
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    if (is_used_coupon($member['mb_id'], $row['cp_id']))
        continue;

    if ($row['cp_method'] == 1) {
        $sql = " select ca_name from {$g5['g5_shop_category_table']} where ca_id = '{$row['cp_target']}' ";
        $ca = sql_fetch($sql);
        $cp_target = $ca['ca_name'].'의 상품할인';
    } else if ($row['cp_method'] == 2) {
        $cp_target = '결제금액 할인';
    } else if ($row['cp_method'] == 3) {
        $cp_target = '배송비 할인';
    } else {
        $sql = " select it_name from {$g5['g5_shop_item_table']} where it_id = '{$row['cp_target']}' ";
        $it = sql_fetch($sql);
        $cp_target = $it['it_name'].' 상품할인';
    }

    if ($row['cp_type'])
        $cp_price = $row['cp_price'].'%';
    else
        $cp_price = number_format($row['cp_price']).'원';

	$list[$k]['cp_subject'] = $row['cp_subject'];
	$list[$k]['cp_start'] = $row['cp_start'];
	$list[$k]['cp_end'] = $row['cp_end'];
	$list[$k]['cp_target'] = $cp_target;
	$list[$k]['cp_price'] = $cp_price;

    $cp_count++;
    $k++;
}

/**
 * 이윰 테마파일 출력
 */
include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/coupon.skin.html.php');

include_once(G5_PATH.'/tail.sub.php');