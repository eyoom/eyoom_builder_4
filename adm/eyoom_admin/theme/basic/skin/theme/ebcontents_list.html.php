<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/theme/ebcontents_list.html.php
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
.admin-ebcontents-list .adm-headline h3 {margin:0 0 20px;font-size:15px}
</style>

<div class="admin-ebcontents-list">
    <div class="adm-headline adm-headline-btn">
        <h3>EB콘텐츠 - 마스터관리</h3>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=ebcontents_form&amp;thema=<?php echo $_theme; ?><?php echo $meinfo ? '&amp;me_id='.$meinfo['me_id']: '';?>&amp;wmode=1" onclick="eb_modal(this.href); return false;" class="btn-e btn-e-red btn-e-lg"><i class="fas fa-plus"></i> EB콘텐츠 마스터추가</a>
        <div class="clearfix"></div>
    </div>
    
    <div class="alert alert-info">
        <p><strong>메뉴위치</strong> : 홈페이지<?php echo $me_title ? ' &gt; ': '';?><?php echo $me_title; ?></p>
    </div>
    
    <input type="hidden" name="theme" value="<?php echo $_theme; ?>">
    <input type="hidden" name="me_id" id="me_id" value="<?php echo $meinfo['me_id'] ? $meinfo['me_id']: ''; ?>">
    <input type="hidden" name="token" value="">

    <div class="row">
        <div class="col col-12">
            <div class="padding-top-5 clearfix">
                <span class="font-size-12 color-grey">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="margin-left-10 margin-right-10 color-light-grey">|</span>EB콘텐츠 마스터 <?php echo number_format($total_count); ?>개
                </span>
            </div>
        </div>
    </div>

    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="ebcontents-list"></div>

    <div class="margin-top-20">
        <input type="submit" name="act_button" value="선택수정" class="btn-e btn-e-xs btn-e-red" onclick="document.pressed=this.value">
        <?php if ($is_admin == 'super') { ?>
        <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
        <?php } ?>
    </div>
</div>

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
            체크: "<label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $i; ?>'><i></i></label><input type='hidden' name='ec_no[<?php echo $i; ?>]' value='<?php echo $list[$i]['ec_no']; ?>'><input type='hidden' name='ec_code[<?php echo $i; ?>]' value='<?php echo $list[$i]['ec_code']; ?>'>",
            관리: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebcontents_form&amp;ec_code=<?php echo $list[$i]['ec_code']; ?>&amp;w=u&amp;wmode=1' onclick='eb_modal(this.href); return false;'><u>수정</u></a> <a href='<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebcontents_itemlist&amp;ec_code=<?php echo $list[$i]['ec_code']; ?>&amp;wmode=1' onclick='eb_modal(this.href); return false;' class='margin-left-10'><u>아이템관리</u></a>",
            스킨: "<?php if ($list[$i]['ec_skin_img']) { ?><img src='<?php echo $list[$i]['ec_skin_img']; ?>' class='img-responsive'><?php } ?><?php echo get_text($list[$i]['ec_skin']); ?>",
            콘텐츠마스터명: "<?php echo get_text($list[$i]['ec_name']); ?>",
            치환코드: "<div class='eb-clipboard'><div id='subs_code_<?php echo $i; ?>' class='eb-clipboard-cont'><?php echo $list[$i]['ec_chg_code']; ?></div><div class='eb-clipboard-btn' data-clipboard-target='#subs_code_<?php echo $i; ?>'>코드복사</div></div>",
            <?php if ($meinfo) { ?>
            출력순서: "<label class='input'><input type='text' name='ec_sort[<?php echo $i; ?>]' id='ec_sort_<?php echo $i; ?>' value='<?php echo $list[$i]['ec_sort']; ?>'><input type='hidden' name='ec_sort_old[<?php echo $i; ?>]' value='<?php echo $list[$i]['ec_sort']; ?>'></label>",
            <?php } ?>
            상태: "<label for='ec_state_<?php echo $i; ?>' class='select'><select name='ec_state[<?php echo $i; ?>]' id='ec_state_<?php echo $i; ?>'><option value=''>선택</option><option value='1' <?php echo  $list[$i]['ec_state'] == '1' ? 'selected':''; ?>>보이기</option><option value='2' <?php echo  $list[$i]['ec_state'] == '2' ? 'selected':''; ?>>숨기기</option></select><i></i></label>",
            등록일: "<?php echo substr($list[$i]['ec_regdt'], 0, 10); ?>",
        },
        <?php } ?>
    ]
}();

$(function() {
    $("#ebcontents-list").jsGrid({
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
            { name: "관리", type: "text", align: "center", width: 120, headercss: "set-btn-header", css: "set-btn-field" },
            { name: "스킨", type: "text", align: "center", width: 80 },
            { name: "콘텐츠마스터명", type: "text", width: 150 },
            { name: "치환코드", type: "text", align: "center", width: 350 },
            <?php if ($meinfo) { ?>
            { name: "출력순서", type: "number", width: 90 },
            <?php } ?>
            { name: "상태", type: "text", align: "center", width: 120 },
            { name: "등록일", type: "text", align: "center", width: 100 },
        ]
    });

    var $chk = $("#ebcontents-list .jsgrid-table th:first-child");
    if ($chk.text() == '체크') {
        var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>';
        $chk.html(html);
    }
});

new Clipboard('.eb-clipboard-btn');
</script>