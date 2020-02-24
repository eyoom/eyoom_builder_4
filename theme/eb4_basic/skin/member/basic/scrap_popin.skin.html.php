<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/scrap_popin.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/fontawesome5/css/fontawesome-all.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/eyoom-form/css/eyoom-form.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/common.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/style.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/custom.css" type="text/css" media="screen">',0);
?>

<style>
.scrap-popin {position:relative;padding:15px}
</style>

<div class="scrap-popin">
    <h4 class="margin-bottom-20"><strong>스크랩하기</strong></h4>
    <div class="alert alert-warning">
        <p><i class="fas fa-exclamation-circle"></i> 제목 확인 및 댓글 쓰기</p>
    </div>

    <form name="f_scrap_popin" action="<?php echo G5_BBS_URL; ?>/scrap_popin_update.php" method="post" class="eyoom-form">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id; ?>">
    <section>
        <label class="label">제목</label>
        <h5><strong class="color-red"><?php echo $subject; ?></strong></h5>
    </section>
    <div class="margin-hr-10"></div>
    <section>
        <label for="wr_content" class="label">댓글</label>
        <label class="textarea textarea-resizable required-mark">
            <textarea name="wr_content" id="wr_content" required></textarea>
        </label>
    </section>
    <div class="note margin-bottom-20"><strong>Note:</strong> 감사 혹은 격려의 댓글을 남겨주세요.</div>
    <div class="text-center margin-bottom-20">
        <input type="submit" value="스크랩 확인" class="btn-e btn-e-lg btn-e-dark">
    </div>
    </form>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
<script>
$("input, textarea, select").on({ 'touchstart' : function() {
    zoomDisable();
}});
$("input, textarea, select").on({ 'touchend' : function() {
    setTimeout(zoomEnable, 500);
}});
function zoomDisable(){
    $('head meta[name=viewport]').remove();
    $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">');
}
function zoomEnable(){
    $('head meta[name=viewport]').remove();
    $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1">');
}
</script>
<!--[if lt IE 9]>
    <script src="<?php echo EYOOM_THEME_URL; ?>/plugins/respond.min.js"></script>
    <script src="<?php echo EYOOM_THEME_URL; ?>/plugins/html5shiv.min.js"></script>
    <script src="<?php echo EYOOM_THEME_URL; ?>/plugins/eyoom-form/js/eyoom-form-ie8.js"></script>
<![endif]-->