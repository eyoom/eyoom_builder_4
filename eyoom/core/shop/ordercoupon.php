<?php
/**
 * core file : /eyoom/core/shop/ordercoupon.php
 */
if (!defined('_EYOOM_')) exit;

if($is_guest)
    exit;

$price = (int)preg_replace('#[^0-9]#', '', $_POST['price']);

if($price <= 0)
    die('상품금액이 0원이므로 쿠폰을 사용할 수 없습니다.');

// 쿠폰정보
$sql = " select *
            from {$g5['g5_shop_coupon_table']}
            where mb_id IN ( '{$member['mb_id']}', '전체회원' )
              and cp_method = '2'
              and cp_start <= '".G5_TIME_YMD."'
              and cp_end >= '".G5_TIME_YMD."'
              and cp_minimum <= '$price' ";
$result = sql_query($sql);
$count = sql_num_rows($result);

$k=0;
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    // 사용한 쿠폰인지 체크
    if (is_used_coupon($member['mb_id'], $row['cp_id']))
        continue;

    $dc = 0;
    if ($row['cp_type']) {
        $dc = floor(($price * ($row['cp_price'] / 100)) / $row['cp_trunc']) * $row['cp_trunc'];
    } else {
        $dc = $row['cp_price'];
    }

    if ($row['cp_maximum'] && $dc > $row['cp_maximum'])
        $dc = $row['cp_maximum'];

    $list[$k] = $row;
    $list[$k]['dc'] = $dc;
    $k++;
}
$cp_count = count((array)$list);

/**
 * 이윰 테마파일 출력
 */
include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/ordercoupon.skin.html.php');