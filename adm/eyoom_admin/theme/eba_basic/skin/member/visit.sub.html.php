<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/member/visit.sub.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-visit-list">
    <form name="fvisit" id="fvisit" method="get" class="eyoom-form">
    <input type="hidden" name="dir" id="dir" value="<?php echo $dir; ?>">
    <input type="hidden" name="pid" id="pid" value="<?php echo $pid; ?>">

    <div class="adm-headline">
        <h3><?php echo $g5_subtitle; ?></h3>
    </div>

    <?php if (G5_IS_MOBILE) { ?>
    <a class="collapse-search-btn btn-e btn-e-sm btn-e-dark m-b-20" data-bs-toggle="collapse" href="#collapse-search-box"><i class="fas fa-search m-r-7"></i><span>검색 조건 열기</span></a>
    <?php } ?>
    <div id="collapse-search-box" class="<?php if (G5_IS_MOBILE) { ?>panel-collapse collapse<?php } ?> m-b-20">
        <div class="adm-form-table adm-search-box m-b-20">
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label class="label">기간별 검색</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <span>
                            <label class="input max-width-150px">
                                <input type="text" id="fr_date" name="fr_date" value="<?php echo $fr_date; ?>" maxlength="10" autocomplete="off">
                            </label>
                        </span>
                        <span> - </span>
                        <span>
                            <label class="input max-width-150px">
                                <input type="text" id="to_date" name="to_date" value="<?php echo $to_date; ?>" maxlength="10" autocomplete="off">
                            </label>
                        </span>
                        <span class="search-btns">
                            <button type="button" onclick="javascript:set_date('오늘');" class="btn-e btn-e-xs btn-e-gray">오늘</button>
                            <button type="button" onclick="javascript:set_date('어제');" class="btn-e btn-e-xs btn-e-gray">어제</button>
                            <button type="button" onclick="javascript:set_date('이번주');" class="btn-e btn-e-xs btn-e-gray">이번주</button>
                            <button type="button" onclick="javascript:set_date('이번달');" class="btn-e btn-e-xs btn-e-gray">이번달</button>
                            <button type="button" onclick="javascript:set_date('지난주');" class="btn-e btn-e-xs btn-e-gray">지난주</button>
                            <button type="button" onclick="javascript:set_date('지난달');" class="btn-e btn-e-xs btn-e-gray">지난달</button>
                            <button type="button" onclick="javascript:set_date('전체');" class="btn-e btn-e-xs btn-e-gray">전체</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="confirm-bottom-btn">
            <?php echo $frm_submit;?>
        </div>
    </div>

    </form>

    <div class="pg-anchor">
        <div class="pg-anchor-in">
            <ul class="nav nav-tabs">
            <?php foreach ($pg_mode as $vmode => $str) { ?>
                <li><a href="<?php echo $visit_link[$vmode]; ?>" class="anchor-menu <?php if ($visit_mode == $vmode) { ?>active<?php } ?>"><?php echo $str; ?></a></li>
            <?php } ?>
            </ul>
            <div class="tab-bottom-line"></div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#fr_date').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
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
        dateFormat: 'yy-mm-dd',
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
})

function fvisit_submit(act) {
    var f = document.fvisit;
    f.action = act;
    f.submit();
}

function set_date(today) {
    <?php
    $date_term = date('w', G5_SERVER_TIME);
    $week_term = $date_term + 7;
    $last_term = strtotime(date('Y-m-01', G5_SERVER_TIME));
    ?>
    if (today == "오늘") {
        document.getElementById("fr_date").value = "<?php echo G5_TIME_YMD; ?>";
        document.getElementById("to_date").value = "<?php echo G5_TIME_YMD; ?>";
    } else if (today == "어제") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME - 86400); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME - 86400); ?>";
    } else if (today == "이번주") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-d', strtotime('-'.($date_term + 6).' days', G5_SERVER_TIME)); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME); ?>";
    } else if (today == "이번달") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-01', G5_SERVER_TIME); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME); ?>";
    } else if (today == "지난주") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-d', strtotime('-'.$week_term.' days', G5_SERVER_TIME)); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-d', strtotime('-'.($week_term - 6).' days', G5_SERVER_TIME)); ?>";
    } else if (today == "지난달") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-01', strtotime('-1 Month', $last_term)); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-t', strtotime('-1 Month', $last_term)); ?>";
    } else if (today == "전체") {
        document.getElementById("fr_date").value = "";
        document.getElementById("to_date").value = "";
    }
}
</script>