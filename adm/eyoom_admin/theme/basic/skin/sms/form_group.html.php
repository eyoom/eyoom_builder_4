<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/sms/form_group.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<style>
.form-group-add {position:relative;padding:10px;background:#fff;border:2px solid #757575;margin-bottom:30px}
</style>

<script>
function move(fg_no, fg_name, sel) {
    var msg = '';
    if (sel.value)
    {
        msg  = "'" + fg_name + "' 그룹에 속한 모든 데이터를\n\n'";
        msg += sel.options[sel.selectedIndex].text + "' 그룹으로 이동하시겠습니까?";

        if (confirm(msg))
            location.href = 'form_group_move.php?fg_no=' + fg_no + '&move_no=' + sel.value;
        else
            sel.selectedIndex = 0;
    }
}

function empty(fg_no) {
    if (confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n그룹에 속한 데이터를 정말로 비우시겠습니까?"))
        location.href = 'form_group_update.php?w='+ fg_no +'&fg_no=' + fg_no;
}

function grouplist_submit(f) {
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n삭제되는 그룹에 속한 자료는 '미분류'로 이동됩니다.\n\n그래도 삭제하시겠습니까?")) {
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

<div class="admin-form-group">
    <div class="adm-headline">
        <h3><?php echo $g5['title']; ?></h3>
    </div>

    <form name="group<?php echo $res['fg_no']?>" method="post" action="<?php echo $action_url; ?>" class="eyoom-form">
    <input type="hidden" name="fg_no" value="<?php echo $res['fg_no']?>">

    <div class="form-group-add">
        <label for="fg_name" class="label">그룹명<strong class="sound_only"> 필수</strong></label>
        <div class="input input-button width-250px">
            <input type="text" id="fg_name" name="fg_name" required>
            <div class="button"><input type="submit">추가</div>
        </div>

        <div class="margin-top-10 font-size-12">건수 : <strong class="color-red"><?php echo $total_count ?></strong></div>
    </div>

    </form>

    <div class="alert alert-info">
        <p class="font-size-12">그룹명순으로 정렬됩니다.</p>
    </div>

    <form name="group<?php echo $group[$i]['fg_no']?>" method="post" action="<?php echo $action_url; ?>" onsubmit="return grouplist_submit(this);" class="eyoom-form">
    <input type="hidden" name="w" value="u">

    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="form-group-list"></div>
    
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
        <?php 
        $qry = sql_query("select count(*) as cnt from {$g5['sms5_form_table']} where fg_no=0");
        $res = sql_fetch_array($qry);
        ?>
        {
            체크: "",
            보기: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=sms&pid=form_list&fg_no=0'><u>보기</u></a>",
            그룹명: "미분류",
            이모티콘수: "<?php echo number_format($res['cnt'])?>",
            이동: "<label class='select'><select name='select_fg_no_999' id='select_fg_no_999' onchange='move(0, \"미분류\", this);'><option value=''></option><?php for ($i=0; $i<count((array)$group); $i++) { ?><option value='<?php echo $group[$i]['fg_no']?>'> <?php echo $group[$i]['fg_name']?> </option><?php } ?></select><i></i></label>",
        },
        <?php for ($i=0; $i<count((array)$group); $i++) { ?>
        {
            체크: "<input type='hidden' name='fg_no[<?php echo $i; ?>]' value='<?php echo $group[$i]['fg_no']; ?>' id='fg_no_<?php echo $i; ?>'><label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $i; ?>'><i></i></label>",
            보기: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=sms&pid=form_list&fg_no=<?php echo $group[$i]['fg_no']?>'><u>보기</u></a>",
            그룹명: "<label class='input'><input type='text' name='fg_name[<?php echo $i; ?>]' value='<?php echo get_sanitize_input($group[$i]['fg_name']); ?>' id='fg_name_<?php echo $i; ?>'></label>",
            이모티콘수: "<?php echo number_format($group[$i]['fg_count'])?>",
            이동: "<label class='select'><select name='select_fg_no[<?php echo $i; ?>]' id='select_fg_no_<?php echo $i; ?>' onchange='move(<?php echo $group[$i]['fg_no']?>, \"<?php echo $group[$i]['fg_name']?>\", this);'><option value=''></option><option value='0'>미분류</option><?php for ($j=0; $j<count((array)$group); $j++) { ?><?php if ($group[$i]['fg_no']==$group[$j]['fg_no']) continue; ?><option value='<?php echo $group[$j]['fg_no']?>'> <?php echo $group[$j]['fg_name']?> </option><?php } ?></select><i></i></label>",
        },
        <?php } ?>
    ]
}();

$(function() {
    $("#form-group-list").jsGrid({
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
            { name: "체크", type: "text", align: "center", width: 40 },
            { name: "보기", type: "text", align: "center", width: 80, headercss: "set-btn-header", css: "set-btn-field" },
            { name: "그룹명", type: "text", align: "center", width: 60 },
            { name: "이모티콘수", type: "text", align: "center", width: 60 },
            { name: "이동", type: "text", align: "center", width: 80 },
        ]
    });
    
    var $chk = $(".jsgrid-table th:first-child");
    if ($chk.text() == '체크') {
        var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>';
        $chk.html(html);
    }
});
</script>