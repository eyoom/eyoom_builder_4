<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/search.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sly/tab_scroll_category.css" type="text/css" media="screen">',0);
?>

<style>
.shop-search .shop-search-form .search-input input {height:42px;background:#f8f8f8;font-size:13px;font-weight:bold}
.shop-search .shop-search-form .search-input .icon-prepend {background-color:transparent;width:42px;height:40px;line-height:40px;border:0;color:#959595;font-size:14px}
.shop-search .shop-search-form .input-button .button {height:40px;line-height:40px;background:#fff;padding:0 30px;font-size:13px}
.shop-search .shop-search-form .content-box-header h4 {font-size:16px}
.shop-search .shop-search-form .content-box-footer {color:#757575}
.shop-search .search-tab {background-color:#D6D6D6;height:40px;margin-bottom:30px}
.shop-search .search-tab #tab-search-result {display:none}
.shop-search .search-tab .scroll_tabs_container {text-align:center;margin-bottom:0}
.shop-search .search-tab .scroll_tabs_container div.scroll_tab_inner li {padding-left:10px;padding-right:10px}
.shop-search .search-tab .scroll_tabs_container div.scroll_tab_inner li a {font-weight:bold}
.shop-search .search-tab .scroll_tabs_container div.scroll_tab_inner span {padding-left:2px;padding-right:0}
.shop-search .search-cate {margin-bottom:30px}
.shop-search .search-cate ul {padding-left:1px;zoom:1;list-style:none}
.shop-search .search-cate ul:after {display:block;visibility:hidden;clear:both;content:""}
.shop-search .search-cate li {float:left;width:20%;border:1px solid #d5d5d5;margin-left:-1px;margin-top:-1px}
.shop-search .search-cate a {display:block;padding:0 10px;line-height:40px;font-size:12px}
.shop-search .search-cate a:hover {background:#f5f5f5;color:#FF4848}
.shop-search #sct_lst {position:absolute;top:6px;right:0;margin-bottom:0;z-index:1;list-style:none}
.shop-search #sct_lst li {position:relative;float:left}
.shop-search #sct_lst button {position:relative;margin:0;padding:0;width:40px;height:40px;border:1px solid #d5d5d5;cursor:pointer;background:#fff;font-size:15px;color:#454545}
.shop-search #sct_lst button.product-type-list-btn {border-right:0}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width:991px) {
    .shop-search .tab-scroll-category {margin-bottom:20px}
    .shop-search #sct_lst {position:relative;top:inherit;right:inherit;float:right;margin-bottom:20px}
}
@media (max-width:767px) {
    .shop-search .search-cate li {width:33.33333%}
}
@media (max-width:550px) {
    .shop-search .search-cate li {width:50%}
}
<?php } ?>
</style>

<div id="fakeloader"></div>

<?php if ($is_admin) { ?>
<div class="text-right margin-bottom-10">
    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=configform#anc_scf_etc" class="btn-e btn-e-red">검색 설정</a>
</div>
<?php } ?>

<?php /* ---------- 쇼핑몰 검색 시작 ---------- */ ?>
<div class="shop-search">
    <?php /* 상세검색 항목 시작 */ ?>
    <div class="shop-search-form">
        <form name="frmdetailsearch" class="eyoom-form">
        <input type="hidden" name="qsort" id="qsort" value="<?php echo $qsort ?>">
        <input type="hidden" name="qorder" id="qorder" value="<?php echo $qorder ?>">
        <input type="hidden" name="qcaid" id="qcaid" value="<?php echo $qcaid ?>">

        <div class="content-box margin-bottom-30">
            <div class="content-box-header">
                <h4><strong class="color-red"><?php echo $q; ?></strong> 검색결과 <small class="font-size-13 color-grey">(총 <strong class="color-red"><?php echo $total_count; ?></strong> 건)</small></h4>
            </div>
            <div class="content-box-body">
                <div class="row">
                    <section class="col col-6">
                        <label class="label">검색범위</label>
                        <div class="inline-group">
                            <label for="ssch_qname" class="checkbox">
                                <input type="checkbox" name="qname" id="ssch_qname" value="1" <?php echo $qname_check?'checked="checked"':'';?>><i></i>상품명
                            </label>
                            <label for="ssch_qexplan" class="checkbox">
                                <input type="checkbox" name="qexplan" id="ssch_qexplan" value="1" <?php echo $qexplan_check?'checked="checked"':'';?>><i></i>상품설명
                            </label>
                            <label for="ssch_qbasic" class="checkbox">
                                <input type="checkbox" name="qbasic" id="ssch_qbasic" value="1" <?php echo $qbasic_check?'checked="checked"':'';?>><i></i>기본설명
                            </label>
                            <label for="ssch_qid" class="checkbox">
                                <input type="checkbox" name="qid" id="ssch_qid" value="1" <?php echo $qid_check?'checked="checked"':'';?>><i></i>상품코드
                            </label>
                        </div>
                    </section>
                    <section class="col col-3">
                        <label for="ssch_qfrom" class="label">최소 가격</label>
                        <label class="input">
                            <i class="icon-append font-style-normal">원</i>
                            <input type="text" name="qfrom" value="<?php echo $qfrom; ?>" id="ssch_qfrom" size="10">
                        </label>
                    </section>
                    <section class="col col-3">
                        <label for="ssch_qto" class="label">최대 가격</label>
                        <label class="input">
                            <i class="icon-append font-style-normal">원</i>
                            <input type="text" name="qto" value="<?php echo $qto; ?>" id="ssch_qto" size="10">
                        </label>
                    </section>
                    <div class="clearfix"></div>
                    <section class="col col-12 margin-bottom-0">
                        <label for="ssch_q" class="sound_only">검색어 입력 필수</label>
                        <div class="input input-button search-input">
                            <i class="icon-prepend fa fa-search"></i>
                            <input type="text" name="q" value="<?php echo $q; ?>" id="ssch_q" size="40" maxlength="30" placeholder="검색어">
                            <div class="button"><input type="submit" value="검색">검색</div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="content-box-footer">
                <div class="text-left font-size-12">
                    * 상세검색을 선택하지 않거나, 상품가격을 입력하지 않으면 전체에서 검색합니다.<br>
                    * 검색어는 최대 30글자까지, 여러개의 검색어를 공백으로 구분하여 입력 할수 있습니다.
                </div>
            </div>
        </div>
        </form>
    </div>
    <?php /* 상세검색 항목 끝 */ ?>

    <?php /* 검색된 분류 시작 */ ?>
    <div class="search-cate">
        <ul>
            <?php if ($sca_count > 0) { ?>
            <?php for ($i=0; $i<$sca_count; $i++) { ?>
            <li><a href="#" onclick="set_ca_id('<?php echo $sca_list[$i]['ca_id']; ?>'); return false;"><?php echo $sca_list[$i]['ca_name']; ?> (<?php echo $sca_list[$i]['cnt']; ?>)</a></li>
            <?php } ?>
            <?php } ?>
            <li><a href="#" onclick="set_ca_id(''); return false;">전체분류 <span>(<?php echo $sca_total_cnt; ?>)</span></a></li>
        </ul>
    </div>
    <?php /* 검색된 분류 끝 */ ?>

    <div class="position-relative">
        <?php /* 검색 정렬 선택 시작 */ ?>
        <a name="scl"></a>
        <div class="tab-scroll-category">
            <div class="scrollbar">
                <div class="handle">
                    <div class="mousearea"></div>
                </div>
            </div>
            <div id="tab-category">
                <div class="category-list">
                    <span <?php if ($_GET['qsort'] == 'it_sum_qty' && $_GET['qorder'] == 'desc') { ?>class="active"<?php } ?>>
                        <a href="#scl" onclick="set_sort('it_sum_qty', 'desc'); return false;">판매많은순</a>
                    </span>
                    <span <?php if ($_GET['qsort'] == 'it_price' && $_GET['qorder'] == 'asc') { ?>class="active"<?php } ?>>
                        <a href="#scl" onclick="set_sort('it_price', 'asc'); return false;">낮은가격순</a>
                    </span>
                    <span <?php if ($_GET['qsort'] == 'it_price' && $_GET['qorder'] == 'desc') { ?>class="active"<?php } ?>>
                        <a href="#scl" onclick="set_sort('it_price', 'desc'); return false;">높은가격순</a>
                    </span>
                    <span <?php if ($_GET['qsort'] == 'it_use_avg' && $_GET['qorder'] == 'desc') { ?>class="active"<?php } ?>>
                        <a href="#scl" onclick="set_sort('it_use_avg', 'desc'); return false;">평점높은순</a>
                    </span>
                    <span <?php if ($_GET['qsort'] == 'it_use_cnt' && $_GET['qorder'] == 'desc') { ?>class="active"<?php } ?>>
                        <a href="#scl" onclick="set_sort('it_use_cnt', 'desc'); return false;">후기많은순</a>
                    </span>
                    <span <?php if ($_GET['qsort'] == 'it_update_time' && $_GET['qorder'] == 'desc') { ?>class="active"<?php } ?>>
                        <a href="#scl" onclick="set_sort('it_update_time', 'desc'); return false;">최근등록순</a>
                    </span>
                    <span class="fake-span"></span>
                </div>
                <div class="controls">
                    <button class="btn prev"><i class="fas fa-caret-left"></i></button>
                    <button class="btn next"><i class="fas fa-caret-right"></i></button>
                </div>
            </div>
            <div class="tab-category-divider"></div>
        </div>
        <?php /* 검색 정렬 선택 끝 */ ?>

        <ul id="sct_lst">
            <li><button type="button" class="product-type-btn product-type-list-btn" title="리스트뷰"><i class="fas fa-th-list" aria-hidden="true"></i><span class="sound_only">리스트뷰</span></button></li>
            <li><button type="button" class="product-type-btn product-type-gallery-btn" title="갤러리뷰"><i class="fas fa-th-large" aria-hidden="true"></i><span class="sound_only">갤러리뷰</span></button></li>
            <div class="clearfix"></div>
        </ul>
        <div class="clearfix"></div>
    </div>

    <?php /* 검색결과 시작 */ ?>
    <div>
        <?php /* 리스트 유형별로 출력 */ ?>
        <?php echo $ssch_list; ?>

        <?php /* 페이지 */ ?>
        <?php echo eb_paging($eyoom['paging_skin']);?>
    </div>
    <?php /* 검색결과 끝 */ ?>
</div>
<?php /* ---------- 쇼핑몰 검색 끝 ---------- */ ?>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/fakeLoader/fakeLoader.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sly/vendor_plugins.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sly/sly.min.js"></script>
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

$(function() {
    var $frame = $('#tab-category');
    var $wrap  = $frame.parent();
    $frame.sly({
        horizontal: 1,
        itemNav: 'centered',
        smart: 1,
        activateOn: 'click',
        mouseDragging: 1,
        touchDragging: 1,
        releaseSwing: 1,
        scrollBar: $wrap.find('.scrollbar'),
        scrollBy: 1,
        startAt: $frame.find('.active'),
        speed: 300,
        elasticBounds: 1,
        easing: 'easeOutExpo',
        dragHandle: 1,
        dynamicHandle: 1,
        clickBar: 1,
        prev: $wrap.find('.prev'),
        next: $wrap.find('.next')
    });
    var tabWidth = $('#tab-category').width();
    var categoryWidth = $('.category-list').width();
    if (tabWidth < categoryWidth) {
        $('.controls').show();
    }
});

function set_sort(qsort, qorder) {
    var f = document.frmdetailsearch;
    f.qsort.value = qsort;
    f.qorder.value = qorder;
    f.submit();
}

function set_ca_id(qcaid) {
    var f = document.frmdetailsearch;
    f.qcaid.value = qcaid;
    f.submit();
}

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