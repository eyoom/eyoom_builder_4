<?php
$g5_path = '../../..';
include_once($g5_path.'/common.php');

if (!$is_member) exit;

$action     = isset($_POST['action']) ? clean_xss_tags($_POST['action']): '';
$bo_table   = isset($_POST['bo_table']) ? clean_xss_tags($_POST['bo_table']): '';
$wr_id      = isset($_POST['wr_id']) ? clean_xss_tags($_POST['wr_id']): '';
$cmt_id     = isset($_POST['cmt_id']) ? clean_xss_tags($_POST['cmt_id']): '';
$yc_reason  = isset($_POST['reason']) ? clean_xss_tags($_POST['reason']): '';

if (!$action) exit;
if (!$bo_table) exit;
if (!$wr_id) exit;
if (!$yc_reason && $action == 'add') exit;

$tocken = true;
$error = false;

/**
 * 게시판 정보 가져오기
 */
$eyoom_board = $bbs->board_info($bo_table);

/**
 * 신고/블라인드 기능 사용 체크
 */
if ($eyoom_board['bo_use_yellow_card'] != '1') {
    $tocken = 'no';
} else {
    $write_table = $g5['write_prefix'] . $bo_table;
    $wr_id = $cmt_id ? $cmt_id: $wr_id;
    $wrid = " wr_id = '{$wr_id}' ";

    /**
     * 신고 접수 정보
     */
    $data = sql_fetch("select eb_5 from {$write_table} where {$wrid} ");
    $ycard = $eb->mb_unserialize($data['eb_5']);
    if (!$ycard) $ycard = array();

    /**
     * 신고 건수 가져오기
     */
    $yc_count = $bbs->get_yellow_card_cnt($bo_table, $wr_id);

    /**
     * 이미 신고한 기록이 있는지 체크
     */
    $my_card = sql_fetch("select count(*) as cnt from {$g5['eyoom_yellowcard']} where mb_id = '{$member['mb_id']}' and bo_table = '{$bo_table}' and {$wrid} ");

    /**
     * 이미 블라인드 처리된 글인지 체크
     */
    if ($ycard['yc_blind'] != 'y') {
        switch($action) {
            /**
             * 신고 추가하기
             */
            case 'add':
                if ($my_card['cnt'] == 0) {
                    $ycard['yc_count'] = $yc_count + 1;
                    sql_query("insert into {$g5['eyoom_yellowcard']} set bo_table = '{$bo_table}', {$wrid}, pr_id = '{$wr_id}', mb_id = '{$member['mb_id']}', yc_reason = '{$yc_reason}',  yc_datetime = '". G5_TIME_YMDHIS ."' ");
                    if ($ycard['yc_count'] >= $eyoom_board['bo_blind_limit']) {
                        $ycard['yc_blind'] = 'y';
                    } else {
                        $ycard['yc_blind'] = 'n';
                    }
                    $eb_5 = serialize($ycard);
                }
                break;

            /**
             * 신고 취소하기
             */
            case 'cancel':
                if ($my_card['cnt'] > 0) {
                    $ycard['yc_count'] = $yc_count - 1;
                    sql_query("delete from {$g5['eyoom_yellowcard']} where bo_table='{$bo_table}' and {$wrid} and mb_id='{$member['mb_id']}' ");
                    if ($ycard['yc_count'] >= $eyoom_board['bo_blind_limit']) {
                        $ycard['yc_blind'] = 'y';
                    } else {
                        $ycard['yc_blind'] = 'n';
                    }
                    $eb_5 = serialize($ycard);
                }
                break;
        }

        /**
         * 원본 게시물에 적용하기
         */
        sql_query("update {$write_table} set eb_5 = '{$eb_5}' where {$wrid} ");
        sql_query("update {$g5['eyoom_tag_write']} set eb_5 = '{$eb_5}' where  bo_table = '{$bo_table}' and {$wrid} and tw_theme='" . sql_real_escape_string($theme) . "' ");
    }
}