<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shop/optionstocklist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<style>
.admin-shop-optionstocklist #admin-shop-optionstocklist img {display:block;width:100% \9;max-width:100%;height:auto}
</style>

<div class="admin-shop-optionstocklist">
    <div class="adm-headline">
        <h3>상품옵션재고관리</h3>
    </div>

    <form id="fsearch" name="fsearch" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    <input type="hidden" name="sst" id="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" id="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">

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
                        <td colspan="3">
                            <div <?php if (!G5_IS_MOBILE) { ?>class="inline-group"<?php } ?>>
                                <div class="margin-bottom-5">
                                    <label class="select form-width-150px">
                                        <select name="sfl" id="sfl">
                                            <option value="it_name" <?php echo get_selected($sfl, 'it_name'); ?>>상품명</option>
                                            <option value="it_id" <?php echo get_selected($sfl, 'it_id'); ?>>상품코드</option>
                                            <option value="it_maker" <?php echo get_selected($sfl, 'it_maker'); ?>>제조사</option>
                                            <option value="it_origin" <?php echo get_selected($sfl, 'it_origin'); ?>>원산지</option>
                                            <option value="it_sell_email" <?php echo get_selected($sfl, 'it_sell_email'); ?>>판매자 e-mail</option>
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
                    <?php if (!G5_IS_MOBILE) { ?>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">기간검색</label>
                        </th>
                        <td colspan="3">
                            <div class="inline-group">
                                <div class="margin-bottom-5">
                                    <label class="select form-width-150px">
                                        <select name="sdt" id="sdt">
                                            <option value="it_time" <?php echo get_selected($sdt, 'it_time'); ?>>등록일</option>
                                            <option value="it_update_time" <?php echo get_selected($sdt, 'it_update_time'); ?>>수정일</option>
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
                    <tr>
                        <th class="table-form-th">
                            <label class="label">카테고리</label>
                        </th>
                        <td colspan="3">
                            <div class="inline-group">
                                <span>
                                    <label class="select form-width-150px">
                                        <select name="cate_a" id="cate_1" onchange="fsearchform_submit(1);">
                                            <option value="">::대분류::</option>
                                            <?php foreach ($cate1 as $ca) { ?>
                                            <option value="<?php echo $ca['ca_id']; ?>" <?php echo $cate_a == $ca['ca_id'] ? 'selected':''; ?>><?php echo $ca['ca_name']; ?></option>
                                            <?php } ?>
                                        </select><i></i>
                                    </label>
                                </span>
                                <span>
                                    <label class="select form-width-150px">
                                        <select name="cate_b" id="cate_2" onchange="fsearchform_submit(2);">
                                            <option value="">::중분류::</option>
                                            <?php foreach ($cate2 as $ca) { ?>
                                            <option value="<?php echo $ca['ca_id']; ?>" <?php echo $cate_b == $ca['ca_id'] ? 'selected':''; ?>><?php echo $ca['ca_name']; ?></option>
                                            <?php } ?>
                                        </select><i></i>
                                    </label>
                                </span>
                                <span>
                                    <label class="select form-width-150px">
                                        <select name="cate_c" id="cate_3" onchange="fsearchform_submit(3);">
                                            <option value="">::소분류::</option>
                                            <?php foreach ($cate3 as $ca) { ?>
                                            <option value="<?php echo $ca['ca_id']; ?>" <?php echo $cate_c == $ca['ca_id'] ? 'selected':''; ?>><?php echo $ca['ca_name']; ?></option>
                                            <?php } ?>
                                        </select><i></i>
                                    </label>
                                </span>
                                <span>
                                    <label class="select form-width-150px">
                                        <select name="cate_d" id="cate_4" onchange="fsearchform_submit(4);">
                                            <option value="">::세분류::</option>
                                            <?php foreach ($cate4 as $ca) { ?>
                                            <option value="<?php echo $ca['ca_id']; ?>" <?php echo $cate_d == $ca['ca_id'] ? 'selected':''; ?>><?php echo $ca['ca_name']; ?></option>
                                            <?php } ?>
                                        </select><i></i>
                                    </label>
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

    <div class="margin-bottom-30"></div>

    <div class="row">
        <div class="col col-9">
            <div class="margin-bottom-5">
                <span class="font-size-12 color-grey">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="margin-left-10 margin-right-10 color-light-grey">|</span>등록된 상품 <?php echo number_format($total_count); ?>건
                </span>
            </div>
        </div>
        <div class="col col-3">
            <section>
                <label for="sort_list" class="select" style="width:200px;float:right;">
                    <select name="sort_list" id="sort_list" onchange="sorting_list(this.form, this.value);">
                        <option value="">:: 정렬방식선택 ::</option>
                        <option value="it_id|asc" <?php echo $sst=='it_id' && $sod == 'asc' ? 'selected':''; ?>>제품코드 정방향 (↓)</option>
                        <option value="it_id|desc" <?php echo $sst=='it_id' && $sod == 'desc' ? 'selected':''; ?>>제품코드 역방향 (↑) </option>
                        <option value="it_name|asc" <?php echo $sst=='it_name' && $sod == 'asc' ? 'selected':''; ?>>제품명 정방향 (↓)</option>
                        <option value="it_name|desc" <?php echo $sst=='it_name' && $sod == 'desc' ? 'selected':''; ?>>제품명 역방향 (↑) </option>
                        <option value="it_order|asc" <?php echo $sst=='it_order' && $sod == 'asc' ? 'selected':''; ?>>순서 정방향 (↓)</option>
                        <option value="it_order|desc" <?php echo $sst=='it_order' && $sod == 'desc' ? 'selected':''; ?>>순서 역방향 (↑) </option>
                        <option value="it_stock_qty|asc" <?php echo $sst=='it_stock_qty' && $sod == 'asc' ? 'selected':''; ?>>재고수량 정방향 (↓)</option>
                        <option value="it_stock_qty|desc" <?php echo $sst=='it_stock_qty' && $sod == 'desc' ? 'selected':''; ?>>재고수량 역방향 (↑) </option>
                        <option value="it_price|asc" <?php echo $sst=='it_price' && $sod == 'asc' ? 'selected':''; ?>>판매가격 정방향 (↓)</option>
                        <option value="it_price|desc" <?php echo $sst=='it_price' && $sod == 'desc' ? 'selected':''; ?>>판매가격 역방향 (↑) </option>
                        <option value="it_cust_price|asc" <?php echo $sst=='it_cust_price' && $sod == 'asc' ? 'selected':''; ?>>시중가격 정방향 (↓)</option>
                        <option value="it_cust_price|desc" <?php echo $sst=='it_cust_price' && $sod == 'desc' ? 'selected':''; ?>>시중가격 역방향 (↑) </option>
                        <option value="it_time|asc" <?php echo $sst=='it_time' && $sod == 'asc' ? 'selected':''; ?>>등록일 정방향 (↓)</option>
                        <option value="it_time|desc" <?php echo $sst=='it_time' && $sod == 'desc' ? 'selected':''; ?>>등록일 역방향 (↑) </option>
                        <option value="it_update_time|asc" <?php echo $sst=='it_update_time' && $sod == 'asc' ? 'selected':''; ?>>수정일 정방향 (↓)</option>
                        <option value="it_update_time|desc" <?php echo $sst=='it_update_time' && $sod == 'desc' ? 'selected':''; ?>>수정일 역방향 (↑) </option>
                    </select><i></i>
                </label>
            </section>
        </div>
    </div>

    </form>

    <form name="foptionstocklist" method="post" action="<?php echo $action_url1; ?>" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="sca" value="<?php echo $sca; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="sdt" value="<?php echo $sdt; ?>">
    <input type="hidden" name="fr_date" value="<?php echo $fr_date; ?>">
    <input type="hidden" name="to_date" value="<?php echo $to_date; ?>">
    <input type="hidden" name="cate_a" value="<?php echo $cate_a; ?>">
    <input type="hidden" name="cate_b" value="<?php echo $cate_b; ?>">
    <input type="hidden" name="cate_c" value="<?php echo $$cate_c; ?>">
    <input type="hidden" name="cate_d" value="<?php echo $cate_d; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">

    <?php if(G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="admin-shop-optionstocklist"></div>

    <?php if(!$wmode) { ?>
    <div class="margin-top-20">
        <input type="submit" name="act_button" value="일괄수정" class="btn-e btn-e-xs btn-e-red" onclick="document.pressed=this.value">
    </div>
    <?php } ?>

    </form>
</div>

<div class="modal fade admin-iframe-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">상품 관리</h4>
            </div>
            <div class="modal-body">
                <iframe id="modal-iframe" width="100%" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn-e btn-e-lg btn-e-dark" type="button"><i class="fas fa-times"></i> 닫기</button>
            </div>
        </div>
    </div>
</div>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>

<div class="margin-bottom-20"></div>

<div class="alert alert-info">
    <p>
        <i class="fas fa-info-circle"></i> 재고수정의 수치를 수정하시면 창고재고의 수치가 변경됩니다.<br>
        <i class="fas fa-info-circle"></i> 창고재고가 부족한 경우 재고수량 뒤에 <span class="sit_stock_qty_alert">!</span><span class="sound_only"> 혹은 재고부족</span>으로 표시됩니다.
    </p>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/jsgrid/jsgrid.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/js/jsgrid.js"></script>
<script>
function fsearchform_submit(num) {
    var f = document.fsearch;
    var number = parseInt(num)+1;
    
    for (var i=number; i<=4; i++) {
        $("#cate_"+number).val('');
    }
    f.submit();
}

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

function eb_modal(href) {
    <?php if (!(G5_IS_MOBILE || $wmode)) { ?>
    $('.admin-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#modal-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.admin-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#modal-iframe").attr("src", href);
        $('#modal-iframe').height(parseInt($(window).height() * 0.85));
        $('html').css({overflow: 'hidden'});
    });
    <?php } ?>
    return false;
}

window.closeModal = function(url){
    $('.admin-iframe-modal').modal('hide');
    document.location.href = url;
};

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
                return !(filter.체크 && !(client.체크.indexOf(filter.체크) > -1) )
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        {
            관리: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=itemform&amp;it_id=<?php echo $list[$i]['it_id']; ?>&amp;w=u&amp;ca_id=<?php echo $list[$i]['ca_id']; ?><?php echo $qstr ? '&amp;'.$qstr:''; ?>'><u>수정</u></a><a href='<?php echo $list[$i]['href']; ?>' target='_blank' class='margin-left-10'><u>보기</u></a>",
            제품코드: "<input type='hidden' name='it_id[<?php echo $i; ?>]' value='<?php echo $list[$i]['it_id']; ?>' id='it_id_<?php echo $i; ?>'><a <?php if (!(G5_IS_MOBILE || $wmode)) { ?>href='<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=itemform&amp;it_id=<?php echo $list[$i]['it_id']; ?>&amp;w=u&amp;wmode=1' onclick='eb_modal(this.href); return false;'<?php } else { ?>href='javascript:void(0);'<?php } ?>><i class='fas fa-external-link-alt color-light-grey margin-right-5 hidden-xs'></i><strong><?php echo $list[$i]['it_id']; ?></strong></a>",
            이미지: "<div style='width:50px;margin:0 auto'><a href='<?php echo $list[$i]['href']; ?>' target='_blank'><?php echo $list[$i]['image']; ?></a></div>",
            제품명: "<?php echo get_text($list[$i]['it_name']); ?>",
            옵션항목: "<?php echo $list[$i]['option']; ?>",
            옵션타입: "<?php echo $list[$i]['type']; ?>",
            창고재고: "<?php echo $list[$i]['io_stock_qty']; ?>",
            주문대기: "<?php echo number_format($list[$i]['wait_qty']); ?>",
            가재고: "<?php echo number_format($list[$i]['temporary_qty']); ?>",
            재고수정: "<label class='input'><input type='text' name='io_stock_qty[<?php echo $i; ?>]' id='stock_qty_<?php echo $i; ?>' value='<?php echo $list[$i]['io_stock_qty']; ?>' autocomplete='off'>",
            통보수량: "<label class='input'><input type='text' name='io_noti_qty[<?php echo $i; ?>]' id='noti_qty_<?php echo $i; ?>' value='<?php echo $list[$i]['io_noti_qty']; ?>' autocomplete='off'>",
            판매: "<label class='checkbox'><input type='checkbox' name='io_use[<?php echo $i; ?>]' id='use_<?php echo $i; ?>' value='1' <?php echo $list[$i]['io_use'] ? 'checked':''; ?>><i></i></label>",
        },
        <?php } ?>
    ]
}();

$(document).ready(function(){
    $("#admin-shop-optionstocklist").jsGrid({
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
            { name: "관리", type: "text", align: "center", width: 80, headercss: "set-btn-header", css: "set-btn-field" },
            { name: "제품코드", type: "text", align:"center", width: 130 },
            { name: "이미지", type: "image", align: "center", width: 60 },
            { name: "제품명", type: "text", width: 280 },
            { name: "옵션항목", type: "number", width: 150 },
            { name: "옵션타입", type: "number", width: 80 },
            { name: "창고재고", type: "number", width: 80 },
            { name: "주문대기", type: "number", width: 80 },
            { name: "가재고", type: "number", width: 80 },
            { name: "재고수정", type: "number", width: 80 },
            { name: "통보수량", type: "number", width: 80 },
            { name: "판매", type: "text", align: "center", width: 60 },
        ]
    })
    $("#sort").click(function() {
        var field = $("#sortingField").val();
        $("#admin-shop-optionstocklist").jsGrid("sort", field);
    });
});

function sorting_list(f, str) {
    var sort = str.split('|');

    $("#sst").val(sort[0]);
    $("#sod").val(sort[1]);

    if (sort[0] && sort[1]) {
        f.submit();
    }
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
        document.getElementById("fr_date").value = "<?php echo date('Y-m-d', strtotime('-'.$date_term.' days', G5_SERVER_TIME)); ?>";
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