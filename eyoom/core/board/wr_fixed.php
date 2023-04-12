<?php
$g5_path = '../../..';
include_once($g5_path.'/common.php');

if (!$is_member) exit;

$bo_table   = isset($_POST['bo_table']) ? clean_xss_tags($_POST['bo_table']): '';
$wr_id      = isset($_POST['wr_id']) ? clean_xss_tags($_POST['wr_id']): '';

if (!$bo_table) exit;
if (!$wr_id) exit;

$error = false;

/**
 * 게시판 정보 가져오기
 */
$eyoom_board = $bbs->board_info($bo_table);

if ($is_admin != 'super') {
    /**
     * 게시물 상단고정을 사용하는지 체크
     */
    if ($eyoom_board['bo_use_wrfixed'] != '1') {
        $msg = '이 게시판은 게시물 상단고정 기능을 사용하고 있지 않습니다.';
    }
    
    /**
     *
     */
    if ($eyoom_board['bo_wrfixed_point'] > $member['mb_point']) {
        $msg = "포인트가 부족합니다.";
    }
}

/**
 * 게시물 상단고정 처리
 */
if (!$msg) {
    $msg = $bbs->bo_wrfixed($bo_table, $wr_id);

    /**
     * 포인트 차감하기
     */
    if ($is_admin != 'super' && $eyoom_board['bo_wrfixed_type'] == '2') {
        insert_point($member['mb_id'], $eyoom_board['bo_wrfixed_point']*(-1), "{$eyoom_board['bo_subject']} $wr_id 게시물 상단고정", $bo_table, $wr_id, "상단고정 - ".time());
    }
}

$_value_array = array();
$_value_array['msg'] = $msg;

include_once EYOOM_CLASS_PATH . '/json.class.php';

$json = new Services_JSON();
$output = $json->encode($_value_array);

echo $output;

exit;