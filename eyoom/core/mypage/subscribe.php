<?php
/**
 * core file : /eyoom/core/mypage/subscribe.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원체크
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.',G5_URL);

/**
 * 익명 게시판
 */
$anonymous_table = $bbs->anonymous_table();

/**
 * 목록보기 권한 체크
 */
$bo_info = $bbs->list_possible_board($member['mb_level']);
$bo_possible = $bo_info['bo_possible'];
$board_info = $bo_info['board_info'];

/**
 * 구독 회원
 */
$my_subscribe = $eb->subscribe_member();
if (is_array($my_subscribe)) {
    foreach ($my_subscribe as $k => $sb_info) {
        $sb_member[$k] = $sb_info['mb_id'];
    }
}

$where = '1';
$where .= " and wr_id = wr_parent ";

$page = (int)$_GET['page'];
if (!$page) $page = 1;
if (!$page_rows) $page_rows = 20;
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

$list = array();
if (is_array($sb_member)) {
    /**
     * 게시판 검색
     */
    if ($bo_table) {
        $where .= " and bo_table = '{$bo_table}' ";
        $qstr .= "&amp;bo_table={$bo_table}";
    } else {
        $where .= " and find_in_set(bo_table,'".implode(',',$bo_possible)."') ";
    }

    /**
     * 구독 회원 검색
     */
    $mbid = clean_xss_tags(trim($_GET['mbid']));
    if ($mbid) {
        $where .= " and mb_id = '{$mbid}' ";
        $qstr .= "&amp;mbid={$mbid}";
    } else {
        $where .= " and find_in_set(mb_id,'".implode(',',$sb_member)."') ";
    }

    /**
     * 익명글 제외하기
     */
    if ($member['mb_id'] != $mbid) {
        $where .= " and wr_anonymous='' ";
        $where .= " and find_in_set(bo_table, '".implode(',', $anonymous_table)."')=0 ";
    }

    $sql = "select * from {$g5['board_new_table']} where $where order by bn_datetime desc limit $from_record, $page_rows";

    $result = sql_query($sql, false);
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        /**
         * 게시글 정보
         */
        $list[$i] = $bbs->board_latest_record($row, $board_info);
    }
}
$count = count($list);

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/subscribe.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/subscribe.skin.html.php');