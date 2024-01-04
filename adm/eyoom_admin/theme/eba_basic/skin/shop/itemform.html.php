<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shop/itemform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/magnific-popup/magnific-popup.min.css" type="text/css" media="screen">',0);
if ($config['cf_editor'] == 'tuieditor') echo tuieditor_resource();

/**
 * 페이지 경로 설정
 */
$fm_pid = 'itemlist';
$g5_title = '상품관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">쇼핑몰관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';

$frm_eba_submit  = ' <div class="confirm-fixed-btn"> ';
$frm_eba_submit .= ' <input type="submit" value="적용하기" class="btn-e btn-e-md btn-e-crimson" accesskey="s">' ;
$frm_eba_submit .= '</div>';
$frm_submit .= $frm_eba_submit;
?>

<style>
.admin-shop-itemform .sit_option {margin:0 0 20px;padding:0;border:1px solid var(--tbc-default)}
.admin-shop-itemform .sit_option .sit-option-list {position:relative;padding:10px;border-bottom:1px solid var(--tbc-default)}
.admin-shop-itemform .sit_option .sit-option-list:after {content:"";display:block;clear:both}
.admin-shop-itemform .sit_option .sit-option-item {float:left;width:50%}
.admin-shop-itemform .sit_option #sit_option_addfrm_btn {text-align:center;padding:10px 0;border-bottom:1px solid var(--tbc-default)}
.admin-shop-itemform .sit_option #sit_option_addfrm_btn button {position:relative;top:inherit;right:inherit}
.admin-shop-itemform .adm-form-thumb {display:flex}
.admin-shop-itemform .adm-form-thumb-img {flex-shrink:0;width:120px;margin-right:10px}
.admin-shop-itemform .adm-form-thumb .goods-thumb {width:120px;height:auto;border:1px solid var(--tbc-default);padding:5px}
.admin-shop-itemform .adm-form-thumb .no-goods-thumb {width:120px;height:auto;min-height:70px;border:1px dashed var(--tbc-default);padding:5px}
.admin-shop-itemform .adm-form-thumb-file {flex-grow:1;position:relative}
.admin-shop-itemform .relation-sbox-margin-top {margin-top:48px}
.admin-shop-itemform #relation ul {list-style:none;margin:0;padding:0}
.admin-shop-itemform #relation ul li {position:relative;border:1px solid var(--tbc-default);border-bottom:0;padding:10px;clear:both}
.admin-shop-itemform #relation ul li:last-child {border-bottom:1px solid var(--tbc-default)}
.admin-shop-itemform #relation ul li img {margin-right:10px;width:50px}
.admin-shop-itemform #relation ul li .list_item {display:block;text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden;margin-right:58px}
.admin-shop-itemform #relation ul li .list_item_btn {position:absolute;top:50%;right:10px;transform:translateY(-50%);margin:0;float:inherit}
.admin-shop-itemform #relation ul li .list_item_btn .btn-e-red {background-color:#ab0000;border-color:#ab0000}
.admin-shop-itemform #relation ul li .add_item {width:48px;text-align:center;padding:0}
.admin-shop-itemform #reg_relation ul {list-style:none;margin:0;padding:0}
.admin-shop-itemform #reg_relation ul li {position:relative;border:1px solid var(--tbc-default);border-bottom:0;padding:10px;clear:both}
.admin-shop-itemform #reg_relation ul li:last-child {border-bottom:1px solid var(--tbc-default)}
.admin-shop-itemform #reg_relation ul li img {margin-right:10px;width:50px}
.admin-shop-itemform #reg_relation ul li .list_item {display:block;text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden;margin-right:58px}
.admin-shop-itemform #reg_relation ul li .list_item_btn {position:absolute;top:50%;right:10px;transform:translateY(-50%);margin:0;float:inherit}
.admin-shop-itemform #reg_relation ul li .list_item_btn .btn-e-red {background-color:#ab0000;border-color:#ab0000}
.admin-shop-itemform #reg_relation ul li .del_item {width:48px;text-align:center;padding:0}
.admin-shop-itemform .event-box {padding:10px;border:1px solid var(--tbc-default)}
.admin-shop-itemform #event_list ul {list-style:none;padding:0;margin:0}
.admin-shop-itemform #event_list ul li {position:relative;margin-bottom:10px}
.admin-shop-itemform #event_list ul li:last-child {margin-bottom:0}
.admin-shop-itemform #event_list ul li .list_item {display:block;text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden;margin-right:58px}
.admin-shop-itemform #event_list ul li .list_item_btn {position:absolute;top:0;right:0}
.admin-shop-itemform #event_list ul li .list_item_btn .btn-e-red {background-color:#ab0000;border-color:#ab0000}
.admin-shop-itemform #event_list ul li .add_event {width:48px;text-align:center;padding:0}
.admin-shop-itemform #reg_event_list ul {list-style:none;padding:0;margin:0}
.admin-shop-itemform #reg_event_list ul li {position:relative;margin-bottom:10px}
.admin-shop-itemform #reg_event_list ul li:last-child {margin-bottom:0}
.admin-shop-itemform #reg_event_list ul li .list_item {display:block;text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden;margin-right:58px}
.admin-shop-itemform #reg_event_list ul li .list_item_btn {position:absolute;top:0;right:0}
.admin-shop-itemform #reg_event_list ul li .list_item_btn .btn-e-red {background-color:#ab0000;border-color:#ab0000}
.admin-shop-itemform #reg_event_list ul li .del_event {width:48px;text-align:center;padding:0}
@media (max-width: 1199px) {
    .pg-anchor-in .nav-tabs li:nth-child(10) a, .pg-anchor-in .nav-tabs li:nth-child(11) a {border-bottom:0}
}
@media (max-width: 991px) {
    .admin-shop-itemform .relation-sbox-margin-top {margin-top:0}
    .admin-shop-itemform #reg_relation ul {margin-top:0}
}
@media (max-width: 767px) {
    .admin-shop-itemform .sit_option .sit-option-item {float:inherit;width:100%;margin-bottom:5px}
    .admin-shop-itemform .adm-form-thumb {display:inherit}
    .admin-shop-itemform .adm-form-thumb-img {flex-shrink:inherit;margin-right:0;margin-bottom:10px}
    .admin-shop-itemform .adm-form-thumb-file {flex-grow:inherit}
    .admin-shop-itemform #scrollbar_container_1 {position:relative;overflow:hidden;display:block}
    .admin-shop-itemform #scrollbar_container_2 {position:relative;overflow:hidden;display:block}
    .admin-shop-itemform .scrollbar-container {position:relative;display:block}
}
</style>

<div class="admin-shop-itemform">
    <form name="fitemform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fitemformcheck(this);" enctype="multipart/form-data" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="codedup" value="<?php echo $default['de_code_dup_use']; ?>">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="sca" value="<?php echo $sca; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod"  value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx"  value="<?php echo $stx; ?>">
    <input type="hidden" name="sdt"  value="<?php echo $sdt; ?>">
    <input type="hidden" name="fr_date"  value="<?php echo $fr_date; ?>">
    <input type="hidden" name="to_date"  value="<?php echo $to_date; ?>">
    <input type="hidden" name="ituse"  value="<?php echo $ituse; ?>">
    <input type="hidden" name="itsoldout"  value="<?php echo $itsoldout; ?>">
    <input type="hidden" name="itype"  value="<?php echo $itype; ?>">
    <input type="hidden" name="cate_a" value="<?php echo $cate_a; ?>">
    <input type="hidden" name="cate_b" value="<?php echo $cate_b; ?>">
    <input type="hidden" name="cate_c" value="<?php echo $cate_c; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="uploading" id="uploading" value="">

    <?php if ($w == 'u') { ?>
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
    <?php } ?>

    <div class="tab-content">
        <?php /* 상품분류 : 시작 */ ?>
        <div class="<?php echo $w=='u' ? 'tab-pane ': ''; ?> show active" id="anc_sitfrm_cate" role="tabpanel" aria-labelledby="anc_sitfrm_cate_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>상품분류</strong></div>
                <div class="adm-form-info">
                    <div class="cont-text-bg">
                        <p class="bg-info">
                            <i class="fas fa-info-circle"></i> 기본분류는 반드시 선택하셔야 합니다. 하나의 상품에 최대 3개의 다른 분류를 지정할 수 있습니다.
                        </p>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="ca_id" class="label">기본분류</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select name="ca_id" id="ca_id" onchange="categorychange(this.form)">
                                <option value="">선택하세요</option>
                                <?php echo conv_selected_option($category_select, $it['ca_id']); ?>
                            </select><i></i>
                        </label>
                        <?php if ($w == "") { ?>
                        <div class="note"><strong>Note:</strong> 기본분류를 선택하면, 판매/재고/HTML사용/판매자 E-mail 등을, 선택한 분류의 기본값으로 설정합니다.</div>
                        <?php } ?>
                        <script>
                            var ca_use = new Array();
                            var ca_stock_qty = new Array();
                            //var ca_explan_html = new Array();
                            var ca_sell_email = new Array();
                            var ca_opt1_subject = new Array();
                            var ca_opt2_subject = new Array();
                            var ca_opt3_subject = new Array();
                            var ca_opt4_subject = new Array();
                            var ca_opt5_subject = new Array();
                            var ca_opt6_subject = new Array();
                            <?php echo "\n$script"; ?>
                        </script>
                    </div>
                </div>
                <?php for ($i=2; $i<=3; $i++) { ?>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="ca_id<?php echo $i; ?>"><?php echo $i; ?>차 분류</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select name="ca_id<?php echo $i; ?>" id="ca_id<?php echo $i; ?>">
                                <option value="">선택하세요</option>
                                <?php echo conv_selected_option($category_select, $it['ca_id'.$i]); ?>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> <?php echo $i; ?>차 분류는 기본 분류의 하위 분류 개념이 아니므로 기본 분류 선택시 해당 상품이 포함될 최하위 분류만 선택하시면 됩니다.</div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php /* 상품분류 선택 : 끝 */ ?>

        <?php /* 스킨설정 : 시작 */ ?>
        <div class="<?php echo $w=='u' ? 'tab-pane ': ''; ?>" id="anc_sitfrm_skin" role="tabpanel" aria-labelledby="anc_sitfrm_skin_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>스킨설정</strong></div>
                <div class="adm-form-info">
                    <div class="cont-text-bg">
                        <p class="bg-info">
                            <i class="fas fa-info-circle"></i> 상품상세보기에서 사용할 스킨을 설정합니다.
                        </p>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_skin" class="label">PC용 스킨</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <?php echo get_skin_select('shop', 'it_skin', 'it_skin', $it['it_skin'] ? $it['it_skin']: 'basic'); ?><i></i>
                        </label>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_skin" class="checkbox"><input type="checkbox" name="chk_ca_it_skin" value="1" id="chk_ca_it_skin"><i></i>분류적용</label>
                                <label for="chk_all_it_skin" class="checkbox"><input type="checkbox" name="chk_all_it_skin" value="1" id="chk_all_it_skin"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_mobile_skin" class="label">모바일용 스킨</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <?php echo get_mobile_skin_select('shop', 'it_mobile_skin', 'it_mobile_skin', $it['it_mobile_skin'] ? $it['it_mobile_skin']: 'basic'); ?><i></i>
                        </label>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_mobile_skin" class="checkbox"><input type="checkbox" name="chk_ca_it_mobile_skin" value="1" id="chk_ca_it_mobile_skin"><i></i>분류적용</label>
                                <label for="chk_all_it_mobile_skin" class="checkbox"><input type="checkbox" name="chk_all_it_mobile_skin" value="1" id="chk_all_it_mobile_skin"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 스킨설정 : 끝 */ ?>

        <?php /* 기본정보 : 시작 */ ?>
        <div class="<?php echo $w=='u' ? 'tab-pane ': ''; ?>" id="anc_sitfrm_ini" role="tabpanel" aria-labelledby="anc_sitfrm_ini_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>기본정보 입력</strong></div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="it_skin" class="label">상품코드</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <?php if ($w == '') { ?>
                        <label for="" class="input max-width-250px">
                            <input type="text" name="it_id" value="<?php echo time(); ?>" id="it_id" required  maxlength="20">
                        </label>
                        <div class="note"><strong>Note:</strong> 상품의 코드는 10자리 숫자로 자동생성합니다. <b>직접 상품코드를 입력할 수도 있습니다.</b><br>상품코드는 영문자, 숫자, - 만 입력 가능합니다.</div>
                        <?php } else { ?>
                        <input type="hidden" name="it_id" value="<?php echo $it['it_id']; ?>">
                        <span class="text-indigo m-r-10 m-b-5"><?php echo $it['it_id']; ?></span>
                        <a href="<?php echo shop_item_url($it_id); ?>" target="_blank" class="btn-e btn-e-lg btn-e-dark m-b-5">상품확인</a>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemuselist&sfl=a.it_id&stx=<?php echo $it['it_id']; ?>" class="btn-e btn-e-lg btn-e-dark m-b-5">사용후기</a>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemqalist&sfl=a.it_id&stx=<?php echo $it['it_id']; ?>" class="btn-e btn-e-lg btn-e-dark m-b-5">상품문의</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="it_name" class="label">상품명</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input">
                            <input type="text" name="it_name" value="<?php echo get_text(cut_str($it['it_name'], 250, "")); ?>" id="it_name" required>
                        </label>
                        <div class="note"><strong>Note:</strong> HTML 입력이 불가합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_basic" class="label">기본설명</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input">
                            <input type="text" name="it_basic" value="<?php echo get_text(html_purifier($it['it_basic'])); ?>" id="it_basic">
                        </label>
                        <div class="note"><strong>Note:</strong> 상품명 하단에 상품에 대한 추가적인 설명이 필요한 경우에 입력합니다. HTML 입력도 가능합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_basic" class="checkbox"><input type="checkbox" name="chk_ca_it_basic" value="1" id="chk_ca_it_basic"><i></i>분류적용</label>
                                <label for="chk_all_it_basic" class="checkbox"><input type="checkbox" name="chk_all_it_basic" value="1" id="chk_all_it_basic"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_order" class="label">출력순서</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <input type="text" name="it_order" value="<?php echo $it['it_order']; ?>" id="it_order">
                        </label>
                        <div class="note"><strong>Note:</strong> 숫자가 작을 수록 상위에 출력됩니다. 음수 입력도 가능하며 입력 가능 범위는 -2147483648 부터 2147483647 까지입니다.<br><b>입력하지 않으면 자동으로 출력됩니다.</b></div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_order" class="checkbox"><input type="checkbox" name="chk_ca_it_order" value="1" id="chk_ca_it_order"><i></i>분류적용</label>
                                <label for="chk_all_it_order" class="checkbox"><input type="checkbox" name="chk_all_it_order" value="1" id="chk_all_it_order"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label class="label">상품유형</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <div class="inline-group">
                            <label class="checkbox">
                                <input type="checkbox" name="it_type1" id="it_type1" value="1" <?php echo ($it['it_type1'] ? "checked" : ""); ?>><i></i><span>히트</span>
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="it_type2" id="it_type2" value="1" <?php echo ($it['it_type2'] ? "checked" : ""); ?> ><i></i><span class="text-orange">추천</span>
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="it_type3" id="it_type3" value="1" <?php echo ($it['it_type3'] ? "checked" : ""); ?> ><i></i><span class="text-crimson">신상</span>
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="it_type4" id="it_type4" value="1" <?php echo ($it['it_type4'] ? "checked" : ""); ?>><i></i><span class="text-teal">인기</span>
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="it_type5" id="it_type5" value="1" <?php echo ($it['it_type5'] ? "checked" : ""); ?>><i></i><span class="text-purple">할인</span>
                            </label>
                        </div>
                        <div class="note"><strong>Note:</strong> 메인화면에 유형별로 출력할때 사용합니다.<br>이곳에 체크하게되면 상품리스트에서 유형별로 정렬할때 체크된 상품이 가장 먼저 출력됩니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_type" class="checkbox"><input type="checkbox" name="chk_ca_it_type" value="1" id="chk_ca_it_type"><i></i>분류적용</label>
                                <label for="chk_all_it_type" class="checkbox"><input type="checkbox" name="chk_all_it_type" value="1" id="chk_all_it_type"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_maker" class="label">제조사</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <input type="text" name="it_maker" value="<?php echo get_text($it['it_maker']); ?>" id="it_maker">
                        </label>
                        <div class="note"><strong>Note:</strong> 입력하지 않으면 상품상세페이지에 출력하지 않습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_maker" class="checkbox"><input type="checkbox" name="chk_ca_it_maker" value="1" id="chk_ca_it_maker"><i></i>분류적용</label>
                                <label for="chk_all_it_maker" class="checkbox"><input type="checkbox" name="chk_all_it_maker" value="1" id="chk_all_it_maker"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_origin" class="label">원산지</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <input type="text" name="it_origin" value="<?php echo get_text($it['it_origin']); ?>" id="it_origin">
                        </label>
                        <div class="note"><strong>Note:</strong> 입력하지 않으면 상품상세페이지에 출력하지 않습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_origin" class="checkbox"><input type="checkbox" name="chk_ca_it_origin" value="1" id="chk_ca_it_origin"><i></i>분류적용</label>
                                <label for="chk_all_it_origin" class="checkbox"><input type="checkbox" name="chk_all_it_origin" value="1" id="chk_all_it_origin"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_brand" class="label">브랜드</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <div class="inline-group">
                            <span>
                                <label class="input width-250px">
                                    <input type="text" name="it_brand" value="<?php echo get_text($it['it_brand']); ?>" id="it_brand">
                                </label>
                                <input type="hidden" name="it_brand_prev" value="<?php echo get_text($it['it_brand']); ?>">
                            </span>
                            <?php if ($br_cnt > 0) { ?>
                            <span>
                                <label for="it_brcode" class="select width-250px">
                                    <select name="it_brcode" id="it_brcode" onchange="set_brand(this);">
                                        <option value="">:: 브랜드 선택 ::</option>
                                        <?php foreach ($brlist as $k => $li) { ?>
                                        <option value="<?php echo $li['br_code']; ?>" <?php echo $li['br_code'] == $it['it_brcode'] ? 'selected': ''; ?>><?php echo $li['br_name']; ?></option>
                                        <?php } ?>
                                    </select><i></i>
                                </label>
                                <script>
                                function set_brand(sel) {
                                    var brand = sel.options[sel.selectedIndex].text;
                                    var brcode = sel.options[sel.selectedIndex].value;
                                    if (brcode) {
                                        $("#it_brand").val(brand);
                                    } else {
                                        $("#it_brand").val('');
                                    }
                                }
                                </script>
                            </span>
                            <?php } ?>
                        </div>
                        <div class="note"><strong>Note:</strong> 선택할 브랜드가 없다면 브랜드명을 입력해 주세요. 입력하지 않으면 상품상세페이지에 출력하지 않습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_brand" class="checkbox"><input type="checkbox" name="chk_ca_it_brand" value="1" id="chk_ca_it_brand"><i></i>분류적용</label>
                                <label for="chk_all_it_brand" class="checkbox"><input type="checkbox" name="chk_all_it_brand" value="1" id="chk_all_it_brand"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_model" class="label">모델</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <input type="text" name="it_model" value="<?php echo get_text($it['it_model']); ?>" id="it_model">
                        </label>
                        <div class="note"><strong>Note:</strong> 입력하지 않으면 상품상세페이지에 출력하지 않습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_model" class="checkbox"><input type="checkbox" name="chk_ca_it_model" value="1" id="chk_ca_it_model"><i></i>분류적용</label>
                                <label for="chk_all_it_model" class="checkbox"><input type="checkbox" name="chk_all_it_model" value="1" id="chk_all_it_model"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_tel_inq" class="label">전화문의</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="it_tel_inq" value="1" id="it_tel_inq" <?php echo ($it['it_tel_inq']) ? "checked" : ""; ?>><i></i> 예
                        </label>
                        <div class="note"><strong>Note:</strong> 상품 금액 대신 전화문의로 표시됩니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_tel_inq" class="checkbox"><input type="checkbox" name="chk_ca_it_tel_inq" value="1" id="chk_ca_it_tel_inq"><i></i>분류적용</label>
                                <label for="chk_all_it_tel_inq" class="checkbox"><input type="checkbox" name="chk_all_it_tel_inq" value="1" id="chk_all_it_tel_inq"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_use" class="label">판매가능</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="it_use" value="1" id="it_use" <?php echo ($it['it_use']) ? "checked" : ""; ?>><i></i> 예
                        </label>
                        <div class="note"><strong>Note:</strong> 잠시 판매를 중단하거나 재고가 없을 경우에 체크를 해제해 놓으면 출력되지 않으며, 주문도 받지 않습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_use" class="checkbox"><input type="checkbox" name="chk_ca_it_use" value="1" id="chk_ca_it_use"><i></i>분류적용</label>
                                <label for="chk_all_it_use" class="checkbox"><input type="checkbox" name="chk_all_it_use" value="1" id="chk_all_it_use"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_nocoupon" class="label">쿠폰적용안함</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="it_nocoupon" value="1" id="it_nocoupon" <?php echo ($it['it_nocoupon']) ? "checked" : ""; ?>><i></i> 예
                        </label>
                        <div class="note"><strong>Note:</strong> 설정에 체크하시면 쿠폰 생성 때 상품 검색 결과에 노출되지 않습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_nocoupon" class="checkbox"><input type="checkbox" name="chk_ca_it_nocoupon" value="1" id="chk_ca_it_nocoupon"><i></i>분류적용</label>
                                <label for="chk_all_it_nocoupon" class="checkbox"><input type="checkbox" name="chk_all_it_nocoupon" value="1" id="chk_all_it_nocoupon"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="ec_mall_pid" class="label">네이버쇼핑 상품ID</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input max-width-250px">
                            <input type="text" name="ec_mall_pid" value="<?php echo get_text($it['ec_mall_pid']); ?>" id="ec_mall_pid">
                        </label>
                        <div class="note"><strong>Note:</strong> 네이버쇼핑에 입점한 경우 네이버쇼핑 상품ID를 입력하시면 네이버페이와 연동됩니다.<br>일부 쇼핑몰의 경우 네이버쇼핑 상품ID 대신 쇼핑몰 상품ID를 입력해야 하는 경우가 있습니다.<br>네이버페이 연동과정에서 이 부분에 대한 안내가 이뤄지니 안내받은 대로 값을 입력하시면 됩니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_explan" class="label">상품설명</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="textarea">
                            <?php echo editor_html('it_explan', get_text(html_purifier($it['it_explan']), 0)); ?>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_mobile_explan" class="label">모바일 상품설명</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="textarea">
                            <?php echo editor_html('it_mobile_explan', get_text(html_purifier($it['it_mobile_explan']), 0)); ?>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_sell_email" class="label">판매자 e-mail</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <input type="text" name="it_sell_email" value="<?php echo get_sanitize_input($it['it_sell_email']); ?>" id="it_sell_email">
                        </label>
                        <div class="note"><strong>Note:</strong> 운영자와 실제 판매자가 다른 경우 실제 판매자의 e-mail을 입력하면, 상품 주문 시점을 기준으로 실제 판매자에게도 주문서를 발송합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_sell_email" class="checkbox"><input type="checkbox" name="chk_ca_it_sell_email" value="1" id="chk_ca_it_sell_email"><i></i>분류적용</label>
                                <label for="chk_all_it_sell_email" class="checkbox"><input type="checkbox" name="chk_all_it_sell_email" value="1" id="chk_all_it_sell_email"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_shop_memo" class="label">상점메모</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="textarea">
                            <textarea name="it_shop_memo" id="it_shop_memo"><?php echo html_purifier($it['it_shop_memo']); ?></textarea>
                        </label>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_shop_memo" class="checkbox"><input type="checkbox" name="chk_ca_it_shop_memo" value="1" id="chk_ca_it_shop_memo"><i></i>분류적용</label>
                                <label for="chk_all_it_shop_memo" class="checkbox"><input type="checkbox" name="chk_all_it_shop_memo" value="1" id="chk_all_it_shop_memo"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 기본정보 : 끝 */ ?>

        <?php /* 상품요약정보 : 시작 */ ?>
        <div class="<?php echo $w=='u' ? 'tab-pane ': ''; ?>" id="anc_sitfrm_compact" role="tabpanel" aria-labelledby="anc_sitfrm_compact_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>상품요약정보</strong></div>
                <div class="adm-form-info">
                    <div class="cont-text-bg">
                        <p class="bg-info">
                            <i class="fas fa-info-circle"></i> <strong>전자상거래 등에서의 상품 등의 정보제공에 관한 고시</strong>에 따라 총 35개 상품군에 대해 상품 특성 등을 양식에 따라 입력할 수 있습니다.
                        </p>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="it_info_gubun" class="label">상품군 선택</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select id="it_info_gubun" name="it_info_gubun">
                                <option value="">상품군을 선택하세요.</option>
                                <?php
                                if(!$it['it_info_gubun']) $it['it_info_gubun'] = 'wear';
                                foreach($item_info as $key=>$value) {
                                    $opt_value = $key;
                                    $opt_text  = $value['title'];
                                ?>
                                <option value="<?php echo $opt_value; ?>" <?php echo get_selected($opt_value, $it['it_info_gubun']); ?>><?php echo $opt_text; ?></option>
                                <?php } ?>
                            </select>
                            <i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 상품군을 선택하면 자동으로 항목이 변환됩니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="it_info_use" class="label">상품요약정보 사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="checkbox">
                            <input type="checkbox" name="it_info_use" id="it_info_use" value="1" <?php echo ($it['it_info_use']) ? "checked" : ""; ?>><i></i> 예
                        </label>
                        <div class="note"><strong>Note:</strong> 체크를 해제하시면 상품상세 페이지에 노출되지 않습니다.</div>
                    </div>
                </div>
            </div>

            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>상품요약정보 상세설정</strong></div>
                <div id="sit_compact_fields">
                    <?php include_once(EYOOM_ADMIN_CORE_PATH.'/shop/iteminfo.php'); ?>
                </div>
                <script>
                $(function(){
                    $(document).on("change", "#it_info_gubun", function() {
                        var gubun = $(this).val();
                        $.post(
                            "<?php echo EYOOM_ADMIN_CORE_URL; ?>//shop/iteminfo.php",
                            { it_id: "<?php echo $it['it_id']; ?>", gubun: gubun },
                            function(data) {
                                $("#sit_compact_fields").empty().html(data);
                            }
                        );
                    });
                });
                </script>
            </div>
        </div>
        <?php /* 상품요약정보 : 끝 */ ?>

        <?php /* 가격 및 재고 : 시작 */ ?>
        <div class="<?php echo $w=='u' ? 'tab-pane ': ''; ?>" id="anc_sitfrm_cost" role="tabpanel" aria-labelledby="anc_sitfrm_cost_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>가격 및 재고</strong></div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_price" class="label">판매가격</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <input type="text" name="it_price" value="<?php echo $it['it_price']; ?>" id="it_price">
                        </label>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_price" class="checkbox"><input type="checkbox" name="chk_ca_it_price" value="1" id="chk_ca_it_price"><i></i>분류적용</label>
                                <label for="chk_all_it_price" class="checkbox"><input type="checkbox" name="chk_all_it_price" value="1" id="chk_all_it_price"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_cust_price" class="label">시중가격</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <input type="text" name="it_cust_price" value="<?php echo $it['it_cust_price']; ?>" id="it_cust_price">
                        </label>
                        <div class="note"><strong>Note:</strong> 입력하지 않으면 상품상세페이지에 출력하지 않습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_cust_price" class="checkbox"><input type="checkbox" name="chk_ca_it_cust_price" value="1" id="chk_ca_it_cust_price"><i></i>분류적용</label>
                                <label for="chk_all_it_cust_price" class="checkbox"><input type="checkbox" name="chk_all_it_cust_price" value="1" id="chk_all_it_cust_price"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_point_type" class="label">포인트 유형</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <select name="it_point_type" id="it_point_type">
                                <option value="0"<?php echo get_selected('0', $it['it_point_type']); ?>>설정금액</option>
                                <option value="1"<?php echo get_selected('1', $it['it_point_type']); ?>>판매가기준 설정비율</option>
                                <option value="2"<?php echo get_selected('2', $it['it_point_type']); ?>>구매가기준 설정비율</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 포인트 유형을 설정할 수 있습니다. 비율로 설정했을 경우 설정 기준금액의 %비율로 포인트가 지급됩니다.</div>
                        <script>
                        $(function() {
                            $("#it_point_type").change(function() {
                                if(parseInt($(this).val()) > 0)
                                    $("#it_point_unit").text("%");
                                else
                                    $("#it_point_unit").text("점");
                            });
                        });
                        </script>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_point_type" class="checkbox"><input type="checkbox" name="chk_ca_it_point_type" value="1" id="chk_ca_it_point_type"><i></i>분류적용</label>
                                <label for="chk_all_it_point_type" class="checkbox"><input type="checkbox" name="chk_all_it_point_type" value="1" id="chk_all_it_point_type"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_point" class="label">포인트</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i id="it_point_unit" class="icon-append"><?php if($it['it_point_type']) echo '%'; else echo '점'; ?></i>
                            <input type="text" name="it_point" value="<?php echo $it['it_point']; ?>" id="it_point" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 주문완료후 환경설정에서 설정한 주문완료 설정일 후 회원에게 부여하는 포인트입니다.\n또, 포인트부여를 '아니오'로 설정한 경우 신용카드, 계좌이체로 주문하는 회원께는 부여하지 않습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_point" class="checkbox"><input type="checkbox" name="chk_ca_it_point" value="1" id="chk_ca_it_point"><i></i>분류적용</label>
                                <label for="chk_all_it_point" class="checkbox"><input type="checkbox" name="chk_all_it_point" value="1" id="chk_all_it_point"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_supply_point" class="label">추가옵션상품 포인트</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">점</i>
                            <input type="text" name="it_supply_point" value="<?php echo $it['it_supply_point']; ?>" id="it_supply_point" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 상품의 추가옵션상품 구매에 일괄적으로 지급하는 포인트입니다. 0으로 설정하시면 구매포인트를 지급하지 않습니다.<br>주문완료후 환경설정에서 설정한 주문완료 설정일 후 회원에게 부여하는 포인트입니다.<br>또, 포인트부여를 '아니오'로 설정한 경우 신용카드, 계좌이체로 주문하는 회원께는 부여하지 않습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_supply_point" class="checkbox"><input type="checkbox" name="chk_ca_it_supply_point" value="1" id="chk_ca_it_supply_point"><i></i>분류적용</label>
                                <label for="chk_all_it_supply_point" class="checkbox"><input type="checkbox" name="chk_all_it_supply_point" value="1" id="chk_all_it_supply_point"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_soldout" class="label">상품품절</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="it_soldout" value="1" id="it_soldout" <?php echo ($it['it_soldout']) ? "checked" : ""; ?>><i></i> 예
                        </label>
                        <div class="note"><strong>Note:</strong> 잠시 판매를 중단하거나 재고가 없을 경우에 체크해 놓으면 품절상품으로 표시됩니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_soldout" class="checkbox"><input type="checkbox" name="chk_ca_it_soldout" value="1" id="chk_ca_it_soldout"><i></i>분류적용</label>
                                <label for="chk_all_it_soldout" class="checkbox"><input type="checkbox" name="chk_all_it_soldout" value="1" id="chk_all_it_soldout"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="it_stock_sms" class="label">재입고SMS 알림</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="checkbox">
                            <input type="checkbox" name="it_stock_sms" value="1" id="it_stock_sms" <?php echo ($it['it_stock_sms']) ? "checked" : ""; ?>><i></i> 예
                        </label>
                        <div class="note"><strong>Note:</strong> 상품이 품절인 경우에 체크해 놓으면 상품상세보기에서 고객이 재입고SMS 알림을 신청할 수 있게 됩니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_stock_qty" class="label">재고수량</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">개</i>
                            <input type="text" name="it_stock_qty" value="<?php echo $it['it_stock_qty']; ?>" id="it_stock_qty" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> <b>주문관리에서 상품별 상태 변경에 따라 자동으로 재고를 가감합니다.</b> 재고는 규격/색상별이 아닌, 상품별로만 관리됩니다.<br>재고수량을 0으로 설정하시면 품절상품으로 표시됩니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_stock_qty" class="checkbox"><input type="checkbox" name="chk_ca_it_stock_qty" value="1" id="chk_ca_it_stock_qty"><i></i>분류적용</label>
                                <label for="chk_all_it_stock_qty" class="checkbox"><input type="checkbox" name="chk_all_it_stock_qty" value="1" id="chk_all_it_stock_qty"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_noti_qty" class="label">재고 통보수량</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">개</i>
                            <input type="text" name="it_noti_qty" value="<?php echo $it['it_noti_qty']; ?>" id="it_noti_qty" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 상품의 재고가 통보수량보다 작을 때 쇼핑몰관리 메인화면의 재고현황에 재고부족 상품으로 표시됩니다.<br>옵션이 있는 상품은 개별 옵션의 통보수량이 적용됩니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_noti_qty" class="checkbox"><input type="checkbox" name="chk_ca_it_noti_qty" value="1" id="chk_ca_it_noti_qty"><i></i>분류적용</label>
                                <label for="chk_all_it_noti_qty" class="checkbox"><input type="checkbox" name="chk_all_it_noti_qty" value="1" id="chk_all_it_noti_qty"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_buy_min_qty" class="label">최소구매수량</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">개</i>
                            <input type="text" name="it_buy_min_qty" value="<?php echo $it['it_buy_min_qty']; ?>" id="it_buy_min_qty" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 상품 구매시 최소 구매 수량을 설정합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_buy_min_qty" class="checkbox"><input type="checkbox" name="chk_ca_it_buy_min_qty" value="1" id="chk_ca_it_buy_min_qty"><i></i>분류적용</label>
                                <label for="chk_all_it_buy_min_qty" class="checkbox"><input type="checkbox" name="chk_all_it_buy_min_qty" value="1" id="chk_all_it_buy_min_qty"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_buy_max_qty" class="label">최대구매수량</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">개</i>
                            <input type="text" name="it_buy_max_qty" value="<?php echo $it['it_buy_max_qty']; ?>" id="it_buy_max_qty" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 상품 구매시 최대 구매 수량을 설정합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_buy_max_qty" class="checkbox"><input type="checkbox" name="chk_ca_it_buy_max_qty" value="1" id="chk_ca_it_buy_max_qty"><i></i>분류적용</label>
                                <label for="chk_all_it_buy_max_qty" class="checkbox"><input type="checkbox" name="chk_all_it_buy_max_qty" value="1" id="chk_all_it_buy_max_qty"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_notax" class="label">상품과세 유형</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <select name="it_notax" id="it_notax">
                                <option value="0"<?php echo get_selected('0', $it['it_notax']); ?>>과세</option>
                                <option value="1"<?php echo get_selected('1', $it['it_notax']); ?>>비과세</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 상품의 과세유형(과세, 비과세)을 설정합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_notax" class="checkbox"><input type="checkbox" name="chk_ca_it_notax" value="1" id="chk_ca_it_notax"><i></i>분류적용</label>
                                <label for="chk_all_it_notax" class="checkbox"><input type="checkbox" name="chk_all_it_notax" value="1" id="chk_all_it_notax"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label class="label">상품선택옵션</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="note m-b-10"><strong>Note:</strong> 옵션항목은 콤마(,) 로 구분하여 여러개를 입력할 수 있습니다. 옷을 예로 들어 [옵션1 : 사이즈 , 옵션1 항목 : XXL,XL,L,M,S] , [옵션2 : 색상 , 옵션2 항목 : 빨,파,노]<br><strong>옵션명과 옵션항목에 따옴표(', ")는 입력할 수 없습니다.</strong></div>
                        <div class="sit_option">
                            <div class="sit-option-list">
                                <div class="sit-option-item">
                                    <div class="inline-group">
                                        <span class="width-90px"><label for="opt1_subject">옵션1</label></span>
                                        <span>
                                            <label class="input width-250px">
                                                <input type="text" name="opt1_subject" value="<?php echo $opt_subject[0]; ?>" id="opt1_subject">
                                            </label>
                                        </span>
                                    </div>
                                </div>
                                <div class="sit-option-item">
                                    <div class="inline-group">
                                        <span class="width-90px"><label for="opt1">옵션1 항목</label></span>
                                        <span>
                                            <label class="input width-250px">
                                                <input type="text" name="opt1" value="" id="opt1">
                                            </label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="sit-option-list">
                                <div class="sit-option-item">
                                    <div class="inline-group">
                                        <span class="width-90px"><label for="opt2_subject">옵션2</label></span>
                                        <span>
                                            <label class="input width-250px">
                                                <input type="text" name="opt2_subject" value="<?php echo $opt_subject[1]; ?>" id="opt2_subject">
                                            </label>
                                        </span>
                                    </div>
                                </div>
                                <div class="sit-option-item">
                                    <div class="inline-group">
                                        <span class="width-90px"><label for="opt2">옵션2 항목</label></span>
                                        <span>
                                            <label class="input width-250px">
                                                <input type="text" name="opt2" value="" id="opt2">
                                            </label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="sit-option-list">
                                <div class="sit-option-item">
                                    <div class="inline-group">
                                        <span class="width-90px"><label for="opt3_subject">옵션3</label></span>
                                        <span>
                                            <label class="input width-250px">
                                                <input type="text" name="opt3_subject" value="<?php echo $opt_subject[2]; ?>" id="opt3_subject">
                                            </label>
                                        </span>
                                    </div>
                                </div>
                                <div class="sit-option-item">
                                    <div class="inline-group">
                                        <span class="width-90px"><label for="opt3">옵션3 항목</label></span>
                                        <span>
                                            <label class="input width-250px">
                                                <input type="text" name="opt3" value="" id="opt3">
                                            </label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center m-t-10 m-b-10">
                                <button type="button" id="option_table_create" class="btn-e btn-e-md btn-e-dark">옵션목록생성</button>
                            </div>
                        </div>
                        <div id="scrollbar_container_1">
                            <div class="scrollbar-container">
                                <div id="sit_option_frm"><?php include_once(EYOOM_ADMIN_CORE_PATH.'/shop/itemoption.php'); ?></div>
                            </div>
                        </div>
                        <script>
                        $(function() {
                            <?php if($it['it_id'] && $po_run) { ?>
                            //옵션항목설정
                            var arr_opt1 = new Array();
                            var arr_opt2 = new Array();
                            var arr_opt3 = new Array();
                            var opt1 = opt2 = opt3 = '';
                            var opt_val;

                            $(".opt-cell").each(function() {
                                opt_val = $(this).text().split(" > ");
                                opt1 = opt_val[0];
                                opt2 = opt_val[1];
                                opt3 = opt_val[2];

                                if(opt1 && $.inArray(opt1, arr_opt1) == -1)
                                    arr_opt1.push(opt1);

                                if(opt2 && $.inArray(opt2, arr_opt2) == -1)
                                    arr_opt2.push(opt2);

                                if(opt3 && $.inArray(opt3, arr_opt3) == -1)
                                    arr_opt3.push(opt3);
                            });


                            $("input[name=opt1]").val(arr_opt1.join());
                            $("input[name=opt2]").val(arr_opt2.join());
                            $("input[name=opt3]").val(arr_opt3.join());
                            <?php } ?>
                            // 옵션목록생성
                            $("#option_table_create").click(function() {
                                var it_id = $.trim($("input[name=it_id]").val());
                                var opt1_subject = $.trim($("#opt1_subject").val());
                                var opt2_subject = $.trim($("#opt2_subject").val());
                                var opt3_subject = $.trim($("#opt3_subject").val());
                                var opt1 = $.trim($("#opt1").val());
                                var opt2 = $.trim($("#opt2").val());
                                var opt3 = $.trim($("#opt3").val());
                                var $option_table = $("#sit_option_frm");

                                if(!opt1_subject || !opt1) {
                                    alert("옵션명과 옵션항목을 입력해 주십시오.");
                                    return false;
                                }

                                $.post(
                                    "<?php echo EYOOM_ADMIN_CORE_URL; ?>/shop/itemoption.php",
                                    { it_id: it_id, w: "<?php echo $w; ?>", opt1_subject: opt1_subject, opt2_subject: opt2_subject, opt3_subject: opt3_subject, opt1: opt1, opt2: opt2, opt3: opt3 },
                                    function(data) {
                                        $option_table.empty().html(data);
                                    }
                                );
                            });

                            // 모두선택
                            $(document).on("click", "input[name=opt_chk_all]", function() {
                                if($(this).is(":checked")) {
                                    $("input[name='opt_chk[]']").attr("checked", true);
                                } else {
                                    $("input[name='opt_chk[]']").attr("checked", false);
                                }
                            });

                            // 선택삭제
                            $(document).on("click", "#sel_option_delete", function() {
                                var $el = $("input[name='opt_chk[]']:checked");
                                if($el.size() < 1) {
                                    alert("삭제하려는 옵션을 하나 이상 선택해 주십시오.");
                                    return false;
                                }

                                $el.closest("tr").remove();
                            });

                            // 일괄적용
                            $(document).on("click", "#opt_value_apply", function() {
                                if($(".opt_com_chk:checked").size() < 1) {
                                    alert("일괄 수정할 항목을 하나이상 체크해 주십시오.");
                                    return false;
                                }

                                var opt_price = $.trim($("#opt_com_price").val());
                                var opt_stock = $.trim($("#opt_com_stock").val());
                                var opt_noti = $.trim($("#opt_com_noti").val());
                                var opt_use = $("#opt_com_use").val();
                                var $el = $("input[name='opt_chk[]']:checked");

                                // 체크된 옵션이 있으면 체크된 것만 적용
                                if($el.size() > 0) {
                                    var $tr;
                                    $el.each(function() {
                                        $tr = $(this).closest("tr");

                                        if($("#opt_com_price_chk").is(":checked"))
                                            $tr.find("input[name='opt_price[]']").val(opt_price);

                                        if($("#opt_com_stock_chk").is(":checked"))
                                            $tr.find("input[name='opt_stock_qty[]']").val(opt_stock);

                                        if($("#opt_com_noti_chk").is(":checked"))
                                            $tr.find("input[name='opt_noti_qty[]']").val(opt_noti);

                                        if($("#opt_com_use_chk").is(":checked"))
                                            $tr.find("select[name='opt_use[]']").val(opt_use);
                                    });
                                } else {
                                    if($("#opt_com_price_chk").is(":checked"))
                                        $("input[name='opt_price[]']").val(opt_price);

                                    if($("#opt_com_stock_chk").is(":checked"))
                                        $("input[name='opt_stock_qty[]']").val(opt_stock);

                                    if($("#opt_com_noti_chk").is(":checked"))
                                        $("input[name='opt_noti_qty[]']").val(opt_noti);

                                    if($("#opt_com_use_chk").is(":checked"))
                                        $("select[name='opt_use[]']").val(opt_use);
                                }
                            });
                        });
                        </script>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label class="label">상품추가옵션</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="note m-b-10"><strong>Note:</strong> 옵션항목은 콤마(,) 로 구분하여 여러개를 입력할 수 있습니다. 스마트폰을 예로 들어 [추가1 : 추가구성상품 , 추가1 항목 : 액정보호필름,케이스,충전기]<br><strong>옵션명과 옵션항목에 따옴표(', ")는 입력할 수 없습니다.</strong></strong></div>
                        <div id="sit_supply_frm" class="sit_option">
                            <?php
                            $i = 0;
                            do {
                                $seq = $i + 1;
                            ?>
                            <div class="sit-option-list">
                                <div class="sit-option-item sit-opt-l">
                                    <div class="inline-group">
                                        <span class="width-90px"><label for="spl_subject_<?php echo $seq; ?>" class="label">추가<?php echo $seq; ?></label></span>
                                        <span>
                                            <label class="input width-150px">
                                                <input type="text" name="spl_subject[]" id="spl_subject_<?php echo $seq; ?>" value="<?php echo $spl_subject[$i]; ?>">
                                            </label>
                                        </span>
                                    </div>
                                </div>
                                <div class="sit-option-item sit-opt-r">
                                    <div class="inline-group">
                                        <span class="width-90px"><label for="spl_item_<?php echo $seq; ?>" class="label"><b>추가<?php echo $seq; ?> 항목</b></label></span>
                                        <span>
                                            <label class="input width-150px">
                                                <input type="text" name="spl[]" id="spl_item_<?php echo $seq; ?>" value="">
                                            </label>
                                        </span>
                                        <span>
                                            <?php if ($i > 0) { ?>
                                            <button type="button" id="del_supply_row" class="btn-e btn-e-lg btn-e-dark">삭제</button>
                                            <?php } ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <?php
                                $i++;
                            } while($i < $spl_count);
                            ?>
                            <div id="sit_option_addfrm_btn"><button type="button" id="add_supply_row" class="btn-e btn-e-indigo"><i class="las la-plus m-r-7"></i>옵션추가</button></div>
                            <div class="text-center m-t-10 m-b-10">
                                <button type="button" id="supply_table_create" class="btn-e btn-e-md btn-e-dark">옵션목록생성</button>
                            </div>
                        </div>
                        <div id="scrollbar_container_2">
                            <div class="scrollbar-container">
                                <div id="sit_option_addfrm"><?php include_once(EYOOM_ADMIN_CORE_PATH.'/shop/itemsupply.php'); ?></div>
                            </div>
                        </div>
                        <script>
                        $(function() {
                            <?php if($it['it_id'] && $ps_run) { ?>
                            // 추가옵션의 항목 설정
                            var arr_subj = new Array();
                            var subj, spl;

                            $("input[name='spl_subject[]']").each(function() {
                                subj = $.trim($(this).val());
                                if(subj && $.inArray(subj, arr_subj) == -1)
                                    arr_subj.push(subj);
                            });

                            for(i=0; i<arr_subj.length; i++) {
                                var arr_spl = new Array();
                                $(".spl-subject-cell").each(function(index) {
                                    subj = $(this).text();
                                    if(subj == arr_subj[i]) {
                                        spl = $(".spl-cell:eq("+index+")").text();
                                        arr_spl.push(spl);
                                    }
                                });

                                $("input[name='spl[]']:eq("+i+")").val(arr_spl.join());
                            }
                            <?php } ?>
                            // 입력필드추가
                            $("#add_supply_row").click(function() {
                                var $el = $("#sit_supply_frm .sit-option-list:last");

                                var fld = "<div class=\"sit-option-list\">\n";
                                fld += "<div class=\"sit-option-item sit-opt-l\">\n";
                                fld += "<div class=\"inline-group\">\n";
                                fld += "<span class=\"width-90px\"><label class=\"label\" for=\"\">추가</label></span>\n";
                                fld += "<span>\n";
                                fld += "<label class=\"input width-150px\">\n";
                                fld += "<input type=\"text\" name=\"spl_subject[]\" value=\"\">\n";
                                fld += "</label>\n";
                                fld += "</span>\n";
                                fld += "</div>\n";
                                fld += "</div>\n";
                                fld += "<div class=\"sit-option-item sit-opt-r\">\n";
                                fld += "<div class=\"inline-group\">\n";
                                fld += "<span class=\"width-90px\"><label class=\"label\" for=\"\"><b>추가 항목</b></label></span>\n";
                                fld += "<span>\n";
                                fld += "<label class=\"input width-150px\">\n";
                                fld += "<input type=\"text\" name=\"spl[]\" value=\"\">\n";
                                fld += "</label>\n";
                                fld += "</span>\n";
                                fld += "<span>\n";
                                fld += "<button type=\"button\" id=\"del_supply_row\" class=\"btn-e btn-e-dark\">삭제</button>\n";
                                fld += "</span>\n";
                                fld += "</div>\n";
                                fld += "</div>\n";
                                fld += "</div>";

                                $el.after(fld);

                                supply_sequence();
                            });

                            // 입력필드삭제
                            $(document).on("click", "#del_supply_row", function() {
                                $(this).closest(".sit-option-list").remove();

                                supply_sequence();
                            });

                            // 옵션목록생성
                            $("#supply_table_create").click(function() {
                                var it_id = $.trim($("input[name=it_id]").val());
                                var subject = new Array();
                                var supply = new Array();
                                var subj, spl;
                                var count = 0;
                                var $el_subj = $("input[name='spl_subject[]']");
                                var $el_spl = $("input[name='spl[]']");
                                var $supply_table = $("#sit_option_addfrm");

                                $el_subj.each(function(index) {
                                    subj = $.trim($(this).val());
                                    spl = $.trim($el_spl.eq(index).val());

                                    if(subj && spl) {
                                        subject.push(subj);
                                        supply.push(spl);
                                        count++;
                                    }
                                });

                                if(!count) {
                                    alert("추가옵션명과 추가옵션항목을 입력해 주십시오.");
                                    return false;
                                }

                                $.post(
                                    "<?php echo EYOOM_ADMIN_CORE_URL; ?>/shop/itemsupply.php",
                                    { it_id: it_id, w: "<?php echo $w; ?>", 'subject[]': subject, 'supply[]': supply },
                                    function(data) {
                                        $supply_table.empty().html(data);
                                    }
                                );
                            });

                            // 모두선택
                            $(document).on("click", "input[name=spl_chk_all]", function() {
                                if($(this).is(":checked")) {
                                    $("input[name='spl_chk[]']").attr("checked", true);
                                } else {
                                    $("input[name='spl_chk[]']").attr("checked", false);
                                }
                            });

                            // 선택삭제
                            $(document).on("click", "#sel_supply_delete", function() {
                                var $el = $("input[name='spl_chk[]']:checked");
                                if($el.size() < 1) {
                                    alert("삭제하려는 옵션을 하나 이상 선택해 주십시오.");
                                    return false;
                                }

                                $el.closest("tr").remove();
                            });

                            // 일괄적용
                            $(document).on("click", "#spl_value_apply", function() {
                                if($(".spl_com_chk:checked").size() < 1) {
                                    alert("일괄 수정할 항목을 하나이상 체크해 주십시오.");
                                    return false;
                                }

                                var spl_price = $.trim($("#spl_com_price").val());
                                var spl_stock = $.trim($("#spl_com_stock").val());
                                var spl_noti = $.trim($("#spl_com_noti").val());
                                var spl_use = $("#spl_com_use").val();
                                var $el = $("input[name='spl_chk[]']:checked");

                                // 체크된 옵션이 있으면 체크된 것만 적용
                                if($el.size() > 0) {
                                    var $tr;
                                    $el.each(function() {
                                        $tr = $(this).closest("tr");

                                        if($("#spl_com_price_chk").is(":checked"))
                                            $tr.find("input[name='spl_price[]']").val(spl_price);

                                        if($("#spl_com_stock_chk").is(":checked"))
                                            $tr.find("input[name='spl_stock_qty[]']").val(spl_stock);

                                        if($("#spl_com_noti_chk").is(":checked"))
                                            $tr.find("input[name='spl_noti_qty[]']").val(spl_noti);

                                        if($("#spl_com_use_chk").is(":checked"))
                                            $tr.find("select[name='spl_use[]']").val(spl_use);
                                    });
                                } else {
                                    if($("#spl_com_price_chk").is(":checked"))
                                        $("input[name='spl_price[]']").val(spl_price);

                                    if($("#spl_com_stock_chk").is(":checked"))
                                        $("input[name='spl_stock_qty[]']").val(spl_stock);

                                    if($("#spl_com_noti_chk").is(":checked"))
                                        $("input[name='spl_noti_qty[]']").val(spl_noti);

                                    if($("#spl_com_use_chk").is(":checked"))
                                        $("select[name='spl_use[]']").val(spl_use);
                                }
                            });
                        });

                        function supply_sequence()
                        {
                            var $tr = $("#sit_supply_frm .sit-option-list");
                            var seq;
                            var th_label, td_label;

                            $tr.each(function(index) {
                                seq = index + 1;
                                $(this).find(".sit-opt-l .label").attr("for", "spl_subject_"+seq).text("추가"+seq);
                                $(this).find(".sit-opt-l input").attr("id", "spl_subject_"+seq);
                                $(this).find(".sit-opt-r .label").attr("for", "spl_item_"+seq);
                                $(this).find(".sit-opt-r .label b").text("추가"+seq+" 항목");
                                $(this).find(".sit-opt-r input").attr("id", "spl_item_"+seq);
                            });
                        }
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 가격 및 재고 : 끝 */ ?>

        <?php /* 배송비 : 시작 */ ?>
        <div class="<?php echo $w=='u' ? 'tab-pane ': ''; ?>" id="anc_sitfrm_sendcost" role="tabpanel" aria-labelledby="anc_sitfrm_sendcost_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>배송비</strong></div>
                <div class="adm-form-info">
                    <div class="cont-text-bg">
                        <p class="bg-info">
                            <i class="fas fa-info-circle"></i> 쇼핑몰설정 &gt; 배송비유형 설정보다 <strong>개별상품 배송비설정이 우선</strong> 적용됩니다.
                        </p>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_sc_type" class="label">배송비 유형</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <select name="it_sc_type" id="it_sc_type">
                                <option value="0"<?php echo get_selected('0', $it['it_sc_type']); ?>>쇼핑몰 기본설정 사용</option>
                                <option value="1"<?php echo get_selected('1', $it['it_sc_type']); ?>>무료배송</option>
                                <option value="2"<?php echo get_selected('2', $it['it_sc_type']); ?>>조건부 무료배송</option>
                                <option value="3"<?php echo get_selected('3', $it['it_sc_type']); ?>>유료배송</option>
                                <option value="4"<?php echo get_selected('4', $it['it_sc_type']); ?>>수량별 부과</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 배송비 유형을 선택하면 자동으로 항목이 변환됩니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_sendcost" class="checkbox"><input type="checkbox" name="chk_ca_it_sendcost" value="1" id="chk_ca_it_sendcost"><i></i>분류적용</label>
                                <label for="chk_all_it_sendcost" class="checkbox"><input type="checkbox" name="chk_all_it_sendcost" value="1" id="chk_all_it_sendcost"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr" id="sc_con_method">
                    <div class="adm-form-td td-l">
                        <label for="it_sc_price" class="label">배송비 결제</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select name="it_sc_method" id="it_sc_method">
                                <option value="0"<?php echo get_selected('0', $it['it_sc_method']); ?>>선불</option>
                                <option value="1"<?php echo get_selected('1', $it['it_sc_method']); ?>>착불</option>
                                <option value="2"<?php echo get_selected('2', $it['it_sc_method']); ?>>사용자선택</option>
                            </select><i></i>
                        </label>
                    </div>
                </div>
                <div class="adm-form-tr" id="sc_con_basic">
                    <div class="adm-form-td td-l">
                        <label for="it_sc_price" class="label">기본배송비</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input max-width-250px">
                            <i class="icon-append">원</i>
                            <input type="text" name="it_sc_price" value="<?php echo $it['it_sc_price']; ?>" id="it_sc_price" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 무료배송 이외의 설정에 적용되는 배송비 금액입니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr" id="sc_con_minimum">
                    <div class="adm-form-td td-l">
                        <label for="it_sc_minimum" class="label">배송비 상세조건</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input max-width-250px">
                            <i class="icon-append">원</i>
                            <input type="text" name="it_sc_minimum" value="<?php echo $it['it_sc_minimum']; ?>" id="it_sc_minimum" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 주문금액이 설정한 금액 이상이면 무료배송</div>
                    </div>
                </div>
                <div class="adm-form-tr" id="sc_con_qty">
                    <div class="adm-form-td td-l">
                        <label for="it_sc_qty" class="label">배송비 상세조건<br><br>(주문수량별 배송비 적용)</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input max-width-250px">
                            <i class="icon-append">개</i>
                            <input type="text" name="it_sc_qty" value="<?php echo $it['it_sc_qty']; ?>" id="it_sc_qty" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 주문수량이 설정한 수량의 배수가 될때마다 배송비를 부과합니다.<br>배송상품의 주문 수량에 따라 배송비가 부과됩니다. 예를 들어 기본배송비가 3,000원 수량을 3으로 설정했을 경우 상품의 주문수량이 5개이면 6,000원 배송비가 부과됩니다.</div>
                    </div>
                </div>
            </div>
            <script>
            $(function() {
                <?php
                switch($it['it_sc_type']) {
                    case 1:
                        echo '$("#sc_con_method").hide();'.PHP_EOL;
                        echo '$("#sc_con_basic").hide();'.PHP_EOL;
                        echo '$("#sc_con_minimum").hide();'.PHP_EOL;
                        echo '$("#sc_con_qty").hide();'.PHP_EOL;
                        echo '$("#sc_grp").attr("rowspan","1");'.PHP_EOL;
                        break;
                    case 2:
                        echo '$("#sc_con_method").show();'.PHP_EOL;
                        echo '$("#sc_con_basic").show();'.PHP_EOL;
                        echo '$("#sc_con_minimum").show();'.PHP_EOL;
                        echo '$("#sc_con_qty").hide();'.PHP_EOL;
                        echo '$("#sc_grp").attr("rowspan","4");'.PHP_EOL;
                        break;
                    case 3:
                        echo '$("#sc_con_method").show();'.PHP_EOL;
                        echo '$("#sc_con_basic").show();'.PHP_EOL;
                        echo '$("#sc_con_minimum").hide();'.PHP_EOL;
                        echo '$("#sc_con_qty").hide();'.PHP_EOL;
                        echo '$("#sc_grp").attr("rowspan","3");'.PHP_EOL;
                        break;
                    case 4:
                        echo '$("#sc_con_method").show();'.PHP_EOL;
                        echo '$("#sc_con_basic").show();'.PHP_EOL;
                        echo '$("#sc_con_minimum").hide();'.PHP_EOL;
                        echo '$("#sc_con_qty").show();'.PHP_EOL;
                        echo '$("#sc_grp").attr("rowspan","4");'.PHP_EOL;
                        break;
                    default:
                        echo '$("#sc_con_method").hide();'.PHP_EOL;
                        echo '$("#sc_con_basic").hide();'.PHP_EOL;
                        echo '$("#sc_con_minimum").hide();'.PHP_EOL;
                        echo '$("#sc_con_qty").hide();'.PHP_EOL;
                        echo '$("#sc_grp").attr("rowspan","1");'.PHP_EOL;
                        break;
                }
                ?>
                $("#it_sc_type").change(function() {
                    var type = $(this).val();

                    switch(type) {
                        case "1":
                            $("#sc_con_method").hide();
                            $("#sc_con_basic").hide();
                            $("#sc_con_minimum").hide();
                            $("#sc_con_qty").hide();
                            $("#sc_grp").attr("rowspan","1");
                            break;
                        case "2":
                            $("#sc_con_method").show();
                            $("#sc_con_basic").show();
                            $("#sc_con_minimum").show();
                            $("#sc_con_qty").hide();
                            $("#sc_grp").attr("rowspan","4");
                            break;
                        case "3":
                            $("#sc_con_method").show();
                            $("#sc_con_basic").show();
                            $("#sc_con_minimum").hide();
                            $("#sc_con_qty").hide();
                            $("#sc_grp").attr("rowspan","3");
                            break;
                        case "4":
                            $("#sc_con_method").show();
                            $("#sc_con_basic").show();
                            $("#sc_con_minimum").hide();
                            $("#sc_con_qty").show();
                            $("#sc_grp").attr("rowspan","4");
                            break;
                        default:
                            $("#sc_con_method").hide();
                            $("#sc_con_basic").hide();
                            $("#sc_con_minimum").hide();
                            $("#sc_con_qty").hide();
                            $("#sc_grp").attr("rowspan","1");
                            break;
                    }
                });
            });
            </script>
        </div>
        <?php /* 배송비 : 끝 */ ?>

        <?php /* 이미지 업로드 : 시작 */ ?>
        <div class="<?php echo $w=='u' ? 'tab-pane ': ''; ?>" id="anc_sitfrm_img" role="tabpanel" aria-labelledby="anc_sitfrm_img_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>이미지 업로드</strong></div>
                <?php foreach ($gdimage as $i => $itimg) { ?>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_img<?php echo $i; ?>">이미지 <?php echo $i; ?></label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="adm-form-thumb">
                            <div class="adm-form-thumb-img">
                                <?php if ($itimg['thumb']) { ?>
                                <div class="goods-thumb">
                                    <?php echo $itimg['thumb']; ?>
                                </div>
                                <?php } else { ?>
                                <div class="no-goods-thumb"></div>
                                <?php } ?>
                            </div>
                            <div class="adm-form-thumb-file">
                                <div class="input">
                                    <input type="file" class="form-control" name="it_img<?php echo $i; ?>" id="it_img<?php echo $i; ?>">
                                </div>
                                <?php if ($itimg['thumb']) { ?>
                                <label class="checkbox"><input type="checkbox" name="it_img<?php echo $i; ?>_del" id="it_img<?php echo $i; ?>_del" value="1"><i></i>파일삭제 [<?php echo $itimg['img_name']; ?>]</label>
                                <a class="goods-thumb-btn btn-e btn-e-xs btn-e-dark" data-gall="goods_image_<?php echo $i; ?>" href="<?php echo G5_DATA_URL; ?>/item/<?php echo $itimg['img_name']; ?>" title="<?php echo $itimg['img_name']; ?>">확대보기</a>
                                <?php } ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php /* 이미지 업로드 : 끝 */ ?>

        <?php /* 관련상품 : 시작 */ ?>
        <div class="<?php echo $w=='u' ? 'tab-pane ': ''; ?>" id="anc_sitfrm_relation" role="tabpanel" aria-labelledby="anc_sitfrm_relation_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>관련상품</strong></div>
                <div class="adm-form-info">
                    <div class="cont-text-bg">
                        <p class="bg-info">
                            <i class="fas fa-info-circle"></i> 등록된 전체상품 목록에서 상품분류를 선택하면 해당 상품 리스트가 연이어 나타납니다.<br>
                            <i class="fas fa-info-circle"></i> 상품리스트에서 관련 상품으로 추가하시면 선택된 관련상품 목록에 <strong>함께</strong> 추가됩니다.<br>
                            <i class="fas fa-info-circle"></i> 예를 들어, A 상품에 B 상품을 관련상품으로 등록하면 B 상품에도 A 상품이 관련상품으로 자동 추가되며, <strong>확인 버튼을 누르셔야 정상 반영됩니다.</strong>
                        </p>
                    </div>
                </div>
                <div class="adm-form-cont">
                    <div class="row row-g-20">
                        <div class="col-lg-6 lg-m-b-20">
                            <label class="label">등록된 전체상품 목록</label>
                            <div class="inline-group m-b-5">
                                <label class="select d-inline-block width-30">
                                    <select id="sch_relation">
                                        <option value=''>분류별 상품</option>
                                        <?php echo $category_select; ?>
                                    </select><i></i>
                                </label>
                                <label class="input input-button d-inline-block width-60">
                                    <input type="text" name="sch_name" id="sch_name"><div class="button"><a href="javascript:void(0);" id="btn_search_item" onclick="return false;"><i class="fas fa-search"></i> 검색</a></div>
                                </label>
                            </div>
                            <div id="relation">
                                <p class="relation-sbox"><strong>Note:</strong> 상품의 분류를 선택하시거나 상품명을 입력하신 후 검색하여 주십시오.</p>
                            </div>
                            <script>
                            $(function() {
                                $("#btn_search_item").click(function() {
                                    var ca_id = $("#sch_relation").val();
                                    var it_name = $.trim($("#sch_name").val());
                                    var $relation = $("#relation");

                                    if(ca_id == "" && it_name == "") {
                                        $relation.html("<p class='relation-sbox'>상품의 분류를 선택하시거나 상품명을 입력하신 후 검색하여 주십시오.</p>");
                                        return false;
                                    }

                                    $("#relation").load(
                                        "<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemformrelation&smode=1",
                                        { it_id: "<?php echo $it_id; ?>", ca_id: ca_id, it_name: it_name }
                                    );
                                });

                                $(document).on("click", "#relation .add_item", function() {
                                    // 이미 등록된 상품인지 체크
                                    var $li = $(this).closest("li");
                                    var it_id = $li.find("input:hidden").val();
                                    var it_id2;
                                    var dup = false;
                                    $("#reg_relation input[name='re_it_id[]']").each(function() {
                                        it_id2 = $(this).val();
                                        if(it_id == it_id2) {
                                            dup = true;
                                            return false;
                                        }
                                    });

                                    if(dup) {
                                        alert("이미 선택된 상품입니다.");
                                        return false;
                                    }

                                    var cont = "<li>"+$li.html().replace("add_item", "del_item").replace("추가", "삭제")+"</li>";
                                    var count = $("#reg_relation li").size();

                                    if(count > 0) {
                                        $("#reg_relation li:last").after(cont);
                                    } else {
                                        $("#reg_relation").html("<ul>"+cont+"</ul>");
                                    }

                                    $li.remove();
                                });

                                $(document).on("click", "#reg_relation .del_item", function() {
                                    if(!confirm("상품을 삭제하시겠습니까?"))
                                        return false;

                                    $(this).closest("li").remove();

                                    var count = $("#reg_relation li").size();
                                    if(count < 1)
                                        $("#reg_relation").html("<p class='relation-sbox'>선택된 상품이 없습니다.</p>");
                                });
                            });
                            </script>
                        </div>
                        <div class="col-lg-6">
                            <label class="label">선택된 관련상품 목록</label>
                            <div id="reg_relation" class="relation-sbox-margin-top">
                                <?php if (count((array)$rellist) > 0) { ?>
                                <ul>
                                    <?php foreach($rellist as $relitem) { ?>
                                    <li>
                                        <input type="hidden" name="re_it_id[]" value="<?php echo $relitem['it_id']; ?>">
                                        <div class="list_item"><?php echo $relitem['image'].' '. $relitem['it_name']; ?></div>
                                        <div class="list_item_btn"><button type="button" class="del_item btn-e btn-e-xs btn-e-dark">삭제</button></div>
                                    </li>
                                    <?php } ?>
                                </ul>
                                <?php } else { ?>
                                <p class="relation-sbox text-gray"><i class="fas fa-exclamation-circle m-r-7"></i>선택된 상품이 없습니다.</p>
                                <?php } ?>
                            </div>
                            <input type="hidden" name="it_list" value="<?php echo $str; ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 관련상품 : 끝 */ ?>

        <?php /* 관련이벤트 : 시작 */ ?>
        <div class="<?php echo $w=='u' ? 'tab-pane ': ''; ?>" id="anc_sitfrm_event" role="tabpanel" aria-labelledby="anc_sitfrm_event_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>관련이벤트</strong></div>
                <div class="adm-form-cont">
                    <div class="row row-g-20">
                        <div class="col-lg-6 lg-m-b-20">
                            <label class="label">등록된 전체이벤트 목록</label>
                            <div id="event_list">
                                <div class="event-box">
                                    <?php if (count((array)$evinfo) > 0) { ?>
                                    <ul>
                                        <?php foreach ($evinfo as $evitem) { ?>
                                        <li>
                                            <input type="hidden" name="ev_id[]" value="<?php echo $evitem['ev_id']; ?>">
                                            <div class="list_item">• <?php echo get_text($evitem['ev_subject']); ?></div>
                                            <div class="list_item_btn"><button type="button" class="add_event btn-e btn-e-xs btn-e-red">추가</button></div>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                    <?php } else { ?>
                                    <i class="fas fa-exclamation-circle m-r-7"></i>등록된 이벤트가 없습니다.
                                    <?php } ?>
                                </div>
                            </div>
                            <script>
                            $(function() {
                                $(document).on("click", "#event_list .add_event", function() {
                                    // 이미 등록된 이벤트인지 체크
                                    var $li = $(this).closest("li");
                                    var ev_id = $li.find("input:hidden").val();
                                    var ev_id2;
                                    var dup = false;
                                    $("#reg_event_list input[name='ev_id[]']").each(function() {
                                        ev_id2 = $(this).val();
                                        if(ev_id == ev_id2) {
                                            dup = true;
                                            return false;
                                        }
                                    });

                                    if(dup) {
                                        alert("이미 선택된 이벤트입니다.");
                                        return false;
                                    }

                                    var cont = "<li>"+$li.html().replace("add_event", "del_event").replace("추가", "삭제")+"</li>";
                                    var count = $("#reg_event_list li").size();

                                    if(count > 0) {
                                        $("#reg_event_list li:last").after(cont);
                                    } else {
                                        $("#reg_event_list").html("<ul>"+cont+"</ul>");
                                    }
                                });

                                $(document).on("click", "#reg_event_list .del_event", function() {
                                    if(!confirm("상품을 삭제하시겠습니까?"))
                                        return false;

                                    $(this).closest("li").remove();

                                    var count = $("#reg_event_list li").size();
                                    if(count < 1)
                                        $("#reg_event_list").html("<i class='fas fa-exclamation-circle m-r-7'></i>선택된 이벤트가 없습니다.");
                                });
                            });
                            </script>
                        </div>
                        <div class="col-lg-6">
                            <label class="label">선택된 관련이벤트 목록</label>
                            <div>
                                <div class="event-box" id="reg_event_list">
                                    <?php if (count((array)$reg_evinfo) > 0) { ?>
                                    <ul>
                                        <?php foreach ($reg_evinfo as $reg_evitem) { ?>
                                        <li>
                                            <input type="hidden" name="ev_id[]" value="<?php echo $reg_evitem['ev_id']; ?>">
                                            <div class="list_item">• <?php echo get_text($reg_evitem['ev_subject']); ?></div>
                                            <div class="list_item_btn"><button type="button" class="del_event btn-e btn-e-xs btn-e-dark">삭제</button></div>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                    <?php } else { ?>
                                    <i class="fas fa-exclamation-circle m-r-7"></i>선택된 이벤트가 없습니다.
                                    <?php } ?>
                                </div>
                                <input type="hidden" name="ev_list" value="<?php echo $reg_ev_ids; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 관련이벤트 : 끝 */ ?>

        <?php /* 상세설명설정 : 시작 */ ?>
        <div class="<?php echo $w=='u' ? 'tab-pane ': ''; ?>" id="anc_sitfrm_optional" role="tabpanel" aria-labelledby="anc_sitfrm_optional_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>상세설명설정</strong></div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_head_html" class="label">상품상단내용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <div class="textarea">
                            <?php echo editor_html('it_head_html', get_text(html_purifier($it['it_head_html']), 0)); ?>
                        </div>
                        <div class="note m-t-10"><strong>Note:</strong> 상품상세설명 페이지 상단에 출력하는 HTML 내용입니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_head_html" class="checkbox"><input type="checkbox" name="chk_ca_it_head_html" value="1" id="chk_ca_it_head_html"><i></i>분류적용</label>
                                <label for="chk_all_it_head_html" class="checkbox"><input type="checkbox" name="chk_all_it_head_html" value="1" id="chk_all_it_head_html"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_tail_html" class="label">상품하단내용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <div class="textarea">
                            <?php echo editor_html('it_tail_html', get_text(html_purifier($it['it_tail_html']), 0)); ?>
                        </div>
                        <div class="note m-t-10"><strong>Note:</strong> 상품상세설명 페이지 하단에 출력하는 HTML 내용입니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_tail_html" class="checkbox"><input type="checkbox" name="chk_ca_it_tail_html" value="1" id="chk_ca_it_tail_html"><i></i>분류적용</label>
                                <label for="chk_all_it_tail_html" class="checkbox"><input type="checkbox" name="chk_all_it_tail_html" value="1" id="chk_all_it_tail_html"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_mobile_head_html" class="label">모바일 상품상단내용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <div class="textarea">
                            <?php echo editor_html('it_mobile_head_html', get_text(html_purifier($it['it_mobile_head_html']), 0)); ?>
                        </div>
                        <div class="note m-t-10"><strong>Note:</strong> 모바일 상품상세설명 페이지 상단에 출력하는 HTML 내용입니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_mobile_head_html" class="checkbox"><input type="checkbox" name="chk_ca_it_mobile_head_html" value="1" id="chk_ca_it_mobile_head_html"><i></i>분류적용</label>
                                <label for="chk_all_it_mobile_head_html" class="checkbox"><input type="checkbox" name="chk_all_it_mobile_head_html" value="1" id="chk_all_it_mobile_head_html"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="it_mobile_tail_html" class="label">모바일 상품하단내용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <div class="textarea">
                            <?php echo editor_html('it_mobile_tail_html', get_text(html_purifier($it['it_mobile_tail_html']), 0)); ?>
                        </div>
                        <div class="note m-t-10"><strong>Note:</strong> 모바일 상품상세설명 페이지 하단에 출력하는 HTML 내용입니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_ca_it_mobile_tail_html" class="checkbox"><input type="checkbox" name="chk_ca_it_mobile_tail_html" value="1" id="chk_ca_it_mobile_tail_html"><i></i>분류적용</label>
                                <label for="chk_all_it_mobile_tail_html" class="checkbox"><input type="checkbox" name="chk_all_it_mobile_tail_html" value="1" id="chk_all_it_mobile_tail_html"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 상세설명설정 : 끝 */ ?>

        <?php /* 여분필드 설 : 시작 */ ?>
        <div class="<?php echo $w=='u' ? 'tab-pane ': ''; ?>" id="anc_sitfrm_extra" role="tabpanel" aria-labelledby="anc_sitfrm_extra_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>여분필드 설정</strong></div>
                <?php for ($i=1; $i<=10; $i++) { ?>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l adm-sm-100">
                        <div class="adm-form-td td-l">
                            <label class="label">여분필드 <?php echo $i ?> 제목</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label for="it_<?php echo $i ?>_subj" class="input max-width-250px">
                                <input type="text" name="it_<?php echo $i ?>_subj" id="it_<?php echo $i ?>_subj" value="<?php echo get_text($it['it_'.$i.'_subj']); ?>">
                            </label>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r adm-sm-100">
                        <div class="adm-form-td td-l">
                            <label class="label">여분필드 <?php echo $i ?> 값</label>
                        </div>
                        <div class="adm-form-td td-r td-rs">
                            <label for="it_<?php echo $i ?>" class="input max-width-250px">
                                <input type="text" name="it_<?php echo $i ?>" id="it_<?php echo $i ?>" value="<?php echo get_text($it['it_'.$i]); ?>">
                            </label>
                            <div class="adm-form-td-rs">
                                <div class="inline-group">
                                    <label for="chk_ca_<?php echo $i ?>" class="checkbox"><input type="checkbox" name="chk_ca_<?php echo $i ?>" value="1" id="chk_ca_<?php echo $i ?>"><i></i>그룹적용</label>
                                    <label for="chk_all_<?php echo $i ?>" class="checkbox"><input type="checkbox" name="chk_all_<?php echo $i ?>" value="1" id="chk_all_<?php echo $i ?>"><i></i>전체적용</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if ($w == 'u') { ?>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="it_time" class="label">입력일시</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input state-disabled max-width-250px">
                            <input type="text" name="it_time" id="it_time" value="<?php echo $it['it_time']; ?>" readonly disabled>
                        </label>
                        <div class="note"><strong>Note:</strong> 상품을 처음 입력(등록)한 시간입니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="it_update_time" class="label">수정일시</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input state-disabled max-width-250px">
                            <input type="text" name="it_update_time" id="it_update_time" value="<?php echo $it['it_update_time']; ?>" readonly disabled>
                        </label>
                        <div class="note"><strong>Note:</strong> 상품을 최종 수정한 시간입니다.</div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php /* 여분필드 끝 : 시작 */ ?>
    </div>

    <div class="confirm-bottom-btn-alt">
        <?php echo $frm_submit; ?>
    </div>
    
    </form>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/magnific-popup/magnific-popup.min.js"></script>
<script>
$(function() {
    // 상품분류 탭 우선 active 적용
    $(".anc_sitfrm_cate").addClass('active');
});

$(function(){
    // 이미지 확대보기
    $('.goods-thumb-btn').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-img-mobile',
        image: {
            verticalFit: true
        }
    });

    $(".goods-thumb img").removeAttr('width');
    $(".goods-thumb img").removeAttr('height');
    $(".goods-thumb img").addClass('img-responsive');
});

var f = document.fitemform;

function codedupcheck(id)
{
    if (!id) {
        alert('상품코드를 입력하십시오.');
        f.it_id.focus();
        return;
    }

    var it_id = id.replace(/[A-Za-z0-9\-_]/g, "");
    if(it_id.length > 0) {
        alert("상품코드는 영문자, 숫자, -, _ 만 사용할 수 있습니다.");
        return false;
    }

    $.post(
        "<?php echo G5_ADMIN_URL; ?>/shop_admin/codedupcheck.php",
        { it_id: id },
        function(data) {
            if(data.name) {
                alert("코드 '"+data.code+"' 는 '".data.name+"' (으)로 이미 등록되어 있으므로\n\n사용하실 수 없습니다.");
                return false;
            } else {
                alert("'"+data.code+"' 은(는) 등록된 코드가 없으므로 사용하실 수 있습니다.");
                document.fitemform.codedup.value = '';
            }
        }, "json"
    );
}

function fitemformcheck(f)
{
    if (!f.ca_id.value) {
        alert("기본분류를 선택하십시오.");
        f.ca_id.focus();
        return false;
    }

    if (f.w.value == "") {
        var error = "";
        $.ajax({
            url: "<?php echo G5_ADMIN_URL; ?>/shop_admin/ajax.it_id.php",
            type: "POST",
            data: {
                "it_id": f.it_id.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                error = data.error;
            }
        });

        if (error) {
            alert(error);
            return false;
        }
    }

    if(f.it_point_type.value == "1" || f.it_point_type.value == "2") {
        var point = parseInt(f.it_point.value);
        if(point < 0 || point > 99) {
            alert("포인트 비율을 0과 99 사이의 값으로 입력해 주십시오.");
            f.it_point.focus();
            f.it_point.select();
            return false;
        }
    }

    if(parseInt(f.it_sc_type.value) > 1) {
        if(!f.it_sc_price.value || f.it_sc_price.value == "0") {
            alert("기본배송비를 입력해 주십시오.");
            return false;
        }

        if(f.it_sc_type.value == "2" && (!f.it_sc_minimum.value || f.it_sc_minimum.value == "0")) {
            alert("배송비 상세조건의 주문금액을 입력해 주십시오.");
            return false;
        }

        if(f.it_sc_type.value == "4" && (!f.it_sc_qty.value || f.it_sc_qty.value == "0")) {
            alert("배송비 상세조건의 주문수량을 입력해 주십시오.");
            return false;
        }
    }

    // 관련상품처리
    var item = new Array();
    var re_item = it_id = "";

    $("#reg_relation input[name='re_it_id[]']").each(function() {
        it_id = $(this).val();
        if(it_id == "")
            return true;

        item.push(it_id);
    });

    if(item.length > 0)
        re_item = item.join();

    $("input[name=it_list]").val(re_item);

    // 이벤트처리
    var evnt = new Array();
    var ev = ev_id = "";

    $("#reg_event_list input[name='ev_id[]']").each(function() {
        ev_id = $(this).val();
        if(ev_id == "")
            return true;

        evnt.push(ev_id);
    });

    if(evnt.length > 0)
        ev = evnt.join();

    $("input[name=ev_list]").val(ev);

    <?php echo get_editor_js('it_explan'); ?>
    <?php echo get_editor_js('it_mobile_explan'); ?>
    <?php echo get_editor_js('it_head_html'); ?>
    <?php echo get_editor_js('it_tail_html'); ?>
    <?php echo get_editor_js('it_mobile_head_html'); ?>
    <?php echo get_editor_js('it_mobile_tail_html'); ?>

    <?php if ($w=='u') { ?>
    f.target = 'blank_iframe';
    <?php } ?>
    return true;
}

function categorychange(f)
{
    var idx = f.ca_id.value;

    if (f.w.value == "" && idx)
    {
        f.it_use.checked = ca_use[idx] ? true : false;
        f.it_stock_qty.value = ca_stock_qty[idx];
        f.it_sell_email.value = ca_sell_email[idx];
    }
}

categorychange(document.fitemform);
</script>