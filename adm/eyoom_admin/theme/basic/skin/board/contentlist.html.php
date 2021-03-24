<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/board/contentlist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-contentlist">
    <form id="fsearch" name="fsearch" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">

    <div class="adm-headline adm-headline-btn">
        <h3>내용 관리</h3>
        <?php if (!$wmode) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=contentform" class="btn-e btn-e-red btn-e-lg"><i class="fas fa-plus"></i> 내용 추가</a>
        <?php } ?>
    </div>

    <div class="adm-table-form-wrap adm-search-box">
        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">검색어</label>
                        </th>
                        <td colspan="3">
                            <div <?php if (!G5_IS_MOBILE) { ?>class="inline-group"<?php } ?>>
                                <div class="margin-bottom-5">
                                    <label class="select form-width-150px">
                                        <select name="sfl" id="sfl">
                                            <option value="co_id"<?php echo get_selected($sfl, "co_id"); ?>>아이디</option>
                                            <option value="co_subject"<?php echo get_selected($sfl, "co_subject"); ?>>제목</option>
                                        </select><i></i>
                                    </label>
                                </div>
                                <span>
                                    <label class="input form-width-250px">
                                        <input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" autocomplete="off">
                                    </label>
                                </span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php if (!G5_IS_MOBILE) { ?>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php echo $frm_submit; ?>

    <div class="margin-bottom-30"></div>

    <div class="row">
        <div class="col col-9">
            <div class="padding-top-5 clearfix">
                <span class="font-size-12 color-grey">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="margin-left-10 margin-right-10 color-light-grey">|</span>전체 내용 <?php echo number_format($total_count); ?>건
                </span>
            </div>
        </div>
    </div>

    </form>

    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="content-list"></div>
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
                return !(filter.ID && !(client.ID.indexOf(filter.ID) > -1) )
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        {
            관리: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=contentform&amp;w=u&amp;co_id=<?php echo $list[$i]['co_id']; ?>'><u>수정</u></a> <a href='<?php echo get_eyoom_pretty_url('content', $list[$i]['co_id']); ?>' target='_blank' class='margin-left-10'><u>보기</u></a> <a href='<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=contentformupdate&amp;w=d&amp;co_id=<?php echo $list[$i]['co_id']; ?>&amp;smode=1' class='margin-left-10' onclick='return delete_confirm(this);'><u>삭제</u></a>",
            ID: "<?php echo $list[$i]['co_id']; ?>",
            제목: "<?php echo htmlspecialchars2($list[$i]['co_subject']); ?>",
        },
        <?php } ?>
    ]
}();

$(function() {
    $("#content-list").jsGrid({
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
            { name: "관리", type: "text", width: 140, align: 'center', headercss: "set-btn-header", css: "set-btn-field" },
            { name: "ID", type: "text", width: 100 },
            { name: "제목", type: "text", width: 400 },
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