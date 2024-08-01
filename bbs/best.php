<?php
include_once('./_common.php');

$g5['title'] = '인기게시물';
include_once('./_head.php');

$sql_common = " from {$g5['eyoom_best']} a, {$g5['board_table']} b ";

$sql_search = " where a.bo_table = b.bo_table ";

// 기간검색이 있다면
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $fr_date) ) $fr_date = '';
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $to_date) ) $to_date = '';

if ($fr_date && $to_date) {
    $sql_search .= " and wr_datetime between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
    $qstr .= "&amp;fr_date={$fr_date}&amp;to_date={$to_date}";
}

if (!$sort) {
    $sort = 'a.wr_good';
} else {
    $sort = clean_xss_tags($_REQUEST['sort']);
    $qstr .= "&amp;sort={$sort}";
}
$sql_order = " order by {$sort} desc ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = G5_IS_MOBILE ? $config['cf_mobile_page_rows'] : $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$list = array();
$sql = " select a.*, b.bo_subject, b.bo_mobile_subject {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $tmp_write_table = $g5['write_prefix'].$row['bo_table'];

    $row2 = sql_fetch(" select * from {$tmp_write_table} where wr_id = '{$row['wr_id']}' ");
    if (!$row2) {
        sql_query("delete from {$g5['eyoom_best']} where bo_table='{$row['bo_table']}' and wr_id='{$row['wr_id']}' ");
        continue;
    } else {
        $list[$i] = $row2;

        $list[$i]['bo_table'] = $row['bo_table'];
        $list[$i]['wr_good'] = $row2['wr_good'];
        $list[$i]['href'] = get_pretty_url($row['bo_table'], $row2['wr_id'], $comment_link);
    
        $list[$i]['datetime1'] = substr($row['wr_datetime'],0,10);
        $list[$i]['datetime2'] = substr($row['bb_datetime'],0,10);
    
        $list[$i]['bo_subject'] = ((G5_IS_MOBILE && $row['bo_mobile_subject']) ? $row['bo_mobile_subject'] : $row['bo_subject']);
        $list[$i]['wr_subject'] = $row2['wr_subject'];
    }
}

$write_pages = get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "?gr_id=$gr_id&amp;view=$view&amp;mb_id=$mb_id&amp;page=");

include_once($best_skin_path.'/best.skin.php');

include_once('./_tail.php');