<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/head.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/fontawesome5/css/fontawesome-all.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/eyoom-form/css/eyoom-form.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/perfect-scrollbar/perfect-scrollbar.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/waves/waves.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/css/common.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/css/style.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/css/custom.css" type="text/css" media="screen">',0);
?>

<?php if (!$wmode) { ?>
<div class="wrapper">
    <div class="eb-logo waves-effect waves-light">
        <a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>">
            <span>ADMINISTRATOR<span>
        </a>
    </div>
    <div id="sidebar_left_scroll" class="eb-sidebar-left">
        <div class="eb-admr-box">
            <div class="eb-admr-photo">
                <?php if (!$member['photo_url']) { ?>
                <i class="fas fa-user-circle"></i>
                <?php } else { ?>
                <img src="<?php echo $member['photo_url']; ?>" class="img-responsive">
                <?php } ?>
            </div>
            <div class="eb-admr-info">
                <h5 class="ellipsis"><?php echo get_text($config['cf_title']); ?></h5>
                <h6 class="ellipsis"><?php echo $member['mb_name']; ?> [<?php echo $member['mb_id']; ?>]</h6>
                <p class="info-left">Lv. <span><?php echo $eyoomer['level']; ?></span></p>
                <p class="info-right">P. <span><?php echo number_format($eyoomer['level_point']); ?></span></p>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <label class="eb-sidebar-title margin-top-20 margin-bottom-10">NAVIGATION</label>
        <ul class="eb-sidebar-left-menu">
            <li class="eb-menu-item menu-item-home <?php if (!$pid) { ?>active<?php } ?>">
                <a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>" class="eb-menu-link waves-effect waves-light">
                    <i class="menu-item-icon fas fa-th-large"></i>
                    <span class="menu-item-text"><strong class="menu-item-main">관리자 메인</strong></span>
                </a>
            </li>
            <?php for($i=0; $i<count((array)$admmenu); $i++) { ?>
            <li class="eb-menu-item <?php echo $admmenu[$i]['active']; ?>">
                <a href="javascript:void(0)" class="eb-menu-link eb-is-submenu waves-effect waves-light">
                    <i class="menu-item-icon fas <?php echo $admmenu[$i]['fa_icon']; ?>"></i>
                    <span class="menu-item-text"><?php echo $admmenu[$i]['menu']; ?></span>
                </a>
                <ul class="eb-menu-sub">
                    <?php foreach ($admmenu[$i]['submenu'] as $j => $sub) { ?>
                    <li class="submenu-item" id="submenu_<?php echo $sub['skey']; ?>"><a href="<?php echo $sub['href']; ?>" <?php echo $sub['target']; ?> class="submenu-link"><?php echo $sub['menu']; ?></a></li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
        </ul>
        <label class="eb-sidebar-title margin-top-20 margin-bottom-10">INFORMATION</label>
        <div class="eb-side-info">
            <div class="eb-side-info-box">
                <div class="side-info-item margin-bottom-15">
                    <p class="side-info-title">설치된 <?php echo $is_youngcart ? '영카트5': '그누보드5'; ?> 버전</p>
                    <h5 class="side-info-cont">
                        <strong class="color-red"><?php echo $is_youngcart ? G5_YOUNGCART_VER: G5_GNUBOARD_VER; ?></strong>
                        <small>최신버전 : <a href="<?php echo $is_youngcart ? GNU_SITE . '/yc5_pds': GNU_SITE . '/g5_pds'; ?>" target="_blank">다운로드</a></small>
                    </h5>
                </div>
                <div class="side-info-item margin-bottom-15">
                    <p class="side-info-title">설치된 이윰빌더 버전</p>
                    <h5 class="side-info-cont">
                        <strong class="color-yellow"><?php echo EYOOM_VERSION; ?></strong>
                        <small>최신버전 : <a href="<?php echo EYOOM_SITE . '/bbs/board.php?bo_table=eb4_download'; ?>" target="_blank">다운로드</a></small>
                    </h5>
                </div>
                <div class="side-info-item margin-bottom-15">
                    <p class="side-info-title">적용중인 테마명</p>
                    <h5 class="side-info-cont"><strong class="color-teal"><?php echo $theme; ?></strong></h5>
                </div>
                <div class="side-info-item">
                    <p class="side-info-title">최초 설치 일자</p>
                    <h5 class="side-info-cont">
                        <?php echo $eb->date_format('Y.m.d', $adminfo['mb_datetime']); ?>
                        <span><?php echo $eb->date_format('H시 i분', $adminfo['mb_datetime']); ?></span>
                    </h5>
                </div>
            </div>
            <div class="eb-site-info-box">
                <div class="site-info-title">
                    <h6>사업자 정보</h6>
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=biz_info" class="site-info-btn btn-e btn-e-xs btn-e-dark">수정하기</a>
                </div>
                <div class="site-info-cont">
                    <div class="site-info-item">
                        <span class="info-left">• 회사명:</span><span class="info-right"><?php echo $bizinfo['bi_company_name']; ?></span>
                    </div>
                    <div class="site-info-item">
                        <span class="info-left">• 사업자:</span><span class="info-right"><?php echo $bizinfo['bi_company_bizno']; ?></span>
                    </div>
                    <div class="site-info-item">
                        <span class="info-left">• 대표자명:</span><span class="info-right"><?php echo $bizinfo['bi_company_ceo']; ?></span>
                    </div>
                    <div class="site-info-item">
                        <span class="info-left">• 전화번호:</span><span class="info-right"><?php echo $bizinfo['bi_company_tel']; ?></span>
                    </div>
                    <?php if ($bizinfo['bi_company_fax']) { ?>
                    <div class="site-info-item">
                        <span class="info-left">• 팩스번호:</span><span class="info-right"><?php echo $bizinfo['bi_company_fax']; ?></span>
                    </div>
                    <?php } ?>
                    <?php if ($bizinfo['bi_company_sellno']) { ?>
                    <div class="site-info-item">
                        <span class="info-left">• 통신판매:</span><span class="info-right"><?php echo $bizinfo['bi_company_sellno']; ?></span>
                    </div>
                    <?php } ?>
                    <div class="site-info-item">
                        <span class="info-left">• 책임자:</span><span class="info-right"><?php echo $bizinfo['bi_company_infoman']; ?></span>
                    </div>
                    <div class="site-info-item">
                        <span class="info-left">• 이메일:</span><span class="info-right"><?php echo $bizinfo['bi_company_infomail']; ?></span>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </div>
    <div class="eb-header">
        <div class="eb-header-left">
            <a id="eb_sidebar_btn_left" href="">
                <div class="eb-icon-btn-left waves-effect waves-light hidden-sm hidden-xs">
                    <i class="fas fa-bars"></i>
                </div>
            </a>
            <a id="eb_sidebar_btn_left_mobile" href="">
                <div class="eb-icon-btn-left waves-effect waves-light hidden-lg hidden-md">
                    <i class="fas fa-bars"></i>
                </div>
            </a>
        </div>
        <div class="eb-header-screenfull hidden-xs" title="전체화면 ON-OFF">
            <i class="far fa-window-maximize"></i>
        </div>
        <div class="eb-header-date-time hidden-xs">
            <div class="eb-header-date"><span id="eb_year"></span><span id="eb_date"></span><span id="eb_week"></span></div>
            <div id="eb_time" class="eb-header-time"></div>
        </div>
        <div class="eb-header-nav">
            <ul class="list-unstyled list-inline">
                <li><a href="<?php echo G5_BBS_URL; ?>/logout.php">로그아웃</a></li>
                <li class="hidden-xs"><a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>">관리자메인</a></li>
                <li class="hidden-xs"><a href="<?php echo G5_ADMIN_URL; ?>/?dir=config&pid=config_form">기본환경설정</a></li>
                <?php if ($is_youngcart) { ?>
                <li class="hidden-xs"><a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=configform">쇼핑몰환경설정</a></li>
                <?php } ?>
                <li><a href="<?php echo G5_URL; ?>/?theme=<?php echo $eyoom_default['theme']; ?>">홈페이지</a></li>
                <?php if ($is_youngcart) { ?>
                <li><a href="<?php echo G5_SHOP_URL; ?>/?shop_theme=<?php echo $eyoom_default['shop_theme']; ?>">쇼핑몰</a></li>
                <?php } ?>
                <?php if ($is_admin == 'super') { ?>
                <li class="hidden-xs"><a href="<?php echo G5_ADMIN_URL; ?>/admin.mode.php?to=gnu">그누관리자</a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="eb-header-right">
            <a id="eb_sidebar_btn_right" href="" class="pos-relative">
                <div class="eb-icon-btn-right waves-effect waves-light">
                    <i class="fas fa-outdent"></i>
                </div>
            </a>
        </div>
    </div>

    <div class="eb-mainarea">
<?php } ?>