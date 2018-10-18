<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/followinggul.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.my-followinggul .favorite-hero {position:relative;padding:10px 15px 9px}
.my-followinggul .favorite-hero p {margin:0;font-size:12px;color:#757575}
.my-followinggul .favorite-select-left {position:absolute;top:4px;right:139px;width:130px}
.my-followinggul .favorite-select-right {position:absolute;top:4px;right:4px;width:130px}
.followinggul-head {position:relative;border-top:2px solid #757575;border-bottom:1px solid #959595;padding:12px 0;background:#fafafa;font-weight:bold}
.followinggul-head .followinggul-head-subj {text-align:center;padding-right:375px}
.followinggul-head .followinggul-head-info {position:absolute;top:12px;right:0}
.followinggul-head .followinggul-head-marker, .followinggul-head .followinggul-head-member, .followinggul-head .followinggul-head-date {position:relative;float:left;width:100px;padding-right:10px}
.followinggul-head .followinggul-head-hit {position:relative;float:left;width:60px;text-align:center}
.my-followinggul .infinite-container {position:relative;border-bottom:1px solid #eaeaea}
.followinggul-box {position:relative;border-top:1px solid #eaeaea;background:#fff}
.followinggul-box .followinggul-list {position:relative;height:56px}
.followinggul-box .followinggul-img-box {position:absolute;top:5px;left:0;width:46px;height:46px;overflow:hidden}
.followinggul-box .followinggul-img {position:relative;overflow:hidden;width:106px;margin-left:-30px;margin-top:-10px}
.followinggul-box .followinggul-subj {margin:0;line-height:56px;font-size:12px}
.followinggul-box .followinggul-subj:hover {text-decoration:underline}
.followinggul-box .followinggul-subj strong {font-weight:normal}
.followinggul-box .followinggul-subj.followinggul-subj-margin {margin-left:60px}
.followinggul-box .followinggul-subj .followinggul-type {color:#b5b5b5;margin-right:3px;letter-spacing:-1px}
.followinggul-box .followinggul-subj .followinggul-comment {display:inline-block;white-space:nowrap;vertical-align:baseline;text-align:center;min-width:35px;padding:1px;font-size:10px;line-height:1;color:#fff;background-color:#757575;margin-right:5px}
.followinggul-box .followinggul-info {position:absolute;top:5px;right:0;font-size:12px;height:46px;line-height:46px;padding-left:15px;background:#fff}
.followinggul-box .followinggul-info .followinggul-marker {position:relative;float:left;width:100px;padding-right:10px}
.followinggul-box .followinggul-info .followinggul-member {position:relative;float:left;width:100px;padding-right:10px}
.followinggul-box .followinggul-info .followinggul-member .followinggul-photo {position:absolute;top:12px;left:0;overflow:hidden;width:20px;height:20px;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.followinggul-box .followinggul-info .followinggul-member .followinggul-photo img {display:block;width:100% \9;max-width:100%;height:auto}
.followinggul-box .followinggul-info .followinggul-member .followinggul-nick {display:inline-block;margin-left:25px}
.followinggul-box .followinggul-info .followinggul-member .followinggul-nick .sv_wrap > a {display:block;overflow:hidden;white-space:nowrap;word-wrap:normal;text-overflow:ellipsis;color:#252525;width:65px}
.followinggul-box .followinggul-info .followinggul-member .followinggul-nick .sv_wrap > .dropdown-menu {margin-top:-10px}
.followinggul-box .followinggul-info .followinggul-date {position:relative;float:left;width:100px;padding-right:10px;color:#959595}
.followinggul-box .followinggul-info .followinggul-hit {position:relative;float:left;width:60px;text-align:center;color:#959595}
.followinggul-box:nth-child(odd) .followinggul-list {background:#fcfcfc}
.followinggul-box:nth-child(odd) .followinggul-info {background:#fcfcfc}
.my-followinggul .view-infinite-more .btn-e-xlg {position:relative;height:40px;line-height:40px;padding:0 100px;font-size:16px !important;border:1px solid #b5b5b5;background:#fff;color:#757575}
.my-followinggul .view-infinite-more .btn-e-xlg i {position:absolute;top:5px;right:5px;font-size:30px;color:#fff;transition:all 0.2s ease-in-out}
.my-followinggul .view-infinite-more .btn-e-xlg:hover {border:1px solid #959595;background:#f5f5f5;color:#000}
.my-followinggul .view-infinite-more .btn-e-xlg:hover i {color:#b5b5b5}
#infscr-loading {text-align:center;z-index:100;position:absolute;left:50%;bottom:0;width:200px;margin-left:-100px;padding:8px 0;background:#000;opacity:0.8;color:#fff}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width: 767px) {
    .my-followinggul .favorite-select-left {position:absolute;top:-50px;right:115px;width:110px}
    .my-followinggul .favorite-select-right {position:absolute;top:-50px;right:0;width:110px}
    .followinggul-head .followinggul-head-subj {text-align:center;padding-right:0}
    .followinggul-head .followinggul-head-info {display:none}
    .followinggul-box .followinggul-subj {line-height:30px}
    .followinggul-box .followinggul-subj strong {font-weight:bold}
    .followinggul-box .followinggul-info {top:inherit;right:inherit;bottom:5px;left:0;padding-left:0;height:23px;line-height:23px;background:transparent}
    .followinggul-box .followinggul-info.followinggul-info-margin {left:60px}
    .followinggul-box .followinggul-info .followinggul-marker, .followinggul-box .followinggul-info .followinggul-member, .followinggul-box .followinggul-info .followinggul-date, .followinggul-box .followinggul-info .followinggul-hit {width:auto}
    .followinggul-box .followinggul-info .followinggul-marker {color:#959595}
    .followinggul-box .followinggul-info .followinggul-member .followinggul-photo {display:none}
    .followinggul-box .followinggul-info .followinggul-member .followinggul-nick {margin-left:0}
    .followinggul-box .followinggul-info .followinggul-member .followinggul-nick .sv_wrap > a {display:inherit;overflow:inherit;white-space:inherit;word-wrap:inherit;text-overflow:inherit;color:#252525;width:auto}
    .followinggul-box .followinggul-info .followinggul-member .followinggul-nick .sv_wrap > .dropdown-menu {margin-top:5px}
}
<?php } ?>
@media (min-width: 768px) {
    .my-followinggul-modal {width:720px;margin:10px auto}
    .my-followinggul-modal .modal-header, .my-followinggul-modal .modal-body, .my-followinggul-modal .modal-footer {padding:10px 20px}
}
@media (min-width: 992px) {
    .my-followinggul-modal {width:940px}
}
@media (min-width: 1200px) {
    .my-followinggul-modal {width:1140px}
}
</style>

<div class="my-followinggul">
    <div class="headline-short">
        <h4><strong>팔로윙글</strong></h4>
    </div>
    <blockquote class="hero favorite-hero">
        <p><i class="fas fa-exclamation-circle"></i> 내가 팔로우(친구맺기)한 회원들의 글을 모아 봅니다.</p>
        <form name="fmypage" method="get" class="eyoom-form">
        <input type="hidden" name="t" value="followinggul">
            <?php if (is_array($my_following)) { ?>
            <div class="favorite-select-left">
                <label class="select">
                    <select name="mbid" onchange="this.form.submit();">
                        <option value=''>팔로우 선택</option>
                        <?php foreach ($my_following as $k => $f_member) { ?>
                        <option value="<?php echo $f_member['mb_id']; ?>" <?php echo $f_member['mb_id'] == $_GET['mbid'] ? 'selected': ''; ?>><?php echo $f_member['mb_nick']; ?></option>
                        <?php } ?>
                    </select><i></i>
                </label>
            </div>
            <?php } ?>
            <?php if (is_array($board_info)) { ?>
            <div class="favorite-select-right">
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
    <?php if ($following && isset($list) && is_array($list)) { ?>
    <div class="infinite-container">
        <div class="followinggul-head">
            <div class="followinggul-head-subj">제목 / 이미지</div>
            <div class="followinggul-head-info">
                <div class="followinggul-head-marker">게시판</div>
                <div class="followinggul-head-member">글쓴이</div>
                <div class="followinggul-head-date">날짜</div>
                <div class="followinggul-head-hit">뷰</div>
            </div>
        </div>
        <?php foreach ($list as $key => $li) { ?>
        <article class="followinggul-box">
            <?php if ($li['wr_id'] == $li['wr_parent']) { ?>
            <div class="followinggul-list">
                <a href="<?php echo $li['href']; ?>" <?php if ($li['secret']) { ?>onclick="return false;"<?php } else if (!G5_IS_MOBILE) { ?>onclick="followinggul_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                    <?php if ($li['wr_image']) { ?>
                    <div class="followinggul-img-box">
                        <div class="followinggul-img">
                            <img src="<?php echo $li['wr_image']; ?>" class="img-responsive" alt="">
                        </div>
                    </div>
                    <?php } ?>
                    <h5 class="followinggul-subj ellipsis <?php if ($li['wr_image']) { ?>followinggul-subj-margin<?php } ?>">
                        <?php if ($li['wr_comment']) { ?>
                        <span class="followinggul-comment">+<?php echo number_format($li['wr_comment']); ?></span>
                        <?php } ?>
                        <strong><?php echo get_text($li['wr_subject']); ?></strong>
                    </h5>
                </a>
                <div class="followinggul-info <?php if ($li['wr_image']) { ?>followinggul-info-margin<?php } ?>">
                    <div class="followinggul-marker ellipsis">
                        <?php echo $li['bo_info']['bo_name']; ?>
                    </div>
                    <div class="followinggul-member">
                        <div class="followinggul-photo">
                            <?php if ($li['mb_photo']) { echo $li['mb_photo']; } else { ?><img src="<?php echo $eyoom_skin_url['mypage']; ?>/img/user.jpg" alt="회원사진"><?php } ?>
                        </div>
                        <div class="followinggul-nick"><?php echo eb_nameview($li['mb_id'], $li['wr_name'], $li['wr_email']); ?></div>
                    </div>
                    <div class="followinggul-date">
                        <i class="far fa-clock margin-right-5"></i><?php echo $eb->date_time('Y-m-d',$li['datetime']); ?>
                    </div>
                    <div class="followinggul-hit ellipsis hidden-xs">
                        <i class="fas fa-eye margin-right-5 hidden-lg hidden-md hidden-sm"></i><?php echo $li['wr_hit']; ?>
                    </div>
                </div>
            </div>
            <?php } else { ?>
            <div class="followinggul-list">
                <a href="<?php echo $li['href']; ?>" <?php if ($li['secret']) { ?>onclick="return false;"<?php } else if (!G5_IS_MOBILE) { ?>onclick="followinggul_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                    <h5 class="followinggul-subj ellipsis">
                        <span class="followinggul-type">[ 댓글 ]</span>
                        <?php echo conv_subject($li['wr_content'],100,'…'); ?>
                    </h5>
                </a>
                <div class="followinggul-info">
                    <div class="followinggul-marker ellipsis">
                        <?php echo $li['bo_info']['bo_name']; ?>
                    </div>
                    <div class="followinggul-member">
                        <div class="followinggul-photo">
                            <?php if ($li['mb_photo']) { echo $li['mb_photo']; } else { ?><img src="<?php echo $eyoom_skin_url['mypage']; ?>/img/user.jpg" alt="회원사진"><?php } ?>
                        </div>
                        <div class="followinggul-nick"><?php echo eb_nameview($li['mb_id'], $li['wr_name'], $li['wr_email']); ?></div>
                    </div>
                    <div class="followinggul-date">
                        <i class="far fa-clock margin-right-5"></i><?php echo $eb->date_time('Y-m-d',$li['datetime']); ?>
                    </div>
                    <div class="followinggul-hit ellipsis hidden-xs">
                        -
                    </div>
                </div>
            </div>
            <?php } ?>
        </article>
        <?php } ?>
    </div>
    <div id="infinite_pagination">
        <a class="next" href="<?php echo G5_URL; ?>/mypage/?t=followinggul<?php echo $qstr;?>&amp;page=<?php echo ($page+1); ?>"></a>
    </div>
    <div class="view-infinite-more text-center margin-top-40 margin-bottom-20">
        <a id="my-followinggul-more" href="#" class="btn btn-default btn-e-xlg">더 보기<i class="far fa-arrow-alt-circle-down"></i></a>
    </div>
    <?php } else { ?>
    <div class="text-center margin-top-30 margin-bottom-30 color-grey font-size-13">
        <i class="fa fa-exclamation-circle"></i> 팔로윙 글이 없습니다.
    </div>
    <?php } ?>
</div>

<?php /* 팔로윙글 상세보기 모달 시작 */ ?>
<div class="modal fade followinggul-iframe-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog my-followinggul-modal">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <div class="modal-body">
                <iframe id="followinggul-iframe" width="100%" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn-e btn-e-xlg btn-e-dark" type="button"><i class="fas fa-times"></i> 닫기</button>
            </div>
        </div>
    </div>
</div>
<?php /* 팔로윙글 상세보기 모달 끝 */ ?>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/infinite-scroll/jquery.infinitescroll.min.js"></script>
<script>
function followinggul_modal(href) {
    $('.followinggul-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#followinggul-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.followinggul-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#followinggul-iframe").attr("src", href);
        $('#followinggul-iframe').height(parseInt($(window).height() * 0.85));
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

$(function(){
    var $container = $('.infinite-container');
    $container.infinitescroll({
        navSelector  : "#infinite_pagination",
        nextSelector : "#infinite_pagination .next",
        itemSelector : ".followinggul-box",
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
    $('#my-followinggul-more').click(function(){
        $container.infinitescroll('retrieve');
        $('#infinite_pagination').show();
        return false;
    });
});
</script>