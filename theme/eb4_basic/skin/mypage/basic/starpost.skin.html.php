<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/starpost.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.starpost-list {font-size:.9375rem}
.starpost-list .sl-wrap {position:relative;border-top:2px solid #757575;border-bottom:1px solid #757575}
.starpost-list .sl-wrap > div:nth-last-child(1), .starpost-list .sl-wrap > div:nth-last-child(2) {border-bottom:0}
.starpost-list .sl-head {position:relative;display:table;width:100%;height:50px;border-bottom:1px solid #757575;background-color:#f2f2f2;font-weight:500}
.starpost-list .sl-head > div {position:relative}
.starpost-list .sl-head > div:before {content:"";position:absolute;top:50%;right:0;width:1px;height:13px;background-color:#cacaca;transform:translateY(-50%)}
.starpost-list .sl-head > div:last-child:before {display:none}
.starpost-list .sl-head .sl-item {display:table-cell;vertical-align:middle;width:120px;text-align:center}
.starpost-list .sl-head .sl-num {width:90px}
.starpost-list .sl-head .sl-num-short {width:80px}
.starpost-list .sl-head .sl-author {width:150px;padding:0 10}
.starpost-list .sl-head .sl-subj {display:table-cell;vertical-align:middle;text-align:center}
.starpost-list .sl-list {position:relative;display:table;table-layout:fixed;;width:100%;height:46px;border-bottom:1px solid #eaeaea;padding:8px 0}
.starpost-list .sl-list > div {position:relative}
.starpost-list .sl-list > div:before {content:"";position:absolute;top:50%;right:0;width:1px;height:13px;background-color:#dadada;transform:translateY(-50%)}
.starpost-list .sl-list > div:last-child:before {display:none}
.starpost-list .sl-list .sl-item {display:table-cell;vertical-align:middle;width:120px;text-align:center}
.starpost-list .sl-list .sl-num {width:90px}
.starpost-list .sl-list .sl-num-short {width:80px}
.starpost-list .sl-list .sl-author {width:150px;padding:0 10px;text-align:left}
.starpost-list .sl-list .sl-subj {display:table-cell;vertical-align:middle;font-weight:500}
.starpost-list .sl-list .sl-subj a {position:relative;padding:0 10px 0 0;overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical}
.starpost-list .sl-list .sl-subj a:hover {color:#000;text-decoration:underline}
.starpost-list .sl-list .sl-subj .sl-img {position:absolute;top:0;left:0;width:50px;height:50px;overflow:hidden} 
.starpost-list .sl-list .sl-subj .sl-img img {background-repeat:no-repeat;background-size:cover;background-attachment:fixed;background-position:50% 50%;height:100%}
.starpost-list .sl-list .sl-subj .sl-type {color:#959595;margin-right:3px}
.starpost-list .sl-list .sl-subj-img {padding-left:60px;height:50px}
.starpost-list .sl-list .sl-comment {color:#959595}
.starpost-list .sl-list .sl-comment strong {color:#f4511e;font-weight:400}
.starpost-list .sl-list .sl-photo {display:inline-block;margin-right:2px}
.starpost-list .sl-list .sl-photo img {width:17px;height:17px;border-radius:50%}
.starpost-list .sl-list .sl-photo .sl-user-icon {font-size:.9375rem}
.starpost-list .starpost-star {position:relative;width:75px;margin:0 auto}
.starpost-list .star-ratings-list {width:75px}
.starpost-list .star-ratings-list li {padding:0;float:left;margin-right:0}
.starpost-list .star-ratings-list li .rating {color:#a5a5a5;font-size:.8125rem;line-height:normal}
.starpost-list .star-ratings-list li .rating-selected {color:#ab0000;font-size:.8125rem}
.starpost-list .sl-mobile {position:relative;border-bottom:1px solid #eaeaea;padding:0 0 8px;color:#959595;display:none}
.starpost-list .sl-mobile .sl-photo {display:inline-block;margin-right:2px}
.starpost-list .sl-mobile .sl-photo img {width:17px;height:17px;border-radius:50%}
.starpost-list .sl-mobile .sl-photo .sl-user-icon {font-size:.9375rem}
.starpost-list .sl-mobile-right {float:right}
.starpost-list .sl-mobile-right .starpost-star {display:inline-block;margin:0 0 -5px 5px}
.starpost-list .sl-no-list {text-align:center;color:#959595;padding:70px 0}
.starpost-list .view-infinite-more .btn-e-xlg {position:relative;height:50px;line-height:50px;padding:0 120px;font-size:1.0625rem !important;border:1px solid #b5b5b5;background:#fff;color:#757575}
.starpost-list .view-infinite-more .btn-e-xlg i {position:absolute;top:10px;right:5px;font-size:30px;color:#fff;transition:all 0.2s ease-in-out}
.starpost-list .view-infinite-more .btn-e-xlg:hover {border:1px solid #959595;background:#f5f5f5;color:#000}
.starpost-list .view-infinite-more .btn-e-xlg:hover i {color:#b5b5b5}
#infscr-loading {text-align:center;z-index:100;position:absolute;left:50%;bottom:0;width:200px;margin-left:-100px;padding:8px 0;background:#000;opacity:0.8;color:#fff}
@media (max-width:991px) {
    .starpost-list .starpost-select {position:relative;top:inherit;right:inherit;width:250px;margin-top:10px}
    .starpost-list .starpost-select .eyoom-form label {margin-bottom:0}
    .starpost-list .sl-head {display:none}
    .starpost-list .sl-head-checkbox {display:table}
    .starpost-list .sl-head > div:before, .starpost-list .sl-list > div:before, .starpost-list .sl-head .sl-item, .starpost-list .sl-list .sl-item {display:none}
    .starpost-list .sl-head .sl-num-checkbox, .starpost-list .sl-list .sl-num-checkbox {display:table-cell;width:25px}
    .starpost-list .sl-head .sl-num-checkbox .sl-txt, .starpost-list .sl-list .sl-num-checkbox .sl-txt {visibility:visible;opacity:0}
    .starpost-list .sl-head .checkbox, .starpost-list .sl-list .checkbox {z-index:1}
    .starpost-list .sl-list {border-bottom:0}
    .starpost-list .sl-list .sl-subj a {padding:0}
    .starpost-list .sl-list .sl-subj .sl-img {left:inherit;right:0}
    .starpost-list .sl-list .sl-subj-img {padding-left:0;padding-right:60px}
    .starpost-list .sl-mobile {display:block}
}
</style>
<?php if ($side_layout['use'] == 'yes') { ?>
<style>
@media (max-width:1199px) {
    .starpost-list .starpost-select {position:relative;top:inherit;right:inherit;width:250px;margin-top:10px}
    .starpost-list .starpost-select .eyoom-form label {margin-bottom:0}
    .starpost-list .sl-head {display:none}
    .starpost-list .sl-head-checkbox {display:table}
    .starpost-list .sl-head > div:before, .starpost-list .sl-list > div:before, .starpost-list .sl-head .sl-item, .starpost-list .sl-list .sl-item {display:none}
    .starpost-list .sl-head .sl-num-checkbox, .starpost-list .sl-list .sl-num-checkbox {display:table-cell;width:25px}
    .starpost-list .sl-head .sl-num-checkbox .sl-txt, .starpost-list .sl-list .sl-num-checkbox .sl-txt {visibility:visible;opacity:0}
    .starpost-list .sl-head .checkbox, .starpost-list .sl-list .checkbox {z-index:1}
    .starpost-list .sl-list {border-bottom:0}
    .starpost-list .sl-list .sl-subj a {padding:0}
    .starpost-list .sl-list .sl-subj .sl-img {left:inherit;right:0}
    .starpost-list .sl-list .sl-subj-img {padding-left:0;padding-right:60px}
    .starpost-list .sl-mobile {display:block}
}
</style>
<?php } ?>

<div class="starpost-list">
    <blockquote class="hero m-b-30">
        <p class="li-p"><i class="fas fa-exclamation-circle li-p-fa"></i> 내가 별점 평가한 게시물을 모아 봅니다.</p>
    </blockquote>

    <div class="sl-wrap">
        <div class="sl-head">
            <div class="sl-subj">제목 / 이미지</div>
            <div class="sl-item sl-author">글쓴이</div>
            <div class="sl-item">게시판</div>
            <div class="sl-item">날짜</div>
            <div class="sl-item sl-num">조회</div>
            <div class="sl-item">별점</div>
        </div>
        <?php if (isset($list) && is_array($list)) { ?>
        <?php foreach ($list as $key => $li) { ?>
        <div class="sl-list-wrap">
            <div class="sl-list">
                <div class="sl-subj <?php if ($li['wr_image']) { ?>sl-subj-img<?php } ?>">
                    <?php if ($li['wr_image']) { ?>
                    <div class="sl-img">
                        <img src="<?php echo $li['wr_image']; ?>" alt="">
                    </div>
                    <?php } ?>
                    <a href="<?php echo $li['href']; ?>" <?php if ($li['secret']) { ?>onclick="return false;"<?php } else if (!G5_IS_MOBILE) { ?>onclick="starpost_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                        <span class="subj"><?php echo get_text($li['wr_subject']); ?></span>
                        <?php if ($li['wr_comment']) { ?>
                        <span class="sound_only">댓글</span><span class="sl-comment m-l-5"><strong><i class="far fa-comment-dots"></i> <?php echo number_format($li['wr_comment']); ?></strong></span><span class="sound_only">개</span>
                        <?php } ?>
                    </a>
                </div>
                <div class="sl-item sl-author">
                    <span class="sl-name-in"><?php echo eb_nameview($li['mb_id'], $li['wr_name'], $li['wr_email']); ?></span>
                </div>
                <div class="sl-item text-gray">
                    <?php echo $li['bo_info']['bo_name']; ?>
                </div>
                <div class="sl-item">
                    <?php echo $eb->date_time('Y-m-d',$li['datetime']); ?>
                </div>
                <div class="sl-item sl-num text-gray">
                    <?php echo number_format($li['wr_hit']); ?>
                </div>
                <div class="sl-item">
                    <div class="starpost-star">
                        <ul class="list-unstyled star-ratings-list">
                            <li><i class="<?php if ($li['star'] <= 0) { ?>rating far fa-star<?php } else if ($li['star'] > 0.3 && $li['star'] <= 0.7) { ?>rating-selected fas fa-star-half<?php } else if ($li['star'] > 0.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
                            <li><i class="<?php if ($li['star'] <= 1) { ?>rating far fa-star<?php } else if ($li['star'] > 1.3 && $li['star'] <= 1.7) { ?>rating-selected fas fa-star-half<?php } else if ($li['star'] > 1.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
                            <li><i class="<?php if ($li['star'] <= 2) { ?>rating far fa-star<?php } else if ($li['star'] > 2.3 && $li['star'] <= 2.7) { ?>rating-selected fas fa-star-half<?php } else if ($li['star'] > 2.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
                            <li><i class="<?php if ($li['star'] <= 3) { ?>rating far fa-star<?php } else if ($li['star'] > 3.3 && $li['star'] <= 3.7) { ?>rating-selected fas fa-star-half<?php } else if ($li['star'] > 3.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
                            <li><i class="<?php if ($li['star'] <= 4) { ?>rating far fa-star<?php } else if ($li['star'] > 4.3 && $li['star'] <= 4.7) { ?>rating-selected fas fa-star-half<?php } else if ($li['star'] > 4.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="sl-mobile"><?php /* 991px 이하에서만 보임 */ ?>
                <span class="m-r-5">
                    <span class="sl-name-in"><?php echo eb_nameview($li['mb_id'], $li['wr_name'], $li['wr_email']); ?></span>
                </span>
                <span class="m-r-5">
                    [<?php echo $li['bo_info']['bo_name']; ?>]
                </span>
                <div class="sl-mobile-right">
                    <span class="m-l-5"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d',$li['datetime']); ?></span>
                    <span class="m-l-5">
                        <div class="starpost-star">
                            <ul class="list-unstyled star-ratings-list">
                                <li><i class="<?php if ($li['star'] <= 0) { ?>rating far fa-star<?php } else if ($li['star'] > 0.3 && $li['star'] <= 0.7) { ?>rating-selected fas fa-star-half<?php } else if ($li['star'] > 0.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
                                <li><i class="<?php if ($li['star'] <= 1) { ?>rating far fa-star<?php } else if ($li['star'] > 1.3 && $li['star'] <= 1.7) { ?>rating-selected fas fa-star-half<?php } else if ($li['star'] > 1.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
                                <li><i class="<?php if ($li['star'] <= 2) { ?>rating far fa-star<?php } else if ($li['star'] > 2.3 && $li['star'] <= 2.7) { ?>rating-selected fas fa-star-half<?php } else if ($li['star'] > 2.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
                                <li><i class="<?php if ($li['star'] <= 3) { ?>rating far fa-star<?php } else if ($li['star'] > 3.3 && $li['star'] <= 3.7) { ?>rating-selected fas fa-star-half<?php } else if ($li['star'] > 3.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
                                <li><i class="<?php if ($li['star'] <= 4) { ?>rating far fa-star<?php } else if ($li['star'] > 4.3 && $li['star'] <= 4.7) { ?>rating-selected fas fa-star-half<?php } else if ($li['star'] > 4.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
                            </ul>
                        </div>
                    </span>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
        <?php if (count((array)$list) == 0) { ?>
            <div class="sl-no-list">
            <i class="fas fa-exclamation-circle"></i> 별점 평가한 게시물이 없습니다.
        </div>
        <?php } ?>
    </div>
    <?php if (count((array)$list) > 0) { ?>
    <div id="infinite_pagination">
        <a class="next" href="<?php echo G5_URL; ?>/mypage/?t=starpost&page=<?php echo ($page+1); ?>"></a>
    </div>
    <div class="view-infinite-more text-center m-t-30">
        <a id="my-starpost-more" href="#" class="btn btn-e-xlg">더 보기<i class="far fa-arrow-alt-circle-down"></i></a>
    </div>
    <?php } ?>
</div>

<?php /* 관심게시판 상세보기 모달 시작 */ ?>
<div class="modal fade starpost-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="starpost-iframe" width="100%" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<?php /* 관심게시판 상세보기 모달 끝 */ ?>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/infinite-scroll/jquery.infinitescroll.min.js"></script>
<script>
function starpost_modal(href) {
    $('.starpost-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#starpost-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.starpost-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#starpost-iframe").attr("src", href);
        $('#starpost-iframe').height(parseInt($(window).height() * 0.85));
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

$(function(){
    var $container = $('.sl-wrap');
    $container.infinitescroll({
        navSelector  : "#infinite_pagination",
        nextSelector : "#infinite_pagination .next",
        itemSelector : ".sl-list-wrap",
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
    $('#my-starpost-more').click(function(){
        $container.infinitescroll('retrieve');
        $('#infinite_pagination').show();
        return false;
    });
});
</script>