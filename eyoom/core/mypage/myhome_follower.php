<?php
/**
 * core file : /eyoom/core/mypage/myhome_follower.php
 */
if (!defined('_EYOOM_')) exit;

$page = (int)$_GET['page'];
if (!$page) $page = 1;
if (!$page_rows) $page_rows = 10;
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

/**
 * 셀렉트 필드
 */
$fields = 'b.mb_id, b.mb_name, b.mb_nick, b.mb_email, b.mb_homepage, b.mb_datetime, b.mb_point, b.mb_level, b.mb_signature, b.mb_profile, c.level';

$sql = "select {$fields} from {$g5['eyoom_follow']} as a left join {$g5['member_table']} as b on a.fo_my_id = b.mb_id left join {$g5['eyoom_member']} as c on b.mb_id = c.mb_id where a.fo_mb_id = '{$user['mb_id']}' limit {$from_record}, $page_rows ";

$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;
    $list[$i]['mb_photo'] = $eb->mb_photo($row['mb_id']);
    $list[$i]['cnt_following'] = $eb->count_following($row['mb_id']);
    $list[$i]['cnt_follower'] = $eb->count_follower($row['mb_id']);
}
$count = count($list);

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/myhome_follower.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/myhome_follower.skin.html.php');