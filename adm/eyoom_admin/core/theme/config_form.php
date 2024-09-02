<?php
/**
 * @file    /adm/eyoom_admin/core/theme/config_form.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999120";

auth_check_menu($auth, $sub_menu, "r");

if ($is_admin != 'super') alert('최고관리자만 접근 가능합니다.');

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");

/**
 * 보정된 eyoom_config 변수 선언
 */
$eyoom_config = $_eyoom;
unset($_eyoom);

/**
 * 폼 action url
 */
$action_url1 = G5_ADMIN_URL . "/?dir=theme&amp;pid=config_form_update&amp;smode=1";

/**
 * 탭메뉴
 */
$pg_anchor = array(
    'anc_tcf_basic' => '기본설정',
    'anc_tcf_alias' => '별칭설정',
    'anc_tcf_func' => '기능설정',
    'anc_tcf_skin' => '스킨설정',
    'anc_tcf_layout' => '레이아웃설정',
    'anc_tcf_tag' => '태그설정',
);

/**
 * 스킨 디렉토리 읽어오기
 */
$skins['outlogin']  = get_skin_dir('outlogin', G5_PATH.'/theme/'.$this_theme.'/skin/');
$skins['connect']   = get_skin_dir('connect', G5_PATH.'/theme/'.$this_theme.'/skin/');
$skins['popular']   = get_skin_dir('popular', G5_PATH.'/theme/'.$this_theme.'/skin/');
$skins['poll']      = get_skin_dir('poll', G5_PATH.'/theme/'.$this_theme.'/skin/');
$skins['visit']     = get_skin_dir('visit', G5_PATH.'/theme/'.$this_theme.'/skin/');
$skins['new']       = get_skin_dir('new', G5_PATH.'/theme/'.$this_theme.'/skin/');
$skins['member']    = get_skin_dir('member', G5_PATH.'/theme/'.$this_theme.'/skin/');
$skins['faq']       = get_skin_dir('faq', G5_PATH.'/theme/'.$this_theme.'/skin/');
$skins['qa']        = get_skin_dir('qa', G5_PATH.'/theme/'.$this_theme.'/skin/');
$skins['search']    = get_skin_dir('search', G5_PATH.'/theme/'.$this_theme.'/skin/');
$skins['shop']      = get_skin_dir('shop', G5_PATH.'/theme/'.$this_theme.'/skin/');
$skins['newwin']    = get_skin_dir('newwin', G5_PATH.'/theme/'.$this_theme.'/skin/');
$skins['mypage']    = get_skin_dir('mypage', G5_PATH.'/theme/'.$this_theme.'/skin/');
$skins['signature'] = get_skin_dir('signature', G5_PATH.'/theme/'.$this_theme.'/skin/');
$skins['respond']   = get_skin_dir('respond', G5_PATH.'/theme/'.$this_theme.'/skin/');
$skins['push']      = get_skin_dir('push', G5_PATH.'/theme/'.$this_theme.'/skin/');
$skins['tag']       = get_skin_dir('tagmenu', G5_PATH.'/theme/'.$this_theme.'/skin/');
$skins['ranking']   = get_skin_dir('ranking', G5_PATH.'/theme/'.$this_theme.'/skin/');
$skins['bbspoll']   = get_skin_dir('bbspoll', G5_PATH.'/theme/'.$this_theme.'/skin/');

/**
 * 아이콘 폴더
 */
$icons['gnuboard']  = get_skin_dir('gnuboard', G5_PATH.'/theme/'.$this_theme.'/image/level_icon');
$icons['eyoom']     = get_skin_dir('eyoom', G5_PATH.'/theme/'.$this_theme.'/image/level_icon');

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= ' <a href="' . G5_URL . '" class="btn-e btn-e-lg btn-e-dark">메인으로</a> ';
$frm_submit .= '</div>';