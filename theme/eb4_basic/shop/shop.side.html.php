<?php
/**
 * theme file : /theme/THEME_NAME/side.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php /*----- 쇼핑몰 회원 사이드바 시작 -----*/ ?>
<button type="button" class="sidebar-shop-trigger sidebar-shop-member-btn mo-btn"><i class="fas fa-user-alt"></i></button>
<aside class="sidebar-shop-member-wrap">
    <button type="button" class="sidebar-shop-trigger sidebar-shop-member-btn pc-btn"><i class="fas fa-user-alt"></i><span class="direction-icon"><i class="fas fa-outdent"></i></span></button>
    <div class="sidebar-shop-member">
        <div class="sidebar-shop-member-in">
            <?php /* 아웃로그인 시작 */ ?>
            <?php if ( $eyoom['use_gnu_outlogin'] == 'y' ) { //그누보드 스킨일 경우 ?>
                <?php echo outlogin('basic'); ?>
            <?php } else { //이윰 스킨일 경우 ?>
                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="position-relative <?php if ($eyoom['use_outlogin_skin'] == 'n') { ?>eb-hidden-space<?php } ?>">
                    <div class="adm-edit-btn btn-edit-mode" style="top:0;text-align:right;z-index:8">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=layout&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_sidebar(this.href); return false;" class="sidebar-admset-trigger ae-btn-l" data-action="toggle" data-side="right"><i class="far fa-edit"></i> 아웃로그인 스킨 설정</a>
                    </div>
                </div>
                <?php } ?>

                <?php echo eb_outlogin($eyoom['outlogin_skin']); ?>
            <?php } ?>
            <?php /* 아웃로그인 끝 */ ?>

			<ul class="rside-nav-list">
				<li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">마이페이지</a></li>
				<li><a href="<?php echo G5_SHOP_URL; ?>/personalpay.php">개인결제</a></li>
				<li><a href="<?php echo G5_BBS_URL; ?>/faq.php">FAQ</a></li>
				<li><a href="<?php echo G5_BBS_URL; ?>/qalist.php">1:1문의</a></li>
			</ul>

            <div class="shop-member-box">
				<div class="panel-group panel-group-control panel-group-control-right" id="accordion_rside">
					<div class="panel">
						<div class="panel-heading">
							<h2 class="panel-title" id="heading_rside1" data-bs-toggle="collapse" data-bs-target="#collapse_rside1" aria-expanded="true" aria-controls="collapse_rside1">
								<span class="count-num"><?php echo get_view_today_items_count(); ?></span>
                                <strong>오늘본상품</strong>
							</h2>
						</div>

						<div id="collapse_rside1" class="collapse show" aria-labelledby="heading_rside1" data-bs-parent="#accordion_rside">
							<div class="panel-body">
								<?php include(EYOOM_THEME_SHOP_SKIN_PATH.'/boxtodayview.skin.html.php'); // 오늘 본 상품 ?>
							</div>
						</div>
					</div>
					<div class="panel">
						<div class="panel-heading">
							<h2 class="panel-title collapsed" id="heading_rside2" data-bs-toggle="collapse" data-bs-target="#collapse_rside2" aria-expanded="false" aria-controls="collapse_rside2">
								<span class="count-num"><?php echo get_boxcart_datas_count(); ?></span>
                                <strong>장바구니</strong>
							</h2>
						</div>
						<div id="collapse_rside2" class="collapse" aria-labelledby="heading_rside2" data-bs-parent="#accordion_rside">
							<div class="panel-body">
								<?php include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/boxcart.skin.html.php'); // 장바구니 ?>
							</div>
						</div>
					</div>
					<div class="panel">
						<div class="panel-heading">
							<h2 class="panel-title collapsed" id="heading_rside3" data-bs-toggle="collapse" data-bs-target="#collapse_rside3" aria-expanded="false" aria-controls="#collapse_rside3">
								<span class="count-num"><?php echo get_wishlist_datas_count(); ?></span>
                                <strong>위시리스트</strong>
							</h2>
						</div>
						<div id="collapse_rside3" class="collapse" aria-labelledby="heading_rside3" data-bs-parent="#accordion_rside">
							<div class="panel-body">
								<?php include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/boxwish.skin.html.php'); // 위시리스트 ?>
							</div>
						</div>
					</div>
				</div>
            </div>

            <?php /* 투표 시작 */ ?>
            <?php if ( $eyoom['use_gnu_poll'] == 'y' ) { //그누보드 스킨일 경우 ?>
                <?php echo poll('basic'); ?>
            <?php } else { //이윰 스킨일 경우 ?>
                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="position-relative <?php if ($eyoom['use_poll_skin'] == 'n') { ?>eb-hidden-space<?php } ?>">
                    <div class="adm-edit-btn btn-edit-mode" style="top:0;text-align:right">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=layout&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_sidebar(this.href); return false;" class="sidebar-admset-trigger ae-btn-l" data-action="toggle" data-side="right"><i class="far fa-edit"></i> 설문조사 스킨 설정</a>
                    </div>
                </div>
                <?php } ?>

                <?php echo eb_poll($eyoom['poll_skin']); ?>
            <?php } ?>
            <?php /* 투표 끝 */ ?>

            <?php /* 방문자 통계 시작 */ ?>
            <?php if ($is_admin) { ?>
                <?php if ( $eyoom['use_gnu_visit'] == 'y' ) { //그누보드 스킨일 경우 ?>
                    <?php visit('basic'); ?>
                <?php } else { //이윰 스킨일 경우 ?>
                    <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                    <div class="position-relative <?php if ($eyoom['use_visit_skin'] == 'n') { ?>eb-hidden-space<?php } ?>">
                        <div class="adm-edit-btn btn-edit-mode" style="top:0;text-align:right">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=layout&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_sidebar(this.href); return false;" class="sidebar-admset-trigger ae-btn-l" data-action="toggle" data-side="right"><i class="far fa-edit"></i> 방문자통계 스킨 설정</a>
                        </div>
                    </div>
                    <?php } ?>

                    <?php echo eb_visit($eyoom['visit_skin']); ?>
                <?php } ?>
            <?php } ?>
            <?php /* 방문자 통계 끝 */ ?>
        </div>
    </div>
</aside>
<?php /*----- 쇼핑몰 회원 사이드바 끝 -----*/ ?>