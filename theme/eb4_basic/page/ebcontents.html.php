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
</style>

<div class="page-ebcontents-wrap">
    <?php foreach ($ec_master as $k => $ec) { ?>
    <a name="<?php echo $ec['ec_code']; ?>"></a>
    <div id="page-ebcontents-<?php echo $ec['ec_code']; ?>" class="page-ebcontents-box">
        <?php echo eb_contents($ec['ec_code']); ?>
    </div>
    <?php } ?>
</div>