<?php
/**
 * core file : /eyoom/core/board/view.head.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 포인트게시물 권한체크
 */
if (preg_match("/pointpost/i", $eyoom_board['bo_skin']) && $eyoom_board['bo_use_pointpost'] && $eyoom_board['bo_pointpost_point']) {
    /**
     * 포인트 설정 금액이 0이 아니라면
     */
    if ($write['wr_point'] > 0) {
        /**
         * 비회원 접근통제
         */
        if (!$is_member) {
            alert("회원로그인 후 이용해 주세요.");
        }

        /**
         * 이미 구매한 게시물인지 체크 
         */ 
        $sql = "select * from {$g5['eyoom_pointpost']} where bo_table='{$bo_table}' and wr_id='{$wr_id}' and mb_id='{$member['mb_id']}'";
        $row = sql_fetch($sql);
        if (!$row['pp_point']) {
            // 보유포인트가 설정포인트보다 작으면 권한이 없음
            if ($write['wr_point'] > $member['mb_point']) {
                alert("보유한 포인트가 부족합니다.\n\n먼저 내통장에서 포인트를 충전해주세요");
            } else if (!$is_admin && $write['mb_id'] != $member['mb_id']) {
                $referer = $_SERVER['HTTP_REFERER'];
                confirm("해당 컨텐츠를 구매하시겠습니까? ".number_format($write['wr_point'])." 포인트가 차감됩니다.", EYOOM_THEME_URL."/skin/board/".$eyoom_board['bo_skin']."/pointpost.php?bo_table={$bo_table}&wr_id={$wr_id}", $referer);
            }
        }
    }
}

/**
 * 게시판 스킨파일
 */
@include_once($eyoom_skin_path['board'].'/view.head.skin.php');

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/board/view.head.skin.php');