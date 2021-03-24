<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shop/couponmember.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-shop-couponmemberlist">
    <form name="fmember" id="fmember" class="eyoom-form" method="get">

    <div class="admin-search-box">
        <div class="row">
            <div class="col col-12">
                <label for="sch_word" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
                <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
                <input type="hidden" name="wmode" value="1">
                <label class="input input-button margin-bottom-0">
                    <input type="text" name="mb_name" value="<?php echo get_text($mb_name); ?>" id="mb_name" required placeholder="회원이름">
                    <div class="button"><input type="submit" value="검색">검색</div>
                </label>
            </div>
        </div>
    </div>
    <div class="margin-bottom-20"></div>

    <?php if(G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="couponmember-list"></div>

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
            회원이름: "<?php echo get_text($list[$i]['mb_name']); ?>",
            회원아이디: "<?php echo $list[$i]['mb_id']; ?>",
            선택: "<a href='javascript:;' class='btn-e btn-e-xs btn-e-red' onclick='sel_member_id(\"<?php echo $list[$i]['mb_id']; ?>\");'>선택</a>"
        },
        <?php } ?>
    ]
}();

$(document).ready(function(){
    $("#couponmember-list").jsGrid({
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
            { name: "회원이름", type: "text", width: 100 },
            { name: "회원아이디", type: "text", width: 150 },
            { name: "선택", type: "text", align: "center", width: 80 }
        ]
    });
});
</script>

<script>
function sel_member_id(mb_id)
{
    $('#mb_id', parent.document).val(mb_id);
    window.parent.closeModal();
}
</script>