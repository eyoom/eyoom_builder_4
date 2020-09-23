<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shopetc/sale1year.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<style>
#admin-shop-sale1year .total-row {font-weight:bold;background:#FFF3E0}
</style>

<div class="admin-shop-sale1year">
    <div class="adm-headline">
        <h3><?php echo $fr_year; ?> ~ <?php echo $to_year; ?> 연간 매출현황</h3>
    </div>

    <?php if(G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="admin-shop-sale1year"></div>
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
                return !(filter.주문번호)
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
        <?php for ($i=0; $i<$cnt; $i++) { ?>
        {
            주문년도: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&amp;pid=sale1month&amp;fr_month=<?php echo preg_replace('/-/','',$list[$i]['od_date']); ?>01&amp;to_month=<?php echo preg_replace('/-/','',$list[$i]['od_date']); ?>12'><?php echo $list[$i]['od_date']; ?></a>",
            주문수: "<?php echo number_format($list[$i]['count']); ?>",
            주문합계: "<?php echo number_format($list[$i]['save']['orderprice']); ?>",
            쿠폰: "<?php echo number_format($list[$i]['save']['ordercoupon']); ?>",
            무통장: "<?php echo number_format($list[$i]['save']['receiptbank']); ?>",
            가상계좌: "<?php echo number_format($list[$i]['save']['receiptvbank']); ?>",
            계좌이체: "<?php echo number_format($list[$i]['save']['receiptiche']); ?>",
            카드입금: "<?php echo number_format($list[$i]['save']['receiptcard']); ?>",
            간편결제: "<?php echo number_format($list[$i]['save']['receipteasy']); ?>",
            휴대폰: "<?php echo number_format($list[$i]['save']['receipthp']); ?>",
            포인트입금: "<?php echo number_format($list[$i]['save']['receiptpoint']); ?>",
            주문취소: "<?php echo number_format($list[$i]['save']['ordercancel']); ?>",
            미수금: "<?php echo number_format($list[$i]['save']['misu']); ?>",
        },
        <?php } ?>
    ];
}();

$(document).ready(function(){
    $("#admin-shop-sale1year").jsGrid({
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
        onRefreshed: function(args) {
            var items = args.grid.option("data");
            var total = {
                "주문년도": "합계",
                "주문수": "<strong class='color-teal'><?php echo number_format($tot['ordercount']); ?></strong>",
                "주문합계": "<strong class='color-indigo'><?php echo number_format($tot['orderprice']); ?></strong>",
                "쿠폰": "<?php echo number_format($tot['ordercoupon']); ?>",
                "무통장": "<?php echo number_format($tot['receiptbank']); ?>",
                "가상계좌": "<?php echo number_format($tot['receiptvbank']); ?>",
                "계좌이체": "<?php echo number_format($tot['receiptiche']); ?>",
                "카드입금": "<?php echo number_format($tot['receiptcard']); ?>",
                "간편결제": "<?php echo number_format($tot['receipteasy']); ?>",
                "휴대폰": "<?php echo number_format($tot['receipthp']); ?>",
                "포인트입금": "<?php echo number_format($tot['receiptpoint']); ?>",
                "주문취소": "<strong class='color-pink'><?php echo number_format($tot['ordercancel']); ?></strong>",
                "미수금": "<strong class='color-pink'><?php echo number_format($tot['misu']); ?></strong>",
            };
            var $totalRow = $("<tr>").addClass("total-row");
            args.grid._renderCells($totalRow, total);
            args.grid._content.append($totalRow);
        },
        fields         : [
            { name: "주문년도", type: "text", align: "center", width: 100 },
            { name: "주문수", type: "number", width: 70 },
            { name: "주문합계", type: "number", width: 70 },
            { name: "쿠폰", type: "number", width: 70 },
            { name: "무통장", type: "number", width: 70 },
            { name: "가상계좌", type: "number", width:70 },
            { name: "계좌이체", type: "number", width: 70 },
            { name: "카드입금", type: "number", width: 70 },
            { name: "간편결제", type: "number", width: 70 },
            { name: "휴대폰", type: "number", width: 70 },
            { name: "포인트입금", type: "number", width: 70 },
            { name: "주문취소", type: "number", width: 70 },
            { name: "미수금", type: "number", width: 70 },
        ]
    });
});
</script>