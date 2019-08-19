<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/sms/history_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-history-list">
    <form id="search_form" name="search_form" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    <input type="hidden" name="st" id="st" value="wr_message" >

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
                        <td colspan="3">
                            <div <?php if (!G5_IS_MOBILE) { ?>class="inline-group"<?php } ?>>
                                <span>
                                    <label class="input fåorm-width-250px">
                                        <input type="text" name="sv" value="<?php echo $sv; ?>" id="sv" required>
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

    <div id="history-list"></div>
</div>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>
<div class="margin-bottom-20"></div>

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
                return !(filter.No && !(client.No.indexOf(filter.No) > -1) || filter.회원구분 && !(client.회원구분.indexOf(filter.회원구분) > -1) || filter.아이디 && !(client.아이디.indexOf(filter.아이디) > -1) || filter.이름 && !(client.이름.indexOf(filter.이름) > -1) || filter.휴대전화 && !(client.휴대전화.indexOf(filter.휴대전화) > -1) || filter.전화번호 && !(client.전화번호.indexOf(filter.전화번호) > -1) || filter.이메일 && !(client.이메일.indexOf(filter.이메일) > -1) || filter.가입일 && !(client.가입일.indexOf(filter.가입일) > -1) || filter.최신로그인 && !(client.최신로그인.indexOf(filter.최신로그인) > -1) || filter.상태 && !(client.상태.indexOf(filter.상태) > -1) )
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
        <?php for ($i=0; $i<$sms_count; $i++) { ?>
        {
            번호: "<?php echo $list[$i]['vnum']; ?>",
            관리: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=history_view&amp;page=<?php echo $page; ?>&amp;st=<?php echo $st; ?>&amp;sv=<?php echo $sv; ?>&amp;wr_no=<?php echo $list[$i]['wr_no']; ?>'><u>수정</u></a>",
            메세지: "<span title='<?php echo $list[$i]['wr_message']?>'><?php echo $list[$i]['wr_message']?></span>",
            회신번호: "<?php echo $list[$i]['wr_reply']?>",
            전송일시: "<?php echo date('Y-m-d H:i', strtotime($list[$i]['wr_datetime'])); ?>",
            예약: "<?php echo $list[$i]['wr_booking']!='0000-00-00 00:00:00'? '예약':'';?>",
            총건수: "<?php echo number_format($list[$i]['wr_total'])?>",
            성공: "<?php echo number_format($list[$i]['wr_success'])?>",
            실패: "<?php echo number_format($list[$i]['wr_failure'])?>",
            중복: "<?php echo number_format($list[$i]['dupli_count'])?>",
            재전송: "<?php echo number_format($list[$i]['wr_re_total'])?>",
        },
        <?php } ?>
    ]
}();

$(function() {
    $("#history-list").jsGrid({
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
            { name: "번호", type: "text", align: "center", width: 60 },
            { name: "관리", type: "text", align: "center", width: 80, headercss: "set-btn-header", css: "set-btn-field" },
            { name: "메세지", type: "text", width: 250 },
            { name: "회신번호", type: "text", align: "center", width: 150 },
            { name: "전송일시", type: "text", align: "center", width: 150 },
            { name: "예약", type: "text", align: "center", width: 80 },
            { name: "총건수", type: "number", width: 80 },
            { name: "성공", type: "number", width: 60 },
            { name: "실패", type: "number", width: 60 },
            { name: "중복", type: "number", width: 60 },
            { name: "재전송", type: "number", width: 60 },
        ]
    });

});

function fhistorylist_submit(f) {
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}
</script>