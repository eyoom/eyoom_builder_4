<?php
/**
 * skin file : /theme/THEME_NAME/skin/qa/basic/answer.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.board-view-ans {font-size:.9375rem;border-top:1px solid #757575;padding-top:15px}
.board-view-ans h4 {font-size:1.25rem}
.board-view-ans .ans-datetime {margin:15px 0 0;padding:8px 0;border-top:1px solid #eaeaea;border-bottom:1px solid #eaeaea;color:#757575}
.board-view-ans .ans-con {position:relative;margin:20px 0}
</style>

<div class="board-view-ans">
    <h4><strong><span class="text-crimson">답변</span> : <?php echo get_text($answer['qa_subject']); ?></strong></h4>
    <div class="ans-datetime">
        <i class="far fa-clock"></i> <?php echo $answer['qa_datetime']; ?>
    </div>
    <div id="ans_con" class="ans-con"><?php echo get_view_thumbnail(conv_content($answer['qa_content'], $answer['qa_html']), $qaconfig['qa_image_width']); ?></div>
    <?php echo $config['cf_editor'] == 'tuieditor' ? $bbs->tuieditor_viewer("ans_con"): ''; ?>
    <div class="float-start">
        <?php if ($answer_update_href) { ?>
        <a href="<?php echo $answer_update_href; ?>" class="btn-e btn-gray">답변수정</a>
        <?php } ?>
        <?php if ($answer_delete_href) { ?>
        <a href="<?php echo $answer_delete_href; ?>" class="btn-e btn-gray" onclick="del(this.href); return false;">답변삭제</a>
        <?php } ?>
    </div>
    <div class="float-end">
        <a href="<?php echo $rewrite_href; ?>" class="btn-e btn-teal">추가질문</a>
    </div>
    <div class="clearfix"></div>
</div>