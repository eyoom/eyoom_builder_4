<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shopetc/orderprint.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'orderprint';
$g5_title = '주문내역출력';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">쇼핑몰현황/기타</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="ac-order-print-list">
    <div class="adm-headline">
        <h3>주문내역출력</h3>
        <?php if (!$wmode) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=orderlist" class="btn-e btn-e-md btn-e-dark adm-headline-btn"><span>주문내역 바로가기</span></a>
        <?php } ?>
    </div>

    <?php if(!$wmode) { ?>
    <div class="cont-text-bg m-b-20">
        <p class="bg-info"><i class="fas fa-info-circle"></i> 기간별 혹은 주문번호구간별 주문내역을 새창으로 출력할 수 있습니다.</p>
    </div>
    <?php } ?>

    <form id="forderprint" name="forderprint" class="eyoom-form" action="<?php echo $action_url1; ?>" method="post" onsubmit="return forderprintcheck(this);" autocomplete="off">
    <input type="hidden" name="case" value="1">
    
    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>기간별 출력</strong></div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">출력형식</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <label for="xls1" class="radio"><input type="radio" name="csv" id="xls1" value="xls"><i></i> MS엑셀 XLS 데이터</label>
                    <label for="csv1" class="radio"><input type="radio" name="csv" id="csv1" value="csv"><i></i> MS엑셀 CSV 데이터</label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="ct_status_p" class="label">출력대상 및 기간</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <span>
                        <label class="select width-200px">
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
                    </span>
                    <span>
                        <label class="input width-200px">
                            <i class="icon-append far fa-calendar-alt"></i>
                            <input type="text" name="fr_date" id="fr_date" value="<?php echo date("Ymd"); ?>" required maxlength="8">
                        </label>
                    </span>
                    <span>~</span>
                    <span>
                        <label class="input width-200px">
                            <i class="icon-append far fa-calendar-alt"></i>
                            <input type="text" name="to_date" id="to_date" value="<?php echo date("Ymd"); ?>" required maxlength="8">
                        </label>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn m-b-20">
        <input type="submit" value="출력 [새창]" class="btn-e btn-e-lg btn-e-crimson">
    </div>

    </form>

    <form id="forderprint" name="forderprint" class="eyoom-form" action="<?php echo $action_url1; ?>" method="post" onsubmit="return forderprintcheck(this);" autocomplete="off">
    <input type="hidden" name="case" value="2">
    
    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>주문번호구간별 출력</strong></div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">출력형식</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <label for="xls2" class="radio"><input type="radio" name="csv" id="xls2" value="xls"><i></i> MS엑셀 XLS 데이터</label>
                    <label for="csv2" class="radio"><input type="radio" name="csv" id="csv2" value="csv"><i></i> MS엑셀 CSV 데이터</label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="ct_status_n" class="label">출력대상 및 주문번호 구간</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <span>
                        <label class="select width-200px">
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
                    </span>
                    <span>
                        <label class="input width-200px">
                            <input type="text" name="fr_od_id" id="fr_od_id" required maxlength="20">
                        </label>
                    </span>
                    <span>~</span>
                    <span>
                        <label class="input width-200px">
                            <input type="text" name="to_od_id" id="to_od_id" required maxlength="20">
                        </label>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <input type="submit" value="출력 [새창]" class="btn-e btn-e-lg btn-e-crimson">
    </div>

    </form>
</div>

<script>
$(document).ready(function() {
    $('#fr_date').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yymmdd',
        changeMonth: true,
        changeYear: true,
        prevText: '◁',
        nextText: '▷',
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
        prevText: '◁',
        nextText: '▷',
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