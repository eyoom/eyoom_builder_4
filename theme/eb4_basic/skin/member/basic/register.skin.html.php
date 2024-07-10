<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/register.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/perfect-scrollbar/perfect-scrollbar.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert2/sweetalert2.min.css" type="text/css" media="screen">',0);
?>

<style>
.member-skin {font-size:.9375rem}
.member-skin  .content-box {position:relative;border:1px solid #b5b5b5;background:#FFF}
.member-skin  .content-box-header {padding:15px;border-bottom:1px solid #E5E5E5;background:#F5F5F5}
.member-skin  .content-box-header h1, .member-skin  .content-box-header h2, .member-skin  .content-box-header h3, .member-skin  .content-box-header h4, .member-skin  .content-box-header h5, .content-box-header h6 {line-height:1;margin:0}
.member-skin  .content-box-body {padding:15px}
.member-skin  .content-box-body p:last-child {margin-bottom:0}
.member-skin  .content-box-footer {padding:10px 15px;border-top:1px solid #E5E5E5;background:#F5F5F5;text-align:right}
.member-skin #register_scroll_1 {position:relative;overflow:hidden;height:250px}
.member-skin #register_scroll_2 {position:relative;overflow:hidden;height:250px}
.member-skin .member-box {border:1px solid #ddd;margin-bottom:30px}
.member-skin .eyoom-form header {padding:20px 15px;background:#fafafa}
.member-skin .eyoom-form header h5 {line-height:1;font-size:1.125rem}
.member-skin .eyoom-form footer {padding:15px;text-align:right}
.member-skin .eyoom-form fieldset {padding:0}
.member-skin .eyoom-form fieldset {padding:0}
.member-skin .member-agree {padding:15px}
.member-skin .member-agree h5 {font-size:.9375rem}
.member-skin .fregister-agree label {display:inline-block;margin-right:5px}
.member-skin #sns_register {border:1px solid #d5d5d5;box-shadow:none;border-radius:0;margin-bottom:30px}
.member-skin #sns_register h2 {margin:0;padding:15px;font-weight:700;background:#fafafa;font-size:.875rem;line-height:1.5}
</style>

<div class="member-skin contents-box-inner">
    <?php
    // 소셜로그인 사용시 소셜로그인 버튼
    @include_once(get_social_skin_path().'/social_register.skin.php');
    ?>

    <form name="fregister" id="fregister" action="<?php echo $register_action_url; ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off" class="eyoom-form">

    <section class="member-box">
        <header><h5 class="m-0 f-w-700">회원가입약관</h5></header>
        <div class="member-agree">
            <div id="register_scroll_1" class="panel-body ps-container">
                <?php
                @include_once(EYOOM_THEME_PATH . '/page/provision.html.php')
                ?>
            </div>
        </div>
        <footer>
            <fieldset class="fregister-agree">
                <label class="checkbox" for="agree11">
                    <input type="checkbox" name="agree" value="1" id="agree11"><i></i>회원가입약관의 내용에 동의합니다.
                </label>
            </fieldset>
        </footer>
    </section>

    <section class="member-box">
        <header><h5 class="m-0 f-w-700">개인정보처리방침안내</h5></header>
        <div class="member-agree">
            <div id="register_scroll_2" class="panel-body ps-container">
                <?php
                @include_once(EYOOM_THEME_PATH . '/page/privacy.html.php')
                ?>
            </div>
        </div>
        <footer>
            <fieldset class="fregister-agree">
                <label class="checkbox" for="agree21">
                    <input type="checkbox" name="agree2" value="1" id="agree21"><i></i>개인정보처리방침안내의 내용에 동의합니다.
                </label>
            </fieldset>
        </footer>
    </section>

    <div class="content-box m-b-30">
        <div class="content-box-body">
            <div class="fregister-agree text-center">
                <label class="checkbox" for="agree_all">
                    <input type="checkbox" name="agree_all" value="1" id="agree_all"><i></i><span>전체 약관에 동의합니다.</span>
                </label>
            </div>
        </div>
    </div>

    <div class="register-btn-box text-center">
        <button class="btn-e btn-e-xl btn-navy" type="submit" value="회원가입"><i class="fas fa-sign-in-alt"></i> 회원가입</button>
    </div>

    </form>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/perfect-scrollbar/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
$(document).ready(function(){
    new PerfectScrollbar('#register_scroll_1');
    new PerfectScrollbar('#register_scroll_2');
});

function fregister_submit(f) {
    if (!f.agree.checked) {
        Swal.fire({
            title: "중요!",
            text: "회원가입약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.agree.focus();
        return false;
    }
    if (!f.agree2.checked) {
        Swal.fire({
            title: "중요!",
            text: "개인정보처리방침안내의 내용에 동의하셔야 회원가입 하실 수 있습니다.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.agree2.focus();
        return false;
    }
    return true;
}

$(function(){
    $("#agree_all").click(function(){
        if ($(this).is(':checked')) {
            $("input:checkbox[id='agree11']").prop("checked", true);
            $("input:checkbox[id='agree21']").prop("checked", true);
        } else {
            $("input:checkbox[id='agree11']").prop("checked", false);
            $("input:checkbox[id='agree21']").prop("checked", false);
        }
    });
});
</script>