<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/board/boardgroup_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-boardgroup-list">
    <form id="fsearch" name="fsearch" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">

    <div class="adm-headline adm-headline-btn">
        <h3>게시판 그룹 설정</h3>
        <?php if (!$wmode) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=boardgroup_form" class="btn-e btn-e-red btn-e-lg"><i class="fas fa-plus"></i> 게시판 그룹 추가</a>
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
                        <td>
                            <div <?php if (!G5_IS_MOBILE) { ?>class="inline-group"<?php } ?>>
                                <div class="margin-bottom-5">
                                    <label class="select form-width-150px">
                                        <select name="sfl" id="sfl">
                                            <option value="gr_subject"<?php echo get_selected($sfl, "gr_subject"); ?>>제목</option>
                                            <option value="gr_id"<?php echo get_selected($sfl, "gr_id"); ?>>그룹ID</option>
                                            <option value="gr_admin"<?php echo get_selected($sfl, "gr_admin"); ?>>그룹관리자</option>
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

    <form name="fboardgrouplist" id="fboardgrouplist" action="<?php echo $action_url1; ?>" method="post" onsubmit="return fboardgrouplist_submit(this);" class="eyoom-form">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="<?php echo $token; ?>">

    <div class="margin-bottom-10">
        <span class="font-size-12 color-grey">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="margin-left-10 margin-right-10 color-light-grey">|</span>전체그룹 <?php echo number_format($total_count); ?>개
        </span>
    </div>

    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="group-list"></div>

    <div class="margin-top-20">
        <input type="submit" name="act_button" value="선택수정" class="btn-e btn-e-xs btn-e-red" onclick="document.pressed=this.value">
        <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
    </div>
    </form>
</div>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>
<div class="margin-bottom-20"></div>

<?php if (!$wmode) { ?>
<div class="margin_top_20">
    <div class="alert alert-info">
        <p class="font-size-12">
            <i class="fas fa-info-circle"></i> 접근사용 옵션을 설정하시면 관리자가 지정한 회원만 해당 그룹에 접근할 수 있습니다.<br>
            <i class="fas fa-info-circle"></i> 접근사용 옵션은 해당 그룹에 속한 모든 게시판에 적용됩니다.
        </p>
    </div>
</div>
<?php } ?>

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
                return !(filter.체크 && !(client.체크.indexOf(filter.체크) > -1) )
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        {
            체크: "<input type='hidden' name='group_id[<?php echo $i; ?>]' value='<?php echo $list[$i]['gr_id']; ?>'><label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $i; ?>'><i></i></label>",
            관리: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=boardgroup_form&amp;w=u&amp;gr_id=<?php echo $list[$i]['gr_id']; ?>&amp;<?php echo $qstr; ?>'><u>수정</u></a>",
            그룹아이디: "<a href='<?php echo get_eyoom_pretty_url(G5_GROUP_DIR, $list[$i]['gr_id']); ?>' target='_blank'><?php echo $list[$i]['gr_id']; ?></a>",
            제목: "<label class='input'><input type='text' name='gr_subject[<?php echo $i; ?>]' id='gr_subject_<?php echo $i; ?>' value='<?php echo get_text($list[$i]['gr_subject']); ?>' required></label>",
            그룹관리자: "<?php if ($is_admin == 'super') { ?><label class='input'><input type='text' name='gr_admin[<?php echo $i; ?>]' id='gr_admin<?php echo $i; ?>' value='<?php echo get_sanitize_input($list[$i]['gr_admin']); ?>' style='text-align:right;'></label><?php } else { ?><input type='hidden' name='gr_admin[<?php echo $i ?>]' value='<?php echo get_sanitize_input($row['gr_admin']); ?>'><?php echo get_text($row['gr_admin']); ?><?php } ?>",
            게시판: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_list&amp;sfl=a.gr_id&amp;stx=<?php echo $list[$i]['gr_id']; ?>'><?php echo $list[$i]['board_cnt']; ?></a>",
            접근사용: "<label class='checkbox'><input type='checkbox' name='gr_use_access[<?php echo $i; ?>]' id='gr_use_access_<?php echo $i; ?>' value='1' <?php echo $list[$i]['gr_use_access'] ? 'checked':''; ?>><i></i></label>",
            접근회원수: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=boardgroupmember_list&amp;gr_id=<?php echo $list[$i]['gr_id']; ?>'><?php echo $list[$i]['member_cnt']; ?></a>",
            출력순서: "<label class='input'><input type='text' name='gr_order[<?php echo $i; ?>]' id='gr_order_<?php echo $i; ?>' value='<?php echo $list[$i]['gr_order']; ?>' style='text-align:right;'></label>",
            접속기기: "<label class='select'><select name='gr_device[<?php echo $i; ?>]' id='gr_device_<?php echo $i; ?>'><option value='both' <?php echo $list[$i]['gr_device']=='both' ? 'selected':''; ?>>모두</option><option value='pc' <?php echo $list[$i]['gr_device']=='pc' ? 'selected':''; ?>>PC</option><option value='mobile' <?php echo $list[$i]['gr_device']=='mobile' ? 'selected':''; ?>>모바일</option></select><i></i></label>",
        },
        <?php } ?>
    ]
}();

$(function() {
    $("#group-list").jsGrid({
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
            { name: "관리", type: "text", align: "center", width: 80, headercss: "set-btn-header", css: "set-btn-field" },
            { name: "그룹아이디", type: "text", width: 100 },
            { name: "제목", type: "text", width: 200 },
            { name: "그룹관리자", type: "text", width: 100 },
            { name: "게시판", type: "number", width: 60 },
            { name: "접근사용", type: "text", width: 60 },
            { name: "접근회원수", type: "number", width: 60 },
            { name: "출력순서", type: "text", width: 70 },
            { name: "접속기기", type: "text", width: 105 },
        ]
    });

    var $chk = $(".jsgrid-table th:first-child");
    if ($chk.text() == '체크') {
        var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>';
        $chk.html(html);
    }
});

function fboardgrouplist_submit(f) {
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