<?php
/**
 * @file    /adm/eyoom_admin/core/cpannel/layout.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 최고관리자 이외 접근통제
 */
if ($is_admin != 'super') alert('최고관리자만 접근 가능합니다.');

/**
 * 폼 action url
 */
$action_url1 = G5_ADMIN_URL . "/?dir=theme&amp;pid=layout_update&amp;smode=1";

$theme = isset($_REQUEST['thema']) ? clean_xss_tags(trim($_REQUEST['thema'])) : 'eb4_basic';

/**
 * 스킨 디렉토리 읽어오기
 */
$skins['outlogin']  = get_skin_dir('outlogin', G5_PATH.'/theme/'.$theme.'/skin/');
$skins['popular']   = get_skin_dir('popular', G5_PATH.'/theme/'.$theme.'/skin/');
$skins['poll']      = get_skin_dir('poll', G5_PATH.'/theme/'.$theme.'/skin/');
$skins['visit']     = get_skin_dir('visit', G5_PATH.'/theme/'.$theme.'/skin/');
$skins['tag']       = get_skin_dir('tagmenu', G5_PATH.'/theme/'.$theme.'/skin/');
$skins['ranking']   = get_skin_dir('ranking', G5_PATH.'/theme/'.$theme.'/skin/');

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="적용하기" id="btn_submit" class="btn-e btn-e-xlg btn-e-red btn-e-block" accesskey="s">' ;
$frm_submit .= '</div>';