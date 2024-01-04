<?php
/**
 * core file : /eyoom/core/shop/item.php
 */
if (!defined('_EYOOM_')) exit;

$it_id = get_search_string(trim($_GET['it_id']));
$it_seo_title = isset($it_seo_title) ? $it_seo_title : '';

$it = get_shop_item_with_category($it_id, $it_seo_title);
$it_id = $_REQUEST['it_id'] = $it['it_id'];

if( isset($row['it_seo_title']) && ! $row['it_seo_title'] ){
    shop_seo_title_update($row['it_id']);
}

if (function_exists('check_case_exist_title')) check_case_exist_title($it, G5_SHOP_DIR, true);

/**
 * 분류사용, 상품사용하는 상품의 정보를 얻음
 */
$sql = " select a.*, b.ca_name, b.ca_use from {$g5['g5_shop_item_table']} a, {$g5['g5_shop_category_table']} b where a.it_id = '" . sql_real_escape_string($it_id) . "' and a.ca_id = b.ca_id ";
$it = sql_fetch($sql);
if (!$it['it_id'])
    alert('자료가 없습니다.');
if (!($it['ca_use'] && $it['it_use'])) {
    if (!$is_admin)
        alert('현재 판매가능한 상품이 아닙니다.');
}

$it['it_basic'] = conv_content($it['it_basic'], 1);

include_once(G5_LIB_PATH.'/iteminfo.lib.php');

/**
 * 분류 테이블에서 분류 상단, 하단 코드를 얻음
 */
$sql = " select ca_id, ca_skin_dir, ca_include_head, ca_include_tail, ca_cert_use, ca_adult_use from {$g5['g5_shop_category_table']} where ca_id = '{$it['ca_id']}' ";
$ca = sql_fetch($sql);

/**
 * 본인인증, 성인인증체크
 */
if(!$is_admin) {
    $msg = shop_member_cert_check($it_id, 'item');
    if($msg)
        alert($msg, G5_SHOP_URL);
}

/**
 * 오늘 본 상품 저장 시작
 * tv 는 today view 약자
 */
$saved = false;
$tv_idx = (int)get_session("ss_tv_idx");
if ($tv_idx > 0) {
    for ($i=1; $i<=$tv_idx; $i++) {
        if (get_session("ss_tv[$i]") == $it_id) {
            $saved = true;
            break;
        }
    }
}

if (!$saved) {
    $tv_idx++;
    set_session("ss_tv_idx", $tv_idx);
    set_session("ss_tv[$tv_idx]", $it_id);
}

/**
 * 조회수 증가
 */
if (get_cookie('ck_it_id') != $it_id) {
    sql_query(" update {$g5['g5_shop_item_table']} set it_hit = it_hit + 1 where it_id = '" . sql_real_escape_string($it_id) . "' "); // 1증가
    set_cookie("ck_it_id", $it_id, 3600); // 1시간동안 저장
}

/**
 * 스킨 경로
 */
$skin_dir = EYOOM_CORE_PATH.'/'. G5_SHOP_DIR;

$g5['title'] = $it['it_name'].' &gt; '.$it['ca_name'];

/**
 * 분류 상단 코드가 있으면 출력하고 없으면 기본 상단 코드 출력
 */
if ($ca['ca_include_head'] && is_include_path_check($ca['ca_include_head']))
    @include_once($ca['ca_include_head']);
else
    include_once(G5_SHOP_PATH.'/_head.php');

/**
 * 분류 위치
 * HOME > 1단계 > 2단계 ... > 6단계 분류
 */
$ca_id = $it['ca_id'];
$nav_skin = $skin_dir.'/navigation.skin.php';
if(!is_file($nav_skin))
    $nav_skin = G5_SHOP_SKIN_PATH.'/navigation.skin.php';

if(defined('G5_THEME_USE_ITEM_CATEGORY') && G5_THEME_USE_ITEM_CATEGORY){
    // 이 분류에 속한 하위분류 출력
    $cate_skin = $skin_dir.'/listcategory.skin.php';
    if(!is_file($cate_skin))
        $cate_skin = G5_SHOP_SKIN_PATH.'/listcategory.skin.php';
}

/**
 * 보안서버경로
 */
if (G5_HTTPS_DOMAIN)
    $action_url = G5_HTTPS_DOMAIN.'/'.G5_SHOP_DIR.'/cartupdate.php';
else
    $action_url = G5_SHOP_URL.'/cartupdate.php';

/**
 * 이전 상품보기
 */
$sql = " select it_id, it_name from {$g5['g5_shop_item_table']} where it_id > '" . sql_real_escape_string($it_id) . "' and SUBSTRING(ca_id,1,4) = '".substr($it['ca_id'],0,4)."' and it_use = '1' order by it_id asc limit 1 ";
$row = sql_fetch($sql);
if ($row['it_id']) {
    $prev_title = $row['it_name'];
    $prev_href = shop_item_url($row['it_id']);
} else {
    $prev_title = '';
    $prev_href = '';
}

/**
 * 다음 상품보기
 */
$sql = " select it_id, it_name from {$g5['g5_shop_item_table']} where it_id < '" . sql_real_escape_string($it_id) . "' and SUBSTRING(ca_id,1,4) = '".substr($it['ca_id'],0,4)."' and it_use = '1' order by it_id desc limit 1 ";
$row = sql_fetch($sql);
if ($row['it_id']) {
    $next_title = $row['it_name'];
    $next_href = shop_item_url($row['it_id']);
} else {
    $next_title = '';
    $next_href = '';
}

/**
 * 고객선호도 별점수
 */
$star_score = get_star_image($it['it_id']);

/**
 * 관리자가 확인한 사용후기의 개수를 얻음
 */
$sql = " select count(*) as cnt from `{$g5['g5_shop_item_use_table']}` where it_id = '" . sql_real_escape_string($it_id) . "' and is_confirm = '1' ";
$row = sql_fetch($sql);
$item_use_count = $row['cnt'];

/**
 * 상품문의의 개수를 얻음
 */
$sql = " select count(*) as cnt from `{$g5['g5_shop_item_qa_table']}` where it_id = '" . sql_real_escape_string($it_id) . "' ";
$row = sql_fetch($sql);
$item_qa_count = $row['cnt'];

/**
 * 관련상품의 개수를 얻음
 */
if($default['de_rel_list_use']) {
    $sql = " select count(*) as cnt from {$g5['g5_shop_item_relation_table']} a left join {$g5['g5_shop_item_table']} b on (a.it_id2=b.it_id) where a.it_id = '" . sql_real_escape_string($it_id) . "' and  b.it_use='1' ";
    $row = sql_fetch($sql);
    $item_relation_count = $row['cnt'];
}

/**
 * 소셜 관련
 */
$sns_title = get_text($it['it_name']).' | '.get_text($config['cf_title']);
$sns_url  = shop_item_url($it['it_id']);
$sns_share_links .= get_sns_share_link('facebook', $sns_url, $sns_title, G5_SHOP_SKIN_URL.'/img/facebook.png').' ';
$sns_share_links .= get_sns_share_link('twitter', $sns_url, $sns_title, G5_SHOP_SKIN_URL.'/img/twitter.png').' ';

/**
 * 상품품절체크
 */
if(G5_SOLDOUT_CHECK)
    $is_soldout = is_soldout($it['it_id']);

/**
 * 주문가능체크
 */
$is_orderable = true;
if(!$it['it_use'] || $it['it_tel_inq'] || $is_soldout)
    $is_orderable = false;

$optitem = $supitem = '';

if($is_orderable) {
    /**
     * 상품 선택옵션
     */
    $option_count = 0;
    if($it['it_option_subject']) {
        $temp = explode(',', $it['it_option_subject']);
        $option_count = count($temp);
        $optitem = $shop->get_item_options($it['it_id'], $it['it_option_subject']);
    }

    /**
     * 상품 추가옵션
     */
    $supply_count = 0;
    if($it['it_supply_subject']) {
        $temp = explode(',', $it['it_supply_subject']);
        $supply_count = count($temp);
        $supitem = $shop->get_item_supply($it['it_id'], $it['it_supply_subject']);
    }
}

/**
 * 탭메뉴
 */
$pg_anchor = array(
    'sit_inf'   => '상품정보',
    'sit_use'   => '사용후기',
    'sit_qa'    => '상품문의',
    'sit_dvr'   => '배송정보',
    'sit_ex'    => '교환정보'
);

/**
 * 상품 구입폼
 */
$form_skin = $skin_dir.'/item.form.skin.php';

/**
 * 상품 상세정보
 */
$info_skin = $skin_dir.'/item.info.skin.php';
if(!is_file($info_skin)) $info_skin = G5_SHOP_SKIN_PATH.'/item.info.skin.php';

/**
 * 이윰 테마파일 출력
 */
include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/item.skin.html.php');

/**
 * 분류 하단 코드가 있으면 출력하고 없으면 기본 하단 코드 출력
 */
if ($ca['ca_include_tail'] && is_include_path_check($ca['ca_include_tail']))
    @include_once($ca['ca_include_tail']);
else
    include_once(G5_SHOP_PATH.'/_tail.php');