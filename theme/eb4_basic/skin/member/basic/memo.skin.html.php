<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/memo.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/fontawesome5/css/fontawesome-all.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sly/tab_scroll_category.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/common.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/style.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/custom.css" type="text/css" media="screen">',0);
?>


<style>
.memo-list {position:relative;overflow:hidden;padding:5px}
.memo-list .memo-hidden-lg {display:none}
@media (max-width: 500px) {
    .memo-list .memo-hidden-sm {display:none}
    .memo-list .memo-hidden-lg {display:table-row !important}
}
.memo-list .table-list-eb .table thead > tr > th {border-bottom:1px solid #959595;text-align:center;padding:10px 5px}
.memo-list .table-list-eb .table thead > tr > th.text-left {text-align:left}
.memo-list .table-list-eb .table tbody > tr > td {padding:10px 5px}
.memo-list .table-list-eb thead {border-top:2px solid #757575;border-bottom:1px solid #959595}
.memo-list .table-list-eb th {color:#000;font-weight:bold;white-space:nowrap}
.memo-list .table-list-eb .btn-e {color:#fff;text-decoration:none}
.memo-list .table-list-eb .memo-del-btn {color:#fff;text-decoration:none}
.memo-list .table-list-eb .td-mobile td {border-top:1px solid #f0f0f0;padding:5px !important;font-size:11px;color:#959595}
.memo-list .table-list-eb .td-mobile td span {margin-right:5px}
<?php if (G5_IS_MOBILE) { ?>
.memo-list {padding:20px 15px}
.memo-list .win-title {position:relative;margin:0 0 20px;font-size:18px;height:50px;line-height:30px;padding:10px;background:#555;color:#fff}
.memo-list .win-close-btn {position:absolute;top:10px;right:10px;width:30px;height:30px;line-height:30px;text-align:center;margin:0;padding:0;border:0;background:none;color:#fff;float:right}
<?php } ?>
</style>

<div class="memo-list">
    <?php if (G5_IS_MOBILE) { ?>
    <h4 class="win-title">
        <strong>내 쪽지함</strong>
        <button type="button" onclick="window.close();" class="win-close-btn"><i class="fas fa-times"></i></button>
        <div class="clearfix"></div>
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
        <div class="color-grey margin-bottom-10">- 전체 <?php echo $kind_title; ?>쪽지: <strong class="color-red"><?php echo $total_count; ?></strong>통</div>
        <div class="table-list-eb">
            <div class="board-list-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-left"><?php if ($kind == 'recv') { ?>보낸사람<?php } else { ?>받는사람<?php } ?></th>
                            <th>내용</th>
                            <th class="text-left memo-hidden-sm">보낸시간</th>
                            <th class="text-left memo-hidden-sm">읽은시간</th>
                            <th class="memo-hidden-sm">관리</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                        <tr>
                            <td><?php echo eb_nameview($list[$i]['mb_id'], $list[$i]['mb_nick'], $list[$i]['mb_email'], $list[$i]['mb_homepage']); ?></td>
                            <td class="text-center"><a href="<?php echo $list[$i]['view_href']; ?>" class="btn-e btn-e-xs btn-e-default <?php if ($list[$i]['read_datetime'] == '아직 읽지 않음') { ?>btn-e-red<?php } ?>">쪽지 보기</a></td>
                            <td class="memo-hidden-sm"><a href="<?php echo $list[$i]['view_href']; ?>"><?php echo $list[$i]['send_datetime']; ?></a></td>
                            <td class="memo-hidden-sm"><a href="<?php echo $list[$i]['view_href']; ?>"><?php echo $list[$i]['read_datetime']; ?></a></td>
                            <td class="text-center memo-hidden-sm"><a href="<?php echo $list[$i]['del_href']; ?>" class="btn-e btn-e-xs btn-e-dark memo-del-btn" onclick="del(this.href); return false;">삭제</a></td>
                        </tr>
                        <tr class="td-mobile memo-hidden-lg"><?php /* 500px 이하에서만 보임 */ ?>
                            <td colspan="2">
                                <span>[보낸시간] <strong class="color-black"><?php echo $list[$i]['send_datetime']; ?></strong></span>
                                <span>[읽은시간] <strong class="color-black"><?php echo $list[$i]['read_datetime']; ?></strong></span>
                                <span class="pull-right"><a href="<?php echo $list[$i]['del_href']; ?>" onclick="del(this.href); return false;">삭제</a></span>
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
    <div class="color-grey margin-bottom-10 font-size-11"><strong>Note:</strong> 쪽지 보관일수는 최장 <strong><?php echo $config['cf_memo_del']; ?></strong>일 입니다.</div>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>

    <?php if (G5_IS_MOBILE) { ?>
    <div class="text-center margin-top-30 margin-bottom-30">
        <button type="button" onclick="window.close();" class="btn-e btn-e-xlg btn-e-dark">창닫기</button>
    </div>
    <?php } ?>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
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
<!--[if lt IE 9]>
    <script src="<?php echo EYOOM_THEME_URL; ?>/plugins/respond.min.js"></script>
    <script src="<?php echo EYOOM_THEME_URL; ?>/plugins/html5shiv.min.js"></script>
<![endif]-->