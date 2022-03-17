<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/itemuselist.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/magnific-popup/magnific-popup.min.css" type="text/css" media="screen">',0);
?>

<style>
.shop-product-use-list .uselist-search-box {position:relative;padding:15px;margin-bottom:30px;border:1px solid #d5d5d5;background:#fff}
.shop-product-use-list .search-input .icon-prepend {background-color:transparent;width:38px;height:36px;line-height:36px;border:0;color:#959595;font-size:.9375rem}
.shop-product-use-list .panel-group .panel {margin-bottom:15px}
.shop-product-use-list .panel-heading {min-height:100px;padding:15px;border:1px solid #d5d5d5}
.shop-product-use-list .product-use-img {position:absolute;top:15px;left:15px;width:70px;height:70px;overflow:hidden}
.shop-product-use-list .product-use-img img {display:block;max-width:100%;height:auto}
.shop-product-use-list .product-use-img span {position:absolute;font-size:0;line-height:0;overflow:hidden}
.shop-product-use-list .heading-content {margin-left:85px}
.shop-product-use-list .heading-content .star-image {width:70px}
.shop-product-use-list .panel-title {font-size:1rem;font-weight:700;line-height:1.4}
.shop-product-use-list .panel-title a:hover {text-decoration:underline;color:#000}
.shop-product-use-list .panel-title > a:before {top:15px;margin-top:inherit;font-size:1rem}
.shop-product-use-list .panel-body img {width:inherit !important;max-width:500px;height:auto}
.shop-product-use-list .panel-body .panel-use-reply {position:relative;border-top:1px solid #f0f0f0;margin:15px 0 0;padding:15px 0 0 30px}
.shop-product-use-list .panel-body .use-reply-icon {position:absolute;top:0px;left:0px;width:10px;height:25px;text-indent:-999px;border-left:1px solid #757575;border-bottom:1px solid #757575}
.shop-product-use-list .panel-body .use-reply-icon:after {content:"";width:0;height:0;border-style:solid;border-width:5px 0 5px 8px;border-color:transparent transparent transparent #757575;position:absolute;bottom:-6px;right:-8px}
.shop-product-use-list .panel-body .use-reply-subj {font-size:1rem;font-weight:700;line-height:1.4;margin:0}
.shop-product-use-list .panel-body .use-reply-name {font-size:.9375rem;color:#959595;margin:10px 0}
@media (max-width:767px) {
    .shop-product-use-list .heading-content .star-image {width:70px}
    .shop-product-use-list .panel-body img {max-width:100%}
}
</style>

<?php /* ---------- 전체 상품 사용후기 목록 시작 ---------- */ ?>
<div class="shop-product-use-list">
    <form method="get" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" class="eyoom-form">
    <div class="uselist-search-box">
        <div class="width-60 float-start">
            <div class="width-200px">
                <label for="sfl" class="sound_only">검색항목<strong class="sound_only"> 필수</strong></label>
                <label class="select">
                    <select name="sfl" id="sfl" required class="form-control">
                        <option value="">선택</option>
                        <option value="b.it_name"   <?php echo get_selected($sfl, "b.it_name"); ?>>상품명</option>
                        <option value="a.it_id"     <?php echo get_selected($sfl, "a.it_id"); ?>>상품코드</option>
                        <option value="a.is_subject"<?php echo get_selected($sfl, "a.is_subject"); ?>>후기제목</option>
                        <option value="a.is_content"<?php echo get_selected($sfl, "a.is_content"); ?>>후기내용</option>
                        <option value="a.is_name"   <?php echo get_selected($sfl, "a.is_name"); ?>>작성자명</option>
                        <option value="a.mb_id"     <?php echo get_selected($sfl, "a.mb_id"); ?>>작성자아이디</option>
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
                <i class="icon-prepend fas fa-search"></i>
                <input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" required>
                <div class="button"><input type="submit" value="검색">검색</div>
            </div>
        </div>
    </div>
    </form>

    <?php if ($count > 0) { ?>
    <p class="text-gray m-b-15"><i class="fas fa-info-circle m-r-5"></i>타이틀 이미지 클릭시 해당상품으로 이동</p>
    <?php } ?>

    <div class="panel-group accordion-default panel-group-control panel-group-control-right" id="porduct-review">
        <?php for ($i=0; $i<$count; $i++) { ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="product-use-img" data-bs-toggle="tooltip" data-bs-placement="right" title="<?php echo $list[$i]['it_name']; ?>">
                    <a href="<?php echo $list[$i]['it_href']; ?>">
                        <?php echo get_itemuselist_thumbnail($list[$i]['it_id'], $list[$i]['is_content'], 160, 0); ?>
                        <span><?php echo $list[$i]['it_name']; ?></span>
                    </a>
                </div>
                <div class="heading-content">
                    <h4 class="panel-title">
                        <a class="collapsed shop-use-collapsed" data-bs-toggle="collapse" href="#review_<?php echo $i ?>">
                            <?php echo get_text($list[$i]['is_subject']); ?>
                        </a>
                    </h4>
                    <div class="m-t-10">
                        <div class="float-start">
                            <span class="text-gray">
                                <span class="m-r-10"><?php echo $list[$i]['is_name']; ?></span>
                                <span><?php echo substr($list[$i]['is_time'],0,10); ?></span>
                            </span>
                        </div>
                        <?php if ($list[$i]['star']) { ?>
                        <div class="float-end">
                            <img src="<?php echo G5_URL; ?>/shop/img/s_star<?php echo $list[$i]['star']; ?>.png" alt="별<?php echo $list[$i]['star']; ?>개" class="star-image">
                        </div>
                        <?php } ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div id="review_<?php echo $i ?>" class="panel-collapse collapse" data-bs-parent="#porduct-review">
                <div class="panel-body">
                    <div class="panel-use-cont">
                        <?php echo $list[$i]['is_content']; // 사용후기 내용 ?>
                    </div>
                    <?php if( !empty($list[$i]['is_reply_subject']) ) { // 사용후기 답변이 있다면 ?>
                    <div class="panel-use-reply">
                        <div class="use-reply-icon">답변</div>
                        <h5 class="use-reply-subj"><?php echo get_text($list[$i]['is_reply_subject']); ?></h5>
                        <div class="use-reply-name">
                            <?php echo $list[$i]['is_reply_name']; ?>
                        </div>
                        <div class="use-reply-cont">
                            <?php echo $list[$i]['is_reply_content']; // 사용후기 답변 내용 ?>
                        </div>
                    </div>
                    <?php } ?>
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
	$('.panel-use-cont img').wrap('<a class="view-image-popup">');
	$('.panel-use-cont img').each(function() {
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