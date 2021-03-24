<?php
/**
 * @file    admin.common.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 그누관리자 모드로 활성화되어 있는지 체크
 */
if ($eyoom['use_eyoom_admin'] == 'n' || $use_eyoom_builder === false) return;

/**
 * 관리자모드 라이브러리 파일
 */
@include_once(G5_ADMIN_PATH.'/admin.lib.php');

if( isset($token) ){
    $token = @htmlspecialchars(strip_tags($token), ENT_QUOTES);
}

/**
 * 이벤트 후킹
 */
run_event('admin_common');

/**
 * 영카트5 인가?
 */
$is_youngcart = false;
if (defined('G5_YOUNGCART_VER')) {
    $is_youngcart = true;

    /**
     * 쇼핑몰 라이브러리 파일
     */
    include_once(EYOOM_ADMIN_LIB_PATH.'/shop.lib.php');
}

/**
 * 이윰 관리자모드 라이브러리 파일
 */
@include_once(EYOOM_ADMIN_LIB_PATH.'/admin.lib.php');

##########################################

/**
 * 새로 가입한 회원
 */
if ($is_admin != 'super') $add_where = " and mb_level <= '{$member['mb_level']}' ";
$sql = " select * from {$g5['member_table']} where (1) and mb_id != '{$config['cf_admin']}' {$add_where} and mb_leave_date = '' order by mb_datetime desc limit 5 ";
$result = sql_query($sql);
$new_member = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $new_member[$i] = $row;
    $new_member[$i]['mb_photo'] = $eb->mb_photo($row['mb_id']);
}

/**
 * 최근 게시물
 */
$new_write_rows = 5;

$sql_common = " from {$g5['board_new_table']} a, {$g5['board_table']} b, {$g5['group_table']} c where a.bo_table = b.bo_table and b.gr_id = c.gr_id ";

if ($gr_id)
    $sql_common .= " and b.gr_id = '$gr_id' ";
if ($view) {
    if ($view == 'w')
        $sql_common .= " and a.wr_id = a.wr_parent ";
    else if ($view == 'c')
        $sql_common .= " and a.wr_id <> a.wr_parent ";
}
$sql_order = " order by a.bn_id desc ";

$sql = " select a.*, b.bo_subject, c.gr_subject, c.gr_id {$sql_common} {$sql_order} limit {$new_write_rows} ";
$result = sql_query($sql);
$new_post = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $tmp_write_table = $g5['write_prefix'] . $row['bo_table'];

    if ($row['wr_id'] == $row['wr_parent']) { // 원글
        $comment = "";
        $comment_link = "";
        $row2 = sql_fetch(" select * from $tmp_write_table where wr_id = '{$row['wr_id']}' ");

        $name = $row2['wr_name'];
        // 당일인 경우 시간으로 표시함
        $datetime = substr($row2['wr_datetime'],0,10);
        $datetime2 = $row2['wr_datetime'];
        if ($datetime == G5_TIME_YMD)
            $datetime2 = substr($datetime2,11,5);
        else
            $datetime2 = substr($datetime2,5,5);

    } else { // 코멘트
        $comment = '댓글. ';
        $comment_link = '#c_'.$row['wr_id'];
        $row2 = sql_fetch(" select * from {$tmp_write_table} where wr_id = '{$row['wr_parent']}' ");
        $row3 = sql_fetch(" select mb_id, wr_name, wr_email, wr_homepage, wr_datetime from {$tmp_write_table} where wr_id = '{$row['wr_id']}' ");

        $name = $row3['wr_name'];
        // 당일인 경우 시간으로 표시함
        $datetime = substr($row3['wr_datetime'],0,10);
        $datetime2 = $row3['wr_datetime'];
        if ($datetime == G5_TIME_YMD)
            $datetime2 = substr($datetime2,11,5);
        else
            $datetime2 = substr($datetime2,5,5);
    }

    $new_post[$i]['gr_href']    = get_eyoom_pretty_url(G5_GROUP_DIR,$row['gr_id']);
    $new_post[$i]['group']      = cut_str($row['gr_subject'], 10);
    $new_post[$i]['bo_href']    = get_eyoom_pretty_url($row['bo_table']);
    $new_post[$i]['board']      = cut_str($row['bo_subject'], 20);
    $new_post[$i]['view_url']   = get_eyoom_pretty_url($row['bo_table'],$row2['wr_id'], $comment_link);
    $new_post[$i]['subject']    = $comment . conv_subject($row2['wr_subject'], 100);
    $new_post[$i]['name']       = $name;
    $new_post[$i]['mb_photo']   = $eb->mb_photo($row['mb_id']);
    $new_post[$i]['datetime']   = $datetime;
}

/**
 * 최근 포인트 발생내역
 */
$new_point_rows = 5;

$sql_common = " from {$g5['point_table']} ";
$sql_search = " where (1) ";
$sql_order = " order by po_id desc ";

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$new_point_rows} ";
$result = sql_query($sql);
$row2['mb_id'] = '';
$new_point = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    if ($row2['mb_id'] != $row['mb_id']) {
        $sql2 = " select mb_no, mb_id, mb_name, mb_nick, mb_email, mb_homepage, mb_point from {$g5['member_table']} where mb_id = '{$row['mb_id']}' ";
        $row2 = sql_fetch($sql2);
    }

    $new_point[$i] = $row;
    $new_point[$i]['mb_name'] = get_text($row2['mb_name']);
    $new_point[$i]['mb_nick'] = $row2['mb_nick'];
    $new_point[$i]['mb_photo'] = $eb->mb_photo($row['mb_id']);
}

/**
 * 1:1문의
 */
$sql = " select * from {$g5['qa_content_table']} where (1) and qa_type = '0' order by qa_num limit 5 ";
$result = sql_query($sql);
$qa_conts = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $sql1 = " select * from {$g5['member_table']} where mb_id = '{$row['mb_id']}' ";
    $row1 = sql_fetch($sql1);

    $qa_conts[$i] = $row;
    $qa_conts[$i]['name'] = get_text($row['qa_name']);
    $qa_conts[$i]['mb_photo'] = $eb->mb_photo($row['mb_id']);
}