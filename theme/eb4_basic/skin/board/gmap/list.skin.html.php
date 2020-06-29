<?php
/**
 * skin file : /theme/THEME_NAME/skin/board/gmap/list.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sly/tab_scroll_category.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert/sweetalert.min.css" type="text/css" media="screen">',0);
?>

<style>
.board-list .board-setup {position:relative;border:1px solid #d5d5d5;height:30px;margin-bottom:20px}
.board-list .board-setup .select {position:absolute;top:-1px;left:-1px;display:inline-block;width:200px}
.board-list .board-setup-btn-box {position:absolute;top:-1px;right:-1px;display:inline-block;width:420px}
.board-list .board-setup-btn {float:left;width:25%;height:30px;line-height:30px;color:#fff;text-align:center;font-size:12px}
.board-list .board-setup-btn:nth-child(odd) {background:#59595B}
.board-list .board-setup-btn:nth-child(even) {background:#676769}
.board-list .board-setup-btn:hover {opacity:0.8}
.board-list .bo_current {color:#FF4848}
.board-list .board-btn-adm li {float:left;margin-right:5px}
.board-list .board-list-footer {margin-top:20px}
.board-list .favorite-setup {display:inline-block;width:100px;margin-left:15px}
.board-list .favorite-setup .toggle {padding-right:37px}
.board-list .gmap-btn-wrap {position:relative;height:40px;margin-bottom:20px}
<?php /* 멀티타입 - 버튼 */ ?>
.gmap-type-btn-wrap {position:absolute;top:0;right:0;margin-bottom:0;z-index:1}
.gmap-type-btn-wrap li {position:relative;float:left}
.gmap-type-btn-wrap button {position:relative;margin:0;padding:0;width:40px;height:40px;border:1px solid #d5d5d5;cursor:pointer;background:#fff;font-size:15px;color:#454545}
.gmap-type-btn-wrap button:hover {background:#f5f5f5}
.gmap-type-btn-wrap button .gmap-type-on + i {color:#E52700}
.gmap-type-btn-wrap button.gmap-type-list-btn {border-right:0}
.gmap-type-btn-wrap button.gmap-type-webzine-btn {border-right:0}
.gmap-type-btn-wrap button.gmap-type-gallery-btn {border-right:0}
<?php /* 멀티타입 - 웹진형 */ ?>
.board-gmap .gmap-item {position:relative;font-size:12px;margin-bottom:10px;border-top:1px solid #e5e5e5;background:#fff;width:100%}
.board-gmap .gmap-item-in {position:relative;padding:20px 0;min-height:170px;box-sizing:border-box}
.board-gmap .gmap-item-in .gmap-img {position:absolute;top:20px;left:0;width:200px;z-index:1}
.board-gmap .gmap-item-in .gmap-desc {position:relative}
.board-gmap .gmap-item-in .gmap-noimg-desc {position:relative}
.board-gmap .gmap-item-in .gmap-img-box {position:relative;overflow:hidden;max-height:140px}
.board-gmap .gmap-item-in .gmap-img-box-in {position:relative;overflow:hidden;width:100%}
.board-gmap .gmap-item-in .gmap-img-box-in:after {content:"";text-align:center;position:absolute;display:block;left:0;top:0;opacity:0;-moz-transition:all 0.2s ease 0s;-webkit-transition:all 0.2s ease 0s;-ms-transition:all 0.2s ease 0s;-o-transition:all 0.2s ease 0s;transition:all 0.2s ease 0s;width:100%;height:100%;background:rgba(0,0,0,0.3)}
.board-gmap .gmap-item-in .gmap-img-box-in:before {content:"";display:block;padding-top:60%}
.board-gmap .gmap-item-in .gmap-img-box-in img {position:absolute;top:0;left:0;right:0;bottom:0}
.board-gmap .gmap-item-in .gmap-img-box-in .movie-icon {display:inline-block;position:absolute;top:50%;left:50%;width:40px;height:40px;line-height:40px;text-align:center;color:#fff;font-size:30px;margin-top:-20px;margin-left:-20px;z-index:1}
.board-gmap .gmap-item:hover .gmap-img-box-in:after {opacity:1}
.board-gmap .gmap-item-in .gmap-subj-cont {position:relative;overflow:hidden;margin-left:215px}
.board-gmap .gmap-item-in h4 {position:relative;font-size:15px;line-height:1.3;color:#000;margin-top:2px;margin-bottom:10px}
.board-gmap .gmap-item-in h4 .label {font-size:11px;color:#fff;font-weight:200;;margin:0 5px 0 0;min-width:50px;text-align:center;padding:3px 5px;vertical-align:middle;display:inline-block}
.board-gmap .gmap-item:hover .gmap-item-in h4 {text-decoration:underline}
.board-gmap .gmap-item-in .gmap-checkbox {display:inline-block;position:absolute;top:-5px;right:-11px;z-index:1}
.board-gmap .gmap-item-in .gmap-info-top {position:relative;border-top:1px solid #f2f2f2;padding-top:10px;margin-bottom:10px}
.board-gmap .gmap-item-in .gmap-info-top p {margin-bottom:5px;font-size:11px}
.board-gmap .gmap-item-in .gmap-info-top p:last-child {margin-bottom:0}
.board-gmap .gmap-item-in .gmap-info-top .info-divider {margin-left:5px;margin-right:5px;color:#d5d5d5}
.board-gmap .gmap-item-in .gmap-cont {position:relative;overflow:hidden;height:36px;font-weight:300;color:#757575;margin-bottom:10px}
.board-gmap .gmap-item-in .gmap-info {position:relative;border-top:1px solid #f2f2f2;padding-top:7px;margin-left:215px}
.board-gmap .gmap-item-in .gmap-photo {display:inline-block;width:26px;height:26px;margin-right:2px;border:1px solid #e5e5e5;padding:1px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.board-gmap .gmap-item-in .gmap-photo img {width:100%;height:auto;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.board-gmap .gmap-item-in .gmap-photo .gmap-user-icon {width:22px;height:22px;font-size:14px;line-height:22px;text-align:center;background:#959595;color:#fff;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;display:inline-block;white-space:nowrap;vertical-align:baseline;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.board-gmap .gmap-item-in .gmap-nick {margin-right:5px}
.board-gmap .gmap-item-in .gmap-lv-icon {display:inline-block;margin-left:2px}
.board-gmap .gmap-item-in .gmap-info > span {color:#959595;font-size:12px}
.board-gmap .gmap-item-in .gmap-info > span > i {margin-right:5px}
.board-gmap .gmap-item-in .gmap-info > span > strong {font-weight:normal;margin-right:10px}
.board-gmap .gmap-item-in .gmap-noimg-desc .gmap-desc-ymd {left:0}
.board-gmap .gmap-item-in .gmap-noimg-desc .gmap-subj-cont {margin-left:0}
.board-gmap .gmap-item-in .gmap-noimg-desc .gmap-info {margin-left:0}
.board-gmap .gmap-ratings .star-ratings-list {position:absolute;top:10px;right:0;width:60px;height:18px;background:#fff}
.board-gmap .gmap-ratings .star-ratings-list li {padding:0;float:left;margin-right:0}
.board-gmap .gmap-ratings .star-ratings-list li .rating {color:#a5a5a5;font-size:10px;line-height:normal}
.board-gmap .gmap-ratings .star-ratings-list li .rating-selected {color:#FF4848;font-size:10px}
.board-gmap .gmap-item-notice {position:relative;overflow:hidden;border:1px solid #e5e5e5;background:#fff;padding:8px 10px;margin-bottom:30px;-webkit-border-radius:2px !important;-moz-border-radius:2px !important;border-radius:2px !important}
<?php /* 멀티타입 - 리스트형 */ ?>
.board-gmap .gmap-type-list .gmap-item-in {padding:15px 0;min-height:80px}
.board-gmap .gmap-type-list .gmap-item-in .gmap-img {display:none}
.board-gmap .gmap-type-list .gmap-item-in .gmap-subj-cont {margin-left:0}
.board-gmap .gmap-type-list .gmap-item-in h4 {font-size:14px}
.board-gmap .gmap-type-list .gmap-item-in .gmap-subj-cont .gmap-cont {display:none}
.board-gmap .gmap-type-list .gmap-item-in .gmap-info {margin-left:0}
<?php /* 멀티타입 - 갤러리형 */ ?>
.board-gmap .gmap-type-gallery {margin-left:-5px;margin-right:-5px}
.board-gmap .gmap-type-gallery:after {content:"";display:block;clear:both}
.board-gmap .gmap-type-gallery .gmap-item {margin:0;border:0;padding:5px;background:#fff;width:50%;float:left;box-sizing:border-box}
.board-gmap .gmap-type-gallery .gmap-item-in {position:relative;border:1px solid #e5e5e5;padding:10px;min-height:inherit}
.board-gmap .gmap-type-gallery .gmap-item-in .gmap-img {position:relative;top:inherit;left:inherit;width:inherit;margin-bottom:15px}
.board-gmap .gmap-type-gallery .gmap-item-in .gmap-img-box {max-height:inherit}
.board-gmap .gmap-type-gallery .gmap-item-in .gmap-subj-cont {margin-left:0}
.board-gmap .gmap-type-gallery .gmap-item-in .gmap-info {margin-left:0}
.board-gmap .gmap-type-gallery .gmap-item-in .gmap-info-rating {min-height:43px}
.board-gmap .gmap-type-gallery .gmap-ratings .star-ratings-list {top:32px}
.board-gmap .gmap-type-gallery .gmap-noimg-desc .gmap-ratings .star-ratings-list {top:32px}
<?php /* 멀티타입 - 와이드형 */ ?>
.board-gmap .gmap-type-wide .gmap-item {margin:0;border:0;padding:10px 0;background:#fff;width:100%;float:left;box-sizing:border-box}
.board-gmap .gmap-type-wide .gmap-item-in {position:relative;border:1px solid #e5e5e5;padding:15px;min-height:inherit}
.board-gmap .gmap-type-wide .gmap-item-in .gmap-img {position:relative;top:inherit;left:inherit;width:inherit;margin-bottom:15px}
.board-gmap .gmap-type-wide .gmap-item-in .gmap-img-box {max-height:inherit}
.board-gmap .gmap-type-wide .gmap-item-in .gmap-subj-cont {margin-left:0}
.board-gmap .gmap-type-wide .gmap-item-in .gmap-info {margin-left:0}
.board-gmap .gmap-type-wide .gmap-item-in .gmap-info-rating {min-height:43px}
.board-gmap .gmap-type-wide .gmap-ratings .star-ratings-list {top:32px}
.board-gmap .gmap-type-wide .gmap-noimg-desc .gmap-ratings .star-ratings-list {top:32px}
<?php /* 멀티타입 - 공지영역 및 기타 */ ?>
.board-gmap .gmap-item-notice .label {font-size:11px;font-weight:normal;margin-bottom:0}
.board-list .view-infinite-more {margin-top:30px;margin-bottom:40px}
.board-list .view-infinite-more .btn-e-xlg {position:relative;height:40px;line-height:40px;padding:0 100px;font-size:16px !important;border:1px solid #b5b5b5;background:#fff;color:#757575}
.board-list .view-infinite-more .btn-e-xlg i {position:absolute;top:5px;right:5px;font-size:30px;color:#fff;transition:all 0.2s ease-in-out}
.board-list .view-infinite-more .btn-e-xlg:hover {border:1px solid #959595;background:#f5f5f5;color:#000}
.board-list .view-infinite-more .btn-e-xlg:hover i {color:#b5b5b5}
#infscr-loading {text-align:center;z-index:100;position:absolute;left:50%;bottom:0;width:200px;margin-left:-100px;padding:8px 0;background:#000;opacity:0.8;color:#fff}
<?php /* 구글맵 멀티마커 영역 */ ?>
.board-list .gmap-container {position:relative;overflow:hidden;height:500px;padding:6px;border:1px solid #c5c5c5;background:#fff}
.board-list .gmap-container #gmap_list_canvas {width:100%;height:100%;margin:0px;padding:0px}
.board-list .gmap-container .info-content {max-width:400px}
.board-list .gmap-container .info-content h5 {border-left:3px solid #FF4848;padding-left:8px;margin:5px 0 10px;font-size:15px;line-height:1.2;color:#252525}
.board-list .gmap-container .gm-style-iw:hover .info-content h5 {text-decoration:underline}
.board-list .gmap-container .gmap-canvas-img {float:left;width:26%;padding-right:15px}
.board-list .gmap-container .gmap-canvas-img-in {position:relative;overflow:hidden;max-height:65px;background:#353535;}
.board-list .gmap-container .gmap-canvas-img-in span {font-size:11px;padding:5px;color:#fff;display:inline-block}
.board-list .gmap-container .gmap-canvas-img img {display:block;width:100% \9;max-width:100%;height:auto}
.board-list .gmap-container .gmap-canvas-info {float:left;width:74%}
.board-list .gmap-container .gmap-canvas-info p {margin-bottom:5px}
.board-list .gmap-search-box {position:relative;border:1px solid #c5c5c5;background:#fbfbfb;padding:10px 10px 5px;margin:20px 0 30px}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width: 650px) {
    .board-list .gmap-btn-wrap {position:relative;height:72px;margin-bottom:20px}
    .gmap-type-btn-wrap {top:30px}
    .gmap-type-btn-wrap button.gmap-type-gallery-btn {border-right:1px solid #d5d5d5}
    .gmap-type-btn-wrap button.gmap-type-wide-btn {display:none}
    <?php /* 멀티타입 - 웹진형 */ ?>
    .board-gmap .gmap-item-in .gmap-img {top:176px;left:0;width:80px}
    .board-gmap .gmap-item-in .gmap-img-box {max-height:55px}
    .board-gmap .gmap-item-in .gmap-subj-cont {margin-left:0}
    .board-gmap .gmap-item-in .gmap-info-top .info-divider {display:none}
    .board-gmap .gmap-item-in .gmap-info-top .fake-block {display:block;height:5px}
    .board-gmap .gmap-item-in .gmap-info {margin-left:95px}
    .board-gmap .gmap-ratings .star-ratings-list {top:30px}
    .board-gmap .gmap-noimg-desc .gmap-ratings .star-ratings-list {top:10px}
    <?php /* 멀티타입 - 리스트형 */ ?>
    .board-gmap .gmap-type-list .gmap-noimg-desc .gmap-ratings .star-ratings-list {top:30px}
    <?php /* 멀티타입 - 갤러리형 */ ?>
    .board-gmap .gmap-type-gallery .gmap-item {padding:10px 5px;width:100%}
    <?php /* 멀티타입 - 와이드형 */ ?>
    .board-gmap .gmap-type-wide .gmap-item-in {padding:10px}
    <?php /* 구글맵 멀티마커 영역 */ ?>
    .board-list .gmap-container {height:450px}
}
<?php } ?>
</style>

<div id="fakeloader"></div>

<div class="board-list">
    <?php if ($is_admin && !G5_IS_MOBILE && !$wmode) { ?>
    <div class="board-setup btn-edit-mode hidden-xs hidden-sm">
        <span class="eyoom-form">
            <label class="select">
                <select name="set_bo_skin" class="set_bo_skin">
                    <option value="">::스킨선택::</option>
                    <?php foreach ($bo_skin as $skin) { ?>
                    <option value="<?php echo $skin; ?>" <?php echo $skin == $eyoom_board['bo_skin'] ? 'selected': ''; ?>><?php echo $skin; ?></option>
                    <?php }?>
                </select><i></i>
            </label>
        </span>
        <span class="board-setup-btn-box">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_copy&amp;bo_table=<?php echo $bo_table; ?>&amp;wmode=1"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="far fa-clone"></i> 복제하기</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_form&amp;w=u&amp;bo_table=<?php echo $bo_table; ?>&amp;wmode=1"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="fas fa-list-alt"></i> 기본설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=board_form&amp;w=u&amp;bo_table=<?php echo $bo_table; ?>&amp;wmode=1"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="far fa-list-alt"></i> 추가기능</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_extend&amp;w=u&amp;bo_table=<?php echo $bo_table; ?>&amp;wmode=1"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="far fa-plus-square"></i> 확장필드 (<?php echo number_format($board['bo_ex_cnt']); ?>)</a>
        </span>
    </div>
    <?php } ?>

    <?php /* 게시판 페이지 정보 및 버튼 시작 */ ?>
    <div class="board-info margin-bottom-20">
        <div class="pull-left margin-top-5 font-size-12 color-grey">
            <u>전체 <?php echo number_format($total_count); ?> 건 - <?php echo $page; ?> 페이지</u>
            <?php if ($is_member && $eyoom['is_community_theme'] == 'y') { ?>
            <span class="favorite-setup eyoom-form">
                <label class="toggle small-toggle green-toggle">
                    <input type="hidden" name="favorite_board" id="favorite_board" value="<?php echo !$is_bo_favorite ? 'n': 'y'; ?>">
                    <input type="checkbox" class="btn_favorite_toggle" value="favorite_board" <?php echo $is_bo_favorite ? 'checked':''; ?>><i></i><span class="color-grey font-size-12">관심게시판</span>
                </label>
            </span>
            <?php } ?>
        </div>
        <?php if ($write_href) { ?>
        <div class="pull-right">
            <a href="<?php echo $write_href; ?>" class="btn-e btn-e-red" type="button">글쓰기</a>
        </div>
        <?php } ?>
        <div class="clearfix"></div>
    </div>
    <?php /* 게시판 페이지 정보 및 버튼 끝 */ ?>

    <?php /* 게시판 카테고리 시작 */ ?>
    <?php if ($is_category) { ?>
    <div class="tab-scroll-category">
        <div class="scrollbar">
            <div class="handle">
                <div class="mousearea"></div>
            </div>
        </div>
        <div id="tab-category">
            <div class="category-list">
                <span <?php if (!$decode_sca) { ?>class="active"<?php } ?>><a href="<?php echo $category_href; ?>">전체분류 (<?php echo number_format($board['bo_count_write']); ?>)</a></span>
                <?php for ($i=0; $i<count($bocate); $i++) { ?>
                <span <?php if ($decode_sca == $bocate[$i]['ca_name']) { ?>class="active"<?php } ?>><a href="<?php echo get_eyoom_pretty_url($bo_table, '', 'sca='.$bocate[$i]['ca_sca']); ?>"><?php echo $bocate[$i]['ca_name']; ?> (<?php echo $bocate[$i]['ca_count']; ?>)</a></span>
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

    <?php if ($eyoom_board['bo_use_addon_map'] == '1' && ($config['cf_map_google_id'])) { ?>
    <div class="margin-bottom-5">
        <p class="color-grey font-size-12 text-right pull-left"><i class="fas fa-exclamation-circle"></i> 현재 페이지 게시글에서 입력한 주소들의 위치 출력</p>
        <button type="button" id="gm_refresh" class="btn-e btn-e-dark pull-right"><i class="fas fa-redo-alt margin-right-5"></i>지도 초기화</button>
        <div class="clearfix"></div>
    </div>
    <div class="gmap-container">
        <div id="gmap_list_canvas"></div>
    </div>

    <div class="gmap-search-box">
        <?php /* 게시판 검색 시작 */ ?>
        <fieldset id="bo_sch" class="eyoom-form">
            <form name="fsearch" method="get">
            <input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">
            <input type="hidden" name="sca" value="<?php echo $sca; ?>">
            <input type="hidden" name="sop" value="and">
            <div class="row">
                <div class="col col-4">
                    <section>
                        <label for="sfl">검색대상</label>
                        <label class="select">
                            <select name="sfl" id="sfl" class="form-control">
                                <option value="wr_subject||wr_6"<?php get_selected($sfl, 'wr_subject||wr_6'); ?>>제목 + 주소</option>
                                <option value="wr_subject"<?php get_selected($sfl, 'wr_subject', true); ?>>제목</option>
                                <option value="wr_6"<?php get_selected($sfl, 'wr_6'); ?>>주소</option>
                                <option value="wr_content"<?php get_selected($sfl, 'wr_content'); ?>>내용</option>
                                <option value="wr_subject||wr_content"<?php get_selected($sfl, 'wr_subject||wr_content'); ?>>제목+내용</option>
                                <option value="mb_id,1"<?php get_selected($sfl, 'mb_id,1'); ?>>회원아이디</option>
                                <option value="mb_id,0"<?php get_selected($sfl, 'mb_id,0'); ?>>회원아이디(코)</option>
                                <option value="wr_name,1"<?php get_selected($sfl, 'wr_name,1'); ?>>글쓴이</option>
                                <option value="wr_name,0"<?php get_selected($sfl, 'wr_name,0'); ?>>글쓴이(코)</option>
                                <?php if (is_array($ex_sfl)) { ?>
                                <?php foreach ($ex_sfl as $key => $ex_name) { ?>
                                <option value="<?php echo $key; ?>"<?php get_selected($sfl, $key, true); ?>><?php echo $ex_name; ?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                            <i></i>
                        </label>
                    </section>
                </div>
                <div class="col col-8">
                    <section>
                        <label for="stx">검색어<strong class="sound_only"> 필수</strong></label>
                        <div class="input input-button">
                            <input type="text" name="stx" value="<?php echo stripslashes($stx); ?>" required id="stx">
                            <div class="button"><input type="submit" value="검색">검색</div>
                        </div>
                    </section>
                </div>
            </div>
            </form>
        </fieldset>
        <?php /* 게시판 검색 끝 */ ?>
    </div>
    <?php } ?>

    <?php if ($is_admin) { ?>
    <form name="fboardlist" id="fboardlist" action="<?php echo G5_BBS_URL; ?>/board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post" class="eyoom-form">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="spt" value="<?php echo $spt; ?>">
    <input type="hidden" name="sca" value="<?php echo $sca; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="sw" value="">
    <?php } ?>
    <div class="gmap-btn-wrap">
        <?php if ($is_checkbox) { ?>
        <ul class="list-unstyled board-btn-adm pull-left">
            <li><button class="btn-e btn-e-default" type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value">선택삭제</button></li>
            <li><button class="btn-e btn-e-default" type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value">선택복사</button></li>
            <li><button class="btn-e btn-e-default" type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value">선택이동</button></li>
        </ul>
        <?php } ?>
        <span class="pull-left">
            <?php if ($rss_href) { ?>
            <a href="<?php echo $rss_href; ?>" class="btn-e btn-e-yellow" type="button"><i class="fas fa-rss"></i></a>
            <?php } ?>
        </span>
        <?php if (!$eyoom_board['bo_use_infinite_scroll'] == '1') { ?>
        <ul class="list-unstyled gmap-type-btn-wrap pull-right">
            <li><button type="button" class="gmap-type-btn gmap-type-list-btn" title="리스트뷰"><span class="sound_only">리스트뷰</span><i class="fas fa-align-justify" aria-hidden="true"></i></button></li>
            <li><button type="button" class="gmap-type-btn gmap-type-webzine-btn" title="웹진뷰"><span class="sound_only">웹진뷰</span><i class="fas fa-th-list" aria-hidden="true"></i></button></li>
            <li><button type="button" class="gmap-type-btn gmap-type-gallery-btn" title="갤러리뷰"><span class="sound_only">갤러리뷰</span><i class="fas fa-th-large" aria-hidden="true"></i></button></li>
            <li><button type="button" class="gmap-type-btn gmap-type-wide-btn" title="와이드뷰"><span class="sound_only">와이드뷰</span><i class="fas fa-square-full" aria-hidden="true"></i></button></li>
            <div class="clearfix"></div>
        </ul>
        <?php } ?>
        <div class="clearfix"></div>
    </div>
    <?php if ($is_checkbox) { ?>
    <div class="margin-bottom-15">
        <label class="checkbox"><input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);"><i></i>현재 페이지 게시물 전체선택</label>
    </div>
    <?php } ?>
    <div class="board-gmap">
        <div id="gmap_item_type" class="gmap-type-webzine">
        <?php for ($i=0; $i<count($list); $i++) { ?>
            <?php if ($list[$i]['is_notice']) { ?>
            <div class="gmap-item-notice">
                <div class="ellipsis">
                    <span class="label label-dark color-white margin-right-5">공지</span><a href="<?php echo $list[$i]['href']; ?>" <?php echo $infinite_wmode? 'onclick="eb_modal(this.href); return false;"': ''; ?>><?php echo $list[$i]['subject']; ?></a>
                </div>
            </div>
            <?php } else { ?>
            <div class="gmap-item">
                <div class="gmap-item-in">
                    <?php if ($list[$i]['img_content'] && !preg_match('/no image/',$list[$i]['img_content'])) { ?>
                    <div class="gmap-img">
                        <a href="<?php echo $list[$i]['href']; ?>" <?php echo $infinite_wmode ? 'onclick="eb_modal(this.href); return false;"': ''; ?>>
                            <div class="gmap-img-box">
                                <div class="gmap-img-box-in">
                                    <?php echo $list[$i]['img_content']; ?>
                                    <?php if ($list[$i]['is_video']) { ?>
                                    <span class="movie-icon"><i class="far fa-play-circle"></i></span>
                                    <?php } ?>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="gmap-desc">
                    <?php } else { ?>
                    <div class="gmap-noimg-desc">
                    <?php } ?>
                        <div class="gmap-subj-cont">
                            <h4 class="ellipsis">
                                <a href="<?php echo $list[$i]['href']; ?>" <?php echo $infinite_wmode ? 'onclick="eb_modal(this.href); return false;"': ''; ?>>
                                    <?php if ($wr_id == $list[$i]['wr_id']) { ?>
                                    <strong class="color-red margin-right-5">열람중</strong>
                                    <?php if ($is_category && $list[$i]['ca_name']) { ?>
                                    <span class="label label-dark"><?php echo $list[$i]['ca_name']; ?></span>
                                    <?php } ?>
                                    <strong><?php echo $list[$i]['subject']; ?></strong>
                                    <?php } else { ?>
                                    <?php if ($is_category && $list[$i]['ca_name']) { ?>
                                    <span class="label label-dark"><?php echo $list[$i]['ca_name']; ?></span>
                                    <?php } ?>
                                    <strong><?php echo $list[$i]['subject']; ?></strong>
                                    <?php } ?>
                                </a>
                                <?php if ($is_checkbox) { ?>
                                <span class="gmap-checkbox">
                                    <label for="chk_wr_id_<?php echo $i; ?>" class="sound_only"><?php echo $list[$i]['subject']; ?></label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id']; ?>" id="chk_wr_id_<?php echo $i; ?>"><i></i>
                                    </label>
                                </span>
                                <?php } ?>
                            </h4>
                            <div class="gmap-info-top">
                                <p><strong>위치명</strong> : <?php if ($list[$i]['wr_9']) { ?><?php echo $list[$i]['wr_9']; ?><?php } else { ?><span class="color-light-grey">미입력</span><?php } ?><span class="info-divider">|</span><span class="fake-block"></span><strong>연락처</strong> : <?php if ($list[$i]['wr_10']) { ?><?php echo $list[$i]['wr_10']; ?><?php } else { ?><span class="color-light-grey">미입력</span><?php } ?></span></p>
                                <p><strong>주소</strong> : <?php echo $list[$i]['wr_6']; ?></p>
                            </div>
                            <p class="gmap-cont">
                                <?php if (!G5_IS_MOBILE) { ?>
                                <?php echo cut_str($list[$i]['content'],140, '…'); ?>
                                <?php } else { ?>
                                <?php echo cut_str($list[$i]['content'],80, '…'); ?>
                                <?php } ?>
                            </p>
                        </div>
                        <div class="gmap-info <?php if ($eyoom_board['bo_use_rating'] == '1' && $eyoom_board['bo_use_rating_list'] == '1') echo 'gmap-info-rating'; ?>">
                            <?php if ($eyoom_board['bo_use_profile_photo'] == 1) { ?>
                            <span class="gmap-photo">
                                <?php if ($list[$i]['mb_photo']) { ?>
                                <?php echo $list[$i]['mb_photo']; ?>
                                <?php } else { ?>
                                <span class="gmap-user-icon"><i class="fas fa-user"></i></span>
                                <?php } ?>
                            </span>
                            <?php } ?>
                            <span class="gmap-nick"><?php echo eb_nameview($list[$i]['mb_id'], $list[$i]['wr_name'], $list[$i]['wr_email'], $list[$i]['homepage']); ?></span>
                            <?php if ($list[$i]['gnu_icon']) { ?>
                            <span class="gmap-lv-icon"><img src="<?php echo $list[$i]['gnu_icon']; ?>" alt="레벨"></span>
                            <?php } ?>
                            <?php if ($list[$i]['eyoom_icon']) { ?>
                            <span class="gmap-lv-icon"><img src="<?php echo $list[$i]['eyoom_icon']; ?>" alt="레벨"></span>
                            <?php } ?>
                            <?php if ($eyoom_board['bo_sel_date_type'] == '1') { ?>
                            <span><i class="far fa-clock"></i><strong class="color-black"><?php echo $eb->date_time('Y.m.d', $list[$i]['wr_datetime']); ?></strong></span>
                            <?php } else if ($eyoom_board['bo_sel_date_type'] == '2') { ?>
                            <span><i class="far fa-clock"></i><strong class="color-black"><?php echo $eb->date_format('Y.m.d', $list[$i]['wr_datetime']); ?></strong></span>
                            <?php } ?>
                            <span><i class="fas fa-eye"></i><strong class="color-black"><?php echo number_format($list[$i]['wr_hit']); ?></strong></span>
                            <?php if ($list[$i]['wr_comment'] > 0) { ?>
                            <span><i class="far fa-comment-dots"></i><strong class="color-red">+<?php echo number_format($list[$i]['wr_comment']); ?></strong></span>
                            <?php } ?>
                            <?php if ($is_good && $list[$i]['wr_good'] > 0) { ?>
                            <span><i class="far fa-thumbs-up"></i><strong class="color-green"><?php echo number_format($list[$i]['wr_good']); ?></strong></span>
                            <?php } ?>
                            <?php if ($is_nogood && $list[$i]['wr_nogood'] > 0) { ?>
                            <span><i class="far fa-thumbs-down"></i><strong class="color-brown"><?php echo number_format($list[$i]['wr_nogood']); ?></strong></span>
                            <?php } ?>
                            <?php if ($eyoom_board['bo_use_rating'] == '1' && $eyoom_board['bo_use_rating_list'] == '1') { ?>
                            <div class="gmap-ratings">
                                <ul class="list-unstyled star-ratings-list">
                                    <li><i class="<?php if ($list[$i]['star'] <= 0) { ?>rating far fa-star<?php } else if ($list[$i]['star'] > 0.3 && $list[$i]['star'] <= 0.7) { ?>rating-selected fas fa-star-half<?php } else if ($list[$i]['star'] > 0.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
                                    <li><i class="<?php if ($list[$i]['star'] <= 1) { ?>rating far fa-star<?php } else if ($list[$i]['star'] > 1.3 && $list[$i]['star'] <= 1.7) { ?>rating-selected fas fa-star-half<?php } else if ($list[$i]['star'] > 1.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
                                    <li><i class="<?php if ($list[$i]['star'] <= 2) { ?>rating far fa-star<?php } else if ($list[$i]['star'] > 2.3 && $list[$i]['star'] <= 2.7) { ?>rating-selected fas fa-star-half<?php } else if ($list[$i]['star'] > 2.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
                                    <li><i class="<?php if ($list[$i]['star'] <= 3) { ?>rating far fa-star<?php } else if ($list[$i]['star'] > 3.3 && $list[$i]['star'] <= 3.7) { ?>rating-selected fas fa-star-half<?php } else if ($list[$i]['star'] > 3.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
                                    <li><i class="<?php if ($list[$i]['star'] <= 4) { ?>rating far fa-star<?php } else if ($list[$i]['star'] > 4.3 && $list[$i]['star'] <= 4.7) { ?>rating-selected fas fa-star-half<?php } else if ($list[$i]['star'] > 4.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
                                </ul>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        <?php } ?>
        <?php if (count($list) == 0) { ?>
            <div class="text-center color-grey font-size-14"><i class="fas fa-exclamation-circle"></i> 게시물이 없습니다.</div>
        <?php } ?>
        </div>
    </div>
    <?php if ($list && $eyoom_board['bo_use_infinite_scroll'] == '1') { ?>
    <div class="view-infinite-more text-center">
        <a id="view-infinite-more" href="#" class="btn btn-default btn-e-xlg">더 보기<i class="far fa-arrow-alt-circle-down"></i></a>
    </div>
    <?php } ?>
    <div class="board-list-footer">
        <div class="pull-left">
            <?php if ($is_checkbox) { ?>
            <ul class="list-unstyled board-btn-adm pull-left">
                <li><button class="btn-e btn-e-default" type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value">선택삭제</button></li>
                <li><button class="btn-e btn-e-default" type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value">선택복사</button></li>
                <li><button class="btn-e btn-e-default" type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value">선택이동</button></li>
            </ul>
            <?php } ?>
            <span class="pull-left">
                <?php if ($rss_href) { ?>
                <a href="<?php echo $rss_href; ?>" class="btn-e btn-e-yellow" type="button"><i class="fas fa-rss"></i></a>
                <?php } ?>
            </span>
        </div>
        <div class="pull-right">
            <?php if ($list_href || $write_href) { ?>
            <ul class="list-unstyled">
                <?php if ($write_href) { ?>
                <li><a href="<?php echo $write_href; ?>" class="btn-e btn-e-red" type="button">글쓰기</a></li>
                <?php } ?>
            </ul>
            <?php } ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php if ($is_admin) { ?>
    </form>
    <?php } ?>
</div>

<?php if ($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<div class="board-pagination">
    <?php if ($eyoom_board['bo_use_infinite_scroll'] != '1') { ?>
    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>
    <?php } else { ?>
    <div id="infinite_pagination">
        <a class="next" href="<?php echo get_eyoom_pretty_url($bo_table,'','&amp;sca='.$sca.'&amp;page='.($page+1)); ?>"></a>
    </div>
    <?php } ?>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/fakeLoader/fakeLoader.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert/sweetalert.min.js"></script>
<?php if ($eyoom_board['bo_use_addon_map'] == '1' && ($config['cf_map_google_id'])) { ?>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&region=KR&key=<?php echo $config['cf_map_google_id']; ?>"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/skin/board/gmap/js/oms.min.js"></script>
<?php } ?>
<?php if ($is_category) { ?>
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
<?php } ?>

<script>
$('#fakeloader').fakeLoader({
    timeToHide:3000,
    zIndex:"11",
    spinner:"spinner6",
    bgColor:"#fff",
});

$(window).load(function(){
    $('#fakeloader').fadeOut(300);
});

<?php if ($eyoom_board['bo_use_addon_map'] == '1') { ?>
(function(){
    var script = '<script type="text/javascript" src="<?php echo EYOOM_THEME_URL; ?>/skin/board/gmap/js/markerclusterer';
    if (document.location.search.indexOf('compiled') !== -1) {
        script += '_compiled';
    }
    script += '.js"><' + '/script>';
    document.write(script);

    var gm = google.maps;
    var config = {
        el: 'gmap_list_canvas',
        lat: 36.376084,
        lon: 128.151405,
        zoom: 6.3,
        minZoom: 15,
        type: google.maps.MapTypeId.ROADMAP
    };
    var spiderConfig = {
        keepSpiderfied: true,
        event: 'mouseover'
    };

    function initialize() {
        var map = new gm.Map(document.getElementById(config.el), {
            zoom: config.zoom,
            center: new gm.LatLng(config.lat, config.lon),
            mapTypeId: config.type
        });
        var markerSpiderfier = new OverlappingMarkerSpiderfier(map, spiderConfig);
        var locations = [
            <?php $cnt = count($list); for ($i=0; $i<$cnt; $i++) { ?>
            ['<?php echo $list[$i]['wr_7']; ?>','<?php echo $list[$i]['wr_8']; ?>']<?php echo $cnt != ($i+1) ? ',':''; ?>
            <?php } ?>
        ];
        var infoWindowContent = [
            <?php $cnt = count($list); for ($i=0; $i<$cnt; $i++) { ?>
            ['<div class="info-content">' + '<a href="<?php echo $list[$i]['href']; ?>"><h5 class="ellipsis margin-bottom-10"><strong><?php echo $list[$i]['subject']; ?></strong></h5></a>' + '<?php if($list[$i]['img_content']) { ?><div class="gmap-canvas-img"><div class="gmap-canvas-img-in"><a href="<?php echo $list[$i]['href']; ?>"><?php echo $list[$i]['img_content']; ?></a></div></div><?php } ?>' + '<div class="gmap-canvas-info"><?php if ($list[$i]['wr_9']) { ?><p class="font-size-11">- <strong>위치명</strong> : <?php echo $list[$i]['wr_9']; ?></p><?php } ?><?php if ($list[$i]['wr_10']) { ?><p class="font-size-11">- <strong>연락처</strong> : <?php echo $list[$i]['wr_10']; ?></p><?php } ?><p class="font-size-11">- <strong>주소</strong> : <?php echo $list[$i]['wr_6']; ?></p></div>' + '</div>']<?php echo $cnt != ($i+1) ? ',':''; ?>
            <?php } ?>
        ];
        var markers = [];
        var clusterStyles = [
            {
                textColor: 'white',
                url: '<?php echo EYOOM_THEME_URL; ?>/skin/board/gmap/images/mc1.png',
                height: 50,
                width: 50
            },
            {
                textColor: 'white',
                url: '<?php echo EYOOM_THEME_URL; ?>/skin/board/gmap/images/mc2.png',
                height: 50,
                width: 50
            },
            {
                textColor: 'white',
                url: '<?php echo EYOOM_THEME_URL; ?>/skin/board/gmap/images/mc3.png',
                height: 50,
                width: 50
            },
            {
                textColor: 'white',
                url: '<?php echo EYOOM_THEME_URL; ?>/skin/board/gmap/images/mc4.png',
                height: 50,
                width: 50
            },
            {
                textColor: 'white',
                url: '<?php echo EYOOM_THEME_URL; ?>/skin/board/gmap/images/mc5.png',
                height: 50,
                width: 50
            }
        ];
        var mcOptions = {
            styles: clusterStyles
        };
        var iw = new gm.InfoWindow();
        for (var i = 0; i < locations.length; i++) {
            var latLng = new gm.LatLng(locations[i][0], locations[i][1]);
            var marker = new gm.Marker({
                position: latLng,
                map: map
            });
            markers.push(marker);
            markerSpiderfier.addMarker(marker);
            gm.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    iw.setContent(infoWindowContent[i][0]);
                    iw.open(map, marker);
                }
            })(marker, i));
        }
        var markerCluster = new MarkerClusterer(map, markers, mcOptions);

        markerCluster.setMaxZoom(config.minZoom);
    }
    gm.event.addDomListener(window, 'load', initialize);

    $('#gm_refresh').on('click', initialize);
})();
<?php } ?>

var gmap_bo_table = "<?php echo $bo_table; ?>";

$.fn.listType = function(type) {
    var $el = this.find(".gmap-item");
    var count = $el.size();
    if(count < 1)
        return;

    var cl = this.attr("class");
    if(cl && !this.data("class")) {
        this.data("class", cl);
    }

    $("button.gmap-type-btn span").removeClass("gmap-type-on").html("");

    if(type == "webzine") {
        this.removeClass("gmap-type-webzine");
        if(this.data("class")) {
            this.attr("class", this.data("class"));
        }

        $("button.gmap-type-webzine-btn span").addClass("gmap-type-on").html("<b class=\"sound_only\"> 선택됨</b>");
    } else if(type == "gallery") {
        if(this.data("class")) {
            this.removeAttr("class");
        }
        this.addClass("gmap-type-gallery");

        $("button.gmap-type-gallery-btn span").addClass("gmap-type-on").html("<b class=\"sound_only\"> 선택됨</b>");
    } else if(type == "wide") {
        if(this.data("class")) {
            this.removeAttr("class");
        }
        this.addClass("gmap-type-wide");

        $("button.gmap-type-wide-btn span").addClass("gmap-type-on").html("<b class=\"sound_only\"> 선택됨</b>");
    } else if(type == "list") {
        if(this.data("class")) {
            this.removeAttr("class");
        }
        this.addClass("gmap-type-list");

        $("button.gmap-type-list-btn span").addClass("gmap-type-on").html("<b class=\"sound_only\"> 선택됨</b>");
    }

    set_cookie("ck_itemlist"+gmap_bo_table+"_type", type, 1, g5_cookie_domain);
}

$(function() {
    if(itemlist_type = get_cookie("ck_itemlist"+gmap_bo_table+"_type")) {
        $("#gmap_item_type").listType(itemlist_type);
    }

    $("button.gmap-type-btn").on("click", function() {
        if($(this).hasClass("gmap-type-webzine-btn")) {
            $("#gmap_item_type").listType("webzine");
        } else if($(this).hasClass("gmap-type-gallery-btn")) {
            $("#gmap_item_type").listType("gallery");
        } else if($(this).hasClass("gmap-type-wide-btn")) {
            $("#gmap_item_type").listType("wide");
        } else if($(this).hasClass("gmap-type-list-btn")) {
            $("#gmap_item_type").listType("list");
        }
    });
});
</script>

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;
    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;
    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
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
    if (document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }
    if (document.pressed == "선택이동") {
        select_copy("move");
        return;
    }
    if (document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;
        f.removeAttribute("target");
        f.action = g5_bbs_url+"/board_list_update.php";
    }
    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;
    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");
    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<?php } ?>

<?php if ($is_admin) { ?>
<script>
$(function() {
    $(".set_bo_skin").change(function() {
        var skin = $(this).val();
        if (!skin) {
            swal({
                title: "알림",
                text: '스킨을 선택해 주세요.',
                confirmButtonColor: "#FF4848",
                type: "warning",
                confirmButtonText: "확인"
            });
        } else {
            $.post('<?php echo EYOOM_CORE_URL; ?>/board/set_bo_skin.php', { bo_table: "<?php echo $bo_table; ?>", skin: skin });
            document.location.reload();
        }
    });
});
</script>
<?php } ?>

<?php if ($is_member) { ?>
<script>
$(function() {
    $(".btn_favorite_toggle").change(function() {
        var favorite = $("#favorite_board").val();

        $.post('<?php echo EYOOM_CORE_URL; ?>/board/favorite_board.php', { bo_table: "<?php echo $bo_table; ?>", favorite: favorite });
        if (favorite == 'y') {
            $("#favorite_board").val('n');
            swal({
                title: "알림",
                text: '관심게시판에서 해제하였습니다.',
                confirmButtonColor: "#FF4848",
                type: "warning",
                confirmButtonText: "확인"
            });
        } else if (favorite == 'n') {
            $("#favorite_board").val('y');
            swal({
                title: "알림",
                text: '관심게시판으로 등록하였습니다.',
                confirmButtonColor: "#FF4848",
                type: "warning",
                confirmButtonText: "확인"
            });
        }
    });
});
</script>
<?php } ?>