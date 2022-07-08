<?php
/**
 * @file    /adm/eyoom_admin/core/member/mail_select_list.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "200300";

$action_url1 = G5_ADMIN_URL . '/?dir=member&amp;pid=mail_select_update';

auth_check_menu($auth, $sub_menu, 'r');

$ma_id = isset($_REQUEST['ma_id']) ? (int) $_REQUEST['ma_id'] : 0;

$ma_last_option = "";

$sql_common = " from {$g5['member_table']} ";
$sql_where = " where (1) ";

$mb_id1         = isset($_POST['mb_id1'])       ? (int) $_POST['mb_id1'] : 1;
$mb_id1_from    = isset($_POST['mb_id1_from'])  ? clean_xss_tags($_POST['mb_id1_from'], 1, 1, 30) : '';
$mb_id1_to      = isset($_POST['mb_id1_to'])    ? clean_xss_tags($_POST['mb_id1_to'], 1, 1, 30) : '';
$mb_email       = isset($_POST['mb_email'])     ? clean_xss_tags($_POST['mb_email'], 1, 1, 100) : '';
$mb_mailling    = isset($_POST['mb_mailling'])  ? clean_xss_tags($_POST['mb_mailling'], 1, 1, 100) : '';
$mb_level_from  = isset($_POST['mb_level_from'])? (int) $_POST['mb_level_from'] : 1;
$mb_level_to    = isset($_POST['mb_level_to'])  ? (int) $_POST['mb_level_to'] : 10;

// 회원ID ..에서 ..까지
if ($mb_id1 != 1) {
    $sql_where .= " and mb_id between '{$mb_id1_from}' and '{$mb_id1_to}' ";
}

// E-mail에 특정 단어 포함
if ($mb_email != "") {
    $sql_where .= " and mb_email like '%{$mb_email}%' ";
}

// 메일링
if ($mb_mailling != "") {
    $sql_where .= " and mb_mailling = '{$mb_mailling}' ";
}

// 권한
$sql_where .= " and mb_level between '{$mb_level_from}' and '{$mb_level_to}' ";

// 게시판그룹회원
if ($gr_id) {
    $group_member = "";
    $comma = "";
    $sql2 = " select mb_id from {$g5['group_member_table']} where gr_id = '{$gr_id}' order by mb_id ";
    $result2 = sql_query($sql2);
    for ($k = 0; $row2 = sql_fetch_array($result2); $k++) {
        $group_member .= "{$comma}'{$row2['mb_id']}'";
        $comma = ",";
    }

    if (!$group_member) {
        alert('선택하신 게시판 그룹회원이 한명도 없습니다.');
    }

    $sql_where .= " and mb_id in ($group_member) ";
}

// 탈퇴, 차단된 회원은 제외
$sql_where .= " and mb_leave_date = '' and mb_intercept_date = '' ";

$sql = " select COUNT(*) as cnt {$sql_common} {$sql_where} ";
$row = sql_fetch($sql);
$cnt = $row['cnt'];
if ($cnt == 0) {
    alert('선택하신 내용으로는 해당되는 회원자료가 없습니다.');
}

// 마지막 옵션을 저장합니다.
$ma_last_option .= "mb_id1={$mb_id1}";
$ma_last_option .= "||mb_id1_from={$mb_id1_from}";
$ma_last_option .= "||mb_id1_to={$mb_id1_to}";
$ma_last_option .= "||mb_email={$mb_email}";
$ma_last_option .= "||mb_mailling={$mb_mailling}";
$ma_last_option .= "||mb_level_from={$mb_level_from}";
$ma_last_option .= "||mb_level_to={$mb_level_to}";
$ma_last_option .= "||gr_id={$gr_id}";

sql_query(" update {$g5['mail_table']} set ma_last_option = '{$ma_last_option}' where ma_id = '{$ma_id}' ");

$sql = " select mb_id, mb_name, mb_nick, mb_email, mb_datetime $sql_common $sql_where order by mb_id ";
$result = sql_query($sql);
$i=0;
$ma_list = "";
$cr = "";
while ($row=sql_fetch_array($result)) {
    $i++;
    $ma_list .= $cr . $row['mb_email'] . "||" . $row['mb_id'] . "||" . get_text($row['mb_name']) . "||" . $row['mb_nick'] . "||" . $row['mb_datetime'];
    $cr = "\n";

    $list[$i] = $row;
}

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="메일보내기" class="btn-e btn-e-lg btn-e-red">' ;
$frm_submit .= ' <a href="' . G5_ADMIN_URL . '/?dir=member&amp;pid=mail_select_form&amp;ma_id='.$ma_id.'" class="btn-e btn-e-lg btn-e-dark">뒤로</a> ';
$frm_submit .= '</div>';