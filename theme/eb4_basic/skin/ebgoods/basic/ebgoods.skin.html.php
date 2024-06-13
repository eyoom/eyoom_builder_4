<?php
/**
 * skin file : /theme/THEME_NAME/skin/ebgoods/basic/ebgoods.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
<div class="position-relative <?php if ($eg_master['eg_state'] == '2') { ?>eb-hidden-space<?php } ?>">
    <div class="adm-edit-btn btn-edit-mode" style="top:0;text-align:right">
        <div class="btn-group">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebgoods_form&amp;thema=<?php echo $theme; ?>&amp;eg_code=<?php echo $eg_master['eg_code']; ?>&amp;w=u&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> EB상품 마스터 설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebgoods_form&amp;thema=<?php echo $theme; ?>&amp;eg_code=<?php echo $eg_master['eg_code']; ?>&amp;w=u" target="_blank" class="ae-btn-r" title="새창 열기">
                <i class="fas fa-external-link-alt"></i>
            </a>
        </div>
    </div>
</div>
<?php } ?>

<?php if (isset($eg_master) && $eg_master['eg_state'] == '1') { // 보이기 상태에서만 출력 ?>
<style>
.ebgoods-basic-wrap {position:relative}
.ebgoods-basic-wrap .nav-tabs {border:1px solid #e5e5e5;border-bottom:0;margin-bottom:20px}
.ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(1) {width:100%;display:none}
.ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(2), .ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(2) ~ li {width:50%}
.ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(3), .ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(3) ~ li {width:33.3333%}
.ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(4), .ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(4) ~ li {width:25%}
.ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(5), .ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(5) ~ li {width:20%}
.ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(6), .ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(6) ~ li {width:16.6666666667%}
.ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(7), .ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(7) ~ li {width:14.2857142857%}
.ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(8), .ebgoods-basic-wrap .nav-tabs li:first-child:nth-last-child(8) ~ li {width:12.5%}
.ebgoods-basic-wrap .nav-tabs li a {display:block;text-align:center;margin-right:0;margin-left:-1px;background:#f5f5f5;color:#959595;border:1px solid #e5e5e5;padding:8px 5px;font-size:.9375rem;border-top:0}
.ebgoods-basic-wrap .nav-tabs li:first-child a {margin-left:0;border-left:0}
.ebgoods-basic-wrap .nav-tabs li:last-child a {border-right:0}
.ebgoods-basic-wrap .nav-tabs li a:hover {background:#fff;border-bottom:1px solid #e5e5e5}
.ebgoods-basic-wrap .nav-tabs li a.active {z-index:1;background:#fff;color:#000;border-bottom:1px solid transparent}
.ebgoods-basic-wrap .nav-tabs li .cursor-pointer:hover {cursor:pointer}
.ebgoods-basic-wrap .tab-content {position:relative;padding:0}
.ebgoods-basic {margin-left:-10px;margin-right:-10px}
.ebgoods-basic:after {content:"";display:block;clear:both}
.ebgoods-basic .ebgoods-item-wrap {padding:10px;width:25%;float:left}
.ebgoods-basic .ebgoods-item {position:relative;-webkit-transition:all 0.2s ease-in-out;transition:all 0.2s ease-in-out}
.ebgoods-basic .goods-img {position:relative;overflow:hidden;margin-bottom:10px;background:#fff}
.ebgoods-basic .goods-img-in {position:relative;overflow:hidden;width:100%}
.ebgoods-basic .goods-img-in:before {content:"";display:block;padding-top:100%;background:#fff}
.ebgoods-basic .goods-img-in img {display:block;max-width:100% !important;height:auto !important;position:absolute;top:0;left:0;right:0;bottom:0}
.ebgoods-basic .goods-description .goods-description-in {position:relative;overflow:hidden;padding:0 0 10px}
.ebgoods-basic .goods-description .goods-name {position:relative;overflow:hidden;margin:10px 0 5px;font-size:1.125rem;font-weight:700;line-height:1.4;height:48px}
.ebgoods-basic .goods-description .goods-name a {color:#000}
.ebgoods-basic .goods-description .goods-name a:hover {text-decoration:underline}
.ebgoods-basic .goods-description .title-price {font-size:1.125rem;font-weight:700;color:#cc2300;margin-right:7px}
.ebgoods-basic .goods-description .line-through {font-size:.9375rem;color:#959595;text-decoration:line-through;font-weight:400;white-space:nowrap}
.ebgoods-basic .goods-description .goods-id {color:#757575;display:block;font-size:.8125rem;margin-top:10px}
.ebgoods-basic .goods-description .goods-info {position:relative;overflow:hidden;height:38px;color:#959595;font-size:.8125rem;margin-top:10px}
.ebgoods-basic .goods-description .goods-sns {position:relative;height:30px;margin-top:10px}
.ebgoods-basic .goods-description .goods-sns ul {position:absolute;top:0;right:0;margin:0;padding:0;list-style:none}
.ebgoods-basic .goods-description .goods-sns ul:after {content:"";display:block;clear:both}
.ebgoods-basic .goods-description .goods-sns ul li {float:left;margin-left:1px}
.ebgoods-basic .goods-description .goods-sns ul li a {display:block;width:30px;height:30px;line-height:30px;text-align:center;background:#b5b5b5;color:#fff;font-size:.75rem}
.ebgoods-basic .goods-description .goods-sns ul li:hover .wish-icon {background:#cc2300}
.ebgoods-basic .goods-description .goods-sns ul li:hover .facebook-icon {background:#39558f}
.ebgoods-basic .goods-description .goods-sns ul li:hover .twitter-icon {background:#4698e0}
.ebgoods-basic .goods-description-bottom {position:relative;overflow:hidden;padding:10px 0;border-top:1px solid #e5e5e5;font-size:.8125rem}
.ebgoods-basic .shop-rgba-red {background:#cc2300}
.ebgoods-basic .shop-rgba-yellow {background:#ff9500}
.ebgoods-basic .shop-rgba-green {background:#00897b}
.ebgoods-basic .shop-rgba-purple {background:#8e24aa}
.ebgoods-basic .shop-rgba-orange {background:#f4511e}
.ebgoods-basic .shop-rgba-dark {background:#3c3c3e}
.ebgoods-basic .shop-rgba-default {background:#A6A6A6}
.ebgoods-basic .rgba-banner-area {position:absolute;top:0;right:0}
.ebgoods-basic .rgba-banner {height:18px;width:70px;line-height:18px;color:#fff;font-size:.6875rem;text-align:center;font-weight:400;position:relative;text-transform:uppercase;margin-bottom:1px}
.ebgoods-basic .ebgoods-item:hover .goods-name a {text-decoration:underline}
@media (max-width:1199px) {
    .ebgoods-basic {margin-left:-5px;margin-right:-5px}
    .ebgoods-basic .ebgoods-item-wrap {width:33.33333%;padding:5px}
}
@media (max-width:991px) {
    .ebgoods-basic .ebgoods-item-wrap {width:50%}
}
@media (max-width:767px) {
    .ebgoods-basic {margin-left:-2px;margin-right:-2px}
    .ebgoods-basic .ebgoods-item-wrap {padding:5px 2px}
}
</style>

<div class="headline-short">
    <h4>
        <?php if ($eg_master['eg_link']) { ?>
        <a href="<?php echo $eg_master['eg_link']; ?>" target="<?php echo $eg_master['eg_target']; ?>"><strong><?php echo $eg_master['eg_subject']; ?></strong></a>
        <?php } else { ?>
        <?php echo $eg_master['eg_subject']; ?>
        <?php } ?>
    </h4>
</div>

<div class="ebgoods-basic-wrap">
    <ul class="nav nav-tabs ebgoods-basic-tabs">
        <?php if (is_array($eg_item)) { foreach ($eg_item as $k => $eb_goods) { ?>
        <li><a href="#basic-tlb-<?php echo $eg_master['eg_code']; ?>-<?php echo ($k+1); ?>" data-toggle="tab" <?php if ($eb_goods['gi_link']) { ?>data-href="<?php echo $eb_goods['gi_link']; ?>" target="<?php echo $eb_goods['gi_target']; ?>"<?php } ?> class="<?php if ($k==0) { ?>active<?php } else if ($eg_count == ($k+1)) { ?>last<?php }?> <?php if ($eb_goods['gi_link']) { ?>cursor-pointer<?php } ?>"><?php echo $eb_goods['gi_title']; ?></a></li>
        <?php }} ?>
    </ul>
    <div class="tab-content">
        <?php if (is_array($eg_item)) { foreach ($eg_item as $k => $eb_goods) { ?>
        <div class="tab-pane <?php echo ($k==0) ? 'active': ''; ?> in" id="basic-tlb-<?php echo $eg_master['eg_code']; ?>-<?php echo ($k+1); ?>">
            <div class="ebgoods-basic">
                <?php if (count((array)$eb_goods['list']) > 0) { foreach ($eb_goods['list'] as $i => $data) { ?>
                <div class="ebgoods-item-wrap">
                    <div class="ebgoods-item">
                        <?php if ($eb_goods['gi_view_img'] == 'y') { ?>
                        <a href="<?php echo $data['href']; ?>">
                            <div class="goods-img">
                                <div class="goods-img-in">
                                    <?php if($data['it_image']) { ?>
                                    <?php echo $data['it_image']; ?>
                                    <?php } ?>
                                    <?php if ($eb_goods['gi_view_it_icon']) { ?>
                                    <?php echo $data['it_icon']; ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </a>
                        <?php } ?>

                        <div class="goods-description">
                            <div class="goods-description-in">
                                <h4 class="goods-name">
                                    <a href="<?php echo $data['href']; ?>">
                                        <?php echo $data['it_name']?>
                                    </a>
                                </h4>

                                <div class="goods-price">
                                    <?php if ($eb_goods['gi_view_it_price'] == 'y') { ?>
                                    <span class="title-price">₩ <?php echo preg_replace('/원/','',display_price(get_price($data), $data['it_tel_inq'])); ?></span>
                                    <?php } ?>
                                    <?php if ($eb_goods['gi_view_it_cust_price'] == 'y' && $data['it_cust_price']) { ?>
                                    <span class="title-price line-through">₩ <?php echo number_format($data['it_cust_price']); ?></span>
                                    <?php } ?>
                                </div>

                                <?php if ($eb_goods['gi_view_it_id'] == 'y') { ?>
                                <span class="goods-id"><?php echo stripslashes($data['it_id']); ?></span>
                                <?php } ?>

                                <?php if ($eb_goods['gi_view_it_basic'] == 'y') { ?>
                                <div class="goods-info"><?php echo $data['it_basic']?></div>
                                <?php } ?>

                                <?php if ($eb_goods['gi_view_sns'] == 'y') { ?>
                                <div class="goods-sns">
                                    <ul>
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $data['sns_url']; ?>&amp;p=<?php echo $data['sns_title']; ?>" target="_blank" class="facebook-icon" title="페이스북"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="https://twitter.com/share?url=<?php echo $data['sns_url']; ?>&amp;text=<?php echo $data['sns_title']; ?>" target="_blank" class="twitter-icon" title="트위터"><i class="fab fa-twitter"></i></a></li>
                                    </ul>
                                </div>
                                <?php } ?>
                            </div>

                            <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                            <div class="adm-edit-btn btn-edit-mode" style="bottom:0">
                                <div class="btn-group">
                                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemform&w=u&it_id=<?php echo $data['it_id']; ?>&wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l ae-item-btn"><i class="far fa-edit"></i> 개별상품 설정</a>
                                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemform&w=u&it_id=<?php echo $data['it_id']; ?>" target="_blank" class="ae-btn-r" title="새창 열기">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <?php if(0) { // 상품분류 숨김 처리 ?>
                        <div class="goods-description-bottom">
                            <span class="text-gray">상품분류 : <span class="text-black"><?php echo $data['ca_name']; ?></span></span>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php }} ?>
                
                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="adm-edit-btn btn-edit-mode" style="top:-20px">
                    <div class="btn-group">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebgoods_itemform&amp;thema=<?php echo $theme; ?>&amp;eg_code=<?php echo $eg_master['eg_code']; ?>&amp;gi_no=<?php echo $eb_goods['gi_no']; ?>&amp;w=u&amp;iw=u&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l ae-item-btn"><i class="far fa-edit"></i> EB상품 아이템 설정</a>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebgoods_itemform&amp;thema=<?php echo $theme; ?>&amp;eg_code=<?php echo $eg_master['eg_code']; ?>&amp;gi_no=<?php echo $eb_goods['gi_no']; ?>&amp;w=u&amp;iw=u" target="_blank" class="ae-btn-r" title="새창 열기">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
                <?php } ?>

                <?php if (count((array)$eb_goods['list']) == 0) { ?>
                <p class="text-center text-gray m-t-50 m-b-50"><i class="fas fa-exclamation-circle"></i> 등록된 상품이 없습니다.</p>
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