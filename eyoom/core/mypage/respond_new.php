<?php
/**
 * core file : /eyoom/core/mypage/respond_new.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원체크
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.',G5_URL);

/**
 * 읽지 않은 내글반응
 */
$sql = "select * from {$g5['eyoom_respond']} where wr_mb_id = '{$eyoomer['mb_id']}' and re_chk = 0 order by regdt desc ";
$result = sql_query($sql, false);
$respond_new = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $reinfo = $eb->respond_mention($row['re_type'],$row['mb_name'],$row['re_cnt']);

    // 당일인 경우 시간으로 표시함
    $respond_new[$i]['rid'] = $row['rid'];
    $respond_new[$i]['mb_name'] = $row['mb_name'];
    $respond_new[$i]['mention'] = $reinfo['mention'];
    $respond_new[$i]['wr_subject'] = $row['wr_subject'];
    $respond_new[$i]['chk'] = $row['re_chk'];
    $respond_new[$i]['type'] = $reinfo['type'];
    $respond_new[$i]['href'] = G5_URL.'/mypage/respond_chk.php?rid='.$row['rid'];
    $respond_new[$i]['delete'] = './respond_chk.php?rid='.$row['rid'].'&act=delete'.$get;
    $respond_new[$i]['datetime'] = $row['regdt'];
    $respond_new[$i]['mb_photo'] = $eb->mb_photo($row['mb_id'], 'icon');
}
$count = count($respond_new);
unset($i);

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/respond_new.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/respond_new.skin.html.php');