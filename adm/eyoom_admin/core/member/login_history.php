<?php
/**
 * @file    /adm/eyoom_admin/core/member/login_history.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "200400";

$sql_common = " from {$g5['eyoom_activity']} as a left join {$g5['member_table']} as b on a.mb_id = b.mb_id ";

$sql_search = " where (1) and a.act_type='login' ";
if ($stx && $sfl) {
    $sql_search .= " and ({$sfl} like '%{$stx}%') ";
}

// 기간검색이 있다면
$fr_date = isset($_REQUEST['fr_date']) ? $_REQUEST['fr_date'] : '';
$to_date = isset($_REQUEST['to_date']) ? $_REQUEST['to_date'] : '';
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $fr_date) ) $fr_date = '';
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $to_date) ) $to_date = '';

if ($fr_date && $to_date) {
    $sql_search .= " and act_regdt between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
    $qstr .= "&amp;fr_date={$fr_date}&amp;to_date={$to_date}";
}

if (!$sst) {
    $sst = "a.act_regdt";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) {
    $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
}
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select *, a.mb_id as mb_id {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    unset($act_tmp);

    $list[$i] = $row;
    $list[$i]['photo_url'] = mb_photo_url($row['mb_id']);

    $act_tmp = $eb->mb_unserialize($row['act_contents']);
    if ($act_tmp['ip']) {
        $list[$i]['act_ip'] = $act_tmp['ip'];
    }

    $list_num = $total_count - ($page - 1) * $rows;
    $list[$i]['num'] = $list_num - $k;
    $k++;
}

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
