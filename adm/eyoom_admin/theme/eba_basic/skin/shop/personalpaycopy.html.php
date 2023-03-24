<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shop/personalpaycopy.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-shop-personalpaycopy">
    <form name="fpersonalpaycopy" method="post" action="<?php echo $action_url1; ?>" onsubmit="return form_check(this);" class="eyoom-form">
    <input type="hidden" name="pp_id" value="<?php echo $pp_id; ?>">

    <div class="adm-form-table adm-search-box m-b-20">
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="pp_name" class="label">이름</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="text" name="pp_name" id="pp_name" value="<?php echo $row['pp_name']; ?>" required class="required">
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="od_id" class="label">주문번호</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="text" name="od_id" id="od_id" value="<?php echo $row['od_id']; ?>">
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="pp_price" class="label">금액</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <i class="icon-append">원</i>
                    <input type="text" name="pp_price" id="pp_price" value="<?php echo $row['pp_price']; ?>" class="text-end" required class="required">
                </label>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit;?>
    </div>

    </form>
</div>

<script>
// <![CDATA[
function form_check(f)
{
    if(f.pp_price.value.replace(/[0-9]/g, "").length > 0) {
        alert("주문금액은 숫자만 입력해 주십시오");
        return false;
    }

    return true;
}
// ]]>
</script>