<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/member/mail_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<style>
.adm-basic-form-wrap {position:relative;border:1px solid #dadada;background:#fff;padding:10px}
</style>

<div class="admin-mail-form">
    <form name="fmailform" id="fmailform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fmailform_check(this);" class="eyoom-form">
    <input type="hidden" name="w" id="w" value="<?php echo $w; ?>">
    <input type="hidden" name="ma_id" id="ma_id" value="<?php echo $ma_id; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-headline">
        <h3><?php echo $html_title; ?></h3>
    </div>

    <div class="cont-text-bg">
        <p class="bg-info font-size-12"><i class="fas fa-info-circle"></i> 메일 내용에 {이름} , {닉네임} , {회원아이디} , {이메일} 처럼 내용에 삽입하면 해당 내용에 맞게 변환하여 메일을 발송합니다.</p>
    </div>
    <div class="margin-bottom-20"></div>

    <div class="adm-basic-form-wrap">
        <label for="ma_subject" class="label">메일 제목</label>
        <label class="input margin-bottom-20">
            <input type="text" name="ma_subject" id="ma_subject" value="<?php echo get_sanitize_input($ma['ma_subject']); ?>" required>
        </label>
        <label class="label">메일 내용</label>
        <label class="textarea">
            <?php echo editor_html("ma_content", get_text(html_purifier($ma['ma_content']), 0)); ?>
        </label>
    </div>

    <?php echo $frm_submit; ?>

    </form>
</div>

<script>
function fmailform_check(f) {
    errmsg = "";
    errfld = "";

    check_field(f.ma_subject, "제목을 입력하세요.");

    if (errmsg != "") {
        alert(errmsg);
        errfld.focus();
        return false;
    }

    <?php echo get_editor_js('ma_content'); ?>
    <?php echo chk_editor_js('ma_content'); ?>

    return true;
}

document.form.ma_subject.focus();
</script>