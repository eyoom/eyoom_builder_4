<?php
/**
 * @file    /adm/eyoom_admin/core/board/bbs_group_board.ajax.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = '300120';

auth_check_menu($auth, $sub_menu, 'r');

$gr_sql = '';
if ($gr_id) {
    $gr_sql = " and gr_id = '" . sql_real_escape_string($gr_id) . "' ";
}

$sql = " select bo_table, bo_subject from {$g5['board_table']} where (1) $gr_sql order by bo_table asc ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $bo_tables[$i] = $row['bo_table'];
    $bo_subject[$i] = $row['bo_subject'];
}

if ($i>0) {
    $_bo_tables = implode('|', $bo_tables);
    $_bo_subject = implode('|', $bo_subject);
}


$_value_array['bo_table'] = $_bo_tables;
$_value_array['bo_subject'] = $_bo_subject;

include_once EYOOM_CLASS_PATH.'/json.class.php';

$json = new Services_JSON();
$output = $json->encode($_value_array);

echo $output;