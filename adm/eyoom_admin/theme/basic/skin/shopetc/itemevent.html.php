<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shopetc/itemevent.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-shop-itemevent">
    <div class="adm-headline adm-headline-btn">
        <h3>이벤트 관리</h3>
        <?php if (!$wmode) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&pid=itemeventform" class="btn-e btn-e-lg btn-e-red"><i class="fas fa-plus"></i> 이벤트 추가</a>
        <?php } ?>
    </div>

    <div class="row">
        <div class="col-sm-8">
            <div class="margin-bottom-5">
                <span class="font-size-12 color-grey">전체 이벤트 <?php echo number_format($total_count); ?>건</span>
            </div>
        </div>
    </div>

    <?php if(G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="admin-shop-itemevent"></div>
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
                return !(filter.이벤트번호)
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        {
            이벤트번호: "<?php echo $list[$i]['ev_id']; ?>",
            관리: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&amp;pid=itemeventform&amp;w=u&amp;ev_id=<?php echo $list[$i]['ev_id']; ?>'><u>수정</u></a><a href='<?php echo G5_SHOP_URL; ?>/event.php?ev_id=<?php echo $list[$i]['ev_id']; ?>' target='_blank' class='margin-left-10'><u>보기</u></a><a href='<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&amp;pid=itemeventformupdate&amp;w=d&amp;ev_id=<?php echo $list[$i]['ev_id']; ?>' onclick='return delete_confirm(this);' class='margin-left-10'><u>삭제</u></a>",
            제목: "<?php echo $list[$i]['subject']; ?>",
            연결상품: "<?php echo $list[$i]['cnt'] ? $list[$i]['href']: 0; ?>",
            사용: "<?php echo $list[$i]['ev_use'] ? '예': '아니오'; ?>",
        },
        <?php } ?>
    ]
}();

$(document).ready(function() {
    $("#admin-shop-itemevent").jsGrid({
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
            { name: "이벤트번호", type: "text", align: "center", width: 100 },
            { name: "관리", type: "text", align: "center", width: 110, headercss: "set-btn-header", css: "set-btn-field" },
            { name: "제목", type: "image", width: 250 },
            { name: "연결상품", type: "text", align: "center", width: 60 },
            { name: "사용", type: "text", align: "center", width: 60 },
        ]
    })
});

function itemeventwin(ev_id) {
    window.open("<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&pid=itemeventwin&wmode=1&ev_id="+ev_id, "itemeventwin", "left=10,top=10,width=500,height=600,scrollbars=1");
}

function delete_confirm() {
    if(confirm('정말로 선택한 이벤트를 삭제하시겠습니까?')) {
        return true;
    } else {
        return false;
    }
}
</script>