<?php
/**
 * core file : /eyoom/core/board/bbspoll.php
 */
if (!defined('_EYOOM_')) exit;

$poll_action_url = EYOOM_CORE_URL . '/board/bbspoll_update.php';

$poll_max   = 1;
$poll_total = 0;
if ($view['wr_poll_result'] != '') {
    $poll_tmp = explode(",", $view['wr_poll_result']);
    for ($i=0; $i<count($poll_tmp); $i++) {
        $poll_total += (int)$poll_tmp[$i];
        if ((int)$poll_tmp[$i] > $max) {
            $poll_max = (int)$poll_max[$i];
        }
    }
}

/**
 * 투표 참여여부 확인
 */
$sql = " select * from {$g5['eyoom_bbspoll']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' and mb_id = '{$member['mb_id']}' ";
$mypoll = sql_fetch($sql);

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/board/bbspoll.skin.php');

/**
 * HTML 출력
 */
@include_once($eyoom_skin_path['bbspoll'].'/bbspoll.skin.html.php');