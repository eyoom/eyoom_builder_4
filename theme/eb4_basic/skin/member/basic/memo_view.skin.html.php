<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/memo_view.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sly/tab_scroll_category.css" type="text/css" media="screen">',0);
?>

<style>
.memo-view {position:relative;overflow:hidden}
.memo-view .memo-content .memo-box {position:relative;overflow:hidden;background-image:url("<?php echo EYOOM_THEME_URL; ?>/skin/member/basic/img/paper_line.png");background-repeat:repeat;padding:15px;border:1px solid #b5b5b5;min-height:100px}
</style>
<?php if (G5_IS_MOBILE) { ?>
<style>
.memo-view {padding:15px}
.memo-view .win-title {position:relative;margin:0 0 20px;font-size:1.0625rem;height:60px;line-height:30px;padding:15px 10px;background:#353535;color:#fff}
.memo-view .btn-close {position:absolute;top:19px;right:10px}
</style>
<?php } ?>

<div class="memo-view">
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
                <span <?php if ($kind == 'recv') { ?>class="active"<?php } ?>>
                    <a href="<?php echo G5_BBS_URL; ?>/memo.php?kind=recv">
                        <?php if ($kind == 'recv') { ?>
                        <strong>받은쪽지</strong>
                        <?php } else { ?>
                        받은쪽지
                        <?php } ?>
                    </a>
                </span>
                <span <?php if ($kind == 'send') { ?>class="active"<?php } ?>>
                    <a href="<?php echo G5_BBS_URL; ?>/memo.php?kind=send">
                        <?php if ($kind == 'send') { ?>
                        <strong>보낸쪽지</strong>
                        <?php } else { ?>
                        보낸쪽지
                        <?php } ?>
                    </a>
                </span>
                <span><a href="<?php echo G5_BBS_URL; ?>/memo_form.php">쪽지쓰기</a></span>
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
        <div class="m-b-30">
            <ul class="list-unstyled list-inline">
                <li class="m-b-10">
                    <span><?php echo $kind_str; ?>사람 : </span>
                    <strong><?php echo eb_nameview($mb['mb_id'], $mb['mb_nick'], $mb['mb_email'], $mb['mb_homepage']); ?></strong>
                </li>
                <li class="m-b-20">
                    <span><?php echo $kind_date; ?>시간 : </span>
                    <strong><?php echo $memo['me_send_datetime']; ?></strong>
                </li>
            </ul>
            <h5 class="f-s-15r m-b-10"><strong>쪽지 내용</strong></h5>
            <div class="memo-box">
                <div class="memo-box-cont"><?php echo conv_content($memo['me_memo'], 0); ?></div>
            </div>
        </div>
    </div>

    <div class="text-center m-b-30">
        <?php if ($prev_link) { ?>
        <a href="<?php echo $prev_link; ?>" class="btn-e btn-e-gray">이전쪽지</a>
        <?php } ?>
        <?php if ($next_link) { ?>
        <a href="<?php echo $next_link; ?>" class="btn-e btn-e-gray">다음쪽지</a>
        <?php } ?>
        <a href="<?php echo $list_link ?>" class="btn-e btn-e-dark">목록보기</a>
        <?php if ($kind == 'recv') { ?>
        <a href="<?php echo G5_BBS_URL; ?>/memo_form.php?me_recv_mb_id=<?php echo $mb['mb_id']; ?>&amp;me_id=<?php echo $memo['me_id']; ?>" class="btn-e btn-e-navy">답장</a>
        <?php } ?>
        <?php if (G5_IS_MOBILE) { ?>
        <div class="text-center m-t-30">
            <button type="button" onclick="window.close();" class="btn-e btn-e-xl btn-e-dark">창닫기</button>
        </div>
        <?php } ?>
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
</script>