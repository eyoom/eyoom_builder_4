<?php
/**
 * core file : /eyoom/core/member/password.skin.php
 */
if (!defined('_EYOOM_')) exit;

$delete_str = "";
if ($w == 'x') $delete_str = "댓";
if ($w == 'u') $g5['title'] = $delete_str."글 수정";
else if ($w == 'd' || $w == 'x') $g5['title'] = $delete_str."글 삭제";
else $g5['title'] = $g5['title'];

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/member/password.skin.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['member'].'/password.skin.html.php');