<?php
/**
 * skin file : /theme/THEME_NAME/skin/qa/basic/answer.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/prism/prism.min.css" type="text/css" media="screen">',0);
?>

<style>
.board-view-ans .ans-datetime {margin:10px 0;padding:8px 0;border-top:1px dotted #e5e5e5;border-bottom:1px dotted #e5e5e5;color:#757575}
.board-view-ans .ans-con {position:relative;margin:20px 0}
.view-ans-divider {position:relative;height:1px;border-top:1px solid #d5d5d5;margin:30px 0}
.view-ans-divider .divider-circle {position:absolute;top:-7px;left:50%;margin-left:-7px;width:14px;height:14px;border:2px solid #d5d5d5;background:#fff;z-index:1px;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
</style>

<div class="view-ans-divider"><span class="divider-circle"></span></div>
<div class="board-view-ans">
    <h4><strong><span class="color-red">답변</span> : <?php echo get_text($answer['qa_subject']); ?></strong></h4>
    <div class="ans-datetime">
        <i class="far fa-clock"></i> <?php echo $answer['qa_datetime']; ?>
    </div>
    <div class="ans-con">
        <?php echo get_view_thumbnail(conv_content($answer['qa_content'], $answer['qa_html']), $qaconfig['qa_image_width']); ?>
    </div>
    <div class="pull-left">
        <?php if ($answer_update_href) { ?>
        <a href="<?php echo $answer_update_href; ?>" class="btn-e btn-e-default">답변수정</a>
        <?php } ?>
        <?php if ($answer_delete_href) { ?>
        <a href="<?php echo $answer_delete_href; ?>" class="btn-e btn-e-default" onclick="del(this.href); return false;">답변삭제</a>
        <?php } ?>
    </div>
    <div class="pull-right">
        <a href="<?php echo $rewrite_href; ?>" class="btn-e btn-e-yellow">추가질문</a>
    </div>
    <div class="clearfix"></div>
</div>
<div class="view-ans-divider"><span class="divider-circle"></span></div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/prism/prism.min.js"></script>