<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shop/coupontarget.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-shop-coupontargetlist">
    <form name="ftarget" id="ftarget" class="eyoom-form" method="get">
    <input type="hidden" name="sch_target" value="<?php echo preg_replace('/[^a-zA-Z0-9]/', '', strip_tags($_GET['sch_target'])); ?>">

    <div class="alert alert-info">
        <p>
            쿠폰을 적용할 <?php echo $t_desc1; ?> 선택하세요.<br>
            <?php echo $t_desc2; ?> 많을 경우에는 검색 기능을 이용하세요.
        </p>
    </div>

    <div class="admin-search-box">
        <label for="sch_word" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
        <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
        <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
        <input type="hidden" name="wmode" value="1">
        <label class="input input-button margin-bottom-0">
            <input type="text" name="sch_word" value="<?php echo get_text($sch_word); ?>" id="sch_word" required placeholder="<?php echo $t_name; ?>">
            <div class="button"><input type="submit" value="검색">검색</div>
        </label>
    </div>
    <div class="margin-bottom-20"></div>

    <?php if(G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="coupontarget-list"></div>

    </form>
</div>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>

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
            <?php echo $t_name; ?>: "<strong><?php echo $list[$i]['t_name']; ?></strong>",
            <?php echo $t_id; ?>: "<?php echo $list[$i]['t_id']; ?>",
            선택: "<a href='javascript:;' class='btn-e btn-e-xs btn-e-red' onclick='sel_target_id(\"<?php echo $list[$i]['t_id']; ?>\");'>선택</a>"
        },
        <?php } ?>
    ]
}();

$(document).ready(function(){
    $("#coupontarget-list").jsGrid({
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
            { name: "<?php echo $t_name; ?>", type: "text", width: 200 },
            { name: "<?php echo $t_id; ?>", type: "text", align: "center", width: 80 },
            { name: "선택", type: "text", align: "center", width: 80 }
        ]
    });
});

function sel_target_id(it_id) {
    $('#cp_target', parent.document).val(it_id);
    window.parent.closeModal();
}
</script>