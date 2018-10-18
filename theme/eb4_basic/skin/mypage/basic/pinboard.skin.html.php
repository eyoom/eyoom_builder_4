<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/pinboard.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.my-pinboard .pinboard-hero {position:relative;padding:10px 15px 9px}
.my-pinboard .pinboard-hero p {margin:0;font-size:12px;color:#757575}
.pinboard-head {position:relative;border-top:2px solid #757575;border-bottom:1px solid #959595;padding:12px 0;background:#fafafa;font-weight:bold}
.pinboard-head .pinboard-head-subj {text-align:center;padding-right:475px}
.pinboard-head .pinboard-head-info {position:absolute;top:12px;right:0}
.pinboard-head .pinboard-head-marker, .pinboard-head .pinboard-head-member, .pinboard-head .pinboard-head-date {position:relative;float:left;width:100px;padding-right:10px}
.pinboard-head .pinboard-head-pin {position:relative;float:left;width:80px;padding-right:10px}
.pinboard-head .pinboard-head-hit {position:relative;float:left;width:60px;text-align:center}
.my-pinboard .infinite-container {position:relative;border-bottom:1px solid #eaeaea}
.pinboard-box {position:relative;border-top:1px solid #eaeaea;background:#fff}
.pinboard-box .pinboard-list {position:relative;height:56px}
.pinboard-box .pinboard-img-box {position:absolute;top:5px;left:0;width:46px;height:46px;overflow:hidden}
.pinboard-box .pinboard-img {position:relative;overflow:hidden;width:106px;margin-left:-30px;margin-top:-10px}
.pinboard-box .pinboard-subj {margin:0;line-height:56px;font-size:12px}
.pinboard-box .pinboard-subj:hover {text-decoration:underline}
.pinboard-box .pinboard-subj strong {font-weight:normal}
.pinboard-box .pinboard-subj.pinboard-subj-margin {margin-left:60px}
.pinboard-box .pinboard-subj .pinboard-type {color:#b5b5b5;margin-right:3px;letter-spacing:-1px}
.pinboard-box .pinboard-subj .pinboard-comment {display:inline-block;white-space:nowrap;vertical-align:baseline;text-align:center;min-width:35px;padding:1px;font-size:10px;line-height:1;color:#fff;background-color:#757575;margin-right:5px}
.pinboard-box .pinboard-info {position:absolute;top:5px;right:0;font-size:12px;height:46px;line-height:46px;padding-left:15px;background:#fff}
.pinboard-box .pinboard-info .pinboard-pin {position:relative;float:left;width:80px;padding-right:10px}
.pinboard-box .pinboard-info .star-ratings-list {width:70px;margin:0 auto}
.pinboard-box .pinboard-info .star-ratings-list li {padding:0;float:left;margin-right:0}
.pinboard-box .pinboard-info .star-ratings-list li .rating {color:#a5a5a5;font-size:10px;line-height:normal}
.pinboard-box .pinboard-info .star-ratings-list li .rating-selected {color:#FF4848;font-size:10px}
.pinboard-box .pinboard-info .pinboard-marker {position:relative;float:left;width:100px;padding-right:10px}
.pinboard-box .pinboard-info .pinboard-member {position:relative;float:left;width:100px;padding-right:10px}
.pinboard-box .pinboard-info .pinboard-member .pinboard-photo {position:absolute;top:12px;left:0;overflow:hidden;width:20px;height:20px;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.pinboard-box .pinboard-info .pinboard-member .pinboard-photo img {display:block;width:100% \9;max-width:100%;height:auto}
.pinboard-box .pinboard-info .pinboard-member .pinboard-nick {display:inline-block;margin-left:25px}
.pinboard-box .pinboard-info .pinboard-member .pinboard-nick .sv_wrap > a {display:block;overflow:hidden;white-space:nowrap;word-wrap:normal;text-overflow:ellipsis;color:#252525;width:65px}
.pinboard-box .pinboard-info .pinboard-member .pinboard-nick .sv_wrap > .dropdown-menu {margin-top:-10px}
.pinboard-box .pinboard-info .pinboard-date {position:relative;float:left;width:100px;padding-right:10px;color:#959595}
.pinboard-box .pinboard-info .pinboard-hit {position:relative;float:left;width:60px;text-align:center;color:#959595}
.pinboard-box:nth-child(odd) .pinboard-list {background:#fcfcfc}
.pinboard-box:nth-child(odd) .pinboard-info {background:#fcfcfc}
.my-pinboard .view-infinite-more .btn-e-xlg {position:relative;height:40px;line-height:40px;padding:0 100px;font-size:16px !important;border:1px solid #b5b5b5;background:#fff;color:#757575}
.my-pinboard .view-infinite-more .btn-e-xlg i {position:absolute;top:5px;right:5px;font-size:30px;color:#fff;transition:all 0.2s ease-in-out}
.my-pinboard .view-infinite-more .btn-e-xlg:hover {border:1px solid #959595;background:#f5f5f5;color:#000}
.my-pinboard .view-infinite-more .btn-e-xlg:hover i {color:#b5b5b5}
#infscr-loading {text-align:center;z-index:100;position:absolute;left:50%;bottom:0;width:200px;margin-left:-100px;padding:8px 0;background:#000;opacity:0.8;color:#fff}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width: 767px) {
    .pinboard-head .pinboard-head-subj {text-align:center;padding-right:0}
    .pinboard-head .pinboard-head-info {display:none}
    .pinboard-box .pinboard-subj {line-height:30px}
    .pinboard-box .pinboard-subj strong {font-weight:bold}
    .pinboard-box .pinboard-info {top:inherit;right:inherit;bottom:5px;left:0;padding-left:0;height:23px;line-height:23px;background:transparent}
    .pinboard-box .pinboard-info.pinboard-info-margin {left:60px}
    .pinboard-box .pinboard-info .pinboard-pin, .pinboard-box .pinboard-info .pinboard-marker, .pinboard-box .pinboard-info .pinboard-member, .pinboard-box .pinboard-info .pinboard-date, .pinboard-box .pinboard-info .pinboard-hit {width:auto}
    .pinboard-box .pinboard-info .pinboard-marker {color:#959595}
    .pinboard-box .pinboard-info .pinboard-member .pinboard-photo {display:none}
    .pinboard-box .pinboard-info .pinboard-member .pinboard-nick {margin-left:0}
    .pinboard-box .pinboard-info .pinboard-member .pinboard-nick .sv_wrap > a {display:inherit;overflow:inherit;white-space:inherit;word-wrap:inherit;text-overflow:inherit;color:#252525;width:auto}
    .pinboard-box .pinboard-info .pinboard-member .pinboard-nick .sv_wrap > .dropdown-menu {margin-top:5px}
}
<?php } ?>
@media (min-width: 768px) {
    .my-pinboard-modal {width:720px;margin:10px auto}
    .my-pinboard-modal .modal-header, .my-pinboard-modal .modal-body, .my-pinboard-modal .modal-footer {padding:10px 20px}
}
@media (min-width: 992px) {
    .my-pinboard-modal {width:940px}
}
@media (min-width: 1200px) {
    .my-pinboard-modal {width:1140px}
}
</style>

<div class="my-pinboard">
    <div class="headline-short">
        <h4><strong>핀보드</strong></h4>
    </div>
    <blockquote class="hero pinboard-hero">
        <p><i class="fas fa-exclamation-circle"></i> 내가 저장한 핀들을 모아서 봅니다.</p>
    </blockquote>
    <?php if (isset($list) && is_array($list)) { ?>
    <div class="infinite-container">
        <div class="pinboard-head">
            <div class="pinboard-head-subj">제목 / 이미지</div>
            <div class="pinboard-head-info">
                <div class="pinboard-head-pin">핀설정</div>
                <div class="pinboard-head-marker">게시판</div>
                <div class="pinboard-head-member">글쓴이</div>
                <div class="pinboard-head-date">날짜</div>
                <div class="pinboard-head-hit">뷰</div>
            </div>
        </div>
        <?php foreach ($list as $key => $li) { ?>
        <article class="pinboard-box" id="pinboard-box-<?php echo $key; ?>">
            <div class="pinboard-list">
                <a href="<?php echo $li['href']; ?>" <?php if ($li['secret']) { ?>onclick="return false;"<?php } else if (!G5_IS_MOBILE) { ?>onclick="pinboard_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                    <?php if ($li['wr_image']) { ?>
                    <div class="pinboard-img-box">
                        <div class="pinboard-img">
                            <img src="<?php echo $li['wr_image']; ?>" class="img-responsive" alt="">
                        </div>
                    </div>
                    <?php } ?>
                    <h5 class="pinboard-subj ellipsis <?php if ($li['wr_image']) { ?>pinboard-subj-margin<?php } ?>">
                        <?php if ($li['wr_comment']) { ?>
                        <span class="pinboard-comment">+<?php echo number_format($li['wr_comment']); ?></span>
                        <?php } ?>
                        <strong><?php echo get_text($li['wr_subject']); ?></strong>
                    </h5>
                </a>
                <div class="pinboard-info <?php if ($li['wr_image']) { ?>pinboard-info-margin<?php } ?>">
                    <div class="pinboard-pin">
                        <a href="javascript:;" onclick="pin_cancel('<?php echo $li['bo_table']?>', '<?php echo $li['wr_id']?>', '<?php echo $key; ?>'); return false;" class="btn-e btn-e-xs btn-e-dark"><i class="fas fa-times"></i> 핀 해제</a>
                    </div>
                    <div class="pinboard-marker ellipsis hidden-xs">
                        <?php echo $li['bo_info']['bo_name']; ?>
                    </div>
                    <div class="pinboard-member">
                        <div class="pinboard-photo">
                            <?php if ($li['mb_photo']) { echo $li['mb_photo']; } else { ?><img src="<?php echo $eyoom_skin_url['mypage']; ?>/img/user.jpg" alt="회원사진"><?php } ?>
                        </div>
                        <div class="pinboard-nick"><?php echo eb_nameview($li['mb_id'], $li['wr_name'], $li['wr_email']); ?></div>
                    </div>
                    <div class="pinboard-date">
                        <i class="far fa-clock margin-right-5"></i><?php echo $eb->date_time('Y-m-d',$li['datetime']); ?>
                    </div>
                    <div class="pinboard-hit ellipsis hidden-xs">
                        <i class="fas fa-eye margin-right-5 hidden-lg hidden-md hidden-sm"></i><?php echo $li['wr_hit']; ?>
                    </div>
                </div>
            </div>
        </article>
        <?php } ?>
    </div>
    <div id="infinite_pagination">
        <a class="next" href="<?php echo G5_URL; ?>/mypage/?t=pinboard&page=<?php echo ($page+1); ?>"></a>
    </div>
    <div class="view-infinite-more text-center margin-top-40 margin-bottom-20">
        <a id="my-pinboard-more" href="#" class="btn btn-default btn-e-xlg">더 보기<i class="far fa-arrow-alt-circle-down"></i></a>
    </div>
    <?php } else { ?>
    <div class="text-center margin-top-30 margin-bottom-30 color-grey font-size-13">
        <i class="fa fa-exclamation-circle"></i> 별점 평가한 게시물이 없습니다.
    </div>
    <?php } ?>
</div>

<?php /* 관심게시판 상세보기 모달 시작 */ ?>
<div class="modal fade pinboard-iframe-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog my-pinboard-modal">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <div class="modal-body">
                <iframe id="pinboard-iframe" width="100%" frameborder="0"></iframe>
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
function pinboard_modal(href) {
    $('.pinboard-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#pinboard-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.pinboard-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#pinboard-iframe").attr("src", href);
        $('#pinboard-iframe').height(parseInt($(window).height() * 0.85));
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

$(function(){
    var $container = $('.infinite-container');
    $container.infinitescroll({
        navSelector  : "#infinite_pagination",
        nextSelector : "#infinite_pagination .next",
        itemSelector : ".pinboard-box",
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
    $('#my-pinboard-more').click(function(){
        $container.infinitescroll('retrieve');
        $('#infinite_pagination').show();
        return false;
    });
});

function pin_cancel(bo_table, wr_id, key) {
    $.post(
        '<?php echo EYOOM_CORE_URL; ?>/board/pin_process.php',
        { bo_table: bo_table, wr_id: wr_id, action: 'cancel' },
        function(data) {
            if (!data.error) {
                swal({
                    title: "알림!",
                    text: '정상적으로 핀을 해제하였습니다.',
                    confirmButtonColor: "#FDAB29",
                    type: "warning",
                    confirmButtonText: "확인"
                });
                $("#pinboard-box-"+key).hide();
            }
        }, "json"
    );
}
</script>