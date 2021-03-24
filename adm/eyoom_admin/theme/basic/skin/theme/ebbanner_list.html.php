<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/theme/ebbanner_list.html.php
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

<div class="admin-ebbanner-list">
    <div class="adm-headline adm-headline-btn">
        <h3>EB배너 관리</h3>
        <?php if (!$wmode) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=ebbanner_form&amp;thema=<?php echo $this_theme; ?>" class="btn-e btn-e-red btn-e-lg"><i class="fas fa-plus"></i> EB배너 추가하기</a>
        <div class="clearfix"></div>
        <?php } ?>
    </div>

    <?php include_once(EYOOM_ADMIN_THEME_PATH . '/skin/theme/theme_head.html.php'); ?>

    <form name="febbannerform" id="febbannerlist" action="<?php echo $action_url1; ?>" method="post" onsubmit="return febbannerform_submit(this);" class="eyoom-form">
    <input type="hidden" name="theme" value="<?php echo $this_theme; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="">

    <div class="row">
        <div class="col col-12">
            <div class="padding-top-5 clearfix">
                <span class="font-size-12 color-grey">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="margin-left-10 margin-right-10 color-light-grey">|</span>EB배너 마스터 <?php echo number_format($total_count); ?>개
                </span>
            </div>
        </div>
    </div>

    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="ebbanner-list"></div>

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
            체크: "<label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $i; ?>'><i></i></label><input type='hidden' name='bn_no[<?php echo $i; ?>]' value='<?php echo $list[$i]['bn_no']; ?>'><input type='hidden' name='bn_code[<?php echo $i; ?>]' value='<?php echo $list[$i]['bn_code']; ?>'>",
            관리: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebbanner_form&amp;bn_code=<?php echo $list[$i]['bn_code']; ?>&amp;w=u'><u>수정</u></a>",
            배너제목: "<?php echo get_text($list[$i]['bn_subject']); ?>",
            치환코드: "<div class='eb-clipboard'><div id='subs_code_<?php echo $i; ?>' class='eb-clipboard-cont'><?php echo $list[$i]['bn_code']; ?></div><div class='eb-clipboard-btn' data-clipboard-target='#subs_code_<?php echo $i; ?>'>코드복사</div></div>",
            이미지: "<?php echo $list[$i]['bn_image']; ?>",
            상태: "<label for='bn_state_<?php echo $i; ?>' class='select'><select name='bn_state[<?php echo $i; ?>]' id='bn_state_<?php echo $i; ?>'><option value=''>선택</option><option value='1' <?php echo  $list[$i]['bn_state'] == '1' ? 'selected':''; ?>>보이기</option><option value='2' <?php echo  $list[$i]['bn_state'] == '2' ? 'selected':''; ?>>숨기기</option></select><i></i></label>",
	        노출수: "<?php echo number_format($list[$i]['bn_exposed']); ?>",
	        클릭수: "<?php echo number_format($list[$i]['bn_clicked']); ?>",
	        클릭률: "<?php echo $list[$i]['bn_ratio']; ?>%",
	        시작일: "<?php echo $list[$i]['bn_start']; ?>",
	        종료일: "<?php echo $list[$i]['bn_end']; ?>",
            등록일: "<?php echo substr($list[$i]['bn_regdt'], 0, 10); ?>",
        },
        <?php } ?>
    ]
}();

$(function() {
    $("#ebbanner-list").jsGrid({
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
            { name: "배너제목", type: "text", width: 120 },
            { name: "치환코드", type: "text", align: "center", width: 250 },
            { name: "이미지", type: "text", align: "center", width: 120 },
            { name: "상태", type: "text", align: "center", width: 100 },
            { name: "노출수", type: "number", width: 60 },
            { name: "클릭수", type: "number", width: 60 },
            { name: "클릭률", type: "number", width: 60 },
            { name: "시작일", type: "text", align: "center", width: 80 },
            { name: "종료일", type: "text", align: "center", width: 80 },
            { name: "등록일", type: "text", align: "center", width: 80 },
        ]
    });

    var $chk = $("#ebbanner-list .jsgrid-table th:first-child");
    if ($chk.text() == '체크') {
        var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>';
        $chk.html(html);
    }
});

function febbannerform_submit(f) {
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