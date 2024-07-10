<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/activity.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 탭메뉴 출력
 */
include_once($eyoom_skin_path['mypage'] . '/tabmenu.skin.html.php');
?>

<style>
.my-activity {font-size:.9375rem}
.my-activity .float-none {float:none !important}
.my-activity .timeline {position:relative;padding:20px 0;list-style:none}
.my-activity .timeline:before {top:0;bottom:0;position:absolute;content:"";width:1px;background-color:#d5d5d5;left:50%;margin-left:-1px}
.my-activity .timeline:after {content:"";display:block;clear:both}
.my-activity .timeline > li {margin-bottom:40px;position:relative;width:50%;float:left;clear:left}
.my-activity .timeline > li:before,.my-activity .timeline > li:after {content:"";display:table}
.my-activity .timeline > li:after {clear:both}
.my-activity .timeline > li:before,.my-activity .timeline > li:after {content: "";display:table}
.my-activity .timeline > li:after {clear:both}
.my-activity .timeline > li > .timeline-panel {position:relative;width:94%;float:left;border:1px solid #d5d5d5}
.my-activity .timeline > li > .timeline-panel:before {position: absolute;top:33px;right:-8px;display:inline-block;border-top:8px solid transparent;border-left:8px solid #c5c5c5;border-right:0 solid #c5c5c5;border-bottom:8px solid transparent;content:""}
.my-activity .timeline > li > .timeline-panel:after {position:absolute;top:34px;right:-7px;display:inline-block;border-top:7px solid transparent;border-left:7px solid #fff;border-right:0 solid #fff;border-bottom:7px solid transparent;content:""}
.my-activity .timeline > li > .timeline-badge {width:14px;height:14px;position:absolute;background:#ab0000;margin:0;border:2px solid #fff;box-shadow:0 0 0 1px #b5b5b5;border-radius:50%;top:35px;right:-6px;z-index:9}
.my-activity .timeline > li.timeline-inverted > .timeline-panel {float:right}
.my-activity .timeline > li.timeline-inverted > .timeline-panel:before {border-left-width:0;border-right-width:8px;left:-8px;right:auto}
.my-activity .timeline > li.timeline-inverted > .timeline-panel:after {border-left-width:0;border-right-width:7px;left:-7px;right:auto}
.my-activity .timeline > li.timeline-inverted {float:right;clear:right;margin-top:40px;margin-bottom:0}
.my-activity .timeline > li.timeline-inverted > .timeline-badge {left:-8px}
.my-activity .timeline > li > .timeline-panel a {color:#252525}
.my-activity .timeline > li > .timeline-panel .timeline-heading {position:relative;overflow:hidden;display:block;padding:0 15px}
.my-activity .timeline > li > .timeline-panel .timeline-heading .timeline-img {position:relative;overflow:hidden;max-height:180px;margin-top:15px}
.my-activity .timeline > li > .timeline-panel .timeline-heading .timeline-img img {width:100%}
.my-activity .timeline > li > .timeline-panel .timeline-top {padding:15px}
.my-activity .timeline > li > .timeline-panel .timeline-top i {color:#757575}
.my-activity .timeline > li > .timeline-panel .timeline-body {padding:0 15px 15px}
.my-activity .timeline > li > .timeline-panel .timeline-body h5 {font-size:.9375rem;display:block;margin:0 0 10px}
.my-activity .timeline > li > .timeline-panel .timeline-body p {color:#757575}
.my-activity .timeline > li > .timeline-panel .timeline-footer {padding:15px;overflow:hidden;border-top:1px solid #e5e5e5;background:#fff;color:#757575}
.my-activity .timeline > li > .timeline-panel:hover .timeline-body a {text-decoration:underline}
.my-activity .view-infinite-more .btn-e-xlg {position:relative;height:50px;line-height:50px;padding:0 120px;font-size:1.0625rem !important;border:1px solid #b5b5b5;background:#fff;color:#757575}
.my-activity .view-infinite-more .btn-e-xlg i {position:absolute;top:10px;right:5px;font-size:30px;color:#fff;transition:all 0.2s ease-in-out}
.my-activity .view-infinite-more .btn-e-xlg:hover {border:1px solid #959595;background:#f5f5f5;color:#000}
.my-activity .view-infinite-more .btn-e-xlg:hover i {color:#b5b5b5}
#infscr-loading {text-align:center;z-index:100;position:absolute;left:50%;bottom:0;width:200px;margin-left:-100px;padding:8px 0;background:#000;opacity:0.8;color:#fff}
@media (max-width: 991px) {
    .my-activity .timeline:before {left:11px}
    .my-activity .timeline > li {margin-bottom:15px;position:relative;width:100%;float:left;clear:left}
    .my-activity .timeline > li > .timeline-panel {width:calc(100% - 30px);width:-moz-calc(100% - 30px);width:-webkit-calc(100% - 30px)}
    .my-activity .timeline > li > .timeline-badge {left:3px;margin-left:0;top:32px}
    .my-activity .timeline > li > .timeline-panel {float:right}
    .my-activity .timeline > li > .timeline-panel:before {top:30px;right:-8px;border-top:8px solid transparent;border-left:8px solid #ccc;border-bottom:8px solid transparent}
    .my-activity .timeline > li > .timeline-panel:after {top:31px;right:-7px;border-top:7px solid transparent;border-left:7px solid #fff;border-bottom:7px solid transparent}
    .my-activity .timeline > li > .timeline-panel:before {border-left-width:0;border-right-width:8px;left:-8px;right:auto}
    .my-activity .timeline > li > .timeline-panel:after {border-left-width:0;border-right-width:7px;left:-7px;right:auto}
    .my-activity .timeline > li.timeline-inverted{float:left; clear:left;margin-top:15px;margin-bottom:30px}
    .my-activity .timeline > li.timeline-inverted > .timeline-badge{left:3px}
}
</style>

<div class="my-activity">
    <?php if (isset($list) && is_array($list)) { ?>
    <ul class="timeline">
        <?php foreach ($list as $key => $li) { ?>
        <li class="<?php if ($key%2 == 1) { ?>timeline-inverted<?php } ?>">
            <div class="timeline-badge"></div>
            <div class="timeline-panel">
            <?php if ($li['type'] == 'new') { ?>
                <div class="timeline-top">
                    <strong class="float-end"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></strong>
                    <div class="clearfix"></div>
                </div>
                <div class="timeline-body">
                    <h5>[<?php echo $li['bo_name']?>] 게시판의 새글을 작성하셨습니다.</h5>
                    <a href="<?php echo get_eyoom_pretty_url($li['bo_table'],$li['wr_id'],'&amp;wmode=1'); ?>" <?php if (!G5_IS_MOBILE) { ?>onclick="activity_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                        <div class="timeline-cont">
                            <p><?php echo stripslashes($li['subject']); ?></p>
                            <p><?php echo conv_subject($li['content'],80,'…'); ?></p>
                        </div>
                    </a>
                </div>
            <?php } else if ($li['type'] == 'reply') { ?>
                <div class="timeline-top">
                    <strong class="float-end"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></strong>
                    <div class="clearfix"></div>
                </div>
                <div class="timeline-body">
                    <h5>[<?php echo $li['bo_name']?>] 게시판의 답변글을 작성하셨습니다.</h5>
                    <a href="<?php echo get_eyoom_pretty_url($li['bo_table'],$li['wr_id'],'&amp;wmode=1'); ?>" <?php if (!G5_IS_MOBILE) { ?>onclick="activity_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                        <div class="timeline-cont">
                            <p><?php echo stripslashes($li['subject']); ?></p>
                            <p><?php echo conv_subject($li['content'],80,'…'); ?></p>
                        </div>
                    </a>
                </div>
            <?php } else if ($li['type'] == 'login') { ?>
                <div class="timeline-top">
                    <strong class="float-end"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></strong>
                    <div class="clearfix"></div>
                </div>
                <div class="timeline-body">
                    <h5>로그인하였습니다.</h5>
                    <div class="timeline-cont">
                        <p><?php echo $li['ip']?></p>
                    </div>
                </div>
            <?php } else if ($li['type'] == 'cmt') { ?>
                <div class="timeline-top">
                    <strong class="float-end"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></strong>
                    <div class="clearfix"></div>
                </div>
                <div class="timeline-body">
                    <h5>[<?php echo $li['bo_name']?>] 게시판의 댓글을 작성하였습니다.</h5>
                    <a href="<?php echo get_eyoom_pretty_url($li['bo_table'],$li['wr_parent'],'&amp;wmode=1#c_'.$li['wr_id']); ?>" <?php if (!G5_IS_MOBILE) { ?>onclick="activity_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                        <div class="timeline-cont">
                            <p><?php echo conv_subject($li['content'],80,'…'); ?></p>
                        </div>
                    </a>
                </div>
            <?php } else if ($li['type'] == 'cmt_re') { ?>
                <div class="timeline-top">
                    <strong class="float-end"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></strong>
                    <div class="clearfix"></div>
                </div>
                <div class="timeline-body">
                    <h5>[<?php echo $li['bo_name']?>] 게시판의 대댓글을 작성하였습니다.</h5>
                    <a href="<?php echo get_eyoom_pretty_url($li['bo_table'],$li['wr_parent'],'&amp;wmode=1#c_'.$li['wr_id']); ?>" <?php if (!G5_IS_MOBILE) { ?>onclick="activity_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                        <div class="timeline-cont">
                            <p><?php echo conv_subject($li['content'],80,'…'); ?></p>
                        </div>
                    </a>
                </div>
            <?php } else if ($li['type'] == 'good') { ?>
                <div class="timeline-top">
                    <strong class="float-end"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></strong>
                    <div class="clearfix"></div>
                </div>
                <div class="timeline-body">
                    <h5>[<?php echo $li['bo_name']?>] 게시판의 게시글을 추천하였습니다.</h5>
                    <a href="<?php echo get_eyoom_pretty_url($li['bo_table'],$li['wr_id'],'&amp;wmode=1'); ?>" <?php if (!G5_IS_MOBILE) { ?>onclick="activity_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                        <div class="timeline-cont">
                            <p><strong><?php echo $li['bo_name']?></strong> 게시판의 게시글을 추천</p>
                        </div>
                    </a>
                </div>
            <?php } else if ($li['type'] == 'nogood') { ?>
                <div class="timeline-top">
                    <strong class="float-end"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></strong>
                    <div class="clearfix"></div>
                </div>
                <div class="timeline-body">
                    <h5>[<?php echo $li['bo_name']?>] 게시판의 게시글을 비추천하였습니다.</h5>
                    <a href="<?php echo get_eyoom_pretty_url($li['bo_table'],$li['wr_id'],'&amp;wmode=1'); ?>" <?php if (!G5_IS_MOBILE) { ?>onclick="activity_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                        <div class="timeline-cont">
                            <p><strong><?php echo $li['bo_name']?></strong> 게시판의 게시글을 비추천</p>
                        </div>
                    </a>
                </div>
            <?php } else if ($li['type'] == 'follow') { ?>
                <div class="timeline-top">
                    <strong class="float-end"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></strong>
                    <div class="clearfix"></div>
                </div>
                <div class="timeline-body">
                    <h5>팔로우하였습니다.</h5>
                    <a href="<?php echo G5_URL; ?>/?<?php echo $li['mb_id']?>" target="_blank">
                        <div class="timeline-cont">
                            <p><strong><?php echo $li['mb_nick']?></strong>님을 팔로우하였습니다.</p>
                        </div>
                    </a>
                </div>
            <?php } else if ($li['type'] == 'unfollow') { ?>
                <div class="timeline-top">
                    <strong class="float-end"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></strong>
                    <div class="clearfix"></div>
                </div>
                <div class="timeline-body">
                    <h5>팔로우 해제하였습니다.</h5>
                    <a href="<?php echo G5_URL; ?>/?<?php echo $li['mb_id']?>" target="_blank">
                        <div class="timeline-cont">
                            <p><strong><?php echo $li['mb_nick']?></strong>님을 팔로우 해제하였습니다.</p>
                        </div>
                    </a>
                </div>
            <?php } else if ($li['type'] == 'subscribe') { ?>
                <div class="timeline-top">
                    <strong class="float-end"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></strong>
                    <div class="clearfix"></div>
                </div>
                <div class="timeline-body">
                    <h5>구독신청 하였습니다.</h5>
                    <a href="<?php echo G5_URL; ?>/?<?php echo $li['mb_id']?>" target="_blank">
                        <div class="timeline-cont">
                            <p><strong><?php echo $li['mb_nick']?></strong>님의 글을 구독신청 하였습니다.</p>
                        </div>
                    </a>
                </div>
            <?php } else if ($li['type'] == 'unsubscribe') { ?>
                <div class="timeline-top">
                    <strong class="float-end"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></strong>
                    <div class="clearfix"></div>
                </div>
                <div class="timeline-body">
                    <h5>구독해제 하였습니다.</h5>
                    <a href="<?php echo G5_URL; ?>/?<?php echo $li['mb_id']?>" target="_blank">
                        <div class="timeline-cont">
                            <p><strong><?php echo $li['mb_nick']?></strong>님의 글을 구독해제 하였습니다.</p>
                        </div>
                    </a>
                </div>
            <?php } else if ($li['type'] == 'memo') { ?>
                <div class="timeline-top">
                    <strong class="float-end"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></strong>
                    <div class="clearfix"></div>
                </div>
                <div class="timeline-body">
                    <h5>쪽지를 발송하였습니다.</h5>
                    <a href="<?php echo G5_BBS_URL; ?>/memo_view.php?me_id=<?php echo $li['me_id']?>&kind=send" target="_blank" class="win_memo">
                        <div class="timeline-cont">
                            <p><strong><?php echo $li['mb_nick']?></strong>님에게 쪽지를 발송</p>
                        </div>
                    </a>
                </div>
            <?php } else if ($li['type'] == 'guest') { ?>
                <div class="timeline-top">
                    <strong class="float-end"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></strong>
                    <div class="clearfix"></div>
                </div>
                <div class="timeline-body">
                    <h5>[<?php echo $li['mb_name']?>] 님의 마이홈에 방명록을 작성하였습니다.</h5>
                    <a href="<?php echo G5_URL; ?>/?<?php echo $li['mb_id']?>" target="_blank">
                        <div class="timeline-cont">
                            <p><?php echo conv_subject($li['content'],80,'…'); ?></p>
                        </div>
                    </a>
                </div>
            <?php } ?>
            </div>
        </li>
        <?php } ?>
    </ul>
    <?php } ?>
    <?php if (count((array)$list) == 0) { ?>
    <div class="text-center m-t-30 m-b-30 text-gray">
        <i class="fa fa-exclamation-circle"></i> 활동 기록이 없습니다.
    </div>
    <?php } ?>
    <?php if (count((array)$list) > 0) { ?>
    <div id="infinite_pagination">
        <a class="next" href="<?php echo G5_URL; ?>/mypage/activity.php?page=<?php echo ($page+1); ?>"></a>
    </div>
    <div class="view-infinite-more text-center m-t-30">
        <a id="my-activity-more" href="#" class="btn btn-e-xlg">더 보기<i class="far fa-arrow-alt-circle-down"></i></a>
    </div>
    <?php } ?>
</div>

<?php /* 타임라인 상세보기 모달 시작 */ ?>
<div class="modal fade activity-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="activity-iframe" width="100%" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<?php /* 타임라인 상세보기 모달 끝 */ ?>

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
    var $container = $('.my-activity .timeline');
    $container.infinitescroll({
        navSelector  : "#infinite_pagination",
        nextSelector : "#infinite_pagination .next",
        itemSelector : ".my-activity .timeline li",
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