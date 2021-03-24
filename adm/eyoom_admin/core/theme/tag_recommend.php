<?php
/**
 * @file    /adm/eyoom_admin/core/theme/tag_recommend.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999700";

auth_check_menu($auth, $sub_menu, 'w');

$tg_id          = isset($_POST['id']) ? clean_xss_tags(trim($_POST['id'])): '';
$tg_recommend   = isset($_POST['yn']) ? clean_xss_tags(trim($_POST['yn'])): '';
if(!$tg_id) exit;

$tg_recommdt = $tg_recommend == 'y' ? G5_TIME_YMDHIS : '0000-00-00 00:00:00';

$sql = "update {$g5['eyoom_tag']} set tg_recommdt = '{$tg_recommdt}' where tg_id = '{$tg_id}'";
sql_query($sql);

$_value_array = array();
$_value_array['recommdt'] = $tg_recommdt;

include_once EYOOM_CLASS_PATH.'/json.class.php';

$json = new Services_JSON();
$output = $json->encode($_value_array);

echo $output;