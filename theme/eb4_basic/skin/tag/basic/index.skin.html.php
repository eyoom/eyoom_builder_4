<?php
/**
 * skin file : /theme/THEME_NAME/skin/tag/basic/index.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.tag-index .tag-item {position:relative;margin-bottom:30px;border:1px solid #d5d5d5;background:#fff;width:100%}
.tag-index .tag-item-heading {position:relative;padding:15px;border-bottom:1px solid #d5d5d5;background:#f8f8f8}
.tag-index .tag-item-heading .tag-photo {display:inline-block;margin-right:2px}
.tag-index .tag-item-heading .tag-photo img {width:17px;height:17px;border-radius:50%}
.tag-index .tag-item-heading .tag-user-icon {color:#959595}
.tag-index .tag-item-heading .tag-date {margin-left:7px}
.tag-index .tag-item-heading .tag-date i {color:#959595}
.tag-index .tag-item-heading .tag-view {margin-left:7px}
.tag-index .tag-item-heading .tag-view i {color:#959595}
.tag-index .tag-item-body {position:relative;overflow:hidden;padding:15px;min-height:130px}
.tag-index .tag-item-body .tag-img {position:absolute;top:15px;left:15px;width:200px;z-index:1}
.tag-index .tag-item-body .tag-desc {position:relative}
.tag-index .tag-item-body .tag-noimg-desc {position:relative}
.tag-index .tag-item-body .tag-img-box {position:relative;overflow:hidden;height:130px;padding:3px;background:#fff;border:1px solid #ddd;border-radius:3px}
.tag-index .tag-item-body .tag-img-box-in {position:relative;overflow:hidden;height:122px;border-radius:2px}
.tag-index .tag-item-body .tag-img-box-in:after {content:"";text-align:center;position:absolute;display:block;left:0;top:0;opacity:0;-moz-transition:all 0.2s ease 0s;-webkit-transition:all 0.2s ease 0s;-ms-transition:all 0.2s ease 0s;-o-transition:all 0.2s ease 0s;transition:all 0.2s ease 0s;width:100%;height:100%;background:rgba(0,0,0,0.45)}
.tag-index .tag-item-body .tag-img-box-in .movie-icon {display:inline-block;position:absolute;top:50%;left:50%;color:#fff;font-size:42px;line-height:1;margin-top:-21px;margin-left:-18px;z-index:1}
.tag-index .tag-item:hover .tag-img-box-in:after {opacity:1}
.tag-index .tag-item-body h5 {font-size:1.125rem;margin-left:215px;margin-bottom:10px}
.tag-index .tag-item:hover .tag-item-body h5 {text-decoration:underline}
.tag-index .tag-item-body .tag-cont {position:relative;overflow:hidden;color:#757575;height:90px;margin-left:215px;margin-bottom:10px}
.tag-index .tag-item-body .tag-noimg-desc h5 {margin-left:0}
.tag-index .tag-item-body .tag-noimg-desc .tag-cont {margin-left:0;margin-bottom:0}
.tag-index .tag-item-body .tag-noimg-desc .tag-info {margin-left:0}
@media (max-width: 767px) {
    .tag-index .tag-item-body .tag-img {top:45px;left:10px;width:100px}
    .tag-index .tag-item-body .tag-img-box {height:70px}
    .tag-index .tag-item-body .tag-img-box-in {height:62px}
    .tag-index .tag-item-body h5 {margin-left:0}
    .tag-index .tag-item-body .tag-cont {margin-left:110px;margin-bottom:0;height:68px}
    .tag-index .tag-item-body .tag-info {margin-left:0;padding-top:10px}
    .tag-index .tag-item-body .tag-noimg-desc .tag-cont {height:68px}
}
</style>

<?php if (count((array)$rel_tags) > 0) { ?>
<div class="panel m-b-30">
    <div class="panel-heading">
        <h5 class="panel-title"><strong>연관태그 검색</strong> <small>[태그 in 태그]</small></h5>
    </div>
    <div class="panel-body">
        <?php for ($i=0; $i<count((array)$rel_tags); $i++) { ?>
        <span><a href="<?php echo $rel_tags[$i]['href']; ?>" class="btn-e btn-e-xs btn-e-gray"><?php echo $rel_tags[$i]['tag']; ?></a></span>
        <?php } ?>
    </div>
</div>
<?php } ?>

<div class="tag-index">
    <div class="m-b-20 text-gray">
        <u>전체 <?php echo number_format($total_count); ?> 건 - <?php echo $page; ?> 페이지</u>
    </div>
    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
    <div class="tag-item">
        <div class="tag-item-heading">
            <?php if ($list[$i]['mb_photo']) { ?>
            <span class="tag-photo">
                <?php echo $list[$i]['mb_photo']; ?>
            </span>
            <?php } else { ?>
            <span class="tag-user-icon"><i class="far fa-user-circle"></i></span>
            <?php } ?>
            <span><?php echo $list[$i]['mb_name']; ?></span>
            <span class="tag-date"><i class="far fa-clock"></i> <?php echo $eb->date_format('Y-m-d', $list[$i]['tw_datetime']); ?></span>
            <span class="tag-view"><i class="far fa-eye"></i> <?php echo number_format($list[$i]['wr_hit']); ?></span>
        </div>
        <div class="tag-item-body">
            <?php if ($list[$i]['image']) { ?>
            <div class="tag-img">
                <a href="<?php echo get_eyoom_pretty_url($list[$i]['bo_table'],$list[$i]['wr_id']); ?>">
                    <div class="tag-img-box">
                        <div class="tag-img-box-in">
                            <img src="<?php echo $list[$i]['image']; ?>" class="img-fluid" alt="">
                        </div>
                    </div>
                </a>
            </div>
            <div class="tag-desc">
            <?php } else { ?>
            <div class="tag-noimg-desc">
            <?php } ?>
                <h5 class="ellipsis">
                    <a href="<?php echo get_eyoom_pretty_url($list[$i]['bo_table'],$list[$i]['wr_id']); ?>">
                        <strong><?php echo $list[$i]['wr_subject']; ?></strong>
                    </a>
                </h5>
                <p class="tag-cont"><?php echo $list[$i]['wr_content']; ?></p>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php if (count((array)$list) == 0) { ?>
    <div class="text-center text-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</div>
    <?php } ?>
</div>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>

<form name="viewform" id="viewform" action="<?php echo G5_BBS_URL; ?>/board.php?bo_table=" method="post">
    <input type="hidden" name="tag" value="<?php echo $_GET['tag']; ?>">
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
    if(!wr_id) return false;
    var form = $("#viewform");
    var action = form.attr('action') + bo_table + '&wr_id=' + wr_id;
    form.attr('action',action);
    form.submit();
}
</script>