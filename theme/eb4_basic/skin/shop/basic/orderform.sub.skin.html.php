<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/orderform.sub.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

require_once(G5_SHOP_PATH.'/settle_'.$default['de_pg_service'].'.inc.php');
require_once(G5_SHOP_PATH.'/settle_kakaopay.inc.php');

if( $default['de_inicis_lpay_use'] || $default['de_inicis_kakaopay_use'] ){   //이니시스 Lpay 또는 이니시스 카카오페이 사용시
    require_once(G5_SHOP_PATH.'/inicis/lpay_common.php');
}

if(function_exists('is_use_easypay') && is_use_easypay('global_nhnkcp')){  // 타 PG 사용시 NHN KCP 네이버페이 사용이 설정되어 있다면
    require_once(G5_SHOP_PATH.'/kcp/global_nhn_kcp.php');
}

/**
 * 결제대행사별 코드 include (스크립트 등)
 */
require_once(G5_SHOP_PATH.'/'.$default['de_pg_service'].'/orderform.1.php');

if( $default['de_inicis_lpay_use'] || $default['de_inicis_kakaopay_use'] ){   //이니시스 L.pay 사용시
    require_once(G5_SHOP_PATH.'/inicis/lpay_form.1.php');
}

if(function_exists('is_use_easypay') && is_use_easypay('global_nhnkcp')){  // 타 PG 사용시 NHN KCP 네이버페이 사용이 설정되어 있다면
    require_once(G5_SHOP_PATH.'/kcp/global_nhn_kcp_form.1.php');
}

if($is_kakaopay_use) {
    require_once(G5_SHOP_PATH.'/kakaopay/orderform.1.php');
}
?>

<style>
.shop-steps {position:relative;margin-bottom:30px}
.shop-steps .step-indicator {border-collapse:separate;display:table;margin-left:0;position:relative;table-layout:fixed;vertical-align:middle}
.shop-steps .step-indicator li {display:table-cell;float:none;padding:0;width:1%}
.shop-steps .step-indicator li:before {background-color:#d5d5d5;content:"";display:block;height:1px;position:relative;top:40px}
.shop-steps .step-indicator li:first-child:before {left:50%}
.shop-steps .step-indicator li:last-child:before {right:50%}
.shop-steps .step-indicator .step {background-color:#fff;border:5px solid #e5e5e5;color:#e5e5e5;font-size:1.875rem;width:80px;height:80px;line-height:70px;border-radius:50% !important;margin:0 auto;position:relative;z-index:1}
.shop-steps .step-indicator .caption {box-sizing:border-box;color:#e5e5e5;padding:10px 5px;font-size:.9375rem;font-weight:700}
.shop-steps .step-indicator .active .step {border-color:#252525;color:#252525}
.shop-steps .step-indicator .active .caption {color:#252525}
.shop-steps .step-indicator .complete .step {border-color:#b5b5b5;color:#b5b5b5}
.shop-steps .step-indicator .complete .caption {color:#b5b5b5}
.shop-steps .step-indicator .incomplete .step {border-color:#b5b5b5;color:#b5b5b5}
.shop-steps .step-indicator .incomplete .caption {color:#b5b5b5}
.shop-steps .step-indicator .inactive .caption {color:#b5b5b5}
.shop-steps .alarm-marker .alarm-point {top:15px;right:15px}
.shop-steps .alarm-marker .alarm-effect {top:5px;right:5px}
.shop-cart .shop-cart-li-wrap, .shop-cart .table-list-eb .td-item-name ul, .shop-cart .shop-cart-li-wrap .li-opt ul {padding:0;list-style:none}
@media (max-width:576px) {
    .shop-steps .step-indicator li:before {top:30px}
    .shop-steps .step-indicator .step {border:3px solid #e5e5e5;font-size:20px;width:60px;height:60px;line-height:54px}
    .shop-steps .step-indicator .caption {font-size:.875rem}
    .shop-steps .alarm-marker .alarm-point {top:10px;right:10px}
    .shop-steps .alarm-marker .alarm-effect {top:0px;right:0px}
}
.shop-order-form {font-size:.9375rem}
.shop-order-form .table-list-eb .table {border-bottom:1px solid #e5e5e5;margin-bottom:0;white-space:nowrap}
.shop-order-form .table-list-eb .td-item-desc {position:relative;min-height:80px}
.shop-order-form .table-list-eb .td-image {position:absolute;top:0;left:0;width:80px;height:80px;overflow:hidden}
.shop-order-form .table-list-eb .td-image img {display:block;max-width:100%;height:auto}
.shop-order-form .table-list-eb .td-item-name {margin-left:95px}
.sod_opt {padding:0;margin:0}
.shop-order-form .table-list-eb .td-item-name .sod_opt ul {list-style:none;padding:0;margin:5px 0}
.shop-order-form .table-list-eb .td-item-name .sod_opt ul li {color:#757575;background:none;line-height:1.5;padding:0;font-weight:normal}
.sod_opt li:before {display:none}
.shop-order-form .table-list-eb .td-item-name .cp_btn {margin-top:5px;margin-right:2px}
.shop-order-form .table-list-eb .td-item-name .cp_cancel {margin-top:5px}
.shop-order-form .order-member-payment {position:relative;border:1px solid #e5e5e5}
.shop-order-form .order-member-area {position:relative;margin-right:370px}
.shop-order-form .order-member-area .sod-frm-title {position:relative;height:70px;margin:-30px -15px 30px;padding:25px 20px;border-bottom:1px solid #e5e5e5;background:#fafafa}
.shop-order-form .order-member-area .sod-frm-title h4 {font-size:1.25rem;line-height:1}
.shop-order-form .order-member-area .sod-frm-title h4:after {content:"";display:block;position:absolute;top:-1px;left:-1px;width:0;height:0;border-top:20px solid #5c6bc0;border-right:20px solid transparent}
.shop-order-form .order-member-area .sod-frm-orderer {padding:30px 15px 40px;border-bottom:1px solid #e5e5e5}
.shop-order-form .order-member-area .sod-frm-taker {padding:30px 15px 40px}
.shop-order-form .order-table {margin:0}
.shop-order-form .order-table table {width:100%;border-collapse:collapse;border-spacing:0}
.shop-order-form .order-table th {width:100px;padding:5px 10px;background:none;text-align:right}
.shop-order-form .order-table td {padding:5px 10px;background:transparent}
.shop-order-form .order-table textarea {width:100%;height:100px}
.shop-order-form .order-table a {text-decoration:none}
.shop-order-form .order-payment-area {position:absolute;top:0;right:0;width:370px;height:100%;border-left:1px solid #e5e5e5;background:#fafafa;padding:20px 15px}
.shop-order-form .order-payment-total {margin-bottom:20px}
.shop-order-form .payment-calc-wrap {position:relative;overflow:hidden;clear:both;border:1px solid #e5e5e5;background:#fff}
.shop-order-form .payment-calc-box {position:relative;float:left;width:33.33333%;text-align:center;padding:20px 0;color:#757575}
.shop-order-form .payment-calc-box span {display:block;margin-bottom:10px}
.shop-order-form .payment-calc-box strong {color:#000}
.shop-order-form .payment-calc-box:before {content:"";width:1px;height:100%;background:#f0f0f0;position:absolute;top:0;right:0}
.shop-order-form .payment-calc-box:last-child:before {display:none}
.shop-order-form .payment-calc-box:nth-child(1):after {font-family:'Font Awesome\ 5 Free';content:"\f068";font-weight:900;color:#ab0000;font-size:.8125rem;text-align:center;width:24px;height:24px;line-height:24px;border:1px solid #e5e5e5;background:#fff;position:absolute;top:50%;right:-12px;margin-top:-12px;z-index:1}
.shop-order-form .payment-calc-box:nth-child(2):after {font-family:'Font Awesome\ 5 Free';content:"\f067";font-weight:900;color:#ab0000;font-size:.8125rem;text-align:center;width:24px;height:24px;line-height:24px;border:1px solid #e5e5e5;background:#fff;position:absolute;top:50%;right:-12px;margin-top:-12px;z-index:1}
.shop-order-form .payment-point-box {position:relative;overflow:hidden;clear:both;padding:10px 15px;border:1px solid #e5e5e5;border-top:0;background:#fff;text-align:right;color:#757575}
.shop-order-form .payment-point-box span {float:left}
.shop-order-form .payment-point-box strong {color:#000}
.shop-order-form .payment-total-box {position:relative;overflow:hidden;clear:both;padding:10px 15px;border:1px solid #e5e5e5;border-top:0;background:#fff;text-align:right;color:#757575}
.shop-order-form .payment-total-box span {float:left}
.shop-order-form .payment-total-box strong {color:#ab0000}
.shop-order-form .order-payment-info {margin-bottom:20px}
.shop-order-form .order-payment-info h2 {position:absolute;border:0;font-size:0;line-height:0;content:""}
.shop-order-form .payment-info-box {position:relative;clear:both;padding:10px 15px;border:1px solid #e5e5e5;margin-top:-1px;background:#fff;text-align:right;color:#757575}
.shop-order-form .payment-info-box.border-color-red {border-color:#ab0000}
.shop-order-form .payment-info-box span {float:left}
.shop-order-form .payment-info-box strong {color:#000}
.shop-order-form .payment-info-box .cp_cancel {margin-left:3px;height:inherit;}
.shop-order-form #od_tot_price {position:relative;overflow:hidden;clear:both;padding:10px 15px;margin:0;text-align:right;line-height:inherit;background:#fff}
.shop-order-form #od_tot_price span {line-height:30px}
.shop-order-form #od_tot_price .print_price {color:#ab0000;font-size:1.25rem}
.shop-order-form .payment-select-wrap {position:relative;margin-top:20px}
.shop-order-form .payment-select-title {margin:0 0 10px;font-size:1.125rem}
.shop-order-form .payment-select-wrap #sod_frm_paysel {padding:0 0 0 2px;background:none;border:0 none}
.shop-order-form .payment-select-wrap input[type="radio"] {position:absolute;width:0;height:0;overflow:hidden;visibility:hidden;text-indent:-999px;left:0;z-index:-1px}
.shop-order-form .payment-select-wrap .payment-select-box {position:relative;overflow:hidden;float:left;width:50% !important;background:#fff;cursor:pointer;font-size:.875rem;height:60px;box-sizing:border-box;border:1px solid #e5e5e5;margin:-1px 0 0 -1px;padding:20px 5px 0 70px !important;text-indent:inherit !important}
.shop-order-form .payment-select-wrap .payment-select-box.inicis_kakaopay {padding:9px 5px 0 70px !important}
.shop-order-form .payment-select-wrap input[type="radio"]:checked+.payment-select-box {border:1px solid #ab0000;z-index:3}
.shop-order-form .payment-select-wrap input[type="radio"]:checked+.payment-select-box:after {font-family:'Font Awesome\ 5 Free';content:"\f00c";font-weight:900;position:absolute;top:2px;right:5px;color:#ab0000;font-size:1rem}
.shop-order-form .payment-select-wrap #sod_frm_paysel .bank_icon {background:#fff}
.shop-order-form .payment-select-wrap #sod_frm_paysel .bank_icon:before {font-family:'Font Awesome\ 5 Free';content:"\f53c";font-weight:900;position:absolute;top:5px;left:5px;width:48px;height:48px;line-height:48px;text-align:center;color:#b5b5b5;font-size:20px}
.shop-order-form .payment-select-wrap #sod_frm_paysel .vbank_icon {background:#fff}
.shop-order-form .payment-select-wrap #sod_frm_paysel .vbank_icon:before {font-family:'Font Awesome\ 5 Free';content:"\f2c2";font-weight:900;position:absolute;top:5px;left:5px;width:48px;height:48px;line-height:48px;text-align:center;color:#b5b5b5;font-size:20px}
.shop-order-form .payment-select-wrap #sod_frm_paysel .iche_icon {background:#fff}
.shop-order-form .payment-select-wrap #sod_frm_paysel .iche_icon:before {font-family:'Font Awesome\ 5 Free';content:"\f53c";font-weight:900;position:absolute;top:5px;left:5px;width:48px;height:48px;line-height:48px;text-align:center;color:#b5b5b5;font-size:20px}
.shop-order-form .payment-select-wrap #sod_frm_paysel .hp_icon {background:#fff}
.shop-order-form .payment-select-wrap #sod_frm_paysel .hp_icon:before {font-family:'Font Awesome\ 5 Free';content:"\f3cd";font-weight:900;position:absolute;top:5px;left:5px;width:48px;height:48px;line-height:48px;text-align:center;color:#b5b5b5;font-size:20px}
.shop-order-form .payment-select-wrap #sod_frm_paysel .card_icon {background:#fff}
.shop-order-form .payment-select-wrap #sod_frm_paysel .card_icon:before {font-family:'Font Awesome\ 5 Free';content:"\f09d";font-weight:900;position:absolute;top:5px;left:5px;width:48px;height:48px;line-height:48px;text-align:center;color:#b5b5b5;font-size:20px}
.shop-order-form .payment-select-wrap #sod_frm_paysel .kakaopay_icon {background:#fff;background-image:url("<?php echo EYOOM_THEME_URL .'/skin/shop/'.$eyoom['shop_skin']; ?>/img/kakaopay.jpg");background-repeat:no-repeat;background-position:5px 5px;background-size:48px 48px}
.shop-order-form .payment-select-wrap #sod_frm_paysel .PAYNOW {background:#fff;background-image:url("<?php echo EYOOM_THEME_URL .'/skin/shop/'.$eyoom['shop_skin']; ?>/img/paynow.jpg");background-repeat:no-repeat;background-position:5px 5px;background-size:48px 48px}
.shop-order-form .payment-select-wrap #sod_frm_paysel .KPAY {background:#fff;background-image:url("<?php echo EYOOM_THEME_URL .'/skin/shop/'.$eyoom['shop_skin']; ?>/img/kpay.jpg");background-repeat:no-repeat;background-position:5px 5px;background-size:48px 48px}
.shop-order-form .payment-select-wrap #sod_frm_paysel .PAYCO {background:#fff;background-image:url("<?php echo EYOOM_THEME_URL .'/skin/shop/'.$eyoom['shop_skin']; ?>/img/payco.jpg");background-repeat:no-repeat;background-position:5px 5px;background-size:48px 48px}
.shop-order-form .payment-select-wrap #sod_frm_paysel .inicis_lpay {background:#fff;background-image:url("<?php echo EYOOM_THEME_URL .'/skin/shop/'.$eyoom['shop_skin']; ?>/img/lpay.jpg");background-repeat:no-repeat;background-position:5px 5px;background-size:48px 48px}
.shop-order-form .payment-select-wrap #sod_frm_paysel .inicis_kakaopay {background:#fff;background-image:url("<?php echo EYOOM_THEME_URL .'/skin/shop/'.$eyoom['shop_skin']; ?>/img/kakaopay.jpg");background-repeat:no-repeat;background-position:5px 5px;background-size:48px 48px}
.shop-order-form .payment-select-wrap #sod_frm_paysel .naverpay_icon {background:#fff;background-image:url("<?php echo EYOOM_THEME_URL .'/skin/shop/'.$eyoom['shop_skin']; ?>/img/naverpay.jpg");background-repeat:no-repeat;background-position:5px 5px;background-size:48px 48px}
.shop-order-form .payment-select-wrap #sod_frm_paysel .samsungpay_icon {background:#fff;background-image:url("<?php echo EYOOM_THEME_URL .'/skin/shop/'.$eyoom['shop_skin']; ?>/img/samsungpay.jpg");background-repeat:no-repeat;background-position:5px 5px;background-size:48px 48px}
.shop-order-form .payment-select-wrap #sod_frm_paysel .paycopay_icon {background:#fff;background-image:url("<?php echo EYOOM_THEME_URL .'/skin/shop/'.$eyoom['shop_skin']; ?>/img/payco.jpg");background-repeat:no-repeat;background-position:5px 5px;background-size:48px 48px}
.shop-order-form .payment-select-wrap #sod_frm_paysel .skpay_icon {background:#fff;background-image:url("<?php echo EYOOM_THEME_URL .'/skin/shop/'.$eyoom['shop_skin']; ?>/img/skpay.jpg");background-repeat:no-repeat;background-position:5px 5px;background-size:48px 48px}
.shop-order-form .payment-select-wrap #sod_frm_paysel .ssgpay_icon {background:#fff;background-image:url("<?php echo EYOOM_THEME_URL .'/skin/shop/'.$eyoom['shop_skin']; ?>/img/ssgpay.jpg");background-repeat:no-repeat;background-position:5px 5px;background-size:48px 48px}
.shop-order-form .payment-select-wrap #sod_frm_paysel .lpay_icon {background:#fff;background-image:url("<?php echo EYOOM_THEME_URL .'/skin/shop/'.$eyoom['shop_skin']; ?>/img/lpay.jpg");background-repeat:no-repeat;background-position:5px 5px;background-size:48px 48px}
#display_pay_button {background:none;padding:0;border:0 none}
.shop-order-form #display_pay_button .btn_submit {display:block;width:100%;height:46px;line-height:46px;padding:0;background:#3f4678;color:#fff;font-size:.9375rem;font-weight:700;letter-spacing:0;border:0;margin-bottom:15px}
.shop-order-form #display_pay_button a.btn01 {display:block;width:100%;height:46px;line-height:46px;padding:0;background:#fff;color:#757575;font-size:.9375rem;font-weight:700;letter-spacing:0;border:1px solid #d5d5d5}
#settle_bank label {float:none;width:auto;line-height:inherit}
.shop-order-form .payment-point-use-box {margin-top:20px}
.shop-order-form .payment-point-use {position:relative;overflow:hidden;clear:both;padding:10px 15px;border:1px solid #e5e5e5;margin-top:-1px;background:#fff;color:#757575}
.shop-order-form .payment-point-use label {line-height:30px;margin-bottom:0}
.shop-order-form .payment-point-use .input {margin-bottom:0}
.shop-order-form #settle_bank {position:relative;padding:15px;border:1px solid #ab0000;margin:20px 0 0;display:none}
.shop-order-form #settle_bank .select {margin-bottom:10px}
#settle_bank select {width:100%;height:38px;border:1px solid #ccc}
.shop-order-form #settle_bank .input {margin-bottom:0}
.shop-order-form #settle_bank #od_deposit_name {width:100%;height:38px;text-align:left;border:1px solid #ccc}
/* Datepicker CSS 수정 */
.ui-datepicker {width:260px}
.ui-datepicker td span, .ui-datepicker td a {padding:inherit;text-align:inherit;line-height:25px}
.ui-widget-header {border:0;border-bottom:1px solid #c5c5c5 !important;background:#e5e5e5}
.ui-widget-content .ui-state-default {border:inherit;background:none}
.ui-datepicker .ui-datepicker-buttonpane button {margin:10px 0 0;padding:5px 15px;border:0;background:#171C29;color:#fff}
.ui-datepicker .ui-datepicker-buttonpane button:hover {background:#1F263B !important}
.ui-datepicker .ui-datepicker-prev:hover, .ui-datepicker .ui-datepicker-next:hover {border:0}
@media (max-width:991px) {
    .shop-order-form .order-member-area {margin-right:0}
    .shop-order-form .order-table th {width:70px !important;text-align:left;padding:5px 0;display:none}
    .shop-order-form .order-table td {padding:5px 0}
    .shop-order-form .order-payment-area {position:relative;top:inherit;right:inherit;width:100%;height:auto;border-left:0;border-top:1px solid #e5e5e5;background:#fafafa}
}
@media (min-width:992px) and (max-width:1199px){
    .gnb-wrap .gnb .gnb-nav > li {padding-right:10px;}
    .gnb-wrap .gnb .gnb-nav > li > a {font-size:var(--small-font-size);}
}
/* 쿠폰 선택 테이블 */
.shop-order-form .payment-info-box .od_coupon h3 {padding: 0 10px;margin: 10px 0 7px;line-height: 35px;font-size: 13px;color:#fff;background:#333;}
.shop-order-form .payment-info-box .od_coupon .btn_close {top: 45px;right: 15px;width: 35px;height: 35px;color:#ddd;border:0 none;}
.shop-order-form .payment-info-box .od_coupon .btn_close:hover {color:#fff;background:transparent;}
.shop-order-form .payment-info-box .od_coupon .tbl_head02 {margin: 0;}
.shop-order-form .payment-info-box #sc_coupon_frm table thead th,
.shop-order-form .payment-info-box #sc_coupon_frm table tbody td {font-size: 12px;text-align: center;}
.shop-order-form .payment-info-box #sc_coupon_frm a.btn_frmline,
.shop-order-form .payment-info-box #sc_coupon_frm button.btn_frmline {width:auto;height:inherit;padding:4px 10px;font-size: 12px;}
/* KG이니시스 팝업창과 부트스트랩 모달과의 충돌로 팝업 출력 버그 해결 소스 */
#inicisModalDiv {opacity:1 !important}
</style>

<div class="shop-steps">
    <ol class="list-inline text-center step-indicator">
        <li class="complete">
            <div class="step"><span class="fas fa-hand-pointer"></span></div>
            <div class="caption">상품선택</div>
        </li>
        <li class="complete">
            <div class="step"><i class="fas fa-shopping-basket"></i></div>
            <div class="caption">장바구니</div>
        </li>
        <li class="active">
            <div class="step">
                <div class="alarm-marker">
                    <span class="alarm-effect"></span>
                    <span class="alarm-point"></span>
                </div>
                <i class="fas fa-credit-card"></i>
            </div>
            <div class="caption">주문/결제</div>
        </li>
        <li class="incomplete">
            <div class="step"><i class="fas fa-check"></i></div>
            <div class="caption">주문완료</div>
        </li>
    </ol>
</div>

<form name="forderform" id="forderform" method="post" action="<?php echo $order_action_url; ?>" autocomplete="off" class="eyoom-form">
<div class="shop-order-form">
    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <div class="table-list-eb m-b-30">
        <div class="table-responsive">
            <table id="sod_list" class="table">
                <thead>
                    <tr>
                        <th>상품명</th>
                        <th class="width-100px tbd-both">총수량</th>
                        <th class="width-100px">판매가</th>
                        <th class="width-100px tbd-both">소계</th>
                        <th class="width-100px tbd-r">포인트</th>
                        <th class="width-100px">배송비</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($sod_count > 0) { ?>
                    <?php for ($i=0; $i<$sod_count; $i++) { ?>
                    <tr>
                        <td>
                            <div class="td-item-desc">
                                <div class="td-image"><?php echo $list[$i]['image']; ?></div>
                                <div class="td-item-name">
                                    <input type="hidden" name="it_id[<?php echo $i; ?>]"    value="<?php echo $list[$i]['it_id']; ?>">
                                    <input type="hidden" name="it_name[<?php echo $i; ?>]"  value="<?php echo get_text($list[$i]['it_name']); ?>">
                                    <input type="hidden" name="it_price[<?php echo $i; ?>]" value="<?php echo $list[$i]['sell_price']; ?>">
                                    <input type="hidden" name="cp_id[<?php echo $i; ?>]" value="">
                                    <input type="hidden" name="cp_price[<?php echo $i; ?>]" value="0">
                                    <?php if($default['de_tax_flag_use']) { ?>
                                    <input type="hidden" name="it_notax[<?php echo $i; ?>]" value="<?php echo $list[$i]['it_notax']; ?>">
                                    <?php } ?>
                                    <div><?php echo $list[$i]['it_name']; ?></div>
                                    <?php if ($list[$i]['cp_count']) { ?>
                                    <button type="button" class="btn-e btn-e-dark cp_btn" data-bs-toggle="modal" data-bs-target="#modal_coupon_apply">쿠폰적용</button>
                                    <?php } ?>
                                </div>
                            </div>
                        </td>
                        <td class="text-center tbd-both"><?php echo number_format($list[$i]['sum_qty']); ?></td>
                        <td class="text-center"><?php echo number_format($list[$i]['ct_price']); ?></td>
                        <td class="text-center tbd-both"><span class="total_price"><?php echo number_format($list[$i]['sell_price']); ?></span></td>
                        <td class="text-center tbd-r"><?php echo number_format($list[$i]['point']); ?></td>
                        <td class="text-center"><?php echo $list[$i]['ct_send_cost']; ?></td>
                    </tr>
                    <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="order-member-payment">
        <div class="order-member-area">
            <input type="hidden" name="od_price" value="<?php echo $tot_sell_price; ?>">
            <input type="hidden" name="org_od_price" value="<?php echo $tot_sell_price; ?>">
            <input type="hidden" name="od_send_cost" value="<?php echo $send_cost; ?>">
            <input type="hidden" name="od_send_cost2" value="0">
            <input type="hidden" name="item_coupon" value="0">
            <input type="hidden" name="od_coupon" value="0">
            <input type="hidden" name="od_send_coupon" value="0">
            <input type="hidden" name="od_goods_name" value="<?php echo $goods; ?>">
            <?php
            // 결제대행사별 코드 include (결제대행사 정보 필드)
            require_once(G5_SHOP_PATH.'/'.$default['de_pg_service'].'/orderform.2.php');

            if($is_kakaopay_use) {
                require_once(G5_SHOP_PATH.'/kakaopay/orderform.2.php');
            }
            ?>

            <?php /* ---------- 주문하시는 분 입력 시작 ---------- */ ?>
            <div class="sod-frm-orderer">
                <div class="sod-frm-title"><h4><strong>주문하시는 분</strong></h4></div>
                <div class="order-table">
                    <table>
                        <tbody>
                            <tr>
                                <th scope="row"><label for="od_name">이름<strong class="sound_only"> 필수</strong></label></th>
                                <td>
                                    <label for="od_name" class="label hidden-lg hidden-md">이름<strong class="sound_only"> 필수</strong></label>
                                    <label class="input width-200px required-mark">
                                        <input type="text" name="od_name" value="<?php echo get_text($member['mb_name']); ?>" id="od_name" required maxlength="20">
                                    </label>
                                </td>
                            </tr>

                            <?php if (!$is_member) { // 비회원이면 ?>
                            <tr>
                                <th scope="row"><label for="od_pwd">비밀번호</label></th>
                                <td>
                                    <label for="od_pwd" class="label hidden-lg hidden-md">비밀번호<strong class="sound_only"> 필수</strong></label>
                                    <label class="input width-200px required-mark">
                                        <input type="password" name="od_pwd" id="od_pwd" required maxlength="20">
                                    </label>
                                    <div class="note">영,숫자 3~20자 (주문서 조회시 필요)</div>
                                </td>
                            </tr>
                            <?php } ?>

                            <tr>
                                <th scope="row"><label for="od_tel">전화번호<strong class="sound_only"> 필수</strong></label></th>
                                <td>
                                    <label for="od_tel" class="label hidden-lg hidden-md">전화번호<strong class="sound_only"> 필수</strong></label>
                                    <label class="input width-200px required-mark">
                                        <input type="text" name="od_tel" value="<?php echo get_text($member['mb_tel']); ?>" id="od_tel" required maxlength="20">
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="od_hp">핸드폰</label></th>
                                <td>
                                    <label for="od_hp" class="label hidden-lg hidden-md">핸드폰</label>
                                    <label class="input width-200px">
                                        <input type="text" name="od_hp" value="<?php echo get_text($member['mb_hp']); ?>" id="od_hp" maxlength="20">
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">주소</th>
                                <td>
                                    <label class="label hidden-lg hidden-md">주소</label>
                                    <label for="od_zip" class="sound_only">우편번호<strong class="sound_only"> 필수</strong></label>
                                    <div class="clearfix"></div>
                                    <label class="input width-150px m-r-5 float-start">
                                        <i class="icon-append fas fa-question-circle"></i>
                                        <input type="text" name="od_zip" value="<?php echo $member['mb_zip1'].$member['mb_zip2']; ?>" id="od_zip" required class="required" size="8" maxlength="6" placeholder="우편번호">
                                        <b class="tooltip tooltip-top-right">우편번호 (주소 검색 버튼을 클릭하여 조회)</b>
                                    </label>
                                    <button type="button" class="btn-e btn-e-lg btn-e-navy" onclick="win_zip('forderform', 'od_zip', 'od_addr1', 'od_addr2', 'od_addr3', 'od_addr_jibeon');">주소 검색</button>
                                    <div class="clearfix m-b-10"></div>
                                    <label for="od_addr1" class="sound_only">기본주소<strong class="sound_only"> 필수</strong></label>
                                    <label class="input required-mark">
                                        <input type="text" name="od_addr1" value="<?php echo get_text($member['mb_addr1']) ?>" id="od_addr1" required size="60" placeholder="기본주소">
                                    </label>
                                    <label for="od_addr2" class="sound_only">상세주소</label>
                                    <label class="input">
                                        <input type="text" name="od_addr2" value="<?php echo get_text($member['mb_addr2']) ?>" id="od_addr2" size="60" placeholder="상세주소">
                                    </label>
                                    <label for="od_addr3" class="sound_only">참고항목</label>
                                    <label class="input">
                                        <input type="text" name="od_addr3" value="<?php echo get_text($member['mb_addr3']) ?>" id="od_addr3" size="60" readonly="readonly" placeholder="참고항목">
                                    </label>
                                    <input type="hidden" name="od_addr_jibeon" value="<?php echo get_text($member['mb_addr_jibeon']); ?>">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="od_email">E-mail<strong class="sound_only"> 필수</strong></label></th>
                                <td>
                                    <label for="od_email" class="label hidden-lg hidden-md">E-mail<strong class="sound_only"> 필수</strong></label>
                                    <label class="input width-200px required-mark">
                                        <input type="text" name="od_email" value="<?php echo $member['mb_email']; ?>" id="od_email" required size="35" maxlength="100">
                                    </label>
                                </td>
                            </tr>

                            <?php if ($default['de_hope_date_use']) { // 배송희망일 사용 ?>
                            <tr>
                                <th scope="row"><label for="od_hope_date">희망배송일<strong class="sound_only"> 필수</strong></label></th>
                                <td>
                                    <label for="od_hope_date" class="label hidden-lg hidden-md">희망배송일</label>
                                    <div class="clearfix"></div>
                                    <?php if(0) { // 희망배송일 셀렉트 미사용 숨김 시작 ?>
                                    <select name="od_hope_date" id="od_hope_date">
                                    <option value="">선택하십시오.</option>
                                    <?php
                                    for ($i=0; $i<7; $i++) {
                                        $sdate = date("Y-m-d", time()+86400*($default['de_hope_date_after']+$i));
                                        echo '<option value="'.$sdate.'">'.$sdate.' ('.get_yoil($sdate).')</option>'.PHP_EOL;
                                    }
                                    ?>
                                    </select>
                                    <?php } // 희망배송일 셀렉트 미사용 숨김 끝 ?>
                                    <label class="input width-200px required-mark m-r-5 float-start">
                                        <input type="text" name="od_hope_date" value="" id="od_hope_date" required size="11" maxlength="10" readonly="readonly">
                                    </label>
                                    <span class="float-start">이후로 배송 바랍니다.</span>
                                    <div class="clearfix"></div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php /* ---------- 주문하시는 분 입력 끝 ---------- */ ?>

            <?php /* ---------- 받으시는 분 입력 시작 ---------- */ ?>
            <div class="sod-frm-taker">
                <div class="sod-frm-title"><h4><strong>받으시는 분</strong></h4></div>
                <div class="order-table">
                    <table>
                        <tbody>
                            <tr>
                                <th scope="row">배송지선택</th>
                                <td>
                                    <label class="label hidden-lg hidden-md">배송지선택</label>
                                    <div class="inline-group">
                                    <?php if ($is_member) { ?>
                                        <label for="ad_sel_addr_same" class="radio"><input type="radio" name="ad_sel_addr" value="same" id="ad_sel_addr_same"><i class="rounded-x"></i>주문자와 동일</label>
                                        <?php if ($ad_sel_addr) { ?>
                                        <label for="ad_sel_addr_def" class="radio"><input type="radio" name="ad_sel_addr" value="<?php echo $ad_sel_addr; ?>" id="ad_sel_addr_def"><i class="rounded-x"></i>기본배송지</label>
                                        <?php } ?>
                                        <?php if (is_array($latest_addr)) { ?>
                                        <?php foreach ($latest_addr as $k => $addrinfo) { ?>
                                        <label for="ad_sel_addr_<?php echo ($k+1); ?>" class="radio"><input type="radio" name="ad_sel_addr" value="<?php echo $addrinfo['val1']; ?>" id="ad_sel_addr_<?php echo ($k+1); ?>"><i class="rounded-x"></i>최근배송지(<?php echo $addrinfo['ad_subject'] ? $addrinfo['ad_subject'] : $addrinfo['ad_name']; ?>)</label>
                                        <?php } ?>
                                        <?php } ?>
                                        <label for="od_sel_addr_new" class="radio"><input type="radio" name="ad_sel_addr" value="new" id="od_sel_addr_new"><i class="rounded-x"></i>신규배송지</label>
                                        <a href="<?php echo G5_SHOP_URL; ?>/orderaddress.php" id="order_address" class="btn-e btn-e-dark">배송지목록</a>
                                    <?php } else { ?>
                                        <label for="ad_sel_addr_same" class="checkbox"><input type="checkbox" name="ad_sel_addr" value="same" id="ad_sel_addr_same"><i class="rounded-x"></i>주문자와 동일</label>
                                    <?php } ?>
                                    </div>
                                </td>
                            </tr>
                            <?php if($is_member) { ?>
                            <tr>
                                <th scope="row"><label for="ad_subject">배송지명</label></th>
                                <td>
                                    <label for="ad_subject" class="label hidden-lg hidden-md">배송지명</label>
                                    <div class="clearfix"></div>
                                    <label class="input width-200px m-r-10 float-start">
                                        <input type="text" name="ad_subject" id="ad_subject" maxlength="20">
                                    </label>
                                    <div class="position-relative float-start">
                                        <label class="checkbox">
                                            <input type="checkbox" name="ad_default" id="ad_default" value="1"><i></i>기본배송지로 설정
                                        </label>
                                    </div>
                                    <div class="clearfix"></div>
                                </td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <th scope="row"><label for="od_b_name">이름<strong class="sound_only"> 필수</strong></label></th>
                                <td>
                                    <label for="od_b_name" class="label hidden-lg hidden-md">이름<strong class="sound_only"> 필수</strong></label>
                                    <label class="input width-200px required-mark">
                                        <input type="text" name="od_b_name" id="od_b_name" required maxlength="20">
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="od_b_tel">전화번호<strong class="sound_only"> 필수</strong></label></th>
                                <td>
                                    <label for="od_b_tel" class="label hidden-lg hidden-md">전화번호<strong class="sound_only"> 필수</strong></label>
                                    <label class="input width-200px required-mark">
                                        <input type="text" name="od_b_tel" id="od_b_tel" required maxlength="20">
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="od_b_hp">핸드폰</label></th>
                                <td>
                                    <label for="od_b_hp" class="label hidden-lg hidden-md">핸드폰</label>
                                    <label class="input width-200px">
                                        <input type="text" name="od_b_hp" id="od_b_hp" maxlength="20">
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">주소</th>
                                <td id="sod_frm_addr">
                                    <label class="label hidden-lg hidden-md">주소</label>
                                    <div class="clearfix"></div>
                                    <label for="od_b_zip" class="sound_only">우편번호<strong class="sound_only"> 필수</strong></label>
                                    <label class="input width-150px m-r-5 float-start">
                                        <i class="icon-append fas fa-question-circle"></i>
                                        <input type="text" name="od_b_zip" id="od_b_zip" required class="required" size="8" maxlength="6" placeholder="우편번호">
                                        <b class="tooltip tooltip-top-right">우편번호 (주소 검색 버튼을 클릭하여 조회)</b>
                                    </label>
                                    <button type="button" class="btn-e btn-e-lg btn-e-navy" onclick="win_zip('forderform', 'od_b_zip', 'od_b_addr1', 'od_b_addr2', 'od_b_addr3', 'od_b_addr_jibeon');">주소 검색</button>
                                    <div class="clearfix m-b-10"></div>
                                    <label for="od_b_addr1" class="sound_only">기본주소<strong class="sound_only"> 필수</strong></label>
                                    <label class="input required-mark">
                                        <input type="text" name="od_b_addr1" id="od_b_addr1" size="60" placeholder="기본주소">
                                    </label>
                                    <label for="od_b_addr2" class="sound_only">상세주소</label>
                                    <label class="input">
                                        <input type="text" name="od_b_addr2" id="od_b_addr2" size="60" placeholder="상세주소">
                                    </label>
                                    <label for="od_b_addr3" class="sound_only">참고항목</label>
                                    <label class="input">
                                        <input type="text" name="od_b_addr3" id="od_b_addr3" readonly="readonly" size="60" placeholder="참고항목">
                                    </label>
                                    <input type="hidden" name="od_b_addr_jibeon" value="">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="od_memo">전하실말씀</label></th>
                                <td>
                                    <label for="od_memo" class="label hidden-lg hidden-md">전하실말씀</label>
                                    <label class="textarea">
                                        <textarea rows="3" name="od_memo" id="od_memo"></textarea>
                                    </label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php /* ---------- 받으시는 분 입력 끝 ---------- */ ?>
        </div>
        <div class="order-payment-area">
            <?php /* ---------- 주문상품 합계 시작 ---------- */ ?>
            <div class="order-payment-total">
                <div class="payment-calc-wrap">
                    <div class="payment-calc-box">
                        <span>주문</span>
                        <strong><?php echo number_format($tot_sell_price); ?></strong>원
                    </div>
                    <div class="payment-calc-box">
                        <span>쿠폰할인</span>
                        <strong id="ct_tot_coupon">0</strong>원
                    </div>
                    <div class="payment-calc-box">
                        <span>배송비</span>
                        <strong><?php echo number_format($send_cost); ?></strong>원
                    </div>
                </div>
                <div class="payment-point-box">
                    <span>포인트</span>
                    <strong><?php echo number_format($tot_point); ?></strong>점
                </div>
                <div class="payment-total-box">
                    <span>총계</span>
                    <strong id="ct_tot_price"><?php echo number_format($tot_price); ?></strong>원
                </div>
            </div>
            <?php /* ---------- 주문상품 합계 끝 ---------- */ ?>

            <?php /* ---------- 결제 정보 입력 시작 ---------- */ ?>
            <div class="order-payment-info">
                <h2>결제정보</h2>

                <?php if($oc_cnt > 0) { ?>
                <div id="sod_frm_pay" class="payment-info-box">
                    <span>주문할인</span>
                    <strong id="od_cp_price">0</strong>원
                    <input type="hidden" name="od_cp_id" value="">
                    <button type="button" id="od_coupon_btn" class="btn-e btn-e-dark m-l-5" data-bs-toggle="modal" data-bs-target="#modal_od_coupon_apply">쿠폰적용</button>
                </div>
                <?php } ?>
                <?php if($sc_cnt > 0) { ?>
                <div class="payment-info-box">
                    <span>배송비할인</span>
                    <strong id="sc_cp_price">0</strong>원
                    <input type="hidden" name="sc_cp_id" value="">
                    <button type="button" id="sc_coupon_btn" class="btn-e btn-e-dark m-l-5">쿠폰적용</button>
                </div>
                <?php } ?>
                <div class="payment-info-box">
                    <span>추가배송비</span>
                    <strong id="od_send_cost2">0</strong>원
                    <div class="f-s-13r text-gray m-t-10"><b class="text-crimson">*</b> 지역에 따라 추가되는 도선료 등의 배송비입니다.</div>
                </div>
                <div class="m-b-20"></div>
                <div id="od_tot_price" class="payment-info-box border-color-red">
                    <span class="text-black">총 주문금액</span>
                    <strong class="print_price"><?php echo number_format($tot_price); ?></strong>원
                </div>

                <div class="payment-select-wrap">
                    <h5 class="payment-select-title"><strong>결제수단</strong></h5>
                    <?php if (!$default['de_card_point']) { ?>
                    <p class="text-gray f-s-13r m-b-15"><b class="text-crimson">*</b> <strong>무통장입금</strong> 이외의 결제 수단으로 결제하시는 경우 포인트를 적립해드리지 않습니다.</p>
                    <?php } ?>

                    <?php if ($is_kakaopay_use || $default['de_bank_use'] || $default['de_vbank_use'] || $default['de_iche_use'] || $default['de_card_use'] || $default['de_hp_use'] || $default['de_easy_pay_use'] || $default['de_inicis_lpay_use'] || $default['de_inicis_kakaopay_use']) { ?>
                    <fieldset id="sod_frm_paysel">
                    <legend>결제방법 선택</legend>
                    <?php } ?>

                    <?php if($is_kakaopay_use) { $multi_settle++; // 카카오페이 ?>
                    <input type="radio" id="od_settle_kakaopay" name="od_settle_case" value="KAKAOPAY" <?php echo $checked; ?>><label for="od_settle_kakaopay" class="payment-select-box kakaopay_icon">KAKAOPAY</label>
                    <?php $checked = ''; } ?>

                    <?php if($default['de_bank_use']) { $multi_settle++; // 무통장입금 사용 ?>
                    <input type="radio" id="od_settle_bank" name="od_settle_case" value="무통장" <?php echo $checked; ?>><label for="od_settle_bank" class="payment-select-box bank_icon">무통장입금</label>
                    <?php $checked = ''; } ?>

                    <?php if($default['de_vbank_use']) { $multi_settle++; // 가상계좌 사용 ?>
                    <input type="radio" id="od_settle_vbank" name="od_settle_case" value="가상계좌" <?php echo $checked; ?>><label for="od_settle_vbank" class="payment-select-box vbank_icon"><?php echo $escrow_title; ?>가상계좌</label>
                    <?php $checked = ''; } ?>

                    <?php if($default['de_iche_use']) { $multi_settle++; // 계좌이체 사용 ?>
                    <input type="radio" id="od_settle_iche" name="od_settle_case" value="계좌이체" <?php echo $checked; ?>><label for="od_settle_iche" class="payment-select-box iche_icon"><?php echo $escrow_title; ?>계좌이체</label>
                    <?php $checked = ''; } ?>

                    <?php if($default['de_hp_use']) { $multi_settle++; // 휴대폰 사용 ?>
                    <input type="radio" id="od_settle_hp" name="od_settle_case" value="휴대폰" <?php echo $checked; ?>><label for="od_settle_hp" class="payment-select-box hp_icon">휴대폰</label>
                    <?php $checked = ''; } ?>

                    <?php if($default['de_card_use']) { $multi_settle++; // 신용카드 사용 ?>
                    <input type="radio" id="od_settle_card" name="od_settle_case" value="신용카드" <?php echo $checked; ?>><label for="od_settle_card" class="payment-select-box card_icon">신용카드</label>
                    <?php $checked = ''; } ?>

                    <?php if(isset($default['de_inicis_kakaopay_use']) && $default['de_inicis_kakaopay_use']) { $multi_settle++; // 이니시스 카카오페이  ?>
                    <input type="radio" id="od_settle_inicis_kakaopay" name="od_settle_case" value="inicis_kakaopay" <?php echo $checked; ?>><label for="od_settle_inicis_kakaopay" class="payment-select-box inicis_kakaopay">KG 이니시스 카카오페이</label>
                    <?php $checked = ''; } ?>

                    <?php
                    $easypay_prints = array();

                    // PG 간편결제
                    if($default['de_easy_pay_use']) {
                        switch($default['de_pg_service']) {
                            case 'lg':
                                $pg_easy_pay_name = 'PAYNOW';
                                break;
                            case 'inicis':
                                $pg_easy_pay_name = 'KPAY';
                                break;
                            default:
                                $pg_easy_pay_name = 'PAYCO';
                                break;
                        }
                        $multi_settle++;

                        if(in_array($default['de_pg_service'], array('kcp', 'nicepay')) && isset($default['de_easy_pay_services']) && $default['de_easy_pay_services']) {
                            $de_easy_pay_service_array = explode(',', $default['de_easy_pay_services']);
                            if ($default['de_pg_service'] === 'kcp') {
                                if( in_array('nhnkcp_payco', $de_easy_pay_service_array) ){
                                    $easypay_prints['nhnkcp_payco'] = '<input type="radio" id="od_settle_nhnkcp_payco" name="od_settle_case" data-pay="payco" value="간편결제"> <label for="od_settle_nhnkcp_payco" class="payment-select-box PAYCO nhnkcp_payco lb_icon" title="NHN_KCP - PAYCO">PAYCO</label>';
                                }
                                if( in_array('nhnkcp_naverpay', $de_easy_pay_service_array) ){
                                    $easypay_prints['nhnkcp_naverpay'] = '<input type="radio" id="od_settle_nhnkcp_naverpay" name="od_settle_case" data-pay="naverpay" value="간편결제" > <label for="od_settle_nhnkcp_naverpay" class="payment-select-box naverpay_icon nhnkcp_naverpay lb_icon" title="NHN_KCP - 네이버페이">네이버페이</label>';
                                }
                                if( in_array('nhnkcp_kakaopay', $de_easy_pay_service_array) ){
                                    $easypay_prints['nhnkcp_kakaopay'] = '<input type="radio" id="od_settle_nhnkcp_kakaopay" name="od_settle_case" data-pay="kakaopay" value="간편결제" > <label for="od_settle_nhnkcp_kakaopay" class="payment-select-box kakaopay_icon nhnkcp_kakaopay lb_icon" title="NHN_KCP - 카카오페이">카카오페이</label>';
                                }
                            } else if ($default['de_pg_service'] === 'nicepay') {
                                if( in_array('nicepay_samsungpay', $de_easy_pay_service_array) ){
                                    $easypay_prints['nicepay_samsungpay'] = '<input type="radio" id="od_settle_nicepay_samsungpay" name="od_settle_case" data-pay="nice_samsungpay" value="간편결제"> <label for="od_settle_nicepay_samsungpay" class="payment-select-box samsungpay_icon nicepay_samsungpay lb_icon" title="NICEPAY - 삼성페이">삼성페이</label>';
                                }
                                if( in_array('nicepay_naverpay', $de_easy_pay_service_array) ){
                                    $easypay_prints['nicepay_naverpay'] = '<input type="radio" id="od_settle_nicepay_naverpay" name="od_settle_case" data-pay="nice_naverpay" value="간편결제" > <label for="od_settle_nicepay_naverpay" class="payment-select-box naverpay_icon nicepay_naverpay lb_icon" title="NICEPAY - 네이버페이">네이버페이</label>';
                                }
                                if( in_array('nicepay_kakaopay', $de_easy_pay_service_array) ){
                                    $easypay_prints['nicepay_kakaopay'] = '<input type="radio" id="od_settle_nicepay_kakaopay" name="od_settle_case" data-pay="nice_kakaopay" value="간편결제" > <label for="od_settle_nicepay_kakaopay" class="payment-select-box kakaopay_icon nicepay_kakaopay lb_icon" title="NICEPAY - 카카오페이">카카오페이</label>';
                                }
                                if( in_array('nicepay_paycopay', $de_easy_pay_service_array) ){
                                    $easypay_prints['nicepay_paycopay'] = '<input type="radio" id="od_settle_nicepay_paycopay" name="od_settle_case" data-pay="nice_paycopay" value="간편결제" > <label for="od_settle_nicepay_paycopay" class="payment-select-box paycopay_icon nicepay_paycopay lb_icon" title="NICEPAY - 페이코">페이코</label>';
                                }
                                if( in_array('nicepay_skpay', $de_easy_pay_service_array) ){
                                    $easypay_prints['nicepay_skpay'] = '<input type="radio" id="od_settle_nicepay_skpay" name="od_settle_case" data-pay="nice_skpay" value="간편결제" > <label for="od_settle_nicepay_skpay" class="payment-select-box skpay_icon nicepay_skpay lb_icon" title="NICEPAY - SK페이">SK페이</label>';
                                }
                                if( in_array('nicepay_ssgpay', $de_easy_pay_service_array) ){
                                    $easypay_prints['nicepay_ssgpay'] = '<input type="radio" id="od_settle_nicepay_ssgpay" name="od_settle_case" data-pay="nice_ssgpay" value="간편결제" > <label for="od_settle_nicepay_ssgpay" class="payment-select-box ssgpay_icon nicepay_ssgpay lb_icon" title="NICEPAY - SSGPAY">SSGPAY</label>';
                                }
                                if( in_array('nicepay_lpay', $de_easy_pay_service_array) ){
                                    $easypay_prints['nicepay_lpay'] = '<input type="radio" id="od_settle_nicepay_lpay" name="od_settle_case" data-pay="nice_lpay" value="간편결제" > <label for="od_settle_nicepay_lpay" class="payment-select-box lpay_icon nicepay_lpay lb_icon" title="NICEPAY - LPAY">LPAY</label>';
                                }
                            }    
                        } else {
                            $easypay_prints[strtolower($pg_easy_pay_name)] = '<input type="radio" id="od_settle_easy_pay" name="od_settle_case" value="간편결제"> <label for="od_settle_easy_pay" class="payment-select-box '.$pg_easy_pay_name.' lb_icon">'.$pg_easy_pay_name.'</label>';
                        }
                    }
                    if( ! isset($easypay_prints['nhnkcp_naverpay']) && function_exists('is_use_easypay') && is_use_easypay('global_nhnkcp') ){
                        $easypay_prints['nhnkcp_naverpay'] = '<input type="radio" id="od_settle_nhnkcp_naverpay" name="od_settle_case" data-pay="naverpay" value="간편결제" > <label for="od_settle_nhnkcp_naverpay" class="payment-select-box naverpay_icon nhnkcp_naverpay lb_icon" title="NHN_KCP - 네이버페이">네이버페이</label>';
                    }
    
                    if($easypay_prints) {
                        $multi_settle++;
                        echo run_replace('shop_orderform_easypay_buttons', implode(PHP_EOL, $easypay_prints), $easypay_prints, $multi_settle);
                    }     
                    ?>

                    <?php if($default['de_inicis_lpay_use']) { // 이니시스 Lpay ?>
                    <input type="radio" id="od_settle_inicislpay" data-case="lpay" name="od_settle_case" value="lpay" <?php echo $checked; ?>><label for="od_settle_inicislpay" class="payment-select-box inicis_lpay">L.pay</label>
                    <?php $checked = ''; } ?>

                    <div class="clearfix"></div>

                    <?php if ($temp_point) { // 회원이면서 포인트사용이면 ?>
                    <div class="payment-point-use-box">
                        <div class="payment-point-use">
                            <label for="od_temp_point" class="float-start">사용 포인트(<?php echo $point_unit; ?>점 단위)</label>
                            <div class="float-end width-120px">
                                <input type="hidden" name="max_temp_point" value="<?php echo $temp_point; ?>">
                                <label class="input">
                                <i class="icon-append font-style-normal">점</i>
                                <input type="text" name="od_temp_point" value="0" id="od_temp_point" size="7">
                                </label>
                            </div>
                        </div>
                        <div class="payment-point-use">
                            <strong class="float-start">보유포인트</strong><span class="float-end"><?php echo display_point($member['mb_point']); ?></span>
                            <div class="clearfix"></div>
                            <strong class="float-start">최대 사용 가능 포인트</strong><strong class="float-end text-black"><?php echo display_point($temp_point); ?></strong>
                        </div>
                    </div>
                    <?php $multi_settle++; } ?>

                    <?php if ($default['de_bank_use']) { // 무통장입금 ?>
                    <div id="settle_bank">
                        <label for="od_bank_account" class="sound_only">입금할 계좌</label>
                        <?php if (count((array)$bank_str) <= 1) { ?>
                        <input type="hidden" name="od_bank_account" value="<?php echo $bank_account; ?>"> <?php echo $bank_account; ?>
                        <?php } else { ?>
                        <label class="select">
                            <select name="od_bank_account" id="od_bank_account">
                                <option value="">선택하십시오.</option>
                                <?php foreach ($bank_account as $bank_account) { ?>
                                <option value="<?php echo $bank_account['bank']; ?>"><?php echo $bank_account['bank']; ?></option>
                                <?php } ?>
                            </select>
                            <i></i>
                        </label>
                        <?php } ?>
                        <div class="clearfix m-b-10"></div>
                        <label for="od_deposit_name">입금자명</label>
                        <label class="input">
                            <input type="text" name="od_deposit_name" id="od_deposit_name" size="10" maxlength="20">
                        </label>
                    </div>
                    <?php } ?>

                    <?php if ($is_kakaopay_use || $default['de_bank_use'] || $default['de_vbank_use'] || $default['de_iche_use'] || $default['de_card_use'] || $default['de_hp_use'] || $default['de_easy_pay_use'] || $default['de_inicis_lpay_use'] || $default['de_inicis_kakaopay_use'] ) { ?>
                    </fieldset>
                    <?php } ?>

                    <?php if ($multi_settle == 0) { ?>
                    <p>결제할 방법이 없습니다.<br>운영자에게 알려주시면 감사하겠습니다.</p>
                    <?php } ?>
                </div>
            </div>
            <?php /* ---------- 결제 정보 입력 끝 ---------- */ ?>

            <?php
            // 결제대행사별 코드 include (주문버튼)
            require_once(G5_SHOP_PATH.'/'.$default['de_pg_service'].'/orderform.3.php');

            if($is_kakaopay_use) {
                require_once(G5_SHOP_PATH.'/kakaopay/orderform.3.php');
            }
            ?>

            <?php
            if ($default['de_escrow_use']) {
                // 결제대행사별 코드 include (에스크로 안내)
                require_once(G5_SHOP_PATH.'/'.$default['de_pg_service'].'/orderform.4.php');
            }
            ?>
        </div>
    </div>
</div>

</form>

<div id="modal_coupon_apply" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-s-20r"><strong>쿠폰 선택</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<div id="modal_od_coupon_apply" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-s-20r"><strong>쿠폰 선택</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<?php
if( $default['de_inicis_lpay_use'] || $default['de_inicis_kakaopay_use'] ){   //이니시스 L.pay 또는 이니시스 카카오페이 사용시
    require_once(G5_SHOP_PATH.'/inicis/lpay_order.script.php');
}

if(function_exists('is_use_easypay') && is_use_easypay('global_nhnkcp')){  // 타 PG 사용시 NHN KCP 네이버페이 사용이 설정되어 있다면
    require_once(G5_SHOP_PATH.'/kcp/global_nhn_kcp_order.script.php');
}
?>
<script>
window.closeCouponModal = function(){
    $('#modal_coupon_apply').modal('hide');
    $('#modal_od_coupon_apply').modal('hide');
};

var zipcode = "";
var form_action_url = "<?php echo $order_action_url; ?>";

function od_coupon_close(){
    var $coupon_frm = jQuery("#od_coupon_frm");
    if ( $coupon_frm.parent(".od_coupon_wrap").length ){
        $coupon_frm.parent(".od_coupon_wrap").remove();
    } else {
        $coupon_frm.remove();
    }
}

function cp_form_close(){
    var $cp_frm = jQuery("#cp_frm");
    if ( $cp_frm.parent(".od_coupon_wrap").length ){
        $cp_frm.parent(".od_coupon_wrap").remove();
    } else {
        $cp_frm.remove();
    }
}

$(function() {
    var $cp_btn_el;
    var $cp_row_el;

    $(".cp_btn").click(function() {
        $cp_btn_el = $(this);
        $cp_row_el = $(this).closest("tr");
        cp_form_close();
        var it_id = $cp_btn_el.closest("tr").find("input[name^=it_id]").val();

        $.post(
            "./orderitemcoupon.php",
            { it_id: it_id,  sw_direct: "<?php echo $sw_direct; ?>" },
            function(data) {
                $("#modal_coupon_apply .modal-body").html(data);
            }
        );
    });

	$(document).on("click", "#cp_close", function() {
        $(".od_coupon, .od_coupon_wrap").remove();
    });

    $(document).on("click", ".cp_apply", function() {
        var $el = $(this).closest("tr");
        var cp_id = $el.find("input[name='f_cp_id[]']").val();
        var price = $el.find("input[name='f_cp_prc[]']").val();
        var subj = $el.find("input[name='f_cp_subj[]']").val();
        var sell_price;

        if(parseInt(price) == 0) {
            if(!confirm(subj+"쿠폰의 할인 금액은 "+price+"원입니다.\n쿠폰을 적용하시겠습니까?")) {
                return false;
            }
        }

        // 이미 사용한 쿠폰이 있는지
        var cp_dup = false;
        var cp_dup_idx;
        var $cp_dup_el;
        $("input[name^=cp_id]").each(function(index) {
            var id = $(this).val();

            if(id == cp_id) {
                cp_dup_idx = index;
                cp_dup = true;
                $cp_dup_el = $(this).closest("tr");;

                return false;
            }
        });

        if(cp_dup) {
            var it_name = $("input[name='it_name["+cp_dup_idx+"]']").val();
            if(!confirm(subj+ "쿠폰은\n"+it_name+"에 사용되었습니다.\n"+it_name+"의 쿠폰을 취소한 후 적용하시겠습니까?")) {
                return false;
            } else {
                coupon_cancel($cp_dup_el);
                cp_form_close();
                $cp_dup_el.find(".cp_btn").text("쿠폰적용").focus();
                $cp_dup_el.find(".cp_cancel").remove();
            }
        }

        var $s_el = $cp_row_el.find(".total_price");;
        sell_price = parseInt($cp_row_el.find("input[name^=it_price]").val());
        sell_price = sell_price - parseInt(price);
        if(sell_price < 0) {
            alert("쿠폰할인금액이 상품 주문금액보다 크므로 쿠폰을 적용할 수 없습니다.");
            return false;
        }
        $s_el.text(number_format(String(sell_price)));
        $cp_row_el.find("input[name^=cp_id]").val(cp_id);
        $cp_row_el.find("input[name^=cp_price]").val(price);

        calculate_total_price();
        cp_form_close();
        $cp_btn_el.text("쿠폰변경").focus();
        if(!$cp_row_el.find(".cp_cancel").length)
            $cp_btn_el.after("<button type=\"button\" class=\"btn-e btn-e-gray cp_cancel\">취소</button>");
    });

    $(document).on("click", ".cp-close", function() {
        cp_form_close();
        $cp_btn_el.focus();
    });

    $(document).on("click", ".cp_cancel", function() {
        coupon_cancel($(this).closest("tr"));
        calculate_total_price();
        cp_form_close();
        $(this).closest("tr").find(".cp_btn").text("쿠폰적용").focus();
        $(this).remove();
    });

    $("#od_coupon_btn").click(function() {
        if( $("#od_coupon_frm").parent(".od_coupon_wrap").length ){
            $("#od_coupon_frm").parent(".od_coupon_wrap").remove();
        }
        od_coupon_close();
        var $this = $(this);
        var price = parseInt($("input[name=org_od_price]").val()) - parseInt($("input[name=item_coupon]").val());
        if(price <= 0) {
            alert('상품금액이 0원이므로 쿠폰을 사용할 수 없습니다.');
            return false;
        }
        $.post(
            "./ordercoupon.php",
            { price: price },
            function(data) {
                $("#modal_od_coupon_apply .modal-body").html(data);
            }
        );
    });

    $(document).on("click", ".od_cp_apply", function() {
        var $el = $(this).closest("tr");
        var cp_id = $el.find("input[name='o_cp_id[]']").val();
        var price = parseInt($el.find("input[name='o_cp_prc[]']").val());
        var subj = $el.find("input[name='o_cp_subj[]']").val();
        var send_cost = $("input[name=od_send_cost]").val();
        var item_coupon = parseInt($("input[name=item_coupon]").val());
        var od_price = parseInt($("input[name=org_od_price]").val()) - item_coupon;

        if(price == 0) {
            if(!confirm(subj+"쿠폰의 할인 금액은 "+price+"원입니다.\n쿠폰을 적용하시겠습니까?")) {
                return false;
            }
        }

        if(od_price - price <= 0) {
            alert("쿠폰할인금액이 주문금액보다 크므로 쿠폰을 적용할 수 없습니다.");
            return false;
        }

        $("input[name=sc_cp_id]").val("");
        $("#sc_coupon_btn").text("쿠폰적용");
        $("#sc_coupon_cancel").remove();

        $("input[name=od_price]").val(od_price - price);
        $("input[name=od_cp_id]").val(cp_id);
        $("input[name=od_coupon]").val(price);
        $("input[name=od_send_coupon]").val(0);
        $("#od_cp_price").text(number_format(String(price)));
        $("#sc_cp_price").text(0);
        calculate_order_price();
        if( $("#od_coupon_frm").parent(".od_coupon_wrap").length ){
            $("#od_coupon_frm").parent(".od_coupon_wrap").remove();
        }
        od_coupon_close();
        $("#od_coupon_btn").text("쿠폰변경").focus();
        if(!$("#od_coupon_cancel").length)
            $("#od_coupon_btn").after("<button type=\"button\" id=\"od_coupon_cancel\" class=\"btn-e btn-e-gray cp_cancel\">취소</button>");
    });

    $(document).on("click", ".od-coupon-close", function() {
        if( $("#od_coupon_frm").parent(".od_coupon_wrap").length ){
            $("#od_coupon_frm").parent(".od_coupon_wrap").remove();
        }
        od_coupon_close();
        $("#od_coupon_btn").focus();
    });

    $(document).on("click", "#od_coupon_cancel", function() {
        var org_price = $("input[name=org_od_price]").val();
        var item_coupon = parseInt($("input[name=item_coupon]").val());
        $("input[name=od_price]").val(org_price - item_coupon);
        $("input[name=sc_cp_id]").val("");
        $("input[name=od_coupon]").val(0);
        $("input[name=od_send_coupon]").val(0);
        $("#od_cp_price").text(0);
        $("#sc_cp_price").text(0);
        calculate_order_price();
        if( $("#od_coupon_frm").parent(".od_coupon_wrap").length ){
            $("#od_coupon_frm").parent(".od_coupon_wrap").remove();
        }
        od_coupon_close();
        $("#od_coupon_btn").text("쿠폰적용").focus();
        $(this).remove();
        $("#sc_coupon_btn").text("쿠폰적용");
        $("#sc_coupon_cancel").remove();
    });

    $("#sc_coupon_btn").click(function() {
        $("#sc_coupon_frm").remove();
        var $this = $(this);
        var price = parseInt($("input[name=od_price]").val());
        var send_cost = parseInt($("input[name=od_send_cost]").val());
        $.post(
            "./ordersendcostcoupon.php",
            { price: price, send_cost: send_cost },
            function(data) {
                $this.after(data);
            }
        );
    });

    $(document).on("click", ".sc_cp_apply", function() {
        var $el = $(this).closest("tr");
        var cp_id = $el.find("input[name='s_cp_id[]']").val();
        var price = parseInt($el.find("input[name='s_cp_prc[]']").val());
        var subj = $el.find("input[name='s_cp_subj[]']").val();
        var send_cost = parseInt($("input[name=od_send_cost]").val());

        if(parseInt(price) == 0) {
            if(!confirm(subj+"쿠폰의 할인 금액은 "+price+"원입니다.\n쿠폰을 적용하시겠습니까?")) {
                return false;
            }
        }

        $("input[name=sc_cp_id]").val(cp_id);
        $("input[name=od_send_coupon]").val(price);
        $("#sc_cp_price").text(number_format(String(price)));
        calculate_order_price();
        $("#sc_coupon_frm").remove();
        $("#sc_coupon_btn").text("쿠폰변경").focus();
        if(!$("#sc_coupon_cancel").length)
            $("#sc_coupon_btn").after("<button type=\"button\" id=\"sc_coupon_cancel\" class=\"btn-e btn-e-gray cp_cancel\">취소</button>");
    });

    $(document).on("click", "#sc_coupon_close", function() {
        $("#sc_coupon_frm").remove();
        $("#sc_coupon_btn").focus();
    });

    $(document).on("click", "#sc_coupon_cancel", function() {
        $("input[name=od_send_coupon]").val(0);
        $("#sc_cp_price").text(0);
        calculate_order_price();
        $("#sc_coupon_frm").remove();
        $("#sc_coupon_btn").text("쿠폰적용").focus();
        $(this).remove();
    });

    $("#od_b_addr2").focus(function() {
        var zip = $("#od_b_zip").val().replace(/[^0-9]/g, "");
        if(zip == "")
            return false;

        var code = String(zip);

        if(zipcode == code)
            return false;

        zipcode = code;
        calculate_sendcost(code);
    });

    $("#od_settle_bank").on("click", function() {
        $("[name=od_deposit_name]").val( $("[name=od_name]").val() );
        $("#settle_bank").show();
    });

    $("#od_settle_iche,#od_settle_card,#od_settle_vbank,#od_settle_hp,#od_settle_easy_pay,#od_settle_kakaopay,#od_settle_nhnkcp_payco,#od_settle_nhnkcp_naverpay,#od_settle_nhnkcp_kakaopay,#od_settle_inicislpay,#od_settle_inicis_kakaopay").bind("click", function() {
        $("#settle_bank").hide();
    });

    // 배송지선택
    $("input[name=ad_sel_addr]").on("click", function() {
        var addr = $(this).val().split(String.fromCharCode(30));

        if (addr[0] == "same") {
            gumae2baesong();
        } else {
            if(addr[0] == "new") {
                for(i=0; i<10; i++) {
                    addr[i] = "";
                }
            }

            var f = document.forderform;
            f.od_b_name.value        = addr[0];
            f.od_b_tel.value         = addr[1];
            f.od_b_hp.value          = addr[2];
            f.od_b_zip.value         = addr[3] + addr[4];
            f.od_b_addr1.value       = addr[5];
            f.od_b_addr2.value       = addr[6];
            f.od_b_addr3.value       = addr[7];
            f.od_b_addr_jibeon.value = addr[8];
            f.ad_subject.value       = addr[9];

            var zip1 = addr[3].replace(/[^0-9]/g, "");
            var zip2 = addr[4].replace(/[^0-9]/g, "");

            var code = String(zip1) + String(zip2);

            if(zipcode != code) {
                calculate_sendcost(code);
            }
        }
    });

    // 배송지목록
    $("#order_address").on("click", function() {
        var url = this.href;
        window.open(url, "win_address", "left=100,top=100,width=800,height=600,scrollbars=1");
        return false;
    });
});

function coupon_cancel($el)
{
    var $dup_sell_el = $el.find(".total_price");
    var $dup_price_el = $el.find("input[name^=cp_price]");
    var org_sell_price = $el.find("input[name^=it_price]").val();

    $dup_sell_el.text(number_format(String(org_sell_price)));
    $dup_price_el.val(0);
    $el.find("input[name^=cp_id]").val("");
}

function calculate_total_price()
{
    var $it_prc = $("input[name^=it_price]");
    var $cp_prc = $("input[name^=cp_price]");
    var tot_sell_price = sell_price = tot_cp_price = 0;
    var it_price, cp_price, it_notax;
    var tot_mny = comm_tax_mny = comm_vat_mny = comm_free_mny = tax_mny = vat_mny = 0;
    var send_cost = parseInt($("input[name=od_send_cost]").val());

    $it_prc.each(function(index) {
        it_price = parseInt($(this).val());
        cp_price = parseInt($cp_prc.eq(index).val());
        sell_price += it_price;
        tot_cp_price += cp_price;
    });

    tot_sell_price = sell_price - tot_cp_price + send_cost;

    $("#ct_tot_coupon").text(number_format(String(tot_cp_price)));
    $("#ct_tot_price").text(number_format(String(tot_sell_price)));

    $("input[name=good_mny]").val(tot_sell_price);
    $("input[name=od_price]").val(sell_price - tot_cp_price);
    $("input[name=item_coupon]").val(tot_cp_price);
    $("input[name=od_coupon]").val(0);
    $("input[name=od_send_coupon]").val(0);
    <?php if($oc_cnt > 0) { ?>
    $("input[name=od_cp_id]").val("");
    $("#od_cp_price").text(0);
    if($("#od_coupon_cancel").length) {
        $("#od_coupon_btn").text("쿠폰적용");
        $("#od_coupon_cancel").remove();
    }
    <?php } ?>
    <?php if($sc_cnt > 0) { ?>
    $("input[name=sc_cp_id]").val("");
    $("#sc_cp_price").text(0);
    if($("#sc_coupon_cancel").length) {
        $("#sc_coupon_btn").text("쿠폰적용");
        $("#sc_coupon_cancel").remove();
    }
    <?php } ?>
    $("input[name=od_temp_point]").val(0);
    <?php if($temp_point > 0 && $is_member) { ?>
    calculate_temp_point();
    <?php } ?>
    calculate_order_price();
}

function calculate_order_price()
{
    var sell_price = parseInt($("input[name=od_price]").val());
    var send_cost = parseInt($("input[name=od_send_cost]").val());
    var send_cost2 = parseInt($("input[name=od_send_cost2]").val());
    var send_coupon = parseInt($("input[name=od_send_coupon]").val());
    var tot_price = sell_price + send_cost + send_cost2 - send_coupon;

    $("input[name=good_mny]").val(tot_price);
    $("#od_tot_price .print_price").text(number_format(String(tot_price)));
    <?php if($temp_point > 0 && $is_member) { ?>
    calculate_temp_point();
    <?php } ?>
}

function calculate_temp_point()
{
    var sell_price = parseInt($("input[name=od_price]").val());
    var mb_point = parseInt(<?php echo $member['mb_point']; ?>);
    var max_point = parseInt(<?php echo $default['de_settle_max_point']; ?>);
    var point_unit = parseInt(<?php echo $default['de_settle_point_unit']; ?>);
    var temp_point = max_point;

    if(temp_point > sell_price)
        temp_point = sell_price;

    if(temp_point > mb_point)
        temp_point = mb_point;

    temp_point = parseInt(temp_point / point_unit) * point_unit;

    $("#use_max_point").text(number_format(String(temp_point))+"점");
    $("input[name=max_temp_point]").val(temp_point);
}

function calculate_sendcost(code)
{
    $.post(
        "./ordersendcost.php",
        { zipcode: code },
        function(data) {
            $("input[name=od_send_cost2]").val(data);
            $("#od_send_cost2").text(number_format(String(data)));

            zipcode = code;

            calculate_order_price();
        }
    );
}

function calculate_tax()
{
    var $it_prc = $("input[name^=it_price]");
    var $cp_prc = $("input[name^=cp_price]");
    var sell_price = tot_cp_price = 0;
    var it_price, cp_price, it_notax;
    var tot_mny = comm_free_mny = tax_mny = vat_mny = 0;
    var send_cost = parseInt($("input[name=od_send_cost]").val());
    var send_cost2 = parseInt($("input[name=od_send_cost2]").val());
    var od_coupon = parseInt($("input[name=od_coupon]").val());
    var send_coupon = parseInt($("input[name=od_send_coupon]").val());
    var temp_point = 0;

    $it_prc.each(function(index) {
        it_price = parseInt($(this).val());
        cp_price = parseInt($cp_prc.eq(index).val());
        sell_price += it_price;
        tot_cp_price += cp_price;
        it_notax = $("input[name^=it_notax]").eq(index).val();
        if(it_notax == "1") {
            comm_free_mny += (it_price - cp_price);
        } else {
            tot_mny += (it_price - cp_price);
        }
    });

    if($("input[name=od_temp_point]").length)
        temp_point = parseInt($("input[name=od_temp_point]").val());

    tot_mny += (send_cost + send_cost2 - od_coupon - send_coupon - temp_point);
    if(tot_mny < 0) {
        comm_free_mny = comm_free_mny + tot_mny;
        tot_mny = 0;
    }

    tax_mny = Math.round(tot_mny / 1.1);
    vat_mny = tot_mny - tax_mny;
    $("input[name=comm_tax_mny]").val(tax_mny);
    $("input[name=comm_vat_mny]").val(vat_mny);
    $("input[name=comm_free_mny]").val(comm_free_mny);
}

function forderform_check(f)
{
    // 재고체크
    var stock_msg = order_stock_check();
    if(stock_msg != "") {
        alert(stock_msg);
        return false;
    }

    errmsg = "";
    errfld = "";
    var deffld = "";

    check_field(f.od_name, "주문하시는 분 이름을 입력하십시오.");
    if (typeof(f.od_pwd) != 'undefined')
    {
        clear_field(f.od_pwd);
        if( (f.od_pwd.value.length<3) || (f.od_pwd.value.search(/([^A-Za-z0-9]+)/)!=-1) )
            error_field(f.od_pwd, "회원이 아니신 경우 주문서 조회시 필요한 비밀번호를 3자리 이상 입력해 주십시오.");
    }
    check_field(f.od_tel, "주문하시는 분 전화번호를 입력하십시오.");
    check_field(f.od_addr1, "주소검색을 이용하여 주문하시는 분 주소를 입력하십시오.");
    //check_field(f.od_addr2, " 주문하시는 분의 상세주소를 입력하십시오.");
    check_field(f.od_zip, "");

    clear_field(f.od_email);
    if(f.od_email.value=='' || f.od_email.value.search(/(\S+)@(\S+)\.(\S+)/) == -1)
        error_field(f.od_email, "E-mail을 바르게 입력해 주십시오.");

    if (typeof(f.od_hope_date) != "undefined")
    {
        clear_field(f.od_hope_date);
        if (!f.od_hope_date.value)
            error_field(f.od_hope_date, "희망배송일을 선택하여 주십시오.");
    }

    check_field(f.od_b_name, "받으시는 분 이름을 입력하십시오.");
    check_field(f.od_b_tel, "받으시는 분 전화번호를 입력하십시오.");
    check_field(f.od_b_addr1, "주소검색을 이용하여 받으시는 분 주소를 입력하십시오.");
    //check_field(f.od_b_addr2, "받으시는 분의 상세주소를 입력하십시오.");
    check_field(f.od_b_zip, "");

    var od_settle_bank = document.getElementById("od_settle_bank");
    if (od_settle_bank) {
        if (od_settle_bank.checked) {
            check_field(f.od_bank_account, "계좌번호를 선택하세요.");
            check_field(f.od_deposit_name, "입금자명을 입력하세요.");
        }
    }

    // 배송비를 받지 않거나 더 받는 경우 아래식에 + 또는 - 로 대입
    f.od_send_cost.value = parseInt(f.od_send_cost.value);

    if (errmsg)
    {
        alert(errmsg);
        errfld.focus();
        return false;
    }

    var settle_case = document.getElementsByName("od_settle_case");
    var settle_check = false;
    var settle_method = "";
    for (i=0; i<settle_case.length; i++)
    {
        if (settle_case[i].checked)
        {
            settle_check = true;
            settle_method = settle_case[i].value;
            break;
        }
    }
    if (!settle_check)
    {
        alert("결제방식을 선택하십시오.");
        return false;
    }

    var od_price = parseInt(f.od_price.value);
    var send_cost = parseInt(f.od_send_cost.value);
    var send_cost2 = parseInt(f.od_send_cost2.value);
    var send_coupon = parseInt(f.od_send_coupon.value);

    var max_point = 0;
    if (typeof(f.max_temp_point) != "undefined")
        max_point  = parseInt(f.max_temp_point.value);

    var temp_point = 0;
    if (typeof(f.od_temp_point) != "undefined") {
        var point_unit = parseInt(<?php echo $default['de_settle_point_unit']; ?>);
        temp_point = parseInt(f.od_temp_point.value) || 0;

        if (f.od_temp_point.value)
        {
            if (temp_point > od_price) {
                alert("상품 주문금액(배송비 제외) 보다 많이 포인트결제할 수 없습니다.");
                f.od_temp_point.select();
                return false;
            }

            if (temp_point > <?php echo (int)$member['mb_point']; ?>) {
                alert("회원님의 포인트보다 많이 결제할 수 없습니다.");
                f.od_temp_point.select();
                return false;
            }

            if (temp_point > max_point) {
                alert(max_point + "점 이상 결제할 수 없습니다.");
                f.od_temp_point.select();
                return false;
            }

            if (parseInt(parseInt(temp_point / point_unit) * point_unit) != temp_point) {
                alert("포인트를 "+String(point_unit)+"점 단위로 입력하세요.");
                f.od_temp_point.select();
                return false;
            }
        }

        // pg 결제 금액에서 포인트 금액 차감
        if(settle_method != "무통장") {
            f.good_mny.value = od_price + send_cost + send_cost2 - send_coupon - temp_point;
        }
    }

    var tot_price = od_price + send_cost + send_cost2 - send_coupon - temp_point;

    if (document.getElementById("od_settle_iche")) {
        if (document.getElementById("od_settle_iche").checked) {
            if (tot_price < 150) {
                alert("계좌이체는 150원 이상 결제가 가능합니다.");
                return false;
            }
        }
    }

    if (document.getElementById("od_settle_card")) {
        if (document.getElementById("od_settle_card").checked) {
            if (tot_price < 1000) {
                alert("신용카드는 1000원 이상 결제가 가능합니다.");
                return false;
            }
        }
    }

    if (document.getElementById("od_settle_hp")) {
        if (document.getElementById("od_settle_hp").checked) {
            if (tot_price < 350) {
                alert("휴대폰은 350원 이상 결제가 가능합니다.");
                return false;
            }
        }
    }

    <?php if($default['de_tax_flag_use']) { ?>
    calculate_tax();
    <?php } ?>

    <?php if($default['de_pg_service'] == 'inicis') { ?>
    if( f.action != form_action_url ){
        f.action = form_action_url;
        f.removeAttribute("target");
        f.removeAttribute("accept-charset");
    }
    <?php } ?>

    // 카카오페이 지불
    if(settle_method == "KAKAOPAY") {
        <?php if($default['de_tax_flag_use']) { ?>
        f.SupplyAmt.value = parseInt(f.comm_tax_mny.value) + parseInt(f.comm_free_mny.value);
        f.GoodsVat.value  = parseInt(f.comm_vat_mny.value);
        <?php } ?>
        getTxnId(f);
        return false;
    }

    var form_order_method = '';

    if( settle_method == "lpay" || settle_method == "inicis_kakaopay" ){      //이니시스 L.pay 또는 이니시스 카카오페이 이면 ( 이니시스의 삼성페이는 모바일에서만 단독실행 가능함 )
        form_order_method = 'samsungpay';
    } else if(settle_method == "간편결제") {
        if(jQuery("input[name='od_settle_case']:checked" ).attr("data-pay") === "naverpay"){
            form_order_method = 'nhnkcp_naverpay';
        }
    }

    if( jQuery(f).triggerHandler("form_sumbit_order_"+form_order_method) !== false ) {

        // pay_method 설정
        <?php if($default['de_pg_service'] == 'kcp') { ?>
        f.site_cd.value = f.def_site_cd.value;
        if(typeof f.payco_direct !== "undefined") f.payco_direct.value = "";
        if(typeof f.naverpay_direct !== "undefined") f.naverpay_direct.value = "A";
        if(typeof f.kakaopay_direct !== "undefined") f.kakaopay_direct.value = "A";
        switch(settle_method)
        {
            case "계좌이체":
                f.pay_method.value   = "010000000000";
                break;
            case "가상계좌":
                f.pay_method.value   = "001000000000";
                break;
            case "휴대폰":
                f.pay_method.value   = "000010000000";
                break;
            case "신용카드":
                f.pay_method.value   = "100000000000";
                break;
            case "간편결제":
                f.pay_method.value   = "100000000000";

                var nhnkcp_easy_pay = jQuery("input[name='od_settle_case']:checked" ).attr("data-pay");
                
                if(nhnkcp_easy_pay === "naverpay"){
                    if(typeof f.naverpay_direct !== "undefined") f.naverpay_direct.value = "Y";
                } else if(nhnkcp_easy_pay === "kakaopay"){
                    if(typeof f.kakaopay_direct !== "undefined") f.kakaopay_direct.value = "Y";
                } else {
                    if(typeof f.payco_direct !== "undefined") f.payco_direct.value = "Y";
                    <?php if($default['de_card_test']) { ?>
                    f.site_cd.value      = "S6729";
                    <?php } ?>
                }
                break;
            default:
                f.pay_method.value   = "무통장";
                break;
        }
        <?php } else if($default['de_pg_service'] == 'lg') { ?>
        f.LGD_EASYPAY_ONLY.value = "";
        if(typeof f.LGD_CUSTOM_USABLEPAY === "undefined") {
            var input = document.createElement("input");
            input.setAttribute("type", "hidden");
            input.setAttribute("name", "LGD_CUSTOM_USABLEPAY");
            input.setAttribute("value", "");
            f.LGD_EASYPAY_ONLY.parentNode.insertBefore(input, f.LGD_EASYPAY_ONLY);
        }

        switch(settle_method)
        {
            case "계좌이체":
                f.LGD_CUSTOM_FIRSTPAY.value = "SC0030";
                f.LGD_CUSTOM_USABLEPAY.value = "SC0030";
                break;
            case "가상계좌":
                f.LGD_CUSTOM_FIRSTPAY.value = "SC0040";
                f.LGD_CUSTOM_USABLEPAY.value = "SC0040";
                break;
            case "휴대폰":
                f.LGD_CUSTOM_FIRSTPAY.value = "SC0060";
                f.LGD_CUSTOM_USABLEPAY.value = "SC0060";
                break;
            case "신용카드":
                f.LGD_CUSTOM_FIRSTPAY.value = "SC0010";
                f.LGD_CUSTOM_USABLEPAY.value = "SC0010";
                break;
            case "간편결제":
                var elm = f.LGD_CUSTOM_USABLEPAY;
                if(elm.parentNode)
                    elm.parentNode.removeChild(elm);
                f.LGD_EASYPAY_ONLY.value = "PAYNOW";
                break;
            default:
                f.LGD_CUSTOM_FIRSTPAY.value = "무통장";
                break;
        }
        <?php } else if($default['de_pg_service'] == 'inicis') { ?>
        switch(settle_method)
        {
            case "계좌이체":
                f.gopaymethod.value = "DirectBank";
                break;
            case "가상계좌":
                f.gopaymethod.value = "VBank";
                break;
            case "휴대폰":
                f.gopaymethod.value = "HPP";
                break;
            case "신용카드":
                f.gopaymethod.value = "Card";
                f.acceptmethod.value = f.acceptmethod.value.replace(":useescrow", "");
                break;
            case "간편결제":
                f.gopaymethod.value = "Kpay";
                break;
            case "lpay":
                f.gopaymethod.value = "onlylpay";
                f.acceptmethod.value = f.acceptmethod.value+":cardonly";
                break;
            case "inicis_kakaopay":
                f.gopaymethod.value = "onlykakaopay";
                f.acceptmethod.value = f.acceptmethod.value+":cardonly";
                break;
            default:
                f.gopaymethod.value = "무통장";
                break;
        }
        <?php } else if($default['de_pg_service'] == 'nicepay') { ?>
        f.DirectShowOpt.value = "";     // 간편결제 요청 값 초기화
        f.DirectEasyPay.value = "";     // 간편결제 요청 값 초기화
        f.NicepayReserved.value = "";   // 간편결제 요청 값 초기화
        f.EasyPayMethod.value = "";   // 간편결제 요청 값 초기화

            <?php if ($default['de_escrow_use']) {  // 간편결제시 에스크로값이 0이 되므로 기본설정값을 지정 ?>
            f.TransType.value = "1";
            <?php } ?>
        switch(settle_method)
        {
            case "계좌이체":
                f.PayMethod.value = "BANK";
                break;
            case "가상계좌":
                f.PayMethod.value = "VBANK";
                break;
            case "휴대폰":
                f.PayMethod.value = "CELLPHONE";
                break;
            case "신용카드":
                f.PayMethod.value = "CARD";
                break;
            case "간편결제":
                f.PayMethod.value = "CARD";
                f.DirectShowOpt.value = "CARD";
                f.TransType.value = "0";    // 간편결제의 경우 에스크로를 사용할수 없다.

                var nicepay_easy_pay = jQuery("input[name='od_settle_case']:checked" ).attr("data-pay");

                if(nicepay_easy_pay === "nice_naverpay"){
                    if(typeof f.DirectEasyPay !== "undefined") f.DirectEasyPay.value = "E020";
                    
                    <?php 
                        // * 카드 선택 시 전액 카드로 결제, 포인트 선택 시 전액 포인트로 결제.
                        // (카드와 포인트를 같이 사용하는 복합결제 형태의 결제는 불가함.)
                        // - 카드: EasyPayMethod=”E020=CARD”, 포인트: EasyPayMethod=”E020=POINT”
                    ?>
                    
                    if(typeof f.EasyPayMethod !== "undefined") f.EasyPayMethod.value = "E020=CARD";

                } else if(nicepay_easy_pay === "nice_kakaopay"){
                    if(typeof f.NicepayReserved !== "undefined") f.NicepayReserved.value = "DirectKakao=Y";
                } else if(nicepay_easy_pay === "nice_samsungpay"){
                    if(typeof f.DirectEasyPay !== "undefined") f.DirectEasyPay.value = "E021";
                } else if(nicepay_easy_pay === "nice_paycopay"){
                    if(typeof f.NicepayReserved !== "undefined") f.NicepayReserved.value = "DirectPayco=Y";
                } else if(nicepay_easy_pay === "nice_skpay"){
                    if(typeof f.NicepayReserved !== "undefined") f.NicepayReserved.value = "DirectPay11=Y";
                } else if(nicepay_easy_pay === "nice_ssgpay"){
                    if(typeof f.DirectEasyPay !== "undefined") f.DirectEasyPay.value = "E007";
                } else if(nicepay_easy_pay === "nice_lpay"){
                    if(typeof f.DirectEasyPay !== "undefined") f.DirectEasyPay.value = "E018";
                }

                break;
            default:
                f.PayMethod.value = "무통장";
                break;
        }
        <?php } ?>

        // 결제정보설정
        <?php if($default['de_pg_service'] == 'kcp') { ?>
        f.buyr_name.value = f.od_name.value;
        f.buyr_mail.value = f.od_email.value;
        f.buyr_tel1.value = f.od_tel.value;
        f.buyr_tel2.value = f.od_hp.value;
        f.rcvr_name.value = f.od_b_name.value;
        f.rcvr_tel1.value = f.od_b_tel.value;
        f.rcvr_tel2.value = f.od_b_hp.value;
        f.rcvr_mail.value = f.od_email.value;
        f.rcvr_zipx.value = f.od_b_zip.value;
        f.rcvr_add1.value = f.od_b_addr1.value;
        f.rcvr_add2.value = f.od_b_addr2.value;

        if(f.pay_method.value != "무통장") {
            jsf__pay( f );
        } else {
            f.submit();
        }
        <?php } ?>
        <?php if($default['de_pg_service'] == 'lg') { ?>
        f.LGD_BUYER.value = f.od_name.value;
        f.LGD_BUYEREMAIL.value = f.od_email.value;
        f.LGD_BUYERPHONE.value = f.od_hp.value;
        f.LGD_AMOUNT.value = f.good_mny.value;
        f.LGD_RECEIVER.value = f.od_b_name.value;
        f.LGD_RECEIVERPHONE.value = f.od_b_hp.value;
        <?php if($default['de_escrow_use']) { ?>
        f.LGD_ESCROW_ZIPCODE.value = f.od_b_zip.value;
        f.LGD_ESCROW_ADDRESS1.value = f.od_b_addr1.value;
        f.LGD_ESCROW_ADDRESS2.value = f.od_b_addr2.value;
        f.LGD_ESCROW_BUYERPHONE.value = f.od_hp.value;
        <?php } ?>
        <?php if($default['de_tax_flag_use']) { ?>
        f.LGD_TAXFREEAMOUNT.value = f.comm_free_mny.value;
        <?php } ?>

        if(f.LGD_CUSTOM_FIRSTPAY.value != "무통장") {
            launchCrossPlatform(f);
        } else {
            f.submit();
        }
        <?php } ?>
        <?php if($default['de_pg_service'] == 'inicis') { ?>
        f.price.value       = f.good_mny.value;
        <?php if($default['de_tax_flag_use']) { ?>
        f.tax.value         = f.comm_vat_mny.value;
        f.taxfree.value     = f.comm_free_mny.value;
        <?php } ?>
        f.buyername.value   = f.od_name.value;
        f.buyeremail.value  = f.od_email.value;
        f.buyertel.value    = f.od_hp.value ? f.od_hp.value : f.od_tel.value;
        f.recvname.value    = f.od_b_name.value;
        f.recvtel.value     = f.od_b_hp.value ? f.od_b_hp.value : f.od_b_tel.value;
        f.recvpostnum.value = f.od_b_zip.value;
        f.recvaddr.value    = f.od_b_addr1.value + " " +f.od_b_addr2.value;

        if(f.gopaymethod.value != "무통장") {
            // 주문정보 임시저장
            var order_data = $(f).serialize();
            var save_result = "";
            $.ajax({
                type: "POST",
                data: order_data,
                url: g5_url+"/shop/ajax.orderdatasave.php",
                cache: false,
                async: false,
                success: function(data) {
                    save_result = data;
                }
            });

            if(save_result) {
                alert(save_result);
                return false;
            }

            if(!make_signature(f))
                return false;

            paybtn(f);
        } else {
            f.submit();
        }
        <?php } ?>
        <?php if($default['de_pg_service'] == 'nicepay') { ?>
        f.Amt.value       = f.good_mny.value;
        <?php if($default['de_tax_flag_use']) { ?>
        f.SupplyAmt.value         = f.comm_tax_mny.value;
        f.GoodsVat.value     = f.comm_vat_mny.value;
        f.TaxFreeAmt.value     = f.comm_free_mny.value;
        <?php } ?>
        f.BuyerName.value   = f.od_name.value;
        f.BuyerEmail.value  = f.od_email.value;
        f.BuyerTel.value    = f.od_hp.value ? f.od_hp.value : f.od_tel.value;

        if(f.PayMethod.value != "무통장") {
            // 주문정보 임시저장
            var order_data = $(f).serialize();
            var save_result = "";
            $.ajax({
                type: "POST",
                data: order_data,
                url: g5_url+"/shop/ajax.orderdatasave.php",
                cache: false,
                async: false,
                success: function(data) {
                    save_result = data;
                }
            });

            if(save_result) {
                alert(save_result);
                return false;
            }

            if(!nicepay_create_signdata(f))
                return false;
            
            nicepayStart(f);
        } else {
            f.submit();
        }

        <?php } ?>
    }

}

// 구매자 정보와 동일합니다.
function gumae2baesong() {
    var f = document.forderform;

    f.od_b_name.value = f.od_name.value;
    f.od_b_tel.value  = f.od_tel.value;
    f.od_b_hp.value   = f.od_hp.value;
    f.od_b_zip.value  = f.od_zip.value;
    f.od_b_addr1.value = f.od_addr1.value;
    f.od_b_addr2.value = f.od_addr2.value;
    f.od_b_addr3.value = f.od_addr3.value;
    f.od_b_addr_jibeon.value = f.od_addr_jibeon.value;

    calculate_sendcost(String(f.od_b_zip.value));
}

<?php if ($default['de_hope_date_use']) { ?>
$(function(){
    $("#od_hope_date").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", minDate: "+<?php echo (int)$default['de_hope_date_after']; ?>d;", maxDate: "+<?php echo (int)$default['de_hope_date_after'] + 6; ?>d;" });
});
<?php } ?>

$(function(){
	//tooltip
    $(".tooltip_icon").click(function(){
        $(this).next(".tooltip").fadeIn(400);
    }).mouseout(function(){
        $(this).next(".tooltip").fadeOut();
    });
});
</script>