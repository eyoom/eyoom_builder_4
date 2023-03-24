<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shop/personalpaycopy.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="new_win">
    <form name="fpersonalpaycopy" method="post" action="<?php echo $action_url1; ?>" onsubmit="return form_check(this);" class="eyoom-form">
    <input type="hidden" name="pp_id" value="<?php echo $pp_id; ?>">

    <div class="table-list-eb">
        <?php if (!G5_IS_MOBILE) { ?>
        <div class="table-responsive">
        <?php } ?>
        <table class="table">
            <tbody>
                <tr>
                    <th class="table-form-th">
                        <label for="pp_name" class="label">이름</label>
                    </th>
                    <td>
                        <label class="input form-width-250px">
                            <input type="text" name="pp_name" id="pp_name" value="<?php echo $row['pp_name']; ?>" required class="required">
                        </label>
                    </td>
                </tr>
                <tr>
                    <th class="table-form-th">
                        <label for="od_id" class="label">주문번호</label>
                    </th>
                    <td>
                        <label class="input form-width-250px">
                            <input type="text" name="od_id" id="od_id" value="<?php echo $row['od_id']; ?>">
                        </label>
                    </td>
                </tr>
                <tr>
                    <th class="table-form-th">
                        <label for="pp_price" class="label">주문번호</label>
                    </th>
                    <td>
                        <label class="input form-width-250px">
                            <i class="icon-append">원</i>
                            <input type="text" name="pp_price" id="pp_price" value="<?php echo $row['pp_price']; ?>" required class="required">
                        </label>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php if (!G5_IS_MOBILE) { ?>
        </div>
        <?php } ?>
    </div>

    <?php echo $frm_submit; // 버튼 ?>

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