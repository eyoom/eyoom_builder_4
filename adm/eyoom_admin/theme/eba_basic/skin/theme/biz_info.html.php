<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/theme/biz_info.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'biz_info';
$g5_title = '기본정보';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">테마설정관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';

$frm_eba_submit  = ' <div class="confirm-fixed-btn"> ';
$frm_eba_submit .= ' <input type="submit" value="적용하기" class="btn-e btn-e-md btn-e-crimson" accesskey="s">' ;
$frm_eba_submit .= '</div>';
$frm_submit .= $frm_eba_submit;
?>

<div class="admin-config-form">
    <?php include_once(EYOOM_ADMIN_THEME_PATH . '/skin/theme/theme_head.html.php'); ?>

    <form name="fbizinfo" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fbizinfo_submit(this);" enctype="multipart/form-data" class="eyoom-form">
    <input type="hidden" name="theme" id="theme" value="<?php echo $this_theme; ?>">
    <input type="hidden" name="wmode" id="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="amode" id="amode" value="<?php echo $amode; ?>">
    <input type="hidden" name="token" value="">

    <?php if (!$amode || $amode == 'biz') { ?>
    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>사업자 정보</strong></div>
        <div class="adm-form-info">
            <div class="cont-text-bg">
                <p class="bg-info">
                    <i class="fas fa-info-circle"></i> 사업자정보는 사이트 하단, 찾아오시는 길 페이지 등에서 출력됩니다. (테마에 따라 상이)<br>
                    <i class="fas fa-info-circle"></i> 대표전화번호는 SMS 발송번호로 사용되므로 사전등록된 발신번호와 일치해야 합니다.
                </p>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="bi_company_name" class="label">회사명</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="bi_company_name" value="<?php echo $bizinfo['bi_company_name'] ?>" id="bi_company_name" maxlength="50">
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="bi_company_bizno" class="label">사업자등록번호</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="bi_company_bizno" value="<?php echo $bizinfo['bi_company_bizno'] ?>" id="bi_company_bizno">
                    </label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="bi_company_ceo" class="label">대표자명</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="text" name="bi_company_ceo" value="<?php echo $bizinfo['bi_company_ceo'] ?>" id="bi_company_ceo">
                </label>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="bi_company_tel" class="label">대표전화번호</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="bi_company_tel" value="<?php echo $bizinfo['bi_company_tel'] ?>" id="bi_company_tel" maxlength="50">
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="bi_company_fax" class="label">팩스번호</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="bi_company_fax" value="<?php echo $bizinfo['bi_company_fax'] ?>" id="bi_company_fax">
                    </label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="bi_company_sellno" class="label">통신판매업 신고번호</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="bi_company_sellno" value="<?php echo $bizinfo['bi_company_sellno'] ?>" id="bi_company_sellno">
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="bi_company_bugano" class="label">부가통신 사업자번호</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="bi_company_bugano" value="<?php echo $bizinfo['bi_company_bugano'] ?>" id="bi_company_bugano">
                    </label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="bi_company_infoman" class="label">정보관리책임자명</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="bi_company_infoman" value="<?php echo $bizinfo['bi_company_infoman'] ?>" id="bi_company_infoman">
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="bi_company_infomail" class="label">정보책임자 e-mail</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="bi_company_infomail" value="<?php echo $bizinfo['bi_company_infomail'] ?>" id="bi_company_infomail">
                    </label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">사업장주소</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="row">
                    <div class="col-sm-4">
                        <section>
                            <label for="bi_company_zip" class="sound_only">우편번호</label>
                            <label class="input">
                                <i class="icon-append fas fa-question-circle"></i>
                                <input type="text" name="bi_company_zip" value="<?php echo $bizinfo['bi_company_zip']; ?>" id="bi_company_zip" maxlength="6" readonly="readonly">
                                <b class="tooltip tooltip-top-right">우편번호 - '주소 검색' 버튼을 클릭해 주세요.</b>
                            </label>
                        </section>
                    </div>
                    <div class="col-sm-3">
                        <section>
                            <button type="button" onclick="win_zip('fbizinfo', 'bi_company_zip', 'bi_company_addr1', 'bi_company_addr2', 'bi_company_addr3', 'bi_company_addr_jibeon');" class="btn-e btn-e-lg btn-e-indigo">주소 검색</button>
                        </section>
                    </div>
                </div>
                <section>
                    <label class="input">
                        <input type="text" name="bi_company_addr1" value="<?php echo $bizinfo['bi_company_addr1']; ?>" id="bi_company_addr1">
                    </label>
                    <div class="note"><strong>Note:</strong> 기본주소</div>
                </section>
                <div class="row">
                    <div class="col-sm-6">
                        <section>
                            <label class="input">
                                <input type="text" name="bi_company_addr2" value="<?php echo $bizinfo['bi_company_addr2']; ?>" id="bi_company_addr2">
                            </label>
                            <div class="note"><strong>Note:</strong> 상세주소</div>
                        </section>
                    </div>
                    <div class="col-sm-6">
                        <section>
                            <label class="input">
                                <input type="text" name="bi_company_addr3" value="<?php echo $bizinfo['bi_company_addr3']; ?>" id="bi_company_addr3" readonly="readonly">
                            </label>
                            <div class="note"><strong>Note:</strong> 참고항목</div>
                        </section>
                    </div>
                    <input type="hidden" name="bi_company_addr_jibeon" value="<?php echo $bizinfo['bi_company_addr_jibeon']; ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn m-b-20">
        <?php echo $frm_submit; ?>
    </div>

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>고객센터 정보</strong></div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="bi_cs_tel1" class="label">전화번호 #1</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="bi_cs_tel1" value="<?php echo $bizinfo['bi_cs_tel1'] ?>" id="bi_cs_tel1" maxlength="30">
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="bi_cs_tel2" class="label">전화번호 #2</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="bi_cs_tel2" value="<?php echo $bizinfo['bi_cs_tel2'] ?>" id="bi_cs_tel2" maxlength="30">
                    </label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="bi_cs_fax" class="label">팩스번호</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="bi_cs_fax" value="<?php echo $bizinfo['bi_cs_fax'] ?>" id="bi_cs_fax" maxlength="30">
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="bi_cs_email" class="label">이메일</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="bi_cs_email" value="<?php echo $bizinfo['bi_cs_email'] ?>" id="bi_cs_email">
                    </label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="bi_cs_time" class="label">상담시간</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="textarea">
                        <textarea name="bi_cs_time" id="bi_cs_time" rows="4"><?php echo $bizinfo['bi_cs_time'] ?></textarea>
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="bi_cs_closed" class="label">휴일안내</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="bi_cs_closed" value="<?php echo $bizinfo['bi_cs_closed'] ?>" id="bi_cs_closed">
                    </label>
                </div>
            </div>
        </div>
    </div>
    
    <div class="confirm-bottom-btn m-b-20">
        <?php echo $frm_submit; ?>
    </div>
    <?php } ?>

    <?php if (!$amode || $amode == 'logo' || $amode == 'shoplogo') { ?>
        <?php if (!$amode || $amode == 'logo') { ?>
    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>로고설정</strong></div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label class="label">상단로고이미지</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="input">
                        <input type="file" class="form-control" id="top_logo" name="top_logo" value="파일선택">
                    </div>
                    <?php if (file_exists($top_logo) && !is_dir($top_logo)) { ?>
                    <label for="top_logo_del" class="checkbox"><input type="checkbox" id="top_logo_del" name="top_logo_del" value="<?php echo $bizinfo['bi_top_logo']; ?>"><i></i> 삭제</label>
                    <span class="scf_img_logoimg"></span>
                    <div id="logoimg" class="banner_or_img">
                        <img src="<?php echo G5_DATA_URL; ?>/common/<?php echo $bizinfo['bi_top_logo']; ?>" class="img-fluid">
                    </div>
                    <?php } ?>
                    <div class="note"><strong>Note:</strong> 홈페이지 상단로고를 직접 올릴 수 있습니다. 이미지 파일만 가능합니다.</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label class="label">하단로고이미지</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="input">
                        <input type="file" class="form-control" id="bottom_logo" name="bottom_logo" value="파일선택">
                    </div>
                    <?php if (file_exists($bottom_logo) && !is_dir($bottom_logo)) { ?>
                    <label for="bottom_logo_del" class="checkbox"><input type="checkbox" id="bottom_logo_del" name="bottom_logo_del" value="<?php echo $bizinfo['bi_bottom_logo']; ?>"><i></i> 삭제</label>
                    <span class="scf_img_logoimg2"></span>
                    <div id="logoimg2" class="banner_or_img">
                        <img src="<?php echo G5_DATA_URL; ?>/common/<?php echo $bizinfo['bi_bottom_logo']; ?>" class="img-fluid">
                    </div>
                    <?php } ?>
                    <div class="note"><strong>Note:</strong> 홈페이지 하단로고를 직접 올릴 수 있습니다. 이미지 파일만 가능합니다. (테마에 따라 하단로고 출력이 안될 수 있습니다.)</div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label class="label">모바일 상단로고이미지</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="input">
                        <input type="file" class="form-control" id="top_mobile_logo" name="top_mobile_logo" value="파일선택">
                    </div>
                    <?php if (file_exists($top_mobile_logo) && !is_dir($top_mobile_logo)) { ?>
                    <label for="top_mobile_logo_del" class="checkbox"><input type="checkbox" id="top_mobile_logo_del" name="top_mobile_logo_del" value="<?php echo $bizinfo['bi_top_mobile_logo']; ?>"><i></i> 삭제</label>
                    <span class="scf_img_mobile_logoimg"></span>
                    <div id="mobile_logoimg" class="banner_or_img">
                        <img src="<?php echo G5_DATA_URL; ?>/common/<?php echo $bizinfo['bi_top_mobile_logo']; ?>" class="img-fluid">
                    </div>
                    <?php } ?>
                    <div class="note"><strong>Note:</strong> 모바일 홈페이지 상단로고를 직접 올릴 수 있습니다. 이미지 파일만 가능합니다.</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label class="label">모바일 하단로고이미지</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="input">
                        <input type="file" class="form-control" id="bottom_mobile_logo" name="bottom_mobile_logo" value="파일선택">
                    </div>
                    <?php if (file_exists($bottom_mobile_logo) && !is_dir($bottom_mobile_logo)) { ?>
                    <label for="bottom_mobile_logo_del" class="checkbox"><input type="checkbox" id="bottom_mobile_logo_del" name="bottom_mobile_logo_del" value="<?php echo $bizinfo['bi_bottom_mobile_logo']; ?>"><i></i> 삭제</label>
                    <span class="scf_img_mobile_logoimg2"></span>
                    <div id="mobile_logoimg2" class="banner_or_img">
                        <img src="<?php echo G5_DATA_URL; ?>/common/<?php echo $bizinfo['bi_bottom_mobile_logo']; ?>" class="img-fluid">
                    </div>
                    <?php } ?>
                    <div class="note"><strong>Note:</strong> 모바일 홈페이지 하단로고를 직접 올릴 수 있습니다. 이미지 파일만 가능합니다. (테마에 따라 하단로고 출력이 안될 수 있습니다.)</div>
                </div>
            </div>
        </div>
    </div>
        <?php } ?>

        <?php if (($is_youngcart || $shop_theme) && (!$amode || $amode == 'shoplogo')) { ?>
    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i> 쇼핑몰 로고설정</strong></div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label class="label">상단로고이미지</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="input">
                        <input type="file" class="form-control" id="top_shoplogo" name="top_shoplogo" value="파일선택">
                    </div>
                    <?php if (file_exists($top_shoplogo) && !is_dir($top_shoplogo)) { ?>
                    <label for="top_shoplogo_del" class="checkbox"><input type="checkbox" id="top_shoplogo_del" name="top_shoplogo_del" value="<?php echo $bizinfo['bi_top_shoplogo']; ?>"><i></i> 삭제</label>
                    <span class="scf_img_shoplogoimg"></span>
                    <div id="shoplogoimg" class="banner_or_img">
                        <img src="<?php echo G5_DATA_URL; ?>/common/<?php echo $bizinfo['bi_top_shoplogo']; ?>" class="img-fluid">
                    </div>
                    <?php } ?>
                    <div class="note"><strong>Note:</strong> 홈페이지 상단로고를 직접 올릴 수 있습니다. 이미지 파일만 가능합니다.</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label class="label">하단로고이미지</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="input">
                        <input type="file" class="form-control" id="bottom_shoplogo" name="bottom_shoplogo" value="파일선택">
                    </div>
                    <?php if (file_exists($bottom_shoplogo) && !is_dir($bottom_shoplogo)) { ?>
                    <label for="bottom_shoplogo_del" class="checkbox"><input type="checkbox" id="bottom_shoplogo_del" name="bottom_shoplogo_del" value="<?php echo $bizinfo['bi_bottom_shoplogo']; ?>"><i></i> 삭제</label>
                    <span class="scf_img_shoplogoimg2"></span>
                    <div id="logoimg2" class="banner_or_img">
                        <img src="<?php echo G5_DATA_URL; ?>/common/<?php echo $bizinfo['bi_bottom_shoplogo']; ?>" class="img-fluid">
                    </div>
                    <?php } ?>
                    <div class="note"><strong>Note:</strong> 홈페이지 하단로고를 직접 올릴 수 있습니다. 이미지 파일만 가능합니다. (테마에 따라 하단로고 출력이 안될 수 있습니다.)</div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label class="label">모바일 상단로고이미지</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="input">
                        <input type="file" class="form-control" id="top_mobile_shoplogo" name="top_mobile_shoplogo" value="파일선택">
                    </div>
                    <?php if (file_exists($top_mobile_shoplogo) && !is_dir($top_mobile_shoplogo)) { ?>
                    <label for="top_mobile_shoplogo_del" class="checkbox"><input type="checkbox" id="top_mobile_shoplogo_del" name="top_mobile_shoplogo_del" value="<?php echo $bizinfo['bi_top_mobile_shoplogo']; ?>"><i></i> 삭제</label>
                    <span class="scf_img_mobile_shoplogoimg"></span>
                    <div id="mobile_shoplogoimg" class="banner_or_img">
                        <img src="<?php echo G5_DATA_URL; ?>/common/<?php echo $bizinfo['bi_top_mobile_shoplogo']; ?>" class="img-fluid">
                    </div>
                    <?php } ?>
                    <div class="note"><strong>Note:</strong> 모바일 홈페이지 상단로고를 직접 올릴 수 있습니다. 이미지 파일만 가능합니다.</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label class="label">모바일 하단로고이미지</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="input">
                        <input type="file" class="form-control" id="bottom_mobile_shoplogo" name="bottom_mobile_shoplogo" value="파일선택">
                    </div>
                    <?php if (file_exists($bottom_mobile_shoplogo) && !is_dir($bottom_mobile_shoplogo)) { ?>
                    <label for="bottom_mobile_shoplogo_del" class="checkbox"><input type="checkbox" id="bottom_mobile_shoplogo_del" name="bottom_mobile_shoplogo_del" value="<?php echo $bizinfo['bi_bottom_mobile_shoplogo']; ?>"><i></i> 삭제</label>
                    <span class="scf_img_mobile_shoplogoimg2"></span>
                    <div id="mobile_shoplogoimg2" class="banner_or_img">
                        <img src="<?php echo G5_DATA_URL; ?>/common/<?php echo $bizinfo['bi_bottom_mobile_shoplogo']; ?>" class="img-fluid">
                    </div>
                    <?php } ?>
                    <div class="note"><strong>Note:</strong> 모바일 홈페이지 하단로고를 직접 올릴 수 있습니다. 이미지 파일만 가능합니다. (테마에 따라 하단로고 출력이 안될 수 있습니다.)</div>
                </div>
            </div>
        </div>
    </div>
        <?php } ?>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit; ?>
    </div>
    <?php } ?>

    </form>
</div>

<script>
function fbizinfo_submit(f) {
    return true;
}
</script>