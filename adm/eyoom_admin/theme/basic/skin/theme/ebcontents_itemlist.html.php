<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/theme/ebcontents_itemlist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-ebcontents-form">
    <div class="admin-ebcontents-itemlist margin-top-30">
        <form name="febcontentsitemlist" id="febcontentsitemlist" action="<?php echo $action_url1; ?>" method="post" onsubmit="return febcontentsitemlist_submit(this);" class="eyoom-form">
        <input type="hidden" name="theme" id="theme" value="<?php echo $this_theme; ?>">
        <input type="hidden" name="ec_code" id="ec_code" value="<?php echo $ec_code; ?>">
        <input type="hidden" name="page" value="<?php echo $page; ?>">
        <input type="hidden" name="token" value="<?php echo $token; ?>">

        <div class="adm-headline adm-headline-btn">
            <h3>EB 콘텐츠 아이템 목록</h3>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=ebcontents_itemform&amp;ec_code=<?php echo $ec_code; ?>&amp;thema=<?php echo $this_theme; ?>&amp;wmode=1" class="btn-e btn-e-red btn-e-lg"><i class="fas fa-plus"></i> EB콘텐츠 아이템 추가</a>
            <div class="clearfix"></div>
        </div>

        <blockquote class="hero">
            <p>마스터코드 - <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebcontents_form&amp;thema=<?php echo $this_theme; ?>&amp;ec_code=<?php echo $ec_code; ?>&amp;w=u&amp;wmode=1" class="btn-e btn-e-dark btn-e-sm margin-left-10"><?php echo $ec_code; ?></a></p>
        </blockquote>

        <?php if (G5_IS_MOBILE) { ?>
        <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
        <?php } ?>

        <div id="ebcontents-itemlist"></div>

        <div class="margin-top-20">
            <input type="submit" name="act_button" value="선택수정" class="btn-e btn-e-xs btn-e-red" onclick="document.pressed=this.value">
            <?php if ($is_admin == 'super') { ?>
            <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
            <?php } ?>
        </div>
        </form>
    </div>
</div>

<div class="modal fade admin-iframe-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <iframe id="modal-iframe" width="100%" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn-e btn-e-lg btn-e-dark" type="button"><i class="fas fa-times"></i> 닫기</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/jsgrid/jsgrid.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/js/jsgrid.js"></script>
<script>
<?php if (!(G5_IS_MOBILE || $wmode)) { ?>
function eb_modal(href, title) {
    $('.admin-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#modal-iframe").attr("src", "");
        $(".modal-title").text("");
        $('html').css({overflow: ''});
    });
    $('.admin-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#modal-iframe").attr("src", href);
        $('#modal-iframe').height(parseInt($(window).height() * 0.85));
        $(".modal-title").text(title);
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

window.closeModal = function(){
    $('.admin-iframe-modal').modal('hide');
};
<?php } ?>

!function () {
    // EB콘텐츠 이미지 아이템
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
            체크: "<label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $i; ?>'><i></i></label><input type='hidden' name='ci_no[<?php echo $i; ?>]' value='<?php echo $list[$i]['ci_no']; ?>'>",
            관리: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebcontents_itemform&amp;thema=<?php echo $this_theme; ?>&amp;ec_code=<?php echo $list[$i]['ec_code']; ?>&amp;ci_no=<?php echo $list[$i]['ci_no']; ?>&amp;w=u&amp;iw=u&amp;page=<?php echo $page; ?>&amp;wmode=1' onclick='eb_modal(this.href,\"EB콘텐츠 아이템관리\"); return false;'><u>수정</u></a>",
            이미지: "<?php echo $list[$i]['ci_image']; ?>",
            텍스트필드: "<?php echo $list[$i]['ci_subject_1'] ? get_text($list[$i]['ci_subject_1']):'없음'; ?>",
            순서: "<label for='ci_sort_<?php echo $list[$i]['index']; ?>' class='input'><input type='text' name='ci_sort[<?php echo $i; ?>]' id='ci_sort_<?php echo $i; ?>' value='<?php echo $list[$i]['ci_sort']; ?>'></label>",
            상태: "<label for='ci_state_<?php echo $i; ?>' class='select'><select name='ci_state[<?php echo $i; ?>]' id='ci_state_<?php echo $i; ?>'><option value=''>선택</option><option value='1' <?php echo $list[$i]['ci_state'] == '1' ? 'selected':''; ?>>보이기</option><option value='2' <?php echo $list[$i]['ci_state'] == '2' ? 'selected': ''; ?>>숨기기</option></select><i></i></label>",
            보기권한: "<label class='select'><?php echo $list[$i]['view_level']; ?><i></i></label>",
            시작일: "<?php echo $list[$i]['ci_start'] ? date('Y-m-d',strtotime($list[$i]['ci_start'])):''; ?>",
            종료일: "<?php echo $list[$i]['ci_end'] ? date('Y-m-d',strtotime($list[$i]['ci_end'])):''; ?>",
            등록일: "<?php echo substr($list[$i]['ci_regdt'], 0, 10); ?>",
        },
        <?php } ?>
    ];
}();

$(function() {
    $("#ebcontents-itemlist").jsGrid({
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
            { name: "관리", type: "text", align: "center", width: 60, headercss: "set-btn-header", css: "set-btn-field" },
            { name: "이미지", type: "text", align: "center", width: 100 },
            { name: "텍스트필드", type: "text", width: 250 },
            { name: "순서", type: "number",width: 60 },
            { name: "상태", type: "text", align: "center", width: 120 },
            { name: "보기권한", type: "text", align: "center", width: 80 },
            { name: "시작일", type: "text", align: "center", width: 80 },
            { name: "종료일", type: "text", align: "center", width: 80 },
            { name: "등록일", type: "text", align: "center", width: 80 },
        ]
    });

    var $chk = $("#ebcontents-itemlist .jsgrid-table th:first-child");
    if ($chk.text() == '체크') {
        var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>';
        $chk.html(html);
    }
});

function popup_sel_skin() {
    var url =  "<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=ebcontents_skins&wmode=1";
    var name = 'ebcontents_skins';
    var opt = 'width=800, height=700';
    window.open(url, name, opt);
}

function febcontentsitemlist_submit(f) {
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

function check_all(f) {
    var chk = document.getElementsByName("chk[]");

    for (i=0; i<chk.length; i++)
        chk[i].checked = f.chkall.checked;
}
</script>