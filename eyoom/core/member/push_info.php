<?php
$g5_path = '../../..';
include_once($g5_path.'/common.php');

if (!$is_member) exit;

/**
 * 회원만 접근
 */
$mb_id = isset($_POST['mb_id']) ? trim($_POST['mb_id']) : '';
if (!$mb_id) exit;

/**
 * 푸쉬파일 가져오기
 */
$push_tocken = false;
$member_path = G5_DATA_PATH . '/member';
$qfile->make_directory($member_path);
$push_path = $member_path . '/push';
$qfile->make_directory($push_path);

$push_file = $push_path.'/push.'.$mb_id.'.php';
if (file_exists($push_file)) {
    include_once($push_file);
} else exit;

// 푸시적용 항목
$push_item = array(
    'respond',
    'memo',
    'follow',
    'unfollow',
    'subscribe',
    'upsubscribe',
    'likes',
    'guest',
    'levelup',
    'adopt',
);

foreach ($push_item as $val) {
    if ($push[$val]) {
        $item = $val;
        $push_tocken = true;
        break;
    }
}

// 푸시가 있다면 넘겨주기
if ($push_tocken) {
    include_once EYOOM_CLASS_PATH . '/json.class.php';

    $json = new Services_JSON();
    $output = $json->encode($push);

    // 푸쉬알람 등록
    if (!$push[$item]['alarm']) {
        $push[$item]['alarm'] = true;

        include_once EYOOM_CLASS_PATH . '/qfile.class.php';
        $qfile  = new qfile;
        $qfile->save_file('push',$push_file,$push);
    }
    echo $output;
}
exit;