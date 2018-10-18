<?php
/**
 * skin file : /theme/THEME_NAME/skin/ebslider/shop_basic/ebslider.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/slick/slick.min.css" type="text/css" media="screen">',0);
?>

<?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
<div class="position-relative <?php if ($es_master['es_state'] == '2') { ?>eb-hidden-space<?php } ?>">
    <div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="top:-22px;text-align:right">
        <div class="btn-group">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebslider_form&thema=<?php echo $theme; ?>&es_code=<?php echo $es_code; ?>&w=u&wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-xs btn-e-red btn-e-split"><i class="far fa-edit"></i> EB슬라이더 마스터 설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebslider_form&thema=<?php echo $theme; ?>&es_code=<?php echo $es_code; ?>&w=u" target="_blank" class="btn-e btn-e-xs btn-e-red btn-e-split-red dropdown-toggle" title="새창 열기">
                <i class="far fa-window-maximize"></i>
            </a>
            <button type="button" class="btn-e btn-e-xs btn-e-red btn-e-split-red popovers" data-container="body" data-toggle="popover" data-placement="top" data-html="true" data-content="
                <span class='font-size-11'>
                <strong class='color-indigo'>이미지 권장 사이즈</strong><br>
                <div class='margin-hr-5'></div>
                1024 x 432 픽셀 사이즈 권장
                </span>
            "><i class="fas fa-question-circle"></i></button>
        </div>
    </div>
</div>
<?php } ?>

<?php if (isset($es_master) && $es_master['es_state'] == '1') { // 보이기 상태에서만 출력 ?>
<style>
.es-shop-basic-wrap-<?php echo $es_code; ?> {position:relative}
.es-shop-basic-wrap-<?php echo $es_code; ?> .slick-dotted.slick-slider {margin-bottom:0}
.es-shop-basic-in {position:relative;overflow:hidden;display:none}
.es-shop-basic-in .es-shop-basic .es-shop-basic-item {position:relative;outline:none}
.es-shop-basic-in .es-shop-basic .es-shop-basic-item .es-shop-basic-cont {position:absolute;top:0;left:0;width:100%;height:220px;background:rgba(0, 0, 0, 0.4);padding:20px 40px}
.es-shop-basic-in .es-shop-basic .es-shop-basic-item .es-shop-basic-cont h3 {padding:0;margin:0;color:#fff;font-size:20px;font-weight:bold}
.es-shop-basic-in .es-shop-basic .es-shop-basic-item .es-shop-basic-cont h2 {padding:0;margin:20px 0 0;color:#fff;font-size:26px;font-weight:bold}
.es-shop-basic-in .es-shop-basic .es-shop-basic-item .es-shop-basic-cont p {padding:0;margin:20px 0 0;color:#fff}
.es-shop-basic-in .es-shop-basic .es-shop-basic-item img {display:block;width:100% \9;max-width:100%;height:auto}
.es-shop-basic-in .es-shop-basic .slick-dots {bottom:10px;z-index:2}
.es-shop-basic-in .es-shop-basic .slick-dots li button:before {color:#fff;font-size:14px;opacity:0.45}
.es-shop-basic-in .es-shop-basic .slick-dots li.slick-active button:before {opacity:0.85}
.es-shop-basic-in .es-shop-basic .slick-next, .es-shop-basic-in .es-shop-basic .slick-prev {width:50px;height:50px;top:50%;background:RGBA(0, 0, 0, 0.4);z-index:1;-webkit-transition:all 0.2s ease-in-out;-moz-transition:all 0.2s ease-in-out;-o-transition:all 0.2s ease-in-out;transition:all 0.2s ease-in-out}
.es-shop-basic-in .es-shop-basic .slick-next {right:5px}
.es-shop-basic-in .es-shop-basic .slick-prev {left:5px}
.es-shop-basic-in .es-shop-basic .slick-next:hover, .es-shop-basic-in .es-shop-basic .slick-prev:hover {background:RGBA(0, 0, 0, 0.5)}
.es-shop-basic-in .es-shop-basic .slick-next:before, .es-shop-basic-in .es-shop-basic .slick-prev:before {font-family:'Font Awesome\ 5 Free';font-weight:900;color:#fff;font-size:18px}
.es-shop-basic-in .es-shop-basic .slick-next:before {content:"\f054"}
.es-shop-basic-in .es-shop-basic .slick-prev:before {content:"\f053"}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width:767px) {
    .es-shop-basic-in .es-shop-basic .es-shop-basic-item {padding:0}
    .es-shop-basic-in .es-shop-basic .es-shop-basic-item .es-shop-basic-cont {height:170px;padding:10px}
    .es-shop-basic-in .es-shop-basic .es-shop-basic-item .es-shop-basic-cont h3 {font-size:16px}
    .es-shop-basic-in .es-shop-basic .es-shop-basic-item .es-shop-basic-cont h2 {font-size:20px;margin-top:10px}
    .es-shop-basic-in .es-shop-basic .es-shop-basic-item .es-shop-basic-cont p {display:none}
}
<?php } ?>
</style>

<div class="es-shop-basic-wrap-<?php echo $es_code; ?>">
    <div class="es-shop-basic-in">
        <div class="es-shop-basic">
        <?php if (is_array($slider)) { ?>
            <?php foreach ($slider as $k => $item) { ?>
            <div class="es-shop-basic-item">
                <?php if ($item['href_1']) { ?>
                <a href="<?php echo $item['href_1']; ?>" target="<?php echo $item['target_1']; ?>">
                <?php } ?>
                    <img src="<?php echo $item['src_1']?>" class="img-responsive" alt="">
                    <?php if ($item['ei_subtitle'] || $item['ei_title'] || $item['ei_text']) { ?>
                    <div class="es-shop-basic-cont">
                        <h3><?php echo $item['ei_subtitle']?></h3>
                        <h2><?php echo $item['ei_title']?></h2>
                        <p><?php echo stripslashes($item['ei_text']); ?></p>
                    </div>
                    <?php } ?>
                <?php if ($item['href_1']) { ?>
                </a>
                <?php } ?>

                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="bottom:40px">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=ebslider_itemform&thema=<?php echo $theme; ?>&es_code=<?php echo $es_code; ?>&ei_no=<?php echo $item['ei_no']; ?>&w=u&iw=u&wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-xs btn-e-dark btn-e-split"><i class="far fa-edit"></i> EB슬라이더 아이템 수정</a>
                    <button type="button" class="btn-e btn-e-xs btn-e-dark btn-e-split-dark popovers" data-container="body" data-toggle="popover" data-placement="top" data-html="true" data-content="
                        <span class='font-size-11'>
                        <strong class='color-indigo'>이미지 권장 사이즈</strong><br>
                        <div class='margin-hr-5'></div>
                        1024 x 432 픽셀 사이즈 권장
                        </span>
                    "><i class="fas fa-question-circle"></i></button>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
        <?php } ?>
        </div>
    </div>

    <?php if ($es_default) { ?>
    <div class="es-shop-basic-in">
        <div class="es-shop-basic">
            <div class="es-shop-basic-item">
                <img src="<?php echo $ebslider_skin_url; ?>/image/slider_sample_1.jpg" class="img-responsive" alt="">
                <div class="es-shop-basic-cont">
                    <h3>Elit Sem</h3>
                    <h2>Vehicula Adipiscing Fermentum</h2>
                    <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                </div>
            </div>
            <div class="es-shop-basic-item">
                <img src="<?php echo $ebslider_skin_url; ?>/image/slider_sample_2.jpg" class="img-responsive" alt="">
                <div class="es-shop-basic-cont">
                    <h3>Consectetur Cras</h3>
                    <h2>Inceptos Aenean Risus</h2>
                    <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/slick/slick.min.js"></script>
<script>
$(window).load(function(){
    $('.es-shop-basic-wrap-<?php echo $es_code; ?> .es-shop-basic-in').show();
    $('.es-shop-basic-wrap-<?php echo $es_code; ?> .es-shop-basic').slick({
        slidesToShow: 1,
        arrows: true,
        dots: true,
        autoplay: true,
        autoplaySpeed: 5000,
        <?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    fade: true,
                    cssEase: 'linear',
                    centerPadding: '0px',
                    slidesToShow: 1
                }
            }
        ]
        <?php } ?>
    });
});
</script>
<?php } ?>