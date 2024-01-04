<?php
/**
 * core file : /eyoom/core/mypage/mypage.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 게시판 썸네일 라이브러리
 */
@include_once(G5_LIB_PATH.'/thumbnail.lib.php');

/**
 * 회원체크
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.',G5_URL);

/**
 * iOS라면 href에서 wmode 를 off
 */
if ($eb->user_agent() != 'ios') $query_wmode = "&amp;wmode=1";

/**
 * 마이페이지 메인 - 설정한 것으로 출력
 */
$tg = clean_xss_tags(trim($_GET['t']));
$permit_tg = array('timeline', 'favorite', 'followinggul', 'subscribe', 'pinboard', 'goodpost', 'starpost');
if (isset($_GET['t']) && !in_array($tg, $permit_tg)) {
    alert("잘못된 접근입니다.");
}

if (!$eyoomer['mypage_main']) $eyoomer['mypage_main'] = 'respond_new';
$mymain = $tg ? $tg : $eyoomer['mypage_main'];

/**
 * 팔로윙 회원수
 */
$eyoomer['cnt_following'] = $eb->count_following($eyoomer['mb_id']);

/**
 * 팔로워 회원수
 */
$eyoomer['cnt_follower'] = $eb->count_follower($eyoomer['mb_id']);

/**
 * 맞팔친구 회원수
 */
$eyoomer['cnt_friends'] = $eb->count_friends($eyoomer['mb_id']);

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/mypage.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/mypage.skin.html.php');