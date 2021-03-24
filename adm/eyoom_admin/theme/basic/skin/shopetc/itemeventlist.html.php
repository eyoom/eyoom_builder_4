<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shopetc/itemeventlist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<style>
.admin-shop-itemeventlist #admin-shop-itemeventlist img {display:block;width:100% \9;max-width:100%;height:auto}
</style>

<div class="admin-shop-itemeventlist">
    <div class="adm-headline">
        <h3>이벤트 일괄처리</h3>
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
                            <label for="ev_id" class="label">이벤트</label>
                        </th>
                        <td>
                            <label class="select form-width-250px">
                                <select name="ev_id" id="ev_id" onchange="this.form.submit();">
                                    <?php echo $event_option; ?>
                                </select><i></i>
                            </label>
                            <div class="note"><strong>Note.</strong> 상품을 이벤트별로 일괄 처리합니다.<br><?php echo ($ev_title ? '현재 선택된 이벤트는 '.$ev_title.'입니다.' : '이벤트를 선택해 주세요.'); ?></div>
                        </td>
                    </tr>
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
                            <label class="label">카테고리</label>
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
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="margin-left-10 margin-right-10 color-light-grey">|</span>등록된 상품 <?php echo number_format($total_count); ?>건
                </span>
            </div>
        </div>
        <div class="col col-3">
            <section>
                <label for="sort_list" class="select" style="width:200px;float:right;">
                    <select name="sort_list" id="sort_list" onchange="sorting_list(this.form, this.value);">
                        <option value="">:: 정렬방식선택 ::</option>
                        <option value="a.it_id|asc" <?php echo $sst=='a.it_id' && $sod == 'asc' ? 'selected':''; ?>>제품코드 정방향 (↓)</option>
                        <option value="a.it_id|desc" <?php echo $sst=='a.it_id' && $sod == 'desc' ? 'selected':''; ?>>제품코드 역방향 (↑) </option>
                        <option value="it_name|asc" <?php echo $sst=='it_name' && $sod == 'asc' ? 'selected':''; ?>>제품명 정방향 (↓)</option>
                        <option value="it_name|desc" <?php echo $sst=='it_name' && $sod == 'desc' ? 'selected':''; ?>>제품명 역방향 (↑) </option>
                    </select><i></i>
                </label>
            </section>
        </div>
    </div>

    </form>

    <form name="fitemeventlistupdate" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fitemeventlistupdatecheck(this);" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="ev_id" value="<?php echo $ev_id; ?>">
    <input type="hidden" name="sca" value="<?php echo $sca; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="cate_a" value="<?php echo $cate_a; ?>">
    <input type="hidden" name="cate_b" value="<?php echo $cate_b; ?>">
    <input type="hidden" name="cate_c" value="<?php echo $$cate_c; ?>">
    <input type="hidden" name="cate_d" value="<?php echo $cate_d; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">

    <?php if(G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="admin-shop-itemeventlist"></div>

    <div class="text-center margin-top-20">
        <input type="submit" value="일괄수정" class="btn-e btn-e-red btn-e-lg">
    </div>

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
    <p class="font-size-12">
        <i class="fas fa-info-circle"></i> 상품을 이벤트별로 일괄 처리합니다.<br>
        <i class="fas fa-info-circle"></i> <?php echo ($ev_title ? '현재 선택된 이벤트는 '.$ev_title.'입니다.' : '이벤트를 선택해 주세요.'); ?><br>
        <?php if ($ev_title) { ?>
        <i class="fas fa-info-circle"></i> 현재 선택된 이벤트는 <strong><?php echo $ev_title; ?></strong>입니다.<br>
        <i class="fas fa-info-circle"></i> 선택된 이벤트의 상품 수정 내용을 반영하시려면 일괄수정 버튼을 누르십시오.
        <?php } else { ?>
        <i class="fas fa-info-circle"></i> 이벤트를 선택하지 않으셨습니다. <strong>수정 내용을 반영하기 전에 이벤트를 선택해주십시오.</strong>
        <?php } ?>
    </p>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/jsgrid/jsgrid.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/js/jsgrid.js"></script>
<script>
function fitemeventlistupdatecheck(f) {
    if (!f.ev_id.value) {
        alert('이벤트를 선택하세요');
        return false;
    }

    return true;
}

function fsearchform_submit(num) {
    var f = document.flist;
    var number = parseInt(num)+1;
    
    for (var i=number; i<=4; i++) {
        $("#cate_"+number).val('');
    }
    f.submit();
}

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
            체크: "<input type='hidden' name='it_id[<?php echo $i; ?>]' value='<?php echo $list[$i]['it_id']; ?>' id='it_id_<?php echo $i; ?>'><label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='1' <?php echo ($list[$i]['is_ev_item'] ? "checked" : ""); ?>><i></i></label>",
            제품코드: "<a <?php if (!(G5_IS_MOBILE || $wmode)) { ?>href='<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=itemform&amp;it_id=<?php echo $list[$i]['it_id']; ?>&amp;w=u&amp;wmode=1' onclick='eb_modal(this.href); return false;'<?php } else { ?>href='javascript:void(0);'<?php } ?>><i class='fas fa-external-link-alt color-light-grey margin-right-5 hidden-xs'></i><strong><?php echo $list[$i]['it_id']; ?></strong></a>",
            이미지: "<div style='width:50px;margin:0 auto'><a href='<?php echo $list[$i]['href']; ?>' target='_blank'><?php echo $list[$i]['image']; ?></a></div>",
            제품명: "<?php echo get_text($list[$i]['it_name']); ?>",
            판매가능: "<?php echo $list[$i]['it_use'] ? '<b class=\"color-indigo\">YES</b>':'<b class=\"color-pink\">NO</b>'; ?>",
            품절: "<?php echo $list[$i]['it_soldout'] ? '<b class=\"color-indigo\">YES</b>':'<b class=\"color-pink\">NO</b>'; ?>",
            재고수량: "<?php echo $list[$i]['it_stock_qty']; ?>",
            판매가격: "<?php echo number_format($list[$i]['it_price']); ?>",
            시중가격: "<?php echo number_format($list[$i]['it_cust_price']); ?>",
            등록일: "<?php echo date("Y-m-d", strtotime($list[$i]['it_time'])); ?>",
        },
        <?php } ?>
    ]
}();

$(document).ready(function(){
    $("#admin-shop-itemeventlist").jsGrid({
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
            { name: "제품코드", type: "text", align:"center", width: 130 },
            { name: "이미지", type: "image", width: 60 },
            { name: "제품명", type: "text", width: 280 },
            { name: "판매가능", type: "text", align:"center", width: 80 },
            { name: "품절", type: "text", align:"center", width: 80 },
            { name: "재고수량", type: "number", width: 80 },
            { name: "판매가격", type: "number", width: 80 },
            { name: "시중가격", type: "number", width: 100 },
            { name: "등록일", type: "text", align: "center", width: 100 },
        ]
    })
    $("#sort").click(function() {
        var field = $("#sortingField").val();
        $("#admin-shop-itemeventlist").jsGrid("sort", field);
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
</script>