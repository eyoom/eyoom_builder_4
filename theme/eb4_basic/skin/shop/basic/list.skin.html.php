<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/list.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.shop-list-navcate-wrap {position:relative;border:1px solid #c5c5c5;margin-bottom:30px}
.shop-list-nav-box {border-bottom:1px solid #e5e5e5;padding:10px}
.shop-list-cate-box {min-height:44px;padding:10px}
.shop-list-sort-wrap {position:relative}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width:991px) {
    .shop-list-sort-wrap .tab-scroll-category {margin-bottom:20px}
}
<?php } ?>
</style>

<div id="fakeloader"></div>

<div class="shop-list">
    <div class="shop-list-navcate-wrap">
        <div class="shop-list-nav-box">
            <?php /* 네이게이션 정보 */ ?>
            <?php include $nav_skin; ?>
        </div>
        <div class="shop-list-cate-box">
            <?php /* 상품분류 정보 */ ?>
            <?php include $cate_skin; ?>
        </div>
    </div>

    <?php /* 상단 HTML */ ?>
    <div id="sct_hhtml" class="margin-bottom-20"><?php echo conv_content($ca['ca_head_html'], 1); ?></div>

    <div class="shop-list-sort-wrap">
        <?php /* 상품 정렬 선택 시작 */ ?>
        <?php include $sort_skin; ?>
        <?php include $sub_skin; ?>
    </div>

    <?php echo $item_list; ?>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>

    <?php /* 하단 HTML */ ?>
    <div id="sct_thtml"><?php echo conv_content($ca['ca_tail_html'], 1); ?></div>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/fakeLoader/fakeLoader.min.js"></script>
<script>
$('#fakeloader').fakeLoader({
    timeToHide:3000,
    zIndex:"11",
    spinner:"spinner6",
    bgColor:"#f4f4f4",
});

$(window).load(function(){
    $('#fakeloader').fadeOut(300);
});

var itemlist_ca_id = "<?php echo $ca_id; ?>";

$.fn.listType = function(type) {
    var $el = this.find(".item-list");
    var count = $el.size();
    if(count < 1)
        return;

    var cl = this.attr("class");
    if(cl && !this.data("class")) {
        this.data("class", cl);
    }

    $("button.product-type-btn span").removeClass("product-type-on").html("");

    if(type == "gallery") {
        this.removeClass("product-type-gallery");
        if(this.data("class")) {
            this.attr("class", this.data("class"));
        }

        $("button.product-type-gallery-btn span").addClass("product-type-on").html("<b class=\"sound_only\"> 선택됨</b>");
    } else {
        if(this.data("class")) {
            this.removeAttr("class");
        }
        this.addClass("product-type-list");

        $("button.product-type-list-btn span").addClass("product-type-on").html("<b class=\"sound_only\"> 선택됨</b>");
    }

    set_cookie("ck_itemlist"+itemlist_ca_id+"_type", type, 1, g5_cookie_domain);
}

$(function() {
    if(itemlist_type = get_cookie("ck_itemlist"+itemlist_ca_id+"_type")) {
        $("#product_list").listType(itemlist_type);
    }

    $("button.product-type-btn").on("click", function() {
        if($(this).hasClass("product-type-gallery-btn")) {
            $("#product_list").listType("gallery");
        } else {
            $("#product_list").listType("list");
        }
    });
});
</script>