<?php
$sub_menu = '600300';
include_once('./_common.php');

if ($config['cf_admin'] != $member['mb_id']) {
    alert("권한이 없습니다.");
}

$sql_common = " from {$g5['member_table']} as a left join {$g5['eyoom_member']} as b on a.mb_id = b.mb_id ";

$sql_search = " where (1) and a.mb_id <> '{$config['cf_admin']}' ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point':
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_level':
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        case 'mb_tel':
        case 'mb_hp':
            $sql_search .= " ({$sfl} like '%{$stx}') ";
            break;
        default:
            $sql_search .= " ({$sfl} like '{$stx}%') ";
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

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";
$sql = " select *, a.mb_id as mb_id {$sql_common} {$sql_search} {$sql_order} ";
$result = sql_query($sql);

if(!@sql_num_rows($result))
    alert('검색 대상 회원이 없습니다.');

function column_char($i) { return chr( 65 + $i ); }

if (phpversion() >= '5.2.0') {
    include_once(G5_LIB_PATH.'/PHPExcel.php');
    
    $headers = array('No', '아이디', '이름', '닉네임', '그누레벨', '이윰레벨', '이메일', '연락처', '휴대전화', '메일수신', '가입일');
    $widths  = array(8, 15, 15, 15, 8, 8, 30, 15, 15, 8, 25);
    $header_bgcolor = 'FFABCDEF';
    $last_char = column_char(count($headers) - 1);
    $rows = array();
    for($i=1; $row=sql_fetch_array($result); $i++) {
        $rows[$i] = 
                    array(' '.$i, 
                          $row['mb_id'],
                          $row['mb_name'],
                          $row['mb_nick'],
                          ' '. $row['mb_level'],
                          ' '. $row['level'],
                          $row['mb_email'],
                          ' '. $row['mb_tel'],
                          ' '. $row['mb_hp'],
                          $row['mb_sms'] ? '예': '아니오',
                          $row['ap_regdate'])
                          ;
    }

    $data = array_merge(array($headers), $rows);

    $excel = new PHPExcel();
    $excel->setActiveSheetIndex(0)->getStyle( "A1:${last_char}1" )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB($header_bgcolor);
    $excel->setActiveSheetIndex(0)->getStyle( "A:$last_char" )->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(true);
    foreach($widths as $i => $w) $excel->setActiveSheetIndex(0)->getColumnDimension( column_char($i) )->setWidth($w);
    $excel->getActiveSheet()->fromArray($data,NULL,'A1');

    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"member_list_".date("ymdhis", time()).".xls\"");
    header("Cache-Control: max-age=0");

    $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
    $writer->save('php://output');
}