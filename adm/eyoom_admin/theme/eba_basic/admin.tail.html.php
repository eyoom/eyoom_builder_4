<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/admin.tail.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<?php if (!$wmode) { ?>
        </div><?php /* End .content-wrapper */ ?>
        <footer>
            <div class="footer-left">
                Copyright &copy; <?php echo $config['cf_title']; ?>. All rights reserved.
            </div>
            <div class="footer-right">
                
            </div>
        </footer>
    </div><?php /* End .page-content */ ?>

    <div class="body-cover">
        <i class="fas fa-times"></i>
    </div>

    <div class="back-to-top">
        <i class="fas fa-angle-up"></i>
    </div>
</div><?php /* End .wrapper */ ?>
<?php } ?>

<iframe src="about:blank" name="blank_iframe" id="blank_iframe" style="display:none;"></iframe>

<?php if ($config['cf_editor'] == 'smarteditor2') { ?>
<script>
$(document).ready(function() {
    // 만일 smarteditor를 사용할 경우, 단축키 버튼 숨기기
    $('.cke_sc').hide();
});
</script>
<?php } ?>

<?php if ($sub_menu) { ?>
<script>
$(function() {
    var submenu_id = 'submenu_<?php echo $sub_menu; ?>';
    $("#"+submenu_id).addClass('active');
});
</script>
<?php } ?>
<?php if (!$wmode) { ?>
<?php if ($is_darkmode == 'yes') { ?>
<script>
<?php /* 다크모드 JS 시작 */ ?>
const darkModeBtn = document.querySelector(".dark-mode-btn");
const currentMode = localStorage.getItem("mode");

if (currentMode == "dark") {
	document.body.classList.toggle("dark-mode");
	if (typeof g5_editor_url != 'undefined' && g5_editor_url.indexOf('ckeditor')!=-1) {
        CKEDITOR.on('instanceReady', function(e) {
            e.editor.document.getBody().setStyle('background-color', '#000');
            e.editor.document.getBody().setStyle('color', '#858585');
        });
    }
}

darkModeBtn.addEventListener("click", function() {
	document.body.classList.toggle("dark-mode");
	let mode = "light";
	let cssLink = document.getElementById("mode_css");
    <?php if(defined('IS_ADMIN_INDEX')) { ?>
    let jsLink = document.getElementById("mode_js");
    <?php if ($is_youngcart) { ?>
    let jsShopLink = document.getElementById("mode_shop_js");
    <?php } ?>
    <?php } ?>
	if (document.body.classList.contains("dark-mode")) {
		mode = "dark";
		cssLink.href = "<?php echo EYOOM_ADMIN_THEME_URL; ?>/css/dark_mode.css?ver=<?php echo G5_CSS_VER; ?>";
        <?php if(defined('IS_ADMIN_INDEX')) { ?>
        jsLink.src = "<?php echo EYOOM_ADMIN_THEME_URL; ?>/js/admin-main-dark.js?ver=<?php echo G5_JS_VER; ?>";
        <?php if ($is_youngcart) { ?>
        jsShopLink.src = "<?php echo EYOOM_ADMIN_THEME_URL; ?>/js/admin-main-shop-dark.js?ver=<?php echo G5_JS_VER; ?>";
        <?php } ?>
        <?php } ?>
        document.documentElement.setAttribute('data-bs-theme', 'dark')
		darkModeBtn.innerHTML = "<i class='fas fa-sun text-amber'></i><span>라이트모드</span>";
	} else {
		cssLink.href = "<?php echo EYOOM_ADMIN_THEME_URL; ?>/css/light_mode.css?ver=<?php echo G5_CSS_VER; ?>";
        <?php if(defined('IS_ADMIN_INDEX')) { ?>
        jsLink.src = "<?php echo EYOOM_ADMIN_THEME_URL; ?>/js/admin-main-light.js?ver=<?php echo G5_JS_VER; ?>";
        <?php if ($is_youngcart) { ?>
        jsShopLink.src = "<?php echo EYOOM_ADMIN_THEME_URL; ?>/js/admin-main-shop-light.js?ver=<?php echo G5_JS_VER; ?>";
        <?php } ?>
        <?php } ?>
        document.documentElement.setAttribute('data-bs-theme', 'light')
		darkModeBtn.innerHTML = "<i class='fas fa-moon'></i><span>다크모드</span>";
	}
	localStorage.setItem("mode", mode);
	set_cookie('mode', mode, 8760);
    window.location.reload();
});
<?php /* 다크모드 JS 끝 */ ?>
</script>
<?php } ?>
<?php } ?>

<script>
$(function() {
    // 사이드메뉴 온/오프
    if (g5_sidebar == 'close') {
        $('#wrapper').addClass('close-nav');
    }

    // 페이지 타이틀/경로설정
    var g5_title = '<?php echo $g5_title; ?>';
    var g5_page_path = '<?php echo $g5_page_path; ?>';
    if (g5_title && g5_page_path) {
        $(".adm_page_title").empty().text(g5_title);
        $(".adm_page_path").empty().html(g5_page_path);
        $("#subpage_title").val('<?php echo $g5_title; ?>');
    }
});
</script>

<?php if (!defined('IS_ADMIN_INDEX') && $is_admin == 'super') { ?>
<script>
$(function() {
    <?php 
    $row = sql_fetch("select count(*) as cnt from {$g5['eyoom_favorite_adm']} where (1) and mb_id='{$member['mb_id']}' and dir='{$dir}' and pid='{$fm_pid}' ");
    if ($row['cnt']>0) {
    ?>
    $("#favorite_menu").prop('checked', true);
    <?php } ?>
    $("#favorite_menu").on("click", function() {
        var onoff = '';
        if($(this).is(":checked")) {
            onoff = 'on';
        } else {
            onoff = 'off';
        }
        var dir = '<?php echo $dir; ?>';
        var pid = '<?php echo $fm_pid; ?>';
        var fm_code = '<?php echo $sub_menu; ?>';
        var me_name = $("#subpage_title").val();
        var url = '<?php echo EYOOM_ADMIN_THEME_URL; ?>/core/common/favorite_menu.php';
        $.post(url, {onoff:onoff, dir:dir, pid:pid, fm_code:fm_code, me_name:me_name});
    });
});
</script>
<?php } ?>

<?php
include_once(EYOOM_ADMIN_THEME_PATH . '/admin.tail_sub.html.php');
?>