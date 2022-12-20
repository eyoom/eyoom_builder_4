<?php
/**
 * skin file : /theme/THEME_NAME/skin/board/gallery/sns.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php if (G5_IS_MOBILE && $config['cf_kakao_js_apikey']) { ?>
<script src="https://developers.kakao.com/sdk/js/kakao.min.js" async></script>
<script src="<?php echo G5_URL; ?>/js/kakaolink.js"></script>
<script>
    // 사용할 앱의 Javascript 키를 설정해 주세요.
    Kakao.init("<?php echo $config['cf_kakao_js_apikey']; ?>");
</script>
<?php } ?>

<ul class="board-view-sns social-icons social-icons-color">
    <li><a href="<?php echo $facebook_url; ?>" target="_blank" title="Facebook" class="social_facebook"></a></li>
    <li><a href="<?php echo $twitter_url; ?>" target="_blank" title="Twitter" class="social_twitter"></a></li>
    <?php if($config['cf_kakao_js_apikey']) { ?>
    <li><a href="javascript:kakaolink_send('<?php echo str_replace(array('%27', '\''), '', $sns_msg); ?>', '<?php echo $longurl; ?>');" title="Kakao" class="social_kakao"></a></li>
    <?php } ?>
    <li><a href="<?php echo $kakaostory_url; ?>" target="_blank" title="Kakao Story" class="social_kakaostory"></a></li>
    <li><a href="<?php echo $band_url; ?>" target="_blank" title="Band" class="social_band"></a></li>
</ul>