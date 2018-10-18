<?php
/**
 * core file : /eyoom/core/member/profile.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원 프로필 포토
 */
$mb_photo = $eb->mb_photo($mb_id);

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/member/profile.skin.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['member'].'/profile.skin.html.php');