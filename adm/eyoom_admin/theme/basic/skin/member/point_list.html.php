<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/member/point_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-point-list">
    <form name="fsearch" id="fsearch" class="eyoom-form" method="get">
    <input type="hidden" name="dir" id="dir" value="<?php echo $dir; ?>">
    <input type="hidden" name="pid" id="pid" value="<?php echo $pid; ?>">

    <div class="adm-headline">
        <h3>포인트 관리</h3>
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
                            <label class="label">검색어</label>
                        </th>
                        <td colspan="3">
                            <div <?php if (!G5_IS_MOBILE) { ?>class="inline-group"<?php } ?>>
                                <div class="margin-bottom-5">
                                    <label class="select form-width-150px">
                                        <select name="sfl" id="sfl">
                                            <option value="mb_id"<?php echo get_selected($sfl, "mb_id"); ?>>아이디</option>
                                            <option value="po_content"<?php echo get_selected($sfl, 'po_content'); ?>>내용</option>
                                        </select><i></i>
                                    </label>
                                </span>
                                <div>
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

    <form name="fpointlist" id="fpointlist" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fpointlist_submit(this);" class="eyoom-form">
    <input type="hidden" name="sst" id="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" id="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="">

    <div class="row">
        <div class="col col-9">
            <div class="padding-top-5">
                <span class="font-size-12 color-grey">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="margin-left-10 margin-right-10 color-light-grey">|</span>전체 <?php echo number_format($total_count); ?> 건
                    <?php if (isset($mb['mb_id']) && $mb['mb_id']) { ?>
                    &nbsp;(<?php echo $mb['mb_id']; ?> 님 포인트 합계 : <?php echo number_format($mb['mb_point']); ?>점)
                    <?php } else { ?>
                    &nbsp;(전체 합계 <?php echo number_format($sum_point); ?>점)
                    <?php } ?>
                </span>
            </div>
        </div>
        <div class="col col-3">
            <section>
                <label for="sort_list" class="select" style="width:200px;float:right;">
                    <select name="sort_list" id="sort_list" onchange="sorting_list(this.form, this.value);">
                        <option value="">:: 정렬방식선택 ::</option>
                        <option value="mb_id|asc" <?php if ($sst=='mb_id' && $sod=='asc') echo 'selected'; ?>>회원아이디 정방향 (↓)</option>
                        <option value="mb_id|desc" <?php if ($sst=='mb_id' && $sod=='desc') echo 'selected'; ?>>회원아이디 역방향 (↑)</option>
                        <option value="po_content|asc" <?php if ($sst=='po_content' && $sod=='asc') echo 'selected'; ?>>포인트 내용 정방향 (↓)</option>
                        <option value="po_content|desc" <?php if ($sst=='po_content' && $sod=='desc') echo 'selected'; ?>>포인트 내용 역방향 (↑)</option>
                        <option value="po_point|asc" <?php if ($sst=='po_point' && $sod=='asc') echo 'selected'; ?>>포인트 정방향 (↓)</option>
                        <option value="po_point|desc" <?php if ($sst=='po_point' && $sod=='desc') echo 'selected'; ?>>포인트 역방향 (↑)</option>
                        <option value="po_datetime|asc" <?php if ($sst=='po_datetime' && $sod=='asc') echo 'selected'; ?>>일시 정방향 (↓)</option>
                        <option value="po_datetime|desc" <?php if ($sst=='po_datetime' && $sod=='desc') echo 'selected'; ?>>일시 역방향 (↑)</option>
                    </select><i></i>
                </label>
            </section>
        </div>
    </div>

    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="point-list"></div>

    <div class="margin-top-20">
        <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-dark btn-e-xs" onclick="document.pressed=this.value">
    </div>
    </form>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>

    <div class="margin-bottom-30"></div>

    <form name="fpointlist2" method="post" id="fpointlist2" action="<?php echo $action_url2; ?>" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="<?php echo $token ?>">

    <div class="adm-headline">
        <h3>개별회원 포인트 증감 설정</h3>
    </div>

    <div class="admin-search-box margin-bottom-30">
        <div class="row">
            <div class="col col-3">
                <section>
                    <label for="mb_id" class="label"><span class="color-red"><i class="fas fa-check"></i></span> 회원아이디</label>

                    <label class="input">
                        <input type="text" name="mb_id" id="mb_id" value="<?php echo $mb_id; ?>" required>
                    </label>
                    <div class="note">Note! '회원검색' 클릭후 회원아이디를 검색/선택하세요.</div>
                </section>
            </div>
            <div class="col col-2">
                <section class="label-height">
                    <a href='<?php echo G5_ADMIN_URL; ?>/?dir=member&amp;pid=member_list&amp;wmode=1' class="btn-e btn-e-sm btn-e-dark" onclick="eb_modal(this.href); return false;">회원검색</a>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col col-3">
                <section>
                    <label for="po_content" class="label"><span class="color-red"><i class="fas fa-check"></i></span> 포인트내용</label>
                    <label class="input">
                        <input type="text" name="po_content" id="po_content" value="" required>
                    </label>
                </section>
            </div>
            <div class="col col-2">
                <section>
                    <label for="po_point" class="label"><span class="color-red"><i class="fas fa-check"></i></span> 포인트</label>
                    <label class="input">
                        <input type="text" name="po_point" id="po_point" value="" required>
                    </label>
                </section>
            </div>
            <?php if ($config['cf_point_term'] > 0) { ?>
            <div class="col col-2">
                <section>
                    <label for="po_expire_term" class="label">포인트 유효기간</label>
                    <label class="input">
                        <i class="icon-append">일</i>
                        <input type="text" name="po_expire_term" id="po_expire_term" value="<?php echo $config['cf_point_term']; ?>">
                    </label>
                </section>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="text-center margin-bottom-30">
        <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">
    </div>
    </form>
</div>

<div class="modal fade admin-iframe-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">회원 검색 및 선택</h4>
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

<?php if (!(G5_IS_MOBILE || $wmode)) { ?>
function eb_modal(href) {
    $('.admin-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#modal-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.admin-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#modal-iframe").attr("src", href);
        $('#modal-iframe').height(parseInt($(window).height() * 0.85));
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

window.closeModal = function(){
    $('.admin-iframe-modal').modal('hide');
};
<?php } ?>

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
                return !(filter.체크 && !(client.체크.indexOf(filter.체크) > -1) || filter.회원아이디 && !(client.회원아이디.indexOf(filter.회원아이디) > -1))
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        {
            체크: "<label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $i; ?>'><i></i></label><input type='hidden' name='mb_id[<?php echo $i; ?>]' value='{.mb_id}' id='mb_id_<?php echo $i; ?>'><input type='hidden' name='po_id[<?php echo $i; ?>]' value='<?php echo $list[$i]['po_id']; ?>' id='po_id_<?php echo $i; ?>'>",
            회원아이디: "<span class='ellipsis'><?php echo $list[$i]['mb_id']; ?></span>",
            이름: "<strong><?php echo $list[$i]['mb_name']; ?></strong>",
            닉네임: "<span class='ellipsis'><?php echo $list[$i]['mb_nick']; ?></span>",
            포인트내용: "<?php if ($list[$i]['link']) { ?><a href='<?php echo get_eyoom_pretty_url($list[$i]['po_rel_table'],$list[$i]['po_rel_id']); ?>' target='_blank'><span class='ellipsis'><?php echo $list[$i]['po_content']; ?></span></a><?php } else { ?><span class='ellipsis'><?php echo $list[$i]['po_content']; ?></span><?php } ?>",
            포인트: "<?php echo number_format($list[$i]['po_point']); ?>",
            일시: "<?php echo $list[$i]['po_datetime']; ?>",
            만료일: "<?php echo $list[$i]['expire_date']; ?>",
            포인트합: "<?php echo number_format($list[$i]['po_mb_point']); ?>",
        },
        <?php } ?>
    ]
}();

$(function() {
    $("#point-list").jsGrid({
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
            { name: "체크", type: "text", width: 40 },
            { name: "회원아이디", type: "text", width: 100 },
            { name: "이름", type: "text", width: 120 },
            { name: "닉네임", type: "text", width: 120 },
            { name: "포인트내용", type: "text", width: 200 },
            { name: "포인트", type: "number", width: 80 },
            { name: "일시", type: "text", align: "center", width: 130 },
            { name: "만료일", type: "text", align: "center", width: 130 },
            { name: "포인트합", type: "number", width: 100 },
        ]
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
        f.action = "<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&pid=<?php echo $pid; ?>";
        f.submit();
    }
}

function fpointlist_submit(f) {
    if ($("input:checked").length == 0) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

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