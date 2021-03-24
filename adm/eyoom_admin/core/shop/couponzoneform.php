<?php
/**
 * @file    /adm/eyoom_admin/core/shop/couponzoneform.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400810";

/**
 * 폼 action URL
 */
$action_url1 = G5_ADMIN_URL . "/?dir=shop&amp;pid=couponzoneformupdate&amp;smode=1";

$cz_id = isset($_REQUEST['cz_id']) ? (int) $_REQUEST['cz_id'] : 0;
$cp = array(
    'cp_method'=>'',
    'cz_subject'=>'',
    'cp_target'=>'',
    'cp_price'=>'',
    'cp_trunc'=>'',
    'cp_type'=>'',
    'mb_id'=>'',
    'cz_type'=>'',
    'cz_point'=>'',
    'cp_price'=>'',
    'cz_file'=>'',
    'cp_minimum'=>'',
    'cp_maximum'=>'',
);

auth_check_menu($auth, $sub_menu, "w");

$g5['title'] = '쿠폰존 쿠폰관리';

if ($w == 'u') {
    $html_title = '쿠폰 수정';

    $sql = " select * from {$g5['g5_shop_coupon_zone_table']} where cz_id = '$cz_id' ";
    $cp = sql_fetch($sql);
    if (!$cp['cz_id']) alert('등록된 자료가 없습니다.');
}
else
{
    $html_title = '쿠폰 입력';
    $cp['cz_start'] = G5_TIME_YMD;
    $cp['cz_end'] = date('Y-m-d', (G5_SERVER_TIME + 86400 * 15));
    $cp['cz_period'] = 15;
}

if($cp['cp_method'] == 1) {
    $cp_target_label = '적용분류';
    $cp_target_btn = '분류검색';
} else {
    $cp_target_label = '적용상품';
    $cp_target_btn = '상품검색';
}

$cpimg_str = '';
$cpimg = G5_DATA_PATH."/coupon/{$cp['cz_file']}";
if (is_file($cpimg) && $cp['cz_id']) {
    $size = @getimagesize($cpimg);
    if($size[0] && $size[0] > 750)
        $width = 750;
    else
        $width = $size[0];
    $cpimg_str = true;
}

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= ' <a href="' . G5_ADMIN_URL . '/?dir=shop&pid=couponzonelist&' . $qstr . '" id="btn_list" class="btn-e btn-e-lg btn-e-dark">목록</a> ';
$frm_submit .= '</div>';