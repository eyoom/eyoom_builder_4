<?php
/**
 * @file    /adm/eyoom_admin/core/board/boardgroup_list.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300200";

$action_url1 = G5_ADMIN_URL . '/?dir=board&amp;pid=boardgroup_list_update&amp;smode=1';

auth_check_menu($auth, $sub_menu, 'r');

if (!isset($group['gr_device'])) {
    // 게시판 그룹 사용 필드 추가
    // both : pc, mobile 둘다 사용
    // pc : pc 전용 사용
    // mobile : mobile 전용 사용
    // none : 사용 안함
    sql_query(" ALTER TABLE  `{$g5['group_table']}` ADD  `gr_device` ENUM(  'both',  'pc',  'mobile' ) NOT NULL DEFAULT  'both' AFTER  `gr_subject` ", false);
}

$sql_common = " from {$g5['group_table']} ";

$sql_search = " where (1) ";
if ($is_admin != 'super') {
    $sql_search .= " and (gr_admin = '{$member['mb_id']}') ";
}

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "gr_id":
        case "gr_admin":
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        default:
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if ($sst) {
    $sql_order = " order by {$sst} {$sod} ";
} else {
    $sql_order = " order by gr_id asc ";
}

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
    // 접근회원수
    $sql1 = " select count(*) as cnt from {$g5['group_member_table']} where gr_id = '{$row['gr_id']}' ";
    $row1 = sql_fetch($sql1);

    // 게시판수
    $sql2 = " select count(*) as cnt from {$g5['board_table']} where gr_id = '{$row['gr_id']}' ";
    $row2 = sql_fetch($sql2);

    $s_upd = '<a href="'.G5_ADMIN_URL.'/?dir=board&amp;pid=boardgroup_form&amp;'.$qstr.'&amp;w=u&amp;gr_id='.$row['gr_id'].'">수정</a>';

    $list[$i] = $row;
    $list[$i]['board_cnt'] = $row2['cnt'];
    $list[$i]['member_cnt'] = $row1['cnt'];
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