<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/admin.head.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
$mb_photo = $eb->mb_photo($member['mb_id'], 'img');

/**
 * 다크모드 사용 : 'yes' || 'no'
 */
$is_darkmode = 'yes';

/**
 * 즐겨찾기 메뉴
 */
$sql = "select * from {$g5['eyoom_favorite_adm']} where (1) and mb_id='{$member['mb_id']}' order by fm_code asc";
$result = sql_query($sql);
$fm_list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $fm_list[$i] = $row;
}
$fm_cnt = count($fm_list);
?>

<script>
var g5_admin_csrf_token_key = "<?php echo (function_exists('admin_csrf_token_key')) ? admin_csrf_token_key() : ''; ?>";
</script>

<?php if (!$wmode) { ?>
<div id="wrapper" class="wrapper <?php echo $g5_sidebar == 'close' ? 'close-nav': ''; ?>">
    <header>
        <div class="header-logo">
            <a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>">
                <strong>ADMIN<span>ISTRATOR</span></strong>
            </a>
        </div>
        <div class="header-bar">
            <div class="header-left">
                <a href="#" id="sidebar_left_btn" class="header-left-btn">
                    <i class="fas fa-bars"></i>
                </a>
                <a href="#" id="sidebar_left_btn_mobile" class="header-left-btn">
                    <i class="fas fa-bars"></i>
                </a>
                <?php if ($fm_cnt > 0) { ?>
                <div class="header-left-dropdown">
                    <a class="left-dropdown-btn dropdown-toggle" href="#" id="fmenuDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="far fa-bookmark"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="fmenuDropdown">
                        <div class="dropdown-header">
                            <p class="mb-0">자주 사용하는 메뉴</p>
                        </div>
                        <div class="dropdown-body">
                            <div class="m-b-5"></div>
                            <?php for($i=0; $i<$fm_cnt; $i++) { ?>
                            <p class="li-p-sq m-b-5"><a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $fm_list[$i]['dir']; ?>&pid=<?php echo $fm_list[$i]['pid']; ?>" class="d-block"><?php echo $fm_list[$i]['me_name']; ?></a></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <a href="#" class="header-left-btn screenfull-btn">
                    <i class="fas fa-expand"></i>
                </a>
            </div>
            <div class="header-nav">
                <ul class="navbar-nav">
                    <?php if ($is_darkmode == 'yes') { ?>
                    <li class="nav-item nav-item-txt">
                        <a href="javascript:void(0);" class="dark-mode-btn">
                            <?php if($modeStyle == 'light') { ?>
                            <i class="fas fa-moon"></i><span>다크모드</span>
                            <?php } else { ?>
                            <i class="fas fa-sun text-amber"></i><span>라이트모드</span>
                            <?php } ?>
                        </a>
                    </li>
                    <?php } ?>
                    <li class="nav-item nav-item-txt"><a href="<?php echo G5_URL; ?>/?theme=<?php echo $eyoom_default['theme']; ?>">홈페이지</a></li>
                    <?php if ($is_youngcart) { ?>
                    <li class="nav-item nav-item-txt"><a href="<?php echo G5_SHOP_URL; ?>/?shop_theme=<?php echo $eyoom_default['shop_theme']; ?>">쇼핑몰</a></li>
                    <li class="nav-item dropdown nav-expand nav-apps">
                        <a class="nav-link dropdown-toggle" href="#" id="appsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-grip-horizontal"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="appsDropdown">
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <p class="mb-0">상점주요메뉴</p>
                                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=configform">쇼핑몰설정<i class="fas fa-ellipsis-v"></i></a>
                            </div>
                            <div class="dropdown-body">
                                <div class="d-flex align-items-center dm-apps">
                                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemlist"><i class="fas fa-boxes"></i><p>상품관리</p></a>
                                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=orderlist"><i class="fas fa-cash-register"></i><p>주문내역</p></a>
                                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&pid=sale1"><i class="fas fa-chart-bar"></i><p>매출현황</p></a>
                                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&pid=itemsellrank"><i class="fas fa-sort-numeric-up"></i><p>판매순위</p></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                    <li class="nav-item dropdown nav-expand nav-profile">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="profile-photo">
                                <?php if (!$mb_photo) { ?>
                                <i class="far fa-user"></i>
                                <?php } else { ?>
                                <?php echo $mb_photo; ?>
                                <?php } ?>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                            <div class="dropdown-header">
                                <?php if (!$mb_photo) { ?>
                                <i class="fas fa-user-circle"></i>
                                <?php } else { ?>
                                <?php echo $mb_photo; ?>
                                <?php } ?>
                                <h6 class="ttc-high ellipsis"><?php echo $member['mb_name']; ?> [<?php echo $member['mb_id']; ?>]</h6>
                                <p class="ttc-lower float-start">Lv. <span><?php echo $eyoomer['level']; ?></p>
                                <p class="ttc-lower float-end">P. <span><?php echo number_format($eyoomer['level_point']); ?></p>
                                <div class="clearfix"></div>
                            </div>
                            <a class="dropdown-item" href="<?php echo G5_BBS_URL; ?>/logout.php"><i class="fas fa-power-off"></i>로그아웃</a>
                        </div>
                    </li>
                </ul>
            </div>
            <?php if(0) { // 우측 사이드바 토글 버튼 숨김 처리 시작 ?>
            <div class="header-right">
                <a href="#" id="sidebar_right_btn" class="header-right-btn">
                    <i class="fas fa-outdent"></i>
                </a>
            </div>
            <?php } // 우측 사이드바 토글 버튼 숨김 처리 끝 ?>
        </div>
    </header>

    <div class="sidebar-left">
        <div class="sidebar-left-in">
            <div class="sidebar-left-top">
                <a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>">
                    <div class="sidebar-top-box">
                        <h5><i class="fas fa-bars"></i>NAVIGATION</h5>
                    </div>
                </a>
            </div>
            <h5 class="sidebar-title"><span>주요메뉴</span><i class="fas fa-grip-lines"></i></h5>
            <ul class="sidebar-left-nav">
                <li class="nav-item <?php if(defined('IS_ADMIN_INDEX')) { ?>active<?php } ?>">
                    <a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>" class="nav-link">
                        <i class="nav-item-icon fas fa-th-large"></i>
                        <span class="nav-item-text">관리자 메인</span>
                    </a>
                </li>
                <?php for($i=0; $i<count((array)$admmenu); $i++) { ?>
                <li class="nav-item <?php echo $admmenu[$i]['active']; ?>">
                    <a href="javascript:void(0)" class="nav-link is-sub-nav">
                        <i class="nav-item-icon fas <?php echo $admmenu[$i]['fa_icon']; ?>"></i>
                        <span class="nav-item-text"><?php echo $admmenu[$i]['menu']; ?></span>
                    </a>
                    <ul class="sub-nav">
                        <?php foreach ($admmenu[$i]['submenu'] as $j => $sub) { ?>
                        <li class="sub-nav-item"><a href="<?php echo $sub['href']; ?>" <?php echo $sub['target']; ?> class="sub-nav-link" id="submenu_<?php echo $sub['skey']; ?>"><?php echo $sub['menu']; ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>
            </ul>
            <?php if ($is_admin == 'super' && $member['mb_id'] == $config['cf_admin']) { ?>
            <h5 class="sidebar-title"><span>추가메뉴</span><i class="fas fa-grip-lines"></i></h5>
            <ul class="sidebar-left-nav">
                <li class="nav-item">
                    <a href="<?php echo G5_ADMIN_URL; ?>/admin.mode.php?to=gnu" class="nav-link">
                        <i class="nav-item-icon fas fa-wrench"></i>
                        <span class="nav-item-text">그누관리자</span>
                    </a>
                </li>
            </ul>
            <?php } ?>
            <h5 class="sidebar-title"><span>설치정보</span><i class="fas fa-grip-lines"></i></h5>
            <div class="sidebar-left-info">
                <div class="sidebar-left-info-box">
                    <div class="install-info-item m-b-15">
                        <p class="install-info-title">설치된 <?php echo G5_VERSION; ?> 버전</p>
                        <h5 class="install-info-cont">
                            <strong><?php echo G5_GNUBOARD_VER; ?></strong>
                            <small>최신버전 : <a href="<?php echo GNU_SITE . '/g5_pds'; ?>" target="_blank">다운로드</a></small>
                        </h5>
                    </div>
                    <div class="install-info-item m-b-15">
                        <p class="install-info-title">설치된 이윰빌더 버전</p>
                        <h5 class="install-info-cont">
                            <strong><?php echo EYOOM_VERSION; ?></strong>
                            <small>최신버전 : <a href="<?php echo EYOOM_SITE . '/eb4_download'; ?>" target="_blank">다운로드</a></small>
                        </h5>
                    </div>
                    <div class="install-info-item m-b-15">
                        <p class="install-info-title">적용중인 테마명</p>
                        <h5 class="install-info-cont"><strong><?php echo $theme; ?></strong></h5>
                    </div>
                    <div class="install-info-item">
                        <p class="install-info-title">최초 설치 일자</p>
                        <h5 class="install-info-cont">
                            <strong><?php echo $eb->date_format('Y.m.d', $adminfo['mb_datetime']); ?></strong>
                            <span><?php echo $eb->date_format('H시 i분', $adminfo['mb_datetime']); ?></span>
                        </h5>
                    </div>
                </div>
            </div>
            <h5 class="sidebar-title"><span>사업자정보</span><i class="fas fa-grip-lines"></i></h5>
            <div class="sidebar-left-info">
                <div class="sidebar-left-info-box">
                    <div class="site-info-cont">
                        <div class="site-info-item">
                            <span class="info-left">회사명 :</span><span class="info-right"><?php echo $bizinfo['bi_company_name']; ?></span>
                        </div>
                        <div class="site-info-item">
                            <span class="info-left">사업자 :</span><span class="info-right"><?php echo $bizinfo['bi_company_bizno']; ?></span>
                        </div>
                        <div class="site-info-item">
                            <span class="info-left">대표자명 :</span><span class="info-right"><?php echo $bizinfo['bi_company_ceo']; ?></span>
                        </div>
                        <div class="site-info-item">
                            <span class="info-left">전화번호 :</span><span class="info-right"><?php echo $bizinfo['bi_company_tel']; ?></span>
                        </div>
                        <?php if ($bizinfo['bi_company_fax']) { ?>
                        <div class="site-info-item">
                            <span class="info-left">팩스번호 :</span><span class="info-right"><?php echo $bizinfo['bi_company_fax']; ?></span>
                        </div>
                        <?php } ?>
                        <?php if ($bizinfo['bi_company_sellno']) { ?>
                        <div class="site-info-item">
                            <span class="info-left">통신판매 :</span><span class="info-right"><?php echo $bizinfo['bi_company_sellno']; ?></span>
                        </div>
                        <?php } ?>
                        <div class="site-info-item">
                            <span class="info-left">책임자 :</span><span class="info-right"><?php echo $bizinfo['bi_company_infoman']; ?></span>
                        </div>
                        <div class="site-info-item">
                            <span class="info-left">이메일 :</span><span class="info-right"><?php echo $bizinfo['bi_company_infomail']; ?></span>
                        </div>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=biz_info" class="site-info-btn btn-e btn-e-xs btn-e-dark m-t-10">수정하기</a>
                    </div>
                </div>
            </div>
            <div class="m-b-30"></div>
        </div>
    </div>
    <?php if(0) { // 우측 사이드바 숨김 처리 시작 ?>
    <div class="sidebar-right">
        <div class="sidebar-right-in">

        </div>
    </div>
    <?php } // 우측 사이드바 숨김 처리 끝 ?>

    <div class="page-content">
        <?php if (!defined('IS_ADMIN_INDEX') && $is_admin == 'super') { ?>
        <div class="content-header d-flex">
            <div class="content-header-title">
                <h4 class="adm_page_title float-start"><?php echo defined('IS_ADMIN_INDEX') ? '관리자 메인': ''; ?></h4>
                <input type="hidden" name="subpage_title" id="subpage_title" value="">
                <div class="eyoom-form float-start">
                    <label class="toggle"><input type="checkbox" id="favorite_menu" value="1"><i></i></label>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="content-header-info">
                <ol class="breadcrumb adm_page_path">
                    <li class="breadcrumb-item"><a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo defined('IS_ADMIN_INDEX') ? '관리자 메인': ''; ?></li>
                </ol>
            </div>
        </div>
        <?php } ?>
        <div class="content-wrapper">
<?php } ?>