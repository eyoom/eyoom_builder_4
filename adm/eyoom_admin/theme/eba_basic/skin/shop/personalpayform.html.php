<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shop/personalpayform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'personalpaylist';
$g5_title = '개인결제관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">쇼핑몰관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';

$frm_eba_submit  = ' <div class="confirm-fixed-btn"> ';
$frm_eba_submit .= ' <input type="submit" value="적용하기" class="btn-e btn-e-md btn-e-crimson" accesskey="s">' ;
$frm_eba_submit .= '</div>';
$frm_submit .= $frm_eba_submit;
?>

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

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>주문 정보</strong></div>
        <div class="adm-form-info">
            <div class="cont-text-bg">
                <p class="bg-info">
                    <i class="fas fa-info-circle"></i> 주문 관련 기본 정보입니다.
                </p>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="pp_name" class="label">이름<strong class="sound_only">필수</strong></label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="text" name="pp_name" id="pp_name" value="<?php echo get_text($pp['pp_name']); ?>" required>
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="pp_price" class="label">주문금액<strong class="sound_only">필수</strong></label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <i class="icon-append">원</i>
                    <input type="text" name="pp_price" id="pp_price" value="<?php echo $pp['pp_price']; ?>" class="text-end" required>
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="od_id" class="label">주문번호</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="text" name="od_id" id="od_id" value="<?php echo $pp['od_id'] ? $pp['od_id'] : ''; ?>">
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="pp_content" class="label">내용<strong class="sound_only">필수</strong></label>
            </div>
            <div class="adm-form-td td-r">
                <label class="textarea">
                    <textarea name="pp_content" id="pp_content" rows="8"><?php echo html_purifier($pp['pp_content']); ?></textarea>
                </label>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn-alt m-b-20">
        <?php echo $frm_submit;?>
    </div>

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>결제 정보 목록</strong></div>
        <div class="adm-form-info">
            <div class="cont-text-bg">
                <p class="bg-info">
                    <i class="fas fa-info-circle"></i> 결제 관련 정보입니다.
                </p>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="pp_receipt_price" class="label">결제금액</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <i class="icon-append">원</i>
                    <input type="text" name="pp_receipt_price" id="pp_receipt_price" value="<?php echo $pp['pp_receipt_price'] ? $pp['pp_receipt_price'] : ''; ?>" class="text-end" required>
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="pp_settle_case" class="label">결제방법</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="select max-width-250px">
                    <select name="pp_settle_case" id="pp_settle_case">
                        <option value="" <?php echo get_selected($pp['pp_settle_case'], ''); ?>>선택</option>
                        <option value="무통장" <?php echo get_selected($pp['pp_settle_case'], '무통장'); ?>>무통장</option>
                        <option value="계좌이체" <?php echo get_selected($pp['pp_settle_case'], '계좌이체'); ?>>계좌이체</option>
                        <option value="가상계좌" <?php echo get_selected($pp['pp_settle_case'], '가상계좌'); ?>>가상계좌</option>
                        <option value="신용카드" <?php echo get_selected($pp['pp_settle_case'], '신용카드'); ?>>신용카드</option>
                        <option value="휴대폰" <?php echo get_selected($pp['pp_settle_case'], '휴대폰'); ?>>휴대폰</option>
                    </select><i></i>
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="pp_receipt_time" class="label">결제일시</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="text" name="pp_receipt_time" value="<?php echo is_null_time($pp['pp_receipt_time']) ? "" : $pp['pp_receipt_time']; ?>" id="pp_receipt_time">
                </label>
                <label for="pp_receipt_chk" class="checkbox">
                    <input type="checkbox" name="pp_receipt_chk" id="pp_receipt_chk" value="<?php echo date("Y-m-d H:i:s", G5_SERVER_TIME); ?>" onclick="if (this.checked == true) this.form.pp_receipt_time.value=this.form.pp_receipt_chk.value; else this.form.pp_receipt_time.value = this.form.pp_receipt_time.defaultValue;"><i></i> 현재 시간으로 설정
                </label>
            </div>
        </div>
        <?php if ($cash_receipt) { ?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="pp_receipt_price" class="label">현금영수증</label>
            </div>
            <div class="adm-form-td td-r">
                <a href="javascript:void(0);" onclick="<?php echo $cash_receipt_script; ?>"><?php echo $cash_receipt_text; ?></a>
            </div>
        </div>
        <?php } ?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="pp_shop_memo" class="label">상점메모</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="textarea">
                    <textarea name="pp_shop_memo" id="pp_shop_memo" rows="8"><?php echo html_purifier($pp['pp_shop_memo']); ?></textarea>
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="pp_use" class="label">사용</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="select max-width-250px">
                    <select name="pp_use" id="pp_use">
                        <option value="1" <?php echo get_selected($pp['pp_use'], 1); ?>>사용함</option>
                        <option value="0" <?php echo get_selected($pp['pp_use'], 0); ?>>사용안함</option>
                    </select><i></i>
                </label>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn-alt">
        <?php echo $frm_submit;?>
    </div>
    
    </form>
</div>

<script>
function form_check(f) {
    if(f.pp_price.value.replace(/[0-9]/g, "").length > 0) {
        alert("주문금액은 숫자만 입력해 주십시오");
        return false;
    }

    return true;
}
</script>