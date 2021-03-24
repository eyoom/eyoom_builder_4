<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/sms/num_group.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<style>
.num-group-add {position:relative;padding:10px;background:#fff;border:2px solid #757575;margin-bottom:30px}
</style>

<script>
function del(bg_no) {
    if (confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n삭제되는 그룹에 속한 자료는 '<?php echo $no_group['bg_name']?>'로 이동됩니다.\n\n그래도 삭제하시겠습니까?"))
        location.href = '<?php echo G5_ADMIN_URL; ?>/?dir=sms&pid=num_group_update&mw=d&bg_no=' + bg_no;
}

function move(bg_no, bg_name, sel) {
    var msg = '';
    if (sel.value)
    {
        msg  = "'" + bg_name + "' 그룹에 속한 모든 데이터를\n\n'";
        msg += sel.options[sel.selectedIndex].text + "' 그룹으로 이동하시겠습니까?";

        if (confirm(msg))
            location.href = '<?php echo G5_ADMIN_URL; ?>/?dir=sms&pid=num_group_move&bg_no=' + bg_no + '&move_no=' + sel.value;
        else
            sel.selectedIndex = 0;
    }
}

function empty(bg_no) {
    if (confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n그룹에 속한 데이터를 정말로 비우시겠습니까?"))
        location.href = 'num_group_update.php?mw=empty&bg_no=' + bg_no;
}

function num_group_submit(f) {
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n삭제되는 그룹에 속한 자료는 '<?php echo $no_group['bg_name']?>'로 이동됩니다.\n\n그래도 삭제하시겠습니까?")) {
            f.w.value = "de";
        } else {
            return false;
        }
    }

    if(document.pressed == "선택비우기") {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n그룹에 속한 데이터를 정말로 비우시겠습니까?")) {
            f.w.value = "em";
        } else {
            return false;
        }
    }

    return true;
}
</script>

<div class="admin-num-form">
    <div class="adm-headline">
        <h3><?php echo $g5['title']; ?></h3>
    </div>

    <form name="group<?php echo $res['bg_no']?>" method="post" action="<?php echo $action_url; ?>" class="eyoom-form">
    <input type="hidden" name="bg_no" value="<?php echo $res['bg_no']?>">

    <div class="num-group-add">
        <label for="bg_name" class="label">그룹추가<strong class="sound_only"> 필수</strong></label>
        <div class="input input-button width-250px">
            <input type="text" id="bg_name" name="bg_name" required>
            <div class="button"><input type="submit">그룹추가</div>
        </div>

        <div class="margin-top-10 font-size-12">건수 : <strong class="color-red"><?php echo $total_count; ?></strong>건</div>
    </div>

    </form>

    <div class="alert alert-info">
        <p class="font-size-12">그룹명순으로 정렬됩니다.</p>
    </div>

    <form name="group_hp_form" id="group_hp_form" method="post" action="<?php echo $action_url; ?>" onsubmit="return num_group_submit(this);" class="eyoom-form">
    <input type="hidden" name="w" value="u">

    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>
    
    <div id="num-group-list"></div>

    <div class="margin-top-20">
        <?php echo $frm_submit; ?>
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
                return !(filter.체크 && !(client.체크.indexOf(filter.체크) > -1) || filter.아이디 && !(client.아이디.indexOf(filter.아이디) > -1) || filter.이름 && !(client.이름.indexOf(filter.이름) > -1) )
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
        {
            체크: "",
            그룹명: "<?php echo $no_group['bg_name']?>",
            보기: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=num_book&amp;bg_no=1'><u>보기</u></a>",
            총: "<?php echo number_format($no_group['bg_count'])?>",
            회원: "<?php echo number_format($no_group['bg_member'])?>",
            비회원: "<?php echo number_format($no_group['bg_nomember'])?>",
            수신: "<?php echo number_format($no_group['bg_receipt'])?>",
            거부: "<?php echo number_format($no_group['bg_reject'])?>",
            이동: "<label class='select'><select name='select_bg_no_999' onchange=\"move(<?php echo $no_group['bg_no']?>, '<?php echo $no_group['bg_name']?>', this);\"><option value=''></option><?php for ($i=0; $i<count((array)$group); $i++) { ?><option value='<?php echo $group[$i]['bg_no']?>'> <?php echo get_sanitize_input($group[$i]['bg_name']); ?> </option><?php } ?></select><i></i></label>",
        },
        <?php for ($i=0; $i<$count; $i++) { ?>
        {
            체크: "<input type='hidden' name='bg_no[<?php echo $i; ?>]' value='<?php echo $group[$i]['bg_no']; ?>' id='bg_no_<?php echo $i; ?>'><label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $i; ?>'><i></i></label>",
            보기: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=num_book&amp;bg_no=<?php echo $group[$i]['bg_no']?>'><u>보기</u></a>",
            그룹명: "<label class='input'><input type='text' name='bg_name[<?php echo $i; ?>]' value='<?php echo get_sanitize_input($group[$i]['bg_name']); ?>' id='bg_name_<?php echo $i; ?>'></label>",
            총: "<?php echo number_format($group[$i]['bg_count'])?>",
            회원: "<?php echo number_format($group[$i]['bg_member'])?>",
            비회원: "<?php echo number_format($group[$i]['bg_nomember'])?>",
            수신: "<?php echo number_format($group[$i]['bg_receipt'])?>",
            거부: "<?php echo number_format($group[$i]['bg_reject'])?>",
            이동: "<label class='select'><select name='select_bg_no[<?php echo $i; ?>]' id='select_bg_no_<?php echo $i; ?>' onchange=\"move(<?php echo $group[$i]['bg_no']?>, '<?php echo $group[$i]['bg_name']?>', this);\"><option value=''></option><option value='<?php echo $no_group['bg_no']?>'><?php echo $no_group['bg_name']?></option><?php for ($j=0; $j<count((array)$group); $j++) { ?><?php if ($group[$i]['bg_no']==$group[$j]['bg_no']) continue; ?><option value='<?php echo $group[$j]['bg_no']?>'> <?php echo get_sanitize_input($group[$j]['bg_name']); ?> </option><?php } ?></select><i></i></label>",
        },
        <?php } ?>
    ]
}();

$(function() {
    $("#num-group-list").jsGrid({
        filtering      : false,
        editing        : false,
        sorting        : false,
        paging         : true,
        autoload       : true,
        controller     : db,
        deleteConfirm  : "정말로 삭제하시겠습니까?\n한번 삭제된 데이터는 복구할수 없습니다.",
        pageButtonCount: 5,
        pageSize       : 20,
        width          : "100%",
        height         : "auto",
        fields         : [
            { name: "체크", type: "text", align: "center", width: 40 },
            { name: "보기", type: "text", align: "center", width: 80, headercss: "set-btn-header", css: "set-btn-field" },
            { name: "그룹명", type: "text", align: "center", width: 150 },
            { name: "총", type: "text", align: "center", width: 80 },
            { name: "회원", type: "text", align: "center", width: 80 },
            { name: "비회원", type: "text", align: "center", width: 80 },
            { name: "수신", type: "text", align: "center", width: 80 },
            { name: "거부", type: "text", align: "center", width: 80 },
            { name: "이동", type: "text", align: "center", width: 150 },
        ]
    });

    var $chk = $(".jsgrid-table th:first-child");
    if ($chk.text() == '체크') {
        var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>';
        $chk.html(html);
    }
});
</script>