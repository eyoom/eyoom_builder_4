<?php
include_once('./_common.php');

if (!$is_member) alert('회원만 접근하실 수 있습니다.');

$g5['title'] = '나의 환경설정 저장';
if(!$eyoomer['mb_id']) alert('잘못된 접근입니다.');

$set = array();
$set_array = array(
    'mypage_main',
    'open_page',
    'onoff_social',
    'onoff_push',
    'open_email',
    'open_homepage',
    'open_tel',
    'open_hp',
    'onoff_push_respond',
    'onoff_push_memo',
    'onoff_push_social',
    'onoff_push_likes',
    'onoff_push_guest',
    'view_timeline',
    'view_favorite',
    'view_followinggul'
);

$i=0;
foreach ($set_array as $k => $field) {
    $postval = clean_xss_tags(trim($_POST[$field]));
    if($postval) $set[$i] = "$field = '".$postval."'";
    $i++;
}

/**
 * 관심게시판
 */
if (is_array($_POST['bo_favorite'])) {
    $favorite = $eb->mb_unserialize($eyoomer['favorite']);

    /**
     * 관심게시판에서 off한 게시판
     */
    foreach ($_POST['bo_favorite'] as $bo_table => $onoff) {
        if ($onoff == 'off') {
            $except[] = $bo_table;
        }
    }

    /**
     * off된 게시판은 제외
     */
    $_bo_favorite = array();
    if (is_array($favorite) && is_array($except)) {
        foreach ($favorite as $bo_table) {
            if (in_array($bo_table, $except)) continue;
            $_bo_favorite[] = $bo_table;
        }
    }

    /**
     * 제외하고 남은 관심게시판 업데이트
     */
    if (is_array($_bo_favorite)) {
        $set[$i] = "favorite = '" . serialize($_bo_favorite) . "'";
    }
}

/**
 * 적용하기
 */
$sql = "UPDATE {$g5['eyoom_member']} SET ".implode(',',$set)." WHERE mb_id = '{$eyoomer['mb_id']}'";

if(sql_query($sql,false)) {
    alert('정상적으로 설정정보를 저장하였습니다.',G5_URL.'/mypage/config.php');
} else {
    alert('처리중 오류가 발생하였습니다.');
}