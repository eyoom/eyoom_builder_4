<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/member/point_compress.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-compress-form">
    <form name="fcompressform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fcompress_check(this)" class="eyoom-form">

    <div class="adm-headline">
        <h3>포인트 압축하기</h3>
    </div>

    <div class="adm-table-form-wrap margin-bottom-30">
        <header><strong><i class="fas fa-caret-right"></i> 압축조건설정</strong></header>

        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">테이블 백업</label>
                        </th>
                        <td>
                            <label for="backup_use" class="checkbox">
                                <input type="checkbox" name="backup_use" id="backup_use" value="y" checked="checked"><i></i> 사용 (체크시, <?php echo $g5['point_table']; ?> 테이블을 <?php echo $g5['point_table']; ?>_YmdHis 형식으로 백업)
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">압축일자 지정</label>
                        </th>
                        <td>
                            <label for="zip_date" class="input form-width-250px">
                                <input type="text" name="zip_date" id="zip_date" value="<?php echo date('Y-m-d', strtotime('-1day')); ?>">
                            </label>
                            <div class="note margin-bottom-10"><strong>Note:</strong> 지정일을 포함하여 이전의 모든 포인트 내역을 압축합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">단위 압축회원수</label>
                        </th>
                        <td>
                            <label for="zip_count" class="input form-width-250px">
                                <i class="icon-append">명</i>
                                <input type="text" name="zip_count" id="zip_count" value="200">
                            </label>
                            <div class="note margin-bottom-10"><strong>Note:</strong> DB에 부하를 줄 수 있기 때문에 적당히 숫자를 조절해 주세요. (전체 일괄작업시, 숫자 '0' 입력)</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">포인트 내역수</label>
                        </th>
                        <td>
                            <label for="zip_item" class="input form-width-250px">
                                <i class="icon-append">건</i>
                                <input type="text" name="zip_item" id="zip_item" value="10">
                            </label>
                            <div class="note margin-bottom-10"><strong>Note:</strong>포인트 내역이 지정한 숫자 이상인 회원만 압축하기(최소 10건 이상)</div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php if (!G5_IS_MOBILE) { ?>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php if (isset($mcnt) || isset($pcnt)) { ?>
    <div class="adm-table-form-wrap margin-bottom-30">
        <header><strong><i class="fas fa-caret-right"></i> 압축결과</strong></header>

        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">압축회원수</label>
                        </th>
                        <td>
                            <?php echo number_format($mcnt); ?> 명 (압축회원수가 0이 될때까지 적용하시면 됩니다.)
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">압축된 포인트 내역</label>
                        </th>
                        <td>
                            <?php echo number_format($pcnt); ?> 건의 포인트 내역이 압축되었습니다.
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php if (!G5_IS_MOBILE) { ?>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>

    <?php echo $frm_submit; ?>

    </form>

</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/eyoom-form/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
function fpointzip_check(f) {
    if($("#zip_date").val().length != '10') {
        alert('압축일자를 정확히 입력해 주세요.');
        f.zip_date.focus();
        return false;
    }
    if($("#zip_count").val() == '') {
        alert('단위 압축회원수를 입력해 주세요.');
        f.zip_count.focus();
        return false;
    }
    if($("#zip_item").val() == '' || parseInt($("#zip_item").val()) < 10) {
        alert('포인트 내역수는 10보다 큰 정수여야 합니다.');
        f.zip_item.focus();
        return false;
    }
    if(!confirm("정말로 그누포인트를 압축하실 건가요?")) return false;
}

/*--------------------------------------
    Datepicker
--------------------------------------*/
$(document).ready(function(){
    $('#zip_date').datepicker({
        dateFormat: 'yy-mm-dd',
        prevText: '<i class="fa fa-angle-left"></i>',
        nextText: '<i class="fa fa-angle-right"></i>',
        showMonthAfterYear: true,
        monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
    });
})
</script>