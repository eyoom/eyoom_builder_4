<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shopetc/orderprint.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="ac-order-print-list">
    <div class="adm-headline adm-headline-btn">
        <h3>주문내역출력</h3>
        <?php if (!$wmode) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=orderlist" class="btn-e btn-e-lg btn-e-teal">주문내역 바로가기</a>
        <?php } ?>
    </div>

    <?php if(!$wmode) { ?>
    <div class="cont-text-bg">
        <p class="bg-info font-size-12"><i class="fas fa-info-circle"></i> 기간별 혹은 주문번호구간별 주문내역을 새창으로 출력할 수 있습니다.</p>
    </div>
    <?php } ?>
    <div class="margin-bottom-30"></div>

    <form id="forderprint" name="forderprint" class="eyoom-form" action="<?php echo $action_url1; ?>" method="post" onsubmit="return forderprintcheck(this);" autocomplete="off">
    <input type="hidden" name="case" value="1">

    <h5 class="margin-bottom-10"><strong>기간별 출력</strong></h5>
    <div class="admin-search-box margin-bottom-30">
        <section>
            <div class="inline-group">
                <label for="xls1" class="radio"><input type="radio" name="csv" id="xls1" value="xls"><i></i> MS엑셀 XLS 데이터</label>
                <label for="csv1" class="radio"><input type="radio" name="csv" id="csv1" value="csv"><i></i> MS엑셀 CSV 데이터</label>
            </div>
        </section>
        <div class="margin-hr-10"></div>
        <div class="row">
            <div class="col col-3">
                <section>
                    <label for="ct_status_p" class="label">출력대상</label>
                    <label class="select">
                        <select name="ct_status" id="ct_status_p">
                            <option value="주문">주문</option>
                            <option value="입금">입금</option>
                            <option value="준비">준비</option>
                            <option value="배송">배송</option>
                            <option value="완료">완료</option>
                            <option value="취소">취소</option>
                            <option value="반품">반품</option>
                            <option value="품절">품절</option>
                            <option value="">전체</option>
                        </select><i></i>
                    </label>
                </section>
            </div>
            <div class="col col-3">
                <section>
                    <label for="fr_date" class="label">기간 시작일</label>
                    <label class="input">
                        <i class="icon-append far fa-calendar-alt"></i>
                        <input type="text" name="fr_date" id="fr_date" value="<?php echo date("Ymd"); ?>" required maxlength="8">
                    </label>
                </section>
            </div>
            <div class="col col-3">
                <section>
                    <label for="to_date" class="label">기간 종료일</label>
                    <label class="input">
                        <i class="icon-append far fa-calendar-alt"></i>
                        <input type="text" name="to_date" id="to_date" value="<?php echo date("Ymd"); ?>" required maxlength="8">
                    </label>
                </section>
            </div>
            <div class="col col-3">
                <section class="label-height">
                    <input type="submit" value="출력 [새창]" class="btn-e btn-e-dark">
                </section>
            </div>
        </div>
    </div>
    </form>

    <form id="forderprint" name="forderprint" class="eyoom-form" action="<?php echo $action_url1; ?>" method="post" onsubmit="return forderprintcheck(this);" autocomplete="off">
    <input type="hidden" name="case" value="2">

    <h5 class="margin-bottom-10"><strong>주문번호구간별 출력</strong></h5>
    <div class="admin-search-box margin-bottom-30">
        <section>
            <div class="inline-group">
                <label for="xls2" class="radio"><input type="radio" name="csv" id="xls2" value="xls"><i></i> MS엑셀 XLS 데이터</label>
                <label for="csv2" class="radio"><input type="radio" name="csv" id="csv2" value="csv"><i></i> MS엑셀 CSV 데이터</label>
            </div>
        </section>
        <div class="margin-hr-10"></div>
        <div class="row">
            <div class="col col-3">
                <section>
                    <label for="ct_status_n" class="label">출력대상</label>
                    <label class="select">
                        <select name="ct_status" id="ct_status_n">
                            <option value="주문">주문</option>
                            <option value="입금">입금</option>
                            <option value="준비">준비</option>
                            <option value="배송">배송</option>
                            <option value="완료">완료</option>
                            <option value="취소">취소</option>
                            <option value="반품">반품</option>
                            <option value="품절">품절</option>
                            <option value="">전체</option>
                        </select><i></i>
                    </label>
                </section>
            </div>
            <div class="col col-3">
                <section>
                    <label for="fr_od_id" class="label">주문번호 구간 시작</label>
                    <label class="input">
                        <input type="text" name="fr_od_id" id="fr_od_id" required maxlength="20">
                    </label>
                </section>
            </div>
            <div class="col col-3">
                <section>
                    <label for="to_od_id" class="label">주문번호 구간 종료</label>
                    <label class="input">
                        <input type="text" name="to_od_id" id="to_od_id" required maxlength="20">
                    </label>
                </section>
            </div>
            <div class="col col-3">
                <section class="label-height">
                    <input type="submit" value="출력 [새창]" class="btn-e btn-e-dark">
                </section>
            </div>
        </div>
    </div>
    </form>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/eyoom-form/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
$(document).ready(function() {
    $('#fr_date').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yymmdd',
        changeMonth: true,
        changeYear: true,
        prevText: '<i class="fas fa-angle-left"></i>',
        nextText: '<i class="fas fa-angle-right"></i>',
        showMonthAfterYear: true,
        monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
        yearRange: "c-99:c+99",
        maxDate: "+0d",
        onSelect: function(selectedDate){
            $('#to_date').datepicker('option', 'minDate', selectedDate);
        }
    });
    $('#to_date').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yymmdd',
        changeMonth: true,
        changeYear: true,
        prevText: '<i class="fas fa-angle-left"></i>',
        nextText: '<i class="fas fa-angle-right"></i>',
        showMonthAfterYear: true,
        monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
        yearRange: "c-99:c+99",
        maxDate: "+0d",
        onSelect: function(selectedDate){
            $('#to_date').datepicker('option', 'maxDate', selectedDate);
        }
    });
});

function forderprintcheck(f) {
    if (f.csv[0].checked || f.csv[1].checked) {
        var url = f.action + '&smode=1';
        f.action = url;
        f.target = "_top";
    } else {
        var win = window.open("", "winprint", "left=10,top=10,width=670,height=800,menubar=yes,toolbar=yes,scrollbars=yes");
        f.target = "winprint";
    }

    f.submit();
}
</script>