<?php
/**
 * 소셜 맺기 처리용 파일
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

/**
 * 소셜 기능이 설정되어 있는지 체크
 */
if ($user['onoff_social'] != 'on') {
    $token = 'no';
} else {
    switch($action) {
        /**
         * 팔로우 맺기
         */
        case 'follow':
            /**
             * 이미 팔로우했는지 체크
             */
            if (!$eb->follow_check($mb_id)) {
                /**
                 * 맞팔친구 체크
                 */
                $friends_check = sql_fetch("select count(*) as cnt from {$g5['eyoom_follow']} where fo_my_id = '{$mb_id}' and fo_mb_id = '{$member['mb_id']}' ");
                $is_friends = $friends_check['cnt'] ? 'y': 'n';

                if ($is_friends) {
                    sql_query("update {$g5['eyoom_follow']} set fo_friends = 'y' where fo_my_id = '{$mb_id}' and fo_mb_id = '{$member['mb_id']}' ");
                }

                /**
                 * 팔로우 추가
                 */
                sql_query("insert into {$g5['eyoom_follow']} set fo_my_id = '{$member['mb_id']}', fo_mb_id = '{$mb_id}', fo_friends = '{$is_friends}', fo_datetime = '".G5_TIME_YMDHIS."' ");

                /**
                 * 팔로우 경험치
                 */
                $eb->level_point($levelset['following'],$mb_id,$levelset['follower']);

                /**
                 * 푸시등록
                 */
                if ($user['onoff_push_social'] == 'on') $eb->set_push("follow", $member['mb_id'], $mb_id, $member['mb_nick']);

                /**
                 * 팔로우 정상처리
                 */
                $token = 'yes';
            } else {
                $token = 'no';
            }
            break;


        /**
         * 팔로우 끊기
         */
        case 'unfollow':
            /**
             * 이미 팔로우했는지 체크
             */
            if ($eb->follow_check($mb_id)) {
                /**
                 * 팔로우 제거
                 */
                $sql = "delete from {$g5['eyoom_follow']} where fo_my_id = '{$member['mb_id']}' and fo_mb_id = '{$mb_id}'";
                sql_query($sql, false);

                /**
                 * 맞팔친구 해제
                 */
                sql_query("update {$g5['eyoom_follow']} set fo_friends = 'n' where fo_my_id = '{$mb_id}' and fo_mb_id = '{$member['mb_id']}' ");

                /**
                 * 푸시등록
                 */
                //if ($user['onoff_push_social'] == 'on') $eb->set_push("unfollow", $member['mb_id'], $mb_id, $member['mb_nick']);

                /**
                 * 팔로우 정상처리
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
}

if ($token) {
    $_value_array = array();
    $_value_array['result'] = $token;

    include_once EYOOM_CLASS_PATH.'/json.class.php';

    $json = new Services_JSON();
    $output = $json->encode($_value_array);

    echo $output;
}
exit;