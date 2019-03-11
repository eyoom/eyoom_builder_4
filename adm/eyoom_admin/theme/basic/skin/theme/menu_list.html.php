<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/theme/menu_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/easyui/themes/default/easyui.css" type="text/css" media="screen">',0);
?>

<style>
.admin-menu-list .easyui-panel {padding:10px 0}
.admin-menu-list .panel {border-right:1px solid #95B8E7;margin-top:-2px}
.btn-history-back {position:absolute;top:15px;left:100px}
.btn-history-forward {position:absolute;top:15px;left:136px}
</style>

<div class="admin-menu-list">
    <div class="adm-headline">
        <h3>홈페이지 메뉴설정</h3>
    </div>

    <?php include_once(EYOOM_ADMIN_THEME_PATH . '/skin/theme/theme_head.html.php'); ?>

    <form name="fmenu" id="fmenu" action="<?php echo $action_url1; ?>" onsubmit="return fmenu_check(this)" method="post" class="eyoom-form">
    <input type="hidden" name="mode" id="mode" value="update">
    <input type="hidden" name="theme" id="theme" value="<?php echo $this_theme; ?>">
    <input type="hidden" name="wmode" id="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="token" id="token" value="">

    <div class="row">
        <div class="col col-3">
            <div class="margin-bottom-15">
                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=menu_copy&amp;thema=<?php echo $this_theme; ?>&amp;me_shop=<?php echo $me_shop; ?>&amp;wmode=1" class="btn-e btn-e-xs btn-e-red" onclick="eb_modal(this.href, '테마메뉴 복사'); return false;">테마메뉴 복사</a>
                <?php if ($is_admin == 'super') { ?>
                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=menu_reset&amp;thema=<?php echo $this_theme; ?>&amp;me_shop=<?php echo $me_shop; ?>&amp;smode=1" class="btn-e btn-e-xs btn-e-dark" onclick="return check_menu_reset();">메뉴 초기화</a>
                <?php } ?>
                <div class="clearfix"></div>
            </div>

            <div class="easyui-panel">
                <ul id="menutree" class="easyui-tree" data-options="url:'<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=menu_json&amp;thema=<?php echo $this_theme; ?>&amp;me_shop=<?php echo $me_shop; ?><?php echo $id ? '&amp;id='.$id:'';?>&amp;smode=1',method:'get',animate:true,lines:true"></ul>
            </div>
        </div>
        <div class="col col-9">
            <h4 class="margin-top-0 margin-bottom-15"><strong class="color-indigo">메뉴설정</strong></h4>
            <div class="scrollbar-container">
                <div id="menu_form"><?php include_once(EYOOM_ADMIN_CORE_PATH.'/theme/menu_form.php'); ?></div>
            </div>
        </div>
    </div>
    </form>
</div>

<div class="modal fade admin-iframe-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title"></h4>
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

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/easyui/jquery.easyui.min.js"></script>
<script>
$(function() {
    $('#menutree').tree('expandAll');
    $('#menutree').tree({
        dnd: false,
        onDrop: function(targetNode, source, point) {
            var targetId = $('#menutree').tree('getNode', targetNode).id;
            var targetOrder = $('#menutree').tree('getNode', targetNode).order;
            $.ajax({
                url: '...',
                type: 'post',
                dataType: 'json',
                data: {
                    id: source.id,
                    targetId: targetId,
                    point: point
                }
            });
        },
        onClick: function(source) {
            var url="<?php echo EYOOM_ADMIN_CORE_URL; ?>/theme/menu_form.php";
            var thema = '<?php echo $this_theme; ?>';
            var $menu_form = $("#menu_form");

            $.post(url, { id: source.id, thema: thema, me_shop: <?php echo $me_shop; ?> }, function(data) {
                $menu_form.empty().html(data);
            });
        }
    });
});
function collapseAll() {
    $('#menu').tree('collapseAll');
}
function expandAll() {
    $('#menu').tree('expandAll');
}

function check_menu_reset() {
    if (confirm("현재 설정된 메뉴를 모두 초기화합니다.\n\n정말로 설정 메뉴를 초기화 하시겠습니까?")) {
        return true;
    } else {
        return false;
    }
}
<?php if (!(G5_IS_MOBILE || $wmode)) { ?>
function eb_modal(href, title) {
    $('.admin-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#modal-iframe").attr("src", "");
        $(".modal-title").text("");
        $('html').css({overflow: ''});
    });
    $('.admin-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#modal-iframe").attr("src", href);
        $('#modal-iframe').height(parseInt($(window).height() * 0.85));
        $(".modal-title").text(title);
        $('html').css({overflow: 'hidden'})
    });
    return false;
}

window.closeModal = function(){
    $('.admin-iframe-modal').modal('hide');
};

function goHistoryBack() {
    window.history.back();
}
function goHistoryForward() {
    window.history.forward();
}
<?php } ?>

function fmenu_check(f) {
    if (document.pressed == '메뉴생성') {
        if(f.subme_name.value == '') {
            alert('메뉴명은 필수항목입니다.');
            f.subme_name.focus();
            f.subme_name.select();
            return false;
        }        
    }
    
    if (document.pressed == '메뉴수정') {
        if(f.me_name.value == '') {
            alert('메뉴명은 필수항목입니다.');
            f.me_name.focus();
            f.me_name.select();
            return false;
        }        
    }
}
function view_select_list(type) {
    var theme = '<?php echo $this_theme; ?>';
    var url = "<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=menu_ajax&smode=1";
    $.post(url, {type:type, theme:theme}, function(data) {
        if(data.pid) {
            var pid_str = data.pid;
            var name_str = data.name;
            var pid = pid_str.split("|");
            var name = name_str.split("|");
            if(pid.length>0) {
                var select = "<select name='select_item' id='select_item' onchange='set_item_value(this.value)'><option value=''>::선택해주세요::</option>";
                for(var i=0; i<pid.length;i++) {
                    var nbsp = '';
                    if (type == 'shop') {
                        for(var j=2; j<pid[i].length; j++) nbsp += '&nbsp;&nbsp;';
                    }
                    select += "<option value=\""+pid[i]+"|"+name[i]+"\">"+nbsp+''+name[i]+"</option>";
                }
                select += "</select><i></i>";
            }
            $("#selbox").html(select);
        }
    },"json");
}
function set_item_value(str) {
    var type = $("#subme_type > option:selected").val();
    var data = str.split("|");
    switch(type) {
        case 'group':
            var url = '<?php echo G5_BBS_URL; ?>/group.php?gr_id='+data[0];
            var name = data[1];
            break;
        case 'board':
            var url = '<?php echo G5_BBS_URL; ?>/board.php?bo_table='+data[0];
            var path = data[1].split(' > ');
            var name = path[1];
            break;
        case 'page':
            var url = '<?php echo G5_BBS_URL; ?>/content.php?co_id='+data[0];
            var name = data[1];
            break;
        case 'shop':
            var url = '<?php echo G5_SHOP_URL; ?>/list.php?ca_id='+data[0];
            var name = data[1];
            break;
    }
    $("#subme_link").val(url);
    $("#subme_name").val(name);
}
function delete_menu() {
    if(confirm("본 메뉴를 삭제하시면 하위메뉴까지 모두 삭제됩니다.\n\n그래도 삭제하시겠습니까?")) {
        var form = document.fmenu;
        var token = get_ajax_token();
        if(!token) {
            alert("토큰 정보가 올바르지 않습니다.");
            return false;
        }
        form.token.value = token;
        form.mode.value = 'delete';
        form.submit();
    } else return false;
}
</script>