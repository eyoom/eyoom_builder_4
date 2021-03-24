<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/sms/num_book.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<style>
.num-book-info {position:relative;padding:10px;background:#fff;border:1px solid #cc2300;font-size:12px}
.num-book-info .book-info-li {margin-right:15px}
.num-book-info .book-info-li .ov_txt {font-weight:bold}
.num-book-info .book-info-li .ov_num {color:#cc2300;font-weight:bold}
</style>

<script>
function book_all_checked(chk) {
    if (chk) {
        jQuery('[name="bk_no[]"]').attr('checked', true);
    } else {
        jQuery('[name="bk_no[]"]').attr('checked', false);
    }
}

function no_hp_click(val) {
    var url = '<?php echo G5_ADMIN_URL; ?>/?dir=sms&pid=num_book&bg_no=<?php echo $bg_no?>&st=<?php echo $st?>&sv=<?php echo $sv?>';

    if (val == true)
        location.href = url + '&no_hp=yes';
    else
        location.href = url + '&no_hp=no';
}
</script>

<div class="admin-num-book">
    <form id="search_form" name="search_form" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    <input type="hidden" name="bg_no" value="<?php echo $bg_no?>" >

    <div class="adm-headline adm-headline-btn">
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
                                            <option value="all"<?php echo get_selected('all', $st); ?>>이름 + 휴대폰번호</option>
                                            <option value="name"<?php echo get_selected('name', $st); ?>>이름</option>
                                            <option value="hp" <?php echo get_selected('hp', $st); ?>>휴대폰번호</option>
                                        </select><i></i>
                                    </label>
                                </div>
                                <span>
                                    <label class="input form-width-250px">
                                        <input type="text" name="sv" value="<?php echo get_sanitize_input($sv); ?>" id="sv">
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

    <?php echo $frm_submit1; ?>

    </form>
    <div class="margin-bottom-30"></div>

    <div class="num-book-info">
        <span class="book-info-li"><span class="ov_txt">업데이트 </span><span class="ov_num"><?php echo $sms5['cf_datetime']?></span></span>
        <span class="book-info-li"><span class="ov_txt">건수 </span><span class="ov_num"><?php echo number_format($total_count)?>명</span></span>
        <span class="book-info-li"><span class="ov_txt">회원 </span><span class="ov_num"> <?php echo number_format($member_count)?>명</span></span>
        <span class="book-info-li"><span class="ov_txt">비회원 </span><span class="ov_num"> <?php echo number_format($no_member_count)?>명</span></span>
        <span class="book-info-li"><span class="ov_txt">수신 </span><span class="ov_num"> <?php echo number_format($receipt_count)?>명</span></span>
        <span class="book-info-li"><span class="ov_txt">거부 </span><span class="ov_num"> <?php echo number_format($reject_count)?>명</span></span>
    </div>

    <div class="margin-bottom-30"></div>

    <form name="search_form" class="eyoom-form margin-bottom-10">
    <div class="row">
        <div class="col col-3">
            <label or="bg_no" class="label sound_only">그룹명</label>
            <label class="select">
                <select name="bg_no" id="bg_no" onchange="location.href='<?php echo G5_ADMIN_URL; ?>/?dir=sms&pid=num_book&bg_no='+this.value;">
                    <option value=""<?php echo get_selected('', $bg_no); ?>> 전체 </option>
                    <option value="<?php echo $no_group['bg_no']?>"<?php echo get_selected($no_group['bg_no'], $bg_no); ?>> <?php echo $no_group['bg_name']?> (<?php echo number_format($no_group['bg_count'])?> 명) </option>
                    <?php for($i=0; $i<count((array)$group); $i++) {?>
                    <option value="<?php echo $group[$i]['bg_no']?>"<?php echo get_selected($group[$i]['bg_no'], $bg_no);?>> <?php echo $group[$i]['bg_name']?> (<?php echo number_format($group[$i]['bg_count'])?> 명) </option>
                    <?php } ?>
                </select>
                <i></i>
            </label>
        </div>
        <div class="col col-3">
            <label class="checkbox"><input type="checkbox" name="no_hp" id="no_hp" <?php echo $no_hp_checked?> onclick="no_hp_click(this.checked)"><i></i>휴대폰 소유자만 보기</label>
        </div>
    </div>
    </form>

    <form name="hp_manage_list" id="hp_manage_list" method="post" action="<?php echo $action_url; ?>" onsubmit="return hplist_submit(this);" class="eyoom-form">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="<?php echo $token; ?>">
    <input type="hidden" name="sw" value="">
    <input type="hidden" name="atype" value="del">
    <input type="hidden" name="str_query" value="<?php echo clean_query_string($_SERVER['QUERY_STRING']); ?>" >

    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="num-book-list"></div>
    
    <div class="margin-top-20">
        <?php echo $frm_submit2; ?>
    </div>

    </form>

    <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, G5_ADMIN_URL."/?dir=sms&amp;pid=num_book&amp;bg_no=$bg_no&amp;st=$st&amp;sv=$sv&amp;ap=$ap&amp;page="); ?>
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
            체크: "<input type='hidden' name='bk_no[<?php echo $i; ?>]' value='<?php echo $list[$i]['bk_no']; ?>' id='bk_no_<?php echo $i; ?>'><label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $i; ?>'><i></i></label>",
            번호: "<?php echo number_format($list[$i]['vnum']); ?>",
            관리: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=num_book_write&amp;w=u&amp;bk_no=<?php echo $list[$i]['bk_no']; ?>&amp;page=<?php echo $page; ?>&amp;bg_no=<?php echo $bg_no; ?>&amp;st=<?php echo $st; ?>&amp;sv=<?php echo $sv; ?>&amp;ap=<?php echo $ap; ?>'><u>수정</u></a><a href='<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=sms_write&amp;bk_no=<?php echo $list[$i]['bk_no']?>' class='margin-left-10'><u>보내기</u></a><a href='<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=history_num&amp;st=hs_hp&amp;sv=<?php echo $list[$i]['bk_hp']?>' class='margin-left-10'><u>내역</u></a>",
            그룹: "<?php echo $list[$i]['group_name']; ?>",
            이름: "<?php echo get_text($list[$i]['bk_name']) ?>",
            휴대폰: "<?php echo $list[$i]['bk_hp']; ?>",
            수신: "<?php echo $list[$i]['bk_receipt'] ? '<span class=\'color-teal\'>수신</span>' : '<span class=\'color-pink\'>거부</span>'?>",
            아이디: "<?php echo $list[$i]['mb_id'] ? $list[$i]['mb_id'] : '비회원'?>",
            업데이트: "<?php echo $list[$i]['bk_datetime']?>",
        },
        <?php } ?>
    ]
}();

$(function() {
    $("#num-book-list").jsGrid({
        filtering      : false,
        editing        : false,
        sorting        : false,
        paging         : true,
        autoload       : true,
        controller     : db,
        deleteConfirm  : "정말로 삭제하시겠습니까?\n한번 삭제된 데이터는 복구할수 없습니다.",
        pageButtonCount: 5,
        pageSize       : 20,
        width          : "100%",
        height         : "auto",
        fields         : [
            { name: "체크", type: "text", align: "center", width: 40 },
            { name: "번호", type: "text", align: "center", width: 40 },
            { name: "관리", type: "text", align: "center", width: 100, headercss: "set-btn-header", css: "set-btn-field" },
            { name: "그룹", type: "text", align: "center", width: 60 },
            { name: "이름", type: "text", align: "center", width: 80 },
            { name: "휴대폰", type: "text", align: "center", width: 80 },
            { name: "수신", type: "text", align: "center", width: 60 },
            { name: "아이디", type: "text", align: "center", width: 100 },
            { name: "업데이트", type: "text", align: "center", width: 100 },
        ]
    });

    var $chk = $(".jsgrid-table th:first-child");
    if ($chk.text() == '체크') {
        var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>';
        $chk.html(html);
    }
});

function hplist_submit(f) {
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }
    if(document.pressed == "선택이동") {
        select_copy("move", f);
        return;
    }
    if(document.pressed == "선택복사") {
        select_copy("copy", f);
        return;
    }
    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }
    if(document.pressed == "수신허용") {
        f.atype.value="receipt";
    }
    if(document.pressed == "수신거부") {
        f.atype.value="reject";
    }
    return true;
}

// 선택한 이모티콘 그룹 이동
function select_copy(sw, f) {
    if( !f ){
        var f = document.emoticonlist;
    }
    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "<?php echo G5_ADMIN_URL; ?>/?dir=sms&pid=num_book_move&wmode=1";
    f.submit();
}
</script>