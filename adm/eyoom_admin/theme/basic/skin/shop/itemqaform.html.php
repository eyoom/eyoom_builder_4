<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shop/itemqaform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<style>
.admin-shop-itemqaform .input-fake {padding:4px 10px;border:1px solid #d5d5d5;margin-bottom:10px}
.admin-shop-itemqaform .input-fake .info-photo {display:inline-block;width:26px;height:26px;margin-right:2px;border:1px solid #e5e5e5;padding:1px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.admin-shop-itemqaform .input-fake .info-photo img {width:100%;height:auto;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.admin-shop-itemqaform .input-fake .info-photo .info-icon {width:22px;height:22px;font-size:12px;line-height:22px;text-align:center;background:#959595;color:#fff;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;display:inline-block;white-space:nowrap;vertical-align:baseline;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
</style>

<div class="admin-shop-itemqaform">
    <form name="fitemqaform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fitemqaform_submit(this);" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="iq_id" value="<?php echo $iq_id; ?>">
    <input type="hidden" name="sca" value="<?php echo $sca; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">

    <div class="adm-headline">
        <h3>상품 문의 수정</h3>
    </div>

    <div class="adm-table-form-wrap margin-bottom-30">
        <header><strong><i class="fas fa-caret-right"></i> 상품 문의 내역</strong></header>
        <fieldset>
            <div class="cont-text-bg">
                <p class="bg-info font-size-12 margin-bottom-0">
                    <i class="fas fa-info-circle"></i> 상품에 대한 문의에 답변하실 수 있습니다. 상품 문의 내용의 수정도 가능합니다.
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
                            <label class="label">이름</label>
                        </th>
                        <td>
                            <div class="input-fake">
                                <?php if($mb_photo) { ?>
                                <span class="info-photo"><?php echo $mb_photo ?></span>
                                <?php } else { ?>
                                <span class="info-icon"><i class="fas fa-user"></i></span>
                                <?php } ?>
                                <span class="info-name"><?php echo $name; ?></span>
                            </div>
                        </td>
                    </tr>
                    <?php if($iq['iq_email']) { ?>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">이메일</label>
                        </th>
                        <td>
                            <div class="input-fake">
                                <?php echo get_text($iq['iq_email']); ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if($iq['iq_hp']) { ?>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">휴대폰</label>
                        </th>
                        <td>
                            <div class="input-fake">
                                <?php echo hyphen_hp_number($iq['iq_hp']); ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <th class="table-form-th">
                            <label for="iq_subject" class="label">제목</label>
                        </th>
                        <td>
                            <label class="input">
                                <input type="text" name="iq_subject" value="<?php echo conv_subject($iq['iq_subject'],120); ?>" id="iq_subject" required>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="iq_question" class="label">질문</label>
                        </th>
                        <td>
                            <label class="textarea">
                                <?php echo editor_html('iq_question', get_text(html_purifier($iq['iq_question']), 0)); ?>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="iq_answer" class="label">답변</label>
                        </th>
                        <td>
                            <label class="textarea">
                                <?php echo editor_html('iq_answer', get_text(html_purifier($iq['iq_answer']), 0)); ?>
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

    <?php echo $frm_submit; // 버튼 ?>

    </form>
</div>

<script>
function fitemqaform_submit(f)
{
    <?php echo get_editor_js('iq_question'); ?>
    <?php echo get_editor_js('iq_answer'); ?>

    return true;
}
</script>