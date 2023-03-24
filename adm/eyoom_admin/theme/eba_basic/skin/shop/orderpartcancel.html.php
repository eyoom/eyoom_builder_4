<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shop/orderpartcancel.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<?php if (!$msg) { ?>
<div class="admin-shop-orderpartcancel">
    <form name="forderpartcancel" method="post" action="<?php echo $action_url; ?>" onsubmit="return form_check(this);" class="eyoom-form">
    <input type="hidden" name="od_id" value="<?php echo $od_id; ?>">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i><?php echo $od['od_settle_case']; ?> 부분취소</strong></div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">취소가능 금액</label>
            </div>
            <div class="adm-form-td td-r">
                <?php echo display_price($od_misu); ?>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="mod_tax_mny" class="label">과세 취소금액</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <i class="icon-append">원</i>
                    <input type="text" name="mod_tax_mny" value="" id="mod_tax_mny" class="text-end">
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="mod_free_mny" class="label">비과세 취소금액</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <i class="icon-append">원</i>
                    <input type="text" name="mod_free_mny" value="" id="mod_free_mny" class="text-end">
                </label>
            </div>
        </div>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label for="mod_memo" class="label">요청사유</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="textarea">
                    <textarea name="mod_memo" id="mod_memo" required></textarea>
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
function form_check(f)
{
    var max_mny = parseInt(<?php echo $od_misu; ?>);
    var tax_mny = parseInt(f.mod_tax_mny.value.replace("/[^0-9]/g", ""));
    var free_mny = 0;
    if(typeof f.mod_free.mny.value != "undefined")
        free_mny = parseInt(f.mod_free_mny.value.replace("/[^0-9]/g", ""));

    if(!tax_mny && !free_mny) {
        alert("과세 취소금액 또는 비과세 취소금액을 입력해 주십시오.");
        return false;
    }

    if((tax_mny && free_mny) && (tax_mny + free_mny) > max_mny) {
        alert("과세, 비과세 취소금액의 합을 "+number_format(String(max_mny))+"원 이하로 입력해 주십시오.");
        return false;
    }

    if(tax_mny && tax_mny > max_mny) {
        alert("과세 취소금액을 "+number_format(String(max_mny))+"원 이하로 입력해 주십시오.");
        return false;
    }

    if(free_mny && free_mny > max_mny) {
        alert("비과세 취소금액을 "+number_format(String(max_mny))+"원 이하로 입력해 주십시오.");
        return false;
    }

    return true;
}
</script>
<?php } else { ?>
<script>
$(function (){
    var msg = '<?php echo $msg; ?>';
    alert(msg);
    window.parent.closeModal();
});
</script>
<?php } ?>