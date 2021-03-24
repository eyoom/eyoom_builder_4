<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/config/config_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.G5_JS_URL.'/remodal/remodal.css">', 11);
add_stylesheet('<link rel="stylesheet" href="'.G5_JS_URL.'/remodal/remodal-default-theme.css">', 12);
add_javascript('<script src="'.G5_JS_URL.'/remodal/remodal.js"></script>', 10);
?>

<style>
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
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(1) a {border-right:1px solid #d5d5d5}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(2) a {border-right:1px solid #d5d5d5}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(4) a {border-right:1px solid #d5d5d5}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(5) a {border-right:1px solid #d5d5d5}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(7) a {border-right:1px solid #d5d5d5;border-bottom:0 !important}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(8) a {border-right:1px solid #d5d5d5;border-bottom:0 !important}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(9) a {border-bottom:0 !important}
    .pg-anchor-in.tab-e2 .tab-bottom-line {display:none}
}
.cf_cert_hide {display:none;position:absolute;top:-20000px;left:-10000px}

.icode_old_version th{background-color:#FFFCED !important;}
.icode_json_version th{background-color:#F6F1FF !important;}
.cf_tr_hide {display:none;}
</style>

<div class="admin-config-form">
    <form name="fconfigform" id="fconfigform" method="post" onsubmit="return fconfigform_submit(this);" class="eyoom-form">
    <input type="hidden" name="token" id="token" value="">

    <div class="adm-headline">
        <h3>기본환경 설정</h3>
    </div>

    <div id="anc_cf_basic">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_cf_basic'); ?>
        </div>
        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 홈페이지 기본환경 설정</strong></header>
            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_title" class="label">홈페이지 제목<strong class="sound_only">필수</strong></label>
                            </th>
                            <td colspan="3">
                                <label class="input form-width-250px">
                                    <input type="text" name="cf_title" value="<?php echo get_sanitize_input($config['cf_title']); ?>" id="cf_title" required>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_admin" class="label">최고관리자<strong class="sound_only">필수</strong></label>
                            </th>
                            <td colspan="3">
                                <label class="select form-width-250px">
                                    <?php echo get_member_id_select('cf_admin', 10, $config['cf_admin'], 'required') ?><i></i>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_admin_email" class="label">관리자 메일 주소<strong class="sound_only">필수</strong></label>
                            </th>
                            <td colspan="3">
                                <label class="input form-width-250px">
                                    <input type="text" name="cf_admin_email" id="cf_admin_email" class="email" value="<?php echo get_sanitize_input($config['cf_admin_email']); ?>" required>
                                </label>
                                <div class="note"><strong>Note:</strong> 관리자가 보내고 받는 용도로 사용하는 메일 주소를 입력합니다. (회원가입, 인증메일, 테스트, 회원메일발송 등에서 사용)</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_admin_email_name" class="label">관리자 메일 발송이름<strong class="sound_only">필수</strong></label>
                            </th>
                            <td colspan="3">
                                <label class="input form-width-250px">
                                    <input type="text" name="cf_admin_email_name" id="cf_admin_email_name" value="<?php echo get_sanitize_input($config['cf_admin_email_name']); ?>" required>
                                </label>
                                <div class="note"><strong>Note:</strong> 관리자가 보내고 받는 용도로 사용하는 메일의 발송이름을 입력합니다. (회원가입, 인증메일, 테스트, 회원메일발송 등에서 사용)</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_eyoom_admin_theme" class="label">이윰관리자 테마설정<strong class="sound_only">필수</strong></label>
                            </th>
                            <td>
                                <label class="select form-width-250px">
                                    <select name="cf_eyoom_admin_theme" id="cf_eyoom_admin_theme" required>
                                        <option value="">선택</option>
                                        <?php for ($i=0; $i<count((array)$cf_eyoom_admin_theme); $i++) { ?>
                                        <option value="<?php echo $cf_eyoom_admin_theme[$i]; ?>" <?php echo get_selected($config['cf_eyoom_admin_theme'], $cf_eyoom_admin_theme[$i])?>><?php echo $cf_eyoom_admin_theme[$i]; ?></option>
                                        <?php } ?>
                                    </select><i></i>
                                </label>
                                <div class="note"><strong>Note:</strong> 이윰 관리자모드의 테마를 설정하합니다.</div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_permit_level" class="label">사이트 접속 최소 레벨</label>
                            </th>
                            <td>
                                <label class="select form-width-250px"><?php echo get_member_level_select('cf_permit_level', 1, 10, $config['cf_permit_level']) ?><i></i></label>
                                <div class="note"><strong>Note:</strong> 회원제 사이트를 운영하고자 할 경우, 홈페이지에 접근 가능한 최소 레벨을 설정합니다.</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_use_point" class="label">포인트 사용</label>
                            </th>
                            <td>
                                <label class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="cf_use_point" value="1" id="cf_use_point" <?php echo $config['cf_use_point']?'checked':''; ?>><i></i> 사용
                                </label>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_point_term" class="label">포인트 유효기간</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <i class="icon-append">일</i>
                                    <input type="text" name="cf_point_term" value="<?php echo (int) $config['cf_point_term']; ?>" id="cf_point_term" class="text-right">
                                </label>
                                <div class="note"><strong>Note:</strong> 기간을 0으로 설정시 포인트 유효기간이 적용되지 않습니다.</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_login_point" class="label">로그인시 포인트<strong class="sound_only">필수</strong></label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <i class="icon-append">점</i>
                                    <input type="text" name="cf_login_point" value="<?php echo (int) $config['cf_login_point']; ?>" id="cf_login_point" class="text-right" required>
                                </label>
                                <div class="note"><strong>Note:</strong> 회원이 로그인시 하루에 한번만 적립</div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_memo_send_point" class="label">쪽지보낼시 차감 포인트<strong class="sound_only">필수</strong></label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <i class="icon-append">점</i>
                                    <input type="text" name="cf_memo_send_point" value="<?php echo (int) $config['cf_memo_send_point']; ?>" id="cf_memo_send_point" class="text-right" required>
                                </label>
                                <div class="note"><strong>Note:</strong> 양수로 입력하십시오. 0점은 쪽지 보낼시 포인트를 차감하지 않습니다.</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_cut_name" class="label">이름(닉네임) 표시</label>
                            </th>
                            <td colspan="3">
                                <label class="input form-width-250px">
                                    <i class="icon-append text-width">자리</i>
                                    <input type="text" name="cf_cut_name" id="cf_cut_name" value="<?php echo (int) $config['cf_cut_name']; ?>" class="text-right">
                                </label>
                                <div class="note"><strong>Note:</strong> 입력한 자리수만큼만 표시하게 됩니다.</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_nick_modify" class="label">닉네임 수정</label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <span>수정하면</span>
                                    <span>
                                        <label class="input"><input type="text" name="cf_nick_modify" id="cf_nick_modify" value="<?php echo (int) $config['cf_nick_modify']; ?>" class="text-right" style="width:80px;"></label>
                                    </span>
                                    <span>일 동안 바꿀 수 없음</span>
                                </div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_open_modify" class="label">정보공개 수정</label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <span>수정하면</span>
                                    <span>
                                        <label class="input"><input type="text" name="cf_open_modify" id="cf_open_modify" value="<?php echo (int) $config['cf_open_modify']; ?>" class="text-right" style="width:80px;"></label>
                                    </span>
                                    <span>일 동안 바꿀 수 없음</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_new_del" class="label">최근게시물 삭제</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <i class="icon-append">일</i>
                                    <input type="text" name="cf_new_del" id="cf_new_del" value="<?php echo (int) $config['cf_new_del']; ?>" class="text-right">
                                </label>
                                <div class="note"><strong>Note:</strong> 설정일이 지난 최근게시물 자동 삭제</div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_memo_del" class="label">쪽지 삭제</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <i class="icon-append">일</i>
                                    <input type="text" name="cf_memo_del" id="cf_memo_del" value="<?php echo (int) $config['cf_memo_del']; ?>" class="text-right">
                                </label>
                                <div class="note"><strong>Note:</strong> 설정일이 지난 쪽지 자동 삭제</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_visit_del" class="label">접속자로그 삭제</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <i class="icon-append">일</i>
                                    <input type="text" name="cf_visit_del" id="cf_visit_del" value="<?php echo (int) $config['cf_visit_del']; ?>" class="text-right">
                                </label>
                                <div class="note"><strong>Note:</strong> 설정일이 지난 접속자 로그 자동 삭제</div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_popular_del" class="label">인기검색어 삭제</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <i class="icon-append">일</i>
                                    <input type="text" name="cf_popular_del" id="cf_popular_del" value="<?php echo (int) $config['cf_popular_del']; ?>" class="text-right">
                                </label>
                                <div class="note"><strong>Note:</strong> 설정일이 지난 인기검색어 자동 삭제</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_login_minutes" class="label">현재 접속자</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <i class="icon-append">분</i>
                                    <input type="text" name="cf_login_minutes" id="cf_login_minutes" value="<?php echo (int) $config['cf_login_minutes']; ?>" class="text-right">
                                </label>
                                <div class="note"><strong>Note:</strong> 설정값 이내의 접속자를 현재 접속자로 인정</div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_new_rows" class="label">최근게시물 라인수</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <i class="icon-append text-width">라인</i>
                                    <input type="text" name="cf_new_rows" id="cf_new_rows" value="<?php echo (int) $config['cf_new_rows']; ?>" class="text-right">
                                </label>
                                <div class="note"><strong>Note:</strong> 목록 한페이지당 라인수</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_page_rows" class="label">한페이지당 라인수</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <i class="icon-append text-width">라인</i>
                                    <input type="text" name="cf_page_rows" id="cf_page_rows" value="<?php echo (int) $config['cf_page_rows']; ?>" class="text-right">
                                </label>
                                <div class="note"><strong>Note:</strong> 목록(리스트) 한페이지당 라인수</div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_mobile_page_rows" class="label">모바일 한페이지당 라인수</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <i class="icon-append text-width">라인</i>
                                    <input type="text" name="cf_mobile_page_rows" id="cf_mobile_page_rows" value="<?php echo (int) $config['cf_mobile_page_rows']; ?>" class="text-right">
                                </label>
                                <div class="note"><strong>Note:</strong> 모바일 목록 한페이지당 라인수</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_write_pages" class="label">페이지 표시 수<strong class="sound_only">필수</strong></label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <i class="icon-append">p.</i>
                                    <input type="text" name="cf_write_pages" id="cf_write_pages" value="<?php echo (int) $config['cf_write_pages']; ?>" required class="text-right">
                                </label>
                                <div class="note"><strong>Note:</strong> 목록 페이지 블럭당 페이지수</div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_mobile_pages" class="label">모바일 페이지 표시 수<strong class="sound_only">필수</strong></label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <i class="icon-append">p.</i>
                                    <input type="text" name="cf_mobile_pages" id="cf_mobile_pages" value="<?php echo (int) $config['cf_mobile_pages']; ?>" required class="text-right">
                                </label>
                                <div class="note"><strong>Note:</strong> 모바일 목록 페이지 블럭당 페이지수</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_new_skin" class="label">최근게시물 스킨<strong class="sound_only">필수</strong></label>
                            </th>
                            <td>
                                <label class="select form-width-250px">
                                    <?php echo get_skin_select('new', 'cf_new_skin', 'cf_new_skin', $config['cf_new_skin'], 'required'); ?><i></i>
                                </label>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_mobile_new_skin" class="label">모바일 최근게시물 스킨<strong class="sound_only">필수</strong></label>
                            </th>
                            <td>
                                <label class="select form-width-250px">
                                    <?php echo get_mobile_skin_select('new', 'cf_mobile_new_skin', 'cf_mobile_new_skin', $config['cf_mobile_new_skin'], 'required'); ?><i></i>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_search_skin" class="label">검색 스킨<strong class="sound_only">필수</strong></label>
                            </th>
                            <td>
                                <label class="select form-width-250px">
                                    <?php echo get_skin_select('search', 'cf_search_skin', 'cf_search_skin', $config['cf_search_skin'], 'required'); ?><i></i>
                                </label>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_mobile_search_skin" class="label">모바일 검색 스킨<strong class="sound_only">필수</strong></label>
                            </th>
                            <td>
                                <label class="select form-width-250px">
                                    <?php echo get_mobile_skin_select('search', 'cf_mobile_search_skin', 'cf_mobile_search_skin', $config['cf_mobile_search_skin'], 'required'); ?><i></i>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_connect_skin" class="label">접속자 스킨<strong class="sound_only">필수</strong></label>
                            </th>
                            <td>
                                <label class="select form-width-250px">
                                    <?php echo get_skin_select('connect', 'cf_connect_skin', 'cf_connect_skin', $config['cf_connect_skin'], 'required'); ?><i></i>
                                </label>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_mobile_connect_skin" class="label">모바일 접속자 스킨<strong class="sound_only">필수</strong></label>
                            </th>
                            <td>
                                <label class="select form-width-250px">
                                    <?php echo get_mobile_skin_select('connect', 'cf_mobile_connect_skin', 'cf_mobile_connect_skin', $config['cf_mobile_connect_skin'], 'required'); ?><i></i>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_faq_skin" class="label">FAQ 스킨<strong class="sound_only">필수</strong></label>
                            </th>
                            <td>
                                <label class="select form-width-250px">
                                    <?php echo get_skin_select('faq', 'cf_faq_skin', 'cf_faq_skin', $config['cf_faq_skin'], 'required'); ?><i></i>
                                </label>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_mobile_faq_skin" class="label">모바일 FAQ 스킨<strong class="sound_only">필수</strong></label>
                            </th>
                            <td>
                                <label class="select form-width-250px">
                                    <?php echo get_mobile_skin_select('faq', 'cf_mobile_faq_skin', 'cf_mobile_faq_skin', $config['cf_mobile_faq_skin'], 'required'); ?><i></i>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_editor" class="label">에디터 선택</label>
                            </th>
                            <td colspan="3">
                                <label class="select form-width-250px">
                                    <select name="cf_editor" id="cf_editor">
                                        <option value="">사용안함</option>
                                        <?php for ($i=0; $i<count((array)$cf_editor); $i++) { ?>
                                        <option value="<?php echo $cf_editor[$i]; ?>" <?php echo get_selected($config['cf_editor'], $cf_editor[$i])?>><?php echo $cf_editor[$i]; ?></option>
                                        <?php } ?>
                                    </select><i></i>
                                </label>
                                <div class="note"><strong>Note:</strong> <?php echo G5_EDITOR_URL; ?> 밑의 DHTML 에디터 폴더를 선택합니다.</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_captcha" class="label">캡챠 선택<strong class="sound_only">필수</strong></label>
                            </th>
                            <td colspan="3">
                                <label class="select form-width-250px">
                                    <select name="cf_captcha" id="cf_captcha" required>
                                        <option value="kcaptcha" <?php echo get_selected($config['cf_captcha'], 'kcaptcha') ; ?>>Kcaptcha</option>
                                        <option value="recaptcha" <?php echo get_selected($config['cf_captcha'], 'recaptcha') ; ?>>reCAPTCHA V2</option>
                                        <option value="recaptcha_inv" <?php echo get_selected($config['cf_captcha'], 'recaptcha_inv') ; ?>>Invisible reCAPTCHA</option>
                                    </select><i></i>
                                </label>
                                <div class="note"><strong>Note:</strong> 사용할 캡챠를 선택합니다.<br>1) Kcaptcha 는 그누보드5의 기본캡챠입니다. ( 문자입력 )<br>2) reCAPTCHA V2 는 구글에서 서비스하는 원클릭 형식의 간편한 캡챠입니다. ( 모바일 친화적 UI )<br>3) Invisible reCAPTCHA 는 구글에서 서비스하는 안보이는 형식의 캡챠입니다. ( 간혹 퀴즈를 풀어야 합니다. )</div>
                            </td>
                        </tr>
                        <tr class="kcaptcha_mp3">
                            <th class="table-form-th">
                                <label for="cf_captcha_mp3" class="label">음성캡챠 선택</label>
                            </th>
                            <td colspan="3">
                                <label class="select form-width-250px">
                                    <select name="cf_captcha_mp3" id="cf_captcha_mp3" required>
                                        <option value="">선택</option>
                                        <?php for ($i=0; $i<count((array)$cf_captcha_mp3); $i++) { ?>
                                        <option value="<?php echo $cf_captcha_mp3[$i]; ?>" <?php echo get_selected($config['cf_captcha_mp3'], $cf_captcha_mp3[$i])?>><?php echo $cf_captcha_mp3[$i]; ?></option>
                                        <?php } ?>
                                    </select><i></i>
                                </label>
                                <div class="note"><strong>Note:</strong>kcaptcha 사용시 <?php echo str_replace(array('recaptcha_inv', 'recaptcha'), 'kcaptcha', G5_CAPTCHA_URL); ?>/mp3 밑의 음성 폴더를 선택합니다.'</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_recaptcha_site_key" class="label">구글 reCAPTCHA Site key</label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <span>
                                        <label class="input"><input type="text" name="cf_recaptcha_site_key" id="cf_recaptcha_site_key" value="<?php echo get_sanitize_input($config['cf_recaptcha_site_key']); ?>"> </label>
                                    </span>
                                    <span><a href="https://www.google.com/recaptcha/admin" target="_blank" class="btn-e btn-e-md btn-e-dark">reCAPTCHA 등록하기</a></span>
                                </div>
                                <div class="note"><strong>Note:</strong> reCAPTCHA V2와 Invisible reCAPTCHA 캡챠의<br>sitekey 와 secret 키는 동일하지 않고, 서로 발급받는 키가 다릅니다.</div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_recaptcha_secret_key" class="label">구글 reCAPTCHA Secret key</label>
                            </th>
                            <td>
                                <label class="input">
                                    <input type="text" name="cf_recaptcha_secret_key" id="cf_recaptcha_secret_key" value="<?php echo get_sanitize_input($config['cf_recaptcha_secret_key']); ?>">
                                </label>
                                <div class="note"><strong>Note:</strong> 구글 reCAPTCHA Secret key 를 입력해 주세요.</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_possible_ip" class="label">접근가능 IP</label>
                            </th>
                            <td>
                                <label class="textarea">
                                    <textarea name="cf_possible_ip" id="cf_possible_ip" rows="8"><?php echo get_sanitize_input($config['cf_possible_ip']); ?></textarea>
                                </label>
                                <div class="note"><strong>Note:</strong> 입력된 IP의 컴퓨터만 접근할 수 있습니다.<br>123.123.+ 도 입력 가능. (엔터로 구분)</div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_intercept_ip" class="label">접근차단 IP</label>
                            </th>
                            <td>
                                <label class="textarea">
                                    <textarea name="cf_intercept_ip" id="cf_intercept_ip" rows="8"><?php echo get_sanitize_input($config['cf_intercept_ip']); ?></textarea>
                                </label>
                                <div class="note"><strong>Note:</strong> 입력된 IP의 컴퓨터는 접근할 수 없음.<br>123.123.+ 도 입력 가능. (엔터로 구분)</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_analytics" class="label">방문자분석 스크립트</label>
                            </th>
                            <td colspan="3">
                                <label class="textarea">
                                    <textarea name="cf_analytics" id="cf_analytics" rows="8"><?php echo get_text($config['cf_analytics']); ?></textarea>
                                </label>
                                <div class="note"><strong>Note:</strong> 방문자분석 스크립트 코드를 입력합니다. 예) 구글 애널리틱스</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_add_meta" class="label">추가 메타태그</label>
                            </th>
                            <td colspan="3">
                                <label class="textarea">
                                    <textarea name="cf_add_meta" id="cf_add_meta" rows="8"><?php echo get_text($config['cf_add_meta']); ?></textarea>
                                </label>
                                <div class="note"><strong>Note:</strong> 추가로 사용하실 meta 태그를 입력합니다.</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_syndi_token" class="label">네이버 신디케이션 연동키</label>
                            </th>
                            <td colspan="3">
                                <label class="input">
                                    <input type="text" name="cf_syndi_token" id="cf_syndi_token" value="<?php echo isset($config['cf_syndi_token']) ? get_sanitize_input($config['cf_syndi_token']) : ''; ?>">
                                </label>
                                <div class="note"><strong>Note:</strong> <?php if (!function_exists('curl_init')) { ?><b>경고) curl이 지원되지 않아 네이버 신디케이션을 사용할수 없습니다.</b><br><?php } ?>네이버 신디케이션 연동키(token)을 입력하면 네이버 신디케이션을 사용할 수 있습니다.<br>연동키는 <a href="http://webmastertool.naver.com/" target="_blank"><u>네이버 웹마스터도구</u></a> -> 네이버 신디케이션에서 발급할 수 있습니다.</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_syndi_except" class="label">네이버 신디케이션 제외게시판</label>
                            </th>
                            <td colspan="3">
                                <label class="input">
                                    <input type="text" name="cf_syndi_except" id="cf_syndi_except" value="<?php echo isset($config['cf_syndi_except']) ? get_sanitize_input($config['cf_syndi_except']) : ''; ?>">
                                </label>
                                <div class="note"><strong>Note:</strong> 네이버 신디케이션 수집에서 제외할 게시판 아이디를 | 로 구분하여 입력하십시오. 예) notice|adult<br>참고로 그룹접근사용 게시판, 글읽기 권한 2 이상 게시판, 비밀글은 신디케이션 수집에서 제외됩니다.</div>
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

    <?php echo $frm_submit; // 버튼 ?>

    <div id="anc_cf_board">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_cf_board'); ?>
        </div>

        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 게시판 기본 설정</strong></header>
            <fieldset>
                <div class="cont-text-bg">
                    <p class="bg-info font-size-12 margin-bottom-0">
                        <i class="fas fa-info-circle"></i> 각 게시판 관리에서 개별적으로 설정 가능합니다.
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
                                <label for="cf_delay_sec" class="label">글쓰기 간격<strong class="sound_only">필수</strong></label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="cf_delay_sec" value="<?php echo (int) $config['cf_delay_sec'] ?>" id="cf_delay_sec" required>
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 초단위로 지정한 초가 지난 후 글쓰기가 가능합니다.</div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_link_target" class="label">새창 링크</label>
                            </th>
                            <td>
                                <label class="select form-width-250px">
                                    <select name="cf_link_target" id="cf_link_target">
                                        <option value="_blank"<?php echo get_selected($config['cf_link_target'], '_blank'); ?>>_blank</option>
                                        <option value="_self"<?php echo get_selected($$config['cf_link_target'], '_self'); ?>>_self</option>
                                        <option value="_top"<?php echo get_selected($$config['cf_link_target'], '_top'); ?>>_top</option>
                                        <option value="_new"<?php echo get_selected($$config['cf_link_target'], '_new'); ?>>_new</option>
                                    </select><i></i>
                                </label>
                                <div class="note"><strong>Note:</strong> 초단위로 지정한 초가 지난 후 글쓰기가 가능합니다.</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_search_part" class="label">검색 단위</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <i class="icon-append">건</i>
                                    <input type="text" name="cf_search_part" id="cf_search_part" value="<?php echo $config['cf_search_part'] ?>" class="text-right">
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 지정한 건수 단위로 검색</div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_use_copy_log" class="label">복사, 이동시 로그</label>
                            </th>
                            <td>
                                <label class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="cf_use_copy_log" value="1" id="cf_use_copy_log" <?php echo $config['cf_use_copy_log']?'checked':''; ?>><i></i> 남김
                                </label>
                                <div class="note"><strong>Note:</strong> 게시물 아래에 누구로 부터 복사, 이동됨 표시</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_read_point" class="label">글읽기 포인트<strong class="sound_only">필수</strong></label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <i class="icon-append">점</i>
                                    <input type="text" name="cf_read_point" id="cf_read_point" value="<?php echo (int) $config['cf_read_point'] ?>" class="text-right" required>
                                </label>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_write_point" class="label">글쓰기 포인트<strong class="sound_only">필수</strong></label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <i class="icon-append">점</i>
                                    <input type="text" name="cf_write_point" id="cf_write_point" value="<?php echo (int) $config['cf_write_point'] ?>" class="text-right" required>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_comment_point" class="label">댓글쓰기 포인트<strong class="sound_only">필수</strong></label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <i class="icon-append">점</i>
                                    <input type="text" name="cf_comment_point" id="cf_comment_point" value="<?php echo (int) $config['cf_comment_point'] ?>" class="text-right" required>
                                </label>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_download_point" class="label">다운로드 포인트<strong class="sound_only">필수</strong></label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <i class="icon-append">점</i>
                                    <input type="text" name="cf_download_point" id="cf_download_point" value="<?php echo (int) $config['cf_download_point'] ?>" class="text-right" required>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_image_extension" class="label">이미지 업로드 확장자</label>
                            </th>
                            <td colspan="3">
                                <label class="input">
                                    <input type="text" name="cf_image_extension" value="<?php echo get_sanitize_input($config['cf_image_extension']); ?>" id="cf_image_extension">
                                </label>
                                <div class="note"><strong>Note:</strong> 게시판 글작성시 이미지 파일 업로드 가능 확장자. | 로 구분</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_flash_extension" class="label">플래쉬 업로드 확장자</label>
                            </th>
                            <td colspan="3">
                                <label class="input">
                                    <input type="text" name="cf_flash_extension" value="<?php echo get_sanitize_input($config['cf_flash_extension']); ?>" id="cf_flash_extension">
                                </label>
                                <div class="note"><strong>Note:</strong> 게시판 글작성시 플래쉬 파일 업로드 가능 확장자. | 로 구분</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_movie_extension" class="label">동영상 업로드 확장자</label>
                            </th>
                            <td colspan="3">
                                <label class="input">
                                    <input type="text" name="cf_movie_extension" value="<?php echo get_sanitize_input($config['cf_movie_extension']); ?>" id="cf_movie_extension">
                                </label>
                                <div class="note"><strong>Note:</strong> 게시판 글작성시 동영상 파일 업로드 가능 확장자. | 로 구분</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_filter" class="label">단어 필터링</label>
                            </th>
                            <td colspan="3">
                                <label class="textarea">
                                    <textarea name="cf_filter" id="cf_filter" rows="8"><?php echo get_sanitize_input($config['cf_filter']); ?></textarea>
                                </label>
                                <div class="note"><strong>Note:</strong> 입력된 단어가 포함된 내용은 게시할 수 없습니다. 단어와 단어 사이는 ,로 구분합니다.</div>
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

    <?php echo $frm_submit; // 버튼 ?>

    <div id="anc_cf_join">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_cf_join'); ?>
        </div>
        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 회원가입 설정</strong></header>
            <fieldset>
                <div class="cont-text-bg">
                    <p class="bg-info font-size-12 margin-bottom-0">
                        <i class="fas fa-info-circle"></i> 회원가입 시 사용할 스킨과 입력 받을 정보 등을 설정할 수 있습니다.
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
                                <label for="cf_member_skin" class="label">회원 스킨<strong class="sound_only">필수</strong></label>
                            </th>
                            <td>
                                <label class="select form-width-250px">
                                    <?php echo get_skin_select('member', 'cf_member_skin', 'cf_member_skin', $config['cf_member_skin'], 'required'); ?><i></i>
                                </label>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_mobile_member_skin" class="label">모바일 회원 스킨<strong class="sound_only">필수</strong></label>
                            </th>
                            <td>
                                <label class="select form-width-250px">
                                    <?php echo get_mobile_skin_select('member', 'cf_mobile_member_skin', 'cf_mobile_member_skin', $config['cf_mobile_member_skin'], 'required'); ?><i></i>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">홈페이지 입력</label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <label for="cf_use_homepage" class="checkbox"><input type="checkbox" name="cf_use_homepage" value="1" id="cf_use_homepage" <?php echo $config['cf_use_homepage']?'checked':''; ?>><i></i> 보이기</label>
                                    <label for="cf_req_homepage" class="checkbox"><input type="checkbox" name="cf_req_homepage" value="1" id="cf_req_homepage" <?php echo $config['cf_req_homepage']?'checked':''; ?>><i></i> 필수입력</label>
                                </div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label class="label">주소 입력</label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <label for="cf_use_addr" class="checkbox"><input type="checkbox" name="cf_use_addr" value="1" id="cf_use_addr" <?php echo $config['cf_use_addr']?'checked':''; ?>><i></i> 보이기</label>
                                    <label for="cf_req_addr" class="checkbox"><input type="checkbox" name="cf_req_addr" value="1" id="cf_req_addr" <?php echo $config['cf_req_addr']?'checked':''; ?>><i></i> 필수입력</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">전화번호 입력</label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <label for="cf_use_tel" class="checkbox"><input type="checkbox" name="cf_use_tel" value="1" id="cf_use_tel" <?php echo $config['cf_use_tel']?'checked':''; ?>><i></i> 보이기</label>
                                    <label for="cf_req_tel" class="checkbox"><input type="checkbox" name="cf_req_tel" value="1" id="cf_req_tel" <?php echo $config['cf_req_tel']?'checked':''; ?>><i></i> 필수입력</label>
                                </div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label class="label">휴대폰번호 입력</label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <label for="cf_use_hp" class="checkbox"><input type="checkbox" name="cf_use_hp" value="1" id="cf_use_hp" <?php echo $config['cf_use_hp']?'checked':''; ?>><i></i> 보이기</label>
                                    <label for="cf_req_hp" class="checkbox"><input type="checkbox" name="cf_req_hp" value="1" id="cf_req_hp" <?php echo $config['cf_req_hp']?'checked':''; ?>><i></i> 필수입력</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">서명 입력</label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <label for="cf_use_signature" class="checkbox"><input type="checkbox" name="cf_use_signature" value="1" id="cf_use_signature" <?php echo $config['cf_use_signature']?'checked':''; ?>><i></i> 보이기</label>
                                    <label for="cf_req_signature" class="checkbox"><input type="checkbox" name="cf_req_signature" value="1" id="cf_req_signature" <?php echo $config['cf_req_signature']?'checked':''; ?>><i></i> 필수입력</label>
                                </div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label class="label">자기소개 입력</label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <label for="cf_use_profile" class="checkbox"><input type="checkbox" name="cf_use_profile" value="1" id="cf_use_profile" <?php echo $config['cf_use_profile']?'checked':''; ?>><i></i> 보이기</label>
                                    <label for="cf_req_profile" class="checkbox"><input type="checkbox" name="cf_req_profile" value="1" id="cf_req_profile" <?php echo $config['cf_req_profile']?'checked':''; ?>><i></i> 필수입력</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_register_level" class="label">회원가입시 권한</label>
                            </th>
                            <td>
                                <label class="select form-width-250px">
                                    <?php echo get_member_level_select('cf_register_level', 1, 9, $config['cf_register_level']) ?><i></i>
                                </label>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_register_point" class="label">회원가입시 포인트</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <i class="icon-append">점</i>
                                    <input type="text" name="cf_register_point" id="cf_register_point" value="<?php echo (int) $config['cf_register_point']; ?>" class="text-right">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_leave_day" class="label">회원탈퇴후 삭제일</label>
                            </th>
                            <td colspan="3">
                                <label class="input form-width-250px">
                                    <i class="icon-append">일</i>
                                    <input type="text" name="cf_leave_day" value="<?php echo (int) $config['cf_leave_day'] ?>" id="cf_leave_day"  class="text-right">
                                </label>
                                <div class="note"><strong>Note:</strong> 설정일 이후 자동 삭제</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_use_member_icon" class="label">회원아이콘 사용</label>
                            </th>
                            <td>
                                <label class="select form-width-250px">
                                    <select name="cf_use_member_icon" id="cf_use_member_icon">
                                        <option value="0"<?php echo get_selected($config['cf_use_member_icon'], '0') ?>>미사용
                                        <option value="1"<?php echo get_selected($config['cf_use_member_icon'], '1') ?>>아이콘만 표시
                                        <option value="2"<?php echo get_selected($config['cf_use_member_icon'], '2') ?>>아이콘+이름 표시
                                    </select><i></i>
                                </label>
                                <div class="note"><strong>Note:</strong> 게시물에 게시자 닉네임 대신 아이콘 사용</div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_icon_level" class="label">회원 아이콘, 이미지 업로드 권한</label>
                            </th>
                            <td>
                                <label class="select form-width-250px">
                                    <?php echo get_member_level_select('cf_icon_level', 1, 9, $config['cf_icon_level']) ?><i></i>
                                </label>
                                <div class="note"><strong>Note:</strong> 설정 레벨 이상 권한을 갖습니다.</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_member_icon_size" class="label">회원아이콘 용량</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <i class="icon-append text-width">Byte</i>
                                    <input type="text" name="cf_member_icon_size" value="<?php echo (int) $config['cf_member_icon_size'] ?>" id="cf_member_icon_size" class="text-right">
                                </label>
                                <div class="note"><strong>Note:</strong> 설정 용량 이하만 허용</div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label class="label">회원아이콘 사이즈</label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <span>
                                        <label for="cf_member_icon_width" class="input"><i class="icon-prepend text-width">가로</i><i class="icon-append text-width">px</i><input type="text" name="cf_member_icon_width" id="cf_member_icon_width" value="<?php echo (int) $config['cf_member_icon_width']; ?>" class="text-right" style="width:170px;"></label>
                                    </span>
                                    <span>이하</span>
                                    <br>
                                    <span>
                                        <label for="cf_member_icon_height" class="input"><i class="icon-prepend text-width">세로</i><i class="icon-append text-width">px</i><input type="text" name="cf_member_icon_height" id="cf_member_icon_height" value="<?php echo (int) $config['cf_member_icon_height']; ?>" class="text-right" style="width:170px;"></label>
                                    </span>
                                    <span>이하</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_member_img_size" class="label">회원이미지 용량</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <i class="icon-append text-width">Byte</i>
                                    <input type="text" name="cf_member_img_size" value="<?php echo (int) $config['cf_member_img_size'] ?>" id="cf_member_img_size" class="text-right">
                                </label>
                                <div class="note"><strong>Note:</strong> 설정 용량 이하만 허용</div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label class="label">회원이미지 사이즈</label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <span>
                                        <label for="cf_member_img_width" class="input"><i class="icon-prepend text-width">가로</i><i class="icon-append text-width">px</i><input type="text" name="cf_member_img_width" id="cf_member_img_width" value="<?php echo (int) $config['cf_member_img_width']; ?>" class="text-right" style="width:170px;"></label>
                                    </span>
                                    <span>이하</span>
                                    <br>
                                    <span>
                                        <label for="cf_member_img_height" class="input"><i class="icon-prepend text-width">세로</i><i class="icon-append text-width">px</i><input type="text" name="cf_member_img_height" id="cf_member_img_height" value="<?php echo (int) $config['cf_member_img_height']; ?>" class="text-right" style="width:170px;"></label>
                                    </span>
                                    <span>이하</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_use_recommend" class="label">추천인제도 사용</label>
                            </th>
                            <td>
                                <label class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="cf_use_recommend" value="1" id="cf_use_recommend" <?php echo $config['cf_use_recommend']?'checked':''; ?>> <i></i> 사용
                                </label>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_recommend_point" class="label">추천인 포인트</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <i class="icon-append">점</i>
                                    <input type="text" name="cf_recommend_point" id="cf_recommend_point" value="<?php echo $config['cf_recommend_point']; ?>" class="text-right">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_prohibit_id" class="label">아이디,닉네임 금지단어</label>
                            </th>
                            <td>
                                <label class="textarea">
                                    <textarea name="cf_prohibit_id" id="cf_prohibit_id" rows="8"><?php echo get_sanitize_input($config['cf_prohibit_id']); ?></textarea>
                                </label>
                                <div class="note"><strong>Note:</strong> 회원아이디, 닉네임으로 사용할 수 없는 단어를 정하여 쉼표 (,)로 구분</div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_prohibit_email" class="label">입력 금지 메일</label>
                            </th>
                            <td>
                                <label class="textarea">
                                    <textarea name="cf_prohibit_email" id="cf_prohibit_email" rows="8"><?php echo get_sanitize_input($config['cf_prohibit_email']); ?></textarea>
                                </label>
                                <div class="note"><strong>Note:</strong> 입력 받지 않을 도메인을 지정합니다. 엔터로 구분 ex) hotmail.com</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_stipulation" class="label">회원가입약관</label>
                            </th>
                            <td colspan="3">
                                <label class="textarea">
                                    <textarea name="cf_stipulation" id="cf_stipulation" rows="8"><?php echo html_purifier($config['cf_stipulation']); ?></textarea>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_privacy" class="label">개인정보처리방침</label>
                            </th>
                            <td colspan="3">
                                <label class="textarea">
                                    <textarea name="cf_privacy" id="cf_privacy" rows="8"><?php echo html_purifier($config['cf_privacy']); ?></textarea>
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

    <?php echo $frm_submit; // 버튼 ?>

    <div id="anc_cf_cert">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_cf_cert'); ?>
        </div>
        <div class="adm-table-form-wrap border-bottom-1px margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 본인확인 설정</strong></header>
            <fieldset>
                <div class="cont-text-bg">
                    <p class="bg-info font-size-12 margin-bottom-0">
                        <i class="fas fa-info-circle"></i> 회원가입 시 본인확인 수단을 설정합니다.<br>
                        <i class="fas fa-info-circle"></i> 실명과 휴대폰 번호 그리고 본인확인 당시에 성인인지의 여부를 저장합니다.<br>
                        <i class="fas fa-info-circle"></i> 게시판의 경우 본인확인 또는 성인여부를 따져 게시물 조회 및 쓰기 권한을 줄 수 있습니다.
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
                                <label for="cf_cert_use" class="label">본인확인</label>
                            </th>
                            <td>
                                <label class="select form-width-250px">
                                    <select name="cf_cert_use" id="cf_cert_use">
                                        <?php echo option_selected("0", $config['cf_cert_use'], "사용안함"); ?>
                                        <?php echo option_selected("1", $config['cf_cert_use'], "테스트"); ?>
                                        <?php echo option_selected("2", $config['cf_cert_use'], "실서비스"); ?>
                                    </select><i></i>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th cf_cert_service">
                                <label for="cf_cert_ipin" class="label">아이핀 본인확인</label>
                            </th>
                            <td class="cf_cert_service">
                                <label class="select form-width-250px">
                                    <select name="cf_cert_ipin" id="cf_cert_ipin">
                                        <?php echo option_selected("",    $config['cf_cert_ipin'], "사용안함"); ?>
                                        <?php echo option_selected("kcb", $config['cf_cert_ipin'], "코리아크레딧뷰로(KCB) 아이핀"); ?>
                                    </select><i></i>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th cf_cert_service">
                                <label for="cf_cert_hp" class="label">휴대폰 본인확인</label>
                            </th>
                            <td class="cf_cert_service">
                                <label class="select form-width-250px">
                                    <select name="cf_cert_hp" id="cf_cert_hp">
                                        <?php echo option_selected("", $config['cf_cert_hp'], "사용안함"); ?>
                                        <?php echo option_selected("kcb", $config['cf_cert_hp'], "코리아크레딧뷰로(KCB) 휴대폰 본인확인"); ?>
                                        <?php echo option_selected("kcp", $config['cf_cert_hp'], "NHN KCP 휴대폰 본인확인"); ?>
                                        <?php echo option_selected("lg", $config['cf_cert_hp'], "LG유플러스 휴대폰 본인확인"); ?>
                                    </select><i></i>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th cf_cert_service">
                                <label for="cf_cert_kcb_cd" class="label">코리아크레딧뷰로 KCB 회원사ID</label>
                            </th>
                            <td class="cf_cert_service">
                                <div class="inline-group">
                                    <span>
                                        <label class="input form-width-250px">
                                            <input type="text" name="cf_cert_kcb_cd" value="<?php echo get_sanitize_input($config['cf_cert_kcb_cd']); ?>" id="cf_cert_kcb_cd">
                                        </label>
                                    </span>
                                    <span>
                                        <a href="http://sir.kr/main/service/b_ipin.php" target="_blank" class="btn-e btn-e-md btn-e-dark">KCB 아이핀 서비스 신청페이지</a>
                                        <a href="http://sir.kr/main/service/b_cert.php" target="_blank" class="btn-e btn-e-md btn-e-dark">KCB 휴대폰 본인확인 서비스 신청페이지</a>
                                    </span>
                                </div>
                                <div class="note margin-bottom-10"><strong>Note:</strong> KCB 회원사ID를 입력해 주십시오.<br>서비스에 가입되어 있지 않다면, KCB와 계약체결 후 회원사ID를 발급 받으실 수 있습니다. 이용하시려는 서비스에 대한 계약을 아이핀, 휴대폰 본인확인 각각 체결해주셔야 합니다. 아이핀 본인확인 테스트의 경우에는 KCB 회원사ID가 필요 없으나, 휴대폰 본인확인 테스트의 경우 KCB 에서 따로 발급 받으셔야 합니다.</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th border-left-th cf_cert_service">
                                <label for="cf_cert_kcp_cd" class="label">NHN KCP 사이트코드</label>
                            </th>
                            <td class="cf_cert_service">
                                <div class="inline-group">
                                    <span>
                                        <label class="input form-width-250px">
                                            <i class="icon-prepend">SM</i>
                                            <input type="text" name="cf_cert_kcp_cd" value="<?php echo get_sanitize_input($config['cf_cert_kcp_cd']); ?>" id="cf_cert_kcp_cd">
                                        </label>
                                    </span>
                                    <span>
                                        <a href="http://sir.kr/main/service/p_cert.php" target="_blank" class="btn-e btn-e-md btn-e-dark">NHN KCP 휴대폰 본인확인 서비스 신청페이지</a>
                                    </span>
                                </div>
                                <div class="note margin-bottom-10"><strong>Note:</strong> SM으로 시작하는 5자리 사이트 코드중 뒤의 3자리만 입력해 주십시오.<br>서비스에 가입되어 있지 않다면, 본인확인 서비스 신청페이지에서 서비스 신청 후 사이트코드를 발급 받으실 수 있습니다.</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th cf_cert_service">
                                <label for="cf_lg_mid" class="label">LG유플러스 상점아이디</label>
                            </th>
                            <td class="cf_cert_service">
                                <div class="inline-group">
                                    <span>
                                        <label class="input form-width-250px">
                                            <i class="icon-prepend">si_</i>
                                            <input type="text" name="cf_lg_mid" value="<?php echo get_sanitize_input($config['cf_lg_mid']); ?>" id="cf_lg_mid">
                                        </label>
                                    </span>
                                    <span>
                                        <a href="http://sir.kr/main/service/lg_cert.php" target="_blank" class="btn-e btn-e-md btn-e-dark">LG유플러스 본인확인 서비스 신청페이지</a>
                                    </span>
                                </div>
                                <div class="note margin-bottom-10"><strong>Note:</strong> LG유플러스 상점아이디 중 si_를 제외한 나머지 아이디만 입력해 주십시오.<br>서비스에 가입되어 있지 않다면, 본인확인 서비스 신청페이지에서 서비스 신청 후 상점아이디를 발급 받으실 수 있습니다. <strong>LG유플러스 휴대폰본인확인은 ActiveX 설치가 필요하므로 Internet Explorer 에서만 사용할 수 있습니다.</strong></div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th cf_cert_service">
                                <label for="cf_lg_mert_key" class="label">LG유플러스 MERT KEY</label>
                            </th>
                            <td class="cf_cert_service">
                                <label class="input form-width-250px">
                                    <input type="text" name="cf_lg_mert_key" value="<?php echo get_sanitize_input($config['cf_lg_mert_key']); ?>" id="cf_lg_mert_key">
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> LG유플러스 상점MertKey는 상점관리자 -> 계약정보 -> 상점정보관리에서 확인하실 수 있습니다.</strong></div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th cf_cert_service">
                                <label for="cf_cert_limit" class="label">본인확인 이용제한</label>
                            </th>
                            <td class="cf_cert_service">
                                <label class="input form-width-250px">
                                    <i class="icon-append">회</i>
                                    <input type="text" name="cf_cert_limit" value="<?php echo (int) $config['cf_cert_limit']; ?>" id="cf_cert_limit" class="text-right">
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 하루동안 아이핀과 휴대폰 본인확인 인증 이용회수를 제한할 수 있습니다.<br>회수제한은 실서비스에서 아이핀과 휴대폰 본인확인 인증에 개별 적용됩니다.<br>0 으로 설정하시면 회수제한이 적용되지 않습니다.</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th cf_cert_service">
                                <label for="cf_cert_req" class="label">본인확인 필수</label>
                            </th>
                            <td class="cf_cert_service">
                                <label class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="cf_cert_req" value="1" id="cf_cert_req"<?php echo get_checked($config['cf_cert_req'], 1); ?>><i></i> 예
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 회원가입 때 본인확인을 필수로 할지 설정합니다. 필수로 설정하시면 본인확인을 하지 않은 경우 회원가입이 안됩니다.</div>
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

    <?php echo $frm_submit; // 버튼 ?>

    <div id="anc_cf_url">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_cf_url'); ?>
        </div>
        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 짧은주소 설정</strong></header>

            <fieldset>
                <div class="cont-text-bg">
                    <p class="bg-info font-size-12 margin-bottom-0">
                        <i class="fas fa-info-circle"></i> 게시판과 컨텐츠 페이지에 짧은 URL 을 사용합니다. <a href="https://sir.kr/manual/g5/286" class="btn-e btn-e-red btn-e-sm" target="_blank" style="margin-left:10px">설정 관련 메뉴얼 보기</a><br>
                        <?php if( $is_use_apache && ! $is_use_nginx ){ ?>
                            <?php if( ! $is_apache_rewrite ){ ?>
                            <i class="fas fa-info-circle"></i> <strong>Apache 서버인 경우 rewrite_module 이 비활성화 되어 있으면 짧은 주소를 사용할수 없습니다.</strong><br>
                            <?php } else if( ! $is_write_file && $is_apache_need_rules ) {   // apache인 경우 ?>
                            <i class="fas fa-info-circle"></i><strong> 짧은 주소 사용시 아래 Apache 설정 코드를 참고하여 설정해 주세요.</strong><br>
                            <?php } ?>
                        <?php } ?>
                    </p>
                </div>
            </fieldset>

            <fieldset>
                <div class="cont-text-bg">
                <?php if ( $is_use_apache ){ ?>
                    <button type="button" data-remodal-target="modal_apache" class="btn-e btn-e-purple btn-e-lg">Apache 설정 코드 보기</button>
                <?php } ?>
                <?php if ( $is_use_nginx ) { ?>
                    <button type="button" data-remodal-target="modal_nginx" class="btn-e btn-e-purple btn-e-lg">Nginx 설정 코드 보기</button>
                <?php } ?>
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
                                <label for="cf_email_use" class="label">짧은주소 타입 설정</label>
                            </th>
                            <td>
                                <?php foreach($short_url_arrs as $k=>$v) {
                                    $checked = ((int) $config['cf_bbs_rewrite'] === (int) $k) ? 'checked' : '';
                                ?>
                                <label for="cf_bbs_rewrite_<?php echo $k; ?>" class="radio"><input name="cf_bbs_rewrite" id="cf_bbs_rewrite_<?php echo $k; ?>" type="radio" value="<?php echo $k; ?>" <?php echo $checked;?> ><i></i> 
                                    <span style="display:inline-block; min-width:100px;"><?php echo $v['label']; ?></span>
                                    <span><?php echo $v['url']; ?></span>
                                </label>
                                <?php } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php if (!G5_IS_MOBILE) { ?>
                </div>
                <?php } ?>
            </div>

            <div class="server_rewrite_info">
                <div class="is_rewrite remodal" data-remodal-id="modal_apache" role="dialog" aria-labelledby="modalApache" aria-describedby="modal1Desc">

                    <button type="button" class="connect-close" data-remodal-action="close">
                        <i class="fa fa-close"></i>
                        <span class="txt">닫기</span>
                    </button>

                    <h4 class="copy_title">.htaccess 파일에 적용할 코드입니다.
                    <?php if( ! $is_apache_rewrite ) { ?>
                    <br><span class="info-warning">Apache 서버인 경우 rewrite_module 이 비활성화 되어 있으면 짧은 주소를 사용할수 없습니다.</span>
                    <?php } else if ( ! $is_write_file && $is_apache_need_rules ) { ?>
                    <br><span class="info-warning">자동으로 .htaccess 파일을 수정 할수 있는 권한이 없습니다.<br>.htaccess 파일이 없다면 생성 후에, 아래 코드가 없으면 코드를 복사하여 붙여넣기 해 주세요.</span>
                    <?php } else if ( ! $is_apache_need_rules ){ ?>
                    <br><span class="info-success">정상적으로 적용된 상태입니다.</span>
                    <?php } ?>
                    </h4>
                    <textarea readonly="readonly" rows="10"><?php echo get_eyoom_mod_rewrite_rules(true); ?></textarea>
                </div>

                <div class="is_rewrite remodal" data-remodal-id="modal_nginx" role="dialog" aria-labelledby="modalNginx" aria-describedby="modal2Desc">

                    <button type="button" class="connect-close" data-remodal-action="close">
                        <i class="fa fa-close"></i>
                        <span class="txt">닫기</span>
                    </button>
                    <h4 class="copy_title">아래 코드를 복사하여 nginx 설정 파일에 적용해 주세요.</h4>
                    <textarea readonly="readonly" rows="10"><?php echo get_eyoom_nginx_conf_rules(true); ?></textarea>
                </div>

            </div>
        </div>
    </div>

    <?php echo $frm_submit; // 버튼 ?>

    <div id="anc_cf_mail">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_cf_mail'); ?>
        </div>
        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 기본 메일 환경 설정</strong></header>
            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_email_use" class="label">메일발송 사용</label>
                            </th>
                            <td>
                                <label class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="cf_email_use" id="cf_email_use" value="1" <?php echo $config['cf_email_use']?'checked':''; ?>><i></i> 사용
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 체크하지 않으면 메일발송을 아예 사용하지 않습니다. 메일 테스트도 불가합니다.</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_use_email_certify" class="label">메일인증 사용<strong class="sound_only">필수</strong></label>
                            </th>
                            <td>
                                <label class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="cf_use_email_certify" id="cf_use_email_certify" value="1" <?php echo $config['cf_use_email_certify']?'checked':''; ?>><i></i> 사용
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 메일에 배달된 인증 주소를 클릭하여야 회원으로 인정합니다.</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_formmail_is_member" class="label">폼메일 사용 여부<strong class="sound_only">필수</strong></label>
                            </th>
                            <td>
                                <label class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="cf_formmail_is_member" id="cf_formmail_is_member" value="1" <?php echo $config['cf_formmail_is_member']?'checked':''; ?>><i></i> 회원만 사용
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 체크하지 않으면 비회원도 사용 할 수 있습니다.</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php if (!G5_IS_MOBILE) { ?>
                </div>
                <?php } ?>
            </div>
            <header><strong><i class="fas fa-caret-right"></i> 게시판 글 작성 시 메일 설정</strong></header>
            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_email_wr_super_admin" class="label">최고관리자</label>
                            </th>
                            <td>
                                <label class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="cf_email_wr_super_admin" id="cf_email_wr_super_admin" value="1" <?php echo $config['cf_email_wr_super_admin']?'checked':''; ?>><i></i> 사용
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 최고관리자에게 메일을 발송합니다.</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_email_wr_group_admin" class="label">그룹관리자</label>
                            </th>
                            <td>
                                <label class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="cf_email_wr_group_admin" id="cf_email_wr_group_admin" value="1" <?php echo $config['cf_email_wr_group_admin']?'checked':''; ?>><i></i> 사용
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 그룹관리자에게 메일을 발송합니다.</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_email_wr_board_admin" class="label">게시판관리자</label>
                            </th>
                            <td>
                                <label class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="cf_email_wr_board_admin" id="cf_email_wr_board_admin" value="1" <?php echo $config['cf_email_wr_board_admin']?'checked':''; ?>><i></i> 사용
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 게시판관리자에게 메일을 발송합니다.</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_email_wr_write" class="label">원글작성자</label>
                            </th>
                            <td>
                                <label class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="cf_email_wr_write" id="cf_email_wr_write" value="1" <?php echo $config['cf_email_wr_write']?'checked':''; ?>><i></i> 사용
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 게시자님께 메일을 발송합니다.</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_email_wr_comment_all" class="label">댓글작성자</label>
                            </th>
                            <td>
                                <label class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="cf_email_wr_comment_all" id="cf_email_wr_comment_all" value="1" <?php echo $config['cf_email_wr_comment_all']?'checked':''; ?>><i></i> 사용
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 원글에 댓글이 올라오는 경우 댓글 쓴 모든 분들께 메일을 발송합니다.</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php if (!G5_IS_MOBILE) { ?>
                </div>
                <?php } ?>
            </div>
            <header><strong><i class="fas fa-caret-right"></i> 회원가입 및 기타 메일 설정</strong></header>
            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_email_mb_super_admin" class="label">최고관리자 메일발송</label>
                            </th>
                            <td>
                                <label class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="cf_email_mb_super_admin" id="cf_email_mb_super_admin" value="1" <?php echo $config['cf_email_mb_super_admin']?'checked':''; ?>><i></i> 사용
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 최고관리자에게 메일을 발송합니다.</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_email_mb_member" class="label">회원님께 메일발송</label>
                            </th>
                            <td>
                                <label class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="cf_email_mb_member" id="cf_email_mb_member" value="1" <?php echo $config['cf_email_mb_member']?'checked':''; ?>><i></i> 사용
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 회원가입한 회원님께 메일을 발송합니다.</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php if (!G5_IS_MOBILE) { ?>
                </div>
                <?php } ?>
            </div>
            <header><strong><i class="fas fa-caret-right"></i> 투표 기타의견 작성 시 메일 설정</strong></header>
            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_email_po_super_admin" class="label">최고관리자 메일발송</label>
                            </th>
                            <td>
                                <label class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="cf_email_po_super_admin" id="cf_email_po_super_admin" value="1" <?php echo $config['cf_email_po_super_admin']?'checked':''; ?>><i></i> 사용
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 최고관리자에게 메일을 발송합니다.</div>
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

    <?php echo $frm_submit; // 버튼 ?>

    <div id="anc_cf_sns">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_cf_sns'); ?>
        </div>
        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 소셜네트워크서비스(SNS : Social Network Service)</strong></header>
            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_social_login_use" class="label">소셜로그인설정</label>
                            </th>
                            <td colspan="3">
                                <label class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="cf_social_login_use" id="cf_social_login_use" value="1" <?php echo (!empty($config['cf_social_login_use']))?'checked':''; ?>><i></i> 사용
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 소셜로그인을 사용합니다. <a href="https://sir.kr/manual/g5/276" class="btn-e btn-e-xs btn-e-dark" target="_blank">설정 관련 메뉴얼 보기</a></div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="check_social_naver" class="label">네이버 소셜로그인</label>
                            </th>
                            <td colspan="3">
                                <label class="checkbox">
                                    <input type="checkbox" name="cf_social_servicelist[]" id="check_social_naver" value="naver" <?php echo option_array_checked('naver', $config['cf_social_servicelist']); ?>><i></i> 네이버 로그인을 사용합니다.
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 네이버 CallbackURL : <?php echo get_social_callbackurl('naver'); ?></div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="check_social_kakao" class="label">카카오 소셜로그인</label>
                            </th>
                            <td colspan="3">
                                <label class="checkbox">
                                    <input type="checkbox" name="cf_social_servicelist[]" id="check_social_kakao" value="kakao" <?php echo option_array_checked('kakao', $config['cf_social_servicelist']); ?>><i></i> 카카오 로그인을 사용합니다.
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 카카오 로그인 Redirect URI : <?php echo get_social_callbackurl('kakao', true); ?></div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="check_social_facebook" class="label">페이스북 소셜로그인</label>
                            </th>
                            <td colspan="3">
                                <label class="checkbox">
                                    <input type="checkbox" name="cf_social_servicelist[]" id="check_social_facebook" value="facebook" <?php echo option_array_checked('facebook', $config['cf_social_servicelist']); ?>><i></i> 페이스북 로그인을 사용합니다.
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 페이스북 유효한 OAuth 리디렉션 URI : <?php echo get_social_callbackurl('facebook'); ?></div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="check_social_google" class="label">구글 소셜로그인</label>
                            </th>
                            <td colspan="3">
                                <label class="checkbox">
                                    <input type="checkbox" name="cf_social_servicelist[]" id="check_social_google" value="google" <?php echo option_array_checked('google', $config['cf_social_servicelist']); ?>><i></i> 구글 로그인을 사용합니다.
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 구글 승인된 리디렉션 URI : <?php echo get_social_callbackurl('google'); ?></div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="check_social_twitter" class="label">트위터 소셜로그인</label>
                            </th>
                            <td colspan="3">
                                <label class="checkbox">
                                    <input type="checkbox" name="cf_social_servicelist[]" id="check_social_twitter" value="twitter" <?php echo option_array_checked('twitter', $config['cf_social_servicelist']); ?>><i></i> 트위터 로그인을 사용합니다.
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 트위터 CallbackURL : <?php echo get_social_callbackurl('twitter'); ?></div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="check_social_payco" class="label">페이코 소셜로그인</label>
                            </th>
                            <td colspan="3">
                                <label class="checkbox">
                                    <input type="checkbox" name="cf_social_servicelist[]" id="check_social_payco" value="payco" <?php echo option_array_checked('payco', $config['cf_social_servicelist']); ?>><i></i> 페이코 로그인을 사용합니다.
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 페이코 CallbackURL : <?php echo get_social_callbackurl('payco', false, true); ?></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php if (!G5_IS_MOBILE) { ?>
                </div>
                <?php } ?>
            </div>
            <header><strong><i class="fas fa-caret-right"></i> SNS 앱ID/KEY 설정</strong></header>
            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_naver_clientid" class="label">네이버 Client ID</label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <span>
                                        <label class="input form-width-220px"><input type="text" name="cf_naver_clientid" id="cf_naver_clientid" value="<?php echo get_sanitize_input($config['cf_naver_clientid']); ?>"> </label>
                                    </span>
                                    <span><a href="https://developers.naver.com/apps/#/register" target="_blank" class="btn-e btn-e-md btn-e-dark">앱 등록하기</a></span>
                                </div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_naver_secret" class="label">네이버 Client Secret</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="cf_naver_secret" id="cf_naver_secret" value="<?php echo get_sanitize_input($config['cf_naver_secret']); ?>">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_facebook_appid" class="label">페이스북 앱 ID</label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <span>
                                        <label class="input form-width-220px"><input type="text" name="cf_facebook_appid" id="cf_facebook_appid" value="<?php echo get_sanitize_input($config['cf_facebook_appid']); ?>"> </label>
                                    </span>
                                    <span><a href="https://developers.facebook.com/apps" target="_blank" class="btn-e btn-e-md btn-e-dark">앱 등록하기</a></span>
                                </div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_facebook_secret" class="label">페이스북 앱 Secret</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="cf_facebook_secret" id="cf_facebook_secret" value="<?php echo get_sanitize_input($config['cf_facebook_secret']); ?>">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_twitter_key" class="label">트위터 컨슈머 Key</label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <span>
                                        <label class="input form-width-220px"><input type="text" name="cf_twitter_key" id="cf_twitter_key" value="<?php echo get_sanitize_input($config['cf_twitter_key']); ?>"> </label>
                                    </span>
                                    <span><a href="https://developer.twitter.com/en/apps" target="_blank" class="btn-e btn-e-md btn-e-dark">앱 등록하기</a></span>
                                </div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_twitter_secret" class="label">트위터 컨슈머 Secret</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="cf_twitter_secret" id="cf_twitter_secret" value="<?php echo get_sanitize_input($config['cf_twitter_secret']); ?>">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_google_clientid" class="label">구글 Client ID</label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <span>
                                        <label class="input form-width-220px"><input type="text" name="cf_google_clientid" id="cf_google_clientid" value="<?php echo get_sanitize_input($config['cf_google_clientid']); ?>"> </label>
                                    </span>
                                    <span><a href="https://console.developers.google.com" target="_blank" class="btn-e btn-e-md btn-e-dark">앱 등록하기</a></span>
                                </div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_google_secret" class="label">구글 Client Secret</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="cf_google_secret" id="cf_google_secret" value="<?php echo get_sanitize_input($config['cf_google_secret']); ?>">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_googl_shorturl_apikey" class="label">구글 짧은주소 API Key</label>
                            </th>
                            <td colspan="3">
                                <div class="inline-group">
                                    <span>
                                        <label class="input form-width-220px"><input type="text" name="cf_googl_shorturl_apikey" id="cf_googl_shorturl_apikey" value="<?php echo get_sanitize_input($config['cf_googl_shorturl_apikey']); ?>"> </label>
                                    </span>
                                    <span><a href="http://code.google.com/apis/console/" target="_blank" class="btn-e btn-e-md btn-e-dark">API Key 등록하기</a></span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_kakao_rest_key" class="label">카카오 REST API 키</label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <span>
                                        <label class="input form-width-220px"><input type="text" name="cf_kakao_rest_key" id="cf_kakao_rest_key" value="<?php echo get_sanitize_input($config['cf_kakao_rest_key']); ?>"> </label>
                                    </span>
                                    <span><a href="https://developers.kakao.com/product/kakaoLogin" target="_blank" class="btn-e btn-e-md btn-e-dark">앱 등록하기</a></span>
                                </div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_kakao_client_secret" class="label">카카오 Client Secret</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="cf_kakao_client_secret" id="cf_kakao_client_secret" value="<?php echo get_sanitize_input($config['cf_kakao_client_secret']); ?>">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_kakao_js_apikey" class="label">카카오 JavaScript 키</label>
                            </th>
                            <td colspan="3">
                                <label class="input form-width-300px">
                                    <input type="text" name="cf_kakao_js_apikey" id="cf_kakao_js_apikey" value="<?php echo get_sanitize_input($config['cf_kakao_js_apikey']); ?>">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_payco_clientid" class="label">페이코 Client ID</label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <span>
                                        <label class="input form-width-220px"><input type="text" name="cf_payco_clientid" id="cf_payco_clientid" value="<?php echo get_sanitize_input($config['cf_payco_clientid']); ?>"> </label>
                                    </span>
                                    <span><a href="https://developers.payco.com/guide" target="_blank" class="btn-e btn-e-md btn-e-dark">앱 등록하기</a></span>
                                </div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_payco_secret" class="label">페이코 Secret</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="cf_payco_secret" id="cf_payco_secret" value="<?php echo get_sanitize_input($config['cf_payco_secret']); ?>">
                                </label>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php if (!G5_IS_MOBILE) { ?>
                </div>
                <?php } ?>
            </div>

            <div id="anc_cf_map">
                <header><strong><i class="fas fa-caret-right"></i> 지도 API ID 설정</strong></header>
                <div class="table-list-eb">
                    <?php if (!G5_IS_MOBILE) { ?>
                    <div class="table-responsive">
                    <?php } ?>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th class="table-form-th">
                                    <label for="cf_map_google_id" class="label">구글지도 API KEY</label>
                                </th>
                                <td>
                                    <div class="inline-group inline-mobile-block">
                                        <span>
                                            <label class="input form-width-350px"><input type="text" name="cf_map_google_id" id="cf_map_google_id" value="<?php echo get_sanitize_input($config['cf_map_google_id']); ?>"> </label>
                                        </span>
                                        <span><a href="https://cloud.google.com/maps-platform/" target="_blank" class="btn-e btn-e-md btn-e-dark">구글지도 API KEY 신청하기</a></span>
                                    </div>
                                    <div class="note margin-bottom-10"><strong>Note:</strong> 구글 계정으로 로그인 &gt; 키가져오기 버튼 클릭 후, API KEY를 발급받을 수 있습니다.</div>
                                </td>
                            </tr>
                            <tr>
                                <th class="table-form-th">
                                    <label for="cf_map_naver_id" class="label">네이버지도 CLIENT ID</label>
                                </th>
                                <td>
                                    <div class="inline-group inline-mobile-block">
                                        <span>
                                            <label class="input form-width-350px"><input type="text" name="cf_map_naver_id" id="cf_map_naver_id" value="<?php echo get_sanitize_input($config['cf_map_naver_id']); ?>"> </label>
                                        </span>
                                        <span><a href="https://www.ncloud.com/product/applicationService/maps" target="_blank" class="btn-e btn-e-md btn-e-green">네이버지도 신청 가이드</a></span>
                                    </div>
                                    <div class="note margin-bottom-10"><strong>Note:</strong> 신청 후, 내 애플리케이션 메뉴에서 Client ID를 확인하실 수 있습니다.</div>
                                </td>
                            </tr>
                            <tr>
                                <th class="table-form-th">
                                    <label for="cf_map_daum_id" class="label">다음지도 APP KEY</label>
                                </th>
                                <td>
                                    <div class="inline-group inline-mobile-block">
                                        <span>
                                            <label class="input form-width-350px"><input type="text" name="cf_map_daum_id" id="cf_map_daum_id" value="<?php echo get_sanitize_input($config['cf_map_daum_id']); ?>"> </label>
                                        </span>
                                        <span><a href="https://developers.kakao.com" target="_blank" class="btn-e btn-e-md btn-e-dark">다음지도 APP KEY 신청하기</a></span>
                                        <span><a href="http://apis.map.daum.net/web/guide/" target="_blank" class="btn-e btn-e-md btn-e-yellow">다음지도 API 개발 가이드</a></span>
                                    </div>
                                    <div class="note margin-bottom-10"><strong>Note:</strong> 앱을 만든 후, 내 애플리케이션에서 등록한 앱의 일반 메뉴의 JavaScript키를 입력해 주세요.</div>
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
    </div>

    <?php echo $frm_submit; // 버튼 ?>

    <div id="anc_cf_layout">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_cf_layout'); ?>
        </div>
        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 레이아웃 추가설정</strong></header>
            <fieldset>
                <div class="cont-text-bg">
                    <p class="bg-info font-size-12 margin-bottom-0">
                        <i class="fas fa-info-circle"></i> 기본 설정된 파일 경로 및 script, css 를 추가하거나 변경할 수 있습니다.
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
                                <label for="cf_add_script" class="label">추가 script, css</label>
                            </th>
                            <td>
                                <label class="textarea">
                                    <textarea name="cf_add_script" id="cf_add_script" rows="8"><?php echo get_text($config['cf_add_script']); ?></textarea>
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> HTML의 &lt;/HEAD&gt; 태그위로 추가될 JavaScript와 css 코드를 설정합니다.<br>관리자 페이지에서는 이 코드를 사용하지 않습니다.</div>
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

    <?php echo $frm_submit; // 버튼 ?>

    <div id="anc_cf_sms">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_cf_sms'); ?>
        </div>
        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> SMS 설정</strong></header>
            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_sms_use" class="label">SMS 사용</label>
                            </th>
                            <td>
                                <label class="select form-width-250px">
                                    <select id="cf_sms_use" name="cf_sms_use">
                                        <option value="" <?php echo get_selected($config['cf_sms_use'], ''); ?>>사용안함</option>
                                        <option value="icode" <?php echo get_selected($config['cf_sms_use'], 'icode'); ?>>아이코드</option>
                                    </select><i></i>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_sms_type" class="label">SMS 전송유형</label>
                            </th>
                            <td>
                                <label class="select form-width-250px">
                                    <select id="cf_sms_type" name="cf_sms_type">
                                        <option value="" <?php echo get_selected($config['cf_sms_type'], ''); ?>>SMS</option>
                                        <option value="LMS" <?php echo get_selected($config['cf_sms_type'], 'LMS'); ?>>LMS</option>
                                    </select><i></i>
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 전송유형을 SMS로 선택하시면 최대 80바이트까지 전송하실 수 있으며<br>LMS로 선택하시면 90바이트 이하는 SMS로, 그 이상은 ".G5_ICODE_LMS_MAX_LENGTH."바이트까지 LMS로 전송됩니다.<br>요금은 건당 SMS는 16원, LMS는 48원입니다.</div>
                            </td>
                        </tr>
                        <tr class="icode_old_version">
                            <th class="table-form-th">
                                <label for="cf_icode_id" class="label">아이코드 회원아이디<br>(구버전)</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="cf_icode_id" value="<?php echo get_sanitize_input($config['cf_icode_id']); ?>" id="cf_icode_id">
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 아이코드에서 사용하시는 회원아이디를 입력합니다.</div>
                            </td>
                        </tr>
                        <tr class="icode_old_version">
                            <th class="table-form-th">
                                <label for="cf_icode_pw" class="label">아이코드 비밀번호<br>(구버전)</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="password" name="cf_icode_pw" value="<?php echo get_sanitize_input($config['cf_icode_pw']); ?>" id="cf_icode_pw">
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 아이코드에서 사용하시는 비밀번호를 입력합니다.</div>
                            </td>
                        </tr>
                        <tr class="icode_old_version <?php if(!(isset($userinfo['payment']) && $userinfo['payment'])){ echo 'cf_tr_hide'; } ?>">
                            <th class="table-form-th">
                                <label class="label">요금제<br>(구버전)</label>
                            </th>
                            <td>
                                <input type="hidden" name="cf_icode_server_ip" value="<?php echo get_sanitize_input($config['cf_icode_server_ip']); ?>">
                                <label class="input margin-top-5">
                                    <?php if ($userinfo['payment'] == 'A') { ?>
                                    충전제<input type="hidden" name="cf_icode_server_port" value="7295" id="cf_icode_server_port">
                                    <?php } else if ($userinfo['payment'] == 'C') { ?>
                                    정액제<input type="hidden" name="cf_icode_server_port" value="7296" id="cf_icode_server_port">
                                    <?php } else { ?>
                                    가입해주세요.<input type="hidden" name="cf_icode_server_port" value="7295" id="cf_icode_server_port">
                                    <?php } ?>
                                </label>
                            </td>
                        </tr>
                        <?php if ($userinfo['payment'] == 'A') { ?>
                        <tr class="icode_old_version">
                            <th class="table-form-th">
                                <label class="label">충전 잔액<br>(구버전)</label>
                            </th>
                            <td>
                                <?php echo number_format($userinfo['coin']); ?> 원.
                                <a href="http://www.icodekorea.com/smsbiz/credit_card_amt.php?icode_id=<?php echo get_text($config['cf_icode_id']); ?>&amp;icode_passwd=<?php echo get_text($config['cf_icode_pw']); ?>" target="_blank" class="btn-e btn-e-sm btn-e-dark text-center">충전하기</a>
                            </td>
                        </tr>
                        <?php } ?>
                        <tr class="icode_json_version">
                            <th class="table-form-th">
                                <label class="label" for="cf_icode_token_key">아이코드 토큰키<br>(JSON버전)</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="cf_icode_token_key" value="<?php echo isset($config['cf_icode_token_key']) ? get_sanitize_input($config['cf_icode_token_key']) : ''; ?>" id="cf_icode_token_key">
                                </label>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 아이코드 JSON 버전의 경우 아이코드 토큰키를 입력시 실행됩니다.<br>SMS 전송유형을 LMS로 설정시 90바이트 이내는 SMS, 90 ~ 2000 바이트는 LMS 그 이상은 절삭 되어 LMS로 발송됩니다.</div>
                                <div class="note margin-bottom-10"><strong>Note:</strong> 아이코드 사이트 -> 토큰키관리 메뉴에서 생성한 토큰키를 입력합니다.</div>
                                <br>
                                서버아이피 : <?php echo $_SERVER['SERVER_ADDR']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">아이코드 SMS 신청<br>회원가입</label>
                            </th>
                            <td>
                                <?php echo number_format($userinfo['coin']); ?> 원
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">아이코드 충전하기</label>
                            </th>
                            <td>
                                <a href="http://icodekorea.com/res/join_company_fix_a.php?sellid=sir2" target="_blank" class="btn-e btn-e-sm btn-e-dark text-center">아이코드 회원가입</a>
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

    <?php echo $frm_submit; // 버튼 ?>

    <div id="anc_cf_extra">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_cf_extra'); ?>
        </div>
        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 여분필드 기본 설정</strong></header>
            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <?php for ($i=1; $i<=10; $i++) { ?>
                        <tr>
                            <th class="table-form-th">
                                <label for="cf_<?php echo $i; ?>_subj" class="label">여분필드 <?php echo $i; ?> 제목</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="cf_<?php echo $i; ?>_subj" id="cf_<?php echo $i; ?>_subj" value="<?php echo get_text($config['cf_'.$i.'_subj']); ?>">
                                </label>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="cf_<?php echo $i; ?>" class="label">여분필드 <?php echo $i; ?> 값</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="cf_<?php echo $i; ?>" id="cf_<?php echo $i; ?>" value="<?php echo get_sanitize_input($config['cf_'.$i]); ?>">
                                </label>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php if (!G5_IS_MOBILE) { ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php echo $frm_submit; // 버튼 ?>

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

$(function() {
    <?php if (!$config['cf_cert_use']) { ?>
    $(".cf_cert_service").addClass("cf_cert_hide");
    <?php } ?>

    $("#cf_cert_use").change(function(){
        switch($(this).val()) {
            case "0":
                $(".cf_cert_service").addClass("cf_cert_hide");
                break;
            default:
                $(".cf_cert_service").removeClass("cf_cert_hide");
                break;
        }
    });

    $("#cf_captcha").on("change", function(){
        if ($(this).val() == 'recaptcha' || $(this).val() == 'recaptcha_inv') {
            $("[class^='kcaptcha_']").hide();
        } else {
            $("[class^='kcaptcha_']").show();
        }
    }).trigger("change");
});

function fconfigform_submit(f) {
    var current_user_ip = "<?php echo $_SERVER['REMOTE_ADDR']; ?>";
    var cf_intercept_ip_val = f.cf_intercept_ip.value;

    if( cf_intercept_ip_val && current_user_ip ){
        var cf_intercept_ips = cf_intercept_ip_val.split("\n");

        for(var i=0; i < cf_intercept_ips.length; i++){
            if ( cf_intercept_ips[i].trim() ) {
                cf_intercept_ips[i] = cf_intercept_ips[i].replace(".", "\.");
                cf_intercept_ips[i] = cf_intercept_ips[i].replace("+", "[0-9\.]+");
                
                var re = new RegExp(cf_intercept_ips[i]);
                if ( re.test(current_user_ip) ){
                    alert("현재 접속 IP : "+ current_user_ip +" 가 차단될수 있기 때문에, 다른 IP를 입력해 주세요.");
                    return false;
                }
            }
        }
    }

    f.action = "<?php echo $action_url1; ?>";
    return true;
}

<?php if (G5_IS_MOBILE) { ?>
$(function() {
    $(".adm-table-form-wrap td").removeAttr('colspan');
});
<?php } ?>
</script>

<?php
// 본인확인 모듈 실행권한 체크
if($config['cf_cert_use']) {
    // kcb일 때
    if($config['cf_cert_ipin'] == 'kcb' || $config['cf_cert_hp'] == 'kcb') {
        // 실행모듈
        if(strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            if(PHP_INT_MAX == 2147483647) // 32-bit
                $exe = G5_OKNAME_PATH.'/bin/okname';
            else
                $exe = G5_OKNAME_PATH.'/bin/okname_x64';
        } else {
            if(PHP_INT_MAX == 2147483647) // 32-bit
                $exe = G5_OKNAME_PATH.'/bin/okname.exe';
            else
                $exe = G5_OKNAME_PATH.'/bin/oknamex64.exe';
        }

        echo module_exec_check($exe, 'okname');

        if(is_dir(G5_OKNAME_PATH.'/log') && is_writable(G5_OKNAME_PATH.'/log') && function_exists('check_log_folder') ) {
            check_log_folder(G5_OKNAME_PATH.'/log');
        }
    }

    // kcp일 때
    if($config['cf_cert_hp'] == 'kcp') {
        if(strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            if(PHP_INT_MAX == 2147483647) // 32-bit
                $exe = G5_KCPCERT_PATH . '/bin/ct_cli';
            else
                $exe = G5_KCPCERT_PATH . '/bin/ct_cli_x64';
        } else {
            $exe = G5_KCPCERT_PATH . '/bin/ct_cli_exe.exe';
        }

        echo module_exec_check($exe, 'ct_cli');
    }

    // LG의 경우 log 디렉토리 체크
    if($config['cf_cert_hp'] == 'lg') {
        $log_path = G5_LGXPAY_PATH.'/lgdacom/log';

        if(!is_dir($log_path)) {
            echo '<script>'.PHP_EOL;
            echo 'alert("'.str_replace(G5_PATH.'/', '', G5_LGXPAY_PATH).'/lgdacom 폴더 안에 log 폴더를 생성하신 후 쓰기권한을 부여해 주십시오.\n> mkdir log\n> chmod 707 log");'.PHP_EOL;
            echo '</script>'.PHP_EOL;
        } else {
            if(!is_writable($log_path)) {
                echo '<script>'.PHP_EOL;
                echo 'alert("'.str_replace(G5_PATH.'/', '',$log_path).' 폴더에 쓰기권한을 부여해 주십시오.\n> chmod 707 log");'.PHP_EOL;
                echo '</script>'.PHP_EOL;
            }
        }
    }
}
?>