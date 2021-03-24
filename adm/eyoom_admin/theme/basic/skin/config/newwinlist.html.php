<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/config/newwinlist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-newwinlist">
    <form id="fsearch" name="fsearch" class="eyoom-form" method="get" class="eyoom-form">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">

    <div class="adm-headline adm-headline-btn">
        <h3>팝업레이어 관리</h3>
        <?php if (!$wmode) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=config&pid=newwinform" class="btn-e btn-e-red btn-e-lg"><i class="fas fa-plus"></i> 팝업레이어 추가</a>
        <?php } ?>
    </div>

    <div class="adm-table-form-wrap adm-search-box">
        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label for="stx" class="label">팝업제목</label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" autocomplete="off">
                            </label>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label for="device" class="label">접속기기</label>
                        </th>
                        <td>
                            <label class="select form-width-250px">
                                <select name="nw_device" id="nw_division">
                                    <option value="">전체</option>
                                    <option value="both"  <?php echo get_selected($nw['nw_device'], 'both', true); ?>>PC와 모바일</option>
                                    <option value="pc"  <?php echo get_selected($nw['nw_device'], 'pc', true); ?>>PC</option>
                                    <option value="mobile"  <?php echo get_selected($nw['nw_device'], 'mobile', true); ?>>모바일</option>
                                </select><i></i>
                            </label>
                        </td>
                    </tr>
                    <?php if (!G5_IS_MOBILE) { ?>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">날짜검색</label>
                        </th>
                        <td colspan="3">
                            <div class="inline-group">
                                <div class="margin-bottom-5">
                                    <label class="select form-width-150px">
                                        <select name="sdt" id="sdt">
                                            <option value="nw_begin_time" <?php echo get_selected($sdt, 'nw_begin_time'); ?>>시작일</option>
                                            <option value="nw_end_time" <?php echo get_selected($sdt, 'nw_end_time'); ?>>종료일</option>
                                        </select><i></i>
                                    </label>
                                </div>
                                <span>
                                    <label class="input form-width-150px">
                                        <input type="text" id="fr_date" name="fr_date" value="<?php echo $fr_date; ?>" maxlength="10">
                                    </label>
                                </span>
                                <span> - </span>
                                <span>
                                    <label class="input form-width-150px">
                                        <input type="text" id="to_date" name="to_date" value="<?php echo $to_date; ?>" maxlength="10">
                                    </label>
                                </span>
                                <span class="search-btns">
                                    <button type="button" onclick="javascript:set_date('오늘');" class="btn-e btn-e-sm btn-e-default">오늘</button>
                                    <button type="button" onclick="javascript:set_date('어제');" class="btn-e btn-e-sm btn-e-default">어제</button>
                                    <button type="button" onclick="javascript:set_date('이번주');" class="btn-e btn-e-sm btn-e-default">이번주</button>
                                    <button type="button" onclick="javascript:set_date('이번달');" class="btn-e btn-e-sm btn-e-default">이번달</button>
                                    <button type="button" onclick="javascript:set_date('지난주');" class="btn-e btn-e-sm btn-e-default">지난주</button>
                                    <button type="button" onclick="javascript:set_date('지난달');" class="btn-e btn-e-sm btn-e-default">지난달</button>
                                    <button type="button" onclick="javascript:set_date('전체');" class="btn-e btn-e-sm btn-e-default">전체</button>
                                </span>
                            </div>
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

    <?php echo $frm_submit;?>

    </form>
    <div class="margin-bottom-30"></div>

    <div class="margin-bottom-5">
        <span class="font-size-12 color-grey">
            전체 <?php echo number_format($total_count); ?>건
        </span>
    </div>

    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="newwin-list"></div>
</div>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/jsgrid/jsgrid.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/js/jsgrid.js"></script>
<script>
$(document).ready(function(){
    $('#fr_date').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        prevText: '<i class="fas fa-angle-left"></i>',
        nextText: '<i class="fas fa-angle-right"></i>',
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
        prevText: '<i class="fas fa-angle-left"></i>',
        nextText: '<i class="fas fa-angle-right"></i>',
        showMonthAfterYear: true,
        monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
        onSelect: function(selectedDate){
            $('#fr_date').datepicker('option', 'maxDate', selectedDate);
        }
    });
});

!function () {
    var db = {
        deleteItem: function (deletingClient) {
            var clientIndex = $.inArray(deletingClient, this.clients);
            this.clients.splice(clientIndex, 1)
        },
        insertItem: function (insertingClient) {
            this.clients.push(insertingClient)
        },
        loadData  : function (filter) {
            return $.grep(this.clients, function (client) {
                return !(filter.No && !(client.No.indexOf(filter.No) > -1) || filter.제목 && !(client.제목.indexOf(filter.제목) > -1))
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        {
            No: "<?php echo $list[$i]['nw_id']; ?>",
            관리: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=config&amp;pid=newwinform&amp;w=u<?php if ($qstr) { ?>&amp;<?php echo $qstr; ?><?php } ?>&amp;nw_id=<?php echo $list[$i]['nw_id']; ?>'><u>수정</u></a> <a href='<?php echo G5_ADMIN_URL; ?>/?dir=config&amp;pid=newwinformupdate&amp;w=d<?php if ($qstr) { ?>&amp;<?php echo $qstr; ?><?php } ?>&amp;nw_id=<?php echo $list[$i]['nw_id']; ?>&amp;smode=1' class='margin-left-10' onclick='return delete_confirm(this);'><u>삭제</u></a>",
            제목: "<span class='ellipsis'><?php echo $list[$i]['nw_subject']; ?></span>",
            접속기기: "<?php echo $list[$i]['device']; ?>",
            시작일시: "<?php echo substr($list[$i]['nw_begin_time'], 2, 14); ?>",
            종료일시: "<?php echo substr($list[$i]['nw_end_time'], 2, 14); ?>",
            시간: "<?php echo $list[$i]['nw_disable_hours']; ?>",
            Left: "<?php echo $list[$i]['nw_left']; ?>",
            Top: "<?php echo $list[$i]['nw_top']; ?>",
            Width: "<?php echo $list[$i]['nw_width']; ?>",
            Height: "<?php echo $list[$i]['nw_height']; ?>"
        },
        <?php } ?>
    ]
}();

$(document).ready(function() {
    $("#newwin-list").jsGrid({
        filtering      : false,
        editing        : false,
        sorting        : false,
        paging         : true,
        autoload       : true,
        controller     : db,
        deleteConfirm  : "정말로 삭제하시겠습니까?\n한번 삭제된 데이터는 복구할수 없습니다.",
        pageButtonCount: 5,
        pageSize       : <?php echo $config['cf_page_rows']; ?>,
        width          : "100%",
        height         : "auto",
        fields         : [
            { name: "No", type: "number", align: "center", width: 40 },
            { name: "관리", type: "button", align: "center", width: 110, headercss: "set-btn-header", css: "set-btn-field" },
            { name: "제목", type: "text", width: 200 },
            { name: "접속기기", type: "text", align: "center", width: 80 },
            { name: "시작일시", type: "text", align: "center", width: 110 },
            { name: "종료일시", type: "text", align: "center", width: 110 },
            { name: "시간", type: "text", align: "center", width: 60 },
            { name: "Left", type: "number", width: 60 },
            { name: "Top", type: "number", width: 60 },
            { name: "Width", type: "number", width: 60 },
            { name: "Height", type: "number", width: 60 },
        ]
    })
});

function delete_confirm() {
    if (confirm("정말로 해당 팝업을 삭제하시겠습니까?")) {
        return true;
    } else return false;
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