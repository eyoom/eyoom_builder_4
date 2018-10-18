<?php
/**
 * theme file : /theme/THEME_NAME/index.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<div id="fakeloader"></div>

<?php echo eb_slider('1516512257'); ?>

<div class="margin-bottom-30">
    <?php echo eb_latest('1517122147'); ?>
</div>

<div class="margin-bottom-30">
    <?php echo eb_latest('1518393947'); ?>
</div>

<div class="margin-bottom-30">
    <?php echo eb_latest('1518503581'); ?>
</div>

<div class="margin-bottom-30">
    <?php echo eb_latest('1519114252'); ?>
</div>

<div class="margin-bottom-30">
    <?php echo eb_goods('1531639927'); ?>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/fakeLoader/fakeLoader.min.js"></script>
<script>
$('#fakeloader').fakeLoader({
    timeToHide:3000,
    zIndex:"11",
    spinner:"spinner6",
    bgColor:"#f4f4f4",
});

$(window).load(function(){
    $('#fakeloader').fadeOut(300);
});
</script>