<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/coupon.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/fontawesome5/css/fontawesome-all.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/common.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/style.css" type="text/css" media="screen">',0);
?>

<style>
.shop-coupon {position:relative;overflow:hidden;padding:5px}
.shop-coupon .win-title {position:relative;margin:0 0 20px;font-size:18px}
<?php if (G5_IS_MOBILE) { ?>
.shop-coupon {padding:20px 15px}
.shop-coupon .win-title {height:50px;line-height:30px;padding:10px;background:#555;color:#fff}
.shop-coupon .win-close-btn {position:absolute;top:10px;right:10px;width:30px;height:30px;line-height:30px;text-align:center;margin:0;padding:0;border:0;background:none;color:#fff;float:right}
<?php } ?>
</style>

<div class="shop-coupon">
    <h4 class="win-title">
        <strong><?php echo $g5['title'] ?></strong>
        <?php if (G5_IS_MOBILE) { ?>
        <button type="button" onclick="window.close();" class="win-close-btn"><i class="fas fa-times"></i></button>
        <div class="clearfix"></div>
        <?php } ?>
    </h4>
    <?php if (G5_IS_MOBILE) { ?>
    <p class="text-right font-size-11 margin-bottom-5 color-grey">Note! 좌우 스크롤 (<i class="fa fa-arrows-h"></i>)</p>
    <?php } ?>
    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>쿠폰명</th>
                        <th class="td-border">적용대상</th>
                        <th>할인금액</th>
                        <th class="td-border-left">사용기한</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<$cp_count; $i++) { ?>
                    <tr>
                        <td><strong><?php echo $list[$i]['cp_subject']; ?></strong></td>
                        <td class="td-border"><?php echo $list[$i]['cp_target']; ?></td>
                        <td><?php echo $list[$i]['cp_price']; ?></td>
                        <td class="td-border-left"><?php echo substr($list[$i]['cp_start'], 2, 8); ?> ~ <?php echo substr($list[$i]['cp_end'], 2, 8); ?></td>
                    </tr>
                    <?php } ?>

                    <?php if ($cp_count == 0) { ?>
                    <tr><td colspan="4" class="text-center"><span class="font-size-13 color-grey"><i class="fa fa-exclamation-circle"></i> 사용할 수 있는 쿠폰이 없습니다.</span></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if (G5_IS_MOBILE) { ?>
    <div class="text-center margin-top-30 margin-bottom-30">
        <button type="button" onclick="window.close();" class="btn-e btn-e-xlg btn-e-dark">창닫기</button>
    </div>
    <?php } ?>
</div>