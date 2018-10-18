<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/ordercoupon.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
#od_coupon_frm {padding:10px}
</style>

<div id="od_coupon_frm">
    <?php if($count > 0) { ?>
    <div class="table-list-eb">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">쿠폰명</th>
                    <th scope="col" class="td-border">할인금액</th>
                    <th scope="col">적용</th>
                </tr>
                </thead>
                <tbody>
                <?php for($i=0; $i<$cp_count; $i++) { ?>
                <tr>
                    <td>
                        <input type="hidden" name="o_cp_id[]" value="<?php echo $list[$i]['cp_id']; ?>">
                        <input type="hidden" name="o_cp_prc[]" value="<?php echo $list[$i]['dc']; ?>">
                        <input type="hidden" name="o_cp_subj[]" value="<?php echo $list[$i]['cp_subject']; ?>">
                        <?php echo get_text($list[$i]['cp_subject']); ?>
                    </td>
                    <td class="td-border text-right"><strong class="color-red"><?php echo number_format($list[$i]['dc']); ?></strong></td>
                    <td class="text-center"><button type="button" class="btn-e btn-e-red od_cp_apply" data-dismiss="modal">적용</button></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php } else { ?>
    <div class="text-center font-size-13 color-grey"><i class="fas fa-exclamation-circle"></i> 사용할 수 있는 쿠폰이 없습니다.</div>
    <?php } ?>
</div>