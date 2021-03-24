<?php
/**
 * skin file : /theme/THEME_NAME/skin/board/webzine/view.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert/sweetalert.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/magnific-popup/magnific-popup.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/prism/prism.min.css" type="text/css" media="screen">',0);
?>

<style>
.board-view .board-setup {position:relative;border:1px solid #d5d5d5;height:30px;margin-bottom:20px}
.board-view .board-setup .select {position:absolute;top:-1px;left:-1px;display:inline-block;width:200px}
.board-view .board-setup-btn-box {position:absolute;top:-1px;right:-1px;display:inline-block;width:420px}
.board-view .board-setup-btn {float:left;width:25%;height:30px;line-height:30px;color:#fff;text-align:center;font-size:12px}
.board-view .board-setup-btn:nth-child(odd) {background:#59595B}
.board-view .board-setup-btn:nth-child(even) {background:#676769}
.board-view .board-setup-btn:hover {opacity:0.8}
.board-view .board-view-info {position:relative;box-sizing:content-box;height:46px;border-top:2px solid #757575;border-bottom:1px solid #d5d5d5;padding:7px 0;margin-top:15px;background:#fafafa}
.board-view .board-view-info .view-photo-box {position:absolute;top:7px;left:0}
.board-view .board-view-info .view-info-box {position:relative;<?php if($eyoom_board['bo_use_profile_photo'] == 1) { ?>margin-left:56px<?php } ?>}
.board-view .board-view-info .view-member-progress {position:absolute;top:10px;right:0;width:150px}
.board-view .board-view-info .view-photo img {width:46px;height:46px;margin-right:3px;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.board-view .board-view-info .view-photo .view-user-icon {width:46px;height:46px;font-size:26px;line-height:46px;text-align:center;background:#757575;color:#fff;margin-right:3px;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important;display:inline-block;white-space:nowrap;vertical-align:baseline}
.board-view .board-view-info .info-box-top {display:block;margin:3px 0 5px}
.board-view .board-view-info .info-box-top .view-nick {font-size:13px;margin-right:3px}
.board-view .board-view-info .info-box-top .view-lv-icon {display:inline-block;margin-right:3px}
.board-view .board-view-info .info-box-bottom {display:block;font-size:11px}
.board-view .board-view-info .info-box-bottom span {margin-right:7px}
.board-view .board-view-info .info-box-bottom i {color:#a5a5a5;margin-right:4px}
.board-view .board-view-file {font-size:11px}
.board-view .board-view-file ul {margin-bottom:0}
.board-view .board-view-file li {padding:7px 0;border-bottom:1px dotted #e5e5e5}
.board-view .board-view-file a:hover {text-decoration:underline}
.board-view .board-view-file span {margin-left:7px}
.board-view .board-view-file span i {margin-right:4px;color:#b5b5b5}
.board-view .board-view-link {font-size:11px}
.board-view .board-view-link ul {margin-bottom:0}
.board-view .board-view-link li {padding:7px 0;border-bottom:1px dotted #e5e5e5}
.board-view .board-view-link a {text-decoration:underline}
.board-view .board-view-link a:hover {color:#6284F3}
.board-view .board-view-star {position:relative;padding:7px 0;border-bottom:1px dotted #e5e5e5;font-size:11px}
.board-view .board-view-star .star-ratings-view {display:inline-block;margin-bottom:0;margin-right:15px;float:left}
.board-view .board-view-star .star-ratings-view li {padding:0;float:left;margin-right:0}
.board-view .board-view-star .star-ratings-view li .rating {color:#a5a5a5;line-height:normal}
.board-view .board-view-star .star-ratings-view li .rating-selected {color:#FF4848}
.board-view .board-view-star .collapse-rating-result-panel {position:relative;border:1px solid #e5e5e5;background:#fff;padding:10px;margin:7px 0 3px}
.board-view .board-view-star .collapse-rating-result-panel > span:after {content:"|";margin:0 3px;color:#d5d5d5}
.board-view .board-view-star .collapse-rating-result-panel > span:last-child:after {display:none}
.board-view .board-view-star .collapse-rating-result-panel span a {color:#757575}
.board-view .board-view-star .collapse-rating-result-panel span.active a {color:#FF4848}
.board-view .eyoom-form .rating {display:inline-block;float:left;width:120px;margin-top:-3px;font-size:11px}
.board-view .eyoom-form .rating label {margin-top:3px}
.board-view .eyoom-form .rating label .fas {font-size:11px}
.board-view .eyoom-form .rating strong {color:#FF4848}
.board-view .eyoom-form .rating-mobile {position:absolute;top:10px;left:50%;display:inline-block;float:left;width:160px;margin-top:0;margin-left:-80px}
.board-view .eyoom-form .rating-mobile label {margin:0;width:32px;height:28px;line-height:28px;padding:0}
.board-view .eyoom-form .rating-mobile label .fas {font-size:26px}
.board-view .rating-mb-photo, .board-view .good-mb-photo {display:inline-block;width:26px;height:26px;margin-right:2px;border:1px solid #e5e5e5;padding:1px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.board-view .rating-mb-photo img, .board-view .good-mb-photo img {width:100%;height:auto;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.board-view .rating-mb-photo .rating-user-icon, .board-view .good-mb-photo .good-user-icon {width:22px;height:22px;font-size:12px;line-height:22px;text-align:center;background:#959595;color:#fff;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;display:inline-block;white-space:nowrap;vertical-align:baseline;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.board-view .board-view-star .collapse-rating-mo-btn {margin:10px 0}
.board-view .board-view-star .collapse-rating-panel {position:relative;border:1px solid #e5e5e5;background:#fff;height:50px;margin:5px 0 10px}
.board-view .board-view-short-url {font-size:11px}
.board-view .board-view-short-url ul {margin-bottom:0}
.board-view .board-view-short-url li {padding:5px 0;border-bottom:1px dotted #e5e5e5}
.board-view .board-view-short-url a:hover {text-decoration:underline}
.board-view .board-view-btn-wrap {position:relative;height:34px;border-bottom:2px solid #e5e5e5}
.board-view .board-view-btn-left {position:absolute;top:5px;left:0}
.board-view .board-view-btn-right {position:absolute;top:5px;right:0}
.board-view .board-view-btn {position:relative;float:left;padding:0 15px;height:22px;line-height:22px;cursor:pointer;background:#959595;font-size:11px;color:#fff}
.board-view .board-view-btn.board-pin-btn i {color:#fff;margin-right:5px}
.board-view .board-view-btn.board-pin-btn:hover {background:#2B2B2E !important}
.board-view .board-view-btn.board-pin-btn:hover i {color:#86A0F7}
.board-view .view-top-btn {padding:20px 0 5px}
.board-view .view-top-btn:after {display:block;visibility:hidden;clear:both;content:""}
.board-view .view-top-btn .top-btn-left li {float:left;margin-right:5px}
.board-view .view-top-btn .top-btn-right li {float:left;margin-left:5px;margin-bottom:5px}
.board-view .board-view-atc {min-height:200px}
.board-view .board-view-atc-title {position:absolute;font-size:0;line-height:0;overflow:hidden}
.board-view .board-view-file-conts {position:relative;overflow:hidden}
.board-view .board-view-file-conts #bo_v_img img {display:block;width:100% \9;max-width:100%;height:auto;margin-bottom:10px}
.board-view .board-view-con {position:relative;overflow:hidden;margin-bottom:30px;width:100%;word-break:break-all}
.board-view .board-view-con img {max-width:100%;height:auto}
.board-view .board-view-good-btn {margin-bottom:30px;text-align:center}
.board-view .board-view-good-btn .board-view-act-gng {position:relative;margin:0 5px}
.board-view .board-view-good-btn .board-view-act-gng .act-gng-btn {position:relative;overflow:hidden;width:70px;height:70px;border:1px solid #d5d5d5;background:#fff;display:inline-block;white-space:nowrap;vertical-align:baseline;text-align:center}
.board-view .board-view-good-btn .board-view-act-gng .act-gng-btn i {font-size:26px;color:#757575;margin:12px 0 3px}
.board-view .board-view-good-btn .board-view-act-gng .act-gng-btn:hover {border:1px solid #b5b5b5}
.board-view .board-view-good-btn .board-view-act-gng .act-gng-btn:hover i {color:#000}
.board-view .board-view-good-btn .board-view-act-gng .act-gng-btn.disabled:hover {border:1px solid #d5d5d5}
.board-view .board-view-good-btn .board-view-act-gng .act-gng-btn.disabled:hover i {color:#757575}
.board-view .board-view-good-btn .board-view-act-gng .act-gng-btn strong {font-size:12px;color:#757575}
.board-view .board-view-good-btn .board-view-act-gng .act-gng-btn:hover strong {color:#252525}
.board-view .board-view-good-btn .board-view-act-gng .act-gng-btn .mask {width:100%;height:100%;position:absolute;overflow:hidden;top:0;left:0;background:#fff;opacity:0}
.board-view .board-view-good-btn .board-view-act-gng .act-gng-btn h5 {color:#000;font-size:13px;font-weight:bold;text-align:center;margin-top:43px;background:transparent;-webkit-transform:scale(0);-moz-transform:scale(0);-o-transform:scale(0);-ms-transform:scale(0);transform:scale(0);-webkit-transition:all 0.2s linear;-moz-transition:all 0.2s linear;-o-transition:all 0.2s linear;-ms-transition:all 0.2s linear;transition:all 0.2s linear;opacity:0}
.board-view .board-view-good-btn .board-view-act-gng .act-gng-btn:hover .mask {opacity:0.9}
.board-view .board-view-good-btn .board-view-act-gng .act-gng-btn:hover h5 {-webkit-transform:scale(1);-moz-transform:scale(1);-o-transform:scale(1);-ms-transform:scale(1);transform:scale(1);opacity:1}
.board-view .board-view-act-good,.board-view-act-nogood {display:none;position:absolute;top:30px;left:0;padding:5px 0;width:165px;background:#000;color:#fff;text-align:center}
.board-view .board-view-good-member {position:relative;background:#fff;border:1px solid #e5e5e5;padding:10px;margin-bottom:10px;font-size:11px}
.board-view .board-view-good-member h6 {position:relative;text-align:center;font-size:12px;margin:0 0 16px}
.board-view .board-view-good-member h6:after {content:"";display:block;position:absolute;bottom:-8px;left:50%;width:12px;height:1px;margin-left:-6px;background:#FDAB29}
.board-view .board-view-good-member > span:after {content:"|";margin:0 3px;color:#d5d5d5}
.board-view .board-view-good-member > span:last-child:after {display:none}
.board-view .board-view-good-member span a {color:#757575}
.board-view .board-view-bot {zoom:1}
.board-view .board-view-bot:after {display:block;visibility:hidden;clear:both;content:""}
.board-view .board-view-bot h2 {position:absolute;font-size:0;line-height:0;overflow:hidden}
.board-view .board-view-bot ul {margin:0;padding:0;list-style:none}
.board-view .blind {display:none}
.board-view .map-content-wrap {width:100%;height:350px}
.board-view .map-content-wrap > div {width:100%;height:350px}
.board-view .board-view-tag {position:relative;overflow:hidden;background:#fafafa;border:1px solid #d5d5d5;padding:5px;margin-top:20px}
.board-view .board-view-tag span {display:inline-block;padding:2px 8px;line-height:1;margin:2px;background:#e5e5e5;font-size:11px;border-radius:2px !important}
.board-view .board-view-tag a:hover span {background:#757575;color:#fff}
.board-view .board-view-tag .fa-tags {width:22px;height:16px;line-height:16px;text-align:center;font-size:12px;color:#353535;margin-right:5px;box-sizing:content-box}
.board-view .view-area-divider {position:relative;height:1px;border-top:1px solid #d5d5d5;margin:30px 0}
.board-view .view-area-divider .divider-circle {position:absolute;top:-7px;left:50%;margin-left:-7px;width:14px;height:14px;border:2px solid #d5d5d5;background:#fff;z-index:1px;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.board-view pre {font-size:12px}
.board-view .caption-overflow span {left:0;right:0}
.draggable {display:block;width:100% \9;max-width:100%;height:auto;margin:0 auto}
button.mfp-close {position:fixed;color:#fff !important}
.mfp-figure .mfp-close {position:absolute}
<?php if ($wmode) { ?>
.board-view {width:100%;overflow:hidden}
<?php } ?>
</style>

<article class="board-view">
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

    <h4>
        <?php if ($category_name) { ?>
        <span class="color-grey margin-right-5">[<?php echo $view['ca_name'] ?>]</span>
        <?php } ?>
        <strong><?php echo cut_str(get_text($view['wr_subject']), 70); ?></strong>
    </h4>
    <div class="board-view-info">
        <?php if ($eyoom_board['bo_use_profile_photo'] == 1) { ?>
        <div class="view-photo-box">
            <?php if ($view['mb_photo']) { ?>
            <span class="view-photo margin-right-5"><?php echo $view['mb_photo'] ?></span>
            <?php } else { ?>
            <span class="view-photo margin-right-5"><span class="view-user-icon"><i class="fas fa-user"></i></span></span>
            <?php } ?>
        </div>
        <?php } ?>
        <div class="view-info-box">
            <div class="info-box-top">
                <span class="view-nick">
                    <?php echo eb_nameview($view['mb_id'], $view['wr_name'], $view['wr_email'], $view['wr_homepage']); ?>
                </span>
                <?php if ($lv['gnu_icon']) { ?>
                <span class="view-lv-icon"><img src="<?php echo $lv['gnu_icon']; ?>" align="absmiddle" alt="레벨"></span>
                <?php } ?>
                <?php if ($lv['eyoom_icon']) { ?>
                <span class="view-lv-icon"><img src="<?php echo $lv['eyoom_icon']; ?>" align="absmiddle" alt="레벨"></span>
                <?php } ?>
                <?php if ($is_ip_view) { ?>
                <span class="margin-left-5 color-grey font-size-11"><?php echo $ip; ?></span>
                <?php } ?>
            </div>
            <div class="info-box-bottom">
                <?php if ($eyoom_board['bo_sel_date_type'] == '1') { ?>
                <span class="color-black"><i class="fas fa-clock"></i><?php echo $eb->date_time('Y.m.d H:i',$view['wr_datetime']); ?></span>
                <?php } else if ($eyoom_board['bo_sel_date_type'] == '2') { ?>
                <span><i class="fas fa-clock"></i><?php echo $eb->date_format('Y.m.d H:i',$view['wr_datetime']); ?></span>
                <?php } ?>
                <span><i class="fas fa-eye"></i><?php echo number_format($view['wr_hit']); ?></span>
                <span class="color-red"><i class="fas fa-comment-alt"></i><?php echo number_format($view['wr_comment']); ?></span>
                <?php if ($is_good) { ?>
                <span>
                    <i class="fas fa-thumbs-up"></i><?php echo number_format($view['wr_good']); ?>
                </span>
                <?php } ?>
                <?php if ($is_nogood ) { ?>
                <span>
                    <i class="fas fa-thumbs-down"></i><?php echo number_format($view['wr_nogood']); ?>
                </span>
                <?php } ?>
            </div>
        </div>
        <?php if ($eyoom['is_community_theme'] == 'y') { ?>
        <div class="view-member-progress hidden-xs">
            <span class="progress-info-left"><small>LV.<strong><?php echo $lvuser['level']; ?></strong></small></span>
            <span class="progress-info-right"><small><?php echo $lvuser['ratio']; ?>%</small></span>
            <div class="progress progress-e progress-xs rounded progress-striped active">
                <div class="progress-bar progress-bar-indigo" role="progressbar" aria-valuenow="<?php echo $lvuser['ratio']; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $lvuser['ratio']; ?>%">
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

    <?php if ($cnt > 0) { ?>
    <?php /* 첨부파일 시작 */?>
    <div class="board-view-file">
        <ul class="list-unstyled">
        <?php for ($i=0; $i<count((array)$view_file); $i++) { ?>
            <li>
                <div class="pull-left">
                    - 첨부파일 : <strong><?php echo $view_file[$i]['source']; ?></strong> <?php echo $view_file[$i]['content']; ?> (<?php echo $view_file[$i]['size']; ?>) - <a href="<?php echo $view_file[$i]['href']; ?>" class="view_file_download"><u>다운로드</u></a>
                </div>
                <div class="pull-right text-right hidden-xs">
                    <span><i class="fas fa-download"></i><?php echo $view_file[$i]['download']; ?></span>
                    <span><i class="far fa-clock"></i><?php echo $view_file[$i]['datetime']; ?></span>
                </div>
                <div class="clearfix"></div>
            </li>
        <?php } ?>
        </ul>
    </div>
    <?php /* 첨부파일 끝 */?>
    <?php } ?>

    <?php if (count((array)$view_link) >0) { ?>
    <?php /* 관련링크 시작 */?>
    <div class="board-view-link">
        <ul class="list-unstyled">
        <?php foreach ($view_link as $k => $vlink) { ?>
            <li>
                <div class="pull-left">
                    - 관련링크 : <a href="<?php echo $vlink['href']; ?>" target="_blank"><?php echo $vlink['link']; ?></a>
                </div>
                <div class="pull-right text-right">
                    <span><?php echo $vlink['hit']; ?>회 연결</span>
                </div>
                <div class="clearfix"></div>
            </li>
        <?php } ?>
        </ul>
    </div>
    <?php /* 관련링크 끝 */?>
    <?php } ?>

    <?php /* 별점평가 시작 */?>
    <?php if ($eyoom_board['bo_use_rating'] == '1') { ?>
    <div class="board-view-star">
        <div class="rating-average">
            - 별점참여 : 전체 <span class="color-red"><?php echo number_format($rating['members']); ?></span> 명
        </div>
    </div>
    <div class="board-view-star">
        <ul class="list-unstyled star-ratings-view">
            <li><span class="margin-right-10">- 별점평가 : 평점</span></li>
            <li><i class="<?php if ($rating['point'] <= 0) { ?>rating far fa-star<?php } else if ($rating['point'] > 0.3 && $rating['point'] <= 0.7) { ?>rating-selected fas fa-star-half<?php } else if ($rating['point'] > 0.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
            <li><i class="<?php if ($rating['point'] <= 1) { ?>rating far fa-star<?php } else if ($rating['point'] > 1.3 && $rating['point'] <= 1.7) { ?>rating-selected fas fa-star-half<?php } else if ($rating['point'] > 1.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
            <li><i class="<?php if ($rating['point'] <= 2) { ?>rating far fa-star<?php } else if ($rating['point'] > 2.3 && $rating['point'] <= 2.7) { ?>rating-selected fas fa-star-half<?php } else if ($rating['point'] > 2.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
            <li><i class="<?php if ($rating['point'] <= 3) { ?>rating far fa-star<?php } else if ($rating['point'] > 3.3 && $rating['point'] <= 3.7) { ?>rating-selected fas fa-star-half<?php } else if ($rating['point'] > 3.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
            <li><i class="<?php if ($rating['point'] <= 4) { ?>rating far fa-star<?php } else if ($rating['point'] > 4.3 && $rating['point'] <= 4.7) { ?>rating-selected fas fa-star-half<?php } else if ($rating['point'] > 4.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
            <li class="margin-left-5">- [ <span class="color-red"><?php echo $rating['point']; ?></span>점 ]</li>
        </ul>

        <?php if ($is_member && !$my_rating['rating']) { ?>
        <div class="eyoom-form hidden-xs">
            <div class="rating">
                <input type="radio" name="quality" id="quality-5" value="5">
                <label for="quality-5"><i class="fas fa-star"></i></label>
                <input type="radio" name="quality" id="quality-4" value="4">
                <label for="quality-4"><i class="fas fa-star"></i></label>
                <input type="radio" name="quality" id="quality-3" value="3">
                <label for="quality-3"><i class="fas fa-star"></i></label>
                <input type="radio" name="quality" id="quality-2" value="2">
                <label for="quality-2"><i class="fas fa-star"></i></label>
                <input type="radio" name="quality" id="quality-1" value="1">
                <label for="quality-1"><i class="fas fa-star"></i></label>
                <strong>평가하기</strong>
            </div>
        </div>
        <?php } ?>

        <?php if ($eyoom_board['bo_use_rating_member'] == '1' && $rating['members'] > 0 && is_array($mb_rating)) { ?>
        <a href="#collapse-rating-result" data-toggle="collapse" class="btn-e btn-e-xs btn-e-default margin-left-10">평가회원보기</a>
        <div id="collapse-rating-result" class="collapse-rating-result-panel collapse">
            <?php foreach ($mb_rating as $mb_id => $rinfo) { ?>
            <span <?php echo $mb_id == $member['mb_id'] ? 'class="active"': ''; ?>>
                <?php if ($eyoom_board['bo_use_profile_photo'] == 1) { ?>
                <span class="rating-mb-photo">
                    <?php if ($rinfo['mb_photo']) { ?>
                    <?php echo $rinfo['mb_photo']; ?>
                    <?php } else { ?>
                    <span class="rating-user-icon"><i class="fas fa-user"></i></span>
                    <?php } ?>
                </span>
                <?php } ?>
                <?php echo eb_nameview($rinfo['mb_id'], $rinfo['mb_nick'], $rinfo['mb_email'], $rinfo['mb_homepage']); ?><?php echo ($mb_id == $member['mb_id'] && $eyoom_board['bo_use_rating_score'] != '1') || $eyoom_board['bo_use_rating_score'] == '1' ? '('.number_format($rinfo['rating']).')':''; ?>
            </span>
            <?php } ?>
        </div>
        <?php } ?>

        <?php if ($my_rating['rating']) { ?>
        <div class="color-grey margin-top-5">- <i class="fas fa-exclamation-circle"></i> 이미 참여한 별점평가</div>
        <?php } ?>

        <?php if ($is_member && !$is_member) { ?>
        <div class="color-grey margin-top-5">- <i class="fas fa-exclamation-circle"></i> 로그인 후 평가 가능</div>
        <?php } ?>
        <div class="clearfix"></div>

        <?php if ($is_member && !$my_rating['rating']) { // 모바일 별점평가 영역 ?>
        <a href="#collapse-board-rating" data-toggle="collapse" class="collapse-rating-mo-btn btn-e btn-e-dark hidden-lg hidden-md hidden-sm">별점평가하기</a>
        <div id="collapse-board-rating" class="collapse-rating-panel collapse hidden-lg hidden-md hidden-sm">
            <div class="eyoom-form">
                <div class="rating rating-mobile">
                    <input type="radio" name="quality" id="quality-5" value="5">
                    <label for="quality-5"><i class="fas fa-star"></i></label>
                    <input type="radio" name="quality" id="quality-4" value="4">
                    <label for="quality-4"><i class="fas fa-star"></i></label>
                    <input type="radio" name="quality" id="quality-3" value="3">
                    <label for="quality-3"><i class="fas fa-star"></i></label>
                    <input type="radio" name="quality" id="quality-2" value="2">
                    <label for="quality-2"><i class="fas fa-star"></i></label>
                    <input type="radio" name="quality" id="quality-1" value="1">
                    <label for="quality-1"><i class="fas fa-star"></i></label>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php } ?>
    </div>
    <?php } ?>
    <?php /* 별점평가 끝 */?>

    <?php if ($is_member) { // 회원일 경우 ?>
    <div class="board-view-btn-wrap">
        <div class="board-view-btn-left">
        <?php if ($copy_href) { ?>
            <a href="<?php echo $copy_href; ?>" class="board-view-btn bg-light" onclick="board_move(this.href); return false;">복사</a>
        <?php } ?>
        <?php if ($move_href) { ?>
            <a href="<?php echo $move_href; ?>" class="board-view-btn bg-light dark" onclick="board_move(this.href); return false;">이동</a>
        <?php } ?>
        </div>

        <div class="board-view-btn-right">
        <?php if ($eyoom_board['bo_use_yellow_card'] == '1') { ?>
            <?php if (!$mb_ycard['mb_id']) { ?>
            <span id="yellow_card" class="board-view-btn bg-dark" data-toggle="modal" data-target=".yellowcard-modal">신고 <span class="badge badge-red rounded-x"><?php echo number_format($eb_5['yc_count']); ?></span></span>
            <?php } else { ?>
            <span id="cancel_yellow_card" class="board-view-btn bg-dark">신고 취소 <span class="badge badge-red rounded-x"><?php echo number_format($eb_5['yc_count']); ?></span></span>
            <?php } ?>
            <?php if ($blind_direct) { ?>
                <?php if ($eb_5['yc_blind'] != 'y') { ?>
            <span id="direct_blind" class="board-view-btn bg-dark lighter btn-blind">블라인드</span>
                <?php } else if ($eb_5['yc_blind'] == 'y') { ?>
            <span id="cancel_blind" class="board-view-btn bg-dark lighter btn-blind">블라인드 취소</span>
                <?php } ?>
            <?php } ?>
        <?php } ?>

        <?php if ($scrap_href) { ?>
            <a href="<?php echo $scrap_href; ?>" target="_blank" class="board-view-btn bg-yellow light" onclick="win_scrap(this.href); return false;">스크랩</a>
        <?php } ?>
        <?php if (!$pininfo) { ?>
            <span id="save_pin" class="board-view-btn board-pin-btn bg-dark light"><i class="fas fa-thumbtack"></i>핀 <span id="pin-text">저장</span></span>
        <?php } else { ?>
            <span id="cancel_pin" class="board-view-btn board-pin-btn bg-default light"><i class="fas fa-thumbtack"></i>핀 <span id="pin-text">해제</span></span>
        <?php } ?>
        </div>
    </div>
    <?php } ?>

    <?php /* 태그 시작 */?>
    <?php if ($eyoom['use_tag'] == 'y' && $eyoom_board['bo_use_tag'] == '1' && count((array)$view_tags) > 0) { ?>
    <div class="board-view-tag">
        <i class="fas fa-tags"></i>
        <?php for ($i=0; $i<count((array)$view_tags); $i++) { ?>
        <a href="<?php echo $view_tags[$i]['href']; ?>"><span><?php echo $view_tags[$i]['tag']; ?></span></a>
        <?php } ?>
        <div class="clearfix"></div>
    </div>
    <?php } ?>
    <?php /* 태그 끝 */?>

    <?php /* 게시물 상단 버튼 시작 */?>
    <div class="view-top-btn">
        <?php if ($prev_href || $next_href) { ?>
        <ul class="top-btn-left list-unstyled pull-left">
            <?php if ($prev_href) { ?>
            <li><a href="<?php echo $prev_href; ?>" class="btn-e btn-e-default" type="button">이전글</a></li>
            <?php } ?>
            <?php if ($next_href) { ?>
            <li><a href="<?php echo $next_href; ?>" class="btn-e btn-e-default" type="button">다음글</a></li>
            <?php } ?>
        </ul>
        <?php } ?>

        <ul class="top-btn-right list-unstyled pull-right">
            <?php if ($search_href) { ?>
            <li><a href="<?php echo $search_href; ?>" class="btn-e btn-e-dark" type="button">검색</a></li>
            <?php } ?>
            <?php if ($update_href) { ?>
            <li><a href="<?php echo $update_href; ?>" class="btn-e btn-e-dark" type="button">수정</a></li>
            <?php } ?>
            <?php if ($delete_href) { ?>
            <li><a href="<?php echo $delete_href; ?>" class="btn-e btn-e-dark" type="button" onclick="del(this.href); return false;">삭제</a></li>
            <?php } ?>
            <?php if (!$wmode) { ?>
            <li><a href="<?php echo $list_href; ?>" class="btn-e btn-e-dark" type="button">목록</a></li>
                <?php if ($reply_href) { ?>
            <li><a href="<?php echo $reply_href; ?>" class="btn-e btn-e-dark" type="button">답변</a></li>
                <?php } ?>
                <?php if ($write_href) { ?>
            <li><a href="<?php echo $write_href; ?>" class="btn-e btn-e-red" type="button">글쓰기</a></li>
                <?php } ?>
            <?php } ?>
        </ul>
        <div class="clearfix"></div>
    </div>
    <?php /* 게시물 상단 버튼 끝 */?>

    <div class="board-view-atc">
        <h2 class="board-view-atc-title">본문</h2>
        <div class="board-view-file-conts">
            <?php echo $file_conts; ?>
        </div>

        <?php /* 본문 내용 시작 */?>
        <?php if ($eb_5['yc_blind'] == 'y') { ?>
            <p class="text-center margin-top-40 margin-bottom-40"><strong class="color-red font-size-13">----- <i class="fas fa-exclamation-circle"></i> 블라인드 처리된 글입니다. -----</strong></p>
        <?php } ?>
        <div class="board-view-con view-content"><?php echo $view_content; ?></div>
        <?php /* 본문 내용 끝 */?>

        <?php /* 추천 비추천 시작 */?>
        <?php if ($good_href || $nogood_href) { ?>
            <div class="board-view-good-btn">
                <div class="margin-bottom-10">
                    <?php if ($good_href) { ?>
                    <span class="board-view-act-gng">
                        <a href="<?php echo $good_href; ?>&amp;<?php echo $qstr; ?>" id="good_button" class="act-gng-btn" type="button"><i class="far fa-thumbs-up display-block"></i><strong><?php echo number_format($view['wr_good']); ?></strong><div class="mask"><h5>추천</h5></div></a>
                        <b class="board-view-act-good"></b>
                    </span>
                    <?php } ?>
                    <?php if ($nogood_href) { ?>
                    <span class="board-view-act-gng">
                        <a href="<?php echo $nogood_href; ?>&amp;<?php echo $qstr; ?>" id="nogood_button" class="act-gng-btn" type="button"><i class="far fa-thumbs-down display-block"></i><strong><?php echo number_format($view['wr_nogood']); ?></strong><div class="mask"><h5>비추천</h5></div></a>
                        <b class="board-view-act-nogood"></b>
                    </span>
                    <?php } ?>
                </div>
                <?php if ($goodinfo && $is_member) { ?>
                <div class="text-center color-grey font-size-11 margin-bottom-10"><i class="fas fa-exclamation-circle"></i> 이미 <?php echo $goodinfo['bg_flag'] == 'good' ? '추천': '비추천';?>하였습니다. [참여일 : <?php echo $goodinfo['bg_datetime']; ?>]</div>
                <?php } ?>
                <?php if ($eyoom_board['bo_use_good_member'] == '1' && $board['bo_use_good'] && count((array)$goods) > 0) { ?>
                <a href="#collapse-good" data-toggle="collapse" class="btn-e btn-e-xs btn-e-default">추천한 회원 보기</a>
                <?php } ?>
                <?php if ($eyoom_board['bo_use_nogood_member'] == '1' && $board['bo_use_nogood'] && count((array)$nogoods) > 0) { ?>
                <a href="#collapse-nogood" data-toggle="collapse" class="btn-e btn-e-xs btn-e-default">비추천 회원 보기</a>
                <?php } ?>
            </div>
        <?php } else { ?>
            <?php if ($board['bo_use_good'] || $board['bo_use_nogood']) { ?>
            <div class="board-view-good-btn">
                <div class="margin-bottom-10">
                    <?php if ($board['bo_use_good']) { ?>
                    <span class="board-view-act-gng">
                        <span class="act-gng-btn disabled"><i class="far fa-thumbs-up display-block"></i><strong><?php echo number_format($view['wr_good']); ?></strong></span>
                    </span>
                    <?php } ?>
                    <?php if ($board['bo_use_nogood']) { ?>
                    <span class="board-view-act-gng">
                        <span class="act-gng-btn disabled"><i class="far fa-thumbs-down display-block"></i><strong><?php echo number_format($view['wr_nogood']); ?></strong></span>
                    </span>
                    <?php } ?>
                </div>
                <div class="text-center color-grey font-size-11 margin-bottom-10"><i class="fas fa-exclamation-circle"></i> 로그인 후 추천 또는 비추천하실 수 있습니다.</div>
                <?php if ($eyoom_board['bo_use_good_member'] == '1' && $board['bo_use_good'] && count((array)$goods) > 0) { ?>
                <a href="#collapse-good" data-toggle="collapse" class="btn-e btn-e-xs btn-e-default">추천한 회원 보기</a>
                <?php } ?>
                <?php if ($eyoom_board['bo_use_nogood_member'] == '1' && $board['bo_use_nogood'] && count((array)$nogoods) > 0) { ?>
                <a href="#collapse-nogood" data-toggle="collapse" class="btn-e btn-e-xs btn-e-default">비추천 회원 보기</a>
                <?php } ?>
            </div>
            <?php } ?>
        <?php } ?>

        <?php if ($eyoom_board['bo_use_good_member'] == '1' && $board['bo_use_good'] && count((array)$goods) > 0) { ?>
        <div id="collapse-good" class="board-view-good-member collapse">
            <h6>추천한 회원</h6>
            <?php foreach ($goods as $k => $gmember) { ?>
            <span>
                <?php if ($eyoom_board['bo_use_profile_photo'] == 1) { ?>
                <span class="good-mb-photo">
                    <span class="good-photo margin-right-5">
                    <?php if ($gmember['mb_photo']) { ?>
                    <?php echo $gmember['mb_photo'] ?>
                    <?php } else { ?>
                    <span class="good-user-icon"><i class="fas fa-user"></i></span>
                    <?php } ?>
                    </span>
                </span>
                <?php } ?>
                <span class="view-nick">
                    <?php echo eb_nameview($gmember['mb_id'], $gmember['mb_nick'], $gmember['mb_email'], $gmember['mb_homepage']); ?>
                </span>
            </span>
            <?php } ?>
        </div>
        <?php } ?>
        
        <?php if ($eyoom_board['bo_use_nogood_member'] == '1' && $board['bo_use_nogood'] && count((array)$nogoods) > 0) { ?>
        <div id="collapse-nogood" class="board-view-good-member collapse">
            <h6>비추천 회원</h6>
            <?php foreach ($nogoods as $k => $nogmember) { ?>
            <span>
                <?php if ($eyoom_board['bo_use_profile_photo'] == 1) { ?>
                <span class="good-mb-photo">
                    <span class="view-photo margin-right-5">
                    <?php if ($nogmember['mb_photo']) { ?>
                    <?php echo $nogmember['mb_photo'] ?>
                    <?php } else { ?>
                    <span class="good-user-icon"><i class="fas fa-user"></i></span>
                    <?php } ?>
                    </span>
                </span>
                <?php } ?>
                <span class="view-nick">
                    <?php echo eb_nameview($nogmember['mb_id'], $nogmember['mb_nick'], $nogmember['mb_email'], $nogmember['mb_homepage']); ?>
                </span>
            </span>
            <?php } ?>
        </div>
        <?php } ?>
        <?php /* 추천 비추천 끝 */?>

        <?php /* 서명 시작 */?>
        <?php if ($is_signature && $view['mb_id']!='anonymous') { ?>
            <?php include_once(EYOOM_CORE_PATH . '/signature/signature.skin.php'); ?>
        <?php } ?>
        <?php /* 서명 끝 */?>
    </div>

    <?php /* 소셜버튼 시작 */?>
    <?php if ($board['bo_use_sns']) { ?>
        <?php include_once(EYOOM_CORE_PATH . '/board/sns.skin.php'); ?>
    <?php } ?>
    <?php /* 소셜버튼 끝 */?>

    <div class="view-area-divider"><span class="divider-circle"></span></div>

    <?php /* 댓글 시작 */?>
    <?php include_once(G5_BBS_PATH . '/view_comment.php'); ?>
    <?php /* 댓글 끝 */?>

    <?php /* 링크 버튼 시작 */?>
    <div class="board-view-bot">
        <?php echo $link_buttons; ?>
    </div>
    <?php /* 링크 버튼 끝 */?>
</article>

<?php if ($eyoom_board['bo_use_yellow_card'] == '1') { ?>
<div class="modal fade yellowcard-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title"><strong>게시물 신고하기</strong></h4>
            </div>
            <div class="modal-body">
                <fieldset id="bo_ycard" class="eyoom-form margin-top-20">
                    <form name="fycard">
                    <input type="hidden" name="modal_cmt_id" id="modal_cmt_id" value="">
                    <label for="sfl" class="sound_only">신고사유</label>
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h6 class="panel-title"><strong class="font-size-13"><i class="fas fa-exclamation-circle"></i> 이 게시물을 신고하시겠습니까? 신고사유를 선택해 주세요.</strong></h6>
                        </div>
                        <div class="panel-body">
                            <div class="inline-group">
                                <label class="radio" for="ycard_reason_1">
                                    <input type="radio" name="ycard_reason" id="ycard_reason_1" value="1"><i class="rounded-x"></i>광고성
                                </label>
                                <label class="radio" for="ycard_reason_2">
                                    <input type="radio" name="ycard_reason" id="ycard_reason_2" value="2"><i class="rounded-x"></i>음란성
                                </label>
                                <label class="radio" for="ycard_reason_3">
                                    <input type="radio" name="ycard_reason" id="ycard_reason_3" value="3"><i class="rounded-x"></i>비방성
                                </label>
                                <label class="radio" for="ycard_reason_4">
                                    <input type="radio" name="ycard_reason" id="ycard_reason_4" value="4"><i class="rounded-x"></i>혐오성
                                </label>
                                <label class="radio" for="ycard_reason_5">
                                    <input type="radio" name="ycard_reason" id="ycard_reason_5" value="5"><i class="rounded-x"></i>기타
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="text-center margin-top-20">
                        <button type="button" class="btn-e btn-e-lg btn-e-red">신고하기</button>
                    </div>
                    </form>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn-e btn-e-lg btn-e-dark" type="button"><i class="fas fa-times"></i> 닫기</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<script src="<?php echo G5_URL; ?>/js/viewimageresize.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/clipboard/clipboard.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/magnific-popup/magnific-popup.min.js"></script>
<?php if ($eyoom_board['bo_use_addon_coding'] == '1') { ?>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/prism/prism.min.js"></script>
<?php } ?>
<?php if ($eyoom_board['bo_use_addon_map'] == '1' && ($config['cf_map_google_id'] || $config['cf_map_naver_id'] || $config['cf_map_daum_id'])) { ?>
<?php if ($config['cf_map_google_id']) { ?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $config['cf_map_google_id']; ?>" async defer></script>
<?php } ?>
<?php if ($config['cf_map_naver_id']) { ?>
<script src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=<?php echo $config['cf_map_naver_id']; ?>&submodules=geocoder"></script>
<?php } ?>
<?php if ($config['cf_map_daum_id']) { ?>
<script src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?php echo $config['cf_map_daum_id']; ?>&libraries=services"></script>
<?php } ?>
<script src="<?php echo EYOOM_THEME_URL; ?>/js/eyoom.map.js"></script>
<script>
$(function(){
    $(".map-content-wrap").each(function(){
        var id      = $(this).find('div').attr('id');
        var type    = $(this).attr('data-map-type');
        var name    = $(this).attr('data-map-name');
        var x       = $(this).attr('data-map-x');
        var y       = $(this).attr('data-map-y');
        var address = $(this).attr('data-map-address');

        switch(type) {
            case 'google': <?php echo $config['cf_map_google_id'] ? 'loading_google_map(id, x, y, name, address);': ''; ?> break;
            case 'naver': <?php echo $config['cf_map_naver_id'] ? 'loading_naver_map(id, x, y, name, address);': ''; ?> break;
            case 'daum': <?php echo $config['cf_map_daum_id'] ? 'loading_daum_map(id, x, y, name, address);': ''; ?> break;
        }
    });
});
</script>
<?php } ?>
<script>
new Clipboard('.clipboard-btn');

<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
    $("a.view_file_download").click(function(e) {
        if (!g5_is_member) {
            swal({
                title: "중요!",
                text: "다운로드 권한이 없습니다. 로그인 후 이용 가능합니다.",
                confirmButtonColor: "#FF4848",
                type: "error",
                confirmButtonText: "확인"
            });
            return false;
        }

        e.preventDefault();
        var linkURL = $(this).attr("href")+"&js=on";
        view_file_download_link(linkURL);
    });
    function view_file_download_link(linkURL) {
        swal({
            html: true,
            title: "안내",
            text: "<div class='alert alert-warning font-size-12 text-left'>파일을 다운로드 하면 포인트가 <strong class='color-red'><?php echo number_format($board['bo_download_point']); ?></strong> 점 적용됩니다.<ol class='margin-top-10'><li>포인트는 게시물당 한번만 적용되며, 다음에 다시 다운로드 하여도 중복하여 적용되지 않습니다.</li><li>본인이 올린 파일은 다운로드 하여도 포인트는가 변동되지 않습니다.</li></ol></div><strong>정말로 다운로드 하시겠습니까?</strong>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#FDAB29",
            confirmButtonText: "다운로드",
            cancelButtonText: "취소",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(){
            window.location.href = linkURL;
        });
    }
});
<?php } ?>

function close_modal(wr_id) {
    window.parent.closeModal(wr_id);
}

function board_move(href) {
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}

$(function() {
    $('.board-view-file-conts img').parent().attr('class', 'view-img-popup').removeAttr('target');
    $('.view-img-popup').each(function() {
        var dataSource = $(this).attr('href');
        $(this).attr('data-source', dataSource);
    });
    $('.board-view-file-conts img').each(function() {
        var imgURL = $(this).attr('src');
        $(this).parent().attr('href', imgURL);
    });
    $('.view-img-popup').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-img-mobile',
        image: {
            verticalFit: true,
            titleSrc: function(item) {
                return '&middot; <a class="image-source-link" href="'+item.el.attr('data-source')+'" target="_blank">원본 이미지 보기</a>';
            }
        }
    });

    if ($('.board-view-con img').parent().hasClass('view_image')) {
        $('.board-view-con img').parent().attr('class', 'view-image-popup').removeAttr('target');
        $('.view-image-popup').each(function() {
            var dataSource = $(this).attr('href');
            $(this).attr('data-source', dataSource);
        });
        $('.board-view-con img').each(function() {
            var imgURL = $(this).attr('src');
            $(this).parent().attr('href', imgURL);
        });
        $('.view-image-popup').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            mainClass: 'mfp-img-mobile',
            image: {
                verticalFit: true,
                titleSrc: function(item) {
                    return '&middot; <a class="image-source-link" href="'+item.el.attr('data-source')+'" target="_blank">원본 이미지 보기</a>';
                }
            }
        });
    } else {
        $('.board-view-con img').wrap('<a class="view-image-popup">');
        $('.board-view-con img').each(function() {
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
    }

    // 이미지 리사이즈
    $(".board-view-atc").viewimageresize();

    // 추천, 비추천
    $("#good_button, #nogood_button").click(function() {
        var $tx, $good;
        if (this.id == "good_button") {
            $tx = $(".board-view-act-good");
            $good = 'good';
        } else {
            $tx = $(".board-view-act-nogood");
            $good = 'nogood';
        }

        excute_good(this.href, $(this), $tx, $good);
        return false;
    });

    <?php if ($eyoom_board['bo_use_yellow_card'] == '1' && $is_member) { ?>
    // 게시물 신고
    $('.yellowcard-modal .modal-body button').click(function () {
        <?php if ($eb_5['yc_blind'] == 'y') { ?>
        swal({
            title: "알림!",
            text: "이미 블라인드 처리된 글은 신고 처리하실 수 없습니다.",
            confirmButtonColor: "#FDAB29",
            type: "warning",
            confirmButtonText: "확인"
        });
        return;
        <?php } ?>

        var cmt_id = $("#modal_cmt_id").val();
        var yc_reason = $(':radio[name="ycard_reason"]:checked').val();
        if (!yc_reason) {
            swal({
                title: "알림!",
                text: "'신고사유'를 선택해 주세요.",
                confirmButtonColor: "#FDAB29",
                type: "warning",
                confirmButtonText: "확인"
            });
            return;
        } else {
            var bo_table = '<?php echo $bo_table; ?>';
            var wr_id = '<?php echo $wr_id; ?>';
            var url = '<?php echo EYOOM_CORE_URL; ?>/board/yellow_card.php';
            $.post('<?php echo EYOOM_CORE_URL; ?>/board/yellow_card.php', { bo_table: bo_table, wr_id: wr_id, cmt_id: cmt_id, action: "add", reason: yc_reason }, function() {
                swal({
                    title: "알림!",
                    text: "정상적으로 신고처리 하였습니다.",
                    confirmButtonColor: "#FDAB29",
                    type: "warning",
                    confirmButtonText: "확인"
                });
                document.location.href = '<?php echo str_replace('&amp;','&',get_pretty_url($bo_table, $wr_id)); ?>';
            });
        }
    });

    // 게시물 신고 취소
    $('#cancel_yellow_card, .cancel_yellow_card, .cancel_cmt_yellow_card').click(function() {
        <?php if ($eb_5['yc_blind'] == 'y') { ?>
        swal({
            title: "알림!",
            text: "이미 블라인드 처리된 글은 신고취소 처리하실 수 없습니다.",
            confirmButtonColor: "#FDAB29",
            type: "warning",
            confirmButtonText: "확인"
        });
        return;
        <?php } ?>

        var cmt_id = $("#modal_cmt_id").val();
        swal({
            title: "신고취소!",
            text: "신고취소 처리하시겠습니까?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#FDAB29",
            confirmButtonText: "확인",
            cancelButtonText: "취소",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(){
            var bo_table = '<?php echo $bo_table; ?>';
            var wr_id = '<?php echo $wr_id; ?>';
            var url = '<?php echo EYOOM_CORE_URL; ?>/board/yellow_card.php';
            $.post(url, { bo_table: bo_table, wr_id: wr_id, cmt_id: cmt_id, action: "cancel" }, function() {
                document.location.href = '<?php echo str_replace('&amp;','&',get_pretty_url($bo_table, $wr_id)); ?>';
            });
        });
    });

    // 원글의 신고취소를 위해 modal_cmt_id 값을 리셋
    $('#yellow_card').click(function() {
        $("#modal_cmt_id").val('');
    });

    <?php if ($blind_direct) { ?>
    // 블라인드 처리 권한을 가진 회원
    $('.btn-blind, .btn-cmt-blind').click(function() {
        var id = $(this).attr('id');
        var cmt_id = $(this).attr('data-cmt-id');
        if (typeof(cmt_id) == 'undefined') var cmt_id = '';

        switch(id) {
            case 'direct_blind':
                swal({
                    title: "블라인드!",
                    text: "본 게시물을 바로 블라인드 처리합니다.\n\n계속 진행하시겠습니까?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#FDAB29",
                    confirmButtonText: "확인",
                    cancelButtonText: "취소",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(){
                    var action = 'db'; // direct blind
                    var re_id = !cmt_id ? 'cancel_blind' : 'cancel_cmt_blind_li_'+cmt_id;
                    var re_class = !cmt_id ? 'board-view-btn bg-dark lighter btn-blind' : 'btn-cmt-blind btn-blind';
                    var re_text = '블라인드 취소';

                    direct_blind(cmt_id, action, re_id, re_class, re_text);
                });
                break;
            case 'cancel_blind':
                swal({
                    title: "블라인드!",
                    text: "본 게시물을 블라인드 취소처리합니다.\n\n계속 진행하시겠습니까?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#FDAB29",
                    confirmButtonText: "확인",
                    cancelButtonText: "취소",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(){
                    var action = 'cb'; // cancel blind
                    var re_id = !cmt_id ? 'direct_blind' : 'direct_cmt_blind_li_'+cmt_id;
                    var re_class = !cmt_id ? 'board-view-btn bg-dark lighter btn-blind' : 'btn-cmt-blind btn-blind';
                    var re_text = '블라인드';

                    direct_blind(cmt_id, action, re_id, re_class, re_text);
                });
                break;
            case 'direct_cmt_blind_li_'+cmt_id:
                swal({
                    title: "블라인드!",
                    text: "본 댓글을 바로 블라인드 처리합니다.\n\n계속 진행하시겠습니까?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#FDAB29",
                    confirmButtonText: "확인",
                    cancelButtonText: "취소",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(){
                    var action = 'db'; // direct blind
                    var re_id = 'cancel_cmt_blind_li_'+cmt_id;
                    var re_class = 'btn-cmt-blind';

                    direct_blind(cmt_id, action, re_id, re_class, re_text);
                });
                break;
            case 'cancel_cmt_blind_li_'+cmt_id:
                swal({
                    title: "블라인드!",
                    text: "본 댓글을 블라인드 취소처리합니다.\n\n계속 진행하시겠습니까?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#FDAB29",
                    confirmButtonText: "확인",
                    cancelButtonText: "취소",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(){
                    var action = 'cb'; // cancel blind
                    var re_id = 'direct_cmt_blind_li_'+cmt_id;
                    var re_class = 'btn-cmt-blind';

                    direct_blind(cmt_id, action, re_id, re_class, re_text);
                });
                break;
        }

        var direct_blind = function(cmt_id, action, re_id, re_class, re_text) {
            if (typeof(action) != 'undefined') {
                $.post(
                    '<?php echo EYOOM_CORE_URL; ?>/board/direct_blind.php',
                    { bo_table: "<?php echo $bo_table; ?>", wr_id: "<?php echo $wr_id; ?>", cmt_id: cmt_id, action: action },
                    function(data) {
                        if (!cmt_id) {
                            $('.btn-blind').attr('id', re_id);
                            $('.btn-blind').attr('class', re_class);
                            $('.btn-blind').text(re_text);
                        } else {
                            $('.btn-cmt-blind').attr('id', re_id);
                            $('.btn-cmt-blind').attr('class', re_class);
                        }
                    }, "json"
                );
            }
        }
    });
    <?php } ?>

    <?php } ?>

    <?php if ($eyoom_board['bo_use_rating'] == '1' && $is_member) { ?>
    $(".rating > input, .rating-mobile > input").click(function() {
        var score = $(this).val();
        swal({
            html: true,
            title: "별점평가",
            text: "<div class='alert alert-warning font-size-12'>별점 <strong>" + score + "</strong> 점을 클릭하였습니다.</div><strong>본 게시물의 별점평가에 참여하시겠습니까?</strong>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#FDAB29",
            confirmButtonText: "확인",
            cancelButtonText: "취소",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(){
            var bo_table = '<?php echo $bo_table; ?>';
            var wr_id = '<?php echo $wr_id; ?>';
            var url = '<?php echo EYOOM_CORE_URL; ?>/board/star_rating.php';
            $.post(url, { bo_table: bo_table, wr_id: wr_id, score: score }, function() {
                document.location.href = '<?php echo str_replace('&amp;','&',get_pretty_url($bo_table, $wr_id)); ?>';
            });
        });
    });
    <?php } ?>

    // 핀 설정
    $('.board-pin-btn').click(function() {
        var id = $(this).attr('id');
        switch(id) {
            case 'save_pin':
                var action = 'save';
                var re_id = 'cancel_pin';
                var re_class = 'board-view-btn board-pin-btn bg-default light';
                var re_text = '해제';

                pin_process(action, re_id, re_class, re_text);
                break;
            case 'cancel_pin':
                var action = 'cancel';
                var re_id = 'save_pin';
                var re_class = 'board-view-btn board-pin-btn bg-dark light';
                var re_text = '저장';

                pin_process(action, re_id, re_class, re_text);
                break;
        }

        function pin_process(action, re_id, re_class, re_text) {
            if (typeof(action) != 'undefined') {
                $.post(
                    '<?php echo EYOOM_CORE_URL; ?>/board/pin_process.php',
                    { bo_table: "<?php echo $bo_table; ?>", wr_id: "<?php echo $wr_id; ?>", action: action },
                    function(data) {
                        if (!data.error) {
                            $('.board-pin-btn').attr('id', re_id);
                            $('.board-pin-btn').attr('class', re_class);
                            $('#pin-text').text(re_text);

                            if (action == 'save') {
                                var str = '정상적으로 핀을 저장하였습니다.\n\n마이페이지 > 핀보드에서 보실 수 있습니다.';
                            } else if (action == 'cancel') {
                                var str = '정상적으로 핀을 해제하였습니다.';
                            }
                            swal({
                                title: "알림!",
                                text: str,
                                confirmButtonColor: "#FDAB29",
                                type: "warning",
                                confirmButtonText: "확인"
                            });
                        } else {
                            swal({
                                title: "알림!",
                                text: "핀 처리하지 못하였습니다.",
                                confirmButtonColor: "#FDAB29",
                                type: "warning",
                                confirmButtonText: "확인"
                            });
                        }
                    }, "json"
                );
            }
        }
    });
});

function excute_good(href, $el, $tx, $good) {
    $.post(
        href,
        { js: "on" },
        function(data) {
            if (data.error) {
                swal({
                    title: "알림",
                    text: data.error,
                    confirmButtonColor: "#FF4848",
                    confirmButtonText: "닫기"
                });
                return false;
            }

            if (data.count) {
                $el.find("strong").text(number_format(String(data.count)));
                if ($good == 'nogood') {
                    swal({
                        title: "비추천 완료",
                        text: "이 글을 비추천하였습니다.",
                        confirmButtonColor: "#FF4848",
                        confirmButtonText: "닫기"
                    });
                } else if ($good == 'good') {
                    swal({
                        title: "추천 완료",
                        text: "이 글을 추천하였습니다.",
                        confirmButtonColor: "#FF4848",
                        confirmButtonText: "닫기"
                    });
                }
            }
        }, "json"
    );
}

<?php if ($is_admin) { ?>
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
            var wr_id = '<?php echo $wr_id; ?>';
            var url = '<?php echo EYOOM_CORE_URL; ?>/board/set_bo_skin.php';
            $.post(url, { bo_table: bo_table, skin: skin }, function() {
                document.location.href = '<?php echo str_replace('&amp;','&',get_pretty_url($bo_table, $wr_id)); ?>';
            });
        }
    });
});
<?php } ?>
</script>