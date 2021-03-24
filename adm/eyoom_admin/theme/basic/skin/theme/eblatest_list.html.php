<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/theme/eblatest_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<style>
.eb-clipboard {position:relative;overflow:hidden;border:1px solid #4052B5;background:#f7f8ff;height:26px;line-height:26px;text-align:left}
.eb-clipboard-cont {padding:0 10px;margin-right:70px}
.eb-clipboard-btn {position:absolute;top:-1px;right:-1px;width:70px;height:26px;cursor:pointer;color:#fff;text-align:center;background:#5C6BBF}
.eb-clipboard-btn:hover {background:#4052B5}
</style>

<div class="admin-eblatest-list">
    <div class="adm-headline adm-headline-btn">
        <h3>EB최신글 - 마스터관리</h3>
        <?php if (!$wmode) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=eblatest_form&amp;thema=<?php echo $this_theme; ?>" class="btn-e btn-e-red btn-e-lg"><i class="fas fa-plus"></i> EB최신글 마스터추가</a>
        <div class="clearfix"></div>
        <?php } ?>
    </div>

    <?php include_once(EYOOM_ADMIN_THEME_PATH . '/skin/theme/theme_head.html.php'); ?>

    <form name="feblatestform" id="feblatestlist" action="<?php echo $action_url1; ?>" method="post" onsubmit="return feblatestform_submit(this);" class="eyoom-form">
    <input type="hidden" name="theme" value="<?php echo $this_theme; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="">

    <div class="row">
        <div class="col col-12">
            <div class="padding-top-5 clearfix">
                <span class="font-size-12 color-grey">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="margin-left-10 margin-right-10 color-light-grey">|</span>EB최신글 마스터 <?php echo number_format($total_count); ?>개
                </span>
            </div>
        </div>
    </div>

    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="eblatest-list"></div>

    <div class="margin-top-20">
        <input type="submit" name="act_button" value="선택수정" class="btn-e btn-e-xs btn-e-red" onclick="document.pressed=this.value">
        <?php if ($is_admin == 'super') { ?>
        <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
        <?php } ?>
    </div>
    </form>
</div>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/jsgrid/jsgrid.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/js/jsgrid.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/clipboard/clipboard.min.js"></script>
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
                return !(filter.체크 && !(client.체크.indexOf(filter.체크) > -1)  )
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        {
            체크: "<label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $i; ?>'><i></i></label><input type='hidden' name='el_no[<?php echo $i; ?>]' value='<?php echo $list[$i]['el_no']; ?>'><input type='hidden' name='el_code[<?php echo $i; ?>]' value='<?php echo $list[$i]['el_code']; ?>'>",
            관리: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=eblatest_form&amp;el_code=<?php echo $list[$i]['el_code']; ?>&amp;w=u'><u>수정</u></a>",
            최신글마스터제목: "<?php echo get_text($list[$i]['el_subject']); ?>",
            치환코드: "<div class='eb-clipboard'><div id='subs_code_<?php echo $i; ?>' class='eb-clipboard-cont'><?php echo $list[$i]['el_chg_code']; ?></div><div class='eb-clipboard-btn' data-clipboard-target='#subs_code_<?php echo $i; ?>'>코드복사</div></div>",
            상태: "<label for='el_state_<?php echo $i; ?>' class='select'><select name='el_state[<?php echo $i; ?>]' id='el_state_<?php echo $i; ?>'><option value=''>선택</option><option value='1' <?php echo  $list[$i]['el_state'] == '1' ? 'selected':''; ?>>보이기</option><option value='2' <?php echo  $list[$i]['el_state'] == '2' ? 'selected':''; ?>>숨기기</option></select><i></i></label>",
            등록일: "<?php echo substr($list[$i]['el_regdt'], 0, 10); ?>",
        },
        <?php } ?>
    ]
}();

$(function() {
    $("#eblatest-list").jsGrid({
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
            { name: "최신글마스터제목", type: "text", width: 200 },
            { name: "치환코드", type: "text", align: "center", width: 350 },
            { name: "상태", type: "text", align: "center", width: 100 },
            { name: "등록일", type: "text", align: "center", width: 100 },
        ]
    });

    var $chk = $("#eblatest-list .jsgrid-table th:first-child");
    if ($chk.text() == '체크') {
        var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>';
        $chk.html(html);
    }
});

function feblatestform_submit(f) {
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

function del_confirm() {
    if (confirm('배너/광고를 삭제하시겠습니까?')) {
        return true;
    } else {
        return false;
    }
}

new Clipboard('.eb-clipboard-btn');
</script>