<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/cart.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert2/sweetalert2.min.css" type="text/css" media="screen">',0);
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
<?php if (!G5_IS_MOBILE) { // 모바일이 아닐경우 ?>
.shop-cart .eyoom-form .checkbox i {top:-8px}
.shop-cart .table-list-eb .table {margin-bottom:0;white-space:nowrap}
.shop-cart .table-list-eb .td-item-desc {position:relative;min-height:80px}
.shop-cart .table-list-eb .td-image {position:absolute;top:0;left:0;width:80px;height:80px;overflow:hidden}
.shop-cart .table-list-eb .td-image img {display:block;max-width:100%;height:auto}
.shop-cart .table-list-eb .td-item-name {margin-left:95px}
.shop-cart .table-list-eb .td-item-name ul {margin:5px 0}
.shop-cart .table-list-eb .td-item-name ul li {color:#959595}
<?php } else { // 모바일의 경우 ?>
.shop-cart .shop-cart-all-select {position:relative;padding:15px;margin-bottom:30px;border:1px solid #757575}
.shop-cart .shop-cart-li-wrap {margin:0 0 30px}
.shop-cart .shop-cart-li-wrap .shop-cart-li {background:#fff;border:1px solid #757575;margin:0 0 20px}
.shop-cart .shop-cart-li-wrap .li-name {position:relative;border-bottom:1px solid #757575;padding:15px 15px 15px 40px;font-size:1.0625rem;font-weight:700}
.shop-cart .shop-cart-li-wrap .li-name .checkbox {position:absolute;top:11px;left:15px}
.shop-cart .shop-cart-li-wrap .li-item-wrap {position:relative;padding:15px;padding-left:110px;min-height:110px}
.shop-cart .shop-cart-li-wrap .li-item-img {position:absolute;top:15px;left:15px;width:80px;height:80px;overflow:hidden}
.shop-cart .shop-cart-li-wrap .li-item-img img {display:block;max-width:100%;height:auto}
.shop-cart .shop-cart-li-wrap .li-opt {padding:0;color:#757575;margin:3px 0 7px;line-height:1.5}
.shop-cart .shop-cart-li-wrap .li-opt li {color:#757575;margin:3px 0;line-height:1.5}
.shop-cart .shop-cart-li-wrap .li-prqty {border-top:1px solid #e5e5e5;padding:15px}
.shop-cart .shop-cart-li-wrap .li-prqty:after {display:block;visibility:hidden;clear:both;content:''}
.shop-cart .shop-cart-li-wrap .li-prqty-sp {float:left;width:50%;display:block;line-height:20px;padding:0 7px;margin-bottom:5px;text-align:right;box-sizing:border-box}
.shop-cart .shop-cart-li-wrap .li-prqty-sp span {float:left}
.shop-cart .shop-cart-li-wrap .prqty-sc, .shop-cart .shop-cart-li-wrap .prqty-price {border-right:1px solid #e5e5e5}
.shop-cart .shop-cart-li-wrap .total-price {background:#f5f5f5;border:1px solid #d5d5d5;display:block;clear:both;margin:0 15px 15px;text-align:right;padding:15px}
.shop-cart .shop-cart-li-wrap .total-price span {float:left;font-weight:700}
.shop-cart .shop-cart-li-wrap .total-price strong {color:#ab0000}
<?php } // if (!G5_IS_MOBILE) END ?>
.shop-cart .shop-cart-total {position:relative;overflow:hidden;clear:both;background:#f2f2f2;border:2px solid #454545;margin-bottom:30px}
.shop-cart .shop-cart-total .cart-total-box {position:relative;float:left;width:33.33333%;height:94px;text-align:center;padding:20px 0;font-size:.9375rem}
.shop-cart .shop-cart-total .cart-total-box:after {content:"";height:54px;width:1px;background:#d5d5d5;position:absolute;top:20px;right:0}
.shop-cart .shop-cart-total .cart-total-box:last-child:after {display:none}
.shop-cart .shop-cart-total .cart-total-box span {display:block;margin-bottom:10px}
.shop-cart .shop-cart-total .cart-total-box strong {color:#000}
.shop-cart .shop-cart-total .cart-total-box .cart-total-price {color:#ab0000;font-size:1.125rem}
.shop-cart .cart-act-btn {margin-top:30px;text-align:center}
/* 영카트 모바일 css 관련 */
#mod_option_frm {position:relative;top:inherit;left:inherit;width:100%;border:0 none}
#mod_option_frm .shop-option {padding:0}
@media (max-width:576px) {
    .shop-cart .shop-cart-total .cart-total-box {font-size:.9375rem}
    .shop-cart .shop-cart-total .cart-total-box .cart-total-price {font-size:.9375rem}
}
</style>

<script src="<?php echo G5_JS_URL; ?>/shop.js?ver=<?php echo G5_JS_VER; ?>"></script>
<script src="<?php echo G5_JS_URL; ?>/shop.override.js?ver=<?php echo G5_JS_VER; ?>"></script>

<div class="shop-steps">
    <ol class="list-inline text-center step-indicator">
        <li class="complete">
            <div class="step"><span class="fas fa-hand-pointer"></span></div>
            <div class="caption">상품선택</div>
        </li>
        <li class="active">
            <div class="step">
                <div class="alarm-marker">
                    <span class="alarm-effect"></span>
                    <span class="alarm-point"></span>
                </div>
                <i class="fas fa-shopping-basket"></i>
            </div>
            <div class="caption">장바구니</div>
        </li>
        <li class="incomplete">
            <div class="step"><i class="fas fa-credit-card"></i></div>
            <div class="caption">주문/결제</div>
        </li>
        <li class="incomplete">
            <div class="step"><i class="fas fa-check"></i></div>
            <div class="caption">주문완료</div>
        </li>
    </ol>
</div>

<div class="shop-cart">
    <form name="frmcartlist" id="sod_bsk_list" class="2017_renewal_itemform eyoom-form" method="post" action="<?php echo $cart_action_url; ?>">

    <?php if (!G5_IS_MOBILE) { // 모바일이 아닐경우 ?>

    <div class="table-list-eb m-b-15">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="width-30px">
                            <label for="ct_all" class="sound_only">상품 전체</label>
                            <label class="checkbox">
                                <input type="checkbox" name="ct_all" value="1" id="ct_all" checked="checked" class="select_chk"><i></i>
                            </label>
                        </th>
                        <th class="tbd-both">상품명</th>
                        <th class="width-100px">총수량</th>
                        <th class="width-100px tbd-both">판매가</th>
                        <th class="width-100px">포인트</th>
                        <th class="width-100px tbd-both">배송비</th>
                        <th class="width-100px">소계</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($count > 0) { ?>
                    <?php for ($i=0; $i<$count; $i++) { ?>
                    <tr>
                        <td>
                            <label for="ct_chk_<?php echo $i; ?>" class="sound_only">상품</label>
                            <label class="checkbox">
                                <input type="checkbox" name="ct_chk[<?php echo $i; ?>]" value="1" id="ct_chk_<?php echo $i; ?>" checked="checked"><i></i>
                            </label>
                        </td>
                        <td class="tbd-both">
                            <div class="td-item-desc">
                                <div class="td-image"><a href="<?php echo shop_item_url($list[$i]['it_id']); ?>"><?php echo $list[$i]['image']; ?></a></div>
                                <div class="td-item-name">
                                    <input type="hidden" name="it_id[<?php echo $i; ?>]"    value="<?php echo $list[$i]['it_id']; ?>">
                                    <input type="hidden" name="it_name[<?php echo $i; ?>]"  value="<?php echo $list[$i]['it_name']; ?>">
                                    <?php if ($list[$i]['it_options']) { ?>
                                    <a href="<?php echo shop_item_url($list[$i]['it_id']); ?>" class="f-s-17r">
                                        <strong><?php echo $list[$i]['it_name']; ?></strong>
                                    </a>
                                    <div><?php echo $list[$i]['it_options']; ?></div>
                                    <div class="m-t-15"><button type="button" class="btn-e btn-e-dark mod_options" data-bs-toggle="modal" data-bs-target="#modal_mod_option">선택사항수정</button></div>
                                    <?php } ?>
                                </div>
                            </div>
                        </td>
                        <td class="text-center"><?php echo number_format($list[$i]['sum_qty']); ?></td>
                        <td class="text-center tbd-both"><?php echo number_format($list[$i]['ct_price']); ?></td>
                        <td class="text-center"><?php echo number_format($list[$i]['point']); ?></td>
                        <td class="text-center tbd-both"><?php echo $list[$i]['ct_send_cost']; ?></td>
                        <td class="text-center"><strong id="sell_price_<?php echo $i; ?>" class="text-crimson"><?php echo number_format($list[$i]['sell_price']); ?></strong></td>
                    </tr>
                    <?php } ?>
                    <?php } else { ?>
                    <tr><td colspan="8" class="text-center"><span class="text-gray"><i class="fas fa-exclamation-circle"></i> 장바구니에 담긴 상품이 없습니다.</span></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php } else { // 모바일의 경우 ?>

    <div class="shop-cart-all-select">
        <label for="ct_all" class="sound_only">상품 전체</label>
        <label class="checkbox">
            <input type="checkbox" name="ct_all" value="1" id="ct_all" checked="checked"><i></i>전체상품 선택
        </label>
    </div>
    <ul class="shop-cart-li-wrap">
    <?php if ($count > 0) { ?>
        <?php for ($i=0; $i<$count; $i++) { ?>
        <li class="shop-cart-li">
            <input type="hidden" name="it_id[<?php echo $i; ?>]"    value="<?php echo $list[$i]['it_id']; ?>">
            <input type="hidden" name="it_name[<?php echo $i; ?>]"  value="<?php echo $list[$i]['it_name']; ?>">
            <div class="li-name">
                <label for="ct_chk_<?php echo $i; ?>" class="sound_only">상품</label>
                <label class="checkbox">
                    <input type="checkbox" name="ct_chk[<?php echo $i; ?>]" value="1" id="ct_chk_<?php echo $i; ?>" checked="checked"><i></i>
                </label>
                <strong><?php echo $list[$i]['it_name']; ?></strong>
            </div>
            <div class="li-item-wrap">
                <div class="li-item-img">
                    <a href="<?php echo shop_item_url($list[$i]['it_id']); ?>">
                        <?php echo $list[$i]['image']; ?>
                    </a>
                </div>
                <div class="li-opt"><?php echo $list[$i]['it_options']; ?></div>
                <div class="li-mod" >
                    <button type="button" class="btn-e btn-e-dark mod_options" data-bs-toggle="modal" data-bs-target="#modal_mod_option">선택사항수정</button>
                </div>
            </div>

            <div class="li-prqty">
                <span class="li-prqty-sp prqty-price"><span>판매가 </span><?php echo number_format($list[$i]['ct_price']); ?></span>
                <span class="li-prqty-sp prqty-qty"><span>수량 </span><?php echo number_format($list[$i]['sum_qty']); ?></span>
                <span class="li-prqty-sp prqty-sc"><span>배송비 </span><?php echo $list[$i]['ct_send_cost']; ?></span>
                <span class="li-prqty-sp total-point"><span>적립포인트 </span><strong><?php echo number_format($list[$i]['point']); ?></strong></span>
            </div>
            <div class="total-price total-span"><span>소계 </span><strong id="sell_price_<?php echo $i; ?>"><?php echo number_format($list[$i]['sell_price']); ?></strong></div>
        </li>
        <?php } ?>
    <?php } else { ?>
        <li class="text-center"><span class="text-gray"><i class="fas fa-exclamation-circle"></i> 장바구니에 담긴 상품이 없습니다.</span></li>
    <?php } ?>
    </ul>

    <?php } // if (!G5_IS_MOBILE) END ?>

    <?php if ($count > 0) { ?>
    <div class="m-b-30">
        <button type="button" onclick="return form_check('seldelete');" class="btn-e btn-e-dark">선택삭제</button>
        <button type="button" onclick="return form_check('alldelete');" class="btn-e btn-e-crimson">전체삭제</button>
    </div>
    <?php } ?>

    <?php if ($tot_price > 0 || $send_cost > 0) { ?>
    <div class="shop-cart-total">
        <div class="cart-total-box">
            <span>배송비</span>
            <strong><?php echo number_format($send_cost); ?></strong> 원
        </div>
        <div class="cart-total-box">
            <span>포인트</span>
            <strong><?php echo number_format($tot_point); ?></strong> 점
        </div>
        <div class="cart-total-box">
            <span>총계 가격</span>
            <strong class="cart-total-price"><?php echo number_format($tot_price); ?></strong> 원
        </div>
    </div>
    <?php } // if G5_IS_MOBILE END ?>

    <div class="cart-act-btn">
        <?php if ($i == 0) { ?>
        <a href="<?php echo G5_SHOP_URL; ?>/" class="btn-e btn-e-brd btn-e-xl btn-e-dark">쇼핑 계속하기</a>
        <?php } else { ?>
        <input type="hidden" name="url" value="<?php echo G5_SHOP_URL; ?>/orderform.php">
        <input type="hidden" name="records" value="<?php echo $i; ?>">
        <input type="hidden" name="act" value="">
        <a href="<?php echo shop_category_url($continue_ca_id); ?>" class="btn-e btn-e-brd btn-e-xl btn-e-dark">쇼핑 계속하기</a>
        <button type="button" onclick="return form_check('buy');" class="btn-e btn-e-xl btn-e-navy"><i class="fas fa-credit-card m-r-5"></i>주문하기</button>

        <?php if ($naverpay_button_js) { ?>
        <div class="cart-naverpay"><?php echo $naverpay_request_js.$naverpay_button_js; ?></div>
        <?php } ?>
        <?php } ?>
    </div>

    </form>
</div>

<div id="modal_mod_option" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-s-20r"><strong>상품옵션 수정</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
$(function() {
    var close_btn_idx;

    // 선택사항수정
    $(".mod_options").click(function() {
        <?php if (!G5_IS_MOBILE) { // 모바일이 아닐경우 ?>
        var it_id = $(this).closest("tr").find("input[name^=it_id]").val();
        <?php } else { // 모바일의 경우 ?>
        var it_id = $(this).closest("li").find("input[name^=it_id]").val();
        <?php } ?>
        var $this = $(this);
        close_btn_idx = $(".mod_options").index($(this));

        $.post(
            "./cartoption.php",
            { it_id: it_id },
            function(data) {
                $("#mod_option_frm").remove();
                $("#modal_mod_option .modal-body").html("<div id=\"mod_option_frm\"></div>");
                $("#mod_option_frm").html(data);
                price_calculate();
            }
        );
    });

    // 모두선택
    $("input[name=ct_all]").click(function() {
        if($(this).is(":checked"))
            $("input[name^=ct_chk]").attr("checked", true);
        else
            $("input[name^=ct_chk]").attr("checked", false);
    });

    // 옵션수정 닫기
    $(document).on("click", ".mod_option_close", function() {
        $("#mod_option_frm").remove();
        $(".mod_options").eq(close_btn_idx).focus();
    });
});

function fsubmit_check(f) {
    if($("input[name^=ct_chk]:checked").length < 1) {
        Swal.fire({
            title: "중요!",
            text: "구매하실 상품을 하나이상 선택해 주십시오.",
            confirmButtonColor: "#ab0000",
            icon: "error",
            confirmButtonText: "확인"
        });
        return false;
    }

    return true;
}

function form_check(act) {
    var f = document.frmcartlist;
    var cnt = f.records.value;

    if (act == "buy") {
        if($("input[name^=ct_chk]:checked").length < 1) {
            Swal.fire({
                title: "중요!",
                text: "주문하실 상품을 하나이상 선택해 주십시오.",
                confirmButtonColor: "#ab0000",
                icon: "error",
                confirmButtonText: "확인"
            });
            return false;
        }

        f.act.value = act;
        f.submit();
    } else if (act == "alldelete") {
        f.act.value = act;
        f.submit();
    } else if (act == "seldelete") {
        if($("input[name^=ct_chk]:checked").length < 1) {
            Swal.fire({
                title: "중요!",
                text: "삭제하실 상품을 하나이상 선택해 주십시오.",
                confirmButtonColor: "#ab0000",
                icon: "error",
                confirmButtonText: "확인"
            });
            return false;
        }

        f.act.value = act;
        f.submit();
    }

    return true;
}
</script>