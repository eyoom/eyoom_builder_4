<?php
/**
 * skin file : /theme/THEME_NAME/skin/ebbanner/basic/ebbanner.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/slick/slick.min.css" type="text/css" media="screen">',0);
?>

<?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
<div class="position-relative <?php if ($bn_master['bn_state'] == '2') { ?>eb-hidden-space<?php } ?>">
    <div class="adm-edit-btn btn-edit-mode" style="top:0;text-align:right">
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
                이미지 비율 1400x400 픽셀 사이즈 권장<br>
                </span>
            "><i class="fas fa-question-circle"></i></button>
        </div>
    </div>
</div>
<?php } ?>

<?php if (isset($bn_master) && $bn_master['bn_state'] == '1') { // 보이기 상태에서만 출력 ?>
<style>
.ebb-basic-wrap-<?php echo $bn_code; ?> {position:relative}
.ebb-basic-wrap-<?php echo $bn_code; ?> .slick-dotted.slick-banner {margin-bottom:0}
.ebb-basic-in {position:relative;overflow:hidden;display:none}
.ebb-basic-in .ebb-basic {margin-bottom:0}
.ebb-basic-in .ebb-basic .ebb-basic-item {position:relative;outline:none}
.ebb-basic-in .ebb-basic .ebb-basic-item img {display:block;max-width:100%;height:auto}
.ebb-basic-in .ebb-basic .ebb-basic-item .ebb-basic-cont {position:absolute;top:0;bottom:0;left:0;right:0;padding:50px 70px;background:rgba(0,0,0,0.15);word-break:keep-all}
.ebb-basic-in .ebb-basic .ebb-basic-item .ebb-basic-cont h2 {color:#fff;font-weight:700}
.ebb-basic-in .ebb-basic .ebb-basic-item .ebb-basic-cont h5 {color:#fff;margin-top:20px;font-size:1.375rem}
.ebb-basic-in .ebb-basic .ebb-basic-item .ebb-basic-cont p {margin-top:20px;font-size:1rem;color:#fff}
.ebb-basic-in .ebb-basic .slick-dots {bottom:20px;z-index:2}
.ebb-basic-in .ebb-basic .slick-dots li {width:30px;height:5px}
.ebb-basic-in .ebb-basic .slick-dots li button:before {content:"";color:#fff;font-size:0;line-height:0;width:30px;height:4px;background:#fff;opacity:0.45}
.ebb-basic-in .ebb-basic .slick-dots li.slick-active button:before {opacity:0.85}
.ebb-basic-in .ebb-basic .slick-next, .ebb-basic-in .ebb-basic .slick-prev {width:30px;height:60px;border:0;-webkit-transition: all .3s ease;-moz-transition: all .3s ease;-o-transition: all .3s ease;-ms-transition: all .3s ease;transition: all .3s ease}
.ebb-basic-in .ebb-basic .slick-next {right:15px;z-index:1}
.ebb-basic-in .ebb-basic .slick-prev {left:15px;z-index:1}
.ebb-basic-in .ebb-basic .slick-next:before, .ebb-basic-in .ebb-basic .slick-prev:before {content:"";display:block;position:absolute;top:50%;width:40px;height:40px;margin-top:-20px;-webkit-transform:rotate(45deg);-moz-transform:rotate(45deg);-o-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg)}
.ebb-basic-in .ebb-basic .slick-next:before {right:10px;border-right:1px solid #fff;border-top:1px solid #fff}
.ebb-basic-in .ebb-basic .slick-prev:before {left:10px;border-left:1px solid #fff;border-bottom:1px solid #fff}
.ebb-basic-in .ebb-basic .slick-next:after, .ebb-basic-in .ebb-basic .slick-prev:after {content:"";display:block;position:absolute;top:50%;width:0;height:1px;background:#fff;-webkit-transition:all 0.4s ease-in-out;-moz-transition:all 0.4s ease-in-out;-o-transition:all 0.4s ease-in-out;transition:all 0.4s ease-in-out}
.ebb-basic-in .ebb-basic .slick-next:after {right:3px}
.ebb-basic-in .ebb-basic .slick-prev:after {left:3px}
.ebb-basic-in .ebb-basic .slick-next:hover:after, .ebb-basic-in .ebb-basic .slick-prev:hover:after {width:40px}
@media (max-width:1199px) {
    .ebb-basic-in .ebb-basic .ebb-basic-item .ebb-basic-cont {padding:30px 70px}
}
@media (max-width:576px) {
    .ebb-basic-in .ebb-basic .ebb-basic-item .ebb-basic-cont {padding:30px}
    .ebb-basic-in .ebb-basic .slick-dots {bottom:5px}
}
</style>

<div class="ebb-basic-wrap-<?php echo $bn_code; ?>">
    <?php if (is_array($banner)) { ?>
    <div class="ebb-basic-in">
        <div class="ebb-basic">
            <?php foreach ($banner as $k => $item) { ?>
            <div class="ebb-basic-item">
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
                    <div class="ebb-basic-cont">
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
    </div>
    <?php } ?>
    <?php if ($bn_default) { ?>
    <div class="ebb-basic-in">
        <div class="ebb-basic">
            <div class="ebb-basic-item">
                <img src="<?php echo $ebbanner_skin_url; ?>/image/01.jpg" alt="">
                <div class="ebb-basic-cont">
                    <h2>배너 타이틀</h2>
                    <h5>배너 서브 타이틀</h5>
                </div>
            </div>
            <div class="ebb-basic-item">
                <img src="<?php echo $ebbanner_skin_url; ?>/image/02.jpg" alt="">
                <div class="ebb-basic-cont">
                    <h2>배너 타이틀</h2>
                    <h5>배너 서브 타이틀</h5>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/slick/slick.min.js"></script>
<script>
$(window).load(function(){
    $('.ebb-basic-wrap-<?php echo $bn_code; ?> .ebb-basic-in').show();
    $('.ebb-basic-wrap-<?php echo $bn_code; ?> .ebb-basic').slick({
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