<?php
/**
 * core file : /eyoom/core/board/write_update.head.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 글등록 회수 제한이 있는지 체크
 */
if ($eyoom_board['bo_write_limit'] && !$is_admin) {
    if (!$is_member) {
        alert("비회원은 본 게시판에 글을 작성하실 수 없습니다.");
    } else {
        $wr_limit = sql_fetch("select count(*) as cnt from {$write_table} where (mb_id = '{$member['mb_id']}' or wr_ip = '" . $_SERVER['REMOTE_ADDR'] . "') and wr_datetime between '" . date('Y-m-d') . " 00:00:00' and '" . date('Y-m-d') . " 23:59:59' ");
        if ($wr_limit['cnt'] >= $eyoom_board['bo_write_limit']) {
            alert("[{$board['bo_subject']}]에는 하루에 {$eyoom_board['bo_write_limit']}개의 글을 작성하실 수 있습니다.");
        }
    }
}

// 사용자 프로그램
@include_once(EYOOM_USER_PATH.'/board/write_update.head.skin.php');