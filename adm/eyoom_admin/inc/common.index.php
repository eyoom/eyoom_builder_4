<?php
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 현재 접속자 정보
 */
$current = eb_connect($skin, false);

/**
 * 방문자 통계
 */
$visit = eb_visit($skin, false);

/**
 * 회원랭킹 정보
 */
$ranking = eb_ranking($skin, 10, false);

/**
 * 하루 일자 지정
 */
$yesterday = date('Y-m-d', strtotime('-1day'));
$today = date('Y-m-d');

/**
 * 하루 방문자 통계
 */
$this_vi_info = get_visit_info($today);

/**
 * 하루 활동기록 - 로그인수, 글쓰기수, 댓글수
 */
$today_activity     = get_activity_info($today);
$this_today_login   = $today_activity['login'];
$this_today_write   = $today_activity['write'];
$this_today_cmt     = $today_activity['cmt'];

/**
 * 시간별 방문자 및 회원가입
 */
for($i=0; $i<24; $i++) {
    // 방문자
    $this_vi_count[$i] = $this_vi_info['vi_cnt'][$i] ? count((array)$this_vi_info['vi_cnt'][$i]) : 0;

    // 회원가입
    $this_vi_regist[$i] = $this_vi_info['vi_regist'][$i] ? count((array)$this_vi_info['vi_regist'][$i]) : 0;
}

/**
 * 이번주 활동기록 - 글쓰기수, 댓글수
 */
$arr_activity = array();
$x_val = array();
for($i=6; $i>=0; $i--) {
    $date = date('Y-m-d', strtotime('-'.$i.' days', G5_SERVER_TIME));
    $last_date = date('Y-m-d', strtotime('-'.($i+7).' days', G5_SERVER_TIME));

    $x_val[] = $date;
    $last_x_val[] = $last_date;
    //$arr_activity[] = get_activity_date_sum($date);
}
$act_info = get_activity_date_sum($x_val);
for($i=6; $i>=0; $i--) {
    $date = date('Y-m-d', strtotime('-'.$i.' days', G5_SERVER_TIME));
    $arr_activity[] = $act_info[$date];
}

/**
 * 접속 브라우저
 */
$this_vi_browser = $this_vi_info['vi_br'];

/**
 * 접속 디바이스
 */
$this_vi_device = $this_vi_info['vi_dev'];

/**
 * 접속 OS
 */
$this_vi_os = $this_vi_info['vi_os'];

/**
 * 접속 도메인
 */
$this_vi_domain = $this_vi_info['vi_domain'];

/**
 * 새로 가입한 회원
 */
if ($is_admin != 'super') $add_where = " and mb_level <= '{$member['mb_level']}' ";
$sql = " select * from {$g5['member_table']} where (1) and mb_id != '{$config['cf_admin']}' {$add_where} and mb_leave_date = '' order by mb_datetime desc limit 15 ";
$result = sql_query($sql);
$new_member = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $new_member[$i] = $row;
    $new_member[$i]['mb_photo'] = $eb->mb_photo($row['mb_id']);
}

/**
 * 최근 게시물
 */
$new_write_rows = 15;

$sql_common = " from {$g5['board_new_table']} where (1) ";

if ($view) {
    if ($view == 'w')
        $sql_common .= " and wr_id = wr_parent ";
    else if ($view == 'c')
        $sql_common .= " and wr_id <> wr_parent ";
}
$sql_order = " order by bn_id desc ";

$sql = " select * {$sql_common} {$sql_order} limit {$new_write_rows} ";
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

    $new_post[$i]['view_url']   = get_eyoom_pretty_url($row['bo_table'],$row2['wr_id'], $comment_link);
    $new_post[$i]['subject']    = $comment . conv_subject($row2['wr_subject'], 100);
    $new_post[$i]['name']       = $name;
    $new_post[$i]['mb_photo']   = $eb->mb_photo($row['mb_id']);
    $new_post[$i]['datetime']   = $datetime;
}

/**
 * 최근 포인트 발생내역
 */
$new_point_rows = 15;

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
$sql = " select * from {$g5['qa_content_table']} where (1) and qa_type = '0' order by qa_num limit 15 ";
$result = sql_query($sql);
$qa_conts = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $qa_conts[$i] = $row;
    $qa_conts[$i]['name'] = get_text($row['qa_name']);
    $qa_conts[$i]['mb_photo'] = $eb->mb_photo($row['mb_id']);
}