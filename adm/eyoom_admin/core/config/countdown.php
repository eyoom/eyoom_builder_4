<?php
/**
 * @file    /adm/eyoom_admin/core/config/countdown.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "100990";

$action_url1 = G5_ADMIN_URL."/?dir=config&amp;pid=countdown_update&amp;smode=1";

/**
 * 공사중 설정파일
 */
$countdown_config_file = G5_DATA_PATH . '/eyoom.countdown.php';
if (file_exists($countdown_config_file) && !is_dir($countdown_config_file)) {
    include_once($countdown_config_file);
}

/**
 * 오픈 예정일
 */
if ($countdown['cd_use'] == 'y') {
    $open_date = $eb->mktime_countdown_date($countdown['cd_opendate']);
}

/**
 * 공사중 스킨
 */
$skins = get_skin_dir('countdown', EYOOM_THEME_PATH . '/skin/');

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= ' <a href="' . G5_URL . '" class="btn-e btn-e-lg btn-e-dark">메인으로</a> ';
$frm_submit .= '</div>';