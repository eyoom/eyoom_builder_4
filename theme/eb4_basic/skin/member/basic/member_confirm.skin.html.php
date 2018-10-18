<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/member_confirm.skin.html.php
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
body {background:#e5e5e5}
.member-confirm {position:relative;width:320px;padding:15px;background:#fff;margin:30px auto;border:1px solid #d5d5d5}
.member-confirm input {vertical-align:inherit}
@media (max-width:500px) {
    .member-confirm {width:inherit;margin:30px 10px 0}
}
</style>

<div class="member-confirm">
    <h4 class="margin-bottom-30"><strong><?php echo $g5['title']; ?></strong></h4>
    <div class="alert alert-warning">
        <h6><strong>비밀번호를 한번 더 입력해주세요.</strong></h6>
        <p><i class="fas fa-exclamation-circle"></i> <?php if ($url == 'member_leave.php') { ?>비밀번호를 입력하시면 회원탈퇴가 완료됩니다.<?php } else { ?>회원님의 정보를 안전하게 보호하기 위해 비밀번호를 한번 더 확인합니다.<?php } ?></p>
    </div>

    <form name="fmemberconfirm" action="<?php echo $url; ?>" onsubmit="return fmemberconfirm_submit(this);" method="post" class="eyoom-form">
    <input type="hidden" name="mb_id" value="<?php echo $member['mb_id']; ?>">
    <input type="hidden" name="w" value="u">
    <div class="margin-hr-10"></div>
    <h5 class="font-bold">회원아이디: <span class="color-blue"><?php echo $member['mb_id']; ?></span></h5>
    <div class="margin-hr-10"></div>
    <section>
        <label for="confirm_mb_password" class="label">비밀번호<strong class="sound_only"> 필수</strong></label>
        <label class="input required-mark">
            <i class="icon-append fas fa-lock"></i>
            <input type="password" name="mb_password" id="confirm_mb_password" required size="15" maxLength="20">
        </label>
    </section>
    <div class="text-center margin-top-20 margin-bottom-20">
        <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-red btn-e-lg btn-e-block">
    </div>
    </form>
</div>

<div class="margin-bottom-20"></div>
<div class="text-center">
    <a href="<?php echo G5_URL; ?>"><u>메인으로 돌아가기</u></a>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
<script>
function fmemberconfirm_submit(f) {
    document.getElementById("btn_submit").disabled = true;
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