<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebgoods_itemform_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999500";

auth_check_menu($auth, $sub_menu, 'w');

check_demo();

$iw                     = isset($_POST['iw']) ? clean_xss_tags(trim($_POST['iw'])) : '';
$gi_theme               = isset($_POST['theme']) ? clean_xss_tags(trim($_POST['theme'])) : '';
$gi_no                  = isset($_POST['gi_no']) ? clean_xss_tags(trim($_POST['gi_no'])) : '';
$eg_code                = isset($_POST['eg_code']) ? clean_xss_tags(trim($_POST['eg_code'])) : '';
$gi_state               = isset($_POST['gi_state']) ? clean_xss_tags(trim($_POST['gi_state'])) : '';
$gi_sort                = isset($_POST['gi_sort']) ? clean_xss_tags(trim($_POST['gi_sort'])) : '';
$gi_title               = isset($_POST['gi_title']) ? clean_xss_tags(trim($_POST['gi_title'])) : '';
$gi_link                = isset($_POST['gi_link']) ? $eb->filter_url($_POST['gi_link']) : '';
$gi_target              = isset($_POST['gi_target']) ? clean_xss_tags(trim($_POST['gi_target'])) : '';
$gi_ca_id               = isset($_POST['gi_ca_id']) ? clean_xss_tags(trim($_POST['gi_ca_id'])) : '';
$gi_include             = isset($_POST['gi_include']) ? clean_xss_tags(trim($_POST['gi_include'])) : '';
$gi_exclude             = isset($_POST['gi_exclude']) ? clean_xss_tags(trim($_POST['gi_exclude'])) : '';
$gi_count               = isset($_POST['gi_count']) ? clean_xss_tags(trim($_POST['gi_count'])) : '';
$gi_view_level          = isset($_POST['gi_view_level']) ? clean_xss_tags(trim($_POST['gi_view_level'])) : '';
$gi_sortby              = isset($_POST['gi_sortby']) ? clean_xss_tags(trim($_POST['gi_sortby'])) : '';
$gi_view_img            = isset($_POST['gi_view_img']) ? clean_xss_tags(trim($_POST['gi_view_img'])) : '';
$gi_img_width           = isset($_POST['gi_img_width']) ? clean_xss_tags(trim($_POST['gi_img_width'])) : '';
$gi_img_height          = isset($_POST['gi_img_height']) ? clean_xss_tags(trim($_POST['gi_img_height'])) : '';
$gi_view_it_id          = isset($_POST['gi_view_it_id']) ? clean_xss_tags(trim($_POST['gi_view_it_id'])) : '';
$gi_view_it_name        = isset($_POST['gi_view_it_name']) ? clean_xss_tags(trim($_POST['gi_view_it_name'])) : '';
$gi_view_it_basic       = isset($_POST['gi_view_it_basic']) ? clean_xss_tags(trim($_POST['gi_view_it_basic'])) : '';
$gi_view_it_cust_price  = isset($_POST['gi_view_it_cust_price']) ? clean_xss_tags(trim($_POST['gi_view_it_cust_price'])) : '';
$gi_view_it_price       = isset($_POST['gi_view_it_price']) ? clean_xss_tags(trim($_POST['gi_view_it_price'])) : '';
$gi_view_it_icon        = isset($_POST['gi_view_it_icon']) ? clean_xss_tags(trim($_POST['gi_view_it_icon'])) : '';
$gi_view_sns            = isset($_POST['gi_view_sns']) ? clean_xss_tags(trim($_POST['gi_view_sns'])) : '';

/**
 * 제외 카테고리
 */
$ex_ca_id = array();
$ca_exclude = explode(',', $gi_exclude);
if (is_array($ca_exclude)) {
    foreach ($ca_exclude as $k => $ca_id) {
        $ex_ca_id[$k] = trim($ca_id);
    }
}

/**
 * 포함 카테고리
 */
$in_ca_id = array();
$ca_include = explode(',', $gi_include);
if (is_array($ca_include)) {
    foreach ($ca_include as $k => $ca_id) {
        $in_ca_id[$k] = trim($ca_id);
    }
}

/**
 * 대상 카테고리
 */
$gi_ca_ids = array();
$gi_ca_ids = array_diff($in_ca_id, $ex_ca_id);

/**
 * 단일 카테고리 설정 추가
 */
if ($gi_ca_id) {
    $gi_ca_ids[] = $gi_ca_id;
}

/**
 * 상품 카테고리 대상은 유니크해야 함
 */
$gi_ca_ids = array_unique($gi_ca_ids);

/**
 * 최신글 대상 게시판 테이블
 */
$gi_ca_ids = implode(',', $gi_ca_ids);

$sql_common = "
    eg_code = '{$eg_code}',
    gi_theme = '{$gi_theme}',
    gi_state = '{$gi_state}',
    gi_sort = '{$gi_sort}',
    gi_title = '{$gi_title}',
    gi_link = '{$gi_link}',
    gi_target = '{$gi_target}',
    gi_ca_id = '{$gi_ca_id}',
    gi_ca_ids = '{$gi_ca_ids}',
    gi_include = '{$gi_include}',
    gi_exclude = '{$gi_exclude}',
    gi_count = '{$gi_count}',
    gi_view_level = '{$gi_view_level}',
    gi_sortby = '{$gi_sortby}',
    gi_view_img = '{$gi_view_img}',
    gi_img_width = '{$gi_img_width}',
    gi_img_height = '{$gi_img_height}',
    gi_view_it_id = '{$gi_view_it_id}',
    gi_view_it_name = '{$gi_view_it_name}',
    gi_view_it_basic = '{$gi_view_it_basic}',
    gi_view_it_cust_price = '{$gi_view_it_cust_price}',
    gi_view_it_price = '{$gi_view_it_price}',
    gi_view_it_icon = '{$gi_view_it_icon}',
    gi_view_sns = '{$gi_view_sns}',
";

if ($iw == '') {
    $sql = "insert into {$g5['eyoom_goods_item']} set {$sql_common} gi_regdt = '".G5_TIME_YMDHIS."'";
    sql_query($sql);
    $gi_no = sql_insert_id();
    $msg = "EB상품추출 아이템을 추가하였습니다.";

} else if ($iw == 'u') {
    $sql = " update {$g5['eyoom_goods_item']} set {$sql_common} gi_regdt=gi_regdt where gi_no = '{$gi_no}' ";
    sql_query($sql);
    $msg = "EB상품추출 아이템을 정상적으로 수정하였습니다.";

} else {
    alert('제대로 된 값이 넘어오지 않았습니다.');
}

/**
 * 설정된 정보를 파일로 저장 - 캐쉬 기능
 */
$thema->save_ebgoods_item($eg_code, $gi_theme);

/**
 * 모달창 닫고 리로드하기
 */
if ($wmode) {
    echo "<script>window.parent.close_modal_and_reload();</script>";
    exit;
}
