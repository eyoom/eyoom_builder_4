<?php
/**
 * 마이홈 좋아요 처리용 파일
 */

$g5_path = '../../..';
include_once($g5_path.'/common.php');

if (!$is_member) exit;

$mb_id = isset($_POST['user']) ? trim($_POST['user']) : '';
if (!$mb_id) exit;

$user = $eb->get_user_info($mb_id);

$sql = "select * from {$g5['eyoom_like']} where lk_my_id = '{$member['mb_id']}' and lk_mb_id = '{$mb_id}' ";
$info = sql_fetch($sql, false);

if (!$info['lk_my_id']) {
    /**
     * 좋아요 추가
     */
    sql_query("insert into {$g5['eyoom_like']} set lk_my_id = '{$member['mb_id']}', lk_mb_id = '{$mb_id}', lk_datetime = '" . G5_TIME_YMDHIS . "' ");

    /**
     * 총 라이크수에 좋아요수 업데이트
     */
    $likes = sql_fetch("select count(*) as cnt from {$g5['eyoom_like']} where lk_mb_id = '{$mb_id}' ", false);
    sql_query("update {$g5['eyoom_member']} set likes = '{$likes['cnt']}' where mb_id = '{$mb_id}'", false);

    /**
     * 푸시등록
     */
    if ($user['onoff_push_likes'] == 'on') $eb->set_push('likes',$member['mb_id'],$mb_id,$member['mb_nick']);

    $token = 'yes';
} else {
    $token = 'no';
}

if ($token) {
    $_value_array = array();
    $_value_array['result'] = $token;

    include_once EYOOM_CLASS_PATH . '/json.class.php';

    $json = new Services_JSON();
    $output = $json->encode($_value_array);

    echo $output;
}
exit;