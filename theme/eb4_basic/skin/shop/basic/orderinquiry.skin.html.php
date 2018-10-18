<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/orderinquiry.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<div id="sod_v">
    <?php
    $limit = " limit $from_record, $rows ";
    include $skin_dir.'/orderinquiry.sub.php';
    ?>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>
</div>