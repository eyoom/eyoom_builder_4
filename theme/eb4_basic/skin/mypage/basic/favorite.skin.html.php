<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/favorite.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.my-favorite .favorite-hero {position:relative;padding:10px 15px 9px}
.my-favorite .favorite-hero p {margin:0;font-size:12px;color:#757575}
.my-favorite .favorite-select {position:absolute;top:4px;right:4px;width:150px}
.favorite-head {position:relative;border-top:2px solid #757575;border-bottom:1px solid #959595;padding:12px 0;background:#fafafa;font-weight:bold}
.favorite-head .favorite-head-subj {text-align:center;padding-right:375px}
.favorite-head .favorite-head-info {position:absolute;top:12px;right:0}
.favorite-head .favorite-head-marker, .favorite-head .favorite-head-member, .favorite-head .favorite-head-date {position:relative;float:left;width:100px;padding-right:10px}
.favorite-head .favorite-head-hit {position:relative;float:left;width:60px;text-align:center}
.my-favorite .infinite-container {position:relative;border-bottom:1px solid #eaeaea}
.favorite-box {position:relative;border-top:1px solid #eaeaea;background:#fff}
.favorite-box .favorite-list {position:relative;height:56px}
.favorite-box .favorite-img-box {position:absolute;top:5px;left:0;width:46px;height:46px;overflow:hidden}
.favorite-box .favorite-img {position:relative;overflow:hidden;width:106px;margin-left:-30px;margin-top:-10px}
.favorite-box .favorite-subj {margin:0;line-height:56px;font-size:12px}
.favorite-box .favorite-subj:hover {text-decoration:underline}
.favorite-box .favorite-subj strong {font-weight:normal}
.favorite-box .favorite-subj.favorite-subj-margin {margin-left:60px}
.favorite-box .favorite-subj .favorite-type {color:#b5b5b5;margin-right:3px;letter-spacing:-1px}
.favorite-box .favorite-subj .favorite-comment {display:inline-block;white-space:nowrap;vertical-align:baseline;text-align:center;min-width:35px;padding:1px;font-size:10px;line-height:1;color:#fff;background-color:#757575;margin-right:5px}
.favorite-box .favorite-info {position:absolute;top:5px;right:0;font-size:12px;height:46px;line-height:46px;padding-left:15px;background:#fff}
.favorite-box .favorite-info .favorite-marker {position:relative;float:left;width:100px;padding-right:10px}
.favorite-box .favorite-info .favorite-member {position:relative;float:left;width:100px;padding-right:10px}
.favorite-box .favorite-info .favorite-member .favorite-photo {position:absolute;top:12px;left:0;overflow:hidden;width:20px;height:20px;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.favorite-box .favorite-info .favorite-member .favorite-photo img {display:block;width:100% \9;max-width:100%;height:auto}
.favorite-box .favorite-info .favorite-member .favorite-nick {display:inline-block;margin-left:25px}
.favorite-box .favorite-info .favorite-member .favorite-nick .sv_wrap > a {display:block;overflow:hidden;white-space:nowrap;word-wrap:normal;text-overflow:ellipsis;color:#252525;width:65px}
.favorite-box .favorite-info .favorite-member .favorite-nick .sv_wrap > .dropdown-menu {margin-top:-10px}
.favorite-box .favorite-info .favorite-date {position:relative;float:left;width:100px;padding-right:10px;color:#959595}
.favorite-box .favorite-info .favorite-hit {position:relative;float:left;width:60px;text-align:center;color:#959595}
.favorite-box:nth-child(odd) .favorite-list {background:#fcfcfc}
.favorite-box:nth-child(odd) .favorite-info {background:#fcfcfc}
.my-favorite .view-infinite-more .btn-e-xlg {position:relative;height:40px;line-height:40px;padding:0 100px;font-size:16px !important;border:1px solid #b5b5b5;background:#fff;color:#757575}
.my-favorite .view-infinite-more .btn-e-xlg i {position:absolute;top:5px;right:5px;font-size:30px;color:#fff;transition:all 0.2s ease-in-out}
.my-favorite .view-infinite-more .btn-e-xlg:hover {border:1px solid #959595;background:#f5f5f5;color:#000}
.my-favorite .view-infinite-more .btn-e-xlg:hover i {color:#b5b5b5}
#infscr-loading {text-align:center;z-index:100;position:absolute;left:50%;bottom:0;width:200px;margin-left:-100px;padding:8px 0;background:#000;opacity:0.8;color:#fff}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width: 767px) {
    .my-favorite .favorite-select {top:-50px;right:0}
    .favorite-head .favorite-head-subj {text-align:center;padding-right:0}
    .favorite-head .favorite-head-info {display:none}
    .favorite-box .favorite-subj {line-height:30px}
    .favorite-box .favorite-subj strong {font-weight:bold}
    .favorite-box .favorite-info {top:inherit;right:inherit;bottom:5px;left:0;padding-left:0;height:23px;line-height:23px;background:transparent}
    .favorite-box .favorite-info.favorite-info-margin {left:60px}
    .favorite-box .favorite-info .favorite-marker, .favorite-box .favorite-info .favorite-member, .favorite-box .favorite-info .favorite-date, .favorite-box .favorite-info .favorite-hit {width:auto}
    .favorite-box .favorite-info .favorite-marker {color:#000}
    .favorite-box .favorite-info .favorite-member .favorite-photo {display:none}
    .favorite-box .favorite-info .favorite-member .favorite-nick {margin-left:0}
    .favorite-box .favorite-info .favorite-member .favorite-nick .sv_wrap > a {display:inherit;overflow:inherit;white-space:inherit;word-wrap:inherit;text-overflow:inherit;color:#252525;width:auto}
    .favorite-box .favorite-info .favorite-member .favorite-nick .sv_wrap > .dropdown-menu {margin-top:5px}
}
<?php } ?>
@media (min-width: 768px) {
    .my-favorite-modal {width:720px;margin:10px auto}
    .my-favorite-modal .modal-header, .my-favorite-modal .modal-body, .my-favorite-modal .modal-footer {padding:10px 20px}
}
@media (min-width: 992px) {
    .my-favorite-modal {width:940px}
}
@media (min-width: 1200px) {
    .my-favorite-modal {width:1140px}
}
</style>

<div class="my-favorite">
    <div class="headline-short">
        <h4><strong>관심게시판</strong></h4>
    </div>
    <blockquote class="hero favorite-hero">
        <p><i class="fas fa-exclamation-circle"></i> 관심게시판으로 설정한 게시판의 모든 글들을 모아 봅니다.</p>
        <form name="fmypage" method="get" class="eyoom-form">
        <input type="hidden" name="t" value="favorite">
        <?php if (is_array($bo_possible)) { ?>
        <div class="favorite-select">
            <label class="select">
                <select name="bo_table" onchange="this.form.submit();">
                    <option value=''>관심게시판 전체</option>
                    <?php foreach ($bo_possible as $_bo_table => $bo_info) { ?>
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
        <div class="favorite-head">
            <div class="favorite-head-subj">제목 / 이미지</div>
            <div class="favorite-head-info">
                <div class="favorite-head-marker">게시판</div>
                <div class="favorite-head-member">글쓴이</div>
                <div class="favorite-head-date">날짜</div>
                <div class="favorite-head-hit">뷰</div>
            </div>
        </div>
        <?php foreach ($list as $key => $li) { ?>
        <article class="favorite-box">
            <?php if ($li['wr_id'] == $li['wr_parent']) { ?>
            <div class="favorite-list">
                <a href="<?php echo $li['href']; ?>" <?php if ($li['secret']) { ?>onclick="return false;"<?php } else if (!G5_IS_MOBILE) { ?>onclick="favorite_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                    <?php if ($li['wr_image']) { ?>
                    <div class="favorite-img-box">
                        <div class="favorite-img">
                            <img src="<?php echo $li['wr_image']; ?>" class="img-responsive" alt="">
                        </div>
                    </div>
                    <?php } ?>
                    <h5 class="favorite-subj ellipsis <?php if ($li['wr_image']) { ?>favorite-subj-margin<?php } ?>">
                        <?php if ($li['wr_comment']) { ?>
                        <span class="favorite-comment">+<?php echo number_format($li['wr_comment']); ?></span>
                        <?php } ?>
                        <strong><?php echo get_text($li['wr_subject']); ?></strong>
                    </h5>
                </a>
                <div class="favorite-info <?php if ($li['wr_image']) { ?>favorite-info-margin<?php } ?>">
                    <div class="favorite-marker ellipsis">
                        <?php echo $li['bo_info']['bo_name']; ?>
                    </div>
                    <div class="favorite-member">
                        <div class="favorite-photo">
                            <?php if ($li['mb_photo']) { echo $li['mb_photo']; } else { ?><img src="<?php echo $eyoom_skin_url['mypage']; ?>/img/user.jpg" alt="회원사진"><?php } ?>
                        </div>
                        <div class="favorite-nick"><?php echo eb_nameview($li['mb_id'], $li['wr_name'], $li['wr_email']); ?></div>
                    </div>
                    <div class="favorite-date">
                        <i class="far fa-clock margin-right-5"></i><?php echo $eb->date_time('Y-m-d',$li['datetime']); ?>
                    </div>
                    <div class="favorite-hit ellipsis hidden-xs">
                        <i class="fas fa-eye margin-right-5 hidden-lg hidden-md hidden-sm"></i><?php echo $li['wr_hit']; ?>
                    </div>
                </div>
            </div>
            <?php } else { ?>
            <div class="favorite-list">
                <a href="<?php echo $li['href']; ?>" <?php if ($li['secret']) { ?>onclick="return false;"<?php } else if (!G5_IS_MOBILE) { ?>onclick="favorite_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                    <h5 class="favorite-subj ellipsis">
                        <span class="favorite-type">[ 댓글 ]</span>
                        <?php echo conv_subject($li['wr_content'],100,'…'); ?>
                    </h5>
                </a>
                <div class="favorite-info">
                    <div class="favorite-marker ellipsis">
                        <?php echo $li['bo_info']['bo_name']; ?>
                    </div>
                    <div class="favorite-member">
                        <div class="favorite-photo">
                            <?php if ($li['mb_photo']) { echo $li['mb_photo']; } else { ?><img src="<?php echo $eyoom_skin_url['mypage']; ?>/img/user.jpg" alt="회원사진"><?php } ?>
                        </div>
                        <div class="favorite-nick"><?php echo eb_nameview($li['mb_id'], $li['wr_name'], $li['wr_email']); ?></div>
                    </div>
                    <div class="favorite-date">
                        <i class="far fa-clock margin-right-5"></i><?php echo $eb->date_time('Y-m-d',$li['datetime']); ?>
                    </div>
                    <div class="favorite-hit ellipsis hidden-xs">
                        -
                    </div>
                </div>
            </div>
            <?php } ?>
        </article>
        <?php } ?>
    </div>
    <div id="infinite_pagination">
        <a class="next" href="<?php echo G5_URL; ?>/mypage/?t=favorite<?php echo $qstr;?>&amp;page=<?php echo ($page+1); ?>"></a>
    </div>
    <div class="view-infinite-more text-center margin-top-40 margin-bottom-20">
        <a id="my-favorite-more" href="#" class="btn btn-default btn-e-xlg">더 보기<i class="far fa-arrow-alt-circle-down"></i></a>
    </div>
    <?php } else { ?>
    <div class="text-center margin-top-30 margin-bottom-30 color-grey font-size-13">
        <i class="fa fa-exclamation-circle"></i> 관심게시판에 등록된 글이 없습니다.<br><a href="<?php echo G5_URL; ?>/mypage/config.php#favorite">[환경설정]</a>에서 관심게시판을 설정하였는지 체크해 보세요.
    </div>
    <?php } ?>
</div>

<?php /* 관심게시판 상세보기 모달 시작 */ ?>
<div class="modal fade favorite-iframe-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog my-favorite-modal">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <div class="modal-body">
                <iframe id="favorite-iframe" width="100%" frameborder="0"></iframe>
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
function favorite_modal(href) {
    $('.favorite-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#favorite-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.favorite-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#favorite-iframe").attr("src", href);
        $('#favorite-iframe').height(parseInt($(window).height() * 0.85));
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

$(function(){
    var $container = $('.infinite-container');
    $container.infinitescroll({
        navSelector  : "#infinite_pagination",
        nextSelector : "#infinite_pagination .next",
        itemSelector : ".favorite-box",
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
    $('#my-favorite-more').click(function(){
        $container.infinitescroll('retrieve');
        $('#infinite_pagination').show();
        return false;
    });
});
</script>