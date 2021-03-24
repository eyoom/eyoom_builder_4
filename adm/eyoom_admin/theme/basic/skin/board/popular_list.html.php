<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/board/popular_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-popular-list">
    <form id="fsearch" name="fsearch" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    <div class="adm-headline">
        <h3>인기 검색어 관리</h3>
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
                                        <select name="sfl" id="sfl">
                                            <option value="pp_word"<?php echo get_selected($sfl, "pp_word"); ?>>검색어</option>
                                            <option value="pp_date"<?php echo get_selected($sfl, "pp_date"); ?>>등록일</option>
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

    </form>

    <div class="margin-bottom-30"></div>

    <form name="fpopularlist" id="fpopularlist" method="post" class="eyoom-form">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="<?php echo $token; ?>">

    <div class="margin-bottom-5">
        <span class="font-size-12 color-grey">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="margin-left-10 margin-right-10 color-light-grey">|</span>건수 <?php echo number_format($total_count); ?>개
        </span>
    </div>

    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="popular-list"></div>

    <?php if ($is_admin == 'super') { ?>
    <div class="margin-top-20">
        <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
    </div>
    <?php } ?>

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
                return !(filter.No && !(client.No.indexOf(filter.No) > -1) || filter.회원구분 && !(client.회원구분.indexOf(filter.회원구분) > -1) || filter.아이디 && !(client.아이디.indexOf(filter.아이디) > -1) || filter.이름 && !(client.이름.indexOf(filter.이름) > -1) || filter.휴대전화 && !(client.휴대전화.indexOf(filter.휴대전화) > -1) || filter.전화번호 && !(client.전화번호.indexOf(filter.전화번호) > -1) || filter.이메일 && !(client.이메일.indexOf(filter.이메일) > -1) || filter.가입일 && !(client.가입일.indexOf(filter.가입일) > -1) || filter.최신로그인 && !(client.최신로그인.indexOf(filter.최신로그인) > -1) || filter.상태 && !(client.상태.indexOf(filter.상태) > -1) )
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        {
            체크: "<label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $list[$i]['pp_id']; ?>'><i></i></label>",
            검색어: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=popular_list&amp;sfl=pp_word&amp;stx=<?php echo $list[$i]['word']; ?>'><?php echo $list[$i]['word']; ?></a>",
            등록일: "<?php echo $list[$i]['pp_date']; ?>",
            등록IP: "<?php echo $list[$i]['pp_ip']; ?>",
        },
        <?php } ?>
    ]
}();

$(function() {
    $("#popular-list").jsGrid({
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
            { name: "체크", type: "text", width: 40 },
            { name: "검색어", type: "text", width: 200 },
            { name: "등록일", type: "text", width: 200 },
            { name: "등록IP", type: "text", width: 100 },
        ]
    });

    var $chk = $(".jsgrid-table th:first-child");
    if ($chk.text() == '체크') {
        var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>';
        $chk.html(html);
    }
});

$(function() {
    $('#fpopularlist').submit(function() {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
            if (!is_checked("chk[]")) {
                alert("선택삭제 하실 항목을 하나 이상 선택하세요.");
                return false;
            }

            return true;
        } else {
            return false;
        }
    });
});
</script>