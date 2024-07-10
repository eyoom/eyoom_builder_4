<?php
/**
 * skin file : /theme/THEME_NAME/skin/qa/basic/list.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sly/tab_scroll_category.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert2/sweetalert2.min.css" type="text/css" media="screen">',0);
?>

<style>
.qa-list {font-size:.9375rem}
.qa-list .ql-wrap {position:relative;border-top:2px solid #757575;border-bottom:1px solid #757575}
.qa-list .ql-wrap > div:nth-last-child(1), .qa-list .ql-wrap > div:nth-last-child(2) {border-bottom:0}
.qa-list .ql-head {position:relative;display:table;width:100%;height:50px;border-bottom:1px solid #757575;background-color:#f2f2f2;font-weight:500}
.qa-list .ql-head > div {position:relative}
.qa-list .ql-head > div:before {content:"";position:absolute;top:50%;right:0;width:1px;height:13px;background-color:#cacaca;transform:translateY(-50%)}
.qa-list .ql-head > div:last-child:before {display:none}
.qa-list .ql-head .ql-item {display:table-cell;vertical-align:middle;width:120px;text-align:center}
.qa-list .ql-head .ql-num {width:90px}
.qa-list .ql-head .ql-num-short {width:80px}
.qa-list .ql-head .ql-num-checkbox {width:110px}
.qa-list .ql-head .ql-author {width:150px;padding:0 10}
.qa-list .ql-head .ql-subj {display:table-cell;vertical-align:middle;text-align:center}
.qa-list .ql-list {position:relative;display:table;table-layout:fixed;;width:100%;height:46px;border-bottom:1px solid #eaeaea;padding:8px 0}
.qa-list .ql-list .checkbox i {top:5px}
.qa-list .ql-list.ql-notice {background-color:#FFF8EC}
.qa-list .ql-list > div {position:relative}
.qa-list .ql-list > div:before {content:"";position:absolute;top:50%;right:0;width:1px;height:13px;background-color:#dadada;transform:translateY(-50%)}
.qa-list .ql-list > div:last-child:before {display:none}
.qa-list .ql-list .ql-item {display:table-cell;vertical-align:middle;width:120px;text-align:center}
.qa-list .ql-list .ql-num {width:90px}
.qa-list .ql-list .ql-num-short {width:80px}
.qa-list .ql-list .ql-num-checkbox {width:110px}
.qa-list .ql-list .ql-author {width:150px;padding:0 10px;text-align:left}
.qa-list .ql-list .ql-subj {display:table-cell;vertical-align:middle;font-weight:500}
.qa-list .ql-list .ql-subj a {position:relative;display:inline-block;padding:0 10px}
.qa-list .ql-list .ql-subj a:hover {color:#000;text-decoration:underline}
.qa-list .ql-mobile {display:none}
.qa-list .ql-no-list {text-align:center;color:#959595;padding:70px 0}
.qa-list .qa-list-footer {margin-top:15px}
.qa-list .qa-list-footer:after {content:"";display:block;clear:both}
.qa-list .qa-list-footer .qlf-left {float:left;margin-top:5px}
.qa-list .qa-list-footer .qlf-right {float:right;margin-top:5px}
.qa-search-form {max-width:300px;margin:30px auto 0}
@media (max-width:991px) {
    .qa-list .ql-head {display:none}
    .qa-list .ql-head-checkbox {display:table}
    .qa-list .ql-head > div:before, .qa-list .ql-list > div:before, .qa-list .ql-head .ql-item, .qa-list .ql-list .ql-item {display:none}
    .qa-list .ql-head .ql-num-checkbox, .qa-list .ql-list .ql-num-checkbox {display:table-cell;width:20px}
    .qa-list .ql-head .ql-num-checkbox .ql-txt, .qa-list .ql-list .ql-num-checkbox .ql-txt {visibility:visible;opacity:0}
    .qa-list .ql-head .checkbox, .qa-list .ql-list .checkbox {z-index:1}
    .qa-list .ql-list {border-bottom:0}
    .qa-list .ql-list .ql-subj a {padding:0}
    .qa-list .ql-mobile {position:relative;display:block;border-bottom:1px solid #eaeaea;padding:0 0 8px;color:#959595}
    .qa-list .ql-mobile-right {position:absolute;top:0;right:0}
}
</style>
<?php if ($side_layout['use'] == 'yes') { ?>
<style>
@media (max-width:1199px) {
    .qa-list .ql-head {display:none}
    .qa-list .ql-head-checkbox {display:table}
    .qa-list .ql-head > div:before, .qa-list .ql-list > div:before, .qa-list .ql-head .ql-item, .qa-list .ql-list .ql-item {display:none}
    .qa-list .ql-head .ql-num-checkbox, .qa-list .ql-list .ql-num-checkbox {display:table-cell;width:20px}
    .qa-list .ql-head .ql-num-checkbox .ql-txt, .qa-list .ql-list .ql-num-checkbox .ql-txt {visibility:visible;opacity:0}
    .qa-list .ql-head .checkbox, .qa-list .ql-list .checkbox {z-index:1}
    .qa-list .ql-list {border-bottom:0}
    .qa-list .ql-list .ql-subj a {padding:0}
    .qa-list .ql-mobile {position:relative;display:block;border-bottom:1px solid #eaeaea;padding:0 0 8px;color:#959595}
    .qa-list .ql-mobile-right {position:absolute;top:0;right:0}
}
</style>
<?php } ?>

<div class="qa-list">
    <?php /* 게시판 페이지 정보 및 버튼 시작 */ ?>
    <div class="board-info m-b-20">
        <div class="float-start m-t-5 text-gray">
            <u>전체 <?php echo number_format($total_count); ?> 건 - <?php echo $page; ?> 페이지</u>
        </div>
        <?php if ($admin_href || $write_href) { ?>
        <div class="float-end">
            <?php if ($admin_href) { ?>
            <a href="<?php echo $admin_href; ?>" class="btn-e btn-e-lg btn-dark" type="button">관리자</a>
            <?php } ?>
            <?php if ($write_href) { ?>
            <a href="<?php echo $write_href; ?>" class="btn-e btn-e-lg btn-navy" type="button">문의등록</a>
            <?php } ?>
        </div>
        <?php } ?>
        <div class="clearfix"></div>
    </div>
    <?php /* 게시판 페이지 정보 및 버튼 끝 */ ?>

    <?php /* qa 카테고리 시작 */ ?>
    <?php if ($category_option) { ?>
    <div class="tab-scroll-category">
        <div class="scrollbar">
            <div class="handle">
                <div class="mousearea"></div>
            </div>
        </div>
        <div id="tab-category">
            <div class="category-list">
                <span <?php if ($sca == '') { ?>class="active"<?php } ?>><a href="<?php echo $category_href; ?>">전체분류</a></span>
                <?php for ($i=0; $i<count($category_tab); $i++) { ?>
                <span <?php if ($category_tab[$i]['category'] == $sca) { ?>class="active"<?php } ?>><a href="<?php echo $category_tab[$i]['href']; ?>"><?php echo $category_tab[$i]['category']; ?></a></span>
                <?php } ?>
                <span class="fake-span"></span>
            </div>
            <div class="controls">
                <button class="btn prev"><i class="fas fa-caret-left"></i></button>
                <button class="btn next"><i class="fas fa-caret-right"></i></button>
            </div>
        </div>
        <div class="tab-category-divider"></div>
    </div>
    <?php } ?>
    <?php /* 게시판 카테고리 끝 */ ?>

    <form name="fqalist" id="fqalist" action="<?php echo G5_BBS_URL; ?>/qadelete.php" onsubmit="return fqalist_submit(this);" method="post" class="eyoom-form">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="sca" value="<?php echo $sca; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="<?php echo get_text($token); ?>">

    <div class="ql-wrap">
        <div class="ql-head <?php if ($is_checkbox) { ?>ql-head-checkbox<?php } ?>">
            <div class="ql-item ql-num <?php if ($is_checkbox) { ?>ql-num-checkbox<?php } ?>">
                <?php if ($is_checkbox) { ?>
                <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
                <label class="checkbox">
                    <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);"><i></i>
                </label>
                <?php } ?>
                <span class="ql-txt">번호</span>
            </div>
            <div class="ql-subj">제목</div>
            <div class="ql-item ql-author">글쓴이</div>
            <div class="ql-item">상태</div>
            <div class="ql-item">등록일</div>
        </div>
        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        <div class="ql-list <?php if ($list[$i]['is_notice']) { ?>ql-notice<?php } ?>">
            <div class="ql-item ql-num <?php if ($is_checkbox) { ?>ql-num-checkbox<?php } ?>">
                <?php if ($is_checkbox) { ?>
                <label for="chk_qa_id_<?php echo $i; ?>" class="sound_only"><?php echo $list[$i]['subject']; ?></label>
                <label class="checkbox">
                    <input type="checkbox" name="chk_qa_id[]" value="<?php echo $list[$i]['qa_id']; ?>" id="chk_qa_id_<?php echo $i; ?>"><i></i>
                </label>
                <?php } ?>
                <span class="ql-txt"><?php echo number_format($list[$i]['num']); ?></span>
            </div>
            <div class="ql-subj">
                <a href="<?php echo $list[$i]['view_href']; ?>">
                    <?php if ($category_option) { ?>
                    <span class="ql-cate text-gray m-r-5">[<?php echo $list[$i]['category']; ?>]</span>
                    <?php } ?>
                    <span class="subj"><?php echo $list[$i]['subject']; ?></span>
                    <?php if ($list[$i]['icon_file']) { ?>
                    <i class="far fa-save m-l-5 text-teal"></i>
                    <?php } ?>
                </a>
            </div>
            <div class="ql-item ql-author">
                <span class="ql-name-in">
                    <?php if ($is_admin == 'super') { ?>
                    <?php echo eb_nameview($list[$i]['mb_id'], $list[$i]['qa_name'], $list[$i]['qa_email'], $list[$i]['wr_homepage']); ?>
                    <?php } else { ?>
                    <?php echo $list[$i]['name']; ?>
                    <?php } ?>
                </span>
            </div>
            <div class="ql-item">
                <span class="<?php if ($list[$i]['qa_status']) { ?>text-teal<?php } else { ?>text-crimson<?php } ?> text-center hidden-xs"><?php if ($list[$i]['qa_status']) { ?>답변완료<?php } else { ?>답변대기<?php } ?></span>
            </div>
            <div class="ql-item text-gray">
                <?php echo $list[$i]['date']; ?>
            </div>
        </div>
        <div class="ql-mobile"><?php /* 991px 이하에서만 보임 */ ?>
            <span class="ql-name-in">
                <?php if ($is_admin == 'super') { ?>
                <?php echo eb_nameview($list[$i]['mb_id'], $list[$i]['qa_name'], $list[$i]['qa_email'], $list[$i]['wr_homepage']); ?>
                <?php } else { ?>
                <i class="far fa-user-circle"></i> <?php echo $list[$i]['name']; ?>
                <?php } ?>
            </span>
            <div class="ql-mobile-right">
                <span class="<?php if ($list[$i]['qa_status']) { ?>text-teal<?php } else { ?>text-crimson<?php } ?>"><?php if ($list[$i]['qa_status']) { ?>답변완료<?php } else { ?>답변대기<?php } ?></span>
                <span class="m-l-5"><i class="far fa-clock"></i> <?php echo $list[$i]['date']; ?></span>
            </div>
        </div>
        <?php } ?>
        <?php if (count((array)$list) == 0) { ?>
        <div class="ql-no-list">
            <i class="fas fa-exclamation-circle"></i> 게시물이 없습니다.
        </div>
        <?php } ?>
    </div>
    <div class="qa-list-footer">
        <div class="qlf-left">
            <?php if ($is_checkbox) { ?>
                <button class="btn-e btn-e-sm btn-gray" type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value">선택삭제</button>
            <?php } ?>
        </div>
        <div class="qlf-right">
            <?php if ($write_href) { ?>
            <a href="<?php echo $write_href; ?>" class="btn-e btn-e-sm btn-navy" type="button">문의등록</a>
            <?php } ?>
        </div>
    </div>

    </form>
</div>

<?php if ($is_checkbox) { ?>
<noscript>
<p class="text-gray f-s-12r m-t-20"><i class="fas fa-exclamation-circle"></i> 자바스크립트를 사용하지 않는 경우 별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>

<?php /* 게시판 검색 시작 */ ?>
<div class="qa-search-form">
    <form name="fsearch" method="get" class="eyoom-form">
    <input type="hidden" name="sca" value="<?php echo $sca; ?>">
    <input type="hidden" name="sop" value="and">
    <label for="sfl" class="sound_only">검색대상</label>
    <label for="sfl" class="select">
        <select name="sfl" id="sfl">
            <?php echo get_qa_sfl_select_options($sfl); ?>
        </select><i></i>
    </label>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <div class="input input-button">
        <input type="text" name="stx" value="<?php echo stripslashes($stx); ?>" required id="stx" size="15" maxlength="15" placeholder="1:1문의 검색">
        <div class="button"><input type="submit" value="검색">검색</div>
    </div>
    </form>
</div>
<?php /* 게시판 검색 끝 */ ?>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<?php if ($category_option) { ?>
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

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fqalist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_qa_id[]")
            f.elements[i].checked = sw;
    }
}

function fqalist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_qa_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        Swal.fire({
            title: '중요!',
            html: "<strong class='text-crimson'>" + document.pressed + "</strong> 할 게시물을 하나 이상 선택하세요.",
            icon: 'error',
            confirmButtonColor: '#e53935',
            confirmButtonText: '확인'
        });
        return false;
    }

    Swal.fire({
        title: "선택삭제",
        html: "선택한 게시물을 정말 삭제하시겠습니까?<br>한번 삭제한 자료는 복구할 수 없습니다.",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#e53935",
        confirmButtonText: "삭제",
        cancelButtonText: "취소"
    }).then((result) => {
        if (result.isConfirmed) {
            f.submit();
            return true;
        }
    });
    return false;
}
</script>
<?php } ?>