<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/coupon.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.shop-coupon {position:relative;overflow:hidden;padding:0}
.shop-coupon .win-title {position:relative;margin:0 0 20px;font-size:1.0625rem}
</style>
<?php if (G5_IS_MOBILE) { ?>
<style>
.shop-coupon {padding:15px}
.shop-coupon .win-title {height:60px;line-height:30px;padding:15px 10px;background:#353535;color:#fff}
.shop-coupon .btn-close {position:absolute;top:19px;right:10px}
</style>
<?php } ?>

<div class="shop-coupon">
    <h4 class="win-title">
        <strong><?php echo $g5['title'] ?></strong>
        <?php if (G5_IS_MOBILE) { ?>
        <button type="button" class="btn-close btn-close-white" onclick="window.close();" aria-label="Close"></button>
        <?php } ?>
    </h4>
    <?php if (G5_IS_MOBILE) { ?>
    <p class="text-end f-s-13r m-b-5 text-gray">Note! 좌우 스크롤 (<i class="fa fa-arrows-h"></i>)</p>
    <?php } ?>
    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>쿠폰명</th>
                        <th>적용대상</th>
                        <th>할인금액</th>
                        <th>사용기한</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<$cp_count; $i++) { ?>
                    <tr>
                        <td class="text-center"><strong><?php echo $list[$i]['cp_subject']; ?></strong></td>
                        <td class="text-center"><?php echo $list[$i]['cp_target']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['cp_price']; ?></td>
                        <td class="text-center"><?php echo substr($list[$i]['cp_start'], 2, 8); ?> ~ <?php echo substr($list[$i]['cp_end'], 2, 8); ?></td>
                    </tr>
                    <?php } ?>

                    <?php if ($cp_count == 0) { ?>
                    <tr><td colspan="4" class="text-center text-gray"><i class="fas fa-exclamation-circle"></i> 사용할 수 있는 쿠폰이 없습니다.</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if (G5_IS_MOBILE) { ?>
    <div class="text-center m-t-30 m-b-30">
        <button type="button" onclick="window.close();" class="btn-e btn-e-xl btn-e-dark">창닫기</button>
    </div>
    <?php } ?>
</div>