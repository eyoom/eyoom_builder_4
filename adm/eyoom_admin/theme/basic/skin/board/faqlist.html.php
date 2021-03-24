<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/member/faqlist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-faqlist">
    <div class="adm-headline adm-headline-btn">
        <h3>FAQ 상세관리</h3>
        <?php if (!$wmode) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&pid=faqform&amp;fm_id=<?php echo $fm['fm_id']; ?>" class="btn-e btn-e-red btn-e-lg"><i class="fas fa-plus"></i> FAQ 상세내용 추가</a>
        <?php } ?>
    </div>

    <div class="margin-bottom-5">
        <span class="font-size-12 color-grey">
            등록된 FAQ 상세내용 <?php echo number_format($total_count); ?>건
        </span>
    </div>

    <?php if (C.G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="faq-list"></div>

    <div class="text-center margin-top-30 margin-bottom-30">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=faqmasterlist" class="btn-e btn-e-lg btn-e-red">FAQ 관리</a>
    </div>
</div>

<div class="margin-bottom-20"></div>

<div class="alert alert-info font-size-12">
    <ol>
        <li>FAQ는 무제한으로 등록할 수 있습니다</li>
        <li><strong>FAQ 상세내용 추가</strong>를 눌러 자주하는 질문과 답변을 입력합니다.</li>
    </ol>
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
                return !(filter.번호 && !(client.번호.indexOf(filter.번호) > -1) )
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        {
            No: "<?php echo $list[$i]['num']; ?>",
            관리: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=faqform&amp;w=u&amp;fm_id=<?php echo $list[$i]['fm_id']; ?>&amp;fa_id=<?php echo $list[$i]['fa_id']; ?>'><u>수정</u></a> <a href='<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=faqformupdate&amp;w=d&amp;fm_id=<?php echo $list[$i]['fm_id']; ?>&amp;fa_id=<?php echo $list[$i]['fa_id']; ?>&amp;smode=1' class='margin-left-10' onclick='return delete_confirm(this);'><u>삭제</u></a>",
            제목: "<?php echo $list[$i]['fa_subject']; ?>",
            순서: "<?php echo $list[$i]['fa_order']; ?>",
        },
        <?php } ?>
    ]
}();

$(function() {
    $("#faq-list").jsGrid({
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
            { name: "No", type: "text", align: "center", width: 40 },
            { name: "관리", type: "text", width: 110, align: 'center', headercss: "set-btn-header", css: "set-btn-field" },
            { name: "제목", type: "text", width: 500 },
            { name: "순서", type: "number", width: 60 },
        ]
    });
});

function delete_confirm(f) {
    if (confirm('한번 삭제한 자료는 다시는 복구할 수 없습니다.\n\n정말로 삭제하시겠습니까?')) {
        return true;
    } else {
        return false;
    }
}
</script>