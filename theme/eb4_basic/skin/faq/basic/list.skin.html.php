<?php
/**
 * skin file : /theme/THEME_NAME/skin/faq/basic/list.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sly/tab_scroll_category.css" type="text/css" media="screen">',0);
?>

<style>
.faq-wrap img {max-width:100%;height:auto}
.faq-img {text-align:center;margin-bottom:30px}
.faq-html {position:relative;border:1px solid #c5c5c5;background:#f8f8f8;padding:15px;margin-bottom:30px}
.faq-search-form {max-width:300px;margin:30px auto 0}
</style>

<div class="faq-wrap">
    <?php if ($admin_href) { ?>
    <div class="text-end m-b-10">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=faqmasterform&amp;w=u&amp;fm_id=<?php echo $fm_id; ?>" class="btn-e btn-e-crimson">FAQ 수정</a>
    </div>
    <?php } ?>

    <?php if ($himg_src) { ?>
    <div id="faq_himg" class="faq-img"><img src="<?php echo $himg_src; ?>" class="img-fluid"></div>
    <?php } ?>
    <?php if ($fm['fm_head_html']) { ?>
    <div id="faq_hhtml" class="faq-html"><?php echo stripslashes($fm['fm_head_html']); ?></div>
    <?php } ?>

    <?php if (count((array)$faq_master) > 0) { ?>
    <div class="tab-scroll-category">
        <div class="scrollbar">
            <div class="handle">
                <div class="mousearea"></div>
            </div>
        </div>
        <div id="tab-category">
            <div class="category-list">
                <?php for ($i=0; $i<count((array)$faq_master); $i++) { ?>
                <span <?php echo $faq_master[$i]['fm_id'] == $fm_id ? 'class="active"': ''; ?>><a href="<?php echo $faq_master[$i]['category_href']; ?>?fm_id=<?php echo $faq_master[$i]['fm_id']; ?>" <?php echo $faq_master[$i]['category_option']; ?>><?php echo $faq_master[$i]['fm_subject']; ?></a></span>
                <?php } ?>
                <span class="fake-span"></span>
            </div>
            <div class="controls">
                <button class="btn prev"><i class="fa fa-caret-left"></i></button>
                <button class="btn next"><i class="fa fa-caret-right"></i></button>
            </div>
        </div>
        <div class="tab-category-divider"></div>
    </div>
    <?php } ?>

    <div class="faq-<?php echo $fm_id; ?>">
        <?php if (count((array)$faq_list) > 0) { ?>
        <div class="panel-group accordion-default panel-group-control panel-group-control-right" id="accordion-faq">
            <?php for ($i=0; $i<count((array)$faq_list); $i++) { ?>
            <div class="panel">
                <div class="panel-heading">
                    <h6 class="panel-title">
                        <a data-bs-toggle="collapse" href="#collapse-faq-<?php echo $i+1; ?>" class="collapsed">
                            <?php echo conv_content($faq_list[$i]['fa_subject'], 1); ?>
                        </a>
                    </h6>
                </div>
                <div id="collapse-faq-<?php echo $i+1; ?>" class="panel-collapse collapse" data-bs-parent="#accordion-faq">
                    <div id="faq_con" class="panel-body">
                        <?php echo conv_content($faq_list[$i]['fa_content'], 1); ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php } else { ?>
            <?php if ($stx) { ?>
        <div class="text-center text-gray m-b-30"><i class="fas fa-exclamation-circle"></i> 검색된 게시물이 없습니다.</p>
            <?php } else { ?>
        <div class="text-center m-b-30">
        <i class="fas fa-exclamation-circle"></i> 등록된 FAQ가 없습니다.
            <?php if ($is_admin) { ?>
        <br>FAQ를 새로 등록하시려면 <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=faqmasterlist"><u>FAQ 관리</u></a> 메뉴를 이용하십시오.
            <?php } ?>
        </div>
            <?php } ?>
        <?php } ?>
    </div>

    <div class="m-b-30">
        <?php /* 페이지 */ ?>
        <?php echo eb_paging($eyoom['paging_skin']);?>
    </div>

    <?php if ($fm['fm_tail_html']) { ?>
    <div id="faq_thtml" class="faq-html"><?php stripslashes($fm['fm_tail_html']); ?></div>
    <?php } ?>
    <?php if ($timg_src) { ?>
    <div id="faq_timg" class="faq-img"><img src="<?php echo $timg_src; ?>" class="img-fluid"></div>
    <?php } ?>
    
    <div class="faq-search-form">
        <form name="faq_search_form" method="get" class="eyoom-form">
        <input type="hidden" name="fm_id" value="<?php echo $fm_id; ?>">
        <div class="input input-button">
            <input type="text" name="stx" value="<?php echo $stx; ?>" required id="stx" size="15" maxlength="15" placeholder="FAQ 검색">
            <div class="button"><input type="submit" value="검색">검색</div>
        </div>
        </form>
    </div>
</div>

<?php if (count((array)$faq_master_list)) { ?>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sly/vendor_plugins.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sly/sly.min.js"></script>
<script>
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
        prevPage: $wrap.find('.prev'),
        nextPage: $wrap.find('.next')
    });
    var tabWidth = $('#tab-category').width();
    var categoryWidth = $('.category-list').width();
    if (tabWidth < categoryWidth) {
        $('.controls').show();
    }
});
</script>
<?php } ?>