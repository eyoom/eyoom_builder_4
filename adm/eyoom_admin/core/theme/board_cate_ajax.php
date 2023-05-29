<?php
/**
 * @file    /adm/eyoom_admin/core/board/menu_ajax.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = '999620';

auth_check_menu($auth, $sub_menu, 'r');

if(!$board) exit;

$_value_array['cate'] = $board['bo_category_list'];

include_once EYOOM_CLASS_PATH.'/json.class.php';

$json = new Services_JSON();
$output = $json->encode($_value_array);

echo $output;