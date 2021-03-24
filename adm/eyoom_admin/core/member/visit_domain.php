<?php
/**
 * @file    /adm/eyoom_admin/core/member/visit_domain.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "200800";

auth_check_menu($auth, $sub_menu, 'r');

$fr_date = isset($_REQUEST['fr_date']) ? preg_replace('/[^0-9 :\-]/i', '', $_REQUEST['fr_date']) : G5_TIME_YMD;
$to_date = isset($_REQUEST['to_date']) ? preg_replace('/[^0-9 :\-]/i', '', $_REQUEST['to_date']) : G5_TIME_YMD;

/**
 * 탭메뉴 활성화 구분자
 */
$visit_mode = 'visit_domain';

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

$sql = " select * {$sql_common} {$sql_search} {$limit}";
$result = sql_query($sql);
while ($row=sql_fetch_array($result)) {
    $str = $row['vi_referer'];
    preg_match("/^http[s]*:\/\/([\.\-\_0-9a-zA-Z]*)\//", $str, $match);
    $s = $match[1];
    $s = preg_replace("/^(www\.|search\.|dirsearch\.|dir\.search\.|dir\.|kr\.search\.|myhome\.)(.*)/", "\\2", $s);
    $arr[$s]++;

    if ($arr[$s] > $max) $max = $arr[$s];

    $sum_count++;
}

$i = 0;
$j = 0;
$k = 0;
$save_count = -1;
$tot_count = 0;
$list = array();
if (count((array)$arr)) {
    arsort($arr);
    foreach ($arr as $key=>$value) {
        $count = $arr[$key];
        if ($save_count != $count) {
            $i++;
            $no = $i;
            $save_count = $count;
        }

        if (!$key) {
            $link = '';
            $link2 = '';
            $key = '직접';
        } else {
            $link = "<a href='". G5_ADMIN_URL ."/?dir=member&amp;pid=visit_list&amp;" . $qstr . "&amp;domain=" . $key . "'>";
            $link2 = '</a>';
        }

        $rate = ($count / $sum_count * 100);
        $s_rate = number_format($rate, 1);

        $list[$j]['no'] = $no;
        $list[$j]['link'] = $link;
        $list[$j]['key'] = $key;
        $list[$j]['link2'] = $link2;
        $list[$j]['s_rate'] = $s_rate;
        $list[$j]['count'] = $count;
        $j++;
    }
}