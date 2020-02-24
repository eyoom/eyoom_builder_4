<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/activity.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.my-activity {position:relative}
.my-activity .timeline {padding:20px;max-width:600px;margin:0 auto}
.my-activity .timeline ul {list-style-type:none;position:relative;padding:10px 0 10px 10px;margin:0}
.my-activity .timeline ul:after {content:"";position:absolute;top:0;left:-4px;bottom:0;border-left:1px solid #eaeaea;height:100%}
.my-activity .timeline ul li {margin:15px 0 15px 10px;position:relative;display:block}
.my-activity .timeline ul li:last-child {margin-bottom:0}
.my-activity .timeline ul li:before {content:"";display:block;width:12px;height:12px;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important;background-color:white;border:2px solid #c5c5c5;position:absolute;z-index:2;left:-30px;outline:2px solid white;top:8px}
.my-activity .timeline ul li .timeline-date {display:table;color:#353535;font-size:12px;padding:4px 0;margin-bottom:15px;position:relative;top:5px;z-index:0;line-height:1}
.my-activity .timeline ul li .timeline-date i {color:#FF4848}
.my-activity .timeline ul li .timeline-date:before {content:"";position:absolute;left:-20px;border-bottom:1px solid #ccc;width:20px;top:9px;z-index:-1}
.my-activity .timeline ul li .timeline-panel {position:relative;display:block;border:1px solid #e5e5e5;padding:8px 15px;background:#fafafa;font-size:11px}
.my-activity .timeline ul li .timeline-panel h6 {font-size:12px;margin:0;padding:0}
.my-activity .timeline ul li .timeline-panel p:last-child {margin-bottom:0}
.my-activity .timeline ul li h5 {font-size:13px;font-weight:bold;margin:0 0 15px}
.my-activity .timeline ul li p {color:#959595}
.my-activity .timeline ul li a p {color:#000}
.my-activity .timeline ul li a .timeline-panel:hover {color:#000}
.my-activity .timeline ul li a .timeline-panel:hover h6 {color:#FF4848}
.my-activity .timeline ul li a .timeline-panel:hover p {color:#FF4848}
.my-activity .view-infinite-more .btn-e-xlg {position:relative;height:40px;line-height:40px;padding:0 100px;font-size:16px !important;border:1px solid #b5b5b5;background:#fff;color:#757575}
.my-activity .view-infinite-more .btn-e-xlg i {position:absolute;top:5px;right:5px;font-size:30px;color:#fff;transition:all 0.2s ease-in-out}
.my-activity .view-infinite-more .btn-e-xlg:hover {border:1px solid #959595;background:#f5f5f5;color:#000}
.my-activity .view-infinite-more .btn-e-xlg:hover i {color:#b5b5b5}
#infscr-loading {text-align:center;z-index:100;position:absolute;left:50%;bottom:0;width:200px;margin-left:-100px;padding:8px 0;background:#000;opacity:0.8;color:#fff}
@media (min-width: 768px) {
    .my-activity-modal {width:720px;margin:10px auto}
    .my-activity-modal .modal-header, .my-activity-modal .modal-body, .my-activity-modal .modal-footer {padding:10px 20px}
}
@media (min-width: 992px) {
    .my-activity-modal {width:940px}
}
@media (min-width: 1200px) {
    .my-activity-modal {width:1140px}
}
</style>

<?php
/**
 * 탭메뉴 출력
 */
include_once($eyoom_skin_path['mypage'] . '/tabmenu.skin.html.php');
?>

<div class="my-activity">
    <div class="headline-short">
        <h4><strong>활동기록</strong></h4>
    </div>
    <?php if (isset($list) && is_array($list)) { ?>
    <div class="timeline">
        <ul class="infinite-container">
        <?php foreach ($list as $key => $li) { ?>
            <li>
            <?php if ($li['type'] == 'new') { ?>
                <span class="timeline-date"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></span>
                <h5><u><?php echo $li['bo_name']?></u> 게시판의 새글을 작성하셨습니다.</h5>
                <a href="<?php echo get_eyoom_pretty_url($li['bo_table'],$li['wr_id'],'&amp;wmode=1'); ?>" <?php if (!G5_IS_MOBILE) { ?>onclick="activity_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                    <div class="timeline-panel">
                        <h6 class="font-bold"><?php echo stripslashes($li['subject']); ?></h6>
                        <p><?php echo conv_subject($li['content'],80,'…'); ?></p>
                    </div>
                </a>
            <?php } else if ($li['type'] == 'reply') { ?>
                <span class="timeline-date"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></span>
                <h5><u><?php echo $li['bo_name']?></u> 게시판의 답변글을 작성하셨습니다.</h5>
                <a href="<?php echo get_eyoom_pretty_url($li['bo_table'],$li['wr_id'],'&amp;wmode=1'); ?>" <?php if (!G5_IS_MOBILE) { ?>onclick="activity_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                    <div class="timeline-panel">
                        <h6 class="font-bold"><?php echo stripslashes($li['subject']); ?></h6>
                        <p><?php echo conv_subject($li['content'],80,'…'); ?></p>
                    </div>
                </a>
            <?php } else if ($li['type'] == 'login') { ?>
                <span class="timeline-date"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></span>
                <h5>로그인하였습니다.</h5>
                <div class="timeline-panel">
                    <p><?php echo $li['ip']?></p>
                </div>
            <?php } else if ($li['type'] == 'cmt') { ?>
                <span class="timeline-date"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></span>
                <h5><u><?php echo $li['bo_name']?></u> 게시판의 댓글을 작성하였습니다.</h5>
                <a href="<?php echo get_eyoom_pretty_url($li['bo_table'],$li['wr_parent'],'&amp;wmode=1#c_'.$li['wr_id']); ?>" <?php if (!G5_IS_MOBILE) { ?>onclick="activity_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                    <div class="timeline-panel">
                        <p><?php echo conv_subject($li['content'],80,'…'); ?></p>
                    </div>
                </a>
            <?php } else if ($li['type'] == 'cmt_re') { ?>
                <span class="timeline-date"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></span>
                <h5><u><?php echo $li['bo_name']?></u> 게시판의 대댓글을 작성하였습니다.</h5>
                <a href="<?php echo get_eyoom_pretty_url($li['bo_table'],$li['wr_parent'],'&amp;wmode=1#c_'.$li['wr_id']); ?>" <?php if (!G5_IS_MOBILE) { ?>onclick="activity_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                    <div class="timeline-panel">
                        <p><?php echo conv_subject($li['content'],80,'…'); ?></p>
                    </div>
                </a>
            <?php } else if ($li['type'] == 'good') { ?>
                <span class="timeline-date"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></span>
                <h5><u><?php echo $li['bo_name']?></u> 게시판의 게시글을 추천하였습니다.</h5>
                <a href="<?php echo get_eyoom_pretty_url($li['bo_table'],$li['wr_id'],'&amp;wmode=1'); ?>" <?php if (!G5_IS_MOBILE) { ?>onclick="activity_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                    <div class="timeline-panel">
                        <p><u><?php echo $li['bo_name']?></u> 게시판의 게시글을 추천</p>
                    </div>
                </a>
            <?php } else if ($li['type'] == 'nogood') { ?>
                <span class="timeline-date"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></span>
                <h5><u><?php echo $li['bo_name']?></u> 게시판의 게시글을 비추천하였습니다.</h5>
                <a href="<?php echo get_eyoom_pretty_url($li['bo_table'],$li['wr_id'],'&amp;wmode=1'); ?>" <?php if (!G5_IS_MOBILE) { ?>onclick="activity_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                    <div class="timeline-panel">
                        <p><u><?php echo $li['bo_name']?></u> 게시판의 게시글을 비추천</p>
                    </div>
                </a>
            <?php } else if ($li['type'] == 'follow') { ?>
                <span class="timeline-date"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></span>
                <h5>팔로우하였습니다.</h5>
                <a href="<?php echo G5_URL; ?>/?<?php echo $li['mb_id']?>" target="_blank">
                    <div class="timeline-panel">
                        <p><u><?php echo $li['mb_nick']?></u>님을 팔로우하였습니다.</p>
                    </div>
                </a>
            <?php } else if ($li['type'] == 'unfollow') { ?>
                <span class="timeline-date"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></span>
                <h5>팔로우 해제하였습니다.</h5>
                <a href="<?php echo G5_URL; ?>/?<?php echo $li['mb_id']?>" target="_blank">
                    <div class="timeline-panel">
                        <p><u><?php echo $li['mb_nick']?></u>님을 팔로우 해제하였습니다.</p>
                    </div>
                </a>
            <?php } else if ($li['type'] == 'subscribe') { ?>
                <span class="timeline-date"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></span>
                <h5>구독신청 하였습니다.</h5>
                <a href="<?php echo G5_URL; ?>/?<?php echo $li['mb_id']?>" target="_blank">
                    <div class="timeline-panel">
                        <p><u><?php echo $li['mb_nick']?></u>님의 글을 구독신청 하였습니다.</p>
                    </div>
                </a>
            <?php } else if ($li['type'] == 'unsubscribe') { ?>
                <span class="timeline-date"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></span>
                <h5>구독해제 하였습니다.</h5>
                <a href="<?php echo G5_URL; ?>/?<?php echo $li['mb_id']?>" target="_blank">
                    <div class="timeline-panel">
                        <p><u><?php echo $li['mb_nick']?></u>님의 글을 구독해제 하였습니다.</p>
                    </div>
                </a>
            <?php } else if ($li['type'] == 'memo') { ?>
                <span class="timeline-date"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></span>
                <h5>쪽지를 발송하였습니다.</h5>
                <a href="<?php echo G5_BBS_URL; ?>/memo_view.php?me_id=<?php echo $li['me_id']?>&kind=send" target="_blank" class="win_memo">
                    <div class="timeline-panel">
                        <p><u><?php echo $li['mb_nick']?></u>님에게 쪽지를 발송</p>
                    </div>
                </a>
            <?php } else if ($li['type'] == 'guest') { ?>
                <span class="timeline-date"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></span>
                <h5><u><?php echo $li['mb_name']?></u>님의 마이홈에 방명록을 작성하였습니다.</h5>
                <a href="<?php echo G5_URL; ?>/?<?php echo $li['mb_id']?>" target="_blank">
                    <div class="timeline-panel">
                        <p><?php echo conv_subject($li['content'],80,'…'); ?></p>
                    </div>
                </a>
            <?php } ?>
            </li>
        <?php } ?>
        </ul>
    </div>
    <div id="infinite_pagination">
        <a class="next" href="<?php echo G5_URL; ?>/mypage/activity.php?page=<?php echo ($page+1); ?>"></a>
    </div>
    <div class="view-infinite-more text-center margin-top-30 margin-bottom-20">
        <a id="my-activity-more" href="#" class="btn btn-default btn-e-xlg">더 보기 <i class="far fa-arrow-alt-circle-down"></i></a>
    </div>
    <?php } else { ?>
    <div class="text-center margin-top-30 margin-bottom-30 color-grey font-size-13">
        <i class="fas fa-exclamation-circle"></i> 활동기록이 없습니다.
    </div>
    <?php } ?>
</div>

<?php /* 활동기록 상세보기 모달 시작 */ ?>
<div class="modal fade activity-iframe-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog my-activity-modal">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <div class="modal-body">
                <iframe id="activity-iframe" width="100%" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn-e btn-e-xlg btn-e-dark" type="button"><i class="fas fa-times"></i> 닫기</button>
            </div>
        </div>
    </div>
</div>
<?php /* 활동기록 상세보기 모달 끝 */ ?>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/infinite-scroll/jquery.infinitescroll.min.js"></script>
<script>
function activity_modal(href) {
    $('.activity-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#activity-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.activity-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#activity-iframe").attr("src", href);
        $('#activity-iframe').height(parseInt($(window).height() * 0.85));
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

$(function(){
    var $container = $('.infinite-container');
    $container.infinitescroll({
        navSelector  : "#infinite_pagination",
        nextSelector : "#infinite_pagination .next",
        itemSelector : ".timeline li",
        loading: {
            finishedMsg: 'END',
            img: '<?php echo EYOOM_THEME_URL; ?>/image/loading.gif'
        }
    },
    function( newElements ) {
        var $newElems = $( newElements ).css({ opacity: 0 });
        $newElems.imagesLoaded(function(){
            $newElems.animate({ opacity: 1 });
        });
    });
    $(window).unbind('.infscr');
    $('#my-activity-more').click(function(){
        $container.infinitescroll('retrieve');
        $('#infinite_pagination').show();
        return false;
    });
});
</script>