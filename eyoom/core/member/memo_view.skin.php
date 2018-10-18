<?php
/**
 * core file : /eyoom/core/member/memo_view.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * nameview 생성
 */
$nick = eb_nameview($eyoom['nameview_skin'], $mb['mb_id'], $mb['mb_nick'], $mb['mb_email'], $mb['mb_homepage']);
if ($kind == "recv") {
    $kind_str = "보낸";
    $kind_date = "받은";
} else {
    $kind_str = "받는";
    $kind_date = "보낸";
}

/**
 * 푸쉬 알람 파일 삭제
 */
$push_file = G5_DATA_PATH.'/member/push/push.'.$member['mb_id'].'.php';
if (@file_exists($push_file)) {
    @unlink($push_file);
}

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/member/memo_view.skin.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['member'].'/memo_view.skin.html.php');