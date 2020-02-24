<?php
/**
 * skin file : /theme/THEME_NAME/skin/group/basic/group.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.group-latest {position:relative;overflow:hidden;border:1px solid #e5e5e5;padding:15px;min-height:193px;-webkit-border-radius:2px !important;-moz-border-radius:2px !important;border-radius:2px !important}
.group-latest ul {margin-bottom:0}
.group-latest li {position:relative;overflow:hidden;padding:2px 0;font-size:12px}
.group-latest .group-subj {position:relative;width:70%;padding-right:0;padding-left:0;display:block;text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden;float:left}
.group-latest .group-comment {display:inline-block;white-space:nowrap;vertical-align:baseline;text-align:center;min-width:35px;padding:1px 2px;font-size:10px;line-height:1;color:#fff;background-color:#757575;margin-right:5px}
.group-latest .group-time {position:relative;overflow:hidden;width:30%;font-size:12px;text-align:right;color:#555;float:right}
.group-latest .group-time .i-color {color:#b5b5b5}
.group-latest a:hover .group-subj {text-decoration:underline}
.group-latest a:hover .group-time i {color:#FF2900}
</style>

<div class="basic-group-skin">
<?php for ($i=0; $i<$group_cnt; $i++) {?>
    <?php if ($i%2 == 0) { ?>
    <div class="row margin-bottom-20">
    <?php } ?>
        <div class="col-sm-6 md-margin-bottom-20">
            <div class="headline-short">
                <h5><strong><a href="<?php echo get_eyoom_pretty_url($list[$i]['bo_table']); ?>"><?php echo $list[$i]['bo_subject']; ?></a></strong></h5>
            </div>
            <div class="group-latest">
                <ul class="list-unstyled">
                <?php if (is_array($list[$i]['data'])) { ?>
                <?php foreach ($list[$i]['data'] as $k => $grlist) { ?>
                    <li>
                        <a href="<?php echo $grlist['href']; ?>">
                            <div class="group-subj">
                                <?php if ($grlist['wr_comment']) { ?><span class="group-comment">+<?php echo number_format($grlist['wr_comment']); ?></span><?php } ?><?php echo $grlist['wr_subject']; ?>
                            </div>
                            <div class="group-time">
                                <i class="far fa-clock {? ..new}color-red{:}i-color{/}"></i> <?php echo $eb->date_time('m-d', $grlist['datetime']); ?>
                            </div>
                        </a>
                    </li>
                <?php } ?>
                <?php } else { ?>
                <p class="text-center font-size-12 margin-top-20"><span class="color-grey"><i class="fas fa-exclamation-circle"></i> 최신글이 없습니다.</span></p>
                <?php } ?>
                </ul>
            </div>
        </div>
    <?php if ($i%2 == 1 || ($i+1 == $group_cnt)) { ?>
    </div>
    <div class="clearfix"></div>
    <?php } ?>
<?php } ?>
</div>