<?php
/**
 * file : /eyoom/inc/db_table.optimize.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 최고관리자일 때만 실행
 */
if($config['cf_admin'] != $member['mb_id'] || $is_admin != 'super') return;

/**
 * 실행일 비교
 */
if(isset($config['cf_optimize_date']) && $config['cf_optimize_date'] >= G5_TIME_YMD) return;

/**
 * 내글반응 삭제
 */
if($config['cf_new_del'] > 0) {
    $sql = " delete from {$g5['eyoom_respond']} where (TO_DAYS('".G5_TIME_YMDHIS."') - TO_DAYS(regdt)) > '{$config['cf_new_del']}' ";
    sql_query($sql);
    sql_query(" OPTIMIZE TABLE `{$g5['eyoom_respond']}` ");
}

/**
 * 활동기록 삭제
 */
if($config['cf_new_del'] > 0) {
    $sql = " delete from {$g5['eyoom_activity']} where (TO_DAYS('".G5_TIME_YMDHIS."') - TO_DAYS(act_regdt)) > '{$config['cf_new_del']}' ";
    sql_query($sql);
    sql_query(" OPTIMIZE TABLE `{$g5['eyoom_activity']}` ");
}

// 설정일이 지난 인기게시물 삭제
if($config['cf_new_del'] > 0) {
    $sql = " delete from {$g5['eyoom_best']} where (TO_DAYS('".G5_TIME_YMDHIS."') - TO_DAYS(bb_datetime)) > '{$config['cf_new_del']}' ";
    sql_query($sql);
    sql_query(" OPTIMIZE TABLE `{$g5['eyoom_best']}` ");
}

/**
 * 이윰멤버 테이블 자동정리
 */
$sql = " delete from {$g5['eyoom_member']} where mb_id='' ";
sql_query($sql);
sql_query(" OPTIMIZE TABLE `{$g5['eyoom_member']}` ");

/**
 * 누적된 푸시파일 정리
 */
$push_file_path = G5_DATA_PATH . '/member/push';
$qfile->del_timeover_file($push_file_path, 86400, 'push');