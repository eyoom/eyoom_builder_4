<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shop/bannerlist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'bannerlist';
$g5_title = '배너관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">쇼핑몰현황/기타</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="cont-text-bg">
    <p class="bg-info">
        <i class="fas fa-info-circle"></i> 배너관리는 이용하지 않습니다.<br>
        <i class="fas fa-info-circle"></i> 관리자 > 테마설정관리 > EB슬라이더관리(또는 EB배너관리)를 이용하시기 바랍니다.
    </p>
</div>