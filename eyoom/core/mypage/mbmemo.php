<?php
/**
 * core file : /eyoom/core/mypage/mbmemo.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원메모 기능 사용여부 체크
 */
if (!$config['cf_use_mbmemo']) alert('회원메모 기능이 비활성화된 상태입니다.',G5_URL);

/**
 * 회원체크
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.',G5_URL);

/**
 * 내글반응 관련 정보
 */
$sql_common = " from {$g5['eyoom_mbmemo']} as a left join {$g5['member_table']} as b on a.mm_mb_id = b.mb_id ";

/**
 * 회원아이디 검색
 */
$sql_where = " where a.mm_my_id = '{$member['mb_id']}' ";

/**
 * 검색대상
 */
if ($stx && $sfl) {
    switch ($sfl) {
        case 'id': $sql_where .= " and b.mb_id = '{$stx}' "; break;
        case 'nick': $sql_where .= " and (b.mb_name = '{$stx}' || b.mb_nick like '%".$stx."%') "; break;
    }
}
$sql_order = " order by a.mm_no desc ";

$sql = " select count(*) as cnt {$sql_common} {$sql_where}";
$row = sql_fetch($sql, false);
$total_count = $row['cnt'];

$rows = $config['cf_new_rows'] ? $config['cf_new_rows']: 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * {$sql_common} {$sql_where} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql, false);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;
    $list[$i]['mm_memo'] = $row['mm_memo'] ? $eb->mb_unserialize($row['mm_memo']): '';
}
$count = count($list);

/**
 * 페이징
 */
$paging = $eb->set_paging('mbmemo', '', $qstr);

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/mbmemo.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/mbmemo.skin.html.php');