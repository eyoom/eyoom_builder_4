<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/theme/ebcontents.html.php
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
        <h3>EB콘텐츠 설정</h3>
    </div>

    <?php include_once(EYOOM_ADMIN_THEME_PATH . '/skin/theme/theme_head.html.php'); ?>

    <form name="febcontentsform" id="febcontentslist" action="<?php echo $action_url1; ?>" method="post" onsubmit="return febcontentsform_submit(this);" class="eyoom-form">
    <div class="row">
        <div class="col col-3">
            <h5 class="margin-top-0 margin-bottom-10"><strong>홈페이지 메뉴구성</strong></h5>
            <div class="easyui-panel">
                <ul id="menutree" class="easyui-tree" data-options="url:'<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=menu_json&amp;thema=<?php echo $this_theme; ?>&amp;me_ec=1<?php echo $id ? '&amp;id='.$id:'';?>&amp;smode=1',method:'get',animate:true,lines:true"></ul>
            </div>
            <div class="margin-bottom-30"></div>
        </div>
        <div class="col col-9">
            <div class="scrollbar-container">
                <div id="ebcontents_list"><?php include_once(EYOOM_ADMIN_CORE_PATH.'/theme/ebcontents_list.php'); ?></div>
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
                <h4 class="modal-title">EB콘텐츠 관리</h4>
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

<iframe name="hidden-iframe" style="display:none;"></iframe>

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
            reload_contents_list (source.id);
        }
    });
});

function reload_contents_list (id) {
    if (!id) id = '1';
    var url="<?php echo EYOOM_ADMIN_CORE_URL; ?>/theme/ebcontents_list.php";
    var thema = '<?php echo $this_theme; ?>';
    var ebcontents_list = $("#ebcontents_list");

    $.post(url, { id: id, thema: thema }, function(data) {
        ebcontents_list.empty().html(data);
    });
}
function collapseAll() {
    $('#menu').tree('collapseAll');
}
function expandAll() {
    $('#menu').tree('expandAll');
}

function eb_modal(href) {
    $('.admin-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#modal-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.admin-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#modal-iframe").attr("src", href);
        $('#modal-iframe').height(parseInt($(window).height() * 0.85));
        $('html').css({overflow: 'hidden'})
    });
    return false;
}

window.close_modal_and_reload = function(id){
    $('.admin-iframe-modal').modal('hide');
    reload_contents_list (id);
};

function goHistoryBack() {
    window.history.back();
}
function goHistoryForward() {
    window.history.forward();
}

function febcontentsform_submit(f) {
    f.target = 'hidden-iframe';
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