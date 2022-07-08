<?php
if (!defined('_EYOOM_')) exit;

/**
 * 쇼핑몰 상수가 없다면 재정의
 */
if (!defined('_SHOP_')) define('_SHOP_', true);

/**
 * 쇼핑몰 기능을 사용하지 않음 처리할 경우
 */
if ($eyoom['is_shop_theme'] == 'n' && !$is_admin) {
    header("location:".G5_URL);
}

/**
 * 커뮤니티 레이아웃을 쇼핑몰에 적용하기
 */
if (isset($eyoom['use_layout_community']) && $eyoom['use_layout_community'] == 'y') {
    @include_once(EYOOM_PATH.'/head.php');
    return;
}

/**
 * 직접 호출할 경우
 */
if (!defined('_EYOOM_')) @include EYOOM_PATH.'/common.php';

/**
 * 메뉴설정
 */
if ($eyoom['use_eyoom_shopmenu'] == 'y') {
    $me_shop = 1;
    $menu = $thema->menu_create('eyoom');
} else {
    $menu = $shop->menu_create();
}

/**
 * 서브페이지 타이틀 및 Path 정보
 */
$subinfo = $thema->subpage_info($menu);

/**
 * 쇼핑몰 코어 스킨경로
 */
$skin_dir = EYOOM_CORE_PATH.'/'.G5_SHOP_DIR;

/**
 * 최근 본 상품
 */
if (defined('_SHOP_')) include $skin_dir.'/boxtodayview.skin.php';

/**
 * 장바구니 정보
 */
if (defined('_SHOP_')) include $skin_dir.'/boxcart.skin.php';

/**
 * 위시리스트 정보
 */
if (defined('_SHOP_')) include $skin_dir.'/boxwish.skin.php';

/**
 * 이벤트 정보
 */
if (defined('_SHOP_') && defined('_INDEX_')) include $skin_dir.'/boxevent.skin.php';

/**
 * 사이드 영역 출력여부 판단
 */
$side_layout = array();
if (!$eyoom_myhome || 1) {
    if (defined('_INDEX_')) { // 커뮤니티 메인
        if (defined('_SHOP_')) { // 쇼핑몰
            if ($eyoom['use_shopmain_side_layout'] == 'y') {
                $side_layout['use'] = 'yes';
                $side_layout['pos'] = $eyoom['pos_shopmain_side_layout'];
            }
        } else { // 커뮤니티
            if ($eyoom['use_main_side_layout'] == 'y') {
                $side_layout['use'] = 'yes';
                $side_layout['pos'] = $eyoom['pos_main_side_layout'];
            }
        }
    } else { // 모든 서브페이지
        if (defined('_SHOP_')) { // 쇼핑몰
            if ($subinfo['sidemenu'] != 'n' && $eyoom['use_shopsub_side_layout'] == 'y') {
                $side_layout['use'] = 'yes';
                $side_layout['pos'] = $eyoom['pos_shopsub_side_layout'];
            }
        } else { // 커뮤니티
            if ($subinfo['sidemenu'] != 'n' && $eyoom['use_sub_side_layout'] == 'y') {
                $side_layout['use'] = 'yes';
                $side_layout['pos'] = $eyoom['pos_sub_side_layout'];
            }
        }
    }
}

/**
 * 상단 메뉴 관리자 링크
 */
if ($is_admin == 'super' && !G5_IS_MOBILE) {
    if ($eyoom['use_eyoom_shopmenu'] == 'n') {
        $shopmenu_link = G5_ADMIN_URL . '/?dir=shop&amp;pid=categorylist';
    } else if ($eyoom['use_eyoom_shopmenu'] == 'y') {
        $shopmenu_link = G5_ADMIN_URL . '/?dir=theme&amp;pid=shopmenu_list';
    }
}

/**
 * 테마용 head.sub.php 파일 인크루드
 */
include_once(G5_THEME_PATH.'/head.sub.php');

/**
 * 로고 Path
 */
$top_logo = G5_DATA_PATH."/common/{$bizinfo['bi_top_shoplogo']}";
$bottom_logo = G5_DATA_PATH."/common/{$bizinfo['bi_bottom_shoplogo']}";
$top_mobile_logo = G5_DATA_PATH."/common/{$bizinfo['bi_top_mobile_shoplogo']}";
$bottom_mobile_logo = G5_DATA_PATH."/common/{$bizinfo['bi_bottom_mobile_shoplogo']}";

/**
 * 로고 URL
 */
$logo_src['top'] = str_replace(G5_PATH, G5_URL, $top_logo);
$logo_src['bottom'] = str_replace(G5_PATH, G5_URL, $bottom_logo);
$logo_src['mobile_top'] = str_replace(G5_PATH, G5_URL, $top_mobile_logo);
$logo_src['mobile_bottom'] = str_replace(G5_PATH, G5_URL, $bottom_mobile_logo);

/**
 * 팝업창
 */
if (defined('_INDEX_')) {
    if ($eyoom['use_gnu_newwin'] == 'n') {
        @include_once(EYOOM_CORE_PATH.'/newwin/newwin.inc.php');
    }
}

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_SHOP_PATH . '/shop.head.php');

/**
 * 이윰 테마파일 출력
 */
include_once(EYOOM_THEME_SHOP_PATH . '/shop.head.html.php');