<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shop/orderpartcancel.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<style>
</style>
<?php if (!$msg) { ?>
<form name="forderpartcancel" method="post" action="<?php echo $action_url; ?>" onsubmit="return form_check(this);" class="eyoom-form">
<input type="hidden" name="od_id" value="<?php echo $od_id; ?>">

<div class="new_win">
    <h1><?php echo $od['od_settle_case']; ?> 부분취소</h1>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption><?php echo $g5['title']; ?> 입력</caption>
        <colgroup>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th scope="row">취소가능 금액</th>
            <td><?php echo display_price($od_misu); ?></td>
        </tr>
        </tr>
        <tr>
            <th scope="row"><label for="mod_tax_mny">과세 취소금액</label></th>
            <td>
                <label class="input form-width-250px">
                    <i class="icon-append">원</i>
                    <input type="text" name="mod_tax_mny" value="" id="mod_tax_mny">
                </label>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="mod_free_mny">비과세 취소금액</label></th>
            <td>
                <label class="input form-width-250px">
                    <i class="icon-append">원</i>
                    <input type="text" name="mod_free_mny" value="" id="mod_free_mny">
                </label>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="mod_memo">요청사유</label></th>
            <td>
                <label class="textarea">
                    <textarea name="mod_memo" id="mod_memo" required></textarea>
                </label>
            </td>
        </tr>
        </tbody>
        </table>
    </div>

    <?php echo $frm_submit; ?>
</div>
</form>

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