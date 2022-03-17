<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 비밀번호 재설정 시작 { -->
<div id="pw_reset" class="new_win">
    <div class="new_win_con">
        <form name="fpasswordreset" action="<?php echo $action_url; ?>" onsubmit="return fpasswordreset_submit(this);" method="post" autocomplete="off" class="eyoom-form">
            <section>
                <label class="label">아이디</label>
                <label class="input">
                    <i class="icon-append fas fa-user"></i>
                    <input type="text" class="form-control" name="mb_id" required class="frm_input required" size="20" maxLength="20" value="<?php echo $_POST['mb_id']; ?>" readonly>
                </label>
            </section>
            <div class="login-form-margin-bottom"></div>
            <section>
                <label class="label">새 비밀번호</label>
                <label class="input">
                    <i class="icon-append fas fa-lock"></i>
                    <input type="password" class="form-control" id="mb_pw" name="mb_password" required class="frm_input required" size="20" maxLength="20">
                </label>
            </section>
            <div class="login-form-margin-bottom"></div>
            <section>
                <label class="label">새 비밀번호 확인</label>
                <label class="input">
                    <i class="icon-append fas fa-lock"></i>
                    <input type="password" class="form-control" id="mb_pw2" name="mb_password_re" required class="frm_input required" size="20" maxLength="20">
                </label>
            </section>

            <div class="login-btn">
                <button type="submit" value="확인" class="btn-e btn-e-dark btn-e-lg btn-block">확인</button>
            </div>
        </form>
    </div>
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
<!-- } 비밀번호 재설정 끝 -->