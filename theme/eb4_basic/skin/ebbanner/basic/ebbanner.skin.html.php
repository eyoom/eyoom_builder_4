<?php
/**
 * skin file : /theme/THEME_NAME/skin/ebbanner/basic/ebbanner.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
<div class="position-relative <?php if ($bn_master['bn_state'] == '2') { ?>eb-hidden-space<?php } ?>">
    <div class="adm-edit-btn btn-edit-mode" style="top:0;text-align:right;z-index:2">
        <div class="btn-group">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebbanner_form&thema=<?php echo $theme; ?>&bn_code=<?php echo $bn_code; ?>&w=u&wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> EB배너 마스터 설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebbanner_form&thema=<?php echo $theme; ?>&bn_code=<?php echo $bn_code; ?>&w=u" target="_blank" class="ae-btn-r" title="새창 열기">
                <i class="fas fa-external-link-alt"></i>
            </a>
            <button type="button" class="ae-btn-info" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-html="true" data-bs-content="
                <span class='f-s-13r'>
                <strong class='text-indigo'>좌측 [EB배너 마스터 설정 버튼] 클릭 후 아래 설명 참고</strong><br>
                <div class='margin-hr-5'></div>
                <span class='text-indigo'>[설정정보]</span><br>
                1. 배너마스터 제목 : 기본 배너<br>
                2. 배너마스터 스킨 : basic<br>
                <span class='text-indigo'>[EB 배너 - 아이템 관리]</span><br>
                1. EB배너 아이템 추가 클릭<br>
                2. 배너 타이틀 입력 (필요시)<br>
                3. 배너 서브 타이틀 입력 (필요시)<br>
                4. 연결주소 [링크] #1 입력<br>
                5. 이미지 #1 업로드<br>
                <div class='margin-hr-5'></div>
                PC 화면용 이미지 비율 1400x300 픽셀 사이즈 권장<br>
                모바일 화면용 이미지 비율 800x800 픽셀 사이즈 권장
                </span>
            "><i class="fas fa-question-circle"></i></button>
        </div>
    </div>
</div>
<?php } ?>

<?php if (isset($bn_master) && $bn_master['bn_state'] == '1') { // 보이기 상태에서만 출력 ?>
<style>
.ebb-basic-wrap-<?php echo $bn_code; ?> {position:relative;margin-bottom:30px}
.ebb-basic-in {position:relative;overflow:hidden;border-radius:8px}
.ebb-basic-in .swiper {width:100%;height:100%;margin-left:auto;margin-right:auto}
.ebb-basic-in .swiper-slide {text-align:center;font-size:.9375rem;display:-webkit-box;display:-ms-flexbox;display:-webkit-flex;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;-webkit-justify-content:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;-webkit-align-items:center;align-items:center}
.ebb-basic-in .swiper-slide img {display:block;width:100%;height:100%;object-fit:cover}
.ebb-basic-in .swiper-slide .overlay {position:absolute;top:0;left:0;width:100%;height:100%;background:#000;opacity:0.2;z-index:2}
.ebb-basic-in .swiper-main .swiper-cont {position:absolute;top:50%;left:60px;right:60px;text-align:center;transform:translateY(-50%);z-index:3}
.ebb-basic-in .swiper-main .swiper-cont h2 {color:#fff;font-size:1.875rem;font-weight:700}
.ebb-basic-in .swiper-main .swiper-cont h5 {color:#fff;margin-top:20px;font-size:1.375rem}
.ebb-basic-in .swiper-button-next, .ebb-basic-in .swiper-button-prev {width:30px;height:60px;border:0;-webkit-transition: all .3s ease;-moz-transition: all .3s ease;-o-transition: all .3s ease;-ms-transition: all .3s ease;transition: all .3s ease}
.ebb-basic-in .swiper-button-next {right:15px;z-index:1}
.ebb-basic-in .swiper-button-prev {left:15px;z-index:1}
.ebb-basic-in .swiper-button-next:before, .ebb-basic-in .swiper-button-prev:before {content:"";display:block;position:absolute;top:50%;width:40px;height:40px;margin-top:-20px;-webkit-transform:rotate(45deg);-moz-transform:rotate(45deg);-o-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg)}
.ebb-basic-in .swiper-button-next:before {right:10px;border-right:1px solid #fff;border-top:1px solid #fff}
.ebb-basic-in .swiper-button-prev:before {left:10px;border-left:1px solid #fff;border-bottom:1px solid #fff}
.ebb-basic-in .swiper-button-next:after, .ebb-basic-in .swiper-button-prev:after {content:"";display:block;position:absolute;top:50%;width:0;height:1px;background:#fff;-webkit-transition:all 0.4s ease-in-out;-moz-transition:all 0.4s ease-in-out;-o-transition:all 0.4s ease-in-out;transition:all 0.4s ease-in-out}
.ebb-basic-in .swiper-button-next:after {right:3px}
.ebb-basic-in .swiper-button-prev:after {left:3px}
.ebb-basic-in .swiper-button-next:hover:after, .ebb-basic-in .swiper-button-prev:hover:after {width:40px}
.ebb-basic-in .swiper-button-next.disabled, .ebb-basic-in .swiper-button-prev.disabled {display:none}
.ebb-basic-in .swiper-pagination-bullet {color:#fff;font-size:0;line-height:0;width:30px;height:2px;border-radius:0;background-color:#fff;opacity:0.45}
.ebb-basic-in .swiper-pagination-bullet-active {background-color:#fff;opacity:1}
@media (max-width:1199px){
    .ebb-basic-in .swiper-main .swiper-cont h2 {font-size:1.375rem}
    .ebb-basic-in .swiper-main .swiper-cont h5 {font-size:.9375rem}
}
@media (max-width:767px){
    .ebb-basic-in .swiper-main .swiper-cont h2 {font-size:1.875rem}
    .ebb-basic-in .swiper-main .swiper-cont h5 {font-size:1rem}
}
@media (max-width:576px){
    .ebb-basic-in .swiper-main .swiper-cont {left:30px;right:30px;text-align:center}
    .ebb-basic-in .swiper-main .swiper-cont h2 {font-size:1.625rem}
    .ebb-basic-in .swiper-button-next, .ebb-basic-in .swiper-button-prev {top:inherit;bottom:10px}
    .ebb-basic-in .swiper-button-next:before, .ebb-basic-in .swiper-button-prev:before {width:24px;height:24px;margin-top:-12px}
    .ebb-basic-in .swiper-button-next:before {right:6px}
    .ebb-basic-in .swiper-button-prev:before {left:6px}
    .ebb-basic-in .swiper-button-next:hover:after, .ebb-basic-in .swiper-button-prev:hover:after {width:24px}
}
</style>

<div class="ebb-basic-wrap-<?php echo $bn_code; ?>">
    <?php if (is_array($banner)) { ?>
    <div class="ebb-basic-in">
        <div id="ebb_basic" class="swiper swiper-main">
            <div class="swiper-wrapper">
                <?php foreach ($banner as $k => $item) { ?>
                <div class="swiper-slide">
                    <?php if ($item['bi_type'] == 'intra') { // 내부배너 ?>
                    <?php if ($item['bi_href']) { ?>
                    <a href="<?php echo $item['bi_href']; ?>" target="<?php echo $item['bi_target']; ?>">
                    <?php } ?>
                        <picture>
                            <source srcset="<?php echo $item['src_1']?>" media="(min-width:768px)">
                            <source srcset="<?php echo $item['src_2']?>" media="(max-width:767px)">
                            <img src="<?php echo $item['src_1']?>" alt="">
                        </picture>
                        <?php if ($item['bi_title'] || $item['bi_subtitle']) { ?>
                        <div class="swiper-cont">
                            <?php if ($item['bi_title']) { ?>
                            <h2><?php echo $item['bi_title']?></h2>
                            <?php } ?>
                            <?php if ($item['bi_subtitle']) { ?>
                            <h5><?php echo $item['bi_subtitle']?></h5>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    <?php if ($item['bi_href']) { ?>
                    </a>
                    <?php } ?>
                    <?php } else if ($item['bi_type'] == 'extra') { // 외부배너 ?>
                        <?php echo $item['bi_script'] ? $item['bi_script']: ''; ?>
                    <?php } ?>
                    <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                    <div class="adm-edit-btn btn-edit-mode" style="top:40px">
                        <div class="btn-group">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=ebbanner_itemform&thema=<?php echo $theme; ?>&bn_code=<?php echo $bn_code; ?>&bi_no=<?php echo $item['bi_no']; ?>&w=u&iw=u&wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-item-btn"><i class="far fa-edit"></i> EB배너 아이템 설정</a>
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=ebbanner_itemform&thema=<?php echo $theme; ?>&bn_code=<?php echo $bn_code; ?>&bi_no=<?php echo $item['bi_no']; ?>&w=u&iw=u" target="_blank" class="ae-btn-r" title="새창 열기">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <?php } ?>
    <?php if ($bn_default) { ?>
    <div class="ebb-basic-in">
        <div id="ebb_basic" class="swiper swiper-main">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <picture>
                        <source srcset="<?php echo $ebbanner_skin_url; ?>/image/01.jpg" media="(min-width:768px)">
                        <source srcset="<?php echo $ebbanner_skin_url; ?>/image/01m.jpg" media="(max-width:767px)">
                        <img src="<?php echo $ebbanner_skin_url; ?>/image/01.jpg" alt="">
                    </picture>
                    <div class="swiper-cont">
                        <h2>EB Banner Sample 1</h2>
                        <h5>새로운 디자인 새로운 미래</h5>
                    </div>
                </div>
                <div class="swiper-slide">
                    <picture>
                        <source srcset="<?php echo $ebbanner_skin_url; ?>/image/02.jpg" media="(min-width:768px)">
                        <source srcset="<?php echo $ebbanner_skin_url; ?>/image/02m.jpg" media="(max-width:767px)">
                        <img src="<?php echo $ebbanner_skin_url; ?>/image/02.jpg" alt="">
                    </picture>
                    <div class="swiper-cont">
                        <h2>EB Banner Sample 2</h2>
                        <h5>새로운 디자인 새로운 미래</h5>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <?php } ?>
</div>

<script>
var ebs_basic = new Swiper("#ebb_basic", {
    loop: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
    },
});
</script>
<?php } ?>