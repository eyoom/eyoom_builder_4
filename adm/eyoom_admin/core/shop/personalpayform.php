<?php
/**
 * @file    /adm/eyoom_admin/core/shop/personalpayform.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400440";

/**
 * 폼 action URL
 */
$action_url1 = G5_ADMIN_URL . "/?dir=shop&amp;pid=personalpayformupdate&amp;smode=1";

auth_check_menu($auth, $sub_menu, "w");

$pp_id = isset($_REQUEST['pp_id']) ? safe_replace_regex($_REQUEST['pp_id'], 'pp_id') : '';
$popup = isset($_REQUEST['popup']) ? clean_xss_tags($_REQUEST['popup'], 1, 1) : '';
$od_id = isset($_REQUEST['od_id']) ? safe_replace_regex($_REQUEST['od_id'], 'od_id') : '';

$pp = array('pp_name'=>'', 'pp_price'=>0, 'od_id'=>'', 'pp_content'=>'', 'pp_settle_case'=>'', 'pp_receipt_time'=>'', 'pp_receipt_price'=>0, 'pp_shop_memo'=>'');

if ($w == 'u') {
    $html_title = '개인결제 수정';

    $sql = " select * from {$g5['g5_shop_personalpay_table']} where pp_id = '$pp_id' ";
    $pp = sql_fetch($sql);
    if (!$pp['pp_id']) alert('등록된 자료가 없습니다.');
}
else
{
    $html_title = '개인결제 입력';
    $pp['pp_use'] = 1;
}

$wrp_tag_st = '';
$wrp_tag_end = '';
if($wmode) { // 팝업창일 때
    $pp['od_id'] = $od_id;
    $sql = " select od_id, od_name, od_misu
                from {$g5['g5_shop_order_table']}
                where od_id = '$od_id' ";
    $od = sql_fetch($sql);

    if(! ($od['od_id'] && $od['od_id']))
        alert_close('주문정보가 존재하지 않습니다.');

    $pp['pp_name'] = $od['od_name'];

    if($od['od_misu'] > 0)
        $pp['pp_price'] = $od['od_misu'];
    $wrp_tag_st = '<div class="new_win">'.PHP_EOL.'<h1 id="new_win_title">'.$html_title.'</h1>';
    $wrp_tag_end = '</div>';

    echo '<script>
        if (typeof g5_admin_csrf_token_key === "undefined") {
            var g5_admin_csrf_token_key = "' . (function_exists('admin_csrf_token_key') ? admin_csrf_token_key() : '') . '";
        }
    </script>';
}

/**
 * 탭메뉴
 */
$pg_anchor = array(
    'anc_spp_info' => '주문 정보',
    'anc_spp_pay' => '결제 정보',
);

/**
 * pg 설정 필드 추가
 */
if(!sql_query(" select pp_pg from {$g5['g5_shop_personalpay_table']} limit 1 ", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_personalpay_table']}`
                    ADD `pp_pg` varchar(255) NOT NULL DEFAULT '' AFTER `pp_price` ", true);

    // 개인결제 PG kcp로 설정
    sql_query(" update {$g5['g5_shop_personalpay_table']} set pp_pg = 'kcp' ");
}

/**
 * 현금영수증 필드 추가
 */
if(!sql_query(" select pp_cash from {$g5['g5_shop_personalpay_table']} limit 1 ", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_personalpay_table']}`
                    ADD `pp_cash` tinyint(4) NOT NULL DEFAULT '0' AFTER `pp_shop_memo`,
                    ADD `pp_cash_no` varchar(255) NOT NULL DEFAULT '' AFTER `pp_cash`,
                    ADD `pp_cash_info` text NOT NULL AFTER `pp_cash_no`,
                    ADD `pp_email` varchar(255) NOT NULL DEFAULT '' AFTER `pp_name`,
                    ADD `pp_hp` varchar(255) NOT NULL DEFAULT '' AFTER `pp_email`,
                    ADD `pp_casseqno` varchar(255) NOT NULL DEFAULT '' AFTER `pp_app_no` ", true);
}

if (!$wmode) {
    $is_cash_receipt = true;

    // 주문내역이 있으면 현금영수증 발급하지 않음
    if($pp['od_id']) {
        $sql = " select count(od_id) as cnt from {$g5['g5_shop_order_table']} where od_id = '{$pp['od_id']}' ";
        $row = sql_fetch($sql);

        if($row['cnt'] > 0)
            $is_cash_receipt = false;
    }

    if ($is_cash_receipt && ($pp['pp_price'] - $pp['pp_receipt_price']) == 0) {
        if ($pp['pp_receipt_price'] && ($pp['pp_settle_case'] == '무통장' || $pp['pp_settle_case'] == '가상계좌' || $pp['pp_settle_case'] == '계좌이체')) {
            if ($pp['pp_cash']) {
                if($pp['pp_pg'] == 'lg') {
                    require G5_SHOP_PATH.'/settle_lg.inc.php';

                    switch($pp['pp_settle_case']) {
                        case '계좌이체':
                            $trade_type = 'BANK';
                            break;
                        case '가상계좌':
                            $trade_type = 'CAS';
                            break;
                        default:
                            $trade_type = 'CR';
                            break;
                    }
                    $cash_receipt_script = 'javascript:showCashReceipts(\''.$LGD_MID.'\',\''.$pp['pp_id'].'\',\''.$pp['pp_casseqno'].'\',\''.$trade_type.'\',\''.$CST_PLATFORM.'\');';
                } else if($pp['pp_pg'] == 'inicis') {
                    $cash = unserialize($pp['pp_cash_info']);
                    $cash_receipt_script = 'window.open(\'https://iniweb.inicis.com/DefaultWebApp/mall/cr/cm/Cash_mCmReceipt.jsp?noTid='.$cash['TID'].'&clpaymethod=22\',\'showreceipt\',\'width=380,height=540,scrollbars=no,resizable=no\');';
                } else {
                    require G5_SHOP_PATH.'/settle_kcp.inc.php';

                    $cash = unserialize($pp['pp_cash_info']);
                    $cash_receipt_script = 'window.open(\''.G5_CASH_RECEIPT_URL.$default['de_kcp_mid'].'&orderid='.$pp_id.'&bill_yn=Y&authno='.$cash['receipt_no'].'\', \'taxsave_receipt\', \'width=360,height=647,scrollbars=0,menus=0\');';
                }

                $cash_receipt_text = "현금영수증 확인";
            } else {
                $cash_receipt_script = "window.open('".G5_SHOP_URL."/taxsave.php?tx=personalpay&od_id=".$pp_id."', 'taxsave', 'width=550,height=400,scrollbars=1,menus=0');";
                $cash_receipt_text = "현금영수증 발급";
            }
            $cash_receipt = true;
        }
    }
}

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">';
$frm_submit .= !$wmode ? ' <a href="' . G5_ADMIN_URL . '/?dir=shop&amp;pid=personalpaylist&amp;'.$qstr.'" class="btn-e btn-e-lg btn-e-dark">목록</a> ':'';
$frm_submit .= $w == 'u' ? ' <a href="' . G5_ADMIN_URL . '/?dir=shop&amp;pid=personalpayformupdate&amp;w=d&amp;pp_id='.$pp['pp_id'].'&amp;smode=1" onclick="delete_confirm(this);" class="btn-e btn-e-lg btn-e-dark">삭제</a> ':'';
$frm_submit .= '</div>';