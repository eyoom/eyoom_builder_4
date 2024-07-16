<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/itemuseform.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
if ($config['cf_editor'] == 'tuieditor') echo tuieditor_resource();
?>

<style>
.shop-product-use-write {position:relative;overflow:hidden;padding:0}
.shop-product-use-write .win-title {position:relative;margin:0 0 20px;font-size:1.0625rem}
.shop-product-use-write .radio {width:100px}
.shop-product-use-write .write-edit-wrap #is_content {display:block;box-sizing:border-box;-moz-box-sizing:border-box;width:100%;min-height:200px;padding:6px 10px;outline:none;border-width:1px;border-style:solid;border-radius:0;background:#FFF;color:#353535;appearance:normal;-moz-appearance:none;-webkit-appearance:none;resize:vertical}
/* Smart Editor */
.cke_sc {margin-bottom:10px !important}
.btn_cke_sc {padding:0 10px}
.cke_sc_def {padding:10px;margin-bottom:10px;margin-top:10px;background:#fbfbfb}
.cke_sc_def button {padding:3px 15px;background:#555555;color:#fff;border:none}
</style>

<?php /* ---------- 사용후기 쓰기 시작 ---------- */ ?>
<div class="shop-product-use-write">
    <form name="fitemuse" method="post" action="<?php echo G5_SHOP_URL; ?>/itemuseformupdate.php" onsubmit="return fitemuse_submit(this);" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="it_id" value="<?php echo $it_id; ?>">
    <input type="hidden" name="is_id" value="<?php echo $is_id; ?>">

    <div class="product-use-write">
        <div class="margin-bottom-20">
            <label for="is_subject" class="sound_only">제목<strong> 필수</strong></label>
            <label class="input required-mark">
                <input type="text" name="is_subject" value="<?php echo get_text($use['is_subject']); ?>" id="is_subject" required maxlength="250" placeholder="제목">
            </label>
        </div>
        <div>
            <strong class="sound_only">내용</strong>
            <div class="write-edit-wrap">
                <?php echo $editor_html; ?>
            </div>
        </div>
        <div class="margin-hr-20"></div>
        <div>
            <span class="sound_only">평점</span>
            <ul class="list-unstyled">
                <li>
                    <div class="inline-group">
                        <label class="radio">
                            <input type="radio" name="is_score" value="5" id="is_score5" <?php echo ($is_score==5)?'checked="checked"':''; ?>><i></i>매우만족
                        </label>
                        <img src="<?php echo G5_URL; ?>/shop/img/s_star5.png" alt="매우만족" width="100">
                    </div>
                    <div class="clearfix"></div>
                </li>
                <li>
                    <div class="inline-group">
                        <label class="radio">
                            <input type="radio" name="is_score" value="4" id="is_score4" <?php echo ($is_score==4)?'checked="checked"':''; ?>><i></i>만족
                        </label>
                        <img src="<?php echo G5_URL; ?>/shop/img/s_star4.png" alt="만족" width="100">
                    </div>
                    <div class="clearfix"></div>
                </li>
                <li>
                    <div class="inline-group">
                        <label class="radio">
                            <input type="radio" name="is_score" value="3" id="is_score3" <?php echo ($is_score==3)?'checked="checked"':''; ?>><i></i>보통
                        </label>
                        <img src="<?php echo G5_URL; ?>/shop/img/s_star3.png" alt="보통" width="100">
                    </div>
                    <div class="clearfix"></div>
                </li>
                <li>
                    <div class="inline-group">
                        <label class="radio">
                            <input type="radio" name="is_score" value="2" id="is_score2" <?php echo ($is_score==2)?'checked="checked"':''; ?>><i></i>불만
                        </label>
                        <img src="<?php echo G5_URL; ?>/shop/img/s_star2.png" alt="불만" width="100">
                    </div>
                    <div class="clearfix"></div>
                </li>
                <li>
                    <div class="inline-group">
                        <label class="radio">
                            <input type="radio" name="is_score" value="1" id="is_score1" <?php echo ($is_score==1)?'checked="checked"':''; ?>><i></i>매우불만
                        </label>
                        <img src="<?php echo G5_URL; ?>/shop/img/s_star1.png" alt="매우불만" width="100">
                    </div>
                    <div class="clearfix"></div>
                </li>
            </ul>
        </div>
        <div class="margin-hr-20"></div>
        <div class="text-center">
            <input type="submit" value="작성완료" class="btn-e btn-e-xlg btn-e-navy">
        </div>
    </div>

    </form>
</div>

<script type="text/javascript">
function fitemuse_submit(f) {
    <?php echo $editor_js; ?>

    return true;
}

<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$is_iphone = (strpos($user_agent, 'iPhone') !== false);
$is_ipad = (strpos($user_agent, 'iPad') !== false);

if ($is_iphone || $is_ipad) {
?>
$(document).ready(function(){
    var touchStartTimestamp = 0;
    
    $("input, textarea, select").on('touchstart', function(event) {
        zoomDisable();
        touchStartTimestamp = event.timeStamp;
    });

    $("input, textarea, select").on('touchend', function(event) {
        var touchEndTimestamp = event.timeStamp;
        if (touchEndTimestamp - touchStartTimestamp > 500) {
            setTimeout(zoomEnable, 500);
        } else {
            zoomDisable();
            setTimeout(zoomEnable, 500);
        }
    });

    function zoomDisable(){
        $('head meta[name=viewport]').remove();
        $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">');
    }

    function zoomEnable(){
        $('head meta[name=viewport]').remove();
        $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1">');
    }
});
<?php } ?>

<?php /* 다크모드 JS 시작 */ ?>
const currentMode = localStorage.getItem("mode");

if (currentMode == "dark") {
	document.body.classList.toggle("dark-mode");
	<?php if($editor_html && preg_match('/ckeditor/i', $config['cf_editor'])) { ?>
	CKEDITOR.on('instanceReady', function(e) {
		e.editor.document.getBody().setStyle('background-color', '#000');
		e.editor.document.getBody().setStyle('color', '#858585');
	});
	<?php } ?>
    <?php if($editor_html && preg_match('/smarteditor2/i', $config['cf_editor'])) { ?>
	$(document).ready(function() {
		$('.smarteditor2').next().attr('class', 'se2_iframe');
		$(".se2_iframe").on("load", function() {
			var iframeHead = $('.se2_iframe').contents().find('head');
			iframeHead.find('#se2_eyoom_css').attr('href', 'css/smart_editor2_eyoom_dark.css');
			iframeHead.find('#se2_eyoom_css').attr('class', 'se2_eyoom_dark_css');
		});
	});
	<?php } ?>
}
<?php /* 다크모드 JS 끝 */ ?>
</script>
<?php /* ---------- 사용후기 쓰기 끝 ---------- */ ?>