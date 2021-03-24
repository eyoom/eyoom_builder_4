<?php
/**
 * @file    /adm/eyoom_admin/core/shop/couponform.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400800";

/**
 * 폼 action URL
 */
$action_url1 = G5_ADMIN_URL . "/?dir=shop&amp;pid=couponformupdate&amp;smode=1";

auth_check_menu($auth, $sub_menu, "w");

$cp_id = isset($_REQUEST['cp_id']) ? clean_xss_tags($_REQUEST['cp_id'], 1, 1) : '';
$cp = array(
    'cp_method'=>'',
    'cp_subject'=>'',
    'cp_target'=>'',
    'mb_id'=>'',
    'cp_type'=>'',
    'cp_price'=>'',
    'cp_trunc'=>'',
    'cp_minimum'=>'',
    'cp_maximum'=>'',
);

$html_title = '';
if ($w == 'u') {
    $html_title = '쿠폰 수정';

    $sql = " select * from {$g5['g5_shop_coupon_table']} where cp_id = '$cp_id' ";
    $cp = sql_fetch($sql);
    if (!$cp['cp_id']) alert('등록된 자료가 없습니다.');
}
else
{
    $html_title = '쿠폰 입력';
    $cp['cp_start'] = G5_TIME_YMD;
    $cp['cp_end'] = date('Y-m-d', (G5_SERVER_TIME + 86400 * 7));
}

if($cp['cp_method'] == 1) {
    $cp_target_label = '적용분류';
    $cp_target_btn = '분류검색';
} else {
    $cp_target_label = '적용상품';
    $cp_target_btn = '상품검색';
}

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= ' <a href="' . G5_ADMIN_URL . '/?dir=shop&pid=couponlist&' . $qstr . '" id="btn_list" class="btn-e btn-e-lg btn-e-dark">목록</a> ';
$frm_submit .= '</div>';