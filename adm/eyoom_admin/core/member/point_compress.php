<?php
/**
 * @file    /adm/eyoom_admin/core/member/point_compress.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "200990";

if($is_admin != 'super') alert('최고관리자만 설정을 변경할 수 있습니다.');

$action_url1 = G5_ADMIN_URL."/?dir=member&amp;pid=point_compress_update&smode=1";

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= ' <a href="' . G5_URL . '" class="btn-e btn-e-lg btn-e-dark">메인으로</a> ';
$frm_submit .= '</div>';