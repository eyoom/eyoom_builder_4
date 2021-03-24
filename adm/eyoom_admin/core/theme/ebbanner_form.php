<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebbanner_form.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999630";

include_once(G5_EDITOR_LIB);

auth_check_menu($auth, $sub_menu, 'w');

$action_url1 = G5_ADMIN_URL . '/?dir=theme&amp;pid=ebbanner_form_update&amp;smode=1';

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");

$bn_code = clean_xss_tags(trim($_GET['bn_code']));

/**
 * EB컨텐츠 마스터 정보
 */
$bn = sql_fetch("select * from {$g5['eyoom_banner']} where bn_code = '{$bn_code}' and bn_theme='{$this_theme}'");

/**
 * EB컨텐츠 아이템 정보 가져오기
 */
if ($w == 'u') {

}

if ($w == '') {
    $info = sql_fetch("select max(bn_sort) as max from {$g5['eyoom_banner']} where bn_code = '{$bn_code}' ");
    $bn_max_sort = $info['max'] + 1;
}

/**
 * 버튼셋
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= '</div>';