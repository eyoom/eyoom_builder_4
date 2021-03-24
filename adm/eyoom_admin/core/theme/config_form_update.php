<?php
/**
 * @file    /adm/eyoom_admin/core/theme/config_form_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999120";

check_demo();

auth_check_menu($auth, $sub_menu, "w");

check_admin_token();

unset($post_theme);
$post_theme         = isset($_POST['theme']) && $_POST['theme'] ? clean_xss_tags(trim($_POST['theme'])) : 'eb4_basic';
$post_tm_alias      = isset($_POST['tm_alias']) && $_POST['tm_alias'] ? clean_xss_tags(trim($_POST['tm_alias'])) : '';
$post_is_shop_theme = isset($_POST['is_shop_theme']) && $_POST['is_shop_theme'] ? clean_xss_tags(trim($_POST['is_shop_theme'])) : '';

/**
 * 테마 별칭 중복 체크
 */
if ($post_tm_alias) {
    $sql = "select count(*) as cnt from {$g5['eyoom_theme']} where tm_name != '{$post_theme}' and tm_alias = '{$post_tm_alias}' ";
    $info = sql_fetch($sql);
    if (isset($info) && $info['cnt'] > 0) {
        alert('입력하신 별칭은 이미 사용하고 있습니다. 다른 별칭을 입력해 주세요.');
    }
}

/**
 * 테마 별칭 업데이트
 */
$sql = "update {$g5['eyoom_theme']} set tm_alias = '{$post_tm_alias}', tm_last = '".G5_TIME_YMDHIS."' where tm_name = '{$post_theme}'";
sql_query($sql);   

/**
 * $eyoom 변수파일 재정의
 */
unset($eyoom);
$eyoom_config_file = !$_POST['theme'] ? G5_DATA_PATH . '/eyoom.config.php': G5_DATA_PATH . '/eyoom.'.$post_theme.'.config.php';
include($eyoom_config_file);

/**
 * 쇼핑몰 테마 체크
 */
if ($post_is_shop_theme == 'y') {
    $shop_theme_file = G5_PATH . '/theme/' . $post_theme . '/shop/index.html.php';
    if (!file_exists($shop_theme_file)) {
        alert("현재 작업 테마는 쇼핑몰 스킨이 존재하지 않아 쇼핑몰 기능을 사용설정하실 수 없습니다.");
    }
}

/**
 * 예외 처리 변수
 */
$except = array('token', 'theme', 'shop_theme', 'tm_key', 'cm_key', 'cm_salt');
foreach ($_POST as $key => $val) {
    if (in_array($key, $except)) continue;
    $eyoom[$key] = $val;
}

/**
 * 설정정보 업데이트
 */
$qfile->save_file('eyoom', $eyoom_config_file, $eyoom);

alert('설정을 사용테마에 적용하였습니다.', G5_ADMIN_URL.'/?dir=theme&amp;pid=config_form');