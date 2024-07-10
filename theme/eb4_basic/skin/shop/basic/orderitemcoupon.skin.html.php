<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/orderitemcoupon.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<div id="cp_frm">
    <?php if($count > 0) { ?>
    <div class="table-list-eb">
        <table class="table">
            <thead>
                <tr>
                    <th>쿠폰명</th>
                    <th>할인금액</th>
                    <th>적용</th>
                </tr>
                </thead>
                <tbody>
                <?php for($i=0; $i<$cp_count; $i++) { ?>
                <tr>
                    <td class="text-center">
                        <input type="hidden" name="f_cp_id[]" value="<?php echo $list[$i]['cp_id']; ?>">
                        <input type="hidden" name="f_cp_prc[]" value="<?php echo $list[$i]['dc']; ?>">
                        <input type="hidden" name="f_cp_subj[]" value="<?php echo $list[$i]['cp_subject']; ?>">
                        <?php echo get_text($list[$i]['cp_subject']); ?>
                    </td>
                    <td class="text-center"><strong class="text-crimson"><?php echo number_format($list[$i]['dc']); ?></strong></td>
                    <td class="text-center"><button type="button" class="btn-e btn-e-navy cp_apply">적용</button></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php } else { ?>
    <div class="text-center text-gray"><i class="fas fa-exclamation-circle"></i> 사용할 수 있는 쿠폰이 없습니다.</div>
    <?php } ?>
</div>

<script>
$(".cp_apply").click(function() {
    window.parent.closeCouponModal();
});
</script>