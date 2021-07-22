<?php
/**
 * core file : /eyoom/core/mypage/config.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원체크
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.',G5_URL);

/**
 * 설정저장 경로
 */
$action_url = G5_URL.'/mypage/config_update.php';

/**
 * 관심게시판 설정 - 게시판 정보
 */
$bo_favorite = $eyoomer['favorite'] ? $eb->mb_unserialize($eyoomer['favorite']): array();
if (!$bo_favorite) $bo_favorite = array();

$sql = "select a.bo_table, a.bo_subject, b.gr_subject from {$g5['board_table']} as a left join {$g5['group_table']} as b on a.gr_id = b.gr_id where (1) and find_in_set(a.bo_table, '".implode(',', $bo_favorite)."') order by b.gr_subject asc, a.bo_subject asc";
$favorite = (array)$eb->mb_unserialize($eyoomer['favorite']);
if (!$favorite) $favorite = array();
$res = sql_query($sql,false);
$bolist = array();
for($i=0; $row=sql_fetch_array($res);$i++) {
    $bolist[$i] = $row;
    //if (in_array($row['bo_table'],$favorite)) $bolist[$i]['check'] = true;
}
$count = count($bolist);

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/config.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/config.skin.html.php');