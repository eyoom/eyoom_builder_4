<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/member/member_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-member-form">
    <div class="adm-headline">
        <h3>회원 정보</h3>
    </div>

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

    <div class="adm-table-form-wrap margin-bottom-30">
        <header><strong><i class="fas fa-caret-right"></i> 회원 정보</strong></header>
        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label for="mb_id" class="label">아이디<?php echo $sound_only ?></label>
                        </th>
                        <td>
                            <div <?php if (!G5_IS_MOBILE) { ?>class="inline-group"<?php } ?>>
                                <span>
                                    <label class="input form-width-250px"><input type="text" name="mb_id" value="<?php echo $mb['mb_id']; ?>" id="mb_id" <?php echo $required_mb_id; ?> <?php if ($w=='u') { ?>readonly<?php } ?> minlength="3" maxlength="20"></label>
                                </span>
                                <?php if ($w=='u' && !$wmode){ ?>
                                <span><a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=boardgroupmember_form&amp;mb_id=<?php echo $mb['mb_id']; ?>" class="btn-e btn-e-sm btn-e-dark">접근가능그룹보기</a></span>
                                <?php } ?>
                            </div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label for="mb_password" class="label">비밀번호<?php echo $sound_only ?></label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <input type="password" name="mb_password" id="mb_password" <?php echo $required_mb_password ?> maxlength="20">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="mb_name" class="label">이름(실명)<strong class="sound_only">필수</strong></label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <input type="text" name="mb_name" id="mb_name" value="<?php echo $mb['mb_name']; ?>" required maxlength="20" required>
                            </label>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label for="mb_nick" class="label">닉네임<strong class="sound_only">필수</strong></label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <input type="text" name="mb_nick" id="mb_nick" value="<?php echo $mb['mb_nick']; ?>" required maxlength="20" required>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="mb_level" class="label">회원 권한</label>
                        </th>
                        <td>
                            <label class="select form-width-250px">
                                <?php echo get_member_level_select('mb_level', 1, $member['mb_level'], $mb['mb_level']) ?><i></i>
                            </label>
                            <input type='hidden' name='mb_prev_level' value='<?php echo $mb['mb_level']; ?>'>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label for="mb_point" class="label">포인트</label>
                        </th>
                        <td>
                            <label class="input state-disabled form-width-250px">
                                <i class="icon-append">점</i>
                                <input type="text" value="<?php echo number_format($mb['mb_point']) ?>" class="text-right" disabled>
                            </label>
                            <input type='hidden' name='level_point' value='<?php echo $eb_member['level_point']; ?>'>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="mb_email" class="label">E-mail<strong class="sound_only">필수</strong></label>
                        </th>
                        <td>
                            <label class="input">
                                <i class="icon-append fas fa-envelope"></i>
                                <input type="text" name="mb_email" id="mb_email" value="<?php echo $mb['mb_email']; ?>" maxlength="100">
                            </label>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label for="mb_homepage" class="label">홈페이지</label>
                        </th>
                        <td>
                            <label class="input">
                                <i class="icon-append fas fa-link"></i>
                                <input type="text" name="mb_homepage" id="mb_homepage" value="<?php echo $mb['mb_homepage']; ?>" maxlength="255">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="mb_hp" class="label">휴대폰번호</label>
                        </th>
                        <td>
                            <label class="input">
                                <i class="icon-append fas fa-tablet-alt"></i>
                                <input type="text" name="mb_hp" id="mb_hp" value="<?php echo $mb['mb_hp']; ?>" maxlength="20">
                            </label>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label for="mb_tel" class="label">전화번호</label>
                        </th>
                        <td>
                            <label class="input">
                                <i class="icon-append fas fa-phone"></i>
                                <input type="text" name="mb_tel" id="mb_tel" value="<?php echo $mb['mb_tel']; ?>" maxlength="20">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="mb_certify_case" class="label">본인확인방법</label>
                        </th>
                        <td colspan="3">
                            <div class="inline-group">
                                <label for="mb_certify_ipin" class="radio"><input type="radio" name="mb_certify_case" value="ipin" id="mb_certify_ipin" <?php if($mb['mb_certify_case'] == 'ipin') echo 'checked="checked"'; ?>><i></i> 아이핀</label>
                                <label for="mb_certify_hp" class="radio"><input type="radio" name="mb_certify_case" value="hp" id="mb_certify_hp" <?php if($mb['mb_certify_case'] == 'hp') echo 'checked="checked"'; ?>><i></i> 휴대폰</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="mb_certify" class="label">본인확인</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="mb_certify_yes" class="radio"><input type="radio" name="mb_certify" value="1" id="mb_certify_yes" <?php echo $mb_certify_yes; ?>><i></i> 예</label>
                                <label for="mb_certify_no" class="radio"><input type="radio" name="mb_certify" value="0" id="mb_certify_no" <?php echo $mb_certify_no; ?>><i></i> 아니오</label>
                            </div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label for="mb_adult" class="label">성인인증</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="mb_adult_yes" class="radio"><input type="radio" name="mb_adult" value="1" id="mb_adult_yes" <?php echo $mb_adult_yes; ?>><i></i> 예</label>
                                <label for="mb_adult_no" class="radio"><input type="radio" name="mb_adult" value="0" id="mb_adult_no" <?php echo $mb_adult_no; ?>><i></i> 아니오</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="mb_hp" class="label">주소</label>
                        </th>
                        <td colspan="3">
                            <div class="row">
                                <div class="col col-3">
                                    <section>
                                        <label for="mb_zip" class="sound_only">우편번호</label>
                                        <label class="input">
                                            <i class="icon-append fas fa-question-circle"></i>
                                            <input type="text" name="mb_zip" value="<?php echo $mb['mb_zip1']; ?><?php echo $mb['mb_zip2']; ?>" id="mb_zip" maxlength="6" readonly="readonly">
                                            <b class="tooltip tooltip-top-right">우편번호</b>
                                        </label>
                                    </section>
                                </div>
                                <div class="col col-2">
                                    <section>
                                        <button type="button" onclick="win_zip('fmember', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');" class="btn-e btn-e-purple" style="padding:4px 12px 3px">주소 검색</button>
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
                                <div class="col col-6">
                                    <section>
                                        <label class="input">
                                            <input type="text" name="mb_addr2" value="<?php echo $mb['mb_addr2']; ?>" id="mb_addr2">
                                        </label>
                                        <div class="note"><strong>Note:</strong> 상세주소</div>
                                    </section>
                                </div>
                                <div class="col col-6">
                                    <section>
                                        <label class="input">
                                            <input type="text" name="mb_addr3" value="<?php echo $mb['mb_addr3']; ?>" id="mb_addr3">
                                        </label>
                                        <div class="note"><strong>Note:</strong> 참고항목</div>
                                    </section>
                                </div>
                                <input type="hidden" name="mb_addr_jibeon" value="<?php echo $mb['mb_addr_jibeon']; ?>">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="mb_icon" class="label">회원아이콘</label>
                        </th>
                        <td>
                            <label for="file" class="input input-file">
                                <div class="button bg-color-light-grey"><input type="file" id="mb_icon" name="mb_icon" value="파일선택" onchange="this.parentNode.nextSibling.value = this.value">파일선택</div><input type="text" readonly>
                            </label>
                            <?php if ($icon_url) { ?>
                            <img src="<?php echo $icon_url.$icon_filemtile; ?>" alt="">
                            <label for="del_mb_icon" class="checkbox"><input type="checkbox" id="del_mb_icon" name="del_mb_icon" value="1"><i></i> 삭제</label>
                            <?php } ?>
                            <div class="note"><strong>Note:</strong> 아이콘 크기는 <strong>넓이 <?php echo $config['cf_member_icon_width']; ?>픽셀 높이 <?php echo $config['cf_member_icon_height']; ?>픽셀</strong>로 해주세요.</div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label for="mb_img" class="label">회원이미지</label>
                        </th>
                        <td>
                            <label for="file" class="input input-file">
                                <div class="button bg-color-light-grey"><input type="file" id="mb_img" name="mb_img" value="파일선택" onchange="this.parentNode.nextSibling.value = this.value">파일선택</div><input type="text" readonly>
                            </label>
                            <?php if (file_exists($photo_file)) { ?>
                            <?php echo get_member_profile_img($mb['mb_id']); ?>
                            <label for="del_mb_img" class="checkbox"><input type="checkbox" id="del_mb_img" name="del_mb_img" value="1"><i></i> 삭제</label>
                            <?php } ?>
                            <div class="note"><strong>Note:</strong> 이미지 크기는 <strong>넓이 <?php echo $config['cf_member_img_width']; ?>픽셀 높이 <?php echo $config['cf_member_img_height']; ?>픽셀</strong>로 해주세요.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="mb_mailling" class="label">메일 수신</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="mb_mailling_yes" class="radio"><input type="radio" name="mb_mailling" id="mb_mailling_yes" value="1" <?php echo $mb_mailling_yes; ?>><i></i> 예</label>
                                <label for="mb_mailling_no" class="radio"><input type="radio" name="mb_mailling" id="mb_mailling_no" value="0" <?php echo $mb_mailling_no; ?>><i></i> 아니오</label>
                            </div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label for="mb_sms" class="label">SMS 수신</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="mb_sms_yes" class="radio"><input type="radio" name="mb_sms" id="mb_sms_yes" value="1" <?php echo $mb_sms_yes; ?>><i></i> 예</label>
                                <label for="mb_sms_no" class="radio"><input type="radio" name="mb_sms" id="mb_sms_no" value="0" <?php echo $mb_sms_no; ?>><i></i> 아니오</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="mb_open" class="label">정보 공개</label>
                        </th>
                        <td colspan="3">
                            <div class="inline-group">
                                <label for="mb_open_yes" class="radio"><input type="radio" name="mb_open" id="mb_open_yes" value="1" <?php echo $mb_open_yes; ?>><i></i> 예</label>
                                <label for="mb_open_no" class="radio"><input type="radio" name="mb_open" id="mb_open_no" value="0" <?php echo $mb_open_no; ?>><i></i> 아니오</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="mb_signature" class="label">서명</label>
                        </th>
                        <td colspan="3">
                            <label for="mb_signature" class="textarea">
                                <textarea name="mb_signature" id="mb_signature" rows="5"><?php echo $mb['mb_signature']; ?></textarea>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="mb_profile" class="label">자기 소개</label>
                        </th>
                        <td colspan="3">
                            <label for="mb_profile" class="textarea">
                                <textarea name="mb_profile" id="mb_profile" rows="5"><?php echo $mb['mb_profile']; ?></textarea>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="mb_memo" class="label">메모</label>
                        </th>
                        <td colspan="3">
                            <label for="mb_memo" class="textarea">
                                <textarea name="mb_memo" id="mb_memo" rows="5"><?php echo $mb['mb_memo']; ?></textarea>
                            </label>
                        </td>
                    </tr>
                    <?php if ($w == 'u') { ?>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">회원가입일</label>
                        </th>
                        <td>
                            <?php echo $mb['mb_datetime'] ?>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">최근접속일</label>
                        </th>
                        <td>
                            <?php echo $mb['mb_today_login'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">IP</label>
                        </th>
                        <td colspan="3">
                            <?php echo $mb['mb_ip'] ?>
                        </td>
                    </tr>
                    <?php if ($config['cf_use_email_certify']) { ?>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">인증일시</label>
                        </th>
                        <td colspan="3">
                            <label class="label">인증일시</label>
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
                        </td>
                    </tr>
                    <?php } ?>
                    <?php } ?>

                    <?php if ($config['cf_use_recommend']) { // 추천인 사용 ?>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">추천인</label>
                        </th>
                        <td colspan="3">
                            <?php echo ($mb['mb_recommend'] ? get_text($mb['mb_recommend']) : '없음'); // 081022 : CSRF 보안 결함으로 인한 코드 수정 ?><i></i>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <th class="table-form-th">
                            <label for="mb_leave_date" class="label">탈퇴일자</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label class="input form-width-250px">
                                    <input type="text" name="mb_leave_date" id="mb_leave_date" value="<?php echo $mb['mb_leave_date']; ?>" maxlength="8">
                                </label>
                                <label for="mb_leave_date_set_today" class="checkbox">
                                    <input type="checkbox" id="mb_leave_date_set_today" value="<?php echo date('Ymd'); ?>" onclick="if (this.form.mb_leave_date.value==this.form.mb_leave_date.defaultValue) {
    this.form.mb_leave_date.value=this.value; } else { this.form.mb_leave_date.value=this.form.mb_leave_date.defaultValue; }"><i></i> 탈퇴일을 오늘로 지정
                                </label>
                            </div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label for="mb_intercept_date" class="label">접근차단일자</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label class="input form-width-250px">
                                    <input type="text" name="mb_intercept_date" id="mb_intercept_date" value="<?php echo $mb['mb_intercept_date']; ?>" maxlength="8">
                                </label>
                                <label for="mb_intercept_date_set_today" class="checkbox">
                                    <input type="checkbox" id="mb_intercept_date_set_today" value="<?php echo date('Ymd'); ?>" onclick="if
    (this.form.mb_intercept_date.value==this.form.mb_intercept_date.defaultValue) { this.form.mb_intercept_date.value=this.value; } else {
    this.form.mb_intercept_date.value=this.form.mb_intercept_date.defaultValue; }"><i></i> 접근차단일을 오늘로 지정
                                </label>
                            </div>
                        </td>
                    </tr>
                    <?php
                    //소셜계정이 있다면
                    if(function_exists('social_login_link_account') && $mb['mb_id'] ){
                        if( $my_social_accounts = social_login_link_account($mb['mb_id'], false, 'get_data') ){ ?>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">소셜계정목록</label>
                        </th>
                        <td colspan="3">
                            <ul class="social_link_box">
                                <li class="social_login_container">
                                    <h4>연결된 소셜 계정 목록</h4>
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
                        </td>
                    </tr>
                    <?php
                        }   //end if
                    }   //end if

                    run_event('admin_member_form_add', $mb, $w, 'table');
                    ?>
                </tbody>
            </table>
            <?php if (!G5_IS_MOBILE) { ?>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php echo $frm_submit; ?>

    <div class="adm-table-form-wrap margin-bottom-30">
        <header><strong><i class="fas fa-caret-right"></i> 여분필드</strong></header>
        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <?php for ($i=1; $i<=10; $i++) { ?>
                    <tr>
                        <th class="table-form-th">
                            <label for="mb_<?php echo $i; ?>" class="label">여분필드 <?php echo $i; ?></label>
                        </th>
                        <td colspan="3">
                            <label class="input form-width-300px">
                                <input type="text" name="mb_<?php echo $i; ?>" id="mb_<?php echo $i; ?>" value="<?php echo $mb['mb_'.$i] ?>" maxlength="255">
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

    <?php echo $frm_submit; ?>

    </form>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/eyoom-form/plugins/jquery-maskedinput/jquery.maskedinput.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/eyoom-form/plugins/jquery-chained/jquery.chained.remote.min.js"></script>

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

    return true;
}
</script>

<?php 
run_event('admin_member_form_after', $mb, $w);
?>