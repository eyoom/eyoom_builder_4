<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/timeline.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.my-timeline {font-size:.9375rem}
.my-timeline .timeline {position:relative;padding:20px 0;list-style:none}
.my-timeline .timeline:before {top:0;bottom:0;position:absolute;content:"";width:1px;background-color:#d5d5d5;left:50%;margin-left:-1px}
.my-timeline .timeline:after {content:"";display:block;clear:both}
.my-timeline .timeline > li {margin-bottom:40px;position:relative;width:50%;float:left;clear:left}
.my-timeline .timeline > li:before,.my-timeline .timeline > li:after {content:"";display:table}
.my-timeline .timeline > li:after {clear:both}
.my-timeline .timeline > li:before,.my-timeline .timeline > li:after {content: "";display:table}
.my-timeline .timeline > li:after {clear:both}
.my-timeline .timeline > li > .timeline-panel {position:relative;width:94%;float:left;border:1px solid #d5d5d5}
.my-timeline .timeline > li > .timeline-panel:before {position: absolute;top:33px;right:-8px;display:inline-block;border-top:8px solid transparent;border-left:8px solid #c5c5c5;border-right:0 solid #c5c5c5;border-bottom:8px solid transparent;content:""}
.my-timeline .timeline > li > .timeline-panel:after {position:absolute;top:34px;right:-7px;display:inline-block;border-top:7px solid transparent;border-left:7px solid #fff;border-right:0 solid #fff;border-bottom:7px solid transparent;content:""}
.my-timeline .timeline > li > .timeline-badge {width:14px;height:14px;position:absolute;background:#ab0000;margin:0;border:2px solid #fff;box-shadow:0 0 0 1px #b5b5b5;border-radius:50%;top:35px;right:-6px;z-index:9}
.my-timeline .timeline > li.timeline-inverted > .timeline-panel {float:right}
.my-timeline .timeline > li.timeline-inverted > .timeline-panel:before {border-left-width:0;border-right-width:8px;left:-8px;right:auto}
.my-timeline .timeline > li.timeline-inverted > .timeline-panel:after {border-left-width:0;border-right-width:7px;left:-7px;right:auto}
.my-timeline .timeline > li.timeline-inverted {float:right;clear:right;margin-top:40px;margin-bottom:0}
.my-timeline .timeline > li.timeline-inverted > .timeline-badge {left:-8px}
.my-timeline .timeline > li > .timeline-panel a {color:#252525}
.my-timeline .timeline > li > .timeline-panel .timeline-heading {position:relative;overflow:hidden;display:block;padding:0 15px}
.my-timeline .timeline > li > .timeline-panel .timeline-heading .timeline-img {position:relative;overflow:hidden;max-height:180px;margin-top:15px}
.my-timeline .timeline > li > .timeline-panel .timeline-heading .timeline-img img {width:100%}
.my-timeline .timeline > li > .timeline-panel .timeline-top {padding:15px}
.my-timeline .timeline > li > .timeline-panel .timeline-top i {color:#757575}
.my-timeline .timeline > li > .timeline-panel .timeline-body {padding:0 15px 15px}
.my-timeline .timeline > li > .timeline-panel .timeline-body h5 {font-size:.9375rem;display:block;margin:0 0 10px}
.my-timeline .timeline > li > .timeline-panel .timeline-body p {margin-bottom:0}
.my-timeline .timeline > li > .timeline-panel .timeline-body span {color:#888}
.my-timeline .timeline > li > .timeline-panel .timeline-footer {padding:15px;overflow:hidden;border-top:1px solid #e5e5e5;color:#757575}
.my-timeline .timeline > li > .timeline-panel:hover .timeline-body h5, .my-timeline .timeline > li > .timeline-panel:hover .timeline-body p {text-decoration:underline}
.my-timeline .view-infinite-more .btn-e-xlg {position:relative;height:50px;line-height:50px;padding:0 120px;font-size:1.0625rem !important;border:1px solid #b5b5b5;background:#fff;color:#757575}
.my-timeline .view-infinite-more .btn-e-xlg i {position:absolute;top:10px;right:5px;font-size:30px;color:#fff;transition:all 0.2s ease-in-out}
.my-timeline .view-infinite-more .btn-e-xlg:hover {border:1px solid #959595;background:#f5f5f5;color:#000}
.my-timeline .view-infinite-more .btn-e-xlg:hover i {color:#b5b5b5}
#infscr-loading {text-align:center;z-index:100;position:absolute;left:50%;bottom:0;width:200px;margin-left:-100px;padding:8px 0;background:#000;opacity:0.8;color:#fff}
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
</style>

<div class="my-timeline">
    <?php if (isset($list) && is_array($list)) { ?>
    <ul class="timeline">
        <?php foreach ($list as $key => $li) { ?>
        <li class="<?php if ($key%2 == 1) { ?>timeline-inverted<?php } ?>">
            <div class="timeline-badge"></div>
            <div class="timeline-panel">
                <div class="timeline-heading">
                    <?php if ($li['wr_image']) { ?>
                    <div class="timeline-img">
                        <a href="<?php echo $li['href']; ?>" <?php if (!G5_IS_MOBILE) { ?>onclick="timeline_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>><img class="img-fluid" src="<?php echo $li['wr_image']; ?>" alt=""></a>
                    </div>
                    <?php } ?>
                </div>
                <a href="<?php echo $li['href']; ?>" <?php if (!G5_IS_MOBILE) { ?>onclick="timeline_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                    <div class="timeline-top">
                        <span class="float-start"><?php if ($li['wr_id'] == $li['wr_parent']) { ?><span class="text-indigo">글작성</span><?php } else { ?><span class="text-gray">댓글</span><?php } ?></i></span>
                        <strong class="float-end"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$li['datetime']); ?></strong>
                        <div class="clearfix"></div>
                    </div>
                    <div class="timeline-body">
                        <?php if ($li['wr_id'] == $li['wr_parent']) { ?>
                        <h5 class="ellipsis m-b-15"><?php echo get_text($li['wr_subject']); ?></h5>
                        <?php } ?>
                        <p class="text-gray">
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
                    <span class="float-start">
                        <i class="far fa-eye m-r-5"></i><?php echo number_format($li['wr_hit']); ?><i class="far fa-comment-dots m-r-5 m-l-10"></i><?php echo number_format($li['wr_comment']); ?>
                    </span>
                    <?php } ?>
                    <span class="float-end">
                        <?php if(0) { // 그룹명 숨김처리 ?>[<?php echo $li['bo_info']['gr_name']; ?>] <?php } ?>
                        [<?php echo $li['bo_info']['bo_name']; ?>]
                    </span>
                    <div class="clearfix"></div>
                </div>
            </div>
        </li>
        <?php } ?>
    </ul>
    <?php } ?>
    <?php if (count((array)$list) == 0) { ?>
    <div class="text-center m-t-30 m-b-30 text-gray">
        <i class="fa fa-exclamation-circle"></i> 타임라인에 표시할 게시글 활동이 없습니다.
    </div>
    <?php } ?>
    <?php if (count((array)$list) > 0) { ?>
    <div id="infinite_pagination">
        <a class="next" href="<?php echo G5_URL; ?>/mypage/?t=timeline&page=<?php echo ($page+1); ?>"></a>
    </div>
    <div class="view-infinite-more text-center m-t-30">
        <a id="my-timeline-more" href="#" class="btn btn-e-xlg">더 보기<i class="far fa-arrow-alt-circle-down"></i></a>
    </div>
    <?php } ?>
</div>

<?php /* 타임라인 상세보기 모달 시작 */ ?>
<div class="modal fade timeline-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="timeline-iframe" width="100%" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<?php /* 타임라인 상세보기 모달 끝 */ ?>

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