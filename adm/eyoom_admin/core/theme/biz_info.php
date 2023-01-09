<?php
/**
 * @file    /adm/eyoom_admin/core/theme/biz_info.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999110";

auth_check_menu($auth, $sub_menu, "r");

if ($is_admin != 'super') alert('최고관리자만 접근 가능합니다.');

/**
 * 우편번호 검색 라이브러리
 */
add_javascript(G5_POSTCODE_JS, 0);

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");

/**
 * 폼 action url
 */
$action_url1 = G5_ADMIN_URL . "/?dir=theme&amp;pid=biz_info_update&amp;smode=1";

/**
 * 작업중인 테마의 기업정보 가져오기
 */
$bizinfo_config = G5_DATA_PATH . '/bizinfo/bizinfo.'.$this_theme.'.config.php';
unset($bizinfo);
if (file_exists($bizinfo_config) && !is_dir($bizinfo_config)) {
    @include($bizinfo_config);
} else {
    $bizinfo = $thema->default_bizinfo();
}

/**
 * 탭메뉴
 */
$pg_anchor = array(
    'anc_tcf_biz' => '사업자정보',
    'anc_tcf_cscenter' => '고객센터',
    'anc_tcf_logo' => '로고설정',
);

/**
 * 로고 파일
 */
$top_logo = isset($bizinfo['bi_top_logo']) && $bizinfo['bi_top_logo'] ? G5_DATA_PATH."/common/{$bizinfo['bi_top_logo']}" : '';
$bottom_logo = isset($bizinfo['bi_bottom_logo']) && $bizinfo['bi_bottom_logo'] ? G5_DATA_PATH."/common/{$bizinfo['bi_bottom_logo']}" : '';
$top_mobile_logo = isset($bizinfo['bi_top_mobile_logo']) && $bizinfo['bi_top_mobile_logo'] ? G5_DATA_PATH."/common/{$bizinfo['bi_top_mobile_logo']}" : '';
$bottom_mobile_logo = isset($bizinfo['bi_bottom_mobile_logo']) && $bizinfo['bi_bottom_mobile_logo'] ? G5_DATA_PATH."/common/{$bizinfo['bi_bottom_mobile_logo']}" : '';
$top_shoplogo = isset($bizinfo['bi_top_shoplogo']) && $bizinfo['bi_top_shoplogo'] ? G5_DATA_PATH."/common/{$bizinfo['bi_top_shoplogo']}" : '';
$bottom_shoplogo = isset($bizinfo['bi_bottom_shoplogo']) && $bizinfo['bi_bottom_shoplogo'] ? G5_DATA_PATH."/common/{$bizinfo['bi_bottom_shoplogo']}" : '';
$top_mobile_shoplogo = isset($bizinfo['bi_top_mobile_shoplogo']) && $bizinfo['bi_top_mobile_shoplogo'] ? G5_DATA_PATH."/common/{$bizinfo['bi_top_mobile_shoplogo']}" : '';
$bottom_mobile_shoplogo = isset($bizinfo['bi_bottom_mobile_shoplogo']) && $bizinfo['bi_bottom_mobile_shoplogo'] ? G5_DATA_PATH."/common/{$bizinfo['bi_bottom_mobile_shoplogo']}" : '';

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= !$wmode ? ' <a href="' . G5_URL . '" class="btn-e btn-e-lg btn-e-dark">메인으로</a> ':'';
$frm_submit .= '</div>';