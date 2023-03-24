<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shop/itemuseform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
if ($config['cf_editor'] == 'tuieditor') echo tuieditor_resource();

/**
 * 페이지 경로 설정
 */
$fm_pid = 'itemuselist';
$g5_title = '상품후기';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">쇼핑몰관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';

$frm_eba_submit  = ' <div class="confirm-fixed-btn"> ';
$frm_eba_submit .= ' <input type="submit" value="적용하기" class="btn-e btn-e-md btn-e-crimson" accesskey="s">' ;
$frm_eba_submit .= '</div>';
$frm_submit .= $frm_eba_submit;
?>

<div class="admin-shop-itemuseform">
    <form name="fitemuseform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fitemuseform_submit(this);" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="is_id" value="<?php echo $is_id; ?>">
    <input type="hidden" name="sca" value="<?php echo $sca; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>사용후기 상세</strong></div>
        <div class="adm-form-info">
            <div class="cont-text-bg">
                <p class="bg-info">
                    <i class="fas fa-info-circle"></i> 사용후기에 대한 내용에 답변하실 수 있습니다. 사용후기 내용의 수정도 가능합니다.
                </p>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">상품명</label>
            </div>
            <div class="adm-form-td td-r">
                <a href="<?php echo shop_item_url($is['it_id']); ?>" target="_blank"><u><?php echo $is['it_name']; ?></u></a>
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
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">평점</label>
            </div>
            <div class="adm-form-td td-r">
                <img src="../../../../../../shop/img/s_star<?php echo $is['is_score']; ?>.png" width="100"> (<?php echo $is['is_score']; ?> 점)
            </div>
        </div>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label for="is_subject">제목</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input">
                    <input type="text" name="is_subject" id="is_subject" value="<?php echo get_text($is['is_subject']); ?>" required>
                </label>
            </div>
        </div>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label class="label">내용</label>
            </div>
            <div class="adm-form-td td-r">
                <div for="is_content" class="textarea">
                    <?php echo editor_html('is_content', get_text(html_purifier($is['is_content']), 0)); ?>
                </div>
            </div>
        </div>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label for="is_reply_subject">답변 제목</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input">
                    <input type="text" name="is_reply_subject" id="is_reply_subject" value="<?php echo get_text($is['is_reply_subject']); ?>">
                </label>
            </div>
        </div>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label class="label">내용</label>
            </div>
            <div class="adm-form-td td-r">
                <div for="is_reply_content" class="textarea">
                    <?php echo editor_html('is_reply_content', get_text(html_purifier($is['is_reply_content']), 0)); ?>
                </div>
            </div>
        </div>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label class="label">확인</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <label for="is_confirm_yes" class="radio"><input type="radio" name="is_confirm" value="1" id="is_confirm_yes" <?php echo $is_confirm_yes; ?>><i></i> 예</label>
                    <label for="is_confirm_no" class="radio"><input type="radio" name="is_confirm" value="0" id="is_confirm_no" <?php echo $is_confirm_no; ?>><i></i> 아니오</label>
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
function fitemuseform_submit(f)
{
    <?php echo get_editor_js('is_content'); ?>
    <?php echo get_editor_js('is_reply_content'); ?>
    return true;
}
</script>
