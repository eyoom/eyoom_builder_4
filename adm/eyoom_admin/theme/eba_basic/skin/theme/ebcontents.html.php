<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/theme/ebcontents.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jquery-easyui/themes/default/easyui.css" type="text/css" media="screen">',0);

/**
 * 페이지 경로 설정
 */
$fm_pid = 'ebcontents';
$g5_title = 'EB콘텐츠관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">테마설정관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-ebcontents">
    <?php include_once(EYOOM_ADMIN_THEME_PATH . '/skin/theme/theme_head.html.php'); ?>
    
    <form name="febcontentsform" id="febcontentslist" action="<?php echo $action_url1; ?>" method="post" onsubmit="return febcontentsform_submit(this);" class="eyoom-form">

    <div class="row row-g-20">
        <div class="col-md-3 md-m-b-20">
            <div class="easyui-btn-wrap">
                <a href="javascript:void(0);" onclick="collapseAll()">전체닫기</a>
                <a href="javascript:void(0);" onclick="expandAll()">전체열기</a>
            </div>
            <div class="easyui-panel">
                <ul id="menutree" class="easyui-tree" data-options="url:'<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=menu_json&amp;thema=<?php echo $this_theme; ?>&amp;me_ec=1<?php echo $id ? '&amp;id='.$id:'';?>&amp;smode=1',method:'get',animate:true,lines:true"></ul>
            </div>
        </div>
        <div class="col-md-9">
            <div id="ebcontents_list"><?php include_once(EYOOM_ADMIN_CORE_PATH.'/theme/ebcontents_list.php'); ?></div>
        </div>
    </div>

    </form>
</div>

<div class="modal fade admin-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-700">EB콘텐츠 관리</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <iframe id="modal-iframe" width="100%" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-e btn-e-lg btn-e-dark" data-bs-dismiss="modal">닫기<i class="fas fa-times m-l-5"></i></button>
            </div>
        </div>
    </div>
</div>

<iframe name="hidden-iframe" style="display:none;"></iframe>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/jquery-easyui/jquery.easyui.min.js"></script>
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
    $('#menutree').tree('collapseAll');
}
function expandAll() {
    $('#menutree').tree('expandAll');
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