<?php
/**
 * core file : /eyoom/core/mypage/myhome_posts.php
 */
if (!defined('_EYOOM_')) exit;

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

/**
 * 내가 작성한 글 가져오기
 */
$where = " find_in_set(bo_table,'".implode(',',$bo_possible)."') and wr_id = wr_parent and mb_id = '{$user['mb_id']}' ";

/**
 * 다른 사람의 홈페이지의 글에서는 익명글 제외하기
 */
if ($member['mb_id'] != $user['mb_id']) {
    $where .= " and wr_anonymous='' && wr_bo_anonymous='' ";
}

$sql = "select * from {$g5['board_new_table']} where {$where} order by bn_datetime desc limit {$from_record}, $page_rows ";
$result = sql_query($sql, false);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    /**
     * 게시글 정보
     */
    $list[$i] = $bbs->board_latest_record($row, $board_info);
    $list[$i]['href'] .= strpos($list[$i]['href'], '?') ? '&wmode=1': '?wmode=1';
}
$count = count($list);

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/myhome_posts.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/myhome_posts.skin.html.php');