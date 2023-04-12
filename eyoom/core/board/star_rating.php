<?php
$g5_path = '../../..';
include_once($g5_path.'/common.php');

if (!$is_member) exit;

$score      = isset($_POST['score']) ? clean_xss_tags($_POST['score']): '';
$bo_table   = isset($_POST['bo_table']) ? clean_xss_tags($_POST['bo_table']): '';
$wr_id      = isset($_POST['wr_id']) ? clean_xss_tags($_POST['wr_id']): '';

if (!$score) exit;
if (!$bo_table) exit;
if (!$wr_id) exit;

/**
 * 게시판 정보 가져오기
 */
$eyoom_board = $bbs->board_info($bo_table);

/**
 * 별점 기능을 사용하는지 체크
 */
if ($eyoom_board['bo_use_rating'] == '1') {
    $write_table = $g5['write_prefix'] . $bo_table;
    $wrid = " wr_id = '{$wr_id}' ";

    /**
     * eb_7 여분필드 활용
     */
    $data = sql_fetch("select eb_7 from {$write_table} where {$wrid} ");
    $eb_7 = $eb->mb_unserialize($data['eb_7']);
    if (!$eb_7) $eb_7 = array();

    /**
     * 이미 참가했는지 체크
     */
    $info = sql_fetch("select mb_id from {$g5['eyoom_rating']} where mb_id = '{$member['mb_id']}' and bo_table = '{$bo_table}' and {$wrid} ");

    /**
     * 참여하지 않았다면 적용하기
     */
    if (!$info['mb_id']) {

        /**
         * 별점 정보 추가
         */
        sql_query("insert into {$g5['eyoom_rating']} set bo_table = '{$bo_table}', {$wrid}, mb_id = '{$member['mb_id']}', rating = '".$score."',  rt_datetime = '". G5_TIME_YMDHIS ."' ");

        /**
         * 합산 정보
         */
        $star = $bbs->get_star_summary($bo_table, $wr_id);
        $eb_7['rating_score'] = $star['score'];
        $eb_7['rating_members'] = $star['cnt'];
        $eb_7 = serialize($eb_7);

        /**
         * 원본 게시물에 업데이트
         */
        sql_query("update {$write_table} set eb_7 = '{$eb_7}' where {$wrid} ");

        /**
         * 태그기능을 사용하는 게시판
         */
        if ($eyoom_board['bo_use_tag'] == '1') {
            sql_query("update {$g5['eyoom_tag_write']} set eb_7 = '{$eb_7}' where tw_theme = '" . sql_real_escape_string($theme) . "' and bo_table = '{$bo_table}' and {$wrid} ");
        }
    }
}