<?php
/**
 * @file    /adm/eyoom_admin/core/board/bbs_list.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300120";

$action_url1 = G5_ADMIN_URL . '/?dir=board&amp;pid=bbs_list_update&amp;smode=1';

/**
 * 그룹정보
 */
$row = sql_fetch("select * from {$g5['group_table']} where gr_id = '{$gr_id}' ");
$gr_subject = $row['gr_subject'];

/**
 * 기본 쿼리
 */
$sql_common = " from {$write_table} ";
$sql_search = " where (1) "; 

/**
 * 검색 대상
 */
if ($sca || $stx) {
    $sql_search .= " and " . get_sql_search($sca, $sfl, $stx, $sop);
}

/**
 * 게시물 대상
 */
if (isset($_REQUEST['view']))  { // search order (검색 오름, 내림차순)
    $view = preg_match("/^(w|c)$/i", $sod) ? $sod : '';
    if ($view)
        $qstr .= '&amp;view=' . urlencode($view);
} else {
    $view = '';
}

/**
 * 출력 순서
 */
if (!$sst) {
    $sst  = "wr_num, wr_reply";
    $sod = "asc";
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
$k=0;
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = get_list($row, $board, $g5['admin_path'], $board['bo_subject_len']);
    $list[$i]['bo_table']	= $bo_table;

    $list_num = $total_count - ($page - 1) * $rows;
    $list[$i]['num'] = $list_num - $k;
    $k++;
}

$width="100%";
$colspan = 11;
$list_count = count($list);

$qstr .= $gr_id ? "&amp;gr_id={$gr_id}": '';
$qstr .= "&amp;bo_table={$bo_table}";

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