<?php
/**
 * @file    /adm/eyoom_admin/core/shop/itemform.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400300";

/**
 * 폼 action URL
 */
$action_url1 = G5_ADMIN_URL . "/?dir=shop&amp;pid=itemformupdate&amp;smode=1";

include_once(G5_EDITOR_LIB);
include_once(G5_LIB_PATH.'/iteminfo.lib.php');

auth_check_menu($auth, $sub_menu, "w");

$html_title = "상품 ";

$it = array(
    'it_id'=>'',
    'it_skin'=>'',
    'it_mobile_skin'=>'',
    'it_name'=>'',
    'it_basic'=>'',
    'it_order'=>0,
    'it_type1'=>0,
    'it_type2'=>0,
    'it_type3'=>0,
    'it_type4'=>0,
    'it_type5'=>0,
    'it_brand'=>'',
    'it_model'=>'',
    'it_tel_inq'=>0,
    'it_use'=>0,
    'it_nocoupon'=>0,
    'ec_mall_pid'=>'',
    'it_mobile_explan'=>'',
    'it_sell_email'=>'',
    'it_shop_memo'=>'',
    'it_info_gubun'=>'',
    'it_explan'=>'',
    'it_point_type'=>0,
    'it_cust_price'=>0,
    'it_option_subject'=>'',
    'it_price'=>0,
    'it_point'=>0,
    'it_supply_point'=>0,
    'it_soldout'=>0,
    'it_stock_sms'=>0,
    'it_stock_qty'=>0,
    'it_noti_qty'=>0,
    'it_buy_min_qty'=>0,
    'it_buy_max_qty'=>0,
    'it_notax'=>0,
    'it_supply_subject'=>'',
    'it_sc_type'=>0,
    'it_sc_method'=>0,
    'it_sc_price'=>0,
    'it_sc_minimum'=>0,
    'it_sc_qty'=>0,
    'it_img1'=>'',
    'it_img2'=>'',
    'it_img3'=>'',
    'it_img4'=>'',
    'it_img5'=>'',
    'it_img6'=>'',
    'it_img7'=>'',
    'it_img8'=>'',
    'it_img9'=>'',
    'it_img10'=>'',
    'it_head_html'=>'',
    'it_tail_html'=>'',
    'it_mobile_head_html'=>'',
    'it_mobile_tail_html'=>'',
);

for($i=0;$i<=10;$i++){
    $it['it_'.$i.'_subj'] = '';
    $it['it_'.$i] = '';
}

if ($w == "")
{
    $html_title .= "입력";

    // 옵션은 쿠키에 저장된 값을 보여줌. 다음 입력을 위한것임
    //$it[ca_id] = _COOKIE[ck_ca_id];
    $it['ca_id'] = get_cookie("ck_ca_id");
    $it['ca_id2'] = get_cookie("ck_ca_id2");
    $it['ca_id3'] = get_cookie("ck_ca_id3");
    if (!$it['ca_id'])
    {
        $sql = " select ca_id from {$g5['g5_shop_category_table']} order by ca_order, ca_id limit 1 ";
        $row = sql_fetch($sql);
        if (! (isset($row['ca_id']) && $row['ca_id']))
            alert("등록된 분류가 없습니다. 우선 분류를 등록하여 주십시오.", G5_ADMIN_URL.'/?dir=shop&amp;pid=categorylist');
        $it['ca_id'] = $row['ca_id'];
    }
    //$it[it_maker]  = stripslashes($_COOKIE[ck_maker]);
    //$it[it_origin] = stripslashes($_COOKIE[ck_origin]);
    $it['it_maker']  = stripslashes(get_cookie("ck_maker"));
    $it['it_origin'] = stripslashes(get_cookie("ck_origin"));
}
else if ($w == "u")
{
    $html_title .= "수정";

    if ($is_admin != 'super')
    {
        $sql = " select it_id from {$g5['g5_shop_item_table']} a, {$g5['g5_shop_category_table']} b
                  where a.it_id = '$it_id'
                    and a.ca_id = b.ca_id
                    and b.ca_mb_id = '{$member['mb_id']}' ";
        $row = sql_fetch($sql);
        if (!$row['it_id'])
            alert("\'{$member['mb_id']}\' 님께서 수정 할 권한이 없는 상품입니다.");
    }

    $it = get_shop_item($it_id);

    if(!$it)
        alert('상품정보가 존재하지 않습니다.');

    if (function_exists('check_case_exist_title')) check_case_exist_title($it, G5_SHOP_DIR, false);

    if (! (isset($ca_id) && $ca_id))
        $ca_id = $it['ca_id'];

    $sql = " select * from {$g5['g5_shop_category_table']} where ca_id = '$ca_id' ";
    $ca = sql_fetch($sql);
}
else
{
    alert();
}

$cate_a = isset($_GET['cate_a']) ? clean_xss_tags(trim($_GET['cate_a'])) : '';
$cate_b = isset($_GET['cate_b']) ? clean_xss_tags(trim($_GET['cate_b'])) : '';
$cate_c = isset($_GET['cate_c']) ? clean_xss_tags(trim($_GET['cate_c'])) : '';

$sdt = isset($_GET['sdt']) ? clean_xss_tags(trim($_GET['sdt'])) : '';
$fr_date = isset($_GET['fr_date']) ? trim($_GET['fr_date']) : '';
$to_date = isset($_GET['to_date']) ? trim($_GET['to_date']) : '';
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $fr_date) ) $fr_date = '';
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $to_date) ) $to_date = '';
$ituse = isset($_GET['ituse']) ? (int) clean_xss_tags(trim($_GET['ituse'])) : '';
$itsoldout = isset($_GET['itsoldout']) ? (int) clean_xss_tags(trim($_GET['itsoldout'])) : '';
$itype = isset($_GET['itype']) ? (int) clean_xss_tags(trim($_GET['itype'])) : '';

$qstr  = $qstr.'&amp;sca='.$sca.'&amp;page='.$page;
if ($cate_a) $qstr .= "&amp;cate_a={$cate_a}";
if ($cate_a && $cate_b) $qstr .= "&amp;cate_b={$cate_b}";
if ($cate_a && $cate_b && $cate_c) $qstr .= "&amp;cate_c={$cate_c}";
if ($sdt) $qstr .= "&amp;sdt={$sdt}";
if ($fr_date) $qstr .= "&amp;fr_date={$fr_date}";
if ($to_date) $qstr .= "&amp;to_date={$to_date}";
if ($ituse) $qstr .= "&amp;ituse={$ituse}";
if ($itsoldout) $qstr .= "&amp;itsoldout={$itsoldout}";
if ($itype) $qstr .= "&amp;itype={$itype}";

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
$script = $category_output['script'];

// 재입고알림 설정 필드 추가
if(!sql_query(" select it_stock_sms from {$g5['g5_shop_item_table']} limit 1 ", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_item_table']}`
                    ADD `it_stock_sms` tinyint(4) NOT NULL DEFAULT '0' AFTER `it_stock_qty` ", true);
}

// 추가옵션 포인트 설정 필드 추가
if(!sql_query(" select it_supply_point from {$g5['g5_shop_item_table']} limit 1 ", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_item_table']}`
                    ADD `it_supply_point` int(11) NOT NULL DEFAULT '0' AFTER `it_point_type` ", true);
}

// 상품메모 필드 추가
if(!sql_query(" select it_shop_memo from {$g5['g5_shop_item_table']} limit 1 ", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_item_table']}`
                    ADD `it_shop_memo` text NOT NULL AFTER `it_use_avg` ", true);
}

// 지식쇼핑 PID 필드추가
// 상품메모 필드 추가
if(!sql_query(" select ec_mall_pid from {$g5['g5_shop_item_table']} limit 1 ", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_item_table']}`
                    ADD `ec_mall_pid` varchar(255) NOT NULL AFTER `it_shop_memo` ", true);
}

/**
 * 탭메뉴
 */
$pg_anchor = array(
    'anc_sitfrm_cate' => '상품분류',
    'anc_sitfrm_skin' => '스킨설정',
    'anc_sitfrm_ini' => '기본정보',
    'anc_sitfrm_compact' => '요약정보',
    'anc_sitfrm_cost' => '가격 및 재고',
    'anc_sitfrm_sendcost' => '배송비',
    'anc_sitfrm_img' => '상품이미지',
    'anc_sitfrm_relation' => '관련상품',
    'anc_sitfrm_event' => '관련이벤트',
    'anc_sitfrm_optional' => '상세설명설정',
    'anc_sitfrm_extra' => '여분필드',
);

// 쿠폰적용안함 설정 필드 추가
if(!sql_query(" select it_nocoupon from {$g5['g5_shop_item_table']} limit 1", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_item_table']}`
                    ADD `it_nocoupon` tinyint(4) NOT NULL DEFAULT '0' AFTER `it_use` ", true);
}

// 스킨필드 추가
if(!sql_query(" select it_skin from {$g5['g5_shop_item_table']} limit 1", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_item_table']}`
                    ADD `it_skin` varchar(255) NOT NULL DEFAULT '' AFTER `ca_id3`,
                    ADD `it_mobile_skin` varchar(255) NOT NULL DEFAULT '' AFTER `it_skin` ", true);
}

/**
 * 상품정보제공고시 출력여부 설정 필드 추가 - 이윰빌더 기능으로 추가
 */
if(!sql_query(" select it_info_use from {$g5['g5_shop_item_table']} limit 1", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_item_table']}`
                    ADD `it_info_use` char(1) NOT NULL DEFAULT '1' AFTER `it_info_value` ", true);
}

/**
 * 브랜드 테이블이 존재한다면
 */
if(sql_query(" DESC {$g5['eyoom_brand']} ", false)) {
    if (!sql_query(" select it_brcode from {$g5['g5_shop_item_table']} limit 1", false)) {
        sql_query(" ALTER TABLE `{$g5['g5_shop_item_table']}`
        ADD `it_brcode` varchar(255) NOT NULL DEFAULT '' AFTER `it_brand` ", true);
    }

    $sql = "select * from {$g5['eyoom_brand']} where (1) order by br_name asc";
    $result = sql_query($sql);
    $brlist= array();
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $brlist[$i] = $row;
    }
    $br_cnt = count($brlist);
}

/**
 * 상품선택옵션
 */
$opt_subject = explode(',', $it['it_option_subject']);

/**
 * 상품추가옵션
 */
$spl_subject = explode(',', $it['it_supply_subject']);
$spl_count = count($spl_subject);

/**
 * 상품 이미지
 */
for($i=1; $i<=10; $i++) {
    $it_img = G5_DATA_PATH.'/item/'.$it['it_img'.$i];
    $it_img_exists = run_replace('shop_item_image_exists', (is_file($it_img) && file_exists($it_img)), $it, $i);
    if($it_img_exists) {
        $size = @getimagesize($it_img);
        $thumb = get_it_thumbnail($it['it_img'.$i], 300, 300);
        $gdimage[$i]['width'] = $size[0];
        $gdimage[$i]['height'] = $size[1];
        $gdimage[$i]['thumb'] = $thumb;
        $gdimage[$i]['img_name'] = $it['it_img'.$i];
    } else {
        $gdimage[$i]['width'] = '';
        $gdimage[$i]['height'] = '';
        $gdimage[$i]['thumb'] = '';
        $gdimage[$i]['img_name'] = '';
    }
}

/**
 * 선택된 관련상품 가져오기 - 관련상품 검색에서 사용
 */
$str = $rellist = array();
$sql = " select b.ca_id, b.it_id, b.it_name, b.it_price
           from {$g5['g5_shop_item_relation_table']} a
           left join {$g5['g5_shop_item_table']} b on (a.it_id2=b.it_id)
          where a.it_id = '$it_id'
          order by ir_no asc ";
$result = sql_query($sql);
for($g=0; $row=sql_fetch_array($result); $g++)
{
    $str[$g] = $row['it_id'];
    $rellist[$g] = $row;
    $rellist[$g]['image'] = get_it_image($row['it_id'], 50, 50);
}
$str = implode(",", $str);

/**
 * 등록된 이벤트 목록
 */
$sql = " select ev_id, ev_subject from {$g5['g5_shop_event_table']} order by ev_id desc ";
$result = sql_query($sql);
$evinfo = array();
for ($g=0; $row=sql_fetch_array($result); $g++) {
    $evinfo[$g] = $row;
}

/**
 * 선택된 이벤트
 */
$sql = " select b.ev_id, b.ev_subject
           from {$g5['g5_shop_event_item_table']} a
           left join {$g5['g5_shop_event_table']} b on (a.ev_id=b.ev_id)
          where a.it_id = '$it_id'
          order by b.ev_id desc ";
$result = sql_query($sql);
$reg_evinfo = $reg_ev_id = array();
for ($g=0; $row=sql_fetch_array($result); $g++) {
    $reg_evinfo[$g] = $row;
    $reg_ev_id[$g] = $row['ev_id'];
}
if (isset($reg_ev_id) && is_array($reg_ev_id)) {
    $reg_ev_ids = implode(',', $reg_ev_id);
}

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
if (!$wmode) {
    $frm_submit .= ' <a href="' . G5_ADMIN_URL . '/?dir=shop&pid=itemlist&' . $qstr . '" class="btn-e btn-e-lg btn-e-dark">목록</a> ';
    $frm_submit .= $w=='u' ? '<a href="' . shop_item_url($it_id) . '" class="btn-e btn-e-lg btn-e-dark">상품보기</a> ' : '';
}
$frm_submit .= '</div>';