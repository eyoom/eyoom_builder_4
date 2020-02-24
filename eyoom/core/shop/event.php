<?php
/**
 * core file : /eyoom/core/shop/event.php
 */
if (!defined('_EYOOM_')) exit;

$ev_id = (int) $ev_id;

// 상품 리스트에서 다른 필드로 정렬을 하려면 아래의 배열 코드에서 해당 필드를 추가하세요.
if( isset($sort) && ! in_array($sort, array('it_sum_qty', 'it_price', 'it_use_avg', 'it_use_cnt', 'it_update_time')) ){
    $sort='';
}

$sql = " select * from {$g5['g5_shop_event_table']}
          where ev_id = '$ev_id'
            and ev_use = 1 ";
$ev = sql_fetch($sql);

if (!$ev['ev_id'])
    alert('등록된 이벤트가 없습니다.');

$g5['title'] = $ev['ev_subject'];
include_once('./_head.php');

/**
 * 이벤트 헤더 이미지
 */
$himg = G5_DATA_PATH.'/event/'.$ev_id.'_h';

/**
 * 상품 출력순서가 있다면
 */
if ($sort != "")
    $order_by = $sort.' '.$sortodr.' , b.it_order, b.it_id desc';
else
    $order_by = 'b.it_order, b.it_id desc';

if ($skin) {
    $skin = preg_replace('#\.+(\/|\\\)#', '', $skin);
    $ev['ev_skin'] = $skin;
}

/**
 * 스킨 경로
 */
$skin_dir = EYOOM_CORE_PATH.'/'. G5_SHOP_DIR;

/**
 * 리스트 유형별로 출력
 */
$list_file = $skin_dir."/{$ev['ev_skin']}";

if (file_exists($list_file)) {
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
    $items = $ev['ev_list_mod'] * $ev['ev_list_row'];

    /**
     * 페이지가 없으면 첫 페이지 (1 페이지)
     */
    if ($page < 1) $page = 1;
    
    /**
     * 시작 레코드 구함
     */
    $from_record = ($page - 1) * $items;

    $list = new item_list($skin_dir.'/'.$ev['ev_skin'], $ev['ev_list_mod'], $ev['ev_list_row'], $ev['ev_img_width'], $ev['ev_img_height']);
    $list->set_event($ev['ev_id']);
    $list->set_is_page(true);
    $list->set_order_by($order_by);
    $list->set_from_record($from_record);
    $list->set_view('it_img', true);
    $list->set_view('it_id', false);
    $list->set_view('it_name', true);
    $list->set_view('it_cust_price', false);
    $list->set_view('it_price', true);
    $list->set_view('it_icon', true);
    $list->set_view('sns', true);
    $ev_list = $list->run();

    /**
     * where 된 전체 상품수
     */
    $total_count = $list->total_count;

    /**
     * 전체 페이지 계산
     */
    $total_page  = ceil($total_count / $items);
}

$qstr .= 'skin='.$skin.'&amp;ev_id='.$ev_id.'&amp;sort='.$sort.'&amp;sortodr='.$sortodr;
$paging = $eb->set_paging('event', '', $qstr);

/**
 * 이벤트 테일 이미지
 */
$timg = G5_DATA_PATH.'/event/'.$ev_id.'_t';

/**
 * 이윰 테마파일 출력
 */
include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/event.skin.html.php');

include_once('./_tail.php');