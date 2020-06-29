<?php
/**
 * skin file : /theme/THEME_NAME/skin/board/gmap/view_comment.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/venobox/venobox.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/magnific-popup/magnific-popup.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert/sweetalert.min.css" type="text/css" media="screen">',0);
?>

<style>
.view-comment {position:relative;margin-bottom:40px}
.view-comment h2 {position:absolute;font-size:0;line-height:0;overflow:hidden}
.view-comment .view-comment-heading {border-bottom:2px solid #757575;padding:10px 0;margin-bottom:30px}
.view-comment .view-comment-item {position:relative;padding:15px 0 20px;border-top:1px solid #e5e5e5}
.view-comment .view-comment-item .no-comment {text-align:center;padding:10px 0 20px}
.view-comment .view-comment-no-item {position:relative;padding:20px 0;border-top:1px solid #e5e5e5;border-bottom:1px solid #e5e5e5;text-align:center}
.view-comment .view-comment-no-item .no-comment {color:#959595;font-size:13px}
.view-comment .view-comment-item .view-cmtgo-btn {position:absolute;top:-10px;left:0;width:20px;height:20px;line-height:20px;text-align:center;background:#757575;color:#fff;font-size:11px;cursor:pointer}
.view-comment .view-comment-item .view-cmtgo-btn:hover {background:#555555}
.view-comment .view-comment-item .view-comment-best-label {position:absolute;top:-10px;left:20px;width:70px;height:20px;line-height:20px;text-align:center;background:#7887CC;color:#fff;font-size:11px;cursor:pointer}
.view-comment .view-comment-item.cmt-best {background:#E3F2FD;border-color:#1E88E5}
.view-comment .view-comment-depth {position:absolute;top:-40px;left:0;width:8px;height:123px;border-left:1px dotted #d5d5d5;border-bottom:1px dotted #d5d5d5}
.view-comment .view-comment-depth i {position:absolute;top:116px;left:5px;color:#d5d5d5}
.view-comment .view-comment-photo {position:absolute;overflow:hidden;top:15px;left:5px;width:48px;height:48px;background:#fff;border:1px solid #eaeaea;padding:2px;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.view-comment .view-comment-photo img {width:42px;height:42px;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.view-comment .view-comment-photo .comment-user-icon {width:42px;height:42px;background:#84848a;font-size:24px;line-height:42px;text-align:center;color:#fff;display:inline-block;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.view-comment .view-comment-photo.no-depth-photo {left:0}
.view-comment .comment-item-info {position:relative;padding-left:60px;padding-right:15px;margin-top:15px;margin-bottom:25px}
.view-comment .comment-item-info > span {margin-right:5px}
.view-comment .comment-ip {font-size:11px;color:#959595}
.view-comment .comment-time {font-size:12px;color:#959595}
.view-comment .comment-dropdown {position:absolute;top:0;right:-5px;display:inline-block}
.view-comment .comment-dropdown-btn {display:inline-block;width:18px;height:18px;line-height:20px;background:#d5d5d5;color:#fff;text-align:center;font-size:11px;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.view-comment .comment-dropdown-btn:hover {background:#757575;color:#fff;cursor:pointer;-webkit-transition:all 0.2s linear;-moz-transition:all 0.2s linear;transition:all 0.2s linear}
.view-comment .comment-dropdown .dropdown-menu {left:inherit;right:0}
.view-comment .comment-dropdown .dropdown-menu a {font-size:12px}
.view-comment .comment-dropdown .dropdown-menu a small {font-size:11px;color:#a5a5a5}
.view-comment .comment-item-content {position:relative;padding-left:20px}
.view-comment .comment-item-content .comment-file-item {position:relative;border:1px solid #e5e5e5;background:#fafafa;padding:7px 10px;font-size:11px;margin-bottom:15px}
.view-comment .comment-item-content .comment-file-item:after {content:"";display:block;clear:both}
.view-comment .comment-item-content .comment-file-item span {margin-left:5px}
.view-comment .comment-item-content .comment-file-item i {color:#959595;margin-right:3px}
.view-comment .comment-item-content .comment-cont-wrap {display:flex}
.view-comment .comment-item-content .comment-cont-wrap:after {content:"";display:block;clear:both}
.view-comment .comment-item-content .comment-cont-img {position:relative;flex-grow:1;padding-right:15px}
.view-comment .comment-item-content .comment-cont-txt {position:relative;flex-grow:4}
.view-comment .comment-item-content .comment-image {display:block;width:200px;margin-bottom:15px}
.view-comment .comment-item-content .comment-yello-card {position:relative;padding:10px;margin-bottom:20px;background:#ffbeaa;border:1px solid #ff9b79;opacity:0.45}
.view-comment .comment-btn-wrap {position:relative;text-align:right;height:20px}
.view-comment .comment-btn-wrap .comment-btn-right {position:absolute;top:0;right:0}
.view-comment .comment-btn-wrap .comment-btn {position:relative;float:left;padding:0 15px;height:20px;line-height:20px;cursor:pointer;background:#959595;font-size:11px;color:#fff}
.view-comment .comment-btn-wrap .comment-btn:nth-child(odd) {background:#59595B}
.view-comment .comment-btn-wrap .comment-btn:nth-child(even) {background:#676769}
.view-comment .comment-btn-wrap .comment-btn:hover {background:#4B4B4D}
.view-comment .comment-item-body-pn .comment-item-info {padding-left:10px}
.view-comment-write {position:relative;margin-bottom:40px}
.comment-area .comment-write-heading {position:relative;border-bottom:2px solid #757575;padding:10px 0;margin-bottom:15px}
.comment-area .comment-write-heading .cmt-point-info-btn {position:absolute;top:9px;right:0}
.comment-area .comment-write-wrap {position:relative}
.comment-area .comment-write {margin-bottom:20px}
.comment-area .comment-write .comment-write-option {position:relative;background:#fafafa;border:1px solid #d5d5d5;border-bottom:0}
.comment-area .comment-write .comment-write-option .panel-default {border:0;margin-bottom:0;box-shadow:none;background:transparent}
.comment-area .comment-write .comment-write-option .panel-in {position:relative;padding:10px}
.comment-area .comment-write .comment-write-option .panel-in .panel-in-left {float:left}
.comment-area .comment-write .comment-write-option .panel-in .panel-in-right {float:right}
.comment-area .comment-write .comment-write-option .comment-option-btn {position:relative;float:left;padding:0 10px;height:22px;line-height:22px;text-align:center;font-size:11px;color:#757575;border:1px solid #c5c5c5;background:#fff;margin-left:-1px;-webkit-transition:all 0.1s linear;-moz-transition:all 0.1s linear;transition:all 0.1s linear}
.comment-area .comment-write .comment-write-option .comment-option-btn:hover {color:#000;background:#e5e5e5}
.comment-area .comment-write .comment-write-option .comment-collapse-box {background:#fff;border-top:1px solid #d5d5d5;padding:10px}
.comment-area .comment-write .comment-write-option .comment-collapse-box label {margin-bottom:0}
.comment-area .comment-write .comment-write-option .comment-collapse-box .btn-e-input {padding:5px 16px}
.comment-area .comment-write .comment-write-footer {position:relative;background:#fafafa;border:1px solid #d5d5d5;border-top:0;padding:7px 10px;color:#959595;font-size:11px}
.comment-area .comment-write-submit {position:relative;text-align:center}
.comment-area #modal_comment_video_note .table-list-eb .table thead>tr>th {text-align:left}
.comment-area .view-comment-more {text-align:center;border-top:1px solid #e5e5e5;padding-top:30px;margin-bottom:40px}
.comment-area .eyoom-form .textarea {margin-bottom:0}
.comment-area .eyoom-form .textarea textarea {border:1px solid #d5d5d5}
.comment-area-divider {position:relative;height:1px;border-top:1px solid #d5d5d5;margin:30px 0}
.comment-area-divider .divider-circle {position:absolute;top:-7px;left:50%;margin-left:-7px;width:14px;height:14px;border:2px solid #d5d5d5;background:#fff;z-index:1px;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
#bo_vc_send_sns ul{padding:0;margin:-5px 0 20px;overflow:hidden}
#bo_vc_send_sns li{float:left;margin-right:10px;list-style:none}
#bo_vc_send_sns li input{margin:10px 25px 10px 5px}
#infscr-loading {text-align:center;z-index:100;position:absolute;left:50%;bottom:0;width:200px;margin-left:-100px;padding:10px;background:#000;opacity:0.6;color:#fff}
#map_canvas {width:1000px;height:400px;display:none}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width:767px) {
    .comment-area .comment-write .comment-write-option .comment-option-btn {padding:0 15px}
    .view-comment .view-comment-depth {height:110px}
    .view-comment .view-comment-depth i {top:104px}
    .view-comment .view-comment-photo {width:34px;height:34px;padding:1px}
    .view-comment .view-comment-photo img {width:30px;height:30px}
    .view-comment .view-comment-photo .comment-user-icon {width:30px;height:30px;font-size:16px;line-height:30px}
    .view-comment .comment-item-info {padding-left:45px;margin-top:8px;margin-bottom:20px}
    .view-comment .comment-item-content {padding-left:17px}
}
@media (max-width:600px) {
    .comment-area {font-size:12px}
    .view-comment .comment-item-content .comment-cont-wrap {display:block}
    .view-comment .comment-item-content .comment-cont-img {position:relative;flex-grow:none;padding-right:0}
    .view-comment .comment-item-content .comment-cont-txt {position:relative;flex-grow:none}
    .view-comment .comment-item-content .comment-image {width:100%;margin-right:inherit}
}
<?php } ?>
</style>

<script>
// 글자수 제한
var char_min = parseInt(<?php echo $comment_min; ?>); // 최소
var char_max = parseInt(<?php echo $comment_max; ?>); // 최대
</script>

<div class="comment-area">
    <?php /* 댓글 목록 시작 */ ?>
    <div class="view-comment">
        <h4 class="view-comment-heading"><strong>댓글목록 <span class="color-red"><?php echo number_format($view['wr_comment']); ?></span></strong></h4>
        <?php for ($i=0; $i<$cmt_amt; $i++) { ?>
        <h2><?php echo $cmt[$i]['wr_name']; ?>님의 <?php if ($cmt[$i]['cmt_depth']) { ?><span class="sound_only">댓글의</span><?php } ?> 댓글</h2>
        <div id="c_<?php echo $cmt[$i]['comment_id']; ?><?php if ($cmt[$i]['is_cmt_best']) { ?>_<?php echo $cmt[$i]['cmt_depth']; ?><?php } ?>" class="view-comment-item <?php if ($cmt[$i]['is_cmt_best']) { ?>cmt-best<?php }  ?>" style="<?php if ($cmt[$i]['cmt_depth'] && !$cmt[$i]['is_cmt_best']) { ?>margin-left:<?php echo $cmt[$i]['cmt_depth']; ?>px;<?php }  ?>">
            <?php if ($cmt[$i]['is_cmt_best']) { ?>
            <div class="view-cmtgo-btn cmtgo-btn-<?php echo $i+1; ?> tooltips" data-toggle="tooltip" data-placement="top" data-original-title="원글 위치로 이동"><i class="fa fa-arrow-down"></i></div>
            <div class="view-comment-best-label best-label-<?php echo $i; ?>">베스트 <?php echo $i+1; ?></div>
            <?php } ?>
            <?php if ($cmt[$i]['cmt_depth']) { ?>
            <div class="view-comment-depth"><i class="fas fa-caret-right"></i></div>
            <?php } ?>
            <?php if ($eyoom_board['bo_use_profile_photo'] == 1) { ?>
            <div class="view-comment-photo <?php if (!$cmt[$i]['cmt_depth']) { ?>no-depth-photo<?php }  ?>">
                <?php if ($cmt[$i]['mb_photo']) { ?>
                <?php echo $cmt[$i]['mb_photo']; ?>
                <?php } else { ?>
                <span class="comment-user-icon"><i class="fas fa-user"></i></span>
                <?php } ?>
            </div>
            <div class="comment-item-body">
            <?php } else { ?>
            <div class="comment-item-body-pn">
            <?php } ?>
                <div class="comment-item-info">
                    <span class="comment-name"><?php echo eb_nameview($cmt[$i]['mb_id'], $cmt[$i]['wr_name'], $cmt[$i]['wr_email'], $cmt[$i]['wr_homepage']); ?></span>
                    <?php if ($cmt[$i]['gnu_icon']) { ?>
                    <span class="comment-lv-icon"><img src="<?php echo $cmt[$i]['gnu_icon']; ?>" align="absmiddle" alt="레벨"></span>
                    <?php } ?>
                    <?php if ($cmt[$i]['eyoom_icon']) { ?>
                    <span class="comment-lv-icon"><img src="<?php echo $cmt[$i]['eyoom_icon']; ?>" align="absmiddle" alt="레벨"></span>
                    <?php } ?>
                    <?php if ($cmt[$i]['is_cmt_best']) { ?>
                    <span class="badge badge-yellow">베스트 댓글 <?php echo $i+1; ?></span>
                    <?php } ?>
                    <?php if ($is_ip_view) { ?>
                    <span class="comment-ip"><?php echo $cmt[$i]['ip']; ?></span>
                    <?php } ?>
                    <span class="comment-time">
                        <?php if ($eyoom_board['bo_sel_date_type'] == '1') { ?>
                        <i class="far fa-clock color-grey"></i> <?php echo $eb->date_time('Y.m.d H:i', $cmt[$i]['datetime']); ?>
                        <?php } else if ($eyoom_board['bo_sel_date_type'] == '2') { ?>
                        <i class="far fa-clock color-grey"></i> <?php echo $eb->date_format('Y.m.d H:i', $cmt[$i]['datetime']); ?>
                        <?php } ?>
                    </span>
                    <?php if ($eyoom_board['bo_use_yellow_card'] == '1' && $is_member) { ?>
                    <span class="comment-dropdown btn-group">
                        <span class="comment-dropdown-btn dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i class="fas fa-ellipsis-v"></i></span>
                        <ul class="dropdown-menu" role="menu">
                        <?php if (!$cmt[$i]['mb_ycard']['mb_id'] ) { ?>
                            <li id="cmt_yellow_card_li_<?php echo $cmt[$i]['comment_id']; ?>">
                                <a href="javascript:void(0);" id="cmt_yellow_card_<?php echo $cmt[$i]['comment_id']; ?>" class="cmt_yellow_card" data-toggle="modal" data-target=".yellowcard-modal" data-cmt-id="<?php echo $cmt[$i]['comment_id']; ?>">
                                    신고하기 <?php if ($cmt[$i]['yc_count']) { ?><small>(누적 : <span class="color-red"><?php echo number_format($cmt[$i]['yc_count']); ?></span>)</small><?php } ?>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li id="cancel_cmt_yellow_card_li_<?php echo $cmt[$i]['comment_id']; ?>">
                                <a href="javascript:void(0);" id="cancel_cmt_yellow_card_<?php echo $cmt[$i]['comment_id']; ?>" class="cancel_cmt_yellow_card" data-cmt-id="<?php echo $cmt[$i]['comment_id']; ?>">
                                    신고취소 <small>(누적 : <span class="color-red"><?php echo number_format($cmt[$i]['yc_count']); ?></span>)</small>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($blind_direct) { ?>
                            <?php if ($cmt[$i]['yc_blind'] != 'y') { ?>
                            <li>
                                <a href="javascript:void(0);" id="direct_cmt_blind_li_<?php echo $cmt[$i]['comment_id']; ?>" class="btn-cmt-blind" data-cmt-id="<?php echo $cmt[$i]['comment_id']; ?>">블라인드</a>
                            </li>
                            <?php } else if ($cmt[$i]['yc_blind'] == 'y') { ?>
                            <li>
                                <a href="javascript:void(0);" id="cancel_cmt_blind_li_<?php echo $cmt[$i]['comment_id']; ?>" class="btn-cmt-blind" data-cmt-id="<?php echo $cmt[$i]['comment_id']; ?>">블라인드 취소</a>
                            </li>
                            <?php } ?>
                        <?php } ?>
                        </ul>
                    </span>
                    <?php } ?>
                </div>
                <div class="comment-item-content">
                    <?php if ($cmt[$i]['yc_blind'] && $cmt[$i]['yc_cannotsee']) { ?>
                    <p class="margin-top-10 margin-bottom-10"><span class="color-orange">----- <i class="fas fa-exclamation-circle"></i> 블라인드 처리된 댓글입니다. -----</span></p>
                    <?php } else { ?>
                    <?php if ($cmt[$i]['count_cmtfile'] > 0) { ?>
                    <div class="comment-file-wrap">
                        <?php
                            $cmtfile = $cmt[$i]['cmtfile'];
                            foreach ($cmtfile as $k => $cmt_file) {
                                if (!$cmt_file['source']) continue;
                        ?>
                            <div class="comment-file-item">
                                <div class="pull-left">
                                    - 첨부파일 : <strong><?php echo $cmt_file['source']; ?></strong> <?php echo $cmt_file['content']; ?> (<?php echo get_filesize($cmt_file['filesize']); ?>) - <a href="<?php echo $cmt_file['href']; ?>" class="view_file_download"><u>다운로드</u></a>
                                </div>
                                <div class="pull-right text-right hidden-xs">
                                    <span><i class="fas fa-download"></i><?php echo $cmt_file['download'] ? number_format($cmt_file['download']): 0; ?></span>
                                    <span><i class="far fa-clock"></i><?php echo $cmt_file['datetime']; ?></span>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    <div class="comment-cont-wrap">
                        <?php if ($cmt[$i]['yc_blind']) { ?>
                        <p class="margin-top-10 margin-bottom-10"><span class="color-orange">----- <i class="fas fa-exclamation-circle"></i> 블라인드 처리된 댓글입니다. -----</span></p>
                        <?php } ?>
                        <?php if (strstr($cmt[$i]['wr_option'], 'secret')) { ?><i class="fas fa-lock color-red"></i> <?php } ?>
                        
                        <?php if ($cmt[$i]['count_cmtimg'] > 0) { ?>
                        <div class="comment-cont-img">
                            <?php
                                $cmtimg = $cmt[$i]['cmtimg'];
                                foreach ($cmtimg as $k => $cmt_img) {
                            ?>
                            <div class="thumbnail comment-image">
                                <div class="thumb">
                                    <img src="<?php echo $cmt_img['imgsrc']; ?>" alt="">
                                    <div class="caption-overflow">
                                        <span>
                                            <a href="<?php echo $cmt_img['imgsrc']; ?>" class="btn-e btn-e-default btn-e-lg btn-e-brd"><i class="fas fa-plus color-white"></i></a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <?php } ?>
                        <div class="comment-cont-txt">
                            <?php if ($cmt[$i]['yc_blind']) { ?>
                            <div class="comment-yello-card">
                            <?php } ?>
                            <?php echo $cmt[$i]['comment']; ?>
                            <?php if ($cmt[$i]['yc_blind']) { ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="margin-bottom-10"></div>
                    <?php if ($cmt[$i]['firstcmt_point']) { ?>
                    <div class="alert alert-warning first-comment">
                        <p><i class="far fa-comments font-size-18 margin-right-10"></i>축하합니다. <strong class="color-black">첫댓글 포인트</strong> <strong class="color-red"><?php echo $cmt[$i]['firstcmt_point']; ?><?php echo $levelset['gnu_name']; ?></strong>를 획득하였습니다.</p>
                    </div>
                    <?php } ?>
                    <?php if ($cmt[$i]['bomb_point']) { ?>
                    <div class="alert alert-danger bomb-comment">
                        <p><i class="fas fa-bomb font-size-18 margin-right-10"></i>축하합니다. <strong class="color-black">지뢰폭탄 포인트</strong> <strong class="color-red"><?php echo $cmt[$i]['bomb_point']; ?><?php echo $levelset['gnu_name']; ?></strong>를 획득하였습니다.</p>
                    </div>
                    <?php } ?>
                    <?php if ($cmt[$i]['lucky_point']) { ?>
                    <div class="alert alert-success lucky-comment">
                        <p><i class="far fa-hand-peace font-size-18 margin-right-10"></i>축하합니다. <strong class="color-black">행운의 포인트</strong> <strong class="color-red"><?php echo $cmt[$i]['lucky_point']; ?><?php echo $levelset['gnu_name']; ?></strong>를 획득하였습니다.</p>
                    </div>
                    <?php } ?>
                </div>
                <div class="comment-btn-wrap">
                    <?php if ($cmt[$i]['is_reply'] || $cmt[$i]['is_edit'] || $cmt[$i]['is_del'] || $cmt[$i]['c_good_href'] || $cmt[$i]['c_nogood_href']) { ?>
                    <div class="comment-btn-right">
                        <?php if ($cmt[$i]['is_reply']) { ?>
                        <a href="<?php echo $cmt[$i]['c_reply_href']; ?>" onclick="comment_box('<?php echo $cmt[$i]['comment_id']; ?><?php if ($cmt[$i]['is_cmt_best']) { ?>_<?php echo $cmt[$i]['cmt_depth']; ?><?php } ?>', 'c'); return false;" class="comment-btn bg-red">댓글쓰기</a>
                        <?php } ?>
                        <?php if ($cmt[$i]['is_edit']) { ?>
                        <a href="<?php echo $cmt[$i]['c_edit_href']; ?>" onclick="comment_box('<?php echo $cmt[$i]['comment_id']; ?><?php if ($cmt[$i]['is_cmt_best']) { ?>_<?php echo $cmt[$i]['cmt_depth']; ?><?php } ?>', 'cu'); return false;" class="comment-btn">수정</a>
                        <?php } ?>
                        <?php if ($cmt[$i]['is_del']) { ?>
                        <a href="<?php echo $cmt[$i]['del_link']; ?>" class="comment-btn comment_delete">삭제</a>
                        <?php } ?>
                        <?php if ($cmt[$i]['c_good_href']) { ?>
                        <a href="<?php echo $cmt[$i]['c_good_href']; ?>" id="goodcmt_button_<?php echo $cmt[$i]['comment_id']; ?>" class="goodcmt_button comment-btn" title="추천"><i class="far fa-thumbs-up"></i> <strong class="board-cmt-act-good"><?php if ($cmt[$i]['good']) { ?><span class="color-yellow"><?php echo $cmt[$i]['good']; ?></span><?php } else { ?><span class="color-light-grey">0</span><?php }  ?></strong></a>
                        <?php } ?>
                        <?php if ($cmt[$i]['c_nogood_href']) { ?>
                        <a href="<?php echo $cmt[$i]['c_nogood_href']; ?>" id="nogoodcmt_button_<?php echo $cmt[$i]['comment_id']; ?>" class="nogoodcmt_button comment-btn" title="비추천"><i class="far fa-thumbs-down"></i> <strong class="board-cmt-act-nogood"><?php if ($cmt[$i]['nogood']) { ?><span class="color-light-grey"><?php echo $cmt[$i]['nogood']; ?></span><?php } else { ?><span class="color-light-grey">0</span><?php }  ?></strong></a>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
                <div class="clearfix"></div>

                <span id="edit_<?php echo $cmt[$i]['comment_id']; ?><?php if ($cmt[$i]['is_cmt_best']) { ?>_<?php echo $cmt[$i]['cmt_depth']; ?><?php } ?>"></span><?php /* 수정 */ ?>
                <span id="reply_<?php echo $cmt[$i]['comment_id']; ?><?php if ($cmt[$i]['is_cmt_best']) { ?>_<?php echo $cmt[$i]['cmt_depth']; ?><?php } ?>"></span><?php /* 답변 */ ?>

                <input type="hidden" value="<?php echo strstr($cmt[$i]['wr_option'],'secret'); ?>" id="secret_comment_<?php echo $cmt[$i]['comment_id']; ?>">
                <input type="hidden" value="<?php echo $cmt[$i]['is_anonymous']; ?>" id="anonymous_id_<?php echo $cmt[$i]['comment_id']; ?>">
                <input type="hidden" value="<?php echo $cmt[$i]['cmt_attach']; ?>" id="cmt_attach_<?php echo $cmt[$i]['comment_id']; ?>">
                <textarea id="save_comment_<?php echo $cmt[$i]['comment_id']; ?><?php if ($cmt[$i]['is_cmt_best']) { ?>_<?php echo $cmt[$i]['cmt_depth']; ?><?php } ?>" style="display:none"><?php echo $cmt[$i]['content1']; ?></textarea>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php } ?>
        <?php if ($cmt_amt == 0) { ?>
        <div class="view-comment-no-item">
            <span id="bo_vc_empty" class="no-comment"><i class="fas fa-exclamation-circle"></i> 등록된 댓글이 없습니다.</span>
        </div>
        <?php } ?>
    </div>
    <?php if ($eyoom_board['bo_use_cmt_infinite'] == '1') { ?>
    <div id="infinite_pagination">
        <a class="next" href="<?php echo get_eyoom_pretty_url($bo_tabl,$wr_id,'&amp;sca='.$sca.'&amp;cpage='.($cpage+1)); ?>"></a>
    </div>
    <?php if (count($cmt_list) > 20 ) { ?>
    <div class="view-comment-more">
        <a id="view-comment-more" href="#" class="btn-e btn-e-indigo btn-e-xlg">댓글 더보기</a>
    </div>
    <?php } ?>
    <?php } ?>
    <?php /* 댓글 목록 끝 */ ?>

    <?php /* 댓글 쓰기 시작 */ ?>
    <?php if ($is_comment_write) { ?>
    <div id="view-comment-write" class="view-comment-write">
        <form name="fviewcomment" action="<?php echo G5_BBS_URL; ?>/write_comment_update.php" onsubmit="return fviewcomment_submit(this);" method="post" autocomplete="off" class="eyoom-form view-comment-write-box" enctype="multipart/form-data">
            <input type="hidden" name="w" value="<?php echo !$w ? 'c': $w; ?>" id="w">
            <input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">
            <input type="hidden" name="wr_id" value="<?php echo $wr_id; ?>">
            <input type="hidden" name="comment_id" value="<?php echo $c_id; ?>" id="comment_id">
            <input type="hidden" name="sca" value="<?php echo $sca; ?>">
            <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
            <input type="hidden" name="stx" value="<?php echo $stx; ?>">
            <input type="hidden" name="spt" value="<?php echo $spt; ?>">
            <input type="hidden" name="page" value="<?php echo $page; ?>">
            <input type="hidden" name="is_good" value="">
            <input type="hidden" name="board_skin_path" value="<?php echo EYOOM_CORE_PATH; ?>/board">
            <input type="hidden" name="cmt_amt" value="<?php echo $cmt_amt; ?>">
            <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
            <input type="hidden" name="eb_1" id="eb_1" value="<?php echo $cmt_eb_1; ?>">
            <input type="hidden" name="eb_2" id="eb_2" value="<?php echo $cmt_eb_2; ?>">
            <input type="hidden" name="eb_3" id="eb_3" value="<?php echo $cmt_eb_3; ?>">
            <input type="hidden" name="eb_4" id="eb_4" value="<?php echo $cmt_eb_4; ?>">
            <input type="hidden" name="eb_5" id="eb_5" value="<?php echo $cmt_eb_5; ?>">
            <input type="hidden" name="eb_6" id="eb_6" value="<?php echo $cmt_eb_6; ?>">
            <input type="hidden" name="eb_7" id="eb_7" value="<?php echo $cmt_eb_7; ?>">
            <input type="hidden" name="eb_8" id="eb_8" value="<?php echo $cmt_eb_8; ?>">
            <input type="hidden" name="eb_9" id="eb_9" value="<?php echo $cmt_eb_9; ?>">
            <input type="hidden" name="eb_10" id="eb_10" value="<?php echo $cmt_eb_10; ?>">

            <h4 class="comment-write-heading">
                <strong>댓글쓰기</strong>
                <?php if ($eyoom_board['bo_use_point_explain'] == 1) { ?>
                <button type="button" class="btn-e btn-e-xs btn-e-default cmt-point-info-btn" data-toggle="modal" data-target=".cmt-point-info-modal"><i class="fas fa-info-circle"></i> 댓글 포인트 안내</button>
                <?php } ?>
            </h4>
            <div class="comment-write-wrap">
                <div class="row">
                    <?php if (!$is_member) { ?>
                    <section class="col col-4">
                        <label for="wr_name" class="label">이름<strong class="sound_only"> 필수</strong></label>
                        <label class="input required-mark">
                            <i class="icon-append fas fa-user"></i>
                            <input type="text" name="wr_name" value="<?php echo get_cookie('ck_sns_name'); ?>" id="wr_name" required size="5" maxLength="20">
                        </label>
                    </section>
                    <section class="col col-4">
                        <label for="wr_password" class="label">비밀번호<strong class="sound_only"> 필수</strong></label>
                        <label class="input required-mark">
                            <i class="icon-append fas fa-lock"></i>
                            <input type="password" name="wr_password" id="wr_password" required size="10" maxLength="20">
                        </label>
                    </section>
                    <?php } ?>
                    <section class="col col-4">
                        <div class="inline-group">
                            <label class="checkbox"><input type="checkbox" name="wr_secret" value="secret" id="wr_secret"><i></i>비밀글 사용</label>
                            <?php if ($bo_use_anonymous == '1') { ?>
                            <label class="checkbox"><input type="checkbox" name="wr_anonymous" value="1" id="wr_anonymous"><i></i>익명글 사용</label>
                            <?php } ?>
                        </div>
                    </section>
                </div>
                <?php if ($board['bo_use_sns'] && ($config['cf_facebook_appid'] || $config['cf_twitter_key'])) { ?>
                <label class="label">SNS 동시등록</label>
                <div id="bo_vc_send_sns"></div>
                <div class="clearfix"></div>
                <?php } ?>
                <div class="comment-write">
                    <div id="comment-option" class="comment-write-option">
                        <div class="panel panel-default">
                            <div class="panel-in">
                                <div class="panel-in-left">
                                    <?php if ($eyoom_board['bo_use_addon_cmtfile'] == '1') { ?>
                                    <a class="comment-option-btn" data-toggle="collapse" data-parent="#comment-option" href="#collapse-file-cm" title="첨부파일"><i class="fas fa-file"></i><span class="margin-left-5 hidden-xs">첨부파일</span></a>
                                    <?php } ?>
                                    <?php if ($eyoom_board['bo_use_addon_video'] == '1') { ?>
                                    <a class="comment-option-btn" data-toggle="collapse" data-parent="#comment-option" href="#collapse-video-cm" title="동영상"><i class="fab fa-youtube"></i><span class="margin-left-5 hidden-xs">동영상</span></a>
                                    <?php } ?>
                                    <?php if ($eyoom_board['bo_use_addon_soundcloud'] == '1') { ?>
                                    <a class="comment-option-btn" data-toggle="collapse" data-parent="#comment-option" href="#collapse-sound-cm" title="사운드클라우드"><i class="fab fa-soundcloud"></i><span class="margin-left-5 hidden-xs">사운드클라우드</span></a>
                                    <?php } ?>
                                    <?php if ($eyoom_board['bo_use_addon_map'] == '1') { ?>
                                    <a class="comment-option-btn" data-toggle="collapse" data-parent="#comment-option" href="#collapse-map-cm" title="지도"><i class="fas fa-map-marker-alt"></i><span class="margin-left-5 hidden-xs">지도</span></a>
                                    <?php } ?>
                                    <?php if ($eyoom_board['bo_use_addon_coding'] == '1') { ?>
                                    <a class="comment-option-btn" data-toggle="collapse" data-parent="#comment-option" href="#collapse-code-cm" title="코드"><i class="fas fa-code"></i><span class="margin-left-5 hidden-xs">코드</span></a>
                                    <?php } ?>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-in-right">
                                    <?php if ($eyoom_board['bo_use_addon_emoticon'] == '1') { ?>
                                    <a class="comment-option-btn pull-right emoticon" data-vbtype="iframe" title="이모티콘" href="<?php echo EYOOM_CORE_URL; ?>/board/emoticon.php"><i class="far fa-smile"></i><span class="margin-left-5 hidden-xs">이모티콘</span></a>
                                    <?php } ?>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <?php if ($eyoom_board['bo_use_addon_cmtfile'] == '1') { ?>
                            <div id="collapse-file-cm" class="panel-collapse collapse">
                                <div class="comment-collapse-box">
                                    <?php for ($j=0; $j<$eyoom_board['bo_count_cmtfile']; $j++) { ?>
                                    <div class="margin-bottom-5">
                                        <label for="cmt_file_<?php echo $j; ?>" class="input input-file">
                                            <div class="button bg-indigo"><input type="file" id="cmt_file_<?php echo $j; ?>" name="cmt_file[]" value="파일찾기" title="파일첨부 : 용량 <?php echo $upload_max_filesize; ?> 이하만 업로드 가능" onchange="this.parentNode.nextSibling.value = this.value">파일<?php echo $j+1; ?></div><input type="text" readonly>
                                        </label>
                                        <div id="del_cmtfile_<?php echo $j; ?>"></div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if ($eyoom_board['bo_use_addon_video'] == '1') { ?>
                            <div id="collapse-video-cm" class="panel-collapse collapse">
                                <div class="comment-collapse-box">
                                    <div class="input input-button">
                                        <input type="text" id="video_url" placeholder="동영상주소 입력">
                                        <div class="button"><input type="button" id="btn_video" onclick="return false;">적용하기</div>
                                    </div>
                                    <div class="note">
                                        <span class="color-red">*</span> <a href="#" data-toggle="modal" data-target="#modal_comment_video_note"><u>지원 동영상 서비스 목록 보기</u></a>
                                    </div>
                                    <div id="modal_comment_video_note" class="modal fade">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                                    <h4 class="modal-title"><i class="fas fa-play-circle color-grey"></i> <strong>지원 동영상 서비스 목록</strong></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-list-eb">
                                                        <table class="table font-size-12">
                                                            <thead>
                                                                <tr><th>서비스명</th><th>URL 주소</th></tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr><th>유튜브</th><td><a href="https://www.youtube.com" target="_blank">https://www.youtube.com</a></td></tr>
                                                                <tr><th>비메오</th><td><a href="https://vimeo.com" target="_blank">https://vimeo.com</a></td></tr>
                                                                <tr><th>네이버 TV</th><td><a href="http://tv.naver.com" target="_blank">http://tv.naver.com</a></td></tr>
                                                                <tr><th>카카오 TV</th><td><a href="https://tv.kakao.com" target="_blank">https://tv.kakao.com</a></td></tr>
                                                                <tr><th>테드</th><td><a href="https://www.ted.com" target="_blank">https://www.ted.com</a></td></tr>
                                                                <tr><th>판도라</th><td><a href="http://www.pandora.tv" target="_blank">http://www.pandora.tv</a></td></tr>
                                                                <tr><th>데일리모션</th><td><a href="https://www.dailymotion.com" target="_blank">https://www.dailymotion.com</a></td></tr>
                                                                <tr><th>슬라이더쉐어</th><td><a href="https://www.slideshare.net" target="_blank">https://www.slideshare.net</a></td></tr>
                                                                <tr><th>유쿠</th><td><a href="http://www.youku.com" target="_blank">http://www.youku.com</a></td></tr>
                                                                <tr><th>iQiyi</th><td><a href="http://www.iqiyi.com" target="_blank">http://www.iqiyi.com</a></td></tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button data-dismiss="modal" class="btn-e btn-e-lg btn-e-dark" type="button"><i class="fas fa-times"></i> 닫기</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if ($eyoom_board['bo_use_addon_soundcloud'] == '1') { ?>
                            <div id="collapse-sound-cm" class="panel-collapse collapse">
                                <div class="comment-collapse-box">
                                    <div class="input input-button">
                                        <input type="text" id="scloud_url" placeholder="사운드클라우드 음원주소 입력">
                                        <div class="button"><input type="button" id="btn_scloud" onclick="return false;">적용하기</div>
                                    </div>
                                    <div class="note">사운드클라우드 바로가기 : <a href="https://soundcloud.com/" target="_blank">https://soundcloud.com/</a></div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if ($eyoom_board['bo_use_addon_map'] == '1') { ?>
                            <div id="collapse-map-cm" class="panel-collapse collapse">
                                <?php if ($config['cf_map_google_id'] || $config['cf_map_naver_id'] || $config['cf_map_daum_id']) { ?>
                                <div class="comment-collapse-box">
                                    <div class="row">
                                        <div class="col col-6 md-margin-bottom-10">
                                            <div class="input input-button">
                                                <i class="icon-prepend fas fa-question-circle"></i>
                                                <input type="text" name="map_zip" id="map_zip" size="5" maxlength="6" readonly>
                                                <b class="tooltip tooltip-top-left">우편번호 - 우측 <span class="color-yellow">주소검색</span> 클릭하여 검색</b>
                                                <div class="button"><input type="button" onclick="win_zip('fviewcomment', 'map_zip', 'map_addr1', 'map_addr2', 'map_addr3', 'map_addr_jibeon');"><i class="fas fa-search"></i> 주소검색</div>
                                            </div>
                                        </div>
                                        <div class="col col-6 inline-group">
                                            <?php if ($config['cf_map_google_id']) { ?>
                                            <label class="radio" for="map_type_1">
                                                <input type="radio" name="map_type" id="map_type_1" value="1" checked="checked"><i class="rounded-x"></i> Google지도
                                            </label>
                                            <?php } ?>
                                            <?php if ($config['cf_map_naver_id']) { ?>
                                            <label class="radio" for="map_type_2">
                                                <input type="radio" name="map_type" id="map_type_2" value="2" <?php echo !$config['cf_map_google_id'] ? 'checked':''; ?>><i class="rounded-x"></i> 네이버지도
                                            </label>
                                            <?php } ?>
                                            <?php if ($config['cf_map_daum_id']) { ?>
                                            <label class="radio" for="map_type_3">
                                                <input type="radio" name="map_type" id="map_type_3" value="3" <?php echo !$config['cf_map_google_id'] && !$config['cf_map_naver_id'] ? 'checked':''; ?>><i class="rounded-x"></i> 다음지도
                                            </label>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="margin-bottom-10"></div>
                                    <div class="row">
                                        <div class="col col-12">
                                            <label class="input">
                                                <input type="text" name="map_addr1" id="map_addr1" size="50">
                                            </label>
                                            <div class="note margin-bottom-10"><strong>Note:</strong> 기본주소</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-6">
                                            <label class="input">
                                                <input type="text" name="map_addr2" id="map_addr2" size="50">
                                            </label>
                                            <div class="note margin-bottom-10"><strong>Note:</strong> 상세주소</div>

                                        </div>
                                        <div class="col col-6">
                                            <label class="input">
                                                <input type="text" name="map_name" id="map_name" size="50">
                                            </label>
                                            <div class="note margin-bottom-10"><strong>Note:</strong> 장소명</div>
                                        </div>
                                    </div>
                                    <div class="margin-hr-10"></div>
                                    <div class="row">
                                        <div class="col col-12">
                                            <input type="hidden" name="map_addr3" id="map_addr3" value="">
                                            <input type="hidden" name="map_addr_jibeon" value="">
                                            <div class="text-center">
                                                <button type="button" class="btn-e btn-e-lg btn-e-red" id="btn_map" onclick="return false;">적용하기</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } else if ($is_admin) { ?>
                                <div class="comment-collapse-box text-center">
                                    <p><i class="fas fa-exclamation-circle"></i> 먼저 지도 API ID를 신청 및 설정을 하셔야 합니다.</p>
                                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=config&amp;pid=config_form#anc_cf_map" class="btn-e btn-e-xs btn-e-dark margin-left-5">지도 API 설정 바로가기</a>
                                </div>
                                <?php } ?>
                            </div>
                            <?php } ?>
                            <?php if ($eyoom_board['bo_use_addon_coding'] == '1') { ?>
                            <div id="collapse-code-cm" class="panel-collapse collapse">
                                <div class="comment-collapse-box">
                                    <button type="button" class="ch_code btn-e btn-e-xs btn-e-default" onclick="return false;">HTML</button>
                                    <button type="button" class="ch_code btn-e btn-e-xs btn-e-default" onclick="return false;">CSS</button>
                                    <button type="button" class="ch_code btn-e btn-e-xs btn-e-default" onclick="return false;">JS</button>
                                    <button type="button" class="ch_code btn-e btn-e-xs btn-e-default" onclick="return false;">PHP</button>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <label class="textarea textarea-resizable">
                        <?php if ($comment_min || $comment_max) { ?><strong id="char_cnt"><span id="char_count"></span>글자</strong><?php } ?>
                        <textarea rows="7" id="wr_content" name="wr_content" maxlength="10000" required <?php if ($comment_min || $comment_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?php }  ?>><?php echo $c_wr_content; ?></textarea>
                        <?php if ($comment_min || $comment_max) { ?><script> check_byte('wr_content', 'char_count'); </script><?php } ?>
                        <script>
                        $("textarea#wr_content[maxlength]").live("keyup change", function() {
                            var str = $(this).val()
                            var mx = parseInt($(this).attr("maxlength"))
                            if (str.length > mx) {
                                $(this).val(str.substr(0, mx));
                                return false;
                            }
                        });
                        </script>
                    </label>
                    <div class="comment-write-footer"><strong>Note:</strong> 댓글은 자신을 나타내는 얼굴입니다. 무분별한 댓글, 욕설, 비방 등을 삼가하여 주세요.</div>
                </div>
                <?php if (!$is_member) { ?>
                <div class="margin-bottom-20">
                    <label class="label">자동등록방지</label>
                    <div class="vc-captcha"><?php echo $captcha_html; ?></div>
                </div>
                <?php } ?>
            </div>
            <div class="comment-write-submit">
                <button type="submit" id="btn_submit" class="btn-e btn-e-xlg btn-e-red" value="댓글등록">댓글등록</button>
            </div>
        </form>
    </div>
    <?php if ($eyoom_board['bo_use_point_explain'] == 1) { ?>
    <div class="modal fade cmt-point-info-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"><strong>댓글 포인트 안내</strong></h4>
                </div>
                <div class="modal-body">
                <?php if ($eyoom_board['bo_firstcmt_point'] > 0) { ?>
                    <div class="panel panel-dark">
                        <div class="panel-heading">
                            <h4 class="panel-title"><span class="font-size-14"><i class="far fa-comments"></i> 첫댓글 포인트</span></h4>
                        </div>
                        <div class="panel-body">
                            <?php if ($eyoom_board['bo_firstcmt_point_type'] == 1) { ?>
                            <p>첫 댓글을 작성하는 회원에게 최대 <strong><u><?php echo $eyoom_board['bo_firstcmt_point']; ?><?php echo $levelset['gnu_name']; ?> 이내에서 랜덤으로 첫댓글<?php echo $levelset['gnu_name']; ?></u></strong>를 지급합니다.</p>
                            <?php } else { ?>
                            <p>첫 댓글을 작성하는 회원에게 <strong class="color-red"><?php echo $eyoom_board['bo_firstcmt_point']; ?><?php echo $levelset['gnu_name']; ?></strong>를 첫댓글<?php echo $levelset['gnu_name']; ?>로 지급합니다.</p>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($eyoom_board['bo_bomb_point'] > 0) { ?>
                    <div class="panel panel-dark">
                        <div class="panel-heading">
                            <h4 class="panel-title"><span class="font-size-14"><i class="fas fa-bomb"></i> 지뢰폭탄 포인트</span></h4>
                        </div>
                        <div class="panel-body">
                            <p>지뢰폭탄이 총<strong><u><?php echo number_format($eyoom_board['bo_bomb_point_limit']); ?></u></strong>개 매설되어 있습니다.</p>
                            <?php if ($eyoom_board['bo_bomb_point_type'] == 1) { ?>
                            <p>댓글을 작성하여 지뢰폭탄을 발견하면 최대 <strong><u><?php echo $eyoom_board['bo_bomb_point']; ?><?php echo $levelset['gnu_name']; ?> 이내에서 랜덤</u></strong>으로 지뢰제거 보상<?php echo $levelset['gnu_name']; ?>로 지급합니다.</p>
                            <?php } else { ?>
                            <p>댓글을 작성하여 지뢰폭탄을 발견하면 <strong><u><?php echo $eyoom_board['bo_bomb_point']; ?><?php echo $levelset['gnu_name']; ?></u></strong>를 지뢰제거 보상<?php echo $levelset['gnu_name']; ?>로 지급합니다.</p>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($eyoom_board['bo_lucky_point'] > 0) { ?>
                    <div class="panel panel-dark">
                        <div class="panel-heading">
                            <h4 class="panel-title"><span class="font-size-14"><i class="far fa-hand-peace"></i> 행운 포인트</span></h4>
                        </div>
                        <div class="panel-body">
                            <?php if ($eyoom_board['bo_lucky_point_type'] == 1) { ?>
                            <p>댓글을 작성하면 <strong><u><?php echo ceil(($eyoom_board['bo_lucky_point_ratio']/100)*100); ?>% 확률</u></strong>로 최대 <strong><u><?php echo $eyoom_board['bo_lucky_point']; ?><?php echo $levelset['gnu_name']; ?> 이내에서 랜덤으로 행운의<?php echo $levelset['gnu_name']; ?></u></strong>를 지급합니다.</p>
                            <?php } else { ?>
                            <p>댓글을 작성하면 <strong><u><?php echo ceil(($eyoom_board['bo_lucky_point_ratio']/100)*100); ?>% 확률</u></strong>로 <strong><u><?php echo $eyoom_board['bo_lucky_point']; ?><?php echo $levelset['gnu_name']; ?></u></strong>를 행운의<?php echo $levelset['gnu_name']; ?>로 지급합니다.</p>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-e btn-e-lg btn-e-dark" data-dismiss="modal"><i class="fas fa-times"></i> 닫기</button>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php } ?>
    <?php /* 댓글 쓰기 끝 */ ?>
</div>

<div class="comment-area-divider"><span class="divider-circle"></span></div>
<div id="map_canvas"></div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/venobox/venobox.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/magnific-popup/magnific-popup.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert/sweetalert.min.js"></script>
<?php if ($eyoom_board['bo_use_cmt_infinite'] == '1') { ?>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/masonry/jquery.masonry.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/infinite-scroll/jquery.infinitescroll.min.js"></script>
<?php } ?>
<script>
$(function() {
    <?php for ($i=0; $i<$cmt_amt; $i++) { ?>
    <?php if ($cmt[$i]['is_cmt_best']) { ?>
    $('.view-cmtgo-btn.cmtgo-btn-<?php echo $i+1; ?>, .view-comment-best-label.best-label-<?php echo $i+1; ?>').on('click', function(e) {
        e.stopPropagation();
        if ($(window).width() >= 992) {
            $('html, body').animate({'scrollTop':$('#c_<?php echo $cmt[$i]['comment_id']; ?>').offset().top-120}, 500);
        } else {
            $('html, body').animate({'scrollTop':$('#c_<?php echo $cmt[$i]['comment_id']; ?>').offset().top-60}, 500);
        }
        return false;
    });
    <?php } ?>
    <?php } ?>
});


var save_before = '';
var save_html = <?php if (($is_member && $board['bo_comment_level'] <= $member['mb_level']) || ($is_guest && $board['bo_comment_level'] == 1)) { ?>document.getElementById('view-comment-write').innerHTML<?php } else { ?>''<?php }  ?>;

<?php if ($eyoom_board['bo_use_addon_emoticon'] == '1') { ?>
function set_emoticon(emoticon) {
    var type='emoticon';
    set_textarea_contents(type,emoticon);
}
<?php } ?>

<?php if ($eyoom_board['bo_use_addon_map'] == '1' && ($config['cf_map_google_id'] || $config['cf_map_naver_id'] || $config['cf_map_daum_id'])) { ?>
function set_map_address(map_type, map_addr1, map_addr2, map_name) {
    switch(map_type) {
        case '1':
            <?php if ($config['cf_map_google_id']) { ?>
            set_map_google_address(map_type, map_addr1, map_addr2, map_name);
            <?php }?>
            break;
        case '2':
            <?php if ($config['cf_map_naver_id']) { ?>
            set_map_naver_address(map_type, map_addr1, map_addr2, map_name);
            <?php }?>
            break;
        case '3':
            <?php if ($config['cf_map_daum_id']) { ?>
            set_map_daum_address(map_type, map_addr1, map_addr2, map_name);
            <?php }?>
            break;
    }
}

<?php if ($config['cf_map_google_id']) { ?>
function set_map_google_address(map_type, map_addr1, map_addr2, map_name) {
    var map = new google.maps.Map(document.getElementById('map_canvas'), {
        zoom: 8,
        center: {lat: -34.397, lng: 150.644}
    });
    var geocoder = new google.maps.Geocoder();

    var address = map_addr1 + " " + map_addr2;
    geocoder.geocode({'address': map_addr1}, function(results, status) {
        if (status === 'OK') {
            map.setCenter(results[0].geometry.location);
            var latlng = map.getCenter();
            set_textarea_contents('map', map_type+'^|^'+address+'^|^'+map_name+'^|^'+latlng);
        } else {
            swal({
                title: "중요!",
                text: "잘못된 주소입니다.",
                confirmButtonColor: "#FF4848",
                type: "error",
                confirmButtonText: "확인"
            });
        }
    });
}
<?php }?>

<?php if ($config['cf_map_naver_id']) { ?>
function set_map_naver_address(map_type, map_addr1, map_addr2, map_name) {
    var address = map_addr1 + " " + map_addr2;

    naver.maps.Service.geocode({
        address: map_addr1
    }, function(status, response) {
        if (status !== naver.maps.Service.Status.OK) {
            swal({
                title: "중요!",
                text: "잘못된 주소입니다.",
                confirmButtonColor: "#FF4848",
                type: "error",
                confirmButtonText: "확인"
            });
        }

        var item = response.result.items[0],
            point = new naver.maps.Point(item.point.x, item.point.y);

        var latlng = '('+point.y+', '+point.x+')';
        set_textarea_contents('map', map_type+'^|^'+address+'^|^'+map_name+'^|^'+latlng);
    });
}
<?php }?>

<?php if ($config['cf_map_daum_id']) { ?>
function set_map_daum_address(map_type, map_addr1, map_addr2, map_name) {
    var address = map_addr1 + " " + map_addr2;

    var mapContainer = document.getElementById('map_canvas'), // 지도를 표시할 div
        mapOption = {
            center: new daum.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
            level: 3 // 지도의 확대 레벨
        };

    // 지도를 생성합니다
    var map = new daum.maps.Map(mapContainer, mapOption);

    // 주소-좌표 변환 객체를 생성합니다
    var geocoder = new daum.maps.services.Geocoder();

    // 주소로 좌표를 검색합니다
    geocoder.addressSearch(map_addr1, function(result, status) {
        // 정상적으로 검색이 완료됐으면
        if (status === daum.maps.services.Status.OK) {
            var latlng = new daum.maps.LatLng(result[0].y, result[0].x);
            set_textarea_contents('map', map_type+'^|^'+address+'^|^'+map_name+'^|^'+latlng);
        }
    });
}
<?php }?>

<?php } ?>

function set_textarea_contents(type,value) {
    var type_text = '';
    var content = '';
    switch(type) {
        case 'emoticon': type_text = '이모티콘'; break;
        case 'video': type_text = '동영상'; break;
        case 'code': type_text = 'code'; break;
        case 'sound': type_text = 'soundcloud'; break;
        case 'map': type_text = '지도'; break;
    }
    if (type_text != 'code') {
        content = '{'+type_text+':'+value+'}';
    } else {
        content = '{code:'+value+'}\n\n{/code}\n'
    }
    var wr_html = $("#wr_content").val();
    var wr_emo = content;
    wr_html += wr_emo;
    $("#wr_content").val(wr_html);
}

function good_and_write() {
    var f = document.fviewcomment;
    if (fviewcomment_submit(f)) {
        f.is_good.value = 1;
        f.submit();
    } else {
        f.is_good.value = 0;
    }
}

function fviewcomment_submit(f) {
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자

    f.is_good.value = 0;

    var subject = "";
    var content = "";
    $.ajax({
        url: g5_bbs_url+"/ajax.filter.php",
        type: "POST",
        data: {
            "subject": "",
            "content": f.wr_content.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            subject = data.subject;
            content = data.content;
        }
    });

    if (content) {
        swal({
            html: true,
            title: "중요!",
            text: "내용에 금지단어 '<strong class='color-red'>"+content+"</strong>' 단어가 포함되어있습니다.",
            confirmButtonColor: "#FF4848",
            type: "error",
            confirmButtonText: "확인"
        });
        f.wr_content.focus();
        return false;
    }

    // 양쪽 공백 없애기
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자
    document.getElementById('wr_content').value = document.getElementById('wr_content').value.replace(pattern, "");
    if (char_min > 0 || char_max > 0) {
        check_byte('wr_content', 'char_count');
        var cnt = parseInt(document.getElementById('char_count').innerHTML);
        if (char_min > 0 && char_min > cnt) {
            swal({
                html: true,
                title: "중요!",
                text: "댓글은 <strong class='color-red'>"+char_min+"</strong> 글자 이상 쓰셔야 합니다.",
                confirmButtonColor: "#FF4848",
                type: "error",
                confirmButtonText: "확인"
            });
            return false;
        } else if (char_max > 0 && char_max < cnt) {
            swal({
                html: true,
                title: "중요!",
                text: "댓글은 <strong class='color-red'>"+char_max+"</strong> 글자 이하로 쓰셔야 합니다.",
                confirmButtonColor: "#FF4848",
                type: "error",
                confirmButtonText: "확인"
            });
            return false;
        }
    }
    else if (!document.getElementById('wr_content').value) {
        swal({
            title: "중요!",
            text: "댓글을 입력하여 주십시오.",
            confirmButtonColor: "#FF4848",
            type: "error",
            confirmButtonText: "확인"
        });
        return false;
    }

    if (typeof(f.wr_name) != 'undefined') {
        f.wr_name.value = f.wr_name.value.replace(pattern, "");
        if (f.wr_name.value == '') {
            swal({
                title: "중요!",
                text: "이름이 입력되지 않았습니다.",
                confirmButtonColor: "#FF4848",
                type: "error",
                confirmButtonText: "확인"
            });
            f.wr_name.focus();
            return false;
        }
    }

    if (typeof(f.wr_password) != 'undefined') {
        f.wr_password.value = f.wr_password.value.replace(pattern, "");
        if (f.wr_password.value == '') {
            swal({
                title: "중요!",
                text: "비밀번호가 입력되지 않았습니다.",
                confirmButtonColor: "#FF4848",
                type: "error",
                confirmButtonText: "확인"
            });
            f.wr_password.focus();
            return false;
        }
    }

    <?php if ($is_guest) echo chk_captcha_js();  ?>

    set_comment_token(f);

    document.getElementById("btn_submit").disabled = "disabled";

    return true;
}

function comment_box(comment_id, work) {
    var el_id;
    // 댓글 아이디가 넘어오면 답변, 수정
    if (comment_id) {
        if (work == 'c')
            el_id = 'reply_' + comment_id;
        else
            el_id = 'edit_' + comment_id;
    }
    else
        el_id = 'view-comment-write';

    if (save_before != el_id) {
        if (save_before) {
            document.getElementById(save_before).style.display = 'none';
            document.getElementById(save_before).innerHTML = '';
        }

        document.getElementById(el_id).style.display = '';
        document.getElementById(el_id).innerHTML = save_html;
        // 댓글 수정
        if (work == 'cu') {
            document.getElementById('wr_content').value = document.getElementById('save_comment_' + comment_id).value;
            if (typeof char_count != 'undefined')
                check_byte('wr_content', 'char_count');
            if (document.getElementById('secret_comment_'+comment_id).value)
                document.getElementById('wr_secret').checked = true;
            else
                document.getElementById('wr_secret').checked = false;
            <?php if ($bo_use_anonymous == '1') { ?>
            if (document.getElementById('anonymous_id_'+comment_id).value == 'y')
                document.getElementById('wr_anonymous').checked = true;
            else
                document.getElementById('wr_anonymous').checked = false;
            <?php } ?>
            var cmt_attach = document.getElementById('cmt_attach_' + comment_id).value;
            if (cmt_attach) {
                var cmtfile = cmt_attach.split('||');
                var delchk_str = '';
                for (var i=0; i<cmtfile.length; i++) {
                    if (!cmtfile[i]) continue;
                    delchk_str = '<label class="checkbox"><input type="checkbox" name="del_cmtfile['+i+']" value="1"><i></i><span class="font-size-12">파일삭제 ('+cmtfile[i]+')</span></label>';
                    $("#del_cmtfile_"+i).html('');
                    $("#del_cmtfile_"+i).html(delchk_str);
                }
            }
        }

        document.getElementById('comment_id').value = comment_id;
        document.getElementById('w').value = work;

        <?php if ($eyoom_board['bo_use_addon_emoticon'] == '1') { ?>
        $(".emoticon").venobox();
        <?php } ?>

        <?php if ($eyoom_board['bo_use_addon_video'] == '1') { ?>
        //동영상 추가
        $("#btn_video").click(function(){
            var v_url = $("#video_url").val();
            if (!v_url) {
                swal({
                    title: "중요!",
                    text: "동영상 주소를 입력해 주세요.",
                    confirmButtonColor: "#FF4848",
                    type: "error",
                    confirmButtonText: "확인"
                });
            }
            else set_textarea_contents('video',v_url);
            $("#video_url").val('');
        });
        <?php } ?>

        <?php if ($eyoom_board['bo_use_addon_coding'] == '1') { ?>
        //코드 추가
        $(".ch_code").click(function(){
            var ch = $(this).text();
            var val = ch.toLowerCase();
            set_textarea_contents('code',val);
        });
        <?php } ?>

        <?php if ($eyoom_board['bo_use_addon_soundcloud'] == '1') { ?>
        //사운드크라우드 추가
        $("#btn_scloud").click(function(){
            var s_url = $("#scloud_url").val();
            if (!s_url) {
                swal({
                    title: "중요!",
                    text: "사운드클라우드 음원주소를 입력해 주세요.",
                    confirmButtonColor: "#FF4848",
                    type: "error",
                    confirmButtonText: "확인"
                });
            }
            else set_textarea_contents('sound',s_url);
            $("#scloud_url").val('');
        });
        <?php } ?>

        <?php if ($eyoom_board['bo_use_addon_map'] == '1') { ?>
        //지도 추가
        $("#btn_map").click(function(){
            var map_type = $("input[name='map_type']:checked").val();
            var map_addr1 = $("#map_addr1").val();
            var map_addr2 = $("#map_addr2").val();
            var map_name = $("#map_name").val();

            set_map_address(map_type, map_addr1, map_addr2, map_name);
        });
        <?php } ?>

        if (save_before)
            $("#captcha_reload").trigger("click");

        save_before = el_id;
    }
}

//댓글 삭제
$(function() {
    $('.comment_delete').click(function(e){
        e.preventDefault();
        var linkURL = $(this).attr("href");
        comment_delete_link(linkURL);
    });
    function comment_delete_link(linkURL) {
        swal({
            title: "댓글삭제!",
            text: "정말로 이 댓글을 삭제하시겠습니까?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#FDAB29",
            confirmButtonText: "삭제",
            cancelButtonText: "취소",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(){
            window.location.href = linkURL;
        });
    }
});

<?php if (($is_member && $board['bo_comment_level'] <= $member['mb_level']) || ($is_guest && $board['bo_comment_level'] == 1)) { ?>
comment_box('', 'c'); // 댓글 입력폼이 보이도록 처리하기위해서 추가 (root님)
<?php } ?>

<?php if ($board['bo_use_sns'] && ($config['cf_facebook_appid'] || $config['cf_twitter_key'])) { ?>
// sns 등록
$(function() {
    $("#bo_vc_send_sns").load(
        "<?php echo G5_SNS_URL; ?>/view_comment_write.sns.skin.php?bo_table=<?php echo $bo_table; ?>",
        function() {
            save_html = document.getElementById('view-comment-write').innerHTML;
        }
    );
});
<?php } ?>

$(function() {
    // 댓글 추천, 비추천
    $(".goodcmt_button, .nogoodcmt_button").click(function() {
        var $tx;
        if ($(this).attr('title') == "추천") {
            $tx = $(".board-cmt-act-good");
            $good = 'good';
        } else {
            $tx = $(".board-cmt-act-nogood");
            $good = 'nogood';
        }

        excute_goodcmt(this.href, $(this), $tx, $good);
        return false;
    });

    <?php if ($eyoom_board['bo_use_yellow_card'] == '1') { ?>
    // 신고버튼 클릭시, 댓글 cmt_id 설정
    $(".cmt_yellow_card, .cancel_cmt_yellow_card").click(function() {
        var cmt_id = $(this).attr('data-cmt-id');
        $(".yellowcard-modal #modal_cmt_id").val(cmt_id);
    });
    <?php } ?>
});

function excute_goodcmt(href, $el, $tx, $good) {
    $.post(
        href,
        { js: "on" },
        function(data) {
            if (data.error) {
                swal({
                    title: "알림",
                    text: data.error,
                    confirmButtonColor: "#FF4848",
                    type: "warning",
                    confirmButtonText: "확인"
                });
                return false;
            }

            if (data.count) {
                $el.find("strong").text(number_format(String(data.count)));
                if ($good == 'nogood') {
                    swal({
                        title: "알림",
                        text: "이 댓글을 비추천하셨습니다.",
                        confirmButtonColor: "#FF4848",
                        type: "warning",
                        confirmButtonText: "확인"
                    });
                } else if ($good == 'good') {
                    swal({
                        title: "알림",
                        text: "이 댓글을 추천하셨습니다.",
                        confirmButtonColor: "#FF4848",
                        type: "warning",
                        confirmButtonText: "확인"
                    });
                }
            }
        }, "json"
    );
}

$(document).ready(function() {
    $('.comment-image').magnificPopup({
        delegate: 'a',
        type: 'image',
        tLoading: '로딩중...',
        mainClass: 'mfp-img-mobile',
        image: {
            tError: '이미지를 불러올수 없습니다.'
        }
    });
});
</script>
<?php if ($eyoom_board['bo_use_cmt_infinite'] == '1') { ?>
<script>
$(function(){
    var $container = $('.view-comment');
    $container.infinitescroll({
        navSelector  : "#infinite_pagination",
        nextSelector : "#infinite_pagination .next",
        itemSelector : ".view-comment-item",
        loading: {
            finishedMsg: 'END',
            img: '../../../image/loading.gif'
        }
    },
    function( newElements ) {
        var $newElems = $( newElements ).css({ opacity: 0 });
        $newElems.imagesLoaded(function(){
            $newElems.animate({ opacity: 1 });
        });
    });
    $(window).unbind('.infscr');
    $('#view-comment-more').click(function(){
        $container.infinitescroll('retrieve');
        $('#infinite_pagination').show();
        return false;
    });
});
</script>
<?php } ?>