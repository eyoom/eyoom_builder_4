<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/listtype.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<div class="shop-listtype">
    <?php echo $item_list; ?>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>
</div>