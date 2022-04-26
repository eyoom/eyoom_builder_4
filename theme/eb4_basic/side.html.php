<?php
/**
 * theme file : /theme/THEME_NAME/side.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<aside class="basic-body-side <?php echo $side_layout['pos'] == 'left' ? 'left':'right'; ?>-side">
    <div class="sidebar-user offcanvas offcanvas-end" tabindex="-1" id="offcanvasUserRight" aria-labelledby="offcanvasUserRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title f-s-16r" id="offcanvasUserRightLabel"><i class="far fa-user text-gray"></i> 회원 사이드바</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="side-contents">
            <?php /* 아웃로그인 시작 */ ?>
            <?php if ( $eyoom['use_gnu_outlogin'] == 'y' ) { //그누보드 스킨일 경우 ?>
                <?php echo outlogin('basic'); ?>
            <?php } else { //이윰 스킨일 경우 ?>
                <?php echo eb_outlogin($eyoom['outlogin_skin']); ?>
            <?php } ?>
            <?php /* 아웃로그인 끝 */ ?>

            <?php /* notice_roll_side 최신글 영역 시작 */ ?>
            <?php echo eb_latest('1520320186'); ?>
            <?php /* notice_roll_side 최신글 영역 끝 */ ?>

            <?php /* Side Nav 영역 시작 */ ?>
            <?php if (!G5_IS_MOBILE) { ?>
            <?php if ( !defined('_INDEX_') ) { ?>
            <ul class="sidebar-nav-e1 m-b-30" id="sidebar-menu1">
                <?php if (isset($menu) && is_array($menu)) { ?>
                <?php foreach ($menu as $key => $menu_1) { ?>
                <li class="sidebar-nav-item <?php if (isset($menu_1['submenu'])) echo 'submenu'; ?> <?php if ($menu_1['active']) echo 'active'; ?>">
                    <a <?php if (isset($menu_1['submenu']) && is_array($menu_1['submenu'])) { ?>data-bs-toggle="collapse" href="#menu1-<?php echo $key; ?>" role="button" aria-expanded="false" aria-controls="menu1-<?php echo $key; ?>"<?php } else { ?>href="<?php echo $menu_1['me_link']; ?>" target="_<?php echo $menu_1['me_target']; ?>"<?php } ?>>
                        <?php echo $menu_1['me_name']?>
                    </a>
                    <?php $index2 = 0; $size2 = count((array)$menu_1['submenu']); ?>
                    <?php if (isset($menu_1['submenu']) && is_array($menu_1['submenu'])) { ?>
                    <?php foreach ($menu_1['submenu'] as $subkey => $menu_2) { ?>
                    <?php if ($index2 == 0) { ?>
                    <ul id="menu1-<?php echo $key; ?>" class="collapse <?php if ($menu_1['active']) echo 'show'; ?>" data-bs-parent="#sidebar-menu1">
                    <?php } ?>
                        <li class="sidebar-nav-item <?php if (isset($menu_2['subsub'])) echo 'submenu'; ?> <?php if ($menu_2['active']) echo 'active'; ?>">
                            <a <?php if (isset($menu_2['subsub']) && is_array($menu_2['subsub'])) { ?>data-bs-toggle="collapse" href="#menu2-<?php echo $index2; ?>" role="button" aria-expanded="false" aria-controls="menu2-<?php echo $index2; ?>"<?php } else { ?>href="<?php echo $menu_2['me_link']; ?>" target="_<?php echo $menu_2['me_target']; ?>"<?php } ?>>
                                <?php echo $menu_2['me_name']; ?>
                            </a>
                            <?php $index3 = 0; $size3 = count((array)$menu_2['subsub']); ?>
                            <?php if (isset($menu_2['subsub']) && is_array($menu_2['subsub'])) { ?>
                            <?php foreach ($menu_2['subsub'] as $ssubkey => $menu_3) { ?>
                            <?php if ($index3 == 0) { ?>
                            <ul id="menu2-<?php echo $index2; ?>" class="collapse <?php if ($menu_2['active']) echo 'show'; ?>">
                            <?php } ?>
                                <li class="sidebar-nav-item <?php if ($menu_3['active']) echo 'active'; ?>">
                                    <a href="<?php echo $menu_3['me_link']; ?>" target="_<?php echo $menu_3['me_target']; ?>" class="<?php if (isset($menu_3['active']) && $menu_3['active']) echo 'active';?>">
                                        <?php echo $menu_3['me_name']; ?>
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
            </ul>
            <?php } ?>
            <?php } ?>
            <?php /* Side Nav 영역 끝 */ ?>

            <?php /* 새글 새댓글 최신글 시작 */ ?>
            <?php echo eb_latest('1519177106'); ?>
            <?php /* 새글 새댓글 최신글 끝 */ ?>

            <?php /* 투표 시작 */ ?>
            <?php if ( $eyoom['use_gnu_poll'] == 'y' ) { //그누보드 스킨일 경우 ?>
            <?php echo poll('basic'); ?>
            <?php } else { //이윰 스킨일 경우 ?>
            <?php echo eb_poll($eyoom['poll_skin']); ?>
            <?php } ?>
            <?php /* 투표 끝 */ ?>

            <?php /* 랭킹 시작 */ ?>
            <?php echo eb_ranking($eyoom['ranking_skin'], 10); ?>
            <?php /* 랭킹 끝 */ ?>

            <?php /* 인기검색어 시작 */ ?>
            <?php if ( $eyoom['use_gnu_popular'] == 'y' ) { //그누보드 스킨일 경우 ?>
            <?php popular('basic'); ?>
            <?php } else { //이윰 스킨일 경우 ?>
            <?php /* 아래는 오늘부터 30일 전까지 인기검색어 10개 추출 소스 */ ?>
            <?php echo eb_popular($eyoom['popular_skin'], 10, 30); ?>
            <?php } ?>
            <?php /* 인기검색어 끝 */ ?>

            <?php /* 태그메뉴 시작 */ ?>
            <?php if ( $eyoom['use_tag'] == 'y' ) { ?>
            <?php echo eb_tagmenu($eyoom['tag_skin']); ?>
            <?php } ?>
            <?php /* 태그메뉴 끝 */ ?>

            <?php /* 방문자 통계 시작 */ ?>
            <?php if ( $eyoom['use_gnu_visit'] == 'y' ) { //그누보드 스킨일 경우 ?>
            <?php visit('basic'); ?>
            <?php } else { //이윰 스킨일 경우 ?>
            <?php echo eb_visit($eyoom['visit_skin']); ?>
            <?php } ?>
            <?php /* 방문자 통계 끝 */ ?>
        </div>
    </div>
</aside>