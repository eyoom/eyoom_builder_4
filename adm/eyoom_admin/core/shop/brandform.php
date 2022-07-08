<?php
/**
 * @file    /adm/eyoom_admin/core/shop/brandform.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400350";

/**
 * 폼 action URL
 */
$action_url1 = G5_ADMIN_URL . "/?dir=shop&amp;pid=brandformupdate&amp;smode=1";

auth_check_menu($auth, $sub_menu, "w");

$html_title = "브랜드 ";

$br = array(
    'br_no'=>'',
    'br_code'=>'',
    'br_name'=>'',
    'br_basic'=>'',
    'br_sort'=>'',
    'br_open'=>'',
);

if ($w == "")
{
    $html_title .= "입력";
}
else if ($w == "u")
{
    $html_title .= "수정";
}
else
{
    alert();
}

$qstr  = $qstr.'&amp;sca='.$sca.'&amp;page='.$page;

$br_no = clean_xss_tags(trim($_GET['br_no']));
if ($br_no) {
    $br = sql_fetch("select * from {$g5['eyoom_brand']} where br_no = '{$br_no}' ");
    
    if ($br['br_img']) {
        $br['img_url'] = G5_DATA_URL.'/brand/'.$br['br_img'];
    }   
}

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= ' <a href="' . G5_ADMIN_URL . '/?dir=shop&pid=brandlist&' . $qstr . '" class="btn-e btn-e-lg btn-e-dark">목록</a> ';
$frm_submit .= '</div>';