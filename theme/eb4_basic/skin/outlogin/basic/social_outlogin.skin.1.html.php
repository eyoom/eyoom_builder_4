<?php
/**
 * skin file : /theme/THEME_NAME/skin/outlogin/basic/social_outlogin.skin.1.html.php
 */
if (!defined('_EYOOM_')) exit;

if( ! $config['cf_social_login_use']) {     //소셜 로그인을 사용하지 않으면
    return;
}

$social_pop_once = false;

$self_url = G5_BBS_URL."/login.php";

//새창을 사용한다면
if( G5_SOCIAL_USE_POPUP ) {
    $self_url = G5_SOCIAL_LOGIN_URL.'/popup.php';
}

add_stylesheet('<link rel="stylesheet" href="'.get_social_skin_url().'/style.css?ver='.G5_CSS_VER.'">', 10);
?>

<style>
.ol-social-icons {margin-top:15px}
.ol-social-icons h6 {text-align:center;margin:0 0 10px;padding:0;font-size:12px;color:#757575}
</style>

<div class="ol-social-icons">
    <h6><strong>SNS 계정으로 로그인</strong></h6>
    <ul class="sns-wrap social-icons text-center">
        <?php if( social_service_check('naver') ) {     //네이버 로그인을 사용한다면 ?>
        <li><a href="<?php echo $self_url;?>?provider=naver&amp;url=<?php echo $urlencode;?>" class="social_link social_naver" title="네이버"></a></li>
        <?php }     //end if ?>
        <?php if( social_service_check('kakao') ) {     //카카오 로그인을 사용한다면 ?>
        <li><a href="<?php echo $self_url;?>?provider=kakao&amp;url=<?php echo $urlencode;?>" class="social_link social_kakao" title="카카오"></a></li>
        <?php }     //end if ?>
        <?php if( social_service_check('facebook') ) {  //페이스북 로그인을 사용한다면 ?>
        <li><a href="<?php echo $self_url;?>?provider=facebook&amp;url=<?php echo $urlencode;?>" class="social_link social_facebook" title="페이스북"></a></li>
        <?php }     //end if ?>
        <?php if( social_service_check('google') ) {    //구글 로그인을 사용한다면 ?>
        <li><a href="<?php echo $self_url;?>?provider=google&amp;url=<?php echo $urlencode;?>" class="social_link social_google" title="구글"></a></li>
        <?php }     //end if ?>
        <?php if( social_service_check('twitter') ) {   //트위터 로그인을 사용한다면 ?>
        <li><a href="<?php echo $self_url;?>?provider=twitter&amp;url=<?php echo $urlencode;?>" class="social_link social_twitter" title="트위터"></a></li>
        <?php }     //end if ?>
        <?php if( social_service_check('payco') ) {     //페이코 로그인을 사용한다면 ?>
        <li><a href="<?php echo $self_url;?>?provider=payco&amp;url=<?php echo $urlencode;?>" class="social_link social_payco" title="페이코"></a></li>
        <?php }     //end if ?>
    </ul>

    <?php if( G5_SOCIAL_USE_POPUP && !$social_pop_once ){
    $social_pop_once = true;
    ?>
    <script>
        jQuery(function($){
            $(".sns-wrap").on("click", "a.social_link", function(e){
                e.preventDefault();

                var pop_url = $(this).attr("href");
                var newWin = window.open(
                    pop_url,
                    "social_sing_on",
                    "location=0,status=0,scrollbars=1,width=600,height=500"
                );

                if(!newWin || newWin.closed || typeof newWin.closed=='undefined')
                    alert('브라우저에서 팝업이 차단되어 있습니다. 팝업 활성화 후 다시 시도해 주세요.');

                return false;
            });
        });
    </script>
    <?php } ?>
</div>