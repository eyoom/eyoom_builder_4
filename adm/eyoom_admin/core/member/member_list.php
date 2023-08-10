<?php
/**
 * @file    /adm/eyoom_admin/core/member/member_list.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "200100";

$action_url1 = G5_ADMIN_URL . '/?dir=member&amp;pid=member_list_update&amp;smode=1';

auth_check_menu($auth, $sub_menu, 'r');

if ($wmode) {
    $qstr .= "&amp;wmode=1";
}

$sql_common = " from {$g5['member_table']} as a left join {$g5['eyoom_member']} as b on a.mb_id = b.mb_id ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point':
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_level':
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        default:
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

// 회원레벨 검색
$lev = isset($_GET['lev']) ? (int) $_GET['lev']: '';
if ($lev) {
    $sql_search .= " and mb_level = '{$lev}' ";
    $qstr .= "&amp;lev={$lev}";
}

// 본인확인
$cert = isset($_GET['cert']) ? (int) $_GET['cert']: '';
if ($cert) {
    $cert_val = $cert-1 == 1 ? 1:'';
    $sql_search .= " and mb_certify = '{$cert_val}' ";
    $qstr .= "&amp;cert={$cert}";
    if ($cert == '1') {
        $mb_certify_no = 'checked';
    } else if ($cert == '2') {
        $mb_certify_yes = 'checked';
    }
} else {
    $mb_certify_all = 'checked';
}

// 정보공개
$open = isset($_GET['open']) ? (int) $_GET['open']: '';
if ($open) {
    $open_val = $open-1 == 1 ? 1:'';
    $sql_search .= " and mb_open = '{$open_val}' ";
    $qstr .= "&amp;open={$open}";
    if ($open == '1') {
        $mb_open_no = 'checked';
    } else if ($open == '2') {
        $mb_open_yes = 'checked';
    }
} else {
    $mb_open_all = 'checked';
}

// 성인인증
$adt = isset($_GET['adt']) ? (int) $_GET['adt']: '';
if ($adt) {
    $adt_val = $adt-1 == 1 ? 1:'';
    $sql_search .= " and mb_adult = '{$adt_val}' ";
    $qstr .= "&amp;adt={$adt}";
    if ($adt == '1') {
        $mb_adult_no = 'checked';
    } else if ($adt == '2') {
        $mb_adult_yes = 'checked';
    }
} else {
    $mb_adult_all = 'checked';
}

// 메일 수신 여부
$mail = isset($_GET['mail']) ? (int) $_GET['mail']: '';
if ($mail) {
    $mail_val = $mail-1 == 1 ? 1:'';
    $sql_search .= " and mb_mailling = '{$mail_val}' ";
    $qstr .= "&amp;mail={$mail}";
    if ($mail == '1') {
        $mb_mailling_no = 'checked';
    } else if ($mail == '2') {
        $mb_mailling_yes = 'checked';
    }
} else {
    $mb_mailling_all = 'checked';
}

// 문자 수신 여부
$sms = isset($_GET['sms']) ? (int) $_GET['sms']: '';
if ($sms) {
    $sms_val = $sms-1 == 1 ? 1:'';
    $sql_search .= " and mb_sms = '{$sms_val}' ";
    $qstr .= "&amp;sms={$sms}";
    if ($sms == '1') {
        $mb_sms_no = 'checked';
    } else if ($sms == '2') {
        $mb_sms_yes = 'checked';
    }
} else {
    $mb_sms_all = 'checked';
}

// 기간검색이 있다면
$fr_date = isset($_REQUEST['fr_date']) ? $_REQUEST['fr_date'] : '';
$to_date = isset($_REQUEST['to_date']) ? $_REQUEST['to_date'] : '';
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $fr_date) ) $fr_date = '';
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $to_date) ) $to_date = '';

if ($sdt == 'mb_datetime') {
    $sdt_target = 'mb_datetime';
} else if ($sdt == 'mb_today_login') {
    $sdt_target = 'mb_today_login';
}

if ($sdt_target && $fr_date && $to_date) {
    $sql_search .= " and $sdt_target between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
    $qstr .= "&amp;sdt={$sdt_target}&amp;fr_date={$fr_date}&amp;to_date={$to_date}";
}

// 최고관리자가 아니라면 자신 레벨보다 낮은 레벨의 회원만 출력
if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) {
    $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
}
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 탈퇴회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_leave_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$leave_count = $row['cnt'];

// 차단회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_intercept_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$intercept_count = $row['cnt'];

// 탈퇴회원이나 차단회원 검색조건
if ($sst == 'mb_leave_date' || $sst == 'mb_intercept_date') {
    $sql_search .= " and {$sst} <> '' ";
}

$sql = " select *, a.mb_id as mb_id {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $leave_date = $row['mb_leave_date'] ? $row['mb_leave_date'] : date('Ymd', G5_SERVER_TIME);
    $intercept_date = $row['mb_intercept_date'] ? $row['mb_intercept_date'] : date('Ymd', G5_SERVER_TIME);

    $mb_nick = get_sideview($row['mb_id'], get_text($row['mb_nick']), $row['mb_email'], $row['mb_homepage']);

    $mb_id = $row['mb_id'];
    $leave_msg = '';
    $intercept_msg = '';
    $intercept_title = '';
    if ($row['mb_leave_date']) {
        $mb_id = $mb_id;
        $leave_msg = "<span class='mb_leave_msg color-red'>탈퇴함</span>";
    }
    else if ($row['mb_intercept_date']) {
        $mb_id = $mb_id;
        $intercept_msg = "<span class='mb_intercept_msg color-orange'>차단됨</span>";
        $intercept_title = '차단해제';
    }
    if ($intercept_title == '')
        $intercept_title = '차단하기';

    if ($leave_msg || $intercept_msg) {
        $row['mb_status'] = $leave_msg.' '.$intercept_msg;
    } else if(preg_match('#^[0-9]{8}.*삭제함#', $row['mb_memo'])) {
        $row['mb_status'] = "<span class='mb_delete_msg color-yellow'>삭제</span>";
    } else {
        $row['mb_status'] = "정상";
    }

    $mb_level = get_member_level_select("mb_level[$i]", 1, $member['mb_level'], $row['mb_level']);

    $list[$i] = $row;
    switch($row['mb_certify']) {
        case 'hp':
            $list[$i]['mb_certify_case'] = '휴대폰';
            break;
        case 'ipin':
            $list[$i]['mb_certify_case'] = '아이핀';
            break;
        case 'simple':
            $list[$i]['mb_certify_case'] = '간편인증';
            break;
        case 'admin':
            $list[$i]['mb_certify_case'] = '관리자';
            break;
        default:
            $list[$i]['mb_certify_case'] = '-';
            break;
    }
    $list[$i]['intercept_date'] = $intercept_date;

    $list[$i]['mb_level_select'] = preg_replace("/(\\n|\\r)/","",str_replace('"', "'", $mb_level));
    if (preg_match('/[1-9]/', $row['mb_email_certify']) ) {
        $list[$i]['email_certify'] = 'Yes';
    } else {
        $list[$i]['email_certify'] = 'No';
    }

    $list[$i]['bg'] = 'bg'.($i%2);
    $list[$i]['photo_url'] = mb_photo_url($row['mb_id']);

    $list_num = $total_count - ($page - 1) * $rows;
    $list[$i]['num'] = $list_num - $k;
    $k++;
}

/**
 * 페이징
 */
$paging = $eb->set_paging('admin', $dir, $pid, $qstr);

/**
 * 검색버튼
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" value="검색" class="btn-e btn-e-lg btn-e-dark" accesskey="s">' ;
$frm_submit .= '</div>';
