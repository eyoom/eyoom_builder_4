<?php
/**
 * skin file : /theme/THEME_NAME/skin/connect/basic/connect.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<a href="<?php echo G5_BBS_URL; ?>/current_connect.php">현재접속자 : <strong><?php echo $row['total_cnt']; ?><?php if ($row['mb_cnt']) { ?> (<span class='color-red'>Member <?php echo $row['mb_cnt']; ?></span>)<?php } ?></strong></a>