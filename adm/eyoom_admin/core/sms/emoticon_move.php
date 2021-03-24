<?php
/**
 * @file    /adm/eyoom_admin/core/sms/emoticon_move.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "900600";
include_once(EYOOM_ADMIN_CORE_PATH . '/sms/_common.php');

$action_url = G5_ADMIN_URL.'/?dir=sms&amp;pid=emoticon_move_update&amp;smode=1';

if ($sw != 'move'){
    alert('sw 값이 제대로 넘어오지 않았습니다.');
}

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = '이모티콘그룹 이동';

$list = array();    //배열 변수 초기화
$fo_no_list = isset($_POST['fo_no']) ? clean_xss_tags(strip_tags(implode(',', $_POST['fo_no']))) : '';

$sql = " select * from {$g5['sms5_form_group_table']} order by fg_no ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    $list[$i] = $row;
}
$count = is_array($list) ? count($list): 0;