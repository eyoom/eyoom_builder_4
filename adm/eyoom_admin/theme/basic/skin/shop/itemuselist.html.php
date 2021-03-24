<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shop/itemuselist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<style>
.admin-shop-itemqalist #admin-shop-itemqalist img {display:block;width:100% \9;max-width:100%;height:auto}
</style>

<div class="admin-shop-itemqalist">
    <div class="adm-headline">
        <h3>사용후기</h3>
    </div>

    <form id="flist" name="flist" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    <input type="hidden" name="sst" id="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" id="sod" value="<?php echo $sod; ?>">

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
                                        <select name="sfl" id="sfl">
                                            <option value="it_name" <?php echo get_selected($sfl, 'it_name'); ?>>상품명</option>
                                            <option value="a.it_id" <?php echo get_selected($sfl, 'a.it_id'); ?>>상품코드</option>
                                            <option value="is_name" <?php echo get_selected($sfl, 'is_name'); ?>>이름</option>
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
                                            <option value="is_time" <?php echo get_selected($sdt, 'it_time'); ?>>등록일</option>
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
                            <label class="label">분류선택</label>
                        </th>
                        <td>
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
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="margin-left-10 margin-right-10 color-light-grey">|</span>전체 후기내역 <?php echo number_format($total_count); ?>건
                </span>
            </div>
        </div>
        <div class="col col-3">
            <section>
                <label for="sort_list" class="select" style="width:200px;float:right;">
                    <select name="sort_list" id="sort_list" onchange="sorting_list(this.form, this.value);">
                        <option value="">:: 정렬방식선택 ::</option>
                        <option value="it_name|asc" <?php echo $sst=='it_name' && $sod == 'asc' ? 'selected':''; ?>>제품명 정방향 (↓)</option>
                        <option value="it_name|desc" <?php echo $sst=='it_name' && $sod == 'desc' ? 'selected':''; ?>>제품명 역방향 (↑) </option>
                        <option value="is_subject|asc" <?php echo $sst=='is_subject' && $sod == 'asc' ? 'selected':''; ?>>제목 정방향 (↓)</option>
                        <option value="is_subject|desc" <?php echo $sst=='is_subject' && $sod == 'desc' ? 'selected':''; ?>>제목 역방향 (↑) </option>
                        <option value="mb_name|asc" <?php echo $sst=='mb_name' && $sod == 'asc' ? 'selected':''; ?>>이름 정방향 (↓)</option>
                        <option value="mb_name|desc" <?php echo $sst=='mb_name' && $sod == 'desc' ? 'selected':''; ?>>이름 역방향 (↑) </option>
                        <option value="is_score|asc" <?php echo $sst=='is_score' && $sod == 'asc' ? 'selected':''; ?>>평점 정방향 (↓)</option>
                        <option value="is_score|desc" <?php echo $sst=='is_score' && $sod == 'desc' ? 'selected':''; ?>>평점 역방향 (↑) </option>
                        <option value="is_confirm|asc" <?php echo $sst=='is_confirm' && $sod == 'asc' ? 'selected':''; ?>>확인 정방향 (↓)</option>
                        <option value="is_confirm|desc" <?php echo $sst=='is_confirm' && $sod == 'desc' ? 'selected':''; ?>>확인 역방향 (↑) </option>
                    </select><i></i>
                </label>
            </section>
        </div>
    </div>

    </form>

    <form name="fitemqalist" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fitemqalist_submit(this);" autocomplete="off" class="eyoom-form">
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

    <div id="admin-shop-itemqalist"></div>

    <div class="margin-top-20">
        <input type="submit" name="act_button" value="선택수정" class="btn-e btn-e-xs btn-e-red" onclick="document.pressed=this.value">
        <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
    </div>

    </form>

</div>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/jsgrid/jsgrid.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/js/jsgrid.js"></script>
<script>
function fsearchform_submit(num) {
    var f = document.flist;
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
            체크: "<input type='hidden' name='is_id[<?php echo $i; ?>]' value='<?php echo $list[$i]['is_id']; ?>' id='is_id_<?php echo $i; ?>'><input type='hidden' name='it_id[<?php echo $i; ?>]' value='<?php echo $list[$i]['it_id']; ?>' id='it_id_<?php echo $i; ?>'><label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $i; ?>'><i></i></label>",
            관리: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=itemuseform&amp;is_id=<?php echo $list[$i]['is_id']; ?>&amp;w=u<?php echo $qstr ? '&amp;'.$qstr:''; ?>'><u>수정</u></a>",
            이미지: "<div style='width:50px;margin:0 auto;'><a href='<?php echo $list[$i]['href']; ?>' target='_blank'><?php echo $list[$i]['image']; ?></a></div></a>",
            상품코드_상품명: "<a href='<?php echo $list[$i]['href']; ?>' target='_blank' class='font-bold'><span class='color-grey'><?php echo $list[$i]['it_id']; ?></span><br><?php echo get_text($list[$i]['it_name']); ?></a>",
            제목: "<a href='#' class='qa_href' onclick='return false;' target='<?php echo $i; ?>'><?php echo get_text($list[$i]['is_subject']); ?></a>",
            이름: "<?php echo $list[$i]['is_name']; ?>",
            평점: "<label for='score_<?php echo $i; ?>' class='select'><select name='is_score[<?php echo $i; ?>]' id='score_<?php echo $i; ?>'><option value='5' <?php echo $list[$i]['is_score'] == '5' ? 'selected':''; ?>>매우만족</option><option value='4' <?php echo $list[$i]['is_score'] == '4' ? 'selected':''; ?>>만족</option><option value='3' <?php echo $list[$i]['is_score'] == '3' ? 'selected':''; ?>>보통</option><option value='2' <?php echo $list[$i]['is_score'] == '2' ? 'selected':''; ?>>불만</option><option value='1' <?php echo $list[$i]['is_score'] == '1' ? 'selected':''; ?>>매우불만</option></select><i></i></label>",
            등록일: "<?php echo date("Y-m-d", strtotime($list[$i]['is_time'])); ?>",
        },
        <?php } ?>
    ]
}();

$(document).ready(function(){
    $("#admin-shop-itemqalist").jsGrid({
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
            { name: "체크", type: "text", width: 30 },
            { name: "관리", type: "text", align: "center", width: 60, headercss: "set-btn-header", css: "set-btn-field" },
            { name: "이미지", type: "image", width: 60 },
            { name: "상품코드_상품명", type: "text", width: 200 },
            { name: "제목", type: "text", width: 300 },
            { name: "이름", type: "text", width: 100 },
            { name: "평점", type: "text", width: 120 },
            { name: "등록일", type: "text", align: "center", width: 100 },
        ]
    })
    $("#sort").click(function() {
        var field = $("#sortingField").val();
        $("#admin-shop-itemqalist").jsGrid("sort", field);
    });

    var $chk = $(".jsgrid-table th:first-child");
    if ($chk.text() == '체크') {
        var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>';
        $chk.html(html);
    }
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