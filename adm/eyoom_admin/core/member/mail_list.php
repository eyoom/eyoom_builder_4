<?php
/**
 * @file    /adm/eyoom_admin/core/member/mail_list.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = '200300';

$action_url1 = G5_ADMIN_URL . '/?dir=member&amp;pid=mail_delete&amp;smode=1';

auth_check_menu($auth, $sub_menu, 'r');

$sql_common = " from {$g5['mail_table']} ";

// 테이블의 전체 레코드수만 얻음
$sql = " select COUNT(*) as cnt {$sql_common} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$page = 1;

$sql = " select * {$sql_common} order by ma_id desc ";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $num = number_format($total_count - ($page - 1) * $config['cf_page_rows'] - $i);

    $list[$i] = $row;
    $list[$i]['num'] = $num;
}

/**
 * 페이징
 */
$paging = $eb->set_paging('admin', $dir, $pid, $qstr);