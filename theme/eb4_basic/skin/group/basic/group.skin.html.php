<?php
/**
 * skin file : /theme/THEME_NAME/skin/group/basic/group.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.group-latest {position:relative;overflow:hidden;border:1px solid #e5e5e5;padding:15px;min-height:232px}
.group-latest ul {list-style:none;margin-bottom:0}
.group-latest li {position:relative;padding:3px 0}
.group-latest li:after {content:"";display:block;clear:both}
.group-latest .group-subj {position:relative;width:70%;padding-right:40px;padding-left:0;display:block;text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden;float:left}
.group-latest .group-new-icon {position:relative;display:inline-block;width:18px;height:14px;background-color:#ab0000;margin-right:2px}
.group-latest .group-new-icon:before {content:"";position:absolute;top:4px;left:5px;width:2px;height:6px;background-color:#fff}
.group-latest .group-new-icon:after {content:"";position:absolute;top:4px;right:5px;width:2px;height:6px;background-color:#fff}
.group-latest .group-new-icon b {position:absolute;top:3px;left:8px;width:2px;height:8px;background-color:#fff;transform:rotate(-60deg)}
.group-latest .group-comment {display:block;position:absolute;top:0;right:0;color:#f4511e;background:#fff;padding-left:5px}
.group-latest .group-time {position:relative;display:block;white-space:nowrap;word-wrap:normal;overflow:hidden;width:30%;float:left;text-align:right}
.group-latest .group-time i {color:#b5b5b5}
.group-latest a:hover .group-subj {color:#000;text-decoration:underline}
.group-latest a:hover .group-time {color:#000}
.group-latest a:hover .group-time i {color:#ab0000}
</style>

<div class="basic-group-skin">
<?php for ($i=0; $i<$group_cnt; $i++) {?>
    <?php if ($i%2 == 0) { ?>
    <div class="row">
    <?php } ?>
        <div class="col-lg-6 m-b-30">
            <div class="headline-short">
                <h5><a href="<?php echo get_eyoom_pretty_url($list[$i]['bo_table']); ?>"><?php echo $list[$i]['bo_subject']; ?></a></h5>
            </div>
            <div class="group-latest">
                <ul class="list-unstyled">
                <?php if (is_array($list[$i]['data'])) { ?>
                <?php foreach ($list[$i]['data'] as $k => $grlist) { ?>
                    <li>
                        <a href="<?php echo $grlist['href']; ?>">
                            <div class="group-subj">
                                <?php if ($grlist['new']) { ?>
                                <span class="group-new-icon"><b></b></span>
                                <?php } ?>
                                <?php echo $grlist['wr_subject']; ?>
                                <?php if ($grlist['wr_comment']) { ?>
                                <span class="group-comment">+<?php echo number_format($grlist['wr_comment']); ?></span>
                                <?php } ?>
                            </div>
                            <div class="group-time">
                                <i class="far fa-clock"></i> <?php echo $eb->date_time('m-d', $grlist['datetime']); ?>
                            </div>
                        </a>
                    </li>
                <?php } ?>
                <?php } else { ?>
                    <p class="text-center text-gray m-t-30 m-b-30"><i class="fas fa-exclamation-circle"></i> 최신글이 없습니다.</p>
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