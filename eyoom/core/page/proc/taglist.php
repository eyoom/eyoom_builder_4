<?php
/**
 * core file : /eyoom/page/proc/taglist.php
 */
if (!defined('_EYOOM_')) exit;

// 기본쿼리
$sql_common = " from {$g5['eyoom_tag']} where (1) and tg_theme = '" . sql_real_escape_string($theme) . "' ";

$sql_order = " order by tg_word asc, tg_regdt desc ";

$sql = " select count(*) as cnt {$sql_common}";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$page = (int)$_GET['page'];
if (!$page) $page = 1;
if (!$page_rows) $page_rows = $config['cf_page_rows'] * 10;
$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

$sql = "select * {$sql_common} {$sql_order} limit {$from_record}, {$page_rows}";

$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    unset($heading);
    $list[$i] = $row;
    $list[$i]['href'] = G5_URL . '/page/?pid=tagview&amp;tag=' . str_replace('&', '^', $row['tg_word']);
    $list[$i]['tag'] = $row['tg_word'];

    if ($row['tg_recommdt'] != '0000-00-00 00:00:00') {
        $list[$i]['weight'] = '10';
    } else {
        $weight = ceil($row['tg_score']/10);
        if ($weight > 10) $weight = 10;

        $list[$i]['weight'] = $weight;
    }
}

/**
 * 페이징
 */
$paging = $eb->set_paging('taglist', '', $qstr);