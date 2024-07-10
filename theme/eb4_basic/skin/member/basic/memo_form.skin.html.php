<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/memo_form.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sly/tab_scroll_category.css" type="text/css" media="screen">',0);
?>

<style>
.memo-write {position:relative;overflow:hidden}
</style>
<?php if (G5_IS_MOBILE) { ?>
<style>
.memo-write {padding:15px}
.memo-write .win-title {position:relative;margin:0 0 20px;font-size:1.0625rem;height:60px;line-height:30px;padding:15px 10px;background:#353535;color:#fff}
.memo-write .btn-close {position:absolute;top:19px;right:10px}
</style>
<?php } ?>

<div class="memo-write">
    <?php if (G5_IS_MOBILE) { ?>
    <h4 class="win-title">
        <strong>내 쪽지함</strong>
        <button type="button" class="btn-close btn-close-white" onclick="window.close();" aria-label="Close"></button>
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
            <div class="note m-b-15"><strong>Note:</strong> 여러 회원에게 보낼때는 컴마 ( , )로 구분하세요.</div>
        </section>
        <section>
            <label for="me_memo" class="label">쪽지내용</label>
            <label class="textarea textarea-resizable required-mark">
                <textarea name="me_memo" id="me_memo" rows="7" required><?php echo $content; ?></textarea>
            </label>
        </section>
        <section>
            <label class="label">자동등록방지</label>
            <div class="vc-captcha"><?php echo captcha_html(); ?></div>
        </section>
        <div class="text-center m-t-30 m-b-30">
            <input type="submit" value="보내기" id="btn_submit" class="btn-e btn-e-xl btn-e-navy">
            <?php if (G5_IS_MOBILE) { ?>
            <button type="button" onclick="window.close();" class="btn-e btn-e-xl btn-e-dark">창닫기</button>
            <?php } ?>
        </div>
        </form>
    </div>
</div>

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