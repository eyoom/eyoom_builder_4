<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/member/visit_graph.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/c3/c3.min.css" type="text/css" media="screen">',0);

$fm_pid = 'visit_list';
$g5_title = '접속자집계';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">회원관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';

$g5_subtitle = '접속자별 그래프보기';
?>

<div class="admin-visit-list">
    <?php include_once(EYOOM_ADMIN_THEME_PATH . '/skin/member/visit.sub.html.php'); ?>

    <div class="text-center m-t-50 m-b-50">
        <p class="text-gray"><i class="fas fa-exclamation-circle m-r-7"></i>지원 예정입니다.</p>
    </div>
</div>