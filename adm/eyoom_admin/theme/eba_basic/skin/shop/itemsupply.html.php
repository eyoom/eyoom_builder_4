<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shop/itemsupply.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<?php if($ps_run) { ?>
<div class="admin-shop-itemsupply">
    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>
    <div class="table-list-eb m-b-10">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            <label for="spl_chk_all" class="sound_only">전체 옵션</label>
                            <label class="checkbox adm-table-check"><input type="checkbox" name="spl_chk_all" id="spl_chk_all" value="1"><i></i></label>
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
                            <label class="checkbox">
                                <input type="checkbox" name="spl_chk[]" id="spl_chk_<?php echo $key; ?>" value="1"><i></i><?php echo get_text($supply['spl_subject'].' &gt; '.$supply['spl']); ?>
                            </label>
                            <input type="hidden" name="spl_id[]" value="<?php echo get_text($supply['spl_id']); ?>">
                        </th>
                        <td>
                            <div class="spl-subject-cell"><?php echo get_text($supply['spl_subject']); ?></div>
                        </td>
                        <td>
                            <div class="spl-cell"><?php echo $supply['spl']; ?></div>
                        </td>
                        <td>
                            <label class="input width-150px">
                                <input type="text" name="spl_price[]" value="<?php echo $supply['spl_price']; ?>" id="spl_price_<?php echo $key; ?>">
                            </label>
                        </td>
                        <td>
                            <label class="input width-150px">
                                <input type="text" name="spl_stock_qty[]" value="<?php echo $supply['spl_stock_qty']; ?>" id="spl_stock_qty_<?php echo $key; ?>">
                            </label>
                        </td>
                        <td>
                            <label class="input width-150px">
                                <input type="text" name="spl_noti_qty[]" value="<?php echo $supply['spl_noti_qty']; ?>" id="spl_noti_qty_<?php echo $key; ?>">
                            </label>
                        </td>
                        <td>
                            <label class="select width-150px">
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
        </div>
    </div>

    <div class="text-start m-b-20">
        <input type="button" id="sel_supply_delete" value="선택삭제" class="btn-e btn-e-xs btn-e-dark">
    </div>

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>추가 옵션 일괄 적용</strong></div>
        <div class="adm-form-info">
            <div class="cont-text-bg">
                <p class="bg-info">
                    <i class="fas fa-info-circle"></i> 전체 추가 옵션의 상품금액, 재고/통보수량 및 사용여부를 일괄 적용할 수 있습니다.  단, 체크된 수정항목만 일괄 적용됩니다.
                </p>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l adm-sm-100">
                <div class="adm-form-td td-l">
                    <label class="checkbox"><input type="checkbox" name="spl_com_price_chk" id="spl_com_price_chk" value="1" class="spl_com_chk"><i></i> 상품금액</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input width-150px">
                        <input type="text" name="spl_com_price" value="0" id="spl_com_price">
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r adm-sm-100">
                <div class="adm-form-td td-l">
                    <label class="checkbox"><input type="checkbox" name="spl_com_stock_chk" id="spl_com_stock_chk" value="1" class="spl_com_chk"><i></i> 재고수량</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input width-150px">
                        <input type="text" name="spl_com_stock" value="0" id="spl_com_stock">
                    </label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l adm-sm-100">
                <div class="adm-form-td td-l">
                    <label class="checkbox"><input type="checkbox" name="spl_com_noti_chk" id="spl_com_noti_chk" value="1" class="spl_com_chk"><i></i> 통보수량</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input width-150px">
                        <input type="text" name="spl_com_noti" value="0" id="spl_com_noti">
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r adm-sm-100">
                <div class="adm-form-td td-l">
                    <label class="checkbox"><input type="checkbox" name="spl_com_use_chk" id="spl_com_use_chk" value="1" class="spl_com_chk"><i></i> 사용여부</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="select width-150px">
                        <select name="spl_com_use" id="spl_com_use">
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
        <button type="button" id="spl_value_apply" class="btn-e btn-e-md btn-e-orange width-150px text-center">일괄적용</button>
    </div>
</div>
<?php } ?>