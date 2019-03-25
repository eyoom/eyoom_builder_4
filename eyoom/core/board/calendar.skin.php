<?php
/**
 * core file : /eyoom/core/board/calendar.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/board/calendar.skin.php');

/**
 * Schedule AJAX 경로
 */
$schedule_ajax_url = EYOOM_THEME_URL.'/skin/board/'.$eyoom_board['bo_skin'].'/schedule.ajax.php';

/**
 *  권한 체크 
 */
$auth_check_url = EYOOM_THEME_URL.'/skin/board/'.$eyoom_board['bo_skin'].'/auth.check.php';

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['board'].'/calendar.skin.html.php');