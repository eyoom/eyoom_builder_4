<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/config/dbupgrade.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-dbupgrade">
    <div class="adm-headline">
        <h3>DB 업그레이드</h3>
    </div>
    <div class="cont-text-bg">
        <p class="bg-danger font-size-12"><i class="fas fa-exclamation-circle"></i> <?php echo $db_upgrade_msg; ?></p>
    </div>
</div>