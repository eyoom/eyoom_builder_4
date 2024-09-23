<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shop/configform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
if ($config['cf_editor'] == 'tuieditor') echo tuieditor_resource();

/**
 * 페이지 경로 설정
 */
$fm_pid = 'configform';
$g5_title = '쇼핑몰설정';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">쇼핑몰관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';

$frm_eba_submit  = ' <div class="confirm-fixed-btn"> ';
$frm_eba_submit .= ' <input type="submit" value="적용하기" class="btn-e btn-e-md btn-e-crimson" accesskey="s">' ;
$frm_eba_submit .= '</div>';
$frm_submit .= $frm_eba_submit;
?>

<style>
.scf_cardtest_hide {display:none}
.scf_cardtest_tip_adm_hide {display:none}
.cf_tr_hide {display:none}
.tab-current .btn-e {border-color:#8e24aa !important;background-color:#8e24aa !important;color:#fff !important}
.tab-current .btn-e:hover {color:#fff !important}
@media (max-width:1199px) {
    .pg-anchor-in .nav-tabs li:nth-child(4) a, .pg-anchor-in .nav-tabs li:nth-child(5) a, .pg-anchor-in .nav-tabs li:nth-child(6) a {border-bottom:0}
    .adm-form-table .inline-group > span.span-lg-block {display:block;margin-bottom:10px}
}
</style>

<div class="admin-shop-configform">
    <form name="fconfig" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fconfig_check(this);" enctype="multipart/form-data" class="eyoom-form">
    <input type="hidden" name="theme" id="theme" value="<?php echo $this_theme; ?>">
    <input type="hidden" name="wmode" id="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="amode" id="amode" value="<?php echo $amode; ?>">
    <input type="hidden" name="de_admin_company_tel" id="de_admin_company_tel" value="<?php echo $bizinfo['bi_company_tel']; ?>">
    <input type="hidden" name="de_admin_company_name" id="de_admin_company_name" value="<?php echo $bizinfo['bi_company_name']; ?>">
    <input type="hidden" name="de_admin_company_owner" id="de_admin_company_owner" value="<?php echo $bizinfo['bi_company_ceo']; ?>">
    <input type="hidden" name="token" value="">

    <div class="pg-anchor">
        <div class="pg-anchor-in">
            <ul class="nav nav-tabs" role="tablist">
            <?php foreach ($pg_anchor as $anc_id => $anc_name) { ?>
                <li role="presentation">
                    <a href="javasecipt:void(0);" class="anchor-menu <?php echo $anc_id; ?>" id="<?php echo $anc_id; ?>_tab" data-bs-toggle="tab" data-bs-target="#<?php echo $anc_id; ?>"><?php echo $anc_name; ?></a>
                </li>
            <?php } ?>
            </ul>
            <div class="tab-bottom-line"></div>
        </div>
    </div>

    <div class="tab-content">
        <?php if (!$amode) { ?>
        <?php /* 스킨설정 : 시작 */ ?>
        <div class="tab-pane show active" id="anc_scf_skin" role="tabpanel" aria-labelledby="anc_scf_skin_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>스킨설정</strong></div>
                <div class="adm-form-info">
                    <div class="cont-text-bg">
                        <p class="bg-info">
                            <i class="fas fa-info-circle"></i> 상품 분류리스트, 상품상세보기 등 에서 사용할 스킨을 설정합니다.
                        </p>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_shop_skin" class="label">PC용 스킨</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <?php echo get_skin_select('shop', 'de_shop_skin', 'de_shop_skin', $default['de_shop_skin'], 'required'); ?><i></i>
                        </label>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_shop_mobile_skin" class="label">모바일용 스킨</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <?php echo get_mobile_skin_select('shop', 'de_shop_mobile_skin', 'de_shop_mobile_skin', $default['de_shop_mobile_skin'], 'required'); ?><i></i>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 스킨설정 : 끝 */ ?>
        <?php } ?>

        <?php if (!$amode || $amode == 'ittype') { ?>
        <?php /* 쇼핑몰 초기화면 : 시작 */ ?>
        <div class="tab-pane" id="anc_scf_index" role="tabpanel" aria-labelledby="anc_scf_index_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>쇼핑몰 초기화면</strong></div>
                <div class="adm-form-info">
                    <div class="cont-text-bg">
                        <p class="bg-info">
                            <i class="fas fa-info-circle"></i> 상품관리에서 선택한 상품의 타입대로 쇼핑몰 초기화면에 출력합니다. (상품 타입 히트/추천/최신/인기/할인)<br>
                            <i class="fas fa-info-circle"></i> 각 타입별로 선택된 상품이 없으면 쇼핑몰 초기화면에 출력하지 않습니다.
                        </p>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">히트상품출력</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <span class="span-lg-block">
                                <label class="checkbox width-100px">
                                    <input type="checkbox" name="de_type1_list_use" id="de_type1_list_use" value="1" <?php echo $default['de_type1_list_use']?"checked":""; ?>>
                                    <i></i> 출력
                                </label>
                                <div class="clearfix"></div>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_type1_list_skin" class="label">스킨</label>
                                <label class="select width-200px">
                                    <select name="de_type1_list_skin" id="de_type1_list_skin">
                                        <?php echo get_list_skin_options("^main.[0-9]+\.skin\.php", G5_SHOP_SKIN_PATH, $default['de_type1_list_skin']); ?>
                                    </select><i></i>
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_type1_list_mod" class="label">1줄당 이미지 수</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_type1_list_mod" value="<?php echo get_sanitize_input($default['de_type1_list_mod']); ?>" id="de_type1_list_mod">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_type1_list_row" class="label">출력할 줄 수</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_type1_list_row" value="<?php echo get_sanitize_input($default['de_type1_list_row']); ?>" id="de_type1_list_row">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_type1_img_width" class="label">이미지 폭</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_type1_img_width" value="<?php echo get_sanitize_input($default['de_type1_img_width']); ?>" id="de_type1_img_width">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_type1_img_height" class="label">이미지 높이</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_type1_img_height" value="<?php echo get_sanitize_input($default['de_type1_img_height']); ?>" id="de_type1_img_height">
                                </label>
                            </span>
                        </div>
                        <p class="li-p-sq f-s-13r text-gray m-t-10">출력갯수 = 1줄당 이미지 수 x 출력할 줄 수</p>
                        <p class="li-p-sq f-s-13r text-gray">사용중인 테마에 따라서 1줄당 이미지 수가 입력한 갯수대로 적용이 안될수 있습니다. (테마 최적화 문제)</p>
                        <p class="li-p-sq f-s-13r text-gray">이미지높이를 0으로 설정하면 상품이미지를 이미지폭에 비례하여 생성합니다.</p>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">추천상품출력</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <span class="span-lg-block">
                                <label class="checkbox width-100px"">
                                    <input type="checkbox" name="de_type2_list_use" id="de_type2_list_use" value="1" <?php echo $default['de_type2_list_use']?"checked":""; ?>>
                                    <i></i> 출력
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_type2_list_skin" class="label">스킨</label>
                                <label class="select width-200px"">
                                    <select name="de_type2_list_skin" id="de_type2_list_skin">
                                        <?php echo get_list_skin_options("^main.[0-9]+\.skin\.php", G5_SHOP_SKIN_PATH, $default['de_type2_list_skin']); ?>
                                    </select><i></i>
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_type2_list_mod" class="label">1줄당 이미지 수</label>
                                <label class="input width-120px"">
                                    <input type="text" name="de_type2_list_mod" value="<?php echo get_sanitize_input($default['de_type2_list_mod']); ?>" id="de_type2_list_mod">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_type2_list_row" class="label">출력할 줄 수</label>
                                <label class="input width-120px"">
                                    <input type="text" name="de_type2_list_row" value="<?php echo get_sanitize_input($default['de_type2_list_row']); ?>" id="de_type2_list_row">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_type2_img_width" class="label">이미지 폭</label>
                                <label class="input width-120px"">
                                    <input type="text" name="de_type2_img_width" value="<?php echo get_sanitize_input($default['de_type2_img_width']); ?>" id="de_type2_img_width">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_type2_img_height" class="label">이미지 높이</label>
                                <label class="input width-120px"">
                                    <input type="text" name="de_type2_img_height" value="<?php echo get_sanitize_input($default['de_type2_img_height']); ?>" id="de_type2_img_height">
                                </label>
                            </span>
                        </div>
                        <p class="li-p-sq f-s-13r text-gray m-t-10">출력갯수 = 1줄당 이미지 수 x 출력할 줄 수</p>
                        <p class="li-p-sq f-s-13r text-gray">사용중인 테마에 따라서 1줄당 이미지 수가 입력한 갯수대로 적용이 안될수 있습니다. (테마 최적화 문제)</p>
                        <p class="li-p-sq f-s-13r text-gray">이미지높이를 0으로 설정하면 상품이미지를 이미지폭에 비례하여 생성합니다.</p>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">최신상품출력</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <span class="span-lg-block">
                                <label class="checkbox width-100px">
                                    <input type="checkbox" name="de_type3_list_use" id="de_type3_list_use" value="1" <?php echo $default['de_type3_list_use']?"checked":""; ?>>
                                    <i></i> 출력
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_type3_list_skin" class="label">스킨</label>
                                <label class="select width-200px">
                                    <select name="de_type3_list_skin" id="de_type3_list_skin">
                                        <?php echo get_list_skin_options("^main.[0-9]+\.skin\.php", G5_SHOP_SKIN_PATH, $default['de_type3_list_skin']); ?>
                                    </select><i></i>
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_type3_list_mod" class="label">1줄당 이미지 수</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_type3_list_mod" value="<?php echo get_sanitize_input($default['de_type3_list_mod']); ?>" id="de_type3_list_mod">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_type3_list_row" class="label">출력할 줄 수</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_type3_list_row" value="<?php echo get_sanitize_input($default['de_type3_list_row']); ?>" id="de_type3_list_row">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_type3_img_width" class="label">이미지 폭</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_type3_img_width" value="<?php echo get_sanitize_input($default['de_type3_img_width']); ?>" id="de_type3_img_width">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_type3_img_height" class="label">이미지 높이</label>
                                <label class="input width-120px"">
                                    <input type="text" name="de_type3_img_height" value="<?php echo get_sanitize_input($default['de_type3_img_height']); ?>" id="de_type3_img_height">
                                </label>
                            </span>
                        </div>
                        <p class="li-p-sq f-s-13r text-gray m-t-10">출력갯수 = 1줄당 이미지 수 x 출력할 줄 수</p>
                        <p class="li-p-sq f-s-13r text-gray">사용중인 테마에 따라서 1줄당 이미지 수가 입력한 갯수대로 적용이 안될수 있습니다. (테마 최적화 문제)</p>
                        <p class="li-p-sq f-s-13r text-gray">이미지높이를 0으로 설정하면 상품이미지를 이미지폭에 비례하여 생성합니다.</p>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">인기상품출력</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <span class="span-lg-block">
                                <label class="checkbox width-100px">
                                    <input type="checkbox" name="de_type4_list_use" id="de_type4_list_use" value="1" <?php echo $default['de_type4_list_use']?"checked":""; ?>>
                                    <i></i> 출력
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_type4_list_skin" class="label">스킨</label>
                                <label class="select width-200px">
                                    <select name="de_type4_list_skin" id="de_type4_list_skin">
                                        <?php echo get_list_skin_options("^main.[0-9]+\.skin\.php", G5_SHOP_SKIN_PATH, $default['de_type4_list_skin']); ?>
                                    </select><i></i>
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_type4_list_mod" class="label">1줄당 이미지 수</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_type4_list_mod" value="<?php echo get_sanitize_input($default['de_type4_list_mod']); ?>" id="de_type4_list_mod">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_type4_list_row" class="label">출력할 줄 수</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_type4_list_row" value="<?php echo get_sanitize_input($default['de_type4_list_row']); ?>" id="de_type4_list_row">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_type4_img_width" class="label">이미지 폭</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_type4_img_width" value="<?php echo get_sanitize_input($default['de_type4_img_width']); ?>" id="de_type4_img_width">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_type4_img_height" class="label">이미지 높이</label>
                                <label class="input width-120px"">
                                    <input type="text" name="de_type4_img_height" value="<?php echo get_sanitize_input($default['de_type4_img_height']); ?>" id="de_type4_img_height">
                                </label>
                            </span>
                        </div>
                        <p class="li-p-sq f-s-13r text-gray m-t-10">출력갯수 = 1줄당 이미지 수 x 출력할 줄 수</p>
                        <p class="li-p-sq f-s-13r text-gray">사용중인 테마에 따라서 1줄당 이미지 수가 입력한 갯수대로 적용이 안될수 있습니다. (테마 최적화 문제)</p>
                        <p class="li-p-sq f-s-13r text-gray">이미지높이를 0으로 설정하면 상품이미지를 이미지폭에 비례하여 생성합니다.</p>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">할인상품출력</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <span class="span-lg-block">
                                <label class="checkbox width-100px">
                                    <input type="checkbox" name="de_type5_list_use" id="de_type5_list_use" value="1" <?php echo $default['de_type5_list_use']?"checked":""; ?>>
                                    <i></i> 출력
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_type5_list_skin" class="label">스킨</label>
                                <label class="select width-200px">
                                    <select name="de_type5_list_skin" id="de_type5_list_skin">
                                        <?php echo get_list_skin_options("^main.[0-9]+\.skin\.php", G5_SHOP_SKIN_PATH, $default['de_type5_list_skin']); ?>
                                    </select><i></i>
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_type5_list_mod" class="label">1줄당 이미지 수</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_type5_list_mod" value="<?php echo get_sanitize_input($default['de_type5_list_mod']); ?>" id="de_type5_list_mod">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_type5_list_row" class="label">출력할 줄 수</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_type5_list_row" value="<?php echo get_sanitize_input($default['de_type5_list_row']); ?>" id="de_type5_list_row">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_type5_img_width" class="label">이미지 폭</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_type5_img_width" value="<?php echo get_sanitize_input($default['de_type5_img_width']); ?>" id="de_type5_img_width">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_type5_img_height" class="label">이미지 높이</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_type5_img_height" value="<?php echo get_sanitize_input($default['de_type5_img_height']); ?>" id="de_type5_img_height">
                                </label>
                            </span>
                        </div>
                        <p class="li-p-sq f-s-13r text-gray m-t-10">출력갯수 = 1줄당 이미지 수 x 출력할 줄 수</p>
                        <p class="li-p-sq f-s-13r text-gray">사용중인 테마에 따라서 1줄당 이미지 수가 입력한 갯수대로 적용이 안될수 있습니다. (테마 최적화 문제)</p>
                        <p class="li-p-sq f-s-13r text-gray">이미지높이를 0으로 설정하면 상품이미지를 이미지폭에 비례하여 생성합니다.</p>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 쇼핑몰 초기화면 : 끝 */ ?>
        <?php } ?>

        <?php if (!$amode) { ?>
        <?php /* 결제설정 : 시작 */ ?>
        <div class="tab-pane" id="anc_scf_payment" role="tabpanel" aria-labelledby="anc_scf_payment_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>결제설정</strong></div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_bank_use" class="label">무통장입금사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select id="de_bank_use" name="de_bank_use">
                                <option value="0" <?php echo get_selected($default['de_bank_use'], 0); ?>>사용안함</option>
                                <option value="1" <?php echo get_selected($default['de_bank_use'], 1); ?>>사용</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 주문시 무통장으로 입금을 가능하게 할것인지를 설정합니다.<br>사용할 경우 은행계좌번호를 반드시 입력하여 주십시오.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_shop_mobile_skin" class="label">은행계좌번호</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="textarea">
                            <textarea name="de_bank_account" id="de_bank_account"><?php echo html_purifier($default['de_bank_account']); ?></textarea>
                        </label>
                        <div class="note"><strong>Note:</strong> 무통장 계좌번호를 입력해 주세요. 엔터를 입력하여 여러개의 계좌번호를 등록하실 수 있습니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_iche_use" class="label">계좌이체 결제사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select id="de_iche_use" name="de_iche_use">
                                <option value="0" <?php echo get_selected($default['de_iche_use'], 0); ?>>사용안함</option>
                                <option value="1" <?php echo get_selected($default['de_iche_use'], 1); ?>>사용</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 주문시 실시간 계좌이체를 가능하게 할것인지를 설정합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_vbank_use" class="label">가상계좌 결제사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select name="de_vbank_use" id="de_vbank_use">
                                <option value="0" <?php echo get_selected($default['de_vbank_use'], 0); ?>>사용안함</option>
                                <option value="1" <?php echo get_selected($default['de_vbank_use'], 1); ?>>사용</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 주문별로 유일하게 생성되는 일회용 계좌번호입니다. 주문자가 가상계좌에 입금시 상점에 실시간으로 통보가 되므로 업무처리가 빨라집니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr pg_vbank_url" id="kcp_vbank_url">
                    <div class="adm-form-td td-l">
                        <label class="label">NHN KCP 가상계좌 입금통보 URL</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <?php echo G5_SHOP_URL; ?>/settle_kcp_common.php<br>
                        <div class="note"><strong>Note:</strong> NHN KCP 가상계좌 사용시 위 주소를 <strong><a href="http://admin.kcp.co.kr" target="_blank">NHN KCP 관리자</a> &gt; 상점정보관리 &gt; 정보변경 &gt; 공통URL 정보 &gt; 공통URL 변경후</strong>에 넣으셔야 상점에 자동으로 입금 통보됩니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr pg_vbank_url" id="inicis_vbank_url">
                    <div class="adm-form-td td-l">
                        <label class="label">KG이니시스 가상계좌 입금통보 URL</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <?php echo G5_SHOP_URL; ?>/settle_inicis_common.php<br>
                        <div class="note"><strong>Note:</strong> KG이니시스 가상계좌 사용시 위 주소를 <strong><a href="https://iniweb.inicis.com/" target="_blank">KG이니시스 관리자</a> &gt; 거래조회 &gt; 가상계좌 &gt; 입금통보방식선택 &gt; URL 수신 설정</strong>에 넣으셔야 상점에 자동으로 입금 통보됩니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr pg_vbank_url" id="nicepay_vbank_url">
                    <div class="adm-form-td td-l">
                        <label class="label">NICEPAY 가상계좌 입금통보 URL</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <?php echo G5_SHOP_URL; ?>/settle_nicepay_common.php<br>
                        <div class="note"><strong>Note:</strong> NICEPAY 가상계좌 사용시 다음 주소를 <strong><a href="https://npg.nicepay.co.kr/" target="_blank">NICEPAY 관리자</a> &gt; 가맹점관리자페이지 설정 (메인화면 → 가맹점정보 클릭)</strong>에 넣으셔야 상점에 자동으로 입금 통보됩니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_hp_use" class="label">휴대폰결제사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select id="de_hp_use" name="de_hp_use">
                                <option value="0" <?php echo get_selected($default['de_hp_use'], 0); ?>>사용안함</option>
                                <option value="1" <?php echo get_selected($default['de_hp_use'], 1); ?>>사용</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 주문시 휴대폰 결제를 가능하게 할것인지를 설정합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_card_use" class="label">신용카드결제사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select id="de_card_use" name="de_card_use">
                                <option value="0" <?php echo get_selected($default['de_card_use'], 0); ?>>사용안함</option>
                                <option value="1" <?php echo get_selected($default['de_card_use'], 1); ?>>사용</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 주문시 신용카드 결제를 가능하게 할것인지를 설정합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_card_noint_use" class="label">신용카드 무이자할부사용<br>(KCP 만 해당)</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select id="de_card_noint_use" name="de_card_noint_use">
                                <option value="0" <?php echo get_selected($default['de_card_noint_use'], 0); ?>>사용안함</option>
                                <option value="1" <?php echo get_selected($default['de_card_noint_use'], 1); ?>>사용</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 주문시 신용카드 무이자할부를 가능하게 할것인지를 설정합니다.<br>사용으로 설정하시면 KCP PG사 가맹점 관리자 페이지에서 설정하신 무이자할부 설정이 적용됩니다.<br>사용안함으로 설정하시면 PG사 무이자 이벤트 카드를 제외한 모든 카드의 무이자 설정이 적용되지 않습니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_easy_pay_use" class="label">PG사 간편결제 버튼 사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select id="de_easy_pay_use" name="de_easy_pay_use">
                                <option value="0" <?php echo get_selected($default['de_easy_pay_use'], 0); ?>>노출안함</option>
                                <option value="1" <?php echo get_selected($default['de_easy_pay_use'], 1); ?>>노출함</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 주문서 작성 페이지에 PG사 간편결제(PAYCO, PAYNOW, KPAY) 버튼의 별도 사용 여부를 설정합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_taxsave_use" class="label">현금영수증 발급사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select id="de_taxsave_use" name="de_taxsave_use">
                                <option value="0" <?php echo get_selected($default['de_taxsave_use'], 0); ?>>사용안함</option>
                                <option value="1" <?php echo get_selected($default['de_taxsave_use'], 1); ?>>사용</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 관리자는 설정에 관계없이 <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=orderlist">주문내역</a> &gt; 보기에서 발급이 가능합니다.<br>현금영수증 발급 취소는 PG사에서 지원하는 현금영수증 취소 기능을 사용하시기 바랍니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_taxsave_types" class="label">현금영수증 적용수단</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <label class="checkbox" for="de_taxsave_types_account"><input type="checkbox" id="de_taxsave_types_account" name="de_taxsave_types_account" value="account" <?php echo $account_checked; ?> ><i></i> 무통장입금</label>
                            <label class="checkbox" for="de_taxsave_types_vbank"><input type="checkbox" id="de_taxsave_types_vbank" name="de_taxsave_types_vbank" value="vbank" <?php echo $vbank_checked; ?> ><i></i> 가상계좌</label>
                            <label class="checkbox" for="de_taxsave_types_transfer"><input type="checkbox" id="de_taxsave_types_transfer" name="de_taxsave_types_transfer" value="transfer" <?php echo $transfer_checked; ?> ><i></i> 실시간계좌이체</label>
                        </div>
                        <div class="note"><strong>Note:</strong> 현금영수증 발급 사용일 경우 해당됩니다.<br>현금 영수증 발급은 무통장입금, 가상계좌, 실시간계좌에만 적용됩니다.<br>아래 체크된 수단에 한해서 회원이 직접 주문 보기 페이지에서 현금영수증을 발급 받을수 있습니다.<br>!!! 만약 PG사 상점관리자에서 가상계좌 또는 실시간계좌이체가 자동으로 현금영수증이 발급되는 경우이면, 아래 가상계좌와 실시간계좌이체 체크박스를 해제하여 사용해 주세요.( 중복으로 발급되는 것을 막기 위함입니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="cf_use_point" class="label">포인트 사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="cf_use_point" class="checkbox max-width-250px">
                            <input type="checkbox" name="cf_use_point" value="1" id="cf_use_point"<?php echo $config['cf_use_point']?' checked':''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=config_form#frm_board">환경설정</a> &gt; 기본환경설정</a>과 동일한 설정입니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_settle_min_point" class="label">결제 최소포인트</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_settle_min_point" class="input max-width-250px">
                            <i class="icon-append">점</i>
                            <input type="text" name="de_settle_min_point" value="<?php echo get_sanitize_input($default['de_settle_min_point']); ?>" id="de_settle_min_point" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 회원의 포인트가 설정값 이상일 경우만 주문시 결제에 사용할 수 있습니다. 포인트 사용을 하지 않는 경우에는 의미가 없습니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_settle_max_point" class="label">최대 결제포인트</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_settle_max_point" class="input max-width-250px">
                            <i class="icon-append">점</i>
                            <input type="text" name="de_settle_max_point" value="<?php echo get_sanitize_input($default['de_settle_max_point']); ?>" id="de_settle_max_point" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 주문 결제시 최대로 사용할 수 있는 포인트를 설정합니다. 포인트 사용을 하지 않는 경우에는 의미가 없습니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_settle_point_unit" class="label">결제 포인트단위</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select id="de_settle_point_unit" name="de_settle_point_unit">
                                <option value="100" <?php echo get_selected($default['de_settle_point_unit'], 100); ?>>100</option>
                                <option value="10"  <?php echo get_selected($default['de_settle_point_unit'],  10); ?>>10</option>
                                <option value="1"   <?php echo get_selected($default['de_settle_point_unit'],   1); ?>>1</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 주문 결제시 사용되는 포인트의 절사 단위를 설정합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_card_point" class="label">포인트부여</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select id="de_card_point" name="de_card_point">
                                <option value="0" <?php echo get_selected($default['de_card_point'], 0); ?>>아니오</option>
                                <option value="1" <?php echo get_selected($default['de_card_point'], 1); ?>>예</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 신용카드, 계좌이체, 휴대폰 결제시 포인트를 부여할지를 설정합니다. (기본값은 '아니오')</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_point_days" class="label">주문완료 포인트</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_settle_max_point" class="input max-width-250px">
                            <i class="icon-append">일</i>
                            <input type="text" name="de_point_days" value="<?php echo get_sanitize_input($default['de_point_days']); ?>" id="de_point_days" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 주문완료 후 지정한 일자 이후에 주문자가 회원일 경우에만 포인트를 지급합니다. 주문취소, 반품 등을 고려하여 포인트를 지급할 적당한 기간을 입력하십시오. (기본값은 7일)<br>0일로 설정하는 경우에는 주문완료와 동시에 포인트를 지급합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="de_pg_service" class="label"><strong class="text-purple">결제대행사</strong></label>
                    </div>
                    <div class="adm-form-td td-r">
                        <input type="hidden" name="de_pg_service" id="de_pg_service" value="<?php echo $default['de_pg_service']; ?>" >
                        <div class="m-b-5 de_pg_tab">
                            <span class="<?php if($default['de_pg_service'] == 'kcp') echo 'tab-current'; ?>"><a href="#kcp_info_anchor" class="btn-e btn-e-lg btn-e-dark btn-e-brd m-b-5" data-value="kcp" title="NHN KCP 선택하기" >NHN KCP</a></span>
                            <span class="<?php if($default['de_pg_service'] == 'lg') echo 'tab-current'; ?>"><a href="#lg_info_anchor" class="btn-e btn-e-lg btn-e-dark btn-e-brd m-b-5" data-value="lg" title="토스페이먼츠 선택하기">토스페이먼츠</a></span>
                            <span class="<?php if($default['de_pg_service'] == 'inicis') echo 'tab-current'; ?>"><a href="#inicis_info_anchor" class="btn-e btn-e-lg btn-e-dark btn-e-brd m-b-5" data-value="inicis" title="KG이니시스 선택하기">KG이니시스</a></span>
                            <span class="<?php if($default['de_pg_service'] == 'nicepay') echo 'tab-current'; ?>"><a href="#nicepay_info_anchor" class="btn-e btn-e-lg btn-e-dark btn-e-brd m-b-5" data-value="nicepay" title="NICEPAY 선택하기">NICEPAY</a></span>
                        </div>
                        <div class="note margin-bottom-10"><strong>Note:</strong> 쇼핑몰에서 사용할 결제대행사를 선택합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100 pg_info_fld kcp_info_fld" id="kcp_info_anchor">
                    <div class="adm-form-td td-l">
                        <label for="de_kcp_mid" class="label"><strong class="text-indigo">NHN KCP SITE CODE</strong></label>
                    </div>
                    <div class="adm-form-td td-r">
                        <a href="http://sir.kr/main/service/p_pg.php" target="_blank" id="scf_kcpreg" class="btn-e btn-e-lg btn-e-indigo width-250px m-b-10">NHN KCP 신청하기</a>
                        <label for="de_kcp_mid" class="input max-width-250px">
                            <i class="icon-prepend text-width">SR</i>
                            <input type="text" name="de_kcp_mid" value="<?php echo get_sanitize_input($default['de_kcp_mid']); ?>" id="de_kcp_mid">
                        </label>
                        <div class="note"><strong>Note:</strong> NHN KCP 에서 받은 SR 로 시작하는 영대문자, 숫자 혼용 총 5자리 중 SR 을 제외한 나머지 3자리 SITE CODE 를 입력하세요.<br>만약, 사이트코드가 SR로 시작하지 않는다면 NHN KCP에 사이트코드 변경 요청을 하십시오. 예) SR9A3</div>
                    </div>
                </div>
                <div class="adm-form-tr pg_info_fld kcp_info_fld">
                    <div class="adm-form-td td-l">
                        <label for="de_kcp_site_key" class="label">NHN KCP SITE KEY</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_kcp_site_key" class="input">
                            <input type="text" name="de_kcp_site_key" value="<?php echo get_sanitize_input($default['de_kcp_site_key']); ?>" id="de_kcp_site_key">
                        </label>
                        <div class="note"><strong>Note:</strong> 25자리 영대소문자와 숫자 - 그리고 _ 로 이루어 집니다. SITE KEY 발급 NHN KCP 전화: 1544-8660<br>예) 1Q9YRV83gz6TukH8PjH0xFf__</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_easy_pays" class="label">NHN KCP 간편결제</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <label class="checkbox" for="de_easy_nhnkcp_payco" disabled><input type="checkbox" id="de_easy_nhnkcp_payco" name="de_easy_pays[]" value="nhnkcp_payco" <?php if(stripos($default['de_easy_pay_services'], 'nhnkcp_payco') !== false){ echo 'checked="checked"'; } ?> ><i></i> PAYCO (페이코)</label>
                            <label class="checkbox" for="de_easy_nhnkcp_naverpay"><input type="checkbox" id="de_easy_nhnkcp_naverpay" name="de_easy_pays[]" value="nhnkcp_naverpay" <?php if(stripos($default['de_easy_pay_services'], 'nhnkcp_naverpay') !== false){ echo 'checked="checked"'; } ?> ><i></i> NAVERPAY (네이버페이)</label>
                            <label class="checkbox" for="de_easy_nhnkcp_kakaopay"><input type="checkbox" id="de_easy_nhnkcp_kakaopay" name="de_easy_pays[]" value="nhnkcp_kakaopay" <?php if(stripos($default['de_easy_pay_services'], 'nhnkcp_kakaopay') !== false){ echo 'checked="checked"'; } ?> ><i></i> KAKAOPAY (카카오페이)</label>
                            <label class="checkbox" for="de_easy_nhnkcp_applepay"><input type="checkbox" id="de_easy_nhnkcp_applepay" name="de_easy_pays[]" value="nhnkcp_applepay" <?php if(stripos($default['de_easy_pay_services'], 'nhnkcp_applepay') !== false){ echo 'checked="checked"'; } ?> ><i></i> APPLEPAY (애플페이)</label>
                        </div>
                        <div class="note"><strong>Note:</strong> 체크시 NHN KCP 간편결제들을 활성화 합니다.<br>NHN_KCP > 네이버페이, 카카오페이는 테스트결제가 되지 않습니다.<br>애플페이는 IOS 기기에 모바일결제만 가능합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr pg_info_fld kcp_info_fld">
                    <div class="adm-form-td td-l">
                        <label for="de_global_nhnkcp_naverpay" class="label">NHN KCP 네이버페이 사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="checkbox" for="de_global_nhnkcp_naverpay" disabled><input type="checkbox" id="de_global_nhnkcp_naverpay" name="de_easy_pays[]" value="global_nhnkcp_naverpay" <?php if(stripos($default['de_easy_pay_services'], 'global_nhnkcp_naverpay') !== false){ echo 'checked="checked"'; } ?> ><i></i> NAVERPAY (네이버페이)</label>
                        <div class="note"><strong>Note:</strong> 체크시 타 PG (토스페이먼츠, KG 이니시스) 사용중일때도 NHN_KCP 를 통한 네이버페이 간편결제를 사용할수 있습니다.<br>실결제시 반드시 결제대행사 NHN_KCP 항목에 KCP SITE CODE와 NHN KCP SITE KEY를 입력해야 합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr pg_info_fld kcp_info_fld">
                    <div class="adm-form-td td-l">
                        <label for="used_nhnkcp_naverpay_point" class="label">NHN KCP 네이버페이<br>포인트결제 사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="checkbox" for="used_nhnkcp_naverpay_point" disabled><input type="checkbox" id="used_nhnkcp_naverpay_point" name="de_easy_pays[]" value="used_nhnkcp_naverpay_point" <?php if(stripos($default['de_easy_pay_services'], 'used_nhnkcp_naverpay_point') !== false){ echo 'checked="checked"'; } ?> ><i></i> NAVERPAY POINT (네이버페이 포인트 사용)</label>
                        <div class="note"><strong>Note:</strong> 체크시 NHN_KCP 를 통한 네이버페이 결제시 네이버페이 포인트결제가 활성화 됩니다.<br>체크를 했는데도 [DR02] 실결제시 가맹점 설정정보가 올바르지 않습니다 라고 메시지가 뜬다면, 체크를 해제하고 NHN_KCP 에 위에서 설정한 KCP SITE CODE 로 네이버페이 포인트 결제가 가능한지 문의해 주세요.</div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100 pg_info_fld lg_info_fld" id="lg_info_anchor">
                    <div class="adm-form-td td-l">
                        <label for="cf_lg_mid" class="label"><strong class="text-indigo">토스페이먼츠 상점아이디</strong></label>
                    </div>
                    <div class="adm-form-td td-r">
                        <a href="http://sir.kr/main/service/lg_pg.php" target="_blank" id="scf_lgreg" class="btn-e btn-e-lg btn-e-indigo width-250px m-b-10">토스페이먼츠 신청하기</a>
                        <label for="cf_lg_mid" class="input max-width-250px">
                            <i class="icon-prepend">si_</i>
                            <input type="text" name="cf_lg_mid" value="<?php echo get_sanitize_input($config['cf_lg_mid']); ?>" id="cf_lg_mid">
                        </label>
                        <div class="note"><strong>Note:</strong> 토스페이먼츠에서 받은 si_ 로 시작하는 상점 ID를 입력하세요.<br>만약, 상점 ID가 si_로 시작하지 않는다면 토스페이먼츠에 사이트코드 변경 요청을 하십시오. 예) si_lguplus<br><a href="<?php echo G5_ADMIN_URL; ?>/config_form.php#anc_cf_cert">기본환경설정 &gt; 본인확인</a> 설정의 토스페이먼츠 상점아이디와 동일합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr pg_info_fld lg_info_fld">
                    <div class="adm-form-td td-l">
                        <label for="cf_lg_mert_key" class="label">토스페이먼츠 MERT KEY</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="cf_lg_mert_key" class="input">
                            <input type="text" name="cf_lg_mert_key" value="<?php echo get_sanitize_input($config['cf_lg_mert_key']); ?>" id="cf_lg_mert_key">
                        </label>
                        <div class="note"><strong>Note:</strong> 토스페이먼츠 상점MertKey는 상점관리자 -> 계약정보 -> 상점정보관리에서 확인하실 수 있습니다.<br>예) 95160cce09854ef44d2edb2bfb05f9f3<br><a href="<?php echo G5_ADMIN_URL; ?>/config_form.php#anc_cf_cert">기본환경설정 &gt; 본인확인</a> 설정의 토스페이먼츠 MERT KEY와 동일합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100 pg_info_fld inicis_info_fld" id="inicis_info_anchor">
                    <div class="adm-form-td td-l">
                        <label for="de_inicis_mid" class="label"><strong class="text-indigo">KG이니시스 상점아이디</strong></label>
                    </div>
                    <div class="adm-form-td td-r">
                        <a href="http://sir.kr/main/service/inicis_pg.php" target="_blank" id="scf_kgreg" class="btn-e btn-e-lg btn-e-indigo width-250px m-b-10">KG이니시스 신청하기</a>
                        <label for="de_inicis_mid" class="input max-width-250px">
                            <i class="icon-prepend">SIR</i>
                            <input type="text" name="de_inicis_mid" value="<?php echo get_sanitize_input($default['de_inicis_mid']); ?>" id="de_inicis_mid">
                        </label>
                        <div class="note"><strong>Note:</strong> KG이니시스로 부터 발급 받으신 상점아이디(MID) 10자리 중 SIR 을 제외한 나머지 7자리를 입력 합니다.<br>만약, 상점아이디가 SIR로 시작하지 않는다면 계약담당자에게 변경 요청을 해주시기 바랍니다. (Tel. 02-3430-5858) 예) SIRpaytest</div>
                    </div>
                </div>
                <div class="adm-form-tr pg_info_fld inicis_info_fld">
                    <div class="adm-form-td td-l">
                        <label for="de_inicis_sign_key" class="label">KG이니시스 웹결제 사인키</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_inicis_sign_key" class="input max-width-250px">
                            <input type="text" name="de_inicis_sign_key" value="<?php echo get_sanitize_input($default['de_inicis_sign_key']); ?>" id="de_inicis_sign_key">
                        </label>
                        <div class="note"><strong>Note:</strong> KG이니시스에서 발급받은 웹결제 사인키를 입력합니다.<br><a href='https://iniweb.inicis.com/' target='_blank'>KG이니시스 가맹점관리자</a> > 상점정보 > 계약정보 > 부가정보의 웹결제 signkey생성 조회 버튼 클릭, 팝업창에서 생성 버튼 클릭 후 해당 값을 입력합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr pg_info_fld inicis_info_fld">
                    <div class="adm-form-td td-l">
                        <label for="de_inicis_iniapi_key" class="label">KG이니시스 INIAPI KEY</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_inicis_iniapi_key" class="input">
                            <input type="text" name="de_inicis_iniapi_key" value="<?php echo get_sanitize_input($default['de_inicis_iniapi_key']); ?>" id="de_inicis_iniapi_key">
                        </label>
                        <div class="note"><strong>Note:</strong> <a href='https://iniweb.inicis.com/' target='_blank'>KG이니시스 가맹점관리자</a> > 상점정보 > 계약정보 > 부가정보 > INIAPI key 생성 조회 하여 KEY를 여기에 입력합니다.<br>이 항목은 영카트 주문에서 kg이니시스 PG 결제 취소, 부분취소, 에스크로 배송등록, 현금영수증 발급에 필요합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr pg_info_fld inicis_info_fld">
                    <div class="adm-form-td td-l">
                        <label for="de_inicis_iniapi_iv" class="label">KG이니시스 INIAPI IV</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_inicis_iniapi_iv" class="input">
                            <input type="text" name="de_inicis_iniapi_iv" value="<?php echo get_sanitize_input($default['de_inicis_iniapi_iv']); ?>" id="de_inicis_iniapi_iv">
                        </label>
                        <div class="note"><strong>Note:</strong> <a href='https://iniweb.inicis.com/' target='_blank'>KG이니시스 가맹점관리자</a> > 상점정보 > 계약정보 > 부가정보 > INIAPI IV 생성 조회 하여 KEY를 여기에 입력합니다.<br>이 항목은 영카트 주문에서 kg이니시스 현금영수증 발급에 필요합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100 pg_info_fld inicis_info_fld">
                    <div class="adm-form-td td-l">
                        <label for="de_samsung_pay_use" class="label"><strong class="text-indigo">KG이니시스 삼성페이 사용</strong></label>
                    </div>
                    <div class="adm-form-td td-r">
                        <a href="http://sir.kr/main/service/samsungpay.php" target="_blank" id="scf_kgreg" class="btn-e btn-e-lg btn-e-indigo width-250px m-b-10">삼성페이 서비스 신청하기</a>
                        <label for="de_samsung_pay_use" class="checkbox">
                            <input type="checkbox" name="de_samsung_pay_use" value="1" id="de_samsung_pay_use"<?php echo $default['de_samsung_pay_use']?' checked':''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> KG이니시스와 별도로 <strong>삼성페이 사용 계약을 하신 경우</strong>에만 체크해주세요. (모바일 주문서 결제수단에 삼성페이가 노출됩니다.) <br >실결제시 반드시 결제대행사 KG이니시스 항목에 상점 아이디와 웹결제 사인키를 입력해 주세요.</div>
                    </div>
                </div>
                <div class="adm-form-tr pg_info_fld inicis_info_fld">
                    <div class="adm-form-td td-l">
                        <label for="de_inicis_lpay_use" class="label">KG이니시스 L.pay 사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_inicis_lpay_use" class="checkbox">
                            <input type="checkbox" name="de_inicis_lpay_use" value="1" id="de_inicis_lpay_use"<?php echo $default['de_inicis_lpay_use']?' checked':''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 체크시 KG이니시스 L.pay를 사용합니다. <br >실결제시 반드시 결제대행사 KG이니시스 항목의 상점 정보( 아이디, 웹결제 사인키 )를 입력해 주세요.</div>
                    </div>
                </div>
                <div class="adm-form-tr pg_info_fld inicis_info_fld">
                    <div class="adm-form-td td-l">
                        <label for="de_inicis_kakaopay_use" class="label">KG이니시스 카카오페이 사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_inicis_kakaopay_use" class="checkbox">
                            <input type="checkbox" name="de_inicis_kakaopay_use" value="1" id="de_inicis_kakaopay_use"<?php echo $default['de_inicis_kakaopay_use']?' checked':''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 체크시 KG이니시스 결제의 카카오페이를 사용합니다. 주문서 결제수단에 카카오페이가 노출됩니다. <br>실결제시 반드시 결제대행사 KG이니시스 항목의 상점 정보( 아이디, 웹결제 사인키 )를 입력해 주세요.</div>
                    </div>
                </div>
                <div class="adm-form-tr pg_info_fld inicis_info_fld">
                    <div class="adm-form-td td-l">
                        <label for="de_inicis_cartpoint_use" class="label">KG이니시스 신용카드 포인트 결제</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_inicis_cartpoint_use" class="checkbox">
                            <input type="checkbox" name="de_inicis_cartpoint_use" value="1" id="de_inicis_cartpoint_use"<?php echo $default['de_inicis_cartpoint_use']?' checked':''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 신용카드 포인트 결제에 대해 이니시스와 계약을 맺은 상점에서만 적용하는 옵션입니다.<br>체크시 pc 결제에서는 신용카드 포인트 사용 여부에 대한 팝업창에 사용 버튼과 사용안함 버튼이 표기되어 결제하는 고객의 선택여부에 따라 신용카드 포인트 결제가 가능합니다.<br >모바일에서는 신용카드 포인트 사용이 가능합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100 kakao_info_fld">
                    <div class="adm-form-td td-l">
                        <label for="de_kakaopay_mid" class="label"><strong class="text-indigo">카카오페이 상점아이디<br>( KG이니시스 )</strong></label>
                    </div>
                    <div class="adm-form-td td-r">
                        <a href="http://sir.kr/main/service/kakaopay.php?kk=yc5" target="_blank" class="btn-e btn-e-lg btn-e-indigo width-250px m-b-10">카카오페이 서비스신청하기</a>
                        <label for="de_kakaopay_mid" class="input max-width-250px">
                            <i class="icon-prepend">SIRK</i>
                            <input type="text" name="de_kakaopay_mid" value="<?php echo get_sanitize_input($default['de_kakaopay_mid']); ?>" id="de_kakaopay_mid">
                        </label>
                        <div class="note"><strong>Note:</strong> KG이니시스로 부터 카카오페이 간편결제만 사용용도로 발급 받으신 상점아이디(MID) 10자리 중 SIRK 을 제외한 나머지 6자리를 입력 합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr kakao_info_fld">
                    <div class="adm-form-td td-l">
                        <label for="de_kakaopay_key" class="label">카카오페이 상점키<br>( KG이니시스 )</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_kakaopay_key" class="input">
                            <input type="text" name="de_kakaopay_key" value="<?php echo get_sanitize_input($default['de_kakaopay_key']); ?>" id="de_kakaopay_key">
                        </label>
                        <div class="note"><strong>Note:</strong> SIRK****** 아이디로 KG이니시스에서 발급받은 웹결제 사인키를 입력합니다<br>KG이니시스 상점관리자 > 상점정보 > 계약정보 > 부가정보의 웹결제 signkey생성 조회 버튼 클릭, 팝업창에서 생성 버튼 클릭 후 해당 값을 입력합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr kakao_info_fld">
                    <div class="adm-form-td td-l">
                        <label for="de_kakaopay_enckey" class="label">카카오페이 키패스워드<br>( KG이니시스 )</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_kakaopay_enckey" class="input max-width-250px">
                            <input type="text" name="de_kakaopay_cancelpwd" value="<?php echo get_sanitize_input($default['de_kakaopay_cancelpwd']); ?>" id="de_kakaopay_cancelpwd">
                        </label>
                        <div class="note"><strong>Note:</strong> SIRK****** 아이디로 KG이니시스에서 발급받은 4자리 상점 키패스워드를 입력합니다.<br>KG이니시스 상점관리자 패스워드와 관련이 없습니다<br>키패스워드 값을 확인하시려면 상점측에 발급된 키파일 안의 readme.txt 파일을 참조해 주십시오</div>
                    </div>
                </div>
                <div class="adm-form-tr kakao_info_fld">
                    <div class="adm-form-td td-l">
                        <label for="de_kakaopay_enckey" class="label">KG이니시스<br>카카오페이 사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_kakaopay_enckey" class="checkbox">
                            <input type="checkbox" name="de_kakaopay_enckey" value="1" id="de_kakaopay_enckey" <?php echo $default['de_kakaopay_enckey']?' checked':''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 체크시 카카오페이 (KG 이니시스)를 사용합니다. <br >KG 이니시스의 SIRK****** 아이디를 받은 상점만 해당됩니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr kakao_info_fld" style="display:none">
                    <div class="adm-form-td td-l">
                        <label for="de_kakaopay_hashkey" class="label">카카오페이 상점 HashKey</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_kakaopay_hashkey" class="input">
                            <input type="text" name="de_kakaopay_hashkey" value="<?php echo get_sanitize_input($default['de_kakaopay_hashkey']); ?>" id="de_kakaopay_hashkey">
                        </label>
                        <div class="note"><strong>Note:</strong> 카카오페이로 부터 발급 받으신 상점 인증 전용 HashKey를 입력합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr pg_info_fld nicepay_info_fld" id="nicepay_info_anchor">
                    <div class="adm-form-td td-l">
                        <label for="de_nicepay_mid" class="label"><strong class="text-indigo">NICEPAY MID</strong></label>
                    </div>
                    <div class="adm-form-td td-r">
                        <a href="https://sir.kr/main/service/nicepayments_pg.php" target="_blank" id="scf_nicepay_reg" class="btn-e btn-e-lg btn-e-indigo width-250px m-b-10">NICEPAY 신청하기</a>
                        <label for="de_nicepay_mid" class="input max-width-250px">
                            <i class="icon-prepend">SR</i>
                            <input type="text" name="de_nicepay_mid" value="<?php echo get_sanitize_input($default['de_nicepay_mid']); ?>" id="de_nicepay_mid">
                        </label>
                        <div class="note"><strong>Note:</strong> NICEPAY로 부터 발급 받으신 상점MID를 SR 을 제외한 나머지 자리를 입력 합니다.<br>NICEPAY 상점관리자 > 가맹점정보 > KEY관리에서 확인 할수 있습니다.<br>만약, 상점아이디가 SR로 시작하지 않는다면 계약담당자에게 변경 요청을 해주시기 바랍니다. 예) SRpaytestm</div>
                    </div>
                </div>
                <div class="adm-form-tr pg_info_fld nicepay_info_fld">
                    <div class="adm-form-td td-l">
                        <label for="de_nicepay_key" class="label">NICEPAY KEY</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_nicepay_key" class="input max-width-250px">
                            <input type="text" name="de_nicepay_key" value="<?php echo get_sanitize_input($default['de_nicepay_key']); ?>" id="de_nicepay_key">
                        </label>
                    </div>
                </div>
                <div class="adm-form-tr pg_info_fld nicepay_info_fld">
                    <div class="adm-form-td td-l">
                        <label for="de_nicepay_easy_pays" class="label">NICEPAY 간편결제</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <label class="checkbox" for="de_easy_nicepay_samsungpay" disabled><input type="checkbox" id="de_easy_nicepay_samsungpay" name="de_easy_pays[]" value="nicepay_samsungpay" <?php if(stripos($default['de_easy_pay_services'], 'nicepay_samsungpay') !== false){ echo 'checked="checked"'; } ?> ><i></i> 삼성페이</label>
                            <label class="checkbox" for="de_easy_nicepay_naverpay"><input type="checkbox" id="de_easy_nicepay_naverpay" name="de_easy_pays[]" value="nicepay_naverpay" <?php if(stripos($default['de_easy_pay_services'], 'nicepay_naverpay') !== false){ echo 'checked="checked"'; } ?> ><i></i> NAVERPAY (네이버페이)</label>
                            <label class="checkbox" for="de_easy_nicepay_kakaopay"><input type="checkbox" id="de_easy_nicepay_kakaopay" name="de_easy_pays[]" value="nicepay_kakaopay" <?php if(stripos($default['de_easy_pay_services'], 'nicepay_kakaopay') !== false){ echo 'checked="checked"'; } ?> ><i></i> KAKAOPAY (카카오페이)</label>
                            <label class="checkbox" for="de_easy_nicepay_applepay"><input type="checkbox" id="de_easy_nicepay_applepay" name="de_easy_pays[]" value="nicepay_applepay" <?php if(stripos($default['de_easy_pay_services'], 'nicepay_applepay') !== false){ echo 'checked="checked"'; } ?> ><i></i> APPLEPAY (애플페이)</label>
                            <label class="checkbox" for="de_easy_nicepay_paycopay"><input type="checkbox" id="de_easy_nicepay_paycopay" name="de_easy_pays[]" value="nicepay_paycopay" <?php if(stripos($default['de_easy_pay_services'], 'nicepay_paycopay') !== false){ echo 'checked="checked"'; } ?> ><i></i> 페이코</label>
                            <label class="checkbox" for="de_easy_nicepay_skpay"><input type="checkbox" id="de_easy_nicepay_skpay" name="de_easy_pays[]" value="nicepay_skpay" <?php if(stripos($default['de_easy_pay_services'], 'nicepay_skpay') !== false){ echo 'checked="checked"'; } ?> ><i></i> SK페이</label>
                            <label class="checkbox" for="de_easy_nicepay_ssgpay"><input type="checkbox" id="de_easy_nicepay_ssgpay" name="de_easy_pays[]" value="nicepay_ssgpay" <?php if(stripos($default['de_easy_pay_services'], 'nicepay_ssgpay') !== false){ echo 'checked="checked"'; } ?> ><i></i> SSG페이</label>
                            <label class="checkbox" for="de_easy_nicepay_lpay"><input type="checkbox" id="de_easy_nicepay_lpay" name="de_easy_pays[]" value="nicepay_lpay" <?php if(stripos($default['de_easy_pay_services'], 'nicepay_lpay') !== false){ echo 'checked="checked"'; } ?> ><i></i> LPAY</label>
                        </div>
                        <div class="note"><strong>Note:</strong> 체크시 NICEPAY 간편결제들을 활성화 합니다.<br>NICEPAY > 간편결제는 테스트결제가 되지 않습니다. 실결제에만 정상작동 합니다.<br>애플페이는 IOS 기기에 모바일결제만 가능합니다.</div>
                    </div>
                </div>
                <?php if (defined('G5_SHOP_DIRECT_NAVERPAY') && G5_SHOP_DIRECT_NAVERPAY) { ?>
                <div class="adm-form-tr naver_info_fld">
                    <div class="adm-form-td td-l">
                        <label for="de_naverpay_mid" class="label">네이버페이 가맹점 아이디</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <a href="http://sir.kr/main/service/naverpay.php" target="_blank" class="btn-e btn-e-lg btn-e-indigo width-250px m-b-10">네이버페이 서비스신청하기</a>
                        <label for="de_naverpay_mid" class="input max-width-250px">
                            <input type="text" name="de_naverpay_mid" value="<?php echo get_sanitize_input($default['de_naverpay_mid']); ?>" id="de_naverpay_mid" maxlength="50">
                        </label>
                        <div class="note"><strong>Note:</strong> 네이버페이 가맹점 아이디를 입력합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr naver_info_fld">
                    <div class="adm-form-td td-l">
                        <label for="de_naverpay_cert_key" class="label">네이버페이 가맹점 인증키</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_naverpay_cert_key" class="input">
                            <input type="text" name="de_naverpay_cert_key" value="<?php echo get_sanitize_input($default['de_naverpay_cert_key']); ?>" id="de_naverpay_cert_key" maxlength="100">
                        </label>
                        <div class="note"><strong>Note:</strong> 네이버페이 가맹점 인증키를 입력합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr naver_info_fld">
                    <div class="adm-form-td td-l">
                        <label for="de_naverpay_button_key" class="label">네이버페이 버튼 인증키</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_naverpay_button_key" class="input">
                            <input type="text" name="de_naverpay_button_key" value="<?php echo get_sanitize_input($default['de_naverpay_button_key']); ?>" id="de_naverpay_button_key" maxlength="100">
                        </label>
                        <div class="note"><strong>Note:</strong> 네이버페이 가맹점 인증키를 입력합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr naver_info_fld">
                    <div class="adm-form-td td-l">
                        <label for="de_naverpay_test" class="label">네이버페이 결제테스트</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_naverpay_test" class="select max-width-250px">
                            <select id="de_naverpay_test" name="de_naverpay_test">
                                <option value="1" <?php echo get_selected($default['de_naverpay_test'], 1); ?>>예</option>
                                <option value="0" <?php echo get_selected($default['de_naverpay_test'], 0); ?>>아니오</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 네이버페이 결제테스트 여부를 설정합니다. 검수 과정 중에는 <strong>예</strong>로 설정해야 하며 최종 승인 후 <strong>아니오</strong>로 설정합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr naver_info_fld">
                    <div class="adm-form-td td-l">
                        <label for="de_naverpay_mb_id" class="label">네이버페이 결제테스트 아이디</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_naverpay_mb_id" class="input max-width-250px">
                            <input type="text" name="de_naverpay_mb_id" value="<?php echo get_sanitize_input($default['de_naverpay_mb_id']); ?>" id="de_naverpay_mb_id" maxlength="20">
                        </label>
                        <div class="note"><strong>Note:</strong> 네이버페이 결제테스트를 위한 테스트 회원 아이디를 입력합니다. 네이버페이 검수 과정에서 필요합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr naver_info_fld">
                    <div class="adm-form-td td-l">
                        <label class="label">네이버페이 상품정보 XML URL</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <?php echo G5_SHOP_URL; ?>/naverpay/naverpay_item.php<br>
                        <div class="note"><strong>Note:</strong> 네이버페이에 상품정보를 XML 데이터로 제공하는 페이지입니다. 검수과정에서 아래의 URL 정보를 제공해야 합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr naver_info_fld">
                    <div class="adm-form-td td-l">
                        <label for="de_naverpay_sendcost" class="label">네이버페이 추가배송비 안내</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_naverpay_sendcost" class="input max-width-250px">
                            <input type="text" name="de_naverpay_sendcost" value="<?php echo get_sanitize_input($default['de_naverpay_sendcost']); ?>" id="de_naverpay_sendcost">
                        </label>
                        <div class="note"><strong>Note:</strong> 네이버페이를 통한 결제 때 구매자에게 보여질 추가배송비 내용을 입력합니다.<br>예) 제주도 3,000원 추가, 제주도 외 도서·산간 지역 5,000원 추가</div>
                    </div>
                </div>
                <?php } // defined('G5_SHOP_DIRECT_NAVERPAY') ?>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">에스크로 사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <label for="de_escrow_use1" class="radio"><input type="radio" name="de_escrow_use" value="0" <?php echo $default['de_escrow_use']==0?"checked":""; ?> id="de_escrow_use1"><i></i> 일반결제 사용</label>
                            <label for="de_escrow_use2" class="radio"><input type="radio" name="de_escrow_use" value="1" <?php echo $default['de_escrow_use']==1?"checked":""; ?> id="de_escrow_use2"><i></i> 에스크로결제 사용</label>
                        </div>
                        <div class="note"><strong>Note:</strong> 에스크로 결제를 사용하시려면, 반드시 결제대행사 상점 관리자 페이지에서 에스크로 서비스를 신청하신 후 사용하셔야 합니다.<br>에스크로 사용시 배송과의 연동은 되지 않으며 에스크로 결제만 지원됩니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label class="label">결제 테스트</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group m-b-10">
                            <label for="de_card_test1" class="radio"><input type="radio" name="de_card_test" value="0" <?php echo $default['de_card_test']==0?"checked":""; ?> id="de_card_test1"><i></i> 실결제</label>
                            <label for="de_card_test2" class="radio"><input type="radio" name="de_card_test" value="1" <?php echo $default['de_card_test']==1?"checked":""; ?> id="de_card_test2"><i></i> 테스트결제</label>
                        </div>
                        <div class="clearfix"></div>
                        <div class="scf_cardtest kcp_cardtest m-b-10">
                            <a href="http://admin.kcp.co.kr/" target="_blank" class="btn-e btn-e-md btn-e-dark m-b-5">실결제 관리자</a>
                            <a href="http://testadmin8.kcp.co.kr/" target="_blank" class="btn-e btn-e-md btn-e-dark m-b-5">테스트 관리자</a>
                        </div>
                        <div class="scf_cardtest lg_cardtest m-b-10">
                            <a href="https://pgweb.tosspayments.com/" target="_blank" class="btn-e btn-e-md btn-e-dark m-b-5">실결제 관리자</a>
                            <a href="https://pgweb.tosspayments.com/tmert" target="_blank" class="btn-e btn-e-md btn-e-dark m-b-5">테스트 관리자</a>
                        </div>
                        <div class="scf_cardtest inicis_cardtest m-b-10">
                            <a href="https://iniweb.inicis.com/" target="_blank" class="btn-e btn-e-md btn-e-dark m-b-5">상점 관리자</a>
                        </div>
                        <div id="scf_cardtest_tip" class="m-t-20">
                            <h6>[일반결제 사용시 테스트 결제]</h6>
                            <p class="li-p-sq"><strong>신용카드</strong> : 1000원 이상, 모든 카드가 테스트 되는 것은 아니므로 여러가지 카드로 결제해 보셔야 합니다.<br>(BC, 현대, 롯데, 삼성카드)</p>
                            <p class="li-p-sq"><strong>계좌이체</strong> : 150원 이상, 계좌번호, 비밀번호는 가짜로 입력해도 되며, 주민등록번호는 공인인증서의 것과 일치해야 합니다.</p>
                            <p class="li-p-sq"><strong>가상계좌</strong> : 1원 이상, 모든 은행이 테스트 되는 것은 아니며 "해당 은행 계좌 없음" 자주 발생함.<br>(광주은행, 하나은행)</p>
                            <p class="li-p-sq m-b-20"><strong>휴대폰</strong> : 1004원, 실결제가 되며 다음날 새벽에 일괄 취소됨.</p>

                            <h6>[에스크로 사용시 테스트 결제]</h6>
                            <p class="li-p-sq"><strong>신용카드</strong> : 1000원 이상, 모든 카드가 테스트 되는 것은 아니므로 여러가지 카드로 결제해 보셔야 합니다.<br>(BC, 현대, 롯데, 삼성카드)</p>
                            <p class="li-p-sq"><strong>계좌이체</strong> : 150원 이상, 계좌번호, 비밀번호는 가짜로 입력해도 되며, 주민등록번호는 공인인증서의 것과 일치해야 합니다.</p>
                            <p class="li-p-sq"><strong>가상계좌</strong> : 1원 이상, 입금통보는 제대로 되지 않음.</p>
                            <p class="li-p-sq m-b-20"><strong>휴대폰</strong> : 테스트 지원되지 않음.</p>

                            <div id="kcp_cardtest_tip" class="scf_cardtest_tip_adm scf_cardtest_tip_adm_hide m-b-20">
                                <p class="li-p-sq">테스트결제의 <a href="http://testadmin8.kcp.co.kr/assist/login.LoginAction.do" target="_blank">상점관리자</a> 로그인 정보는 NHN KCP로 문의하시기 바랍니다. (기술지원 1544-8661)</p>
                                <p class="li-p-sq"><b>일반결제</b>의 테스트 사이트코드는 <b>T0000</b> 이며, <b>에스크로 결제</b>의 테스트 사이트코드는 <b>T0007</b> 입니다.</p>
                            </div>

                            <div id="lg_cardtest_tip" class="scf_cardtest_tip_adm scf_cardtest_tip_adm_hide m-b-20">
                                <p class="li-p-sq">테스트결제의 <a href="http://pgweb.dacom.net:7085/" target="_blank">상점관리자</a> 로그인 정보는 토스페이먼츠 상점아이디 첫 글자에 t를 추가해서 로그인하시기 바랍니다. 예) tsi_lguplus</p>
                            </div>

                            <div id="inicis_cardtest_tip" class="scf_cardtest_tip_adm scf_cardtest_tip_adm_hide">
                                <p class="li-p-sq"><b>일반결제</b>의 테스트 사이트 mid는 <b>INIpayTest</b> 이며, <b>에스크로 결제</b>의 테스트 사이트 mid는 <b>iniescrow0</b> 입니다.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_tax_flag_use" class="label">복합과세 결제</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_tax_flag_use" class="checkbox">
                            <input type="checkbox" name="de_tax_flag_use" value="1" id="de_tax_flag_use"<?php echo $default['de_tax_flag_use']?' checked':''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 복합과세(과세, 비과세) 결제를 사용하려면 체크하십시오.<br>복합과세 결제를 사용하기 전 PG사에 별도로 결제 신청을 해주셔야 합니다. 사용시 PG사로 문의하여 주시기 바랍니다.</div>
                    </div>
                </div>
            </div>
            <script>
            $('#scf_cardtest_tip').addClass('scf_cardtest_tip');
            $('<button type="button" class="scf_cardtest_btn btn-e btn-e-md btn-e-teal m-b-5">테스트결제 팁 더보기</button>').appendTo('.scf_cardtest');

            $(".scf_cardtest").addClass("scf_cardtest_hide");
            $(".<?php echo $default['de_pg_service']; ?>_cardtest").removeClass("scf_cardtest_hide");
            $("#<?php echo $default['de_pg_service']; ?>_cardtest_tip").removeClass("scf_cardtest_tip_adm_hide");
            </script>
        </div>
        <?php /* 결제설정 : 끝 */ ?>
        <?php } ?>

        <?php /* 배송설정 : 시작 */ ?>
        <div class="tab-pane" id="anc_scf_delivery" role="tabpanel" aria-labelledby="anc_scf_delivery_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>배송설정</strong></div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_delivery_company" class="label">배송업체</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select name="de_delivery_company" id="de_delivery_company">
                                <?php echo get_delivery_company($default['de_delivery_company']); ?>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 이용 중이거나 이용하실 배송업체를 선택하세요.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_send_cost_case" class="label">배송비유형</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select name="de_send_cost_case" id="de_send_cost_case">
                                <option value="차등" <?php echo get_selected($default['de_send_cost_case'], "차등"); ?>>금액별차등</option>
                                <option value="무료" <?php echo get_selected($default['de_send_cost_case'], "무료"); ?>>무료배송</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> <strong>금액별차등</strong>으로 설정한 경우, 주문총액이 배송비상한가 미만일 경우 배송비를 받습니다.<br><strong>무료배송</strong>으로 설정한 경우, 배송비상한가 및 배송비를 무시하며 착불의 경우도 무료배송으로 설정합니다.<br><strong>상품별로 배송비 설정을 한 경우 상품별 배송비 설정이 우선</strong> 적용됩니다.<br>예를 들어 무료배송으로 설정했을 때 특정 상품에 배송비가 설정되어 있으면 주문시 배송비가 부과됩니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_send_cost_limit" class="label">배송비상한가</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_send_cost_limit" class="input max-width-250px">
                            <i class="icon-append">원</i>
                            <input type="text" name="de_send_cost_limit" value="<?php echo get_sanitize_input($default['de_send_cost_limit']); ?>" id="de_send_cost_limit">
                        </label>
                        <div class="note"><strong>Note:</strong> 배송비유형이 '금액별차등'일 경우에만 해당되며 배송비상한가를 여러개 두고자 하는 경우는 <b>;</b> 로 구분합니다.<br>예를 들어 20000원 미만일 경우 4000원, 30000원 미만일 경우 3000원 으로 사용할 경우에는 배송비상한가를 20000;30000 으로 입력하고 배송비를 4000;3000 으로 입력합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_send_cost_list" class="label">배송비</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_send_cost_list" class="input max-width-250px">
                            <i class="icon-append">원</i>
                            <input type="text" name="de_send_cost_list" value="<?php echo get_sanitize_input($default['de_send_cost_list']); ?>" id="de_send_cost_list">
                        </label>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_hope_date_use" class="label">희망배송일사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select name="de_hope_date_use" id="de_hope_date_use">
                                <option value="0" <?php echo get_selected($default['de_hope_date_use'], 0); ?>>사용안함</option>
                                <option value="1" <?php echo get_selected($default['de_hope_date_use'], 1); ?>>사용</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> '예'로 설정한 경우 주문서에서 희망배송일을 입력 받습니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_hope_date_after" class="label">희망배송일지정</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_hope_date_after" class="input max-width-250px">
                            <i class="icon-append">일</i>
                            <input type="text" name="de_hope_date_after" value="<?php echo get_sanitize_input($default['de_hope_date_after']); ?>" id="de_hope_date_after" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 오늘을 포함하여 설정한 날 이후부터 일주일 동안을 달력 형식으로 노출하여 선택할수 있도록 합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label class="label">배송정보</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div for="de_baesong_content" class="textarea">
                            <?php echo editor_html('de_baesong_content', get_text(html_purifier($default['de_baesong_content']), 0)); ?>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label class="label">교환/반품</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div for="de_change_content" class="textarea">
                            <?php echo editor_html('de_change_content', get_text(html_purifier($default['de_change_content']), 0)); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 배송설정 : 끝 */ ?>

        <?php /* 기타설정 : 시작 */ ?>
        <div class="tab-pane" id="anc_scf_etc" role="tabpanel" aria-labelledby="anc_scf_etc_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>기타설정</strong></div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">관련상품출력</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <span class="span-lg-block">
                                <label class="checkbox width-100px">
                                    <input type="checkbox" name="de_rel_list_use" value="1" id="de_rel_list_use" <?php echo $default['de_rel_list_use']?"checked":""; ?>><i></i> 출력
                                </label>
                                <div class="clearfix"></div>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_rel_list_skin" class="label">스킨</label>
                                <label class="select width-200px">
                                    <select name="de_rel_list_skin" id="de_rel_list_skin">
                                        <?php echo get_list_skin_options("^relation.[0-9]+\.skin\.php", G5_SHOP_SKIN_PATH, $default['de_rel_list_skin']); ?>
                                    </select><i></i>
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_rel_img_width" class="label">이미지 폭</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_rel_img_width" value="<?php echo get_sanitize_input($default['de_rel_img_width']); ?>" id="de_rel_img_width">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_rel_img_height" class="label">이미지 높이</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_rel_img_height" value="<?php echo get_sanitize_input($default['de_rel_img_height']); ?>" id="de_rel_img_height">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_rel_list_mod" class="label">1줄당 이미지 수</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_rel_list_mod" value="<?php echo get_sanitize_input($default['de_rel_list_mod']); ?>" id="de_rel_list_mod">
                                </label>
                            </span>
                        </div>
                        <div class="note"><strong>Note:</strong> 관련상품의 경우 등록된 상품은 모두 출력하므로 '출력할 줄 수'는 설정하지 않습니다. 이미지높이를 0으로 설정하면 상품이미지를 이미지폭에 비례하여 생성합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">모바일 관련상품출력</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <span class="span-lg-block">
                                <label class="checkbox width-100px">
                                    <input type="checkbox" name="de_mobile_rel_list_use" value="1" id="de_mobile_rel_list_use" <?php echo $default['de_mobile_rel_list_use']?"checked":""; ?>><i></i> 출력
                                </label>
                                <div class="clearfix"></div>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_mobile_rel_list_skin" class="label">스킨</label>
                                <label class="select width-200px">
                                    <select name="de_mobile_rel_list_skin" id="de_mobile_rel_list_skin">
                                        <?php echo get_list_skin_options("^relation.[0-9]+\.skin\.php", G5_MSHOP_SKIN_PATH, $default['de_mobile_rel_list_skin']); ?>
                                    </select><i></i>
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_mobile_rel_img_width" class="label">이미지 폭</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_mobile_rel_img_width" value="<?php echo get_sanitize_input($default['de_mobile_rel_img_width']); ?>" id="de_mobile_rel_img_width">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_mobile_rel_img_height" class="label">이미지 높이</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_mobile_rel_img_height" value="<?php echo get_sanitize_input($default['de_mobile_rel_img_height']); ?>" id="de_mobile_rel_img_height">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_mobile_rel_list_mod" class="label">1줄당 이미지 수</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_mobile_rel_list_mod" value="<?php echo get_sanitize_input($default['de_mobile_rel_list_mod']); ?>" id="de_mobile_rel_list_mod">
                                </label>
                            </span>
                        </div>
                        <div class="note"><strong>Note:</strong> 관련상품의 경우 등록된 상품은 모두 출력하므로 '출력할 줄 수'는 설정하지 않습니다. 이미지높이를 0으로 설정하면 상품이미지를 이미지폭에 비례하여 생성합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">검색상품출력</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <span class="span-lg-block">
                                <label for="de_search_list_skin" class="label">스킨</label>
                                <label class="select width-200px">
                                    <select name="de_search_list_skin" id="de_search_list_skin">
                                        <?php echo get_list_skin_options("^list.[0-9]+\.skin\.php", G5_SHOP_SKIN_PATH, $default['de_search_list_skin']); ?>
                                    </select><i></i>
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_search_img_width" class="label">이미지 폭</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_search_img_width" value="<?php echo get_sanitize_input($default['de_search_img_width']); ?>" id="de_search_img_width">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_search_img_height" class="label">이미지 높이</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_search_img_height" value="<?php echo get_sanitize_input($default['de_search_img_height']); ?>" id="de_search_img_height">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_search_list_mod" class="label">1줄당 이미지 수</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_search_list_mod" value="<?php echo get_sanitize_input($default['de_search_list_mod']); ?>" id="de_search_list_mod">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_search_list_row" class="label">출력할 줄 수</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_search_list_row" value="<?php echo get_sanitize_input($default['de_search_list_row']); ?>" id="de_search_list_row">
                                </label>
                            </span>
                        </div>
                        <p class="li-p-sq f-s-13r text-gray m-t-10">페이지당 출력갯수 = 1줄당 이미지 수 x 출력할 줄 수</p>
                        <p class="li-p-sq f-s-13r text-gray">사용중인 테마에 따라서 1줄당 이미지 수가 입력한 갯수대로 적용이 안될수 있습니다. (테마 최적화 문제)</p>
                        <p class="li-p-sq f-s-13r text-gray">이미지높이를 0으로 설정하면 상품이미지를 이미지폭에 비례하여 생성합니다.</p>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">모바일 검색상품출력</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <span class="span-lg-block">
                                <label for="de_mobile_search_list_skin" class="label">스킨</label>
                                <label class="select width-200px">
                                    <select name="de_mobile_search_list_skin" id="de_mobile_search_list_skin">
                                        <?php echo get_list_skin_options("^list.[0-9]+\.skin\.php", G5_MSHOP_SKIN_PATH, $default['de_mobile_search_list_skin']); ?>
                                    </select><i></i>
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_mobile_search_img_width" class="label">이미지 폭</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_mobile_search_img_width" value="<?php echo get_sanitize_input($default['de_mobile_search_img_width']); ?>" id="de_mobile_search_img_width">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_mobile_search_img_height" class="label">이미지 높이</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_mobile_search_img_height" value="<?php echo get_sanitize_input($default['de_mobile_search_img_height']); ?>" id="de_mobile_search_img_height">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_mobile_search_list_mod" class="label">1줄당 이미지 수</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_mobile_search_list_mod" value="<?php echo get_sanitize_input($default['de_mobile_search_list_mod']); ?>" id="de_mobile_search_list_mod">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_mobile_search_list_row" class="label">출력할 줄 수</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_mobile_search_list_row" value="<?php echo get_sanitize_input($default['de_mobile_search_list_row']); ?>" id="de_mobile_search_list_row">
                                </label>
                            </span>
                        </div>
                        <p class="li-p-sq f-s-13r text-gray m-t-10">페이지당 출력갯수 = 1줄당 이미지 수 x 출력할 줄 수</p>
                        <p class="li-p-sq f-s-13r text-gray">사용중인 테마에 따라서 1줄당 이미지 수가 입력한 갯수대로 적용이 안될수 있습니다. (테마 최적화 문제)</p>
                        <p class="li-p-sq f-s-13r text-gray">이미지높이를 0으로 설정하면 상품이미지를 이미지폭에 비례하여 생성합니다.</p>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">유형별 상품리스트</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <span class="span-lg-block">
                                <label for="de_listtype_list_skin" class="label">스킨</label>
                                <label class="select width-200px">
                                    <select name="de_listtype_list_skin" id="de_listtype_list_skin">
                                        <?php echo get_list_skin_options("^list.[0-9]+\.skin\.php", G5_SHOP_SKIN_PATH, $default['de_listtype_list_skin']); ?>
                                    </select><i></i>
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_listtype_img_width" class="label">이미지 폭</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_listtype_img_width" value="<?php echo get_sanitize_input($default['de_listtype_img_width']); ?>" id="de_listtype_img_width">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_listtype_img_height" class="label">이미지 높이</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_listtype_img_height" value="<?php echo get_sanitize_input($default['de_listtype_img_height']); ?>" id="de_listtype_img_height">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_listtype_list_mod" class="label">1줄당 이미지 수</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_listtype_list_mod" value="<?php echo get_sanitize_input($default['de_listtype_list_mod']); ?>" id="de_listtype_list_mod">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_listtype_list_row" class="label">출력할 줄 수</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_listtype_list_row" value="<?php echo get_sanitize_input($default['de_listtype_list_row']); ?>" id="de_listtype_list_row">
                                </label>
                            </span>
                        </div>
                        <p class="li-p-sq f-s-13r text-gray m-t-10">페이지당 출력갯수 = 1줄당 이미지 수 x 출력할 줄 수</p>
                        <p class="li-p-sq f-s-13r text-gray">사용중인 테마에 따라서 1줄당 이미지 수가 입력한 갯수대로 적용이 안될수 있습니다. (테마 최적화 문제)</p>
                        <p class="li-p-sq f-s-13r text-gray">이미지높이를 0으로 설정하면 상품이미지를 이미지폭에 비례하여 생성합니다.</p>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">모바일 유형별 상품리스트</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <span class="span-lg-block">
                                <label for="de_mobile_listtype_list_skin" class="label">스킨</label>
                                <label class="select width-200px">
                                    <select name="de_mobile_listtype_list_skin" id="de_mobile_listtype_list_skin">
                                        <?php echo get_list_skin_options("^list.[0-9]+\.skin\.php", G5_MSHOP_SKIN_PATH, $default['de_mobile_listtype_list_skin']); ?>
                                    </select><i></i>
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_mobile_listtype_img_width" class="label">이미지 폭</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_mobile_listtype_img_width" value="<?php echo get_sanitize_input($default['de_mobile_listtype_img_width']); ?>" id="de_mobile_listtype_img_width">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_mobile_listtype_img_height" class="label">이미지 높이</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_mobile_listtype_img_height" value="<?php echo get_sanitize_input($default['de_mobile_listtype_img_height']); ?>" id="de_mobile_listtype_img_height">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_mobile_listtype_list_mod" class="label">1줄당 이미지 수</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_mobile_listtype_list_mod" value="<?php echo get_sanitize_input($default['de_mobile_listtype_list_mod']); ?>" id="de_mobile_listtype_list_mod">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_mobile_listtype_list_row" class="label">출력할 줄 수</label>
                                <label class="input width-120px">
                                    <input type="text" name="de_mobile_listtype_list_row" value="<?php echo get_sanitize_input($default['de_mobile_listtype_list_row']); ?>" id="de_mobile_listtype_list_row">
                                </label>
                            </span>
                        </div>
                        <p class="li-p-sq f-s-13r text-gray m-t-10">페이지당 출력갯수 = 1줄당 이미지 수 x 출력할 줄 수</p>
                        <p class="li-p-sq f-s-13r text-gray">사용중인 테마에 따라서 1줄당 이미지 수가 입력한 갯수대로 적용이 안될수 있습니다. (테마 최적화 문제)</p>
                        <p class="li-p-sq f-s-13r text-gray">이미지높이를 0으로 설정하면 상품이미지를 이미지폭에 비례하여 생성합니다.</p>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">이미지(소)</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <span>
                                <label for="de_simg_width" class="input width-200px">
                                    <i class="icon-prepend">폭</i>
                                    <i class="icon-append">px</i>
                                    <input type="text" name="de_simg_width" id="de_simg_width" value="<?php echo get_sanitize_input($default['de_simg_width']); ?>" class="text-end">
                                </label>
                            </span>
                            <span> X </span>
                            <span>
                                <label for="de_simg_height" class="input width-200px">
                                    <i class="icon-prepend">높이</i>
                                    <i class="icon-append">px</i>
                                    <input type="text" name="de_simg_height" id="de_simg_height" value="<?php echo get_sanitize_input($default['de_simg_height']); ?>" class="text-end">
                                </label>
                            </span>
                        </div>
                        <div class="note"><strong>Note:</strong> 분류리스트에서 보여지는 사이즈를 설정하시면 됩니다. 분류관리의 출력 이미지폭, 높이의 기본값으로 사용됩니다. 높이를 0 으로 설정하시면 폭에 비례하여 높이를 썸네일로 생성합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">이미지(중)</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <span>
                                <label for="de_mimg_width" class="input width-200px">
                                    <i class="icon-prepend">폭</i>
                                    <i class="icon-append">px</i>
                                    <input type="text" name="de_mimg_width" id="de_mimg_width" value="<?php echo get_sanitize_input($default['de_mimg_width']); ?>" class="text-end">
                                </label>
                            </span>
                            <span> X </span>
                            <span>
                                <label for="de_mimg_height" class="input width-200px">
                                    <i class="icon-prepend">높이</i>
                                    <i class="icon-append">px</i>
                                    <input type="text" name="de_mimg_height" id="de_mimg_height" value="<?php echo get_sanitize_input($default['de_mimg_height']); ?>" class="text-end">
                                </label>
                            </span>
                        </div>
                        <div class="note"><strong>Note:</strong> 상품상세보기에서 보여지는 상품이미지의 사이즈를 픽셀로 설정합니다. 높이를 0 으로 설정하시면 폭에 비례하여 높이를 썸네일로 생성합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_item_use_write" class="label">사용후기 작성</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_item_use_write" class="select max-width-250px">
                            <select name="de_item_use_write" id="de_item_use_write">
                                <option value="0" <?php echo get_selected($default['de_item_use_write'], 0); ?>>주문상태와 무관하게 작성가능</option>
                                <option value="1" <?php echo get_selected($default['de_item_use_write'], 1); ?>>주문상태가 완료인 경우에만 작성가능</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 주문상태에 따른 사용후기 작성여부를 설정합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_item_use_use" class="label">사용후기</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_item_use_use" class="select max-width-250px">
                            <select name="de_item_use_use" id="de_item_use_use">
                                <option value="0" <?php echo get_selected($default['de_item_use_use'], 0); ?>>즉시 출력</option>
                                <option value="1" <?php echo get_selected($default['de_item_use_use'], 1); ?>>관리자 승인 후 출력</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 사용후기가 올라오면, 즉시 출력 혹은 관리자 승인 후 출력 여부를 설정합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_level_sell" class="label">상품구입 권한</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_level_sell" class="select max-width-250px">
                            <?php echo get_member_level_select('de_level_sell', 1, 10, $default['de_level_sell']); ?><i></i>
                        </label>
                        <div class="note margin-bottom-10"><strong>Note:</strong> 권한을 1로 설정하면 누구나 구입할 수 있습니다. 특정회원만 구입할 수 있도록 하려면 해당 권한으로 설정하십시오.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_cart_keep_term" class="label">장바구니 보관기간</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_cart_keep_term" class="input max-width-250px">
                            <i class="icon-append">일</i>
                            <input type="text" name="de_cart_keep_term" value="<?php echo get_sanitize_input($default['de_cart_keep_term']); ?>" id="de_cart_keep_term" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 장바구니 상품의 보관 기간을 설정하십시오.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_guest_cart_use" class="label">비회원 장바구니</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_guest_cart_use" class="checkbox">
                            <input type="checkbox" name="de_guest_cart_use" value="1" id="de_guest_cart_use"<?php echo $default['de_guest_cart_use']?' checked':''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 비회원 장바구니 기능을 사용하려면 체크하십시오.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_guest_cart_use" class="label">신규회원 쿠폰발행</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <span class="span-lg-block">
                                <label class="checkbox width-100px">
                                    <input type="checkbox" name="de_member_reg_coupon_use" value="1" id="de_member_reg_coupon_use" <?php echo $default['de_member_reg_coupon_use']?' checked':''; ?>><i></i> 사용
                                </label>
                                <div class="clearfix"></div>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_member_reg_coupon_price" class="label">쿠폰할인금액</label>
                                <label class="input width-150px">
                                    <i class="icon-append">원</i>
                                    <input type="text" name="de_member_reg_coupon_price" value="<?php echo get_sanitize_input($default['de_member_reg_coupon_price']); ?>" id="de_member_reg_coupon_price" class="text-end">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_member_reg_coupon_minimum" class="label">주문최소금액</label>
                                <label class="input width-150px">
                                    <i class="icon-append">원</i>
                                    <input type="text" name="de_member_reg_coupon_minimum" value="<?php echo get_sanitize_input($default['de_member_reg_coupon_minimum']); ?>" id="de_member_reg_coupon_minimum" class="text-end">
                                </label>
                            </span>
                            <span class="span-lg-block">
                                <label for="de_member_reg_coupon_term" class="label">쿠폰유효기간</label>
                                <label class="input width-150px">
                                    <i class="icon-append">일</i>
                                    <input type="text" name="de_member_reg_coupon_term" value="<?php echo get_sanitize_input($default['de_member_reg_coupon_term']); ?>" id="de_member_reg_coupon_term" class="text-end">
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="de_guest_cart_use" class="label">비회원에 대한 개인정보수집 내용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div for="de_guest_privacy" class="textarea">
                            <?php echo editor_html('de_guest_privacy', get_text(html_purifier($default['de_guest_privacy']), 0)); ?>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">MYSQL USER</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <?php echo G5_MYSQL_USER; ?>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">MYSQL DB</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <?php echo G5_MYSQL_DB; ?>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">서버 IP</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <?php echo ($_SERVER['SERVER_ADDR']?$_SERVER['SERVER_ADDR']:$_SERVER['LOCAL_ADDR']); ?>
                    </div>
                </div>
            </div>
            <script>
            function byte_check(el_cont, el_byte)
            {
                var cont = document.getElementById(el_cont);
                var bytes = document.getElementById(el_byte);
                var i = 0;
                var cnt = 0;
                var exceed = 0;
                var ch = '';
                var limit_num = (jQuery("#cf_sms_type").val() == "LMS") ? 1500 : 80;

                if( $("input[name='cf_icode_token_key']").length && $("input[name='cf_icode_token_key']").val() && jQuery("#cf_sms_type").val() == "LMS" ){
                    limit_num = 2000;
                }

                for (i=0; i<cont.value.length; i++) {
                    ch = cont.value.charAt(i);
                    if (escape(ch).length > 4) {
                        cnt += 2;
                    } else {
                        cnt += 1;
                    }
                }

                //byte.value = cnt + ' / 80 bytes';
                bytes.innerHTML = cnt + ' / ' + limit_num +' bytes';

                if (cnt > limit_num) {
                    exceed = cnt - limit_num;
                    alert('메시지 내용은 ' + limit_num +' 바이트를 넘을수 없습니다.\r\n작성하신 메세지 내용은 '+ exceed +'byte가 초과되었습니다.\r\n초과된 부분은 자동으로 삭제됩니다.');
                    var tcnt = 0;
                    var xcnt = 0;
                    var tmp = cont.value;
                    for (i=0; i<tmp.length; i++) {
                        ch = tmp.charAt(i);
                        if (escape(ch).length > 4) {
                            tcnt += 2;
                        } else {
                            tcnt += 1;
                        }

                        if (tcnt > limit_num) {
                            tmp = tmp.substring(0,i);
                            break;
                        } else {
                            xcnt = tcnt;
                        }
                    }
                    cont.value = tmp;
                    //byte.value = xcnt + ' / 80 bytes';
                    bytes.innerHTML = xcnt + ' / ' + limit_num +' bytes';
                    return;
                }
            }
            </script>
        </div>
        <?php /* 기타설정 : 끝 */ ?>

        <?php /* SMS설정 : 시작 */ ?>
        <div class="tab-pane" id="anc_scf_sms" role="tabpanel" aria-labelledby="anc_scf_sms_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>SMS설정</strong></div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="cf_sms_use" class="label">SMS 사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="cf_sms_use" class="select max-width-250px">
                            <select id="cf_sms_use" name="cf_sms_use">
                                <option value="" <?php echo get_selected($config['cf_sms_use'], ''); ?>>사용안함</option>
                                <option value="icode" <?php echo get_selected($config['cf_sms_use'], 'icode'); ?>>아이코드</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> SMS  서비스 회사를 선택하십시오. 서비스 회사를 선택하지 않으면, SMS 발송 기능이 동작하지 않습니다.<br>아이코드는 무료 문자메세지 발송 테스트 환경을 지원합니다.<br><a href="<?php echo G5_ADMIN_URL; ?>/?dir=config&amp;pid=config_form#anc_cf_sms">기본환경설정 &gt; SMS</a> 설정과 동일합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="cf_sms_type" class="label">SMS 전송유형</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="cf_sms_type" class="select max-width-250px">
                            <select id="cf_sms_type" name="cf_sms_type">
                                <option value="" <?php echo get_selected($config['cf_sms_type'], ''); ?>>SMS</option>
                                <option value="LMS" <?php echo get_selected($config['cf_sms_type'], 'LMS'); ?>>LMS</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 전송유형을 SMS로 선택하시면 최대 80바이트까지 전송하실 수 있으며<br>LMS로 선택하시면 90바이트 이하는 SMS로, 그 이상은 1500바이트까지 LMS로 전송됩니다.<br>요금은 건당 SMS는 16원, LMS는 48원입니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="de_sms_hp" class="label">관리자 휴대폰번호</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="de_sms_hp" class="input max-width-250px">
                            <input type="text" name="de_sms_hp" value="<?php echo get_sanitize_input($default['de_sms_hp']); ?>" id="de_sms_hp">
                        </label>
                        <div class="note"><strong>Note:</strong> 주문서작성시 쇼핑몰관리자가 문자메세지를 받아볼 번호를 숫자만으로 입력하세요. 예) 0101234567</div>
                    </div>
                </div>
                <div class="adm-form-tr icode_old_version">
                    <div class="adm-form-td td-l">
                        <label for="cf_icode_id" class="label">아이코드 회원아이디<br>(구버전)</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="cf_icode_id" class="input max-width-250px">
                            <input type="text" name="cf_icode_id" value="<?php echo get_sanitize_input($config['cf_icode_id']); ?>" id="cf_icode_id">
                        </label>
                        <div class="note"><strong>Note:</strong> 아이코드에서 사용하시는 회원아이디를 입력합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr icode_old_version">
                    <div class="adm-form-td td-l">
                        <label for="cf_icode_pw" class="label">아이코드 비밀번호<br>(구버전)</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="cf_icode_pw" class="input max-width-250px">
                            <input type="password" name="cf_icode_pw" value="<?php echo get_sanitize_input($config['cf_icode_pw']); ?>" id="cf_icode_pw">
                        </label>
                        <div class="note"><strong>Note:</strong> 아이코드에서 사용하시는 비밀번호를 입력합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr icode_old_version <?php if(!(isset($userinfo['payment']) && $userinfo['payment'])){ echo 'cf_tr_hide'; } ?>">
                    <div class="adm-form-td td-l">
                        <label for="cf_icode_pw" class="label">요금제<br>(구버전)</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <input type="hidden" name="cf_icode_server_ip" value="<?php echo get_sanitize_input($config['cf_icode_server_ip']); ?>">
                        <?php
                            if ($userinfo['payment'] == 'A') {
                                echo '충전제';
                                echo '<input type="hidden" name="cf_icode_server_port" value="7295">';
                            } else if ($userinfo['payment'] == 'C') {
                                echo '정액제';
                                echo '<input type="hidden" name="cf_icode_server_port" value="7296">';
                            } else {
                                echo '가입해주세요.';
                                echo '<input type="hidden" name="cf_icode_server_port" value="7295">';
                            }
                        ?>
                    </div>
                </div>
                <?php if ($userinfo['payment'] == 'A') { ?>
                <div class="adm-form-tr icode_old_version">
                    <div class="adm-form-td td-l">
                        <label class="label">충전 잔액</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <?php echo number_format($userinfo['coin']); ?> 원
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">아이코드 충전하기</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <a href="http://www.icodekorea.com/smsbiz/credit_card_amt.php?icode_id=<?php echo $config['cf_icode_id']; ?>&amp;icode_passwd=<?php echo $config['cf_icode_pw']; ?>" target="_blank" class="btn-e btn-e-lg btn-e-dark width-250px">충전하기</a>
                    </div>
                </div>
                <?php } ?>
                <div class="adm-form-tr icode_json_version">
                    <div class="adm-form-td td-l">
                        <label class="label">아이코드 토큰키<br>(JSON버전)</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input max-width-250px">
                            <input type="text" name="cf_icode_token_key" value="<?php echo get_sanitize_input($config['cf_icode_token_key']); ?>" id="cf_icode_token_key">
                        </label>
                        <div class="note"><strong>Note:</strong> 아이코드 JSON 버전의 경우 아이코드 토큰키를 입력시 실행됩니다.<br>SMS 전송유형을 LMS로 설정시 90바이트 이내는 SMS, 90 ~ 2000 바이트는 LMS 그 이상은 절삭 되어 LMS로 발송됩니다.</div>
                        <div class="note"><strong>Note:</strong> 아이코드 사이트 -> 토큰키관리 메뉴에서 생성한 토큰키를 입력합니다.</div>
                        <br>
                        서버아이피 : <?php echo $_SERVER['SERVER_ADDR']; ?>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">아이코드 SMS 신청<br>회원가입</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <a href="http://icodekorea.com/res/join_company_fix_a.php?sellid=sir2" target="_blank" class="btn-e btn-e-lg btn-e-dark width-250px">아이코드 회원가입</a>
                        <div class="note"><strong>Note:</strong> 아래 링크에서 회원가입 하시면 문자 건당 16원에 제공 받을 수 있습니다.</div>
                    </div>
                </div>
            </div>

            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>사전에 정의된 SMS프리셋</strong></div>
                <div class="adm-form-cont">
                    <p class="li-p-sq"><strong>회원가입시</strong> : {이름} {회원아이디} {회사명}</p>
                    <p class="li-p-sq"><strong>주문서작성</strong> : {이름} {보낸분} {받는분} {주문번호} {주문금액} {회사명}</p>
                    <p class="li-p-sq"><strong>입금확인시</strong> : {이름} {입금액} {주문번호} {회사명}</p>
                    <p class="li-p-sq"><strong>상품배송시</strong> : {이름} {택배회사} {운송장번호} {주문번호} {회사명}</p>
                    <div class="note"><?php echo help('주의! 80 bytes 까지만 전송됩니다. (영문 한글자 : 1byte , 한글 한글자 : 2bytes , 특수문자의 경우 1 또는 2 bytes 임)'); ?></div>
                </div>
                <div class="adm-form-cont">
                    <div id="scf_sms">
                        <?php
                        $scf_sms_title = array (1=>"회원가입시 고객님께 발송", "주문시 고객님께 발송", "주문시 관리자에게 발송", "입금확인시 고객님께 발송", "상품배송시 고객님께 발송");
                        for ($i=1; $i<=5; $i++) {
                        ?>
                        <section class="scf_sms_box">
                            <label class="label"><h6><strong><?php echo $scf_sms_title[$i]; ?></strong></h6></label>
                            <label for="de_sms_use<?php echo $i; ?>" class="checkbox">
                                <input type="checkbox" name="de_sms_use<?php echo $i; ?>" value="1" id="de_sms_use<?php echo $i; ?>" <?php echo ($default["de_sms_use".$i] ? " checked" : ""); ?>><i></i> 사용 <span class="sound_only"><?php echo $scf_sms_title[$i]; ?></span>
                            </label>
                            <div class="textarea scf_sms_img">
                                <textarea rows="5" id="de_sms_cont<?php echo $i; ?>" name="de_sms_cont<?php echo $i; ?>" ONKEYUP="byte_check('de_sms_cont<?php echo $i; ?>', 'byte<?php echo $i; ?>');"><?php echo html_purifier($default['de_sms_cont'.$i]); ?></textarea>
                            </div>
                            <div class="note" id="byte<?php echo $i; ?>" class="scf_sms_cnt">0 / 80 바이트</div>
                        </section>

                        <script>
                        byte_check('de_sms_cont<?php echo $i; ?>', 'byte<?php echo $i; ?>');
                        </script>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php /* SMS설정 : 끝 */ ?>
    </div>
    
    <div class="confirm-bottom-btn">
        <?php echo $frm_submit; ?>
    </div>

    </form>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/eyoom-form/plugins/jquery-maskedinput/jquery.maskedinput.min.js"></script>
<script>
$(function() {
    $(".anc_scf_skin").addClass('active');
});

$(function(){
    //Corporate
    $("#masked_corporate").mask('999-99-99999', {placeholder:'_'});
});
</script>

<script>
function fconfig_check(f)
{
    <?php echo get_editor_js('de_baesong_content'); ?>
    <?php echo get_editor_js('de_change_content'); ?>
    <?php echo get_editor_js('de_guest_privacy'); ?>

    var msg = "",
        pg_msg = "";

    if( f.de_pg_service.value == "kcp" ){
        if( f.de_kcp_mid.value && f.de_kcp_site_key.value && parseInt(f.de_card_test.value) > 0 ){
            pg_msg = "NHN KCP";
        }
    } else if ( f.de_pg_service.value == "lg" ) {
        if( f.cf_lg_mid.value && f.cf_lg_mert_key.value && parseInt(f.de_card_test.value) > 0 ){
            pg_msg = "토스페이먼츠";
        }
    } else if ( f.de_pg_service.value == "inicis" ) {
        if( f.de_inicis_mid.value && f.de_inicis_sign_key.value && parseInt(f.de_card_test.value) > 0 ){
            pg_msg = "KG이니시스";
        }
    } else if ( f.de_pg_service.value == "nicepay" ) {
        if( f.de_nicepay_mid.value && f.de_nicepay_key.value && parseInt(f.de_card_test.value) > 0 ){
            pg_msg = "NICEPAY";
        }
    }

    if( pg_msg ){
        msg += "(주의!) "+pg_msg+" 결제의 결제 설정이 현재 테스트결제 로 되어 있습니다.\n쇼핑몰 운영중이면 반드시 실결제로 설정하여 운영하셔야 합니다.\n실결제로 변경하려면 결제설정 탭 -> 결제 테스트에서 실결제를 선택해 주세요.\n정말로 테스트결제로 설정하시겠습니까?";
    }

    f.target = "blank_iframe";
    if( msg ){
        if (confirm(msg)){
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
}

$(function() {
    $(document).ready(function () {
        
        $("#de_global_nhnkcp_naverpay").on("click", function(e){
            if ( $(this).prop('checked') ) {
                $("#de_easy_nhnkcp_naverpay").prop('checked', true);
            }
        });

        function hash_goto_scroll(hash=""){
            var $elem = hash ? $("#"+hash) : $('#' + window.location.hash.replace('#', ''));
            if($elem.length) {

                var admin_head_height = $("#hd_top").height() + $("#container_title").height() + 30;

                $('html, body').animate({
                    scrollTop: ($elem.offset().top - admin_head_height) + 'px'
                }, 500, 'swing');
            }
        }

        hash_goto_scroll();
        
        $(document).on("click", ".pg_test_conf_link", function(e){
            e.preventDefault();

            var str_hash = this.href.split("#")[1];

            if( str_hash ){
                hash_goto_scroll(str_hash);
            }
        });
    });

    //$(".pg_info_fld").hide();
    $(".pg_vbank_url").hide();
    <?php if($default['de_pg_service']) { ?>
    //$(".<?php echo $default['de_pg_service']; ?>_info_fld").show();
    $("#<?php echo $default['de_pg_service']; ?>_vbank_url").show();
    <?php } else { ?>
    $(".kcp_info_fld").show();
    $("#kcp_vbank_url").show();
    <?php } ?>
    $(".de_pg_tab").on("click", "a", function(e){

        var pg = $(this).attr("data-value"),
            class_name = "tab-current";

        $("#de_pg_service").val(pg);
        $(this).parent("span").addClass(class_name).siblings().removeClass(class_name);

        //$(".pg_info_fld:visible").hide();
        $(".pg_vbank_url:visible").hide();
        //$("."+pg+"_info_fld").show();
        $("#"+pg+"_vbank_url").show();
        $(".scf_cardtest").addClass("scf_cardtest_hide");
        $("."+pg+"_cardtest").removeClass("scf_cardtest_hide");
        $(".scf_cardtest_tip_adm").addClass("scf_cardtest_tip_adm_hide");
        $("#"+pg+"_cardtest_tip").removeClass("scf_cardtest_tip_adm_hide");
    });

    $("#de_pg_service").on("change", function() {
        var pg = $(this).val();
        $(".pg_info_fld:visible").hide();
        $(".pg_vbank_url:visible").hide();
        $("."+pg+"_info_fld").show();
        $("#"+pg+"_vbank_url").show();
        $(".scf_cardtest").addClass("scf_cardtest_hide");
        $("."+pg+"_cardtest").removeClass("scf_cardtest_hide");
        $(".scf_cardtest_tip_adm").addClass("scf_cardtest_tip_adm_hide");
        $("#"+pg+"_cardtest_tip").removeClass("scf_cardtest_tip_adm_hide");
    });

    $(".scf_cardtest_btn").bind("click", function() {
        var $cf_cardtest_tip = $("#scf_cardtest_tip");
        var $cf_cardtest_btn = $(".scf_cardtest_btn");

        $cf_cardtest_tip.toggle();

        if($cf_cardtest_tip.is(":visible")) {
            $cf_cardtest_btn.text("테스트결제 팁 닫기");
        } else {
            $cf_cardtest_btn.text("테스트결제 팁 더보기");
        }
    });

    $(".get_shop_skin").on("click", function() {
        if(!confirm("현재 테마의 쇼핑몰 스킨 설정을 적용하시겠습니까?"))
            return false;

        $.ajax({
            type: "POST",
            url: "../theme_config_load.php",
            cache: false,
            async: false,
            data: { type: "shop_skin" },
            dataType: "json",
            success: function(data) {
                if(data.error) {
                    alert(data.error);
                    return false;
                }

                var field = Array('de_shop_skin', 'de_shop_mobile_skin');
                var count = field.length;
                var key;

                for(i=0; i<count; i++) {
                    key = field[i];

                    if(data[key] != undefined && data[key] != "")
                        $("select[name="+key+"]").val(data[key]);
                }
            }
        });
    });

    $(".shop_pc_index, .shop_mobile_index, .shop_etc").on("click", function() {
        if(!confirm("현재 테마의 스킨, 이미지 사이즈 등의 설정을 적용하시겠습니까?"))
            return false;

        var type = $(this).attr("class");
        var $el;

        $.ajax({
            type: "POST",
            url: "../theme_config_load.php",
            cache: false,
            async: false,
            data: { type: type },
            dataType: "json",
            success: function(data) {
                if(data.error) {
                    alert(data.error);
                    return false;
                }

                $.each(data, function(key, val) {
                    if(key == "error")
                        return true;

                    $el = $("#"+key);

                    if($el[0].type == "checkbox") {
                        $el.attr("checked", parseInt(val) ? true : false);
                        return true;
                    }
                    $el.val(val);
                });
            }
        });
    });

    $(document).on("change", "#de_taxsave_use", function(e){
        var $val = $(this).val();
        
        if( parseInt($val) > 0 ){
            $("#de_taxsave_types").show();
        } else {
            $("#de_taxsave_types").hide();
        }
    });
    
    // 현금영수증 발급수단 중 무통장입금은 무조건 체크처리
    document.getElementById("de_taxsave_types_account").checked = true;
    document.getElementById("de_taxsave_types_account").disabled = true;
});
</script>

<?php
// 결제모듈 실행권한 체크
if($default['de_iche_use'] || $default['de_vbank_use'] || $default['de_hp_use'] || $default['de_card_use']) {
    // kcp의 경우 pp_cli 체크
    if($default['de_pg_service'] == 'kcp') {
        if(!extension_loaded('openssl')) {
            echo '<script>'.PHP_EOL;
            echo 'alert("PHP openssl 확장모듈이 설치되어 있지 않습니다.\n모바일 쇼핑몰 결제 때 사용되오니 openssl 확장 모듈을 설치하여 주십시오.");'.PHP_EOL;
            echo '</script>'.PHP_EOL;
        }

        if(!extension_loaded('soap') || !class_exists('SOAPClient')) {
            echo '<script>'.PHP_EOL;
            echo 'alert("PHP SOAP 확장모듈이 설치되어 있지 않습니다.\n모바일 쇼핑몰 결제 때 사용되오니 SOAP 확장 모듈을 설치하여 주십시오.");'.PHP_EOL;
            echo '</script>'.PHP_EOL;
        }

        $is_linux = true;
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
            $is_linux = false;

        $exe = '/kcp/bin/';
        if($is_linux) {
            if(PHP_INT_MAX == 2147483647) // 32-bit
                $exe .= 'pp_cli';
            else
                $exe .= 'pp_cli_x64';
        } else {
            $exe .= 'pp_cli_exe.exe';
        }

        echo module_exec_check(G5_SHOP_PATH.$exe, 'pp_cli');

        // shop/kcp/log 디렉토리 체크 후 있으면 경고
        if(is_dir(G5_SHOP_PATH.'/kcp/log') && is_writable(G5_SHOP_PATH.'/kcp/log')) {
            echo '<script>'.PHP_EOL;
            echo 'alert("웹접근 가능 경로에 log 디렉토리가 있습니다.\nlog 디렉토리를 웹에서 접근 불가능한 경로로 변경해 주십시오.\n\nlog 디렉토리 경로 변경은 SIR FAQ를 참고해 주세요.")'.PHP_EOL;
            echo '</script>'.PHP_EOL;
        }
    }

    // LG의 경우 log 디렉토리 체크
    if($default['de_pg_service'] == 'lg') {
        $log_path = G5_LGXPAY_PATH.'/lgdacom/log';

        try {
            if( ! is_dir($log_path) && is_writable(G5_LGXPAY_PATH.'/lgdacom/') ){
                @mkdir($log_path, G5_DIR_PERMISSION);
                @chmod($log_path, G5_DIR_PERMISSION);
            }
        } catch(Exception $e) {
        }

        if(!is_dir($log_path)) {

            if( is_writable(G5_LGXPAY_PATH.'/lgdacom/') ){
                // 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
                @mkdir($log_path, G5_DIR_PERMISSION);
                @chmod($log_path, G5_DIR_PERMISSION);
            }

            if(!is_dir($log_path)){
                echo '<script>'.PHP_EOL;
                echo 'alert("'.str_replace(G5_PATH.'/', '', G5_LGXPAY_PATH).'/lgdacom 폴더 안에 log 폴더를 생성하신 후 쓰기권한을 부여해 주십시오.\n> mkdir log\n> chmod 707 log");'.PHP_EOL;
                echo '</script>'.PHP_EOL;
            }
        }

        if(is_writable($log_path)) {
            if( function_exists('check_log_folder') ){
                check_log_folder($log_path);
            }
        } else {
            echo '<script>'.PHP_EOL;
            echo 'alert("'.str_replace(G5_PATH.'/', '',$log_path).' 폴더에 쓰기권한을 부여해 주십시오.\n> chmod 707 log");'.PHP_EOL;
            echo '</script>'.PHP_EOL;
        }
    }

    // 이니시스의 경우 log 디렉토리 체크
    if($default['de_pg_service'] == 'inicis') {
        if (!function_exists('xml_set_element_handler')) {
            echo '<script>'.PHP_EOL;
            echo 'alert("XML 관련 함수를 사용할 수 없습니다.\n서버 관리자에게 문의해 주십시오.");'.PHP_EOL;
            echo '</script>'.PHP_EOL;
        }

        if (!function_exists('openssl_get_publickey')) {
            echo '<script>'.PHP_EOL;
            echo 'alert("OPENSSL 관련 함수를 사용할 수 없습니다.\n서버 관리자에게 문의해 주십시오.");'.PHP_EOL;
            echo '</script>'.PHP_EOL;
        }

        if (!function_exists('socket_create')) {
            echo '<script>'.PHP_EOL;
            echo 'alert("SOCKET 관련 함수를 사용할 수 없습니다.\n서버 관리자에게 문의해 주십시오.");'.PHP_EOL;
            echo '</script>'.PHP_EOL;
        }

        $log_path = G5_SHOP_PATH.'/inicis/log';
        
        try {
            if( ! is_dir($log_path) && is_writable(G5_SHOP_PATH.'/inicis/') ){
                @mkdir($log_path, G5_DIR_PERMISSION);
                @chmod($log_path, G5_DIR_PERMISSION);
            }
        } catch(Exception $e) {
        }

        if( function_exists('check_log_folder') && is_writable($log_path) ){
            check_log_folder($log_path);
        }
    }

    // 카카오페이의 경우 log 디렉토리 체크
    if($default['de_kakaopay_mid'] && $default['de_kakaopay_key'] && $default['de_kakaopay_enckey'] && $default['de_kakaopay_hashkey'] && $default['de_kakaopay_cancelpwd']) {
        $log_path = G5_SHOP_PATH.'/kakaopay/log';

        if(!is_dir($log_path)) {
            echo '<script>'.PHP_EOL;
            echo 'alert("'.str_replace(G5_PATH.'/', '', G5_SHOP_PATH).'/kakaopay 폴더 안에 log 폴더를 생성하신 후 쓰기권한을 부여해 주십시오.\n> mkdir log\n> chmod 707 log");'.PHP_EOL;
            echo '</script>'.PHP_EOL;
        } else {
            if(!is_writable($log_path)) {
                echo '<script>'.PHP_EOL;
                echo 'alert("'.str_replace(G5_PATH.'/', '',$log_path).' 폴더에 쓰기권한을 부여해 주십시오.\n> chmod 707 log");'.PHP_EOL;
                echo '</script>'.PHP_EOL;
            } else {
                if( function_exists('check_log_folder') && is_writable($log_path) ){
                    check_log_folder($log_path);
                }
            }
        }
    }
}
?>