<?php
/**
 * @file    /adm/eyoom_admin/core/shopetc/bannerform.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "500500";

$action_url1 = G5_ADMIN_URL . '/?dir=shopetc&amp;pid=bannerformupdate&amp;smode=1';

auth_check_menu($auth, $sub_menu, "w");

$bn_id = isset($_REQUEST['bn_id']) ? preg_replace('/[^0-9]/', '', $_REQUEST['bn_id']) : 0;
$bn = array(
    'bn_id'=>0,
    'bn_alt'=>'',
    'bn_device'=>'',
    'bn_position'=>'',
    'bn_border'=>'',
    'bn_new_win'=>'',
    'bn_order'=>''
);

if ($w=="u")
{
    $html_title .= ' 수정';
    $sql = " select * from {$g5['g5_shop_banner_table']} where bn_id = '$bn_id' ";
    $bn = sql_fetch($sql);
}
else
{
    $html_title .= ' 입력';
    $bn['bn_url']        = "http://";
    $bn['bn_begin_time'] = date("Y-m-d 00:00:00", time());
    $bn['bn_end_time']   = date("Y-m-d 00:00:00", time()+(60*60*24*31));
}

// 접속기기 필드 추가
if(!sql_query(" select bn_device from {$g5['g5_shop_banner_table']} limit 0, 1 ")) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_banner_table']}`
                    ADD `bn_device` varchar(10) not null default '' AFTER `bn_url` ", true);
    sql_query(" update {$g5['g5_shop_banner_table']} set bn_device = 'pc' ", true);
}

$bimg_url = "";
$bimg = G5_DATA_PATH."/banner/{$bn['bn_id']}";
if (file_exists($bimg) && !is_dir($bimg)) {
    $size = @getimagesize($bimg);
    if($size[0] && $size[0] > 750)
        $width = 750;
    else
        $width = $size[0];

    $bimg_url = G5_DATA_URL.'/banner/'.$bn['bn_id'];
    $bimg_width = $width;
}

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= ' <a href="' . G5_ADMIN_URL . '/?dir=shopetc&pid=bannerlist&' . $qstr . '" id="btn_list" class="btn-e btn-e-lg btn-e-dark">목록</a> ';
$frm_submit .= '</div>';