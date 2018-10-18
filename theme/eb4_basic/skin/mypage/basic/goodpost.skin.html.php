<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/goodpost.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.my-goodpost .goodpost-hero {position:relative;padding:10px 15px 9px}
.my-goodpost .goodpost-hero p {margin:0;font-size:12px;color:#757575}
.goodpost-head {position:relative;border-top:2px solid #757575;border-bottom:1px solid #959595;padding:12px 0;background:#fafafa;font-weight:bold}
.goodpost-head .goodpost-head-subj {text-align:center;padding-right:435px}
.goodpost-head .goodpost-head-info {position:absolute;top:12px;right:0}
.goodpost-head .goodpost-head-marker, .goodpost-head .goodpost-head-member, .goodpost-head .goodpost-head-date {position:relative;float:left;width:100px;padding-right:10px}
.goodpost-head .goodpost-head-good {position:relative;float:left;width:60px;padding-right:10px}
.goodpost-head .goodpost-head-hit {position:relative;float:left;width:60px;text-align:center}
.my-goodpost .infinite-container {position:relative;border-bottom:1px solid #eaeaea}
.goodpost-box {position:relative;border-top:1px solid #eaeaea;background:#fff}
.goodpost-box .goodpost-list {position:relative;height:56px}
.goodpost-box .goodpost-img-box {position:absolute;top:5px;left:0;width:46px;height:46px;overflow:hidden}
.goodpost-box .goodpost-img {position:relative;overflow:hidden;width:106px;margin-left:-30px;margin-top:-10px}
.goodpost-box .goodpost-subj {margin:0;line-height:56px;font-size:12px}
.goodpost-box .goodpost-subj:hover {text-decoration:underline}
.goodpost-box .goodpost-subj strong {font-weight:normal}
.goodpost-box .goodpost-subj.goodpost-subj-margin {margin-left:60px}
.goodpost-box .goodpost-subj .goodpost-type {color:#b5b5b5;margin-right:3px;letter-spacing:-1px}
.goodpost-box .goodpost-subj .goodpost-comment {display:inline-block;white-space:nowrap;vertical-align:baseline;text-align:center;min-width:35px;padding:1px;font-size:10px;line-height:1;color:#fff;background-color:#757575;margin-right:5px}
.goodpost-box .goodpost-info {position:absolute;top:5px;right:0;font-size:12px;height:46px;line-height:46px;padding-left:15px;background:#fff}
.goodpost-box .goodpost-info .goodpost-good {position:relative;float:left;width:60px;padding-right:10px}
.goodpost-box .goodpost-info .goodpost-marker {position:relative;float:left;width:100px;padding-right:10px}
.goodpost-box .goodpost-info .goodpost-member {position:relative;float:left;width:100px;padding-right:10px}
.goodpost-box .goodpost-info .goodpost-member .goodpost-photo {position:absolute;top:12px;left:0;overflow:hidden;width:20px;height:20px;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.goodpost-box .goodpost-info .goodpost-member .goodpost-photo img {display:block;width:100% \9;max-width:100%;height:auto}
.goodpost-box .goodpost-info .goodpost-member .goodpost-nick {display:inline-block;margin-left:25px}
.goodpost-box .goodpost-info .goodpost-member .goodpost-nick .sv_wrap > a {display:block;overflow:hidden;white-space:nowrap;word-wrap:normal;text-overflow:ellipsis;color:#252525;width:65px}
.goodpost-box .goodpost-info .goodpost-member .goodpost-nick .sv_wrap > .dropdown-menu {margin-top:-10px}
.goodpost-box .goodpost-info .goodpost-date {position:relative;float:left;width:100px;padding-right:10px;color:#959595}
.goodpost-box .goodpost-info .goodpost-hit {position:relative;float:left;width:60px;text-align:center;color:#959595}
.goodpost-box:nth-child(odd) .goodpost-list {background:#fcfcfc}
.goodpost-box:nth-child(odd) .goodpost-info {background:#fcfcfc}
.my-goodpost .view-infinite-more .btn-e-xlg {position:relative;height:40px;line-height:40px;padding:0 100px;font-size:16px !important;border:1px solid #b5b5b5;background:#fff;color:#757575}
.my-goodpost .view-infinite-more .btn-e-xlg i {position:absolute;top:5px;right:5px;font-size:30px;color:#fff;transition:all 0.2s ease-in-out}
.my-goodpost .view-infinite-more .btn-e-xlg:hover {border:1px solid #959595;background:#f5f5f5;color:#000}
.my-goodpost .view-infinite-more .btn-e-xlg:hover i {color:#b5b5b5}
#infscr-loading {text-align:center;z-index:100;position:absolute;left:50%;bottom:0;width:200px;margin-left:-100px;padding:8px 0;background:#000;opacity:0.8;color:#fff}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width: 767px) {
    .goodpost-head .goodpost-head-subj {text-align:center;padding-right:0}
    .goodpost-head .goodpost-head-info {display:none}
    .goodpost-box .goodpost-subj {line-height:30px}
    .goodpost-box .goodpost-subj strong {font-weight:bold}
    .goodpost-box .goodpost-info {top:inherit;right:inherit;bottom:5px;left:0;padding-left:0;height:23px;line-height:23px;background:transparent}
    .goodpost-box .goodpost-info.goodpost-info-margin {left:60px}
    .goodpost-box .goodpost-info .goodpost-good, .goodpost-box .goodpost-info .goodpost-marker, .goodpost-box .goodpost-info .goodpost-member, .goodpost-box .goodpost-info .goodpost-date, .goodpost-box .goodpost-info .goodpost-hit {width:auto}
    .goodpost-box .goodpost-info .goodpost-marker {color:#959595}
    .goodpost-box .goodpost-info .goodpost-member .goodpost-photo {display:none}
    .goodpost-box .goodpost-info .goodpost-member .goodpost-nick {margin-left:0}
    .goodpost-box .goodpost-info .goodpost-member .goodpost-nick .sv_wrap > a {display:inherit;overflow:inherit;white-space:inherit;word-wrap:inherit;text-overflow:inherit;color:#252525;width:auto}
    .goodpost-box .goodpost-info .goodpost-member .goodpost-nick .sv_wrap > .dropdown-menu {margin-top:5px}
}
<?php } ?>
@media (min-width: 768px) {
    .my-goodpost-modal {width:720px;margin:10px auto}
    .my-goodpost-modal .modal-header, .my-goodpost-modal .modal-body, .my-goodpost-modal .modal-footer {padding:10px 20px}
}
@media (min-width: 992px) {
    .my-goodpost-modal {width:940px}
}
@media (min-width: 1200px) {
    .my-goodpost-modal {width:1140px}
}
</style>

<div class="my-goodpost">
    <div class="headline-short">
        <h4><strong>추천글 / 비추천글</strong></h4>
    </div>
    <blockquote class="hero goodpost-hero">
        <p><i class="fas fa-exclamation-circle"></i> 내가 추천 또는 비추천한 원글만 모아 봅니다.</p>
    </blockquote>
    <?php if (isset($list) && is_array($list)) { ?>
    <div class="infinite-container">
        <div class="goodpost-head">
            <div class="goodpost-head-subj">제목 / 이미지</div>
            <div class="goodpost-head-info">
                <div class="goodpost-head-good">상태</div>
                <div class="goodpost-head-marker">게시판</div>
                <div class="goodpost-head-member">글쓴이</div>
                <div class="goodpost-head-date">날짜</div>
                <div class="goodpost-head-hit">뷰</div>
            </div>
        </div>
        <?php foreach ($list as $key => $li) { ?>
        <article class="goodpost-box">
            <div class="goodpost-list">
                <a href="<?php echo $li['href']; ?>" <?php if ($li['secret']) { ?>onclick="return false;"<?php } else if (!G5_IS_MOBILE) { ?>onclick="goodpost_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                    <?php if ($li['wr_image']) { ?>
                    <div class="goodpost-img-box">
                        <div class="goodpost-img">
                            <img src="<?php echo $li['wr_image']; ?>" class="img-responsive" alt="">
                        </div>
                    </div>
                    <?php } ?>
                    <h5 class="goodpost-subj ellipsis <?php if ($li['wr_image']) { ?>goodpost-subj-margin<?php } ?>">
                        <?php if ($li['wr_comment']) { ?>
                        <span class="goodpost-comment">+<?php echo number_format($li['wr_comment']); ?></span>
                        <?php } ?>
                        <strong><?php echo get_text($li['wr_subject']); ?></strong>
                    </h5>
                </a>
                <div class="goodpost-info <?php if ($li['wr_image']) { ?>goodpost-info-margin<?php } ?>">
                    <div class="goodpost-good">
                        <?php echo $li['is_good'] == 'good' ? '<strong class=\'color-red\'>추천</strong>': '<strong class=\'color-yellow\'>비추</strong>'; ?>
                    </div>
                    <div class="goodpost-marker ellipsis">
                        <?php echo $li['bo_info']['bo_name']; ?>
                    </div>
                    <div class="goodpost-member">
                        <div class="goodpost-photo">
                            <?php if ($li['mb_photo']) { echo $li['mb_photo']; } else { ?><img src="<?php echo $eyoom_skin_url['mypage']; ?>/img/user.jpg" alt="회원사진"><?php } ?>
                        </div>
                        <div class="goodpost-nick"><?php echo eb_nameview($li['mb_id'], $li['wr_name'], $li['wr_email']); ?></div>
                    </div>
                    <div class="goodpost-date">
                        <i class="far fa-clock margin-right-5"></i><?php echo $eb->date_time('Y-m-d',$li['datetime']); ?>
                    </div>
                    <div class="goodpost-hit ellipsis hidden-xs">
                        <i class="fas fa-eye margin-right-5 hidden-lg hidden-md hidden-sm"></i><?php echo $li['wr_hit']; ?>
                    </div>
                </div>
            </div>
        </article>
        <?php } ?>
    </div>
    <div id="infinite_pagination">
        <a class="next" href="<?php echo G5_URL; ?>/mypage/?t=goodpost&page=<?php echo ($page+1); ?>"></a>
    </div>
    <div class="view-infinite-more text-center margin-top-40 margin-bottom-20">
        <a id="my-goodpost-more" href="#" class="btn btn-default btn-e-xlg">더 보기<i class="far fa-arrow-alt-circle-down"></i></a>
    </div>
    <?php } else { ?>
    <div class="text-center margin-top-30 margin-bottom-30 color-grey font-size-13">
        <i class="fa fa-exclamation-circle"></i> 추천 및 비추천을 체크한 게시물이 없습니다.
    </div>
    <?php } ?>
</div>

<?php /* 관심게시판 상세보기 모달 시작 */ ?>
<div class="modal fade goodpost-iframe-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog my-goodpost-modal">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <div class="modal-body">
                <iframe id="goodpost-iframe" width="100%" frameborder="0"></iframe>
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
function goodpost_modal(href) {
    $('.goodpost-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#goodpost-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.goodpost-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#goodpost-iframe").attr("src", href);
        $('#goodpost-iframe').height(parseInt($(window).height() * 0.85));
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

$(function(){
    var $container = $('.infinite-container');
    $container.infinitescroll({
        navSelector  : "#infinite_pagination",
        nextSelector : "#infinite_pagination .next",
        itemSelector : ".goodpost-box",
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
    $('#my-goodpost-more').click(function(){
        $container.infinitescroll('retrieve');
        $('#infinite_pagination').show();
        return false;
    });
});
</script>