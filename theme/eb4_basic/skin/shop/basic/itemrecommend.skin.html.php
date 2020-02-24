<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/itemrecommend.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/fontawesome5/css/fontawesome-all.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/eyoom-form/css/eyoom-form.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/common.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/style.css" type="text/css" media="screen">',0);
?>

<style>
.shop-itemrecommend {position:relative;padding:15px}
.shop-itemrecommend .win-title {position:relative;margin:0 0 20px;font-size:16px;height:50px;line-height:30px;padding:10px;background:#555;color:#fff;margin-bottom:30px}
.shop-itemrecommend .win-close-btn {position:absolute;top:10px;right:10px;width:30px;height:30px;line-height:30px;text-align:center;margin:0;padding:0;border:0;background:none;color:#fff}
</style>

<?php /* ---------- 상품 추천하기 시작 ---------- */ ?>
<div class="shop-itemrecommend">
    <h1 class="win-title">
        <?php echo $g5['title']; ?>
        <button type="button" onclick="self.close();" class="win-close-btn"><i class="fas fa-times"></i></button>
    </h1>

    <form name="fitemrecommend" method="post" action="<?php echo G5_SHOP_URL; ?>/itemrecommendmail.php" autocomplete="off" onsubmit="return fitemrecommend_check(this);" class="eyoom-form">
    <input type="hidden" name="token" value="<?php echo $token; ?>">
    <input type="hidden" name="it_id" value="<?php echo $it_id; ?>">

    <div class="itemrecommend-box">
        <div class="margin-bottom-10">
            <label for="to_email">추천받는 분 E-mail<strong class="sound_only"> 필수</strong></label>
            <label class="input required-mark">
                <input type="text" name="to_email" id="to_email" required size="51">
            </label>
        </div>
        <div class="margin-bottom-10">
            <label for="subject">제목<strong class="sound_only"> 필수</strong></label>
            <label class="input required-mark">
                <input type="text" name="subject" id="subject" required size="51">
            </label>
        </div>
        <div class="margin-bottom-30">
            <label for="content">내용<strong class="sound_only"> 필수</strong></label>
            <label class="textarea textarea-resizable required-mark">
                <textarea rows="3" name="content" id="content" required></textarea>
            </label>
        </div>
    </div>

    <div class="text-center">
        <input type="submit" id="btn_submit" value="보내기" class="btn-e btn-e-xlg btn-e-red">
        <button type="button" onclick="self.close();" class="btn-e btn-e-xlg btn-e-dark">닫기</button>
    </div>
    </form>
</div>

<script>
function fitemrecommend_check(f) {
    return true;
}

$(function(){
    $("input, textarea, select, button, i, div.note-editing-area, span.select2-selection, .calendar-time, ul.tag-editor, div.asSpinner-control").on({ 'touchstart' : function() {
        zoomDisable();
    }});
    $("input, textarea, select, button, i, div.note-editing-area, span.select2-selection, .calendar-time, ul.tag-editor, div.asSpinner-control").on({ 'touchend' : function() {
        setTimeout(zoomEnable, 500);
    }});
    function zoomDisable() {
        $('head meta[name=viewport]').remove();
        $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">');
    }
    function zoomEnable() {
        $('head meta[name=viewport]').remove();
        $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1">');
    }
});
</script>
<?php /* ---------- 상품 추천하기 끝 ---------- */ ?>