<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/subscribe.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.my-subscribe .subscribe-hero {position:relative;padding:10px 15px 9px}
.my-subscribe .subscribe-hero p {margin:0;font-size:12px;color:#757575}
.my-subscribe .subscribe-select-left {position:absolute;top:4px;right:139px;width:130px}
.my-subscribe .subscribe-select-right {position:absolute;top:4px;right:4px;width:130px}
.subscribe-head {position:relative;border-top:2px solid #757575;border-bottom:1px solid #959595;padding:12px 0;background:#fafafa;font-weight:bold}
.subscribe-head .subscribe-head-subj {text-align:center;padding-right:375px}
.subscribe-head .subscribe-head-info {position:absolute;top:12px;right:0}
.subscribe-head .subscribe-head-marker, .subscribe-head .subscribe-head-member, .subscribe-head .subscribe-head-date {position:relative;float:left;width:100px;padding-right:10px}
.subscribe-head .subscribe-head-hit {position:relative;float:left;width:60px;text-align:center}
.my-subscribe .infinite-container {position:relative;border-bottom:1px solid #eaeaea}
.subscribe-box {position:relative;border-top:1px solid #eaeaea;background:#fff}
.subscribe-box .subscribe-list {position:relative;height:56px}
.subscribe-box .subscribe-img-box {position:absolute;top:5px;left:0;width:46px;height:46px;overflow:hidden}
.subscribe-box .subscribe-img {position:relative;overflow:hidden;width:106px;margin-left:-30px;margin-top:-10px}
.subscribe-box .subscribe-subj {margin:0;line-height:56px;font-size:12px}
.subscribe-box .subscribe-subj:hover {color:#FF4848;text-decoration:underline}
.subscribe-box .subscribe-subj strong {font-weight:normal}
.subscribe-box .subscribe-subj.subscribe-subj-margin {margin-left:60px}
.subscribe-box .subscribe-subj .subscribe-type {color:#b5b5b5;margin-right:3px;letter-spacing:-1px}
.subscribe-box .subscribe-subj .subscribe-comment {display:inline-block;white-space:nowrap;vertical-align:baseline;text-align:center;min-width:35px;padding:1px;font-size:10px;line-height:1;color:#fff;background-color:#757575;margin-right:5px}
.subscribe-box .subscribe-info {position:absolute;top:5px;right:0;font-size:12px;height:46px;line-height:46px;padding-left:15px;background:#fff}
.subscribe-box .subscribe-info .subscribe-marker {position:relative;float:left;width:100px;padding-right:10px}
.subscribe-box .subscribe-info .subscribe-member {position:relative;float:left;width:100px;padding-right:10px}
.subscribe-box .subscribe-info .subscribe-member .subscribe-photo {position:absolute;top:12px;left:0;overflow:hidden;width:20px;height:20px;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.subscribe-box .subscribe-info .subscribe-member .subscribe-photo img {display:block;width:100% \9;max-width:100%;height:auto}
.subscribe-box .subscribe-info .subscribe-member .subscribe-nick {display:inline-block;margin-left:25px}
.subscribe-box .subscribe-info .subscribe-member .subscribe-nick .sv_wrap > a {display:block;overflow:hidden;white-space:nowrap;word-wrap:normal;text-overflow:ellipsis;color:#252525;width:65px}
.subscribe-box .subscribe-info .subscribe-member .subscribe-nick .sv_wrap > .dropdown-menu {margin-top:-10px}
.subscribe-box .subscribe-info .subscribe-date {position:relative;float:left;width:100px;padding-right:10px;color:#959595}
.subscribe-box .subscribe-info .subscribe-hit {position:relative;float:left;width:60px;text-align:center;color:#959595}
.subscribe-box:nth-child(odd) .subscribe-list {background:#fcfcfc}
.subscribe-box:nth-child(odd) .subscribe-info {background:#fcfcfc}
.my-subscribe .view-infinite-more .btn-e-xlg {position:relative;height:40px;line-height:40px;padding:0 100px;font-size:16px !important;border:1px solid #b5b5b5;background:#fff;color:#757575}
.my-subscribe .view-infinite-more .btn-e-xlg i {position:absolute;top:5px;right:5px;font-size:30px;color:#fff;transition:all 0.2s ease-in-out}
.my-subscribe .view-infinite-more .btn-e-xlg:hover {border:1px solid #959595;background:#f5f5f5;color:#000}
.my-subscribe .view-infinite-more .btn-e-xlg:hover i {color:#b5b5b5}
#infscr-loading {text-align:center;z-index:100;position:absolute;left:50%;bottom:0;width:200px;margin-left:-100px;padding:8px 0;background:#000;opacity:0.8;color:#fff}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width: 767px) {
    .my-subscribe .subscribe-select-left {position:absolute;top:-50px;right:115px;width:110px}
    .my-subscribe .subscribe-select-right {position:absolute;top:-50px;right:0;width:110px}
    .subscribe-head .subscribe-head-subj {text-align:center;padding-right:0}
    .subscribe-head .subscribe-head-info {display:none}
    .subscribe-box .subscribe-subj {line-height:30px}
    .subscribe-box .subscribe-subj strong {font-weight:bold}
    .subscribe-box .subscribe-info {top:inherit;right:inherit;bottom:5px;left:0;padding-left:0;height:23px;line-height:23px;background:transparent}
    .subscribe-box .subscribe-info.subscribe-info-margin {left:60px}
    .subscribe-box .subscribe-info .subscribe-marker, .subscribe-box .subscribe-info .subscribe-member, .subscribe-box .subscribe-info .subscribe-date, .subscribe-box .subscribe-info .subscribe-hit {width:auto}
    .subscribe-box .subscribe-info .subscribe-marker {color:#959595}
    .subscribe-box .subscribe-info .subscribe-member .subscribe-photo {display:none}
    .subscribe-box .subscribe-info .subscribe-member .subscribe-nick {margin-left:0}
    .subscribe-box .subscribe-info .subscribe-member .subscribe-nick .sv_wrap > a {display:inherit;overflow:inherit;white-space:inherit;word-wrap:inherit;text-overflow:inherit;color:#252525;width:auto}
    .subscribe-box .subscribe-info .subscribe-member .subscribe-nick .sv_wrap > .dropdown-menu {margin-top:5px}
}
<?php } ?>
@media (min-width: 768px) {
    .my-subscribe-modal {width:720px;margin:10px auto}
    .my-subscribe-modal .modal-header, .my-subscribe-modal .modal-body, .my-subscribe-modal .modal-footer {padding:10px 20px}
}
@media (min-width: 992px) {
    .my-subscribe-modal {width:940px}
}
@media (min-width: 1200px) {
    .my-subscribe-modal {width:1140px}
}
</style>

<div class="my-subscribe">
    <div class="headline-short">
        <h4><strong>구독글</strong></h4>
    </div>
    <blockquote class="hero subscribe-hero">
        <p><i class="fas fa-exclamation-circle"></i> 내가 구독 신청한 회원들의 글을 모아 봅니다.</p>
        <form name="fmypage" method="get" class="eyoom-form">
        <input type="hidden" name="t" value="subscribe">
            <?php if (is_array($my_subscribe)) { ?>
            <div class="subscribe-select-left">
                <label class="select">
                    <select name="mbid" onchange="this.form.submit();">
                        <option value=''>구독회원 선택</option>
                        <?php foreach ($my_subscribe as $k => $sb_member) { ?>
                        <option value="<?php echo $sb_member['mb_id']; ?>" <?php echo $sb_member['mb_id'] == $_GET['mbid'] ? 'selected': ''; ?>><?php echo $sb_member['mb_nick']; ?></option>
                        <?php } ?>
                    </select><i></i>
                </label>
            </div>
            <?php } ?>
            <?php if (is_array($board_info)) { ?>
            <div class="subscribe-select-right">
                <label class="select">
                    <select name="bo_table" onchange="this.form.submit();">
                        <option value=''>게시판 선택</option>
                        <?php foreach ($board_info as $_bo_table => $bo_info) { ?>
                        <option value="<?php echo $_bo_table; ?>" <?php echo $_bo_table == $_GET['bo_table'] ? 'selected': ''; ?>><?php echo $bo_info['bo_name']; ?></option>
                        <?php } ?>
                    </select><i></i>
                </label>
            </div>
            <?php } ?>
        </form>
    </blockquote>
    <?php if (isset($list) && is_array($list)) { ?>
    <div class="infinite-container">
        <div class="subscribe-head">
            <div class="subscribe-head-subj">제목 / 이미지</div>
            <div class="subscribe-head-info">
                <div class="subscribe-head-marker">게시판</div>
                <div class="subscribe-head-member">글쓴이</div>
                <div class="subscribe-head-date">날짜</div>
                <div class="subscribe-head-hit">뷰</div>
            </div>
        </div>
        <?php foreach ($list as $key => $li) { ?>
        <article class="subscribe-box">
            <?php if ($li['wr_id'] == $li['wr_parent']) { ?>
            <div class="subscribe-list">
                <a href="<?php echo $li['href']; ?>" <?php if ($li['secret']) { ?>onclick="return false;"<?php } else if (!G5_IS_MOBILE) { ?>onclick="subscribe_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                    <?php if ($li['wr_image']) { ?>
                    <div class="subscribe-img-box">
                        <div class="subscribe-img">
                            <img src="<?php echo $li['wr_image']; ?>" class="img-responsive" alt="">
                        </div>
                    </div>
                    <?php } ?>
                    <h5 class="subscribe-subj ellipsis <?php if ($li['wr_image']) { ?>subscribe-subj-margin<?php } ?>">
                        <?php if ($li['wr_comment']) { ?>
                        <span class="subscribe-comment">+<?php echo number_format($li['wr_comment']); ?></span>
                        <?php } ?>
                        <strong><?php echo get_text($li['wr_subject']); ?></strong>
                    </h5>
                </a>
                <div class="subscribe-info <?php if ($li['wr_image']) { ?>subscribe-info-margin<?php } ?>">
                    <div class="subscribe-marker ellipsis">
                        <?php echo $li['bo_info']['bo_name']; ?>
                    </div>
                    <div class="subscribe-member">
                        <div class="subscribe-photo">
                            <?php if ($li['mb_photo']) { echo $li['mb_photo']; } else { ?><img src="<?php echo $eyoom_skin_url['mypage']; ?>/img/user.jpg" alt="회원사진"><?php } ?>
                        </div>
                        <div class="subscribe-nick"><?php echo eb_nameview($li['mb_id'], $li['wr_name'], $li['wr_email']); ?></div>
                    </div>
                    <div class="subscribe-date">
                        <i class="far fa-clock margin-right-5"></i><?php echo $eb->date_time('Y-m-d',$li['datetime']); ?>
                    </div>
                    <div class="subscribe-hit ellipsis hidden-xs">
                        <i class="fas fa-eye margin-right-5 hidden-lg hidden-md hidden-sm"></i><?php echo $li['wr_hit']; ?>
                    </div>
                </div>
            </div>
            <?php } else { ?>
            <div class="subscribe-list">
                <a href="<?php echo $li['href']; ?>" <?php if ($li['secret']) { ?>onclick="return false;"<?php } else if (!G5_IS_MOBILE) { ?>onclick="subscribe_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                    <h5 class="subscribe-subj ellipsis">
                        <span class="subscribe-type">[ 댓글 ]</span>
                        <?php echo conv_subject($li['wr_content'],100,'…'); ?>
                    </h5>
                </a>
                <div class="subscribe-info">
                    <div class="subscribe-marker ellipsis">
                        <?php echo $li['bo_info']['bo_name']; ?>
                    </div>
                    <div class="subscribe-member">
                        <div class="subscribe-photo">
                            <?php if ($li['mb_photo']) { echo $li['mb_photo']; } else { ?><img src="<?php echo $eyoom_skin_url['mypage']; ?>/img/user.jpg" alt="회원사진"><?php } ?>
                        </div>
                        <div class="subscribe-nick"><?php echo eb_nameview($li['mb_id'], $li['wr_name'], $li['wr_email']); ?></div>
                    </div>
                    <div class="subscribe-date">
                        <i class="far fa-clock margin-right-5"></i><?php echo $eb->date_time('Y-m-d',$li['datetime']); ?>
                    </div>
                    <div class="subscribe-hit ellipsis hidden-xs">
                        -
                    </div>
                </div>
            </div>
            <?php } ?>
        </article>
        <?php } ?>
    </div>
    <div id="infinite_pagination">
        <a class="next" href="<?php echo G5_URL; ?>/mypage/?t=subscribe<?php echo $qstr;?>&amp;page=<?php echo ($page+1); ?>"></a>
    </div>
    <div class="view-infinite-more text-center margin-top-40 margin-bottom-20">
        <a id="my-subscribe-more" href="#" class="btn btn-default btn-e-xlg">더 보기<i class="far fa-arrow-alt-circle-down"></i></a>
    </div>
    <?php } else { ?>
    <div class="text-center margin-top-30 margin-bottom-30 color-grey font-size-13">
        <i class="fa fa-exclamation-circle"></i> 구독한 글이 없습니다.
    </div>
    <?php } ?>
</div>

<?php /* 관심게시판 상세보기 모달 시작 */ ?>
<div class="modal fade subscribe-iframe-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog my-subscribe-modal">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <div class="modal-body">
                <iframe id="subscribe-iframe" width="100%" frameborder="0"></iframe>
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
function subscribe_modal(href) {
    $('.subscribe-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#subscribe-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.subscribe-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#subscribe-iframe").attr("src", href);
        $('#subscribe-iframe').height(parseInt($(window).height() * 0.85));
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

$(function(){
    var $container = $('.infinite-container');
    $container.infinitescroll({
        navSelector  : "#infinite_pagination",
        nextSelector : "#infinite_pagination .next",
        itemSelector : ".subscribe-box",
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
    $('#my-subscribe-more').click(function(){
        $container.infinitescroll('retrieve');
        $('#infinite_pagination').show();
        return false;
    });
});
</script>