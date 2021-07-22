<?php
/**
 * core file : /eyoom/core/mypage/activity.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원체크
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.',G5_URL);

/**
 * 활동기록 정보
 */
$page = (int)$_GET['page'];
if (!$page) $page = 1;
if (!$page_rows) $page_rows = 20;
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

$sql = "select * from {$g5['eyoom_activity']} where mb_id = '{$eyoomer['mb_id']}' order by act_regdt desc limit $from_record, $page_rows";
$res = sql_query($sql, false);
$list = array();
for ($i=0;$row=sql_fetch_array($res);$i++) {
    $act_contents = $eb->mb_unserialize($row['act_contents']);
    $list[$i] = $act_contents;
    $list[$i]['type'] = $row['act_type'];
    $list[$i]['datetime'] = $row['act_regdt'];
}
$count = count($list);

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/activity.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/activity.skin.html.php');