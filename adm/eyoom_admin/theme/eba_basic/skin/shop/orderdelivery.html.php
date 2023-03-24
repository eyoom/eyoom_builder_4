<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shop/orderdelivery.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-shop-orderdelivery">
    <form name="forderdelivery" method="post" action="<?php echo $action_url1; ?>" enctype="MULTIPART/FORM-DATA" autocomplete="off" class="eyoom-form">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>엑셀 배송일괄처리</strong></div>
        <div class="adm-form-info">
            <div class="cont-text-bg m-b-15">
                <p class="bg-info">
                    <i class="fas fa-info-circle"></i> 엑셀파일을 이용하여 배송정보를 일괄등록할 수 있습니다.<br>
                    <i class="fas fa-info-circle"></i> 형식은 <strong>배송처리용 엑셀파일</strong>을 다운로드하여 배송 정보를 입력하시면 됩니다.<br>
                    <i class="fas fa-info-circle"></i> 수정 완료 후 엑셀파일을 업로드하시면 배송정보가 일괄등록됩니다.<br>
                    <i class="fas fa-info-circle"></i> 엑셀파일을 저장하실 때는 <strong>Excel 97 - 2003 통합문서 (*.xls)</strong> 로 저장하셔야 합니다.<br>
                    <i class="fas fa-info-circle"></i> 주문상태가 준비이고 미수금이 0인 주문에 한해 엑셀파일이 생성됩니다.
                </p>
            </div>
            <div class="text-center">
                <a href="<?php echo G5_ADMIN_URL; ?>/shop_admin/orderdeliveryexcel.php" class="btn btn-e-lg btn-e-dark">배송정보 일괄등록용 엑셀파일 다운로드</a>
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
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">배송일괄처리 후 체크사항</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <label for="od_send_mail" class="checkbox"><input type="checkbox" name="od_send_mail" value="1" id="od_send_mail" checked="checked"><i></i> 배송안내 메일</label>
                    <label for="od_send_sms" class="checkbox"><input type="checkbox" name="send_sms" value="1" id="od_send_sms" checked="checked"><i></i>배송안내 SMS</label>
                    <label for="send_escrow" class="checkbox"><input type="checkbox" name="send_escrow" value="1" id="od_send_escrow"><i></i>에스크로배송등록</label>
                </div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit; ?>
    </div>

    </form>
</div>