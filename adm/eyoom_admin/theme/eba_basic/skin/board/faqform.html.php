<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/member/faqform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
if ($config['cf_editor'] == 'tuieditor') echo tuieditor_resource();

/**
 * 페이지 경로 설정
 */
$fm_pid = 'faqmasterlist';
$g5_title = 'FAQ관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">게시판관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-faqform">
    <form name="frmfaqform" id="frmfaqform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return frmfaqform_check(this)" enctype="multipart/form-data" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="fm_id" value="<?php echo $fm_id; ?>">
    <input type="hidden" name="fa_id" value="<?php echo $fa_id; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-form-table">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i><?php echo $html_title; ?></strong></div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="fa_order" class="label">출력순서</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <span>
                        <label class="input width-250px">
                            <input type="text" name="fa_order" value="<?php echo $fa['fa_order']; ?>" id="fa_order" maxlength="10">
                        </label>
                    </span>
                    <?php if ($w == 'u') { ?>
                    <span>
                        <a href="<?php echo G5_BBS_URL; ?>/faq.php?fm_id=<?php echo $fm_id; ?>" target="_blank" class="btn-e btn-e-lg btn-e-dark">내용보기</a>
                    </span>
                    <?php } ?>
                </div>
                <div class="note"><strong>Note:</strong> 숫자가 작을수록 FAQ 페이지에서 먼저 출력됩니다.</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="fm_head_html" class="label">질문</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="textarea">
                    <?php echo editor_html('fa_subject', get_text(html_purifier($fa['fa_subject']), 0)); ?>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="fm_head_html" class="label">답변</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="textarea">
                    <?php echo editor_html('fa_content', get_text(html_purifier($fa['fa_content']), 0)); ?>
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
function frmfaqform_check(f) {
    errmsg = "";
    errfld = "";

    //check_field(f.fa_subject, "제목을 입력하세요.");
    //check_field(f.fa_content, "내용을 입력하세요.");

    if (errmsg != "")
    {
        alert(errmsg);
        errfld.focus();
        return false;
    }

    <?php echo get_editor_js('fa_subject'); ?>
    <?php echo get_editor_js('fa_content'); ?>

    return true;
}

// document.getElementById('fa_order').focus(); 포커스 해제
</script>