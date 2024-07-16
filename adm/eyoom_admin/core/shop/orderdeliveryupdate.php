<?php
/**
 * @file    /adm/eyoom_admin/core/shop/orderdeliveryupdate.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400400";

include_once(G5_LIB_PATH.'/mailer.lib.php');

auth_check_menu($auth, $sub_menu, "w");

define("_ORDERMAIL_", true);

$sms_count = 0;
$sms_messages = array();

if(isset($_FILES['excelfile']['tmp_name']) && $_FILES['excelfile']['tmp_name']) {
    $file = $_FILES['excelfile']['tmp_name'];

    include_once(G5_LIB_PATH.'/PHPExcel/IOFactory.php');

    $objPHPExcel = PHPExcel_IOFactory::load($file);
    $sheet = $objPHPExcel->getSheet(0);

    $num_rows = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();

    $fail_od_id = array();
    $total_count = 0;
    $fail_count = 0;
    $succ_count = 0;

    // $i 사용시 ordermail.inc.php의 $i 때문에 무한루프에 빠짐
    for ($k = 2; $k <= $num_rows; $k++) {
        $total_count++;

        $rowData = $sheet->rangeToArray('A' . $k . ':' . $highestColumn . $k,
                                            NULL,
                                            TRUE,
                                            FALSE);

        $od_id               = isset($rowData[0][0]) ? addslashes(trim($rowData[0][0])) : '';
        $od_delivery_company = isset($rowData[0][8]) ? addslashes($rowData[0][8]) : '';
        $od_invoice          = isset($rowData[0][9]) ? addslashes($rowData[0][9]) : '';

        if(!$od_id || !$od_delivery_company || !$od_invoice) {
            $fail_count++;
            $fail_od_id[] = $od_id;
            continue;
        }

        // 주문정보
        $od = sql_fetch(" select * from {$g5['g5_shop_order_table']} where od_id = '$od_id' ");
        if (!$od) {
            $fail_count++;
            $fail_od_id[] = $od_id;
            continue;
        }

        if($od['od_status'] != '준비') {
            $fail_count++;
            $fail_od_id[] = $od_id;
            continue;
        }

        $delivery['invoice'] = $od_invoice;
        $delivery['invoice_time'] = G5_TIME_YMDHIS;
        $delivery['delivery_company'] = $od_delivery_company;

        // 주문정보 업데이트
        order_update_delivery($od_id, $od['mb_id'], '배송', $delivery);
        change_status($od_id, '준비', '배송');

        $succ_count++;
        
        $send_sms = isset($_POST['send_sms']) ? clean_xss_tags($_POST['send_sms'], 1, 1) : '';
        $od_send_mail = isset($_POST['od_send_mail']) ? clean_xss_tags($_POST['od_send_mail'], 1, 1) : '';
        $send_escrow = isset($_POST['send_escrow']) ? clean_xss_tags($_POST['send_escrow'], 1, 1) : '';

        // SMS
        if($config['cf_sms_use'] == 'icode' && $send_sms && $default['de_sms_use5']) {
            $sms_contents = conv_sms_contents($od_id, $default['de_sms_cont5']);
            if($sms_contents) {
                $receive_number = preg_replace("/[^0-9]/", "", $od['od_hp']);	// 수신자번호
                $send_number = preg_replace("/[^0-9]/", "", $default['de_admin_company_tel']); // 발신자번호

                if($receive_number)
                    $sms_messages[] = array('recv' => $receive_number, 'send' => $send_number, 'cont' => $sms_contents);
            }
        }

        // 메일
        if($config['cf_email_use'] && $od_send_mail)
            include G5_ADMIN_PATH.'/shop_admin/ordermail.inc.php';

        // 에스크로 배송
        if($send_escrow && $od['od_tno'] && $od['od_escrow']) {
            $escrow_tno  = $od['od_tno'];
            $escrow_numb = $od_invoice;
            $escrow_corp = $od_delivery_company;

            include(G5_SHOP_PATH.'/'.$od['od_pg'].'/escrow.register.php');
        }
    }
}

// SMS
$sms_count = count($sms_messages);
if($sms_count > 0) {
    if($config['cf_sms_type'] == 'LMS') {
        include_once(G5_LIB_PATH.'/icode.lms.lib.php');

        $port_setting = get_icode_port_type($config['cf_icode_id'], $config['cf_icode_pw']);

        // SMS 모듈 클래스 생성
        if($port_setting !== false) {
            $SMS = new LMS;
            $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $port_setting);

            for($s=0; $s<$sms_count; $s++) {
                $strDest     = array();
                $strDest[]   = $sms_messages[$s]['recv'];
                $strCallBack = $sms_messages[$s]['send'];
                $strCaller   = iconv_euckr(trim($default['de_admin_company_name']));
                $strSubject  = '';
                $strURL      = '';
                $strData     = iconv_euckr($sms_messages[$s]['cont']);
                $strDate     = '';
                $nCount      = count($strDest);

                $res = $SMS->Add($strDest, $strCallBack, $strCaller, $strSubject, $strURL, $strData, $strDate, $nCount);

                $SMS->Send();
                $SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
            }
        }
    } else {
        include_once(G5_LIB_PATH.'/icode.sms.lib.php');

        $SMS = new SMS; // SMS 연결
        $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $config['cf_icode_server_port']);

        for($s=0; $s<$sms_count; $s++) {
            $recv_number = $sms_messages[$s]['recv'];
            $send_number = $sms_messages[$s]['send'];
            $sms_content = iconv_euckr($sms_messages[$s]['cont']);

            $SMS->Add($recv_number, $send_number, $config['cf_icode_id'], $sms_content, "");
        }

        $SMS->Send();
        $SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
    }
}