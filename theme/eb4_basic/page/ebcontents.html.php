<?php
/**
 * page file : /theme/THEME_NAME/page/ebcontents.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.page-ebcontents-wrap {position:relative}
.page-ebcontents-box {position:relative;margin-bottom:30px}
.page-ebcontents-box:last-child {margin-bottom:0}
.page-ebcontents-box .map-content-wrap {width:100%;height:350px}
.page-ebcontents-box .map-content-wrap > div {width:100%;height:350px}
</style>

<div class="page-ebcontents-wrap">
    <?php if ($ec_cnt > 0) { foreach ($ec_master as $k => $ec) { ?>
    <a name="<?php echo $ec['ec_code']; ?>"></a>
    <div id="page-ebcontents-<?php echo $ec['ec_code']; ?>" class="page-ebcontents-box">
        <?php echo eb_contents($ec['ec_code']); ?>
    </div>
    <?php }} ?>
</div>

<?php if ($is_admin && $ec_cnt==0) { ?>
<style>
.page-ebcontents-install {text-align:center}
.page-ebcontents-install .headline-short h3:after {left:50%;width:16px;margin-left:-8px}
.page-ebcontents-install .ebcontents-install-box {border:1px solid #d5d5d5;padding:30px 20px}
.page-ebcontents-install .ebcontents-license {max-width:500px;background:#353535;padding:15px;color:#b5b5b5;word-break:keep-all;margin:0 auto}
.page-ebcontents-install .ebcontents-license strong {color:#fff}
.page-ebcontents-install .ebcontents-license strong span {color:#FF9500}
.page-ebcontents-install .ebcontents-install-submit {max-width:320px;text-align:left;margin:20px auto 0}
.page-ebcontents-install .ebcontents-install-submit .input-button .button {top:0;right:0;height:38px;line-height:38px;background:#cc2300;color:#fff}
</style>

<div class="page-ebcontents-install">
    <div class="headline-short">
        <h3><strong>웹페이지 설치하기</strong></h3>
    </div>
    <?php if (!$meinfo) { ?>
    <div class="ebcontents-install-box">
        <p class="m-b-15">
            <span class="text-gray">본 페이지는 홈페이지 메뉴에 등록되어 있지 않습니다.</span><br>
            <i class="fas fa-exclamation-circle text-crimson"></i> 먼저 메뉴를 등록해 주세요.
        </p>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=menu_list&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-lg btn-e-crimson"><i class="far fa-edit"></i> 메뉴 설정</a>
    </div>
    <?php } else { ?>
    <form name="fecsetup" action="<?php echo G5_ADMIN_URL; ?>" method="get" onsubmit="return fecsetup_submit(this.form);" class="eyoom-form">
    <input type="hidden" name="dir" value="theme">
    <input type="hidden" name="pid" value="ebcontents_setup">
    <input type="hidden" name="smode" value="1">
    <input type="hidden" name="ec_theme" value="<?php echo $theme; ?>">
    <div class="ebcontents-install-box">
        <p class="text-gray m-b-10">페이지를 설치합니다.</p>
        <div class="ebcontents-license">
            <p class="m-b-10"><i class="fas fa-exclamation-circle text-amber"></i> <strong>웹페이지 라이센스 : <span>1 domain 1copy license</span></strong></p>
            웹페이지 상품은 하나의 홈페이지에서는 여러개를 설치하셔도 되지만 다른 홈페이지에서는 별도로 구매하셔야 하는 라이센스입니다.
        </div>

        <div class="ebcontents-install-submit">
            <label class="label">페이지 아이디(pid)</label>
            <div class="input input-button">
                <input type="text" name="ec_pid" id="ec_pid" value="<?php echo $pid; ?>" readonly required>
                <div class="button"><input type="submit" value="설치하기">설치하기</div>
            </div>
        </div>
    </div>

    </form>
    <script>
    function fecsetup_submit(f) {
        if (f.ec_pid.value == '') {
            alert('페이지 아이디를 입력해 주세요.');
            f.ec_pid.focus();
            return false;
        }
    }
    </script>
    <?php } ?>
</div>
<?php } ?>