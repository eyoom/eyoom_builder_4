<?php
/**
 * @file    /adm/eyoom_admin/core/shopetc/itemeventform.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

include_once(G5_EDITOR_LIB);

$sub_menu = "500300";

$action_url1 = G5_ADMIN_URL . '/?dir=shopetc&amp;pid=itemeventformupdate&smode=1';

auth_check_menu($auth, $sub_menu, "w");

$ev_id = isset($_REQUEST['ev_id']) ? preg_replace('/[^0-9]/', '', $_REQUEST['ev_id']) : '';
$ev = array(
    'ev_subject'=>'',
    'ev_subject_strong'=>'',
    'ev_id'=>'',
    'ev_head_html'=>'',
    'ev_tail_html'=>''
);

$res_item = null;

$html_title = "이벤트";
$g5['title'] = $html_title.' 관리';

$it_info = array();
if ($w == "u")
{
    $html_title .= " 수정";
    $readonly = " readonly";

    $sql = " select * from {$g5['g5_shop_event_table']} where ev_id = '$ev_id' ";
    $ev = sql_fetch($sql);
    if (! (isset($ev['ev_id']) && $ev['ev_id']))
        alert("등록된 자료가 없습니다.");

    // 등록된 이벤트 상품
    $sql = " select b.it_id, b.it_name
                from {$g5['g5_shop_event_item_table']} a left join {$g5['g5_shop_item_table']} b on ( a.it_id = b.it_id )
                where a.ev_id = '$ev_id' ";
    $res_item = sql_query($sql);
    for($i=0; $row=sql_fetch_array($res_item); $i++) {
        $it_info[$i] = $row;
        $it_info[$i]['image'] = get_it_image($row['it_id'], 50, 50);
    }
}
else
{
    $html_title .= " 입력";
    $ev['ev_skin'] = 'list.10.skin.php';
    $ev['ev_mobile_skin'] = 'list.10.skin.php';
    $ev['ev_use'] = 1;

    $ev['ev_img_width']  = 230;
    $ev['ev_img_height'] = 230;
    $ev['ev_list_mod'] = 3;
    $ev['ev_list_row'] = 5;
    $ev['ev_mobile_img_width']  = 230;
    $ev['ev_mobile_img_height'] = 230;
    $ev['ev_mobile_list_mod'] = 3;
    $ev['ev_mobile_list_row'] = 5;
}

// 분류리스트
$category = $shop->get_category();
$category = $shop->sort_category($category);

$cate_sel_option = array();
if (is_array($category)) {
    $i = 0;
    foreach ($category as $val) {
        if (isset($val['ca_id'])) {
            $ca_order = $val['ca_order'] . $i;
            $cate_sel_option[$ca_order] = array(
                'ca_id' => $val['ca_id'],
                'ca_use' => $val['ca_use'],
                'ca_name' => trim($val['ca_name']),
                'ca_stock_qty' => $val['ca_stock_qty'],
                'ca_sell_email' => $val['ca_sell_email'],
            );
            if (isset($val['children']) && is_array($val['children']) && !empty($val['children'])) {
                $cate_sel_option[$ca_order]['ca_sub'] = $shop->category_array_sort($val['children']);
            }
            $i++;
        }
    }
    ksort($cate_sel_option);
}

$category_select = '';
$category_output = $shop->get_category_select($cate_sel_option);
$category_select = $category_output['select'];

// 모바일 1줄당 이미지수 필드 추가
if(!sql_query(" select ev_mobile_list_row from {$g5['g5_shop_event_table']} limit 1 ", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_event_table']}`
                    ADD `ev_mobile_list_row` int(11) NOT NULL DEFAULT '0' AFTER `ev_mobile_list_mod` ", true);
}

$mimg_url = "";
$mimg = G5_DATA_PATH.'/event/'.$ev['ev_id'].'_m';
if (file_exists($mimg)) {
    $size = @getimagesize($mimg);
    if($size[0] && $size[0] > 750)
        $width = 750;
    else
        $width = $size[0];

    $mimg_url = G5_DATA_URL.'/event/'.$ev['ev_id'].'_m';
    $mimg_width = $width;
}

$himg_url = "";
$himg = G5_DATA_PATH.'/event/'.$ev['ev_id'].'_h';
if (file_exists($himg)) {
    $size = @getimagesize($himg);
    if($size[0] && $size[0] > 750)
        $width = 750;
    else
        $width = $size[0];

    $himg_url = G5_DATA_URL.'/event/'.$ev['ev_id'].'_h';
    $himg_width = $width;
}

$timg_url = "";
$timg = G5_DATA_PATH.'/event/'.$ev['ev_id'].'_t';
if (file_exists($timg)) {
    $size = @getimagesize($timg);
    if($size[0] && $size[0] > 750)
        $width = 750;
    else
        $width = $size[0];

    $timg_url = G5_DATA_URL.'/event/'.$ev['ev_id'].'_t';
    $timg_width = $width;
}

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= ' <a href="' . G5_ADMIN_URL . '/?dir=shopetc&pid=itemevent&' . $qstr . '" id="btn_list" class="btn-e btn-e-lg btn-e-dark">목록</a> ';
$frm_submit .= '</div>';