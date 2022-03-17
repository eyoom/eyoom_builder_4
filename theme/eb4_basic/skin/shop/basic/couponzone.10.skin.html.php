<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/couponzone.10.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.shop-couponzone .couponzone-container {margin-left:-10px;margin-right:-10px}
.shop-couponzone .couponzone-box {position:relative;width:25%}
.shop-couponzone .couponzone-box-pd {padding:10px}
.shop-couponzone .couponzone-box-in {position:relative;border:1px solid #e5e5e5;padding:10px;background:#fff}
.shop-couponzone .couponzone-box .couponzone-img {margin-bottom:15px}
.shop-couponzone .couponzone-box h5 {font-size:1.125rem;margin:0 0 10px}
.shop-couponzone .couponzone-box .couponzone-desc {color:#757575}
.shop-couponzone .couponzone-box .couponzone-desc strong {color:#252525}
.shop-couponzone .couponzone-btn {position:relative;text-align:center;margin-top:15px}
.shop-couponzone .couponzone-btn button.disabled {background:#b5b5b5;border:1px solid #b5b5b5;cursor:not-allowed}
.shop-couponzone .couponzone-btn button.disabled:hover {background:#b5b5b5}
@media (max-width:1199px) {
    .shop-couponzone .couponzone-box {width:33.33333%}
}
@media (max-width:991px) {
    .shop-couponzone .couponzone-container {margin-left:-5px;margin-right:-5px}
    .shop-couponzone .couponzone-box {width:50%}
    .shop-couponzone .couponzone-box-pd {padding:5px}
}
@media (max-width:767px) {
    .shop-couponzone .couponzone-container {margin-left:-2px;margin-right:-2px}
    .shop-couponzone .couponzone-box-pd {padding:5px 2px}
}
</style>

<div class="shop-couponzone">
    <div class="m-b-40">
        <div class="headline-short">
            <h4><strong>다운로드 쿠폰</strong></h4>
        </div>
        <blockquote class="hero m-b-30">
            <p class="p-li"><i class="fas fa-info-circle"></i><?php echo $config['cf_title']; ?> 회원이시라면 쿠폰 다운로드 후 바로 사용하실 수 있습니다.</p>
        </blockquote>

        <?php if ($dn_count > 0) { ?>
        <div class="couponzone-container">
            <?php for ($i=0; $i<$dn_count; $i++) { ?>
            <div class="couponzone-box">
                <div class="couponzone-box-pd">
                    <div class="couponzone-box-in">
                        <div class="couponzone-img"><img src="<?php echo $dn_list[$i]['coupon_img']; ?>" class="img-fluid" alt="<?php echo $dn_list[$i]['coupon_tit']; ?>"></div>
                        <h5><strong><?php echo $dn_list[$i]['coupon_tit']; ?></strong></h5>
                        <div class="couponzone-desc">
                            <strong>기한</strong> : 다운로드 후 <?php echo number_format($dn_list[$i]['cz_period']); ?>일
                        </div>
                        <div class="couponzone-desc">
                            <?php if ($dn_list[$i]['cp_method'] < 2) { ?>
                            <strong>적용</strong> : <a href="<?php echo $dn_list[$i]['link_href']; ?>"><u><?php echo $dn_list[$i]['link_text']; ?></u></a>
                            <?php } else { ?>
                            <strong>적용</strong> : <?php echo $dn_list[$i]['cp_target']; ?>
                            <?php } ?>
                        </div>
                        <div class="couponzone-btn"><button type="button" class="btn-e btn-e-dark btn-e-xl btn-e-block coupon_download <?php echo $dn_list[$i]['btn_disabled']; ?>" data-cid="<?php echo $dn_list[$i]['cz_id']; ?>">쿠폰다운로드</button></div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php } else { ?>
        <p class="text-center text-gray m-t-50 m-b-50"><i class="fas fa-exclamation-circle"></i> 사용할 수 있는 쿠폰이 없습니다.</p>
        <?php } ?>
    </div>

    <div id="point_coupon">
        <div class="headline-short">
            <h4><strong>포인트 쿠폰</strong></h4>
        </div>
        <blockquote class="hero m-b-30">
            <p class="p-li"><i class="fas fa-info-circle"></i>보유하신 <?php echo $config['cf_title']; ?> 회원 포인트를 쿠폰으로 교환하실 수 있습니다.</p>
        </blockquote>

        <?php if ($po_count > 0) { ?>
        <div class="couponzone-container">
            <?php for ($i=0; $i<$po_count; $i++) { ?>
            <div class="couponzone-box">
                <div class="couponzone-box-pd">
                    <div class="couponzone-box-in">
                        <div class="couponzone-img"><img src="<?php echo $po_list[$i]['coupon_img']; ?>" class="img-fluid" alt="<?php echo $po_list[$i]['coupon_tit']; ?>"></div>
                        <h5><strong><?php echo $po_list[$i]['coupon_tit']; ?></strong></h5>
                        <div class="couponzone-desc">
                            <strong>기한</strong> : 다운로드 후 <?php echo number_format($po_list[$i]['cz_period']); ?>일
                        </div>
                        <div class="couponzone-desc">
                            <?php if ($po_list[$i]['cp_method'] < 2) { ?>
                            <strong>적용</strong> : <a href="<?php echo $po_list[$i]['link_href']; ?>"><?php echo $po_list[$i]['link_text']; ?></a>
                            <?php } else { ?>
                            <strong>적용</strong> : <?php echo $po_list[$i]['cp_target']; ?>
                            <?php } ?>
                        </div>
                        <div class="couponzone-desc">포인트 <strong class="text-crimson"><?php echo number_format($po_list[$i]['cz_point']); ?></strong>점 차감</div>
                        <div class="couponzone-btn"><button type="button" class="btn-e btn-e-dark btn-e-xl btn-e-block coupon_download <?php echo $po_list[$i]['btn_disabled']; ?>" data-cid="<?php echo $po_list[$i]['cz_id']; ?>">쿠폰다운로드</button></div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php } else { ?>
        <p class="text-center text-gray m-t-50 m-b-50"><i class="fa fa-exclamation-circle"></i> 사용할 수 있는 쿠폰이 없습니다.</p>
        <?php } ?>
    </div>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/masonry/masonry.pkgd.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script>
$(document).ready(function(){
    var $container = $('.couponzone-container');
    $container.imagesLoaded(function() {
        $container.masonry({
            columnWidth: '.couponzone-box',
            itemSelector: '.couponzone-box'
        });
    });
});
</script>