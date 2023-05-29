<?php
/**
 * skin file : /theme/THEME_NAME/page/page.tail.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php if(0) { ?>
<?php if ($config['cf_map_google_id'] || $config['cf_map_naver_id'] || $config['cf_map_daum_id']) { ?>
<?php if ($config['cf_map_google_id']) { ?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $config['cf_map_google_id']; ?>" async defer></script>
<?php } ?>
<?php if ($config['cf_map_naver_id']) { ?>
<script src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=<?php echo $config['cf_map_naver_id']; ?>&submodules=geocoder"></script>
<?php } ?>
<?php if ($config['cf_map_daum_id']) { ?>
<script src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?php echo $config['cf_map_daum_id']; ?>&libraries=services"></script>
<?php } ?>
<script src="<?php echo EYOOM_THEME_URL; ?>/js/eyoom.map.js"></script>
<script>
$(function(){
    $(".map-content-wrap").each(function(){
        var id      = $(this).find('div').attr('id');
        var type    = $(this).attr('data-map-type');
        var name    = $(this).attr('data-map-name');
        var x       = $(this).attr('data-map-x');
        var y       = $(this).attr('data-map-y');
        var address = $(this).attr('data-map-address');

        switch(type) {
            case 'google': <?php echo $config['cf_map_google_id'] ? 'loading_google_map(id, x, y, name, address);': ''; ?> break;
            case 'naver': <?php echo $config['cf_map_naver_id'] ? 'loading_naver_map(id, x, y, name, address);': ''; ?> break;
            case 'daum': <?php echo $config['cf_map_daum_id'] ? 'loading_daum_map(id, x, y, name, address);': ''; ?> break;
        }
    });
});
</script>
<?php } ?>
<?php } ?>