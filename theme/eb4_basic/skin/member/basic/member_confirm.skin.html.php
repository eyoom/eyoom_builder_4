<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/member_confirm.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.member-confirm {position:relative;width:360px;padding:15px;background:#fff;margin:50px auto;border:1px solid #d5d5d5}
.member-confirm input {vertical-align:inherit}
@media (max-width:576px) {
    .member-confirm {width:inherit;margin:30px 15px 0}
}
</style>

<div class="member-confirm">
    <h5 class="m-b-15"><strong><?php echo $g5['title']; ?></strong></h5>
    <div class="alert alert-warning">
        <h6 class="m-b-10">비밀번호를 한번 더 입력해주세요.</h6>
        <p><i class="fas fa-exclamation-circle"></i> <?php if ($url == 'member_leave.php') { ?>비밀번호를 입력하시면 회원탈퇴가 완료됩니다.<?php } else { ?>회원님의 정보를 안전하게 보호하기 위해 비밀번호를 한번 더 확인합니다.<?php } ?></p>
    </div>

    <form name="fmemberconfirm" action="<?php echo $url; ?>" onsubmit="return fmemberconfirm_submit(this);" method="post" class="eyoom-form">
    <input type="hidden" name="mb_id" value="<?php echo $member['mb_id']; ?>">
    <input type="hidden" name="w" value="u">
    <h6 class="m-b-15">회원아이디 : <span class="text-indigo"><?php echo $member['mb_id']; ?></span></h6>
    <section>
        <label for="confirm_mb_password" class="label">비밀번호<strong class="sound_only"> 필수</strong></label>
        <label class="input required-mark">
            <i class="icon-append fas fa-lock"></i>
            <input type="password" name="mb_password" id="confirm_mb_password" required size="15" maxLength="20">
        </label>
    </section>
    <div class="text-center m-t-20 m-b-20">
        <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-navy btn-e-lg btn-e-block">
    </div>
    </form>
</div>

<div class="m-b-20"></div>
<div class="text-center">
    <a href="<?php echo G5_URL; ?>"><u>메인으로 돌아가기</u></a>
</div>

<script>
function fmemberconfirm_submit(f) {
    document.getElementById("btn_submit").disabled = true;
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