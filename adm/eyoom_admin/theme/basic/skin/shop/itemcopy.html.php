<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shop/itemcopy.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-shop-itemcopy">
    <form name="fitemcopy" id="fitemcopy" class="eyoom-form">
    <div class="adm-headline">
        <h3>상품 복사하기</h3>
    </div>
    <div class="adm-table-form-wrap adm-search-box">
        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label for="ca_id" class="label">상품코드</label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <i class="icon-prepend far fa-clone"></i>
                                <input type="text" name="new_it_id" id="new_it_id" value="<?php echo time(); ?>">
                            </label>
                            <div class="note margin-bottom-10">
                                <strong>Note:</strong> 위 상품코드로 선택한 상품을 동일하게 복사합니다.
                            </div>
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
// <![CDATA[
function _copy()
{
    var link = "<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemcopyupdate&it_id=<?php echo $it_id; ?>&ca_id=<?php echo $ca_id; ?>";
    var new_it_id = document.getElementById('new_it_id').value;
    var t_it_id = new_it_id.replace(/[A-Za-z0-9\-_]/g, "");
    if(t_it_id.length > 0) {
        alert("상품코드는 영문자, 숫자, -, _ 만 사용할 수 있습니다.");
        return false;
    }
    var token = get_ajax_token();
    if(!token) {
        alert("토큰 정보가 올바르지 않습니다.");
        return false;
    }
    window.parent.closeModal(link+'&new_it_id='+new_it_id+"&token="+token+"&smode=1");
}
// ]]>
</script>