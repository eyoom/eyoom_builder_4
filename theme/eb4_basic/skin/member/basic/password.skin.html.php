<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/password.skin.html.php
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
.password-confirm {position:relative;width:300px;padding:15px;background:#fff;border:1px solid #c5c5c5;margin:40px auto 30px;-webkit-border-radius:2px !important;-moz-border-radius:2px !important;border-radius:2px !important}
</style>

<div class="password-confirm">
    <h4 class="margin-bottom-20"><i class="fas fa-lock"></i> <strong>비밀번호 확인</strong></h4>
    <div class="margin-hr-15"></div>
    <h6><strong>해당글: <span class="color-red"><?php $g5['title']; ?></span></strong></h6>
    <form name="fboardpassword" action="<?php echo $action; ?>" method="post" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id; ?>">
    <input type="hidden" name="comment_id" value="<?php echo $comment_id; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">

    <section>
        <?php if ($w=='u') { ?>
        <div class="alert alert-warning">
            <p>작성자만 글을 수정할 수 있습니다.<br>작성자 본인이라면, 글 작성시 입력한 비밀번호를 입력하여 글을 수정할 수 있습니다.</p>
        </div>
        <?php } else if ($w=='d' || $w=='x') { ?>
        <div class="alert alert-warning">
            <p>작성자만 글을 삭제할 수 있습니다.<br>작성자 본인이라면, 글 작성시 입력한 비밀번호를 입력하여 글을 삭제할 수 있습니다.</p>
        </div>
        <?php } else { ?>
        <div class="alert alert-warning">
            <p>비밀글 기능으로 보호된 글입니다.<br>작성자와 관리자만 열람하실 수 있습니다. 본인이라면 비밀번호를 입력하세요.</p>
        </div>
        <?php } ?>
    </section>
    <div class="margin-hr-15"></div>
    <section>
        <label for="pw_wr_password" class="label">비밀번호<strong class="sound_only">필수</strong></label>
        <label class="input required-mark">
            <i class="icon-append fas fa-lock"></i>
            <input type="password" name="wr_password" id="password_wr_password" required size="15" maxLength="20">
        </label>
    </section>
    <div class="margin-hr-15"></div>
    <div class="text-center">
        <input type="submit" value="확인" class="btn-e btn-e-red btn-e-lg">
    </div>
    </form>
</div>
<div class="text-center">
    <a href="<?php echo $return_url; ?>"><u>이전 페이지로 돌아가기</u></a>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
<script>
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