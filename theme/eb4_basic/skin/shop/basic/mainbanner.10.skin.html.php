<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/mainbanner.10.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<div id="main_bn">
    <ul class="slide-wrap">
        <?php for ($i=0; $i<$count; $i++) { ?>
        <li <?php echo $list[$i]['bn_first_class']; ?>>
            <a href="<?php echo $list[$i]['bn_url']; ?>">
                <img src="<?php echo G5_DATA_URL; ?>'/banner/<?php echo $list[$i]['bn_id']; ?>" alt="<?php echo get_text($list[$i]['bn_alt']); ?>"<?php echo $list[$i]['bn_border']; ?> class="img-responsive">
            </a>
        </li>
        <?php } ?>
    </ul>
    
    <?php if ($count > 0) { ?>
    <div id="bx_pager" class="bx_pager">
        <ul>
            <?php $k=0; foreach ($main_banners as $row) { ?>
            <li>
                <a data-slide-index="<?php echo $k; ?>" href=""><?php echo get_text($row['bn_alt']); ?></a>
            </li>
            <?php $k++; } ?>
        </ul>
    </div>
    <?php } ?>
</div>

<?php if (0) { ?>
<script>
jQuery(function($){
    var slider = $('.slide-wrap').show().bxSlider({
        speed:800,
        pagerCustom: '#bx_pager',
        auto: true,
        useCSS : false,
        onSlideAfter : function(){
            slider.startAuto();
        }
    });
});
</script>
<?php } ?>