<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/main.50.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.product-main-50 {position:relative;overflow:hidden}
.product-main-50-in {margin-left:-10px;margin-right:-10px}
.product-main-50 .item-main-50 {position:relative;padding-left:10px;padding-right:10px;outline:none;opacity:0.4}
.product-main-50 .slick-center .item-main-50 {opacity:1}
.product-main-50 .slick-center .item-main-50 .item-main-50-in {border:1px solid #c5c5c5}
.product-main-50 .item-main-50-in {position:relative;border:1px solid #e5e5e5;background:#fff;margin-bottom:20px;-webkit-transition:all 0.2s ease-in-out;-moz-transition:all 0.2s ease-in-out;-o-transition:all 0.2s ease-in-out;transition:all 0.2s ease-in-out}
.product-main-50 .product-img {position:relative;overflow:hidden;margin:10px;background:#fff}
.product-main-50 .product-img:after {content:"";position:absolute;display:block;left:0;top:0;opacity:0;-moz-transition:all 0.2s ease 0s;-webkit-transition:all 0.2s ease 0s;-ms-transition:all 0.2s ease 0s;-o-transition:all 0.2s ease 0s;transition:all 0.2s ease 0s;width:100%;height:100%;background:rgba(0,0,0,0.3)}
.product-main-50 .product-img-in {position:relative;overflow:hidden;width:100%}
.product-main-50 .product-img-in:before {content:"";display:block;padding-top:100%;background:#fff}
.product-main-50 .product-img-in img {display:block;width:100% \9;max-width:100% !important;height:auto !important;position:absolute;top:0;left:0;right:0;bottom:0}
.product-main-50 .product-description .product-description-in {position:relative;overflow:hidden;padding:0 10px 10px}
.product-main-50 .product-description .product-name {position:relative;overflow:hidden;margin:10px 0 5px;height:40px}
.product-main-50 .product-description .product-name a {font-size:15px;font-weight:bold;color:#000}
.product-main-50 .product-description .product-name a:hover {color:#FF4848;text-decoration:underline}
.product-main-50 .product-description .title-price {font-size:16px;font-weight:bold;color:#E52700}
.product-main-50 .product-description .line-through {font-size:12px;color:#959595;text-decoration:line-through;margin-left:7px;font-weight:normal}
.product-main-50 .product-description .product-id {color:#757575;display:block;font-size:12px;margin-top:8px}
.product-main-50 .product-description .product-info {position:relative;overflow:hidden;height:34px;color:#959595;font-size:11px;margin-top:8px}
.product-main-50 .product-description .product-sns {position:relative;text-align:right;margin-top:8px}
.product-main-50 .product-description .product-sns ul {margin:0;padding:0;list-style:none}
.product-main-50 .product-description .product-sns ul li {display:inline-block}
.product-main-50 .product-description .product-sns ul li a {display:inline-block;width:26px;height:26px;line-height:26px;text-align:center;background:#c5c5c5;color:#fff;font-size:12px;border-radius:50% !important}
.product-main-50 .product-description .product-sns ul li:hover .facebook-icon {background:#5D82D1}
.product-main-50 .product-description .product-sns ul li:hover .twitter-icon {background:#40BFF5}
.product-main-50 .product-description .product-sns ul li:hover .google-icon {background:#EB5E4C}
.product-main-50 .product-description .product-sns ul li:hover .wish-icon {background:#FF9500}
.product-main-50 .product-description-bottom {position:relative;overflow:hidden;padding:7px 10px;border-top:1px solid #e5e5e5}
.product-main-50 .product-ratings {margin:0;padding:0;margin-right:3px}
.product-main-50 .product-ratings li {padding:0;margin-right:-3px}
.product-main-50 .product-ratings li .rating {color:#959595;line-height:normal;font-size:11px}
.product-main-50 .product-ratings li .rating-selected {color:#FF4848;font-size:11px}
.product-main-50 .shop-rgba-red {background:#FF4848;opacity:0.9}
.product-main-50 .shop-rgba-yellow {background:#FDAB29;opacity:0.9}
.product-main-50 .shop-rgba-green {background:#73B852;opacity:0.9}
.product-main-50 .shop-rgba-purple {background:#907EEC;opacity:0.9}
.product-main-50 .shop-rgba-orange {background:#FF6F42;opacity:0.9}
.product-main-50 .shop-rgba-dark {background:#4B4B4D;opacity:0.9}
.product-main-50 .shop-rgba-default {background:#A6A6A6;opacity:0.9}
.product-main-50 .rgba-banner-area {position:absolute;top:0;right:0}
.product-main-50 .rgba-banner {height:14px;width:60px;line-height:14px;color:#fff;font-size:10px;text-align:center;font-weight:normal;position:relative;text-transform:uppercase;margin-bottom:1px}
.product-main-50 .item-main-50:hover .product-img:after {opacity:1}
.product-main-50 .item-main-50:hover .product-name a {text-decoration:underline}
.product-main-50 .slick-next {top:inherit;bottom:-34px;right:5px;z-index:1}
.product-main-50 .slick-prev {top:inherit;bottom:-34px;left:5px;z-index:1}
.product-main-50 .slick-next:before, .product-main-50 .slick-prev:before {font-family:'Font Awesome\ 5 Free';font-weight:900;color:#000;font-size:16px}
.product-main-50 .slick-next:before {content:"\f054"}
.product-main-50 .slick-prev:before {content:"\f053"}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (min-width:768px) and (max-width:1199px) {
    .product-main-50-in {margin-left:-5px;margin-right:-5px}
    .product-main-50 .item-main-50 {padding-left:5px;padding-right:5px}
}
<?php } ?>
</style>

<div class="product-main-50">
    <div class="product-main-50-in">
        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        <div class="item-main-50">
            <div class="item-main-50-in">
                <div class="product-img-wrap">
                    <?php if ($list[$i]['href']) { ?>
                    <a href="<?php echo $list[$i]['href']; ?>">
                    <?php } ?>
                        <div class="product-img">
                            <div class="product-img-in">
                                <?php echo $list[$i]['it_image']; ?>
                                <?php if ($this->view_it_icon) { ?>
                                <?php echo $list[$i]['it_icon']; ?>
                                <?php } ?>
                            </div>
                        </div>
                    <?php if ($list[$i]['href']) { ?>
                    </a>
                    <?php } ?>
                </div>

                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="margin-top:-10px">
                    <div class="btn-group">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemform&w=u&it_id=<?php echo $list[$i]['it_id']; ?>&wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-xs btn-e-dark btn-e-split"><i class="far fa-edit"></i> 개별상품 설정</a>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemform&w=u&it_id=<?php echo $list[$i]['it_id']; ?>" target="_blank" class="btn-e btn-e-xs btn-e-dark btn-e-split-dark dropdown-toggle" title="새창 열기">
                            <i class="far fa-window-maximize"></i>
                        </a>
                    </div>
                </div>
                <?php } ?>

                <div class="product-description">
                    <div class="product-description-in">
                        <?php if ($list[$i]['href']) { ?>
                        <h4 class="product-name">
                            <a href="<?php echo $list[$i]['href']; ?>">
                        <?php } ?>
                            <?php if ($this->view_it_name) { echo stripslashes($list[$i]['it_name']); } ?>
                        <?php if ($list[$i]['href']) { ?>
                            </a>
                        </h4>
                        <?php } ?>

                        <?php if ($this->view_it_cust_price || $this->view_it_price) { ?>
                        <div class="product-price">
                            <?php if ($this->view_it_price) { ?>
                            <span class="title-price">₩ <?php echo $list[$i]['it_tel_inq']; ?></span>
                            <?php } ?>
                            <?php if ($this->view_it_cust_price && $list[$i]['it_cust_price']) { ?>
                            <span class="title-price line-through">₩ <?php echo $list[$i]['it_cust_price']; ?></span>
                            <?php } ?>
                        </div>
                        <?php } ?>

                        <?php if ($this->view_it_id) { ?>
                        <span class="product-id"><?php echo stripslashes($list[$i]['it_id']); ?></span>
                        <?php } ?>

                        <?php if ($this->view_it_basic) { ?>
                        <div class="product-info"><?php echo stripslashes($list[$i]['it_basic']); ?></div>
                        <?php } ?>

                        <?php if ($this->view_sns) { ?>
                        <div class="product-sns">
                            <ul>
                                <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $list[$i]['sns_url']; ?>&amp;p=<?php echo $list[$i]['sns_title']; ?>" target="_blank" class="facebook-icon" title="페이스북"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="https://twitter.com/share?url=<?php echo $list[$i]['sns_url']; ?>&amp;text=<?php echo $list[$i]['sns_title']; ?>" target="_blank" class="twitter-icon" title="트위터"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="https://plus.google.com/share?url=<?php echo $list[$i]['sns_url']; ?>" arget="_blank" class="google-icon"><i class="fab fa-google-plus-g" title="구글플러스"></i></a></li>
                            </ul>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="product-description-bottom">
                    <a class="pull-left font-size-12" href="<?php echo G5_SHOP_URL; ?>/itemuselist.php?sfl=a.it_id&stx=<?php echo $list[$i]['it_id']; ?>">리뷰보기</a>
                    <ul class="list-inline product-ratings pull-right">
                        <li><i class="rating<?php if ($list[$i]['star_score'] > 0) { ?>-selected fas fa-star<?php } else { ?> far fa-star<?php } ?>"></i></li>
                        <li><i class="rating<?php if ($list[$i]['star_score'] > 1) { ?>-selected fas fa-star<?php } else { ?> far fa-star<?php } ?>"></i></li>
                        <li><i class="rating<?php if ($list[$i]['star_score'] > 2) { ?>-selected fas fa-star<?php } else { ?> far fa-star<?php } ?>"></i></li>
                        <li><i class="rating<?php if ($list[$i]['star_score'] > 3) { ?>-selected fas fa-star<?php } else { ?> far fa-star<?php } ?>"></i></li>
                        <li><i class="rating<?php if ($list[$i]['star_score'] > 4) { ?>-selected fas fa-star<?php } else { ?> far fa-star<?php } ?>"></i></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if (count((array)$list) == 0) { ?>
        <p class="text-center font-size-13 color-grey margin-top-10"><i class="fa fa-exclamation-circle"></i> 등록된 상품이 없습니다.</p>
        <?php } ?>
    </div>
</div>

<script>
$('.product-main-50-in').slick({
    dots: true,
    infinite: true,
    centerMode: true,
    centerPadding: '50px',
    slidesToShow: 3,
    autoplay: true,
    autoplaySpeed: 4000,
    <?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
    responsive: [
        {
            breakpoint: 992,
            settings: {
                centerPadding: '30px',
                slidesToShow: 2,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 500,
            settings: {
                centerPadding: '50px',
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
    <?php } ?>
});
</script>