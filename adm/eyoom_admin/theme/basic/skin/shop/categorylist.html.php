<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shop/categorylist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/easyui/themes/default/easyui.css" type="text/css" media="screen">',0);
?>

<style>
.admin-shop-categorylist .easyui-panel {padding:10px 0}
.admin-shop-categorylist .panel {border-right:1px solid #95B8E7;margin-top:-2px}
</style>

<div class="admin-shop-categorylist">
    <form name="fcategory" id="fcategory" action="<?php echo $action_url1; ?>" onsubmit="return fcategory_check(this)" method="post" class="eyoom-form">
    <input type="hidden" name="mode" id="mode" value="update">
    <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="token" id="token" value="">

    <div class="adm-headline">
        <h3>상품 카테고리설정</h3>
    </div>

    <div class="row">
        <div class="col col-3">
            <div class="margin-bottom-15">
                <a href="#" class="btn-e btn-e-xs btn-e-dark" onclick="collapseAll()">전체닫기</a>
                <a href="#" class="btn-e btn-e-xs btn-e-indigo" onclick="expandAll()">전체열기</a>
            </div>
            <div class="easyui-panel">
                <ul id="category" class="easyui-tree" data-options="url:'<?php echo EYOOM_ADMIN_CORE_URL; ?>/shop/categorylist.json.php<?php echo $id ? '?id='.$id:'';?>',method:'get',animate:true,lines:true"></ul>
            </div>
        </div>
        <div class="col col-9">
            <h4 class="margin-top-0 margin-bottom-15"><strong class="color-indigo">분류설정</strong></h4>
            <div class="scrollbar-container">
                <div id="category_form"><?php include_once(EYOOM_ADMIN_CORE_PATH.'/shop/categoryform.php'); ?></div>
            </div>
        </div>
    </div>
    </form>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/easyui/jquery.easyui.min.js"></script>
<script>
$(function() {
    $('#category').tree('expandAll');
    $('#category').tree({
        dnd: false,
        onDrop: function(targetNode, source, point) {
            var targetId = $('#category').tree('getNode', targetNode).id;
            var targetOrder = $('#category').tree('getNode', targetNode).order;
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
            var url="<?php echo EYOOM_ADMIN_CORE_URL; ?>/shop/categoryform.php";
            var $category_form = $("#category_form");

            $.post(url, { id: source.id }, function(data) {
                $category_form.empty().html(data);
            });
        }
    });
});
function collapseAll() {
    $('#category').tree('collapseAll');
}
function expandAll() {
    $('#category').tree('expandAll');
}
</script>