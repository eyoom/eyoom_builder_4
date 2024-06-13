<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/member/member_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'member_list';
$g5_title = '회원관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">회원관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';

$frm_eba_submit  = ' <div class="confirm-fixed-btn"> ';
$frm_eba_submit .= ' <input type="submit" value="적용하기" class="btn-e btn-e-md btn-e-crimson" accesskey="s">' ;
$frm_eba_submit .= '</div>';
$frm_submit .= $frm_eba_submit;
?>

<div class="admin-member-form">
    <?php
    if ($w=='u') {
        /**
         * 회원 활동정보
         */
        @include_once(EYOOM_ADMIN_THEME_PATH . '/skin/member/member_box.html.php');
    }
    ?>

    <form name="fmember" id="fmember" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fmember_submit(this);" enctype="multipart/form-data" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="lev" value="<?php echo $lev; ?>">
    <input type="hidden" name="cert" value="<?php echo $cert; ?>">
    <input type="hidden" name="open" value="<?php echo $open; ?>">
    <input type="hidden" name="adt" value="<?php echo $adt; ?>">
    <input type="hidden" name="mail" value="<?php echo $mail; ?>">
    <input type="hidden" name="sms" value="<?php echo $sms; ?>">
    <input type="hidden" name="sdt" value="<?php echo $sdt; ?>">
    <input type="hidden" name="fr_date" value="<?php echo $fr_date; ?>">
    <input type="hidden" name="to_date" value="<?php echo $to_date; ?>">
    <input type="hidden" name="wmode" value="<?php echo $wmode ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>회원 정보</strong></div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="mb_id" class="label">아이디<?php echo $sound_only ?></label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <span>
                            <div class="input max-width-250px">
                                <input type="text" name="mb_id" value="<?php echo $mb['mb_id']; ?>" id="mb_id" <?php echo $required_mb_id; ?> <?php if ($w=='u') { ?>readonly<?php } ?> minlength="3" maxlength="20">
                            </div>
                        </span>
                        <?php if ($w=='u' && !$wmode){ ?>
                        <span>
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=boardgroupmember_form&amp;mb_id=<?php echo $mb['mb_id']; ?>" class="btn-e btn-e-lg btn-e-dark">접근가능그룹보기</a>
                        </span>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="mb_password" class="label">비밀번호<?php echo $sound_only ?></label>
                </div>
                <div class="adm-form-td td-r">
                    <div>
                        <label class="input max-width-250px">
                            <input type="password" name="mb_password" id="mb_password" <?php echo $required_mb_password ?> maxlength="20">
                        </label>
                    </div>
                    <div id="mb_password_captcha_wrap" style="display:none">
                        <?php
                        require_once G5_CAPTCHA_PATH . '/captcha.lib.php';
                        $captcha_html = captcha_html();
                        $captcha_js   = chk_captcha_js();
                        echo $captcha_html;
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="mb_name" class="label">이름(실명)<strong class="sound_only">필수</strong></label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="mb_name" id="mb_name" value="<?php echo $mb['mb_name']; ?>" required maxlength="20" required>
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="mb_nick" class="label">닉네임<strong class="sound_only">필수</strong></label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="mb_nick" id="mb_nick" value="<?php echo $mb['mb_nick']; ?>" required maxlength="20" required>
                    </label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="mb_level" class="label">회원 권한</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="select max-width-250px">
                        <?php echo get_member_level_select('mb_level', 1, $member['mb_level'], $mb['mb_level']) ?><i></i>
                    </label>
                    <input type="hidden" name="mb_prev_level" value="<?php echo $mb['mb_level']; ?>">
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="mb_point" class="label">포인트</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input state-disabled max-width-250px">
                        <i class="icon-append">점</i>
                        <input type="text" value="<?php echo number_format($mb['mb_point']) ?>" class="text-right" disabled>
                    </label>
                    <input type="hidden" name="level_point" value="<?php echo $eb_member['level_point']; ?>">
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="mb_email" class="label">E-mail<strong class="sound_only">필수</strong></label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append fas fa-envelope"></i>
                        <input type="text" name="mb_email" id="mb_email" value="<?php echo $mb['mb_email']; ?>" maxlength="100">
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="mb_homepage" class="label">홈페이지</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append fas fa-link"></i>
                        <input type="text" name="mb_homepage" id="mb_homepage" value="<?php echo $mb['mb_homepage']; ?>" maxlength="255">
                    </label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="mb_hp" class="label">휴대폰번호</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append fas fa-mobile-alt"></i>
                        <input type="text" name="mb_hp" id="mb_hp" value="<?php echo $mb['mb_hp']; ?>" maxlength="20">
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="mb_tel" class="label">전화번호</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append fas fa-phone"></i>
                        <input type="text" name="mb_tel" id="mb_tel" value="<?php echo $mb['mb_tel']; ?>" maxlength="20">
                    </label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="mb_certify_case" class="label">본인확인방법</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <label for="mb_certify_sa" class="radio"><input type="radio" name="mb_certify_case" value="simple" id="mb_certify_sa" <?php if($mb['mb_certify'] == 'simple') echo 'checked="checked"'; ?>><i></i> 간편인증</label>
                    <label for="mb_certify_hp" class="radio"><input type="radio" name="mb_certify_case" value="hp" id="mb_certify_hp" <?php if($mb['mb_certify'] == 'hp') echo 'checked="checked"'; ?>><i></i> 휴대폰</label>
                    <label for="mb_certify_ipin" class="radio"><input type="radio" name="mb_certify_case" value="ipin" id="mb_certify_ipin" <?php if($mb['mb_certify'] == 'ipin') echo 'checked="checked"'; ?>><i></i> 아이핀</label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="mb_certify" class="label">본인확인</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <label for="mb_certify_yes" class="radio"><input type="radio" name="mb_certify" value="1" id="mb_certify_yes" <?php echo $mb_certify_yes; ?>><i></i> 예</label>
                        <label for="mb_certify_no" class="radio"><input type="radio" name="mb_certify" value="0" id="mb_certify_no" <?php echo $mb_certify_no; ?>><i></i> 아니오</label>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="mb_adult" class="label">성인인증</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <label for="mb_adult_yes" class="radio"><input type="radio" name="mb_adult" value="1" id="mb_adult_yes" <?php echo $mb_adult_yes; ?>><i></i> 예</label>
                        <label for="mb_adult_no" class="radio"><input type="radio" name="mb_adult" value="0" id="mb_adult_no" <?php echo $mb_adult_no; ?>><i></i> 아니오</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label for="mb_hp" class="label">주소</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="row">
                    <div class="col-sm-4">
                        <section>
                            <label for="mb_zip" class="sound_only">우편번호</label>
                            <label class="input">
                                <i class="icon-append fas fa-question-circle"></i>
                                <input type="text" name="mb_zip" value="<?php echo $mb['mb_zip1']; ?><?php echo $mb['mb_zip2']; ?>" id="mb_zip" maxlength="6" readonly="readonly">
                                <b class="tooltip tooltip-top-right">우편번호 - '주소 검색' 버튼을 클릭해 주세요.</b>
                            </label>
                        </section>
                    </div>
                    <div class="col-sm-3">
                        <section>
                            <button type="button" onclick="win_zip('fmember', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');" class="btn-e btn-e-lg btn-e-indigo">주소 검색</button>
                        </section>
                    </div>
                </div>
                <section>
                    <label class="input">
                        <input type="text" name="mb_addr1" value="<?php echo $mb['mb_addr1']; ?>" id="mb_addr1">
                    </label>
                    <div class="note"><strong>Note:</strong> 기본주소</div>
                </section>
                <div class="row">
                    <div class="col-sm-6">
                        <section>
                            <label class="input">
                                <input type="text" name="mb_addr2" value="<?php echo $mb['mb_addr2']; ?>" id="mb_addr2">
                            </label>
                            <div class="note"><strong>Note:</strong> 상세주소</div>
                        </section>
                    </div>
                    <div class="col-sm-6">
                        <section>
                            <label class="input">
                                <input type="text" name="mb_addr3" value="<?php echo $mb['mb_addr3']; ?>" id="mb_addr3">
                            </label>
                            <div class="note"><strong>Note:</strong> 참고항목</div>
                        </section>
                    </div>
                    <input type="hidden" name="mb_addr_jibeon" value="<?php echo $mb['mb_addr_jibeon']; ?>">
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="mb_icon" class="label">회원아이콘</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="input">
                        <input type="file" class="form-control" id="mb_icon" name="mb_icon" value="파일선택">
                    </div>
                    <?php if ($icon_url) { ?>
                    <img src="<?php echo $icon_url.$icon_filemtile; ?>" alt="">
                    <label for="del_mb_icon" class="checkbox"><input type="checkbox" id="del_mb_icon" name="del_mb_icon" value="1"><i></i> 삭제</label>
                    <?php } ?>
                    <div class="note"><strong>Note:</strong> 아이콘 크기는 <strong>너비 <?php echo $config['cf_member_icon_width']; ?>픽셀 높이 <?php echo $config['cf_member_icon_height']; ?>픽셀</strong>로 해주세요.</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="mb_img" class="label">회원이미지</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="input">
                        <input type="file" class="form-control" id="mb_img" name="mb_img" value="파일선택">
                    </div>
                    <?php if (file_exists($photo_file)) { ?>
                    <?php echo get_member_profile_img($mb['mb_id']); ?>
                    <label for="del_mb_img" class="checkbox"><input type="checkbox" id="del_mb_img" name="del_mb_img" value="1"><i></i> 삭제</label>
                    <?php } ?>
                    <div class="note"><strong>Note:</strong> 이미지 크기는 <strong>너비 <?php echo $config['cf_member_img_width']; ?>픽셀 높이 <?php echo $config['cf_member_img_height']; ?>픽셀</strong>로 해주세요.</div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="mb_mailling" class="label">메일 수신</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <label for="mb_mailling_yes" class="radio"><input type="radio" name="mb_mailling" id="mb_mailling_yes" value="1" <?php echo $mb_mailling_yes; ?>><i></i> 예</label>
                        <label for="mb_mailling_no" class="radio"><input type="radio" name="mb_mailling" id="mb_mailling_no" value="0" <?php echo $mb_mailling_no; ?>><i></i> 아니오</label>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="mb_sms" class="label">SMS 수신</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <label for="mb_sms_yes" class="radio"><input type="radio" name="mb_sms" id="mb_sms_yes" value="1" <?php echo $mb_sms_yes; ?>><i></i> 예</label>
                        <label for="mb_sms_no" class="radio"><input type="radio" name="mb_sms" id="mb_sms_no" value="0" <?php echo $mb_sms_no; ?>><i></i> 아니오</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="mb_open" class="label">정보 공개</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <label for="mb_open_yes" class="radio"><input type="radio" name="mb_open" id="mb_open_yes" value="1" <?php echo $mb_open_yes; ?>><i></i> 예</label>
                    <label for="mb_open_no" class="radio"><input type="radio" name="mb_open" id="mb_open_no" value="0" <?php echo $mb_open_no; ?>><i></i> 아니오</label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="mb_signature" class="label">서명</label>
            </div>
            <div class="adm-form-td td-r">
                <label for="mb_signature" class="textarea">
                    <textarea name="mb_signature" id="mb_signature" rows="5"><?php echo html_purifier($mb['mb_signature']); ?></textarea>
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="mb_profile" class="label">자기 소개</label>
            </div>
            <div class="adm-form-td td-r">
                <label for="mb_profile" class="textarea">
                    <textarea name="mb_profile" id="mb_profile" rows="5"><?php echo html_purifier($mb['mb_profile']); ?></textarea>
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="mb_memo" class="label">메모</label>
            </div>
            <div class="adm-form-td td-r">
                <label for="mb_memo" class="textarea">
                    <textarea name="mb_memo" id="mb_memo" rows="5"><?php echo html_purifier($mb['mb_memo']); ?></textarea>
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="mb_cert_history" class="label">본인인증 내역</label>
            </div>
            <div class="adm-form-td td-r">
                <?php 
                $cnt = 0;
                while ($row = sql_fetch_array($mb_cert_history)) {
                    $cnt++;
                    switch($row['ch_type']){
                        case 'simple':
                            $cert_type = '간편인증';
                            break;
                        case 'hp':
                            $cert_type = '휴대폰';
                            break;
                        case 'ipin':
                            $cert_type = '아이핀';
                            break;
                    }
                ?>
                <div>
                    [<?php echo $row['ch_datetime']; ?>]
                    <?php echo $row['mb_id']; ?> /
                    <?php echo $row['ch_name']; ?> /
                    <?php echo $row['ch_hp']; ?> /
                    <?php echo $cert_type; ?>
                </div>
                <?php } ?>

                <?php if ($cnt == 0) { ?>
                    본인인증 내역이 없습니다.
                <?php } ?>
            </div>
        </div>
        <?php if ($w == 'u') { ?>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label class="label">회원가입일</label>
                </div>
                <div class="adm-form-td td-r">
                    <?php echo $mb['mb_datetime'] ?>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label class="label">최근접속일</label>
                </div>
                <div class="adm-form-td td-r">
                    <?php echo $mb['mb_today_login'] ?>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">IP</label>
            </div>
            <div class="adm-form-td td-r">
                <?php echo $mb['mb_ip'] ?>
            </div>
        </div>
        <?php if ($config['cf_use_email_certify']) { ?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">인증일시</label>
            </div>
            <div class="adm-form-td td-r">
                <?php if ($mb['mb_email_certify'] == '0000-00-00 00:00:00') { ?>
                <label for="passive_certify" class="checkbox">
                    <input type="checkbox" name="passive_certify" id="passive_certify"><i></i> 수동인증
                </label>
                <div class="note"><strong>Note:</strong> 회원님이 메일을 수신할 수 없는 경우 등에 직접 인증처리를 하실 수 있습니다.</div>
                <?php } else { ?>
                <label class="input">
                    <input type="text" name="mb_leave_date" id="mb_leave_date" class="color-blue-important" value="<?php echo $mb['mb_leave_date']; ?>">
                </label>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
        <?php if ($config['cf_use_recommend']) { // 추천인 사용 ?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">추천인</label>
            </div>
            <div class="adm-form-td td-r">
                <?php echo ($mb['mb_recommend'] ? get_text($mb['mb_recommend']) : '없음'); // 081022 : CSRF 보안 결함으로 인한 코드 수정 ?><i></i>
            </div>
        </div>
        <?php } ?>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="mb_leave_date" class="label">탈퇴일자</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="mb_leave_date" id="mb_leave_date" value="<?php echo $mb['mb_leave_date']; ?>" maxlength="8">
                    </label>
                    <label for="mb_leave_date_set_today" class="checkbox">
                        <input type="checkbox" id="mb_leave_date_set_today" value="<?php echo date('Ymd'); ?>" onclick="if (this.form.mb_leave_date.value==this.form.mb_leave_date.defaultValue) {
this.form.mb_leave_date.value=this.value; } else { this.form.mb_leave_date.value=this.form.mb_leave_date.defaultValue; }"><i></i> 탈퇴일을 오늘로 지정
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="mb_intercept_date" class="label">접근차단일자</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="mb_intercept_date" id="mb_intercept_date" value="<?php echo $mb['mb_intercept_date']; ?>" maxlength="8">
                    </label>
                    <label for="mb_intercept_date_set_today" class="checkbox">
                        <input type="checkbox" id="mb_intercept_date_set_today" value="<?php echo date('Ymd'); ?>" onclick="if
(this.form.mb_intercept_date.value==this.form.mb_intercept_date.defaultValue) { this.form.mb_intercept_date.value=this.value; } else {
this.form.mb_intercept_date.value=this.form.mb_intercept_date.defaultValue; }"><i></i> 접근차단일을 오늘로 지정
                    </label>
                </div>
            </div>
        </div>
        <?php
        //소셜계정이 있다면
        if(function_exists('social_login_link_account') && $mb['mb_id'] ){
            if( $my_social_accounts = social_login_link_account($mb['mb_id'], false, 'get_data') ){ ?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">소셜계정목록</label>
            </div>
            <div class="adm-form-td td-r">
                <ul class="social_link_box">
                    <li class="social_login_container">
                        <h6>연결된 소셜 계정 목록</h6>
                        <?php foreach($my_social_accounts as $account){     //반복문
                            if( empty($account) ) continue;

                            $provider = strtolower($account['provider']);
                            $provider_name = social_get_provider_service_name($provider);
                        ?>
                        <div class="account_provider" data-mpno="social_<?php echo $account['mp_no'];?>" >
                            <div class="sns-wrap-32 sns-wrap-over">
                                <span class="sns-icon sns-<?php echo $provider; ?>" title="<?php echo $provider_name; ?>">
                                    <span class="ico"></span>
                                    <span class="txt"><?php echo $provider_name; ?></span>
                                </span>

                                <span class="provider_name"><?php echo $provider_name;   //서비스이름?> ( <?php echo $account['displayname']; ?> )</span>
                                <span class="account_hidden" style="display:none"><?php echo $account['mb_id']; ?></span>
                            </div>
                            <div class="btn_info"><a href="<?php echo G5_SOCIAL_LOGIN_URL.'/unlink.php?mp_no='.$account['mp_no'] ?>" class="social_unlink" data-provider="<?php echo $account['mp_no'];?>" >연동해제</a> <span class="sound_only"><?php echo substr($account['mp_register_day'], 2, 14); ?></span></div>
                        </div>
                        <?php } //end foreach ?>
                    </li>
                </ul>
                <script>
                jQuery(function($){
                    $(".account_provider").on("click", ".social_unlink", function(e){
                        e.preventDefault();

                        if (!confirm('정말 이 계정 연결을 삭제하시겠습니까?')) {
                            return false;
                        }

                        var ajax_url = "<?php echo G5_SOCIAL_LOGIN_URL.'/unlink.php' ?>";
                        var mb_id = '',
                            mp_no = $(this).attr("data-provider"),
                            $mp_el = $(this).parents(".account_provider");

                            mb_id = $mp_el.find(".account_hidden").text();

                        if( ! mp_no ){
                            alert('잘못된 요청! mp_no 값이 없습니다.');
                            return;
                        }

                        $.ajax({
                            url: ajax_url,
                            type: 'POST',
                            data: {
                                'mp_no': mp_no,
                                'mb_id': mb_id
                            },
                            dataType: 'json',
                            async: false,
                            success: function(data, textStatus) {
                                if (data.error) {
                                    alert(data.error);
                                    return false;
                                } else {
                                    alert("연결이 해제 되었습니다.");
                                    $mp_el.fadeOut("normal", function() {
                                        $(this).remove();
                                    });
                                }
                            }
                        });

                        return;
                    });
                });
                </script>
            </div>
        </div>
        <?php
            }   //end if
        }   //end if
        run_event('admin_member_form_add', $mb, $w, 'table');
        ?>
    </div>

    <div class="confirm-bottom-btn m-b-20">
        <?php echo $frm_submit;?>
    </div>

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>여분필드</strong></div>
        <?php for ($i=1; $i<=10; $i++) { ?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="mb_<?php echo $i; ?>" class="label">여분필드 <?php echo $i; ?></label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-300px">
                    <input type="text" name="mb_<?php echo $i; ?>" id="mb_<?php echo $i; ?>" value="<?php echo $mb['mb_'.$i] ?>" maxlength="255">
                </label>
            </div>
        </div>
        <?php } ?>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit;?>
    </div>

    </form>
</div>

<script>
function fmember_submit(f)
{
    if (!f.mb_icon.value.match(/\.(gif|jpe?g|png)$/i) && f.mb_icon.value) {
        alert('아이콘은 이미지 파일만 가능합니다.');
        return false;
    }

    if (!f.mb_img.value.match(/\.(gif|jpe?g|png)$/i) && f.mb_img.value) {
        alert('회원이미지는 이미지 파일만 가능합니다.');
        return false;
    }

    if( jQuery("#mb_password").val() ){
        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함 ?>
    }

    return true;
}
jQuery(function($){
    $("#captcha_key").prop('required', false).removeAttr("required").removeClass("required");

    $("#mb_password").on("keyup", function(e) {
        var $warp = $("#mb_password_captcha_wrap"),
            tooptipid = "mp_captcha_tooltip",
            $span_text = $("<span>", {id:tooptipid, style:"font-size:0.95em;letter-spacing:-0.1em"}).html("비밀번호를 수정할 경우 캡챠를 입력해야 합니다."),
            $parent = $(this).parent(),
            is_invisible_recaptcha = $("#captcha").hasClass("invisible_recaptcha");

        if($(this).val()){
            $warp.show();
            if(! is_invisible_recaptcha) {
                $warp.css("margin-top","1em");
                if(! $("#"+tooptipid).length){ $parent.append($span_text) }
            }
        } else {
            $warp.hide();
            if($("#"+tooptipid).length && ! is_invisible_recaptcha){ $parent.find("#"+tooptipid).remove(); }
        }
    });
});
</script>

<?php 
run_event('admin_member_form_after', $mb, $w);
?>