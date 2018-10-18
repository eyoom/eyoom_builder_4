<?php
/**
 * core file : /eyoom/core/mypage/pinboard.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원체크
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.',G5_URL);

/**
 * 목록보기 권한 체크
 */
$bo_info = $bbs->list_possible_board($member['mb_level']);
$bo_possible = $bo_info['bo_possible'];
$board_info = $bo_info['board_info'];

$page = (int)$_GET['page'];
if (!$page) $page = 1;
if (!$page_rows) $page_rows = 20;
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

$sql = "select * from {$g5['eyoom_pin']} where (1) and mb_id='{$member['mb_id']}' and find_in_set(bo_table,'".implode(',',$bo_possible)."') order by pn_datetime desc limit $from_record, $page_rows";
$result = sql_query($sql, false);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    /**
     * 게시글 정보
     */
    $list[$i] = $bbs->board_latest_record($row, $board_info, 'pn_datetime');
}

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/pinboard.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/pinboard.skin.html.php');