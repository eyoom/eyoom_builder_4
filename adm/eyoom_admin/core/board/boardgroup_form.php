<?php
/**
 * @file    /adm/eyoom_admin/core/board/boardgroup_form.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300200";

$action_url1 = G5_ADMIN_URL . '/?dir=board&amp;pid=boardgroup_form_update&amp;smode=1';

auth_check_menu($auth, $sub_menu, 'w');

if ($is_admin != 'super' && $w == '') {
    alert('최고관리자만 접근 가능합니다.');
}

$html_title = '게시판그룹';
$gr_id_attr = '';
$sound_only = '';

if (!isset($group['gr_id'])) {
    $group['gr_id'] = '';
    $group['gr_subject'] = '';
    $group['gr_device'] = '';
}

$gr = array('gr_use_access' => 0, 'gr_admin' => '');
if ($w == '') {
    $gr_id_attr = 'required';
    $sound_only = '<strong class="sound_only"> 필수</strong>';
    $html_title .= ' 생성';
} elseif ($w == 'u') {
    $gr_id_attr = 'readonly';
    $gr = sql_fetch(" select * from {$g5['group_table']} where gr_id = '$gr_id' ");
    $html_title .= ' 수정';
} else {
    alert('제대로 된 값이 넘어오지 않았습니다.');
}

if (!isset($group['gr_device'])) {
    sql_query(" ALTER TABLE `{$g5['group_table']}` ADD `gr_device` ENUM('both','pc','mobile') NOT NULL DEFAULT 'both' AFTER `gr_subject` ", false);
}

// 접근회원수
$sql1 = " select count(*) as cnt from {$g5['group_member_table']} where gr_id = '{$gr_id}' ";
$row1 = sql_fetch($sql1);
$grmember_cnt = $row1['cnt'];

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= !$wmode ? ' <a href="' . G5_ADMIN_URL . '/?dir=board&amp;pid=boardgroup_list&amp;'.$qstr.'" class="btn-e btn-e-lg btn-e-dark">목록</a> ': '';
$frm_submit .= '</div>';