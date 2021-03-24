<?php
/**
 * core file : /eyoom/core/signature/signature.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원이 작성한 최신글
 */
$mb_write = $bbs->get_member_latest($view['mb_id'], 8, false);
$mb_write_cnt = count((array)$mb_write);

/**
 * 회원이 작성한 최신 댓글
 */
$mb_cmt = $bbs->get_member_latest($view['mb_id'], 8, true);
$mb_cmt_cnt = count((array)$mb_cmt);

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/signature/signature.skin.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['signature'].'/signature.skin.html.php');