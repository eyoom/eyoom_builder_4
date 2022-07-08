<?php
/**
 * @file    /adm/eyoom_admin/core/board/boardgroupmember_list.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300200";

$action_url1 = G5_ADMIN_URL . '/?dir=board&amp;pid=boardgroupmember_update&amp;smode=1';

auth_check_menu($auth, $sub_menu, 'r');

$gr = get_group($gr_id);
if (!$gr['gr_id']) {
    alert('존재하지 않는 그룹입니다.');
}

$sql_common = " from {$g5['group_member_table']} a
                         left outer join {$g5['member_table']} b on (a.mb_id = b.mb_id) ";
$sql_search = " where gr_id = '{$gr_id}' ";

// 회원아이디로 검색되지 않던 오류를 수정
if (isset($stx) && $stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        default:
            $sql_search .= " ($sfl like '%$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst = "gm_datetime";
    $sod = "desc";
}
$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt
            {$sql_common}
            {$sql_search}
            {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) {
    $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
}
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select *
            {$sql_common}
            {$sql_search}
            {$sql_order}
            limit {$from_record}, {$rows} ";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    // 접근가능한 그룹수
    $sql2 = " select count(*) as cnt from {$g5['group_member_table']} where mb_id = '{$row['mb_id']}' ";
    $row2 = sql_fetch($sql2);
    $group = "";
    if ($row2['cnt']) {
        $group = '<a href="'.G5_ADMIN_URL.'/?dir=board&amp;pid=boardgroupmember_form&amp;mb_id='.$row['mb_id'].'">'.$row2['cnt'].'</a>';
    }
    
    $list[$i] = $row;
    $list[$i]['cnt'] = $row2['cnt'];
}

/**
 * 페이징
 */
$paging = $eb->set_paging('admin', $dir, $pid, 'gr_id='.$gr_id.'&amp;'.$qstr);

/**
 * 검색버튼
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" value="검색" class="btn-e btn-e-lg btn-e-dark" accesskey="s">' ;
$frm_submit .= '</div>';