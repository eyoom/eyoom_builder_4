<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/board/board_extend.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-board-form">
    <form name="fexboardform" id="fexboardform" action="<?php echo $action_url1; ?>" method="post" onsubmit="return fexboardform_submit(this);" class="eyoom-form">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="gr_id" value="<?php echo $gr_id; ?>">
    <input type="hidden" name="bo_skin" value="<?php echo $bo_skin; ?>">
    <input type="hidden" name="bo_mobile_skin" value="<?php echo $bo_mobile_skin; ?>">
    <input type="hidden" name="bo_ex" value="<?php echo $bo_ex; ?>">
    <input type="hidden" name="bo_cate" value="<?php echo $bo_cate; ?>">
    <input type="hidden" name="bo_sideview" value="<?php echo $bo_sideview; ?>">
    <input type="hidden" name="bo_dhtml" value="<?php echo $bo_dhtml; ?>">
    <input type="hidden" name="bo_secret" value="<?php echo $bo_secret; ?>">
    <input type="hidden" name="bo_good" value="<?php echo $bo_good; ?>">
    <input type="hidden" name="bo_nogood" value="<?php echo $bo_nogood; ?>">
    <input type="hidden" name="bo_file" value="<?php echo $bo_file; ?>">
    <input type="hidden" name="bo_cont" value="<?php echo $bo_cont; ?>">
    <input type="hidden" name="bo_list" value="<?php echo $bo_list; ?>">
    <input type="hidden" name="bo_sns" value="<?php echo $bo_sns; ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">
    <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="token" value="<?php echo $token; ?>">

    <div class="adm-headline">
        <h3>[ <span class="color-red"><?php echo $board['bo_subject']; ?></span> ] 확장필드 관리</h3>
    </div>

    <div class="adm-table-form-wrap">
        <header class="border-bottom-1px"><strong><i class="fas fa-caret-right"></i> 게시판 확장필드</strong></header>

        <fieldset>
            <div class="cont-text-bg">
                <p class="bg-info font-size-12 margin-bottom-0">
                    <i class="fas fa-info-circle"></i> 이윰 확장필드는 그누보드의 기본 여분필드인 wr_1 ~ wr_10 여분필드와는 별개로 작동합니다.<br>
                    <i class="fas fa-info-circle"></i> <?php echo EYOOM_EXBOARD_PREFIX; ?>1 ~ <?php echo EYOOM_EXBOARD_PREFIX; ?><span class='color-red'>숫자</span> 확장필드를 원하시는 만큼 생성하여 게시판에 활용하여 다양한 게시판 스킨을 개발하실 수 있습니다.</p>
            </div>
        </fieldset>

        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">현재 확장 필드수</label>
                        </th>
                        <td>
                            <label class="input state-disabled form-width-150px">
                                <i class="icon-append">개</i>
                                <input type="text" name="bo_ex_cnt" id="bo_ex_cnt" value="<?php echo $board['bo_ex_cnt']; ?>" readonly>
                            </label>
                            <div class="note"><strong>Note:</strong> 현재 추가된 확장필드의 개수입니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="bo_exadd" class="label">확장필드 일괄 추가하기</label>
                        </th>
                        <td>
                            <label class="input form-width-150px">
                                <i class="icon-append">개</i>
                                <input type="text" name="bo_exadd" id="bo_exadd" value="" required>
                            </label>
                            <div class="note"><strong>Note:</strong> 한꺼번에 여러개의 확장필드를 추가할 때 사용합니다. 일괄 추가후, 아래 리스트에서 설정을 변경하실 수 있습니다.</div>
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
</div>

<div class="margin-bottom-40"></div>

<div class="admin-board-exlist">
    <form name="fboardexlist" id="fboardexlist" action="<?php echo $action_url2; ?>" method="post" onsubmit="return fboardexlist_submit(this);" class="eyoom-form">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="gr_id" value="<?php echo $gr_id; ?>">
    <input type="hidden" name="bo_skin" value="<?php echo $bo_skin; ?>">
    <input type="hidden" name="bo_mobile_skin" value="<?php echo $bo_mobile_skin; ?>">
    <input type="hidden" name="bo_ex" value="<?php echo $bo_ex; ?>">
    <input type="hidden" name="bo_cate" value="<?php echo $bo_cate; ?>">
    <input type="hidden" name="bo_sideview" value="<?php echo $bo_sideview; ?>">
    <input type="hidden" name="bo_dhtml" value="<?php echo $bo_dhtml; ?>">
    <input type="hidden" name="bo_secret" value="<?php echo $bo_secret; ?>">
    <input type="hidden" name="bo_good" value="<?php echo $bo_good; ?>">
    <input type="hidden" name="bo_nogood" value="<?php echo $bo_nogood; ?>">
    <input type="hidden" name="bo_file" value="<?php echo $bo_file; ?>">
    <input type="hidden" name="bo_cont" value="<?php echo $bo_cont; ?>">
    <input type="hidden" name="bo_list" value="<?php echo $bo_list; ?>">
    <input type="hidden" name="bo_sns" value="<?php echo $bo_sns; ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">
    <input type="hidden" name="token" value="<?php echo $token; ?>">

    <div class="adm-headline adm-headline-btn">
        <h3>[ <span class="color-red"><?php echo $board['bo_subject']; ?></span> ] 확장필드 아이템 리스트</h3>
        <?php if (!G5_IS_MOBILE) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&pid=board_exform&amp;bo_table=<?php echo $bo_table; ?>&amp;wmode=1" onclick="exboard_modal(this.href, '확장필드 설정관리'); return false;" class="btn-e btn-e-red btn-e-lg"><i class="fas fa-plus"></i> 확장필드 추가하기</a>
        <?php } ?>
    </div>

    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="board-exlist"></div>

    <div class="margin-top-20">
        <input type="submit" name="act_button" value="선택수정" class="btn-e btn-e-xs btn-e-red" onclick="document.pressed=this.value">
        <?php if ($is_admin == 'super') { ?>
        <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
        <?php } ?>
    </div>
    </form>

</div>

<div class="modal fade exboard-iframe-modal" tabindex="-1" role="dialog" aria-labelledby="themeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 id="themeModalLabel" class="modal-title"><strong><i class="fas fa-ellipsis-v color-grey"></i> <span id="modal-title">확장필드 설정관리</span></strong></h4>
            </div>
            <div class="modal-body">
                <iframe id="exboard-iframe" width="100%" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="exboard-close-btn btn-e btn-e-lg btn-e-dark" type="button"><i class="fas fa-times"></i> 닫기</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/jsgrid/jsgrid.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/js/jsgrid.js"></script>
<script>
function exboard_modal(href, title) {
    $('.exboard-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#exboard-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.exboard-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#exboard-iframe").attr("src", href);
        $("#modal-title").text(title);
        $('#exboard-iframe').height(parseInt($(window).height() * 0.85));
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

window.closeModal = function(){
    $('.exboard-iframe-modal').modal('hide');
    window.location.reload();
};

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
            체크: "<label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $i; ?>'><i></i></label><input type='hidden' name='ex_no[<?php echo $i; ?>]' value='<?php echo $list[$i]['ex_no']; ?>'>",
            관리: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_exform&amp;bo_table=<?php echo $bo_table; ?>&amp;ex_no=<?php echo $list[$i]['ex_no']; ?>&amp;w=u&amp;wmode=1' onclick='exboard_modal(this.href); return false;'><u>수정</u></a>",
            코드복사: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_excode&amp;bo_table=<?php echo $bo_table; ?>&amp;ex_no=<?php echo $list[$i]['ex_no']; ?>&amp;wmode=1' onclick='exboard_modal(this.href,\"코드복사하기\"); return false;' class='btn-e btn-e-xs btn-e-dark'>코드보기</a>",
            필드명: "<strong><?php echo $list[$i]['ex_fname']; ?></strong><input type='hidden' name='ex_fname[<?php echo $i; ?>]' value='<?php echo $list[$i]['ex_fname']; ?>'>",
            타이틀: "<label for='ex_subject' class='input'><input type='text' name='ex_subject[<?php echo $i; ?>]' id='ex_subject_<?php echo $i; ?>' value='<?php echo get_text($list[$i]['ex_subject']); ?>'></label>",
            폼타입: "<?php echo $list[$i]['form']; ?>",
            필드종류: "<?php echo $list[$i]['ex_type']; ?> <?php if ($list[$i]['ex_length'] && $list[$i]['ex_type'] != 'text') { echo '('. $list[$i]['ex_length'].')'; } ?>",
            검색사용: "<label class='checkbox' for='ex_use_search_<?php echo $i; ?>'><input type='checkbox' name='ex_use_search[<?php echo $i; ?>]' id='ex_use_search_<?php echo $i; ?>' value='y' <?php echo $list[$i]['ex_use_search'] == 'y' ? 'checked':''; ?>><i></i></label>",
            필수여부: "<label class='checkbox' for='ex_required_<?php echo $i; ?>'><input type='checkbox' name='ex_required[<?php echo $i; ?>]' id='ex_required_<?php echo $i; ?>' value='y' <?php echo $list[$i]['ex_required'] == 'y' ? 'checked':''; ?>><i></i></label>",
        },
        <?php } ?>
    ]
}();

$(function() {
    $("#board-exlist").jsGrid({
        filtering      : false,
        editing        : false,
        sorting        : false,
        paging         : true,
        autoload       : true,
        controller     : db,
        deleteConfirm  : "정말로 삭제하시겠습니까?\n한번 삭제된 데이터는 복구할수 없습니다.",
        pageButtonCount: 5,
        pageSize       : 30,
        width          : "100%",
        height         : "auto",
        fields         : [
            { name: "체크", type: "text", width: 40 },
            { name: "관리", type: "text", align: "center", width: 80, headercss: "set-btn-header", css: "set-btn-field" },
            { name: "코드복사", type: "text", align: "center", width: 80 },
            { name: "필드명", type: "text", align: "center", width: 80 },
            { name: "타이틀", type: "text", width: 150 },
            { name: "폼타입", type: "text", width: 200 },
            { name: "필드종류", type: "text", align: "center", width: 100 },
            { name: "검색사용", type: "text", align: "center", width: 80 },
            { name: "필수여부", type: "text", align: "center", width: 80 },
        ]
    });

    var $chk = $("#board-exlist .jsgrid-table th:first-child");
    if ($chk.text() == '체크') {
        var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>';
        $chk.html(html);
    }
});

function fboardexlist_submit(f) {
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("해당 필드에 입력되어 있는 모든 입력값들도 함께 삭제됩니다.\n\n정말로 선택한 확장필드를 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}
</script>