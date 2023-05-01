<?php
/**
 * core file : /eyoom/core/board/good.tail.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 추천 비추천 내글반응 적용하기*/
if ($count || $href) {
    $respond = array();
    $respond['type']        = $good;
    $respond['bo_table']    = $bo_table;
    $respond['wr_id']       = $wr_id;
    $respond['wr_subject']  = $write['wr_subject'];
    $respond['wr_mb_id']    = $write['mb_id'];

    $eb->respond($respond);
}

/**
 * 나의 활동
 */
$act_contents = array();
$act_contents['bo_table'] = $bo_table;
$act_contents['bo_name'] = $board['bo_subject'];
$act_contents['wr_id'] = $wr_id;
$eb->insert_activity($member['mb_id'], $good, $act_contents);

/**
 * 추천 비추천 포인트 지급 및 자동 이동/복사
 * 관리자가 작성한 공지글은 제외하기
 */
$arr_notice = explode(',', trim($board['bo_notice']));
$is_automove = false;
if (!in_array($wr_id, $arr_notice)) {
    switch($good) {
        case 'good' :
            $eb->level_point($levelset['good'], $write['mb_id'], $levelset['regood']);

            // 추천수 게시물 자동 이동/복사
            if ($eyoom_board['bo_use_automove'] && $bo_automove['count2'] && $bo_automove['target2'] && $bo_automove['action2'] && $bo_automove['count2'] <= $write['wr_good']+1) {
                $sw = $bo_automove['action2'];
                $tg_table = $bo_automove['target2'];
                $is_automove = true;
            }
            break;

        case 'nogood' :
            $eb->level_point($levelset['nogood'], $write['mb_id'], $levelset['renogood']);

            // 비추천수 게시물 자동 이동/복사
            if ($eyoom_board['bo_use_automove'] && $bo_automove['count3'] && $bo_automove['target3'] && $bo_automove['action3'] && $bo_automove['count3'] <= $write['wr_nogood']+1) {
                $sw = $bo_automove['action3'];
                $tg_table = $bo_automove['target3'];
                $is_automove = true;
            }
            break;
    }
}

/**
 * 자동 이동/복사 실행
 */
if (($write['mb_id'] && $write['mb_id']!=$config['cf_admin'] && $write['mb_id']!=$board['bo_admin']) || !$write['mb_id']) {
    if ($is_automove && $write['wr_10'] != $tg_table) {
        define("G5_AUTOMOVE", true);

        $chk_bo_table = array($tg_table);
        $wr_id_list = $wr_id;

        $binfo = sql_fetch("select bo_subject from {$g5['board_table']} where bo_table = '{$tg_table}'");

        switch ($sw) {
            case 'copy': $act = '복사'; break;
            case 'move': $act = '이동'; break;
        }
        @include_once(EYOOM_CORE_PATH . "/board/move_update.php");
    }
}

/**
 * 게시판 스킨파일
 */
@include_once($eyoom_skin_path['board'].'/good.tail.skin.php');

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/board/good.tail.skin.php');