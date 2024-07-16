<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/itemqaform.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
if ($config['cf_editor'] == 'tuieditor') echo tuieditor_resource();
?>

<style>
.shop-product-qa-write {position:relative;overflow:hidden;padding:0}
.shop-product-qa-write .win-title {position:relative;margin:0 0 20px;font-size:1.0625rem}
.shop-product-qa-write .radio {width:60px}
.shop-product-qa-write .write-edit-wrap #is_content {display:block;box-sizing:border-box;-moz-box-sizing:border-box;width:100%;min-height:200px;padding:6px 10px;outline:none;border-width:1px;border-style:solid;border-radius:0;background:#FFF;color:#353535;appearance:normal;-moz-appearance:none;-webkit-appearance:none;resize:vertical}
/* Smart Editor */
.cke_sc {margin-bottom:10px !important}
.btn_cke_sc {padding:0 10px}
.cke_sc_def {padding:10px;margin-bottom:10px;margin-top:10px;background:#fbfbfb}
.cke_sc_def button {padding:3px 15px;background:#555555;color:#fff;border:none}
</style>

<?php /* ---------- 사용후기 쓰기 시작 ---------- */ ?>
<div class="shop-product-qa-write">
    <form name="fitemqa" method="post" action="<?php echo G5_SHOP_URL; ?>/itemqaformupdate.php" onsubmit="return fitemqa_submit(this);" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="it_id" value="<?php echo $it_id; ?>">
    <input type="hidden" name="iq_id" value="<?php echo $iq_id; ?>">

    <div class="product-qa-write">
        <div class="m-b-20">
            <label for="iq_secret" class="sound_only">옵션</label>
            <label class="checkbox">
                <input type="checkbox" name="iq_secret" id="iq_secret" value="1" <?php echo $chk_secret; ?>><i></i>비밀글
            </label>

        </div>
        <div class="m-b-20">
            <div class="row">
                <div class="col col-6">
                    <label for="iq_email" class="sound_only">이메일</label>
                    <label class="input">
                        <i class="icon-append far fa-envelope"></i>
                        <input type="text" name="iq_email" id="iq_email" value="<?php echo get_text($qa['iq_email']); ?>" size="30" placeholder="이메일">
                    </label>
                    <div class="note">이메일을 입력하시면 답변 등록 시 답변이 이메일로 전송됩니다.</div>
                </div>
                <div class="col col-6">
                    <label for="iq_hp" class="sound_only">휴대폰</label>
                    <label class="input">
                        <i class="icon-append fas fa-mobile-alt"></i>
                        <input type="text" name="iq_hp" id="iq_hp" value="<?php echo get_text($qa['iq_hp']); ?>" size="20" placeholder="휴대폰">
                    </label>
                    <div class="note">휴대폰번호를 입력하시면 답변 등록 시 답변등록 알림이 SMS로 전송됩니다.</div>
                </div>
            </div>
        </div>
        <div class="m-b-20">
            <label for="iq_subject" class="sound_only">제목<strong> 필수</strong></label>
            <label class="input required-mark">
                <input type="text" name="iq_subject" value="<?php echo get_text($qa['iq_subject']); ?>" id="iq_subject" required maxlength="250" placeholder="제목">
            </label>
        </div>
        <div class="m-b-30">
            <label class="sound_only">질문</label>
            <div class="write-edit-wrap">
                <?php echo $editor_html; ?>
            </div>
        </div>

        <div class="text-center">
            <input type="submit" value="작성완료" class="btn-e btn-e-xlg btn-e-navy">
        </div>
    </div>

    </form>
</div>

<script>
function fitemqa_submit(f) {
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
<?php /* ---------- 상품문의 쓰기 시작 ---------- */ ?>