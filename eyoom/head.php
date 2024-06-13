<?php
/**
 * file : /eyoom/head.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 이윰 common.php 파일을 불러오지 못한 경우가 있다면
 * 1:1문의의 경우 이윰 common.php 파일을 한번 더 호출해야 이윰 테마의 스킨이 적용 됨
 */
if (!defined('_EYOOM_COMMON_')) include(EYOOM_PATH.'/common.php');

/**
 * 1:1문의 스킨 재설정
 */
if (isset($qaconfig) && $eyoom['use_gnu_qa'] == 'n') {
    $qa_skin_path = EYOOM_CORE_PATH.'/qa';
}

/**
 * 커뮤니티 기능을 사용하지 않거나
 * 게시판의 설정이 쇼핑몰 레이아웃 적용일때
 */
if ((defined('G5_COMMUNITY_USE') && G5_COMMUNITY_USE === false) || (isset($eyoom_board['use_shop_skin']) && $eyoom_board['use_shop_skin'] == 'y' && $eyoom['use_layout_community'] == 'n')) {
    if (defined('G5_USE_SHOP') && G5_USE_SHOP) {
        @include_once(G5_THEME_SHOP_PATH . '/shop.head.php');
        return;
    }
}

/**
 * 커뮤니티 메인에서 쇼핑몰 아이템 사용하기
 */
if (defined('G5_USE_SHOP') && G5_USE_SHOP && $eyoom['use_shop_itemtype'] == 'y' || $eyoom['use_layout_community'] == 'y') {
    /**
     * 쇼핑몰 코어 스킨경로
     */
    $skin_dir = EYOOM_CORE_PATH.'/'.G5_SHOP_DIR;

    /**
     * 최근 본 상품
     */
    include $skin_dir.'/boxtodayview.skin.php';

    /**
     * 장바구니 정보
     */
    include $skin_dir.'/boxcart.skin.php';

    /**
     * 위시리스트 정보
     */
    include $skin_dir.'/boxwish.skin.php';
}

/**
 * 테마용 head.sub.php 파일 인크루드
 * 이윰빌더 사용시 G5_THEME_PATH 는 /eyoom/ 폴더의 path로 재정의 됨
 * 결국 /eyoom/head.sub.php 파일을 인크루드 함
 */
include_once(G5_THEME_PATH.'/head.sub.php');

/**
 * 로고 Path
 */
$top_logo = G5_DATA_PATH."/common/{$bizinfo['bi_top_logo']}";
$bottom_logo = G5_DATA_PATH."/common/{$bizinfo['bi_bottom_logo']}";
$top_mobile_logo = G5_DATA_PATH."/common/{$bizinfo['bi_top_mobile_logo']}";
$bottom_mobile_logo = G5_DATA_PATH."/common/{$bizinfo['bi_bottom_mobile_logo']}";

/**
 * 로고 URL
 */
$logo_src['top'] = str_replace(G5_PATH, G5_URL, $top_logo);
$logo_src['bottom'] = str_replace(G5_PATH, G5_URL, $bottom_logo);
$logo_src['mobile_top'] = str_replace(G5_PATH, G5_URL, $top_mobile_logo);
$logo_src['mobile_bottom'] = str_replace(G5_PATH, G5_URL, $bottom_mobile_logo);

/**
 * 메뉴설정
 */
if ($eyoom['use_eyoom_menu'] == 'y') $menu_flag = 'eyoom';
$menu = $thema->menu_create($menu_flag);

/**
 * 메인인지 마이홈인지 GET변수의 초기key 값으로 구분하기
 */
$is_myhome = false;
$eyoom_myhome = false;
if (isset($_GET) && is_array($_GET)) {
    foreach ($_GET as $k => $v) { $dummy = $k; break; }
    if ($dummy != '') {
        if (!$$dummy) {
            $eyoom_myhome = true;
            if ($member['mb_id'] == $dummy) {
                $is_myhome = true;
            }
        }
    }
}

/**
 * 서브페이지 메뉴정보, 타이틀 및 Path 정보
 */
if (!defined('_INDEX_')) {
    $sidemenu = '';
    $subinfo = $thema->subpage_info($menu);
    if ($subinfo['registed'] == 'y') $sidemenu = $thema->submenu_create($menu_flag);
} else {
    /**
     * 팝업창
     */
    if ($eyoom['use_gnu_newwin'] == 'n' && !$is_myhome) {
        @include_once(EYOOM_CORE_PATH.'/newwin/newwin.inc.php');
    }
}

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
        }
        else { // 커뮤니티
            if ($eyoom['use_main_side_layout'] == 'y') {
                $side_layout['use'] = 'yes';
                $side_layout['pos'] = $eyoom['pos_main_side_layout'];
            }
        }
    }
    else { // 모든 서브페이지
        if (defined('_SHOP_')) { // 쇼핑몰
            if ($subinfo['sidemenu'] != 'n' && $eyoom['use_shopsub_side_layout'] == 'y') {
                $side_layout['use'] = 'yes';
                $side_layout['pos'] = $eyoom['pos_shopsub_side_layout'];
            }
        }
        else { // 커뮤니티
            if ($subinfo['sidemenu'] != 'n' && $eyoom['use_sub_side_layout'] == 'y') {
                $side_layout['use'] = 'yes';
                $side_layout['pos'] = $eyoom['pos_sub_side_layout'];
            }
        }
    }
}

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH . '/head.php');

/**
 * 이윰 테마파일 출력
 */
include_once(EYOOM_THEME_PATH . '/head.html.php');