<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shop/itemexcelupdate.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-shop-itemexcel">
    <div class="headline">
        <h2>상품 엑셀일괄등록 결과</h2>
        <div class="clearfix"></div>
    </div>
    <div class="margin-bottom-30"></div>
    <div class="adm-table-form-wrap margin-bottom-30">
        <fieldset>
            <div class="cont-text-bg">
                <p class="bg-danger font-size-12">
                    <i class="fas fa-info-circle"></i> 상품등록을 완료했습니다.
                </p>
            </div>
        </fieldset>

        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            총상품수
                        </th>
                        <td>
                            <?php echo number_format($total_count); ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            완료건수
                        </th>
                        <td>
                            <?php echo number_format($succ_count); ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            실패건수
                        </th>
                        <td>
                            <?php echo number_format($fail_count); ?>
                        </td>
                    </tr>
                    <?php if($fail_count > 0) { ?>
                    <tr>
                        <th class="table-form-th">
                            실패상품코드
                        </th>
                        <td>
                            <?php echo implode(', ', (array)$fail_it_id); ?>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if($dup_count > 0) { ?>
                    <tr>
                        <th class="table-form-th">
                            상품코드중복건수
                        </th>
                        <td>
                            <?php echo number_format($dup_count); ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            중복상품코드
                        </th>
                        <td>
                            <?php echo implode(', ', (array)$dup_it_id); ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php if (!G5_IS_MOBILE) { ?>
            </div>
            <?php } ?>
        </div>
    </div>
</div>