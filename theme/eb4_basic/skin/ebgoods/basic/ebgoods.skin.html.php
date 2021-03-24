<?php
/**
 * skin file : /theme/THEME_NAME/skin/ebslider/basic/ebgoods.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
<div class="position-relative <?php if ($eg_master['eg_state'] == '2') { ?>eb-hidden-space<?php } ?>">
    <div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="top:-22px;text-align:right">
        <div class="btn-group">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebgoods_form&amp;thema=<?php echo $theme; ?>&amp;eg_code=<?php echo $eg_master['eg_code']; ?>&amp;w=u&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-xs btn-e-red btn-e-split"><i class="far fa-edit"></i> EB상품 마스터 설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebgoods_form&amp;thema=<?php echo $theme; ?>&amp;eg_code=<?php echo $eg_master['eg_code']; ?>&amp;w=u" target="_blank" class="btn-e btn-e-xs btn-e-red btn-e-split-red dropdown-toggle" title="새창 열기">
                <i class="far fa-window-maximize"></i>
            </a>
        </div>
    </div>
</div>
<?php }?>

<?php if (isset($eg_master) && $eg_master['eg_state'] == '1') { // 보이기 상태에서만 출력 ?>
<style>
.ebgoods-basic-wrap {position:relative}
.ebgoods-basic-wrap .nav-tabs {border-bottom:0}
.ebgoods-basic-wrap .nav-tabs li {margin-bottom:20px}
.ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(1) {width:100%;display:none}
.ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(2), .ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(2) ~ li {width:50%}
.ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(3), .ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(3) ~ li {width:33.3333%}
.ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(4), .ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(4) ~ li {width:25%}
.ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(5), .ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(5) ~ li {width:20%}
.ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(6), .ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(6) ~ li {width:16.6666666667%}
.ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(7), .ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(7) ~ li {width:14.2857142857%}
.ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(8), .ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(8) ~ li {width:12.5%}
.ebgoods-basic-wrap .nav-tabs li a {text-align:center;margin-right:0;margin-left:-1px;background:#f5f5f5;color:#959595;border:1px solid #e5e5e5;padding:7px 5px;font-size:13px}
.ebgoods-basic-wrap .nav-tabs li:first-child a {margin-left:0}
.ebgoods-basic-wrap .nav-tabs li a:hover {background:#fff;border-bottom:1px solid #e5e5e5}
.ebgoods-basic-wrap .nav-tabs li.active a {z-index:1;background:#fff;font-weight:bold;color:#353535;border-bottom:0;padding:7px 5px 8px}
.ebgoods-basic-wrap .nav-tabs li .cursor-pointer:hover {cursor:pointer}
.ebgoods-basic-wrap .tab-content {position:relative;padding:0}
.ebgoods-basic.row {margin-left:-10px;margin-right:-10px}
.ebgoods-basic .col-sm-4 {padding-left:10px;padding-right:10px}
.ebgoods-basic .goods-box {position:relative;border:1px solid #e5e5e5;background:#fff;margin-bottom:20px;-webkit-transition:all 0.2s ease-in-out;-moz-transition:all 0.2s ease-in-out;-o-transition:all 0.2s ease-in-out;transition:all 0.2s ease-in-out}
.ebgoods-basic .goods-img {position:relative;overflow:hidden;margin:10px;background:#fff}
.ebgoods-basic .goods-img:after {content:"";position:absolute;display:block;left:0;top:0;opacity:0;-moz-transition:all 0.2s ease 0s;-webkit-transition:all 0.2s ease 0s;-ms-transition:all 0.2s ease 0s;-o-transition:all 0.2s ease 0s;transition:all 0.2s ease 0s;width:100%;height:100%;background:rgba(0,0,0,0.3)}
.ebgoods-basic .goods-img-in {position:relative;overflow:hidden;width:100%}
.ebgoods-basic .goods-img-in:before {content:"";display:block;padding-top:100%;background:#fff}
.ebgoods-basic .goods-img-in img {display:block;width:100% \9;max-width:100% !important;height:auto !important;position:absolute;top:0;left:0;right:0;bottom:0}
.ebgoods-basic .goods-description .goods-description-in {position:relative;overflow:hidden;padding:0 10px 10px}
.ebgoods-basic .goods-description .goods-name {position:relative;overflow:hidden;margin:10px 0 0;margin-bottom:5px;height:40px}
.ebgoods-basic .goods-description .goods-name a {font-size:15px;font-weight:bold;color:#000}
.ebgoods-basic .goods-description .goods-name a:hover {color:#FF4848;text-decoration:underline}
.ebgoods-basic .goods-description .title-price {font-size:16px;font-weight:bold;color:#E52700}
.ebgoods-basic .goods-description .line-through {font-size:12px;color:#959595;text-decoration:line-through;margin-left:7px;font-weight:normal}
.ebgoods-basic .goods-description .goods-id {color:#757575;display:block;font-size:12px;margin-top:8px}
.ebgoods-basic .goods-description .goods-info {position:relative;overflow:hidden;height:34px;color:#959595;font-size:11px;margin-top:8px}
.ebgoods-basic .goods-description .goods-sns {position:relative;text-align:right;margin-top:8px}
.ebgoods-basic .goods-description .goods-sns ul {margin:0;padding:0;list-style:none}
.ebgoods-basic .goods-description .goods-sns ul li {display:inline-block}
.ebgoods-basic .goods-description .goods-sns ul li a {display:inline-block;width:26px;height:26px;line-height:26px;text-align:center;background:#c5c5c5;color:#fff;font-size:12px;border-radius:50% !important}
.ebgoods-basic .goods-description .goods-sns ul li:hover .facebook-icon {background:#5D82D1}
.ebgoods-basic .goods-description .goods-sns ul li:hover .twitter-icon {background:#40BFF5}
.ebgoods-basic .goods-description .goods-sns ul li:hover .google-icon {background:#EB5E4C}
.ebgoods-basic .goods-description .goods-sns ul li:hover .wish-icon {background:#FF9500}
.ebgoods-basic .goods-description-bottom {position:relative;overflow:hidden;padding:7px 10px;border-top:1px solid #e5e5e5}
.ebgoods-basic .goods-ratings {margin:0;padding:0;margin-right:3px}
.ebgoods-basic .goods-ratings li {padding:0;margin-right:-3px}
.ebgoods-basic .goods-ratings li .rating {color:#959595;line-height:normal;font-size:11px}
.ebgoods-basic .goods-ratings li .rating-selected {color:#FF4848;font-size:11px}
.ebgoods-basic .shop-rgba-red {background:#FF4848;opacity:0.9}
.ebgoods-basic .shop-rgba-yellow {background:#FDAB29;opacity:0.9}
.ebgoods-basic .shop-rgba-green {background:#73B852;opacity:0.9}
.ebgoods-basic .shop-rgba-purple {background:#907EEC;opacity:0.9}
.ebgoods-basic .shop-rgba-orange {background:#FF6F42;opacity:0.9}
.ebgoods-basic .shop-rgba-dark {background:#4B4B4D;opacity:0.9}
.ebgoods-basic .shop-rgba-default {background:#A6A6A6;opacity:0.9}
.ebgoods-basic .rgba-banner-area {position:absolute;top:0;right:0}
.ebgoods-basic .rgba-banner {height:14px;width:60px;line-height:14px;color:#fff;font-size:10px;text-align:center;font-weight:normal;position:relative;text-transform:uppercase;margin-bottom:1px}
.ebgoods-basic .goods-box:hover .goods-img:after {opacity:1}
.ebgoods-basic .goods-box:hover .goods-name a {text-decoration:underline}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (min-width:768px) and (max-width:1199px) {
    .ebgoods-basic.row {margin-left:-5px;margin-right:-5px}
    .ebgoods-basic .col-sm-4 {width:33.33333%;float:left;padding-left:5px;padding-right:5px}
}
@media (max-width:767px) {
    .ebgoods-basic.row {margin-left:-2px;margin-right:-2px}
    .ebgoods-basic .col-sm-4 {width:50%;float:left;padding-left:2px;padding-right:2px}
    .ebgoods-basic .goods-img {margin:5px}
    .ebgoods-basic .goods-description .goods-name a {font-size:13px}
    .ebgoods-basic .goods-description .title-price {font-size:13px}
    .ebgoods-basic .goods-description .line-through {font-size:11px}
    .ebgoods-basic .goods-description .goods-description-in {padding:0 5px 10px}
    .ebgoods-basic .goods-description-bottom {padding:7px 5px}
}
<?php } ?>
</style>

<div class="headline-short">
    <h4>
        <?php if ($eg_master['eg_link']) { ?>
        <a href="<?php echo $eg_master['eg_link']; ?>" target="<?php echo $eg_master['eg_target']; ?>"><strong><?php echo $eg_master['eg_subject']; ?></strong></a>
        <?php } else { ?>
        <strong><?php echo $eg_master['eg_subject']; ?></strong>
        <?php } ?>
    </h4>
</div>

<div class="ebgoods-basic-wrap">
    <ul class="nav nav-tabs ebgoods-basic-tabs">
        <?php if (is_array($eg_item)) { foreach ($eg_item as $k => $eb_goods) { ?>
        <li class="<?php if ($k==0) { ?>active<?php } else if ($eg_count == ($k+1)) { ?>last<?php }?>"><a href="#basic-tlb-<?php echo $eg_master['eg_code']; ?>-<?php echo ($k+1); ?>" data-toggle="tab" <?php if ($eb_goods['gi_link']) { ?>data-href="<?php echo $eb_goods['gi_link']; ?>" target="<?php echo $eb_goods['gi_target']; ?>"<?php } ?> <?php if ($eb_goods['gi_link']) { ?>class="cursor-pointer"<?php } ?>><?php echo $eb_goods['gi_title']; ?></a></li>
        <?php }} ?>
    </ul>
    <div class="tab-content">
        <?php if (is_array($eg_item)) { foreach ($eg_item as $k => $eb_goods) { ?>
        <div class="tab-pane <?php echo ($k==0) ? 'active': ''; ?> in" id="basic-tlb-<?php echo $eg_master['eg_code']; ?>-<?php echo ($k+1); ?>">
            <div class="ebgoods-basic row">
                <?php if (count((array)$eb_goods['list']) > 0) { foreach ($eb_goods['list'] as $i => $data) { ?>
                <div class="col-sm-4">
                    <div class="goods-box">
                        <a href="<?php echo $data['href']; ?>">
                            <div class="goods-img">
                                <div class="goods-img-in">
                                    <?php if ($eb_goods['gi_view_img'] == 'y') { ?>
                                    <?php if($data['it_image']) { ?>
                                    <?php echo $data['it_image']; ?>
                                    <?php } else { ?>
                                    <span class="no-image">No Image</span>
                                    <?php } ?>
                                    <?php } ?>
                                    <?php if ($eb_goods['gi_view_it_icon']) { ?>
                                    <?php echo $data['it_icon']; ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </a>

                        <div class="goods-description">
                            <div class="goods-description-in">
                                <h4 class="goods-name">
                                    <a href="<?php echo $data['href']; ?>">
                                        <?php echo $data['it_name']?>
                                    </a>
                                </h4>

                                <div class="goods-price">
                                    <?php if ($eb_goods['gi_view_it_price'] == 'y') { ?>
                                    <span class="title-price">₩ <?php echo number_format($data['it_price']); ?></span>
                                    <?php } ?>
                                    <?php if ($eb_goods['gi_view_it_cust_price'] == 'y' && $data['it_cust_price']) { ?>
                                    <span class="title-price line-through">₩ <?php echo number_format($data['it_cust_price']); ?></span>
                                    <?php } ?>
                                </div>

                                <?php if ($eb_goods['gi_view_it_id'] == 'y') { ?>
                                <span class="goods-id"><?php echo stripslashes($data['it_id']); ?></span>
                                <?php } ?>

                                <?php if ($eb_goods['gi_view_it_basic'] == 'y') { ?>
                                <p class="goods-info"><?php echo $data['it_basic']?></p>
                                <?php } ?>

                                <?php if ($eb_goods['gi_view_sns'] == 'y') { ?>
                                <div class="goods-sns">
                                    <ul>
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $data['sns_url']; ?>&amp;p=<?php echo $data['sns_title']; ?>" target="_blank" class="facebook-icon" title="페이스북"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="https://twitter.com/share?url=<?php echo $data['sns_url']; ?>&amp;text=<?php echo $data['sns_title']; ?>" target="_blank" class="twitter-icon" title="트위터"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="https://plus.google.com/share?url=<?php echo $data['sns_url']; ?>" arget="_blank" class="google-icon"><i class="fab fa-google-plus-g" title="구글플러스"></i></a></li>
                                    </ul>
                                </div>
                                <?php } ?>
                            </div>

                            <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                            <div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="bottom:0">
                                <div class="btn-group">
                                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemform&w=u&it_id=<?php echo $data['it_id']; ?>&wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-xs btn-e-dark btn-e-split"><i class="far fa-edit"></i> 개별상품 설정</a>
                                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemform&w=u&it_id=<?php echo $data['it_id']; ?>" target="_blank" class="btn-e btn-e-xs btn-e-dark btn-e-split-dark dropdown-toggle" title="새창 열기">
                                        <i class="far fa-window-maximize"></i>
                                    </a>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="goods-description-bottom">
                            <span class="font-size-12">
                                상품분류 : <span class="color-yellow"><?php echo $data['ca_name']; ?></span>
                            </span>
                        </div>
                    </div>
                </div>
                <?php }} ?>

                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="bottom:-10px">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebgoods_itemform&amp;thema=<?php echo $theme; ?>&amp;eg_code=<?php echo $eg_master['eg_code']; ?>&amp;gi_no=<?php echo $eb_goods['gi_no']; ?>&amp;w=u&amp;iw=u&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-xs btn-e-dark"><i class="far fa-edit"></i> EB상품 아이템 설정</a>
                </div>
                <?php } ?>

                <?php if (count((array)$eb_goods['list']) == 0) { ?>
                <p class="text-center font-size-13 color-grey margin-top-10"><i class="fas fa-exclamation-circle"></i> 등록된 상품이 없습니다.</p>
                <?php } ?>
            </div>
        </div>
        <?php }} ?>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.ebgoods-basic-tabs li a').hover(function (e) {
        e.preventDefault()
        $(this).tab('show');
    });

    $('.ebgoods-basic-tabs li a').click(function (e) {
        return true;
    });

    $('.ebgoods-basic-tabs li a').on("click",function (e) {
        if ($(this).attr("data-href")) {
            window.location.href = $(this).attr("data-href");
        }
    });
});
</script>
<?php } ?>