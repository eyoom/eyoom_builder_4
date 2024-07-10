<?php
/**
 * theme file : /theme/THEME_NAME/shop/index.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php /* ---------- 쇼핑몰 메인 EB 슬라이더 시작 ---------- */ ?>
<div class="shop-main-slider-top">
    <?php /* EB슬라이더 - basic */ ?>
    <?php echo eb_slider('1526428620'); ?>
</div>
<?php /* ---------- 쇼핑몰 메인 EB 슬라이더 끝 ---------- */ ?>

<?php /* ---------- 쇼핑몰 브랜드 시작 ---------- */ ?>
<?php if ($eyoom['use_brand'] != 'n') { ?>
<div class="container">
    <div class="main-heading">
        <h2><strong>브랜드</strong></h2>
    </div>
    <div class="m-b-40">
        <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
        <div class="adm-edit-btn btn-edit-mode" style="margin-top:-30px;">
            <div class="btn-group">
                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=brandlist&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> 브랜드관리 설정</a>
                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=brandlist" target="_blank" class="ae-btn-r" title="새창 열기">
                    <i class="fas fa-external-link-alt"></i>
                </a>
            </div>
        </div>
        <?php } ?>
        <?php echo eb_brand('basic'); ?>
    </div>
</div>
<?php } ?>
<?php /* ---------- 쇼핑몰 브랜드 끝 ---------- */ ?>

<div class="container">
    <?php /* ---------- 이벤트박스 시작 ---------- */ ?>
    <?php include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/boxevent.skin.html.php'); // 이벤트 ?>
    <?php /* ---------- 이벤트박스 끝 ---------- */ ?>

    <?php /* ---------- 히트상품 시작 ---------- */ ?>
    <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
    <div class="adm-edit-btn btn-edit-mode" style="margin-top:-25px;">
        <div class="btn-group">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;amode=ittype&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> 유형별 상품진열 설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;thema=<?php echo $theme; ?>#anc_scf_index" target="_blank" class="ae-btn-r" title="새창 열기">
                <i class="fas fa-external-link-alt"></i>
            </a>
        </div>
    </div>
    <?php } ?>

    <?php if($default['de_type1_list_use']) { ?>
    <section class="m-b-40">
        <div class="main-heading">
            <h2><a href="<?php echo shop_type_url(1); ?>"><strong>히트<span class="text-gray">상품</span></strong></a></h2>
        </div>
        <?php
        $list = new item_list($skin_dir.'/'.$default['de_type1_list_skin']);
        $list->set_type(1);
        $list->set_view('it_img', true);
        $list->set_view('it_id', false);
        $list->set_view('it_name', true);
        $list->set_view('it_basic', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', true);
        $list->set_view('sns', true);
        $list->set_view('star', true);
        echo $list->run();
        ?>
    </section>
    <?php } ?>
    <?php /* ---------- 히트상품 끝 ---------- */ ?>

    <?php /* ---------- 추천상품 시작 ---------- */ ?>
    <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
    <div class="adm-edit-btn btn-edit-mode" style="margin-top:-25px;">
        <div class="btn-group">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;amode=ittype&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> 유형별 상품진열 설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;thema=<?php echo $theme; ?>#anc_scf_index" target="_blank" class="ae-btn-r" title="새창 열기">
                <i class="fas fa-external-link-alt"></i>
            </a>
        </div>
    </div>
    <?php } ?>

    <?php if($default['de_type2_list_use']) { ?>
    <section class="m-b-40">
        <div class="main-heading">
            <h2><a href="<?php echo shop_type_url(2); ?>"><strong>추천<span class="text-gray">상품</span></strong></strong></a></h2>
        </div>
        <?php
        $list = new item_list($skin_dir.'/'.$default['de_type2_list_skin']);
        $list->set_type(2);
        $list->set_view('it_id', false);
        $list->set_view('it_name', true);
        $list->set_view('it_basic', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', true);
        $list->set_view('sns', true);
        $list->set_view('star', true);
        echo $list->run();
        ?>
    </section>
    <?php } ?>
    <?php /* ---------- 추천상품 끝 ---------- */ ?>

    <?php /* ---------- 최신상품 시작 ---------- */ ?>
    <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
    <div class="adm-edit-btn btn-edit-mode" style="margin-top:-25px;">
        <div class="btn-group">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;amode=ittype&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> 유형별 상품진열 설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;thema=<?php echo $theme; ?>#anc_scf_index" target="_blank" class="ae-btn-r" title="새창 열기">
                <i class="fas fa-external-link-alt"></i>
            </a>
        </div>
    </div>
    <?php } ?>

    <?php if($default['de_type3_list_use']) { ?>
    <section class="m-b-40">
        <div class="main-heading">
            <h2><a href="<?php echo shop_type_url(3); ?>"><strong>최신<span class="text-gray">상품</span></strong></strong></a></h2>
        </div>
        <?php
        $list = new item_list($skin_dir.'/'.$default['de_type3_list_skin']);
        $list->set_type(3);
        $list->set_view('it_id', false);
        $list->set_view('it_name', true);
        $list->set_view('it_basic', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', true);
        $list->set_view('sns', true);
        $list->set_view('star', true);
        echo $list->run();
        ?>
    </section>
    <?php } ?>
    <?php /* ---------- 최신상품 끝 ---------- */ ?>

    <?php /* ---------- 인기상품 시작 ---------- */ ?>
    <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
    <div class="adm-edit-btn btn-edit-mode" style="margin-top:-25px;">
        <div class="btn-group">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;amode=ittype&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> 유형별 상품진열 설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;thema=<?php echo $theme; ?>#anc_scf_index" target="_blank" class="ae-btn-r" title="새창 열기">
                <i class="fas fa-external-link-alt"></i>
            </a>
        </div>
    </div>
    <?php } ?>

    <?php if($default['de_type4_list_use']) { ?>
    <section class="m-b-40">
        <div class="main-heading">
            <h2><a href="<?php echo shop_type_url(4); ?>"><strong>인기<span class="text-gray">상품</span></strong></strong></a></h2>
        </div>
        <?php
        $list = new item_list($skin_dir.'/'.$default['de_type4_list_skin']);
        $list->set_type(4);
        $list->set_view('it_id', false);
        $list->set_view('it_name', true);
        $list->set_view('it_basic', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', true);
        $list->set_view('sns', true);
        $list->set_view('star', true);
        echo $list->run();
        ?>
    </section>
    <?php } ?>
    <?php /* ---------- 인기상품 끝 ---------- */ ?>

    <?php /* ---------- 할인상품 시작 ---------- */ ?>
    <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
    <div class="adm-edit-btn btn-edit-mode" style="margin-top:-25px;">
        <div class="btn-group">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;amode=ittype&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> 유형별 상품진열 설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;thema=<?php echo $theme; ?>#anc_scf_index" target="_blank" class="ae-btn-r" title="새창 열기">
                <i class="fas fa-external-link-alt"></i>
            </a>
        </div>
    </div>
    <?php } ?>

    <?php if($default['de_type5_list_use']) { ?>
    <section>
        <div class="main-heading">
            <h2><a href="<?php echo shop_type_url(5); ?>"><strong>할인<span class="text-gray">상품</span></strong></strong></a></h2>
        </div>
        <?php
        $list = new item_list($skin_dir.'/'.$default['de_type5_list_skin']);
        $list->set_type(5);
        $list->set_view('it_id', false);
        $list->set_view('it_name', true);
        $list->set_view('it_basic', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', true);
        $list->set_view('sns', true);
        $list->set_view('star', true);
        echo $list->run();
        ?>
    </section>
    <?php } ?>
    <?php /* ---------- 할인상품 끝 ---------- */ ?>
</div>