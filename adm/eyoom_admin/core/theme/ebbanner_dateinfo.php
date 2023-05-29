<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebbanner_dateinfo.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999630";

auth_check_menu($auth, $sub_menu, 'r');

$bn_code = isset($_REQUEST['bn_code']) && $_REQUEST['bn_code'] ? clean_xss_tags($_REQUEST['bn_code']) : '';
$bi_no   = isset($_REQUEST['bi_no']) && $_REQUEST['bi_no'] ? (int) clean_xss_tags($_REQUEST['bi_no']) : '';

$fr_date = isset($_REQUEST['fr_date']) ? preg_replace('/[^0-9 :\-]/i', '', $_REQUEST['fr_date']) : date("Y-m-01");
$to_date = isset($_REQUEST['to_date']) ? preg_replace('/[^0-9 :\-]/i', '', $_REQUEST['to_date']) : G5_TIME_YMD;

$max_expose = $max_clicked = 0;
$sum_expose = $sum_clicked = 0;
$expose = $clicked = array();
$limit = '';

$sql_common = " from {$g5['eyoom_banner_date']} ";
$sql_search = " where (1) ";

if ($fr_date && $to_date) {
    $sql_search .= " and bs_date between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
    $qstr .= "&amp;fr_date={$fr_date}&amp;to_date={$to_date}";
} else {
    $limit = ' limit 100 ';
}

$sql = " select bs_date, bs_expose, bs_clicked {$sql_common} {$sql_search} order by bs_date desc {$limit} ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $bs_expose = unserialize($row['bs_expose']);
    $bs_clicked = unserialize($row['bs_clicked']);
    $expose[$row['bs_date']] = $bs_expose[$bi_no];
    $clicked[$row['bs_date']] = $bs_clicked[$bi_no];

    if ($bs_expose[$bi_no] > $max_expose) $max_expose = $bs_expose[$bi_no];
    if ($bs_clicked[$bi_no] > $max_clicked) $max_clicked = $bs_clicked[$bi_no];

    $sum_expose += $bs_expose[$bi_no];
    $sum_clicked += $bs_clicked[$bi_no];
}

$i = 0;
$list = array();
if (count((array)$expose)) {
    foreach ($expose as $key=>$value) {
        $count_expose = $value;
        $count_clicked = $clicked[$key];

        $rate = $count_expose > 0 ? ($count_clicked / $count_expose * 100): 0;
        $s_rate = number_format($rate, 1);

        $list[$i]['key'] = $key;
        $list[$i]['s_rate'] = $s_rate;
        $list[$i]['count_expose'] = $count_expose;
        $list[$i]['count_clicked'] = $count_clicked;
        $i++;
    }
}

/**
 * 검색버튼
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" value="검색" class="btn-e btn-e-lg btn-e-dark" accesskey="s">' ;
$frm_submit .= '</div>';