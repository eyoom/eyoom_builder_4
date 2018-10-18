<?php
/**
 * page file : /theme/eb4_0022_busi/page/subpage_01.html.php
 */
if (!defined('_EYOOM_')) exit;
add_stylesheet('<link href="https://fonts.googleapis.com/css?family=Nanum+Myeongjo:700" rel="stylesheet">',0);
?>
<style>
.sub-page-section {position:relative;margin-bottom:30px}
/* 페이지 앵커 */
.anchor-page {position:absolute;top:-50px;height:0;width:0}

/* 타이틀 */
.ebcontents-title h2 {position:relative;margin:0;padding:90px 0 120px;margin-bottom:30px;text-align:center;font-size:26px}
.ebcontents-title h2 small {display:block;margin-top:10px;font-size:14px}
.ebcontents-title h2:after {content:"";position:absolute;bottom:20px;left:50%;display:block;width:1px;height:60px;background:#69AFDB}
.ebcontents-title {margin-bottom:40px;text-align:center}
.ebcontents-title h3 {margin-bottom:30px;font-size:34px;font-weight:700;font-family:'Nanum Myeongjo', serif}
.ebcontents-title p {font-size:16px;line-height:30px}
@media (max-width:991px){
    .ebcontents-title h3 {font-size:24px}
}
@media (max-width:767px) {
    .ebcontents-title h2 {padding:70px 0 100px}
    .ebcontents-title h3 {font-size:20px;line-height:30px}
    .ebcontents-title p {font-size:14px;line-height:24px}
}

/* 회사 정보 */
.contact-info {margin-top:40px}
.contact-info dl {margin:0}
.contact-info dl:after {content:"";display:block;clear:both}
.contact-info dl dt {float:left;width:30%;padding-right:50px}
.contact-info dl dt h6 {padding:20px 0;margin:0;border-top:3px solid #333;font-size:16px;font-weight:bold}
.contact-info dl dd {float:left;width:70%;padding:20px 0;font-size:16px;border-top:1px solid #333}

@media (min-width:1200px){
    .sub-page-01 .ebcontents-title {padding:0 80px}
}
@media (max-width:991px){
    .sub-page-01 .ebcontents-title {padding:0 }
    .sub-page-01 .ebcontents-title h3 {font-size:24px}
    .contact-info dl dt {width:35%;padding-right:30px}
    .contact-info dl dd {width:65%}
}
@media (max-width:767px){
    .sub-page-01 .ebcontents-title h3 {font-size:20px;line-height:30px}
    .sub-page-01 .ebcontents-title p {font-size:14px;line-height:24px}
    .contact-info dl dt, .contact-info dl dd {width:100%}
    .contact-info dl dt {padding-right:0}
    .contact-info dl dt h6, .contact-info dl dd {font-size:14px}
}
</style>
<div class="sub-page sub-page-01">
    <section class="sub-page-section section-01">
        <div class="anchor-page" id="sub01Sect01"></div>
        <?php /* EB콘텐츠 - overviwe */ ?>
        <?php echo eb_contents('1530509799'); ?>
    </section>
    
    <section class="sub-page-section section-02">
        <div class="anchor-page" id="sub01Sect02"></div>
        <?php /* EB콘텐츠 - history */ ?>
        <?php echo eb_contents('1530517339'); ?>
    </section>
    
    <section class="sub-page-section section-03">
        <div class="anchor-page" id="sub01Sect03"></div>
        <?php /* EB콘텐츠 - vision */ ?>
        <?php echo eb_contents('1530604144'); ?>
    </section>
    
    <section class="sub-page-section section-04">
        <div class="anchor-page" id="sub01Sect04"></div>
        <?php /* EB콘텐츠 - R&D */ ?>
        <?php echo eb_contents('1530606504'); ?>
    </section>
    
    <section class="sub-page-section section-05">
        <div class="anchor-page" id="sub01Sect05"></div>
        <?php /* EB콘텐츠 - contact */ ?>
        <?php echo eb_contents('1530608415'); ?>
        <?php /* 회사정보 */ ?>
        <div class="contact-info">
            <dl>
                <dt><h6>회사명</h6></dt>
                <dd><?php echo $bizinfo['bi_company_name'] ?></dd>
            </dl>
            <dl>
                <dt><h6>대표이사</h6></dt>
                <dd><?php echo $bizinfo['bi_company_ceo'] ?></dd>
            </dl>
            <dl>
                <dt><h6>주소</h6></dt>
                <dd><?php echo $bizinfo['bi_company_addr1'] ?> <?php echo $bizinfo['bi_company_addr2'] ?> <?php echo $bizinfo['bi_company_addr3'] ?></dd>
            </dl>
            <dl>
                <dt><h6>사업자등록번호</h6></dt>
                <dd><?php echo $bizinfo['bi_company_bizno'] ?></dd>
            </dl>
            <dl>
                <dt><h6>대표전화</h6></dt>
                <dd><?php echo $bizinfo['bi_company_tel'] ?></dd>
            </dl>
            <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
            <p class="color-red"><i class="fas fa-exclamation-circle"></i> 하단 기업 정보 설정에서 내용 입력(편집모드 on 일때 보임)</p>
            <?php } ?>
        </div>
    </section>
</div>