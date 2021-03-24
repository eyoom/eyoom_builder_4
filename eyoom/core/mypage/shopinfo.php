<?php
/**
 * core file : /eyoom/core/mypage/shopinfo.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원체크
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.',G5_URL);

/**
 * 마이박스
 */
@include_once(EYOOM_CORE_PATH.'/mypage/mybox.php');

/**
 * 최근 주문내역
 */
$limit = " limit 0, 10 ";
$sql = " select *
           from {$g5['g5_shop_order_table']}
          where mb_id = '{$member['mb_id']}'
          order by od_id desc
          $limit ";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $uid = md5($row['od_id'].$row['od_time'].$row['od_ip']);

    switch ($row['od_status']) {
        case '주문':
            $od_status = '입금확인중';
            break;
        case '입금':
            $od_status = '입금완료';
            break;
        case '준비':
            $od_status = '상품준비중';
            break;
        case '배송':
            $od_status = '상품배송';
            break;
        case '완료':
            $od_status = '배송완료';
            break;
        default:
            $od_status = '주문취소';
            break;
    }
    $list[$i]['ct_id'] = $row['ct_id'];
    $list[$i]['od_id'] = $row['od_id'];
    $list[$i]['od_time'] = $row['od_time'];
    $list[$i]['od_cart_count'] = $row['od_cart_count'];
    $list[$i]['od_receipt_price'] = $row['od_receipt_price'];
    $list[$i]['od_misu'] = $row['od_misu'];
    $list[$i]['od_price'] = $row['od_cart_price'] + $row['od_send_cost'] + $row['od_send_cost2'];
    $list[$i]['href'] = G5_SHOP_URL.'/orderinquiryview.php?od_id='.$row['od_id'].'&amp;uid='.$uid;
    $list[$i]['od_status'] = $od_status;
}
$count = count($list);

/**
 * 최근 위시리스트
 */
$sql = " select *
           from {$g5['g5_shop_wish_table']} a,
                {$g5['g5_shop_item_table']} b
          where a.mb_id = '{$member['mb_id']}'
            and a.it_id  = b.it_id
          order by a.wi_id desc
          limit 0, 3 ";
$result = sql_query($sql);
$wishlist = array();
for ($i=0; $row = sql_fetch_array($result); $i++) {
    $image = get_it_image($row['it_id'], 70, 70, true);
    $wishlist[$i]['image'] = $image;
    $wishlist[$i]['it_id'] = $row['it_id'];
    $wishlist[$i]['it_name'] = $row['it_name'];
    $wishlist[$i]['wi_time'] = $row['wi_time'];
}
$wish_count = count($wishlist);

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/shopinfo.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/shopinfo.skin.html.php');