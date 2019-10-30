<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shop/personalpayform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<style>
.scf_cardtest_hide {display:none}
.scf_cardtest_tip_adm_hide {display:none}
@media (min-width: 1100px) {
    .pg-anchor-in.tab-e2 .nav-tabs li a {font-size:14px;font-weight:bold;padding:8px 17px}
    .pg-anchor-in.tab-e2 .nav-tabs li.active a {z-index:1;border:1px solid #000;border-top:1px solid #DE2600;color:#DE2600}
    .pg-anchor-in.tab-e2 .tab-bottom-line {position:relative;display:block;height:1px;background:#000;margin-bottom:20px}
}
@media (max-width: 1099px) {
    .pg-anchor-in {position:relative;overflow:hidden;margin-bottom:20px;border:1px solid #757575}
    .pg-anchor-in.tab-e2 .nav-tabs li {width:33.33333%;margin:0}
    .pg-anchor-in.tab-e2 .nav-tabs li a {font-size:12px;padding:6px 0;text-align:center;border-bottom:1px solid #d5d5d5;margin-right:0;font-weight:bold;background:#fff}
    .pg-anchor-in.tab-e2 .nav-tabs li.active a {border:0;border-bottom:1px solid #d5d5d5 !important;color:#DE2600;background:#fff1f0}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(1) a {border-right:1px solid #d5d5d5;border-bottom:0 !important}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(2) a {border-right:1px solid #d5d5d5;border-bottom:0 !important}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(3) a {border-bottom:0 !important}
    .pg-anchor-in.tab-e2 .tab-bottom-line {display:none}
}
</style>

<div class="admin-shop-personalpayform">
    <form name="fpersonalpayform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return form_check(this);" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="pp_id" value="<?php echo $pp_id; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
    <?php if ($wmode) { ?>
    <input type="hidden" name="pp_use" value="1">
    <?php } ?>

    <?php if (!$wmode) { ?>
    <div class="adm-headline">
        <h3>개인결제 관리 <?php echo $wrp_tag_st; ?></h3>
    </div>
    <?php } ?>

    <div id="anc_spp_info">
        <?php if (!$wmode) { ?>
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_spp_info'); ?>
        </div>
        <?php } ?>

        <div class="adm-table-form-wrap margin-bottom-30">
            <header class="border-bottom-1px"><strong><i class="fas fa-caret-right"></i> 주문 정보</strong></header>
            <fieldset>
                <div class="cont-text-bg">
                    <p class="bg-danger font-size-12 margin-bottom-0">
                        <i class="fas fa-info-circle"></i> 주문 관련 기본 정보입니다.
                    </p>
                </div>
            </fieldset>

            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label for="pp_name" class="label">이름<strong class="sound_only">필수</strong></label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="pp_name" id="pp_name" value="<?php echo get_text($pp['pp_name']); ?>" required>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="pp_price" class="label">주문금액<strong class="sound_only">필수</strong></label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <i class="icon-append">원</i>
                                    <input type="text" name="pp_price" id="pp_price" value="<?php echo $pp['pp_price']; ?>" required>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="od_id" class="label">주문번호</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="od_id" id="od_id" value="<?php echo $pp['od_id'] ? $pp['od_id'] : ''; ?>">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="pp_content" class="label">내용<strong class="sound_only">필수</strong></label>
                            </th>
                            <td>
                                <label class="textarea">
                                    <textarea name="pp_content" id="pp_content" rows="8"><?php echo html_purifier($pp['pp_content']); ?></textarea>
                                </label>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php if (!G5_IS_MOBILE) { ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php echo $frm_submit; // 버튼 ?>

    <?php if (!$wmode) { ?>

    <div id="anc_spp_pay">
        <?php if (!$wmode) { ?>
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_spp_pay'); ?>
        </div>
        <?php } ?>

        <div class="adm-table-form-wrap margin-bottom-30">
            <header class="border-bottom-1px"><strong><i class="fas fa-caret-right"></i> 결제 정보 목록</strong></header>
            <fieldset>
                <div class="cont-text-bg">
                    <p class="bg-danger font-size-12 margin-bottom-0">
                        <i class="fas fa-info-circle"></i> 결제 관련 정보입니다.
                    </p>
                </div>
            </fieldset>

            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label for="pp_receipt_price" class="label">결제금액</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <i class="icon-append">원</i>
                                    <input type="text" name="pp_receipt_price" id="pp_receipt_price" value="<?php echo $pp['pp_receipt_price'] ? $pp['pp_receipt_price'] : ''; ?>" required>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="pp_settle_case" class="label">결제방법</label>
                            </th>
                            <td>
                                <label class="select form-width-250px">
                                    <select name="pp_settle_case" id="pp_settle_case">
                                        <option value="" <?php echo get_selected($pp['pp_settle_case'], ''); ?>>선택</option>
                                        <option value="무통장" <?php echo get_selected($pp['pp_settle_case'], '무통장'); ?>>무통장</option>
                                        <option value="계좌이체" <?php echo get_selected($pp['pp_settle_case'], '계좌이체'); ?>>계좌이체</option>
                                        <option value="가상계좌" <?php echo get_selected($pp['pp_settle_case'], '가상계좌'); ?>>가상계좌</option>
                                        <option value="신용카드" <?php echo get_selected($pp['pp_settle_case'], '신용카드'); ?>>신용카드</option>
                                        <option value="휴대폰" <?php echo get_selected($pp['pp_settle_case'], '휴대폰'); ?>>휴대폰</option>
                                    </select><i></i>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="pp_receipt_time" class="label">결제일시</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="pp_receipt_time" value="<?php echo is_null_time($pp['pp_receipt_time']) ? "" : $pp['pp_receipt_time']; ?>" id="pp_receipt_time">
                                </label>
                                <label for="pp_receipt_chk" class="checkbox">
                                    <input type="checkbox" name="pp_receipt_chk" id="pp_receipt_chk" value="<?php echo date("Y-m-d H:i:s", G5_SERVER_TIME); ?>" onclick="if (this.checked == true) this.form.pp_receipt_time.value=this.form.pp_receipt_chk.value; else this.form.pp_receipt_time.value = this.form.pp_receipt_time.defaultValue;"><i></i> 현재 시간으로 설정
                                </label>
                            </td>
                        </tr>
                        <?php if ($cash_receipt) { ?>
                        <tr>
                            <th class="table-form-th">
                                <label for="pp_receipt_price" class="label">현금영수증</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <a href="javascript:;" onclick="<?php echo $cash_receipt_script; ?>"><?php echo $cash_receipt_text; ?></a>
                                </label>
                            </td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <th class="table-form-th">
                                <label for="pp_shop_memo" class="label">상점메모</label>
                            </th>
                            <td>
                                <label class="textarea">
                                    <textarea name="pp_shop_memo" id="pp_shop_memo" rows="8"><?php echo $pp['pp_shop_memo']; ?></textarea>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="pp_use" class="label">사용</label>
                            </th>
                            <td>
                                <label class="select form-width-250px">
                                    <select name="pp_use" id="pp_use">
                                        <option value="1" <?php echo get_selected($pp['pp_use'], 1); ?>>사용함</option>
                                        <option value="0" <?php echo get_selected($pp['pp_use'], 0); ?>>사용안함</option>
                                    </select><i></i>
                                </label>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php if (!G5_IS_MOBILE) { ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php echo $frm_submit; // 버튼 ?>
    
    <?php } ?>

    </form>
</div>

<script>
$('.pg-anchor a').on('click', function(e) {
    e.stopPropagation();
    var scrollTopSpace;
    if (window.innerWidth >= 1100) {
        scrollTopSpace = 70;
    } else {
        scrollTopSpace = 70;
    }
    var tabLink = $(this).attr('href');
    var offset = $(tabLink).offset().top;
    $('html, body').animate({scrollTop : offset - scrollTopSpace}, 500);
    return false;
});

function form_check(f) {
    if(f.pp_price.value.replace(/[0-9]/g, "").length > 0) {
        alert("주문금액은 숫자만 입력해 주십시오");
        return false;
    }

    return true;
}
</script>