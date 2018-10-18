<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shop/itemoption.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<style>
.admin-shop-itemoption .table-list-eb {background:#fff}
.admin-shop-itemoption .table-list-eb label {margin-bottom:0}
.admin-shop-itemoption .table-list-eb .input {width:100px}
.admin-shop-itemoption .table-list-eb .select {width:100px}
.admin-shop-itemoption .table-list-eb .item-option-th {width:150px}
.admin-shop-itemoption .margin-hr-20 {border-top:1px dotted #c5c5c5}
.admin-shop-itemoption .label-height {margin-top:31px}
@media screen and (max-width: 600px) {
    .admin-shop-itemoption .label-height {margin-top:0}
}
</style>

<?php if($po_run) { ?>
<div class="admin-shop-itemoption">
    <div class="table-list-eb">
        <?php if (!G5_IS_MOBILE) { ?>
        <div class="table-responsive">
        <?php } ?>
        <table class="table table-bordered">
        <thead>
            <tr>
                <th>
                    <label for="opt_chk_all" class="sound_only">전체 옵션</label>
                    <label class="checkbox">
                        <input type="checkbox" name="opt_chk_all" value="1" id="opt_chk_all"><i></i>
                    </label>
                </th>
                <th>옵션</th>
                <th>추가금액</th>
                <th>재고수량</th>
                <th>통보수량</th>
                <th>사용여부</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itoption as $key => $option) { ?>
            <tr id="it_option_<?php echo $key; ?>">
                <th>
                    <div class="item-option-th">
                        <label for="opt_chk_<?php echo $key; ?>" class="checkbox">
                            <input type="checkbox" name="opt_chk[]" id="opt_chk_<?php echo $key; ?>" value="1"><i></i> <?php echo $option['opt_1']; if ($option['opt_2_len']) echo ' <small>&gt;</small> '.$option['opt_2']; if ($option['opt_3_len']) echo ' <small>&gt;</small> '.$option['opt_3']; ?>
                        </label>
                        <input type="hidden" name="opt_id[]" value="<?php echo $option['opt_id']; ?>">
                    </div>
                </th>
                <td>
                    <div class="opt-cell"><?php echo $option['opt_1']; if ($option['opt_2_len']) echo ' <small>&gt;</small> '.$option['opt_2']; if ($option['opt_3_len']) echo ' <small>&gt;</small> '.$option['opt_3']; ?></div>
                </td>
                <td>
                    <label for="opt_price_<?php echo $key; ?>" class="input">
                        <input type="text" name="opt_price[]" value="<?php echo $option['opt_price']; ?>" id="opt_price_<?php echo $key; ?>">
                    </label>
                </td>
                <td>
                    <label for="opt_stock_qty_<?php echo $key; ?>" class="input">
                        <input type="text" name="opt_stock_qty[]" value="<?php echo $option['opt_stock_qty']; ?>" id="opt_stock_qty_<?php echo $key; ?>">
                    </label>
                </td>
                <td>
                    <label for="opt_noti_qty_<?php echo $key; ?>" class="input">
                        <input type="text" name="opt_noti_qty[]" value="<?php echo $option['opt_noti_qty']; ?>" id="opt_noti_qty_<?php echo $key; ?>">
                    </label>
                </td>
                <td>
                    <label for="opt_use_<?php echo $key; ?>" class="select">
                        <select name="opt_use[]" id="opt_use_<?php echo $key; ?>">
                            <option value="1" <?php echo get_selected('1', $option['opt_use']); ?>>사용함</option>
                            <option value="0" <?php echo get_selected('0', $option['opt_use']); ?>>사용안함</option>
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
        <input type="button" value="선택삭제" id="sel_option_delete" class="btn-e btn-e-xs btn-e-dark">
    </div>

    <div class="margin-hr-20"></div>

    <div class="row">
        <div class="col col-2"></div>
        <div class="col col-10">
            <div class="alert alert-info">
                <p>전체 옵션의 추가금액, 재고/통보수량 및 사용여부를 일괄 적용할 수 있습니다. 단, 체크된 수정항목만 일괄 적용됩니다.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-2">
            <strong>옵션 일괄 적용</strong>
        </div>
        <div class="col col-2">
            <label class="checkbox"><input type="checkbox" name="opt_com_price_chk" id="opt_com_price_chk" value="1" class="opt_com_chk"><i></i> 추가금액</label>
            <label class="input">
                <input type="text" name="opt_com_price" value="0" id="opt_com_price">
            </label>
        </div>
        <div class="col col-2">
            <label class="checkbox"><input type="checkbox" name="opt_com_stock_chk" id="opt_com_stock_chk" value="1" class="opt_com_chk"><i></i> 재고수량</label>
            <label class="input">
                <input type="text" name="opt_com_stock" value="0" id="opt_com_stock">
            </label>
        </div>
        <div class="col col-2">
            <label class="checkbox"><input type="checkbox" name="opt_com_noti_chk" id="opt_com_noti_chk" value="1" class="opt_com_chk"><i></i> 통보수량</label>
            <label class="input">
                <input type="text" name="opt_com_noti" value="0" id="opt_com_noti">
            </label>
        </div>
        <div class="col col-2">
            <label class="checkbox"><input type="checkbox" name="opt_com_use_chk" id="opt_com_use_chk" value="1" class="opt_com_chk"><i></i> 사용여부</label>
            <label class="select">
                <select name="opt_com_use" id="opt_com_use">
                    <option value="1">사용함</option>
                    <option value="0">사용안함</option>
                </select>
                <i></i>
            </label>
        </div>
        <div class="col col-2">
            <label for="opt_value_apply" class="label-height"><button type="button" id="opt_value_apply" class="btn-e btn-e-md btn-e-dark">일괄적용</button></label>
        </div>
    </div>
<?php } ?>