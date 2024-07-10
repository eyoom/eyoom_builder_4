<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/register_form.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert2/sweetalert2.min.css" type="text/css" media="screen">',0);
add_javascript('<script src="'.G5_JS_URL.'/jquery.register_form.js"></script>', 0);
if ($config['cf_cert_use'] && ($config['cf_cert_simple'] || $config['cf_cert_ipin'] || $config['cf_cert_hp']))
    add_javascript('<script src="'.G5_JS_URL.'/certify.js?v='.G5_JS_VER.'"></script>', 0);
?>

<style>
.register-form .register-box {border:1px solid #ddd}
.register-form .eyoom-form header {padding:20px 15px;background:#fafafa}
.register-form .eyoom-form footer {padding:15px}
.register-form .eyoom-form fieldset {padding:15px}
.register-form .eyoom-form .vc-captcha fieldset {padding:0}
.register-form .border-top {border-top:1px solid #ddd}
.register-form .security-display {display:none}
.register-form .security_0 .security-display, .register-form .security_1 .security-display, .register-form .security_2 .security-display, .register-form .security_3 .security-display, .register-form .security_4 .security-display {display:block}
.register-form .progress-xxs {height:3px;float:none}
.register-form .security_0 .progress-bar {width:10%}
.register-form .security_1 .progress-bar {width:25%}
.register-form .security_2 .progress-bar {width:50%}
.register-form .security_3 .progress-bar {width:75%}
.register-form .security_4 .progress-bar {width:100%}
.register-form .security_0 .progress-e .progress-bar {background:#000}
.register-form .security_1 .progress-e .progress-bar {background:#FF4848}
.register-form .security_2 .progress-e .progress-bar {background:#FF6F42}
.register-form .security_3 .progress-e .progress-bar {background:#FDAB29}
.register-form .security_4 .progress-e .progress-bar {background:#73B852}
.register-form .security_0 .security-heading .float-end:after {content:"매우약함"}
.register-form .security_1 .security-heading .float-end:after {content:"약함"}
.register-form .security_2 .security-heading .float-end:after {content:"보통"}
.register-form .security_3 .security-heading .float-end:after {content:"강함"}
.register-form .security_4 .security-heading .float-end:after {content:"아주강함"}
.register-form .btn-e-cert {padding:7px 12px}
.register-form .frm_label {font-weight:700}
.register-form .sns-wrap-reg {margin-bottom:20px}
.register-form .sns-wrap {text-align:left}
.register-form #reg_mb_icon, .register-form #reg_mb_img {float:inherit}
</style>

<script src="<?php echo EYOOM_THEME_URL; ?>/js/zxcvbn.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/js/jquery.password.strength.js"></script>

<div class="register-form">
    <form name="fregisterform" action="<?php echo $register_action_url; ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="url" value="<?php echo $urlencode; ?>">
    <input type="hidden" name="agree" value="<?php echo $agree; ?>">
    <input type="hidden" name="agree2" value="<?php echo $agree2; ?>">
    <input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
    <input type="hidden" name="cert_no" value="">
    <?php if (isset($member['mb_sex'])) { ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex']; ?>"><?php } ?>
    <?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { ?>
    <input type="hidden" name="mb_nick_default" value="<?php echo $member['mb_nick']; ?>">
    <input type="hidden" name="mb_nick" value="<?php echo $member['mb_nick']; ?>">
    <?php } ?>
    <div class="register-box">
        <header><h5 class="m-0"><strong>사이트 이용정보 입력</strong></h5></header>
        <fieldset>
            <div class="row">
                <section class="col-lg-6">
                    <label for="reg_mb_id" class="label">
                        아이디<strong class="sound_only"> 필수</strong>
                    </label>
                    <label class="input input-button required-mark">
                        <i class="icon-prepend fas fa-user"></i>
                        <input type="text" name="mb_id" value="<?php echo $member['mb_id']; ?>" id="reg_mb_id" <?php if ($w!='') { ?>required readonly<?php } ?> minlength="3" maxlength="20">
                        <?php if ($w=='') { ?>
                        <div class="button" onclick="check_duplication('mb_id');"><input type="button"><i class="fas fa-check text-crimson"></i> 중복체크</div>
                        <?php } ?>
                        <?php if ($w=='') { ?><input type="hidden" name="mb_id_duplicated" id="mb_id_duplicated"><?php } ?>
                        <span id="msg_mb_id"></span>
                    </label>
                    <?php if ($w=='') { ?>
                    <div class="note"><strong>Note:</strong> 아이디 입력 후 <span class="text-crimson">중복체크 필수</span></div>
                    <?php } ?>
                </section>
            </div>
            <div class="row">
                <section class="col-lg-6">
                    <label for="reg_mb_password" class="label">비밀번호<strong class="sound_only"> 필수</strong></label>
                    <label class="input required-mark">
                        <i class="icon-prepend fas fa-lock"></i>
                        <input type="password" name="mb_password" id="reg_mb_password" <?php if ($w!='') { ?>required<?php } ?> minlength="4" maxlength="20">
                    </label>
                </section>
                <section class="col-lg-6">
                    <label for="reg_mb_password_re" class="label">비밀번호 확인<strong class="sound_only"> 필수</strong></label>
                    <label class="input required-mark">
                        <i class="icon-prepend fas fa-lock"></i>
                        <input type="password" name="mb_password_re" id="reg_mb_password_re" <?php if ($w!='') { ?>required<?php } ?> minlength="4" maxlength="20">
                    </label>
                </section>
                <div class="clearfix"></div>
                <div id="pass_meter">
                    <div class="row">
                        <section class="col-lg-6">
                            <div class="security-display">
                                <p class="security-heading"><span>보안강도체크</span> <span class="float-end text-orange"></span></p>
                                <div class="clearfix"></div>
                                <div class="progress progress-e progress-xxs">
                                    <div class="progress-bar progress-bar-e"></div>
                                </div>
                                <div class="note"><strong>Note:</strong> 보안강도는 <span class="text-crimson">보통</span> 이상이어야 합니다.</div>
                            </div>
                        </section>
                        <section class="col-lg-6">
                            <div>
                                <div class="security_text text-crimson"></div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </fieldset>
        <header class="border-top"><h5 class="m-0"><strong>개인정보 입력</strong></h5></header>
        <fieldset>
            <?php if ($config['cf_cert_use']) { ?>
            <div class="row m-b-20">
                <div class="col-lg-12">
                    <?php 
                    $desc_name = '';
                    $desc_phone = '';
                    if ($config['cf_cert_use']) {
                        $desc_name = ' <span class="text-crimson f-w-400">- 본인확인 시 자동입력</span>';
                        $desc_phone = ' <span class="text-crimson f-w-400">- 본인확인 시 자동입력</span>';
                    
                        if (!$config['cf_cert_simple'] && !$config['cf_cert_hp'] && $config['cf_cert_ipin']) {
                            $desc_phone = '';
                        }
                    
                        if ($config['cf_cert_simple']) {
                            echo '<button type="button" id="win_sa_kakao_cert" class="btn-e btn-e-dark btn-e-cert win_sa_cert" data-type="">간편인증</button>'.PHP_EOL;
                        }
                        if ($config['cf_cert_hp'])
                            echo '<button type="button" id="win_hp_cert" class="btn-e btn-e-dark btn-e-cert">휴대폰 본인확인</button>'.PHP_EOL;
                        if ($config['cf_cert_ipin'])
                            echo '<button type="button" id="win_ipin_cert" class="btn-e btn-e-dark btn-e-cert">아이핀 본인확인</button>'.PHP_EOL;
                    
                        echo '<span class="cert_req text-crimson m-l-5">(필수)</span>';
                        echo '<noscript>본인확인을 위해서는 자바스크립트 사용이 가능해야합니다.</noscript>'.PHP_EOL;
                    }
                    ?>
                    <?php
                    if ($config['cf_cert_use'] && $member['mb_certify']) {
                        switch  ($member['mb_certify']) {
                            case "simple": 
                                $mb_cert = "간편인증";
                                break;
                            case "ipin": 
                                $mb_cert = "아이핀";
                                break;
                            case "hp": 
                                $mb_cert = "휴대폰";
                                break;
                        }    
                    ?>
                    <div id="msg_certify" class="text-crimson m-t-10">
                        <strong><?php echo $mb_cert; ?> 본인확인</strong><?php if ($member['mb_adult']) { ?> 및 <strong>성인인증</strong><?php } ?> 완료
                    </div>
                    <?php } ?>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php } ?>
            <div class="row">
                <section class="col-lg-6">
                    <label for="reg_mb_name" class="label">이름<strong class="sound_only">필수</strong><?php echo $desc_name ?></label>
                    <label class="input required-mark">
                        <i class="icon-prepend fas fa-male"></i>
                        <input type="text" name="mb_name" id="reg_mb_name"  value="<?php echo $member['mb_name']; ?>" <?php if ($w!='') { ?>required readonly<?php } ?> size="10">
                    </label>
                </section>
            </div>
            <?php if ($req_nick) { ?>
            <div class="row">
                <section class="col-lg-6">
                    <label for="reg_mb_nick" class="label">
                        닉네임<strong class="sound_only">필수</strong>
                    </label>
                    <label class="input input-button required-mark">
                        <input type="hidden" name="mb_nick_default" value="<?php if (isset($member['mb_nick'])) { ?><?php echo $member['mb_nick']; ?><?php } ?>">
                        <i class="icon-prepend far fa-smile"></i>
                        <input type="text" name="mb_nick" value="<?php if (isset($member['mb_nick'])) { ?><?php echo $member['mb_nick']; ?><?php } ?>" id="reg_mb_nick" required size="10" maxlength="100">
                        <?php if ($w=='') { ?>
                        <div class="button" onclick="check_duplication('mb_nick');"><input type="button"><i class="fas fa-check text-crimson"></i> 중복체크</div>
                        <?php } ?>
                        <?php if ($w=='') { ?><input type="hidden" name="mb_nick_duplicated" id="mb_nick_duplicated"><?php } ?>
                        <span id="msg_mb_nick"></span>
                    </label>
                    <?php if ($w=='') { ?>
                    <div class="note"><strong>Note:</strong> 닉네임 입력 후 <span class="text-crimson">중복체크 필수</span></div>
                    <?php } ?>
                </section>
                <div class="clearfix"></div>
                <section class="col-lg-12">
                    <div class="alert alert-warning m-t-15">
                        <strong>Note:</strong> 공백없이 한글,영문,숫자만 입력 가능 (한글2자, 영문4자 이상) | 닉네임을 바꾸시면 앞으로 <?php echo $config['cf_nick_modify']*1; ?>일 이내에는 변경 할 수 없습니다.
                    </div>
                </section>
            </div>
            <?php } ?>
            <div class="row">
                <section class="col-lg-6">
                    <label for="reg_mb_email" class="label">
                        이메일<strong class="sound_only"> 필수</strong>
                    </label>
                    <label class="input input-button required-mark">
                        <input type="hidden" name="old_email" value="<?php echo $member['mb_email']; ?>">
                        <i class="icon-prepend far fa-envelope"></i>
                        <input type="text" name="mb_email" value="<?php if (isset($member['mb_email'])) { ?><?php echo $member['mb_email']; ?><?php } ?>" id="reg_mb_email" required size="70" maxlength="100">
                        <?php if ($w=='') { ?>
                        <div class="button" onclick="check_duplication('mb_email');"><input type="button"><i class="fas fa-check text-crimson"></i> 중복체크</div>
                        <?php } ?>
                        <?php if ($w=='') { ?><input type="hidden" name="mb_email_duplicated" id="mb_email_duplicated"><?php } ?>
                    </label>
                    <?php if ($w=='') { ?>
                    <div class="note m-b-15"><strong>Note:</strong> 이메일 입력 후 <span class="text-crimson">중복체크 필수</span></div>
                    <?php } ?>
                </section>
                <?php if ($config['cf_use_email_certify']) { ?>
                <div class="col-lg-12">
                    <div class="alert alert-warning m-t-15">
                        <strong>Note:</strong> <?php if ($w=='') { ?>E-mail 로 발송된 내용을 확인한 후 인증하셔야 회원가입이 완료됩니다.<?php } ?><?php if ($w=='u') { ?>E-mail 주소를 변경하시면 다시 인증하셔야 합니다.<?php } ?>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="row">
                <?php if ($config['cf_use_homepage']) { ?>
                <section class="col-lg-4">
                    <label for="reg_mb_homepage" class="label">홈페이지<?php if ($config['cf_req_homepage']) { ?><strong class="sound_only">필수</strong><?php } ?></label>
                    <label class="input <?php if ($config['cf_req_homepage']) { ?>required-mark<?php } ?>">
                        <i class="icon-prepend fas fa-home"></i>
                        <input type="text" name="mb_homepage" value="<?php echo $member['mb_homepage']; ?>" id="reg_mb_homepage" <?php if ($config['cf_req_homepage']) { ?>required<?php } ?> size="70" maxlength="255">
                    </label>
                </section>
                <?php } ?>
                <?php if ($config['cf_use_tel']) { ?>
                <section class="col-lg-4">
                    <label for="reg_mb_tel" class="label">전화번호<?php if ($config['cf_req_tel']) { ?><strong class="sound_only">필수</strong><?php } ?></label>
                    <label class="input <?php if ($config['cf_req_tel']) { ?>required-mark<?php } ?>">
                        <i class="icon-prepend fas fa-phone"></i>
                        <input type="text" name="mb_tel" value="<?php echo $member['mb_tel']; ?>" id="reg_mb_tel" <?php if ($config['cf_req_tel']) { ?>required<?php } ?> maxlength="20">
                    </label>
                </section>
                <?php } ?>
                <?php if ($config['cf_use_hp'] || ($config['cf_cert_use'] && $config['cf_cert_hp'])) { ?>
                <section class="col-lg-4">
                    <label for="reg_mb_hp" class="label">휴대폰번호<?php if ($config['cf_req_hp']) { ?><strong class="sound_only">필수</strong><?php } ?><?php echo $desc_phone ?></label>
                    <label class="input <?php if ($config['cf_req_hp']) { ?>required-mark<?php } ?>">
                        <i class="icon-prepend fas fa-mobile-alt"></i>
                        <input type="text" name="mb_hp" value="<?php echo $member['mb_hp']; ?>" id="reg_mb_hp" <?php if ($config['cf_req_hp']) { ?>required<?php } ?> maxlength="20">
                        <?php if ($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
                        <input type="hidden" name="old_mb_hp" value="<?php echo $member['mb_hp']; ?>">
                        <?php } ?>
                    </label>
                </section>
                <?php } ?>
            </div>
            <?php if ($config['cf_use_addr']) { ?>
            <div class="row">
                <div class="col-lg-12">
                    <label for="reg_mb_hp" class="label m-l-5">주소<?php if ($config['cf_req_addr']) { ?><strong class="sound_only">필수</strong><?php } ?></label>
                </div>
                <div class="col-lg-6">
                    <label for="reg_mb_zip" class="sound_only">우편번호<?php if ($config['cf_req_addr']) { ?><strong class="sound_only"> 필수</strong><?php } ?></label>
                    <label class="input <?php if ($config['cf_req_addr']) { ?>required-mark<?php } ?>">
                        <i class="icon-append fas fa-question-circle"></i>
                        <input type="text" name="mb_zip" value="<?php echo $member['mb_zip1']; ?><?php echo $member['mb_zip2']; ?>" id="reg_mb_zip" <?php if ($config['cf_req_addr']) { ?>required<?php } ?> size="5" maxlength="6">
                        <b class="tooltip tooltip-top-right">우편번호 (주소 검색 버튼을 클릭하여 조회)</b>
                    </label>
                </div>
                <div class="col-lg-6">
                    <button type="button" onclick="win_zip('fregisterform', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');" class="btn-e btn-e-lg btn-e-indigo address-search-btn">주소 검색</button>
                </div>
                <div class="clearfix m-b-15"></div>
                <div class="col-lg-12">
                    <label class="input <?php if ($config['cf_req_addr']) { ?>required-mark<?php } ?>">
                        <input type="text" name="mb_addr1" value="<?php echo $member['mb_addr1']; ?>" id="reg_mb_addr1" <?php if ($config['cf_req_addr']) { ?>required<?php } ?> size="50">
                    </label>
                    <div class="note m-b-15"><strong>Note:</strong> 기본주소<?php if ($config['cf_req_addr']) { ?><strong class="sound_only"> 필수</strong><?php } ?></div>
                </div>
                <div class="clear"></div>
                <div class="col-lg-6">
                    <label class="input">
                        <input type="text" name="mb_addr2" value="<?php echo $member['mb_addr2']; ?>" id="reg_mb_addr2" size="50">
                    </label>
                    <div class="note m-b-15"><strong>Note:</strong> 상세주소</div>
                </div>
                <div class="col-lg-6">
                    <label class="input">
                        <input type="text" name="mb_addr3" value="<?php echo $member['mb_addr3']; ?>" id="reg_mb_addr3" size="50" readonly="readonly">
                    </label>
                    <div class="note m-b-15"><strong>Note:</strong> 참고항목</div>
                </div>
                <input type="hidden" name="mb_addr_jibeon" value="<?php echo $member['mb_addr_jibeon']; ?>">
            </div>
            <?php } ?>
        </fieldset>
        <header class="border-top"><h5 class="m-0"><strong>기타 개인설정</strong></h5></header>
        <fieldset>
            <?php if ($config['cf_use_signature']) { ?>
            <div class="row">
                <section class="col-lg-12">
                    <label for="reg_mb_signature" class="label">서명<?php if ($config['cf_req_signature']) { ?><strong class="sound_only">필수</strong><?php } ?></label>
                    <label class="textarea textarea-resizable <?php if ($config['cf_req_signature']) { ?>required-mark<?php } ?>">
                        <textarea name="mb_signature" id="reg_mb_signature" rows="5" <?php if ($config['cf_req_signature']) { ?>required<?php } ?>><?php echo $member['mb_signature']; ?></textarea>
                    </label>
                </section>
            </div>
            <?php } ?>
            <?php if ($config['cf_use_profile']) { ?>
            <div class="row">
                <section class="col-lg-12">
                    <label for="reg_mb_profile" class="label">자기소개</label>
                    <label class="textarea textarea-resizable <?php if ($config['cf_req_profile']) { ?>required-mark<?php } ?>">
                        <textarea name="mb_profile" id="reg_mb_profile" rows="5" <?php if ($config['cf_req_profile']) { ?>required<?php } ?>><?php echo $member['mb_profile']; ?></textarea>
                    </label>
                </section>
            </div>
            <?php } ?>
            <?php if ($config['cf_use_member_icon'] && $member['mb_level'] >= $config['cf_icon_level']) {  ?>
            <div class="row">
                <section class="col-lg-12">
                    <label for="reg_mb_icon" class="label">회원아이콘</label>
                    <div class="input m-b-10">
                        <input type="file" class="form-control" id="reg_mb_icon" name="mb_icon" value="파일선택">
                    </div>
                    <div class="clearfix"></div>
                    <?php if ($w == 'u' && file_exists($mb_icon_path)) {  ?>
                    <img src="<?php echo $mb_icon_url ?>" alt="회원아이콘" class="float-start m-r-10">
                    <label class="checkbox float-start p-l-20"><input type="checkbox" name="del_mb_icon" value="1" id="del_mb_icon"><i></i>삭제</label>
                    <div class="clearfix"></div>
                    <?php }  ?>
                    <div class="note m-b-10"><strong>Note:</strong> 이미지 크기는 가로 <?php echo $config['cf_member_icon_width'] ?>픽셀, 세로 <?php echo $config['cf_member_icon_height'] ?>픽셀 이하로 해주세요.<br>gif, jpg, png파일만 가능하며 용량 <?php echo number_format($config['cf_member_icon_size']) ?>바이트 이하만 등록됩니다.</div>
                </section>
            </div>
            <?php } ?>
            <?php if ($member['mb_level'] >= $config['cf_icon_level'] && $config['cf_member_img_size'] && $config['cf_member_img_width'] && $config['cf_member_img_height']) {  ?>
            <div class="row">
                <section class="col-lg-12">
                    <label for="reg_mb_img" class="label">회원이미지</label>
                    <div class="input m-b-10">
                        <input type="file" class="form-control" id="reg_mb_img" name="mb_img" value="파일선택">
                    </div>
                    <div class="clearfix"></div>
                    <?php if ($w == 'u' && file_exists($mb_img_path)) {  ?>
                    <img src="<?php echo $mb_img_url ?>" alt="회원이미지" class="float-start m-r-10">
                    <label class="checkbox float-start p-l-20"><input type="checkbox" name="del_mb_img" value="1" id="del_mb_img"><i></i>삭제</label>
                    <div class="clearfix"></div>
                    <?php }  ?>
                    <div class="note m-b-10"><strong>Note:</strong> 이미지 크기는 가로 <?php echo $config['cf_member_img_width'] ?>픽셀, 세로 <?php echo $config['cf_member_img_height'] ?>픽셀 이하로 해주세요.<br>gif, jpg, png파일만 가능하며 용량 <?php echo number_format($config['cf_member_img_size']) ?>바이트 이하만 등록됩니다.</div>
                </section>
            </div>
            <div class="margin-hr-15"></div>
            <?php } ?>
            <div class="row">
                <section class="col-lg-6">
                    <label for="reg_mb_mailling" class="label">메일링서비스</label>
                    <label class="checkbox">
                        <input type="checkbox" name="mb_mailling" value="1" id="reg_mb_mailling" <?php if ($w=='' || $member['mb_mailling']) { ?>checked<?php } ?>><i></i>정보 메일을 받겠습니다.
                    </label>
                </section>
                <?php if ($config['cf_use_hp']) { ?>
                <section class="col-lg-6">
                    <label for="reg_mb_sms" class="label">SMS 수신여부</label>
                    <label class="checkbox">
                        <input type="checkbox" name="mb_sms" value="1" id="reg_mb_sms" <?php if ($w=='' || $member['mb_sms']) { ?>checked<?php } ?>><i></i>휴대폰 문자메세지를 받겠습니다.
                    </label>
                </section>
                <?php } ?>
            </div>
            <div class="row">
                <?php if (isset($member['mb_open_date']) && $member['mb_open_date'] <= date("Y-m-d", G5_SERVER_TIME - ($config['cf_open_modify'] * 86400)) || empty($member['mb_open_date']) ) { ?>
                <section class="col-lg-6">
                    <label for="reg_mb_open" class="label">정보공개</label>
                    <label class="checkbox">
                        <input type="checkbox" name="mb_open" value="1" <?php if ($w=='' || $member['mb_open']) { ?>checked<?php } ?> id="reg_mb_open"><i></i>다른분들이 나의 정보를 볼 수 있도록 합니다.
                        <input type="hidden" name="mb_open_default" value="<?php echo $member['mb_open']; ?>">
                    </label>
                    <div class="note m-b-10"><strong>Note:</strong> 정보공개를 바꾸시면 앞으로 <?php echo $config['cf_open_modify']*1; ?>일 이내에는 변경이 안됩니다.</div>
                </section>
                <?php } else { ?>
                <section class="col-lg-6">
                    <label for="reg_mb_open" class="label">정보공개</label>
                    <label class="checkbox">
                        <input type="hidden" name="mb_open" value="<?php echo $member['mb_open']; ?>">
                    </label>
                    <div class="note m-b-10"><strong>Note:</strong> 정보공개는 수정후 <?php $config['cf_open_modify']*1; ?>일 이내, <?php echo $open_day; ?> 까지는 변경이 안됩니다.<br>이렇게 하는 이유는 잦은 정보공개 수정으로 인하여 쪽지를 보낸 후 받지 않는 경우를 막기 위해서 입니다.</div>
                </section>
                <?php } ?>
                <?php if ($w=='' && $config['cf_use_recommend']) { ?>
                <section class="col-lg-6">
                    <label for="reg_mb_recommend" class="label">추천인아이디</label>
                    <label class="input">
                        <i class="icon-prepend fas fa-user"></i>
                        <i class="icon-append fas fa-question-circle"></i>
                        <input type="text" name="mb_recommend" id="reg_mb_recommend">
                        <b class="tooltip tooltip-top-right">추천인 아이디를 남겨주세요.</b>
                    </label>
                </section>
                <?php } ?>
                <?php if ($w=='u' && function_exists('social_member_provider_manage')) { ?>
                <ul class="list-unstyle">
                    <?php echo social_member_provider_manage(); ?>
                </ul>
                <?php } ?>
            </div>
            <div class="row">
                <section class="col-lg-12">
                    <label class="label">자동등록방지</label>
                    <div class="vc-captcha"><?php echo captcha_html(); ?></div>
                </section>
            </div>
        </fieldset>

        <footer class="text-center">
            <?php if ($w=='u') { ?>
            <button type="button" value="회원탈퇴" id="btn_remove" class="btn-e btn-e-xl btn-e-gray" onclick="member_leave();">회원탈퇴</button>
            <?php } ?>
            <button type="submit" value="<?php if ($w=='') { ?>회원가입<?php } else { ?>정보수정<?php } ?>" id="btn_submit" class="btn-e btn-e-xl btn-e-navy" accesskey="s"><?php if ($w=='') { ?>회원가입<?php } else { ?>정보수정<?php } ?></button>
        </footer>
    </div>
    </form>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
$(function() {
    $("#reg_zip_find").css("display", "inline-block");
    var pageTypeParam = "pageType=register";

	<?php if($config['cf_cert_use'] && $config['cf_cert_simple']) { ?>
	// 이니시스 간편인증
	var url = "<?php echo G5_INICERT_URL; ?>/ini_request.php";
	var type = "";    
    var params = "";
    var request_url = "";

	$(".win_sa_cert").click(function() {
        if(!cert_confirm()) return false;
        type = $(this).data("type");
        params = "?directAgency=" + type + "&" + pageTypeParam;
        request_url = url + params;
        call_sa(request_url);
    });
    <?php } ?>

    <?php if ($config['cf_cert_use'] && $config['cf_cert_ipin']) { ?>
    // 아이핀인증
    var params = "";
    $("#win_ipin_cert").click(function() {
        if(!cert_confirm()) return false;
        params = "?" + pageTypeParam;
        var url = "<?php echo G5_OKNAME_URL; ?>/ipin1.php"+params;
        certify_win_open('kcb-ipin', url);
        return;
    });
    <?php } ?>

    <?php if ($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
    // 휴대폰인증
    var params = "";
    $("#win_hp_cert").click(function() {
        if(!cert_confirm()) return false;
        params = "?" + pageTypeParam;
        <?php     
        switch($config['cf_cert_hp']) {
            case 'kcb':                    
                $cert_url = G5_OKNAME_URL.'/hpcert1.php';
                $cert_type = 'kcb-hp';
                break;
            case 'kcp':
                $cert_url = G5_KCPCERT_URL.'/kcpcert_form.php';
                $cert_type = 'kcp-hp';
                break;
            case 'lg':
                $cert_url = G5_LGXPAY_URL.'/AuthOnlyReq.php';
                $cert_type = 'lg-hp';
                break;
            default:
                echo 'alert("기본환경설정에서 휴대폰 본인확인 설정을 해주십시오");';
                echo 'return false;';
                break;
        }
        ?>            
        certify_win_open("<?php echo $cert_type; ?>", "<?php echo $cert_url; ?>"+params);
        return;
    });
    <?php } ?>
});

// 인증체크
function cert_confirm()
{
    var val = document.fregisterform.cert_type.value;
    var type;

    switch(val) {
        case "simple":
            type = "간편인증";
            break;
        case "ipin":
            type = "아이핀";
            break;
        case "hp":
            type = "휴대폰";
            break;
        default:
            return true;
    }

    if(confirm("이미 "+type+"으로 본인확인을 완료하셨습니다.\n\n이전 인증을 취소하고 다시 인증하시겠습니까?"))
        return true;
    else
        return false;
}

// submit 최종 폼체크
function fregisterform_submit(f)
{
    // 회원아이디 검사
    if (f.w.value == "") {
        var msg = reg_mb_id_check();
        if (msg) {
            Swal.fire({
                title: "중요!",
                text: msg,
                confirmButtonColor: "#ab0000",
                icon: "error",
                confirmButtonText: "확인"
            });
            f.mb_id.select();
            return false;
        }
    }
    <?php if ($w=='') { ?>
    if (f.mb_id_duplicated.value != 'y') {
        Swal.fire({
            title: "중요!",
            text: "아이디 중복검사를 하셔야 합니다.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.mb_id.select();
        return false;
    }
    <?php } ?>

    if (f.w.value == "") {
        if (f.mb_password.value.length < 4) {
            Swal.fire({
                title: "중요!",
                text: "비밀번호를 4글자 이상 입력하십시오.",
                confirmButtonColor: "#ab0000",
                icon: "warning",
                confirmButtonText: "확인"
            });
            f.mb_password.focus();
            return false;
        }
    }

    if (f.mb_password.value != f.mb_password_re.value) {
        Swal.fire({
            title: "중요!",
            text: "비밀번호가 같지 않습니다.",
            confirmButtonColor: "#ab0000",
            type: "error",
            confirmButtonText: "확인"
        });
        f.mb_password_re.focus();
        return false;
    }

    if (f.mb_password.value.length > 0) {
        if (f.mb_password_re.value.length < 4) {
            Swal.fire({
                title: "중요!",
                text: "비밀번호를 4글자 이상 입력하십시오.",
                confirmButtonColor: "#ab0000",
                icon: "warning",
                confirmButtonText: "확인"
            });
            f.mb_password_re.focus();
            return false;
        }
    }

    // 비밀번호 강도체크
    var pass_strength = $("#pass_meter").attr("class");
    if (!pass_strength || pass_strength == 'security_0' || pass_strength == 'security_1') {
        Swal.fire({
            title: "중요!",
            text: "비밀번호의 강도는 '보통' 이상이여야 합니다.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.mb_password.focus();
        return false;
    }

    // 이름 검사
    if (f.w.value=="") {
        if (f.mb_name.value.length < 1) {
            Swal.fire({
                title: "중요!",
                text: "이름을 입력하십시오.",
                confirmButtonColor: "#ab0000",
                icon: "error",
                confirmButtonText: "확인"
            });
            f.mb_name.focus();
            return false;
        }

        /*
        var pattern = /([^가-힣\x20])/i;
        if (pattern.test(f.mb_name.value)) {
            swal({
                title: "중요!",
                text: "이름은 한글로 입력하십시오.",
                confirmButtonColor: "#FDAB29",
                type: "warning",
                confirmButtonText: "확인"
            });
            f.mb_name.select();
            return false;
        }
        */
    }

    <?php if ($w=='' && $config['cf_cert_use'] && $config['cf_cert_req']) { ?>
    // 본인확인 체크
    if (f.cert_no.value=="") {
        Swal.fire({
            title: "중요!",
            text: "회원가입을 위해서는 본인확인을 해주셔야 합니다.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        return false;
    }
    <?php } ?>

    // 닉네임 검사
    if ((f.w.value == "") || (f.w.value == "u" && f.mb_nick.defaultValue != f.mb_nick.value)) {
        var msg = reg_mb_nick_check();
        if (msg) {
            Swal.fire({
                title: "중요!",
                text: msg,
                confirmButtonColor: "#ab0000",
                icon: "warning",
                confirmButtonText: "확인"
            });
            f.reg_mb_nick.select();
            return false;
        }
    }
    <?php if ($w=='') { ?>
    if (f.mb_nick_duplicated.value != 'y') {
        Swal.fire({
            title: "중요!",
            text: "닉네임 중복검사를 하셔야 합니다.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.reg_mb_nick.select();
        return false;
    }
    <?php } ?>


    // E-mail 검사
    if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
        var msg = reg_mb_email_check();
        if (msg) {
            Swal.fire({
                title: "중요!",
                text: msg,
                confirmButtonColor: "#ab0000",
                icon: "error",
                confirmButtonText: "확인"
            });
            f.reg_mb_email.select();
            return false;
        }
    }

    <?php if ($w=='') { ?>
    if (f.mb_email_duplicated.value != 'y') {
        Swal.fire({
            title: "중요!",
            text: "이메일 중복검사를 하셔야 합니다.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.reg_mb_email.select();
        return false;
    }
    <?php } ?>

    <?php if (($config['cf_use_hp'] || $config['cf_cert_hp']) && $config['cf_req_hp']) { ?>
    // 휴대폰번호 체크
    var msg = reg_mb_hp_check();
    if (msg) {
        Swal.fire({
            title: "중요!",
            text: msg,
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.reg_mb_hp.select();
        return false;
    }
    <?php } ?>

    if (typeof(f.mb_recommend) != "undefined" && f.mb_recommend.value) {
        if (f.mb_id.value == f.mb_recommend.value) {
            Swal.fire({
                title: "중요!",
                text: "본인을 추천할 수 없습니다.",
                confirmButtonColor: "#ab0000",
                icon: "error",
                confirmButtonText: "확인"
            });
            f.mb_recommend.focus();
            return false;
        }

        var msg = reg_mb_recommend_check();
        if (msg) {
            Swal.fire({
                title: "중요!",
                text: msg,
                confirmButtonColor: "#ab0000",
                icon: "warning",
                confirmButtonText: "확인"
            });
            f.mb_recommend.select();
            return false;
        }
    }

    <?php chk_captcha_js(); ?>

    document.getElementById("btn_submit").disabled = "disabled";

    return true;
}

function check_duplication(target) {
    switch(target) {
        case 'mb_id':
            var mb_id = $('#reg_mb_id').val();
            if (!mb_id) {
                alert('아이디를 입력해 주세요.');
                return false;
            }
            var msg = reg_mb_id_check();
            if (msg) {
                Swal.fire({
                    title: "중요!",
                    text: msg,
                    confirmButtonColor: "#ab0000",
                    icon: "error",
                    confirmButtonText: "확인"
                });
                $("#reg_mb_id").focus();
                $("#reg_mb_id").select();
                return false;
            } else {
                Swal.fire({
                    title: "OK!",
                    text: "사용가능한 아이디입니다.",
                    confirmButtonColor: "#00897b",
                    icon: "success",
                    confirmButtonText: "확인"
                });
                $("#reg_mb_id").attr('readonly','true');
                $("#mb_id_duplicated").val('y');
                $("#reg_mb_id").css('background','#f5f5f5');
            }
            break;
        case 'mb_nick':
            var mb_nick = $('#reg_mb_nick').val();
            if (!mb_nick) {
                alert('닉네임을 입력해 주세요.');
                return false;
            }
            var msg = reg_mb_nick_check();
            if (msg) {
                Swal.fire({
                    title: "중요!",
                    text: msg,
                    confirmButtonColor: "#ab0000",
                    icon: "error",
                    confirmButtonText: "확인"
                });
                $("#reg_mb_nick").focus();
                $("#reg_mb_nick").select();
                return false;
            } else {
                Swal.fire({
                    title: "OK!",
                    text: "사용가능한 닉네임입니다.",
                    confirmButtonColor: "#00897b",
                    icon: "success",
                    confirmButtonText: "확인"
                });
                $("#reg_mb_nick").attr('readonly','true');
                $("#mb_nick_duplicated").val('y');
                $("#reg_mb_nick").css('background','#f5f5f5');
            }
            break;
        case 'mb_email':
            var mb_email = $('#reg_mb_email').val();
            if (!mb_email) {
                alert('이메일을 입력해 주세요.');
                return false;
            }
            var msg = reg_mb_email_check();
            if (msg) {
                Swal.fire({
                    title: "중요!",
                    text: msg,
                    confirmButtonColor: "#ab0000",
                    icon: "error",
                    confirmButtonText: "확인"
                });
                $("#reg_mb_email").focus();
                $("#reg_mb_email").select();
                return false;
            } else {
                Swal.fire({
                    title: "OK!",
                    text: "사용가능한 이메일입니다.",
                    confirmButtonColor: "#00897b",
                    icon: "success",
                    confirmButtonText: "확인"
                });
                $("#reg_mb_email").attr('readonly','true');
                $("#mb_email_duplicated").val('y');
                $("#reg_mb_email").css('background','#f5f5f5');
            }
            break;
    }
}
<?php if ($w=='u') { ?>
function member_leave() {  // 회원 탈퇴 tto
    Swal.fire({
        title: "중요!",
        html: "<div class='alert alert-warning'>회원 탈퇴를 하시면 모든 포인트와 경험치가 삭제되며, 복구할 수 없습니다.</div><span>정말로 회원 탈퇴를 하시겠습니까?</span>",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#ab0000",
        confirmButtonText: "탈퇴",
        cancelButtonText: "취소"
    }).then((result) => {
        if (result.isConfirmed) {
            location.href = '<?php echo G5_BBS_URL; ?>/member_confirm.php?url=member_leave.php';
        }
    });
}
<?php } ?>

// 암호강도체크
$(function() {
    $("#reg_mb_password").keyup(function() {
        initializeStrengthMeter();
    });

    $("#reg_mb_password_re").keyup(function() {
        initializeStrengthMeter();
    });
});

function initializeStrengthMeter() {
    $("#pass_meter").PasswordStrengthManager({
        password: $("#reg_mb_password").val(),
        confirm_pass : $("#reg_mb_password_re").val(),
        minChars : $("#reg_mb_password").attr("minlength"),
        maxChars : $("#reg_mb_password").attr("maxlength"),
        blackList : []
    });
}

<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$is_iphone = (strpos($user_agent, 'iPhone') !== false);
$is_ipad = (strpos($user_agent, 'iPad') !== false);

if ($is_iphone || $is_ipad) {
?>
$(document).ready(function(){
    var touchStartTimestamp = 0;
    
    $("input, textarea, select").on('touchstart', function(event) {
        zoomDisable();
        touchStartTimestamp = event.timeStamp;
    });

    $("input, textarea, select").on('touchend', function(event) {
        var touchEndTimestamp = event.timeStamp;
        if (touchEndTimestamp - touchStartTimestamp > 500) {
            setTimeout(zoomEnable, 500);
        } else {
            zoomDisable();
            setTimeout(zoomEnable, 500);
        }
    });

    function zoomDisable(){
        $('head meta[name=viewport]').remove();
        $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">');
    }

    function zoomEnable(){
        $('head meta[name=viewport]').remove();
        $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1">');
    }
});
<?php } ?>
</script>