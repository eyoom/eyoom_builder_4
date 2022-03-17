<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/listcategory.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.shop-list .sct-ct ul {margin:0;padding:0;margin-left:-8px;margin-right:-8px}
.shop-list .sct-ct ul:after {content:"";display:block;clear:both}
.shop-list .sct-ct li {float:left;padding:8px}
.shop-list .sct-ct li a {color:#a5a5a5;font-size:1.0625rem}
.shop-list .sct-ct li a strong {color:#000}
.shop-list .sct-ct li a span {color:#353535}
.shop-list .sct-ct li a:hover {text-decoration:underline}
@media (max-width:576px) {
    .shop-list .sct-ct ul {margin-left:-5px;margin-right:-5px}
    .shop-list .sct-ct li {padding:5px}
    .shop-list .sct-ct li a {font-size:.9375rem}
}
</style>

<?php if ($listcategory) { ?>
<aside class="sct-ct">
    <ul class="list-unstyled">
        <?php foreach ($listcategory as $k => $cateinfo) { ?>
        <li><a href="<?php echo $cateinfo['href']; ?>"><strong><?php echo $cateinfo['ca_name']; ?></strong> [<span><?php echo $cateinfo['cnt']; ?></span>]</a></li>
        <?php } ?>
    </ul>
    <div class="clearfix"></div>
</aside>
<?php } ?>