<?php
/**
 * @file    /adm/eyoom_admin/core/board/boardgroupmember_form.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300200";

auth_check($auth[$sub_menu], 'w');

$action_url1 = G5_ADMIN_URL . '/?dir=board&amp;pid=boardgroupmember_update&amp;smode=1';

$mb = get_member($mb_id);
if (!$mb['mb_id'])
    alert('존재하지 않는 회원입니다.');

/**
 * 전체 그룹
 */
$sql = " select * from {$g5['group_table']} where gr_use_access = 1 ";
if ($is_admin != 'super') $sql .= " and gr_admin = '{$member['mb_id']}' ";
$sql .= " order by gr_id ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $grlist[$i] = $row;
}

/**
 * 해당 멤버 지정 그룹
 */
$sql = " select * from {$g5['group_member_table']} a, {$g5['group_table']} b
where a.mb_id = '{$mb['mb_id']}'
and a.gr_id = b.gr_id ";
if ($is_admin != 'super')
$sql .= " and b.gr_admin = '{$member['mb_id']}' ";
$sql .= " order by a.gr_id desc ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;
}