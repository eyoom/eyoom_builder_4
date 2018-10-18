<?php
/**
 * core file : /eyoom/core/member/login_check.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 로그인하면 자신의 푸시파일은 삭제합니다.
 */
$push_file = G5_DATA_PATH.'/member/push.'.$mb['mb_id'].'.php';
$qfile->del_file($push_file);

/**
 * 나의 활동에 로그인 정보등록
 */
$act_contents = array();
$act_contents['ip'] = $_SERVER['REMOTE_ADDR'];
$eb->insert_activity($mb['mb_id'],'login',$act_contents);

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/member/login_check.skin.php');