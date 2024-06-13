<?php
/**
 * @file    /adm/eyoom_admin/core/member/mail_select_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "200300";

auth_check_menu($auth, $sub_menu, 'w');

check_demo();

check_admin_token();

require_once G5_LIB_PATH . '/mailer.lib.php';

$countgap = 10; // 몇건씩 보낼지 설정
$maxscreen = 500; // 몇건씩 화면에 보여줄건지?
$sleepsec = 200;  // 천분의 몇초간 쉴지 설정