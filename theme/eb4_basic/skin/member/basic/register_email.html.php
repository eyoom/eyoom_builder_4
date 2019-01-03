<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/register_email.html.php
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
.register-email {padding:15px}
</style>

<div class="register-email">
    <h5 class="margin-bottom-30"><strong>메일인증을 받지 못한 경우 회원정보의 메일주소를 변경 할 수 있습니다.</strong></h5>
    <form method="post" name="fregister_email" action="<?php echo G5_HTTPS_BBS_URL; ?>/register_email_update.php" onsubmit="return fregister_email_submit(this);" class="eyoom-form">
    <input type="hidden" name="mb_id" value="<?php echo $mb_id; ?>">
    <section>
        <label for="reg_mb_email" class="label">E-mail<strong class="sound_only">필수</strong></label>
        <label class="input required-mark">
            <i class="icon-append far fa-envelope"></i>
            <input type="text" name="mb_email" id="reg_mb_email" required size="50" maxlength="100" value="<?php echo $mb['mb_email']; ?>">
        </label>
    </section>
    <div class="margin-hr-15"></div>
    <section>
        <label class="label">자동등록방지</label>
        <div class="vc-captcha"><?php echo captcha_html(); ?></div>
    </section>
    <div class="text-center margin-bottom-20">
        <input type="submit" id="btn_submit" value="인증메일변경" class="btn-e btn-e-lg btn-e-red">
        <button type="button" onclick="window.close();" class="btn-e btn-e-lg btn-e-dark">창닫기</button>
    </div>
    </form>
    <div class="margin-bottom-20"></div>
    <div class="text-center">
        <a href="<?php echo G5_URL; ?>"><u>메인으로 돌아가기</u></a>
    </div>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
<script>
function fregister_email_submit(f) {
    <?php echo chk_captcha_js();  ?>

    return true;
}

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