<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shop/itemexcel.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-shop-itemexcel">
    <form name="fitemexcel" method="post" action="<?php echo $action_url1; ?>" enctype="MULTIPART/FORM-DATA" autocomplete="off" class="eyoom-form">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>엑셀파일로 상품 일괄 등록</strong></div>
        <div class="adm-form-info">
            <div class="cont-text-bg m-b-15">
                <p class="bg-info">
                    <i class="fas fa-info-circle"></i> 엑셀파일을 이용하여 상품을 일괄등록할 수 있습니다.<br>
                    <i class="fas fa-info-circle"></i> 형식은 <strong>상품일괄등록용 엑셀파일</strong>을 다운로드하여 상품 정보를 입력하시면 됩니다.<br>
                    <i class="fas fa-info-circle"></i> 수정 완료 후 엑셀파일을 업로드하시면 상품이 일괄등록됩니다.<br>
                    <i class="fas fa-info-circle"></i> 엑셀파일을 저장하실 때는 <strong>Excel 97 - 2003 통합문서 (*.xls)</strong> 로 저장하셔야 합니다.
                </p>
            </div>
            <div class="text-center">
                <a href="<?php echo G5_URL; ?>/<?php echo G5_LIB_DIR; ?>/Excel/itemexcel_eyoom.xls" class="btn btn-e-lg btn-e-dark">상품일괄등록용 엑셀파일 다운로드</a>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="excelfile" class="label">파일선택</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="input">
                    <input type="file" class="form-control" name="excelfile" id="excelfile">
                </div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit; ?>
    </div>

    </form>
</div>