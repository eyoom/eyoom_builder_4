<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shopetc/sale1.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'sale1';
$g5_title = '매출현황';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">쇼핑몰현황/기타</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-shop-sale1">
    <div class="adm-headline">
        <h3>일일 매출</h3>
    </div>

    <form id="frm_sale_today" name="frm_sale_today" action="<?php echo G5_ADMIN_URL; ?>" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>">
    <input type="hidden" name="pid" value="sale1today">

    <div class="adm-form-table adm-search-box m-b-20">
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="date" class="label">하루</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <i class="icon-append far fa-calendar-alt"></i>
                    <input type="text" name="date" value="<?php echo date("Ymd", G5_SERVER_TIME); ?>" id="date" required maxlength="8">
                </label>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <input type="submit" value="확인" class="btn-e btn-e-lg btn-e-dark">
    </div>

    </form>
    <div class="m-b-20"></div>

    <div class="adm-headline">
        <h3>일간 매출</h3>
    </div>

    <form id="frm_sale_date" name="frm_sale_date" action="<?php echo G5_ADMIN_URL; ?>" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>">
    <input type="hidden" name="pid" value="sale1date">

    <div class="adm-form-table adm-search-box m-b-20">
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="fr_date" class="label">시작일</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append far fa-calendar-alt"></i>
                        <input type="text" name="fr_date" id="fr_date" value="<?php echo date("Ym01", G5_SERVER_TIME); ?>" required>
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="to_date" class="label">종료일</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append far fa-calendar-alt"></i>
                        <input type="text" name="to_date" id="to_date" value="<?php echo date("Ymd", G5_SERVER_TIME); ?>" required>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <input type="submit" value="확인" class="btn-e btn-e-lg btn-e-dark">
    </div>

    </form>
    <div class="m-b-20"></div>

    <div class="adm-headline">
        <h3>월간 매출</h3>
    </div>

    <form id="frm_sale_month" name="frm_sale_month" action="<?php echo G5_ADMIN_URL; ?>" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>">
    <input type="hidden" name="pid" value="sale1month">

    <div class="adm-form-table adm-search-box m-b-20">
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="fr_month" class="label">시작월</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append far fa-calendar-alt"></i>
                        <input type="text" name="fr_month" id="fr_month" value="<?php echo date("Y01", G5_SERVER_TIME); ?>" required>
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="to_month" class="label">종료월</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append far fa-calendar-alt"></i>
                        <input type="text" name="to_month" id="to_month" value="<?php echo date("Ym", G5_SERVER_TIME); ?>" required>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <input type="submit" value="확인" class="btn-e btn-e-lg btn-e-dark">
    </div>

    </form>
    <div class="m-b-20"></div>

    <div class="adm-headline">
        <h3>연간 매출</h3>
    </div>

    <form id="frm_sale_year" name="frm_sale_year" action="<?php echo G5_ADMIN_URL; ?>" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>">
    <input type="hidden" name="pid" value="sale1year">

    <div class="adm-form-table adm-search-box m-b-20">
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="fr_year" class="label">시작년도</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append far fa-calendar-alt"></i>
                        <input type="text" name="fr_year" id="fr_year" value="<?php echo date("Y", G5_SERVER_TIME); ?>" required>
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="to_year" class="label">종료년도</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append far fa-calendar-alt"></i>
                        <input type="text" name="to_year" id="to_year" value="<?php echo date("Y", G5_SERVER_TIME); ?>" required>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <input type="submit" value="확인" class="btn-e btn-e-lg btn-e-dark">
    </div>

    </form>
</div>

<script>
$(document).ready(function(){
    $('#date').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yymmdd',
        prevText: '◁',
        nextText: '▷',
        showMonthAfterYear: true,
        monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNamesMin: ['일','월','화','수','목','금','토']
    });
});

$(document).ready(function(){
    $('#fr_date').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yymmdd',
        prevText: '◁',
        nextText: '▷',
        showMonthAfterYear: true,
        monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
        onSelect: function(selectedDate){
            $('#to_date').datepicker('option', 'minDate', selectedDate);
        }
    });
    $('#to_date').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yymmdd',
        prevText: '◁',
        nextText: '▷',
        showMonthAfterYear: true,
        monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
        onSelect: function(selectedDate){
            $('#fr_date').datepicker('option', 'maxDate', selectedDate);
        }
    });
});
</script>