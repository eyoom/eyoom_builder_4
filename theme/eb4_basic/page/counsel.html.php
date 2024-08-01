<?php
/**
 * page file : /theme/THEME_NAME/page/counsel.html.php
 */
if (!defined('_EYOOM_')) exit;

// 상담 신청 기능 사용유무 체크
if (!$config['cf_use_counsel']) alert("사용하지 않는 기능입니다.");

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/perfect-scrollbar/perfect-scrollbar.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert2/sweetalert2.min.css" type="text/css" media="screen">',0);

$action_url = EYOOM_CORE_URL.'/page/proc/counsel_update.php';

include_once(G5_EDITOR_LIB);
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

$captcha_html = '';
$captcha_js   = '';
$is_use_captcha = 1;

if ($is_use_captcha) {
    $captcha_html = captcha_html();
    $captcha_js   = chk_captcha_js();
}

$is_dhtml_editor = false;
$is_dhtml_editor_use = true;
$editor_content_js = '';
if(!is_mobile() || defined('G5_IS_MOBILE_DHTML_USE') && G5_IS_MOBILE_DHTML_USE)
    $is_dhtml_editor_use = true;

// 모바일에서는 G5_IS_MOBILE_DHTML_USE 설정에 따라 DHTML 에디터 적용
if ($config['cf_editor'] && $is_dhtml_editor_use) {
    $is_dhtml_editor = true;
}

$editor_html = editor_html('cs_content', $content, $is_dhtml_editor);
$editor_js = '';
$editor_js .= get_editor_js('cs_content', $is_dhtml_editor);
$editor_js .= chk_editor_js('cs_content', $is_dhtml_editor);

// 상담 분야
$counsel_part = explode(',', $config['cf_counsel_part']);
?>

<style>
.counsel-wrap .counsel-title {border-bottom:1px solid #d5d5d5;padding-bottom:20px;margin-bottom:20px}
.counsel-wrap .counsel-title h3 {font-size:1.875rem;font-weight:800}
.counsel-wrap .counsel-title p {margin-top:10px}
.counsel-wrap .cs-form-wrap {position:relative}
.counsel-wrap .cs-goods-box {position:absolute;top:39px;bottom:0;left:0;right:10px;border:1px solid #d5d5d5;padding:15px}
.counsel-wrap .cs-goods-box div.row {position:relative;margin-left:-5px;margin-right:-5px}
.counsel-wrap .cs-goods-box div.row:after {content:"";display:block;clear:both}
.counsel-wrap .cs-goods-box .cs-goods {border:1px solid #e5e5e5;padding:20px 10px 10px;margin-bottom:15px}
.counsel-wrap .cs-goods-box .cs-goods-name {margin-top:10px;font-size:.9375rem}
.counsel-wrap .cs-goods-box .cs-goods .checkbox {margin-bottom:0;padding-left:0;z-index:1}
.counsel-wrap .cs-goods-box .cs-goods .checkbox i {top:-10px}
.counsel-wrap #cs_scroll {position:relative;overflow:hidden;height:204px;font-size:.8125rem}
.counsel-wrap .cs-agree-box {border:1px solid #ddd;margin-bottom:30px}
.counsel-wrap .eyoom-form header {padding:20px 15px;background:#fafafa}
.counsel-wrap .eyoom-form header h5 {line-height:1;font-size:1rem}
.counsel-wrap .eyoom-form footer {padding:12px 15px;text-align:right}
.counsel-wrap .eyoom-form fieldset {padding:0}
.counsel-wrap .eyoom-form fieldset {padding:0}
.counsel-wrap .eyoom-form .inline-group .radio {margin-left:5px;margin-right:5px;padding-left:0}
.counsel-wrap .eyoom-form .radio i {position:relative;top:inherit;left:inherit;display:block;margin:0 auto 1px}
.counsel-wrap .eyoom-form .radio-text-block {display:block;font-size:.8125rem}
.counsel-wrap .cs-agree {padding:15px}
.counsel-wrap .cs-agree h5 {font-size:.9375rem}
.counsel-wrap .csregister-agree label {display:inline-block;margin-right:5px}
.counsel-wrap .cs-form-title {font-size:1rem;font-weight:700;margin-bottom:20px}
.counsel-wrap .cs-mobile-btn {margin-top:30px;display:none}
@media (max-width:991px) {
    .counsel-wrap .cs-search-wrap {width:100%;padding-right:0;margin-bottom:30px}
    .counsel-wrap .cs-form-wrap {width:100%;padding-left:0}
    .counsel-wrap .cs-goods-box {position:relative;overflow:hidden;top:inherit;bottom:inherit;left:inherit;right:inherit;border:0;padding:0}
    .counsel-wrap .cs-mobile-btn {display:block}
}
@media (max-width:576px) {
    .counsel-wrap .eyoom-form .col {margin-bottom:0}
}
</style>

<div class="sub-page page-counsel">
    <div class="counsel-wrap">
        <div class="counsel-title">
            <h3>상담 신청</h3>
            <p>상담 신청 내용을 남겨주시면 빠른 시간 내 연락 드리도록 하겠습니다.</p>
        </div>
        
        <form name="csregister" id="csregister" action="<?php echo $action_url; ?>" onsubmit="return csregister_submit(this);" method="POST" enctype="multipart/form-data" class="eyoom-form">

        <div class="cs-form-wrap">
            <h5 class="cs-form-title">상담 전 아래 내용을 기입 해 주시기 바랍니다.</h5>
            <div class="row m-b-10">
                <div class="col col-6">
                    <label class="select required-mark">
                        <select name="cs_part" id="cs_part" required>
                            <option value="">상담분야 선택</option>
                            <?php foreach ($counsel_part as $k => $part) { ?>
                            <option value="<?php echo trim($part); ?>"><?php echo $part; ?></option>
                            <?php } ?>
                        </select><i></i>
                    </label>
                </div>
                <div class="col col-6">
                    <label class="input required-mark">
                        <i class="icon-append far fa-building"></i>
                        <input type="text" name="cs_company" placeholder="회사명(단체명)" required>
                    </label>
                </div>
            </div>
            <div class="row m-b-10">
                <div class="col col-6">
                    <label class="input required-mark">
                        <i class="icon-append far fa-user"></i>
                        <input type="text" name="cs_name" placeholder="이름" required>
                    </label>
                </div>
                <div class="col col-6">
                    <label class="input required-mark">
                        <i class="icon-append fas fa-phone"></i>
                        <input type="text" name="cs_tel" placeholder="연락처" required>
                    </label>
                </div>
            </div>
            <div class="row m-b-10">
                <div class="col col-12">
                    <label class="input required-mark">
                        <i class="icon-append far fa-envelope"></i>
                        <input type="text" name="cs_email" placeholder="이메일" required>
                    </label>
                </div>
            </div>
            <div class="row m-b-10">
                <div class="col col-12">
                    <label class="input required-mark">
                        <i class="icon-append fas fa-pencil-alt"></i>
                        <input type="text" name="cs_subject" placeholder="제목" required>
                    </label>
                </div>
            </div>
            <h6 class="f-s-16r f-w-700 m-b-5">상담 내용</h6>
            <label class="textarea required-mark m-b-30">
                <?php echo $editor_html; ?>
            </label>
            <div class="m-b-20">
                <?php for ($i=0; $i<2; $i++) { ?>
                <div class="row">
                    <div class="col col-12">
                        <label class="input">
                            <input type="file" class="form-control" id="cs_file_<?php echo $i+1 ?>" name="cs_file[]" value="사진선택">
                        </label>
                    </div>
                </div>
                <?php } ?>
            </div>

            <div class="cs-agree-box m-b-30">
                <header><h5 class="m-0 f-w-700">개인정보처리방침안내</h5></header>
                <div class="cs-agree">
                    <div id="cs_scroll" class="panel-body ps-container">
                        <?php
                        @include_once(EYOOM_THEME_PATH . '/page/privacy.html.php')
                        ?>
                    </div>
                </div>
                <footer>
                    <fieldset class="csregister-agree">
                        <label class="checkbox" for="cs_agree">
                            <input type="checkbox" name="cs_agree" value="1" id="cs_agree"><i></i>개인정보처리방침안내의 내용에 동의합니다.
                        </label>
                    </fieldset>
                </footer>
            </div>

            <?php if ($is_use_captcha) { ?>
            <div class="m-b-30">
                <label class="label">자동등록방지</label>
                <div class="vc-captcha"><?php echo $captcha_html; ?></div>
            </div>
            <?php } ?>
            
            <div class="text-center">
                <button class="btn-e btn-e-navy btn-e-xxl width-250px f-w-700" type="submit" value="상담 신청하기">상담 신청하기</button>
            </div>
        </div>
        
        </form>
    </div>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/perfect-scrollbar/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
$(document).ready(function(){
    new PerfectScrollbar('#cs_scroll');
});

function csregister_submit(f) {
    if ($("select[name=cs_part]").val() == '') {
        Swal.fire({
            title: "중요!",
            text: "문의 분야를 선택해 주세요.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.cs_part.focus();
        return false;
    }

    if (f.cs_company.value == '') {
        Swal.fire({
            title: "중요!",
            text: "회사명을 입력해 주세요.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.cs_company.focus();
        return false;
    }

    if (f.cs_name.value == '') {
        Swal.fire({
            title: "중요!",
            text: "이름을 입력해 주세요.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.cs_name.focus();
        return false;
    }

    if (f.cs_tel.value == '') {
        Swal.fire({
            title: "중요!",
            text: "휴대전화를 입력해 주세요.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.cs_tel.focus();
        return false;
    }

    if (f.cs_email.value == '') {
        Swal.fire({
            title: "중요!",
            text: "이메일을 입력해 주세요.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.cs_email.focus();
        return false;
    }

    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailPattern.test(f.cs_email.value)) {
        Swal.fire({
            title: "중요!",
            text: "유효하지 않은 이메일 주소입니다.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.cs_email.focus();
        return false;
    }

    if (f.cs_subject.value == '') {
        Swal.fire({
            title: "중요!",
            text: "제목을 입력해 주세요.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.cs_subject.focus();
        return false;
    }

    <?php echo $editor_js; ?>
    <?php echo $captcha_js; ?>

    if (f.cs_content.value == '') {
        Swal.fire({
            title: "중요!",
            text: "문의내용을 입력해 주세요.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.cs_content.focus();
        return false;
    }

    if (!f.cs_agree.checked) {
        Swal.fire({
            title: "중요!",
            text: "개인정보처리방침안내의 내용에 동의하셔야 상담 문의가 가능합니다.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.cs_agree.focus();
        return false;
    }
    
    return true;
}

function format_number() {
    const numberInput = document.getElementById('cs_deposit');
    const value = numberInput.value.replace(/\D/g, ''); // 숫자 이외의 문자 제거
    
    // 천단위 쉼표 추가
    numberInput.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}
</script>