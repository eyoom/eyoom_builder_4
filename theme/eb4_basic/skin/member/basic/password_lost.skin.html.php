<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/password_lost.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.find-info {padding:15px}
</style>

<div class="find-info">
    <h4 class="m-b-20"><strong>회원정보찾기</strong></h4>
    <div class="alert alert-warning">
        <p><i class="fas fa-exclamation-circle"></i> 회원가입 시 등록하신 이메일 주소를 입력해 주세요. 해당 이메일로 아이디와 비밀번호 정보를 보내드립니다.</p>
    </div>

    <form name="fpasswordlost" action="<?php echo $action_url; ?>" onsubmit="return fpasswordlost_submit(this);" method="post" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="cert_no" value="">
    <div id="info_fs">
        <section>
            <label for="mb_email" class="label">E-mail 주소<strong class="sound_only">필수</strong></label>
            <label class="input required-mark">
                <i class="icon-append far fa-envelope"></i>
                <input type="text" name="mb_email" id="mb_email" required size="30">
            </label>
        </section>
        <section>
            <label class="label">자동등록방지</label>
            <div class="vc-captcha"><?php echo captcha_html(); ?></div>
        </section>
    </div>
    <div class="text-center m-t-20">
        <input type="submit" value="확인" class="btn-e btn-e-lg btn-e-navy">
        <?php if ($wmode) { ?>
        <button type="button" onclick="window.close();" class="btn-e btn-e-lg btn-e-dark">창닫기</button>
        <?php } ?>
    </div>
    </form>

    <?php if($config['cf_cert_use'] != 0 && $config['cf_cert_find'] != 0) { ?> 
    <div class="new_win_con find_btn">
        <h4 class="m-b-20"><strong>본인인증으로 찾기</strong></h4>
        <div class="cert_btn">
        <?php if(!empty($config['cf_cert_simple'])) { ?>
            <button type="button" id="win_sa_kakao_cert" class="btn-e btn-e-lg btn-e-red win_sa_cert" data-type="">간편인증</button>
        <?php } if(!empty($config['cf_cert_hp']) || !empty($config['cf_cert_ipin'])) { ?>
            <?php if(!empty($config['cf_cert_hp'])) { ?>
            <button type="button" id="win_hp_cert" class="btn-e btn-e-lg btn-e-dark">휴대폰 본인확인</button>
            <?php } if(!empty($config['cf_cert_ipin'])) { ?>
            <button type="button" id="win_ipin_cert" class="btn-e btn-e-lg btn-e-dark">아이핀 본인확인</button>
            <?php } ?>
        <?php } ?>
        </div>
    </div>
    <?php } ?>
</div>

<script>
$(function() {
    $("#reg_zip_find").css("display", "inline-block");
    var pageTypeParam = "pageType=find";

	<?php if($config['cf_cert_use'] && $config['cf_cert_simple']) { ?>
	// TOSS 간편인증
	var url = "<?php echo G5_INICERT_URL; ?>/ini_request.php";
	var type = "";    
    var params = "";
    var request_url = "";
    
	
	$(".win_sa_cert").click(function() {
		type = $(this).data("type");
		params = "?directAgency=" + type + "&" + pageTypeParam;
        request_url = url + params;
        call_sa(request_url);
	});
    <?php } ?>
    <?php if($config['cf_cert_use'] && $config['cf_cert_ipin']) { ?>
    // 아이핀인증
    var params = "";
    $("#win_ipin_cert").click(function() {
        params = "?" + pageTypeParam;
        var url = "<?php echo G5_OKNAME_URL; ?>/ipin1.php"+params;
        certify_win_open('kcb-ipin', url);
        return;
    });

    <?php } ?>
    <?php if($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
    // 휴대폰인증
    var params = "";
    $("#win_hp_cert").click(function() {
        params = "?" + pageTypeParam;
        <?php     
        switch($config['cf_cert_hp']) {
            case 'kcb':                
                $cert_url = G5_OKNAME_URL.'/hpcert1.php';
                $cert_type = 'kcb-hp';
                break;
            case 'kcp':
                $cert_url = G5_KCPCERT_URL.'/kcpcert_form.php';
                $cert_type = 'kcp-hp';
                break;
            case 'lg':
                $cert_url = G5_LGXPAY_URL.'/AuthOnlyReq.php';
                $cert_type = 'lg-hp';
                break;
            default:
                echo 'alert("기본환경설정에서 휴대폰 본인확인 설정을 해주십시오");';
                echo 'return false;';
                break;
        }
        ?>
        
        certify_win_open("<?php echo $cert_type; ?>", "<?php echo $cert_url; ?>"+params);
        return;
    });
    <?php } ?>
});

function fpasswordlost_submit(f)
{
    <?php echo chk_captcha_js();  ?>

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
</script>