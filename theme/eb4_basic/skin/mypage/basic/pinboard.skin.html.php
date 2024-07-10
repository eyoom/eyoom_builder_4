<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/pinboard.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert2/sweetalert2.min.css" type="text/css" media="screen">',0);
?>

<style>
.pinboard-list {font-size:.9375rem}
.pinboard-list .pinboard-select {position:absolute;top:7px;right:7px;width:250px}
.pinboard-list .pl-wrap {position:relative;border-top:2px solid #757575;border-bottom:1px solid #757575}
.pinboard-list .pl-wrap > div:nth-last-child(1), .pinboard-list .pl-wrap > div:nth-last-child(2) {border-bottom:0}
.pinboard-list .pl-head {position:relative;display:table;width:100%;height:50px;border-bottom:1px solid #757575;background-color:#f2f2f2;font-weight:500}
.pinboard-list .pl-head > div {position:relative}
.pinboard-list .pl-head > div:before {content:"";position:absolute;top:50%;right:0;width:1px;height:13px;background-color:#cacaca;transform:translateY(-50%)}
.pinboard-list .pl-head > div:last-child:before {display:none}
.pinboard-list .pl-head .pl-item {display:table-cell;vertical-align:middle;width:120px;text-align:center}
.pinboard-list .pl-head .pl-num {width:90px}
.pinboard-list .pl-head .pl-num-short {width:80px}
.pinboard-list .pl-head .pl-author {width:150px;padding:0 10}
.pinboard-list .pl-head .pl-subj {display:table-cell;vertical-align:middle;text-align:center}
.pinboard-list .pl-list {position:relative;display:table;table-layout:fixed;;width:100%;height:46px;border-bottom:1px solid #eaeaea;padding:8px 0}
.pinboard-list .pl-list > div {position:relative}
.pinboard-list .pl-list > div:before {content:"";position:absolute;top:50%;right:0;width:1px;height:13px;background-color:#dadada;transform:translateY(-50%)}
.pinboard-list .pl-list > div:last-child:before {display:none}
.pinboard-list .pl-list .pl-item {display:table-cell;vertical-align:middle;width:120px;text-align:center}
.pinboard-list .pl-list .pl-num {width:90px}
.pinboard-list .pl-list .pl-num-short {width:80px}
.pinboard-list .pl-list .pl-author {width:150px;padding:0 10px;text-align:left}
.pinboard-list .pl-list .pl-subj {display:table-cell;vertical-align:middle;font-weight:500}
.pinboard-list .pl-list .pl-subj a {position:relative;padding:0 10px 0 0;overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical}
.pinboard-list .pl-list .pl-subj a:hover {color:#000;text-decoration:underline}
.pinboard-list .pl-list .pl-subj .pl-img {position:absolute;top:0;left:0;width:50px;height:50px;overflow:hidden} 
.pinboard-list .pl-list .pl-subj .pl-img img {background-repeat:no-repeat;background-size:cover;background-attachment:fixed;background-position:50% 50%;height:100%}
.pinboard-list .pl-list .pl-subj .pl-type {color:#959595;margin-right:3px}
.pinboard-list .pl-list .pl-subj-img {padding-left:60px;height:50px}
.pinboard-list .pl-list .pl-comment {color:#959595}
.pinboard-list .pl-list .pl-comment strong {color:#f4511e;font-weight:400}
.pinboard-list .pl-list .pl-photo {display:inline-block;margin-right:2px}
.pinboard-list .pl-list .pl-photo img {width:17px;height:17px;border-radius:50%}
.pinboard-list .pl-list .pl-photo .pl-user-icon {font-size:.9375rem}
.pinboard-list .pl-mobile {position:relative;border-bottom:1px solid #eaeaea;padding:0 0 8px;color:#959595;display:none}
.pinboard-list .pl-mobile .pl-photo {display:inline-block;margin-right:2px}
.pinboard-list .pl-mobile .pl-photo img {width:17px;height:17px;border-radius:50%}
.pinboard-list .pl-mobile .pl-photo .pl-user-icon {font-size:.9375rem}
.pinboard-list .pl-mobile-right {float:right}
.pinboard-list .pl-no-list {text-align:center;color:#959595;padding:70px 0}
.pinboard-list .view-infinite-more .btn-e-xlg {position:relative;height:50px;line-height:50px;padding:0 120px;font-size:1.0625rem !important;border:1px solid #b5b5b5;background:#fff;color:#757575}
.pinboard-list .view-infinite-more .btn-e-xlg i {position:absolute;top:10px;right:5px;font-size:30px;color:#fff;transition:all 0.2s ease-in-out}
.pinboard-list .view-infinite-more .btn-e-xlg:hover {border:1px solid #959595;background:#f5f5f5;color:#000}
.pinboard-list .view-infinite-more .btn-e-xlg:hover i {color:#b5b5b5}
#infscr-loading {text-align:center;z-index:100;position:absolute;left:50%;bottom:0;width:200px;margin-left:-100px;padding:8px 0;background:#000;opacity:0.8;color:#fff}
@media (max-width:991px) {
    .pinboard-list .pinboard-select {position:relative;top:inherit;right:inherit;width:250px;margin-top:10px}
    .pinboard-list .pinboard-select .eyoom-form label {margin-bottom:0}
    .pinboard-list .pl-head {display:none}
    .pinboard-list .pl-head-checkbox {display:table}
    .pinboard-list .pl-head > div:before, .pinboard-list .pl-list > div:before, .pinboard-list .pl-head .pl-item, .pinboard-list .pl-list .pl-item {display:none}
    .pinboard-list .pl-head .pl-num-checkbox, .pinboard-list .pl-list .pl-num-checkbox {display:table-cell;width:25px}
    .pinboard-list .pl-head .pl-num-checkbox .pl-txt, .pinboard-list .pl-list .pl-num-checkbox .pl-txt {visibility:visible;opacity:0}
    .pinboard-list .pl-head .checkbox, .pinboard-list .pl-list .checkbox {z-index:1}
    .pinboard-list .pl-list {border-bottom:0}
    .pinboard-list .pl-list .pl-subj a {padding:0}
    .pinboard-list .pl-list .pl-subj .pl-img {left:inherit;right:0}
    .pinboard-list .pl-list .pl-subj-img {padding-left:0;padding-right:60px}
    .pinboard-list .pl-mobile {display:block}
}
</style>
<?php if ($side_layout['use'] == 'yes') { ?>
<style>
@media (max-width:1199px) {
    .pinboard-list .pinboard-select {position:relative;top:inherit;right:inherit;width:250px;margin-top:10px}
    .pinboard-list .pinboard-select .eyoom-form label {margin-bottom:0}
    .pinboard-list .pl-head {display:none}
    .pinboard-list .pl-head-checkbox {display:table}
    .pinboard-list .pl-head > div:before, .pinboard-list .pl-list > div:before, .pinboard-list .pl-head .pl-item, .pinboard-list .pl-list .pl-item {display:none}
    .pinboard-list .pl-head .pl-num-checkbox, .pinboard-list .pl-list .pl-num-checkbox {display:table-cell;width:25px}
    .pinboard-list .pl-head .pl-num-checkbox .pl-txt, .pinboard-list .pl-list .pl-num-checkbox .pl-txt {visibility:visible;opacity:0}
    .pinboard-list .pl-head .checkbox, .pinboard-list .pl-list .checkbox {z-index:1}
    .pinboard-list .pl-list {border-bottom:0}
    .pinboard-list .pl-list .pl-subj a {padding:0}
    .pinboard-list .pl-list .pl-subj .pl-img {left:inherit;right:0}
    .pinboard-list .pl-list .pl-subj-img {padding-left:0;padding-right:60px}
    .pinboard-list .pl-mobile {display:block}
}
</style>
<?php } ?>

<div class="pinboard-list">
    <blockquote class="hero m-b-30">
        <p class="li-p"><i class="fas fa-exclamation-circle li-p-fa"></i> 내가 핀보드에 핀저장한 글들을 모아서 봅니다.</p>
    </blockquote>

    <div class="pl-wrap">
        <div class="pl-head">
            <div class="pl-subj">제목 / 이미지</div>
            <div class="pl-item pl-author">글쓴이</div>
            <div class="pl-item">게시판</div>
            <div class="pl-item">날짜</div>
            <div class="pl-item pl-num">조회</div>
            <div class="pl-item pl-num">관리</div>
        </div>
        <?php if (isset($list) && is_array($list)) { ?>
        <?php foreach ($list as $key => $li) { ?>
        <div class="pl-list-wrap" id="pinboard_list_<?php echo $key; ?>">
            <div class="pl-list">
                <div class="pl-subj <?php if ($li['wr_image']) { ?>pl-subj-img<?php } ?>">
                    <?php if ($li['wr_image']) { ?>
                    <div class="pl-img">
                        <img src="<?php echo $li['wr_image']; ?>" alt="">
                    </div>
                    <?php } ?>
                    <a href="<?php echo $li['href']; ?>" <?php if ($li['secret']) { ?>onclick="return false;"<?php } else if (!G5_IS_MOBILE) { ?>onclick="pinboard_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                        <span class="subj"><?php echo get_text($li['wr_subject']); ?></span>
                        <?php if ($li['wr_comment']) { ?>
                        <span class="sound_only">댓글</span><span class="pl-comment m-l-5"><strong><i class="far fa-comment-dots"></i> <?php echo number_format($li['wr_comment']); ?></strong></span><span class="sound_only">개</span>
                        <?php } ?>
                    </a>
                </div>
                <div class="pl-item pl-author">
                    <span class="pl-name-in"><?php echo eb_nameview($li['mb_id'], $li['wr_name'], $li['wr_email']); ?></span>
                </div>
                <div class="pl-item text-gray">
                    <?php echo $li['bo_info']['bo_name']; ?>
                </div>
                <div class="pl-item">
                    <?php echo $eb->date_time('Y-m-d',$li['datetime']); ?>
                </div>
                <div class="pl-item pl-num text-gray">
                    <?php echo number_format($li['wr_hit']); ?>
                </div>
                <div class="pl-item pl-num">
                    <button type="button" onclick="pin_cancel('<?php echo $li['bo_table']?>', '<?php echo $li['wr_id']?>', '<?php echo $key; ?>'); return false;" class="btn-e btn-e-xs btn-gray"><i class="fas fa-times"></i> 핀 해제</button>
                </div>
            </div>
            <div class="pl-mobile"><?php /* 991px 이하에서만 보임 */ ?>
                <span class="m-r-5">
                    <span class="pl-name-in"><?php echo eb_nameview($li['mb_id'], $li['wr_name'], $li['wr_email']); ?></span>
                </span>
                <span class="m-r-5">
                    [<?php echo $li['bo_info']['bo_name']; ?>]
                </span>
                <div class="pl-mobile-right">
                    <span class="m-l-5"><i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d',$li['datetime']); ?></span>
                    <span class="m-l-5"><button type="button" onclick="pin_cancel('<?php echo $li['bo_table']?>', '<?php echo $li['wr_id']?>', '<?php echo $key; ?>'); return false;" class="btn-e btn-e-xs btn-gray"><i class="fas fa-times"></i> 핀 해제</button></span>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
        <?php if (count((array)$list) == 0) { ?>
        <div class="pl-no-list">
            <i class="fas fa-exclamation-circle"></i> 핀 저장한 글이 없습니다.
        </div>
        <?php } ?>
    </div>
    <?php if (count((array)$list) > 0) { ?>
    <div id="infinite_pagination">
        <a class="next" href="<?php echo G5_URL; ?>/mypage/?t=pinboard&page=<?php echo ($page+1); ?>"></a>
    </div>
    <div class="view-infinite-more text-center m-t-30">
        <a id="my-pinboard-more" href="#" class="btn btn-e-xlg">더 보기<i class="far fa-arrow-alt-circle-down"></i></a>
    </div>
    <?php } ?>
</div>

<?php /* 관심게시판 상세보기 모달 시작 */ ?>
<div class="modal fade pinboard-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="pinboard-iframe" width="100%" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<?php /* 관심게시판 상세보기 모달 끝 */ ?>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/infinite-scroll/jquery.infinitescroll.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
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
    var $container = $('.pl-wrap');
    $container.infinitescroll({
        navSelector  : "#infinite_pagination",
        nextSelector : "#infinite_pagination .next",
        itemSelector : ".pl-list-wrap",
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
                Swal.fire({
                    title: "알림!",
                    text: '정상적으로 핀을 해제하였습니다.',
                    confirmButtonColor: "#ab0000",
                    icon: "success",
                    confirmButtonText: "확인"
                });
                $("#pinboard_list_"+key).hide();
            }
        }, "json"
    );
}
</script>