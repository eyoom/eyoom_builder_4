<?php
/**
 * skin file : /theme/THEME_NAME/skin/board/gallery/list.skin.html.php
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
.board-gallery {margin-left:-5px;margin-right:-5px}
.board-gallery .gallery-item, .board-gallery .gallery-sizer {position:relative;width:33.33333%}
.board-gallery .gallery-item-pd {padding:5px}
.board-gallery .gallery-item-in {position:relative;background:#fff;border:1px solid #e5e5e5}
.board-gallery .gallery-item-in .gallery-item-category {position:relative;background:#fff;padding:10px;color:#959595;font-weight:bold;border-bottom:1px solid #ededed}
.board-gallery .gallery-item .gallery-item-image {position:relative;overflow:hidden;padding:10px 10px 0}
.board-gallery .gallery-item .gallery-item-image-in {position:relative;overflow:hidden;max-height:500px}
.board-gallery .gallery-item .gallery-item-image-in:after {content:"";text-align:center;position:absolute;display:block;left:0;top:0;opacity:0;-moz-transition:all 0.2s ease 0s;-webkit-transition:all 0.2s ease 0s;-ms-transition:all 0.2s ease 0s;-o-transition:all 0.2s ease 0s;transition:all 0.2s ease 0s;width:100%;height:100%;background:rgba(0,0,0,0.45)}
.board-gallery .gallery-item .gallery-item-image-in .movie-icon {display:inline-block;position:absolute;top:50%;left:50%;width:40px;height:40px;line-height:40px;text-align:center;color:#fff;font-size:30px;margin-top:-20px;margin-left:-20px;z-index:1}
.board-gallery .gallery-item:hover .gallery-item-image-in:after {opacity:1}
.board-gallery .gallery-item:hover .gallery-item-image-in {box-shadow:none}
.board-gallery .gallery-item .gallery-item-info {position:relative;padding:0 10px;margin-top:5px}
.board-gallery .gallery-item .gallery-item-info h4 {font-size:15px;color:#000}
.board-gallery .gallery-item .gallery-item-info .gallery-checkbox {display:inline-block;position:absolute;top:-5px;right:0;z-index:1}
.board-gallery .gallery-item:hover .gallery-item-info h4 {text-decoration:underline}
.board-gallery .gallery-item .gallery-item-info .gallery-cont {position:relative;overflow:hidden;color:#757575;font-weight:200;font-size:12px}
.board-gallery .gallery-desc {position:relative;margin-bottom:10px}
.board-gallery .gallery-desc .gallery-photo {display:inline-block;width:26px;height:26px;margin-right:2px;border:1px solid #e5e5e5;padding:1px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.board-gallery .gallery-desc .gallery-photo img {width:100%;height:auto;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.board-gallery .gallery-desc .gallery-photo .desc-user-icon {width:22px;height:22px;font-size:14px;line-height:22px;text-align:center;background:#959595;color:#fff;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;display:inline-block;white-space:nowrap;vertical-align:baseline;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.board-gallery .gallery-desc .gallery-lv-icon {display:inline-block;margin-left:2px}
.board-gallery .gallery-ratings .star-ratings-list {position:absolute;top:3px;right:0;width:60px;height:18px;background:#fff}
.board-gallery .gallery-ratings .star-ratings-list li {padding:0;float:left;margin-right:0}
.board-gallery .gallery-ratings .star-ratings-list li .rating {color:#a5a5a5;font-size:10px;line-height:normal}
.board-gallery .gallery-ratings .star-ratings-list li .rating-selected {color:#FF4848;font-size:10px}
.board-gallery .gallery-item .gallery-item-bottom {position:relative;border-top:1px solid #e5e5e5;font-size:11px;color:#000}
.board-gallery .gallery-item .gallery-item-bottom .pull-left {padding:7px 10px}
.board-gallery .gallery-item .gallery-item-bottom .pull-left i {color:#959595}
.board-gallery .gallery-item .gallery-item-bottom .pull-right {padding:7px 10px;border-left:1px solid #e5e5e5}
.board-gallery .gallery-item .gallery-item-bottom .pull-right i {margin:0 5px}
.board-gallery .masonry-blick-100 {width:100% !important;padding:0 5px;box-sizing:border-box}
.board-gallery .masonry-blick-100 .gallery-item-in {box-shadow:none;margin:0;margin-bottom:18px}
.board-gallery .gallery-box-notice {position:relative;overflow:hidden;border:1px solid #e5e5e5;background:#fff;padding:8px 10px}
.board-gallery .gallery-box-notice:hover {background:#fff;border:solid 1px #e5e5e5;box-shadow:none}
.board-gallery .gallery-box-notice:first-child {margin-top:0}
.board-gallery .gallery-box-notice .label {font-size:11px;font-weight:normal;margin-bottom:0}
.board-list .view-infinite-more {margin-top:30px;margin-bottom:40px}
.board-list .view-infinite-more .btn-e-xlg {position:relative;height:40px;line-height:40px;padding:0 100px;font-size:16px !important;border:1px solid #b5b5b5;background:#fff;color:#757575}
.board-list .view-infinite-more .btn-e-xlg i {position:absolute;top:5px;right:5px;font-size:30px;color:#fff;transition:all 0.2s ease-in-out}
.board-list .view-infinite-more .btn-e-xlg:hover {border:1px solid #959595;background:#f5f5f5;color:#000}
.board-list .view-infinite-more .btn-e-xlg:hover i {color:#b5b5b5}
#infscr-loading {text-align:center;z-index:100;position:absolute;left:50%;bottom:0;width:200px;margin-left:-100px;padding:8px 0;background:#000;opacity:0.8;color:#fff}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width:767px) {
    .board-gallery .gallery-item, .board-gallery .gallery-sizer {width:50%}
    .board-gallery .gallery-item-in .gallery-item-category {padding:5px}
    .board-gallery .gallery-item .gallery-item-image {padding:5px 5px 0}
    .board-gallery .gallery-item .gallery-item-info {padding:0 5px}
    .board-gallery .gallery-item .gallery-item-info h4 {font-size:13px}
    .board-gallery .gallery-item .gallery-item-info .gallery-checkbox {right:-5px}
    .board-gallery .gallery-item .gallery-item-bottom .pull-left {padding:5px}
    .board-gallery .gallery-item .gallery-item-bottom .pull-right {padding:5px}
}
<?php } ?>
@media (min-width: 768px) {
    .board-view-modal {width:720px;margin:10px auto}
    .board-view-modal .modal-header, .board-view-modal .modal-body, .board-view-modal .modal-footer {padding:10px 20px}
}
@media (min-width: 992px) {
    .board-view-modal {width:940px}
}
@media (min-width: 1200px) {
    .board-view-modal {width:1140px}
}
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

    <?php /* Hot 게시글 */ ?>
    <?php if ($eyoom_board['bo_use_hotgul'] == 1) { ?>
    <?php //echo $latest->latest_hot('basic', 'count=5||cut_subject=30||photo=y'); ?>
    <?php } ?>

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
                <?php for ($i=0; $i<count((array)$bocate); $i++) { ?>
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
    <div class="margin-bottom-20">
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
            <a class="btn-e btn-e-dark" type="button" data-toggle="modal" data-target=".search-modal"><i class="fas fa-search"></i></a>
        </span>
        <div class="clearfix"></div>
    </div>
    <?php if ($is_checkbox) { ?>
    <div class="margin-bottom-15">
        <label class="checkbox"><input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);"><i></i>현재 페이지 게시물 전체선택</label>
    </div>
    <?php } ?>
    <div class="board-gallery">
        <div class="gallery-sizer"></div>
    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        <div class="gallery-item">
            <?php if ($list[$i]['is_notice']) { ?>
            <div class="gallery-item-in gallery-box-notice">
                <div class="ellipsis">
                    <span class="label label-dark color-white margin-right-5">공지</span><a href="<?php echo $list[$i]['href']; ?>" <?php echo $infinite_wmode? 'onclick="eb_modal(this.href); return false;"': ''; ?>><?php echo $list[$i]['subject']; ?></a>
                </div>
            </div>
            <?php } else { ?>
            <div class="gallery-item-pd">
                <div class="gallery-item-in">
                    <?php if ($is_category && $list[$i]['ca_name']) { ?>
                    <div class="gallery-item-category">
                        <?php echo $list[$i]['ca_name']; ?>
                    </div>
                    <?php } ?>
                    <div class="gallery-item-image">
                        <a href="<?php echo $list[$i]['href']; ?>" <?php echo $infinite_wmode ? 'onclick="eb_modal(this.href); return false;"': ''; ?>>
                            <div class="gallery-item-image-in">
                            <?php if ($list[$i]['img_content'] && !preg_match('/no image/',$list[$i]['img_content'])) { ?>
                                <?php echo $list[$i]['img_content']; ?>
                                <?php if ($list[$i]['is_video']) { ?>
                                <span class="movie-icon"><i class="far fa-play-circle"></i></span>
                                <?php } ?>
                            <?php } ?>
                            </div>
                        </a>
                    </div>
                    <div class="gallery-item-info">
                        <h4 class="ellipsis">
                            <a href="<?php echo $list[$i]['href']; ?>" <?php echo $infinite_wmode ? 'onclick="eb_modal(this.href); return false;"': ''; ?>>
                                <?php if ($wr_id == $list[$i]['wr_id']) { ?>
                                <strong><span class="color-red margin-right-5">열람중</span><?php echo $list[$i]['subject']; ?></strong>
                                <?php } else { ?>
                                <strong><?php echo $list[$i]['subject']; ?></strong>
                                <?php } ?>
                            </a>
                            <?php if ($is_checkbox) { ?>
                            <span class="gallery-checkbox">
                                <label for="chk_wr_id_<?php echo $i; ?>" class="sound_only"><?php echo $list[$i]['subject']; ?></label>
                                <label class="checkbox">
                                    <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id']; ?>" id="chk_wr_id_<?php echo $i; ?>"><i></i>
                                </label>
                            </span>
                            <?php } ?>
                        </h4>
                        <div class="gallery-desc">
                            <?php if ($eyoom_board['bo_use_profile_photo'] == 1) { ?>
                            <span class="gallery-photo">
                                <?php if ($list[$i]['mb_photo']) { ?>
                                <?php echo $list[$i]['mb_photo']; ?>
                                <?php } else { ?>
                                <span class="desc-user-icon"><i class="fas fa-user"></i></span>
                                <?php } ?>
                            </span>
                            <?php } ?>
                            <span><?php echo eb_nameview($list[$i]['mb_id'], $list[$i]['wr_name'], $list[$i]['wr_email'], $list[$i]['homepage']); ?></span>
                            <?php if ($eyoom_board['bo_use_rating'] == '1' && $eyoom_board['bo_use_rating_list'] == '1') { ?>
                            <div class="gallery-ratings">
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
                        <?php if ($list[$i]['content']) { ?>
                        <p class="gallery-cont">
                            <?php if (!G5_IS_MOBILE) { ?>
                            <?php echo cut_str($list[$i]['content'],70, '…'); ?>
                            <?php } else { ?>
                            <?php echo cut_str($list[$i]['content'],40, '…'); ?>
                            <?php } ?>
                        </p>
                        <?php } ?>
                    </div>
                    <div class="gallery-item-bottom clearfix">
                        <div class="pull-left">
                            <?php if ($eyoom_board['bo_sel_date_type'] == '1') { ?>
                            <i class="far fa-clock"></i> <?php echo $eb->date_time('Y.m.d', $list[$i]['wr_datetime']); ?>
                            <?php } else if ($eyoom_board['bo_sel_date_type'] == '2') { ?>
                            <i class="far fa-clock"></i> <?php echo $eb->date_format('Y.m.d', $list[$i]['wr_datetime']); ?>
                            <?php } ?>
                            <?php if ($list[$i]['wr_comment']) { ?>
                            <i class="far fa-comments margin-left-5"></i> <span class="color-red"><?php echo number_format($list[$i]['wr_comment']); ?></span>
                            <?php } ?>
                            <?php if ($is_good && $list[$i]['wr_good'] > 0) { ?>
                            <i class="far fa-thumbs-up margin-left-5"></i> <span class="color-green"><?php echo number_format($list[$i]['wr_good']); ?></span>
                            <?php } ?>
                            <?php if ($is_nogood && $list[$i]['wr_nogood'] > 0) { ?>
                            <i class="far fa-thumbs-down margin-left-5"></i> <span class="color-brown"><?php echo number_format($list[$i]['wr_nogood']); ?></span>
                            <?php } ?>
                        </div>
                        <div class="pull-right color-grey hidden-xs">
                            <i class="fas fa-eye"></i> <?php echo number_format($list[$i]['wr_hit']); ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    <?php } ?>
    <?php if (count((array)$list) == 0) { ?>
        <div class="text-center color-grey font-size-14"><i class="fas fa-exclamation-circle"></i> 게시물이 없습니다.</div>
    <?php } ?>
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
                <a class="btn-e btn-e-dark" type="button" data-toggle="modal" data-target=".search-modal"><i class="fas fa-search"></i></a>
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

<?php /* 게시판 검색 모달 시작 */ ?>
<div class="modal fade search-modal" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h5 class="modal-title"><i class="fas fa-search color-grey"></i> <strong><?php echo $board['bo_subject']; ?> 검색</strong></h5>
            </div>
            <div class="modal-body">
                <?php /* 게시판 검색 시작 */ ?>
                <fieldset id="bo_sch" class="eyoom-form">
                    <form name="fsearch" method="get">
                    <input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">
                    <input type="hidden" name="sca" value="<?php echo $sca; ?>">
                    <input type="hidden" name="sop" value="and">
                    <label for="sfl" class="sound_only">검색대상</label>
                    <section class="margin-top-10">
                        <label class="select">
                            <select name="sfl" id="sfl" class="form-control">
                                <option value="wr_subject"<?php get_selected($sfl, 'wr_subject', true); ?>>제목</option>
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
                    <section>
                        <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                        <div class="input input-button">
                            <input type="text" name="stx" value="<?php echo stripslashes($stx); ?>" required id="stx">
                            <div class="button"><input type="submit" value="검색">검색</div>
                        </div>
                    </section>
                    </form>
                </fieldset>
                <?php /* 게시판 검색 끝 */ ?>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn-e btn-e-lg btn-e-dark" type="button"><i class="fas fa-times"></i> 닫기</button>
            </div>
        </div>
    </div>
</div>
<iframe name="photoframe" id="photoframe" style="display:none;"></iframe>
<?php /* 게시판 검색 모달 끝 */ ?>

<?php if ($infinite_wmode) { ?>
<?php /* 게시판 상세보기 모달 시작 */ ?>
<div class="modal fade view-iframe-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog board-view-modal">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <div class="modal-body">
                <iframe id="view-iframe" width="100%" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn-e btn-e-xlg btn-e-dark" type="button"><i class="fas fa-times"></i> 닫기</button>
            </div>
        </div>
    </div>
</div>
<?php /* 게시판 상세보기 모달 끝 */ ?>
<?php } ?>

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
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/masonry/masonry.pkgd.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/imagesloaded/imagesloaded.pkgd.min.js"></script>
<?php if ($eyoom_board['bo_use_infinite_scroll'] == '1') { ?>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/infinite-scroll/jquery.infinitescroll.min.js"></script>
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

<?php if ($eyoom_board['bo_use_infinite_scroll'] == '1') { ?>
function eb_modal(href) {
    $('.view-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#view-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.view-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#view-iframe").attr("src", href);
        $('#view-iframe').height(parseInt($(window).height() * 0.85));
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

$(document).ready(function () {
    $(window).resize(function () {
        $('#view-iframe').height(parseInt($(window).height() * 0.7));
    });
    window.closeModal = function(wr_id){
        $('.view-iframe-modal').modal('hide');
        if(wr_id) {
            var w_id = wr_id.split('|');
            for(var i=0;i<w_id.length;i++) {
                $("#list-item-"+w_id[i]).hide();
            }
        }
    };
});
<?php } ?>

$(document).ready(function(){
    var $container = $('.board-gallery');

    <?php if ($infinite_wmode) { ?>
    $container.infinitescroll({
        navSelector  : "#infinite_pagination",
        nextSelector : "#infinite_pagination .next",
        itemSelector : ".gallery-item",
        loading: {
            finishedMsg: 'END',
            msgText: "Loading...",
            img: '<?php echo EYOOM_THEME_URL; ?>/image/loading.gif'
        }
    },

    function( newElements ) {
        var $newElems = $( newElements ).css({ opacity: 0 });
        $newElems.imagesLoaded(function() {
            $newElems.animate({ opacity: 1 });
            $container.masonry( 'appended', $newElems, true );
        });

        $container.imagesLoaded(function() {
            $container.masonry({
                columnWidth: '.gallery-sizer',
                itemSelector: '.gallery-item',
                percentPosition: true
            });
        });
    });

    $(window).unbind('.infscr');

    $('#view-infinite-more').click(function(){
        $container.infinitescroll('retrieve');
        $('#infinite_pagination').show();
        return false;
    });
    <?php } ?>

    $container.imagesLoaded(function() {
        $container.masonry({
            columnWidth: '.gallery-sizer',
            itemSelector: '.gallery-item',
            percentPosition: true
        });
    });

    $(".gallery-box-notice").parent().addClass("masonry-blick-100");
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
            var bo_table = '<?php echo $bo_table; ?>';
            var url = '<?php echo EYOOM_CORE_URL; ?>/board/set_bo_skin.php';
            $.post(url, { bo_table: bo_table, skin: skin }, function() {
                document.location.href = '<?php echo str_replace('&amp;','&', get_pretty_url($bo_table));?>';
            });
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