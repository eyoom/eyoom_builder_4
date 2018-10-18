<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/personalpay.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.shop-personalpay .personalpay-container {margin-left:-10px;margin-right:-10px}
.shop-personalpay .personalpay-box {position:relative;width:25%}
.shop-personalpay .personalpay-box-pd {padding:10px}
.shop-personalpay .personalpay-box-in {position:relative;border:1px solid #dadada;padding:10px;background:#fff}
.shop-personalpay .personalpay-box .personalpay-img {margin-bottom:15px}
.shop-personalpay .personalpay-box h5 {font-size:14px}
.shop-personalpay .personalpay-box .personalpay-cost {font-size:14px;color:#FF4848;font-weight:bold}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width:991px) {
    .shop-personalpay .personalpay-box {width:33.33333%}
}
@media (max-width:767px) {
    .shop-personalpay .personalpay-container {margin-left:-5px;margin-right:-5px}
    .shop-personalpay .personalpay-box {width:50%}
    .shop-personalpay .personalpay-box-pd {padding:5px}
}
<?php } ?>
</style>

<div id="fakeloader"></div>

<div class="shop-personalpay">
    <?php if ($count > 0) { ?>
    <div class="personalpay-container">
        <?php for ($i=0; $i<$count; $i++) { ?>
        <div class="personalpay-box">
            <div class="personalpay-box-pd">
                <div class="personalpay-box-in">
                    <div class="personalpay-img">
                        <a href="<?php echo $list[$i]['href']; ?>"><img src="<?php echo EYOOM_THEME_SHOP_SKIN_URL; ?>/img/personal.jpg" class="img-responsive" alt=""></a>
                    </div>
                    <h5><a href="<?php echo $list[$i]['href']; ?>"><strong><?php echo get_text($list[$i]['pp_name']).'님 개인결제'; ?></strong></a></h5>
                    <div class="personalpay-cost"><?php echo display_price($list[$i]['pp_price']); ?></div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <?php } else { ?>
    <p class="text-center font-size-14 color-grey margin-top-20"><i class="fas fa-exclamation-circle"></i> 등록된 개인결제가 없습니다.</p>
    <?php } ?>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/fakeLoader/fakeLoader.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/masonry/masonry.pkgd.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script>
$('#fakeloader').fakeLoader({
    timeToHide:3000,
    zIndex:"11",
    spinner:"spinner6",
    bgColor:"#fff",
});

$(window).load(function(){
    $('#fakeloader').fadeOut(300);
});

$(document).ready(function(){
    var $container = $('.personalpay-container');
    $container.imagesLoaded(function() {
        $container.masonry({
            columnWidth: '.personalpay-box',
            itemSelector: '.personalpay-box'
        });
    });
});
</script>