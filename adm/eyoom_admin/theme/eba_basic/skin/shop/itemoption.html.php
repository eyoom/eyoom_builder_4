<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shop/itemoption.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<?php if($po_run) { ?>
<div class="admin-shop-itemoption">
    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>
    <div class="table-list-eb m-b-10">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            <label for="opt_chk_all" class="sound_only">전체 옵션</label>
                            <label class="checkbox adm-table-check"><input type="checkbox" name="opt_chk_all" id="opt_chk_all" value="1"><i></i></label>
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
                            <label class="checkbox">
                                <input type="checkbox" name="opt_chk[]" id="opt_chk_<?php echo $key; ?>" value="1"><i></i><?php echo $option['opt_1']; if ($option['opt_2_len']) echo ' <small>&gt;</small> '.$option['opt_2']; if ($option['opt_3_len']) echo ' <small>&gt;</small> '.$option['opt_3']; ?>
                            </label>
                            <input type="hidden" name="opt_id[]" value="<?php echo $option['opt_id']; ?>">
                        </th>
                        <td>
                            <div class="opt-cell"><?php echo $option['opt_1']; if ($option['opt_2_len']) echo ' <small>&gt;</small> '.$option['opt_2']; if ($option['opt_3_len']) echo ' <small>&gt;</small> '.$option['opt_3']; ?></div>
                        </td>
                        <td>
                            <label class="input width-150px">
                                <input type="text" name="opt_price[]" value="<?php echo $option['opt_price']; ?>" id="opt_price_<?php echo $key; ?>">
                            </label>
                        </td>
                        <td>
                            <label class="input width-150px">
                                <input type="text" name="opt_stock_qty[]" value="<?php echo $option['opt_stock_qty']; ?>" id="opt_stock_qty_<?php echo $key; ?>">
                            </label>
                        </td>
                        <td>
                            <label class="input width-150px">
                                <input type="text" name="opt_noti_qty[]" value="<?php echo $option['opt_noti_qty']; ?>" id="opt_noti_qty_<?php echo $key; ?>">
                            </label>
                        </td>
                        <td>
                            <label class="select width-150px">
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
        </div>
    </div>

    <div class="text-start m-b-20">
        <input type="button" id="sel_option_delete" value="선택삭제" class="btn-e btn-e-xs btn-e-dark">
    </div>

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>옵션 일괄 적용</strong></div>
        <div class="adm-form-info">
            <div class="cont-text-bg">
                <p class="bg-info">
                    <i class="fas fa-info-circle"></i> 전체 옵션의 추가금액, 재고/통보수량 및 사용여부를 일괄 적용할 수 있습니다. 단, 체크된 수정항목만 일괄 적용됩니다.
                </p>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l adm-sm-100">
                <div class="adm-form-td td-l">
                    <label class="checkbox"><input type="checkbox" name="opt_com_price_chk" id="opt_com_price_chk" value="1" class="opt_com_chk"><i></i> 추가금액</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input width-150px">
                        <input type="text" name="opt_com_price" value="0" id="opt_com_price">
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r adm-sm-100">
                <div class="adm-form-td td-l">
                    <label class="checkbox"><input type="checkbox" name="opt_com_stock_chk" id="opt_com_stock_chk" value="1" class="opt_com_chk"><i></i> 재고수량</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input width-150px">
                        <input type="text" name="opt_com_stock" value="0" id="opt_com_stock">
                    </label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l adm-sm-100">
                <div class="adm-form-td td-l">
                    <label class="checkbox"><input type="checkbox" name="opt_com_noti_chk" id="opt_com_noti_chk" value="1" class="opt_com_chk"><i></i> 통보수량</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input width-150px">
                        <input type="text" name="opt_com_noti" value="0" id="opt_com_noti">
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r adm-sm-100">
                <div class="adm-form-td td-l">
                    <label class="checkbox"><input type="checkbox" name="opt_com_use_chk" id="opt_com_use_chk" value="1" class="opt_com_chk"><i></i> 사용여부</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="select width-150px">
                        <select name="opt_com_use" id="opt_com_use">
                            <option value="1">사용함</option>
                            <option value="0">사용안함</option>
                        </select>
                        <i></i>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center m-b-10">
        <button type="button" id="opt_value_apply" class="btn-e btn-e-md btn-e-orange width-150px text-center">일괄적용</button>
    </div>
</div>
<?php } ?>