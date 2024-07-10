<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/itemrecommend.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.shop-itemrecommend {position:relative;padding:15px}
.shop-itemrecommend .win-title {position:relative;margin:0 0 20px;font-size:1.0625rem;height:60px;line-height:30px;padding:15px 10px;background:#353535;color:#fff}
.shop-itemrecommend .btn-close {position:absolute;top:19px;right:10px}
</style>

<?php /* ---------- 상품 추천하기 시작 ---------- */ ?>
<div class="shop-itemrecommend">
    <h1 class="win-title">
        <?php echo $g5['title']; ?>
        <button type="button" class="btn-close btn-close-white" onclick="self.close();" aria-label="Close"></button>
    </h1>

    <form name="fitemrecommend" method="post" action="<?php echo G5_SHOP_URL; ?>/itemrecommendmail.php" autocomplete="off" onsubmit="return fitemrecommend_check(this);" class="eyoom-form">
    <input type="hidden" name="token" value="<?php echo $token; ?>">
    <input type="hidden" name="it_id" value="<?php echo $it_id; ?>">

    <div class="itemrecommend-box">
        <div class="m-b-10">
            <label for="to_email" class="label">추천받는 분 E-mail<strong class="sound_only"> 필수</strong></label>
            <label class="input required-mark">
                <input type="text" name="to_email" id="to_email" required size="51">
            </label>
        </div>
        <div class="m-b-10">
            <label for="subject" class="label">제목<strong class="sound_only"> 필수</strong></label>
            <label class="input required-mark">
                <input type="text" name="subject" id="subject" required size="51">
            </label>
        </div>
        <div class="m-b-30">
            <label for="content" class="label">내용<strong class="sound_only"> 필수</strong></label>
            <label class="textarea textarea-resizable required-mark">
                <textarea rows="3" name="content" id="content" required></textarea>
            </label>
        </div>
    </div>

    <div class="text-center">
        <input type="submit" id="btn_submit" value="보내기" class="btn-e btn-e-lg btn-e-navy">
        <button type="button" onclick="self.close();" class="btn-e btn-e-lg btn-e-dark">닫기</button>
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