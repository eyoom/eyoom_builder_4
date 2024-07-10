<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/personalpayform.sub.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

require_once(G5_SHOP_PATH.'/settle_'.$default['de_pg_service'].'.inc.php');

// 결제대행사별 코드 include (스크립트 등)
require_once(G5_SHOP_PATH.'/'.$default['de_pg_service'].'/orderform.1.php');
?>

<style>
.shop-personalpay-form .personal-member-payment {position:relative;border:1px solid #e5e5e5}
.shop-personalpay-form .personal-member-area {position:relative;margin-right:370px}
.shop-personalpay-form .personal-member-area .sod-frm-title {position:relative;height:70px;margin:-30px -15px 30px;padding:25px 20px;border-bottom:1px solid #e5e5e5;background:#fafafa}
.shop-personalpay-form .personal-member-area .sod-frm-title h4 {font-size:1.25rem;line-height:1}
.shop-personalpay-form .personal-member-area .sod-frm-title h4:after {content:"";display:block;position:absolute;top:-1px;left:-1px;width:0;height:0;border-top:20px solid #5c6bc0;border-right:20px solid transparent}
.shop-personalpay-form .personal-member-area .sod-frm-pay {padding:30px 15px 40px}
.shop-personalpay-form .personal-table {margin:0}
.shop-personalpay-form .personal-table table {width:100%;border-collapse:collapse;border-spacing:0}
.shop-personalpay-form .personal-table th {width:90px;padding:5px 10px;background:none;text-align:right}
.shop-personalpay-form .personal-table td {padding:5px 10px;background:transparent}
.shop-personalpay-form .personal-table textarea {width:100%;height:100px}
.shop-personalpay-form .personal-table a {text-decoration:none}
.shop-personalpay-form .personal-table .td-box {min-height:30px;padding:7px 12px;border:1px solid #d5d5d5;margin-bottom:5px;background:#fafafa;cursor:not-allowed}
.shop-personalpay-form .personal-payment-area {position:absolute;top:0;right:0;width:370px;height:100%;border-left:1px solid #e5e5e5;background:#fafafa;padding:20px 15px}
.shop-personalpay-form .payment-select-wrap {position:relative}
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
#display_pay_button a.btn01 {display:block;width:100%;height:46px;line-height:46px;padding:0;background:#fff;color:#757575;font-size:.9375rem;font-weight:700;letter-spacing:0;border:1px solid #d5d5d5;margin:15px 0;border-radius:3px}
@media (max-width:991px) {
    .shop-personalpay-form .personal-member-area {margin-right:0}
    .shop-personalpay-form .personal-table th {width:70px !important;text-align:left;padding:5px 0;display:none}
    .shop-personalpay-form .personal-table td {padding:5px 0}
    .shop-personalpay-form .personal-payment-area {position:relative;top:inherit;right:inherit;width:100%;height:auto;border-left:0;border-top:1px solid #e5e5e5;background:#fafafa}
}
</style>

<form name="forderform" id="forderform" method="post" action="<?php echo $order_action_url; ?>" autocomplete="off" class="eyoom-form">
<input type="hidden" name="pp_id" value="<?php echo $pp['pp_id']; ?>">

<div class="shop-personalpay-form">
    <?php
    // 결제대행사별 코드 include (결제대행사 정보 필드)
    require_once(G5_SHOP_PATH.'/'.$default['de_pg_service'].'/orderform.2.php');
    ?>

    <div class="personal-member-payment">
        <div class="personal-member-area">
            <div class="sod-frm-pay">
                <div class="sod-frm-title"><h4><strong>개인결제정보</strong></h4></div>
                <div class="personal-table">
                    <table>
                        <tbody>
                            <?php if(trim($pp['pp_content'])) { ?>
                            <tr>
                                <th scope="row">상세내용</th>
                                <td>
                                    <label class="label hidden-lg hidden-md">상세내용</strong></label>
                                    <div class="td-box">
                                        <?php echo conv_content($pp['pp_content'], 0); ?>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <th scope="row">결제금액</th>
                                <td>
                                    <label class="label hidden-lg hidden-md">결제금액</strong></label>
                                    <div class="td-box width-200px">
                                        <strong class="text-crimson"><?php echo display_price($pp['pp_price']); ?></strong>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="pp_name">이름<strong class="sound_only"> 필수</strong></label></th>
                                <td>
                                    <label for="pp_name" class="label hidden-lg hidden-md">이름<strong class="sound_only"> 필수</strong></label>
                                    <label class="input width-200px required-mark">
                                        <input type="text" name="pp_name" value="<?php echo get_text($pp['pp_name']); ?>" id="pp_name" required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="pp_email">이메일<strong class="sound_only"> 필수</strong></label></th>
                                <td>
                                    <label for="pp_email" class="label hidden-lg hidden-md">이메일<strong class="sound_only"> 필수</strong></label>
                                    <label class="input width-200px required-mark">
                                        <input type="text" name="pp_email" value="<?php echo $member['mb_email']; ?>" id="pp_email" required size="30">
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="pp_hp">휴대폰</label></th>
                                <td>
                                    <label for="pp_hp" class="label hidden-lg hidden-md">휴대폰</label>
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
        <div class="personal-payment-area">
            <div class="payment-select-wrap">
                <h5 class="payment-select-title"><strong>결제수단</strong></h5>
                <?php if ($default['de_vbank_use'] || $default['de_iche_use'] || $default['de_card_use'] || $default['de_hp_use']) { ?>
                <fieldset id="sod_frm_paysel">
                <legend>결제방법 선택</legend>
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
                </fieldset>
                <?php } ?>

                <?php if ($multi_settle == 0) { ?>
                <p class="text-gray"><i class="fas fa-exclamation-circle"></i> 결제할 방법이 없습니다.<br>운영자에게 알려주시면 감사하겠습니다.</p>
                <?php } ?>

                <?php
                // 결제대행사별 코드 include (주문버튼)
                require_once(G5_SHOP_PATH.'/'.$default['de_pg_service'].'/orderform.3.php');
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
</div>

</form>

<script>
function forderform_check(f)
{
    var settle_case = document.getElementsByName("pp_settle_case");
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

    // pay_method 설정
    <?php if($default['de_pg_service'] == 'kcp') { ?>
    switch(settle_method)
    {
        case "계좌이체":
            f.pay_method.value = "010000000000";
            break;
        case "가상계좌":
            f.pay_method.value = "001000000000";
            break;
        case "휴대폰":
            f.pay_method.value = "000010000000";
            break;
        case "신용카드":
            f.pay_method.value = "100000000000";
            break;
        default:
            f.pay_method.value = "무통장";
            break;
    }
    <?php } else if($default['de_pg_service'] == 'lg') { ?>
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
        default:
            f.LGD_CUSTOM_FIRSTPAY.value = "무통장";
            break;
    }
    <?php }  else if($default['de_pg_service'] == 'inicis') { ?>
    switch(settle_method)
    {
        case "계좌이체":
            f.gopaymethod.value = "onlydbank";
            break;
        case "가상계좌":
            f.gopaymethod.value = "onlyvbank";
            break;
        case "휴대폰":
            f.gopaymethod.value = "onlyhpp";
            break;
        case "신용카드":
            f.gopaymethod.value = "onlycard";
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
        default:
            f.PayMethod.value = "무통장";
            break;
    }
    <?php } ?>

    // 결제정보설정
    <?php if($default['de_pg_service'] == 'kcp') { ?>
    f.buyr_name.value = f.pp_name.value;
    f.buyr_mail.value = f.pp_email.value;
    f.buyr_tel1.value = f.pp_hp.value;
    f.buyr_tel2.value = f.pp_hp.value;
    f.rcvr_name.value = f.pp_name.value;
    f.rcvr_tel1.value = f.pp_hp.value;
    f.rcvr_tel2.value = f.pp_hp.value;
    f.rcvr_mail.value = f.pp_email.value;

    if(f.pay_method.value != "무통장") {
        jsf__pay( f );
    } else {
        f.submit();
    }
    <?php } ?>
    <?php if($default['de_pg_service'] == 'lg') { ?>
    f.LGD_BUYER.value = f.pp_name.value;
    f.LGD_BUYEREMAIL.value = f.pp_email.value;
    f.LGD_BUYERPHONE.value = f.pp_hp.value;
    f.LGD_AMOUNT.value = f.good_mny.value;
    f.LGD_TAXFREEAMOUNT.value = 0;

    if(f.LGD_CUSTOM_FIRSTPAY.value != "무통장") {
        launchCrossPlatform(f);
    } else {
        f.submit();
    }
    <?php } ?>
    <?php if($default['de_pg_service'] == 'inicis') { ?>
    f.price.value       = f.good_mny.value;
    f.buyername.value   = f.pp_name.value;
    f.buyeremail.value  = f.pp_email.value;
    f.buyertel.value    = f.pp_hp.value;

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
    f.BuyerName.value   = f.pp_name.value;
    f.BuyerEmail.value  = f.pp_email.value;
    f.BuyerTel.value    = f.pp_hp.value;

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
</script>