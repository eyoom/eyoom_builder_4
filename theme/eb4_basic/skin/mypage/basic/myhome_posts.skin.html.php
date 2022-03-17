<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/myhome_posts.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 마이홈박스
 */
include_once($eyoom_skin_path['mypage'] . '/myhomebox.skin.html.php');
?>

<style>
.my-post {position:relative;margin-left:-10px;margin-right:-10px;margin-bottom:30px}
.my-post .post-item {position:relative;width:33.33333%}
.my-post .post-item-pd {padding:10px}
.my-post .post-item-in {position:relative;background:#fff;border:1px solid #e5e5e5}
.my-post .post-item-in .item-category {position:relative;background:#fff;padding:15px;color:#959595;border-bottom:1px solid #ededed}
.my-post .post-item .post-item-img {position:relative;overflow:hidden;padding:15px 15px 0}
.my-post .post-item .post-item-img-in {position:relative;overflow:hidden;max-height:500px}
.my-post .post-item .post-item-img-in img {width:100%}
.my-post .post-item .post-item-img-in:after {content:"";text-align:center;position:absolute;display:block;left:0;top:0;opacity:0;-webkit-transition:all 0.2s ease 0s;transition:all 0.2s ease 0s;width:100%;height:100%;background:rgba(0,0,0,0.45)}
.my-post .post-item:hover .post-item-img-in:after {opacity:1}
.my-post .post-item:hover .post-item-img-in {box-shadow:none}
.my-post .post-item .post-item-info {position:relative;padding:15px}
.my-post .post-item .post-item-info h4 {font-size:.9375rem;color:#000}
.my-post .post-item:hover .post-item-info h4 {text-decoration:underline}
.my-post .post-item .post-item-info .post-cont {position:relative;color:#757575;margin-top:10px}
.my-post .post-item .post-item-bottom {position:relative;border-top:1px solid #e5e5e5}
.my-post .post-item .post-item-bottom .float-start {padding:15px}
.my-post .post-item .post-item-bottom .float-start i {color:#959595}
.my-post .post-item .post-item-bottom .float-end {padding:15px;border-left:1px solid #e5e5e5}
.my-post .post-item .post-item-bottom .float-end i {margin:0 5px}
.my-post .view-infinite-more {margin-top:30px}
.my-post .view-infinite-more .btn-e-xlg {position:relative;height:50px;line-height:50px;padding:0 120px;font-size:1.0625rem !important;border:1px solid #b5b5b5;background:#fff;color:#757575}
.my-post .view-infinite-more .btn-e-xlg i {position:absolute;top:10px;right:5px;font-size:30px;color:#fff;transition:all 0.2s ease-in-out}
.my-post .view-infinite-more .btn-e-xlg:hover {border:1px solid #959595;background:#f5f5f5;color:#000}
.my-post .view-infinite-more .btn-e-xlg:hover i {color:#b5b5b5}
#infscr-loading {text-align:center;z-index:100;position:absolute;left:50%;bottom:0;width:200px;margin-left:-100px;padding:8px 0;background:#000;opacity:0.8;color:#fff}
@media (max-width:1399px) {
    .my-post .post-item .post-item-bottom .float-end {padding:10px;display:none}
}
@media (max-width:1199px) {
    .my-post {margin-left:-3px;margin-right:-3px}
    .my-post .post-item {width:50%}
    .my-post .post-item-pd {padding:3px}
    .my-post .post-item-in .item-category {padding:10px}
    .my-post .post-item .post-item-img {padding:10px 10px 0}
    .my-post .post-item .post-item-info {padding:10px}
    .my-post .post-item .post-item-bottom .float-start {padding:10px}
}
</style>

<div class="headline-short">
    <h4>
        <strong><?php if ($user['mb_id'] == $member['mb_id']) { ?>나의 최근 게시물<?php } else { ?><?php echo $user['mb_nick']; ?> 님의 최근 게시물<?php } ?></strong>
    </h4>
</div>

<div class="my-post">
    <div class="my-post-container">
        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        <div class="post-item">
            <div class="post-item-pd">
                <div class="post-item-in">
                    <div class="item-category">
                        <?php if(0) { // 그룹명 숨김처리 ?><?php echo $list[$i]['bo_info']['gr_name']; ?> / <?php } ?>
                        <?php echo $list[$i]['bo_info']['bo_name']; ?>
                    </div>
                    <a href="<?php echo $list[$i]['href']; ?>" <?php if (!G5_IS_MOBILE) { ?>onclick="post_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                        <?php if ($list[$i]['wr_image']) { ?>
                        <div class="post-item-img">
                            <div class="post-item-img-in">
                                <img src="<?php echo $list[$i]['wr_image']; ?>" class="img-fluid" alt="">
                            </div>
                        </div>
                        <?php } ?>
                        <div class="post-item-info">
                            <h4><?php echo get_text($list[$i]['wr_subject']); ?></h4>
                            <p class="post-cont"><?php echo conv_subject($list[$i]['wr_content'],50,'…'); ?></p>
                        </div>
                    </a>
                    <div class="post-item-bottom clearfix">
                        <div class="float-start">
                            <i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$list[$i]['datetime']); ?>
                        </div>
                        <div class="float-end text-gray">
                            <i class="far fa-eye"></i> <?php echo $list[$i]['wr_hit']; ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if (count((array)$list) == 0) { ?>
        <div class="text-center text-gray m-t-50"><i class="fas fa-exclamation-circle"></i> 최근 게시물이 없습니다.</div>
        <?php } ?>
    </div>
    <?php if ($list) { ?>
    <div id="infinite_pagination">
        <a class="next" href="<?php echo G5_URL; ?>/?<?php echo $user['mb_id']; ?>&page=<?php echo ($page+1); ?>"></a>
    </div>
    <div class="view-infinite-more text-center">
        <a id="view-infinite-more" href="#" class="btn btn-default btn-e-xlg">더 보기<i class="far fa-arrow-alt-circle-down"></i></a>
    </div>
    <?php } ?>

    <?php /* 게시물 상세보기 모달 시작 */ ?>
    <div class="modal fade post-iframe-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="post-iframe" width="100%" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
    <?php /* 게시물 상세보기 모달 끝 */ ?>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/masonry/masonry.pkgd.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/infinite-scroll/jquery.infinitescroll.min.js"></script>
<script>
function post_modal(href) {
    $('.post-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#post-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.post-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#post-iframe").attr("src", href);
        $('#post-iframe').height(parseInt($(window).height() * 0.85));
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

$(document).ready(function () {
    $(window).resize(function () {
        $('#post-iframe').height(parseInt($(window).height() * 0.7));
    });
    window.closeModal = function(wr_id){
        $('.post-iframe-modal').modal('hide');
        if (wr_id) {
            var w_id = wr_id.split('|');
            for(var i=0;i<w_id.length;i++) {
                $("#list-item-"+w_id[i]).hide();
            }
        }
    };
});

$(document).ready(function(){
    var $container = $('.my-post-container');

    $container.infinitescroll({
        navSelector  : "#infinite_pagination",
        nextSelector : "#infinite_pagination .next",
        itemSelector : ".post-item",
        loading: {
            finishedMsg: 'END',
            msgText: "Loading...",
            img: '<?php echo EYOOM_THEME_URL; ?>/image/loading.gif'
        }
    },

    function( newElements ) {
        var $newElems = $( newElements ).css({ opacity: 0 });
        $newElems.imagesLoaded(function() {
            $newElems.animate({ opacity: 1 });
            $container.masonry( 'appended', $newElems, true );
        });

        $container.imagesLoaded(function() {
            $container.masonry({
                columnWidth: '.post-item',
                itemSelector: '.post-item'
            });
        });
    });

    $(window).unbind('.infscr');

    $('#view-infinite-more').click(function(){
        $container.infinitescroll('retrieve');
        $('#infinite_pagination').show();
        return false;
    });

    $container.imagesLoaded(function() {
        $container.masonry({
            columnWidth: '.post-item',
            itemSelector: '.post-item'
        });
    });
});
</script>