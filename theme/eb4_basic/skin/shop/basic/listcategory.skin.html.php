<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/listcategory.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.shop-list .sct-ct ul {margin-bottom:0}
.shop-list .sct-ct li {float:left;padding:2px}
</style>

<?php if ($listcategory) { ?>
<aside class="sct-ct">
    <ul class="list-unstyled">
        <?php foreach ($listcategory as $k => $cateinfo) { ?>
        <li><a href="<?php echo $cateinfo['href']; ?>" class="btn-e btn-e-xs btn-e-dark"><?php echo $cateinfo['ca_name']; ?> (<?php echo $cateinfo['cnt']; ?>)</a></li>
        <?php } ?>
    </ul>
    <div class="clearfix"></div>
</aside>
<?php } ?>