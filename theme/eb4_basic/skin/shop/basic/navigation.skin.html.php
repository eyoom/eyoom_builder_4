<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/navigation.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.shop-list-nav .list-nav {font-size:13px}
.shop-list-nav .list-nav a {color:#959595}
.shop-list-nav .list-nav .sct_here {color:#FF4848}
.shop-list-nav .sct_here:before {content:"\f105";font-family:'Font Awesome\ 5 Free';font-weight:900;padding:0 8px;color:#d5d5d5}
.shop-list-nav .sct_bg:before {content:"\f105";font-family:'Font Awesome\ 5 Free';font-weight:900;padding:0 8px;color:#d5d5d5}
</style>

<div class="shop-list-nav">
    <div class="pull-left list-nav">
        <a href="<?php echo G5_SHOP_URL; ?>"><strong>HOME</strong></a>
        <?php echo $navigation; ?>
    </div>
    <?php if ($is_admin) { ?>
    <div class="pull-right">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=categorylist&wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-red btn-edit-mode">분류 관리</a>
    </div>
    <?php } ?>
    <div class="clearfix"></div>
</div>