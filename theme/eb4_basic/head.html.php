<?php
/**
 * theme file : /theme/THEME_NAME/head.html.php
 */
if (!defined('_EYOOM_')) exit;

if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때
    add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/style.css?ver='.G5_CSS_VER.'">',0);
} else if ($eyoom['is_responsive'] == '0' && !G5_IS_MOBILE) { // 비반응형이면서 PC버전일때
    add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/style-nr.css?ver='.G5_CSS_VER.'">',0);
}
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/custom.css?ver='.G5_CSS_VER.'">',0);

/**
 * 로고 타입 : 'image' || 'text'
 */
$logo = 'image';

/**
 * Footer Top (하단 사이트 상세 정보) 출력 : 'yes' || 'no'
 */
$footer_top = 'yes';

/**
 * 상품 이미지 미리보기 종류 : zoom or slider
 */
$item_view = 'zoom';
?>

<?php if (!$wmode) { ?>
<div class="wrapper">
    <?php
    // 팝업창
    if(defined('_INDEX_') && $newwin_contents) { // index에서만 실행
        echo $newwin_contents;
    }
    ?>

    <?php /* Header Topbar */ ?>
    <header class="header-topbar">
        <div class="container position-relative">
            <div class="topbar-left">
                <ul class="list-unstyled left-menu">
                <?php if ($eyoom['is_shop_theme'] == 'y') { ?>
                    <?php if (defined('_SHOP_') && $eyoom['use_layout_community'] == 'y') { ?>
                    <li><a href="<?php echo G5_SHOP_URL; ?>" class="active">쇼핑몰</a></li>
                    <li><a href="<?php echo G5_URL; ?>">커뮤니티</a></li>
                    <?php } else { ?>
                    <li><a href="<?php echo G5_SHOP_URL; ?>">쇼핑몰</a></li>
                    <li><a href="<?php echo G5_URL; ?>" class="active">커뮤니티</a></li>
                    <?php } ?>
                <?php } ?>
                    <?php if (!G5_IS_MOBILE) { ?>
                    <li>
                        <a id="bookmarkme" href="javascript:void(0);" rel="sidebar" title="bookmark this page">북마크</a>
                        <script>
                        $(function() {
                            $("#bookmarkme").click(function() {
                                // Mozilla Firefox Bookmark
                                if ('sidebar' in window && 'addPanel' in window.sidebar) {
                                    window.sidebar.addPanel(location.href,document.title,"");
                                } else if( /*@cc_on!@*/false) { // IE Favorite
                                    window.external.AddFavorite(location.href,document.title);
                                } else { // webkit - safari/chrome
                                    alert('단축키 ' + (navigator.userAgent.toLowerCase().indexOf('mac') != - 1 ? 'Command' : 'CTRL') + ' + D를 눌러 북마크에 추가하세요.');
                                }
                            });
                        });
                        </script>
                    </li>
                    <?php } ?>
                    <li class="hidden-xs">
                        <?php echo eb_connect('basic_top'); ?>
                    </li>
                </ul>
            </div>

            <ul class="topbar-right list-unstyled">
                <div class="member-menu">
                <?php if ($is_admin) { // 관리자일 경우 ?>
                    <li>
                        <div class="eyoom-form">
                            <input type="hidden" name="edit_mode" id="edit_mode" value="<?php echo $eyoom_default['edit_mode']; ?>">
                            <label class="toggle red-toggle">
                                <input type="checkbox" id="btn_edit_mode" <?php echo $eyoom_default['edit_mode'] == 'on' ? 'checked':''; ?>><i></i><span class="color-grey font-size-12">편집모드</span>
                            </label>
                        </div>
                    </li>
                <?php } ?>
                <?php if ($is_admin || $is_auth) { // 관리자일 경우 ?>
                    <li><a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>"><i class="fas fa-cog margin-right-5"></i>관리자</a></li>
                <?php } ?>
                <?php if ($is_member) { // 회원일 경우 ?>
                    <li><a href="<?php echo G5_BBS_URL; ?>/logout.php"><i class="fas fa-sign-out-alt margin-right-5"></i>로그아웃</a></li>
                    <li><a href="<?php echo G5_URL; ?>/mypage/"><i class="fas fa-user-circle margin-right-5"></i>마이페이지</a></li>
                <?php } else { ?>
                    <li><a href="<?php echo G5_BBS_URL; ?>/register.php"><i class="fas fa-user-plus margin-right-5"></i>회원가입</a></li>
                    <li><a href="<?php echo G5_BBS_URL; ?>/login.php"><i class="fas fa-unlock-alt margin-right-5"></i>로그인</a></li>
                <?php } ?>
                    <li class="topbar-add-menu">
                        <a href="#" data-toggle="dropdown" data-hover="dropdown"><i class="fas fa-plus-circle margin-right-5"></i>추가메뉴</a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo G5_BBS_URL; ?>/new.php">새글</a></li>
                            <li><a href="<?php echo G5_BBS_URL; ?>/faq.php">FAQ</a></li>
                            <li><a href="<?php echo G5_BBS_URL; ?>/qalist.php">1:1문의</a></li>
                            <?php if ($is_member) { // 회원일 경우 ?>
                            <li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php">회원정보수정</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </div>
                <li class="mobile-nav-trigger">
                    <a href="#" class="sidebar-left-trigger" data-action="toggle" data-side="left">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="fas fa-search margin-right-10"></span>
                        <span class="fas fa-bars"></span>
                    </a>
                </li>
            </ul>
        </div>
    </header>
    <?php /* End Header Topbar */ ?>

    <?php if ($eyoom['layout'] == 'wide') { ?>
    <div <?php if ($eyoom['sticky'] == 'y') echo 'id="header-fixed"'; ?> class="basic-layout <?php if (defined('_INDEX_')) echo 'fixed-main'; ?>">
    <?php } else if ($eyoom['layout'] == 'boxed') { ?>
    <div <?php if ($eyoom['sticky'] == 'y') echo 'id="header-fixed"'; ?> class="boxed-layout container <?php if (defined('_INDEX_')) echo 'fixed-main'; ?>">
    <?php } ?>
        <?php /* Header Title */ ?>
        <div class="header-title">
            <div class="header-title-in">
                <div class="container">
                    <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                    <div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="top:-2px">
                        <div class="btn-group">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=biz_info&amp;amode=logo&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-xs btn-e-red btn-e-split"><i class="far fa-edit"></i> 로고 설정</a>
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=biz_info&amp;amode=logo&amp;thema=<?php echo $theme; ?>" target="_blank" class="btn-e btn-e-xs btn-e-red btn-e-split-red dropdown-toggle" title="새창 열기">
                                <i class="far fa-window-maximize"></i>
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                    <a href="<?php echo G5_URL; ?>">
                    <?php if ($logo == 'text') { ?>
                        <h1><?php echo $config['cf_title']; ?></h1>
                    <?php } else if ($logo == 'image') { ?>
                        <?php if (!G5_IS_MOBILE) { ?>
                        <?php if (file_exists($top_logo) && !is_dir($top_logo)) { ?>
                        <img src="<?php echo $logo_src['top']; ?>" class="title-image-center" alt="<?php echo $config['cf_title']; ?>">
                        <?php } else { ?>
                        <img src="<?php echo EYOOM_THEME_URL; ?>/image/site_logo.png" class="title-image-center" alt="<?php echo $config['cf_title']; ?>">
                        <?php } ?>
                        <?php } else { ?>
                        <?php if (file_exists($top_mobile_logo) && !is_dir($top_mobile_logo)) { ?>
                        <img src="<?php echo $logo_src['mobile_top']; ?>" class="title-image-center" alt="<?php echo $config['cf_title']; ?>">
                        <?php } else { ?>
                        <img src="<?php echo EYOOM_THEME_URL; ?>/image/site_logo.png" class="title-image-center" alt="<?php echo $config['cf_title']; ?>">
                        <?php } ?>
                        <?php } ?>
                    <?php } ?>
                    </a>
                </div>
            </div>
        </div>
        <?php /* End Header Title */ ?>

        <?php /* Header Nav */ ?>
        <div class="header-nav header-sticky">
            <div class="navbar" role="navigation">
                <div class="container">
                    <?php /* ---------- 공지사항 시작 // 991픽셀 이하에서만 출력 ---------- */ ?>
                    <div class="nav-center hidden-md hidden-lg">
                        <?php echo eb_latest('1520321978'); ?>
                    </div>
                    <?php /* ---------- 공지사항 끝 ---------- */ ?>

                    <nav class="sidebar left">
                        <div class="sidebar-left-content">
                            <?php /* ---------- 모바일용 컨텐츠 시작 // 991픽셀 이하에서만 출력 ---------- */ ?>
                            <div class="sidebar-member-menu">
                                <form name="fsearchbox" method="get" action="<?php echo G5_BBS_URL; ?>/search.php" onsubmit="return fsearchbox_submit(this);" class="eyoom-form margin-bottom-20">
                                <input type="hidden" name="sfl" value="wr_subject||wr_content">
                                <input type="hidden" name="sop" value="and">
                                <label for="sch_stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                                <div class="input input-button">
                                    <input type="text" name="stx" id="sch_stx" maxlength="20" placeholder="전체검색">
                                    <div class="button"><input type="submit">검색</div>
                                </div>
                                </form>
                                <?php if ($eyoom['is_shop_theme'] == 'y') { ?>
                                <a href="<?php echo G5_SHOP_URL; ?>" class="sidebar-lg-btn btn-e btn-e-lg btn-e-red btn-e-block">
                                    쇼핑몰 메인
                                </a>
                                <?php } ?>
                                <?php if ($is_admin) { // 관리자일 경우 ?>
                                <a href="<?php echo G5_ADMIN_URL; ?>" class="sidebar-lg-btn btn-e btn-e-lg btn-e-yellow btn-e-block">
                                    관리자 페이지
                                </a>
                                <?php } ?>
                                <?php if ($is_member) { // 회원일 경우 ?>
                                <a href="<?php echo G5_URL; ?>/mypage/" class="sidebar-member-btn-box">
                                    <div class="sidebar-other-btn">
                                        마이페이지
                                    </div>
                                </a>
                                <a <?php if ( !G5_IS_MOBILE ) { ?>href="javascript:void(0);" onclick="scrap_modal();"<?php } else { ?>href="<?php echo G5_BBS_URL; ?>/scrap.php" target="_blank"<?php } ?> class="sidebar-member-btn-box">
                                    <div class="sidebar-other-btn pull-right">
                                        스크랩
                                    </div>
                                </a>
                                <div class="margin-bottom-10"></div>
                                <a <?php if (!G5_IS_MOBILE) { ?>href="javascript:void(0);" onclick="memo_modal();"<?php } else { ?>href="<?php echo G5_BBS_URL; ?>/memo.php" target="_blank"<?php } ?> class="sidebar-member-btn-box">
                                    <div class="sidebar-other-btn">
                                        쪽지<?php if ($memo_not_read) { ?><span class="badge rounded-3x badge-e badge-red margin-left-5"><?php echo $memo_not_read; ?></span><?php } ?>
                                    </div>
                                </a>
                                <a href="<?php echo G5_URL; ?>/mypage/respond.php" class="sidebar-member-btn-box">
                                    <div class="sidebar-other-btn pull-right">
                                        내글반응<?php if ( $respond_not_read >= 1 ) { ?><span class="badge rounded-3x badge-e badge-red margin-left-5"><?php echo $respond_not_read; ?></span><?php } ?>
                                    </div>
                                </a>
                                <div class="margin-bottom-10"></div>
                                <a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php" class="sidebar-member-btn-box">
                                    <div class="sidebar-member-btn">정보수정</div>
                                </a>
                                <a href="<?php echo G5_BBS_URL; ?>/logout.php" class="sidebar-member-btn-box">
                                    <div class="sidebar-member-btn pull-right">로그아웃</div>
                                </a>
                                <?php } else { //비회원일 경우 ?>
                                <a href="<?php echo G5_BBS_URL; ?>/register.php" class="sidebar-member-btn-box">
                                    <div class="sidebar-member-btn">회원가입</div>
                                </a>
                                <a href="<?php echo G5_BBS_URL; ?>/login.php" class="sidebar-member-btn-box">
                                    <div class="sidebar-member-btn pull-right">로그인</div>
                                </a>
                                <?php } ?>
                                <div class="clearfix"></div>
                            </div>
                            <?php /* ---------- 모바일용 컨텐츠 끝 ---------- */ ?>

                            <ul class="nav navbar-nav">
                                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                                <div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="top:-2px">
                                    <div class="btn-group">
                                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=menu_list&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-xs btn-e-red btn-e-split"><i class="far fa-edit"></i> 메뉴 설정</a>
                                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=menu_list&amp;thema=<?php echo $theme; ?>" target="_blank" class="btn-e btn-e-xs btn-e-red btn-e-split-red dropdown-toggle" title="새창 열기">
                                            <i class="far fa-window-maximize"></i>
                                        </a>
                                    </div>
                                </div>
                                <?php } ?>
                                <li class="navbar-nav-home">
                                    <a href="<?php echo G5_URL; ?>"><i class="fas fa-navicon nav-icon-pre hidden-xs hidden-sm"></i>HOME</a>
                                </li>
                                <li class="nav-li-divider"></li>
                                <?php if (isset($menu) && is_array($menu)) { ?>
                                <?php foreach ($menu as $key => $menu_1) { ?>
                                <li class="<?php if ($menu_1['active']) echo 'active';?> <?php if ($menu_1['submenu']) echo 'dropdown'; ?>">
                                    <a href="<?php echo $menu_1['me_link']; ?>" target="_<?php echo $menu_1['me_target']; ?>" class="dropdown-toggle disabled" <?php echo G5_IS_MOBILE && $menu_1['submenu'] ? 'data-toggle="dropdown"' : 'data-hover="dropdown"';?>>
                                        <?php if ($menu_1['me_icon']) { ?><i class="<?php echo $menu_1['me_icon']; ?> nav-cate-icon margin-right-5"></i><?php } ?>
                                        <?php echo $menu_1['me_name']?>
                                    </a>
                                    <?php if (isset($menu_1['submenu']) && is_array($menu_1['submenu'])) { ?>
                                    <a href="#" class="cate-dropdown-open dorpdown-toggle hidden-lg hidden-md" data-toggle="dropdown"></a>
                                    <?php } ?>
                                    <?php $index2 = 0; $size2 = count((array)$menu_1['submenu']); ?>
                                    <?php if (isset($menu_1['submenu']) && is_array($menu_1['submenu'])) { ?>
                                    <?php foreach ($menu_1['submenu'] as $subkey => $menu_2) { ?>
                                    <?php if ($index2 == 0) { ?>
                                    <ul class="dropdown-menu">
                                    <?php } ?>
                                        <li class="dropdown-submenu <?php if ($menu_2['active']) echo 'active';?>">
                                            <a href="<?php echo $menu_2['me_link']; ?>" target="_<?php echo $menu_2['me_target']; ?>">
                                                <span class="submenu-marker"></span>
                                                <?php if ($menu_2['me_icon']) { ?>
                                                <i class="<?php echo $menu_2['me_icon']; ?> margin-right-5"></i>
                                                <?php } ?>
                                                <?php echo $menu_2['me_name']; ?>
                                                <?php if ($menu_2['new']) { ?>
                                                <i class="far fa-check-circle color-red margin-left-5"></i>
                                                <?php } ?>
                                                <?php if ($menu_2['sub'] == 'on') { ?>
                                                <i class="fas fa-angle-right sub-caret hidden-sm hidden-xs"></i><i class="fas fa-angle-down sub-caret hidden-md hidden-lg"></i>
                                                <?php } ?>
                                            </a>
                                            <?php $index3 = 0; $size3 = count((array)$menu_2['subsub']); ?>
                                            <?php if (isset($menu_2['subsub']) && is_array($menu_2['subsub'])) { ?>
                                            <?php foreach ($menu_2['subsub'] as $ssubkey => $menu_3) { ?>
                                            <?php if ($index3 == 0) { ?>
                                            <ul class="dropdown-menu">
                                            <?php } ?>
                                                <li class="dropdown-submenu <?php if ($menu_3['active']) echo 'active';?>">
                                                    <a href="<?php echo $menu_3['me_link']; ?>" target="_<?php echo $menu_3['me_target']; ?>">
                                                        <span class="submenu-marker"></span>
                                                        <?php if ($menu_3['me_icon']) { ?>
                                                        <i class="<?php echo $menu_3['me_icon']; ?> margin-right-5"></i>
                                                        <?php } ?>
                                                        <?php echo $menu_3['me_name']; ?>
                                                        <?php if ($menu_3['new']) { ?>
                                                        <i class="far fa-check-circle color-red margin-left-5"></i>
                                                        <?php } ?>
                                                        <?php if ($menu_3['sub'] == 'on') { ?>
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
                                    <?php } ?>
                                    <?php $index2++; } ?>
                                    <?php } ?>
                                </li>
                                <?php } ?>
                                <?php } ?>
                                <li class="hidden-xs hidden-sm"><a href="#" data-toggle="modal" data-target=".all-search-modal"><i class="fas fa-search"></i></a></li>

                                <?php /* ---------- 모바일용 컨텐츠 시작 // 991픽셀 이하에서만 출력 ---------- */ ?>
                                <li class="visible-xs visible-sm nav-li-space"></li>
                                <li class="visible-xs visible-sm nav-mo-half"><a href="<?php echo G5_BBS_URL; ?>/new.php">새글</a></li>
                                <li class="visible-xs visible-sm nav-mo-half board-right-none"><a href="<?php echo G5_BBS_URL; ?>/faq.php">FAQ</a></li>
                                <div class="clearfix"></div>
                                <li class="visible-xs visible-sm"><a href="<?php echo G5_BBS_URL; ?>/qalist.php">1:1문의</a></li>
                                <?php /* ---------- 모바일용 컨텐츠 끝 ---------- */ ?>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            <?php /* End Navbar */ ?>
        </div>
        <?php /* End Header Nav */ ?>

        <div class="header-sticky-space"></div>

        <?php if (!defined('_INDEX_')) { ?>
        <div class="page-title-wrap">
            <div class="container">
            <?php if (!defined('_EYOOM_MYPAGE_')) { ?>
                <h2 class="pull-left">
                    <?php if (!$it_id) { ?>
                    <i class="fas fa-map-marker-alt"></i> <?php echo $subinfo['title']; ?>
                    <?php } else { ?>
                    <span class="font-size-14"><i class="fas fa-map-marker-alt"></i> <?php echo $subinfo['title']; ?></span>
                    <?php } ?>
                </h2>
                <?php if (!$it_id) { ?>
                <ul class="breadcrumb pull-right hidden-xs">
                    <?php echo $subinfo['path']; ?>
                </ul>
                <?php } ?>
                <div class="clearfix"></div>
            <?php } else { ?>
                <h2><i class="fas fa-map-marker-alt"></i> 마이페이지</h2>
            <?php } ?>
            </div>
        </div>
        <?php } ?>

        <?php /* Basic Body */ ?>
        <div class="basic-body container <?php if (!defined('_INDEX_')) { echo 'page-padding'; if ($footer_top == 'yes') { echo ' ft-padding'; }} ?>">
            <?php if (!defined('_INDEX_')) { ?>
            <div class="basic-body-page">
                <?php /* 페이지 카테고리 시작, 서브페이지 사이드 레이아웃 사용 + 991px 이하에서만 출력 */ ?>
                <?php if ($side_layout['use'] == 'yes') { ?>
                <div class="category-mobile-area">
                    <?php if (isset($sidemenu) && $sidemenu) { ?>
                    <div class="tab-scroll-page-category">
                        <div class="scrollbar">
                            <div class="handle">
                                <div class="mousearea"></div>
                            </div>
                        </div>
                        <div id="tab-page-category">
                            <div class="page-category-list">
                                <?php foreach ((array)$sidemenu as $smenu) { ?>
                                <span <?php if ($smenu['active']) echo 'active'; ?>><a href="<?php echo $smenu['me_link']; ?>" target="_<?php echo $smenu['me_target']; ?>"><?php echo $smenu['me_name']; ?></a></span>
                                <?php } ?>
                                <span class="fake-span"></span>
                            </div>
                            <div class="controls">
                                <button class="btn prev"><i class="fas fa-caret-left"></i></button>
                                <button class="btn next"><i class="fas fa-caret-right"></i></button>
                            </div>
                        </div>
                        <div class="tab-page-category-divider"></div>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>
                <?php /* 페이지 카테고리 끝 */ ?>
            <?php } ?>
            <div class="row">
            <?php if ($side_layout['use'] == 'yes') { ?>
                <?php
                if ($side_layout['pos'] == 'left') {
                    /* 사이드영역 시작 */
                    include_once(EYOOM_THEME_PATH . '/side.html.php');
                    /* 사이드영역 끝 */
                }
                ?>
                <section class="basic-body-main <?php if (!defined('_INDEX_')) { echo 'page-padding'; } else { if ($footer_top == 'yes') { echo 'ft-padding';}} ?> <?php if ($side_layout['pos'] == 'left') { echo 'right'; } else { echo 'left'; }?>-main col-md-9">
            <?php } else { ?>
                <section class="basic-body-main col-md-12 <?php if ($footer_top == 'yes') echo 'ft-padding'; ?>">
            <?php } ?>
<?php } // !$wmode ?>