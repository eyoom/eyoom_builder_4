<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/config/inorderlist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-shop-inorderlist">
    <form id="fsearch" name="fsearch" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">

    <div class="adm-headline">
        <h3>미완료주문</h3>
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
                                            <option value="od_id"<?php echo get_selected($sfl, "od_id"); ?>>주문번호</option>
                                        </select><i></i>
                                    </label>
                                </div>
                                <span>
                                    <label class="input form-width-250px">
                                        <input type="text" name="stx" value="<?php echo $stx; ?>" id="stx"  autocomplete="off">
                                    </label>
                                </span>
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

    <?php echo $frm_submit;?>

    </form>

    <div class="margin-bottom-30"></div>

    <form name="finorderlist" id="finorderlist" <?php echo $action_url1; ?> onsubmit="return finorderlist_submit(this);" method="post" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="">

    <div class="row">
        <div class="col-sm-8">
            <div class="margin-bottom-5 clearfix">
                <span class="font-size-12 color-grey">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="margin-left-10 margin-right-10">|</span>전체 <?php echo number_format($total_count); ?>건
                </span>
            </div>
        </div>
    </div>

    <?php if (G5_IS_MOBILE) {?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="admin-shop-inorderlist"></div>

    <div class="margin-top-20">
        <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
    </div>

    </form>
</div>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/jsgrid/jsgrid.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/js/jsgrid.js"></script>

<script>
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
            체크: "<input type='hidden' name='od_id[<?php echo $i; ?>]' value='<?php echo $list[$i]['od_id']; ?>' id='od_id_<?php echo $i; ?>'><label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' value='<?php echo $i; ?>' id='chk_<?php echo $i; ?>'><i></i></label>",
            관리: "<span class='text-center grid-buttons'><a href='<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=inorderform&w=u&od_id=<?php echo $list[$i]['od_id']; ?><?php echo $qstr ? '&'.$qstr:''; ?>'><u>수정</u></a><a href='<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=inorderformupdate&w=d&od_id=<?php echo $list[$i]['od_id']; ?><?php echo $qstr ? '&'.$qstr:''; ?>'  onclick='return delete_confirm(this);' class='margin-left-10'><u>삭제</u></a></span>",
            주문번호: "<?php echo $list[$i]['od_id']; ?>",
            PG: "<?php echo $list[$i]['pg']; ?>",
            주문자: "<?php echo get_text($list[$i]['od_name']); ?>",
            주문자전화: "<?php echo get_text($list[$i]['od_tel']); ?>",
            받는분: "<?php echo get_text($list[$i]['od_b_name']); ?>",
            주문금액: "<?php echo number_format($list[$i]['price']); ?>",
            결제방법: "<?php echo $list[$i]['od_settle_case']; ?>",
            주문일시: "<?php echo $list[$i]['dt_time']; ?>"
        },
        <?php } ?>
    ]
}();

$(document).ready(function(){
    $("#admin-shop-inorderlist").jsGrid({
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
            { name: "관리", type: "text", align: "center", width: 110, headercss: "set-btn-header", css: "set-btn-field" },
            { name: "주문번호", type: "text", align: "center", width: 150 },
            { name: "PG", type: "text", width: 100 },
            { name: "주문자", type: "text", width: 100 },
            { name: "주문자전화", type: "text", width: 100 },
            { name: "받는분", type: "text", width: 100 },
            { name: "주문금액", type: "text", width: 100 },
            { name: "결제방법", type: "text", align: "center", width: 120 },
            { name: "주문일시", type: "text", align: "center", width: 160 }
        ]
    });

    var $chk = $(".jsgrid-table th:first-child");
    if ($chk.text() == '체크') {
        var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>';
        $chk.html(html);
    }
});

function finorderlist_submit(f) {
    if (!is_checked("chk[]")) {
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
</script>