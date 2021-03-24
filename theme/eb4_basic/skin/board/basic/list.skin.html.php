<?php
/**
 * skin file : /theme/THEME_NAME/skin/board/basic/list.skin.html.php
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
.board-list .eyoom-form .checkbox {padding-left:15px}
.board-list .eyoom-form .checkbox i {top:2px}
.board-list .table-list-eb .table thead > tr > th {border-bottom:1px solid #959595;text-align:center;padding:10px 5px}
.board-list .table-list-eb .table tbody > tr > td {border-top:1px solid #ededed;padding:7px 5px}
.board-list .table-list-eb thead {border-top:2px solid #757575;border-bottom:1px solid #959595}
.board-list .table-list-eb th {color:#000;font-weight:bold;white-space:nowrap;font-size:13px}
.board-list .table-list-eb .td-comment {display:inline-block;white-space:nowrap;vertical-align:baseline;text-align:center;min-width:35px;padding:1px;font-size:10px;line-height:1;color:#fff;background-color:#757575;margin-right:5px}
.board-list .table-list-eb .td-comment .cnt_cmt {margin:0;font-weight:normal}
.board-list .table-list-eb .td-subject {width:300px}
.board-list .table-list-eb .td-subject a {color:#000}
.board-list .table-list-eb .td-subject a:hover {color:#FF4848;text-decoration:underline}
.board-list .table-list-eb .td-subject .fas {color:#FF4848}
.board-list .table-list-eb .td-subject .reply-indication {display:inline-block;width:7px;height:10px;border-left:1px dotted #b5b5b5;border-bottom:1px dotted #b5b5b5}
.board-list .table-list-eb .td-photo {display:inline-block;width:26px;height:26px;margin-right:2px;border:1px solid #e5e5e5;padding:1px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.board-list .table-list-eb .td-photo img {width:100%;height:auto;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.board-list .table-list-eb .td-photo .td-user-icon {width:22px;height:22px;font-size:12px;line-height:22px;text-align:center;background:#959595;color:#fff;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;display:inline-block;white-space:nowrap;vertical-align:baseline;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.board-list .table-list-eb .td-lv-icon {display:inline-block;margin-right:2px}
.board-list .table-list-eb .td-star-icon {display:inline-block;margin-right:2px;margin-bottom:-4px}
.board-list .table-list-eb .td-name b {font-weight:normal;font-size:12px}
.board-list .table-list-eb .td-date {text-align:center;color:#959595;font-size:12px}
.board-list .table-list-eb .td-num {text-align:center;font-size:12px}
.board-list .table-list-eb .table tbody > tr.td-mobile > td {border-top:1px solid #fff;padding:0 0 5px !important;font-size:11px;color:#959595}
.board-list .table-list-eb .td-mobile td {position:relative}
.board-list .table-list-eb .td-mobile td > span {margin-right:5px}
.board-list .table-list-eb .td-mobile td .td-mobile-name b {font-weight:normal}
.board-list .table-list-eb .td-mobile td .td-mobile-time {position:absolute;top:5px;right:0;margin-right:0}
.board-list .star-ratings-list {width:60px;margin:0 auto}
.board-list .star-ratings-list li {padding:0;float:left;margin-right:0}
.board-list .star-ratings-list li .rating {color:#a5a5a5;font-size:10px;line-height:normal}
.board-list .star-ratings-list li .rating-selected {color:#FF4848;font-size:10px}
.board-list .bo_current {color:#FF4848}
.board-list .board-notice {background:#FFF8EC}
.board-list .board-notice .td-subject a {color:#AA3510}
.board-list .board-notice .td-subject a:hover {color:#AA3510}
.board-list .board-btn-adm li {float:left;margin-right:5px}
.board-list .favorite-setup {display:inline-block;width:100px;margin-left:15px}
.board-list .favorite-setup .toggle {padding-right:37px}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width:1199px) {
    .board-list .table-list-eb .td-subject {width:240px}
}
@media (max-width:767px) {
    .board-list .table-list-eb .table tbody > tr > td {padding:10px 0}
    .board-list .table-list-eb .table tbody > tr > td.td-subj-wrap {padding:10px 0}
    .board-list .table-list-eb .td-subject {width:300px}
    .board-list .table-list-eb .td-subject .subject {font-size:13px;font-weight:bold}
}
<?php } ?>
</style>

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
    <div class="table-list-eb margin-bottom-20">
        <div class="board-list-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="hidden-md hidden-sm">번호</th>
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
                        <th class="hidden-xs"><?php echo subject_sort_link('wr_datetime', $qstr2, 1); ?>날짜</a></th>
                        <th class="hidden-xs"><?php echo subject_sort_link('wr_hit', $qstr2, 1); ?>뷰</a></th>
                        <?php if ($is_good) { ?>
                        <th class="hidden-xs"><?php echo subject_sort_link('wr_good', $qstr2, 1); ?>추천</a></th>
                        <?php } ?>
                        <?php if ($is_nogood) { ?>
                        <th class="hidden-xs"><?php echo subject_sort_link('wr_nogood', $qstr2, 1); ?>비추</a></th>
                        <?php } ?>
                        <?php if ($eyoom_board['bo_use_rating'] == '1' && $eyoom_board['bo_use_rating_list'] == '1') { ?>
                        <th class="hidden-xs">별점</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr class="<?php if ($list[$i]['is_notice']) { ?>board-notice<?php } ?>">
                        <td class="td-num hidden-md hidden-sm">
                            <?php if ($list[$i]['is_notice']) { ?>
                            <strong class="color-red">공지</strong>
                            <?php } else if ($wr_id == $list[$i]['wr_id']) { ?>
                            <strong class="color-red">열람</strong>
                            <?php } else { ?>
                            <?php echo number_format($list[$i]['num']); ?>
                            <?php } ?>
                        </td>
                        <?php if ($is_checkbox) { ?>
                        <td>
                            <label for="chk_wr_id_<?php echo $i; ?>" class="sound_only"><?php echo $list[$i]['subject']; ?></label>
                            <label class="checkbox">
                                <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id']; ?>" id="chk_wr_id_<?php echo $i; ?>"><i></i>
                            </label>
                        </td>
                        <?php } ?>
                        <td class="td-subj-wrap">
                            <div class="td-subject ellipsis">
                                <?php if ($list[$i]['icon_reply']) { ?>
                                <span class="reply-indication" style="margin-left:<?php echo $list[$i]['reply']; ?>px;"></span>
                                <?php } ?>
                                <a href="<?php echo $list[$i]['href']; ?>">
                                    <?php if ($list[$i]['wr_comment']) { ?>
                                    <span class="sound_only">댓글</span><span class="td-comment">+<?php echo $list[$i]['wr_comment']; ?></span><span class="sound_only">개</span>
                                    <?php } ?>
                                    <?php if ($is_category && $list[$i]['ca_name']) { ?>
                                    <span class="color-grey margin-right-5">[<?php echo $list[$i]['ca_name']; ?>]</span>
                                    <?php } ?>
                                    <?php if ($list[$i]['icon_new']) { ?>
                                    <i class="fas fa-circle margin-right-5"></i>
                                    <?php } ?>
                                    <?php if ($list[$i]['icon_secret']) { ?>
                                    <i class="fas fa-lock margin-right-5"></i>
                                    <?php } ?>
                                    <?php if ($list[$i]['is_notice']) { ?>
                                    <strong><?php echo $list[$i]['subject']; ?></strong>
                                    <?php } else if ($wr_id == $list[$i]['wr_id']) { ?>
                                    <strong><?php echo $list[$i]['subject']; ?></strong>
                                    <?php } else { ?>
                                    <span class="subject"><?php echo $list[$i]['subject']; ?></span>
                                    <?php } ?>
                                </a>
                            </div>
                        </td>
                        <td class="td-name hidden-xs">
                            <?php if ($eyoom_board['bo_use_profile_photo'] == 1) { ?>
                            <span class="td-photo">
                                <?php if ($list[$i]['mb_photo']) { ?>
                                <?php echo $list[$i]['mb_photo']; ?>
                                <?php } else { ?>
                                <span class="td-user-icon"><i class="fas fa-user"></i></span>
                                <?php } ?>
                            </span>
                            <?php } ?>
                            <?php if ($list[$i]['gnu_icon']) { ?>
                            <span class="td-lv-icon"><img src="<?php echo $list[$i]['gnu_icon']; ?>" align="absmiddle" alt="레벨"></span>
                            <?php } ?>
                            <?php if ($list[$i]['eyoom_icon']) { ?>
                            <span class="td-lv-icon"><img src="<?php echo $list[$i]['eyoom_icon']; ?>" align="absmiddle" alt="레벨"></span>
                            <?php } ?>
                            <span class="td-name-in"><?php echo eb_nameview($list[$i]['mb_id'], $list[$i]['wr_name'], $list[$i]['wr_email'], $list[$i]['homepage']); ?></span>
                        </td>
                        <td class="td-date hidden-xs">
                            <?php if ($eyoom_board['bo_sel_date_type'] == '1') { ?>
                            <?php echo $eb->date_time('Y.m.d', $list[$i]['wr_datetime']); ?>
                            <?php } else if ($eyoom_board['bo_sel_date_type'] == '2') { ?>
                            <?php echo $eb->date_format('Y.m.d', $list[$i]['wr_datetime']); ?>
                            <?php } ?>
                        </td>
                        <td class="td-num hidden-xs"><?php echo number_format($list[$i]['wr_hit']); ?></td>
                        <?php if ($is_good) { ?>
                        <td class="td-num hidden-xs color-green"><?php echo number_format($list[$i]['wr_good']); ?></td>
                        <?php } ?>
                        <?php if ($is_nogood) { ?>
                        <td class="td-num hidden-xs  color-yellow"><?php echo number_format($list[$i]['wr_nogood']); ?></td>
                        <?php } ?>
                        <?php if ($eyoom_board['bo_use_rating'] == '1' && $eyoom_board['bo_use_rating_list'] == '1') { ?>
                        <td class="hidden-xs">
                            <ul class="list-unstyled star-ratings-list">
                                <li><i class="<?php if ($list[$i]['star'] <= 0) { ?>rating far fa-star<?php } else if ($list[$i]['star'] > 0.3 && $list[$i]['star'] <= 0.7) { ?>rating-selected fas fa-star-half<?php } else if ($list[$i]['star'] > 0.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
                                <li><i class="<?php if ($list[$i]['star'] <= 1) { ?>rating far fa-star<?php } else if ($list[$i]['star'] > 1.3 && $list[$i]['star'] <= 1.7) { ?>rating-selected fas fa-star-half<?php } else if ($list[$i]['star'] > 1.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
                                <li><i class="<?php if ($list[$i]['star'] <= 2) { ?>rating far fa-star<?php } else if ($list[$i]['star'] > 2.3 && $list[$i]['star'] <= 2.7) { ?>rating-selected fas fa-star-half<?php } else if ($list[$i]['star'] > 2.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
                                <li><i class="<?php if ($list[$i]['star'] <= 3) { ?>rating far fa-star<?php } else if ($list[$i]['star'] > 3.3 && $list[$i]['star'] <= 3.7) { ?>rating-selected fas fa-star-half<?php } else if ($list[$i]['star'] > 3.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
                                <li><i class="<?php if ($list[$i]['star'] <= 4) { ?>rating far fa-star<?php } else if ($list[$i]['star'] > 4.3 && $list[$i]['star'] <= 4.7) { ?>rating-selected fas fa-star-half<?php } else if ($list[$i]['star'] > 4.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
                            </ul>
                        </td>
                        <?php } ?>
                    </tr>
                    <tr class="td-mobile visible-xs"><?php /* 767px 이하에서만 보임 */ ?>
                        <td colspan="<?php echo $colspan; ?>">
                            <?php if ($eyoom_board['bo_use_profile_photo'] == 1) { ?>
                            <span class="td-photo">
                                <?php if ($list[$i]['mb_photo']) { ?><?php echo $list[$i]['mb_photo']; ?><?php } else { ?><span class="td-user-icon"><i class="fas fa-user"></i></span><?php } ?>
                            </span>
                            <?php } ?>
                            <?php if ($list[$i]['gnu_icon']) { ?>
                            <span class="td-lv-icon"><img src="<?php echo $list[$i]['gnu_icon']; ?>" align="absmiddle" alt="레벨"></span>
                            <?php } ?>
                            <?php if ($list[$i]['eyoom_icon']) { ?>
                            <span class="td-lv-icon"><img src="<?php echo $list[$i]['eyoom_icon']; ?>" align="absmiddle" alt="레벨"></span>
                            <?php } ?>
                            <span class="td-mobile-name"><?php echo eb_nameview($list[$i]['mb_id'], $list[$i]['wr_name'], $list[$i]['wr_email'], $list[$i]['homepage']); ?></span>
                            <span><i class="fas fa-eye"></i> <?php echo number_format($list[$i]['wr_hit']); ?></span>
                            <?php if ($is_good) { ?>
                            <span><i class="far fa-thumbs-up"></i> <?php echo number_format($list[$i]['wr_good']); ?></span>
                            <?php } ?>
                            <?php if ($is_nogood) { ?>
                            <span><i class="far fa-thumbs-down"></i> <?php echo number_format($list[$i]['wr_nogood']); ?></span>
                            <?php } ?>
                            <?php if ($eyoom_board['bo_sel_date_type'] == '1') { ?>
                            <span class="td-mobile-time"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y.m.d', $list[$i]['wr_datetime']); ?></span>
                            <?php } else if ($eyoom_board['bo_sel_date_type'] == '2') { ?>
                            <span class="td-mobile-time"><i class="far fa-clock"></i> <?php echo $eb->date_format('Y.m.d', $list[$i]['wr_datetime']); ?></span>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if (count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="<?php echo $colspan; ?>" class="text-center"><span class="color-grey"><i class="fas fa-exclamation-circle"></i> 게시물이 없습니다.</span></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
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

<?php if ($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert/sweetalert.min.js"></script>
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