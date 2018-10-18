<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/password_lost.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/fontawesome5/css/fontawesome-all.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/eyoom-form/css/eyoom-form.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/common.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/style.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/custom.css" type="text/css" media="screen">',0);
?>

<style>
.find-info {padding:15px}
</style>

<div class="find-info">
    <h4 class="margin-bottom-30"><strong>회원정보 찾기</strong></h4>
    <div class="alert alert-warning">
        <p><i class="fas fa-exclamation-circle"></i> 회원가입 시 등록하신 이메일 주소를 입력해 주세요. 해당 이메일로 아이디와 비밀번호 정보를 보내드립니다.</p>
    </div>

    <form name="fpasswordlost" action="<?php echo $action_url; ?>" onsubmit="return fpasswordlost_submit(this);" method="post" autocomplete="off" class="eyoom-form">
    <div id="info_fs">
        <section>
            <label for="mb_email" class="label">E-mail 주소<strong class="sound_only">필수</strong></label>
            <label class="input required-mark">
                <i class="icon-append far fa-envelope"></i>
                <input type="text" name="mb_email" id="mb_email" required size="30">
            </label>
        </section>
        <div class="margin-hr-15"></div>
        <section>
            <label class="label">자동등록방지</label>
            <div class="vc-captcha"><?php echo captcha_html(); ?></div>
        </section>
    </div>
    <div class="text-center margin-top-30">
        <input type="submit" value="확인" class="btn-e btn-e-lg btn-e-red">
        <button type="button" onclick="window.close();" class="btn-e btn-e-lg btn-e-dark">창닫기</button>
    </div>
    </form>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
<script>
function fpasswordlost_submit(f) {
    <?php echo chk_captcha_js(); ?>

    return true;
}

$(function() {
    var sw = screen.width;
    var sh = screen.height;
    var cw = document.body.clientWidth;
    var ch = document.body.clientHeight;
    var top  = sh / 2 - ch / 2 - 100;
    var left = sw / 2 - cw / 2;
    moveTo(left, top);
});

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
</script>
<!--[if lt IE 9]>
    <script src="<?php echo EYOOM_THEME_URL; ?>/plugins/respond.min.js"></script>
    <script src="<?php echo EYOOM_THEME_URL; ?>/plugins/html5shiv.min.js"></script>
    <script src="<?php echo EYOOM_THEME_URL; ?>/plugins/eyoom-form/js/eyoom-form-ie8.js"></script>
<![endif]-->