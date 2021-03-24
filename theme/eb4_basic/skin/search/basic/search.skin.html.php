<?php
/**
 * skin file : /theme/THEME_NAME/skin/search/basic/search.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/scroll-tabs/scrolltabs.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert/sweetalert.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/magnific-popup/magnific-popup.min.css" type="text/css" media="screen">',0);
?>

<style>
.search-result .search-box {position:relative;padding:15px;margin-bottom:30px;border:1px solid #e5e5e5;background:#fff;border-radius:3px !important}
.search-result .search-box .search-input input {height:42px;background:#f8f8f8;font-size:13px;font-weight:bold;border-radius:3px !important}
.search-result .search-box .search-input .icon-prepend {background-color:transparent;width:42px;height:40px;line-height:40px;border:0;color:#959595;font-size:14px}
.search-result .search-box .input-button .button {height:40px;line-height:40px;background:#fff;padding:0 30px;font-size:13px;border-radius:0 3px 3px 0 !important}
.search-result .search-tab {background-color:#D6D6D6;height:40px;border-radius:3px !important}
.search-result .search-tab #tab-search-result {display:none}
.search-result .search-tab .scroll_tabs_container {text-align:center;margin-bottom:0}
.search-result .search-tab .scroll_tabs_container div.scroll_tab_inner li {padding-left:10px;padding-right:10px}
.search-result .search-tab .scroll_tabs_container div.scroll_tab_inner li.active a {font-weight:bold}
.search-result .search-tab .scroll_tabs_container div.scroll_tab_inner span {padding-left:2px;padding-right:0}
.search-result-list .result-list > li {padding:10px 0;border-bottom:1px dotted #e5e5e5}
.search-result-list .result-list > li:hover {background:#fbfbfb}
.search-result-list .result-list > li:first-child {border-top:1px dotted #e5e5e5}
.search-result-list .result-list > li h6 {font-size:14px}
.search-result-list .result-list > li h6 a {color:#1E88E5}
.search-result-list .result-list > li h6 a:hover {color:#0068c1;text-decoration:underline}
.search-result-list .result-list > li h6 i {color:#959595}
.search-result-list .result-list .result-list-box {position:relative}
.search-result-list .result-list .result-list-image {position:absolute;overflow:hidden;top:0;left:0;width:100px;height:58px}
.search-result-list .result-list .result-list-text {position:relative;overflow:hidden;height:58px;margin-bottom:10px}
.search-result-list .result-list .result-list-text.result-list-text-margin {margin-left:115px}
.search-result-list .result-list .search-result-image img {display:block;width:100% \9;max-width:100%;height:auto}
.search-result-list .result-list .result-list-info {font-size:12px;color:#959595;margin-bottom:0}
.search-result-list .result-list .result-list-info .info-photo img {width:17px;height:17px;margin-right:2px;display:inline-block}
.search-result-list .result-list .result-list-info .info-icon {width:17px;height:17px;line-height:17px;font-size:11px;text-align:center;background:#858585;color:#fff;margin-right:2px;display:inline-block}
.search-result-list .result-list .result-list-info .info-name {font-size:12px;color:#353535}
.search-result-list .result-list .result-list-info .info-name:hover a {color:#000}
.search-result-list .result-list .result-list-info .info-name .open a {color:#000}
.search-result-list .sch_word {color:#0068c1;font-weight:bold}
</style>

<div class="search-result">
    <form name="fsearch" onsubmit="return fsearch_submit(this);" method="get" class="eyoom-form">
    <input type="hidden" name="srows" value="<?php echo $srows; ?>">
    <div class="search-box">
        <div class="row">
            <section class="col col-3">
                <label class="select">
                    <select name="gr_id" id="gr_id" class="form-control">
                        <option value="">전체그룹</option>
                        <?php for ($i=0; $i<count((array)$sel_group); $i++) { ?>
                        <option value='<?php echo $sel_group[$i]['gr_id']; ?>'><?php echo $sel_group[$i]['gr_subject']; ?></option>
                        <?php } ?>
                    </select>
                    <i></i>
                </label>
            </section>
            <section class="col col-3">
                <label for="sfl" class="sound_only">검색조건</label>
                <label class="select">
                    <select name="sfl" id="sfl" class="form-control">
                        <option value="wr_subject||wr_content" <?php echo get_selected($_GET['sfl'], "wr_subject||wr_content"); ?>>제목+내용</option>
                        <option value="wr_subject" <?php echo get_selected($_GET['sfl'], "wr_subject"); ?>>제목</option>
                        <option value="wr_content" <?php echo get_selected($_GET['sfl'], "wr_content"); ?>>내용</option>
                        <option value="mb_id" <?php echo get_selected($_GET['sfl'], "mb_id"); ?>>회원아이디</option>
                        <option value="wr_name" <?php echo get_selected($_GET['sfl'], "wr_name"); ?>>이름</option>
                    </select>
                    <i></i>
                </label>
            </section>
            <section class="col col-3 inline-group">
                <label for="sop_or" class="radio"><input type="radio" value="or" <?php if ($sop == 'or') { ?>checked<?php } ?> id="sop_or" name="sop"><i class="rounded-x"></i>OR</label>
                <label for="sop_and" class="radio"><input type="radio" value="and" <?php if ($sop == 'and') { ?>checked<?php } ?> id="sop_and" name="sop"><i class="rounded-x"></i>AND</label>
            </section>
            <div class="clearfix"></div>
            <section class="col col-12 margin-bottom-0">
                <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                <div class="input input-button search-input">
                    <i class="icon-prepend fas fa-search"></i>
                    <input type="text" name="stx" value="<?php echo $text_stx; ?>" id="stx" required maxlength="20">
                    <div class="button"><input type="submit" value="검색">검색</div>
                </div>
            </section>
        </div>
    </div>
    </form>
    <div class="margin-bottom-10"></div>

    <?php if ($stx) { ?>
        <?php if ($board_count) { ?>
    <div class="cont-text-bg margin-bottom-30">
        <h6><strong><?php echo $stx; ?></strong> 전체검색 결과</h6>
        <p class="bg-primary font-size-12">
            게시판 -<strong> <?php echo $board_count; ?></strong> 개
            <span class="margin-left-5 margin-right-5">/</span>
            게시물 -<strong> <?php echo number_format($total_count); ?></strong> 개
            <span class="pull-right"><?php echo number_format($page); ?> / <?php echo number_format($total_page); ?> 페이지 열람 중</span>
        </p>
    </div>
        <?php } ?>
    <?php } ?>

    <?php if ($stx) { ?>
        <?php if ($board_count) { //#2 ?>
    <div class="search-tab">
        <ul id="tab-search-result">
            <li class="active"><a href="?<?php echo $search_query; ?>&amp;gr_id=<?php echo $gr_id; ?>" <?php echo $sch_all; ?>>전체게시판</a></li>
            <?php echo $str_board_list; ?>
        </ul>
    </div>
        <?php } else { ?>
    <div class="text-center color-grey font-size-14 margin-top-30"><i class="fas fa-exclamation-circle"></i> 검색된 자료가 없습니다.</div>
        <?php } ?>
    <?php } ?>
    <div class="margin-bottom-30"></div>

    <?php if ($stx && $board_count) { ?><section class="search-result-list"><?php } ?>
    <?php for ($idx=$table_index, $k=0; $idx<count((array)$search_table) && $k<$rows; $idx++) { ?>
        <h5>
            <a href="<?php echo get_eyoom_pretty_url($search_table[$idx], '', $search_query); ?>">
                <strong><i class="fas fa-search"></i> '<u><?php echo $bo_subject[$idx] ?></u>' 게시판 내 결과</strong>
            </a>
        </h5>
        <ul class="list-unstyled result-list">
        <?php
        for ($i=0; $i<count((array)$list[$idx]) && $k<$rows; $i++, $k++) {
            if ($list[$idx][$i]['wr_is_comment']) {
                $comment_def = '<span class="cmt_def">댓글 | </span>';
                $comment_href = '#c_'.$list[$idx][$i]['wr_id'];
            } else {
                $comment_def = '';
                $comment_href = '';
            }

            $level = $list[$idx][$i]['eb_1'] ? $eb->level_info($list[$idx][$i]['eb_1']):'';
            if (is_array($level) && $level['anonymous']) {
                $data['mb_id'] = 'anonymous';
                $data['name'] = '익명';
            } else {
                $data['mb_photo'] = $eb->mb_photo($list[$idx][$i]['mb_id']);
                $data['name'] = eb_nameview($list[$idx][$i]['mb_id'], $list[$idx][$i]['wr_name'], $list[$idx][$i]['wr_email'], $list[$idx][$i]['homepage']);
            }

            /**
             * 이미지 사용일 경우
             */
            if ($eyoom['use_search_image'] == 'y') {
                unset($data['img_content'], $data['img_src']);
                $thumb = get_list_thumbnail($search_table[$idx], $list[$idx][$i]['wr_id'],$eyoom['search_image_width'], $eyoom['search_image_height']);
                if ($tpl_name == 'bs') {
                    if ($thumb['src']) {
                        $data['img_content'] = '<img class="img-responsive" src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
                        $data['img_src'] = $thumb['src'];
                    }
                } else {
                    if ($thumb['src']) {
                        $data['img_content'] = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$board['bo_gallery_width'].'" height="'.$board['bo_gallery_height'].'">';
                        $data['img_src'] = $thumb['src'];
                    }
                }
            }
        ?>
            <li>
                <h6>
                    <a href="<?php echo $list[$idx][$i]['href'] ?><?php echo $comment_href ?>" class="font-size-14"><?php echo $comment_href ?><?php echo $list[$idx][$i]['subject'] ?></a>
                    <a href="<?php echo $list[$idx][$i]['href'] ?><?php echo $comment_href ?>" target="_blank" class="font-size-12 pull-right tooltips" data-placement="left" data-toggle="tooltip" data-original-title="새창"><i class="fas fa-external-link-alt"></i></a>
                </h6>
                <div class="result-list-box">
                    <?php if ($data['img_content']) { ?>
                    <div class="result-list-image">
                        <a class="search-result-image" href="<?php echo $data['img_src']; ?>">
                            <?php echo $data['img_content']; ?>
                        </a>
                    </div>
                    <?php } ?>
                    <div class="result-list-text <?php if ($data['img_content']) { ?>result-list-text-margin<?php } ?>">
                        <p class="color-grey font-size-12 margin-bottom-0"><?php echo $list[$idx][$i]['content'] ?></p>
                    </div>
                </div>
                <div class="result-list-info">
                    <?php if($data['mb_photo']) { ?>
                    <span class="info-photo"><?php echo $data['mb_photo'] ?></span>
                    <?php } else { ?>
                    <span class="info-icon"><i class="fas fa-user"></i></span>
                    <?php } ?>
                    <span class="info-name"><?php echo $data['name'] ?></span>
                    <span class="info-date"><i class="far fa-clock margin-left-10 margin-right-5"></i><?php echo $list[$idx][$i]['wr_datetime'] ?></span>
                </div>
            </li>
        <?php } ?>
        </ul>
        <div class="text-right margin-top-5 margin-bottom-30"><a href="<?php echo get_eyoom_pretty_url($search_table[$idx], '', $search_query); ?>" class="btn-e btn-e-dark btn-e-xs">'<?php echo $bo_subject[$idx]; ?>' 결과 더보기</a></div>
    <?php } ?>
    <?php if ($stx && $board_count) { ?>
    </section>
    <?php } ?>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/scroll-tabs/jquery.mousewheel.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/scroll-tabs/jquery.scrolltabs.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/magnific-popup/magnific-popup.min.js"></script>
<script>
$(document).ready(function(){
    $('#tab-search-result').scrollTabs({
        scroll_distance: 150
    });
});

$(window).load(function(){
    $('#tab-search-result').show();
});

document.getElementById("gr_id").value = "<?php echo $gr_id; ?>";

function fsearch_submit(f) {
    if (f.stx.value.length < 2) {
        swal({
            title: "중요!",
            text: "검색어는 두글자 이상 입력하십시오.",
            confirmButtonColor: "#FF2900",
            type: "error",
            confirmButtonText: "확인"
        });
        f.stx.select();
        f.stx.focus();
        return false;
    }
    var cnt = 0;
    for (var i=0; i<f.stx.value.length; i++) {
        if (f.stx.value.charAt(i) == ' ')
            cnt++;
    }
    if (cnt > 1) {
        swal({
            title: "중요!",
            text: "빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.",
            confirmButtonColor: "#FF2900",
            type: "error",
            confirmButtonText: "확인"
        });
        f.stx.select();
        f.stx.focus();
        return false;
    }
    f.action = "";
    return true;
}

$(function() {
    $('.search-result-image').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-img-mobile',
        image: {
            verticalFit: true
        }
    });
});
</script>