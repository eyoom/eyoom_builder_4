<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shop/orderdeliveryupdate.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-shop-itemexcel">
    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>엑셀 배송일괄처리 결과</strong></div>
        <div class="adm-form-info">
            <div class="cont-text-bg">
                <p class="bg-success">
                    <i class="fas fa-info-circle"></i> 배송일괄처리를 완료했습니다.
                </p>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">총배송건수</label>
            </div>
            <div class="adm-form-td td-r">
                <?php echo number_format($total_count); ?>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">완료건수</label>
            </div>
            <div class="adm-form-td td-r">
                <?php echo number_format($succ_count); ?>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">실패건수</label>
            </div>
            <div class="adm-form-td td-r">
                <?php echo number_format($fail_count); ?>
            </div>
        </div>
        <?php if($fail_count > 0) { ?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">실패주문코드</label>
            </div>
            <div class="adm-form-td td-r">
                <?php echo implode(', ', $fail_od_id); ?>
            </div>
        </div>
        <?php } ?>
    </div>
</div>