<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebgoods_itemform.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999500";

auth_check_menu($auth, $sub_menu, 'w');

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");

$action_url1 = G5_ADMIN_URL . '/?dir=theme&amp;pid=ebgoods_itemform_update&amp;smode=1';

$eg_code = isset($_GET['eg_code']) ? clean_xss_tags(trim($_GET['eg_code'])): '';
$gi_no = isset($_GET['gi_no']) ? clean_xss_tags(trim($_GET['gi_no'])): '';

/**
 * EB상품추출 아이템 정보 가져오기
 */
if ($iw == 'u') {
    $gi = sql_fetch("select * from {$g5['eyoom_goods_item']} where gi_no = '{$gi_no}' and gi_theme='{$this_theme}'");
    $eg_item = array();
    if (isset($gi) && is_array($gi)) {
        foreach($gi as $key => $value) {
            $eg_item[$key] = get_text(stripslashes($value));
        }

        $gi_file = G5_DATA_PATH.'/ebgoods/'.$gi['gi_theme'].'/'.$eg_item['gi_img'];
        if (file_exists($gi_file) && !is_dir($gi_file) && $eg_item['gi_img']) {
            $eg_item['gi_url'] = G5_DATA_URL.'/ebgoods/'.$gi['gi_theme'].'/'.$eg_item['gi_img'];
        }
    } else {
        alert('존재하지 않는 아이템입니다.');
    }
}

/**
 * 분류리스트
 */
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

/**
 * 전체 그룹 정보
 */
$gr_info = $eb->get_all_group_info();

if ($iw == '') {
    $info = sql_fetch("select max(gi_sort) as max from {$g5['eyoom_goods_item']} where eg_code = '{$eg_code}' ");
    $gi_max_sort = $info['max'] + 1;
}

/**
 * 버튼셋
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= '</div>';