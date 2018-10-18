<?php
/**
 * theme file : /theme/THEME_NAME/side.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="' . EYOOM_THEME_URL . '/plugins/sly/tab_scroll_category.css" type="text/css" media="screen">',0);
?>

<aside class="basic-body-side <?php echo $side_layout['pos'] == 'left' ? 'left':'right'; ?>-side col-md-3">
    <div class="side-pc-area">
        <?php /* 아웃로그인 시작 */ ?>
        <?php if ( $eyoom['use_gnu_outlogin'] == 'y' ) { //그누보드 스킨일 경우 ?>
            <?php echo outlogin('basic'); ?>
        <?php } else { //이윰 스킨일 경우 ?>
            <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
            <div class="position-relative <?php if ($eyoom['use_outlogin_skin'] == 'n') { ?>eb-hidden-space<?php } ?>">
                <div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="top:-22px;text-align:right">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=layout&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_sidebar(this.href); return false;" class="sidebar-admset-trigger btn-e btn-e-xs btn-e-red" data-action="toggle" data-side="right"><i class="far fa-edit"></i> 아웃로그인 스킨 설정</a>
                </div>
            </div>
            <?php } ?>

            <?php echo eb_outlogin($eyoom['outlogin_skin']); ?>
        <?php } ?>
        <?php /* 아웃로그인 끝 */ ?>

        <?php /* notice_roll_side 최신글 영역 시작 */ ?>
            <?php echo eb_latest('1520320186'); ?>
        <?php /* notice_roll_side 최신글 영역 끝 */ ?>

        <?php /* Side Nav 영역 시작 */ ?>
            <?php if ( !defined('_INDEX_') ) { ?>
            <ul class="sidebar-nav-e1 list-group" id="sidebar-nav">
                <?php if (is_array($sidemenu)) { ?>
                <?php foreach ($sidemenu as $key => $smenu) { ?>
                <li class="list-group-item list-toggle <?php if ($smenu['active']) echo 'active'; ?>">
                    <a <?php if (G5_IS_MOBILE && $smenu['submenu']) { ?>data-toggle="collapse" data-parent="#sidebar-nav" href="#collapse-<?php echo $key; ?>"<?php } else { ?>href="<?php echo $smenu['me_link']; ?>" target="_<?php echo $smenu['me_target']; ?>"<?php } ?>>
                        <?php echo $smenu['me_name']; ?><?php if ( $smenu['new'] ) { ?><i class="fas fa-circle color-red margin-left-5"></i><?php } ?>
                    </a>
                    <ul id="collapse-<?php echo $key; ?>" class="collapse <?php if ($smenu['active']) echo 'in'; ?>">
                        <?php if (is_array($smenu['submenu'])) { ?>
                        <?php foreach ($smenu['submenu'] as $skey => $smenu_2) { ?>
                        <li class="<?php if ($smenu_2['active']) echo 'active'; ?>">
                            <a href="<?php echo $smenu_2['me_link']; ?>" target="_<?php echo $smenu_2['me_target']; ?>">
                                <?php echo $smenu_2['me_name']; ?>
                                <?php if ( $smenu_2['new'] ) { ?>
                                <i class="fas fa-circle color-red margin-left-5"></i>
                                <?php } ?>
                            </a>
                        </li>
                        <?php } ?>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>
                <?php } ?>
            </ul>
            <?php } ?>
        <?php /* Side Nav 영역 끝 */ ?>

        <?php /* 새글 새댓글 최신글 시작 */ ?>
            <?php echo eb_latest('1519177106'); ?>
        <?php /* 새글 새댓글 최신글 끝 */ ?>

        <?php /* 투표 시작 */ ?>
        <?php if ( $eyoom['use_gnu_poll'] == 'y' ) { //그누보드 스킨일 경우 ?>
            <?php echo poll('basic'); ?>
        <?php } else { //이윰 스킨일 경우 ?>
            <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
            <div class="position-relative <?php if ($eyoom['use_poll_skin'] == 'n') { ?>eb-hidden-space<?php } ?>">
                <div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="top:-22px;text-align:right">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=layout&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_sidebar(this.href); return false;" class="sidebar-admset-trigger btn-e btn-e-xs btn-e-red" data-action="toggle" data-side="right"><i class="far fa-edit"></i> 설문조사 스킨 설정</a>
                </div>
            </div>
            <?php } ?>

            <?php echo eb_poll($eyoom['poll_skin']); ?>
        <?php } ?>
        <?php /* 투표 끝 */ ?>

        <?php /* 랭킹 시작 */ ?>
            <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
            <div class="position-relative <?php if ($eyoom['use_ranking_skin'] == 'n') { ?>eb-hidden-space<?php } ?>">
                <div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="top:-22px;text-align:right">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=layout&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_sidebar(this.href); return false;" class="sidebar-admset-trigger btn-e btn-e-xs btn-e-red" data-action="toggle" data-side="right"><i class="far fa-edit"></i> 회원랭킹 스킨 설정</a>
                </div>
            </div>
            <?php } ?>

            <?php echo eb_ranking($eyoom['ranking_skin'], 10); ?>
        <?php /* 랭킹 끝 */ ?>

        <?php /* 인기검색어 시작 */ ?>
        <?php if ( $eyoom['use_gnu_popular'] == 'y' ) { //그누보드 스킨일 경우 ?>
            <?php popular('basic'); ?>
        <?php } else { //이윰 스킨일 경우 ?>
            <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
            <div class="position-relative <?php if ($eyoom['use_popular_skin'] == 'n') { ?>eb-hidden-space<?php } ?>">
                <div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="top:-22px;text-align:right">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=layout&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_sidebar(this.href); return false;" class="sidebar-admset-trigger btn-e btn-e-xs btn-e-red" data-action="toggle" data-side="right"><i class="far fa-edit"></i> 인기검색어 스킨 설정</a>
                </div>
            </div>
            <?php } ?>

            <?php /* 아래는 오늘부터 30일 전까지 인기검색어 10개 추출 소스 */ ?>
            <?php echo eb_popular($eyoom['popular_skin'], 10, 30); ?>
        <?php } ?>
        <?php /* 인기검색어 끝 */ ?>

        <?php /* 태그메뉴 시작 */ ?>
        <?php if ( $eyoom['use_tag'] == 'y' ) { ?>
            <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
            <div class="position-relative <?php if ($eyoom['use_tag_skin'] == 'n') { ?>eb-hidden-space<?php } ?>">
                <div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="top:-22px;text-align:right">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=layout&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_sidebar(this.href); return false;" class="sidebar-admset-trigger btn-e btn-e-xs btn-e-red" data-action="toggle" data-side="right"><i class="far fa-edit"></i> 태그 스킨 설정</a>
                </div>
            </div>
            <?php } ?>

            <?php echo eb_tagmenu($eyoom['tag_skin']); ?>
        <?php } ?>
        <?php /* 태그메뉴 끝 */ ?>

        <?php /* 방문자 통계 시작 */ ?>
        <?php if ( $eyoom['use_gnu_visit'] == 'y' ) { //그누보드 스킨일 경우 ?>
            <?php visit('basic'); ?>
        <?php } else { //이윰 스킨일 경우 ?>
            <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
            <div class="position-relative <?php if ($eyoom['use_visit_skin'] == 'n') { ?>eb-hidden-space<?php } ?>">
                <div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="top:-22px;text-align:right">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=layout&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_sidebar(this.href); return false;" class="sidebar-admset-trigger btn-e btn-e-xs btn-e-red" data-action="toggle" data-side="right"><i class="far fa-edit"></i> 방문자통계 스킨 설정</a>
                </div>
            </div>
            <?php } ?>

            <?php echo eb_visit($eyoom['visit_skin']); ?>
        <?php } ?>
        <?php /* 방문자 통계 끝 */ ?>
    </div>
</aside>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sly/vendor_plugins.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sly/sly.min.js"></script>
<script>
$(function() {
    var $frame = $('#tab-page-category');
    var $wrap  = $frame.parent();
    $frame.sly({
        horizontal: 1,
        itemNav: 'centered',
        smart: 1,
        activateOn: 'click',
        mouseDragging: 1,
        touchDragging: 1,
        releaseSwing: 1,
        scrollBar: $wrap.find('.scrollbar'),
        scrollBy: 1,
        startAt: $frame.find('.active'),
        speed: 300,
        elasticBounds: 1,
        easing: 'easeOutExpo',
        dragHandle: 1,
        dynamicHandle: 1,
        clickBar: 1,
        prev: $wrap.find('.prev'),
        next: $wrap.find('.next')
    });
    var tabWidth = $('#tab-page-category').width();
    var categoryWidth = $('.page-category-list').width();
    if (tabWidth < categoryWidth) {
        $('.controls').show();
    }
});
</script>