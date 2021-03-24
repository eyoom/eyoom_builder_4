<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/board/boardgroupmember_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>


<div class="admin-boardgroup-list">
    <form id="fsearch" name="fsearch" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    <input type="hidden" name="gr_id" value="<?php echo $gr_id ?>">

    <div class="adm-headline adm-headline-btn">
        <h3><?php echo $gr['gr_subject'].' 그룹 접근가능회원 (그룹아이디:'.$gr['gr_id'].')'; ?></h3>
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
                        <td>
                            <div <?php if (!G5_IS_MOBILE) { ?>class="inline-group"<?php } ?>>
                                <div class="margin-bottom-5">
                                    <label class="select form-width-150px">
                                        <select name="sfl" id="sfl">
                                            <option value="a.mb_id"<?php echo get_selected($_GET['sfl'], "a.mb_id") ?>>회원아이디</option>
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

    <?php echo $frm_submit; ?>

    </form>

    <div class="margin-bottom-30"></div>

    <form name="fboardgroupmember" id="fboardgroupmember" action="<?php echo $action_url1; ?>" method="post" onsubmit="return fboardgroupmember_submit(this);" class="eyoom-form">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="<?php echo $token ?>">
    <input type="hidden" name="gr_id" value="<?php echo $gr_id ?>">
    <input type="hidden" name="w" value="ld">

    <div class="margin-bottom-10">
        <span class="font-size-12 color-grey">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="margin-left-10 margin-right-10 color-light-grey">|</span>전체 <?php echo number_format($total_count); ?>명
        </span>
    </div>

    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="boardgroupmember-list"></div>

    <div class="margin-top-20">
        <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
    </div>
    </form>
</div>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>
<div class="margin-bottom-20"></div>

<div class="modal fade admin-iframe-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">회원 정보 수정</h4>
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
                return !(filter.체크 && !(client.체크.indexOf(filter.체크) > -1) )
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        {
            체크: "<label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $list[$i]['gm_id'] ?>'><i></i></label>",
            그룹: "<?php if ($list[$i]['cnt']) { ?><a href='<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=boardgroupmember_form&amp;mb_id=<?php echo $list[$i]['mb_id']; ?>'><?php echo $list[$i]['cnt']; ?></a><?php } ?>",
            회원아이디: "<span class='ellipsis'><a <?php if (!(G5_IS_MOBILE || $wmode)) { ?>href='<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=member_form&mb_id=<?php echo $list[$i]['mb_id'];; ?>&w=u&amp;wmode=1' onclick='eb_modal(this.href); return false;'<?php } else { ?>href='javascript:void(0);'<?php } ?> ><i class='fas fa-external-link-alt color-light-grey margin-right-5 hidden-xs'></i><strong><?php echo $list[$i]['mb_id']; ?></strong></a></span>",
            이름: "<?php echo get_text($list[$i]['mb_name']); ?>",
            닉네임: "<span class='ellipsis'><a <?php if (!(G5_IS_MOBILE || $wmode)) { ?>href='<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=member_form&mb_id=<?php echo $list[$i]['mb_id'];; ?>&w=u&amp;wmode=1' onclick='eb_modal(this.href); return false;'<?php } else { ?>href='javascript:void(0);'<?php } ?> ><?php echo $list[$i]['mb_nick']; ?></a></span>",
            최종접속: "<?php echo substr($list[$i]['mb_today_login'],2,8) ?>",
            처리일시: "<?php echo $list[$i]['gm_datetime'] ?>",
        },
        <?php } ?>
    ]
}();

$(function() {
    $("#boardgroupmember-list").jsGrid({
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
            { name: "그룹", type: "text", width: 120 },
            { name: "회원아이디", type: "text", width: 100 },
            { name: "이름", type: "text", width: 100 },
            { name: "닉네임", type: "number", width: 100 },
            { name: "최종접속", type: "text", width: 100 },
            { name: "처리일시", type: "number", width: 100 },
        ]
    });

    var $chk = $(".jsgrid-table th:first-child");
    if ($chk.text() == '체크') {
        var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>';
        $chk.html(html);
    }
});

function fboardgroupmember_submit(f) {
    if (!is_checked("chk[]")) {
        alert("선택삭제 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    return true;
}
</script>