<?php
/**
 * page file : /theme/THEME_NAME/page/tagview.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.board-webzine .webzine-item {position:relative;font-size:13px;margin-bottom:30px;border:1px solid #d5d5d5;-webkit-border-radius:2px !important;-moz-border-radius:2px !important;border-radius:2px !important;background:#fff;width:100%}
.board-webzine .webzine-item-heading {position:relative;padding:8px 15px;border-bottom:1px solid #e5e5e5;background:#f8f8f8;-webkit-border-radius:2px 2px 0 0 !important;-moz-border-radius:2px 2px 0 0 !important;border-radius:2px 2px 0 0 !important}
.board-webzine .webzine-item-heading .webzine-photo {display:inline-block;width:26px;height:26px;margin-right:2px;border:1px solid #e5e5e5;padding:1px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.board-webzine .webzine-item-heading .webzine-photo img {width:100%;height:auto;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.board-webzine .webzine-item-heading .webzine-photo .webzine-user-icon {width:22px;height:22px;font-size:14px;line-height:22px;text-align:center;background:#959595;color:#fff;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;display:inline-block;white-space:nowrap;vertical-align:baseline;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.board-webzine .webzine-item-heading .webzine-date {margin-left:7px;font-size:12px}
.board-webzine .webzine-item-heading .webzine-date i {color:#959595}
.board-webzine .webzine-item-body {position:relative;overflow:hidden;padding:15px;min-height:130px;box-sizing:content-box}
.board-webzine .webzine-item-body .webzine-img {position:absolute;top:15px;left:15px;width:200px;z-index:1}
.board-webzine .webzine-item-body .webzine-desc {position:relative}
.board-webzine .webzine-item-body .webzine-noimg-desc {position:relative}
.board-webzine .webzine-item-body .webzine-img-box {position:relative;overflow:hidden;height:130px;padding:3px;background:#fff;border:1px solid #ddd;box-sizing:border-box;border-radius:3px !important}
.board-webzine .webzine-item-body .webzine-img-box-in {position:relative;overflow:hidden;height:122px;border-radius:2px !important}
.board-webzine .webzine-item-body .webzine-img-box-in:after {content:"";text-align:center;position:absolute;display:block;left:0;top:0;opacity:0;-moz-transition:all 0.2s ease 0s;-webkit-transition:all 0.2s ease 0s;-ms-transition:all 0.2s ease 0s;-o-transition:all 0.2s ease 0s;transition:all 0.2s ease 0s;width:100%;height:100%;background:rgba(0,0,0,0.45)}
.board-webzine .webzine-item-body .webzine-img-box-in .movie-icon {display:inline-block;position:absolute;top:50%;left:50%;color:#fff;font-size:42px;line-height:1;margin-top:-21px;margin-left:-18px;z-index:1}
.board-webzine .webzine-item:hover .webzine-img-box-in:after {opacity:1}
.board-webzine .webzine-item-body h4 {font-size:15px;color:#000;margin-left:215px}
.board-webzine .webzine-item:hover .webzine-item-body h4 {text-decoration:underline;color:#005cff}
.board-webzine .webzine-item-body .webzine-cont {position:relative;font-weight:300;color:#757575;margin-left:215px}
.board-webzine .webzine-item-body .webzine-info {position:relative;border-top:1px solid #f2f2f2;padding-top:7px;margin-left:215px}
.board-webzine .webzine-item-body .webzine-info span {color:#959595;font-size:11px}
.board-webzine .webzine-item-body .webzine-info span i {margin-right:5px}
.board-webzine .webzine-item-body .webzine-info strong {font-weight:normal;margin-right:10px}
.board-webzine .webzine-item-body .webzine-noimg-desc h4 {margin-left:0}
.board-webzine .webzine-item-body .webzine-noimg-desc .webzine-cont {margin-left:0}
.board-webzine .webzine-item-body .webzine-noimg-desc .webzine-info {margin-left:0}
@media (max-width: 576px) {
    .board-webzine .webzine-item-heading {padding:8px 10px}
    .board-webzine .webzine-item-body {padding:15px 10px}
    .board-webzine .webzine-item-body .webzine-img {top:54px;left:10px;width:100px}
    .board-webzine .webzine-item-body .webzine-img-box {height:70px}
    .board-webzine .webzine-item-body .webzine-img-box-in {height:62px}
    .board-webzine .webzine-item-body h4 {margin-left:0}
    .board-webzine .webzine-item-body .webzine-cont {margin-left:110px;height:72px;font-size:12px;overflow:hidden;margin-bottom:15px}
    .board-webzine .webzine-item-body .webzine-info {margin-left:0;padding-top:10px}
    .board-webzine .webzine-item-body .webzine-noimg-desc .webzine-cont {height:70px;font-size:12px;overflow:hidden}
}
</style>

<?php if ($tag_info['count'] > 0) { ?>
<div class="content-box margin-bottom-30">
    <div class="content-box-header">
        <h4 class="font-bold"><strong>연관태그 검색</strong> <small>[태그 in 태그]</small></h4>
    </div>
    <div class="content-box-body">
        <?php foreach ($rel_tags as $key => $tginfo) { ?>
        <span><a href="<?php echo $tginfo['href']; ?>" class="btn-e btn-e-xs btn-e-blue rounded"><?php echo $tginfo['tag']; ?></a></span>
        <?php } ?>
    </div>
</div>
<?php } ?>

<div class="board-webzine">
    <div class="margin-bottom-20 font-size-12 color-grey">
        <u>전체 <?php echo number_format($total_count); ?> 건 - <?php echo number_format($page); ?> 페이지</u>
    </div>
    <?php for ($i=0; $i<$tag_count; $i++) { ?>
    <div class="webzine-item">
        <div class="webzine-item-heading">
            <span class="webzine-photo">
                <?php if ($list[$i]['mb_photo']) { ?>
                <?php echo $list[$i]['mb_photo']; ?>
                <?php } else { ?>
                <span class="webzine-user-icon"><i class="fa fa-user"></i></span>
                <?php } ?>
            </span>
            <span><?php echo eb_nameview($eyoom['nameview_skin'], $list[$i]['mb_id'], $list[$i]['mb_nick'], $list[$i]['email'], $list[$i]['homepage']); ?></span>
            <span class="webzine-date">
                <?php echo $eb->date_format('Y-m-d', $list[$i]['tw_datetime']); ?>
            </span>
        </div>
        <div class="webzine-item-body">
            <?php if ($list[$i]['mb_photo']) { ?>
            <div class="webzine-img">
                <a href="<?php echo get_eyoom_pretty_url($list[$i]['bo_table'],$list[$i]['wr_id']); ?>">
                    <div class="webzine-img-box">
                        <div class="webzine-img-box-in">
                            <img class="img-responsive" src="<?php echo $list[$i]['image']; ?>">
                        </div>
                    </div>
                </a>
            </div>
            <div class="webzine-desc">
            <?php } else { ?>
            <div class="webzine-noimg-desc">
            <?php } ?>
                <h4 class="ellipsis">
                    <a href="<?php echo get_eyoom_pretty_url($list[$i]['bo_table'],$list[$i]['wr_id']); ?>">
                        <strong><?php echo $list[$i]['wr_subject']; ?></strong>
                    </a>
                </h4>
                <p class="webzine-cont"><?php echo $list[$i]['wr_content']; ?></p>
                <div class="webzine-info">
                    <span><i class="fa fa-eye"></i><strong class="color-black"><?php echo number_format($list[$i]['wr_hit']); ?></strong></span>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php if (!$tag_count) { ?>
    <div class="text-center color-grey font-size-14"><i class="fa fa-exclamation-circle"></i> 출력할 내용이 없습니다.</div>
    <?php } ?>
</div>

<?php echo eb_paging($eyoom['paging_skin']);?>

<form name="viewform" id="viewform" action="<?php echo G5_BBS_URL; ?>/board.php?bo_table=" method="post">
    <input type="hidden" name="tag" value="<?php echo $GET['tag']; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="sca" value="<?php echo $sca; ?>">
    <input type="hidden" name="sop" value="<?php echo $sop; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="spt" value="<?php echo $spt; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
</form>

<script>
// 게시물 목록 링크를 폼으로 변경
function view_post(bo_table, wr_id) {
    if (!wr_id) return false;
    var form = $("#viewform");
    var action = form.attr('action') + bo_table + '&wr_id=' + wr_id;
    form.attr('action',action);
    form.submit();
}
</script>