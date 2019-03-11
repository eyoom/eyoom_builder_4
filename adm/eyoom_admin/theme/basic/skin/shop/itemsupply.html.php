<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shop/itemsupply.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<style>
.admin-shop-itemsupply .table-list-eb {background:#fff}
.admin-shop-itemsupply .table-list-eb label {margin-bottom:0}
.admin-shop-itemsupply .table-list-eb .input {width:100px}
.admin-shop-itemsupply .table-list-eb .select {width:100px}
.admin-shop-itemsupply .table-list-eb .item-supply-th {width:150px}
.admin-shop-itemsupply .margin-hr-20 {border-top:1px dotted #c5c5c5}
.admin-shop-itemsupply .label-height {margin-top:31px}
@media screen and (max-width: 600px) {
    .admin-shop-itemsupply .label-height {margin-top:0}
}
</style>

<?php if($ps_run) { ?>
<div class="admin-shop-itemsupply">
    <div class="table-list-eb">
        <?php if (!G5_IS_MOBILE) { ?>
        <div class="table-responsive">
        <?php } ?>
        <table class="table table-bordered">
        <thead>
            <tr>
                <th>
                    <label for="spl_chk_all" class="sound_only">전체 옵션</label>
                    <label class="checkbox">
                        <input type="checkbox" name="spl_chk_all" value="1" id="sql_chk_all"><i></i>
                    </label>
                </th>
                <th>옵션명</th>
                <th>옵션항목</th>
                <th>상품금액</th>
                <th>재고수량</th>
                <th>통보수량</th>
                <th>사용여부</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itsupply as $key => $supply) { ?>
            <tr id="it_supply_<?php echo $key; ?>">
                <th>
                    <div class="item-supply-th">
                        <label for="spl_chk_<?php echo $key; ?>" class="checkbox">
                            <input type="checkbox" name="spl_chk[]" id="spl_chk_<?php echo $key; ?>" value="1"><i></i> <?php echo $supply['spl_subject'].' &gt; '.$supply['spl']; ?>
                        </label>
                        <input type="hidden" name="spl_id[]" value="<?php echo $supply['spl_id']; ?>">
                    </div>
                </th>
                <td>
                    <div class="opt-cell spl-subject-cell"><?php echo $supply['spl_subject']; ?></div>
                </td>
                <td>
                    <div class="opt-cell spl-cell"><?php echo $supply['spl']; ?></div>
                </td>
                <td>
                    <label for="spl_price_<?php echo $key; ?>" class="input">
                        <input type="text" name="spl_price[]" value="<?php echo $supply['spl_price']; ?>" id="spl_price_<?php echo $key; ?>">
                    </label>
                </td>
                <td>
                    <label for="spl_stock_qty_<?php echo $key; ?>" class="input">
                        <input type="text" name="spl_stock_qty[]" value="<?php echo $supply['spl_stock_qty']; ?>" id="spl_stock_qty_<?php echo $key; ?>">
                    </label>
                </td>
                <td>
                    <label for="spl_noti_qty_<?php echo $key; ?>" class="input">
                        <input type="text" name="spl_noti_qty[]" value="<?php echo $supply['spl_noti_qty']; ?>" id="spl_noti_qty_<?php echo $key; ?>">
                    </label>
                </td>
                <td>
                    <label for="spl_use_<?php echo $key; ?>" class="select">
                        <select name="spl_use[]" id="spl_use_<?php echo $key; ?>">
                            <option value="1" <?php echo get_selected('1', $supply['spl_use']); ?>>사용함</option>
                            <option value="0" <?php echo get_selected('0', $supply['spl_use']); ?>>사용안함</option>
                        </select><i></i>
                    </label>
                </td>
            </tr>
            <?php } ?>
        </tbody>
        </table>
        <?php if (!G5_IS_MOBILE) { ?>
        </div>
        <?php } ?>
    </div>
    <div class="margin-top-20">
        <input type="button" value="선택삭제" id="sel_supply_delete" class="btn-e btn-e-xs btn-e-dark">
    </div>

    <div class="margin-hr-20"></div>

    <div class="row">
        <div class="col col-2"></div>
        <div class="col col-10">
            <div class="alert alert-info">
                <p>전체 추가 옵션의 상품금액, 재고/통보수량 및 사용여부를 일괄 적용할 수 있습니다.  단, 체크된 수정항목만 일괄 적용됩니다.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-2">
            <strong>추가 옵션 일괄 적용</strong>
        </div>
        <div class="col col-2">
            <label class="checkbox"><input type="checkbox" name="spl_com_price_chk" id="spl_com_price_chk" value="1" class="spl_com_chk"><i></i> 상품금액</label>
            <label class="input">
                <input type="text" name="spl_com_price" value="0" id="spl_com_price">
            </label>
        </div>
        <div class="col col-2">
            <label class="checkbox"><input type="checkbox" name="spl_com_stock_chk" id="spl_com_stock_chk" value="1" class="spl_com_chk"><i></i> 재고수량</label>
            <label class="input">
                <input type="text" name="spl_com_stock" value="0" id="spl_com_stock">
            </label>
        </div>
        <div class="col col-2">
            <label class="checkbox"><input type="checkbox" name="spl_com_noti_chk" id="spl_com_noti_chk" value="1" class="spl_com_chk"><i></i> 통보수량</label>
            <label class="input">
                <input type="text" name="spl_com_noti" value="0" id="spl_com_noti">
            </label>
        </div>
        <div class="col col-2">
            <label class="checkbox"><input type="checkbox" name="spl_com_use_chk" id="spl_com_use_chk" value="1" class="spl_com_chk"><i></i> 사용여부</label>
            <label class="select">
                <select name="spl_com_use" id="spl_com_use">
                    <option value="1">사용함</option>
                    <option value="0">사용안함</option>
                </select>
                <i></i>
            </label>
        </div>
        <div class="col col-2">
            <label for="spl_value_apply" class="label-height"><button type="button" id="spl_value_apply" class="btn-e btn-e-md btn-e-dark">일괄적용</button></label>
        </div>
    </div>
<?php } ?>