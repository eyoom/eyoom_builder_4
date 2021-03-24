<?php
/**
 * core file : /eyoom/core/member/point.skin.php
 */
if (!defined('_EYOOM_')) exit;

$g5['title'] = $member['mb_nick'].' 님의 '.$levelset['gnu_name'].' 내역';
$sum_point1 = $sum_point2 = $sum_point3 = 0;

$sql = " select * {$sql_common} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $point1 = $point2 = 0;
    if ($row['po_point'] > 0) {
        $point1 = '+' .number_format($row['po_point']);
        $sum_point1 += $row['po_point'];
    } else {
        $point2 = number_format($row['po_point']);
        $sum_point2 += $row['po_point'];
    }

    $expr = '';
    if ($row['po_expired'] == 1)
        $expr = ' txt_expired';
    $row['expr'] = $expr;
    $row['point1'] = $point1;
    $row['point2'] = $point2;

    $list[$i] = $row;
}

if (count((array)$list)>0) {
    if ($sum_point1 > 0) $sum_point1 = "+" . number_format($sum_point1);
    $sum_point2 = number_format($sum_point2);
}

/**
 * 페이징
 */
$paging = $eb->set_paging('point', '', $qstr);

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/member/point.skin.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['member'].'/point.skin.html.php');