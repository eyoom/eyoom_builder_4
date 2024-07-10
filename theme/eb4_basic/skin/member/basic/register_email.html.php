<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/register_email.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.register-email {padding:15px}
</style>

<div class="register-email">
    <h5 class="m-b-20 f-s-15r"><strong>메일인증을 받지 못한 경우 회원정보의 메일주소를 변경 할 수 있습니다.</strong></h5>
    <form method="post" name="fregister_email" action="<?php echo G5_HTTPS_BBS_URL; ?>/register_email_update.php" onsubmit="return fregister_email_submit(this);" class="eyoom-form">
    <input type="hidden" name="mb_id" value="<?php echo $mb_id; ?>">
    <section>
        <label for="reg_mb_email" class="label">E-mail<strong class="sound_only">필수</strong></label>
        <label class="input required-mark">
            <i class="icon-append far fa-envelope"></i>
            <input type="text" name="mb_email" id="reg_mb_email" required size="50" maxlength="100" value="<?php echo $mb['mb_email']; ?>">
        </label>
    </section>
    <section>
        <label class="label">자동등록방지</label>
        <div class="vc-captcha"></div>
    </section>
    <div class="text-center m-b-20">
        <input type="submit" id="btn_submit" value="인증메일변경" class="btn-e btn-e-lg btn-e-navy">
        <button type="button" onclick="window.close();" class="btn-e btn-e-lg btn-e-dark">창닫기</button>
    </div>
    </form>
    <div class="m-b-20"></div>
    <div class="text-center">
        <a href="<?php echo G5_URL; ?>"><u>메인으로 돌아가기</u></a>
    </div>
</div>

<script>
function fregister_email_submit(f) {
    <?php echo chk_captcha_js();  ?>

    return true;
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