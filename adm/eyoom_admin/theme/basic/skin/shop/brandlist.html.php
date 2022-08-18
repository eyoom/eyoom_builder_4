<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shop/brandlist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<style>
.admin-shop-brandlist .search-brand-type .radio {margin-right:20px}
.admin-shop-brandlist .search-brand-type .radio b {display:inline-block;font-weight:normal;width:40px}
.admin-shop-brandlist .search-brand-type .radio .label {padding:2px 0 1px;font-size:10px;width:40px;text-align:center}
.admin-shop-brandlist #admin-shop-brandlist img {display:block;width:100% \9;max-width:100%;height:auto}
.admin-shop-brandlist #admin-shop-brandlist .brand-type-divider {border-bottom:1px solid #e5e5e5;margin:0.5em -0.5em}
.admin-shop-brandlist #admin-shop-brandlist .brand-type-box {margin-bottom:0.5em}
.admin-shop-brandlist #admin-shop-brandlist .brand-type-group .checkbox {width:115px;margin-right:10px;padding:0 0 0 25px;margin:inherit}
.admin-shop-brandlist #admin-shop-brandlist .brand-type-group .checkbox i {top:5px}
.admin-shop-brandlist #admin-shop-brandlist .brand-type-group .checkbox .label {margin-left:5px;padding:2px 7px 1px;font-size:10px}
</style>

<div class="admin-shop-brandlist">
    <div class="adm-headline adm-headline-btn">
        <h3>브랜드 관리</h3>
        <div class="headline-btn">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=brandform" class="btn-e btn-e-red btn-e-lg"><i class="fas fa-plus"></i> 브랜드등록</a>
        </div>
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
                        <td colspan="3">
                            <div <?php if (!G5_IS_MOBILE) { ?>class="inline-group"<?php } ?>>
                                <div class="margin-bottom-5">
                                    <label class="select form-width-150px">
                                        <select name="sfl" id="sfl">
                                            <option value="br_name" <?php echo get_selected($sfl, 'br_name'); ?>>브랜드명</option>
                                            <option value="br_code" <?php echo get_selected($sfl, 'br_code'); ?>>브랜드코드</option>
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
        <div class="col col-12">
            <div class="margin-bottom-5">
                <span class="font-size-12 color-grey">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="margin-left-10 margin-right-10 color-light-grey">|</span>등록된 브랜드 <?php echo number_format($total_count); ?>건
                </span>
            </div>
        </div>
    </div>

    </form>

    <form name="fbrandlistupdate" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fbrandlist_submit(this);" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="sca" value="<?php echo $sca; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">

    <?php if(G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="admin-shop-brandlist"></div>

    <?php if(!$wmode) { ?>
    <div class="margin-top-20">
        <input type="submit" name="act_button" value="선택수정" class="btn-e btn-e-xs btn-e-red" onclick="document.pressed=this.value">
        <?php if ($is_admin == 'super') { ?>
        <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
        <?php } ?>
    </div>
    <?php } ?>
    </form>
</div>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/jsgrid/jsgrid.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/js/jsgrid.js"></script>
<script>
function fbrandlist_submit(f)
{
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

function fsearchform_submit(num) {
    var f = document.flist;
    var number = parseInt(num)+1;
    
    for (var i=number; i<=4; i++) {
        $("#cate_"+number).val('');
    }
    f.submit();
}

!function () {
    var db = {
        deletebrand: function (deletingClient) {
            var clientIndex = $.inArray(deletingClient, this.clients);
            this.clients.splice(clientIndex, 1)
        },
        insertbrand: function (insertingClient) {
            this.clients.push(insertingClient)
        },
        loadData  : function (filter) {
            return $.grep(this.clients, function (client) {
                return !(filter.체크 && !(client.체크.indexOf(filter.체크) > -1) )
            })
        },
        updatebrand: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        {
            체크: "<input type='hidden' name='br_no[<?php echo $i; ?>]' value='<?php echo $list[$i]['br_no']; ?>' id='br_no_<?php echo $i; ?>'><label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $i; ?>'><i></i></label>",
            관리: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=brandform&amp;br_no=<?php echo $list[$i]['br_no']; ?>&amp;w=u&amp;ca_id=<?php echo $list[$i]['ca_id']; ?><?php echo $qstr ? '&amp;'.$qstr:''; ?>'><u>수정</u></a>",
            이미지: "<div class='brand-image'><?php if ($list[$i]['img_url']) { ?><img src='<?php echo $list[$i]['img_url']; ?>' class='img-responsive'><?php } ?></div>",
            브랜드코드: "<strong><a href='<?php echo G5_SHOP_URL; ?>/brand.php?br_cd=<?php echo $list[$i]['br_code']; ?>' target='_blank'><?php echo $list[$i]['br_code']; ?></a></strong>",
            브랜드명: "<label class='input'><input type='text' name='br_name[<?php echo $i; ?>]' id='br_name_<?php echo $i; ?>' value='<?php echo get_text($list[$i]['br_name']); ?>' required></label>",
            노출여부: "<div class='inline-group'><label for='br_open_<?php echo $i; ?>_y' class='radio'><input type='radio' name='br_open[<?php echo $i; ?>]' id='br_open_<?php echo $i; ?>_y' value='y' <?php echo $list[$i]['br_open']=='y' ? 'checked': ''; ?>><i></i> 예</label><label for='br_open_<?php echo $i; ?>_n' class='radio'><input type='radio' name='br_open[<?php echo $i; ?>]' id='br_open_<?php echo $i; ?>_n' value='n' <?php echo $list[$i]['br_open']=='n' ? 'checked': ''; ?>><i></i> 아니오</label></div>",
            순서: "<label class='input'><input type='text' name='br_sort[<?php echo $i; ?>]' id='br_sort_<?php echo $i; ?>' value='<?php echo $list[$i]['br_sort']; ?>'></label>",
            등록일: "<?php echo date("Y-m-d", strtotime($list[$i]['br_regdt'])); ?>",
        },
        <?php } ?>
    ]
}();

$(document).ready(function(){
    $("#admin-shop-brandlist").jsGrid({
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
            { name: "관리", type: "text", align: "center", width: 96, headercss: "set-btn-header", css: "set-btn-field" },
            { name: "이미지", type: "image", align: "center", width: 60 },
            { name: "브랜드코드", type: "text",align: "center", width: 100 },
            { name: "브랜드명", type: "text", width: 500 },
            { name: "노출여부", type: "text", align: "center", width: 150 },
            { name: "순서", type: "text", align: "center", width: 60 },
            { name: "등록일", type: "text", align: "center", width: 80 },
        ]
    });

    var $chk = $(".jsgrid-table th:first-child");
    if ($chk.text() == '체크') {
        var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>';
        $chk.html(html);
    }
});

function del_confirm() {
    if(confirm('정말로 선택한 브랜드을 삭제하시겠습니까?')) {
        return true;
    } else {
        return false;
    }
}
</script>