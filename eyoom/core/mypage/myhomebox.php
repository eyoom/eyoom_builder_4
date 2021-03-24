<?php
/**
 * core file : /eyoom/core/mypage/myhomebox.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 친구맺기 정보 가져오기
 */
if (!$page) {
    $friends = $user['friends'] ? $eb->get_user_info($user['friends']):'';
    $following = $user['following'] ? $eb->get_user_info($user['following']):'';
    $follower = $user['follower'] ? $eb->get_user_info($user['follower']):'';

    $_friends = $friends;
    $_following = $following;
    $_follower = $$follower;

    $box_friends = is_array($_friends) ? array_slice($_friends,0,12): '';
    $box_following = is_array($_following) ? array_slice($_following,0,12): '';
    $box_follower = is_array($_follower) ? array_slice($_follower,0,12): '';
}

/**
 * 맞팔친구
 */
if (!isset($box_friends['mb_id'])) {
    $box_friends = null;
}

/**
 * 팔로잉 - 내가 팔로우한 회원
 */
if (!isset($box_following['mb_id'])) {
    $box_following = null;
}

/**
 * 팔로워 - 나를 팔로우한 회원
 */
if (!isset($box_follower['mb_id'])) {
    $box_follower = null;
}

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/myhomebox.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/myhomebox.skin.html.php');