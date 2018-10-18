<?php
/**
 * skin file : /theme/THEME_NAME/skin/ebslider/basic/ebslider.skin.html.php
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
        </div>
    </div>
</div>
<?php } ?>

<?php if (isset($es_master) && $es_master['es_state'] == '1') { // 보이기 상태에서만 출력 ?>
<style>
.eb-slider-basic-wrap-<?php echo $es_code; ?> {position:relative;margin-bottom:30px}
.eb-slider-basic-wrap-<?php echo $es_code; ?> .slick-dotted.slick-slider {margin-bottom:0}
.eb-slider-basic-in {position:relative;overflow:hidden;display:none}
.eb-slider-basic-in .eb-slider-basic .eb-slider-basic-item {position:relative;outline:none}
.eb-slider-basic-in .eb-slider-basic .eb-slider-basic-item .eb-slider-basic-cont {position:absolute;top:0;left:0;width:100%;height:220px;background:rgba(0, 0, 0, 0.4);padding:20px 40px}
.eb-slider-basic-in .eb-slider-basic .eb-slider-basic-item .eb-slider-basic-cont h3 {padding:0;margin:0;color:#fff;font-size:20px;font-weight:bold}
.eb-slider-basic-in .eb-slider-basic .eb-slider-basic-item .eb-slider-basic-cont h2 {padding:0;margin:20px 0 0;color:#fff;font-size:26px;font-weight:bold}
.eb-slider-basic-in .eb-slider-basic .eb-slider-basic-item .eb-slider-basic-cont p {padding:0;margin:20px 0 0;color:#fff}
.eb-slider-basic-in .eb-slider-basic .eb-slider-basic-item img {display:block;width:100% \9;max-width:100%;height:auto}
.eb-slider-basic-in .eb-slider-basic .slick-dots {bottom:10px;z-index:2}
.eb-slider-basic-in .eb-slider-basic .slick-dots li button:before {color:#fff;font-size:14px;opacity:0.45}
.eb-slider-basic-in .eb-slider-basic .slick-dots li.slick-active button:before {opacity:0.85}
.eb-slider-basic-in .eb-slider-basic .slick-next, .eb-slider-basic-in .eb-slider-basic .slick-prev {width:50px;height:50px;top:50%;background:RGBA(0, 0, 0, 0.4);z-index:1;-webkit-transition:all 0.2s ease-in-out;-moz-transition:all 0.2s ease-in-out;-o-transition:all 0.2s ease-in-out;transition:all 0.2s ease-in-out}
.eb-slider-basic-in .eb-slider-basic .slick-next {right:5px}
.eb-slider-basic-in .eb-slider-basic .slick-prev {left:5px}
.eb-slider-basic-in .eb-slider-basic .slick-next:hover, .eb-slider-basic-in .eb-slider-basic .slick-prev:hover {background:RGBA(0, 0, 0, 0.5)}
.eb-slider-basic-in .eb-slider-basic .slick-next:before, .eb-slider-basic-in .eb-slider-basic .slick-prev:before {font-family:'Font Awesome\ 5 Free';font-weight:900;color:#fff;font-size:18px}
.eb-slider-basic-in .eb-slider-basic .slick-next:before {content:"\f054"}
.eb-slider-basic-in .eb-slider-basic .slick-prev:before {content:"\f053"}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width:767px) {
    .eb-slider-basic-in .eb-slider-basic .eb-slider-basic-item {padding:0}
    .eb-slider-basic-in .eb-slider-basic .eb-slider-basic-item .eb-slider-basic-cont {height:170px;padding:10px}
    .eb-slider-basic-in .eb-slider-basic .eb-slider-basic-item .eb-slider-basic-cont h3 {font-size:16px}
    .eb-slider-basic-in .eb-slider-basic .eb-slider-basic-item .eb-slider-basic-cont h2 {font-size:20px;margin-top:10px}
    .eb-slider-basic-in .eb-slider-basic .eb-slider-basic-item .eb-slider-basic-cont p {display:none}
}
<?php } ?>
</style>

<div class="eb-slider-basic-wrap-<?php echo $es_code; ?>">
    <div class="eb-slider-basic-in">
        <div class="eb-slider-basic">
        <?php if (is_array($slider)) { ?>
            <?php foreach ($slider as $k => $item) { ?>
            <div class="eb-slider-basic-item">
                <?php if ($item['href_1']) { ?>
                <a href="<?php echo $item['href_1']; ?>" target="<?php echo $item['target_1']; ?>">
                <?php } ?>
                    <img src="<?php echo $item['src_1']?>" class="img-responsive" alt="">
                    <?php if ($item['ei_subtitle'] || $item['ei_title'] || $item['ei_text']) { ?>
                    <div class="eb-slider-basic-cont">
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
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=ebslider_itemform&thema=<?php echo $theme; ?>&es_code=<?php echo $es_code; ?>&ei_no=<?php echo $item['ei_no']; ?>&w=u&iw=u&wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-xs btn-e-dark"><i class="far fa-edit"></i> EB슬라이더 아이템 수정</a>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
        <?php } ?>
        </div>
    </div>

    <?php if ($es_default) { ?>
    <div class="eb-slider-basic-in">
        <div class="eb-slider-basic">
            <div class="eb-slider-basic-item">
                <img src="<?php echo $ebslider_skin_url; ?>/image/slider_sample_1.jpg" class="img-responsive" alt="">
                <div class="eb-slider-basic-cont">
                    <h3>이윰에 오신것을 환영합니다.</h3>
                    <h2>Welcome to EYOOM</h2>
                    <p>새로운 소통의 창구 '이윰'에 오신것을 환영합니다.<br>더 나은 커뮤니티 환경을 위해 모인 여러분들께 최고의 환경을 선사하겠습니다.<br>즐겁게 보내다 가시기 바랍니다.</p>
                </div>
            </div>
            <div class="eb-slider-basic-item">
                <img src="<?php echo $ebslider_skin_url; ?>/image/slider_sample_2.jpg" class="img-responsive" alt="">
                <div class="eb-slider-basic-cont">
                    <h3></h3>
                    <h2>Enjoy EYOOM</h2>
                    <p>새로운 소통의 창구 '이윰'에 오신것을 환영합니다.<br>더 나은 커뮤니티 환경을 위해 모인 여러분들께 최고의 환경을 선사하겠습니다.<br>즐겁게 보내다 가시기 바랍니다.</p>
                </div>
            </div>
            <div class="eb-slider-basic-item">
                <img src="<?php echo $ebslider_skin_url; ?>/image/slider_sample_3.jpg" class="img-responsive" alt="">
                <div class="eb-slider-basic-cont">
                    <h3>끝나지 않는 우리들의 이야기</h3>
                    <h2>Conglature is a never ending story.</h2>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/slick/slick.min.js"></script>
<script>
$(window).load(function(){
    $('.eb-slider-basic-wrap-<?php echo $es_code; ?> .eb-slider-basic-in').show();
    $('.eb-slider-basic-wrap-<?php echo $es_code; ?> .eb-slider-basic').slick({
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