<?php
$g5_path = '../../..';
include_once($g5_path.'/common.php');

if (!$is_member) exit;

$action     = isset($_POST['action']) ? clean_xss_tags($_POST['action']): '';
$bo_table   = isset($_POST['bo_table']) ? clean_xss_tags($_POST['bo_table']): '';
$wr_id      = isset($_POST['wr_id']) ? clean_xss_tags($_POST['wr_id']): '';

if (!$action) exit;
if (!$bo_table) exit;
if (!$wr_id) exit;

$error = false;

/**
 * 핀정보
 */
$pin = $bbs->my_pininfo($member['mb_id'], $bo_table, $wr_id);

/**
 * 핀 저장 및 취소
 */
switch($action) {
    case 'save':
        if ($pin) $error = true; // 이미 핀으로 저장되어 있다면 에러
        else {
            $sql = "insert into {$g5['eyoom_pin']} set mb_id = '{$member['mb_id']}', bo_table = '{$bo_table}', wr_id = '{$wr_id}', pn_datetime = '" . G5_TIME_YMDHIS . "' ";
            sql_query($sql, false);
            $token = true;
        }
        break;

    case 'cancel':
        if (!$pin) $error = true; // 저장된 핀이 없다면 에러
        else {
            $sql = "delete from {$g5['eyoom_pin']} where mb_id = '{$member['mb_id']}' and bo_table = '{$bo_table}' and wr_id = '{$wr_id}' ";
            sql_query($sql, false);
            $token = true;
        }
        break;
}

$_value_array = array();
$_value_array['error'] = $error;

include_once EYOOM_CLASS_PATH . '/json.class.php';

$json = new Services_JSON();
$output = $json->encode($_value_array);

echo $output;

exit;