<?php
/**
 * theme file : /theme/THEME_NAME/head.sub.html.php
 */
if (!defined('_EYOOM_')) exit;
?>
<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<?php if (G5_IS_MOBILE) { ?>
<meta name="viewport" id="meta_viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes">
<meta name="HandheldFriendly" content="true">
<meta name="format-detection" content="telephone=no">
<?php } else { ?>
<meta http-equiv="imagetoolbar" content="no">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<?php } ?>
<?php
if ($config['cf_add_meta']) echo $config['cf_add_meta'];
?>

<title><?php echo $g5_head_title; ?></title>
<link rel="stylesheet" href="<?php echo $css_href; ?>">
<?php
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/bootstrap/css/bootstrap.min.css?ver='.G5_CSS_VER.'">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/fontawesome5/css/fontawesome-all.min.css?ver='.G5_CSS_VER.'">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/eyoom-form/css/eyoom-form.min.css?ver='.G5_CSS_VER.'">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/font/Pretendard/Pretendard.css?ver='.G5_CSS_VER.'">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/swiper/swiper-bundle.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/common.css?ver='.G5_CSS_VER.'">',0);
?>
<!--[if lte IE 8]>
<script src="<?php echo G5_JS_URL ?>/html5.js"></script>
<![endif]-->
<script>
// 자바스크립트에서 사용하는 전역변수 선언
var g5_url       = "<?php echo G5_URL ?>";
var g5_bbs_url   = "<?php echo G5_BBS_URL ?>";
var g5_is_member = "<?php echo isset($is_member)?$is_member:''; ?>";
var g5_is_admin  = "<?php echo isset($is_admin)?$is_admin:''; ?>";
var g5_is_mobile = "<?php echo G5_IS_MOBILE ?>";
var g5_bo_table  = "<?php echo isset($bo_table)?$bo_table:''; ?>";
var g5_sca       = "<?php echo isset($sca)?$sca:''; ?>";
var g5_editor    = "<?php echo ($config['cf_editor'] && $board['bo_use_dhtml_editor'])?$config['cf_editor']:''; ?>";
var g5_cookie_domain = "<?php echo G5_COOKIE_DOMAIN ?>";
<?php if(defined('G5_USE_SHOP') && G5_USE_SHOP) { ?>
var g5_shop_url  = "<?php echo G5_SHOP_URL; ?>";
<?php } ?>
<?php if(defined('G5_IS_ADMIN')) { ?>
var g5_admin_url = "<?php echo G5_ADMIN_URL; ?>";
<?php } ?>
</script>
<?php
add_javascript('<script src="'.G5_JS_URL.'/jquery-1.12.4.min.js"></script>', 0);
add_javascript('<script src="'.G5_JS_URL.'/jquery-migrate-1.4.1.min.js"></script>', 0);
add_javascript('<script src="'.G5_JS_URL.'/common.js?ver='.G5_JS_VER.'"></script>', 0);
add_javascript('<script src="'.G5_JS_URL.'/wrest.js?ver='.G5_JS_VER.'"></script>', 0);
add_javascript('<script src="'.G5_JS_URL.'/placeholders.min.js"></script>', 0);
if (G5_IS_MOBILE) { 
    add_javascript('<script src="'.G5_JS_URL.'/modernizr.custom.70111.js"></script>', 1); // overflow scroll 감지
}
add_javascript('<script src="'.EYOOM_THEME_URL.'/plugins/popper/popper.min.js"></script>', 0);
add_javascript('<script src="'.EYOOM_THEME_URL.'/plugins/bootstrap/js/bootstrap.min.js"></script>', 0);
add_javascript('<script src="'.EYOOM_THEME_URL.'/plugins/swiper/swiper-bundle.min.js"></script>', 0);
if (!defined('G5_IS_ADMIN')) echo $config['cf_add_script'];
?>
</head>

<body <?php echo $body_script; ?>>
<?php
if ($is_member) { // 회원이라면 로그인 중이라는 메세지를 출력해준다.
    echo '<div id="hd_login_msg">'.$sr_admin_msg.get_text($member['mb_nick']).'님 로그인 중 ';
    echo '<a href="'.G5_BBS_URL.'/logout.php">로그아웃</a></div>';
}
?>