<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/itemqalist.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/magnific-popup/magnific-popup.min.css" type="text/css" media="screen">',0);
?>

<style>
.shop-product-qa-list .uselist-search-box {position:relative;padding:15px;margin-bottom:30px;border:1px solid #d5d5d5;background:#fff}
.shop-product-qa-list .search-input .icon-prepend {background-color:transparent;width:38px;height:36px;line-height:36px;border:0;color:#959595;font-size:.9375rem}
.shop-product-qa-list .panel-group .panel {margin-bottom:15px}
.shop-product-qa-list .panel-heading {min-height:100px;padding:15px;border:1px solid #d5d5d5}
.shop-product-qa-list .panel-heading .label {display:inline-block;width:64px;text-align:center}
.shop-product-qa-list .panel-heading .sit_qaa_yet {background:#ab0000}
.shop-product-qa-list .product-use-img {position:absolute;top:15px;left:15px;width:70px;height:70px;overflow:hidden}
.shop-product-qa-list .product-use-img img {display:block;max-width:100%;height:auto}
.shop-product-qa-list .product-use-img span {position:absolute;font-size:0;line-height:0;overflow:hidden}
.shop-product-qa-list .heading-content {margin-left:85px}
.shop-product-qa-list .panel-title {font-size:1rem;font-weight:700;line-height:1.4}
.shop-product-qa-list .panel-title i {color:#ab0000;margin-left:5px}
.shop-product-qa-list .panel-title a:hover {text-decoration:underline;color:#000}
.shop-product-qa-list .panel-title > a:before {top:15px;margin-top:inherit;font-size:1rem}
.shop-product-qa-list .panel-body {padding:0}
.shop-product-qa-list .panel-body img {width:inherit !important;max-width:500px;height:auto}
.shop-product-qa-list .product-qa-cont .product-qa-alp {position:absolute;top:15px;left:15px;font-size:1.5rem;color:#959595;font-weight:700}
.shop-product-qa-list .product-qa-cont .product-qa-qaa {padding:15px;padding-left:45px;position:relative;min-height:100px;border-top:1px solid #d5d5d5}
.shop-product-qa-list .product-qa-cont .product-qa-qaq {padding:15px;padding-left:45px;position:relative;min-height:100px}
@media (max-width:767px) {
    .shop-product-qa-list .panel-body img {max-width:100%}
}
</style>

<?php /* ---------- 전체 상품 문의 목록 시작 ---------- */ ?>
<div class="shop-product-qa-list">
    <form method="get" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" class="eyoom-form">
	<div class="uselist-search-box">
        <div class="width-60 float-start">
            <div class="width-200px">
                <label for="sfl" class="sound_only">검색항목<strong class="sound_only"> 필수</strong></label>
                <label class="select">
                    <select name="sfl" id="sfl" required class="form-control">
                        <option value="">선택</option>
                        <option value="b.it_name"    <?php echo get_selected($sfl, "b.it_name", true); ?>>상품명</option>
                        <option value="a.it_id"      <?php echo get_selected($sfl, "a.it_id"); ?>>상품코드</option>
                        <option value="a.iq_subject" <?php echo get_selected($sfl, "a.iq_subject"); ?>>문의제목</option>
                        <option value="a.iq_question"<?php echo get_selected($sfl, "a.iq_question"); ?>>문의내용</option>
                        <option value="a.iq_name"    <?php echo get_selected($sfl, "a.iq_name"); ?>>작성자명</option>
                        <option value="a.mb_id"      <?php echo get_selected($sfl, "a.mb_id"); ?>>작성자아이디</option>
                    </select>
                    <i></i>
                </label>
            </div>
        </div>
        <div class="width-40 float-end text-end">
            <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>" class="btn-e btn-e-dark">전체보기</a>
        </div>
        <div class="clearfix"></div>
        <div>
            <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
            <div class="input input-button search-input">
                <i class="icon-prepend fa fa-search"></i>
                <input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" required>
                <div class="button"><input type="submit" value="검색">검색</div>
            </div>
        </div>
	</div>
    </form>

    <?php if ($count > 0) { ?>
    <p class="text-gray m-b-15"><i class="fas fa-info-circle m-r-5"></i>타이틀 이미지 클릭시 해당상품으로 이동</p>
    <?php } ?>

    <div class="panel-group accordion-default panel-group-control panel-group-control-right" id="porduct-qa">
        <?php for ($i=0; $i<$count; $i++) { ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="product-use-img" data-bs-toggle="tooltip" data-bs-placement="right" title="<?php echo $list[$i]['it_name']; ?>">
                    <a href="<?php echo $list[$i]['it_href']; ?>">
                        <?php echo get_it_image($list[$i]['it_id'], 160, 0); ?>
                        <span><?php echo $list[$i]['it_name']; ?></span>
                    </a>
                </div>
                <div class="heading-content">
                    <h4 class="panel-title">
                        <a class="collapsed shop-use-collapsed" data-bs-toggle="collapse" href="#product_qa_<?php echo $i ?>">
                            <?php echo $list[$i]['iq_subject']; ?>
                        </a>
                    </h4>
                    <div class="m-t-10">
                        <div class="float-start">
                            <span class="text-gray">
                                <span class="m-r-10"><?php echo $list[$i]['iq_name']; ?></span>
                                <span><?php echo substr($list[$i]['iq_time'],0,10); ?></span>
                            </span>
                        </div>
                        <div class="float-end">
                            <span class="label label-default <?php echo $list[$i]['iq_style']; ?>"><?php echo $list[$i]['iq_stats']; ?></span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div id="product_qa_<?php echo $i ?>" class="panel-collapse collapse" data-bs-parent="#porduct-qa">
                <div class="panel-body">
                    <div class="product-qa-cont">
                        <div class="product-qa-qaq">
                            <strong class="sound_only">문의내용</strong>
                            <span class="product-qa-alp">Q</span>
                            <?php echo $list[$i]['iq_question']; // 상품 문의 내용 ?>
                        </div>
                        <?php if (!$list[$i]['is_secret']) { ?>
                        <div class="product-qa-qaa">
                            <strong class="sound_only">답변</strong>
                            <span class="product-qa-alp">A</span>
                            <?php echo $list[$i]['iq_answer']; ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php if ($count == 0) { ?>
        <div class="text-center text-gray m-t-30"><i class="fas fa-exclamation-circle m-r-5"></i>자료가 없습니다.</div>
        <?php } ?>
    </div>
</div>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>
<?php /* ---------- 전체 상품 사용후기 목록 끝 ---------- */ ?>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/magnific-popup/magnific-popup.min.js"></script>
<script>
$(function() {
	$('.product-qa-cont img').wrap('<a class="view-image-popup">');
	$('.product-qa-cont img').each(function() {
		var imgURL = $(this).attr('src');
		$(this).parent().attr('href', imgURL);
	});
	$('.view-image-popup').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		mainClass: 'mfp-img-mobile',
		image: {
			verticalFit: true
		}
	});
});
</script>