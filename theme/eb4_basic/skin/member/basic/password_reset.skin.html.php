<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/password_reset.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.password-reset {position:relative;width:360px;padding:15px;margin:50px auto;border:1px solid #d5d5d5}
@media (max-width:576px) {
    .password-reset {width:100%;margin:30px auto}
}
</style>

<div class="password-reset">
    <div class="alert alert-warning">
        <p><i class="fas fa-exclamation-circle"></i> 새로운 비밀번호를 입력해주세요.</p>
    </div>
    <form name="fpasswordreset" action="<?php echo $action_url; ?>" onsubmit="return fpasswordreset_submit(this);" method="post" autocomplete="off" class="eyoom-form">
    <section>
        <label for="mb_id" class="label">아이디</label>
        <label class="input state-disabled">
            <i class="icon-append fas fa-user"></i>
            <input type="text" name="mb_id" size="20" maxLength="20" value="<?php echo get_text($_POST['mb_id']); ?>" readonly>
        </label>
    </section>
    <section>
        <label for="mb_pw" class="label">새 비밀번호</label>
        <label class="input required-mark">
            <i class="icon-append fas fa-lock"></i>
            <input type="password" id="mb_pw" name="mb_password" required size="20" maxLength="20">
        </label>
    </section>
    <section>
        <label for="mb_pw2" class="label">새 비밀번호 확인</label>
        <label class="input required-mark">
            <i class="icon-append fas fa-lock"></i>
            <input type="password" id="mb_pw2" name="mb_password_re" required size="20" maxLength="20">
        </label>
    </section>
    <div class="text-center m-t-20">
        <button type="submit" value="확인" class="btn-e btn-e-navy btn-e-lg btn-block">확인</button>
    </div>
    </form>
</div>

<script>
function fpasswordreset_submit(f) {
    if ($("#mb_pw").val() == $("#mb_pw2").val()) {
        alert("비밀번호 변경되었습니다. 다시 로그인해 주세요.");
    } else {
        alert("새 비밀번호와 비밀번호 확인이 일치하지 않습니다.");
        return false;
    }
}
</script>