<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/member/visit_year.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-visit-year">
    <div class="adm-headline">
        <h3>연도별 접속자집계</h3>
    </div>

    <?php include_once(EYOOM_ADMIN_THEME_PATH . '/skin/member/visit.sub.html.php'); ?>

    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="visit-year"></div>
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
                return !(filter.IP && !(client.IP.indexOf(filter.IP) > -1) || filter.접속경로 && !(client.접속경로.indexOf(filter.접속경로) > -1))
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        {
            년: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=visit_month&fr_date=<?php echo $list[$i]['key']; ?>-01-01&to_date=<?php echo $list[$i]['key']; ?>-12-31'><?php echo $list[$i]['key']; ?></a>",
            그래프: "<div class='visit_bar'><span style='width:<?php echo $list[$i]['s_rate']; ?>%'></span></div>",
            접속자수: "<?php echo number_format($list[$i]['value']); ?>",
            비율: "<?php echo $list[$i]['s_rate']; ?> %"
        },
        <?php } ?>
    ]
}();

$(document).ready(function() {
    $("#visit-year").jsGrid({
        filtering      : false,
        editing        : false,
        sorting        : false,
        paging         : true,
        autoload       : true,
        controller     : db,
        deleteConfirm  : "정말로 삭제하시겠습니까?\n한번 삭제된 데이터는 복구할수 없습니다.",
        pageButtonCount: 5,
        pageSize       : 24,
        width          : "100%",
        height         : "auto",
        fields         : [
            { name: "년", type: "text", width: 80 },
            { name: "그래프", type: "text", width: 500 },
            { name: "접속자수", type: "text", width: 80 },
            { name: "비율", type: "text", width: 80 },
        ]
    })
});
</script>