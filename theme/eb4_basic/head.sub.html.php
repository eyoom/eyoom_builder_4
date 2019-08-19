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
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes">
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
if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때
    add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/bootstrap/css/bootstrap.min.css?ver='.G5_CSS_VER.'">',0);
} else if ($eyoom['is_responsive'] == '0' && !G5_IS_MOBILE) { // 비반응형이면서 PC버전일때
    add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/bootstrap/css/bootstrap-nr.min.css?ver='.G5_CSS_VER.'">',0);
}

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/fontawesome5/css/fontawesome-all.min.css?ver='.G5_CSS_VER.'">',0);

if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때
    add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/eyoom-form/css/eyoom-form.min.css?ver='.G5_CSS_VER.'">',0);
    add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/common.css?ver='.G5_CSS_VER.'">',0);
} else if ($eyoom['is_responsive'] == '0' && !G5_IS_MOBILE) { // 비반응형이면서 PC버전일때
    add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/eyoom-form/css/eyoom-form-nr.min.css?ver='.G5_CSS_VER.'">',0);
    add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/common-nr.css?ver='.G5_CSS_VER.'">',0);
}
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
</script>
<script src="<?php echo G5_JS_URL ?>/jquery-1.8.3.min.js"></script>
<?php if (defined('_SHOP_')) { if (!G5_IS_MOBILE) { ?>
<script src="<?php echo G5_JS_URL ?>/jquery.shop.menu.js?ver=<?php echo G5_JS_VER; ?>"></script>
<?php }} else { ?>
<script src="<?php echo G5_JS_URL ?>/jquery.menu.js?ver=<?php echo G5_JS_VER; ?>"></script>
<?php } ?>
<script src="<?php echo G5_JS_URL ?>/common.js?ver=<?php echo G5_JS_VER; ?>"></script>
<script src="<?php echo G5_JS_URL ?>/wrest.js?ver=<?php echo G5_JS_VER; ?>"></script>
<?php if (G5_IS_MOBILE) { ?>
<script src="<?php echo G5_JS_URL ?>/modernizr.custom.70111.js"></script>
<?php } ?>
<?php
if (!defined('G5_IS_ADMIN')) echo $config['cf_add_script'];
?>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/jquery.bootstrap-hover-dropdown.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sidebar/jquery.sidebar.min.js"></script>
<!--[if lt IE 9]>
    <script src="<?php echo EYOOM_THEME_URL; ?>/plugins/respond.min.js"></script>
    <script src="<?php echo EYOOM_THEME_URL; ?>/plugins/eyoom-form/js/eyoom-form-ie8.js"></script>
<![endif]-->
</head>
<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?>>