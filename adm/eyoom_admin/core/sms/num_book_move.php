<?php
/**
 * @file    /adm/eyoom_admin/core/sms/num_book_move.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "900600";
include_once(EYOOM_ADMIN_CORE_PATH . '/sms/_common.php');

$action_url = G5_ADMIN_URL . '/?dir=sms&amp;pid=number_move_update&amp;smode=1';

$inputbox_type="checkbox";
if ($sw == 'move'){
    $act = '이동';
} else if ($sw == 'copy') {
    $act = '복사';
} else {
    alert('sw 값이 제대로 넘어오지 않았습니다.');
}

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = '번호그룹 ' . $act;

$bk_no_list = isset($_POST['bk_no']) ? implode(',', $_POST['bk_no']) : '';

$sql = " select * from {$g5['sms5_book_group_table']} order by bg_no ";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    $list[$i] = $row;
}