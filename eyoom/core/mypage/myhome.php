<?php
/**
 * core file : /eyoom/core/mypage/myhome.php
 */
if (!defined('_EYOOM_')) exit;

define('_MYHOME_',true);

/**
 * iOS라면 href에서 wmode 를 off
 */
if ($eb->user_agent() != 'ios') $query_wmode = "&amp;wmode=1";

// eyoom.class.php > print_page() 함수에서 $user 정보가 넘어옴

/**
 * 팔로윙 정보
 */
$my_following = $eb->following_member($user['mb_id'], 12);

/**
 * 팔로윙 정보
 */
$my_follower = $eb->follower_member($user['mb_id'], 12);

/**
 * 맞팔친구
 */
$my_friends = $eb->friends_member($user['mb_id'], 12);

/**
 * 나를 구독한 회원
 */
$my_subscriber = $eb->subscriber_member($user['mb_id'], 12);

/**
 * 회원 이미지
 */
$user['mb_photo'] = $eb->mb_photo($user['mb_id']);

/**
 * 배경이미지
 */
$user['wallpaper'] = $eb->myhome_cover($user['mb_id'], $user['myhome_cover']);

/**
 * 팔로윙 회원수
 */
$user['cnt_following'] = $eb->count_following($user['mb_id']);

/**
 * 팔로워 회원수
 */
$user['cnt_follower'] = $eb->count_follower($user['mb_id']);

/**
 * 맞팔친구 회원수
 */
$user['cnt_friends'] = $eb->count_friends($user['mb_id']);

/**
 * 나를 구독한 회원수
 */
$user['cnt_subscriber'] = $eb->count_subscriber($user['mb_id']);

/**
 * 해당 user가 나의 팔로우인지 체크
 */
$user['follow_token'] = $eb->follow_check($user['mb_id']);

/**
 * 마이홈 좋아요 회원수
 */
$user['cnt_likes'] = $user['likes'] ? $user['likes']: 0;

/**
 * 방문카운트
 */
$ss_name = 'ss_myhome_'.$user['mb_id'].'_'.$member['mb_id'];
if (!get_session($ss_name) && $is_member) {
    sql_query(" update {$g5['eyoom_member']} set myhome_hit = myhome_hit + 1 where mb_id = '{$user['mb_id']}' ");
    set_session($ss_name, TRUE);
}

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/myhome.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/myhome.skin.html.php');