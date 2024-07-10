<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/list.sub.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
#sct_lst {position:absolute;top:7px;right:0;margin-bottom:0;z-index:1}
#sct_lst li {position:relative;float:left}
#sct_lst button {position:relative;margin:0;padding:0;width:40px;height:40px;border:1px solid #d5d5d5;cursor:pointer;background:#fff;font-size:15px;color:#454545}
#sct_lst button .product-type-on + i {color:#ab0000}
#sct_lst button.product-type-list-btn {border-right:0}
@media (max-width:991px) {
    #sct_lst {position:relative;top:inherit;right:inherit;float:right;margin-bottom:20px}
}
</style>

<ul id="sct_lst" class="list-unstyled">
    <li><button type="button" class="product-type-btn product-type-list-btn" title="리스트뷰"><span class="sound_only">리스트뷰</span><i class="fas fa-th-list" aria-hidden="true"></i></button></li>
    <li><button type="button" class="product-type-btn product-type-gallery-btn" title="갤러리뷰"><span class="sound_only">갤러리뷰</span><i class="fas fa-th-large" aria-hidden="true"></i></button></li>
    <div class="clearfix"></div>
</ul>
<div class="clearfix"></div>