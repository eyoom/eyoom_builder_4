<?php
/**
 * page file : /theme/THEME_NAME/page/aboutus.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.sub-title {position:relative;font-size:36px;margin:10px 0 50px}
.sub-title small {display:block;margin-top:10px;font-size:.9375rem;border-top:1px solid #757575;padding-top:10px}
.aboutus-top {position:relative}
.aboutus-img {position:absolute;top:50px;left:50px;max-height:480px}
.aboutus-img:before {content:"";position:absolute;display:block;width:150px;height:150px;left:200px;bottom:-25px;background:#BD081C;z-index:1}
.aboutus-img img {position:relative;display:block;width:320px;height:auto;z-index:2}
.aboutus-top .text-1 {padding:50px 50px 50px 430px;margin:0;color:#fff;background:#252525}
.aboutus-top .text-2 {padding:50px 50px 50px 430px;margin:0;color:#000;background:#e5e5e5}
.page-words {margin:70px 0}
.page-words h4 {font-size:1.875rem;font-weight:700;color:#34608D;text-align:center;word-break:keep-all;line-height:1.5}
.aboutus-bottom {position:relative}
@media (min-width:768px) and (max-width:991px){
	.aboutus-top .text-2 {padding:80px 50px 50px}
}
@media (max-width:767px) {
	.page-words {margin:40px 0}
	.page-words h4 {font-size:1.25rem}
	.aboutus-img {top:20px;left:20px}
	.aboutus-img:before {left:165px;bottom:-15px}
	.aboutus-img img {width:300px}
	.aboutus-top .text-1 {padding:520px 20px 20px}
	.aboutus-top .text-2 {padding:20px}
}
</style>

<div class="sub-page page-aboutus">
	<h3 class="sub-title">About Us <small>초기 목표설정을 통해 계획적인 진행을 거쳐 임무를 완수할 수 있는 시스템을 만들어 내고 그 결과물로 한단계 더 성장합니다.</small></h3>

	<div class="aboutus-top">
		<div class="aboutus-img">
			<img src="<?php echo EYOOM_THEME_PAGE_URL; ?>/img/aboutus_01.jpg" alt="" />
		</div>
		<p class="text-1">우리의 내일을 함께 만들겠다는 꿈<br><br>그 꿈에 대한 열정으로 항상 앞선생각과 실천하는 행동을 보여드리며 더 큰 내일을 만들어가는 기업이 될 것을 약속 드립니다.<br><br>국내 웹시장과 전자상거래의 규모는 점점 확대되고 있습니다.<br>나이, 성별, 연령에 구애 받지 않고 누구나 쉽게 자신의 꿈을 펼쳐 볼 수 있기 때문입니다.<br>더 나은 내일을 위해 함께 걸어가며 상상너머의 세상을 같이 만들어 가는 동반자가 되고 싶습니다.</p>
		<p class="text-2">우리 기업의 친환경 신주거 문화상품인 브리츠가 고객의 신뢰와 사랑을 받을 수 있었던 것도 풍부한 자연과 고품격 주거문화를 제공하기위해 지속적으로 노력하고 변화했기 때문입니다. 우리 기업은 끊임없는 변화만이 세상을 바꿀 수 있다고 믿습니다. <br><br>이전까지의 결과가 단순한 목적에 머물렀다면 브리츠의 탄생과 더불어 결과는 비로소 건강하고 여유로운 문화공간으로 거듭나게 되었습니다. 세계에서 가장 깊은 수심에 터널을 건설한 OO대로와 국내 최초이자 세계 최대 규모의 조력발전소 건설을 통해서도 우리 기업은 세상을 움직이는 변화를 가져왔습니다.</p>
	</div>

	<div class="page-words">
		<h4>"끊임없는 변화만이 세상을 바꿀 수 있다고 믿습니다."</h4>
	</div>

	<div class="aboutus-bottom">
        <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
        <div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="top:0">
            <div class="btn-group">
                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=biz_info&amp;amode=biz&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> 기업정보 설정</a>
                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=biz_info&amp;amode=biz&amp;thema=<?php echo $theme; ?>" target="_blank" class="ae-btn-r" title="새창 열기">
                    <i class="fas fa-external-link-alt"></i>
                </a>
                <button type="button" class="ae-btn-info" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-html="true" data-bs-content="
                    <span class='f-s-13r'>
                    <strong class='text-indigo'>기업정보 사용가능한 변수</strong><br>
                    <div class='margin-hr-10'></div>
                    <strong class='text-indigo'>[설정정보]</strong><br>
                    회사명 : $bizinfo['bi_company_name']<br>
                    사업자등록번호 : $bizinfo['bi_company_bizno']<br>
                    대표자명 : $bizinfo['bi_company_ceo']<br>
                    대표전화 : $bizinfo['bi_company_tel']<br>
                    팩스번호 : $bizinfo['bi_company_fax']<br>
                    통신판매업 : $bizinfo['bi_company_sellno']<br>
                    부가통신사업자 : $bizinfo['bi_company_bugano']<br>
                    정보관리책임자 : $bizinfo['bi_company_infoman']<br>
                    정보책임자메일 : $bizinfo['bi_company_infomail']<br>
                    우편번호 : $bizinfo['bi_company_zip']<br>
                    주소1 : $bizinfo['bi_company_addr1']<br>
                    주소2 : $bizinfo['bi_company_addr2']<br>
                    주소3 : $bizinfo['bi_company_addr3']<br>
                    고객센터1 : $bizinfo['bi_cs_tel1']<br>
                    고객센터2 : $bizinfo['bi_cs_tel2']<br>
                    고객센터팩스 : $bizinfo['bi_cs_fax']<br>
                    고객센터메일 : $bizinfo['bi_cs_email']<br>
                    상담시간 : $bizinfo['bi_cs_time']<br>
                    휴무안내 : $bizinfo['bi_cs_closed']
                    </span>
                "><i class="fas fa-question-circle"></i></button>
            </div>
        </div>
        <?php } ?>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>회사명</td>
                    <td><?php echo $bizinfo['bi_company_name']; ?></td>
                </tr>
                <tr>
                    <td>대표</td>
                    <td><?php echo $bizinfo['bi_company_ceo']; ?></td>
                </tr>
                <tr>
                    <td>사업자등록번호</td>
                    <td><?php echo $bizinfo['bi_company_bizno']; ?></td>
                </tr>
                <tr>
                    <td>주소</td>
                    <td><?php echo $bizinfo['bi_company_zip']; ?> <?php echo $bizinfo['bi_company_addr1']; ?> <?php echo $bizinfo['bi_company_addr2']; ?> <?php echo $bizinfo['bi_company_addr3']; ?><a href="<?php echo G5_URL; ?>/page/?pid=contactus" class="btn-e btn-e-xxs btn-e-gray m-l-5">상세지도</a></td>
                </tr>
                <tr>
                    <td>이메일</td>
                    <td><a href="mailto:<?php echo $bizinfo['bi_cs_email']; ?>"><?php echo $bizinfo['bi_cs_email']; ?></a></td>
                </tr>
                <?php if($bizinfo['bi_cs_tel1']) { ?>
                <tr>
                    <td>전화번호</td>
                    <td><?php echo $bizinfo['bi_cs_tel1']; ?></td>
                </tr>
                <?php } ?>
                <?php if($bizinfo['bi_cs_fax']) { ?>
                <tr>
                    <td>팩스번호</td>
                    <td><?php echo $bizinfo['bi_cs_fax']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
	</div>
</div>