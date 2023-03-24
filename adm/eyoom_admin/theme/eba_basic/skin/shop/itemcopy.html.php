<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shop/itemcopy.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-shop-itemcopy">
    <form name="fitemcopy" id="fitemcopy" class="eyoom-form">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>상품 복사하기</strong></div>
        <div class="adm-form-info">
            <div class="cont-text-bg">
                <p class="bg-info">
                    <i class="fas fa-info-circle"></i> 아래 상품코드로 선택한 상품을 동일하게 복사합니다.
                </p>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="ca_id" class="label">상품코드</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="text" name="new_it_id" id="new_it_id" value="<?php echo time(); ?>">
                </label>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit; ?>
    </div>

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