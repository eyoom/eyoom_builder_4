<?php
/**
 * @file    /adm/eyoom_admin/core/theme/biz_info_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999110";

check_demo();

auth_check_menu($auth, $sub_menu, "w");

check_admin_token();

/**
 * 작업테마
 */
$this_theme = isset($_POST['theme']) ? clean_xss_tags($_POST['theme']) : 'eb4_basic';

/**
 * 이미지 파일 업로드
 */
$is_img = true;

/**
 * 커뮤니티 상단 로고
 */
$top_logo = $bottom_logo = $top_mobile_logo = $bottom_mobile_logo = $top_shoplogo = $bottom_shoplogo = $top_mobile_shoplogo = $bottom_mobile_shoplogo = '';

if (isset($_FILES['top_logo']['name']) && $_FILES['top_logo']['name']) {
    $upfile = $upload->upload_file($_FILES['top_logo'], G5_DATA_PATH."/common", $is_img);
    $top_logo = $upfile['destfile'];
}

/**
 * 커뮤니티 하단 로고
 */
if (isset($_FILES['bottom_logo']['name']) && $_FILES['bottom_logo']['name']) {
    $upfile = $upload->upload_file($_FILES['bottom_logo'], G5_DATA_PATH."/common", $is_img);
    $bottom_logo = $upfile['destfile'];
}

/**
 * 커뮤니티 모바일 상단 로고
 */
if (isset($_FILES['top_mobile_logo']['name']) && $_FILES['top_mobile_logo']['name']) {
    $upfile = $upload->upload_file($_FILES['top_mobile_logo'], G5_DATA_PATH."/common", $is_img);
    $top_mobile_logo = $upfile['destfile'];
}

/**
 * 커뮤니티 모바일 하단 로고
 */
if (isset($_FILES['bottom_mobile_logo']['name']) && $_FILES['bottom_mobile_logo']['name']) {
    $upfile = $upload->upload_file($_FILES['bottom_mobile_logo'], G5_DATA_PATH."/common", $is_img);
    $bottom_mobile_logo = $upfile['destfile'];
}

/**
 * 쇼핑몰 상단 로고
 */
if (isset($_FILES['top_shoplogo']['name']) && $_FILES['top_shoplogo']['name']) {
    $upfile = $upload->upload_file($_FILES['top_shoplogo'], G5_DATA_PATH."/common", $is_img);
    $top_shoplogo = $upfile['destfile'];
}

/**
 * 쇼핑몰 하단 로고
 */
if (isset($_FILES['bottom_shoplogo']['name']) && $_FILES['bottom_shoplogo']['name']) {
    $upfile = $upload->upload_file($_FILES['bottom_shoplogo'], G5_DATA_PATH."/common", $is_img);
    $bottom_shoplogo = $upfile['destfile'];
}

/**
 * 쇼핑몰 모바일 상단 로고
 */
if (isset($_FILES['top_mobile_shoplogo']['name']) && $_FILES['top_mobile_shoplogo']['name']) {
    $upfile = $upload->upload_file($_FILES['top_mobile_shoplogo'], G5_DATA_PATH."/common", $is_img);
    $top_mobile_shoplogo = $upfile['destfile'];
}

/**
 * 커뮤니티 모바일 하단 로고
 */
if (isset($_FILES['bottom_mobile_shoplogo']['name']) && $_FILES['bottom_mobile_shoplogo']['name']) {
    $upfile = $upload->upload_file($_FILES['bottom_mobile_shoplogo'], G5_DATA_PATH."/common", $is_img);
    $bottom_mobile_shoplogo = $upfile['destfile'];
}

/**
 * 로고 파일 삭제
 */
if ((isset($_POST['top_logo_del']) && $_POST['top_logo_del']) || $top_logo)  @unlink(G5_DATA_PATH."/common/{$_POST['top_logo_del']}");
if ((isset($_POST['bottom_logo_del']) && $_POST['bottom_logo_del']) || $bottom_logo)  @unlink(G5_DATA_PATH."/common/{$_POST['bottom_logo_del']}");
if ((isset($_POST['top_mobile_logo_del']) && $_POST['top_mobile_logo_del']) || $top_mobile_logo)  @unlink(G5_DATA_PATH."/common/{$_POST['top_mobile_logo_del']}");
if ((isset($_POST['bottom_mobile_logo_del']) && $_POST['bottom_mobile_logo_del']) || $bottom_mobile_logo)  @unlink(G5_DATA_PATH."/common/{$_POST['bottom_lmobile_logo_del']}");
if ((isset($_POST['top_shoplogo_del']) && $_POST['top_shoplogo_del']) || $top_shoplogo)  @unlink(G5_DATA_PATH."/common/{$_POST['top_shoplogo_del']}");
if ((isset($_POST['bottom_shoplogo_del']) && $_POST['bottom_shoplogo_del']) || $bottom_shoplogo)  @unlink(G5_DATA_PATH."/common/{$_POST['bottom_shoplogo_del']}");
if ((isset($_POST['top_mobile_shoplogo_del']) && $_POST['top_mobile_shoplogo_del']) || $top_mobile_shoplogo)  @unlink(G5_DATA_PATH."/common/{$_POST['top_mobile_shoplogo_del']}");
if ((isset($_POST['bottom_mobile_shoplogo_del']) && $_POST['bottom_mobile_shoplogo_del']) || $bottom_mobile_shoplogo)  @unlink(G5_DATA_PATH."/common/{$_POST['bottom_lmobile_shoplogo_del']}");

/**
 * 테마의 기업정보 설정 파일
 */
$bizinfo_config_file = G5_DATA_PATH . '/bizinfo/bizinfo.'.$this_theme.'.config.php';

/**
 * 예외 POST 변수
 */
$except = array('token','theme','wmode','amode');

/**
 * POST 변수처리
 */
foreach ($_POST as $key => $val) {
    if (in_array($key, $except)) continue;
    $bizinfo[$key] = $val;
}

/**
 * 로고 이미지
 */
if ($top_logo) $bizinfo['bi_top_logo'] = $top_logo;
if ($bottom_logo) $bizinfo['bi_bottom_logo'] = $bottom_logo;
if ($top_mobile_logo) $bizinfo['bi_top_mobile_logo'] = $top_mobile_logo;
if ($bottom_mobile_logo) $bizinfo['bi_bottom_mobile_logo'] = $bottom_mobile_logo;
if ($top_shoplogo) $bizinfo['bi_top_shoplogo'] = $top_shoplogo;
if ($bottom_shoplogo) $bizinfo['bi_bottom_shoplogo'] = $bottom_shoplogo;
if ($top_mobile_shoplogo) $bizinfo['bi_top_mobile_shoplogo'] = $top_mobile_shoplogo;
if ($bottom_mobile_shoplogo) $bizinfo['bi_bottom_mobile_shoplogo'] = $bottom_mobile_shoplogo;

/**
 * 설정파일 저장
 */
$qfile->save_file('bizinfo', $bizinfo_config_file, $bizinfo);

$qstr = '';
$qstr .= "&amp;amode={$amode}";
$qstr .= "&amp;wmode={$wmode}";

alert("기본정보를 적용하였습니다.", G5_ADMIN_URL. '/?dir=theme&amp;pid=biz_info&amp;'.$qstr);