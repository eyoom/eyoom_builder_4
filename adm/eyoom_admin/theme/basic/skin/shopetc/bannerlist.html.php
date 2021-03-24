<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shop/bannerlist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<style>
.admin-shop-bannerlist #admin-shop-bannerlist img {display:block;width:100% \9;max-width:100%;height:auto}
</style>

<div class="admin-shop-bannerlist">
    <div class="adm-headline adm-headline-btn">
        <h3>배너 관리</h3>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&pid=bannerform" class="btn-e btn-e-lg btn-e-red"><i class="fas fa-plus"></i> 배너추가</a>
    </div>

    <div class="row">
        <div class="col-sm-8">
            <div class="margin-bottom-5">
                <span class="font-size-12 color-grey">
                    등록된 배너 <?php echo number_format($total_count); ?>개
                </span>
            </div>
        </div>
    </div>

    <?php if(G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="admin-shop-bannerlist"></div>
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
                return !(filter.ID)
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        {
            ID: "<?php echo $list[$i]['bn_id'];  ?>",
            관리: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&amp;pid=bannerform&amp;w=u&amp;bn_id=<?php echo $list[$i]['bn_id'];  ?>'><u>수정</u></a><a href='<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&amp;pid=bannerformupdate&amp;w=d&amp;bn_id=<?php echo $list[$i]['bn_id'];  ?>' onclick='return delete_confirm(this);' class='margin-left-10'><u>삭제</u></a>",
            이미지: "<div style='width:150px;margin:0 auto;'><?php echo $list[$i]['bn_img'];  ?></div>",
            접속기기: "<?php echo $list[$i]['bn_device'];  ?>",
            위치: "<?php echo $list[$i]['bn_position'];  ?>",
            시작일시: "<?php echo $list[$i]['bn_begin_time'];  ?>",
            종료일시: "<?php echo $list[$i]['bn_end_time'];  ?>",
            출력순서: "<?php echo $list[$i]['bn_order'];  ?>",
            조회: "<?php echo $list[$i]['bn_hit'];  ?>",
        },
        <?php } ?>
    ]
}();

$(document).ready(function() {
    $("#admin-shop-bannerlist").jsGrid({
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
            { name: "ID", type: "text", align: "center", width: 80 },
            { name: "관리", type: "text", align: "center", width: 110, headercss: "set-btn-header", css: "set-btn-field" },
            { name: "이미지", type: "text", align: "center", width: 160 },
            { name: "접속기기", type: "text", width: 100 },
            { name: "위치", type: "text", align: "center", width: 80 },
            { name: "시작일시", type: "text", align: "center", width: 150 },
            { name: "종료일시", type: "text", align: "center", width: 150 },
            { name: "출력순서", type: "text", align: "center", width: 60 },
            { name: "조회", type: "text", align: "center", width: 60 },
        ]
    });
});

jQuery(function($) {
    $(".sbn_img_view").on("click", function() {
        $(this).closest(".td_img_view").find(".sbn_image").slideToggle();
    });
});
</script>