<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shop/itemexcelupdate.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-shop-itemexcel">
    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>상품 엑셀일괄등록 결과</strong></div>
        <div class="adm-form-info">
            <div class="cont-text-bg">
                <p class="bg-success">
                    <i class="fas fa-info-circle"></i> 상품등록을 완료했습니다.
                </p>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">총상품수</label>
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
                <label class="label">실패상품코드</label>
            </div>
            <div class="adm-form-td td-r">
                <?php echo implode(', ', (array)$fail_it_id); ?>
            </div>
        </div>
        <?php } ?>
        <?php if($dup_count > 0) { ?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">상품코드중복건수</label>
            </div>
            <div class="adm-form-td td-r">
                <?php echo number_format($dup_count); ?>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">중복상품코드</label>
            </div>
            <div class="adm-form-td td-r">
                <?php echo implode(', ', (array)$dup_it_id); ?>
            </div>
        </div>
        <?php } ?>
    </div>
</div>