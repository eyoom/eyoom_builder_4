<?php
/**
 * @file    /adm/eyoom_admin/core/member/visit_week.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "200800";

auth_check_menu($auth, $sub_menu, 'r');

$fr_date = isset($_REQUEST['fr_date']) ? preg_replace('/[^0-9 :\-]/i', '', $_REQUEST['fr_date']) : G5_TIME_YMD;
$to_date = isset($_REQUEST['to_date']) ? preg_replace('/[^0-9 :\-]/i', '', $_REQUEST['to_date']) : G5_TIME_YMD;

/**
 * 탭메뉴 활성화 구분자
 */
$visit_mode = 'visit_week';

include_once(EYOOM_ADMIN_CORE_PATH . '/member/visit.sub.php');

$weekday = array ('월', '화', '수', '목', '금', '토', '일');

$sum_count = 0;
$arr = array();
$limit = '';

$sql_common = " from {$g5['visit_sum_table']} ";
$sql_search = " where (1) ";

if ($fr_date && $to_date) {
    $sql_search .= " and vs_date between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
    $qstr .= "&amp;fr_date={$fr_date}&amp;to_date={$to_date}";
} else {
    $limit = ' limit 100 ';
}

$sql = " select WEEKDAY(vs_date) as weekday_date, SUM(vs_count) as cnt
            {$sql_common}
            {$sql_search}
            group by weekday_date
            order by weekday_date {$limit}";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $arr[$row['weekday_date']] = $row['cnt'];

    $sum_count += $row['cnt'];
}

$k = 0;
$list = array();
if ($i) {
    for ($i=0; $i<7; $i++) {
        $count = (int)$arr[$i];

        $rate = ($count / $sum_count * 100);
        $s_rate = number_format($rate, 1);

        $list[$i]['week'] = $weekday[$i];
        $list[$i]['s_rate'] = $s_rate;
        $list[$i]['count'] = $count;
    }
}