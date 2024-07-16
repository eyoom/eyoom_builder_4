<?php
/**
 * skin file : /theme/THEME_NAME/skin/board/webzine/view_comment.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/venobox/venobox.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/magnific-popup/magnific-popup.min.css" type="text/css" media="screen">',0);
?>

<style>
.comment-area {font-size:.9375rem;margin-top:30px}
.view-comment {position:relative;margin-bottom:40px}
.view-comment h2 {position:absolute;font-size:0;line-height:0;overflow:hidden}
.view-comment .view-comment-heading {font-size:1.375rem;border-bottom:2px solid #757575;padding:10px 0;margin-bottom:30px}
.view-comment .view-comment-item-wrap {position:relative}
.view-comment .view-comment-item-wrap:before {content:"";position:absolute;top:0;left:0;height:100%;width:1px;background-color:#eaeaea}
.view-comment .view-comment-item-wrap:last-child {border-bottom:1px solid #eaeaea}
.view-comment .view-comment-item-wrap.depth-w15 {background-color:rgba(89, 167, 255, 0.05)}
.view-comment .view-comment-item-wrap.depth-w15:before {background-color:rgba(89, 167, 255, 0.3)}
.view-comment .view-comment-item-wrap.depth-w30 {background-color:rgba(255, 138, 102, 0.05)}
.view-comment .view-comment-item-wrap.depth-w30:before {background-color:rgba(255, 138, 102, 0.3)}
.view-comment .view-comment-item-wrap.depth-w45 {background-color:rgba(77, 181, 171, 0.05)}
.view-comment .view-comment-item-wrap.depth-w45:before {background-color:rgba(77, 181, 171, 0.3)}
.view-comment .view-comment-item-wrap.depth-w60 {background-color:rgba(240, 97, 145, 0.05)}
.view-comment .view-comment-item-wrap.depth-w60:before {background-color:rgba(240, 97, 145, 0.4)}
.view-comment .view-comment-item-wrap.depth-w75 {background-color:rgba(255, 189, 95, 0.05)}
.view-comment .view-comment-item-wrap.depth-w75:before {background-color:rgba(255, 189, 95, 0.4)}
.view-comment .view-comment-item-wrap.depth-w90 {background-color:rgba(179, 216, 78, 0.05)}
.view-comment .view-comment-item-wrap.depth-w90:before {background-color:rgba(179, 216, 78, 0.3)}
.view-comment .view-comment-item {position:relative;padding:0 0 20px;background-color:#fff}
.view-comment .view-comment-item:before {content:"";position:absolute;top:0;left:0;height:100%;width:1px;background-color:#eaeaea}
.view-comment .view-comment-item.cmt-best {background-color:rgba(255, 243, 224, 0.4)}
.view-comment .view-comment-item .no-comment {text-align:center;padding:10px 0 20px}
.view-comment .view-comment-no-item {position:relative;padding:20px 0;border-top:1px solid #eaeaea;border-bottom:1px solid #eaeaea;text-align:center}
.view-comment .view-comment-no-item .no-comment {color:#959595}
.view-comment .view-comment-item .view-cmtgo-btn {position:absolute;top:-12px;left:0;width:24px;height:24px;line-height:24px;text-align:center;background:#4b4b4d;color:#fff;font-size:.6875rem;cursor:pointer;z-index:1}
.view-comment .view-comment-item .view-cmtgo-btn:hover {background:#2b2b2e}
.view-comment .view-comment-item .view-comment-best-label {position:absolute;top:-12px;left:24px;width:80px;height:24px;line-height:24px;text-align:center;background:#3949ab;color:#fff;font-size:.75rem;cursor:pointer;z-index:1}
.view-comment .view-comment-depth {position:absolute;top:0;left:0;width:7px;height:97px;border-left:1px solid #757575;border-bottom:1px solid #757575}
.view-comment .view-comment-depth:after {content:"";width:0;height:0;border-style:solid;border-width:5px 0 5px 8px;border-color:transparent transparent transparent #757575;position:absolute;bottom:-6px;right:-8px}
.view-comment .view-comment-photo {position:absolute;top:10px;left:10px;z-index:1}
.view-comment .view-comment-photo img {width:50px;height:50px;border-radius:50%}
.view-comment .view-comment-photo .comment-user-icon {font-size:50px;line-height:1;color:#757575}
.view-comment .view-comment-item.cmt-best .view-comment-photo {top:15px}
.view-comment .view-comment-item.cmt-best .view-comment-depth {display:none}
.view-comment .comment-name .sv_wrap > a {font-weight:400}
.view-comment .comment-item-info {position:relative;padding:10px 20px 10px 70px;margin-bottom:15px;border:1px solid #eaeaea;background-color:#fafafa}
.view-comment .view-comment-item.cmt-best .comment-item-info {padding:15px 20px 10px 70px;border-color:#757575}
.view-comment .view-comment-item.cmt-best .comment-item-body-pn .comment-item-info {padding-left:10px}
.view-comment .comment-item-info > span {margin-right:5px}
.view-comment .comment-ip {font-size:.75rem;color:#959595;margin-left:5px}
.view-comment .comment-time {color:#959595}
.view-comment .comment-dropdown {position:absolute;top:23px;right:0px;display:inline-block}
.view-comment .comment-dropdown-btn {display:inline-block;width:20px;height:20px;line-height:20px;background:#d5d5d5;color:#fff;text-align:center;font-size:.6875rem;border-radius:50%}
.view-comment .comment-dropdown-btn:after {display:none}
.view-comment .comment-dropdown-btn:hover {background:#757575;color:#fff;cursor:pointer;-webkit-transition:all 0.2s linear;-moz-transition:all 0.2s linear;transition:all 0.2s linear}
.view-comment .comment-dropdown .dropdown-menu {left:inherit !important;right:0 !important;background-color:#fff;padding:5px 0;border:1px solid rgba(0,0,0,0.7);box-shadow:none;border-radius:0;margin:0}
.view-comment .comment-dropdown .dropdown-menu a {display:block;padding:5px 10px;color:#151515}
.view-comment .comment-dropdown .dropdown-menu a small {font-size:.6875rem;color:#a5a5a5}
.view-comment .comment-dropdown .dropdown-menu a:hover {background-color:transparent;color:#ab0000}
.view-comment .comment-dropdown:hover .dropdown-menu {display:block}
.view-comment .comment-item-content {position:relative;padding-left:20px}
.view-comment .comment-item-content .comment-file-item {position:relative;border:1px solid #d5d5d5;background:#fafafa;padding:10px;margin-bottom:15px}
.view-comment .comment-item-content .comment-file-item:after {content:"";display:block;clear:both}
.view-comment .comment-item-content .comment-file-item span {margin-left:5px}
.view-comment .comment-item-content .comment-file-item i {color:#959595;margin-right:3px}
.view-comment .comment-item-content .comment-cont-wrap.display-flex {display:flex}
.view-comment .comment-item-content .comment-cont-wrap:after {content:"";display:block;clear:both}
.view-comment .comment-item-content .comment-cont-img {position:relative;width:200px;margin-right:15px}
.view-comment .comment-item-content .comment-cont-txt {position:relative}
.view-comment .comment-item-content .comment-image {display:block;width:200px;margin-bottom:15px}
.view-comment .comment-item-content .comment-yello-card {position:relative;padding:10px;margin-bottom:20px;background:#ffbeaa;border:1px solid #ff9b79;opacity:0.45}
.view-comment .comment-btn-wrap {position:relative;text-align:right;height:22px;margin-top:10px}
.view-comment .comment-btn-wrap .comment-btn-right {position:absolute;top:0;right:0}
.view-comment .comment-btn-wrap .comment-btn {position:relative;float:left;padding:0 15px;height:22px;line-height:22px;cursor:pointer;background:#4b4b4d;font-size:.75rem;color:#fff;margin-left:1px}
.view-comment .comment-btn-wrap .comment-btn:hover {background:#2b2b2e}
.view-comment .comment-item-body-pn .comment-item-info {padding-left:10px}
.view-comment-write {position:relative;margin-bottom:40px}
.comment-area .comment-write-heading {position:relative;font-size:1.375rem;border-bottom:2px solid #757575;padding:10px 0;margin-bottom:15px}
.comment-area .comment-write-heading .cmt-point-info-btn {position:absolute;top:9px;right:0}
.comment-area .comment-write-wrap {position:relative}
.comment-area .comment-write {margin-bottom:20px}
.comment-area .comment-write .comment-write-option {position:relative;background:#fafafa;border:1px solid #d5d5d5;border-bottom:0}
.comment-area .comment-write .comment-write-option .option-btn-wrap {padding:15px}
.comment-area .comment-write .comment-write-option .comment-collapse-box {background:#fff;border-top:1px solid #d5d5d5;padding:15px}
.comment-area .comment-write .comment-write-option .comment-collapse-box label {margin-bottom:0}
.comment-area .comment-write .comment-write-option .comment-collapse-box .btn-e-input {padding:5px 16px}
.comment-area .comment-write .comment-write-footer {position:relative;background:#fafafa;border:1px solid #d5d5d5;border-top:0;padding:15px;color:#959595;font-size:.8125rem}
.comment-area .comment-write-submit {position:relative;text-align:center}
.comment-area #modal_comment_video_note .table-list-eb .table thead>tr>th {text-align:left}
.comment-area .view-comment-more {text-align:center;border-top:1px solid #e5e5e5;padding-top:30px;margin-bottom:40px}
.comment-area .eyoom-form .textarea {margin-bottom:0}
.comment-area .eyoom-form .textarea textarea {border:1px solid #d5d5d5}
#bo_vc_send_sns ul{padding:0;margin:-5px 0 20px;overflow:hidden}
#bo_vc_send_sns li{float:left;margin-right:10px;list-style:none}
#bo_vc_send_sns li input{margin:10px 25px 10px 5px}
#infscr-loading {text-align:center;z-index:100;position:absolute;left:50%;bottom:0;width:200px;margin-left:-100px;padding:10px;background:#000;opacity:0.6;color:#fff}
#map_canvas {width:1000px;height:400px;display:none}
@media (max-width:767px) {
    .view-comment .comment-item-content {padding-left:17px}
    .view-comment .comment-item-content .comment-cont-wrap.display-flex {display:block}
    .view-comment .comment-item-content .comment-cont-img {position:relative;width:100%;margin-right:0}
    .view-comment .comment-item-content .comment-cont-txt {position:relative;width:100%}
    .view-comment .comment-item-content .comment-image {width:100%}
}
</style>

<script>
// 글자수 제한
var char_min = parseInt(<?php echo $comment_min; ?>); // 최소
var char_max = parseInt(<?php echo $comment_max; ?>); // 최대
</script>

<div class="comment-area">
    <?php /* 댓글 목록 시작 */ ?>
    <div class="view-comment">
        <h4 class="view-comment-heading"><strong>댓글목록<span class="text-deep-orange f-s-22r m-l-15"><i class="far fa-comment-dots m-r-5"></i><?php echo number_format($view['wr_comment']); ?></span></strong></h4>
        <?php for ($i=0; $i<$cmt_amt; $i++) { ?>
        <h2><?php echo $cmt[$i]['wr_name']; ?>님의 <?php if ($cmt[$i]['cmt_depth']) { ?><span class="sound_only">댓글의</span><?php } ?> 댓글</h2>
        <div class="view-comment-item-wrap depth-w<?php echo $cmt[$i]['cmt_depth']; ?>">
            <div id="c_<?php echo $cmt[$i]['comment_id']; ?><?php if ($cmt[$i]['is_cmt_best']) { ?>_<?php echo $cmt[$i]['cmt_depth']; ?><?php } ?>" class="view-comment-item <?php if ($cmt[$i]['is_cmt_best']) { ?>cmt-best<?php }  ?>" <?php if ($cmt[$i]['cmt_depth'] && !$cmt[$i]['is_cmt_best']) { ?>style="margin-left:<?php echo $cmt[$i]['cmt_depth']; ?>px;"<?php }  ?>>
                <?php if ($cmt[$i]['is_cmt_best']) { ?>
                <div class="view-cmtgo-btn cmtgo-btn-<?php echo $i+1; ?> tooltips" data-toggle="tooltip" data-placement="top" data-original-title="원글 위치로 이동"><i class="fa fa-arrow-down"></i></div>
                <div class="view-comment-best-label best-label-<?php echo $i+1; ?>">베스트 <?php echo $i+1; ?></div>
                <?php } ?>
                <?php if ($cmt[$i]['cmt_depth']) { ?>
                <div class="view-comment-depth"></div>
                <?php } ?>
                <?php if ($config['cf_use_member_icon']) { ?>
                <div class="view-comment-photo <?php if (!$cmt[$i]['cmt_depth']) { ?>no-depth-photo<?php }  ?>">
                    <?php if ($cmt[$i]['mb_photo']) { ?>
                    <?php echo $cmt[$i]['mb_photo']; ?>
                    <?php } else { ?>
                    <span class="comment-user-icon"><i class="fas fa-user-circle"></i></span>
                    <?php } ?>
                </div>
                <div class="comment-item-body">
                <?php } else { ?>
                <div class="comment-item-body-pn">
                <?php } ?>
                    <div class="comment-item-info">
                        <div class="m-t-3">
                            <span class="comment-name"><?php echo eb_nameview($cmt[$i]['mb_id'], $cmt[$i]['wr_name'], $cmt[$i]['wr_email'], $cmt[$i]['wr_homepage'], $cmt[$i]['mb_id2']); ?></span>
                            <?php if ($cmt[$i]['gnu_icon']) { ?>
                            <span class="comment-lv-icon"><img src="<?php echo $cmt[$i]['gnu_icon']; ?>" align="absmiddle" alt="레벨"></span>
                            <?php } ?>
                            <?php if ($cmt[$i]['eyoom_icon']) { ?>
                            <span class="comment-lv-icon"><img src="<?php echo $cmt[$i]['eyoom_icon']; ?>" align="absmiddle" alt="레벨"></span>
                            <?php } ?>
                            <?php if ($config['cf_use_mbmemo'] && $cmt[$i]['mb_id'] && $is_member && $cmt[$i]['mb_id'] != $member['mb_id'] && $cmt[$i]['is_anonymous'] !='y') { // 회원메모 ?>
                            <a href="<?php echo G5_URL; ?>/page/?pid=mbmemo&amp;mb_id=<?php echo $cmt[$i]['mb_id']; ?>&amp;wmode=1" data-bs-toggle="tooltip" data-bs-placement="top" title="회원메모" class="btn-mbmemo" onclick="mbmemo_modal(this.href); return false;">
                                <span class="label label-dark"><i class="fas fa-user-edit"></i></span>
                            </a>
                            <?php } ?>
                            <?php if ($is_ip_view) { ?>
                            <span class="comment-ip"><?php echo $cmt[$i]['ip']; ?></span>
                            <?php } ?>
                        </div>
                        <div class="m-t-4">
                            <span class="comment-time">
                                <?php if ($eyoom_board['bo_sel_date_type'] == '1') { ?>
                                <i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i', $cmt[$i]['datetime']); ?>
                                <?php } else if ($eyoom_board['bo_sel_date_type'] == '2') { ?>
                                <i class="far fa-clock"></i> <?php echo $eb->date_format('Y-m-d H:i', $cmt[$i]['datetime']); ?>
                                <?php } ?>
                            </span>
                        </div>
                        <?php if ($eyoom_board['bo_use_yellow_card'] == '1' && $is_member) { ?>
                        <span class="comment-dropdown btn-group">
                            <span class="comment-dropdown-btn dropdown-toggle" id="dropdownCommentMenu" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></span>
                            <ul class="dropdown-menu" aria-labelledby="dropdownCommentMenu">
                            <?php if (!$cmt[$i]['mb_ycard']['mb_id'] ) { ?>
                                <li id="cmt_yellow_card_li_<?php echo $cmt[$i]['comment_id']; ?>">
                                    <a href="javascript:void(0);" id="cmt_yellow_card_<?php echo $cmt[$i]['comment_id']; ?>" class="cmt_yellow_card" data-bs-toggle="modal" data-bs-target=".yellowcard-modal" data-cmt-id="<?php echo $cmt[$i]['comment_id']; ?>">
                                        신고하기 <?php if ($cmt[$i]['yc_count']) { ?><small>(누적 : <span class="text-crimson"><?php echo number_format($cmt[$i]['yc_count']); ?></span>)</small><?php } ?>
                                    </a>
                                </li>
                            <?php } else { ?>
                                <li id="cancel_cmt_yellow_card_li_<?php echo $cmt[$i]['comment_id']; ?>">
                                    <a href="javascript:void(0);" id="cancel_cmt_yellow_card_<?php echo $cmt[$i]['comment_id']; ?>" class="cancel_cmt_yellow_card" data-cmt-id="<?php echo $cmt[$i]['comment_id']; ?>">
                                        신고취소 <small>(누적 : <span class="text-crimson"><?php echo number_format($cmt[$i]['yc_count']); ?></span>)</small>
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
                        <p class="m-t-10 m-b-10"><span class="text-pink">----- <i class="fas fa-exclamation-circle"></i> 블라인드 처리된 댓글입니다. -----</span></p>
                        <?php } else { ?>
                        <?php if ($cmt[$i]['count_cmtfile'] > 0) { ?>
                        <div class="comment-file-wrap">
                            <?php
                                $cmtfile = $cmt[$i]['cmtfile'];
                                foreach ($cmtfile as $k => $cmt_file) {
                                    if (!$cmt_file['source']) continue;
                            ?>
                                <div class="comment-file-item">
                                    <div class="float-start">
                                        - 첨부파일 : <strong><?php echo $cmt_file['source']; ?></strong> <?php echo $cmt_file['content']; ?> (<?php echo get_filesize($cmt_file['filesize']); ?>) - <a href="<?php echo $cmt_file['href']; ?>" class="view_file_download"><u>다운로드</u></a>
                                    </div>
                                    <div class="float-end text-end hidden-xs">
                                        <span><i class="fas fa-download"></i><?php echo $cmt_file['download'] ? number_format($cmt_file['download']): 0; ?></span>
                                        <span><i class="far fa-clock"></i><?php echo $cmt_file['datetime']; ?></span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <?php } ?>
                        <div class="comment-cont-wrap <?php if ($cmt[$i]['count_cmtimg'] > 0) { ?>display-flex<?php } ?>">
                            <?php if ($cmt[$i]['yc_blind']) { ?>
                            <p class="m-t-10 m-b-10"><span class="text-pink">----- <i class="fas fa-exclamation-circle"></i> 블라인드 처리된 댓글입니다. -----</span></p>
                            <?php } ?>
                            <?php if (strstr($cmt[$i]['wr_option'], 'secret')) { ?><i class="fas fa-lock text-crimson m-r-10"></i> <?php } ?>
                            
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
                                                <a href="<?php echo $cmt_img['imgsrc']; ?>" class="btn-e btn-light-gray btn-e-lg btn-e-brd"><i class="fas fa-plus text-white"></i></a>
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
                        <div class="m-b-15"></div>
                        <?php if ($cmt[$i]['firstcmt_point']) { ?>
                        <div class="alert alert-warning first-comment">
                            <p class="f-s-13r"><i class="far fa-comment-dots f-s-18r m-r-10"></i>축하합니다. <span class="text-black">첫댓글 포인트</span> <span class="text-crimson"><?php echo $cmt[$i]['firstcmt_point']; ?><?php echo $levelset['gnu_name']; ?></span>를 획득하였습니다.</p>
                        </div>
                        <?php } ?>
                        <?php if ($cmt[$i]['bomb_point']) { ?>
                        <div class="alert alert-danger bomb-comment">
                            <p class="f-s-13r"><i class="fas fa-bomb f-s-18r m-r-10"></i>축하합니다. <span class="text-black">지뢰폭탄 포인트</span> <span class="text-crimson"><?php echo $cmt[$i]['bomb_point']; ?><?php echo $levelset['gnu_name']; ?></span>를 획득하였습니다.</p>
                        </div>
                        <?php } ?>
                        <?php if ($cmt[$i]['lucky_point']) { ?>
                        <div class="alert alert-success lucky-comment">
                            <p class="f-s-13r"><i class="far fa-hand-peace f-s-18r m-r-10"></i>축하합니다. <span class="text-black">행운의 포인트</span> <span class="text-crimson"><?php echo $cmt[$i]['lucky_point']; ?><?php echo $levelset['gnu_name']; ?></span>를 획득하였습니다.</p>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="comment-btn-wrap">
                        <?php if ($cmt[$i]['is_reply'] || $cmt[$i]['is_edit'] || $cmt[$i]['is_del'] || $cmt[$i]['c_good_href'] || $cmt[$i]['c_nogood_href']) { ?>
                        <div class="comment-btn-right">
                            <?php if ($cmt[$i]['is_reply']) { ?>
                            <a href="<?php echo $cmt[$i]['c_reply_href']; ?>" onclick="comment_box('<?php echo $cmt[$i]['comment_id']; ?><?php if ($cmt[$i]['is_cmt_best']) { ?>_<?php echo $cmt[$i]['cmt_depth']; ?><?php } ?>', 'c'); return false;" class="comment-btn bg-navy">댓글쓰기</a>
                            <?php } ?>
                            <?php if ($cmt[$i]['is_edit']) { ?>
                            <a href="<?php echo $cmt[$i]['c_edit_href']; ?>" onclick="comment_box('<?php echo $cmt[$i]['comment_id']; ?><?php if ($cmt[$i]['is_cmt_best']) { ?>_<?php echo $cmt[$i]['cmt_depth']; ?><?php } ?>', 'cu'); return false;" class="comment-btn">수정</a>
                            <?php } ?>
                            <?php if ($cmt[$i]['is_del']) { ?>
                            <a href="<?php echo $cmt[$i]['del_link']; ?>" class="comment-btn comment_delete">삭제</a>
                            <?php } ?>
                            <?php if ($cmt[$i]['c_good_href']) { ?>
                            <a href="<?php echo $cmt[$i]['c_good_href']; ?>" id="goodcmt_button_<?php echo $cmt[$i]['comment_id']; ?>" class="goodcmt_button comment-btn" title="추천"><i class="far fa-thumbs-up"></i> <strong class="board-cmt-act-good"><?php if ($cmt[$i]['good']) { ?><span class="text-amber"><?php echo $cmt[$i]['good']; ?></span><?php } else { ?><span class="text-light-gray">0</span><?php }  ?></strong></a>
                            <?php } ?>
                            <?php if ($cmt[$i]['c_nogood_href']) { ?>
                            <a href="<?php echo $cmt[$i]['c_nogood_href']; ?>" id="nogoodcmt_button_<?php echo $cmt[$i]['comment_id']; ?>" class="nogoodcmt_button comment-btn" title="비추천"><i class="far fa-thumbs-down"></i> <strong class="board-cmt-act-nogood"><?php if ($cmt[$i]['nogood']) { ?><span class="text-light-gray"><?php echo $cmt[$i]['nogood']; ?></span><?php } else { ?><span class="text-light-gray">0</span><?php }  ?></strong></a>
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
    <?php if (count((array)$cmt_list) > 20 ) { ?>
    <div class="view-comment-more">
        <a id="view-comment-more" href="#" class="btn-e btn-e-navy btn-e-xlg">댓글 더보기</a>
    </div>
    <?php } ?>
    <?php } ?>
    <?php /* 댓글 목록 끝 */ ?>

    <?php /* 댓글 쓰기 시작 */ ?>
    <?php if ($is_comment_write) { ?>
    <div id="view-comment-write" class="view-comment-write">
        <form name="fviewcomment" id="fviewcomment" action="<?php echo G5_BBS_URL; ?>/write_comment_update.php" onsubmit="return fviewcomment_submit(this);" method="post" autocomplete="off" class="eyoom-form view-comment-write-box" enctype="multipart/form-data">
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
                <button type="button" class="btn-e btn-gray cmt-point-info-btn" data-bs-toggle="modal" data-bs-target=".cmt-point-info-modal"><i class="fas fa-info-circle"></i> 댓글 포인트 안내</button>
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
                            <label class="checkbox"><input type="checkbox" name="wr_anonymous" value="1" id="wr_anonymous"><i></i><?php echo $eyoom['anonymous_title']; ?>글 사용</label>
                            <?php } ?>
                        </div>
                    </section>
                </div>

                <?php if(0) { // 숨김처리 ?>
                <?php if ($board['bo_use_sns'] && ($config['cf_facebook_appid'] || $config['cf_twitter_key'])) { ?>
                <label class="label">SNS 동시등록</label>
                <div id="bo_vc_send_sns"></div>
                <div class="clearfix"></div>
                <?php } ?>
                <?php } ?>

                <div class="comment-write">
                    <div id="comment_option" class="comment-write-option">
                        <div class="option-btn-wrap clearfix">
                            <div class="float-start">
                                <?php if ($eyoom_board['bo_use_addon_cmtfile'] == '1') { ?>
                                <a class="comment-option-btn btn-e btn-gray" data-bs-toggle="collapse" href="#collapse-file-cm" title="첨부파일"><i class="fas fa-paperclip"></i><span class="m-l-5 hidden-xs">첨부파일</span></a>
                                <?php } ?>
                                <?php if ($eyoom_board['bo_use_addon_video'] == '1') { ?>
                                <a class="comment-option-btn btn-e btn-gray" data-bs-toggle="collapse" href="#collapse-video-cm" title="동영상"><i class="fab fa-youtube"></i><span class="m-l-5 hidden-xs">동영상</span></a>
                                <?php } ?>
                                <?php if ($eyoom_board['bo_use_addon_soundcloud'] == '1') { ?>
                                <a class="comment-option-btn btn-e btn-gray" data-bs-toggle="collapse" href="#collapse-sound-cm" title="사운드클라우드"><i class="fab fa-soundcloud"></i><span class="m-l-5 hidden-xs">사운드클라우드</span></a>
                                <?php } ?>
                                <?php if ($eyoom_board['bo_use_addon_map'] == '1') { ?>
                                <a class="comment-option-btn btn-e btn-gray" data-bs-toggle="collapse" href="#collapse-map-cm" title="지도"><i class="fas fa-map-marker-alt"></i><span class="m-l-5 hidden-xs">지도</span></a>
                                <?php } ?>
                                <?php if ($eyoom_board['bo_use_addon_coding'] == '1') { ?>
                                <a class="comment-option-btn btn-e btn-gray" data-bs-toggle="collapse" href="#collapse-code-cm" title="코드"><i class="fas fa-code"></i><span class="m-l-5 hidden-xs">코드</span></a>
                                <?php } ?>
                            </div>
                            <div class="float-end">
                                <?php if ($eyoom_board['bo_use_addon_emoticon'] == '1') { ?>
                                <a class="comment-option-btn btn-e btn-gray emoticon" data-vbtype="iframe" title="이모티콘" href="<?php echo EYOOM_CORE_URL; ?>/board/emoticon.php"><i class="far fa-smile"></i><span class="m-l-5 hidden-xs">이모티콘</span></a>
                                <?php } ?>
                            </div>
                        </div>
                        <?php if ($eyoom_board['bo_use_addon_cmtfile'] == '1') { ?>
                        <div id="collapse-file-cm" class="collapse" data-bs-parent="#comment_option">
                            <div class="comment-collapse-box">
                                <?php for ($j=0; $j<$eyoom_board['bo_count_cmtfile']; $j++) { ?>
                                <label class="input">
                                    <input type="file" class="form-control" id="cmt_file_<?php echo $j; ?>" name="cmt_file[]" value="사진선택">
                                </label>
                                <div id="del_cmtfile_<?php echo $j; ?>"></div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if ($eyoom_board['bo_use_addon_video'] == '1') { ?>
                        <div id="collapse-video-cm" class="collapse" data-bs-parent="#comment_option">
                            <div class="comment-collapse-box">
                                <div class="input input-button">
                                    <input type="text" id="video_url" placeholder="동영상주소 입력">
                                    <div class="button"><input type="button" id="btn_video" onclick="return false;">적용하기</div>
                                </div>
                                <div class="note">
                                    <span class="text-crimson">*</span> <a href="#" data-bs-toggle="modal" data-bs-target="#modal_comment_video_note"><u>지원 동영상 서비스 목록 보기</u></a>
                                </div>
                                <div id="modal_comment_video_note" class="modal fade" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title f-s-20r"><i class="fas fa-play-circle text-gray m-r-7"></i><strong>지원 동영상 서비스 목록</strong></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="table-list-eb">
                                                    <table class="table">
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
                                                <button data-bs-dismiss="modal" class="btn-e btn-e-sm btn-dark" type="button"><i class="fas fa-times m-r-7"></i>닫기</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if ($eyoom_board['bo_use_addon_soundcloud'] == '1') { ?>
                        <div id="collapse-sound-cm" class="collapse" data-bs-parent="#comment_option">
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
                        <div id="collapse-map-cm" class="collapse" data-bs-parent="#comment_option">
                            <?php if ($config['cf_map_google_id'] || $config['cf_map_naver_id'] || $config['cf_map_daum_id']) { ?>
                            <div class="comment-collapse-box">
                                <div class="row">
                                    <div class="col col-6 md-m-b-10">
                                        <div class="input input-button">
                                            <i class="icon-prepend fas fa-question-circle"></i>
                                            <input type="text" name="map_zip" id="map_zip" size="5" maxlength="6" readonly>
                                            <b class="tooltip tooltip-top-left">우편번호 - 우측 <span class="text-deep-orange">주소검색</span> 클릭하여 검색</b>
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
                                <div class="m-b-10"></div>
                                <div class="row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <input type="text" name="map_addr1" id="map_addr1" size="50">
                                        </label>
                                        <div class="note m-b-10"><strong>Note:</strong> 기본주소</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col col-6">
                                        <label class="input">
                                            <input type="text" name="map_addr2" id="map_addr2" size="50">
                                        </label>
                                        <div class="note m-b-10"><strong>Note:</strong> 상세주소</div>

                                    </div>
                                    <div class="col col-6">
                                        <label class="input">
                                            <input type="text" name="map_name" id="map_name" size="50">
                                        </label>
                                        <div class="note m-b-10"><strong>Note:</strong> 장소명</div>
                                    </div>
                                </div>
                                <div class="margin-hr-10"></div>
                                <div class="row">
                                    <div class="col col-12">
                                        <input type="hidden" name="map_addr3" id="map_addr3" value="">
                                        <input type="hidden" name="map_addr_jibeon" value="">
                                        <div class="text-center">
                                            <button type="button" class="btn-e btn-e-lg btn-e-crimson" id="btn_map" onclick="return false;">적용하기</button>
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
                        <div id="collapse-code-cm" class="collapse" data-bs-parent="#comment_option">
                            <div class="comment-collapse-box">
                                <button type="button" class="ch_code btn-e btn-dark" onclick="return false;">HTML</button>
                                <button type="button" class="ch_code btn-e btn-dark" onclick="return false;">CSS</button>
                                <button type="button" class="ch_code btn-e btn-dark" onclick="return false;">JS</button>
                                <button type="button" class="ch_code btn-e btn-dark" onclick="return false;">PHP</button>
                            </div>
                        </div>
                        <?php } ?>
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
                <div class="m-b-20">
                    <label class="label">자동등록방지</label>
                    <div class="vc-captcha"><?php echo $captcha_html; ?></div>
                </div>
                <?php } ?>
            </div>
            <div class="comment-write-submit">
                <button type="submit" id="btn_submit" class="btn-e btn-e-xlg btn-e-navy" value="댓글등록">댓글등록</button>
            </div>
        </form>
    </div>
    <?php if ($eyoom_board['bo_use_point_explain'] == 1) { ?>
    <div class="modal fade cmt-point-info-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title f-s-20r"><strong>댓글 포인트 안내</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <?php if ($eyoom_board['bo_firstcmt_point'] > 0) { ?>
                    <div class="card bd-r-0 m-b-20">
                        <h5 class="card-header"><span class="f-s-16r"><i class="far fa-comment-dots m-r-7"></i>첫댓글 포인트</span></h5>
                        <div class="card-body">
                            <?php if ($eyoom_board['bo_firstcmt_point_type'] == 1) { ?>
                            <p>첫 댓글을 작성하는 회원에게 최대 <span class="text-crimson"><?php echo $eyoom_board['bo_firstcmt_point']; ?><?php echo $levelset['gnu_name']; ?> 이내에서 랜덤으로 첫댓글<?php echo $levelset['gnu_name']; ?></span>를 지급합니다.</p>
                            <?php } else { ?>
                            <p>첫 댓글을 작성하는 회원에게 <span class="text-crimson"><?php echo $eyoom_board['bo_firstcmt_point']; ?><?php echo $levelset['gnu_name']; ?></span>를 첫댓글<?php echo $levelset['gnu_name']; ?>로 지급합니다.</p>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($eyoom_board['bo_bomb_point'] > 0) { ?>
                    <div class="card bd-r-0 m-b-20">
                        <h5 class="card-header"><span class="f-s-16r"><i class="fas fa-bomb m-r-7"></i>지뢰폭탄 포인트</span></h5>
                        <div class="card-body">
                            <p>지뢰폭탄이 총<span class="text-crimson"><?php echo number_format($eyoom_board['bo_bomb_point_limit']); ?></span>개 매설되어 있습니다.</p>
                            <?php if ($eyoom_board['bo_bomb_point_type'] == 1) { ?>
                            <p>댓글을 작성하여 지뢰폭탄을 발견하면 최대 <span class="text-crimson"><?php echo $eyoom_board['bo_bomb_point']; ?><?php echo $levelset['gnu_name']; ?> 이내에서 랜덤</span>으로 지뢰제거 보상<?php echo $levelset['gnu_name']; ?>로 지급합니다.</p>
                            <?php } else { ?>
                            <p>댓글을 작성하여 지뢰폭탄을 발견하면 <span class="text-crimson"><?php echo $eyoom_board['bo_bomb_point']; ?><?php echo $levelset['gnu_name']; ?></span>를 지뢰제거 보상<?php echo $levelset['gnu_name']; ?>로 지급합니다.</p>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($eyoom_board['bo_lucky_point'] > 0) { ?>
                    <div class="card bd-r-0 m-b-20">
                        <h5 class="card-header"><span class="f-s-16r"><i class="far fa-hand-peace m-r-7"></i>행운 포인트</span></h5>
                        <div class="card-body">
                            <?php if ($eyoom_board['bo_lucky_point_type'] == 1) { ?>
                            <p>댓글을 작성하면 <span class="text-crimson"><?php echo ceil(($eyoom_board['bo_lucky_point_ratio']/100)*100); ?>% 확률</span>로 최대 <span class="text-crimson"><?php echo $eyoom_board['bo_lucky_point']; ?><?php echo $levelset['gnu_name']; ?> 이내에서 랜덤으로 행운의<?php echo $levelset['gnu_name']; ?></span>를 지급합니다.</p>
                            <?php } else { ?>
                            <p>댓글을 작성하면 <span class="text-crimson"><?php echo ceil(($eyoom_board['bo_lucky_point_ratio']/100)*100); ?>% 확률</span>로 <span class="text-crimson"><?php echo $eyoom_board['bo_lucky_point']; ?><?php echo $levelset['gnu_name']; ?></span>를 행운의<?php echo $levelset['gnu_name']; ?>로 지급합니다.</p>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php } ?>
    <?php /* 댓글 쓰기 끝 */ ?>
</div>

<div id="map_canvas"></div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/venobox/venobox.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/magnific-popup/magnific-popup.min.js"></script>
<?php if ($eyoom_board['bo_use_cmt_infinite'] == '1') { ?>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/masonry/jquery.masonry.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/infinite-scroll/jquery.infinitescroll.min.js"></script>
<?php } ?>
<script>
$(function() {
    <?php if ($eyoom_board['bo_use_addon_emoticon'] == '1') { ?>
    $(".emoticon").venobox({
        framewidth : '800px',
        frameheight: '500px'
    });
    <?php } ?>
    <?php for ($i=0; $i<$cmt_amt; $i++) { ?>
    <?php if ($cmt[$i]['is_cmt_best']) { ?>
    $('.view-cmtgo-btn.cmtgo-btn-<?php echo $i+1; ?>, .view-comment-best-label.best-label-<?php echo $i+1; ?>').on('click', function(e) {
        e.stopPropagation();
        if ($(window).width() >= 992) {
            $('html, body').animate({'scrollTop':$('#c_<?php echo $cmt[$i]['comment_id']; ?>').offset().top-90}, 500);
        } else {
            $('html, body').animate({'scrollTop':$('#c_<?php echo $cmt[$i]['comment_id']; ?>').offset().top-70}, 500);
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
            Swal.fire({
                title: "알림!",
                text: "잘못된 주소입니다.",
                confirmButtonColor: "#ab0000",
                icon: "error",
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
            Swal.fire({
                title: "알림!",
                text: "잘못된 주소입니다.",
                confirmButtonColor: "#ab0000",
                icon: "error",
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
        Swal.fire({
            title: "알림!",
            html: "내용에 금지단어 '<strong class='text-crimson'>"+content+"</strong>' 단어가 포함되어있습니다.",
            confirmButtonColor: "#ab0000",
            icon: "error",
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
            Swal.fire({
                title: "알림!",
                html: "댓글은 <strong class='text-crimson'>"+char_min+"</strong> 글자 이상 쓰셔야 합니다.",
                confirmButtonColor: "#ab0000",
                icon: "error",
                confirmButtonText: "확인"
            });
            return false;
        } else if (char_max > 0 && char_max < cnt) {
            Swal.fire({
                title: "알림!",
                html: "댓글은 <strong class='text-crimson'>"+char_max+"</strong> 글자 이하로 쓰셔야 합니다.",
                confirmButtonColor: "#ab0000",
                icon: "error",
                confirmButtonText: "확인"
            });
            return false;
        }
    }
    else if (!document.getElementById('wr_content').value) {
        Swal.fire({
            title: "알림!",
            text: "댓글을 입력하여 주십시오.",
            confirmButtonColor: "#ab0000",
            icon: "error",
            confirmButtonText: "확인"
        });
        return false;
    }

    if (typeof(f.wr_name) != 'undefined') {
        f.wr_name.value = f.wr_name.value.replace(pattern, "");
        if (f.wr_name.value == '') {
            Swal.fire({
                title: "알림!",
                text: "이름이 입력되지 않았습니다.",
                confirmButtonColor: "#ab0000",
                icon: "error",
                confirmButtonText: "확인"
            });
            f.wr_name.focus();
            return false;
        }
    }

    if (typeof(f.wr_password) != 'undefined') {
        f.wr_password.value = f.wr_password.value.replace(pattern, "");
        if (f.wr_password.value == '') {
            Swal.fire({
                title: "알림!",
                text: "비밀번호가 입력되지 않았습니다.",
                confirmButtonColor: "#ab0000",
                icon: "error",
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
    var el_id,
        form_el = 'fviewcomment',
        respond = document.getElementById(form_el);

    // 댓글 아이디가 넘어오면 답변, 수정
    if (comment_id) {
        if (work == 'c')
            el_id = 'reply_' + comment_id;
        else
            el_id = 'edit_' + comment_id;
    } else
        el_id = 'bo_vc_w';

    if (save_before != el_id) {
        if (save_before) {
            var prevElement = document.getElementById(save_before);
            if (prevElement) {
                prevElement.style.display = 'none';
            }
        }

        var currentElement = document.getElementById(el_id);
        if (currentElement) {
            currentElement.style.display = '';
            currentElement.appendChild(respond);
            // 입력값 초기화
            document.getElementById('wr_content').value = '';
        }

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
                    delchk_str = '<label class="checkbox"><input type="checkbox" name="del_cmtfile['+i+']" value="1"><i></i><span class="f-s-12r">파일삭제 ('+cmtfile[i]+')</span></label>';
                    $("#del_cmtfile_"+i).html('');
                    $("#del_cmtfile_"+i).html(delchk_str);
                }
            }
        }

        document.getElementById('comment_id').value = comment_id;
        document.getElementById('w').value = work;

        <?php if ($eyoom_board['bo_use_addon_video'] == '1') { ?>
        //동영상 추가
        $("#btn_video").click(function(){
            var v_url = $("#video_url").val();
            if (!v_url) {
                Swal.fire({
                    title: "알림!",
                    text: "동영상 주소를 입력해 주세요.",
                    confirmButtonColor: "#ab0000",
                    icon: "error",
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
                Swal.fire({
                    title: "알림!",
                    text: "사운드클라우드 음원주소를 입력해 주세요.",
                    confirmButtonColor: "#ab0000",
                    icon: "error",
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
        Swal.fire({
            title: "댓글삭제!",
            text: "정말로 이 댓글을 삭제하시겠습니까?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#ab0000",
            confirmButtonText: "삭제",
            cancelButtonText: "취소"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = linkURL;
            }
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
                Swal.fire({
                    title: "알림",
                    text: data.error,
                    confirmButtonColor: "#ab0000",
                    icon: "warning",
                    confirmButtonText: "확인"
                });
                return false;
            }

            if (data.count) {
                $el.find("strong").text(number_format(String(data.count)));
                if ($good == 'nogood') {
                    Swal.fire({
                        title: "알림",
                        text: "이 댓글을 비추천하셨습니다.",
                        confirmButtonColor: "#ab0000",
                        icon: "warning",
                        confirmButtonText: "확인"
                    });
                } else if ($good == 'good') {
                    Swal.fire({
                        title: "알림",
                        text: "이 댓글을 추천하셨습니다.",
                        confirmButtonColor: "#ab0000",
                        icon: "warning",
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