<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/main.50.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/slick/slick.min.css" type="text/css" media="screen">',0);
?>

<style>
.product-main-50 {position:relative;overflow:hidden}
.product-main-50-in {margin-left:-10px;margin-right:-10px}
.product-main-50 .item-main-50 {position:relative;padding-left:10px;padding-right:10px;outline:none;opacity:0.4}
.product-main-50 .slick-center .item-main-50 {opacity:1}
.product-main-50 .slick-center .item-main-50 .item-main-50-in {border:1px solid rgba(0,0,0,0.7)}
.product-main-50 .item-main-50-in {position:relative;border:1px solid #e5e5e5;background:#fff;margin-bottom:20px;-webkit-transition:all 0.2s ease-in-out;transition:all 0.2s ease-in-out}
.product-main-50 .product-img {position:relative;overflow:hidden;margin:10px;background:#fff}
.product-main-50 .product-img-in {position:relative;overflow:hidden;width:100%}
.product-main-50 .product-img-in:before {content:"";display:block;padding-top:100%;background:#fff}
.product-main-50 .product-img-in .first-img {display:block}
.product-main-50 .product-img-in .second-img {display:none}
.product-main-50 .item-main-50-in:hover .product-img-in .second-img {display:block}
.product-main-50 .product-img-in img {display:block;max-width:100% !important;height:auto !important;position:absolute;top:0;left:0;right:0;bottom:0}
.product-main-50 .product-img-in .discount-percent {position:absolute;top:-40px;left:-40px;width:80px;height:80px;padding-top:57px;text-align:center;background:#ab0000;color:#fff;font-style:italic;font-size:.75rem;-webkit-transform:rotate(-45deg);-moz-transform:rotate(-45deg);transform:rotate(-45deg)}
.product-main-50 .product-description .product-description-in {position:relative;overflow:hidden;padding:0 10px 10px}
.product-main-50 .product-description .product-name {position:relative;overflow:hidden;margin:10px 0 5px;font-size:1.125rem;font-weight:700;line-height:1.4;height:48px}
.product-main-50 .product-description .product-name a {color:#000}
.product-main-50 .product-description .product-name a:hover {text-decoration:underline}
.product-main-50 .product-description .title-price {font-size:1.125rem;font-weight:700;color:#ab0000;margin-right:7px}
.product-main-50 .product-description .line-through {font-size:.9375rem;color:#959595;text-decoration:line-through;font-weight:400;white-space:nowrap}
.product-main-50 .product-description .product-id {color:#757575;display:block;font-size:.8125rem;margin-top:10px}
.product-main-50 .product-description .product-info {position:relative;overflow:hidden;height:38px;color:#959595;font-size:.8125rem;margin-top:10px}
.product-main-50 .product-description .product-sns {position:relative;height:30px;margin-top:10px}
.product-main-50 .product-description .product-sns ul {position:absolute;top:0;right:0;margin:0;padding:0;list-style:none}
.product-main-50 .product-description .product-sns ul:after {content:"";display:block;clear:both}
.product-main-50 .product-description .product-sns ul li {float:left;margin-left:1px}
.product-main-50 .product-description .product-sns ul li a {display:block;width:28px;height:28px;display:flex;align-items:center;justify-content:center;background:#a5a5a5}
.product-main-50 .product-description .product-sns ul li img {width:12px;height:12px}
.product-main-50 .product-description .product-sns ul li:hover .wish-icon {background:#ab0000}
.product-main-50 .product-description .product-sns ul li:hover .facebook-icon {background:#39558f}
.product-main-50 .product-description .product-sns ul li:hover .twitter-icon {background:#252525}
.product-main-50 .product-description-bottom {position:relative;overflow:hidden;padding:12px 10px;border-top:1px solid #e5e5e5}
.product-main-50 .product-description-bottom a:hover {text-decoration:underline;color:#000}
.product-main-50 .product-ratings {width:75px;margin:0;padding:0}
.product-main-50 .product-ratings li {padding:0;float:left;margin-right:0}
.product-main-50 .product-ratings li .rating {color:#a5a5a5;font-size:.8125rem;line-height:normal}
.product-main-50 .product-ratings li .rating-selected {color:#ab0000;font-size:.8125rem}
.product-main-50 .shop-rgba-red {background:#ab0000}
.product-main-50 .shop-rgba-yellow {background:#ff9500}
.product-main-50 .shop-rgba-green {background:#00897b}
.product-main-50 .shop-rgba-purple {background:#8e24aa}
.product-main-50 .shop-rgba-orange {background:#f4511e}
.product-main-50 .shop-rgba-dark {background:#3c3c3e}
.product-main-50 .shop-rgba-default {background:#A6A6A6}
.product-main-50 .rgba-banner-area {position:absolute;top:0;right:0}
.product-main-50 .rgba-banner {height:18px;width:70px;line-height:18px;color:#fff;font-size:.6875rem;text-align:center;font-weight:400;position:relative;text-transform:uppercase;margin-bottom:1px}
.product-main-50 .item-main-50-in:hover .product-name a {text-decoration:underline}
.product-main-50 .slick-dotted.slick-slider {margin-bottom:40px}
.product-main-50 .slick-dots li {display:inline-block;margin:0 1px;width:30px;height:3px;background:#959595}
.product-main-50 .slick-dots li button:before {content:"";width:100%;height:3px;-webkit-transition:all .2s linear;transition:all .2s linear;opacity:1}
.product-main-50 .slick-dots li.slick-active button:before {background:#ab0000}
.product-main-50 .slick-next, .product-main-50 .slick-prev {width:50px;height:50px;line-height:50px;text-align:center;border:1px solid #e5e5e5;-webkit-transition:all .2s linear;transition:all .2s linear}
.product-main-50 .slick-next:hover, .product-main-50 .slick-prev:hover {border:1px solid #757575}
.product-main-50 .slick-next {top:inherit;bottom:-60px;right:10px;z-index:1}
.product-main-50 .slick-prev {top:inherit;bottom:-60px;left:10px;z-index:1}
.product-main-50 .slick-next:before, .product-main-50 .slick-prev:before {font-family:'Font Awesome\ 5 Free';font-weight:900;color:#000;font-size:.9375rem;line-height:inherit}
.product-main-50 .slick-next:before {content:"\f054"}
.product-main-50 .slick-prev:before {content:"\f053"}
@media (max-width:1199px) {
    .product-main-50-in {margin-left:-5px;margin-right:-5px}
    .product-main-50 .item-main-50 {padding:0 5px}
    .product-main-50 .slick-next {right:5px}
    .product-main-50 .slick-prev {left:5px}
}
@media (max-width:767px) {
    .product-main-50-in {margin-left:-2px;margin-right:-2px}
    .product-main-50 .item-main-50 {padding:0 2px}
    .product-main-50 .slick-next {right:2px}
    .product-main-50 .slick-prev {left:2px}
}
</style>

<div class="product-main-50">
    <div class="product-main-50-in">
        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        <div class="item-main-50">
            <div class="item-main-50-in">
                <?php if ($list[$i]['href']) { ?>
                <a href="<?php echo $list[$i]['href']; ?>">
                <?php } ?>
                    <div class="product-img">
                        <div class="product-img-in">
                            <div class="first-img">
                                <?php echo $list[$i]['it_image']; ?>
                            </div>
                            <?php if($list[$i]['it_image2']) { ?>
                            <div class="second-img">
                                <?php echo $list[$i]['it_image2']; ?>
                            </div>
                            <?php } ?>
                            <?php if ($this->view_it_icon) { ?>
                            <?php echo $list[$i]['it_icon']; ?>
                            <?php } ?>
                            <?php if($list[$i]['dc_ratio']) { ?>
                            <div class="discount-percent"><?php echo $list[$i]['dc_ratio']; ?>%</div>
                            <?php } ?>
                        </div>
                    </div>
                <?php if ($list[$i]['href']) { ?>
                </a>
                <?php } ?>

                <div class="product-description">
                    <div class="product-description-in">
                        <h4 class="product-name">
                            <?php if ($list[$i]['href']) { ?>
                            <a href="<?php echo $list[$i]['href']; ?>">
                            <?php } ?>
                            <?php if ($this->view_it_name) { echo stripslashes($list[$i]['it_name']); } ?>
                            <?php if ($list[$i]['href']) { ?>
                            </a>
                            <?php } ?>
                        </h4>

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
                                <li><a href="javascript:void(0);" class="wish-icon" onclick="item_wish_for_list(<?php echo $list[$i]['it_id']; ?>);" title="위시리스트"><img src="<?php echo EYOOM_THEME_URL; ?>/image/social/heart-regular.svg" alt=""></a></li>
                                <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $list[$i]['sns_url']; ?>&amp;p=<?php echo $list[$i]['sns_title']; ?>" target="_blank" class="facebook-icon" title="페이스북"><img src="<?php echo EYOOM_THEME_URL; ?>/image/social/facebook-f.svg" alt=""></a></li>
                                <li><a href="https://twitter.com/share?url=<?php echo $list[$i]['sns_url']; ?>&amp;text=<?php echo $list[$i]['sns_title']; ?>" target="_blank" class="twitter-icon" title="엑스(트위터)"><img src="<?php echo EYOOM_THEME_URL; ?>/image/social/x-twitter.svg" alt=""></a></li>
                            </ul>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="product-description-bottom">
                    <a class="float-start" href="<?php echo G5_SHOP_URL; ?>/itemuselist.php?sfl=a.it_id&stx=<?php echo $list[$i]['it_id']; ?>">리뷰보기</a>
                    <ul class="list-inline product-ratings float-end">
                        <li><i class="rating<?php if ($list[$i]['star_score'] > 0) { ?>-selected fas fa-star<?php } else { ?> far fa-star<?php } ?>"></i></li>
                        <li><i class="rating<?php if ($list[$i]['star_score'] > 1) { ?>-selected fas fa-star<?php } else { ?> far fa-star<?php } ?>"></i></li>
                        <li><i class="rating<?php if ($list[$i]['star_score'] > 2) { ?>-selected fas fa-star<?php } else { ?> far fa-star<?php } ?>"></i></li>
                        <li><i class="rating<?php if ($list[$i]['star_score'] > 3) { ?>-selected fas fa-star<?php } else { ?> far fa-star<?php } ?>"></i></li>
                        <li><i class="rating<?php if ($list[$i]['star_score'] > 4) { ?>-selected fas fa-star<?php } else { ?> far fa-star<?php } ?>"></i></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="adm-edit-btn btn-edit-mode" style="bottom:0">
                    <div class="btn-group">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemform&w=u&it_id=<?php echo $list[$i]['it_id']; ?>&wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l ae-item-btn"><i class="far fa-edit"></i> 개별상품 설정</a>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemform&w=u&it_id=<?php echo $list[$i]['it_id']; ?>" target="_blank" class="ae-btn-r" title="새창 열기">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
        <?php if (count((array)$list) == 0) { ?>
        <p class="text-center text-gray m-t-50 m-b-50"><i class="fas fa-exclamation-circle"></i> 등록된 상품이 없습니다.</p>
        <?php } ?>
    </div>
</div>

<?php if (count((array)$list) > 0) { ?>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/slick/slick.min.js"></script>
<script>
$('.product-main-50-in').slick({
    dots: true,
    infinite: true,
    centerMode: true,
    centerPadding: '150px',
    slidesToShow: 3,
    autoplay: true,
    autoplaySpeed: 4000,
    responsive: [
        {
            breakpoint: 1400,
            settings: {
                centerPadding: '100px'
            }
        },
        {
            breakpoint: 1200,
            settings: {
                centerPadding: '0px'
            }
        },
        {
            breakpoint: 992,
            settings: {
                centerPadding: '170px',
                slidesToShow: 1
            }
        },
        {
            breakpoint: 768,
            settings: {
                centerPadding: '120px',
                slidesToShow: 1
            }
        },
        {
            breakpoint: 577,
            settings: {
                centerPadding: '70px',
                slidesToShow: 1
            }
        }
    ]
});
</script>
<?php } ?>