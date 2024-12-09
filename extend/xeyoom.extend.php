<?php
if (!defined('_GNUBOARD_')) exit;
/**
 * 이윰빌더와 그누보드를 연결하는 핵심 파일
 * file : /extend/xEyoom.extend.php
 */

/**
 * @package     Eyoom Builder Season4
 * @author      Gyusoon Kim <kgsoon@eyoom.net>
 * @author      Jingeun Yang <eyoom@eyoom.net>
 * @author      Taeeun Hwang <hte@eyoom.net>
 * @copyright   eyoom
 * @version     Season 4
 * @license     http://eyoom.net/page/?pid=license
 * @link        http://eyoom.net
 */

/**
 * 이윰빌더를 사용할 것인지 설정
 * false 로 설정하면 그누보드5 순정이 됩니다.
 */
$use_eyoom_builder = true; //false

/**
 * 소셜로그인일 경우 리턴
 */
if (preg_match("/(oauth|social)/i", $_SERVER['SCRIPT_NAME']) && !preg_match("/register_member/i", $_SERVER['SCRIPT_NAME'])) $use_eyoom_builder = false;

/**
 * 이윰빌더를 사용하지 않기
 */
if ($use_eyoom_builder === false) return;

/**
 * 보안서버 체크 후, 보안서버 도메인이 설정되어 있다면 강제 리다이렉션
 */
if (defined('G5_HTTPS_DOMAIN') && G5_HTTPS_DOMAIN && !isset($_SERVER['HTTPS'])) {
    header('location:'. G5_HTTPS_DOMAIN);
    exit;
}

/**
 * Model & Controller 경로 정의
 */
define('EYOOM_DIR', 'eyoom');
define('EYOOM_PATH', G5_PATH . '/' . EYOOM_DIR);
define('EYOOM_URL', G5_URL . '/' . EYOOM_DIR);

/**
 * Eyoom common.php 파일 호출
 */
include_once(EYOOM_PATH . '/common.php');