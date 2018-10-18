<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/theme/theme_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-theme-form">
	<div class="headline">
		<h4><strong>[<span class="color-red"><?php echo $theme_name; ?></span>] 테마 설치하기</strong></h4>
	</div>

	<form name="fthemeform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return ftheme_check(this)" class="eyoom-form">
	<input type="hidden" name="cm_key" id="cm_key" value="">
	<input type="hidden" name="cm_salt" id="cm_salt" value="">
	<input type="hidden" name="tm_name" id="tm_name" value="<?php echo $theme_name; ?>">
	<input type="hidden" name="eyoom_config" id="eyoom_config" value="">

	<div class="adm-form-wrap margin-bottom-30">
		<fieldset>
			<section>
				<label class="label">테마키 입력</label>
				<label for="tm_key" class="input">
					<input type="text" name="tm_key" id="tm_key" value="" required>
				</label>
			</section>
			<div class="note margin-bottom-10"><strong>Note:</strong> 테마키는 테마를 다운로드받으신 이윰넷(<a href="<?php echo EYOOM_SITE; ?>" target="_blank"><?php echo EYOOM_SITE; ?></a>)의 마이페이지 다운로드 내역에서 확인하실 수 있습니다.</div>
		</fieldset>
	</div>

	<?php echo $frm_submit; ?>

	</form>
</div>

<script>
function ftheme_check(f) {
	var tmkey 	= $("#tm_key").val();
	if (!tmkey) {
		alert("구매하신 테마의 라이센스키를 입력해 주세요.");
		$("#tm_key").focus();
		return false;
	} else {
    	var scheme = '<?php echo $hostname['scheme']; ?>';
		var host = '<?php echo $hostname['host']; ?>';
		var wurl = '<?php echo $hostname['host']; ?>';
		var rurl = '';
		
		$.ajax({
			url: "<?php echo EYOOM_AJAX_URL; ?>",
			data: {tmkey: tmkey, scheme: scheme, host: host, wurl: wurl, rurl: rurl},
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
		if (data.eyoom_config) f.eyoom_config.value = data.eyoom_config;
		f.submit();
	} else {
		alert(data.msg);
		f.tm_key.focus();
		f.tm_key.select();
		return false;
	}
}
</script>