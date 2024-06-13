<?php
/**
 * @file    /adm/eyoom_admin/core/board/board_list.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300900";

$action_url1 = G5_ADMIN_URL . '/?dir=board&amp;pid=wrfixed_list_update&amp;smode=1';

auth_check_menu($auth, $sub_menu, 'r');

/**
 * 전체 게시판 정보
 */
$sql = "select bo_table, bo_subject from {$g5['board_table']} where (1) order by bo_table asc";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $bo_subject[$row['bo_table']] = $row['bo_subject'];
}

$sql_common = " from {$g5['eyoom_wrfixed']} ";

$sql_search = " where (1) ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "bo_table":
            $sql_search .= " ($sfl like '$stx%') ";
            break;
        default:
            $sql_search .= " ($sfl like '%$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst  = "bf_datetime";
    $sod = "desc";
}
$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) {
    $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
}
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;
    
    $list[$i]['bo_subject'] = $bo_subject[$row['bo_table']];
    
    $wr_table = $g5['write_prefix'] . $row['bo_table'];
    $row1 = sql_fetch("select * from {$wr_table} where wr_id = '{$row['wr_id']}' ");

    if ($row1) {
        $row2 = sql_fetch("select mb_point from {$g5['member_table']} where mb_id='{$row1['mb_id']}' ");
        $list[$i]['wr_subject'] = $row1['wr_subject'];
        $list[$i]['wr_name'] = $row1['wr_name'];
        $list[$i]['wr_mb_id'] = $row1['mb_id'];
        $list[$i]['mb_point'] = $row2['mb_point'];
        $list[$i]['bf_open'] = $row['bf_open'];

        $list_num = $total_count - ($page - 1) * $rows;
        $list[$i]['num'] = $list_num - $k;
        $k++;
    }
}

$bf_cnt = count($list);

/**
 * 페이징
 */
$paging = $eb->set_paging('admin', $dir, $pid, $qstr);

/**
 * 검색버튼
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" value="검색" class="btn-e btn-e-lg btn-e-dark" accesskey="s">' ;
$frm_submit .= '</div>';