<?php
/**
 * page file : /theme/THEME_NAME/page/contactus.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.sub-title {position:relative;font-size:36px;margin:10px 0 50px}
.sub-title small {display:block;margin-top:10px;font-size:.9375rem;border-top:1px solid #757575;padding-top:10px}
.contact-img {margin-bottom:50px}
.contact-info h3 {margin:0 0 20px;font-size:1.375rem}
.contact-info ul {position:relative;border-bottom:1px solid #c5c5c5}
.contact-info ul:after {content:"";position:absolute;bottom:-2px;left:0;width:80px;height:2px;background:#353535}
.contact-info li {position:relative;padding:15px 0 15px 90px;border-top:1px solid #c5c5c5;color:#757575}
.contact-info li span {position:absolute;top:-1px;left:0;display:block;width:80px;color:#252525;border-top:2px solid #353535;padding-top:15px}
.map-box {margin-top:30px}
</style>

<div class="sub-page page-contact">
	<h3 class="sub-title">Contact Us <small>초기 목표설정을 통해 계획적인 진행을 거쳐 임무를 완수할 수 있는 시스템을 만들어 내고 그 결과물로 한단계 더 성장합니다.</small></h3>

	<div class="contact-top">
		<div class="contact-info-wrap">
			<div class="contact-img"><img src="<?php echo EYOOM_THEME_PAGE_URL; ?>/img/contactus_01.jpg" class="img-fluid" alt=""></div>
			<div class="contact-info">
				<h3>회사정보</h3>
				<ul class="list-unstyled">
					<li><span>&middot; 회사명</span> <?php echo $bizinfo['bi_company_name']; ?></li>
					<li><span>&middot; 주소</span> <?php echo $bizinfo['bi_company_zip']; ?> <?php echo $bizinfo['bi_company_addr1']; ?> <?php echo $bizinfo['bi_company_addr2']; ?> <?php echo $bizinfo['bi_company_addr3']; ?></li>
					<li><span>&middot; 이메일</span> <a href="mailto:<?php echo $bizinfo['bi_cs_email']; ?>"><?php echo $bizinfo['bi_cs_email']; ?></a></li>
					<?php if($bizinfo['bi_cs_tel1']) { ?>
					<li><span>&middot; 전화번호</span> <?php echo $bizinfo['bi_cs_tel1']; ?></li>
					<?php } ?>
					<?php if($bizinfo['bi_cs_fax']) { ?>
					<li><span>&middot; 팩스번호</span> <?php echo $bizinfo['bi_cs_fax']; ?></li>
					<?php } ?>
				</ul>
				<div class="map-box">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1581.054867924505!2d126.9761484873726!3d37.576033597526504!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357ca2eaa004eda1%3A0xf00ffa78293b4ece!2z7ISc7Jq47Yq567OE7IucIOyiheuhnOq1rCDsooXroZwxLjIuMy406rCA64-ZIDEtNTY!5e0!3m2!1sko!2skr!4v1631585905886!5m2!1sko!2skr" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
				</div>
			</div>
		</div>
	</div>
</div>