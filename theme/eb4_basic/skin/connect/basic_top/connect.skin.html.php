<?php
/**
 * skin file : /theme/THEME_NAME/skin/connect/basic_top/connect.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<a href="<?php echo G5_BBS_URL; ?>/current_connect.php"><i class="fas fa-male m-r-5"></i>접속자 <?php echo $row['total_cnt']; ?> <?php if ($row['mb_cnt']) { ?>(<span><?php echo $row['mb_cnt']; ?></span>)<?php } ?></a>