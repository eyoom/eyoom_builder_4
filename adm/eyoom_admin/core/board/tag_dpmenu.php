<?php
/**
 * @file    /adm/eyoom_admin/core/board/tag_dpmenu.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300710";

auth_check_menu($auth, $sub_menu, 'w');

$tg_id      = isset($_POST['id']) ? clean_xss_tags(trim($_POST['id'])): '';
$tg_dpmenu  = isset($_POST['yn']) ? clean_xss_tags(trim($_POST['yn'])): 'n';
if(!$tg_id) exit;

switch($tg_dpmenu) {
    case 'y': $dpmenu = 'n'; break;
    case 'n': $dpmenu = 'y'; break;
}

$sql = "update {$g5['eyoom_tag']} set tg_dpmenu = '{$tg_dpmenu}' where tg_id = '{$tg_id}'";
sql_query($sql);

$_value_array = array();
$_value_array['dpmenu'] = $dpmenu;

include_once EYOOM_CLASS_PATH.'/json.class.php';

$json = new Services_JSON();
$output = $json->encode($_value_array);

echo $output;