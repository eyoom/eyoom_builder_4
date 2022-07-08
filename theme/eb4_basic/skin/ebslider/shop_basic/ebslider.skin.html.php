<?php
/**
 * skin file : /theme/THEME_NAME/skin/ebslider/shop_basic/ebslider.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/slick/slick.min.css" type="text/css" media="screen">',0);
?>

<?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
<div class="position-relative <?php if ($es_master['es_state'] == '2') { ?>eb-hidden-space<?php } ?>">
    <div class="adm-edit-btn btn-edit-mode" style="top:0;text-align:right">
        <div class="btn-group">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebslider_form&thema=<?php echo $theme; ?>&es_code=<?php echo $es_code; ?>&w=u&wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> EB슬라이더 마스터 설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebslider_form&thema=<?php echo $theme; ?>&es_code=<?php echo $es_code; ?>&w=u" target="_blank" class="ae-btn-r" title="새창 열기">
                <i class="fas fa-external-link-alt"></i>
            </a>
            <button type="button" class="ae-btn-info" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-html="true" data-bs-content="
                <span class='f-s-13r'>
                <strong class='text-indigo'>좌측 [EB슬라이더 마스터 설정 버튼] 클릭 후 아래 설명 참고</strong><br>
                <div class='margin-hr-5'></div>
                <span class='text-indigo'>[설정정보]</span><br>
                1. 슬라이더마스터 제목 : 쇼핑몰 메인 슬라이더<br>
                2. 슬라이더마스터 스킨 : shop_basic<br>
                3. EB슬라이더 아이템 링크수 : 1개<br>
                4. EB슬라이더 아이템 이미지수 : 2개<br>
                <span class='text-indigo'>[EB 슬라이더 - 아이템 관리]</span><br>
                1. EB슬라이더 아이템 추가 클릭<br>
                2. 대표 타이틀 입력<br>
                3. 서브 타이틀 입력<br>
                4. 설명문구 입력<br>
                5. 연결주소 [링크] #1 입력<br>
                6. 이미지 #1 업로드 (PC 화면용 이미지)<br>
                7. 이미지 #2 업로드 (모바일 화면용 이미지)<br>
                <div class='margin-hr-5'></div>
                PC 화면용 이미지 비율 2500x800 픽셀 사이즈 권장<br>
                모바일 화면용 이미지 비율 800x800 픽셀 사이즈 권장
                </span>
            "><i class="fas fa-question-circle"></i></button>
        </div>
    </div>
</div>
<?php } ?>

<?php if (isset($es_master) && $es_master['es_state'] == '1') { // 보이기 상태에서만 출력 ?>
<style>
.ebs-shop-basic-wrap-<?php echo $es_code; ?> {position:relative}
.ebs-shop-basic-wrap-<?php echo $es_code; ?> .slick-dotted.slick-slider {margin-bottom:0}
.ebs-shop-basic-in {position:relative;overflow:hidden;display:none}
.ebs-shop-basic-in .ebs-shop-basic .ebs-shop-basic-item {position:relative;outline:none}
.ebs-shop-basic-in .ebs-shop-basic .ebs-shop-basic-item img {display:block;max-width:100%;height:auto}
.ebs-shop-basic-in .ebs-shop-basic .ebs-shop-basic-item .ebs-shop-basic-cont {position:absolute;top:0;bottom:0;left:0;right:0;padding:70px;background:rgba(0,0,0,0.15);word-break:keep-all}
.ebs-shop-basic-in .ebs-shop-basic .ebs-shop-basic-item .ebs-shop-basic-cont h2 {color:#fff;font-weight:700}
.ebs-shop-basic-in .ebs-shop-basic .ebs-shop-basic-item .ebs-shop-basic-cont h5 {color:#fff;margin-top:20px;font-size:1.375rem}
.ebs-shop-basic-in .ebs-shop-basic .ebs-shop-basic-item .ebs-shop-basic-cont p {margin-top:20px;font-size:1rem;color:#fff}
.ebs-shop-basic-in .ebs-shop-basic .slick-dots {bottom:20px;z-index:2}
.ebs-shop-basic-in .ebs-shop-basic .slick-dots li {width:30px;height:5px}
.ebs-shop-basic-in .ebs-shop-basic .slick-dots li button:before {content:"";color:#fff;font-size:0;line-height:0;width:30px;height:4px;background:#fff;opacity:0.45}
.ebs-shop-basic-in .ebs-shop-basic .slick-dots li.slick-active button:before {opacity:0.85}
.ebs-shop-basic-in .ebs-shop-basic .slick-next, .ebs-shop-basic-in .ebs-shop-basic .slick-prev {width:30px;height:60px;border:0;-webkit-transition: all .3s ease;-moz-transition: all .3s ease;-o-transition: all .3s ease;-ms-transition: all .3s ease;transition: all .3s ease}
.ebs-shop-basic-in .ebs-shop-basic .slick-next {right:15px;z-index:1}
.ebs-shop-basic-in .ebs-shop-basic .slick-prev {left:15px;z-index:1}
.ebs-shop-basic-in .ebs-shop-basic .slick-next:before, .ebs-shop-basic-in .ebs-shop-basic .slick-prev:before {content:"";display:block;position:absolute;top:50%;width:40px;height:40px;margin-top:-20px;-webkit-transform:rotate(45deg);-moz-transform:rotate(45deg);-o-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg)}
.ebs-shop-basic-in .ebs-shop-basic .slick-next:before {right:10px;border-right:1px solid #fff;border-top:1px solid #fff}
.ebs-shop-basic-in .ebs-shop-basic .slick-prev:before {left:10px;border-left:1px solid #fff;border-bottom:1px solid #fff}
.ebs-shop-basic-in .ebs-shop-basic .slick-next:after, .ebs-shop-basic-in .ebs-shop-basic .slick-prev:after {content:"";display:block;position:absolute;top:50%;width:0;height:1px;background:#fff;-webkit-transition:all 0.4s ease-in-out;-moz-transition:all 0.4s ease-in-out;-o-transition:all 0.4s ease-in-out;transition:all 0.4s ease-in-out}
.ebs-shop-basic-in .ebs-shop-basic .slick-next:after {right:3px}
.ebs-shop-basic-in .ebs-shop-basic .slick-prev:after {left:3px}
.ebs-shop-basic-in .ebs-shop-basic .slick-next:hover:after, .ebs-shop-basic-in .ebs-shop-basic .slick-prev:hover:after {width:40px}
@media (max-width:1199px) {
    .ebs-shop-basic-in .ebs-shop-basic .ebs-shop-basic-item .ebs-shop-basic-cont {padding:30px 70px}
}
@media (max-width:576px) {
    .ebs-shop-basic-in .ebs-shop-basic .ebs-shop-basic-item .ebs-shop-basic-cont {padding:30px}
}
</style>

<div class="ebs-shop-basic-wrap-<?php echo $es_code; ?>">
    <?php if (is_array($slider)) { ?>
    <div class="ebs-shop-basic-in">
        <div class="ebs-shop-basic">
            <?php foreach ($slider as $k => $item) { ?>
            <div class="ebs-shop-basic-item">
                <?php if ($item['href_1']) { ?>
                <a href="<?php echo $item['href_1']; ?>" target="<?php echo $item['target_1']; ?>">
                <?php } ?>
                    <picture>
                        <source srcset="<?php echo $item['src_1']?>" media="(min-width:768px)">
                        <source srcset="<?php echo $item['src_2']?>" media="(max-width:767px)">
                        <img src="<?php echo $item['src_1']?>" alt="">
                    </picture>
                    <?php if ($item['ei_title'] || $item['ei_subtitle']) { ?>
                    <div class="ebs-shop-basic-cont">
                        <?php if ($item['ei_title']) { ?>
                        <h2><?php echo $item['ei_title']?></h2>
                        <?php } ?>
                        <?php if ($item['ei_subtitle']) { ?>
                        <h5><?php echo $item['ei_subtitle']?></h5>
                        <?php } ?>
                        <?php if ($item['ei_text']) { ?>
                        <p><?php echo stripslashes($item['ei_text']); ?></p>
                        <?php } ?>
                    </div>
                    <?php } ?>
                <?php if ($item['href_1']) { ?>
                </a>
                <?php } ?>
                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="adm-edit-btn btn-edit-mode" style="top:40px">
                    <div class="btn-group">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=ebslider_itemform&thema=<?php echo $theme; ?>&es_code=<?php echo $es_code; ?>&ei_no=<?php echo $item['ei_no']; ?>&w=u&iw=u&wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-item-btn"><i class="far fa-edit"></i> EB슬라이더 아이템 설정</a>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=ebslider_itemform&thema=<?php echo $theme; ?>&es_code=<?php echo $es_code; ?>&ei_no=<?php echo $item['ei_no']; ?>&w=u&iw=u" target="_blank" class="ae-btn-r" title="새창 열기">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    <?php if ($es_default) { ?>
    <div class="ebs-shop-basic-in">
        <div class="ebs-shop-basic">
            <div class="ebs-shop-basic-item">
                <picture>
                    <source srcset="<?php echo $ebslider_skin_url; ?>/image/01.jpg" media="(min-width:768px)">
                    <source srcset="<?php echo $ebslider_skin_url; ?>/image/01_m.jpg" media="(max-width:767px)">
                    <img src="<?php echo $ebslider_skin_url; ?>/image/01.jpg" alt="">
                </picture>
                <div class="ebs-shop-basic-cont">
                    <h2>STORE SLIDE 1</h2>
                    <p>Etiam porta sem malesuada magna mollis euismod.</p>
                </div>
            </div>
            <div class="ebs-shop-basic-item">
                <picture>
                    <source srcset="<?php echo $ebslider_skin_url; ?>/image/02.jpg" media="(min-width:768px)">
                    <source srcset="<?php echo $ebslider_skin_url; ?>/image/02_m.jpg" media="(max-width:767px)">
                    <img src="<?php echo $ebslider_skin_url; ?>/image/02.jpg" alt="">
                </picture>
                <div class="ebs-shop-basic-cont">
                    <h2>STORE SLIDE 2</h2>
                    <p>Aenean lacinia bibendum nulla sed consectetur.</p>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/slick/slick.min.js"></script>
<script>
$(window).load(function(){
    $('.ebs-shop-basic-wrap-<?php echo $es_code; ?> .ebs-shop-basic-in').show();
    $('.ebs-shop-basic-wrap-<?php echo $es_code; ?> .ebs-shop-basic').slick({
        slidesToShow: 1,
        arrows: true,
        dots: true,
        autoplay: true,
        autoplaySpeed: 5000,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false
                }
            }
        ]
    });
});
</script>
<?php } ?>