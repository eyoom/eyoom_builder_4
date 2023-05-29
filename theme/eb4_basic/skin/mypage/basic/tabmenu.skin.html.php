<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/tabmenu.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sly/tab_scroll_category.css" type="text/css" media="screen">',0);
?>

<div class="tab-scroll-category">
    <div class="scrollbar">
        <div class="handle">
            <div class="mousearea"></div>
        </div>
    </div>

    <div id="tab-category">
        <div class="category-list">
            <span<?php if ($mpid == 'mypage' && !$tg) { ?> class="active"<?php } ?>><a href="<?php echo G5_URL; ?>/mypage/">마이페이지</a></span>
            <span<?php if ($mpid == 'respond') { ?> class="active"<?php } ?>><a href="<?php echo G5_URL; ?>/mypage/respond.php">내글반응</a></span>
            <?php if ($config['cf_use_mbmemo']) { ?>
            <span<?php if ($mpid == 'mbmemo') { ?> class="active"<?php } ?>><a href="<?php echo G5_URL; ?>/mypage/mbmemo.php">회원메모</a></span>
            <?php } ?>
            <span<?php if ($tg == 'timeline') { ?> class="active"<?php } ?>><a href="<?php echo get_eyoom_pretty_url('mypage', 'timeline'); ?>">타임라인</a></span>
            <span<?php if ($tg == 'favorite') { ?> class="active"<?php } ?>><a href="<?php echo get_eyoom_pretty_url('mypage', 'favorite'); ?>">관심게시판</a></span>
            <?php if ($eyoom['is_community_theme'] == 'y') { ?>
            <span<?php if ($tg == 'followinggul') { ?> class="active"<?php } ?>><a href="<?php echo get_eyoom_pretty_url('mypage', 'followinggul'); ?>">팔로잉글</a></span>
            <?php } ?>
            <span<?php if ($tg == 'subscribe') { ?> class="active"<?php } ?>><a href="<?php echo get_eyoom_pretty_url('mypage', 'subscribe'); ?>">구독글</a></span>
            <span<?php if ($tg == 'pinboard') { ?> class="active"<?php } ?>><a href="<?php echo get_eyoom_pretty_url('mypage', 'pinboard'); ?>">핀보드</a></span>
            <span<?php if ($tg == 'goodpost') { ?> class="active"<?php } ?>><a href="<?php echo get_eyoom_pretty_url('mypage', 'goodpost'); ?>">추천/비추천</a></span>
            <span<?php if ($tg == 'starpost') { ?> class="active"<?php } ?>><a href="<?php echo get_eyoom_pretty_url('mypage', 'starpost'); ?>">별점평가글</a></span>
            <span<?php if ($mpid == 'activity') { ?> class="active"<?php } ?>><a href="<?php echo G5_URL; ?>/mypage/activity.php">활동기록</a></span>
            <span<?php if ($mpid == 'config') { ?> class="active"<?php } ?>><a href="<?php echo G5_URL; ?>/mypage/config.php">환경설정</a></span>
            <span class="fake-span"></span>
        </div>
        <div class="controls">
            <button class="btn prev"><i class="fas fa-caret-left"></i></button>
            <button class="btn next"><i class="fas fa-caret-right"></i></button>
        </div>
    </div>
    <div class="tab-category-divider"></div>
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
        prevPage: $wrap.find('.prev'),
        nextPage: $wrap.find('.next')
    });
    var tabWidth = $('#tab-category').width();
    var categoryWidth = $('.category-list').width();
    if (tabWidth < categoryWidth) {
        $('.controls').show();
    }
});
</script>