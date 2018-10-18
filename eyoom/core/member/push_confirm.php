<?php
/**
 * core file : /eyoom/core/member/push_confirm.php
 */

$g5_path = '../../..';
include_once($g5_path.'/common.php');

// 회원만 접근
if (!$is_member) exit;

// 푸쉬기능을 off 한 상태
if ($eyoomer['use_push'] == 'off') exit;

$push_file = G5_DATA_PATH.'/member/push/push.'.$member['mb_id'].'.php';

// 푸쉬파일 삭제
$qfile->del_file($push_file);
exit;