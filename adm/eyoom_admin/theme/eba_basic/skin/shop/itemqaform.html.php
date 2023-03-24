<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shop/itemqaform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
if ($config['cf_editor'] == 'tuieditor') echo tuieditor_resource();

/**
 * 페이지 경로 설정
 */
$fm_pid = 'itemqalist';
$g5_title = '상품문의';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">쇼핑몰관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';

$frm_eba_submit  = ' <div class="confirm-fixed-btn"> ';
$frm_eba_submit .= ' <input type="submit" value="적용하기" class="btn-e btn-e-md btn-e-crimson" accesskey="s">' ;
$frm_eba_submit .= '</div>';
$frm_submit .= $frm_eba_submit;
?>

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

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>상품문의 상세</strong></div>
        <div class="adm-form-info">
            <div class="cont-text-bg">
                <p class="bg-info">
                    <i class="fas fa-info-circle"></i> 상품에 대한 문의에 답변하실 수 있습니다. 상품 문의 내용의 수정도 가능합니다.
                </p>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">문의 상품</label>
            </div>
            <div class="adm-form-td td-r">
                <a href="<?php echo shop_item_url($iq['it_id']); ?>" target="_blank"><u><?php echo $iq['it_id']; ?></u></a>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">이름</label>
            </div>
            <div class="adm-form-td td-r">
                <?php echo $name; ?>
            </div>
        </div>
        <?php if($iq['iq_email']) { ?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">이메일</label>
            </div>
            <div class="adm-form-td td-r">
                <?php echo get_text($iq['iq_email']); ?>
            </div>
        </div>
        <?php } ?>
        <?php if($iq['iq_hp']) { ?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">휴대폰</label>
            </div>
            <div class="adm-form-td td-r">
                <?php echo hyphen_hp_number($iq['iq_hp']); ?>
            </div>
        </div>
        <?php } ?>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label for="iq_subject" class="label">제목</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input">
                    <input type="text" name="iq_subject" value="<?php echo conv_subject($iq['iq_subject'],120); ?>" id="iq_subject" required>
                </label>
            </div>
        </div>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label for="iq_question" class="label">질문</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="textarea">
                    <?php echo editor_html('iq_question', get_text(html_purifier($iq['iq_question']), 0)); ?>
                </div>
            </div>
        </div>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label for="iq_answer" class="label">답변</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="textarea">
                    <?php echo editor_html('iq_answer', get_text(html_purifier($iq['iq_answer']), 0)); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit; ?>
    </div>

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