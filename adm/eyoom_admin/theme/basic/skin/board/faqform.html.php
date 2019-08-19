<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/member/faqform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-faqform">
    <form name="frmfaqform" id="frmfaqform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return frmfaqform_check(this)" enctype="multipart/form-data" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="fm_id" value="<?php echo $fm_id; ?>">
    <input type="hidden" name="fa_id" value="<?php echo $fa_id; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-headline">
        <h3>FAQ <?php echo $html_title; ?></h3>
    </div>

    <div class="adm-table-form-wrap">
        <header><strong><i class="fas fa-caret-right"></i> FAQ <?php echo $html_title; ?></strong></header>
        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label for="fa_order" class="label">출력순서</label>
                        </th>
                        <td>
                            <div <?php if (!G5_IS_MOBILE) { ?>class="inline-group"<?php } ?>>
                                <span>
                                    <label class="input form-width-250px">
                                        <input type="text" name="fa_order" value="<?php echo $fa['fa_order']; ?>" id="fa_order" maxlength="10">
                                    </label>
                                </span>
                                <?php if ($w == 'u') { ?>
                                <span>
                                    <a href="<?php echo G5_BBS_URL; ?>/faq.php?fm_id=<?php echo $fm_id; ?>" class="btn-e btn-e-md btn-e-dark">내용보기</a>
                                </span>
                                <?php } ?>
                            </div>
                            <div class="note"><strong>Note:</strong> 숫자가 작을수록 FAQ 페이지에서 먼저 출력됩니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="fm_head_html" class="label">질문</label>
                        </th>
                        <td>
                            <label class="textarea">
                                <?php echo editor_html('fa_subject', get_text(html_purifier($fa['fa_subject']), 0)); ?>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="fm_head_html" class="label">답변</label>
                        </th>
                        <td>
                            <label class="textarea">
                                <?php echo editor_html('fa_content', get_text(html_purifier($fa['fa_content']), 0)); ?>
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

    <?php echo $frm_submit; ?>

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