<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shop/couponzonelist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<style>
.admin-shop-couponzonelist #admin-shop-couponzonelist img {display:block;width:100% \9;max-width:100%;height:auto}
</style>

<div class="admin-shop-couponzonelist">
    <div class="adm-headline">
        <h3>쿠폰존관리</h3>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=couponzoneform" class="btn-e btn-e-red btn-e-lg"><i class="fas fa-plus"></i> 쿠폰추가</a>
    </div>

    <form id="fsearch" name="fsearch" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
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

    <div class="margin-bottom-30"></div>

    <div class="row">
        <div class="col col-9">
            <div class="margin-bottom-5">
                <span class="font-size-12 color-grey">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="margin-left-10 margin-right-10 color-light-grey">|</span>전체 <?php echo number_format($total_count); ?>개
                </span>
            </div>
        </div>
    </div>

    </form>

    <form name="fcouponzonelist" method="post" action="<?php echo $action_url1; ?>" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">

    <?php if(G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="admin-shop-couponzonelist"></div>

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
            체크: "<input type='hidden' name='cz_id[<?php echo $i; ?>]' value='<?php echo $list[$i]['cz_id']; ?>' id='cz_id_<?php echo $i; ?>'><label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $i; ?>'><i></i></label>",
            관리: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=couponzoneform&amp;cz_id=<?php echo $list[$i]['cz_id']; ?>&amp;w=u<?php echo $qstr ? '&amp;'.$qstr:''; ?>'><u>수정</u></a>",
            쿠폰이름: "<?php echo $list[$i]['cz_subject']; ?>",
            쿠폰종류: "<?php echo $list[$i]['cz_type']; ?>",
            적용대상: "<?php echo $list[$i]['cp_method']; ?>",
            쿠폰금액: "<?php echo $list[$i]['cp_price']; ?>",
            쿠폰사용기한: "다운로드 후 <?php echo $list[$i]['cz_period']; ?>일",
            다운로드: "<?php echo $list[$i]['mb_id']; ?>",
            사용기한: "<?php echo substr($list[$i]['cz_start'], 2, 8); ?> ~ <?php echo substr($list[$i]['cz_end'], 2, 8); ?>",
        },
        <?php } ?>
    ]
}();

$(document).ready(function(){
    $("#admin-shop-couponzonelist").jsGrid({
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
            { name: "관리", type: "text", align: "center", width: 70, headercss: "set-btn-header", css: "set-btn-field" },
            { name: "쿠폰이름", type: "text", width: 200 },
            { name: "쿠폰종류", type: "text", width: 60 },
            { name: "적용대상", type: "text", width: 70 },
            { name: "쿠폰금액", type: "text", width: 80 },
            { name: "쿠폰사용기한", type: "text", width: 100 },
            { name: "다운로드", type: "text", width: 100 },
            { name: "사용기한", type: "text", align: "center", width: 150 }
        ]
    })
    $("#sort").click(function() {
        var field = $("#sortingField").val();
        $("#admin-shop-couponzonelist").jsGrid("sort", field);
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
</script>