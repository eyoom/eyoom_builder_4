<?php
/**
 * theme file : /theme/THEME_NAME/shop/index.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/slick/slick.min.css" type="text/css" media="screen">',0);
?>

<div id="fakeloader"></div>

<?php /* ---------- 쇼핑몰 메인 EB 슬라이더 시작 ---------- */ ?>
<div class="main-banner-wrap">
    <div class="main-banner-left"></div>
    <div class="main-banner-right">
        <?php echo eb_slider('1526428620'); ?>
    </div>
    <div class="clearfix"></div>
</div>
<?php /* ---------- 쇼핑몰 메인 EB 슬라이더 끝 ---------- */ ?>

<?php if(0) { // 영카트 매인 배너 스킨 이윰빌더에서는 사용안함 (위 EB 슬라이더로 대체) ?>
<?php /* ---------- 메인 배너 시작 ---------- */ ?>
<?php echo eb_display_banner('메인', 'mainbanner.10.skin.php'); ?>
<?php /* ---------- 메인 배너 끝 ---------- */ ?>
<?php } ?>

<?php /* ---------- 히트상품 시작 ---------- */ ?>
<?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
<div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="margin-top:-20px;">
    <div class="btn-group">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;amode=ittype&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-xs btn-e-red btn-e-split"><i class="far fa-edit"></i> 유형별 상품진열 설정</a>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;thema=<?php echo $theme; ?>#anc_scf_index" target="_blank" class="btn-e btn-e-xs btn-e-red btn-e-split-red dropdown-toggle" title="새창 열기">
            <i class="far fa-window-maximize"></i>
        </a>
    </div>
</div>
<?php } ?>

<?php if($default['de_type1_list_use']) { ?>
<section class="margin-bottom-40">
    <div class="main-heading">
        <h2><a href="<?php echo shop_type_url(1); ?>"><strong>히트상품</strong></a></h2>
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
<div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="margin-top:-20px;">
    <div class="btn-group">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;amode=ittype&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-xs btn-e-red btn-e-split"><i class="far fa-edit"></i> 유형별 상품진열 설정</a>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;thema=<?php echo $theme; ?>#anc_scf_index" target="_blank" class="btn-e btn-e-xs btn-e-red btn-e-split-red dropdown-toggle" title="새창 열기">
            <i class="far fa-window-maximize"></i>
        </a>
    </div>
</div>
<?php } ?>

<?php if($default['de_type2_list_use']) { ?>
<section class="margin-bottom-40">
    <div class="main-heading">
        <h2><a href="<?php echo shop_type_url(2); ?>"><strong>추천상품</strong></a></h2>
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

<?php /* ---------- 이벤트박스 시작 ---------- */ ?>
<?php include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/boxevent.skin.html.php'); // 이벤트 ?>
<?php /* ---------- 이벤트박스 끝 ---------- */ ?>

<?php /* ---------- 최신상품 시작 ---------- */ ?>
<?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
<div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="margin-top:-20px;">
    <div class="btn-group">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;amode=ittype&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-xs btn-e-red btn-e-split"><i class="far fa-edit"></i> 유형별 상품진열 설정</a>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;thema=<?php echo $theme; ?>#anc_scf_index" target="_blank" class="btn-e btn-e-xs btn-e-red btn-e-split-red dropdown-toggle" title="새창 열기">
            <i class="far fa-window-maximize"></i>
        </a>
    </div>
</div>
<?php } ?>

<?php if($default['de_type3_list_use']) { ?>
<section class="margin-bottom-40">
    <div class="main-heading">
        <h2><a href="<?php echo shop_type_url(3); ?>"><strong>최신상품</strong></a></h2>
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
<div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="margin-top:-20px;">
    <div class="btn-group">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;amode=ittype&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-xs btn-e-red btn-e-split"><i class="far fa-edit"></i> 유형별 상품진열 설정</a>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;thema=<?php echo $theme; ?>#anc_scf_index" target="_blank" class="btn-e btn-e-xs btn-e-red btn-e-split-red dropdown-toggle" title="새창 열기">
            <i class="far fa-window-maximize"></i>
        </a>
    </div>
</div>
<?php } ?>

<?php if($default['de_type4_list_use']) { ?>
<section class="margin-bottom-40">
    <div class="main-heading">
        <h2><a href="<?php echo shop_type_url(4); ?>"><strong>인기상품</strong></a></h2>
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
<div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="margin-top:-20px;">
    <div class="btn-group">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;amode=ittype&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-xs btn-e-red btn-e-split"><i class="far fa-edit"></i> 유형별 상품진열 설정</a>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=configform&amp;thema=<?php echo $theme; ?>#anc_scf_index" target="_blank" class="btn-e btn-e-xs btn-e-red btn-e-split-red dropdown-toggle" title="새창 열기">
            <i class="far fa-window-maximize"></i>
        </a>
    </div>
</div>
<?php } ?>

<?php if($default['de_type5_list_use']) { ?>
<section class="margin-bottom-40">
    <div class="main-heading">
        <h2><a href="<?php echo shop_type_url(5); ?>"><strong>할인상품</strong></a></h2>
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

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/fakeLoader/fakeLoader.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/slick/slick.min.js"></script>
<script>
$('#fakeloader').fakeLoader({
    timeToHide:3000,
    zIndex:"11",
    spinner:"spinner6",
    bgColor:"#f4f4f4",
});

$(window).load(function(){
    $('#fakeloader').fadeOut(300);
});
</script>