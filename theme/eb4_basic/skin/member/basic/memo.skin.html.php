<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/memo.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sly/tab_scroll_category.css" type="text/css" media="screen">',0);
?>


<style>
.memo-list {position:relative;overflow:hidden;min-height:500px}
.memo-list .table-list-eb .tr-mobile td {font-size:.75rem;color:#959595;padding-top:0}
.memo-list .table-list-eb .tr-mobile td span {margin-left:5px}
@media (max-width:767px) {
    .memo-list .table-list-eb .tr-fixing {border-color:transparent}
}
</style>
<?php if (G5_IS_MOBILE) { ?>
<style>
.memo-list {padding:15px}
.memo-list .win-title {position:relative;margin:0 0 20px;font-size:1.0625rem;height:60px;line-height:30px;padding:15px 10px;background:#353535;color:#fff}
.memo-list .btn-close {position:absolute;top:19px;right:10px}
</style>
<?php } ?>

<div class="memo-list">
    <?php if (G5_IS_MOBILE) { ?>
    <h4 class="win-title">
        <strong>내 쪽지함</strong>
        <button type="button" class="btn-close btn-close-white" onclick="window.close();" aria-label="Close"></button>
    </h4>
    <?php } ?>
    <div class="tab-scroll-category">
        <div class="scrollbar">
            <div class="handle">
                <div class="mousearea"></div>
            </div>
        </div>
        <div id="tab-category">
            <div class="category-list">
                <span <?php if ($kind == 'recv') { ?>class="active"<?php } ?>>
                    <a href="<?php echo G5_BBS_URL; ?>/memo.php?kind=recv">
                        <?php if ($kind == 'recv') { ?>
                        <strong>받은쪽지</strong>
                        <?php } else { ?>
                        받은쪽지
                        <?php } ?>
                    </a>
                </span>
                <span <?php if ($kind == 'send') { ?>class="active"<?php } ?>>
                    <a href="<?php echo G5_BBS_URL; ?>/memo.php?kind=send">
                        <?php if ($kind == 'send') { ?>
                        <strong>보낸쪽지</strong>
                        <?php } else { ?>
                        보낸쪽지
                        <?php } ?>
                    </a>
                </span>
                <span><a href="<?php echo G5_BBS_URL; ?>/memo_form.php">쪽지쓰기</a></span>
                <span class="fake-span"></span>
            </div>
            <div class="controls">
                <button class="btn prev"><i class="fas fa-caret-left"></i></button>
                <button class="btn next"><i class="fas fa-caret-right"></i></button>
            </div>
        </div>
        <div class="tab-category-divider"></div>
    </div>

    <div class="memo-content">
        <div class="text-gray m-b-15">- 전체 <?php echo $kind_title; ?>쪽지 : <strong class="text-crimson"><?php echo $total_count; ?></strong> 통</div>
        <div class="table-list-eb">
            <div class="board-list-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th><?php if ($kind == 'recv') { ?>보낸사람<?php } else { ?>받는사람<?php } ?></th>
                            <th>내용</th>
                            <th class="hidden-xs">보낸시간</th>
                            <th class="hidden-xs">읽은시간</th>
                            <th>관리</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                        <tr class="tr-fixing">
                            <td class="text-center"><strong><?php echo eb_nameview($list[$i]['mb_id'], $list[$i]['mb_nick'], $list[$i]['mb_email'], $list[$i]['mb_homepage']); ?></strong></td>
                            <td class="text-center"><a href="<?php echo $list[$i]['view_href']; ?>" class="btn-e btn-e-xs <?php if ($list[$i]['read_datetime'] == '아직 읽지 않음') { ?>btn-e-navy<?php } else { ?>btn-e-gray<?php } ?>">쪽지 보기</a></td>
                            <td class="text-center hidden-xs"><a href="<?php echo $list[$i]['view_href']; ?>"><?php echo $list[$i]['send_datetime']; ?></a></td>
                            <td class="text-center hidden-xs"><a href="<?php echo $list[$i]['view_href']; ?>"><span class="<?php if ($list[$i]['read_datetime'] == '아직 읽지 않음') { ?>text-crimson<?php } else { ?>text-black<?php } ?>"><?php echo $list[$i]['read_datetime']; ?></span></a></td>
                            <td class="text-center"><a href="<?php echo $list[$i]['del_href']; ?>" class="btn-e btn-e-xs btn-e-dark memo-del-btn" onclick="del(this.href); return false;">삭제</a></td>
                        </tr>
                        <tr class="tr-mobile visible-xs"><?php /* 991px 이하에서만 보임 */ ?>
                            <td colspan="3" class="text-end">
                                <span>[보낸시간] <strong class="text-black"><?php echo $list[$i]['send_datetime']; ?></strong></span>
                                <span>[읽은시간] <strong class="<?php if ($list[$i]['read_datetime'] == '아직 읽지 않음') { ?>text-crimson<?php } else { ?>text-black<?php } ?>"><?php echo $list[$i]['read_datetime']; ?></strong></span>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php if (count((array)$list) == 0) { ?>
                        <tr><td colspan="5" class="text-center">자료가 없습니다.</td></tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="text-gray m-b-10 f-s-13r"><strong>Note:</strong> 쪽지 보관일수는 최장 <strong><?php echo $config['cf_memo_del']; ?></strong>일 입니다.</div>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>

    <?php if (G5_IS_MOBILE) { ?>
    <div class="text-center m-t-30 m-b-30">
        <button type="button" onclick="window.close();" class="btn-e btn-e-xl btn-e-dark">창닫기</button>
    </div>
    <?php } ?>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sly/vendor_plugins.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sly/sly.min.js"></script>
<script>
$(function() {
    var $frame = $('#tab-category');
    var $wrap  = $frame.parent();
    $frame.sly({
        horizontal: 1,
        itemNav: 'centered',
        smart: 1,
        activateOn: 'click',
        mouseDragging: 1,
        touchDragging: 1,
        releaseSwing: 1,
        scrollBar: $wrap.find('.scrollbar'),
        scrollBy: 1,
        startAt: $frame.find('.active'),
        speed: 300,
        elasticBounds: 1,
        easing: 'easeOutExpo',
        dragHandle: 1,
        dynamicHandle: 1,
        clickBar: 1,
        prev: $wrap.find('.prev'),
        next: $wrap.find('.next')
    });
    var tabWidth = $('#tab-category').width();
    var categoryWidth = $('.category-list').width();
    if (tabWidth < categoryWidth) {
        $('.controls').show();
    }
});
</script>