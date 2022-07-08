<?php
/**
 * core file : /eyoom/core/mypage/favorite.php
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
 * 관심게시판
 */
$favorite = $eb->mb_unserialize($eyoomer['favorite']);
$board_info = $eb->get_bo_subject();

/**
 * 목록보기 권한이 있는 게시물만 리스트에 보이도록 처리
 */
if (is_array($favorite)) {
    $i=0;
    foreach ($favorite as $_bo_table) {
        if ($bo_info[$_bo_table]['bo_list_level'] > $member['mb_level']) {
            continue;
        } else {
            $bo_tables[$i] = $_bo_table;
            $bo_possible[$_bo_table] = $board_info[$_bo_table];
            $i++;
        }
    }
}

$where = '1';
switch($eyoomer['view_favorite']) {
    case '2': $where .= " and wr_id = wr_parent "; break;
    case '3': $where .= " and wr_id <> wr_parent "; break;
}

$page = (int)$_GET['page'];
if (!$page) $page = 1;
if (!$page_rows) $page_rows = 20;
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

/**
 * 설정된 관심게시판이 있다면 가져오기
 */
$list = array();
if (is_array($bo_tables)) {
    /**
     * 게시판 검색
     */
    if ($bo_table) {
        $where .= " and bo_table = '{$bo_table}' ";
        $qstr .= "&amp;bo_table={$bo_table}";
    } else {
        $where .= " and find_in_set(bo_table,'".implode(',',$bo_tables)."')";
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
@include_once(EYOOM_USER_PATH.'/mypage/favorite.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/favorite.skin.html.php');