<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shop/personalpaylist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-shop-personalpaylist">
    <div class="adm-headline adm-headline-btn">
        <h3>개인결제 관리</h3>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=personalpayform" class="btn-e btn-e-red btn-e-lg"><i class="fas fa-plus"></i> 개인결제 추가</a>
    </div>

    <form name="fsearch" id="fsearch" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">

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
                            <div class="inline-group">
                                <div class="margin-bottom-5">
                                    <label class="select form-width-150px">
                                        <select name="sfl" id="sfl">
                                            <option value="pp_id"<?php echo get_selected($sfl, "pp_id"); ?>>개인결제번호</option>
                                            <option value="pp_name"<?php echo get_selected($sfl, "pp_name"); ?>>이름</option>
                                            <option value="od_id"<?php echo get_selected($sfl, "od_id"); ?>>주문번호</option>
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

    <form name="fpersonalpaylist" id="fpersonalpaylist" action="<?php echo $action_url1; ?>" onsubmit="return fpersonalpaylist_submit(this);" method="post" class="eyoom-form">
    <input type="hidden" name="sst" id="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" id="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" id="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" id="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" id="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="">

    <div class="row">
        <div class="col-sm-8">
            <div class="margin-bottom-5 clearfix">
                <span class="font-size-12 color-grey">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="margin-left-10 margin-right-10 color-light-grey">|</span>전체 <?php echo number_format($total_count); ?>건
                </span>
            </div>
        </div>
    </div>

    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="admin-shop-personalpaylist"></div>

    <?php if (!$wmode) { ?>
    <div class="margin-top-20">
        <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
    </div>
    <?php } ?>
    </form>
</div>

<div class="modal fade personalpay-iframe-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 id="modalLabel" class="modal-title"><strong><i class="fas fa-ellipsis-v color-grey"></i> <span id="modal-title">개인결제 복사</span></strong></h4>
            </div>
            <div class="modal-body">
                <iframe id="personalpay-iframe" width="100%" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn-e btn-e-lg btn-e-dark" type="button"><i class="fas fa-times"></i> 닫기</button>
            </div>
        </div>
    </div>
</div>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/jsgrid/jsgrid.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/js/jsgrid.js"></script>
<script>
function eb_modal(href) {
    $('.personalpay-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#product-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.personalpay-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#personalpay-iframe").attr("src", href);
        $('#personalpay-iframe').height(260);
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

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
            체크: "<input type='hidden' name='pp_id[<?php echo $i; ?>]' value='<?php echo $list[$i]['pp_id']; ?>' id='pp_id_<?php echo $i; ?>'><label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' value='<?php echo $i; ?>' id='chk_<?php echo $i; ?>'><i></i></label>",
            관리: "<div class='text-center'><a href='<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=personalpayform&w=u&pp_id=<?php echo $list[$i]['pp_id']; ?><?php echo $qstr ? '&'.$qstr:''?>'><u>수정</u></a><a href='<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=personalpaycopy&pp_id=<?php echo $list[$i]['pp_id']; ?>&wmode=1' onclick='return eb_modal(this.href);' class='margin-left-10'><u>복사</u></a></div>",
            제목: "<?php echo get_text($list[$i]['pp_name']); ?>",
            주문번호: "<?php if ($list[$i]['od_id']) { ?><a href='<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=orderform&od_id=<?php echo $list[$i]['od_id']; ?>' target='_blank'><?php echo $list[$i]['od_id']; ?></a><?php } ?>",
            주문금액: "<?php echo number_format($list[$i]['pp_price']); ?>",
            입금금액: "<?php echo number_format($list[$i]['pp_receipt_price']); ?>",
            미수금액: "<?php echo number_format($list[$i]['pp_price'] - $list[$i]['pp_receipt_price']); ?>",
            입금방법: "<?php echo $list[$i]['pp_settle_case']; ?>",
            입금일: "<?php if (!is_null_time($list[$i]['pp_receipt_time'])) { echo substr($list[$i]['pp_receipt_time'],2,8); } ?>",
            사용: "<?php echo $list[$i]['pp_use'] ? '예': '아니오'; ?>"
        },
        <?php } ?>
    ]
}();

$(document).ready(function() {
    $("#admin-shop-personalpaylist").jsGrid({
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
            { name: "제목", type: "text", width: 150 },
            { name: "주문번호", type: "text", align: "center", width: 150 },
            { name: "주문금액", type: "number", width: 100 },
            { name: "입금금액", type: "number", width: 100 },
            { name: "미수금액", type: "number", width: 100 },
            { name: "입금방법", type: "text", width: 80 },
            { name: "입금일", type: "text", width: 100 },
            { name: "사용", type: "text", align: "center", width: 60 },
        ]
    });

    var $chk = $(".jsgrid-table th:first-child");
    if ($chk.text() == '체크') {
        var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>';
        $chk.html(html);
    }
});

$(function() {
    $(".personalpaycopy").on("click", function() {
        var href = this.href;
        window.open(href, "copywin", "left=100, top=100, width=600, height=300, scrollbars=0");
        return false;
    });
});

function fpersonalpaylist_submit(f) {
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