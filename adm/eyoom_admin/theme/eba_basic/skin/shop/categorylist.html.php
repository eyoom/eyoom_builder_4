<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shop/categorylist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jquery-easyui/themes/default/easyui.css" type="text/css" media="screen">',0);

/**
 * 페이지 경로 설정
 */
$fm_pid = 'categorylist';
$g5_title = '분류관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">쇼핑몰관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-shop-categorylist">
    <form name="fcategory" id="fcategory" action="<?php echo $action_url1; ?>" onsubmit="return fcategory_check(this)" method="post" class="eyoom-form">
    <input type="hidden" name="mode" id="mode" value="update">
    <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="token" id="token" value="">

    <div class="row row-g-20">
        <div class="col-md-3 md-m-b-20">
            <div class="easyui-btn-wrap">
                <a href="javascript:void(0);" onclick="collapseAll()">전체닫기</a>
                <a href="javascript:void(0);" onclick="expandAll()">전체열기</a>
            </div>
            <div class="easyui-panel">
                <ul id="category" class="easyui-tree" data-options="url:'<?php echo EYOOM_ADMIN_CORE_URL; ?>/shop/categorylist.json.php<?php echo $id ? '?id='.$id:'';?>',method:'get',animate:true,lines:true"></ul>
            </div>
        </div>
        <div class="col-md-9">
            <div id="category_form"><?php include_once(EYOOM_ADMIN_CORE_PATH.'/shop/categoryform.php'); ?></div>
        </div>
    </div>

    </form>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/jquery-easyui/jquery.easyui.min.js"></script>
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