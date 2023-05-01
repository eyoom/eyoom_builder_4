<?php
define('_EYOOM_MYPAGE_',true);

$g5['title'] = '회원메모';
$mpid = 'mbmemo';

include_once('./_common.php');

if (!$config['cf_use_mbmemo']) alert('회원메모 기능이 비활성화된 상태입니다.');
if (!$is_member) alert('회원만 접근하실 수 있습니다.');

include_once('../_head.php');
include_once($mypage_skin_path.'/mbmemo.php');
include_once('../_tail.php');