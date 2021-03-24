<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/member/visit_search.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-visit-search">
    <div class="adm-headline">
        <h3>접속자검색</h3>
    </div>

    <form name="fvisit" id="fvisit" method="get" class="eyoom-form" onsubmit="return fvisit_submit(this);">
    <input type="hidden" name="dir" id="dir" value="<?php echo $dir; ?>">
    <input type="hidden" name="pid" id="pid" value="<?php echo $pid; ?>">

    <div class="adm-table-form-wrap adm-search-box">
        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">검색어</label>
                        </th>
                        <td>
                            <div <?php if (!G5_IS_MOBILE) { ?>class="inline-group"<?php } ?>>
                                <div class="margin-bottom-5">
                                    <label class="select form-width-150px">
                                        <select name="sfl" id="sch_sort" class="search_sort">
                                            <option value="vi_ip" <?php echo get_selected($sfl, 'vi_ip'); ?>>IP</option>
                                            <option value="vi_referer" <?php echo get_selected($sfl, 'vi_referer'); ?>>접속경로</option>
                                        </select><i></i>
                                    </label>
                                </div>
                                <span>
                                    <label class="input form-width-250px">
                                        <input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" autocomplete="off">
                                    </label>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">기간별 검색</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <span>
                                    <label class="input">
                                        <input type="text" id="fr_date" name="fr_date" value="<?php echo $fr_date; ?>" maxlength="10">
                                    </label>
                                </span>
                                <span> - </span>
                                <span>
                                    <label class="input">
                                        <input type="text" id="to_date" name="to_date" value="<?php echo $to_date; ?>" maxlength="10">
                                    </label>
                                </span>
                                <?php if (!G5_IS_MOBILE) { ?>
                                <span class="search-btns">
                                    <button type="button" onclick="javascript:set_date('오늘');" class="btn-e btn-e-sm btn-e-default">오늘</button>
                                    <button type="button" onclick="javascript:set_date('어제');" class="btn-e btn-e-sm btn-e-default">어제</button>
                                    <button type="button" onclick="javascript:set_date('이번주');" class="btn-e btn-e-sm btn-e-default">이번주</button>
                                    <button type="button" onclick="javascript:set_date('이번달');" class="btn-e btn-e-sm btn-e-default">이번달</button>
                                    <button type="button" onclick="javascript:set_date('지난주');" class="btn-e btn-e-sm btn-e-default">지난주</button>
                                    <button type="button" onclick="javascript:set_date('지난달');" class="btn-e btn-e-sm btn-e-default">지난달</button>
                                </span>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php if (!G5_IS_MOBILE) { ?>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php echo $frm_submit; ?>

    </form>
    <div class="margin-bottom-30"></div>

    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="visit-search"></div>
</div>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/jsgrid/jsgrid.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/js/jsgrid.js"></script>
<script>
$(document).ready(function() {
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
                return !(filter.IP && !(client.IP.indexOf(filter.IP) > -1) || filter.접속경로 && !(client.접속경로.indexOf(filter.접속경로) > -1))
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        {
            IP: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=visit_search&sfl=vi_ip&amp;stx=<?php echo $list[$i]['ip']; ?>'><?php echo $list[$i]['ip']; ?></a>",
            접속경로: "<?php echo $list[$i]['link'].$list[$i]['title']; ?><?php echo $list[$i]['link'] ? '</a>' : ''; ?>",
            브라우저: "<?php echo $list[$i]['brow']; ?>",
            OS: "<?php echo $list[$i]['os']; ?>",
            접속기기: "<?php echo $list[$i]['device']; ?>",
            일시: "<?php echo $list[$i]['vi_date'] . ' ' . $list[$i]['vi_time']; ?>"
        },
        <?php } ?>
    ]
}();

$(document).ready(function(){
    $("#visit-search").jsGrid({
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
            { name: "IP", type: "text", width: 130 },
            { name: "접속경로", type: "text", width: 300 },
            { name: "브라우저", type: "text", width: 100 },
            { name: "OS", type: "text", width: 100 },
            { name: "접속기기", type: "text", width: 100 },
            { name: "일시", type: "text", width: 130 },
        ]
    })
});

function fvisit_submit(f) {
    return true;
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
    }
}
</script>