<?php
/**
 * skin file : /theme/THEME_NAME/skin/board/basic/sns.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php if($config['cf_kakao_js_apikey']) { ?>
<script src="//developers.kakao.com/sdk/js/kakao.min.js" async charset="utf-8"></script>
<script src="<?php echo G5_JS_URL; ?>/kakaolink.js?ver=<?php echo G5_JS_VER; ?>" charset="utf-8"></script>
<script type='text/javascript'>
    //<![CDATA[
        var kakao_javascript_apikey = "<?php echo $config['cf_kakao_js_apikey']; ?>";

        function Kakao_sendLink() {

            if (window.Kakao && (kakao_javascript_apikey !== undefined)) {
                if (! Kakao.isInitialized()) {
                    Kakao.init(kakao_javascript_apikey);
                }
            }

            var webUrl = location.protocol+"<?php echo '//'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>",
                imageUrl = $("#bo_v_img").find("img").attr("src") || $(".view_image").find("img").attr("src") || '';

            Kakao.Link.sendDefault({
                objectType: 'feed',
                content: {
                    title: "<?php echo str_replace(array('%27', '&#034;' , '\"'), '', strip_tags($view['subject'])); ?>",
                    description: "<?php echo preg_replace('/\r\n|\r|\n/','', strip_tags(get_text(cut_str(strip_tags($view['wr_content']), 200), 1))); ?>",
                    imageUrl: imageUrl,
                    link: {
                        mobileWebUrl: webUrl,
                        webUrl: webUrl
                    }
                },
                buttons: [{
                    title: '자세히 보기',
                    link: {
                        mobileWebUrl: webUrl,
                        webUrl: webUrl
                    }
                }]
            });
        }
    //]]>
</script>
<?php } ?>

<ul class="board-view-sns social-icons social-icons-color">
    <li><a href="<?php echo $facebook_url; ?>" target="_blank" title="Facebook" class="social_facebook"></a></li>
    <li><a href="<?php echo $twitter_url; ?>" target="_blank" title="Twitter" class="social_twitter"></a></li>
    <?php if($config['cf_kakao_js_apikey']) { ?>
    <li><a href="javascript:kakaolink_send('<?php echo str_replace(array('%27', '\''), '', $sns_msg); ?>', '<?php echo $longurl; ?>');" title="Kakao" class="social_kakao"></a></li>
    <?php } ?>
    <li><a href="<?php echo $band_url; ?>" target="_blank" title="Band" class="social_band"></a></li>
</ul>