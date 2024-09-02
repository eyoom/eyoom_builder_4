<?php
/**
 * skin file : /theme/THEME_NAME/skin/board/basic/view.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert2/sweetalert2.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/prism/prism.min.css" type="text/css" media="screen">',0);
?>

<style>
.board-view {font-size:.9375rem}
.board-view .board-setup {position:relative;border:1px solid #d5d5d5;height:38px;margin-bottom:20px}
.board-view .board-setup .select {position:absolute;top:-1px;left:-1px;display:inline-block;width:200px}
.board-view .board-setup-btn-box {position:absolute;top:-1px;right:-1px;display:inline-block;width:420px}
.board-view .board-setup-btn {float:left;width:25%;height:38px;line-height:38px;color:#fff;text-align:center;font-size:.8125rem}
.board-view .board-setup-btn:nth-child(odd) {background-color:#000}
.board-view .board-setup-btn:nth-child(even) {background-color:#3c3c3e}
.board-view .board-setup-btn:hover {opacity:0.8}
.board-view .board-view-subj {font-size:1.375rem}
.board-view .board-view-info {position:relative;min-height:70px;border-top:2px solid #757575;border-bottom:1px solid #757575;padding:10px 0;margin-top:20px;background:#fafafa}
.board-view .board-view-info .view-photo-box {position:absolute;top:8px;left:0}
.board-view .board-view-info .view-info-box {position:relative}
.board-view .board-view-info .view-photo img {width:50px;height:50px;margin-right:3px;border-radius:50%}
.board-view .board-view-info .view-photo .view-user-icon {font-size:50px;margin-right:3px;line-height:1;color:#757575}
.board-view .board-view-info .info-box-top {display:block;margin:0 0 4px}
.board-view .board-view-info .info-box-top .view-nick {margin-right:3px}
.board-view .board-view-info .info-box-top .view-nick .sv_wrap > a {font-weight:400}
.board-view .board-view-info .info-box-top .view-lv-icon {display:inline-block;margin-right:3px}
.board-view .board-view-info .info-box-bottom {display:block}
.board-view .board-view-info .info-box-bottom span {margin-right:8px;white-space:nowrap}
.board-view .board-view-info .info-box-bottom strong {font-weight:400}
.board-view .board-view-info .info-box-bottom i {color:#a5a5a5;margin-right:5px}
.board-view .board-view-info .status-label {position:absolute;top:20px;right:0}
.board-view .board-view-info .status-label .bl-label {display:inline-block;width:100px;height:30px;line-height:30px;font-size:.8125rem;text-align:center;color:#fff;background-color:#a5a5a5}
.board-view .board-view-file ul {margin-bottom:0}
.board-view .board-view-file li {padding:8px 0;border-bottom:1px solid #eaeaea}
.board-view .board-view-file a:hover {text-decoration:underline}
.board-view .board-view-file span {margin-left:7px}
.board-view .board-view-file span i {margin-right:4px;color:#b5b5b5}
.board-view .board-view-link ul {margin-bottom:0}
.board-view .board-view-link li {padding:8px 0;border-bottom:1px solid #eaeaea}
.board-view .board-view-link a {text-decoration:underline}
.board-view .board-view-link a:hover {color:#3949ab}
.board-view .board-view-star {position:relative;padding:8px 0;border-bottom:1px solid #eaeaea}
.board-view .board-view-star .star-ratings-view {display:inline-block;margin-bottom:0;margin-right:15px;float:left}
.board-view .board-view-star .star-ratings-view li {padding:0;float:left;margin-right:0}
.board-view .board-view-star .star-ratings-view li .rating {color:#a5a5a5;line-height:normal}
.board-view .board-view-star .star-ratings-view li .rating-selected {color:#ab0000}
.board-view .board-view-star .collapse-rating-result-panel {position:relative;border:1px solid #d5d5d5;background:#fff;padding:10px;margin:7px 0 3px}
.board-view .board-view-star .collapse-rating-result-panel > span:after {content:"|";margin:0 3px;color:#d5d5d5}
.board-view .board-view-star .collapse-rating-result-panel > span:last-child:after {display:none}
.board-view .board-view-star .collapse-rating-result-panel span a {color:#252525}
.board-view .board-view-star .collapse-rating-result-panel span.active .sv_wrap > a {color:#ab0000}
.board-view .eyoom-form .rating {display:inline-block;float:left;width:160px;margin-top:0px}
.board-view .eyoom-form .rating label {margin-top:3px;margin-bottom:0}
.board-view .eyoom-form .rating strong {color:#ab0000}
.board-view .eyoom-form .rating-mobile {position:absolute;top:10px;left:50%;display:inline-block;float:left;width:160px;margin-top:0;margin-left:-80px}
.board-view .eyoom-form .rating-mobile label {margin:0;width:32px;height:28px;line-height:28px;padding:0}
.board-view .eyoom-form .rating-mobile label .fas {font-size:26px}
.board-view .rating-mb-photo, .board-view .good-mb-photo {display:inline-block;margin-right:2px}
.board-view .rating-mb-photo img, .board-view .good-mb-photo img {width:17px;height:17px;border-radius:50%}
.board-view .rating-mb-photo .rating-user-icon, .board-view .good-mb-photo .good-user-icon {font-size:.9375rem}
.board-view .board-view-star .collapse-rating-mo-btn {margin:10px 0}
.board-view .board-view-star .collapse-rating-panel {position:relative;border:1px solid #d5d5d5;background:#fff;height:50px;margin:5px 0 10px}
.board-view .board-view-btn-wrap {border-bottom:1px solid #eaeaea}
.board-view .board-view-btn-wrap:after {content:"";display:block;clear:both}
.board-view .board-view-btn-left {float:left}
.board-view .board-view-btn-right {float:right}
.board-view .board-view-btn {position:relative;float:left;padding:0 15px;height:35px;line-height:35px;cursor:pointer;background:#fff;font-size:.8125rem;color:#252525;border-left:1px solid #eaeaea}
.board-view .board-view-btn:last-child {border-right:1px solid #eaeaea}
.board-view .board-view-btn:hover {color:#ab0000}
.board-view .view-top-btn {padding:20px 0}
.board-view .view-top-btn:after {display:block;visibility:hidden;clear:both;content:""}
.board-view .view-top-btn .top-btn-left li {float:left;margin-right:1px;margin-bottom:5px}
.board-view .view-top-btn .top-btn-right li {float:left;margin-left:1px}
.board-view .board-view-atc {min-height:200px}
.board-view .board-view-atc-title {position:absolute;font-size:0;line-height:0;overflow:hidden}
.board-view .board-view-file-conts {position:relative;overflow:hidden}
.board-view .board-view-file-conts #bo_v_img img {display:block;max-width:100%;height:auto;margin-bottom:10px}
.board-view .board-view-con {position:relative;overflow:hidden;margin-bottom:30px;width:100%;word-break:break-all}
.board-view .board-view-con img {max-width:100%;height:auto}
.board-view .board-view-good-btn {margin-bottom:30px;text-align:center}
.board-view .board-view-good-btn .board-view-act-gng {position:relative;margin:0 5px}
.board-view .board-view-good-btn .board-view-act-gng .act-gng-btn {position:relative;overflow:hidden;width:80px;height:80px;border:1px solid #d5d5d5;background:#fff;display:inline-block;white-space:nowrap;vertical-align:baseline;text-align:center}
.board-view .board-view-good-btn .board-view-act-gng .act-gng-btn i {font-size:26px;color:#757575;margin:12px 0 8px}
.board-view .board-view-good-btn .board-view-act-gng .act-gng-btn:hover {border:1px solid rgba(0,0,0,0.7)}
.board-view .board-view-good-btn .board-view-act-gng .act-gng-btn:hover i {color:#000}
.board-view .board-view-good-btn .board-view-act-gng .act-gng-btn.disabled:hover {border:1px solid #d5d5d5}
.board-view .board-view-good-btn .board-view-act-gng .act-gng-btn.disabled:hover i {color:#757575}
.board-view .board-view-good-btn .board-view-act-gng .act-gng-btn strong {color:#757575}
.board-view .board-view-good-btn .board-view-act-gng .act-gng-btn:hover strong {color:#252525}
.board-view .board-view-good-btn .board-view-act-gng .act-gng-btn .mask {width:100%;height:100%;position:absolute;overflow:hidden;top:0;left:0;background:#fff;opacity:0}
.board-view .board-view-good-btn .board-view-act-gng .act-gng-btn h5 {color:#000;font-size:.9375rem;text-align:center;margin-top:48px;background:transparent;-webkit-transform:scale(0);-moz-transform:scale(0);-o-transform:scale(0);-ms-transform:scale(0);transform:scale(0);-webkit-transition:all 0.2s linear;-moz-transition:all 0.2s linear;-o-transition:all 0.2s linear;-ms-transition:all 0.2s linear;transition:all 0.2s linear;opacity:0}
.board-view .board-view-good-btn .board-view-act-gng .act-gng-btn:hover .mask {opacity:0.9}
.board-view .board-view-good-btn .board-view-act-gng .act-gng-btn:hover h5 {-webkit-transform:scale(1);-moz-transform:scale(1);-o-transform:scale(1);-ms-transform:scale(1);transform:scale(1);opacity:1}
.board-view .board-view-act-good,.board-view-act-nogood {display:none;position:absolute;top:30px;left:0;padding:5px 0;width:165px;background:#000;color:#fff;text-align:center}
.board-view .board-view-good-member {position:relative;background:#fff;border:1px solid #d5d5d5;padding:15px;margin-bottom:10px}
.board-view .board-view-good-member h5 {position:relative;text-align:center;font-size:1.0625rem;margin:0 0 20px}
.board-view .board-view-good-member h5:after {content:"";display:block;position:absolute;bottom:-10px;left:50%;width:20px;height:2px;margin-left:-10px;background:#3949ab}
.board-view .board-view-good-member > span:after {content:"|";margin:0 3px;color:#d5d5d5}
.board-view .board-view-good-member > span:last-child:after {display:none}
.board-view .board-view-good-member span a {color:#252525}
.board-view .board-view-bot {zoom:1}
.board-view .board-view-bot:after {display:block;visibility:hidden;clear:both;content:""}
.board-view .board-view-bot h2 {position:absolute;font-size:0;line-height:0;overflow:hidden}
.board-view .board-view-bot ul {margin:0;padding:0;list-style:none}
.board-view .blind {display:none}
.board-view .map-content-wrap {width:100%;height:350px}
.board-view .map-content-wrap > div {width:100%;height:350px}
.board-view .board-view-tag {position:relative;overflow:hidden;background:#fafafa;border:1px solid #d5d5d5;padding:10px;margin-top:20px}
.board-view .board-view-tag span {display:inline-block;padding:2px 8px;line-height:1;margin:2px;background:#e5e5e5;border-radius:2px !important}
.board-view .board-view-tag a:hover span {background:#757575;color:#fff}
.board-view .board-view-tag .fa-tags {width:22px;height:16px;line-height:16px;text-align:center;color:#353535;margin-right:5px;box-sizing:content-box}
.board-view pre {border-radius:0}
.board-view .caption-overflow span {left:0;right:0}
.draggable {display:block;width:100% \9;max-width:100%;height:auto;margin:0 auto}
button.mfp-close {position:fixed;color:#fff !important}
.mfp-figure .mfp-close {position:absolute}
@media (max-width:576px) {
    .board-view .board-view-info .status-label {position:relative;top:inherit;right:inherit;margin-top:10px}
    .board-view .board-view-btn {padding:0 10px}
}
</style>
<?php if ($wmode) { ?>
<style>
.board-view {width:100%;overflow:hidden}
</style>
<?php } ?>

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
            <?php if( $config['cf_eyoom_admin_theme'] != 'basic' ) { ?>
            <a href="<?php echo $bbs->board_config_url('copy'); ?>"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="far fa-clone"></i> 복제하기</a>
            <a href="<?php echo $bbs->board_config_url('basic'); ?>"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="fas fa-list-alt"></i> 기본설정</a>
            <a href="<?php echo $bbs->board_config_url('addon'); ?>"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="far fa-list-alt"></i> <?php echo $eyoom_board['cf_eyoom_admin_theme'] == 'basic' ? '추가기능': '확장기능'; ?></a>
            <a href="<?php echo $bbs->board_config_url('extend'); ?>"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="far fa-plus-square"></i> 확장필드 (<?php echo number_format($board['bo_ex_cnt']); ?>)</a>
            <?php } else { ?>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_copy&amp;bo_table=<?php echo $bo_table; ?>&amp;wmode=1"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="far fa-clone"></i> 복제하기</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_form&amp;w=u&amp;bo_table=<?php echo $bo_table; ?>&amp;wmode=1"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="fas fa-list-alt"></i> 기본설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=board_form&amp;w=u&amp;bo_table=<?php echo $bo_table; ?>&amp;wmode=1"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="far fa-list-alt"></i> 추가기능</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_extend&amp;w=u&amp;bo_table=<?php echo $bo_table; ?>&amp;wmode=1"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="far fa-plus-square"></i> 확장필드 (<?php echo number_format($board['bo_ex_cnt']); ?>)</a>
            <?php } ?>
        </span>
    </div>
    <?php } ?>

    <h3 class="board-view-subj">
        <?php if ($category_name) { ?>
        <span class="text-gray m-r-5">[<?php echo $view['ca_name'] ?>]</span>
        <?php } ?>
        <strong><?php echo cut_str(get_text($view['wr_subject']), 70); ?></strong>
    </h3>
    <div class="board-view-info">
        <?php if ($config['cf_use_member_icon']) { ?>
        <div class="view-photo-box">
            <?php if ($view['mb_photo']) { ?>
            <span class="view-photo m-r-5"><?php echo $view['mb_photo'] ?></span>
            <?php } else { ?>
            <span class="view-photo m-r-5"><span class="view-user-icon"><i class="fas fa-user-circle"></i></span></span>
            <?php } ?>
        </div>
        <?php } ?>
        <div class="view-info-box" <?php if($config['cf_use_member_icon']) { ?>style="margin-left:60px"<?php } ?>>
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
                <?php if ($config['cf_use_mbmemo'] && $view['mb_id'] && $is_member && $view['mb_id'] != $member['mb_id'] && !$is_anonymous) { // 회원메모 ?>
                <a href="<?php echo G5_URL; ?>/page/?pid=mbmemo&amp;mb_id=<?php echo $view['mb_id']; ?>&amp;wmode=1" data-bs-toggle="tooltip" data-bs-placement="top" title="회원메모" class="btn-mbmemo" onclick="mbmemo_modal(this.href); return false;">
                    <span class="label label-dark"><i class="fas fa-user-edit"></i></span>
                </a>
                <?php } ?>
                <?php if ($is_ip_view) { ?>
                <span class="m-l-5 text-gray f-s-12r"><?php echo $ip; ?></span>
                <?php } ?>
            </div>
            <div class="info-box-bottom">
                <?php if ($eyoom_board['bo_sel_date_type'] == '1') { ?>
                <span><?php echo $eb->date_time('Y-m-d H:i',$view['wr_datetime']); ?></span>
                <?php } else if ($eyoom_board['bo_sel_date_type'] == '2') { ?>
                <span><?php echo $eb->date_format('Y-m-d H:i',$view['wr_datetime']); ?></span>
                <?php } ?>
                <span><i class="far fa-eye"></i><?php echo number_format($view['wr_hit']); ?></span>
                <span><i class="far fa-comment-dots"></i><strong class="text-deep-orange"><?php echo number_format($view['wr_comment']); ?></strong></span>
                <?php if ($is_good) { ?>
                <span><i class="far fa-thumbs-up"></i><strong class="text-teal"><?php echo number_format($view['wr_good']); ?></strong></span>
                <?php } ?>
                <?php if ($is_nogood ) { ?>
                <span><i class="far fa-thumbs-down"></i><strong class="text-pink"><?php echo number_format($view['wr_nogood']); ?></strong></span>
                <?php } ?>
            </div>
        </div>
        <?php if ($board['bo_use_approval'] && ($is_admin || ($is_member && $view['mb_id'] == $member['mb_id']))) { ?>
        <div class="status-label">
            <span class="bl-label bg-<?php echo $view['wr_approval'] ? 'dark': 'light-gray'; ?>"><?php echo $view['wr_approval'] ? '승인': '미승인'; ?></span>
        </div>
        <?php } ?>
    </div>

    <?php if ($cnt > 0) { ?>
    <?php /* 첨부파일 시작 */?>
    <div class="board-view-file">
        <ul class="list-unstyled">
        <?php for ($i=0; $i<count((array)$view_file); $i++) { ?>
            <li>
                <div class="float-start">
                    - 첨부파일 : <strong><?php echo $view_file[$i]['source']; ?></strong> <?php echo $view_file[$i]['content']; ?> (<?php echo $view_file[$i]['size']; ?>) - <a href="<?php echo $view_file[$i]['href']; ?>" class="view_file_download"><u>다운로드</u></a>
                </div>
                <div class="float-end text-end hidden-xs">
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
                <div class="float-start">
                    - 관련링크 : <a href="<?php echo $vlink['href']; ?>" target="_blank"><?php echo $vlink['link']; ?></a>
                </div>
                <div class="float-end text-end">
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
        <ul class="list-unstyled star-ratings-view">
            <li><span class="m-r-10">- 별점 : 평점</span></li>
            <li><i class="<?php if ($rating['point'] <= 0) { ?>rating far fa-star<?php } else if ($rating['point'] > 0.3 && $rating['point'] <= 0.7) { ?>rating-selected fas fa-star-half<?php } else if ($rating['point'] > 0.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
            <li><i class="<?php if ($rating['point'] <= 1) { ?>rating far fa-star<?php } else if ($rating['point'] > 1.3 && $rating['point'] <= 1.7) { ?>rating-selected fas fa-star-half<?php } else if ($rating['point'] > 1.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
            <li><i class="<?php if ($rating['point'] <= 2) { ?>rating far fa-star<?php } else if ($rating['point'] > 2.3 && $rating['point'] <= 2.7) { ?>rating-selected fas fa-star-half<?php } else if ($rating['point'] > 2.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
            <li><i class="<?php if ($rating['point'] <= 3) { ?>rating far fa-star<?php } else if ($rating['point'] > 3.3 && $rating['point'] <= 3.7) { ?>rating-selected fas fa-star-half<?php } else if ($rating['point'] > 3.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
            <li><i class="<?php if ($rating['point'] <= 4) { ?>rating far fa-star<?php } else if ($rating['point'] > 4.3 && $rating['point'] <= 4.7) { ?>rating-selected fas fa-star-half<?php } else if ($rating['point'] > 4.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
            <li class="m-l-5">- [ <span class="text-crimson"><?php echo $rating['point']; ?></span>점 <span class="text-light-gray m-l-3 m-r-3">|</span> 참여 <span class="text-crimson"><?php echo number_format($rating['members']); ?></span>명 ]</li>
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
        <a href="#collapse-rating-result" data-bs-toggle="collapse" class="btn-e btn-gray m-l-5">평가회원보기</a>
        <div id="collapse-rating-result" class="collapse-rating-result-panel collapse">
            <?php foreach ($mb_rating as $mb_id => $rinfo) { ?>
            <span <?php echo $mb_id == $member['mb_id'] ? 'class="active"': ''; ?>>
                <?php echo eb_nameview($rinfo['mb_id'], $rinfo['mb_nick'], $rinfo['mb_email'], $rinfo['mb_homepage']); ?><?php echo ($mb_id == $member['mb_id'] && $eyoom_board['bo_use_rating_score'] != '1') || $eyoom_board['bo_use_rating_score'] == '1' ? '['.number_format($rinfo['rating']).']':''; ?>
            </span>
            <?php } ?>
        </div>
        <?php } ?>

        <?php if ($my_rating['rating']) { ?>
        <div class="clearfix"></div>
        <div class="text-gray m-t-5">- <i class="fas fa-exclamation-circle"></i> 이미 참여한 별점평가</div>
        <?php } ?>

        <?php if ($is_member && !$is_member) { ?>
        <div class="clearfix"></div>
        <div class="text-gray m-t-5">- <i class="fas fa-exclamation-circle"></i> 로그인 후 평가 가능</div>
        <?php } ?>
        <div class="clearfix"></div>

        <?php if ($is_member && !$my_rating['rating']) { // 모바일 별점평가 영역 ?>
        <a href="#collapse-board-rating" data-bs-toggle="collapse" class="collapse-rating-mo-btn btn-e btn-e-dark hidden-lg hidden-md hidden-sm">별점평가하기</a>
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
            <a href="<?php echo $copy_href; ?>" class="board-view-btn" onclick="board_move(this.href); return false;">복사</a>
        <?php } ?>
        <?php if ($move_href) { ?>
            <a href="<?php echo $move_href; ?>" class="board-view-btn" onclick="board_move(this.href); return false;">이동</a>
        <?php } ?>
        </div>

        <div class="board-view-btn-right">
        <?php if ($eyoom_board['bo_use_yellow_card'] == '1') { ?>
            <?php if (!$mb_ycard['mb_id']) { ?>
            <span id="yellow_card" class="board-view-btn" data-bs-toggle="modal" data-bs-target=".yellowcard-modal">신고 <span class="badge badge-crimson"><?php echo number_format($eb_5['yc_count']); ?></span></span>
            <?php } else { ?>
            <span id="cancel_yellow_card" class="board-view-btn">신고 취소 <span class="badge badge-crimson"><?php echo number_format($eb_5['yc_count']); ?></span></span>
            <?php } ?>
            <?php if ($blind_direct) { ?>
                <?php if ($eb_5['yc_blind'] != 'y') { ?>
            <span id="direct_blind" class="board-view-btn btn-blind">블라인드</span>
                <?php } else if ($eb_5['yc_blind'] == 'y') { ?>
            <span id="cancel_blind" class="board-view-btn btn-blind">블라인드 취소</span>
                <?php } ?>
            <?php } ?>
        <?php } ?>

        <?php if ($scrap_href) { ?>
            <a href="<?php echo $scrap_href; ?>" target="_blank" class="board-view-btn" onclick="win_scrap(this.href); return false;">스크랩</a>
        <?php } ?>
        <?php if (!$pininfo) { ?>
            <span id="save_pin" class="board-view-btn board-pin-btn">핀 <span id="pin-text">저장</span></span>
        <?php } else { ?>
            <span id="cancel_pin" class="board-view-btn board-pin-btn">핀 <span id="pin-text">해제</span></span>
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
        <?php if (!$wmode) { ?>
        <?php if ($prev_href || $next_href) { ?>
        <ul class="top-btn-left list-unstyled float-start">
            <?php if ($prev_href) { ?>
            <li><a href="<?php echo $prev_href; ?>" class="btn-e btn-e-dark" type="button">이전글</a></li>
            <?php } ?>
            <?php if ($next_href) { ?>
            <li><a href="<?php echo $next_href; ?>" class="btn-e btn-e-dark" type="button">다음글</a></li>
            <?php } ?>
        </ul>
        <?php } ?>
        <?php } ?>
        <ul class="top-btn-right list-unstyled float-end">
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
            <li><a href="<?php echo $write_href; ?>" class="btn-e btn-e-navy" type="button">글쓰기</a></li>
                <?php } ?>
            <?php } ?>
        </ul>
        <div class="clearfix"></div>
    </div>
    <?php /* 게시물 상단 버튼 끝 */?>

    <div class="board-view-atc" id="view_good_nogood">
        <h2 class="board-view-atc-title">본문</h2>
        <?php if ($eyoom_board['bo_use_addon_poll'] == '1' && $view['wr_poll_use'] == '1') { ?>
        <?php } else { ?>
        <div class="board-view-file-conts">
            <?php echo $file_conts; ?>
        </div>
        <?php } ?>

        <?php /* 본문 내용 시작 */?>
        <?php if ($eb_5['yc_blind'] == 'y') { ?>
        <p class="text-center m-t-40 m-b-40"><strong class="text-pink">----- <i class="fas fa-exclamation-circle"></i> 블라인드 처리된 글입니다. -----</strong></p>
        <?php } ?>
        <div id="board_view_con" class="board-view-con view-content"><?php echo $view_content; ?></div>
        <?php echo $config['cf_editor'] == 'tuieditor' ? $bbs->tuieditor_viewer("board_view_con"): ''; ?>

        <?php
        /* 투표게시판 */
        if ($eyoom_board['bo_use_addon_poll'] == '1' && isset($view['wr_poll_use']) && $view['wr_poll_use'] == '1') {
            @include_once(EYOOM_CORE_PATH.'/board/bbspoll.php');
        }
        ?>
        <?php /* 본문 내용 끝 */?>

        <?php /* 추천 비추천 시작 */?>
        <?php if ($good_href || $nogood_href) { ?>
        <div class="board-view-good-btn">
            <div class="m-b-10">
                <?php if ($good_href) { ?>
                <span class="board-view-act-gng">
                    <a href="<?php echo $good_href; ?>&amp;<?php echo $qstr; ?>" id="good_button" class="act-gng-btn" type="button"><i class="far fa-thumbs-up display-block"></i><strong class="text-teal"><?php echo number_format($view['wr_good']); ?></strong><div class="mask"><h5>추천</h5></div></a>
                    <b class="board-view-act-good"></b>
                </span>
                <?php } ?>
                <?php if ($nogood_href) { ?>
                <span class="board-view-act-gng">
                    <a href="<?php echo $nogood_href; ?>&amp;<?php echo $qstr; ?>" id="nogood_button" class="act-gng-btn" type="button"><i class="far fa-thumbs-down display-block"></i><strong class="text-pink"><?php echo number_format($view['wr_nogood']); ?></strong><div class="mask"><h5>비추천</h5></div></a>
                    <b class="board-view-act-nogood"></b>
                </span>
                <?php } ?>
            </div>
            <?php if ($goodinfo && $is_member) { ?>
            <div class="text-center text-gray f-s-12r m-t-10 m-b-10"><i class="fas fa-exclamation-circle"></i> 이미 <?php echo $goodinfo['bg_flag'] == 'good' ? '추천': '비추천';?>하였습니다. [참여일 : <?php echo $goodinfo['bg_datetime']; ?>]</div>
            <?php } ?>
            <?php if ($eyoom_board['bo_use_good_member'] == '1' && $board['bo_use_good'] && count((array)$goods) > 0) { ?>
            <a href="#collapse-good" data-bs-toggle="collapse" class="btn-e btn-gray">추천한 회원 보기</a>
            <?php } ?>
            <?php if ($eyoom_board['bo_use_nogood_member'] == '1' && $board['bo_use_nogood'] && count((array)$nogoods) > 0) { ?>
            <a href="#collapse-nogood" data-bs-toggle="collapse" class="btn-e btn-gray">비추천 회원 보기</a>
            <?php } ?>
        </div>
        <?php } else { ?>
            <?php if ($board['bo_use_good'] || $board['bo_use_nogood']) { ?>
        <div class="board-view-good-btn">
            <div class="m-b-10">
                <?php if ($board['bo_use_good']) { ?>
                <span class="board-view-act-gng">
                    <span class="act-gng-btn disabled"><i class="far fa-thumbs-up display-block"></i><strong class="text-teal"><?php echo number_format($view['wr_good']); ?></strong></span>
                </span>
                <?php } ?>
                <?php if ($board['bo_use_nogood']) { ?>
                <span class="board-view-act-gng">
                    <span class="act-gng-btn disabled"><i class="far fa-thumbs-down display-block"></i><strong class="text-pink"><?php echo number_format($view['wr_nogood']); ?></strong></span>
                </span>
                <?php } ?>
            </div>
            <div class="text-center text-gray f-s-13r m-t-10 m-b-10"><i class="fas fa-exclamation-circle"></i> 로그인 후 추천 또는 비추천하실 수 있습니다.</div>
            <?php if ($eyoom_board['bo_use_good_member'] == '1' && $board['bo_use_good'] && count((array)$goods) > 0) { ?>
            <a href="#collapse-good" data-bs-toggle="collapse" class="btn-e btn-gray">추천한 회원 보기</a>
            <?php } ?>
            <?php if ($eyoom_board['bo_use_nogood_member'] == '1' && $board['bo_use_nogood'] && count((array)$nogoods) > 0) { ?>
            <a href="#collapse-nogood" data-bs-toggle="collapse" class="btn-e btn-gray">비추천 회원 보기</a>
            <?php } ?>
        </div>
            <?php } ?>
        <?php } ?>

        <?php if ($eyoom_board['bo_use_good_member'] == '1' && $board['bo_use_good'] && count((array)$goods) > 0) { ?>
        <div id="collapse-good" class="board-view-good-member collapse" data-bs-parent="#view_good_nogood">
            <h5>추천한 회원</h5>
            <?php foreach ($goods as $k => $gmember) { ?>
            <span>
                <span class="view-nick">
                    <?php echo eb_nameview($gmember['mb_id'], $gmember['mb_nick'], $gmember['mb_email'], $gmember['mb_homepage']); ?>
                </span>
            </span>
            <?php } ?>
        </div>
        <?php } ?>
        
        <?php if ($eyoom_board['bo_use_nogood_member'] == '1' && $board['bo_use_nogood'] && count((array)$nogoods) > 0) { ?>
        <div id="collapse-nogood" class="board-view-good-member collapse" data-bs-parent="#view_good_nogood">
            <h5>비추천 회원</h5>
            <?php foreach ($nogoods as $k => $nogmember) { ?>
            <span>
                <span class="view-nick">
                    <?php echo eb_nameview($nogmember['mb_id'], $nogmember['mb_nick'], $nogmember['mb_email'], $nogmember['mb_homepage']); ?>
                </span>
            </span>
            <?php } ?>
        </div>
        <?php } ?>
        <?php /* 추천 비추천 끝 */?>

        <?php /* 게시물 상단고정 시작 */
            $bo_notice = explode(',', $board['bo_notice']);
            $sql = "select count(*) as cnt from {$g5['eyoom_wrfixed']} where bo_table='{$bo_table}' and wr_id='{$wr_id}' and bf_open='y' ";
            $wr_fixed = sql_fetch($sql);
        ?>
        <?php if ($eyoom_board['bo_use_wrfixed'] == '1' && (isset($member['mb_id']) && $member['mb_id'] == $view['wr_mb_id'] || $is_admin) && !in_array($wr_id, $bo_notice) && $wr_fixed['cnt']==0) { ?>
        <div id="wrfixed" class="text-center m-b-10">
            <a href="javascript:void(0);" id="bo_wrfixed" class="btn-e btn-e-deep-purple btn-e-md">게시물 <?php echo $eyoom_board['bo_wrfixed_date']; ?>일간 상단노출 (<?php echo number_format($eyoom_board['bo_wrfixed_point']); ?>포인트 소모)</a>
        </div>
        <script>
        $(function() {
            $(document).on("click","#bo_wrfixed",function() {
                if (confirm("본 게시물을 상단에 <?php echo $eyoom_board['bo_wrfixed_date']; ?>일간 노출하는데 총 <?php echo number_format($eyoom_board['bo_wrfixed_point']); ?>포인트가 소모됩니다.\n정말로 상단노출을 진행하시겠습니다?")) {
                    var url = "<?php echo EYOOM_CORE_URL; ?>/board/wr_fixed.php";
                    $.post(url, {bo_table: '<?php echo $bo_table; ?>', wr_id: '<?php echo $wr_id; ?>'}, function(data) {
                        alert(data.msg);
                    }, "json");
                } else {
                    return false;
                }
            });
        });
        </script>
        <?php } ?>
        <?php /* 게시물 상단고정 끝 */ ?>

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
<div class="modal fade yellowcard-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-s-20r"><strong>게시물 신고하기</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <fieldset id="bo_ycard" class="eyoom-form m-t-20">
                    <form name="fycard">
                    <input type="hidden" name="modal_cmt_id" id="modal_cmt_id" value="">

                    <h5 class="m-b-10"><strong class="f-s-14r"><i class="fas fa-exclamation-circle"></i> 이 게시물을 신고하시겠습니까? 신고사유를 선택해 주세요.</strong></h5>

                    <label class="sound_only">신고사유</label>
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

                    <div class="text-center m-t-20">
                        <button type="button" class="btn-e btn-e-lg btn-e-crimson">신고하기</button>
                    </div>

                    </form>
                </fieldset>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<script src="<?php echo G5_URL; ?>/js/viewimageresize.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<?php if ($eyoom_board['bo_use_addon_coding'] == '1') { ?>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/prism/prism.min.js"></script>
<?php } ?>
<?php if ($eyoom_board['bo_use_addon_map'] == '1' && ($config['cf_map_google_id'] || $config['cf_map_naver_id'] || $config['cf_map_daum_id'])) { ?>
<?php if ($config['cf_map_google_id']) { ?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $config['cf_map_google_id']; ?>" async defer></script>
<?php } ?>
<?php if ($config['cf_map_naver_id']) { ?>
<script src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=<?php echo $config['cf_map_naver_id']; ?>&submodules=geocoder"></script>
<?php } ?>
<?php if ($config['cf_map_daum_id']) { ?>
<script src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?php echo $config['cf_map_daum_id']; ?>&libraries=services"></script>
<?php } ?>
<script src="<?php echo EYOOM_THEME_URL; ?>/js/eyoom.map.js"></script>
<script>
$(window).load(function() {
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
<?php if ($board['bo_download_point'] < 0) { ?>
$(window).load(function() {
    $("a.view_file_download").click(function(e) {
        if (!g5_is_member) {
            Swal.fire({
                title: "알림!",
                text: "다운로드 권한이 없습니다. 로그인 후 이용 가능합니다.",
                confirmButtonColor: "#ab0000",
                icon: "error",
                confirmButtonText: "확인"
            });
            return false;
        }

        e.preventDefault();
        var linkURL = $(this).attr("href")+"&js=on";
        view_file_download_link(linkURL);
    });
    function view_file_download_link(linkURL) {
        Swal.fire({
            title: "안내",
            html: "<div class='alert alert-warning text-start'>파일을 다운로드 하면 포인트가 <span class='text-crimson'><?php echo number_format($board['bo_download_point']); ?></span> 점 적용됩니다.<ol class='m-t-10'><li>포인트는 게시물당 한번만 적용되며, 다음에 다시 다운로드 하여도 중복하여 적용되지 않습니다.</li><li>본인이 올린 파일은 다운로드 하여도 포인트는가 변동되지 않습니다.</li></ol></div><span>정말로 다운로드 하시겠습니까?</span>",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#00897b",
            confirmButtonText: "다운로드",
            cancelButtonText: "취소"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = linkURL;
            }
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

$(window).load(function() {
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
        Swal.fire({
            title: "알림!",
            text: "이미 블라인드 처리된 글은 신고 처리하실 수 없습니다.",
            confirmButtonColor: "#ab0000",
            icon: "error",
            confirmButtonText: "확인"
        });
        return;
        <?php } ?>

        var cmt_id = $("#modal_cmt_id").val();
        var yc_reason = $(':radio[name="ycard_reason"]:checked').val();
        if (!yc_reason) {
            Swal.fire({
                title: "알림!",
                text: "'신고사유'를 선택해 주세요.",
                confirmButtonColor: "#ab0000",
                icon: "warning",
                confirmButtonText: "확인"
            });
            return;
        } else {
            var bo_table = '<?php echo $bo_table; ?>';
            var wr_id = '<?php echo $wr_id; ?>';
            var url = '<?php echo EYOOM_CORE_URL; ?>/board/yellow_card.php';
            $.post(url, { bo_table: bo_table, wr_id: wr_id, cmt_id: cmt_id, action: "add", reason: yc_reason }, function() {
                Swal.fire({
                    title: "알림!",
                    text: "정상적으로 신고처리 하였습니다.",
                    confirmButtonColor: "#ab0000",
                    icon: "success",
                    confirmButtonText: "확인"
                }).then(() => {
                    document.location.href = '<?php echo str_replace('&amp;','&',get_pretty_url($bo_table, $wr_id)); ?>';
                });
            });
        }
    });

    // 게시물 신고 취소
    $('#cancel_yellow_card, .cancel_yellow_card, .cancel_cmt_yellow_card').click(function() {
        <?php if ($eb_5['yc_blind'] == 'y') { ?>
        Swal.fire({
            title: "알림!",
            text: "이미 블라인드 처리된 글은 신고취소 처리하실 수 없습니다.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        return;
        <?php } ?>

        var cmt_id = $("#modal_cmt_id").val();
        Swal.fire({
            title: "신고취소!",
            text: "신고취소 처리하시겠습니까?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#00897b",
            confirmButtonText: "확인",
            cancelButtonText: "취소"
        }).then((result) => {
            if (result.isConfirmed) {
                var bo_table = '<?php echo $bo_table; ?>';
                var wr_id = '<?php echo $wr_id; ?>';
                var url = '<?php echo EYOOM_CORE_URL; ?>/board/yellow_card.php';
                $.post(url, { bo_table: bo_table, wr_id: wr_id, cmt_id: cmt_id, action: "cancel" }, function() {
                    document.location.href = '<?php echo str_replace('&amp;','&',get_pretty_url($bo_table, $wr_id)); ?>';
                });
            }
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
                Swal.fire({
                    title: "블라인드!",
                    text: "본 게시물을 바로 블라인드 처리합니다. 계속 진행하시겠습니까?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#ab0000",
                    confirmButtonText: "확인",
                    cancelButtonText: "취소"
                }).then((result) => {
                    if (result.isConfirmed) {
                        var action = 'db'; // direct blind
                        var re_id = !cmt_id ? 'cancel_blind' : 'cancel_cmt_blind_li_'+cmt_id;
                        var re_class = !cmt_id ? 'board-view-btn btn-blind' : 'btn-cmt-blind btn-blind';
                        var re_text = '블라인드 취소';

                        direct_blind(cmt_id, action, re_id, re_class, re_text);

                        window.location.reload();
                    }
                });
                break;
            case 'cancel_blind':
                Swal.fire({
                    title: "블라인드!",
                    text: "본 게시물을 블라인드 취소처리합니다. 계속 진행하시겠습니까?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#ab0000",
                    confirmButtonText: "확인",
                    cancelButtonText: "취소"
                }).then((result) => {
                    if (result.isConfirmed) {
                        var action = 'cb'; // cancel blind
                        var re_id = !cmt_id ? 'direct_blind' : 'direct_cmt_blind_li_'+cmt_id;
                        var re_class = !cmt_id ? 'board-view-btn btn-blind' : 'btn-cmt-blind btn-blind';
                        var re_text = '블라인드';

                        direct_blind(cmt_id, action, re_id, re_class, re_text);

                        window.location.reload();
                    }
                });
                break;
            case 'direct_cmt_blind_li_'+cmt_id:
                Swal.fire({
                    title: "블라인드!",
                    text: "본 댓글을 바로 블라인드 처리합니다. 계속 진행하시겠습니까?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#ab0000",
                    confirmButtonText: "확인",
                    cancelButtonText: "취소"
                }).then((result) => {
                    if (result.isConfirmed) {
                        var action = 'db'; // direct blind
                        var re_id = 'cancel_cmt_blind_li_'+cmt_id;
                        var re_class = 'btn-cmt-blind';

                        direct_blind(cmt_id, action, re_id, re_class, re_text);

                        window.location.reload();
                    }
                });
                break;
            case 'cancel_cmt_blind_li_'+cmt_id:
                Swal.fire({
                    title: "블라인드!",
                    text: "본 댓글을 블라인드 취소처리합니다. 계속 진행하시겠습니까?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#ab0000",
                    confirmButtonText: "확인",
                    cancelButtonText: "취소"
                }).then((result) => {
                    if (result.isConfirmed) {
                        var action = 'cb'; // cancel blind
                        var re_id = 'direct_cmt_blind_li_'+cmt_id;
                        var re_class = 'btn-cmt-blind';

                        direct_blind(cmt_id, action, re_id, re_class, re_text);

                        window.location.reload();
                    }
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
        Swal.fire({
            title: "별점평가",
            html: "<div class='alert alert-warning'>별점 <span>" + score + "</span> 점을 클릭하였습니다.</div><span>본 게시물의 별점평가에 참여하시겠습니까?</span>",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#00897b",
            confirmButtonText: "확인",
            cancelButtonText: "취소"
        }).then((result) => {
            if (result.isConfirmed) {
                var bo_table = '<?php echo $bo_table; ?>';
                var wr_id = '<?php echo $wr_id; ?>';
                var wmode = '<?php echo $wmode ? "?wmode=1": ''; ?>';
                var url = '<?php echo EYOOM_CORE_URL; ?>/board/star_rating.php';
                $.post(url, { bo_table: bo_table, wr_id: wr_id, score: score }, function() {
                    document.location.href = '<?php echo str_replace('&amp;','&',get_pretty_url($bo_table, $wr_id)); ?>'+wmode;
                });
            }
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
                var re_class = 'board-view-btn board-pin-btn';
                var re_text = '해제';

                pin_process(action, re_id, re_class, re_text);
                break;
            case 'cancel_pin':
                var action = 'cancel';
                var re_id = 'save_pin';
                var re_class = 'board-view-btn board-pin-btn';
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
                                var str = '정상적으로 핀을 저장하였습니다. 마이페이지 > 핀보드에서 보실 수 있습니다.';
                            } else if (action == 'cancel') {
                                var str = '정상적으로 핀을 해제하였습니다.';
                            }
                            Swal.fire({
                                title: "알림!",
                                text: str,
                                confirmButtonColor: "#ab0000",
                                icon: "success",
                                confirmButtonText: "확인"
                            });
                        } else {
                            Swal.fire({
                                title: "알림!",
                                text: "핀 처리하지 못하였습니다.",
                                confirmButtonColor: "#ab0000",
                                icon: "error",
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
                Swal.fire({
                    title: "알림",
                    text: data.error,
                    confirmButtonColor: "#ab0000",
                    confirmButtonText: "닫기"
                });
                return false;
            }

            if (data.count) {
                $el.find("strong").text(number_format(String(data.count)));
                if ($good == 'nogood') {
                    Swal.fire({
                        title: "비추천 완료",
                        text: "이 글을 비추천하였습니다.",
                        icon: "success",
                        confirmButtonColor: "#ab0000",
                        confirmButtonText: "닫기"
                    });
                } else if ($good == 'good') {
                    Swal.fire({
                        title: "추천 완료",
                        text: "이 글을 추천하였습니다.",
                        icon: "success",
                        confirmButtonColor: "#ab0000",
                        confirmButtonText: "닫기"
                    });
                }
            }
        }, "json"
    );
}

<?php if ($is_admin) { ?>
$(window).load(function() {
    $(".set_bo_skin").change(function() {
        var skin = $(this).val();
        if (!skin) {
            Swal.fire({
                title: "알림",
                text: '스킨을 선택해 주세요.',
                confirmButtonColor: "#ab0000",
                icon: "warning",
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