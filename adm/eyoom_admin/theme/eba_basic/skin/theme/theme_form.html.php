<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/theme/theme_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<style>
.admin-theme-form .license-scroll-box {position:relative;overflow:hidden;border:1px solid #b5b5b5;padding:10px;margin-bottom:10px}
.admin-theme-form .license-scroll-box-in {position:relative;overflow:hidden;height:200px}
.admin-theme-form .license-title {margin:20px 0 10px}
.admin-theme-form .license-box {position:relative;overflow:hidden;border:1px solid #b5b5b5;padding:10px;margin-bottom:10px}
.admin-theme-form .license-box p {position:relative;padding-left:13px;margin-bottom:0}
.admin-theme-form .license-box p:before {content:"";position:absolute;top:6px;left:0;width:5px;height:5px;background:#959595}
.admin-theme-form .btn-e-red {background-color:#ab0000;border-color:#ab0000}
</style>

<div class="admin-theme-form">
	<div class="headline">
		<h5><strong>[<span class="text-crimson"><?php echo $theme_name; ?></span>] 테마 설치하기</strong></h5>
	</div>

	<form name="fthemeform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return ftheme_check(this)" class="eyoom-form">
	<input type="hidden" name="cm_key" id="cm_key" value="">
	<input type="hidden" name="cm_salt" id="cm_salt" value="">
	<input type="hidden" name="tm_name" id="tm_name" value="<?php echo $theme_name; ?>">
	<input type="hidden" name="eyoom_config" id="eyoom_config" value="">

    <div class="m-b-30">
        <div class="license-scroll-box">
            <div class="license-scroll-box-in">
                <iframe src="<?php echo EYOOM_SITE; ?>/page/?pid=eb4_license&wmode=1" width="100%" height="100%" frameborder="0"></iframe>
            </div>
        </div>

        <label class="checkbox" for="license-agree1">
            <input type="checkbox" name="agree1" value="1" id="license-agree1"><i></i>이윰 라이선스 규정에 동의합니다.
        </label>

        <h5 class="license-title"><strong>1도메인 1카피 라이선스</strong></h5>
        <div class="license-box">
            <p>구매하신 유료테마는 하나의 도메인에서만 사용이 가능하며, 다른 도메인에서 중복으로 사용하실 수 없습니다.</p>
            <p>동일한 테마라도 다른 도메인에서 별도로 사용하고자 한다면 해당 테마를 추가적으로 구매하셔야 합니다.</p>
            <p>1도메인 1카피 라이선스를 어겼을 경우, 저작권자는 사법기관에 고소할 수 있으며, 저작권법에 따라 손해배상액을 청구할 수 있습니다.</p>
        </div>

        <label class="checkbox" for="license-agree2">
            <input type="checkbox" name="agree2" value="1" id="license-agree2"><i></i>1도메인 1카피 라이선스 내용에 동의합니다.
        </label>
        
        <?php if (!$is_cmall) { ?>
		<label class="label m-t-20">테마키 입력</label>
		<label for="tm_key" class="input">
			<input type="text" name="tm_key" id="tm_key" value="">
		</label>

		<div class="note m-b-10"><strong>Note:</strong> 테마키는 테마를 다운로드받으신 이윰넷(<a href="<?php echo EYOOM_SITE; ?>" target="_blank"><?php echo EYOOM_SITE; ?></a>)의 마이페이지 다운로드 내역에서 확인하실 수 있습니다.</div>
		<?php } else { ?>
		<label class="label">주문번호 입력</label>
		<label for="tm_key" class="input">
			<input type="text" name="tm_key" id="tm_key" value="">
		</label>

		<div class="note m-b-10"><strong>Note:</strong> (주)에스아이알소프트(<?php echo GNU_SITE; ?>) 콘텐츠몰에서 구매하신 테마의 주문번호를 입력해 주시기 바랍니다. </div>
		<div class="note m-b-10"><strong>Note:</strong> 주문번호는 향후 테마키로 활용됩니다. 정확히 입력해 주셔야 합니다.</div>
		<?php }?>
    </div>

    <?php echo $frm_submit; ?>

    </form>
</div>

<script>
function ftheme_check(f) {
    if (!f.agree1.checked) {
        alert('테마 라이센스정책 내용에 동의하셔야 테마를 설치하실 수 있습니다.');
        f.agree1.focus();
        return false;
    }
    if (!f.agree2.checked) {
        alert('1도메인 1카피 라이센스 내용에 동의하셔야 테마를 설치하실 수 있습니다.');
        f.agree2.focus();
        return false;
    }
    
	var tmkey 	= $("#tm_key").val();
	if (!tmkey) {
		<?php if (!$is_cmall) { ?>
		alert("구매하신 테마의 라이센스키를 입력해 주세요.");
		<?php } else { ?>
		alert("(주)에스아이알소프트(<?php echo GNU_SITE; ?>) 콘텐츠몰에서 구매하신 테마의 주문번호를 입력해 주세요.");
		<?php } ?>
		$("#tm_key").focus();
		return false;
	} else {
		var scheme = '<?php echo $hostname['scheme']; ?>';
		var host = '<?php echo $hostname['host']; ?>';
		var wurl = '<?php echo $hostname['host']; ?>';
		var rurl = '';
		var itid = '<?php echo $it_id; ?>';
		var eb4 = '<?php echo EYOOM_VERSION; ?>';
		
		$.ajax({
			url: "<?php echo EYOOM_AJAX_URL; ?>",
			data: {tmkey: tmkey, scheme: scheme, host: host, wurl: wurl, rurl: rurl, itid: itid, eb4: eb4},
			dataType: 'jsonp',
			jsonp: 'callback',
			jsonpCallback: 'set_theme',
			success: function(){}
		});
		return false;
	}
}

function set_theme(data) {
	var f = document.fthemeform;
	if(data.cm_key) {
		if (data.cm_key) f.cm_key.value = data.cm_key;
		if (data.cm_salt) f.cm_salt.value = data.cm_salt;
		if (data.tm_name) f.tm_name.value = data.tm_name;
		if (data.eyoom_config) f.eyoom_config.value = data.eyoom_config;
		if (data.msg) alert(data.msg);
		f.submit();
	} else {
		alert(data.msg);
		f.tm_key.focus();
		f.tm_key.select();
		return false;
	}
}
</script>