<?php
/**
 * core file : /eyoom/core/member/scrap.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 페이징
 */
$paging = $eb->set_paging('scrap', '', $qstr);

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/member/scrap.skin.php');

/**
 * HTML 출력
 */
include_once ($eyoom_skin_path['member'].'/scrap.skin.html.php');