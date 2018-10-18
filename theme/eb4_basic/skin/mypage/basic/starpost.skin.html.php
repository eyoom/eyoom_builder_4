<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/starpost.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.my-starpost .starpost-hero {position:relative;padding:10px 15px 9px}
.my-starpost .starpost-hero p {margin:0;font-size:12px;color:#757575}
.starpost-head {position:relative;border-top:2px solid #757575;border-bottom:1px solid #959595;padding:12px 0;background:#fafafa;font-weight:bold}
.starpost-head .starpost-head-subj {text-align:center;padding-right:475px}
.starpost-head .starpost-head-info {position:absolute;top:12px;right:0}
.starpost-head .starpost-head-marker, .starpost-head .starpost-head-member, .starpost-head .starpost-head-date {position:relative;float:left;width:100px;padding-right:10px}
.starpost-head .starpost-head-star {position:relative;float:left;width:80px;padding-right:10px}
.starpost-head .starpost-head-hit {position:relative;float:left;width:60px;text-align:center}
.my-starpost .infinite-container {position:relative;border-bottom:1px solid #eaeaea}
.starpost-box {position:relative;border-top:1px solid #eaeaea;background:#fff}
.starpost-box .starpost-list {position:relative;height:56px}
.starpost-box .starpost-img-box {position:absolute;top:5px;left:0;width:46px;height:46px;overflow:hidden}
.starpost-box .starpost-img {position:relative;overflow:hidden;width:106px;margin-left:-30px;margin-top:-10px}
.starpost-box .starpost-subj {margin:0;line-height:56px;font-size:12px}
.starpost-box .starpost-subj:hover {text-decoration:underline}
.starpost-box .starpost-subj strong {font-weight:normal}
.starpost-box .starpost-subj.starpost-subj-margin {margin-left:60px}
.starpost-box .starpost-subj .starpost-type {color:#b5b5b5;margin-right:3px;letter-spacing:-1px}
.starpost-box .starpost-subj .starpost-comment {display:inline-block;white-space:nowrap;vertical-align:baseline;text-align:center;min-width:35px;padding:1px;font-size:10px;line-height:1;color:#fff;background-color:#757575;margin-right:5px}
.starpost-box .starpost-info {position:absolute;top:5px;right:0;font-size:12px;height:46px;line-height:46px;padding-left:15px;background:#fff}
.starpost-box .starpost-info .starpost-star {position:relative;float:left;width:80px;padding-right:10px}
.starpost-box .starpost-info .star-ratings-list {width:70px;margin:0 auto}
.starpost-box .starpost-info .star-ratings-list li {padding:0;float:left;margin-right:0}
.starpost-box .starpost-info .star-ratings-list li .rating {color:#a5a5a5;font-size:10px;line-height:normal}
.starpost-box .starpost-info .star-ratings-list li .rating-selected {color:#FF4848;font-size:10px}
.starpost-box .starpost-info .starpost-marker {position:relative;float:left;width:100px;padding-right:10px}
.starpost-box .starpost-info .starpost-member {position:relative;float:left;width:100px;padding-right:10px}
.starpost-box .starpost-info .starpost-member .starpost-photo {position:absolute;top:12px;left:0;overflow:hidden;width:20px;height:20px;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.starpost-box .starpost-info .starpost-member .starpost-photo img {display:block;width:100% \9;max-width:100%;height:auto}
.starpost-box .starpost-info .starpost-member .starpost-nick {display:inline-block;margin-left:25px}
.starpost-box .starpost-info .starpost-member .starpost-nick .sv_wrap > a {display:block;overflow:hidden;white-space:nowrap;word-wrap:normal;text-overflow:ellipsis;color:#252525;width:65px}
.starpost-box .starpost-info .starpost-member .starpost-nick .sv_wrap > .dropdown-menu {margin-top:-10px}
.starpost-box .starpost-info .starpost-date {position:relative;float:left;width:100px;padding-right:10px;color:#959595}
.starpost-box .starpost-info .starpost-hit {position:relative;float:left;width:60px;text-align:center;color:#959595}
.starpost-box:nth-child(odd) .starpost-list {background:#fcfcfc}
.starpost-box:nth-child(odd) .starpost-info {background:#fcfcfc}
.my-starpost .view-infinite-more .btn-e-xlg {position:relative;height:40px;line-height:40px;padding:0 100px;font-size:16px !important;border:1px solid #b5b5b5;background:#fff;color:#757575}
.my-starpost .view-infinite-more .btn-e-xlg i {position:absolute;top:5px;right:5px;font-size:30px;color:#fff;transition:all 0.2s ease-in-out}
.my-starpost .view-infinite-more .btn-e-xlg:hover {border:1px solid #959595;background:#f5f5f5;color:#000}
.my-starpost .view-infinite-more .btn-e-xlg:hover i {color:#b5b5b5}
#infscr-loading {text-align:center;z-index:100;position:absolute;left:50%;bottom:0;width:200px;margin-left:-100px;padding:8px 0;background:#000;opacity:0.8;color:#fff}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width: 767px) {
    .starpost-head .starpost-head-subj {text-align:center;padding-right:0}
    .starpost-head .starpost-head-info {display:none}
    .starpost-box .starpost-subj {line-height:30px}
    .starpost-box .starpost-subj strong {font-weight:bold}
    .starpost-box .starpost-info {top:inherit;right:inherit;bottom:5px;left:0;padding-left:0;height:23px;line-height:23px;background:transparent}
    .starpost-box .starpost-info.starpost-info-margin {left:60px}
    .starpost-box .starpost-info .starpost-star, .starpost-box .starpost-info .starpost-marker, .starpost-box .starpost-info .starpost-member, .starpost-box .starpost-info .starpost-date, .starpost-box .starpost-info .starpost-hit {width:auto}
    .starpost-box .starpost-info .starpost-marker {color:#959595}
    .starpost-box .starpost-info .starpost-member .starpost-photo {display:none}
    .starpost-box .starpost-info .starpost-member .starpost-nick {margin-left:0}
    .starpost-box .starpost-info .starpost-member .starpost-nick .sv_wrap > a {display:inherit;overflow:inherit;white-space:inherit;word-wrap:inherit;text-overflow:inherit;color:#252525;width:auto}
    .starpost-box .starpost-info .starpost-member .starpost-nick .sv_wrap > .dropdown-menu {margin-top:5px}
}
<?php } ?>
@media (min-width: 768px) {
    .my-starpost-modal {width:720px;margin:10px auto}
    .my-starpost-modal .modal-header, .my-starpost-modal .modal-body, .my-starpost-modal .modal-footer {padding:10px 20px}
}
@media (min-width: 992px) {
    .my-starpost-modal {width:940px}
}
@media (min-width: 1200px) {
    .my-starpost-modal {width:1140px}
}
</style>

<div class="my-starpost">
    <div class="headline-short">
        <h4><strong>별점평가글</strong></h4>
    </div>
    <blockquote class="hero starpost-hero">
        <p><i class="fas fa-exclamation-circle"></i> 내가 별점 평가한 원글만 모아 봅니다.</p>
    </blockquote>
    <?php if (isset($list) && is_array($list)) { ?>
    <div class="infinite-container">
        <div class="starpost-head">
            <div class="starpost-head-subj">제목 / 이미지</div>
            <div class="starpost-head-info">
                <div class="starpost-head-star">별점</div>
                <div class="starpost-head-marker">게시판</div>
                <div class="starpost-head-member">글쓴이</div>
                <div class="starpost-head-date">날짜</div>
                <div class="starpost-head-hit">뷰</div>
            </div>
        </div>
        <?php foreach ($list as $key => $li) { ?>
        <article class="starpost-box">
            <div class="starpost-list">
                <a href="<?php echo $li['href']; ?>" <?php if ($li['secret']) { ?>onclick="return false;"<?php } else if (!G5_IS_MOBILE) { ?>onclick="starpost_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                    <?php if ($li['wr_image']) { ?>
                    <div class="starpost-img-box">
                        <div class="starpost-img">
                            <img src="<?php echo $li['wr_image']; ?>" class="img-responsive" alt="">
                        </div>
                    </div>
                    <?php } ?>
                    <h5 class="starpost-subj ellipsis <?php if ($li['wr_image']) { ?>starpost-subj-margin<?php } ?>">
                        <?php if ($li['wr_comment']) { ?>
                        <span class="starpost-comment">+<?php echo number_format($li['wr_comment']); ?></span>
                        <?php } ?>
                        <strong><?php echo get_text($li['wr_subject']); ?></strong>
                    </h5>
                </a>
                <div class="starpost-info <?php if ($li['wr_image']) { ?>starpost-info-margin<?php } ?>">
                    <div class="starpost-star">
                        <ul class="list-unstyled star-ratings-list">
                            <li><i class="<?php if ($li['star'] <= 0) { ?>rating far fa-star<?php } else if ($li['star'] > 0.3 && $li['star'] <= 0.7) { ?>rating-selected fas fa-star-half<?php } else if ($li['star'] > 0.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
                            <li><i class="<?php if ($li['star'] <= 1) { ?>rating far fa-star<?php } else if ($li['star'] > 1.3 && $li['star'] <= 1.7) { ?>rating-selected fas fa-star-half<?php } else if ($li['star'] > 1.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
                            <li><i class="<?php if ($li['star'] <= 2) { ?>rating far fa-star<?php } else if ($li['star'] > 2.3 && $li['star'] <= 2.7) { ?>rating-selected fas fa-star-half<?php } else if ($li['star'] > 2.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
                            <li><i class="<?php if ($li['star'] <= 3) { ?>rating far fa-star<?php } else if ($li['star'] > 3.3 && $li['star'] <= 3.7) { ?>rating-selected fas fa-star-half<?php } else if ($li['star'] > 3.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
                            <li><i class="<?php if ($li['star'] <= 4) { ?>rating far fa-star<?php } else if ($li['star'] > 4.3 && $li['star'] <= 4.7) { ?>rating-selected fas fa-star-half<?php } else if ($li['star'] > 4.8) { ?>rating-selected fas fa-star<?php } ?>"></i></li>
                        </ul>
                    </div>
                    <div class="starpost-marker ellipsis hidden-xs">
                        <?php echo $li['bo_info']['bo_name']; ?>
                    </div>
                    <div class="starpost-member">
                        <div class="starpost-photo">
                            <?php if ($li['mb_photo']) { echo $li['mb_photo']; } else { ?><img src="<?php echo $eyoom_skin_url['mypage']; ?>/img/user.jpg" alt="회원사진"><?php } ?>
                        </div>
                        <div class="starpost-nick"><?php echo eb_nameview($li['mb_id'], $li['wr_name'], $li['wr_email']); ?></div>
                    </div>
                    <div class="starpost-date">
                        <i class="far fa-clock margin-right-5"></i><?php echo $eb->date_time('Y-m-d',$li['datetime']); ?>
                    </div>
                    <div class="starpost-hit ellipsis hidden-xs">
                        <i class="fas fa-eye margin-right-5 hidden-lg hidden-md hidden-sm"></i><?php echo $li['wr_hit']; ?>
                    </div>
                </div>
            </div>
        </article>
        <?php } ?>
    </div>
    <div id="infinite_pagination">
        <a class="next" href="<?php echo G5_URL; ?>/mypage/?t=starpost&page=<?php echo ($page+1); ?>"></a>
    </div>
    <div class="view-infinite-more text-center margin-top-40 margin-bottom-20">
        <a id="my-starpost-more" href="#" class="btn btn-default btn-e-xlg">더 보기<i class="far fa-arrow-alt-circle-down"></i></a>
    </div>
    <?php } else { ?>
    <div class="text-center margin-top-30 margin-bottom-30 color-grey font-size-13">
        <i class="fa fa-exclamation-circle"></i> 별점 평가한 게시물이 없습니다.
    </div>
    <?php } ?>
</div>

<?php /* 관심게시판 상세보기 모달 시작 */ ?>
<div class="modal fade starpost-iframe-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog my-starpost-modal">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <div class="modal-body">
                <iframe id="starpost-iframe" width="100%" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn-e btn-e-xlg btn-e-dark" type="button"><i class="fas fa-times"></i> 닫기</button>
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
    var $container = $('.infinite-container');
    $container.infinitescroll({
        navSelector  : "#infinite_pagination",
        nextSelector : "#infinite_pagination .next",
        itemSelector : ".starpost-box",
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