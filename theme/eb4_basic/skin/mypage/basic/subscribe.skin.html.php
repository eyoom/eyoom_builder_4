<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/subscribe.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.subscribe-list {font-size:.9375rem}
.subscribe-list .subscribe-select {position:absolute;top:7px;right:7px;width:310px}
.subscribe-list .subscribe-select .subscribe-select-left {width:150px}
.subscribe-list .subscribe-select .subscribe-select-right {width:150px}
.subscribe-list .sl-wrap {position:relative;border-top:2px solid #757575;border-bottom:1px solid #757575}
.subscribe-list .sl-wrap > div:nth-last-child(1), .subscribe-list .sl-wrap > div:nth-last-child(2) {border-bottom:0}
.subscribe-list .sl-head {position:relative;display:table;width:100%;height:50px;border-bottom:1px solid #757575;background-color:#f2f2f2;font-weight:500}
.subscribe-list .sl-head > div {position:relative}
.subscribe-list .sl-head > div:before {content:"";position:absolute;top:50%;right:0;width:1px;height:13px;background-color:#cacaca;transform:translateY(-50%)}
.subscribe-list .sl-head > div:last-child:before {display:none}
.subscribe-list .sl-head .sl-item {display:table-cell;vertical-align:middle;width:120px;text-align:center}
.subscribe-list .sl-head .sl-num {width:90px}
.subscribe-list .sl-head .sl-num-short {width:80px}
.subscribe-list .sl-head .sl-author {width:150px;padding:0 10}
.subscribe-list .sl-head .sl-subj {display:table-cell;vertical-align:middle;text-align:center}
.subscribe-list .sl-list {position:relative;display:table;table-layout:fixed;;width:100%;height:46px;border-bottom:1px solid #eaeaea;padding:8px 0}
.subscribe-list .sl-list > div {position:relative}
.subscribe-list .sl-list > div:before {content:"";position:absolute;top:50%;right:0;width:1px;height:13px;background-color:#dadada;transform:translateY(-50%)}
.subscribe-list .sl-list > div:last-child:before {display:none}
.subscribe-list .sl-list .sl-item {display:table-cell;vertical-align:middle;width:120px;text-align:center}
.subscribe-list .sl-list .sl-num {width:90px}
.subscribe-list .sl-list .sl-num-short {width:80px}
.subscribe-list .sl-list .sl-author {width:150px;padding:0 10px;text-align:left}
.subscribe-list .sl-list .sl-subj {display:table-cell;vertical-align:middle;font-weight:500}
.subscribe-list .sl-list .sl-subj a {position:relative;padding:0 10px 0 0;overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical}
.subscribe-list .sl-list .sl-subj a:hover {color:#000;text-decoration:underline}
.subscribe-list .sl-list .sl-subj .sl-img {position:absolute;top:0;left:0;width:50px;height:50px;overflow:hidden} 
.subscribe-list .sl-list .sl-subj .sl-img img {background-repeat:no-repeat;background-size:cover;background-attachment:fixed;background-position:50% 50%;height:100%}
.subscribe-list .sl-list .sl-subj .sl-type {color:#959595;margin-right:3px}
.subscribe-list .sl-list .sl-subj-img {padding-left:60px;height:50px}
.subscribe-list .sl-list .sl-comment {color:#959595}
.subscribe-list .sl-list .sl-comment strong {color:#f4511e;font-weight:700}
.subscribe-list .sl-list .sl-photo {display:inline-block;margin-right:2px}
.subscribe-list .sl-list .sl-photo img {width:17px;height:17px;border-radius:50%}
.subscribe-list .sl-list .sl-photo .sl-user-icon {font-size:.9375rem}
.subscribe-list .sl-mobile {position:relative;border-bottom:1px solid #eaeaea;padding:0 0 8px;color:#959595;display:none}
.subscribe-list .sl-mobile .sl-photo {display:inline-block;margin-right:2px}
.subscribe-list .sl-mobile .sl-photo img {width:17px;height:17px;border-radius:50%}
.subscribe-list .sl-mobile .sl-photo .sl-user-icon {font-size:.9375rem}
.subscribe-list .sl-mobile-right {float:right}
.subscribe-list .sl-no-list {text-align:center;color:#959595;padding:70px 0}
.subscribe-list .view-infinite-more .btn-e-xlg {position:relative;height:50px;line-height:50px;padding:0 120px;font-size:1.0625rem !important;border:1px solid #b5b5b5;background:#fff;color:#757575}
.subscribe-list .view-infinite-more .btn-e-xlg i {position:absolute;top:10px;right:5px;font-size:30px;color:#fff;transition:all 0.2s ease-in-out}
.subscribe-list .view-infinite-more .btn-e-xlg:hover {border:1px solid #959595;background:#f5f5f5;color:#000}
.subscribe-list .view-infinite-more .btn-e-xlg:hover i {color:#b5b5b5}
#infscr-loading {text-align:center;z-index:100;position:absolute;left:50%;bottom:0;width:200px;margin-left:-100px;padding:8px 0;background:#000;opacity:0.8;color:#fff}
@media (max-width:991px) {
    .subscribe-list .subscribe-select {position:relative;top:inherit;right:inherit;width:310px;margin-top:10px}
    .subscribe-list .subscribe-select .eyoom-form label {margin-bottom:0}
    .subscribe-list .sl-head {display:none}
    .subscribe-list .sl-head-checkbox {display:table}
    .subscribe-list .sl-head > div:before, .subscribe-list .sl-list > div:before, .subscribe-list .sl-head .sl-item, .subscribe-list .sl-list .sl-item {display:none}
    .subscribe-list .sl-head .sl-num-checkbox, .subscribe-list .sl-list .sl-num-checkbox {display:table-cell;width:25px}
    .subscribe-list .sl-head .sl-num-checkbox .sl-txt, .subscribe-list .sl-list .sl-num-checkbox .sl-txt {visibility:visible;opacity:0}
    .subscribe-list .sl-head .checkbox, .subscribe-list .sl-list .checkbox {z-index:1}
    .subscribe-list .sl-list {border-bottom:0}
    .subscribe-list .sl-list .sl-subj a {padding:0}
    .subscribe-list .sl-list .sl-subj .sl-img {left:inherit;right:0}
    .subscribe-list .sl-list .sl-subj-img {padding-left:0;padding-right:60px}
    .subscribe-list .sl-mobile {display:block}
}
</style>
<?php if ($side_layout['use'] == 'yes') { ?>
<style>
@media (max-width:1199px) {
    .subscribe-list .subscribe-select {position:relative;top:inherit;right:inherit;width:310px;margin-top:10px}
    .subscribe-list .subscribe-select .eyoom-form label {margin-bottom:0}
    .subscribe-list .sl-head {display:none}
    .subscribe-list .sl-head-checkbox {display:table}
    .subscribe-list .sl-head > div:before, .subscribe-list .sl-list > div:before, .subscribe-list .sl-head .sl-item, .subscribe-list .sl-list .sl-item {display:none}
    .subscribe-list .sl-head .sl-num-checkbox, .subscribe-list .sl-list .sl-num-checkbox {display:table-cell;width:25px}
    .subscribe-list .sl-head .sl-num-checkbox .sl-txt, .subscribe-list .sl-list .sl-num-checkbox .sl-txt {visibility:visible;opacity:0}
    .subscribe-list .sl-head .checkbox, .subscribe-list .sl-list .checkbox {z-index:1}
    .subscribe-list .sl-list {border-bottom:0}
    .subscribe-list .sl-list .sl-subj a {padding:0}
    .subscribe-list .sl-list .sl-subj .sl-img {left:inherit;right:0}
    .subscribe-list .sl-list .sl-subj-img {padding-left:0;padding-right:60px}
    .subscribe-list .sl-mobile {display:block}
}
</style>
<?php } ?>

<div class="subscribe-list">
    <blockquote class="hero m-b-30">
        <p class="li-p"><i class="fas fa-exclamation-circle li-p-fa"></i> 내가 구독 신청한 회원들의 글을 모아 봅니다.</p>
        <div class="subscribe-select">
            <form name="fmypage" method="get" class="eyoom-form">
            <input type="hidden" name="t" value="subscribe">
                <?php if (is_array($my_subscribe)) { ?>
                <div class="subscribe-select-left float-start">
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
                <div class="subscribe-select-right float-end">
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
                <div class="clearfix"></div>
            </form>
        </div>
    </blockquote>

    <div class="sl-wrap">
        <div class="sl-head">
            <div class="sl-subj">제목 / 이미지</div>
            <div class="sl-item sl-author">글쓴이</div>
            <div class="sl-item">게시판</div>
            <div class="sl-item">날짜</div>
            <div class="sl-item sl-num">조회</div>
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
                    <a href="<?php echo $li['href']; ?>" <?php if ($li['secret']) { ?>onclick="return false;"<?php } else if (!G5_IS_MOBILE) { ?>onclick="subscribe_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
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
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
        <?php if (count((array)$list) == 0) { ?>
        <div class="sl-no-list">
            <i class="fas fa-exclamation-circle"></i> 구독한 글이 없습니다.
        </div>
        <?php } ?>
    </div>
    <?php if (count((array)$list) > 0) { ?>
    <div id="infinite_pagination">
        <a class="next" href="<?php echo G5_URL; ?>/mypage/?t=subscribe<?php echo $qstr;?>&amp;page=<?php echo ($page+1); ?>"></a>
    </div>
    <div class="view-infinite-more text-center m-t-30">
        <a id="my-subscribe-more" href="#" class="btn btn-e-xlg">더 보기<i class="far fa-arrow-alt-circle-down"></i></a>
    </div>
    <?php } ?>
</div>

<?php /* 관심게시판 상세보기 모달 시작 */ ?>
<div class="modal fade subscribe-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="subscribe-iframe" width="100%" frameborder="0"></iframe>
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
    $('#my-subscribe-more').click(function(){
        $container.infinitescroll('retrieve');
        $('#infinite_pagination').show();
        return false;
    });
});
</script>