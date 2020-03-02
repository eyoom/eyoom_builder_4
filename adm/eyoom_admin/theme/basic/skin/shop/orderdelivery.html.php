<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shop/orderdelivery.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-shop-orderdelivery">
    <form name="forderdelivery" method="post" action="<?php echo $action_url1; ?>" enctype="MULTIPART/FORM-DATA" autocomplete="off" class="eyoom-form">
    <div class="headline">
        <h2>엑셀 배송일괄처리</h2>
        <div class="clearfix"></div>
    </div>
    <div class="margin-bottom-30"></div>
    <div class="adm-table-form-wrap margin-bottom-30">
        <fieldset>
            <div class="cont-text-bg">
                <p class="bg-danger font-size-12">
                    <i class="fas fa-info-circle"></i> 엑셀파일을 이용하여 배송정보를 일괄등록할 수 있습니다.<br>
                    <i class="fas fa-info-circle"></i> 형식은 <strong>배송처리용 엑셀파일</strong>을 다운로드하여 배송 정보를 입력하시면 됩니다.<br>
                    <i class="fas fa-info-circle"></i> 수정 완료 후 엑셀파일을 업로드하시면 배송정보가 일괄등록됩니다.<br>
                    <i class="fas fa-info-circle"></i> 엑셀파일을 저장하실 때는 <strong>Excel 97 - 2003 통합문서 (*.xls)</strong> 로 저장하셔야 합니다.<br>
                    <i class="fas fa-info-circle"></i> 주문상태가 준비이고 미수금이 0인 주문에 한해 엑셀파일이 생성됩니다.
                </p>
            </div>
        </fieldset>

        <fieldset>
            <div class="text-center margin-top-10 margin-bottom-10">
                <a href="<?php echo G5_ADMIN_URL; ?>/shop_admin/orderdeliveryexcel.php" class="btn btn-e-md btn-e-dark"><i class="fas fa-file-alt"></i> 배송정보 일괄등록용 엑셀파일 다운로드</a>
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
                            <label for="excelfile" class="label">파일선택</label>
                        </th>
                        <td>
                            <label class="input input-file">
                                <div class="button"><input type="file" name="excelfile" id="excelfile" onchange="this.parentNode.nextSibling.value = this.value">파일선택</div><input type="text" readonly="">
                            </label>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php if (!G5_IS_MOBILE) { ?>
            </div>
            <?php } ?>
        </div>
    </div>

    <div class="inline-group">
        <label for="od_send_mail" class="checkbox"><input type="checkbox" name="od_send_mail" value="1" id="od_send_mail" checked="checked"><i></i> 배송안내 메일</label>
        <label for="od_send_sms" class="checkbox"><input type="checkbox" name="send_sms" value="1" id="od_send_sms" checked="checked"><i></i>배송안내 SMS</label>
        <label for="send_escrow" class="checkbox"><input type="checkbox" name="send_escrow" value="1" id="od_send_escrow"><i></i>에스크로배송등록</label>
    </div>

    <?php echo $frm_submit; ?>

    </form>
</div>