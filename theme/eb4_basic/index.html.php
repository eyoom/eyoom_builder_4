<?php
/**
 * theme file : /theme/THEME_NAME/index.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php /*----- Preloader 시작 -----*/ ?>
<div class="loader-wrap">
    <div class="loader"></div>
    <div class="loader-section-left"></div>
    <div class="loader-section-right"></div>
</div>
<?php /*----- Preloader 끝 -----*/ ?>

<div class="main-contents">
    <div class="main-slider">
        <?php echo eb_slider('1516512257'); ?>
    </div>

    <div class="m-b-30">
        <?php echo eb_banner('1669280887'); ?>
    </div>

    <div class="m-b-30">
        <?php echo eb_latest('1517122147'); ?>
    </div>

    <div class="m-b-30">
        <?php echo eb_latest('1518393947'); ?>
    </div>

    <div class="m-b-10">
        <?php echo eb_latest('1518503581'); ?>
    </div>

    <div class="m-b-10">
        <?php echo eb_latest('1519114252'); ?>
    </div>
</div>