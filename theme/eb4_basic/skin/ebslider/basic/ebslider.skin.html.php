<?php
/**
 * skin file : /theme/THEME_NAME/skin/ebslider/basic/ebslider.skin.html.php
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
                1. 슬라이더마스터 제목 : 메인 슬라이더<br>
                2. 슬라이더마스터 스킨 : basic<br>
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
                PC 화면용 이미지 비율 1400x600 픽셀 사이즈 권장<br>
                모바일 화면용 이미지 비율 800x800 픽셀 사이즈 권장
                </span>
            "><i class="fas fa-question-circle"></i></button>
        </div>
    </div>
</div>
<?php } ?>

<?php if (isset($es_master) && $es_master['es_state'] == '1') { // 보이기 상태에서만 출력 ?>
<style>
.ebs-basic-wrap-<?php echo $es_code; ?> {position:relative}
.ebs-basic-wrap-<?php echo $es_code; ?> .slick-dotted.slick-slider {margin-bottom:0}
.ebs-basic-in {position:relative;overflow:hidden;display:none}
.ebs-basic-in .ebs-basic .ebs-basic-item {position:relative;outline:none}
.ebs-basic-in .ebs-basic .ebs-basic-item img {display:block;max-width:100%;height:auto}
.ebs-basic-in .ebs-basic .ebs-basic-item .ebs-basic-cont {position:absolute;top:0;bottom:0;left:0;right:0;padding:50px 70px;background:rgba(0,0,0,0.15);word-break:keep-all}
.ebs-basic-in .ebs-basic .ebs-basic-item .ebs-basic-cont h2 {color:#fff;font-weight:700}
.ebs-basic-in .ebs-basic .ebs-basic-item .ebs-basic-cont h5 {color:#fff;margin-top:20px;font-size:1.375rem}
.ebs-basic-in .ebs-basic .ebs-basic-item .ebs-basic-cont p {margin-top:20px;font-size:1rem;color:#fff}
.ebs-basic-in .ebs-basic .slick-dots {bottom:20px;z-index:2}
.ebs-basic-in .ebs-basic .slick-dots li {width:30px;height:5px}
.ebs-basic-in .ebs-basic .slick-dots li button:before {content:"";color:#fff;font-size:0;line-height:0;width:30px;height:4px;background:#fff;opacity:0.45}
.ebs-basic-in .ebs-basic .slick-dots li.slick-active button:before {opacity:0.85}
.ebs-basic-in .ebs-basic .slick-next, .ebs-basic-in .ebs-basic .slick-prev {width:30px;height:60px;border:0;-webkit-transition: all .3s ease;-moz-transition: all .3s ease;-o-transition: all .3s ease;-ms-transition: all .3s ease;transition: all .3s ease}
.ebs-basic-in .ebs-basic .slick-next {right:15px;z-index:1}
.ebs-basic-in .ebs-basic .slick-prev {left:15px;z-index:1}
.ebs-basic-in .ebs-basic .slick-next:before, .ebs-basic-in .ebs-basic .slick-prev:before {content:"";display:block;position:absolute;top:50%;width:40px;height:40px;margin-top:-20px;-webkit-transform:rotate(45deg);-moz-transform:rotate(45deg);-o-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg)}
.ebs-basic-in .ebs-basic .slick-next:before {right:10px;border-right:1px solid #fff;border-top:1px solid #fff}
.ebs-basic-in .ebs-basic .slick-prev:before {left:10px;border-left:1px solid #fff;border-bottom:1px solid #fff}
.ebs-basic-in .ebs-basic .slick-next:after, .ebs-basic-in .ebs-basic .slick-prev:after {content:"";display:block;position:absolute;top:50%;width:0;height:1px;background:#fff;-webkit-transition:all 0.4s ease-in-out;-moz-transition:all 0.4s ease-in-out;-o-transition:all 0.4s ease-in-out;transition:all 0.4s ease-in-out}
.ebs-basic-in .ebs-basic .slick-next:after {right:3px}
.ebs-basic-in .ebs-basic .slick-prev:after {left:3px}
.ebs-basic-in .ebs-basic .slick-next:hover:after, .ebs-basic-in .ebs-basic .slick-prev:hover:after {width:40px}
@media (max-width:1199px) {
    .ebs-basic-in .ebs-basic .ebs-basic-item .ebs-basic-cont {padding:30px 70px}
}
@media (max-width:576px) {
    .ebs-basic-in .ebs-basic .ebs-basic-item .ebs-basic-cont {padding:30px}
}
</style>

<div class="ebs-basic-wrap-<?php echo $es_code; ?>">
    <?php if (is_array($slider)) { ?>
    <div class="ebs-basic-in">
        <div class="ebs-basic">
            <?php foreach ($slider as $k => $item) { ?>
            <div class="ebs-basic-item">
                <?php if ($item['href_1']) { ?>
                <a href="<?php echo $item['href_1']; ?>" target="<?php echo $item['target_1']; ?>">
                <?php } ?>
                    <picture>
                        <source srcset="<?php echo $item['src_1']?>" media="(min-width:768px)">
                        <source srcset="<?php echo $item['src_2']?>" media="(max-width:767px)">
                        <img src="<?php echo $item['src_1']?>" alt="">
                    </picture>
                    <?php if ($item['ei_title'] || $item['ei_subtitle'] || $item['ei_text']) { ?>
                    <div class="ebs-basic-cont">
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
    <div class="ebs-basic-in">
        <div class="ebs-basic">
            <div class="ebs-basic-item">
                <picture>
                    <source srcset="<?php echo $ebslider_skin_url; ?>/image/01.jpg" media="(min-width:768px)">
                    <source srcset="<?php echo $ebslider_skin_url; ?>/image/01_m.jpg" media="(max-width:767px)">
                    <img src="<?php echo $ebslider_skin_url; ?>/image/01.jpg" alt="">
                </picture>
                <div class="ebs-basic-cont">
                    <h2>최신 기술 트랜드로 코딩하여 웹수집 최적화</h2>
                    <p>웹 표준 최적화 작업은 여러분의 사이트 내 콘텐츠 정보를 검색엔진이 잘 이해할 수 있도록 정리하는 작업입니다.<br>이윰빌더는 최신 기술 트랜드에 맞춰 코딩되었으며, 각 포털 사이트의 웹수집 프로그램들이 정확하고 확실한 정보를 읽어낼 수 있도록 제작되었습니다.</p>
                </div>
            </div>
            <div class="ebs-basic-item">
                <picture>
                    <source srcset="<?php echo $ebslider_skin_url; ?>/image/02.jpg" media="(min-width:768px)">
                    <source srcset="<?php echo $ebslider_skin_url; ?>/image/02_m.jpg" media="(max-width:767px)">
                    <img src="<?php echo $ebslider_skin_url; ?>/image/02.jpg" alt="">
                </picture>
                <div class="ebs-basic-cont">
                    <h2>반응형 웹디자인으로 제작된 테마</h2>
                    <p>반응형 웹 디자인(Responsive Web Design, RWD)이란 하나의 웹사이트에서 PC, 스마트폰, 태블릿 PC 등 접속하는 디스플레이의 종류에 따라 화면의 크기가 자동으로 변하도록 만든 웹페이지 접근 기법을 말합니다.</p>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/slick/slick.min.js"></script>
<script>
$(window).load(function(){
    $('.ebs-basic-wrap-<?php echo $es_code; ?> .ebs-basic-in').show();
    $('.ebs-basic-wrap-<?php echo $es_code; ?> .ebs-basic').slick({
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