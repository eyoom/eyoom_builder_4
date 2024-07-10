<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/personalpayform.sub.mobile.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

require_once(G5_MSHOP_PATH.'/settle_'.$default['de_pg_service'].'.inc.php');

$tablet_size = "1.0"; // 화면 사이즈 조정 - 기기화면에 맞게 수정(갤럭시탭,아이패드 - 1.85, 스마트폰 - 1.0)
?>

<style>
.shop-personalpay-form .personal-member-area .headline-short {margin-bottom:30px}
.shop-personalpay-form .personal-member-area .m-sod-frm-orderer {padding:20px 0}
.shop-personalpay-form .personal-table {margin:0}
.shop-personalpay-form .personal-table table {width:100%;border-collapse:collapse;border-spacing:0}
.shop-personalpay-form .personal-table th {width:90px;padding:5px 10px;background:none;text-align:right}
.shop-personalpay-form .personal-table td {padding:5px 10px;background:transparent}
.shop-personalpay-form .personal-table .td-box {min-height:30px;padding:6px 12px;border:1px solid #c5c5c5;box-sizing:border-box;margin-bottom:5px;background:#fafafa;cursor:not-allowed}
.shop-personalpay-form .payment-select-wrap {position:relative;margin-top:20px}
.shop-personalpay-form .payment-select-title {margin:0 0 10px}
.shop-personalpay-form .payment-select-wrap fieldset {padding:0 0 0 2px;background:none}
.shop-personalpay-form .payment-select-wrap input[type="radio"] {position:absolute;width:0;height:0;overflow:hidden;visibility:hidden;text-indent:-999px;left:0;z-index:-1px}
.shop-personalpay-form .payment-select-wrap .payment-select-box {position:relative;overflow:hidden;float:left;width:50%;background:#fff;cursor:pointer;height:60px;box-sizing:border-box;border:1px solid #e5e5e5;margin:-1px 0 0 -1px;padding:20px 0 0 80px !important;text-indent:inherit !important}
.shop-personalpay-form .payment-select-wrap input[type="radio"]:checked+.payment-select-box {border:1px solid #ab0000;z-index:3}
.shop-personalpay-form .payment-select-wrap input[type="radio"]:checked+.payment-select-box:after {font-family:'Font Awesome\ 5 Free';content:"\f00c";font-weight:900;position:absolute;top:5px;right:10px;color:#ab0000;font-size:16px}
.shop-personalpay-form .payment-select-wrap #sod_frm_paysel .bank_icon {background:#fff}
.shop-personalpay-form .payment-select-wrap #sod_frm_paysel .bank_icon:before {font-family:'Font Awesome\ 5 Free';content:"\f53c";font-weight:900;position:absolute;top:5px;left:5px;width:48px;height:48px;line-height:48px;text-align:center;color:#b5b5b5;font-size:20px}
.shop-personalpay-form .payment-select-wrap #sod_frm_paysel .vbank_icon {background:#fff}
.shop-personalpay-form .payment-select-wrap #sod_frm_paysel .vbank_icon:before {font-family:'Font Awesome\ 5 Free';content:"\f2c2";font-weight:900;position:absolute;top:5px;left:5px;width:48px;height:48px;line-height:48px;text-align:center;color:#b5b5b5;font-size:20px}
.shop-personalpay-form .payment-select-wrap #sod_frm_paysel .iche_icon {background:#fff}
.shop-personalpay-form .payment-select-wrap #sod_frm_paysel .iche_icon:before {font-family:'Font Awesome\ 5 Free';content:"\f53c";font-weight:900;position:absolute;top:5px;left:5px;width:48px;height:48px;line-height:48px;text-align:center;color:#b5b5b5;font-size:20px}
.shop-personalpay-form .payment-select-wrap #sod_frm_paysel .hp_icon {background:#fff}
.shop-personalpay-form .payment-select-wrap #sod_frm_paysel .hp_icon:before {font-family:'Font Awesome\ 5 Free';content:"\f3cd";font-weight:900;position:absolute;top:5px;left:5px;width:48px;height:48px;line-height:48px;text-align:center;color:#b5b5b5;font-size:20px}
.shop-personalpay-form .payment-select-wrap #sod_frm_paysel .card_icon {background:#fff}
.shop-personalpay-form .payment-select-wrap #sod_frm_paysel .card_icon:before {font-family:'Font Awesome\ 5 Free';content:"\f09d";font-weight:900;position:absolute;top:5px;left:5px;width:48px;height:48px;line-height:48px;text-align:center;color:#b5b5b5;font-size:20px}
#display_pay_button {background:none;padding:0;border:0 none}
#display_pay_button .btn_submit {display:block;width:100%;height:46px;line-height:46px;padding:0;background:#3f4678;color:#fff;font-size:.9375rem;font-weight:700;letter-spacing:0;border:0;margin:15px 0;border-radius:3px}
#display_pay_button a.btn_cancel {display:block;width:100%;height:46px;line-height:46px;padding:0;background:#fff;color:#757575;font-size:.9375rem;font-weight:700;letter-spacing:0;border:1px solid #d5d5d5;margin:15px 0;border-radius:3px}
#display_pay_button a.btn01 {display:block;width:100%;height:46px;line-height:46px;padding:0;background:#fff;color:#757575;font-size:.9375rem;font-weight:700;letter-spacing:0;border:1px solid #d5d5d5;margin:15px 0;border-radius:3px}
@media (max-width:991px) {
    .shop-personalpay-form .personal-table th {width:70px !important;text-align:left;padding:5px 0;display:none}
    .shop-personalpay-form .personal-table td {padding:5px 0}
}
</style>

<div class="shop-personalpay-form">
    <div id="sod_approval_frm">
        <?php
        // 결제대행사별 코드 include (결제등록 필드)
        require_once(G5_MSHOP_PATH.'/'.$default['de_pg_service'].'/orderform.1.php');
        ?>
    </div>

    <div class="personalpay-form-wrap">
        <form name="forderform" method="post" action="<?php echo $order_action_url; ?>" autocomplete="off" class="eyoom-form">
        <input type="hidden" name="pp_id" value="<?php echo $pp['pp_id']; ?>">

        <div class="personal-member-area">
            <div class="m-sod-frm-orderer">
                <div class="headline-short"><h4><strong>개인결제정보</strong></h4></div>
                <div class="personal-table">
                    <table>
                        <tbody>
                            <?php if(trim($pp['pp_content'])) { ?>
                            <tr>
                                <th scope="row">상세내용</th>
                                <td>
                                    <label class="hidden-lg hidden-md">상세내용</strong></label>
                                    <div class="td-box">
                                        <?php echo conv_content($pp['pp_content'], 0); ?>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <th scope="row">결제금액</th>
                                <td>
                                    <label class="hidden-lg hidden-md">결제금액</strong></label>
                                    <div class="td-box width-200px">
                                        <strong class="text-crimson"><?php echo display_price($pp['pp_price']); ?></strong>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="pp_name">이름<strong class="sound_only"> 필수</strong></label></th>
                                <td>
                                    <label for="pp_name" class="hidden-lg hidden-md">이름<strong class="sound_only"> 필수</strong></label>
                                    <label class="input width-200px required-mark">
                                        <input type="text" name="pp_name" value="<?php echo get_text($pp['pp_name']); ?>" id="pp_name" required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="pp_email">이메일<strong class="sound_only"> 필수</strong></label></th>
                                <td>
                                    <label for="pp_email" class="hidden-lg hidden-md">이메일<strong class="sound_only"> 필수</strong></label>
                                    <label class="input width-200px required-mark">
                                        <input type="email" name="pp_email" value="<?php echo $member['mb_email']; ?>" id="pp_email" required size="30">
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="pp_hp">휴대폰</label></th>
                                <td>
                                    <label for="pp_hp" class="hidden-lg hidden-md">휴대폰</label>
                                    <label class="input width-200px required-mark">
                                        <input type="text" name="pp_hp" value="<?php echo get_text($member['mb_hp']); ?>" id="pp_hp" required>
                                    </label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="payment-select-wrap">
            <div class="headline-short"><h4><strong>결제수단</strong></h4></div>
            <?php if ($default['de_vbank_use'] || $default['de_iche_use'] || $default['de_card_use'] || $default['de_hp_use']) { ?>
            <div id="sod_frm_paysel">
            <?php } ?>

            <?php if($default['de_vbank_use']) { $multi_settle++; // 가상계좌 사용 ?>
            <input type="radio" id="pp_settle_vbank" name="pp_settle_case" value="가상계좌" <?php echo $checked; ?>><label for="pp_settle_vbank" class="payment-select-box vbank_icon"><?php echo $escrow_title; ?>가상계좌</label>
            <?php $checked = ''; } ?>

            <?php if($default['de_iche_use']) { $multi_settle++; // 계좌이체 사용 ?>
            <input type="radio" id="pp_settle_iche" name="pp_settle_case" value="계좌이체" <?php echo $checked; ?>><label for="pp_settle_iche" class="payment-select-box iche_icon"><?php echo $escrow_title; ?>계좌이체</label>
            <?php $checked = ''; } ?>

            <?php if($default['de_hp_use']) { $multi_settle++; // 휴대폰 사용 ?>
            <input type="radio" id="pp_settle_hp" name="pp_settle_case" value="휴대폰" <?php echo $checked; ?>><label for="pp_settle_hp" class="payment-select-box hp_icon">휴대폰</label>
            <?php $checked = ''; } ?>

            <?php if($default['de_card_use']) { $multi_settle++; // 신용카드 사용 ?>
            <input type="radio" id="pp_settle_card" name="pp_settle_case" value="신용카드" <?php echo $checked; ?>><label for="pp_settle_card" class="payment-select-box card_icon">신용카드</label>
            <?php $checked = ''; } ?>

            <?php if ($default['de_vbank_use'] || $default['de_iche_use'] || $default['de_card_use'] || $default['de_hp_use']) { ?>
            </div>
            <?php } ?>

            <?php if ($multi_settle == 0) { ?>
            <p class="text-gray"><i class="fas fa-exclamation-circle"></i> 결제할 방법이 없습니다.<br>운영자에게 알려주시면 감사하겠습니다.</p>
            <?php } ?>
        </div>

        <div class="margin-bottom-20"></div>

        <?php
        // 결제대행사별 코드 include (결제대행사 정보 필드 및 주분버튼)
        require_once(G5_MSHOP_PATH.'/'.$default['de_pg_service'].'/orderform.2.php');
        ?>

        <div id="show_progress" style="display:none;">
            <img src="<?php echo G5_MOBILE_URL; ?>/shop/img/loading.gif" alt="">
            <span>결제진행 중입니다. 잠시만 기다려 주십시오.</span>
        </div>
        </form>

        <?php
        if ($default['de_escrow_use']) {
            // 결제대행사별 코드 include (에스크로 안내)
            require_once(G5_MSHOP_PATH.'/'.$default['de_pg_service'].'/orderform.3.php');
        }
        ?>
    </div>
</div>

<script>
/* 결제방법에 따른 처리 후 결제등록요청 실행 */
var settle_method = "";

function pay_approval()
{
    var f = document.sm_form;
    var pf = document.forderform;

    // 필드체크
    if(!payfield_check(pf))
        return false;

    // 금액체크
    if(!payment_check(pf))
        return false;

    <?php if($default['de_pg_service'] == 'kcp') { ?>
    f.buyr_name.value = pf.pp_name.value;
    f.buyr_mail.value = pf.pp_email.value;
    f.buyr_tel1.value = pf.pp_hp.value;
    f.buyr_tel2.value = pf.pp_hp.value;
    f.rcvr_name.value = pf.pp_name.value;
    f.rcvr_tel1.value = pf.pp_hp.value;
    f.rcvr_tel2.value = pf.pp_hp.value;
    f.rcvr_mail.value = pf.pp_email.value;
    f.settle_method.value = settle_method;
    <?php } else if($default['de_pg_service'] == 'lg') { ?>
    var pay_method = "";
    switch(settle_method) {
        case "계좌이체":
            pay_method = "SC0030";
            break;
        case "가상계좌":
            pay_method = "SC0040";
            break;
        case "휴대폰":
            pay_method = "SC0060";
            break;
        case "신용카드":
            pay_method = "SC0010";
            break;
    }
    f.LGD_CUSTOM_FIRSTPAY.value = pay_method;
    f.LGD_BUYER.value = pf.pp_name.value;
    f.LGD_BUYEREMAIL.value = pf.pp_email.value;
    f.LGD_BUYERPHONE.value = pf.pp_hp.value;
    f.LGD_AMOUNT.value = f.good_mny.value;
    <?php if($default['de_tax_flag_use']) { ?>
    f.LGD_TAXFREEAMOUNT.value = pf.comm_free_mny.value;
    <?php } ?>
    <?php } else if($default['de_pg_service'] == 'inicis') { ?>
    var paymethod = "";
    var width = 330;
    var height = 480;
    var xpos = (screen.width - width) / 2;
    var ypos = (screen.width - height) / 2;
    var position = "top=" + ypos + ",left=" + xpos;
    var features = position + ", width=320, height=440";
    switch(settle_method) {
        case "계좌이체":
            paymethod = "bank";
            break;
        case "가상계좌":
            paymethod = "vbank";
            break;
        case "휴대폰":
            paymethod = "mobile";
            break;
        case "신용카드":
            paymethod = "wcard";
            break;
    }
    f.P_AMT.value = f.good_mny.value;
    f.P_UNAME.value = pf.pp_name.value;
    f.P_MOBILE.value = pf.pp_hp.value;
    f.P_EMAIL.value = pf.pp_email.value;
    <?php if($default['de_tax_flag_use']) { ?>
    f.P_TAX.value = pf.comm_vat_mny.value;
    f.P_TAXFREE = pf.comm_free_mny.value;
    <?php } ?>
    f.P_RETURN_URL.value = "<?php echo $return_url.$pp_id; ?>";
    f.action = "https://mobile.inicis.com/smart/" + paymethod + "/";
    <?php } else if($default['de_pg_service'] == 'nicepay') { ?>

    f.Amt.value       = f.good_mny.value;
    f.BuyerName.value   = pf.pp_name.value;
    f.BuyerEmail.value  = pf.pp_email.value;
    f.BuyerTel.value    = pf.pp_hp.value;

    f.DirectShowOpt.value = "";     // 간편결제 요청 값 초기화
    f.DirectEasyPay.value = "";     // 간편결제 요청 값 초기화
    f.NicepayReserved.value = "";   // 간편결제 요청 값 초기화
    f.EasyPayMethod.value = "";   // 간편결제 요청 값 초기화

        <?php if ($default['de_escrow_use']) {  // 간편결제시 에스크로값이 0이 되므로 기본설정값을 지정 ?>
        f.TransType.value = "1";
        <?php } ?>

    switch(settle_method) {
        case "계좌이체":
            paymethod = "BANK";
            break;
        case "가상계좌":
            paymethod = "VBANK";
            break;
        case "휴대폰":
            paymethod = "CELLPHONE";
            break;
        case "신용카드":
            paymethod = "CARD";
            break;
        default:
            paymethod = "무통장";
            break;
    }

    f.PayMethod.value = paymethod;

    <?php if($default['de_tax_flag_use']) { ?>
    f.SupplyAmt.value = pf.comm_tax_mny.value;
    f.GoodsVat.value = pf.comm_vat_mny.value;
    f.TaxFreeAmt.value = pf.comm_free_mny.value;
    <?php } ?>

    if (! nicepay_create_signdata(f)) {
        return false;
    }
    <?php } ?>

    //var new_win = window.open("about:blank", "tar_opener", "scrollbars=yes,resizable=yes");
    //f.target = "tar_opener";

    // 주문 정보 임시저장
    var order_data = $(pf).serialize();
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

    <?php if($default['de_pg_service'] == 'nicepay') { ?>
        nicepayStart(f);

        return;
    <?php } ?>

    f.submit();
}

function forderform_check()
{
    var f = document.forderform;

    // 필드체크
    if(!payfield_check(f))
        return false;

    // 금액체크
    if(!payment_check(f))
        return false;

    if(f.res_cd.value != "0000") {
        alert("결제등록요청 후 결제해 주십시오.");
        return false;
    }

    document.getElementById("display_pay_button").style.display = "none";
    document.getElementById("show_progress").style.display = "block";

    setTimeout(function() {
        f.submit();
    }, 300);
}

// 결제폼 필드체크
function payfield_check(f)
{
    var settle_case = document.getElementsByName("pp_settle_case");
    var settle_check = false;
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

    return true;
}

// 결제체크
function payment_check(f)
{
    var tot_price = <?php echo (int)$pp['pp_price']; ?>;

    if (document.getElementById("pp_settle_iche")) {
        if (document.getElementById("pp_settle_iche").checked) {
            if (tot_price < 150) {
                alert("계좌이체는 150원 이상 결제가 가능합니다.");
                return false;
            }
        }
    }

    if (document.getElementById("pp_settle_card")) {
        if (document.getElementById("pp_settle_card").checked) {
            if (tot_price < 1000) {
                alert("신용카드는 1000원 이상 결제가 가능합니다.");
                return false;
            }
        }
    }

    if (document.getElementById("pp_settle_hp")) {
        if (document.getElementById("pp_settle_hp").checked) {
            if (tot_price < 350) {
                alert("휴대폰은 350원 이상 결제가 가능합니다.");
                return false;
            }
        }
    }

    return true;
}
</script>