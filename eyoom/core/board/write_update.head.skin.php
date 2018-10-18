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

/**
 * 한줄게시판 - 비회원 글수정일 경우 비밀번호 확인
 */
if (isset($_POST['bbs_no_view']) && $_POST['bbs_no_view'] == '1' && $w == 'u') {
    if (!$is_admin) {
        $write = sql_fetch("select mb_id, wr_password from {$write_table} where wr_id = '{$wr_id}' ");
        if (!$write['mb_id']) {
            if (!check_password($_POST['wr_password'], $write['wr_password'])) {
                alert('비밀번호가 틀립니다.');
            }
        }
    }
}

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/board/write_update.head.skin.php');