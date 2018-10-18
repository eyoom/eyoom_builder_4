<?php
/**
 * core file : /eyoom/core/board/member.php
 *
 * /eyoom/common.php $exchange_file 에서 호출
 */
if (!defined('_EYOOM_')) exit;

include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

$g5['title'] = '메일인증 메일주소 변경';
/**
 * 헤더 디자인 출력
 */
include_once(G5_PATH . '/_head.php');

$mb_id = substr(clean_xss_tags($_GET['mb_id']), 0, 20);
$sql = " select mb_email, mb_datetime, mb_ip, mb_email_certify from {$g5['member_table']} where mb_id = '{$mb_id}' ";
$mb = sql_fetch($sql);
if (substr($mb['mb_email_certify'],0,1)!=0) {
    alert("이미 메일인증 하신 회원입니다.", G5_URL);
}

$ckey = trim($_GET['ckey']);
$key  = md5($mb['mb_ip'].$mb['mb_datetime']);

if (!$ckey || $ckey != $key)
    alert('올바른 방법으로 이용해 주십시오.', G5_URL);

/**
 * 테마 경로 지정
 */
if (!file_exists($eyoom_skin_path['member'].'/register_email.html.php')) die('skin error');
@include_once ($eyoom_skin_path['member'].'/register_email.html.php');

include_once(G5_PATH . '/_tail.php');