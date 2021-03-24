<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/board/boardgroupmember_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-boardgroupmember-form">
    <form name="fboardgroupmember_form" id="fboardgroupmember_form" action="<?php echo $action_url1; ?>" onsubmit="return boardgroupmember_form_check(this)" method="post" class="eyoom-form">
    <input type="hidden" name="mb_id" value="<?php echo $mb['mb_id'] ?>" id="mb_id">
    <input type="hidden" name="token" value="" id="token">

    <div class="adm-headline adm-headline-btn">
        <h3>접근가능그룹</h3>
    </div>

    <div class="adm-table-form-wrap">
        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">회원정보</label>
                        </th>
                        <td>
                            <span>아이디</span> <?php echo $mb['mb_id'] ?>
                            <span>이름</span> <?php echo get_text($mb['mb_name']); ?>
                            <span>닉네임</span> <?php echo $mb['mb_nick'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">그룹지정</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <span>
                                    <label class="select form-width-250px">
                                        <select name="gr_id" id="gr_id">
                                            <option value="">접근가능 그룹을 선택하세요.</option>
                                            <?php for ($i=0; $i<count((array)$grlist); $i++) { ?>
                                            <option value="<?php echo $grlist[$i]['gr_id']; ?>"><?php echo $grlist[$i]['gr_subject']; ?></option>
                                            <?php } ?>
                                        </select><i></i>
                                    </label>
                                </span>
                                <span>
                                    <input type="submit" value="선택" class="btn-e btn-e-md btn-e-dark" accesskey="s">
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

    </form>

    <div class="margin-bottom-30"></div>

    <form name="fboardgroupmember" id="fboardgroupmember" action="<?php echo $action_url1; ?>" method="post" onsubmit="return fboardgroupmember_submit(this);" class="eyoom-form">
    <input type="hidden" name="sst" value="<?php echo $sst ?>" id="sst">
    <input type="hidden" name="sod" value="<?php echo $sod ?>" id="sod">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>" id="sfl">
    <input type="hidden" name="stx" value="<?php echo $stx ?>" id="stx">
    <input type="hidden" name="page" value="<?php echo $page ?>" id="page">
    <input type="hidden" name="token" value="<?php echo $token ?>" id="token">
    <input type="hidden" name="mb_id" value="<?php echo $mb['mb_id'] ?>" id="mb_id">
    <input type="hidden" name="w" value="d" id="w">

    <div class="margin-bottom-10">
        <span class="font-size-12 color-grey">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="margin-left-10 margin-right-10 color-light-grey">|</span>전체그룹 <?php echo number_format($total_count); ?>개
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
            체크: "<input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $list[$i]['gm_id'] ?>'><i></i></label>",
            그룹아이디: "<a href='<?php echo get_eyoom_pretty_url(G5_GROUP_DIR, $list[$i]['gr_id']); ?>'><?php echo $list[$i]['gr_id']; ?></a>",
            그룹: "<?php echo $list[$i]['gr_subject'] ?>",
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
            { name: "그룹아이디", type: "text", width: 100 },
            { name: "그룹", type: "text", width: 200 },
            { name: "처리일시", type: "text", width: 100 },
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

function boardgroupmember_form_check(f) {
    if (f.gr_id.value == '') {
        alert('접근가능 그룹을 선택하세요.');
        return false;
    }

    return true;
}
</script>