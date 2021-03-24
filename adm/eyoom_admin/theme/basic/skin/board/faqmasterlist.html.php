<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/member/faqmasterlist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-faqmasterlist">
    <div class="adm-headline adm-headline-btn">
        <h3>FAQ 관리</h3>
        <?php if (!$wmode) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=faqmasterform" class="btn-e btn-e-red btn-e-lg"><i class="fas fa-plus"></i> FAQ 추가</a>
        <?php } ?>
    </div>

    <div class="margin-bottom-5">
        <span class="font-size-12 color-grey">
            <?php if ($page > 1) { ?><a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[처음으로]</a><span class="margin-left-10 margin-right-10 color-light-grey">|</span><?php } ?>전체 FAQ <?php echo number_format($total_count); ?>건
        </span>
    </div>

    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="faqmaster-list"></div>
</div>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>

<div class="margin-bottom-20"></div>

<div class="alert alert-info font-size-12">
    <ol>
        <li>FAQ는 무제한으로 등록할 수 있습니다</li>
        <li><strong>FAQ추가</strong>를 눌러 FAQ Master를 생성합니다. (하나의 FAQ 타이틀 생성 : 자주하시는 질문, 이용안내..등 )</li>
        <li>생성한 FAQ Master 의 <strong>제목</strong>을 눌러 세부 내용을 관리할 수 있습니다.</li>
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
                return !(filter.ID && !(client.ID.indexOf(filter.ID) > -1) )
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        {
            No: "<?php echo $list[$i]['fm_id']; ?>",
            관리: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=faqmasterform&amp;w=u&amp;fm_id=<?php echo $list[$i]['fm_id']; ?>'><u>수정</u></a> <a href='<?php echo G5_BBS_URL; ?>/faq.php?fm_id=<?php echo $list[$i]['fm_id']; ?>' target='_blank' class='margin-left-10'><u>보기</u></a> <a href='<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=faqmasterformupdate&amp;w=d&amp;fm_id=<?php echo $list[$i]['fm_id']; ?>&amp;smode=1' class='margin-left-10' onclick='return delete_confirm(this);'><u>삭제</u></a>",
            제목: "<?php echo stripslashes($list[$i]['fm_subject']); ?>",
            FAQ수: "<?php echo $list[$i]['cnt']; ?>",
            순서: "<?php echo $list[$i]['fm_order']; ?>",
        },
        <?php } ?>
    ]
}();

$(function() {
    $("#faqmaster-list").jsGrid({
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
            { name: "관리", type: "text", width: 140, align: 'center', headercss: "set-btn-header", css: "set-btn-field" },
            { name: "제목", type: "text", width: 400 },
            { name: "FAQ수", type: "number", width: 60 },
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