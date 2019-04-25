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

auth_check($auth[$sub_menu], "r");

$g5['title'] = '번호그룹 ' . $act;

for ($i=0; $i<count($_POST['bk_no']);$i++) {
    // 실제 번호를 넘김
    $k = $_POST['chk'][$i];
    if (!$k) continue;
    $post_bk_no[$i] = $_POST['bk_no'][$k];
}
$bk_no_list = is_array($post_bk_no) ? implode(',', $post_bk_no): '';

$sql = " select * from {$g5['sms5_book_group_table']} order by bg_no ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    $list[$i] = $row;
}

