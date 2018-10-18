<?php
/**
 * @file    /adm/eyoom_admin/core/theme/theme_form.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999100";

/**
 * action url
 */
$action_url1 = G5_ADMIN_URL . '/?dir=theme&amp;pid=theme_form_update&amp;smode=1';

/**
 * 설치하고자 하는 테마명
 */
$theme_name = clean_xss_tags(trim($_GET['thema']));

/**
 * 홈페이지 주소
 */
$hostname = $eb->eyoom_host();

/**
 * submit 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="설치하기" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= '</div>';