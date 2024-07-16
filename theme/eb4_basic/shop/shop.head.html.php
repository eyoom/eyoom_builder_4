<?php
/**
 * theme file : /theme/THEME_NAME/shop/shop.head.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/shop_style.css?ver='.G5_CSS_VER.'">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/custom.css?ver='.G5_CSS_VER.'">',0);

/**
 * 로고 타입 : 'image' || 'text'
 */
$logo = 'image';

/**
 * 메뉴바 전체 메뉴 출력 : 'yes' || 'no'
 */
$is_megamenu = 'yes';

/**
 * 상품 이미지 미리보기 종류 : 'zoom' || 'slider'
 */
$item_view = 'zoom';
?>

<?php if (!$wmode) { ?>
<?php /*----- wrapper 시작 -----*/ ?>
<div class="wrapper">
    <h1 id="hd-h1"><?php echo $g5['title'] ?></h1>
    <div class="to-content"><a href="#container">본문 바로가기</a></div>
    <?php
    // 팝업창
    if (defined('_INDEX_') && $newwin_contents) { // index에서만 실행
        echo $newwin_contents;
    }
    ?>

    <?php /*----- header 시작 -----*/ ?>
    <header class="header-wrap <?php if(!defined('_INDEX_')) { ?>page-header-wrap<?php } ?>">
        <div class="top-header">
            <div class="container">
                <div class="row align-items-center position-relative">
                    <div class="col-lg-6 d-none d-lg-block">
                        <ul class="top-header-nav list-unstyled thn-start">
                            <?php if ($eyoom['use_shop_index'] == 'n') { ?>
                            <li class="cs-nav c-nav"><a href="<?php echo G5_URL; ?>"><span class="deactivate">커뮤니티</span></a></li>
                            <?php } ?>
                            <li class="cs-nav s-nav"><a href="<?php echo G5_SHOP_URL; ?>" class="disabled"><span class="activate">쇼핑몰</span></a></li>
                            <li><a href="<?php echo G5_SHOP_URL; ?>/couponzone.php"><i class="fas fa-ticket-alt"></i>쿠폰존</a></li>
                            <?php if ($is_admin) { // 관리자일 경우 ?>
                            <li>
                                <div class="eyoom-form">
                                    <input type="hidden" name="edit_mode" id="edit_mode" value="<?php echo $eyoom_default['edit_mode']; ?>">
                                    <label class="toggle">
                                        <input type="checkbox" id="btn_edit_mode" <?php echo $eyoom_default['edit_mode'] == 'on' ? 'checked':''; ?>><i></i><span class="text-black"><span class="fas fa-sliders-h m-r-5"></span>편집모드</span>
                                    </label>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="col-lg-6 clearfix">
                        <ul class="top-header-nav list-unstyled thn-end">
                            <?php if ($is_member) {  ?>
                                <?php if ($is_admin) {  ?>
                            <li><a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>"><i class="fas fa-cog text-crimson"></i>관리자</a></li>
                                <?php }  ?>
                            <li><a href="<?php echo G5_BBS_URL ?>/logout.php"><i class="fas fa-sign-out-alt"></i>로그아웃</a></li>
                            <?php } else {  ?>
                            <li><a href="<?php echo G5_BBS_URL ?>/login.php"><i class="fas fa-unlock-alt"></i>로그인</a></li>
                            <li><a href="<?php echo G5_BBS_URL ?>/register.php"><i class="fas fa-user-plus"></i>회원가입</a></li>
                            <?php }  ?>
                            <li class="dropdown">
                                <a class="dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-plus-circle"></i>추가메뉴
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a href="<?php echo G5_SHOP_URL; ?>/cart.php">장바구니</a>
                                    <a href="<?php echo G5_SHOP_URL; ?>/wishlist.php">위시리스트</a>
                                    <a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php">주문/배송조회</a>
                                    <a href="<?php echo G5_SHOP_URL; ?>/couponzone.php">쿠폰존</a>
                                    <a href="<?php echo G5_SHOP_URL; ?>/personalpay.php">개인결제</a>
                                    <a href="<?php echo G5_SHOP_URL; ?>/itemuselist.php">사용후기</a>
                                    <a href="<?php echo G5_BBS_URL ?>/faq.php">자주묻는 질문</a>
                                    <a href="<?php echo G5_BBS_URL ?>/qalist.php">1:1문의</a>
                                    <?php if ($is_member) { // 회원일 경우 ?>
                                    <a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php">회원정보수정</a>
                                    <?php } ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-title">
            <div class="container">
                <?php /* ===== 사이트 로고 시작 ===== */ ?>
                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="adm-edit-btn btn-edit-mode" style="top:0;left:12px;text-align:left">
                    <div class="btn-group">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=biz_info&amp;amode=logo&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> 로고 설정</a>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=biz_info&amp;amode=logo&amp;thema=<?php echo $theme; ?>" target="_blank" class="ae-btn-r" title="새창 열기">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
                <?php } ?>
                <a href="<?php echo G5_SHOP_URL; ?>" class="title-logo">
                <?php if ($logo == 'text') { ?>
                    <h1><?php echo $config['cf_title']; ?></h1>
                <?php } else if ($logo == 'image') { ?>
                    <?php if (!G5_IS_MOBILE) { ?>
                    <?php if (file_exists($top_logo) && !is_dir($top_logo)) { ?>
                    <img src="<?php echo $logo_src['top']; ?>" class="site-logo" alt="<?php echo $config['cf_title']; ?>">
                    <?php } else { ?>
                    <img src="<?php echo EYOOM_THEME_URL; ?>/image/site_logo.svg" class="site-logo" alt="<?php echo $config['cf_title']; ?>">
                    <?php } ?>
                    <?php } else { ?>
                    <?php if (file_exists($top_mobile_logo) && !is_dir($top_mobile_logo)) { ?>
                    <img src="<?php echo $logo_src['mobile_top']; ?>" class="site-logo" alt="<?php echo $config['cf_title']; ?>">
                    <?php } else { ?>
                    <img src="<?php echo EYOOM_THEME_URL; ?>/image/site_logo.svg" class="site-logo" alt="<?php echo $config['cf_title']; ?>">
                    <?php } ?>
                    <?php } ?>
                <?php } ?>
                </a>
                <?php /* ===== 사이트 로고 끝 ===== */ ?>

                <div class="header-title-search d-none d-lg-block">
                    <form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);" class="eyoom-form">
                    <input type="hidden" name="sfl" value="wr_subject||wr_content">
                    <input type="hidden" name="sop" value="and">
                    <label for="search_input" class="sound_only">검색어 입력 필수</strong></label>
                    <div class="input input-button">
                        <input type="text" name="q" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="search_input" class="sch_stx" placeholder="상품 검색어 입력">
                        <div class="button"><input type="submit"><i class="fas fa-search"></i></div>
                    </div>
                    </form>
                </div>

                <div class="header-title-btn">
                    <div class="title-btn">
                        <a href="<?php echo G5_SHOP_URL; ?>/wishlist.php">
                            <div class="title-btn-in">
                                <span class="title-btn-text">위시리스트</span>
                                <span class="badge badge-indigo rounded"><?php echo get_wishlist_datas_count(); ?></span>
                            </div>
                        </a>
                    </div>
                    <div class="title-btn">
                        <a href="<?php echo G5_SHOP_URL; ?>/cart.php">
                            <div class="title-btn-in title-btn-navy">
                                <span class="title-btn-text">장바구니</span>
                                <span class="badge badge-dark rounded"><?php echo get_boxcart_datas_count(); ?></span>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="header-title-mobile-btn">
                    <button type="button" class="navbar-toggler search-toggle mobile-search-btn">
                        <span class="sr-only">검색 버튼</span>
                        <span class="fas fa-search"></span>
                    </button>
                    <button type="button" class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft" aria-controls="offcanvasLeft">
                        <span class="sr-only">메뉴 버튼</span>
                        <span class="fas fa-bars"></span>
                    </button>
                </div>
            </div>
        </div>
        <div class="nav-wrap">
            <div class="container">
                <nav class="navbar navbar-expand-lg">
                    <div class="sidebar-left offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft" aria-controls="offcanvasLeftLabel">
                        <div class="sidebar-left-content">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title f-s-16r" id="offcanvasLeftLabel"><i class="fas fa-bars m-r-10 text-gray"></i>NAVIGATION</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <?php /* ---------- 모바일용 컨텐츠 시작 // 991픽셀 이하에서만 출력 ---------- */ ?>
                            <?php if ($eyoom['is_shop_theme'] == 'y' || $is_member) { ?>
                            <div class="sidebar-member-menu">
                                <?php if ($eyoom['is_shop_theme'] == 'y') { ?>
                                <a href="<?php echo G5_URL; ?>" class="btn-e btn-e-md btn-e-navy btn-e-block m-t-10 m-b-10">
                                    커뮤니티<i class="far fa-caret-square-right m-l-5"></i>
                                </a>
                                <?php } ?>
                                <div class="m-t-10">
                                    <a href="<?php echo G5_SHOP_URL; ?>/cart.php" class="sidebar-member-btn-box">
                                        <div class="sidebar-member-btn">
                                            장바구니
                                        </div>
                                    </a>
                                    <a href="<?php echo G5_SHOP_URL; ?>/wishlist.php" class="sidebar-member-btn-box">
                                        <div class="sidebar-member-btn float-end">
                                            위시리스트
                                        </div>
                                    </a>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="m-t-10 m-b-10">
                                    <a href="<?php echo G5_SHOP_URL; ?>/couponzone.php" class="sidebar-member-btn-box">
                                        <div class="sidebar-member-btn">
                                            쿠폰존
                                        </div>
                                    </a>
                                    <a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php" class="sidebar-member-btn-box">
                                        <div class="sidebar-member-btn float-end">
                                            주문/배송조회
                                        </div>
                                    </a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php /* ---------- 모바일용 컨텐츠 끝 ---------- */ ?>
                            <ul class="navbar-nav">
                                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                                <div class="adm-edit-btn btn-edit-mode" style="top:0;text-align:left">
                                    <div class="btn-group">
                                        <a href="<?php echo $shopmenu_link; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> 쇼핑몰 메뉴 설정</a>
                                        <a href="<?php echo $shopmenu_link; ?>" target="_blank" class="ae-btn-r" title="새창 열기">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    </div>
                                </div>
                                <?php } ?>
                                <li class="navbar-nav-home">
                                    <a href="<?php echo G5_URL ?>" class="nav-link">HOME</a>
                                </li>

                                <?php if (isset($menu) && is_array($menu)) { ?>
                                <?php foreach ($menu as $key => $menu_1) { ?>
                                <li class="dropdown">
                                    <a href="<?php echo $menu_1['me_link']; ?>" target="_<?php echo $menu_1['me_target']; ?>" class="dropdown-toggle nav-link">
                                        <?php if (isset($menu_1['me_icon']) && $menu_1['me_icon']) { ?><i class="<?php echo $menu_1['me_icon']; ?> nav-cate-icon margin-right-5"></i><?php } ?>
                                        <?php echo $menu_1['me_name']?>
                                    </a>
                                    <?php if (isset($menu_1['submenu']) && is_array($menu_1['submenu'])) { ?>
                                    <a href="#" class="cate-dropdown-open <?php if (isset($menu_1['active']) && $menu_1['active']) echo 'show'; ?>" data-bs-toggle="dropdown"></a>
                                    <?php } ?>
                                    <?php $index2 = $size2 = 0; ?>
                                    <?php if (isset($menu_1['submenu']) && is_array($menu_1['submenu'])) { $size2 = count($menu_1['submenu']); ?>
                                    <?php foreach ($menu_1['submenu'] as $subkey => $menu_2) { ?>
                                    <?php if ($index2 == 0) { ?>
                                    <div class="dropdown-menu <?php if (isset($menu_1['active']) && $menu_1['active']) echo 'show'; ?>">
                                        <ul>
                                    <?php } ?>
                                        <li class="dropdown-submenu">
                                            <a href="<?php echo $menu_2['me_link']; ?>" target="_<?php echo $menu_2['me_target']; ?>" class="dropdown-item nav-link <?php if (isset($menu_2['active']) && $menu_2['active']) echo 'active';?>">
                                                <span class="submenu-marker"></span>
                                                <?php if (isset($menu_2['me_icon']) && $menu_2['me_icon']) { ?>
                                                <i class="<?php echo $menu_2['me_icon']; ?> m-r-5"></i>
                                                <?php } ?>
                                                <?php echo $menu_2['me_name']; ?>
                                                <?php if ($menu_2['new']) { ?>
                                                <i class="far fa-check-circle text-indigo"></i>
                                                <?php } ?>
                                                <?php if (isset($menu_2['sub']) && $menu_2['sub'] == 'on') { ?>
                                                <i class="fas fa-angle-right sub-caret hidden-sm hidden-xs"></i><i class="fas fa-angle-down sub-caret hidden-md hidden-lg"></i>
                                                <?php } ?>
                                            </a>
                                            <?php $index3 = $size3 = 0; ?>
                                            <?php if (isset($menu_2['subsub']) && is_array($menu_2['subsub'])) { $size3 = count($menu_2['subsub']); ?>
                                            <?php foreach ($menu_2['subsub'] as $ssubkey => $menu_3) { ?>
                                            <?php if ($index3 == 0) { ?>
                                            <ul class="dropdown-menu">
                                            <?php } ?>
                                                <li class="dropdown-submenu">
                                                    <a href="<?php echo $menu_3['me_link']; ?>" target="_<?php echo $menu_3['me_target']; ?>" class="dropdown-item nav-link <?php if (isset($menu_3['active']) && $menu_3['active']) echo 'active';?>">
                                                        <span class="submenu-marker"></span>
                                                        <?php if (isset($menu_3['me_icon']) && $menu_3['me_icon']) { ?>
                                                        <i class="<?php echo $menu_3['me_icon']; ?> m-r-5"></i>
                                                        <?php } ?>
                                                        <?php echo $menu_3['me_name']; ?>
                                                        <?php if ($menu_3['new']) { ?>
                                                        <i class="far fa-check-circle text-indigo"></i>
                                                        <?php } ?>
                                                        <?php if (isset($menu_3['sub']) && $menu_3['sub'] == 'on') { ?>
                                                        <i class="fas fa-angle-right sub-caret hidden-sm hidden-xs"></i><i class="fas fa-angle-down sub-caret hidden-md hidden-lg"></i>
                                                        <?php } ?>
                                                    </a>
                                                </li>
                                            <?php if ($index3 == $size3 - 1) { ?>
                                            </ul>
                                            <?php } ?>
                                            <?php $index3++; } ?>
                                            <?php } ?>
                                        </li>
                                    <?php if ($index2 == $size2 - 1) { ?>
                                        </ul>
                                    </div>
                                    <?php } ?>
                                    <?php $index2++; } ?>
                                    <?php } ?>
                                </li>
                                <?php } ?>
                                <?php } ?>
                                        
                                <?php if ($is_megamenu == 'yes') { ?>
                                <li class="dropdown dropdown-mega-menu d-none d-lg-block">
                                    <a data-bs-toggle="dropdown" class="nav-link dropdown-toggle" href="#"><i class="fas fa-bars"></i></a>
                                    <div class="dropdown-menu">
                                        <ul class="mega-menu d-lg-flex">
                                        <?php if (is_array($menu)) { ?>
                                            <?php foreach ($menu as $key => $menu_1) { ?>
                                            <li class="mega-menu-col">
                                            <h5><a href="<?php echo $menu_1['me_link']; ?>" target="_<?php echo $menu_1['me_target']; ?>" class="<?php if ($menu_1['active']) echo 'active';?>"><?php echo $menu_1['me_name']?></a></h5>
                                                <?php $index2 = $size2 = 0; ?>
                                                <?php if (isset($menu_1['submenu']) && is_array($menu_1['submenu'])) { $size2 = count($menu_1['submenu']); ?>
                                                <?php foreach ($menu_1['submenu'] as $subkey => $menu_2) { ?>
                                                <?php if ($index2 == 0) { ?>
                                                <ul>
                                                <?php } ?>
                                                    <li>
                                                        <a href="<?php echo $menu_2['me_link']; ?>" target="_<?php echo $menu_2['me_target']; ?>" class="mega-menu-item <?php if ($menu_2['active']) echo 'active';?>"><?php echo $menu_2['me_name']; ?></a>
                                                        <?php $index3 = $size3 = 0; ?>
                                                        <?php if (isset($menu_2['subsub']) && is_array($menu_2['subsub'])) { $size3 = count($menu_2['subsub']); ?>
                                                        <?php foreach ($menu_2['subsub'] as $ssubkey => $menu_3) { ?>
                                                        <?php if ($index3 == 0) { ?>
                                                        <ul class="menu3-ul">
                                                        <?php } ?>
                                                            <li>
                                                                <a href="<?php echo $menu_3['me_link']; ?>" target="_<?php echo $menu_3['me_target']; ?>" class="mega-menu-item <?php if (isset($menu_3['active']) && $menu_3['active']) echo 'active';?>"><?php echo $menu_3['me_name']; ?></a>
                                                            </li>
                                                        <?php if ($index3 == $size3 - 1) { ?>
                                                        </ul>
                                                        <?php } ?>
                                                        <?php $index3++; } ?>
                                                        <?php } ?>
                                                    </li>
                                                <?php if ($index2 == $size2 - 1) { ?>
                                                </ul>
                                                <?php } ?>
                                                <?php $index2++; } ?>
                                                <?php } ?>
                                            </li>
                                            <?php } ?>
                                        <?php } ?>
                                        </ul>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                            <?php /* ---------- 모바일용 컨텐츠 시작 // 991픽셀 이하에서만 출력 ---------- */ ?>
                            <div class="sidebar-mobile-menu">
                                <a href="<?php echo shop_type_url(1); ?>">히트상품</a>
                                <a href="<?php echo shop_type_url(2); ?>">추천상품</a>
                                <a href="<?php echo shop_type_url(3); ?>">최신상품</a>
                                <a href="<?php echo shop_type_url(4); ?>">인기상품</a>
                                <a href="<?php echo shop_type_url(5); ?>">할인상품</a>
                            </div>
                            <?php /* ---------- 모바일용 컨텐츠 끝 ---------- */ ?>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <?php /*----- header 끝 -----*/ ?>

    <?php if(!defined('_INDEX_')) { // 메인이 아닐때 ?>
    <?php /*----- page title 시작 -----*/ ?>
    <div class="page-title-wrap">
        <div class="container">
        <?php if (!defined('_EYOOM_MYPAGE_')) { ?>
            <h2>
                <?php if (!$it_id) { ?>
                <i class="fas fa-arrow-alt-circle-right m-r-10"></i><?php echo $subinfo['title']; ?>
                <?php } else { ?>
                <i class="fas fa-arrow-alt-circle-right m-r-10"></i><?php echo $subinfo['title']; ?>
                <?php } ?>
            </h2>
            <?php if (!$it_id) { ?>
            <div class="sub-breadcrumb-wrap">
                <ul class="sub-breadcrumb hidden-xs">
                    <?php echo $subinfo['path']; ?>
                </ul>
            </div>
            <?php } ?>
        <?php } else { ?>
            <h2><i class="fas fa-arrow-alt-circle-right"></i> 마이페이지</h2>
        <?php } ?>
        </div>
    </div>
    <?php /*----- page title 끝 -----*/ ?>
    <?php } ?>

    <div class="basic-body <?php if(!defined('_INDEX_')) { ?>page-body<?php } ?>">
        <?php if(defined('_INDEX_')) { ?>
        <main class="basic-body-main">
        <?php } else { ?>
        <div class="container">
            <main class="basic-body-main">
        <?php } ?>
<?php } // !$wmode ?>