<?php
$g5_path = '../../..';
include_once($g5_path.'/common.php');

if (!$is_member) exit;

$action     = isset($_POST['action']) ? clean_xss_tags($_POST['action']): '';
$bo_table   = isset($_POST['bo_table']) ? clean_xss_tags($_POST['bo_table']): '';
$wr_id      = isset($_POST['wr_id']) ? clean_xss_tags($_POST['wr_id']): '';
$cmt_id     = isset($_POST['cmt_id']) ? clean_xss_tags($_POST['cmt_id']): '';

if (!$action) exit;
if (!$bo_table) exit;
if (!$wr_id) exit;

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
     * 권한 체크
     */
    if (!$is_admin && $member['mb_level'] < $eyoom_board['bo_blind_direct']) {
        $error = true;
    } else {

        /**
         * 이미 블라인드 처리된 글
         */
        if ($ycard['yc_blind'] == 'y' && $action == 'db') {
            $error = true;
        }

        /**
         * 이미 블라인드 취소 처리된 글
         */
        if ($ycard['yc_blind'] == 'n' && $action == 'cb') {
            $error = true;
        }

        /**
         * 다이렉트 블라인드 적용 및 취소
         */
        switch($action) {
            case 'db': // direct blind
                $ycard['yc_blind'] = 'y';
                $ycard['yc_count'] = $yc_count;
                $eb_5 = serialize($ycard);
                sql_query("update {$write_table} set eb_5 = '{$eb_5}' where {$wrid} ");
                sql_query("update {$g5['eyoom_tag_write']} set eb_5 = '{$eb_5}' where tw_theme ='{$theme}' and bo_table = '{$bo_table}' and {$wrid} ");
                break;

            case 'cb': // cancel blind
                $ycard['yc_blind'] = 'n';
                $ycard['yc_count'] = $yc_count;
                $eb_5 = serialize($ycard);
                sql_query("update {$write_table} set eb_5 = '{$eb_5}' where {$wrid} ");
                sql_query("update {$g5['eyoom_tag_write']} set eb_5 = '{$eb_5}' where tw_theme ='{$theme}' and bo_table = '{$bo_table}' and {$wrid} ");
                break;
        }
    }
}

if ($tocken) {
    $_value_array = array();
    $_value_array['error'] = $error;

    include_once '../../class/json.class.php';

    $json = new Services_JSON();
    $output = $json->encode($_value_array);

    echo $output;
}
exit;