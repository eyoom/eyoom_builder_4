<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/config/sendcostlist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-shop-sendcostlist">
    <form id="fsendcost" name="fsendcost" action="<?php echo $action_url1; ?>" method="post" onsubmit="return fsendcost_submit(this);" class="eyoom-form">
    <input type="hidden" name="w" value="d">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-headline">
        <h3>추가배송비 내역</h3>
    </div>

    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="admin-shop-sendcostlist"></div>

    <div class="margin-top-20">
        <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
    </div>
    </form>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>

    <div class="margin-bottom-30"></div>

    <form name="fsendcost2" id="fsendcost2" action="<?php echo $action_url1; ?>" method="post" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="token" value="">

    <div class="adm-headline">
        <h3>추가배송비 등록</h3>
    </div>

    <div class="adm-form-wrap margin-bottom-30">
        <header>
            <strong><i class="fas fa-caret-right"></i> 추가배송비 등록</strong>
        </header>

        <fieldset>
            <div class="row">
                <div class="col col-12">
                    <section>
                        <label for="sc_name" class="label">지역명</label>
                        <label class="input">
                            <input type="text" name="sc_name" id="sc_name" value="" required>
                        </label>
                    </section>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <div class="row">
                <div class="col col-2">
                    <section>
                        <label for="sc_zip1" class="label">우편번호 시작</label>
                        <label class="input">
                            <input type="text" name="sc_zip1" id="sc_zip1" value="" required>
                        </label>
                        <div class="note margin-bottom-10">
                            <strong>Note:</strong> (입력 예 : 01234)
                        </div>
                    </section>
                </div>
                <div class="col col-2">
                    <section>
                        <label for="sc_zip2" class="label">우편번호 끝</label>
                        <label class="input">
                            <input type="text" name="sc_zip2" id="sc_zip2" value="" required>
                        </label>
                        <div class="note margin-bottom-10">
                            <strong>Note:</strong> (입력 예 : 01234)
                        </div>
                    </section>
                </div>
                <div class="col col-4">
                    <section>
                        <label for="sc_price" class="label">추가배송비</label>
                        <label class="input">
                            <i class="icon-append">원</i>
                            <input type="text" name="sc_price" id="sc_price" value="" required>
                        </label>
                    </section>
                </div>
            </div>
        </fieldset>
    </div>

    <?php echo $frm_submit; ?>

    </form>
</div>

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
            체크: "<input type='hidden' name='sc_id[<?php echo $i; ?>]' value='<?php echo $list[$i]['sc_id']; ?>'><label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $i; ?>'><i></i></label>",
            지역명: "<?php echo $list[$i]['sc_name']; ?>",
            우편번호: "<?php echo $list[$i]['sc_zip1']; ?> ~ <?php echo $list[$i]['sc_zip2']; ?>",
            추가배송비: "<?php echo number_format($list[$i]['sc_price']); ?>",
        },
        <?php } ?>
    ]
}();

$(function() {
    $("#admin-shop-sendcostlist").jsGrid({
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
            { name: "지역명", type: "text", width: 150 },
            { name: "우편번호", type: "text", align: "center", width: 100 },
            { name: "추가배송비", type: "number", width: 100 }
        ]
    });

    var $chk = $(".jsgrid-table th:first-child");
    if ($chk.text() == '체크') {
        var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>';
        $chk.html(html);
    }
});

function fsendcost_submit(f) {
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