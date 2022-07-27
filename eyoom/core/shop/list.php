<?php
/**
 * core file : /eyoom/core/shop/list.php
 */
if (!defined('_EYOOM_')) exit;

// 상품 리스트에서 다른 필드로 정렬을 하려면 아래의 배열 코드에서 해당 필드를 추가하세요.
if( isset($sort) && ! in_array($sort, array('it_name', 'it_sum_qty', 'it_price', 'it_use_avg', 'it_use_cnt', 'it_update_time')) ){
    $sort='';
}

/**
 * 분류 체크
 */
$sql = " select * from {$g5['g5_shop_category_table']} where ca_id = '$ca_id' and ca_use = '1'  ";
$ca = sql_fetch($sql);
if (!$ca['ca_id'])
    alert('등록된 분류가 없습니다.');

/**
 * 본인인증, 성인인증체크
 */
if(!$is_admin && $config['cf_cert_use']) {
    $msg = shop_member_cert_check($ca_id, 'list');
    if($msg)
        alert($msg, G5_SHOP_URL);
}

/**
 * 타이틀
 */
$g5['title'] = $ca['ca_name'].' 상품리스트';

/**
 * 상단 디자인 출력
 */
if ($ca['ca_include_head'] && is_include_path_check($ca['ca_include_head']))
    @include_once($ca['ca_include_head']);
else
    include_once(G5_SHOP_PATH.'/_head.php');

/**
 * 스킨 경로
 */
$skin_dir = EYOOM_CORE_PATH.'/'. G5_SHOP_DIR;

/**
 * 네비게이션 스킨
 */
$nav_skin = $skin_dir.'/navigation.skin.php';
if(!is_file($nav_skin)) $nav_skin = G5_SHOP_SKIN_PATH.'/navigation.skin.php';

/**
 * 카테고리 스킨
 */
$cate_skin = $skin_dir.'/listcategory.skin.php';
if(!is_file($cate_skin)) $cate_skin = G5_SHOP_SKIN_PATH.'/listcategory.skin.php';

/**
 * 상품 출력순서가 있다면
 */
if ($sort != "")
    $order_by = $sort.' '.$sortodr.' , it_order, it_id desc';
else
    $order_by = 'it_order, it_id desc';

/**
 * 리스트 스킨
 */
$skin_file = is_include_path_check($skin_dir.'/'.$ca['ca_skin']) ? $skin_dir.'/'.$ca['ca_skin'] : $skin_dir.'/list.10.skin.php';

if (file_exists($skin_file)) {
    /**
     * 정렬 스킨
     */
    $sort_skin = $skin_dir.'/list.sort.skin.php';
    if(!is_file($sort_skin)) $sort_skin = G5_SHOP_SKIN_PATH.'/list.sort.skin.php';

    /**
     * 상품보기 타입 변경
     */
    $sub_skin = $skin_dir.'/list.sub.skin.php';
    if(!is_file($sub_skin)) $sub_skin = G5_SHOP_SKIN_PATH.'/list.sub.skin.php';

    /**
     * 총몇개 = 한줄에 몇개 * 몇줄
     */
    $items = $ca['ca_list_mod'] * $ca['ca_list_row'];

    /**
     * 페이지가 없으면 첫 페이지 (1 페이지)
     */
    if ($page < 1) $page = 1;

    /**
     * 시작 레코드 구함
     */
    $from_record = ($page - 1) * $items;

    /**
     * 상품 리스트 정보
     */
    $list = new item_list($skin_file, $ca['ca_list_mod'], $ca['ca_list_row'], $ca['ca_img_width'], $ca['ca_img_height']);
    $list->set_category($ca['ca_id'], 1);
    $list->set_category($ca['ca_id'], 2);
    $list->set_category($ca['ca_id'], 3);
    $list->set_is_page(true);
    $list->set_order_by($order_by);
    $list->set_from_record($from_record);
    $list->set_view('it_img', true);
    $list->set_view('it_id', false);
    $list->set_view('it_name', true);
    $list->set_view('it_basic', true);
    $list->set_view('it_cust_price', true);
    $list->set_view('it_price', true);
    $list->set_view('it_icon', true);
    $list->set_view('sns', true);
    $item_list = $list->run();

    /**
     * where 된 전체 상품수
     */
    $total_count = $list->total_count;

    /**
     * 전체 페이지 계산
     */
    $total_page  = ceil($total_count / $items);
}

/**
 * 페이징
 */
//$qstr1 .= 'ca_id='.$ca_id;
$qstr1 .='&amp;sort='.$sort.'&amp;sortodr='.$sortodr;
$paging = $eb->set_paging('itemlist', $ca_id, $qstr1);

/**
 * 이윰 테마파일 출력
 */
include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/list.skin.html.php');

/**
 * 하단 디자인 출력
 */
if ($ca['ca_include_tail'] && is_include_path_check($ca['ca_include_tail']))
    @include_once($ca['ca_include_tail']);
else
    include_once(G5_SHOP_PATH.'/_tail.php');

echo "\n<!-- {$ca['ca_skin']} -->\n";
