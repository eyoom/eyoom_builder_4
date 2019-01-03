<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/item.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때
    add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/skin/shop/'.$eyoom['shop_skin'].'/css/item_style.css" type="text/css" media="screen">',0);
} else if ($eyoom['is_responsive'] == '0' && !G5_IS_MOBILE) { // 비반응형이면서 PC버전일때
    add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/skin/shop/'.$eyoom['shop_skin'].'/css/item_style_nr.css" type="text/css" media="screen">',0);
}
?>

<div id="fakeloader"></div>

<div class="shop-item">
    <?php /* 네이게이션 정보 */ ?>
    <?php include $nav_skin; ?>

    <?php /* 상품분류 정보 */ ?>
    <?php if ($cate_skin) include $cate_skin; ?>

    <?php /* 상단 HTML */ ?>
    <div id="sit_hhtml" class="margin-bottom-20"><?php echo conv_content($it['it_head_html'], 1); ?></div>

    <?php include_once(G5_SHOP_PATH.'/settle_naverpay.inc.php'); ?>

    <?php if($is_orderable) { ?>
    <script src="<?php echo G5_JS_URL; ?>/shop.js"></script>
    <?php } ?>

    <?php /* 상품 구입폼 */ ?>
    <?php include_once($form_skin); ?>

    <?php /* 상품 상세정보 */ ?>
    <?php include_once($info_skin); ?>

    <?php /* 하단 HTML */ ?>
    <div id="sit_thtml"><?php echo conv_content($it['it_tail_html'], 1); ?></div>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/fakeLoader/fakeLoader.min.js"></script>
<script>
$('#fakeloader').fakeLoader({
    timeToHide:3000,
    zIndex:"11",
    spinner:"spinner6",
    bgColor:"#f4f4f4",
});

$(window).load(function(){
    $('#fakeloader').fadeOut(300);
});
</script>