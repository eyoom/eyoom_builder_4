<?php
/**
 * theme file : /theme/THEME_NAME/side.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="' . EYOOM_THEME_URL . '/plugins/sly/tab_scroll_category.css" type="text/css" media="screen">',0);
?>

<aside class="basic-body-side <?php echo $side_layout['pos'] == 'left' ? 'left':'right'; ?>-side col-md-3">
    <div class="side-pc-area">
        <?php /* Side Nav 영역 시작 */ ?>
            <?php if ( !defined('_INDEX_') ) { ?>
            <ul class="sidebar-nav-e1 list-group" id="sidebar-nav">
                <?php if (is_array($sidemenu)) { ?>
                <?php foreach ($sidemenu as $key => $smenu) { ?>
                <li class="list-group-item list-toggle <?php if ($smenu['active']) echo 'active'; ?>">
                    <a <?php if (G5_IS_MOBILE && $smenu['submenu']) { ?>data-toggle="collapse" data-parent="#sidebar-nav" href="#collapse-<?php echo $key; ?>"<?php } else { ?>href="<?php echo $smenu['me_link']; ?>" target="_<?php echo $smenu['me_target']; ?>"<?php } ?>>
                        <?php echo $smenu['me_name']; ?><?php if ( $smenu['new'] ) { ?><i class="fas fa-circle color-red margin-left-5"></i><?php } ?>
                    </a>
                    <ul id="collapse-<?php echo $key; ?>" class="collapse <?php if ($smenu['active']) echo 'in'; ?>">
                        <?php if (is_array($submenu)) { ?>
                        <?php foreach ($submenu as $skey => $smenu_2) { ?>
                        <li class="<?php if ($smenu_2['active']) echo 'active'; ?>">
                            <a href="<?php echo $smenu_2['me_link']; ?>" target="_<?php echo $smenu_2['me_target']; ?>">
                                <?php echo $smenu_2['me_name']; ?>
                                <?php if ( $smenu_2['new'] ) { ?>
                                <i class="fas fa-circle color-red margin-left-5"></i>
                                <?php } ?>
                            </a>
                        </li>
                        <?php } ?>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>
                <?php } ?>
            </ul>
            <?php } ?>
        <?php /* Side Nav 영역 끝 */ ?>
    </div>
</aside>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sly/vendor_plugins.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sly/sly.min.js"></script>
<script>
$(function() {
    var $frame = $('#tab-page-category');
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
    var tabWidth = $('#tab-page-category').width();
    var categoryWidth = $('.page-category-list').width();
    if (tabWidth < categoryWidth) {
        $('.controls').show();
    }
});
</script>