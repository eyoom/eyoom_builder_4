<?php if (!defined('_EYOOM_IS_ADMIN_')) exit; ?>

<?php if ($is_admin == 'super') {  ?><!-- <div style='float:left; text-align:center;'>RUN TIME : <?php echo get_microtime()-$begin_time; ?><br></div> --><?php }  ?>

<?php if ($wmode) { ?>
<style>
html {overflow-x:hidden}    
</style>
<?php } ?>

<?php 
/**
 * 후킹 이벤트 실행
 */
run_event('tail_sub');
?>

</body>
</html>
<?php echo html_end(); ?>