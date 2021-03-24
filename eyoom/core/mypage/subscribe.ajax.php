<?php
/**
 * 구독 처리용 파일
 */

$g5_path = '../../..';
include_once($g5_path.'/common.php');

if (!$is_member) exit;

$action = isset($_POST['action']) ? trim($_POST['action']) : '';
$mb_id = isset($_POST['user']) ? trim($_POST['user']) : '';

if (!$action) exit;
if (!$mb_id) exit;

$token = '';

/**
 * 유저 정보
 */
$user = $eb->get_user_info($mb_id);

switch($action) {
    /**
     * 구독 맺기
     */
    case 'subscribe':
        /**
         * 이미 구독했는지 체크
         */
        if (!$eb->subscribe_check($mb_id)) {
            /**
             * 구독 추가
             */
            sql_query("insert into {$g5['eyoom_subscribe']} set sb_my_id = '{$member['mb_id']}', sb_mb_id = '{$mb_id}', sb_datetime = '".G5_TIME_YMDHIS."' ");

            /**
             * 푸시등록
             */
            if ($user['onoff_push_social'] == 'on') $eb->set_push("subscribe", $member['mb_id'], $mb_id, $member['mb_nick']);

            /**
             * 구독 정상처리
             */
            $token = 'yes';
        } else {
            $token = 'no';
        }
        break;


    /**
     * 구독 끊기
     */
    case 'unsubscribe':
        /**
         * 이미 구독했는지 체크
         */
        if ($eb->subscribe_check($mb_id)) {
            /**
             * 구독 제거
             */
            $sql = "delete from {$g5['eyoom_subscribe']} where sb_my_id = '{$member['mb_id']}' and sb_mb_id = '{$mb_id}'";
            sql_query($sql, false);

            /**
             * 구독 정상처리
             */
            $token = 'yes';
        } else {
            $token = 'no';
        }
        break;
}


/**
 * 나의 활동에 기록
 */
$act_contents = array();
$act_contents['mb_nick'] = $user['mb_nick'];
$act_contents['mb_id'] = $mb_id;
$eb->insert_activity($member['mb_id'], $action, $act_contents);

if ($token) {
    $_value_array = array();
    $_value_array['result'] = $token;

    include_once EYOOM_CLASS_PATH.'/json.class.php';

    $json = new Services_JSON();
    $output = $json->encode($_value_array);

    echo $output;
}
exit;