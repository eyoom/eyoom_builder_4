<?php
/**
 * core file : /eyoom/core/mypage/respond.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원체크
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.',G5_URL);

/**
 * 회원아이디 검색
 */
$sql_where = " where wr_mb_id = '{$member['mb_id']}' ";

/**
 * 읽지 않은 내글반응 적용
 */
$not_read = sql_fetch("select count(*) as cnt from {$g5['eyoom_respond']} {$sql_where} and re_chk=0");
sql_query("update {$g5['eyoom_member']} set respond = '{$not_read['cnt']}' where mb_id = '{$member['mb_id']}' ");

/**
 * 내글반응 관련 정보
 */
$sql_common = " from {$g5['eyoom_respond']} {$sql_where} ";

/**
 * 읽음 여부
 */
$read = isset($_GET['read']) ? $_GET['read'] : "";
if ($read == "y") {
    $sql_common .= " and re_chk = 1 ";
    $qstr .= '&read=y';
} else if ($read == "n") {
    $sql_common .= " and re_chk = 0 ";
    $qstr .= '&read=n';
}
$type = isset($_GET['type']) ? $_GET['type'] : "";
if ($type) {
    $sql_common .= " and re_type = '".$type."' ";
    $qstr .= '&type='.$type;
}

/**
 * 검색대상
 */
if ($stx && $sfl) {
    switch ($sfl) {
        case 'id': $sql_common .= " and mb_id = '{$stx}' "; break;
        case 'nick': $sql_common .= " and mb_name = '{$stx}' "; break;
    }
}
$sql_order = " order by regdt desc ";

$sql = " select count(*) as cnt {$sql_common} ";
$row = sql_fetch($sql, false);
$total_count = $row['cnt'];

$rows = $config['cf_new_rows'] ? $config['cf_new_rows']: 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * {$sql_common} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql, false);
$respond = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $reinfo = $eb->respond_mention($row['re_type'],$row['mb_name'],$row['re_cnt']);

    /**
     * 당일인 경우 시간으로 표시함
     */
    $datetime = substr($row['regdt'],0,10);
    $datetime2 = $row['regdt'];
    if ($datetime == G5_TIME_YMD) {
        $datetime2 = substr($datetime2,11,5);
    } else {
        $datetime2 = substr($datetime2,5,5);
    }
    $respond[$i]['rid'] = $row['rid'];
    $respond[$i]['mb_name'] = $row['mb_name'];
    $respond[$i]['mention'] = $reinfo['mention'];
    $respond[$i]['wr_subject'] = $row['wr_subject'];
    $respond[$i]['chk'] = $row['re_chk'];
    $respond[$i]['type'] = $reinfo['type'];
    $respond[$i]['href'] = './respond_chk.php?rid='.$row['rid'];
    $respond[$i]['delete'] = './respond_chk.php?rid='.$row['rid'].'&act=delete'.$get;
    $respond[$i]['datetime'] = $datetime;
    $respond[$i]['datetime2'] = $datetime2;
    $respond[$i]['mb_photo'] = $eb->mb_photo($row['mb_id'], 'icon');
}
$count = count($respond);

/**
 * 페이징
 */
$paging = $eb->set_paging('respond', '', $qstr);

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/respond.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/respond.skin.html.php');