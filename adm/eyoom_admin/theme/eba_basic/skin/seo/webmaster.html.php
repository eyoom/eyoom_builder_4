<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/seo/webmaster.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'webmaster';
$g5_title = '웹마스터도구메뉴얼';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">검색엔진최적화</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';

$frm_eba_submit  = ' <div class="confirm-fixed-btn"> ';
$frm_eba_submit .= ' <input type="submit" value="적용하기" class="btn-e btn-e-md btn-e-crimson" accesskey="s">' ;
$frm_eba_submit .= '</div>';
$frm_submit .= $frm_eba_submit;
?>
