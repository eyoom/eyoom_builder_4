<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/relation.10.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.relation-10 {position:relative}
.relation-10-in {margin-left:-10px;margin-right:-10px}
.relation-10 .item-relation-10 {position:relative;padding-left:10px;padding-right:10px;outline:none}
.relation-10 .item-relation-10-in {position:relative;-webkit-transition:all 0.2s ease-in-out;-moz-transition:all 0.2s ease-in-out;-o-transition:all 0.2s ease-in-out;transition:all 0.2s ease-in-out}
.relation-10 .product-img-wrap {position:relative;background:#fff;margin-bottom:10px}
.relation-10 .product-img {position:relative;overflow:hidden;background:#fff}
.relation-10 .product-img-in {position:relative;overflow:hidden;width:100%}
.relation-10 .product-img-in:before {content:"";display:block;padding-top:100%;background:#fff}
.relation-10 .product-img-in img {display:block;max-width:100% !important;height:auto !important;position:absolute;top:0;left:0;right:0;bottom:0}
.relation-10 .product-description .product-description-in {position:relative;overflow:hidden;padding:0 0 10px}
.relation-10 .product-description .product-name {position:relative;overflow:hidden;margin:5px 0;height:50px;line-height:1}
.relation-10 .product-description .product-name a {font-size:1rem;font-weight:700;color:#000}
.relation-10 .product-description .product-name a:hover {text-decoration:underline}
.relation-10 .product-description .title-price {font-size:1rem;font-weight:700;color:#ab0000}
.relation-10 .product-description .line-through {font-size:.875rem;color:#959595;text-decoration:line-through;margin-left:7px;font-weight:400}
.relation-10 .item-relation-10:hover .product-name a {text-decoration:underline}
.relation-10 .slick-next, .relation-10 .slick-prev {width:30px;height:60px;margin-top:-30px;text-align:center;background:rgba(0, 0, 0, 0.7)}
.relation-10 .slick-next {right:-11px;z-index:1}
.relation-10 .slick-prev {left:-11px;z-index:1}
.relation-10 .slick-next:before, .relation-10 .slick-prev:before {font-family:'Font Awesome\ 5 Free';font-weight:900;color:#fff;font-size:16px}
.relation-10 .slick-next:before {content:"\f054"}
.relation-10 .slick-prev:before {content:"\f053"}
@media (max-width:1199px) {
    .relation-10-in {margin-left:-5px;margin-right:-5px}
    .relation-10 .item-relation-10 {padding-left:5px;padding-right:5px}
    .relation-10 .slick-next {right:-6px}
    .relation-10 .slick-prev {left:-6px}
}
</style>

<div class="relation-10">
    <div class="relation-10-in">
        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        <div class="item-relation-10">
            <div class="item-relation-10-in">
                <div class="product-img-wrap">
                    <?php if ($list[$i]['href']) { ?>
                    <a href="<?php echo $list[$i]['href']; ?>">
                    <?php } ?>
                        <div class="product-img">
                            <div class="product-img-in">
                                <?php echo $list[$i]['it_image']; ?>
                            </div>
                        </div>
                    <?php if ($list[$i]['href']) { ?>
                    </a>
                    <?php } ?>
                </div>

                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="adm-edit-btn btn-edit-mode" style="margin-top:-35px">
                    <div class="btn-group">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemform&w=u&it_id=<?php echo $list[$i]['it_id']; ?>&wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-item-btn ae-btn-l"><i class="far fa-edit"></i> 개별상품 설정</a>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemform&w=u&it_id=<?php echo $list[$i]['it_id']; ?>" target="_blank" class="ae-btn-r" title="새창 열기">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
                <?php } ?>

                <div class="product-description">
                    <div class="product-description-in">
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

                        <?php if ($list[$i]['href']) { ?>
                        <h4 class="product-name">
                            <a href="<?php echo $list[$i]['href']; ?>">
                        <?php } ?>
                            <?php if ($this->view_it_name) { echo stripslashes($list[$i]['it_name']); } ?>
                        <?php if ($list[$i]['href']) { ?>
                            </a>
                        </h4>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if (count((array)$list) == 0) { ?>
        <p class="text-center text-gray m-t-10 m-b-30"><i class="fa fa-exclamation-circle"></i> 등록된 상품이 없습니다.</p>
        <?php } ?>
    </div>
</div>

<script>
$('.relation-10-in').slick({
    dots: false,
    infinite: true,
    centerMode: true,
    centerPadding: '0px',
    slidesToShow: 5,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 4000,
    responsive: [
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        }
    ]
});
</script>