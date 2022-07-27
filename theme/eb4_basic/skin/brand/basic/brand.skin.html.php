<?php
/**
 * skin file : /theme/THEME_NAME/skin/brand/basic/brand.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
if ($eyoom['use_brand'] == 'n') return;
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sly/tab_scroll_category.css" type="text/css" media="screen">',0);
?>

<style>
.brand-wrap {position:relative}
.brand-box .tab-scroll-category {margin-bottom:0}
.brand-box .tab-scroll-category #tab-category {height:auto;line-height:inherit}
.brand-box .category-list {margin:0px auto;display:none}
.brand-box .category-img {position:relative;width:100px;height:100px;margin:0 auto}
.brand-box .category-title {font-size:.9375rem;text-align:center;height:40px;line-height:40px}
.brand-box .category-list > span {position:relative}
.brand-box .category-list > span:hover .category-title {color:#000;text-decoration:underline}
.brand-box .category-list span a {display:block;position:relative;}
.brand-box .category-list span.active a {border-bottom:0;font-weight:normal;color:#858585;height:auto !important}
.brand-box .controls .btn {outline:none;top:50%;transform:translateY(-50%);width:26px;height:50px;font-size:1rem;background:rgba(0,0,0,0.5);color:#fff}
.brand-box .scrollbar {display:none}
@media (max-width:1199px) {
    .brand-box .category-img {width:70px;height:70px;line-height:70px;font-size:1.625rem;border:0}
}
@media (max-width:991px) {
    .brand-box .scrollbar {display:block}
}
</style>

<div class="brand-wrap">
    <div class="brand-box">
        <div class="tab-scroll-category">
            <div class="scrollbar">
                <div class="handle">
                    <div class="mousearea"></div>
                </div>
            </div>
            <div id="tab-category">
                <div class="category-list">
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <span <?php echo $list[$i]['br_code'] == $br_cd ? 'class="active"': ''; ?>>
                        <a href="<?php echo G5_SHOP_URL; ?>/brand.php?br_cd=<?php echo urlencode($list[$i]['br_code']); ?>">
                            <?php if ($list[$i]['br_img']) { ?>
                            <div class="category-img">
                                <img src="<?php echo $list[$i]['img_url']?>" class="img-fluid" alt="">
                            </div>
                            <?php } ?>
                            <div class="category-title"><?php echo $list[$i]['br_name']; ?></div>
                        </a>
                    </span>
                    <?php } ?>
                    <?php if (count((array)$list) == 0) { ?>
                    <span class="width-100"><div class="m-t-30 m-b-50"><i class="fas fa-exclamation-circle"></i> 출력할 브랜드가 없습니다.</div></span>
                    <?php } ?>
                    <?php if (count((array)$list) > 0) { ?>
                    <span class="fake-span"></span>
                    <span class="fake-span"></span>
                    <?php } ?>
                </div>
                <div class="controls">
                    <button class="btn prev"><i class="fas fa-chevron-left"></i></button>
                    <button class="btn next"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sly/vendor_plugins.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sly/sly.min.js"></script>
<script>
$(function() {
    $('.category-list').show();

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