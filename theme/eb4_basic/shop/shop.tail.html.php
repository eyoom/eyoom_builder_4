<?php
/**
 * theme file : /theme/THEME_NAME/shop.tail.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php if (!$wmode) { ?>
                </section>
                <?php if ($side_layout['use'] == 'yes') { ?>
                <?php
                if ($side_layout['pos'] == 'right') {
                    /* 사이드영역 시작 */
                    include_once(EYOOM_THEME_SHOP_PATH . '/shop.side.html.php');
                    /* 사이드영역 끝 */
                }
                ?>
                <?php } ?>
                <div class="clearfix"></div>
            </div><?php /* End row */ ?>
            <?php if (!defined('_INDEX_')) { ?>
            </div>
            <?php } ?>
        </div><?php /* End container */ ?>
        <?php /* End Basic Body */ ?>

        <?php /* Footer Top */ ?>
        <div class="footer-top">
            <div class="container">
                <div class="footer-top-content">
                    <div class="footer-top-logo">
                        <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                        <div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="top:-35px">
                            <div class="btn-group">
                                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=biz_info&amp;amode=shoplogo&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-xs btn-e-red btn-e-split"><i class="far fa-edit"></i> 로고 설정</a>
                                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=biz_info&amp;amode=shoplogo&amp;thema=<?php echo $theme; ?>" target="_blank" class="btn-e btn-e-xs btn-e-red btn-e-split-red dropdown-toggle" title="새창 열기">
                                    <i class="far fa-window-maximize"></i>
                                </a>
                            </div>
                        </div>
                        <?php } ?>
                        <a href="<?php echo G5_URL; ?>">
                            <?php if ($logo == 'text') { ?>
                            <h2><?php echo $config['cf_title']; ?></h2>
                            <?php } else if ($logo == 'image') { ?>
                                <?php if (!G5_IS_MOBILE) { ?>
                                <?php if (file_exists($bottom_logo) && !is_dir($bottom_logo)) { ?>
                                <img src="<?php echo $logo_src['bottom']; ?>" class="img-responsive" alt="<?php echo $config['cf_title']; ?>">
                                <?php } else { ?>
                                <img src="<?php echo EYOOM_THEME_URL; ?>/image/site_logo.png" class="img-responsive" alt="<?php echo $config['cf_title']; ?>">
                                <?php } ?>
                                <?php } else { ?>
                                <?php if (file_exists($bottom_mobile_logo) && !is_dir($bottom_mobile_logo)) { ?>
                                <img src="<?php echo $logo_src['mobile_bottom']; ?>" class="img-responsive" alt="<?php echo $config['cf_title']; ?>">
                                <?php } else { ?>
                                <img src="<?php echo EYOOM_THEME_URL; ?>/image/site_logo.png" class="img-responsive" alt="<?php echo $config['cf_title']; ?>">
                                <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </a>
                    </div>
                    <div class="footer-top-info">
                        <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                        <div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="top:-31px">
                            <div class="btn-group">
                                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=biz_info&amp;amode=biz&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-xs btn-e-red btn-e-split"><i class="far fa-edit"></i> 기업정보 설정</a>
                                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=biz_info&amp;amode=biz&amp;thema=<?php echo $theme; ?>" target="_blank" class="btn-e btn-e-xs btn-e-red btn-e-split-red dropdown-toggle" title="새창 열기">
                                    <i class="far fa-window-maximize"></i>
                                </a>
                                <button type="button" class="btn-e btn-e-xs btn-e-red btn-e-split-red popovers" data-container="body" data-toggle="popover" data-placement="top" data-html="true" data-content="
                                    <span class='font-size-11'>
                                    <strong class='color-indigo'>기업정보 사용가능한 변수</strong><br>
                                    <div class='margin-hr-5'></div>
                                    <span class='color-indigo'>[설정정보]</span><br>
                                    회사명 : $bizinfo['bi_company_name']<br>
                                    사업자등록번호 : $bizinfo['bi_company_bizno']<br>
                                    대표자명 : $bizinfo['bi_company_ceo']<br>
                                    대표전화 : $bizinfo['bi_company_tel']<br>
                                    팩스번호 : $bizinfo['bi_company_fax']<br>
                                    통신판매업 : $bizinfo['bi_company_sellno']<br>
                                    부가통신사업자 : $bizinfo['bi_company_bugano']<br>
                                    정보관리책임자 : $bizinfo['bi_company_infoman']<br>
                                    정보책임자메일 : $bizinfo['bi_company_infomail']<br>
                                    우편번호 : $bizinfo['bi_company_zip']<br>
                                    주소1 : $bizinfo['bi_company_addr1']<br>
                                    주소2 : $bizinfo['bi_company_addr2']<br>
                                    주소3 : $bizinfo['bi_company_addr3']<br>
                                    고객센터1 : $bizinfo['bi_cs_tel1']<br>
                                    고객센터2 : $bizinfo['bi_cs_tel2']<br>
                                    고객센터팩스 : $bizinfo['bi_cs_fax']<br>
                                    고객센터메일 : $bizinfo['bi_cs_email']<br>
                                    상담시간 : $bizinfo['bi_cs_time']<br>
                                    휴무안내 : $bizinfo['bi_cs_closed']
                                    </span>
                                "><i class="fas fa-question-circle"></i></button>
                            </div>
                        </div>
                        <?php } ?>
                        <strong><?php echo $bizinfo['bi_company_name']; ?></strong>
                        <span class="info-divider">|</span>
                        <span>대표 : <?php echo $bizinfo['bi_company_ceo']; ?></span>
                        <span class="info-divider">|</span>
                        <span>사업자등록번호 : <?php echo $bizinfo['bi_company_bizno']; ?></span>
                        <?php if($bizinfo['bi_company_sellno']) { ?>
                        <span class="info-divider">|</span>
                        <span>통신판매신고번호 : <?php echo $bizinfo['bi_company_sellno']; ?></span>
                        <?php } ?>
                        <?php if($bizinfo['bi_company_bugano']) { ?>
                        <span class="info-divider">|</span>
                        <span>부가통신사업자 : <?php echo $bizinfo['bi_company_bugano']; ?></span>
                        <?php } ?>
                        <span class="info-divider">|</span>
                        <span>주소 : <?php echo $bizinfo['bi_company_zip']; ?> <?php echo $bizinfo['bi_company_addr1']; ?> <?php echo $bizinfo['bi_company_addr2']; ?> <?php echo $bizinfo['bi_company_addr3']; ?><a href="<?php echo G5_URL; ?>/page/?pid=contactus" class="btn-e btn-e-xs btn-e-default margin-left-5">상세지도</a></span>
                        <span class="info-divider">|</span>
                        <span>E-mail : <a href="mailto:<?php echo $bizinfo['bi_cs_email']; ?>"><?php echo $bizinfo['bi_cs_email']; ?></a></span><br>
                        <span>T. <?php echo $bizinfo['bi_cs_tel1']; ?></span>
                        <span class="info-divider">|</span>
                        <span>F. <?php echo $bizinfo['bi_cs_fax']; ?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php /* End Footer Top */ ?>

        <?php /* Footer */ ?>
        <footer class="footer">
            <div class="container position-relative">
                <div class="footer-left">
                    <ul class="list-unstyled list-inline">
                        <li>
                            <span class="footer-site-name hidden-xs"><?php echo $config['cf_title']; ?></span>
                            <div class="btn-group dropup visible-xs">
                                <span data-toggle="dropdown" class="footer-info-btn dropdown-toggle"><?php echo $config['cf_title']; ?> 정보<i class="fas fa-caret-up margin-left-5"></i></span>
                                <ul role="menu" class="dropdown-menu">
                                    <li><a href="<?php echo get_eyoom_pretty_url('page', 'aboutus'); ?>">회사소개</a></li>
                                    <li class="divider"></li>
                                    <li><a href="<?php echo get_eyoom_pretty_url('page', 'provision'); ?>">이용약관</a></li>
                                    <li><a href="<?php echo get_eyoom_pretty_url('page', 'privacy'); ?>">개인정보처리방침</a></li>
                                    <li><a href="<?php echo get_eyoom_pretty_url('page', 'noemail'); ?>">이메일무단수집거부</a></li>
                                    <li class="divider"></li>
                                    <li><?php if (G5_IS_MOBILE) { ?><a href="<?php echo G5_URL; ?>/?device=pc">PC버전</a><?php } else { ?><a href="<?php echo G5_URL; ?>/?device=mobile">모바일버전</a><?php } ?></li>
                                </ul>
                            </div>
                        </li>
                        <li class="hidden-xs"><a href="<?php echo get_eyoom_pretty_url('page', 'aboutus'); ?>">회사소개</a><a href="<?php echo get_eyoom_pretty_url('page', 'provision'); ?>">이용약관</a><a href="<?php echo get_eyoom_pretty_url('page', 'privacy'); ?>">개인정보처리방침</a><a href="<?php echo get_eyoom_pretty_url('page', 'noemail'); ?>">이메일무단수집거부</a><?php if (G5_IS_MOBILE) { ?><a href="<?php echo G5_URL; ?>/?device=pc" class="btn-e btn-e-xs btn-e-default color-white margin-left-5">PC버전</a><?php } else { ?><a href="<?php echo G5_URL; ?>/?device=mobile" class="btn-e btn-e-xs btn-e-default color-white margin-left-5">모바일버전</a><?php } ?></li>
                    </ul>
                </div>
                <div class="footer-right">
                    <p><span class="hidden-xs">Copyright </span>&copy; <?php echo $config['cf_title']; ?>. All Rights Reserved.</p>
                </div>
            </div>
        </footer>
        <?php /* End Footer */ ?>
    </div><?php /* End Header Fixed */ ?>

    <div class="back-to-top">
        <i class="fas fa-angle-up"></i>
    </div>
</div><?php /* End wrapper */ ?>
<?php } ?>

<?php /** 쇼핑몰 회원 사이드바 시작 **/ ?>
<button type="button" class="sidebar-shop-trigger sidebar-shop-member-btn mo-btn"><i class="fas fa-user-alt"></i></button>
<div class="sidebar-shop-member-wrap">
    <button type="button" class="sidebar-shop-trigger sidebar-shop-member-btn pc-btn"><i class="fas fa-user-alt"></i><span class="direction-icon"><i class="fas fa-outdent"></i></span></button>
    <div class="sidebar-shop-member">
        <div class="sidebar-shop-member-in">
            <?php /* 아웃로그인 시작 */ ?>
            <?php if ( $eyoom['use_gnu_outlogin'] == 'y' ) { //그누보드 스킨일 경우 ?>
                <?php echo outlogin('basic'); ?>
            <?php } else { //이윰 스킨일 경우 ?>
                <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
                <div class="position-relative <?php if ($eyoom['use_outlogin_skin'] == 'n') { ?>eb-hidden-space<?php } ?>">
                    <div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="top:0;text-align:right">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=layout&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_sidebar(this.href); return false;" class="sidebar-admset-trigger btn-e btn-e-xs btn-e-red" data-action="toggle" data-side="right"><i class="far fa-edit"></i> 아웃로그인 스킨 설정</a>
                    </div>
                </div>
                <?php } ?>

                <?php echo eb_outlogin($eyoom['outlogin_skin']); ?>
            <?php } ?>
            <?php /* 아웃로그인 끝 */ ?>

            <div class="shop-member-box">
                <button type="button" class="btn-e btn-e-lg btn-e-dark btn-e-block shop-member-box-btn">오늘본상품<span class="badge badge-red rounded"><?php echo get_view_today_items_count(); ?></span></button>
                <?php include(EYOOM_THEME_SHOP_SKIN_PATH.'/boxtodayview.skin.html.php'); // 오늘 본 상품 ?>
                <button type="button" class="btn-e btn-e-lg btn-e-dark btn-e-block shop-member-box-btn">장바구니<span class="badge badge-red rounded"><?php echo get_boxcart_datas_count(); ?></span></button>
                <?php include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/boxcart.skin.html.php'); // 장바구니 ?>
                <button type="button" class="btn-e btn-e-lg btn-e-dark btn-e-block shop-member-box-btn">위시리스트<span class="badge badge-red rounded"><?php echo get_wishlist_datas_count(); ?></span></button>
                <?php include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/boxwish.skin.html.php'); // 위시리스트 ?>
            </div>

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

            <?php /* 방문자 통계 시작 */ ?>
            <?php if ($is_admin) { ?>
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
            <?php } ?>
            <?php /* 방문자 통계 끝 */ ?>
        </div>
    </div>
</div>
<?php /** 쇼핑몰 회원 사이드바 끝 **/ ?>

<div class="sidebar-left-mask sidebar-left-trigger" data-action="toggle" data-side="left"></div>
<div class="sidebar-right-mask sidebar-right-trigger" data-action="toggle" data-side="right"></div>
<div class="sidebar-shop-mask sidebar-shop-trigger"></div>
<form name="fitem_for_list" method="post" action="" onsubmit="return fitem_for_list_submit(this);">
<input type="hidden" name="url">
<input type="hidden" name="it_id">
</form>

<?php
include_once(EYOOM_THEME_PATH . '/misc.html.php');
?>

<?php
if ($is_member && $eyoomer['onoff_push'] == 'on') {
    include_once(EYOOM_THEME_PATH . '/skin/push/basic/push.skin.html.php');
}
?>

<script src="<?php echo EYOOM_THEME_URL; ?>/js/shop-app.js?ver=<?php echo G5_JS_VER; ?>"></script>
<script>
$(document).ready(function() {
    ShopApp.init();
});

function search_submit(f) {
    if (f.q.value.length < 2) {
        alert("검색어는 두글자 이상 입력하십시오.");
        f.q.select();
        f.q.focus();
        return false;
    }
    return true;
}

function item_wish_for_list(it_id) {
    var f = document.fitem_for_list;
    f.url.value = "<?php echo G5_SHOP_URL; ?>/wishupdate.php?it_id="+it_id;
    f.it_id.value = it_id;
    f.action = "<?php echo G5_SHOP_URL; ?>/wishupdate.php";
    f.submit();
}

<?php if ($is_admin == 'super') { ?>
$(document).ready(function() {
    var edit_mode = "<?php echo $eyoom_default['edit_mode']; ?>";
    if (edit_mode == 'on') {
        $(".btn-edit-mode").show();
    } else {
        $(".btn-edit-mode").hide();
    }

    $("#btn_edit_mode").click(function() {
        var edit_mode = $("#edit_mode").val();
        if (edit_mode == 'on') {
            $(".btn-edit-mode").hide();
            $("#edit_mode").val('');
        } else {
            $(".btn-edit-mode").show();
            $("#edit_mode").val('on');
        }

        $.post("<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=theme_editmode&smode=1", { edit_mode: edit_mode });
    });
});
<?php } ?>
</script>