<?php
/**
 * @file    /adm/eyoom_admin/core/member/visit_hour.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "200800";

auth_check_menu($auth, $sub_menu, 'r');

$fr_date = isset($_REQUEST['fr_date']) ? preg_replace('/[^0-9 :\-]/i', '', $_REQUEST['fr_date']) : G5_TIME_YMD;
$to_date = isset($_REQUEST['to_date']) ? preg_replace('/[^0-9 :\-]/i', '', $_REQUEST['to_date']) : G5_TIME_YMD;

/**
 * 탭메뉴 활성화 구분자
 */
$visit_mode = 'visit_hour';

include_once(EYOOM_ADMIN_CORE_PATH . '/member/visit.sub.php');

$max = 0;
$sum_count = 0;
$arr = array();
$limit = '';

$sql_common = " from {$g5['visit_table']} ";
$sql_search = " where (1) ";

if ($fr_date && $to_date) {
    $sql_search .= " and vi_date between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
    $qstr .= "&amp;fr_date={$fr_date}&amp;to_date={$to_date}";
} else {
    $limit = ' limit 100 ';
}

$sql = " select SUBSTRING(vi_time,1,2) as vi_hour, count(vi_id) as cnt
            {$sql_common}
            {$sql_search}
            group by vi_hour
            order by vi_hour {$limit}";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $arr[$row['vi_hour']] = $row['cnt'];

    if ($row['cnt'] > $max) $max = $row['cnt'];

    $sum_count += $row['cnt'];
}

$k = 0;
$list = array();
if ($i) {
    for ($i=0; $i<24; $i++) {
        $hour = sprintf("%02d", $i);
        $count = (int)$arr[$hour];

        $rate = ($count / $sum_count * 100);
        $s_rate = number_format($rate, 1);

        $list[$i]['hour'] = $hour;
        $list[$i]['s_rate'] = $s_rate;
        $list[$i]['count'] = $count;
    }
}