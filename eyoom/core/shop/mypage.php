<?php
/**
 * core file : /eyoom/core/shop/mypage.php
 */
if (!defined('_EYOOM_')) exit;

if (!$is_member)
    goto_url(G5_BBS_URL."/login.php?url=".urlencode(G5_SHOP_URL."/mypage.php"));

$g5['title'] = '마이페이지';

include_once('./_head.php');

// 쿠폰
$cp_count = 0;
$sql = " select cp_id
            from {$g5['g5_shop_coupon_table']}
            where mb_id IN ( '{$member['mb_id']}', '전체회원' )
              and cp_start <= '".G5_TIME_YMD."'
              and cp_end >= '".G5_TIME_YMD."' ";
$res = sql_query($sql);

for($k=0; $cp=sql_fetch_array($res); $k++) {
    if(!is_used_coupon($member['mb_id'], $cp['cp_id']))
        $cp_count++;
}

/**
 * 최근 위시리스트
 */
$sql = " select *
           from {$g5['g5_shop_wish_table']} a,
                {$g5['g5_shop_item_table']} b
          where a.mb_id = '{$member['mb_id']}'
            and a.it_id  = b.it_id
          order by a.wi_id desc
          limit 0, 8 ";
$result = sql_query($sql);
$wish_list = array();
for ($i=0; $row = sql_fetch_array($result); $i++) {
    $image = get_it_image($row['it_id'], 500, 0, true);
    
    $wish_list[$i] = $row;
    $wish_list[$i]['image'] = $image;
}
$wish_count = count((array)$wish_list);

/**
 * 이윰 테마파일 출력
 */
include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/mypage.skin.html.php');

include_once("./_tail.php");