<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shop/couponlist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<style>
.admin-shop-couponlist #admin-shop-couponlist img {display:block;width:100% \9;max-width:100%;height:auto}
</style>

<div class="admin-shop-couponlist">
    <div class="adm-headline">
        <h3>쿠폰관리</h3>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=couponform" class="btn-e btn-e-red btn-e-lg"><i class="fas fa-plus"></i> 쿠폰등록</a>
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
                                            <option value="mb_id"<?php echo get_selected($sfl, "mb_id"); ?>>회원아이디</option>
                                            <option value="cp_subject"<?php echo get_selected($sfl, "cp_subject"); ?>>쿠폰이름</option>
                                            <option value="cp_id"<?php echo get_selected($sfl, "cp_id"); ?>>쿠폰코드</option>
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

    <div class="margin-bottom-30"></div>

    <div class="row">
        <div class="col col-9">
            <div class="margin-bottom-5">
                <span class="font-size-12 color-grey">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="margin-left-10 margin-right-10 color-light-grey">|</span>등록된 쿠폰 <?php echo number_format($total_count); ?>건
                </span>
            </div>
        </div>
        <div class="col col-3">
            <label for="sort_list" class="select" style="width:200px;float:right;">
                <select name="sort_list" id="sort_list" onchange="sorting_list(this.form, this.value);">
                    <option value="">:: 정렬방식선택 ::</option>
                    <option value="mb_id|asc" <?php echo $sst=='mb_id' && $sod == 'asc' ? 'selected':''; ?>>회원아이디 정방향 (↓)</option>
                    <option value="mb_id|desc" <?php echo $sst=='mb_id' && $sod == 'desc' ? 'selected':''; ?>>회원아이디 역방향 (↑) </option>
                    <option value="cp_end|asc" <?php echo $sst=='cp_end' && $sod == 'asc' ? 'selected':''; ?>>사용기간 정방향 (↓)</option>
                    <option value="cp_end|desc" <?php echo $sst=='cp_end' && $sod == 'desc' ? 'selected':''; ?>>사용기간 역방향 (↑) </option>
                </select><i></i>
            </label>
        </div>
    </div>

    </form>

    <form name="fcouponlist" method="post" action="<?php echo $action_url1; ?>" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="sca" value="<?php echo $sca; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">

    <?php if(G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="admin-shop-couponlist"></div>

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
            체크: "<input type='hidden' name='cp_id[<?php echo $i; ?>]' value='<?php echo $list[$i]['cp_id']; ?>' id='cp_id_<?php echo $i; ?>'><label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $i; ?>'><i></i></label>",
            관리: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=couponform&amp;cp_id=<?php echo $list[$i]['cp_id']; ?>&amp;w=u<?php echo $qstr ? '&amp;'.$qstr:''; ?>'><u>수정</u></a>",
            쿠폰종류: "<?php echo $list[$i]['cp_method']; ?>",
            쿠폰코드: "<?php echo $list[$i]['cp_id']; ?>",
            쿠폰이름: "<?php echo $list[$i]['cp_subject']; ?>",
            적용대상: "<?php echo $list[$i]['cp_target']; ?>",
            회원아이디: "<?php echo $list[$i]['mb_id']; ?>",
            사용기한: "<?php echo substr($list[$i]['cp_start'], 2, 8); ?> ~ <?php echo substr($list[$i]['cp_end'], 2, 8); ?>",
            사용회수: "<?php echo number_format($list[$i]['used_count']); ?>",
        },
        <?php } ?>
    ]
}();

$(document).ready(function(){
    $("#admin-shop-couponlist").jsGrid({
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
            { name: "관리", type: "text", align: "center", width: 80, headercss: "set-btn-header", css: "set-btn-field" },
            { name: "쿠폰종류", type: "text", align:"center", width: 120 },
            { name: "쿠폰코드", type: "text", align:"center", width: 170 },
            { name: "쿠폰이름", type: "text", width: 250 },
            { name: "적용대상", type: "text", width: 170 },
            { name: "회원아이디", type: "text", width: 120 },
            { name: "사용기한", type: "text", width: 150 },
            { name: "사용회수", type: "text", width: 60 },
        ]
    })

    var $chk = $(".jsgrid-table th:first-child");
    if ($chk.text() == '체크') {
        var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>';
        $chk.html(html);
    }

    $("#sort").click(function() {
        var field = $("#sortingField").val();
        $("#admin-shop-couponlist").jsGrid("sort", field);
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

function fcouponlist_submit(f) {
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