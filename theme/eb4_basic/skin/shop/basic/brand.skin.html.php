<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/brand.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.brand-title {text-align:center;margin-bottom:30px}
.brand-title .brand-title-img {width:122px;border:1px solid #000;padding:10px;height:auto;margin:0 auto 20px}
.brand-title h3 {font-weight:700}
</style>

<div class="shop-list">
    <div class="brand-title">
        <?php if ($br['img_url']) { ?>
        <div class="brand-title-img">
            <img src="<?php echo $br['img_url']; ?>" class="img-fluid" alt="">
        </div>
        <?php } ?>
        <h3><?php echo $br['br_name']; ?></h3>
    </div>
    
    <?php if ($eyoom['use_brand'] != 'n') { //쇼핑몰 브랜드 시작 ?>
    <div class="brand-list">
        <?php echo eb_brand('basic'); ?>
    </div>
    <?php } ?>

    <div id="product_list" class="product-list">
        <?php echo $item_list; ?>
    </div>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>
</div>