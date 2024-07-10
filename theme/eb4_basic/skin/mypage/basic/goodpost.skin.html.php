<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/goodpost.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.goodpost-list {font-size:.9375rem}
.goodpost-list .gl-wrap {position:relative;border-top:2px solid #757575;border-bottom:1px solid #757575}
.goodpost-list .gl-wrap > div:nth-last-child(1), .goodpost-list .gl-wrap > div:nth-last-child(2) {border-bottom:0}
.goodpost-list .gl-head {position:relative;display:table;width:100%;height:50px;border-bottom:1px solid #757575;background-color:#f2f2f2;font-weight:500}
.goodpost-list .gl-head > div {position:relative}
.goodpost-list .gl-head > div:before {content:"";position:absolute;top:50%;right:0;width:1px;height:13px;background-color:#cacaca;transform:translateY(-50%)}
.goodpost-list .gl-head > div:last-child:before {display:none}
.goodpost-list .gl-head .gl-item {display:table-cell;vertical-align:middle;width:120px;text-align:center}
.goodpost-list .gl-head .gl-num {width:90px}
.goodpost-list .gl-head .gl-num-short {width:80px}
.goodpost-list .gl-head .gl-author {width:150px;padding:0 10}
.goodpost-list .gl-head .gl-subj {display:table-cell;vertical-align:middle;text-align:center}
.goodpost-list .gl-list {position:relative;display:table;table-layout:fixed;;width:100%;height:46px;border-bottom:1px solid #eaeaea;padding:8px 0}
.goodpost-list .gl-list > div {position:relative}
.goodpost-list .gl-list > div:before {content:"";position:absolute;top:50%;right:0;width:1px;height:13px;background-color:#dadada;transform:translateY(-50%)}
.goodpost-list .gl-list > div:last-child:before {display:none}
.goodpost-list .gl-list .gl-item {display:table-cell;vertical-align:middle;width:120px;text-align:center}
.goodpost-list .gl-list .gl-num {width:90px}
.goodpost-list .gl-list .gl-num-short {width:80px}
.goodpost-list .gl-list .gl-author {width:150px;padding:0 10px;text-align:left}
.goodpost-list .gl-list .gl-subj {display:table-cell;vertical-align:middle;font-weight:500}
.goodpost-list .gl-list .gl-subj a {position:relative;padding:0 10px 0 0;overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical}
.goodpost-list .gl-list .gl-subj a:hover {color:#000;text-decoration:underline}
.goodpost-list .gl-list .gl-subj .gl-img {position:absolute;top:0;left:0;width:50px;height:50px;overflow:hidden} 
.goodpost-list .gl-list .gl-subj .gl-img img {background-repeat:no-repeat;background-size:cover;background-attachment:fixed;background-position:50% 50%;height:100%}
.goodpost-list .gl-list .gl-subj .gl-type {color:#959595;margin-right:3px}
.goodpost-list .gl-list .gl-subj-img {padding-left:60px;height:50px}
.goodpost-list .gl-list .gl-comment {color:#959595}
.goodpost-list .gl-list .gl-comment strong {color:#f4511e;font-weight:400}
.goodpost-list .gl-list .gl-photo {display:inline-block;margin-right:2px}
.goodpost-list .gl-list .gl-photo img {width:17px;height:17px;border-radius:50%}
.goodpost-list .gl-list .gl-photo .gl-user-icon {font-size:.9375rem}
.goodpost-list .gl-mobile {position:relative;border-bottom:1px solid #eaeaea;padding:0 0 8px;color:#959595;display:none}
.goodpost-list .gl-mobile .gl-photo {display:inline-block;margin-right:2px}
.goodpost-list .gl-mobile .gl-photo img {width:17px;height:17px;border-radius:50%}
.goodpost-list .gl-mobile .gl-photo .gl-user-icon {font-size:.9375rem}
.goodpost-list .gl-mobile-right {float:right}
.goodpost-list .gl-no-list {text-align:center;color:#959595;padding:70px 0}
.goodpost-list .view-infinite-more .btn-e-xlg {position:relative;height:50px;line-height:50px;padding:0 120px;font-size:1.0625rem !important;border:1px solid #b5b5b5;background:#fff;color:#757575}
.goodpost-list .view-infinite-more .btn-e-xlg i {position:absolute;top:10px;right:5px;font-size:30px;color:#fff;transition:all 0.2s ease-in-out}
.goodpost-list .view-infinite-more .btn-e-xlg:hover {border:1px solid #959595;background:#f5f5f5;color:#000}
.goodpost-list .view-infinite-more .btn-e-xlg:hover i {color:#b5b5b5}
#infscr-loading {text-align:center;z-index:100;position:absolute;left:50%;bottom:0;width:200px;margin-left:-100px;padding:8px 0;background:#000;opacity:0.8;color:#fff}
@media (max-width:991px) {
    .goodpost-list .goodpost-select {position:relative;top:inherit;right:inherit;width:250px;margin-top:10px}
    .goodpost-list .goodpost-select .eyoom-form label {margin-bottom:0}
    .goodpost-list .gl-head {display:none}
    .goodpost-list .gl-head-checkbox {display:table}
    .goodpost-list .gl-head > div:before, .goodpost-list .gl-list > div:before, .goodpost-list .gl-head .gl-item, .goodpost-list .gl-list .gl-item {display:none}
    .goodpost-list .gl-head .gl-num-checkbox, .goodpost-list .gl-list .gl-num-checkbox {display:table-cell;width:25px}
    .goodpost-list .gl-head .gl-num-checkbox .gl-txt, .goodpost-list .gl-list .gl-num-checkbox .gl-txt {visibility:visible;opacity:0}
    .goodpost-list .gl-head .checkbox, .goodpost-list .gl-list .checkbox {z-index:1}
    .goodpost-list .gl-list {border-bottom:0}
    .goodpost-list .gl-list .gl-subj a {padding:0}
    .goodpost-list .gl-list .gl-subj .gl-img {left:inherit;right:0}
    .goodpost-list .gl-list .gl-subj-img {padding-left:0;padding-right:60px}
    .goodpost-list .gl-mobile {display:block}
}
</style>
<?php if ($side_layout['use'] == 'yes') { ?>
<style>
@media (max-width:1199px) {
    .goodpost-list .goodpost-select {position:relative;top:inherit;right:inherit;width:250px;margin-top:10px}
    .goodpost-list .goodpost-select .eyoom-form label {margin-bottom:0}
    .goodpost-list .gl-head {display:none}
    .goodpost-list .gl-head-checkbox {display:table}
    .goodpost-list .gl-head > div:before, .goodpost-list .gl-list > div:before, .goodpost-list .gl-head .gl-item, .goodpost-list .gl-list .gl-item {display:none}
    .goodpost-list .gl-head .gl-num-checkbox, .goodpost-list .gl-list .gl-num-checkbox {display:table-cell;width:25px}
    .goodpost-list .gl-head .gl-num-checkbox .gl-txt, .goodpost-list .gl-list .gl-num-checkbox .gl-txt {visibility:visible;opacity:0}
    .goodpost-list .gl-head .checkbox, .goodpost-list .gl-list .checkbox {z-index:1}
    .goodpost-list .gl-list {border-bottom:0}
    .goodpost-list .gl-list .gl-subj a {padding:0}
    .goodpost-list .gl-list .gl-subj .gl-img {left:inherit;right:0}
    .goodpost-list .gl-list .gl-subj-img {padding-left:0;padding-right:60px}
    .goodpost-list .gl-mobile {display:block}
}
</style>
<?php } ?>

<div class="goodpost-list">
    <blockquote class="hero m-b-30">
        <p class="li-p"><i class="fas fa-exclamation-circle li-p-fa"></i> 내가 추천 또는 비추천한 게시물을 모아 봅니다.</p>
    </blockquote>

    <div class="gl-wrap">
        <div class="gl-head">
            <div class="gl-subj">제목 / 이미지</div>
            <div class="gl-item gl-author">글쓴이</div>
            <div class="gl-item">게시판</div>
            <div class="gl-item">날짜</div>
            <div class="gl-item gl-num">조회</div>
            <div class="gl-item gl-num">상태</div>
        </div>
        <?php if (isset($list) && is_array($list)) { ?>
        <?php foreach ($list as $key => $li) { ?>
        <div class="gl-list-wrap">
            <div class="gl-list">
                <div class="gl-subj <?php if ($li['wr_image']) { ?>gl-subj-img<?php } ?>">
                    <?php if ($li['wr_image']) { ?>
                    <div class="gl-img">
                        <img src="<?php echo $li['wr_image']; ?>" alt="">
                    </div>
                    <?php } ?>
                    <a href="<?php echo $li['href']; ?>" <?php if ($li['secret']) { ?>onclick="return false;"<?php } else if (!G5_IS_MOBILE) { ?>onclick="goodpost_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                        <span class="subj"><?php echo get_text($li['wr_subject']); ?></span>
                        <?php if ($li['wr_comment']) { ?>
                        <span class="sound_only">댓글</span><span class="gl-comment m-l-5"><strong><i class="far fa-comment-dots"></i> <?php echo number_format($li['wr_comment']); ?></strong></span><span class="sound_only">개</span>
                        <?php } ?>
                    </a>
                </div>
                <div class="gl-item gl-author">
                    <span class="gl-name-in"><?php echo eb_nameview($li['mb_id'], $li['wr_name'], $li['wr_email']); ?></span>
                </div>
                <div class="gl-item text-gray">
                    <?php echo $li['bo_info']['bo_name']; ?>
                </div>
                <div class="gl-item">
                    <?php echo $eb->date_time('Y-m-d',$li['datetime']); ?>
                </div>
                <div class="gl-item gl-num text-gray">
                    <?php echo number_format($li['wr_hit']); ?>
                </div>
                <div class="gl-item gl-num">
                    <?php echo $li['is_good'] == 'good' ? '<span class=\'text-teal\'>추천</span>': '<span class=\'text-crimson\'>비추</span>'; ?>
                </div>
            </div>
            <div class="gl-mobile"><?php /* 991px 이하에서만 보임 */ ?>
                <span class="m-r-5">
                    <span class="gl-name-in"><?php echo eb_nameview($li['mb_id'], $li['wr_name'], $li['wr_email']); ?></span>
                </span>
                <span class="m-r-5">
                    [<?php echo $li['bo_info']['bo_name']; ?>]
                </span>
                <div class="gl-mobile-right">
                    <span class="m-l-5"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d',$li['datetime']); ?></span>
                    <span class="m-l-5"><?php echo $li['is_good'] == 'good' ? '<span class=\'text-teal\'>추천</span>': '<span class=\'text-crimson\'>비추</span>'; ?></span>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
        <?php if (count((array)$list) == 0) { ?>
            <div class="gl-no-list">
            <i class="fas fa-exclamation-circle"></i> 추천 및 비추천을 체크한 게시물이 없습니다.
        </div>
        <?php } ?>
    </div>
    <?php if (count((array)$list) > 0) { ?>
    <div id="infinite_pagination">
        <a class="next" href="<?php echo G5_URL; ?>/mypage/?t=goodpost&page=<?php echo ($page+1); ?>"></a>
    </div>
    <div class="view-infinite-more text-center m-t-30">
        <a id="my-goodpost-more" href="#" class="btn btn-e-xlg">더 보기<i class="far fa-arrow-alt-circle-down"></i></a>
    </div>
    <?php } ?>
</div>

<?php /* 관심게시판 상세보기 모달 시작 */ ?>
<div class="modal fade goodpost-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="goodpost-iframe" width="100%" frameborder="0"></iframe>
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
    var $container = $('.gl-wrap');
    $container.infinitescroll({
        navSelector  : "#infinite_pagination",
        nextSelector : "#infinite_pagination .next",
        itemSelector : ".gl-list-wrap",
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