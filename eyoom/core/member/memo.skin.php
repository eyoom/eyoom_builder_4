<?php
/**
 * core file : /eyoom/core/member/memo.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 페이징
 */
$paging = $eb->set_paging('memo', '', 'kind='.$kind.$qstr);

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/member/memo.skin.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['member'].'/memo.skin.html.php');