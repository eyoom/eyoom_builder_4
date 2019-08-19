<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/sms/history_num.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-history-num">
    <form id="search_form" name="search_form" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">

    <div class="adm-headline">
        <h3><?php echo $g5['title']; ?></h3>
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
                        <td>
                            <div <?php if (!G5_IS_MOBILE) { ?>class="inline-group"<?php } ?>>
                                <div class="margin-bottom-5">
                                    <label class="select form-width-150px">
                                        <select name="st" id="st">
                                            <option value="hs_name"<?php echo get_selected('hs_name', $st); ?>>이름</option>
                                            <option value="hs_hp"<?php echo get_selected('hs_hp', $st); ?>>휴대폰번호</option>
                                            <option value="bk_no"<?php echo get_selected('bk_no', $st); ?>>고유번호</option>
                                        </select><i></i>
                                    </label>
                                </div>
                                <span>
                                    <label class="input form-width-250px">
                                        <input type="text" name="sv" value="<?php echo get_sanitize_input($sv); ?>" id="ssv">
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

    </form>
    <div class="margin-bottom-30"></div>

    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="history-num-list"></div>

    <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME']."?st=$st&amp;sv=$sv&amp;page="); ?>
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
                return !(filter.체크 && !(client.체크.indexOf(filter.체크) > -1) || filter.아이디 && !(client.아이디.indexOf(filter.아이디) > -1) || filter.이름 && !(client.이름.indexOf(filter.이름) > -1) )
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
        <?php for ($i=0; $i<$count; $i++) { ?>
        {
            번호: "<?php echo number_format($list[$i]['vnum']); ?>",
            관리: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=history_view&amp;page=<?php echo $page; ?>&amp;st=<?php echo $st; ?>&amp;sv=<?php echo $sv; ?>&amp;wr_no=<?php echo $list[$i]['wr_no']; ?>'><u>수정</u></a>",
            그룹: "<?php echo $list[$i]['bg_name']; ?>",
            이름: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=num_book_write&amp;w=u&amp;bk_no=<?php echo $list[$i]['bk_no']; ?>'><?php echo $list[$i]['hs_name']; ?></a>",
            회원ID: "<?php echo $list[$i]['mb_id']; ?>",
            전화번호: "<?php echo $list[$i]['hs_hp']; ?>",
            전송일시: "<?php echo date('Y-m-d H:i', strtotime($write['wr_datetime']))?>",
            예약: "<?php echo $write['wr_booking']!='0000-00-00 00:00:00'?"<span title='{$write['wr_booking']}'>예약</span>":'-';?>",
            전송: "<?php echo $list[$i]['hs_flag']?'성공':'실패'?>",
            메세지: "<span title='<?php echo $write['wr_message']?>'><?php echo $write['wr_message']?></span>",
        },
        <?php } ?>
    ]
}();

$(function() {
    $("#history-num-list").jsGrid({
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
            { name: "번호", type: "text", align: "center", width: 40 },
            { name: "관리", type: "text", align: "center", width: 60, headercss: "set-btn-header", css: "set-btn-field" },
            { name: "그룹", type: "text", align: "center", width: 60 },
            { name: "이름", type: "text", align: "center", width: 100 },
            { name: "회원ID", type: "text", width: 100 },
            { name: "전화번호", type: "text", width: 150 },
            { name: "전송일시", type: "text", align: "center", width: 150 },
            { name: "예약", type: "text", align: "center", width: 60 },
            { name: "전송", type: "text", align: "center", width: 60 },
            { name: "메세지", type: "text", width: 300 },
        ]
    });

});
</script>

