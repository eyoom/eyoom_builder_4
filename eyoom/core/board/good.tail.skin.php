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
 * 추천 비추천 포인트 지급 및 추천수 이윰NEW에 업데이트
 */
switch($good) {
    case 'good' :
        $eb->level_point($levelset['good'], $write['mb_id'], $levelset['regood']);

        // 추천 기록 적용
        $sql = "update {$g5['eyoom_new']} as a set a.wr_good=(select b.wr_good from {$g5['write_prefix']}{$bo_table} as b where b.wr_id='{$wr_id}') where a.bo_table='{$bo_table}' and a.wr_id = a.wr_parent and a.wr_id='{$wr_id}'";
        sql_query($sql,false);
        break;

    case 'nogood' :
        $eb->level_point($levelset['nogood'], $write['mb_id'], $levelset['renogood']);
        break;
}

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/board/good.tail.skin.php');