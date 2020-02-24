<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/login.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/fontawesome5/css/fontawesome-all.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/eyoom-form/css/eyoom-form.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/perfect-scrollbar/perfect-scrollbar.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert/sweetalert.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/common.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/style.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/custom.css" type="text/css" media="screen">',0);

/**
 * 로그인 백그라운드 타입 : 'color' || 'image'
 */
$login_background = 'image';

/**
 * 로그인 사이드바 타입 : 'color' || 'image'
 */
$login_sidebar = 'image';
?>

<style>
.eb-login .eyoom-form .input input {height:34px;font-size:13px}
.eb-login .eyoom-form .icon-append,.member-login .eyoom-form .icon-prepend {width:33px;height:32px;line-height:32px;font-size:14px}
.eb-login .eyoom-form .input .icon-append + input {padding-right:48px;font-size:14px}
.eb-login .login-btn {text-align:center;position:relative;overflow:hidden;width:100%;padding:0}
.eb-login .login-btn .btn-e-lg {width:100%;padding:10px 0;border-radius:2px !important;font-weight:bold;font-size:16px;background:#2d2d38}
.eb-login .login-btn .btn-e-lg:hover {background:#43434d;border:1px solid #43434d}
.login-box {color:#fff;padding:30px 20px;width:100%;position:relative;z-index:1}
.login-box a:hover {text-decoration:underline}
.login-box .login-box-in {margin:0 auto;background:rgba(255, 255, 255, 0.9);margin-bottom:0;max-width:940px;padding:0;height:auto;position:relative;overflow:hidden}
.login-box .login-box-in .login-form {padding:30px 120px;color:#171C29;margin-right:300px}
.login-box .login-box-in .login-form-margin-bottom {margin-bottom:20px}
.login-box .login-box-in .login-form h1 {font-size:42px;font-weight:bold;text-align:center;margin:10px 0 20px}
.login-box .login-box-in .login-link {text-align:right}
.login-box .login-box-in .login-link a {font-size:13px}
.login-box .login-box-in .login-link a:hover {text-decoration:none}
.login-box .login-box-in .login-link a:before {content:"|";margin-left:7px;margin-right:7px;color:#d5d5d5}
.login-box .login-box-in .login-link a:first-child:before {display:none}
.login-box .login-box-in #sns_login h5 {text-align:center;color:#353535;font-size:13px;margin-bottom:15px}
.login-box .login-box-in .login-sidebar {width:300px;background:#757578;position:absolute;top:0;right:0;bottom:0;background-size:cover;background-position:center center}
.login-box .login-box-in .login-sidebar-opacity:after {content:"";position:absolute;z-index:1;top:0;left:0;width:100%;height:100%;background:rgba(0, 0, 0, 0.4)}
.login-box .login-box-in .login-sidebar-content {position:absolute;top:0;left:0;z-index:2;padding:50px 40px 40px}
.login-box .login-box-in .login-sidebar-content-title {margin-bottom:20px;font-size:24px;font-weight:bold}
.login-box .login-box-in .login-sidebar-content-item {padding-left:20px;border-left:2px solid #83848b;margin-bottom:20px;color:#fff}
.login-box .login-box-in .login-sidebar-bottom {font-size:11px;font-weight:200;position:absolute;z-index:2;bottom:40px;left:40px}
.login-box .login-box-in .non-members {padding:30px 120px;color:#171C29}
.login-box .login-box-in .non-members .scroll-box-login {position:relative;overflow:hidden;border:1px solid #b5b5b5;padding:10px;height:150px}
.login-box .login-box-in .non-member-order {padding:90px 120px;color:#171C29}
.login-box .login-box-in .non-members .btn-e-lg {width:250px;padding:10px 0;border-radius:2px !important;font-weight:bold;font-size:16px}
.login-box .login-box-in .non-members .btn-e-lg:hover {text-decoration:none}
.eyoom-form .btn-e {box-sizing:border-box;-moz-box-sizing:border-box}
@media (max-width: 991px) {
    .login-box .login-box-in .login-form {padding:30px 60px}
    .login-box .login-box-in .non-members {padding:30px 60px}
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

<?php if ($login_background == 'color') { ?>
.backstretch {background:#e2e2e2}
.backstretch img {display:none !important}
<?php } ?>
</style>

<div class="eb-login">
    <div class="login-content">
        <div class="login-box">
            <div class="login-box-in">
                <div class="login-form">
                    <h1>LOGIN</h1>
                    <form name="flogin" action="<?php echo $login_action_url;?>" onsubmit="return flogin_submit(this);" method="post" class="eyoom-form">
                    <input type="hidden" name="url" value='<?php echo $login_url;?>'>
                    <section>
                        <label class="label"><strong class="font-size-14">아이디</strong></label>
                        <label class="input">
                            <i class="icon-append fas fa-user"></i>
                            <input type="text" class="form-control" name="mb_id" placeholder="ID" required class="frm_input required" size="20" maxLength="20">
                        </label>
                    </section>
                    <div class="login-form-margin-bottom"></div>
                    <section>
                        <label class="label"><strong class="font-size-14">비밀번호</strong></label>
                        <label class="input">
                            <i class="icon-append fas fa-lock"></i>
                            <input type="password" class="form-control" name="mb_password" placeholder="Password" required class="frm_input required" size="20" maxLength="20">
                        </label>
                    </section>
                    <div class="login-form-margin-bottom"></div>
                    <label class="checkbox">
                        <input type="checkbox" name="auto_login" id="login_auto_login"><i></i>자동로그인
                    </label>
                    <div class="margin-bottom-20"></div>
                    <div class="login-link margin-bottom-10">
                        <a href="<?php echo G5_BBS_URL; ?>/register.php">회원가입</a>
                        <a href="<?php echo G5_BBS_URL;?>/password_lost.php" id="ol_password_lost">아이디/비밀번호찾기</a>
                    </div>
                    <div class="login-btn">
                        <button type="submit" value="로그인" class="btn-e btn-e-dark btn-e-lg btn-block">로그인</button>
                    </div>

                    <?php
                    // 소셜로그인 사용시 소셜로그인 버튼
                    @include_once($eyoom_skin_path['member'].'/social_login.skin.html.php');
                    ?>

                    <div class="text-center margin-top-20">
                        <a href="<?php echo G5_URL;?>"><strong class="font-size-13">메인으로 돌아가기</strong></a>
                    </div>
                    </form>
                </div>
                <div class="login-sidebar">
                    <div class="login-sidebar-opacity">
                        <?php if ($login_sidebar == 'image') { ?>
                        <img src="<?php echo EYOOM_THEME_URL; ?>/skin/member/basic/img/login_sidebar_img.jpg" class="img-responsive" alt="">
                        <?php } ?>
                    </div>
                    <div class="login-sidebar-content">
                        <div class="login-sidebar-content-title">
                            Welcome
                        </div>
                        <div class="login-sidebar-content-item">
                            <?php echo $config['cf_title']; ?> 방문을 환영합니다.<br><br>회원가입 / 로그인 후 좀더 다양한 회원 혜택과 여러 서비스를 이용하실 수 있습니다.
                        </div>
                        <div class="login-sidebar-content-item">
                            그럼 좋은 시간 되세요.
                        </div>
                    </div>
                    <div class="login-sidebar-bottom">
                        Copyright © <?php echo $config['cf_title']; ?>. All Rights Reserved.
                    </div>
                </div>
            </div>

            <?php /* 쇼핑몰 비회원 구매 시작 */ ?>
            <?php if ($default['de_level_sell'] == 1) { ///#1) ?>

            <?php if (preg_match('/orderform.php/',$url)) { ///#2) ?>
            <div class="margin-bottom-30"></div>
            <div class="login-box-in">
                <div class="non-members">
                    <div class="heading heading-e4"><h4><strong>비회원 구매</strong></h4></div>
                    <div class="cont-text-bg margin-bottom-20">
                        <p class="bg-info font-size-12"><i class="fas fa-exclamation-circle"></i> 비회원으로 주문하시는 경우 포인트는 지급하지 않습니다.</p>
                    </div>

                    <div id="scrollbar" class="scroll-box-login margin-bottom-10">
                        <?php echo $default['de_guest_privacy'];?>
                    </div>

                    <div class="eyoom-form">
                        <label class="checkbox" for="agree">
                            <input type="checkbox" id="agree" value="1"><i></i><span class="font-size-12">개인정보수집에 대한 내용을 읽었으며 이에 동의합니다.</span>
                        </label>
                    </div>

                    <div class="margin-top-15 text-center">
                        <a href="javascript:guest_submit(document.flogin);" class="no-member-btn btn-e btn-e-lg btn-e-red">비회원으로 구매하기</a>
                    </div>

                    <script>
                    function guest_submit(f) {
                        if (document.getElementById('agree')) {
                            if (!document.getElementById('agree').checked) {
                                swal({
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
            <div class="margin-bottom-30"></div>
            <div class="login-box-in">
                <div class="non-member-order">
                    <div class="heading heading-e4 margin-bottom-30"><h4><strong>비회원 주문조회</strong></h4></div>
                    <form name="forderinquiry" method="post" action="<?php echo urldecode($url); ?>" autocomplete="off" class="eyoom-form">
                    <section>
                        <label for="od_id" class="label"><strong class="font-size-14">주문서번호</strong><strong class="sound_only"> 필수</strong></label>
                        <label class="input">
                            <i class="icon-append fas fa-shopping-cart"></i>
                            <input type="text" class="form-control" placeholder="Order Number" name="od_id" value="<?php echo $od_id;?>" id="od_id" required size="20">
                        </label>
                    </section>
                    <div class="login-form-margin-bottom"></div>
                    <section>
                        <label for="id_pwd" class="label"><strong class="font-size-14">비밀번호</strong><strong class="sound_only"> 필수</strong></label>
                        <label class="input">
                            <i class="icon-append fas fa-lock"></i>
                            <input type="password" class="form-control" placeholder="Password" name="od_pwd" size="20" id="od_pwd" required>
                        </label>
                    </section>
                    <div class="login-form-margin-bottom"></div>
                    <div class="text-center margin-bottom-20">
                        <input class="btn-e btn-e-lg btn-e-purple" type="submit" value="확인">
                    </div>
                    </form>
                    <div class="cont-text-bg margin-bottom-20">
                        <p class="bg-danger font-size-12">
                            <strong class="color-black"><i class="fas fa-exclamation-circle"></i> 비회원 주문조회 안내</strong><br>
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

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/backstretch/jquery.backstretch.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/perfect-scrollbar/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert/sweetalert.min.js"></script>
<script>
$.backstretch(["<?php echo EYOOM_THEME_URL; ?>/skin/member/basic/img/login_bg_1.jpg", "<?php echo EYOOM_THEME_URL; ?>/skin/member/basic/img/login_bg_2.jpg"], {fade: 1000, duration: 7000});

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

$(document).ready(function(){
    $("input, textarea, select").on({ 'touchstart' : function() {
        zoomDisable();
    }});
    $("input, textarea, select").on({ 'touchend' : function() {
        setTimeout(zoomEnable, 500);
    }});
    function zoomDisable(){
        $('head meta[name=viewport]').remove();
        $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">');
    }
    function zoomEnable(){
        $('head meta[name=viewport]').remove();
        $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1">');
    }
});

jQuery(function($){
    $("#login_auto_login").click(function(){
        if ($(this).is(":checked")) {
            swal({
                html: true,
                title: "알림",
                text: "<div class='alert alert-info text-left font-size-12'>자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.<br><br>공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.</div><strong>자동로그인을 사용하시겠습니까?</strong>",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#53A5FA",
                confirmButtonText: "확인",
                cancelButtonText: "취소",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm){
                if (isConfirm) {
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
</script>
<!--[if lt IE 9]>
    <script src="<?php echo EYOOM_THEME_URL; ?>/plugins/respond.min.js"></script>
    <script src="<?php echo EYOOM_THEME_URL; ?>/plugins/html5shiv.min.js"></script>
    <script src="<?php echo EYOOM_THEME_URL; ?>/plugins/eyoom-form/js/eyoom-form-ie8.js"></script>
<![endif]-->