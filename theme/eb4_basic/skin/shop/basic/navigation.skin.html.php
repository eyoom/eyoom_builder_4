<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/navigation.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.shop-list-nav {border-bottom:1px solid #eaeaea;padding-bottom:10px;margin-bottom:10px}
.shop-list-nav .list-nav a {color:#757575}
.shop-list-nav .list-nav .sct_here {color:#ab0000}
.shop-list-nav .sct_here:before {content:">";padding:0 8px;color:#c5c5c5}
.shop-list-nav .sct_bg:before {content:">";padding:0 8px;color:#c5c5c5}
</style>

<div class="shop-list-nav">
    <div class="float-start list-nav">
        <a href="<?php echo G5_SHOP_URL; ?>"><strong>상점 메인</strong></a>
        <?php echo $navigation; ?>
    </div>
    <?php if ($is_admin) { ?>
    <div class="float-end">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=categorylist&wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-crimson btn-edit-mode">분류 관리</a>
    </div>
    <?php } ?>
    <div class="clearfix"></div>
</div>