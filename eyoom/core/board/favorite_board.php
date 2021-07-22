<?php
$g5_path = '../../..';
include_once($g5_path.'/common.php');

if (!$is_member) exit;

$bo_table = isset($_POST['bo_table']) ? clean_xss_tags($_POST['bo_table']): '';
$favorite = isset($_POST['favorite']) ? clean_xss_tags($_POST['favorite']): 'n';

$bo_favorite = $eyoomer['favorite'] ? $eb->mb_unserialize($eyoomer['favorite']): array();
if (!$bo_favorite) $bo_favorite = array();

switch ($favorite) {
    case 'n':
        $bo_favorite[] = $bo_table;
        $bo_favorite = serialize($bo_favorite);
        break;
    case 'y':
        foreach ($bo_favorite as $_bo_table) {
            if ($bo_table == $_bo_table) continue;
            $_bo_favorite[] = $_bo_table;
        }
        $bo_favorite = serialize($_bo_favorite);
        break;
}

$sql = "update {$g5['eyoom_member']} set favorite = '{$bo_favorite}' where mb_id = '{$member['mb_id']}' ";
sql_query($sql);