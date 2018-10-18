<?php
/**
 * core file : /eyoom/core/mypage/myfollowing.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원체크
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.',G5_URL);

/**
 * 마이박스
 */
@include_once(EYOOM_CORE_PATH.'/mypage/mybox.php');

$page = (int)$_GET['page'];
if (!$page) $page = 1;
if (!$page_rows) $page_rows = 20;
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

/**
 * 팔로워
 */
if ($eyoomer['cnt_follower'] > 0) {
    $following = array_slice($eb->get_user_info($eyoomer['following']),$from_record,$page_rows);
}

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/myfollowing.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/myfollowing.skin.html.php');