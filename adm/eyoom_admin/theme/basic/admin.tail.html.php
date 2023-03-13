<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/tail.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<?php if (!$wmode) { ?>
    </div>
    <div class="back-to-top">
        <i class="fas fa-angle-up"></i>
    </div>
</div>
<?php } ?>

<script>var g5_admin_url = "<?php echo G5_ADMIN_URL; ?>";</script>
<script src="<?php echo G5_ADMIN_URL; ?>/admin.js?ver=<?php echo G5_JS_VER; ?>"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/perfect-scrollbar/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/screenfull/screenfull.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/waves/waves.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/moment/moment.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/eyoom-form/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/js/app.js"></script>
<script>
$(document).ready(function() {
    App.init();

    <?php if (!$wmode) { ?>
    new PerfectScrollbar('#sidebar_left_scroll');
    <?php } ?>

    <?php if ($config['cf_editor'] == 'smarteditor2') { ?>
    // 만일 smarteditor를 사용할 경우, 단축키 버튼 숨기기
    $('.cke_sc').hide();
    <?php } ?>
});
</script>
<?php if ($sub_menu) { ?>
<script>
$(function() {
    var submenu_id = 'submenu_<?php echo $sub_menu; ?>';
    $("#"+submenu_id).addClass('active');
});
</script>
<?php } ?>
<!--[if lt IE 9]>
    <script src="../plugins/respond.min.js"></script>
    <script src="../plugins/html5shiv.min.js"></script>
    <script src="../plugins/eyoom-form/js/eyoom-form-ie8.js"></script>
<![endif]-->

<?php
include_once(EYOOM_ADMIN_THEME_PATH . '/admin.tail_sub.html.php');
?>