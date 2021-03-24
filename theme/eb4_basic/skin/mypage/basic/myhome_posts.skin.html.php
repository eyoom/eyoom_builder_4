<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/myhome_posts.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.my-post {position:relative;margin-left:-5px;margin-right:-5px}
.my-post .post-item {position:relative;width:33.33333%}
.my-post .post-item-pd {padding:5px}
.my-post .post-item-in {position:relative;background:#fff;border:1px solid #e5e5e5}
.my-post .post-item-in .item-category {position:relative;background:#fff;padding:10px;color:#959595;font-weight:bold;border-bottom:1px solid #ededed}
.my-post .post-item .post-item-photo {position:relative;overflow:hidden;padding:10px 10px 0}
.my-post .post-item .post-item-photo-in {position:relative;overflow:hidden;max-height:500px}
.my-post .post-item .post-item-photo-in:after {content:"";text-align:center;position:absolute;display:block;left:0;top:0;opacity:0;-moz-transition:all 0.2s ease 0s;-webkit-transition:all 0.2s ease 0s;-ms-transition:all 0.2s ease 0s;-o-transition:all 0.2s ease 0s;transition:all 0.2s ease 0s;width:100%;height:100%;background:rgba(0,0,0,0.45)}
.my-post .post-item .post-item-photo-in .movie-icon {display:inline-block;position:absolute;top:50%;left:50%;width:40px;height:40px;line-height:40px;text-align:center;color:#fff;font-size:30px;margin-top:-20px;margin-left:-20px;z-index:1}
.my-post .post-item:hover .post-item-photo-in:after {opacity:1}
.my-post .post-item:hover .post-item-photo-in {box-shadow:none}
.my-post .post-item .post-item-info {position:relative;padding:0 10px;margin-top:5px}
.my-post .post-item .post-item-info h4 {font-size:15px;color:#000}
.my-post .post-item:hover .post-item-info h4 {text-decoration:underline}
.my-post .post-item .post-item-info .post-cont {position:relative;overflow:hidden;color:#757575;font-weight:200;font-size:12px}
.my-post .post-item .post-item-bottom {position:relative;border-top:1px solid #e5e5e5;font-size:11px;color:#000}
.my-post .post-item .post-item-bottom .pull-left {padding:7px 10px}
.my-post .post-item .post-item-bottom .pull-left i {color:#959595}
.my-post .post-item .post-item-bottom .pull-right {padding:7px 10px;border-left:1px solid #e5e5e5}
.my-post .post-item .post-item-bottom .pull-right i {margin:0 5px}
.my-post .view-infinite-more {margin-top:30px;margin-bottom:40px}
.my-post .view-infinite-more .btn-e-xlg {position:relative;height:40px;line-height:40px;padding:0 100px;font-size:16px !important;border:1px solid #b5b5b5;background:#fff;color:#757575}
.my-post .view-infinite-more .btn-e-xlg i {position:absolute;top:5px;right:5px;font-size:30px;color:#fff;transition:all 0.2s ease-in-out}
.my-post .view-infinite-more .btn-e-xlg:hover {border:1px solid #959595;background:#f5f5f5;color:#000}
.my-post .view-infinite-more .btn-e-xlg:hover i {color:#b5b5b5}
#infscr-loading {text-align:center;z-index:100;position:absolute;left:50%;bottom:0;width:200px;margin-left:-100px;padding:8px 0;background:#000;opacity:0.8;color:#fff}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width:767px) {
    .my-post .post-item {width:50%}
    .my-post .post-item-in .item-category {padding:5px}
    .my-post .post-item .post-item-photo {padding:5px 5px 0}
    .my-post .post-item .post-item-info {padding:0 5px}
    .my-post .post-item .post-item-info h4 {font-size:13px}
    .my-post .post-item .post-item-bottom .pull-left {padding:5px}
    .my-post .post-item .post-item-bottom .pull-right {padding:5px}
}
<?php } ?>
@media (min-width: 768px) {
    .my-post-modal {width:720px;margin:10px auto}
    .my-post-modal .modal-header, .my-post-modal .modal-body, .my-post-modal .modal-footer {padding:10px 20px}
}
@media (min-width: 992px) {
    .my-post-modal {width:940px}
}
@media (min-width: 1200px) {
    .my-post-modal {width:1140px}
}
</style>

<div id="fakeloader"></div>

<?php
/**
 * 마이홈박스
 */
include_once($eyoom_skin_path['mypage'] . '/myhomebox.skin.html.php');
?>

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
                        <?php echo $list[$i]['bo_info']['gr_name']; ?> / <?php echo $list[$i]['bo_info']['bo_name']; ?>
                    </div>
                    <a href="<?php echo $list[$i]['href']; ?>" <?php if (!G5_IS_MOBILE) { ?>onclick="post_modal(this.href); return false;"<?php } else { ?>target="_blank"<?php } ?>>
                        <?php if ($list[$i]['wr_image']) { ?>
                        <div class="post-item-photo">
                            <div class="post-item-photo-in">
                                <img class="img-responsive" src="<?php echo $list[$i]['wr_image']; ?>" alt="">
                                <?php if ($list[$i]['is_video']) { ?>
                                <span class="movie-icon"><i class="far fa-play-circle"></i></span>
                                <?php } ?>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="post-item-info">
                            <h4 class="ellipsis"><strong><?php echo get_text($list[$i]['wr_subject']); ?></strong></h4>
                            <p class="post-cont"><?php echo conv_subject($list[$i]['wr_content'],50,'…'); ?></p>
                        </div>
                    </a>
                    <div class="post-item-bottom clearfix">
                        <div class="pull-left">
                            <i class="far fa-clock"></i> <?php echo $eb->date_time('Y-m-d H:i',$list[$i]['datetime']); ?>
                        </div>
                        <div class="pull-right color-grey">
                            <i class="fas fa-eye"></i> <?php echo $list[$i]['wr_hit']; ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if (count((array)$list) == 0) { ?>
        <div class="text-center color-grey font-size-14 margin-top-50"><i class="fas fa-exclamation-circle"></i> 최근 게시물이 없습니다.</div>
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
    <div class="margin-bottom-30"></div>
    <?php /* 게시물 상세보기 모달 시작 */ ?>
    <div class="modal fade post-iframe-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog my-post-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title"><strong><i class="fas fa-search"></i> <?php if ($user['mb_id'] == $member['mb_id'] ) { ?>나의 게시물 상세보기<?php } else { ?><span class="color-blue"><?php echo $user['mb_nick']; ?></span> 님의 게시물 상세보기<?php } ?></strong></h4>
                </div>
                <div class="modal-body">
                    <iframe id="post-iframe" width="100%" frameborder="0"></iframe>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-e btn-e-lg btn-e-dark" type="button"><i class="fas fa-times"></i> 닫기</button>
                </div>
            </div>
        </div>
    </div>
    <?php /* 게시물 상세보기 모달 끝 */ ?>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/fakeLoader/fakeLoader.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/masonry/masonry.pkgd.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/infinite-scroll/jquery.infinitescroll.min.js"></script>
<script>
$("#fakeloader").fakeLoader({
    timeToHide:3000,
    zIndex:"10",
    spinner:"spinner6",
    bgColor:"#f4f4f4",
});

$(window).load(function(){
    $('#fakeloader').fadeOut(300);
});

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