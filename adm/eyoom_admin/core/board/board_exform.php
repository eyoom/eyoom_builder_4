<?php
/**
 * @file    /adm/eyoom_admin/core/board/board_exform.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300100";

auth_check_menu($auth, $sub_menu, 'w');

if ($is_admin != 'super') alert('최고관리자만 접근 가능합니다.');

if (!$board) alert("잘못된 접근입니다.");

if ($eyoom_board['use_gnu_skin'] == 'y') {
    alert("게시판 확장필드 기능은 그누보드스킨에서는 사용하실 수 없습니다.");
}

$action_url1 = G5_ADMIN_URL . '/?dir=board&amp;pid=board_exform_update&amp;smode=1';

if ($w == '') {
    $exinfo = array();
    $num = $board['bo_ex_cnt'] + 1;
    $exinfo['ex_fname'] = EYOOM_EXBOARD_PREFIX . $num;
} else if ($w == 'u') {
    $ex_no = clean_xss_tags(trim($_GET['ex_no']));
    if (!$ex_no) alert("잘못된 접근입니다.");

    $exinfo = sql_fetch("select * from {$g5['eyoom_exboard']} where (1) and ex_no = '{$ex_no}' and bo_table = '{$board['bo_table']}' ");
}

/**
 * 버튼셋
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확장필드 적용하기" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= ' </div>';