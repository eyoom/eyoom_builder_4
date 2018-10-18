<?php
/**
 * page file : /theme/THEME_NAME/page/aboutus.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.sub-page p, .sub-page li {word-break:keep-all;font-size:13px}
.sub-title {position:relative;font-size:37px;color:#333;margin:10px 0 70px;font-weight:300}
.sub-title small {display:block;margin-top:10px;font-size:13px;border-top:1px solid #333;padding-top:10px}
.aboutus-top {position:relative}
.aboutus-img {position:absolute;top:50px;left:50px;max-height:480px}
.aboutus-img:before {content:"";position:absolute;display:block;width:150px;height:150px;left:200px;bottom:-25px;background:#BD081C;z-index:1}
.aboutus-img img {position:relative;display:block;width:320px;height:auto;z-index:2}
.aboutus-top .text-1 {padding:50px 50px 50px 430px;margin:0;color:#fff;background:#2B3749}
.aboutus-top .text-2 {padding:50px 50px 50px 430px;margin:0;color:#000;background:#DADFE5}
.page-words {margin:70px 0}
.page-words h4 {font-size:24px;line-height:28px;font-weight:bold;color:#34608D;text-align:center}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (min-width:992px) and (max-width:1199px){
	.aboutus-top .text-2 {padding:150px 50px 50px}
}
@media (min-width:768px) and (max-width:991px){
	.aboutus-top .text-2 {padding:170px 50px 50px}
}
@media (max-width:767px) {
    .sub-title {margin-bottom:40px}
	.page-words {margin:40px 0}
	.page-words h4 {font-size:16px;line-height:22px}
	.aboutus-img {top:20px;left:20px}
	.aboutus-img:before {left:165px;bottom:-15px}
	.aboutus-img img {width:300px}
	.aboutus-top .text-1 {padding:520px 20px 20px}
	.aboutus-top .text-2 {padding:20px}
}
<?php } ?>
</style>

<div class="sub-page page-aboutus">
	<h3 class="sub-title">About Us <small>초기 목표설정을 통해 계획적인 진행을 거쳐 임무를 완수할 수 있는 시스템을 만들어 내고 그 결과물로 한단계 더 성장합니다.</small></h3>

	<div class="aboutus-top">
		<div class="aboutus-img">
			<img src="<?php echo EYOOM_THEME_PAGE_URL; ?>/img/aboutus_01.jpg" alt="" />
		</div>
		<p class="text-1">우리의 내일을 함께 만들겠다는 꿈<br><br>그 꿈에 대한 열정으로 항상 앞선생각과 실천하는 행동을 보여드리며 더 큰 내일을 만들어가는 기업이 될 것을 약속 드립니다.<br><br>국내 웹시장과 전자상거래의 규모는 점점 확대되고 있습니다.<br>나이, 성별, 연령에 구애 받지 않고 누구나 쉽게 자신의 꿈을 펼쳐 볼 수 있기 때문입니다.<br>더 나은 내일을 위해 함께 걸어가며 상상너머의 세상을 같이 만들어 가는 동반자가 되고 싶습니다.</p>
		<p class="text-2">우리 기업의 친환경 신주거 문화상품인 브리츠가 고객의 신뢰와 사랑을 받을 수 있었던 것도 풍부한 자연과 고품격 주거문화를 제공하기위해 지속적으로 노력하고 변화했기 때문입니다. 우리 기업은 끊임없는 변화만이 세상을 바꿀 수 있다고 믿습니다. <br><br>이전까지의 아파트가 단순한 주거 공간에 머물렀다면 브리츠의 탄생과 더불어 아파트는 비로소 건강하고 여유로운 문화공간으로 거듭나게 되었습니다. 세계에서 가장 깊은 수심에 침매터널을 건설한 거가대로와 국내 최초이자 세계 최대 규모의 시화호조력발전소 건설을 통해서도 우리 기업은 세상을 움직이는 변화를 가져왔습니다.</p>
	</div>

	<div class="page-words">
		<h4>"끊임없는 변화만이 세상을 바꿀 수 있다고 믿습니다."</h4>
	</div>

	<div class="aboutus-bottom">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>회사명</td>
                    <td><strong><?php echo $bizinfo['bi_company_name']; ?></strong></td>
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
                    <td><?php echo $bizinfo['bi_company_zip']; ?> <?php echo $bizinfo['bi_company_addr1']; ?> <?php echo $bizinfo['bi_company_addr2']; ?> <?php echo $bizinfo['bi_company_addr3']; ?><a href="<?php echo G5_URL; ?>/page/?pid=contactus" class="btn-e btn-e-xs btn-e-default margin-left-5">상세지도</a></td>
                </tr>
                <tr>
                    <td>이메일</td>
                    <td><a href="mailto:<?php echo $bizinfo['bi_cs_email']; ?>"><?php echo $bizinfo['bi_cs_email']; ?></a></td>
                </tr>
                <tr>
                    <td>전화번호</td>
                    <td><?php echo $bizinfo['bi_cs_tel1']; ?></td>
                </tr>
                <tr>
                    <td>팩스번호</td>
                    <td><?php echo $bizinfo['bi_cs_fax']; ?></td>
                </tr>
            </tbody>
        </table>
	</div>
</div>