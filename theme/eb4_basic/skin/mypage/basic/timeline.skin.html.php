<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/timeline.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.my-timeline .float-none {float:none !important}
.my-timeline .timeline {position:relative;padding:20px 0;list-style:none;background:#fff}
.my-timeline .timeline:before {top:0;bottom:0;position:absolute;content:"";width:1px;background-color:#e5e5e5;left:50%;margin-left:-1px}
.my-timeline .timeline > li {margin-bottom:40px;position:relative;width:50%;float:left;clear:left}
.my-timeline .timeline > li:before,.my-timeline .timeline > li:after {content:"";display:table}
.my-timeline .timeline > li:after {clear:both}
.my-timeline .timeline > li:before,.my-timeline .timeline > li:after {content: "";display:table}
.my-timeline .timeline > li:after {clear:both}
.my-timeline .timeline > li > .timeline-panel {position:relative;width:94%;float:left;border:1px solid #e5e5e5}
.my-timeline .timeline > li > .timeline-panel:before {position: absolute;top:33px;right:-8px;display:inline-block;border-top:8px solid transparent;border-left:8px solid #e5e5e5;border-right:0 solid #ddd;border-bottom:8px solid transparent;content:""}
.my-timeline .timeline > li > .timeline-panel:after {position:absolute;top:34px;right:-7px;display:inline-block;border-top:7px solid transparent;border-left:7px solid #fff;border-right:0 solid #fff;border-bottom:7px solid transparent;content:""}
.my-timeline .timeline > li > .timeline-badge {width:14px;height:14px;background:#fff;border:2px solid #c5c5c5;border-radius:50% !important;position:absolute;top:35px;right:-6px;z-index:9}
.my-timeline .timeline > li.timeline-inverted > .timeline-panel {float:right}
.my-timeline .timeline > li.timeline-inverted > .timeline-panel:before {border-left-width:0;border-right-width:8px;left:-8px;right:auto}
.my-timeline .timeline > li.timeline-inverted > .timeline-panel:after {border-left-width:0;border-right-width:7px;left:-7px;right:auto}
.my-timeline .timeline > li.timeline-inverted {float:right;clear:right;margin-top:40px;margin-bottom:0}
.my-timeline .timeline > li.timeline-inverted > .timeline-badge {left:-8px}
.my-timeline .timeline > li > .timeline-panel .timeline-heading {position:relative;overflow:hidden;display:block;padding:0 10px;background:#fff}
.my-timeline .timeline > li > .timeline-panel .timeline-heading .timeline-img {position:relative;overflow:hidden;max-height:180px;margin-top:10px}
.my-timeline .timeline > li > .timeline-panel .timeline-heading .timeline-img img {width:100%}
.my-timeline .timeline > li > .timeline-panel .timeline-top {padding:10px;font-size:12px;background:#fff}
.my-timeline .timeline > li > .timeline-panel .timeline-top i {color:#757575}
.my-timeline .timeline > li > .timeline-panel .timeline-body {padding:0 10px 10px;background:#fff}
.my-timeline .timeline > li > .timeline-panel .timeline-body h5 {font-size:13px;display:block;font-weight:bold;margin:0 0 10px}
.my-timeline .timeline > li > .timeline-panel .timeline-body p {margin-bottom:0}
.my-timeline .timeline > li > .timeline-panel .timeline-body span {color:#888;font-size:12px}
.my-timeline .timeline > li > .timeline-panel .timeline-footer {padding:7px 10px;overflow:hidden;border-top:1px solid #f5f5f5;background:#fff;font-size:11px;color:#959595}
.my-timeline .view-infinite-more .btn-e-xlg {position:relative;height:40px;line-height:40px;padding:0 100px;font-size:16px !important;border:1px solid #b5b5b5;background:#fff;color:#757575}
.my-timeline .view-infinite-more .btn-e-xlg i {position:absolute;top:5px;right:5px;font-size:30px;color:#fff;transition:all 0.2s ease-in-out}
.my-timeline .view-infinite-more .btn-e-xlg:hover {border:1px solid #959595;background:#f5f5f5;color:#000}
.my-timeline .view-infinite-more .btn-e-xlg:hover i {color:#b5b5b5}
#infscr-loading {text-align:center;z-index:100;position:absolute;left:50%;bottom:0;width:200px;margin-left:-100px;padding:8px 0;background:#000;opacity:0.8;color:#fff}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width: 991px) {
    .my-timeline .timeline:before {left:11px}
    .my-timeline .timeline > li {margin-bottom:15px;position:relative;width:100%;float:left;clear:left}
    .my-timeline .timeline > li > .timeline-panel {width:calc(100% - 30px);width:-moz-calc(100% - 30px);width:-webkit-calc(100% - 30px)}
    .my-timeline .timeline > li > .timeline-badge {left:3px;margin-left:0;top:32px}
    .my-timeline .timeline > li > .timeline-panel {float:right}
    .my-timeline .timeline > li > .timeline-panel:before {top:30px;right:-8px;border-top:8px solid transparent;border-left:8px solid #ccc;border-bottom:8px solid transparent}
    .my-timeline .timeline > li > .timeline-panel:after {top:31px;right:-7px;border-top:7px solid transparent;border-left:7px solid #fff;border-bottom:7px solid transparent}
    .my-timeline .timeline > li > .timeline-panel:before {border-left-width:0;border-right-width:8px;left:-8px;right:auto}
    .my-timeline .timeline > li > .timeline-panel:after {border-left-width:0;border-right-width:7px;left:-7px;right:auto}
    .my-timeline .timeline > li.timeline-inverted{float:left; clear:left;margin-top:15px;margin-bottom:30px}
    .my-timeline .timeline > li.timeline-inverted > .timeline-badge{left:3px}
}
<?php } ?>
@media (min-width: 768px) {
    .my-timeline-modal {width:720px;margin:10px auto}
    .my-timeline-modal .modal-header, .my-timeline-modal .modal-body, .my-timeline-modal .modal-footer {padding:10px 20px}
}
@media (min-width: 992px) {
    .my-timeline-modal {width:940px}
}
@media (min-width: 1200px) {
    .my-timeline-modal {width:1140px}
}
</style>

<div class="my-timeline">
    <div class="headline-short">
        <h4><strong>나의 타임라인</strong></h4>
    </div>
    <?php if (isset($list) && is_array($list)) { ?>
    <ul class="timeline">
        <?php foreach ($list as $key => $li) { ?>
        <li class="<?php if ($key%2 == 1) { ?>timeline-inverted<?php } ?>">
            <div class="timeline-badge"></div>
            <div class="timeline-panel">
                <div class="timeline-heading">
                    <?php if ($li['wr_image']) { ?>
                    <div class="timeline-img">
                        <a href="<?php echo $li['href']; ?>" <?php if (!G5_IS_MOBILE) { ?>onclick="timeline_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>><img class="img-responsive" src="<?php echo $li['wr_image']; ?>" alt=""></a>
                    </div>
                    <?php } ?>
                </div>
                <a href="<?php echo $li['href']; ?>" <?php if (!G5_IS_MOBILE) { ?>onclick="timeline_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                    <div class="timeline-top">
                        <span class="pull-left"><?php if ($li['wr_id'] == $li['wr_parent']) { ?><strong class="color-dark">포스팅</strong><?php } else { ?><strong class="color-light-grey">댓글</strong><?php } ?></i></span>
                        <strong class="pull-right"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y.m.d - H:i',$li['datetime']); ?></strong>
                        <div class="clearfix"></div>
                    </div>
                    <div class="timeline-body">
                        <?php if ($li['wr_id'] == $li['wr_parent']) { ?>
                        <h5 class="ellipsis margin-bottom-15"><?php echo get_text($li['wr_subject']); ?></h5>
                        <?php } ?>
                        <p class="color-grey font-size-12">
                            <?php echo conv_subject($li['wr_content'],100,'…'); ?>
                        </p>
                        <?php if (is_array($li['video'])) { ?>
                        <?php foreach ($li['video'] as $k => $video) { ?>
                        <p><?php echo $video; ?></p>
                        <?php } ?>
                        <?php } ?>

                        <?php if (is_array($li['sound'])) { ?>
                        <?php foreach ($li['sound'] as $k => $sound) { ?>
                        <p><?php echo $sound; ?></p>
                        <?php } ?>
                        <?php } ?>
                        <div class="clearfix"></div>
                    </div>
                </a>
                <div class="timeline-footer">
                    <?php if ($li['wr_id'] == $li['wr_parent']) { ?>
                    <span class="pull-left"><i class="fas fa-eye margin-right-5"></i><?php echo $li['wr_hit']; ?><i class="fas fa-comment-alt margin-right-5 margin-left-10"></i><?php echo number_format($li['wr_comment']); ?></span>
                    <?php } ?>
                    <span class="pull-right"><?php echo $li['bo_info']['gr_name']; ?> / <?php echo $li['bo_info']['bo_name']; ?></span>
                    <div class="clearfix"></div>
                </div>
            </div>
        </li>
        <?php } ?>
        <li class="clearfix float-none"></li>
    </ul>
    <div id="infinite_pagination">
        <a class="next" href="<?php echo G5_URL; ?>/mypage/?t=timeline&page=<?php echo ($page+1); ?>"></a>
    </div>
    <div class="view-infinite-more text-center margin-top-30 margin-bottom-20">
        <a id="my-timeline-more" href="#" class="btn btn-default btn-e-xlg">더 보기<i class="far fa-arrow-alt-circle-down"></i></a>
    </div>
    <?php } else { ?>
    <div class="text-center margin-top-30 margin-bottom-30 color-grey font-size-13">
        <i class="fa fa-exclamation-circle"></i> 타임라인에 표시할 게시글 활동이 없습니다.
    </div>
    <?php } ?>
    <?php /* 타임라인 상세보기 모달 시작 */ ?>
    <div class="modal fade timeline-iframe-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog my-timeline-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                </div>
                <div class="modal-body">
                    <iframe id="timeline-iframe" width="100%" frameborder="0"></iframe>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-e btn-e-xlg btn-e-dark" type="button"><i class="fas fa-times"></i> 닫기</button>
                </div>
            </div>
        </div>
    </div>
    <?php /* 타임라인 상세보기 모달 끝 */ ?>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/infinite-scroll/jquery.infinitescroll.min.js"></script>
<script>
function timeline_modal(href) {
    $('.timeline-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#timeline-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.timeline-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#timeline-iframe").attr("src", href);
        $('#timeline-iframe').height(parseInt($(window).height() * 0.85));
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

$(function(){
    var $container = $('.my-timeline .timeline');
    $container.infinitescroll({
        navSelector  : "#infinite_pagination",
        nextSelector : "#infinite_pagination .next",
        itemSelector : ".my-timeline .timeline li",
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
    $('#my-timeline-more').click(function(){
        $container.infinitescroll('retrieve');
        $('#infinite_pagination').show();
        return false;
    });
});
</script>