<?php
/**
 * skin file : /theme/THEME_NAME/skin/qa/basic/list.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sly/tab_scroll_category.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert/sweetalert.min.css" type="text/css" media="screen">',0);
?>

<style>
.qa-list .eyoom-form .checkbox i {top:2px}
.qa-list .table-list-eb .table thead > tr > th {border-bottom:1px solid #959595;text-align:center;padding:10px 5px}
.qa-list .table-list-eb .table tbody > tr > td {border-top:1px solid #ededed;padding:7px 5px}
.qa-list .table-list-eb thead {border-top:2px solid #757575;border-bottom:1px solid #959595}
.qa-list .table-list-eb th {color:#000;font-weight:bold;white-space:nowrap;font-size:13px}
.qa-list .table-list-eb .txt_done {color:#b5b5b5}
.qa-list .table-list-eb .txt_rdy {color:#FF4848}
.qa-list .table-list-eb .td-subject {width:300px}
.qa-list .table-list-eb .table tbody > tr.td-mobile > td {border-top:1px solid #fff;padding:0 0 5px !important;font-size:11px;color:#959595}
.qa-list .table-list-eb .td-mobile td {position:relative}
.qa-list .table-list-eb .td-mobile td > span {margin-right:5px}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width: 1199px) {
    .qa-list .table-list-eb .td-subject {width:240px}
}
@media (max-width: 767px) {
    .qa-list .table-list-eb .table tbody > tr > td.td-subj-wrap {padding:10px 0}
    .qa-list .table-list-eb .td-subject {width:300px}
    .qa-list .table-list-eb .td-subject .subject {font-weight:bold}
}
<?php } ?>
</style>

<form name="fqalist" id="fqalist" action="<?php echo G5_BBS_URL; ?>/qadelete.php" onsubmit="return fqalist_submit(this);" method="post" class="eyoom-form">
<input type="hidden" name="stx" value="<?php echo $stx; ?>">
<input type="hidden" name="sca" value="<?php echo $sca; ?>">
<input type="hidden" name="page" value="<?php echo $page; ?>">
<input type="hidden" name="token" value="<?php echo get_text($token); ?>">

<div class="qa-list">
    <?php /* 게시판 페이지 정보 및 버튼 시작 */ ?>
    <div class="board-info margin-bottom-20">
        <div class="pull-left margin-top-5 font-size-12 color-grey">
            <u>전체 <?php echo number_format($total_count); ?> 건 - <?php echo $page; ?> 페이지</u>
        </div>
        <?php if ($admin_href || $write_href) { ?>
        <div class="pull-right">
            <?php if ($admin_href) { ?>
            <a href="<?php echo $admin_href; ?>" class="btn-e btn-e-dark" type="button">관리자</a>
            <?php } ?>
            <?php if ($write_href) { ?>
            <a href="<?php echo $write_href; ?>" class="btn-e btn-e-red" type="button">문의등록</a>
            <?php } ?>
        </div>
        <?php } ?>
        <div class="clearfix"></div>
    </div>
    <?php /* 게시판 페이지 정보 및 버튼 끝 */ ?>

    <?php /* 게시판 카테고리 시작 */ ?>
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
                <?php for ($i=0; $i<count((array)$category_tab); $i++) { ?>
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

    <div class="table-list-eb margin-bottom-20">
        <div class="qa-list-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="hidden-xs">번호</th>
                        <?php if ($is_checkbox) { ?>
                        <th>
                            <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
                            <label class="checkbox">
                                <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);"><i></i>
                            </label>
                        </th>
                        <?php } ?>
                        <th>제목</th>
                        <th class="hidden-xs">글쓴이</th>
                        <th class="hidden-xs">상태</th>
                        <th class="hidden-xs">등록일</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <td class="text-center hidden-xs"><?php echo $list[$i]['num']; ?></td>
                        <?php if ($is_checkbox) { ?>
                        <td>
                            <label for="chk_qa_id_<?php echo $i; ?>" class="sound_only"><?php echo $list[$i]['subject']; ?></label>
                            <label class="checkbox">
                                <input type="checkbox" name="chk_qa_id[]" value="<?php echo $list[$i]['qa_id']; ?>" id="chk_qa_id_<?php echo $i; ?>"><i></i>
                            </label>
                        </td>
                        <?php } ?>
                        <td class="td-subj-wrap">
                            <div class="td-subject ellipsis">
                                <span class="color-grey">[<?php echo $list[$i]['category']; ?>]</span>
                                <a href="<?php echo $list[$i]['view_href']; ?>">
                                    <span class="subject"><?php echo $list[$i]['subject']; ?></span>
                                </a>
                                <?php if ($list[$i]['icon_file']) { ?>
                                <i class="far fa-save margin-left-5 color-grey"></i>
                                <?php } ?>
                            </div>
                        </td>
                        <td class="hidden-xs"><?php echo $list[$i]['name']; ?></td>
                        <td class="<?php if ($list[$i]['qa_status']) { ?>txt_done<?php } else { ?>txt_rdy<?php } ?> text-center hidden-xs"><?php if ($list[$i]['qa_status']) { ?>답변완료<?php } else { ?>답변대기<?php } ?></td>
                        <td class="text-center hidden-xs"><?php echo $list[$i]['date']; ?></td>
                    </tr>
                    <tr class="td-mobile visible-xs"><?php /* 767px 이하에서만 보임 */ ?>
                        <td colspan="<?php echo $colspan; ?>">
                            <span class="<?php if ($list[$i]['qa_status']) { ?>txt_done<?php } else { ?>txt_rdy<?php } ?>"><?php if ($list[$i]['qa_status']) { ?>답변완료<?php } else { ?>답변대기<?php } ?></span>
                            <span><i class="fas fa-user"></i> <?php echo $list[$i]['name']; ?></span>
                            <span><i class="far fa-clock"></i> <?php echo $list[$i]['date']; ?></span>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if (count((array)$list) == 0) { ?>
                    <tr><td colspan="<?php echo $colspan; ?>" class="text-center"><span class="color-grey"><i class="fas fa-exclamation-circle"></i> 게시물이 없습니다.</span></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="pull-left">
        <?php if ($is_checkbox) { ?>
        <input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value" class="btn-e btn-e-default">
        <?php } ?>
    </div>
    <div class="pull-right">
        <?php if ($write_href) { ?>
        <a href="<?php echo $write_href; ?>" class="btn-e btn-e-red">문의등록</a>
        <?php } ?>
    </div>
    <div class="clearfix"></div>
</div>
</form>

<?php if ($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>

<?php /* 검색 시작 */ ?>
<div class="row margin-top-30">
    <div class="col-sm-4 col-sm-offset-4">
        <form name="fsearch" method="get" class="eyoom-form">
        <input type="hidden" name="sca" value="<?php echo $sca; ?>">
        <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
        <div class="input input-button">
            <input type="text" name="stx" value="<?php echo stripslashes($stx); ?>" required id="stx" size="15" maxlength="15" placeholder="1:1문의 검색">
            <div class="button"><input type="submit" value="검색">검색</div>
        </div>
        </form>
    </div>
</div>
<?php /* 검색 끝 */ ?>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sly/vendor_plugins.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sly/sly.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert/sweetalert.min.js"></script>
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
        prev: $wrap.find('.prev'),
        next: $wrap.find('.next')
    });
    var tabWidth = $('#tab-category').width();
    var categoryWidth = $('.category-list').width();
    if (tabWidth < categoryWidth) {
        $('.controls').show();
    }
});
</script>

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
        swal({
            html: true,
            title: "중요!",
            text: "<strong class='color-red'>" + document.pressed + "</strong> 할 게시물을 하나 이상 선택하세요.",
            confirmButtonColor: "#FF4848",
            type: "error",
            confirmButtonText: "확인"
        });
        return false;
    }

    swal({
        title: "선택삭제",
        text: "선택한 게시물을 정말 삭제하시겠습니까?\n한번 삭제한 자료는 복구할 수 없습니다",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#FDAB29",
        confirmButtonText: "삭제",
        cancelButtonText: "취소",
        closeOnConfirm: true,
        closeOnCancel: true
    },
    function(){
        f.submit();
        return true;
    });
    return false;
}
</script>
<?php } ?>