<?php
/**
 * core file : /eyoom/core/member/scrap_popin.skin.php
 */
if (!defined('_EYOOM_')) exit;

$subject = get_text(cut_str($write['wr_subject'], 255));

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/member/scrap_popin.skin.php');

/**
 * HTML 출력
 */
include_once ($eyoom_skin_path['member'].'/scrap_popin.skin.html.php');