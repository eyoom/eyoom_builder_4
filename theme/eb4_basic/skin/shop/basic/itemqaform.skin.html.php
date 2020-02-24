<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/itemqaform.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/fontawesome5/css/fontawesome-all.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/eyoom-form/css/eyoom-form.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/common.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/style.css" type="text/css" media="screen">',0);
?>

<style>
.shop-product-qa-write {position:relative;overflow:hidden;padding:0 5px}
.shop-product-qa-write .win-title {position:relative;margin:0 0 20px;font-size:16px;height:50px;line-height:30px;padding:10px;background:#555;color:#fff;margin-bottom:30px}
.shop-product-qa-write .win-close-btn {position:absolute;top:10px;right:10px;width:30px;height:30px;line-height:30px;text-align:center;margin:0;padding:0;border:0;background:none;color:#fff}
.shop-product-qa-write .radio {width:60px}
.shop-product-qa-write .write-edit-wrap #is_content {display:block;box-sizing:border-box;-moz-box-sizing:border-box;width:100%;min-height:200px;padding:6px 10px;outline:none;border-width:1px;border-style:solid;border-radius:0;background:#FFF;color:#353535;appearance:normal;-moz-appearance:none;-webkit-appearance:none;resize:vertical}
/* Smart Editor */
.cke_sc {margin-bottom:10px !important}
.btn_cke_sc {padding:0 10px}
.cke_sc_def {padding:10px;margin-bottom:10px;margin-top:10px;background:#fbfbfb}
.cke_sc_def button {padding:3px 15px;background:#555555;color:#fff;border:none}
<?php if (G5_IS_MOBILE) { ?>
.shop-product-qa-write {padding:20px 15px}
<?php } ?>
</style>

<?php /* ---------- 사용후기 쓰기 시작 ---------- */ ?>
<div class="shop-product-qa-write">
    <h1 class="win-title">
        상품문의 쓰기
        <?php if (G5_IS_MOBILE) { ?>
        <button type="button" onclick="self.close();" class="win-close-btn"><i class="fas fa-times"></i></button>
        <?php } ?>
    </h1>

    <form name="fitemqa" method="post" action="<?php echo G5_SHOP_URL; ?>/itemqaformupdate.php" onsubmit="return fitemqa_submit(this);" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="it_id" value="<?php echo $it_id; ?>">
    <input type="hidden" name="iq_id" value="<?php echo $iq_id; ?>">

    <div class="product-qa-write">
        <div class="margin-bottom-20">
            <label for="iq_secret" class="sound_only">옵션</label>
            <label class="checkbox">
                <input type="checkbox" name="iq_secret" id="iq_secret" value="1" <?php echo $chk_secret; ?>><i></i>비밀글
            </label>

        </div>
        <div class="margin-bottom-20">
            <div class="row">
                <div class="col col-6">
                    <label for="iq_email" class="sound_only">이메일</label>
                    <label class="input">
                        <i class="icon-append far fa-envelope"></i>
                        <input type="text" name="iq_email" id="iq_email" value="<?php echo get_text($qa['iq_email']); ?>" size="30" placeholder="이메일">
                    </label>
                    <div class="note">이메일을 입력하시면 답변 등록 시 답변이 이메일로 전송됩니다.</div>
                </div>
                <div class="col col-6">
                    <label for="iq_hp" class="sound_only">휴대폰</label>
                    <label class="input">
                        <i class="icon-append fas fa-mobile-alt"></i>
                        <input type="text" name="iq_hp" id="iq_hp" value="<?php echo get_text($qa['iq_hp']); ?>" size="20" placeholder="휴대폰">
                    </label>
                    <div class="note">휴대폰번호를 입력하시면 답변 등록 시 답변등록 알림이 SMS로 전송됩니다.</div>
                </div>
            </div>
        </div>
        <div class="margin-bottom-20">
            <label for="iq_subject" class="sound_only">제목<strong> 필수</strong></label>
            <label class="input required-mark">
                <input type="text" name="iq_subject" value="<?php echo get_text($qa['iq_subject']); ?>" id="iq_subject" required maxlength="250" placeholder="제목">
            </label>
        </div>
        <div class="margin-bottom-30">
            <label class="sound_only">질문</label>
            <div class="write-edit-wrap">
                <?php echo $editor_html; ?>
            </div>
        </div>

        <div class="text-center">
            <input type="submit" value="작성완료" class="btn-e btn-e-xlg btn-e-red">
            <?php if (G5_IS_MOBILE) { ?>
            <button type="button" onclick="self.close();" class="btn-e btn-e-xlg btn-e-dark">닫기</button>
            <?php } ?>
        </div>
    </div>

    </form>
</div>

<script type="text/javascript">
function fitemqa_submit(f) {
    <?php echo $editor_js; ?>

    return true;
}
</script>
<?php /* ---------- 상품문의 쓰기 시작 ---------- */ ?>