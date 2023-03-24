<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/member/mail_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
if ($config['cf_editor'] == 'tuieditor') echo tuieditor_resource();

/**
 * 페이지 경로 설정
 */
$fm_pid = 'mail_list';
$g5_title = '회원메일발송';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">회원관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-mail-form">
    <form name="fmailform" id="fmailform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fmailform_check(this);" class="eyoom-form">
    <input type="hidden" name="w" id="w" value="<?php echo $w; ?>">
    <input type="hidden" name="ma_id" id="ma_id" value="<?php echo $ma_id; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>회원 메일 입력</strong></div>
        <div class="adm-form-info">
            <div class="cont-text-bg">
                <p class="bg-info">
                    <i class="fas fa-info-circle"></i> 메일 내용에 {이름} , {닉네임} , {회원아이디} , {이메일} 처럼 내용에 삽입하면 해당 내용에 맞게 변환하여 메일을 발송합니다.
                </p>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="ma_subject" class="label">메일 제목</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input">
                    <input type="text" name="ma_subject" id="ma_subject" value="<?php echo get_sanitize_input($ma['ma_subject']); ?>" required>
                </label>
            </div>
        </div>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label class="label">메일 내용</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="textarea">
                    <?php echo editor_html("ma_content", get_text(html_purifier($ma['ma_content']), 0)); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit;?>
    </div>

    </form>
</div>

<script>
function fmailform_check(f) {
    errmsg = "";
    errfld = "";

    check_field(f.ma_subject, "제목을 입력하세요.");

    if (errmsg != "") {
        alert(errmsg);
        errfld.focus();
        return false;
    }

    <?php echo get_editor_js('ma_content'); ?>
    <?php echo chk_editor_js('ma_content'); ?>

    return true;
}
</script>