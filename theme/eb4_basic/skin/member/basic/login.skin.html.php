<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/login.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/perfect-scrollbar/perfect-scrollbar.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert2/sweetalert2.min.css" type="text/css" media="screen">',0);
?>

<style>
.eb-login .login-btn {text-align:center;position:relative;overflow:hidden;width:100%;padding:0}
.eb-login .login-btn .btn-e-lg {width:100%;padding:10px 0;border-radius:5px !important;font-weight:bold;font-size:1rem;background:#2d2d38}
.eb-login .login-btn .btn-e-lg:hover {background:#43434d;border:1px solid #43434d}
.login-box {position:relative;padding:30px 20px}
.login-box a:hover {text-decoration:underline}
.login-box .login-box-in {margin:0 auto;width:500px;height:auto;padding:0}
.login-box .login-box-in .login-form {padding:30px 50px;color:#171C29}
.login-box .login-box-in .login-form-margin-bottom {margin-bottom:20px}
.login-box .login-box-in .login-form h1 {font-size:30px;font-weight:700;text-align:center;margin:0 0 30px}
.login-box .login-box-in .login-form .input input::placeholder {color:#b5b5b5}
.login-box .login-box-in .login-form .input .pv-icon {position:absolute;top:8px;right:45px;cursor:pointer}
.login-box .login-box-in .login-form .input .pv-icon.is-active i {display:none}
.login-box .login-box-in .login-form .input .pv-icon.is-active:after {font-family:'Font Awesome\ 5 Free';content:"\f070";font-weight:900}
.login-box .login-box-in .login-link {text-align:right}
.login-box .login-box-in .login-link a {font-size:.9375rem}
.login-box .login-box-in .login-link a:hover {text-decoration:underline;color:#000}
.login-box .login-box-in .login-link a:before {content:"|";margin-left:7px;margin-right:7px;color:#d5d5d5}
.login-box .login-box-in .login-link a:first-child:before {display:none}
.login-box .login-box-in #sns_login h5 {text-align:center;color:#353535;font-size:.9375rem;margin-bottom:15px}
.login-box .login-box-in .non-members {padding:30px 50px;color:#171C29}
.login-box .login-box-in .non-members .scroll-box-login {position:relative;overflow:hidden;border:1px solid #b5b5b5;padding:10px;height:150px}
.login-box .login-box-in .non-member-order {padding:30px 50px;color:#171C29}
.eyoom-form .btn-e {box-sizing:border-box;-moz-box-sizing:border-box}
@media (max-width: 991px) {
    .login-box .login-box-in .login-form {padding:30px 50px}
    .login-box .login-box-in .non-members {padding:30px 50px}
    .login-box .login-box-in .non-member-order {padding:90px 60px}
}
@media (max-width: 767px) {
    .login-box .login-box-in {height:auto}
    .login-box .login-box-in .login-form {padding:30px 20px;margin-right:0}
    .login-box .login-box-in .login-form-margin-bottom {margin-bottom:10px}
    .login-box .login-box-in .login-form h1 {font-size:30px}
    .login-box .login-box-in .login-sidebar {display:none}
    .login-box .login-box-in .non-members {padding:30px 20px}
    .login-box .login-box-in .non-member-order {padding:40px 20px}
}
@media (max-width: 576px) {
    .login-box {width:100%}
    .login-box .login-box-in {width:100%}
}
</style>

<div class="eb-login">
    <div class="login-content">
        <div class="login-box">
            <div class="login-box-in">
                <div class="login-form">
                    <h1>로그인</h1>
                    <form name="flogin" action="<?php echo $login_action_url;?>" onsubmit="return flogin_submit(this);" method="post" class="eyoom-form">
                    <input type="hidden" name="url" value='<?php echo $login_url; ?>'>
                    <section>
                        <label for="mb_id" class="label">아이디</label>
                        <label class="input">
                            <i class="icon-append fas fa-user"></i>
                            <input type="text" class="form-control" id="mb_id" name="mb_id" placeholder="ID" required class="frm_input required" size="20" maxLength="20">
                        </label>
                    </section>
                    <div class="login-form-margin-bottom"></div>
                    <section>
                        <label for="mb_password" class="label">비밀번호</label>
                        <label class="input">
                            <i class="icon-append fas fa-lock"></i>
                            <input type="password" class="form-control" id="mb_password" name="mb_password" placeholder="Password" required class="frm_input required" size="20" maxLength="20">
                            <span class="pv-icon" data-toggle="password" data-target="#mb_password" data-class-active="is-active"><i class="fas fa-eye"></i></span>
                        </label>
                    </section>
                    <div class="login-form-margin-bottom"></div>
                    <label class="checkbox">
                        <input type="checkbox" name="auto_login" id="login_auto_login"><i></i>자동로그인
                    </label>
                    <div class="m-b-20"></div>
                    <div class="login-link m-b-10">
                        <a href="<?php echo G5_BBS_URL; ?>/register.php">회원가입</a>
                        <a href="<?php echo G5_BBS_URL; ?>/password_lost.php?wmode=1" id="ol_password_lost">아이디/비밀번호찾기</a>
                    </div>
                    <div class="login-btn">
                        <button type="submit" value="로그인" class="btn-e btn-e-dark btn-e-lg btn-block">로그인</button>
                    </div>

                    <?php
                    // 소셜로그인 사용시 소셜로그인 버튼
                    @include_once($eyoom_skin_path['member'].'/social_login.skin.html.php');
                    ?>

                    <div class="text-center m-t-20">
                        <a href="<?php echo G5_URL; ?>">메인으로 돌아가기</a>
                    </div>
                    </form>
                </div>
            </div>

            <?php /* 쇼핑몰 비회원 구매 시작 */ ?>
            <?php if (isset($default['de_level_sell']) && $default['de_level_sell'] == 1) { ///#1) ?>

            <?php if (preg_match('/orderform.php/',$url)) { ///#2) ?>
            <div class="m-b-30"></div>
            <div class="login-box-in">
                <div class="non-members">
                    <div class="text-center m-b-30"><h4><strong>비회원 구매</strong></h4></div>
                    <div class="cont-text-bg m-b-20">
                        <p class="bg-info f-s-13r"><i class="fas fa-exclamation-circle"></i> 비회원으로 주문하시는 경우 포인트는 지급하지 않습니다.</p>
                    </div>

                    <div id="scrollbar" class="scroll-box-login m-b-10">
                        <?php echo $default['de_guest_privacy'];?>
                    </div>

                    <div class="eyoom-form">
                        <label class="checkbox" for="agree">
                            <input type="checkbox" id="agree" value="1"><i></i><span class="f-s-12">개인정보수집에 대한 내용을 읽었으며 이에 동의합니다.</span>
                        </label>
                    </div>

                    <div class="login-btn m-t-15 text-center">
                        <a href="javascript:guest_submit(document.flogin);" class="btn-e btn-e-dark btn-e-lg btn-block">비회원으로 구매하기</a>
                    </div>

                    <script>
                    function guest_submit(f) {
                        if (document.getElementById('agree')) {
                            if (!document.getElementById('agree').checked) {
                                Swal.fire({
                                    title: "중요!",
                                    text: "개인정보수집에 대한 내용을 읽고 이에 동의하셔야 합니다.",
                                    confirmButtonColor: "#FF2900",
                                    type: "error",
                                    confirmButtonText: "확인"
                                });
                                return;
                            }
                        }

                        f.url.value = "<?php echo $url;?>";
                        f.action = "<?php echo $url;?>";
                        f.submit();
                    }
                    </script>
                </div>
            </div>
            <?php } else if (preg_match('/orderinquiry.php$/',$url)) { ///#2 ?>
            <div class="m-b-30"></div>
            <div class="login-box-in">
                <div class="non-member-order">
                    <div class="text-center m-b-30"><h4><strong>비회원 주문조회</strong></h4></div>
                    <form name="forderinquiry" method="post" action="<?php echo urldecode($url); ?>" autocomplete="off" class="eyoom-form">
                    <section>
                        <label for="od_id" class="label">주문서번호<strong class="sound_only"> 필수</strong></label>
                        <label class="input">
                            <i class="icon-append fas fa-shopping-cart"></i>
                            <input type="text" class="form-control" placeholder="Order Number" name="od_id" value="<?php echo $od_id;?>" id="od_id" required size="20">
                        </label>
                    </section>
                    <div class="login-form-margin-bottom"></div>
                    <section>
                        <label for="id_pwd" class="label">비밀번호<strong class="sound_only"> 필수</strong></label>
                        <label class="input">
                            <i class="icon-append fas fa-lock"></i>
                            <input type="password" class="form-control" placeholder="Password" name="od_pwd" size="20" id="od_pwd" required>
                        </label>
                    </section>
                    <div class="login-form-margin-bottom"></div>
                    <div class="login-btn m-b-20">
                        <input class="btn-e btn-e-dark btn-e-lg btn-block" type="submit" value="확인">
                    </div>
                    </form>
                    <div class="cont-text-bg m-b-20">
                        <p class="bg-danger f-s-13r">
                            <strong class="text-black"><i class="fas fa-exclamation-circle"></i> 비회원 주문조회 안내</strong><br>
                            메일로 발송해드린 주문서의 <strong>주문번호</strong> 및 주문 시 입력하신 <strong>비밀번호</strong>를 정확히 입력해주십시오.
                        </p>
                    </div>
                </div>
            </div>
            <?php } //#2 ?>

            <?php } //#1 ?>
            <?php /* 쇼핑몰 비회원 구매 끝 */ ?>
        </div>
    </div>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/perfect-scrollbar/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + $(window).scrollLeft()) + "px");
    return this;
}
$('.login-box').center();

<?php if (preg_match('/orderform.php/',$url)) { ///#2) ?>
$(document).ready(function(){
    new PerfectScrollbar('#scrollbar');
});
<?php } ?>

document.querySelectorAll('[data-toggle="password"]').forEach(function (el) {
    el.addEventListener("click", function (e) {
        e.preventDefault();

        var target = el.dataset.target;
        document.querySelector(target).focus();

        if (document.querySelector(target).getAttribute('type') == 'password') {
            document.querySelector(target).setAttribute('type', 'text');
        } else {
            document.querySelector(target).setAttribute('type', 'password');
        }

        if (el.dataset.classActive) el.classList.toggle(el.dataset.classActive);
    });
});

jQuery(function($){
    $("#login_auto_login").click(function(){
        if ($(this).is(":checked")) {
            Swal.fire({
                title: "알림",
                html: "<div class='alert alert-info text-start f-s-13r'>자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.<br><br>공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.</div><span>자동로그인을 사용하시겠습니까?</span>",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#ab0000",
                confirmButtonText: "확인",
                cancelButtonText: "취소"
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#login_auto_login").attr("checked");
                } else {
                    $("#login_auto_login").removeAttr("checked");
                }
            });
        }
    });
});

function flogin_submit(f) {
    if( $( document.body ).triggerHandler( 'login_sumit', [f, 'flogin'] ) !== false ){
        return true;
    }
    return false;
}

<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$is_iphone = (strpos($user_agent, 'iPhone') !== false);
$is_ipad = (strpos($user_agent, 'iPad') !== false);

if ($is_iphone || $is_ipad) {
?>
$(document).ready(function(){
    var touchStartTimestamp = 0;
    
    $("input, textarea, select").on('touchstart', function(event) {
        zoomDisable();
        touchStartTimestamp = event.timeStamp;
    });

    $("input, textarea, select").on('touchend', function(event) {
        var touchEndTimestamp = event.timeStamp;
        if (touchEndTimestamp - touchStartTimestamp > 500) {
            setTimeout(zoomEnable, 500);
        } else {
            zoomDisable();
            setTimeout(zoomEnable, 500);
        }
    });

    function zoomDisable(){
        $('head meta[name=viewport]').remove();
        $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">');
    }

    function zoomEnable(){
        $('head meta[name=viewport]').remove();
        $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1">');
    }
});
<?php } ?>
</script>