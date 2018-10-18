<?php
/**
 * core file : /eyoom/core/member/push_alarm.php
 */

$g5_path = '../../..';
include_once($g5_path.'/common.php');

// 회원만 접근
if (!$is_member) exit;

// 푸쉬기능을 off 한 상태
if ($eyoomer['use_push'] == 'off') exit;

// 이윰 알람음 선택
$alarm_sound = EYOOM_MISC_PATH.'/sound/'.$eyoom['push_sound'];

if (file_exists($alarm_sound)) {
    $sound = EYOOM_MISC_URL.'/sound/'.$eyoom['push_sound'];
    echo "<embed src='{$sound}'></embed>";
}
exit;