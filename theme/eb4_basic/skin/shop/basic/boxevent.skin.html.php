<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/boxevent.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php if ($ev_count > 0) { ?>
<style>
.shop-boxevent-wrap {position:relative;margin-bottom:40px}
.shop-boxevent .boxevent-box {position:relative;border:1px solid #e5e5e5;padding:10px;margin-bottom:20px}
.shop-boxevent .boxevent-box:after {display:block;visibility:hidden;clear:both;content:""}
.shop-boxevent .boxevent-box-title {position:absolute;overflow:hidden;top:10px;left:10px;width:400px;height:250px}
.shop-boxevent .boxevent-box-title .box-title-txt {display:table-cell;vertical-align:middle;width:400px;height:250px;color:#fff;text-align:center;font-size:17px;background:#676769}
.shop-boxevent .boxevent-item-wrap {position:relative;margin-left:420px;height:250px}
.shop-boxevent .boxevent-item {margin-left:-5px;margin-right:-5px}
.shop-boxevent .boxevent-item:after {display:block;visibility:hidden;clear:both;content:""}
.shop-boxevent .boxevent-item-box {float:left;width:25%}
.shop-boxevent .boxevent-item-box-in {position:relative;padding:0 5px 5px}
.shop-boxevent .boxevent-item-box-in .boxevent-item-img {position:relative;overflow:hidden;margin-bottom:10px}
.shop-boxevent .boxevent-item-box-in .boxevent-item-img img {display:block;width:100% \9;max-width:100%;height:auto}
.shop-boxevent .boxevent-item-box-in .boxevent-item-desc h5 {position:relative;overflow:hidden;height:38px;margin:0 0 5px;font-size:14px;line-height:1.5}
.shop-boxevent .boxevent-item-box-in .boxevent-item-desc span {color:#E52700;font-weight:bold}
.shop-boxevent .boxevent-item-box-in:hover h5 {text-decoration:underline}
.shop-boxevent .boxevent-no-item {text-align:center;height:250px;line-height:250px;color:#959595}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width:991px) {
    .shop-boxevent .boxevent-box-title {width:280px;height:175px}
    .shop-boxevent .boxevent-box-title .box-title-txt {width:280px;height:175px;font-size:15px}
    .shop-boxevent .boxevent-item-wrap {margin-left:300px;height:175px}
}
@media (max-width:767px) {
    .shop-boxevent .boxevent-box-title {position:relative;width:auto;height:auto;top:inherit;left:inherit;margin-bottom:10px}
    .shop-boxevent .boxevent-box-title .box-title-txt {display:block;width:auto;height:200px;line-height:200px}
    .shop-boxevent .boxevent-item-wrap {margin-left:0;height:auto}
}
@media (max-width:550px) {
    .shop-boxevent .boxevent-item-box {width:50%}
    .shop-boxevent .boxevent-item-box-in {padding:0 5px 10px}
}
<?php } ?>
</style>

<section id="sev" class="shop-boxevent-wrap">
    <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
    <div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="top:-20px">
        <div class="btn-group">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&amp;pid=itemevent&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-xs btn-e-red btn-e-split"><i class="far fa-edit"></i> 이벤트 설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&amp;pid=itemevent&amp;thema=<?php echo $theme; ?>" target="_blank" class="btn-e btn-e-xs btn-e-red btn-e-split-red dropdown-toggle" title="새창 열기">
                <i class="far fa-window-maximize"></i>
            </a>
            <button type="button" class="btn-e btn-e-xs btn-e-red btn-e-split-red popovers" data-container="body" data-toggle="popover" data-placement="top" data-html="true" data-content="
                <span class='font-size-11'>
                <strong class='color-indigo'>이미지 권장 사이즈</strong><br>
                <div class='margin-hr-5'></div>
                600 x 375 픽셀 사이즈 권장
                </span>
            "><i class="fas fa-question-circle"></i></button>
        </div>
    </div>
    <?php } ?>

    <div class="main-heading">
        <h2><strong>이벤트</strong></h2>
    </div>
    <div class="shop-boxevent">
        <?php for ($i=0; $i<$ev_count; $i++) { ?>
        <div class="boxevent-box">
            <div class="boxevent-box-title">
                <a href="<?php echo $ev_list[$i]['href']; ?>">
                <?php if (file_exists($ev_list[$i]['event_img'])) { // 이벤트 이미지가 있다면 이미지 출력 ?>
                    <img src="<?php echo G5_DATA_URL; ?>/event/<?php echo $ev_list[$i]['ev_id']; ?>_m" class="img-responsive" alt="<?php echo $ev_list[$i]['ev_subject']; ?>">
                <?php } else { ?>
                    <div class="box-title-txt">
                        <?php if ($ev_list[$i]['ev_subject_strong']) { ?>
                        <strong><?php echo $ev_list[$i]['ev_subject']; ?></strong>
                        <?php } else { ?>
                        <?php echo $ev_list[$i]['ev_subject']; ?>
                        <?php } ?>
                    </div>
                <?php } ?>
                </a>
                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="bottom:20px">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&pid=itemeventform&thema=<?php echo $theme; ?>&ev_id=<?php echo $ev_list[$i]['ev_id']; ?>&w=u&iw=u&wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-xs btn-e-dark btn-e-split"><i class="far fa-edit"></i> 개별이벤트 설정</a>
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&pid=itemeventform&thema=<?php echo $theme; ?>&ev_id=<?php echo $ev_list[$i]['ev_id']; ?>&w=u&iw=u" target="_blank" class="btn-e btn-e-xs btn-e-dark btn-e-split-dark dropdown-toggle" title="새창 열기">
                        <i class="far fa-window-maximize"></i>
                    </a>
                    <button type="button" class="btn-e btn-e-xs btn-e-dark btn-e-split-dark popovers" data-container="body" data-toggle="popover" data-placement="top" data-html="true" data-content="
                        <span class='font-size-11'>
                        <strong class='color-indigo'>이미지 권장 사이즈</strong><br>
                        <div class='margin-hr-5'></div>
                        600 x 375 픽셀 사이즈 권장
                        </span>
                    "><i class="fas fa-question-circle"></i></button>
                </div>
                <?php } ?>
            </div>

            <div class="boxevent-item-wrap">
                <?php if (is_array($ev_list[$i]['ev_prd'])) { ?>
                <div class="boxevent-item">
                    <?php foreach ($ev_list[$i]['ev_prd'] as $k => $ev_prd) { ?>
                    <div class="boxevent-item-box">
                        <div class="boxevent-item-box-in">
                            <div class="boxevent-item-img">
                                <?php echo get_it_image($ev_prd['it_id'], 400, 0, get_text($ev_prd['it_name'])); ?>
                            </div>
                            <div class="boxevent-item-desc">
                                <a href="<?php echo $ev_prd['item_href']; ?>" class="ev_prd_tit">
                                    <h5><strong><?php echo get_text(cut_str($ev_prd['it_name'], 30)); ?></strong></h5>
                                </a>
                                <span><?php echo $ev_prd['it_price']; ?></span>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>

                <?php if (count((array)$ev_list[$i]['ev_prd']) == 0) { ?>
                <div class="boxevent-no-item">
                    <i class="fas fa-exclamation-circle"></i> 등록된 상품이 없습니다.
                </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
    </div>
</section>
<?php } ?>