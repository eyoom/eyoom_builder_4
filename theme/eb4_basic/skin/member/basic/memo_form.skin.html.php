<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/memo_form.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/fontawesome5/css/fontawesome-all.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/eyoom-form/css/eyoom-form.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sly/tab_scroll_category.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/common.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/style.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/custom.css" type="text/css" media="screen">',0);
?>

<style>
.memo-write {position:relative;overflow:hidden;padding:5px}
<?php if (G5_IS_MOBILE) { ?>
.memo-write {padding:20px 15px}
.memo-write .win-title {position:relative;margin:0 0 20px;font-size:18px;height:50px;line-height:30px;padding:10px;background:#555;color:#fff}
.memo-write .win-close-btn {position:absolute;top:10px;right:10px;width:30px;height:30px;line-height:30px;text-align:center;margin:0;padding:0;border:0;background:none;color:#fff;float:right}
<?php } ?>
</style>

<div class="memo-write">
    <?php if (G5_IS_MOBILE) { ?>
    <h4 class="win-title">
        <strong>내 쪽지함</strong>
        <button type="button" onclick="window.close();" class="win-close-btn"><i class="fas fa-times"></i></button>
        <div class="clearfix"></div>
    </h4>
    <?php } ?>
    <div class="tab-scroll-category">
        <div class="scrollbar">
            <div class="handle">
                <div class="mousearea"></div>
            </div>
        </div>
        <div id="tab-category">
            <div class="category-list">
                <span><a href="<?php echo G5_BBS_URL; ?>/memo.php?kind=recv">받은쪽지</a></span>
                <span><a href="<?php echo G5_BBS_URL; ?>/memo.php?kind=send">보낸쪽지</a></span>
                <span class="active"><a href="<?php echo G5_BBS_URL; ?>/memo_form.php">쪽지쓰기</a></span>
                <span class="fake-span"></span>
            </div>
            <div class="controls">
                <button class="btn prev"><i class="fas fa-caret-left"></i></button>
                <button class="btn next"><i class="fas fa-caret-right"></i></button>
            </div>
        </div>
        <div class="tab-category-divider"></div>
    </div>

    <div class="memo-content">
        <form name="fmemoform" action="<?php echo $memo_action_url; ?>" onsubmit="return fmemoform_submit(this);" method="post" autocomplete="off" class="eyoom-form">
        <section>
            <label for="me_recv_mb_id" class="label">받는 회원아이디<strong class="sound_only">필수</strong></label>
            <label class="input required-mark">
                <i class="icon-append fas fa-user"></i>
                <input type="text" name="me_recv_mb_id" value="<?php echo $me_recv_mb_id; ?>" id="me_recv_mb_id" required size="47">
            </label>
            <div class="note margin-bottom-10"><strong>Note:</strong> 여러 회원에게 보낼때는 컴마 ( , )로 구분하세요.</div>
        </section>
        <div class="margin-hr-15"></div>
        <section>
            <label for="me_memo" class="label">쪽지내용</label>
            <label class="textarea textarea-resizable required-mark">
                <textarea name="me_memo" id="me_memo" rows="7" required><?php echo $content; ?></textarea>
            </label>
        </section>
        <div class="margin-hr-15"></div>
        <section>
            <label class="label">자동등록방지</label>
            <div class="vc-captcha"><?php echo captcha_html(); ?></div>
        </section>
        <div class="text-center margin-top-30 margin-bottom-30">
            <input type="submit" value="보내기" id="btn_submit" class="btn-e btn-e-xlg btn-e-red">
            <?php if (G5_IS_MOBILE) { ?>
            <button type="button" onclick="window.close();" class="btn-e btn-e-xlg btn-e-dark">창닫기</button>
            <?php } ?>
        </div>
        </form>
    </div>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sly/vendor_plugins.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sly/sly.min.js"></script>
<script>
$(function() {
    var $frame = $('#tab-category');
    var $wrap  = $frame.parent();
    $frame.sly({
        horizontal: 1,
        itemNav: 'centered',
        smart: 1,
        activateOn: 'click',
        mouseDragging: 1,
        touchDragging: 1,
        releaseSwing: 1,
        scrollBar: $wrap.find('.scrollbar'),
        scrollBy: 1,
        startAt: $frame.find('.active'),
        speed: 300,
        elasticBounds: 1,
        easing: 'easeOutExpo',
        dragHandle: 1,
        dynamicHandle: 1,
        clickBar: 1,
        prev: $wrap.find('.prev'),
        next: $wrap.find('.next')
    });
    var tabWidth = $('#tab-category').width();
    var categoryWidth = $('.category-list').width();
    if (tabWidth < categoryWidth) {
        $('.controls').show();
    }
});

function fmemoform_submit(f) {
    <?php chk_captcha_js(); ?>

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