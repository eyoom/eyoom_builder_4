<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/itemuselist.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/magnific-popup/magnific-popup.min.css" type="text/css" media="screen">',0);
?>

<style>
.shop-product-use-list .uselist-search-box {position:relative;padding:15px;margin-bottom:30px;border:1px solid #d5d5d5;background:#fff}
.shop-product-use-list .search-input input {height:42px;background:#f8f8f8;font-size:13px;font-weight:bold}
.shop-product-use-list .search-input .icon-prepend {background-color:transparent;width:42px;height:40px;line-height:40px;border:0;color:#959595;font-size:14px}
.shop-product-use-list .input-button .button {height:40px;line-height:40px;background:#fff;padding:0 30px;font-size:13px}
.shop-product-use-list .panel-group .panel {margin-bottom:10px}
.shop-product-use-list .panel-heading {min-height:80px;padding:10px;border:1px solid #e5e5e5}
.shop-product-use-list .product-use-img {position:absolute;top:10px;left:10px;width:60px;height:60px;overflow:hidden}
.shop-product-use-list .product-use-img img {display:block;width:100% \9;max-width:100%;height:auto}
.shop-product-use-list .product-use-img span {position:absolute;font-size:0;line-height:0;overflow:hidden}
.shop-product-use-list .heading-content {margin-left:75px}
.shop-product-use-list .heading-content .star-image {width:80px}
.shop-product-use-list .panel-title {font-size:14px;font-weight:bold}
.shop-product-use-list .panel-title a:hover {text-decoration:underline;color:#000}
.shop-product-use-list .panel-title > a:before {top:10px;margin-top:inherit;font-size:14px}
.shop-product-use-list .panel-body img {width:inherit !important;max-width:500px;height:auto}
.shop-product-use-list .panel-body .panel-use-reply {position:relative;border-top:1px dotted #e5e5e5;margin:10px 0 0;padding:10px 0 0 30px}
.shop-product-use-list .panel-body .use-reply-icon {position:absolute;top:15px;left:0px;width:15px;height:30px;text-indent:-999px;overflow:hidden;border-left:1px dotted #c5c5c5;border-bottom:1px dotted #c5c5c5}
.shop-product-use-list .panel-body .use-reply-subj {font-size:14px;font-weight:bold;line-height:1.5;margin:0}
.shop-product-use-list .panel-body .use-reply-name {font-size:12px;color:#959595;margin:5px 0}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width:600px) {
    .shop-product-use-list .heading-content .star-image {width:70px}
    .shop-product-use-list .panel-body img {max-width:100%}
}
<?php } ?>
</style>

<?php /* ---------- 전체 상품 사용후기 목록 시작 ---------- */ ?>
<div class="shop-product-use-list">
    <form method="get" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" class="eyoom-form">
	<div class="uselist-search-box">
	    <div class="width-60 pull-left">
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
	    <div class="width-40 pull-right text-right">
		    <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>" class="btn-e btn-e-dark">전체보기</a>
	    </div>
	    <div class="clearfix"></div>
	    <div class="margin-top-10">
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
    <p class="font-size-12 color-grey"><i class="fas fa-info-circle"></i> 타이틀 이미지 클릭시 해당상품으로 이동</p>
    <?php } ?>

    <div class="panel-group accordion-default panel-group-control panel-group-control-right" id="porduct-review">
        <?php for ($i=0; $i<$count; $i++) { ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="product-use-img tooltips" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $list[$i]['it_name']; ?>">
                    <a href="<?php echo $list[$i]['it_href']; ?>">
                        <?php echo get_itemuselist_thumbnail($list[$i]['it_id'], $list[$i]['is_content'], 160, 0); ?>
                        <span><?php echo $list[$i]['it_name']; ?></span>
                    </a>
                </div>
                <div class="heading-content">
                    <h4 class="panel-title">
                        <a class="collapsed shop-use-collapsed" data-toggle="collapse" data-parent="#porduct-review" href="#review_<?php echo $i ?>">
                            <?php echo get_text($list[$i]['is_subject']); ?>
                        </a>
                    </h4>
                    <div class="margin-top-10">
                        <div class="pull-left">
                            <span class="font-size-12 color-grey">
                                <span class="margin-right-10"><?php echo $list[$i]['is_name']; ?></span>
                                <span><?php echo substr($list[$i]['is_time'],0,10); ?></span>
                            </span>
                        </div>
                        <div class="pull-right">
                            <img src="<?php echo G5_URL; ?>/shop/img/s_star<?php echo $list[$i]['star']; ?>.png" alt="별<?php echo $list[$i]['star']; ?>개" class="star-image">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div id="review_<?php echo $i ?>" class="panel-collapse collapse">
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
        <div class="text-center color-grey font-size-13 margin-top-10"><i class="fas fa-exclamation-circle"></i> 자료가 없습니다.</div>
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