<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/theme/biz_info.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<style>
.admin-config-form .banner_or_img {position:relative;overflow:hidden;width:200px}
@media (min-width: 1100px) {
    .pg-anchor-in.tab-e2 .nav-tabs li a {font-size:14px;font-weight:bold;padding:8px 17px}
    .pg-anchor-in.tab-e2 .nav-tabs li.active a {z-index:1;border:1px solid #000;border-top:1px solid #DE2600;color:#DE2600}
    .pg-anchor-in.tab-e2 .tab-bottom-line {position:relative;display:block;height:1px;background:#000;margin-bottom:20px}
}
@media (max-width: 1099px) {
    .pg-anchor-in {position:relative;overflow:hidden;margin-bottom:20px;border:1px solid #757575}
    .pg-anchor-in.tab-e2 .nav-tabs li {width:33.33333%;margin:0}
    .pg-anchor-in.tab-e2 .nav-tabs li a {font-size:12px;padding:6px 0;text-align:center;border-bottom:1px solid #d5d5d5;margin-right:0;font-weight:bold;background:#fff}
    .pg-anchor-in.tab-e2 .nav-tabs li.active a {border:0;border-bottom:1px solid #d5d5d5 !important;color:#DE2600;background:#fff1f0}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(1) a {border-right:1px solid #d5d5d5;border-bottom:0 !important}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(2) a {border-right:1px solid #d5d5d5;border-bottom:0 !important}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(3) a {border-bottom:0 !important}
    .pg-anchor-in.tab-e2 .tab-bottom-line {display:none}
}
</style>

<div class="admin-config-form">
    <div class="adm-headline">
        <h3>기본정보</h3>
    </div>

    <?php include_once(EYOOM_ADMIN_THEME_PATH . '/skin/theme/theme_head.html.php'); ?>

    <form name="fbizinfo" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fbizinfo_submit(this);" enctype="multipart/form-data" class="eyoom-form">
    <input type="hidden" name="theme" id="theme" value="<?php echo $this_theme; ?>">
    <input type="hidden" name="wmode" id="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="amode" id="amode" value="<?php echo $amode; ?>">
    <input type="hidden" name="token" value="">

    <?php if (!$amode || $amode == 'biz') { ?>
    <div id="anc_tcf_biz">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_tcf_biz'); ?>
        </div>
        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 사업자정보</strong></header>
            <fieldset>
                <div class="cont-text-bg">
                    <p class="bg-danger font-size-12 margin-bottom-0">
                        <i class="fas fa-info-circle"></i> 사업자정보는 tail.php 와 content.php 에서 표시합니다.<br>
                        <i class="fas fa-info-circle"></i> 대표전화번호는 SMS 발송번호로 사용되므로 사전등록된 발신번호와 일치해야 합니다.
                    </p>
                </div>
            </fieldset>
            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label for="bi_company_name" class="label">회사명</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="bi_company_name" value="<?php echo $bizinfo['bi_company_name'] ?>" id="bi_company_name" maxlength="50">
                                </label>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="bi_company_bizno" class="label">사업자등록번호</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="bi_company_bizno" value="<?php echo $bizinfo['bi_company_bizno'] ?>" id="bi_company_bizno">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="bi_company_ceo" class="label">대표자명</label>
                            </th>
                            <td colspan="3">
                                <label class="input form-width-250px">
                                    <input type="text" name="bi_company_ceo" value="<?php echo $bizinfo['bi_company_ceo'] ?>" id="bi_company_ceo">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="bi_company_tel" class="label">대표전화번호</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="bi_company_tel" value="<?php echo $bizinfo['bi_company_tel'] ?>" id="bi_company_tel" maxlength="50">
                                </label>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="bi_company_fax" class="label">팩스번호</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="bi_company_fax" value="<?php echo $bizinfo['bi_company_fax'] ?>" id="bi_company_fax">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="bi_company_sellno" class="label">통신판매업 신고번호</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="bi_company_sellno" value="<?php echo $bizinfo['bi_company_sellno'] ?>" id="bi_company_sellno">
                                </label>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="bi_company_bugano" class="label">부가통신 사업자번호</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="bi_company_bugano" value="<?php echo $bizinfo['bi_company_bugano'] ?>" id="bi_company_bugano">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="bi_company_infoman" class="label">정보관리책임자명</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="bi_company_infoman" value="<?php echo $bizinfo['bi_company_infoman'] ?>" id="bi_company_infoman">
                                </label>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="bi_company_infomail" class="label">정보책임자 e-mail</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="bi_company_infomail" value="<?php echo $bizinfo['bi_company_infomail'] ?>" id="bi_company_infomail">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">사업장주소</label>
                            </th>
                            <td colspan="3">
                                <div class="row">
                                    <div class="col col-3">
                                        <section>
                                            <label for="bi_company_zip" class="sound_only">우편번호<strong class="sound_only"> 필수</strong></label>
                                            <label class="input">
                                                <i class="icon-append fas fa-question-circle"></i>
                                                <input type="text" name="bi_company_zip" value="<?php echo $bizinfo['bi_company_zip']; ?>" id="bi_company_zip" maxlength="6" readonly="readonly">
                                                <b class="tooltip tooltip-top-right">우편번호</b>
                                            </label>
                                        </section>
                                    </div>
                                    <div class="col col-2">
                                        <section>
                                            <button type="button" onclick="win_zip('fbizinfo', 'bi_company_zip', 'bi_company_addr1', 'bi_company_addr2', 'bi_company_addr3', 'bi_company_addr_jibeon');" class="btn-e btn-e-purple">주소 검색</button>
                                        </section>
                                    </div>
                                </div>
                                <section>
                                    <label class="input">
                                        <input type="text" name="bi_company_addr1" value="<?php echo $bizinfo['bi_company_addr1']; ?>" id="bi_company_addr1">
                                    </label>
                                    <div class="note margin-bottom-10"><strong>Note:</strong> 기본주소</div>
                                </section>
                                <div class="row">
                                    <div class="col col-6">
                                        <section>
                                            <label class="input">
                                                <input type="text" name="bi_company_addr2" value="<?php echo $bizinfo['bi_company_addr2']; ?>" id="bi_company_addr2">
                                            </label>
                                            <div class="note margin-bottom-10"><strong>Note:</strong> 상세주소</div>
                                        </section>
                                    </div>
                                    <div class="col col-6">
                                        <section>
                                            <label class="input">
                                                <input type="text" name="bi_company_addr3" value="<?php echo $bizinfo['bi_company_addr3']; ?>" id="bi_company_addr3" readonly="readonly">
                                            </label>
                                            <div class="note margin-bottom-10"><strong>Note:</strong> 참고항목</div>
                                        </section>
                                    </div>
                                    <input type="hidden" name="bi_company_addr_jibeon" value="<?php echo $bizinfo['bi_company_addr_jibeon']; ?>">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php if (!G5_IS_MOBILE) { ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php echo $frm_submit; ?>

    <div id="anc_tcf_cscenter">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_tcf_cscenter'); ?>
        </div>
        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 고객센터 정보</strong></header>
            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label for="bi_cs_tel1" class="label">전화번호 #1</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="bi_cs_tel1" value="<?php echo $bizinfo['bi_cs_tel1'] ?>" id="bi_cs_tel1" maxlength="30">
                                </label>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="bi_cs_tel2" class="label">전화번호 #2</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="bi_cs_tel2" value="<?php echo $bizinfo['bi_cs_tel2'] ?>" id="bi_cs_tel2" maxlength="30">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="bi_cs_fax" class="label">팩스번호</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="bi_cs_fax" value="<?php echo $bizinfo['bi_cs_fax'] ?>" id="bi_cs_fax" maxlength="30">
                                </label>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="bi_cs_email" class="label">이메일</label>
                            </th>
                            <td>
                                <label class="input form-width-300px">
                                    <input type="text" name="bi_cs_email" value="<?php echo $bizinfo['bi_cs_email'] ?>" id="bi_cs_email">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="bi_cs_time" class="label">상담시간</label>
                            </th>
                            <td>
                                <label class="textarea form-width-300px">
                                    <textarea name="bi_cs_time" id="bi_cs_time" rows="4"><?php echo $bizinfo['bi_cs_time'] ?></textarea>
                                </label>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="bi_cs_closed" class="label">휴일안내</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="bi_cs_closed" value="<?php echo $bizinfo['bi_cs_closed'] ?>" id="bi_cs_closed">
                                </label>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php if (!G5_IS_MOBILE) { ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php echo $frm_submit; ?>
    <?php } ?>

    <?php if (!$amode || $amode == 'logo' || $amode == 'shoplogo') { ?>
    <div id="anc_tcf_logo">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_tcf_logo'); ?>
        </div>
        <?php if (!$amode || $amode == 'logo') { ?>
        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 로고설정</strong></header>

            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">상단로고이미지</label>
                            </th>
                            <td>
                                <label for="file" class="input input-file form-width-250px">
                                    <div class="button bg-color-light-grey"><input type="file" id="top_logo" name="top_logo" value="파일선택" onchange="this.parentNode.nextSibling.value = this.value">파일선택</div><input type="text" readonly>
                                </label>
                                <?php if (file_exists($top_logo) && !is_dir($top_logo)) { ?>
                                <label for="top_logo_del" class="checkbox"><input type="checkbox" id="top_logo_del" name="top_logo_del" value="<?php echo $bizinfo['bi_top_logo']; ?>"><i></i> 삭제</label>
                                <span class="scf_img_logoimg"></span>
                                <div id="logoimg" class="banner_or_img">
                                    <img src="<?php echo G5_DATA_URL; ?>/common/<?php echo $bizinfo['bi_top_logo']; ?>" class="img-responsive">
                                </div>
                                <?php } ?>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 홈페이지 상단로고를 직접 올릴 수 있습니다. 이미지 파일만 가능합니다.</div>
                            </td>
                        <?php if (G5_IS_MOBILE || $wmode) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th <?php echo !(G5_IS_MOBILE || $wmode) ? 'border-left-th':''; ?>">
                                <label class="label">하단로고이미지</label>
                            </th>
                            <td>
                                <label for="file" class="input input-file form-width-250px">
                                    <div class="button bg-color-light-grey"><input type="file" id="bottom_logo" name="bottom_logo" value="파일선택" onchange="this.parentNode.nextSibling.value = this.value">파일선택</div><input type="text" readonly>
                                </label>
                                <?php if (file_exists($bottom_logo) && !is_dir($bottom_logo)) { ?>
                                <label for="bottom_logo_del" class="checkbox"><input type="checkbox" id="bottom_logo_del" name="bottom_logo_del" value="<?php echo $bizinfo['bi_bottom_logo']; ?>"><i></i> 삭제</label>
                                <span class="scf_img_logoimg2"></span>
                                <div id="logoimg2" class="banner_or_img">
                                    <img src="<?php echo G5_DATA_URL; ?>/common/<?php echo $bizinfo['bi_bottom_logo']; ?>" class="img-responsive">
                                </div>
                                <?php } ?>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 홈페이지 하단로고를 직접 올릴 수 있습니다. 이미지 파일만 가능합니다.</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">모바일 상단로고이미지</label>
                            </th>
                            <td>
                                <label for="file" class="input input-file form-width-250px">
                                    <div class="button bg-color-light-grey"><input type="file" id="top_mobile_logo" name="top_mobile_logo" value="파일선택" onchange="this.parentNode.nextSibling.value = this.value">파일선택</div><input type="text" readonly>
                                </label>
                                <?php if (file_exists($top_mobile_logo) && !is_dir($top_mobile_logo)) { ?>
                                <label for="top_mobile_logo_del" class="checkbox"><input type="checkbox" id="top_mobile_logo_del" name="top_mobile_logo_del" value="<?php echo $bizinfo['bi_top_mobile_logo']; ?>"><i></i> 삭제</label>
                                <span class="scf_img_mobile_logoimg"></span>
                                <div id="mobile_logoimg" class="banner_or_img">
                                    <img src="<?php echo G5_DATA_URL; ?>/common/<?php echo $bizinfo['bi_top_mobile_logo']; ?>" class="img-responsive">
                                </div>
                                <?php } ?>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 모바일 홈페이지 상단로고를 직접 올릴 수 있습니다. 이미지 파일만 가능합니다.</div>
                            </td>
                        <?php if (G5_IS_MOBILE || $wmode) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th <?php echo !(G5_IS_MOBILE || $wmode) ? 'border-left-th':''; ?>">
                                <label class="label">모바일 하단로고이미지</label>
                            </th>
                            <td>
                                <label for="file" class="input input-file form-width-250px">
                                    <div class="button bg-color-light-grey"><input type="file" id="bottom_mobile_logo" name="bottom_mobile_logo" value="파일선택" onchange="this.parentNode.nextSibling.value = this.value">파일선택</div><input type="text" readonly>
                                </label>
                                <?php if (file_exists($bottom_mobile_logo) && !is_dir($bottom_mobile_logo)) { ?>
                                <label for="bottom_mobile_logo_del" class="checkbox"><input type="checkbox" id="bottom_mobile_logo_del" name="bottom_mobile_logo_del" value="<?php echo $bizinfo['bi_bottom_mobile_logo']; ?>"><i></i> 삭제</label>
                                <span class="scf_img_mobile_logoimg2"></span>
                                <div id="mobile_logoimg2" class="banner_or_img">
                                    <img src="<?php echo G5_DATA_URL; ?>/common/<?php echo $bizinfo['bi_bottom_mobile_logo']; ?>" class="img-responsive">
                                </div>
                                <?php } ?>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 모바일 홈페이지 하단로고를 직접 올릴 수 있습니다. 이미지 파일만 가능합니다.</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php if (!G5_IS_MOBILE) { ?>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>

        <?php if (($is_youngcart || $shop_theme) && (!$amode || $amode == 'shoplogo')) { ?>
        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 쇼핑몰 로고설정</strong></header>

            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">상단로고이미지</label>
                            </th>
                            <td>
                                <label for="file" class="input input-file form-width-250px">
                                    <div class="button bg-color-light-grey"><input type="file" id="top_shoplogo" name="top_shoplogo" value="파일선택" onchange="this.parentNode.nextSibling.value = this.value">파일선택</div><input type="text" readonly>
                                </label>
                                <?php if (file_exists($top_shoplogo) && !is_dir($top_shoplogo)) { ?>
                                <label for="top_shoplogo_del" class="checkbox"><input type="checkbox" id="top_shoplogo_del" name="top_shoplogo_del" value="<?php echo $bizinfo['bi_top_shoplogo']; ?>"><i></i> 삭제</label>
                                <span class="scf_img_shoplogoimg"></span>
                                <div id="shoplogoimg" class="banner_or_img">
                                    <img src="<?php echo G5_DATA_URL; ?>/common/<?php echo $bizinfo['bi_top_shoplogo']; ?>" class="img-responsive">
                                </div>
                                <?php } ?>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 홈페이지 상단로고를 직접 올릴 수 있습니다. 이미지 파일만 가능합니다.</div>
                            </td>
                        <?php if (G5_IS_MOBILE || $wmode) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th <?php echo !(G5_IS_MOBILE || $wmode) ? 'border-left-th':''; ?>">
                                <label class="label">하단로고이미지</label>
                            </th>
                            <td>
                                <label for="file" class="input input-file form-width-250px">
                                    <div class="button bg-color-light-grey"><input type="file" id="bottom_shoplogo" name="bottom_shoplogo" value="파일선택" onchange="this.parentNode.nextSibling.value = this.value">파일선택</div><input type="text" readonly>
                                </label>
                                <?php if (file_exists($bottom_shoplogo) && !is_dir($bottom_shoplogo)) { ?>
                                <label for="bottom_shoplogo_del" class="checkbox"><input type="checkbox" id="bottom_shoplogo_del" name="bottom_shoplogo_del" value="<?php echo $bizinfo['bi_bottom_shoplogo']; ?>"><i></i> 삭제</label>
                                <span class="scf_img_shoplogoimg2"></span>
                                <div id="logoimg2" class="banner_or_img">
                                    <img src="<?php echo G5_DATA_URL; ?>/common/<?php echo $bizinfo['bi_bottom_shoplogo']; ?>" class="img-responsive">
                                </div>
                                <?php } ?>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 홈페이지 하단로고를 직접 올릴 수 있습니다. 이미지 파일만 가능합니다.</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">모바일 상단로고이미지</label>
                            </th>
                            <td>
                                <label for="file" class="input input-file form-width-250px">
                                    <div class="button bg-color-light-grey"><input type="file" id="top_mobile_shoplogo" name="top_mobile_shoplogo" value="파일선택" onchange="this.parentNode.nextSibling.value = this.value">파일선택</div><input type="text" readonly>
                                </label>
                                <?php if (file_exists($top_mobile_shoplogo) && !is_dir($top_mobile_shoplogo)) { ?>
                                <label for="top_mobile_shoplogo_del" class="checkbox"><input type="checkbox" id="top_mobile_shoplogo_del" name="top_mobile_shoplogo_del" value="<?php echo $bizinfo['bi_top_mobile_shoplogo']; ?>"><i></i> 삭제</label>
                                <span class="scf_img_mobile_shoplogoimg"></span>
                                <div id="mobile_shoplogoimg" class="banner_or_img">
                                    <img src="<?php echo G5_DATA_URL; ?>/common/<?php echo $bizinfo['bi_top_mobile_shoplogo']; ?>" class="img-responsive">
                                </div>
                                <?php } ?>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 모바일 홈페이지 상단로고를 직접 올릴 수 있습니다. 이미지 파일만 가능합니다.</div>
                            </td>
                        <?php if (G5_IS_MOBILE || $wmode) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th <?php echo !(G5_IS_MOBILE || $wmode) ? 'border-left-th':''; ?>">
                                <label class="label">모바일 하단로고이미지</label>
                            </th>
                            <td>
                                <label for="file" class="input input-file form-width-250px">
                                    <div class="button bg-color-light-grey"><input type="file" id="bottom_mobile_shoplogo" name="bottom_mobile_shoplogo" value="파일선택" onchange="this.parentNode.nextSibling.value = this.value">파일선택</div><input type="text" readonly>
                                </label>
                                <?php if (file_exists($bottom_mobile_shoplogo) && !is_dir($bottom_mobile_shoplogo)) { ?>
                                <label for="bottom_mobile_shoplogo_del" class="checkbox"><input type="checkbox" id="bottom_mobile_shoplogo_del" name="bottom_mobile_shoplogo_del" value="<?php echo $bizinfo['bi_bottom_mobile_shoplogo']; ?>"><i></i> 삭제</label>
                                <span class="scf_img_mobile_shoplogoimg2"></span>
                                <div id="mobile_shoplogoimg2" class="banner_or_img">
                                    <img src="<?php echo G5_DATA_URL; ?>/common/<?php echo $bizinfo['bi_bottom_mobile_shoplogo']; ?>" class="img-responsive">
                                </div>
                                <?php } ?>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 모바일 홈페이지 하단로고를 직접 올릴 수 있습니다. 이미지 파일만 가능합니다.</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php if (!G5_IS_MOBILE) { ?>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
    </div>

    <?php echo $frm_submit; ?>
    <?php } ?>

    </form>

</div>

<script>
$('.pg-anchor a').on('click', function(e) {
    e.stopPropagation();
    var scrollTopSpace;
    if (window.innerWidth >= 1100) {
        scrollTopSpace = 70;
    } else {
        scrollTopSpace = 70;
    }
    var tabLink = $(this).attr('href');
    var offset = $(tabLink).offset().top;
    $('html, body').animate({scrollTop : offset - scrollTopSpace}, 500);
    return false;
});

function fbizinfo_submit(f) {
    return true;
}
</script>