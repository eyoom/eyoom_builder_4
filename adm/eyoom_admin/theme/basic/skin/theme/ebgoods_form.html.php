<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/theme/ebgoods_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<style>
.eb-clipboard-box {position:relative;overflow:hidden;border:1px solid #4052B5;background:#f7f8ff;text-align:center}
.eb-clipboard-box-cont {height:26px;line-height:26px;padding:0 10px}
.eb-clipboard-box-btn {height:26px;line-height:26px;cursor:pointer;color:#fff;background:#5C6BBF}
.eb-clipboard-box-btn:hover {background:#4052B5}
</style>

<div class="admin-ebgoods-form">
    <div class="adm-headline">
        <h3>EB상품 마스터 관리</h3>
    </div>

    <?php include_once(EYOOM_ADMIN_THEME_PATH . '/skin/theme/theme_head.html.php'); ?>

    <form name="febgoodsform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return febgoodsform_submit(this);" enctype="multipart/form-data" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="theme" id="theme" value="<?php echo $this_theme; ?>">
    <input type="hidden" name="eg_no" id="eg_no" value="<?php echo $eg['eg_no']; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-table-form-wrap margin-bottom-30">
        <header><strong><i class="fas fa-caret-right"></i> EB상품 마스터 설정정보</strong></header>

        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">코드</label>
                        </th>
                        <td colspan="3">
                            <label for="eg_code" class="input form-width-250px">
                                <input type="text" name="eg_code" id="eg_code" value="<?php echo $eg['eg_code'] ? $eg['eg_code']: time(); ?>" readonly required>
                            </label>
                            <div class="note"><strong>Note:</strong> 자동생성되며, 수정하실 수 없습니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">치환코드</label>
                        </th>
                        <td>
                            <div class="eb-clipboard-box">
                                <div id="substitution_code" class="eb-clipboard-box-cont"><strong>&lt;?php echo eb_goods('<?php echo $eg['eg_code'] ? $eg['eg_code']: time(); ?>'); ?&gt;</strong></div>
                                <div class="eb-clipboard-box-btn" data-clipboard-target="#substitution_code">치환코드복사</div>
                            </div>
                            <div class="note"><strong>Note:</strong> 치환코드를 복사하여 출력하고자 하는 위치에 붙여넣기 하세요.</div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">출력여부</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="eg_state_1" class="radio"><input type="radio" name="eg_state" id="eg_state_1" value="1" <?php echo $eg['eg_state'] == '1' || !$eg['eg_state'] ? 'checked':''; ?>><i></i> 보이기</label>
                                <label for="eg_state_2" class="radio"><input type="radio" name="eg_state" id="eg_state_2" value="2" <?php echo $eg['eg_state'] == '2' ? 'checked':''; ?>><i></i> 숨기기</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 출력여부를 결정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">상품마스터 제목</label>
                        </th>
                        <td>
                            <label for="eg_subject" class="input">
                                <input type="text" name="eg_subject" id="eg_subject" value="<?php echo get_text($eg['eg_subject']); ?>" required>
                            </label>
                            <div class="note"><strong>Note:</strong> 예) 메인 상품, 메인 제품소개 상품...</div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">상품마스터 스킨</label>
                        </th>
                        <td>
                            <label for="eg_skin" class="select form-width-250px">
                                <select name="eg_skin" id="eg_skin">
                                    <option value="">::선택::</option>
                                    <?php foreach ($ebgoods_skins as $eb_skin) { ?>
                                    <option value="<?php echo $eb_skin; ?>" <?php echo get_selected($eg['eg_skin'], $eb_skin); ?>><?php echo $eb_skin; ?></option>
                                    <?php } ?>
                                </select><i></i>
                            </label>
                            <div class="note"><strong>Note:</strong> EB상품 마스터에 적용할 스킨을 선택해 주세요.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">대표 연결주소 [링크]</label>
                        </th>
                        <td colspan="3">
                            <div class="inline-group">
                                <span>
                                    <label for="eg_link" class="input form-width-350px">
                                        <i class="icon-prepend fas fa-link"></i>
                                        <input type="text" name="eg_link" id="eg_link" value="<?php echo $eg['eg_link']; ?>">
                                    </label>
                                </span>
                                <span>
                                    <label for="eg_target" class="select form-width-150px">
                                        <select name="eg_target" id="eg_target">
                                            <option value="">타겟을 선택하세요.</option>
                                            <option value="_blank" <?php echo $eg['eg_target'] == '_blank' ? 'selected':''; ?>>새창</option>
                                            <option value="_self" <?php echo $eg['eg_target'] == '_self' || !$eg['ec_target'] ? 'selected':''; ?>>현재창</option>
                                        </select><i></i>
                                    </label>
                                </span>
                            </div>
                            <div class="note"><strong>Note:</strong> EB상품 마스터에서 사용할 링크주소를 입력해 주세요. 예) <?php echo G5_URL; ?></div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <?php if (!G5_IS_MOBILE) { ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php echo $frm_submit; ?>

    </form>

    <script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/clipboard/clipboard.min.js"></script>
    <script>
    function febgoodsform_submit(f) {
        if (f.eg_code.value == '') {
            alert("코드는 자동생성되며 빈값을 입력하실 수 없습니다.");
            document.location.reload();
            return false;
        }
        if (f.eg_subject.value.length < 2) {
            alert("상품 마스터의 제목을 2자이상으로 입력해 주세요.");
            f.eg_subject.focus();
            return false;
        }
        if (!f.eg_skin.value) {
            alert("상품 마스터의 스킨을 선택해 주세요.");
            f.eg_skin.focus();
            return false;
        }
        return true;
    }

    new Clipboard('.eb-clipboard-box-btn');
    </script>

    <?php if ($w == 'u' && $eg_code) { ?>
    <div class="admin-ebgoods-itemlist margin-top-40">
        <form name="febgoodsitemlist" id="febgoodsitemlist" action="<?php echo $action_url2; ?>" method="post" onsubmit="return febgoodsitemlist_submit(this);" class="eyoom-form">
        <input type="hidden" name="theme" id="theme" value="<?php echo $this_theme; ?>">
        <input type="hidden" name="eg_code" id="eg_code" value="<?php echo $eg['eg_code']; ?>">
        <input type="hidden" name="page" value="<?php echo $page; ?>">
        <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
        <input type="hidden" name="token" value="<?php echo $token; ?>">

        <div class="adm-headline adm-headline-btn">
            <h3>EB상품 - 아이템 관리</h3>
            <?php if (!$wmode) { ?>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=ebgoods_itemform&amp;eg_code=<?php echo $eg['eg_code']; ?>&amp;thema=<?php echo $this_theme; ?>&amp;wmode=1" onclick="eb_modal(this.href, 'EB상품 아이템'); return false;" class="btn-e btn-e-red btn-e-lg"><i class="fas fa-plus"></i> EB상품 아이템 추가</a>
            <div class="clearfix"></div>
            <?php } ?>
        </div>

        <?php if (G5_IS_MOBILE) { ?>
        <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
        <?php } ?>

        <div id="ebgoods-itemlist"></div>

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
    // EB상품 이미지 아이템
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
        <?php for ($i=0; $i<(array)$list); $i++) { ?>
        {
            체크: "<label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $i; ?>'><i></i></label><input type='hidden' name='gi_no[<?php echo $i; ?>]' value='<?php echo $list[$i]['gi_no']; ?>'>",
            관리: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebgoods_itemform&amp;eg_code=<?php echo $list[$i]['eg_code']; ?>&amp;gi_no=<?php echo $list[$i]['gi_no']; ?>&amp;w=u&amp;iw=u&amp;page=<?php echo $page; ?>&amp;wmode=1' onclick='eb_modal(this.href,\"EB상품 아이템관리\"); return false;'><u>수정</u></a>",
            타이틀: "<?php echo $list[$i]['gi_title'] ? get_text($list[$i]['gi_title']):'없음'; ?>",
            순서: "<label for='gi_sort_<?php echo $list[$i]['index']; ?>' class='input'><input type='text' name='gi_sort[<?php echo $i; ?>]' id='gi_sort_<?php echo $i; ?>' value='<?php echo $list[$i]['gi_sort']; ?>'></label>",
            상태: "<label for='gi_state_<?php echo $i; ?>' class='select'><select name='gi_state[<?php echo $i; ?>]' id='gi_state_<?php echo $i; ?>'><option value=''>선택</option><option value='1' <?php echo $list[$i]['gi_state'] == '1' ? 'selected':''; ?>>보이기</option><option value='2' <?php echo $list[$i]['gi_state'] == '2' ? 'selected': ''; ?>>숨기기</option></select><i></i></label>",
            보기권한: "<label class='select'><?php echo $list[$i]['view_level']; ?><i></i></label>",
            대상카테고리: "<?php echo $list[$i]['gi_ca_ids'] ? $list[$i]['gi_ca_ids']: '전체상품'; ?>",
            출력상품수: "<?php echo $list[$i]['gi_count']; ?>",
            등록일: "<?php echo substr($list[$i]['gi_regdt'], 0, 10); ?>",
        },
        <?php } ?>
    ];
}();

$(function() {
    $("#ebgoods-itemlist").jsGrid({
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
            { name: "타이틀", type: "text", width: 100 },
            { name: "순서", type: "number",width: 60 },
            { name: "상태", type: "text", align: "center", width: 120 },
            { name: "보기권한", type: "text", align: "center", width: 80 },
            { name: "대상카테고리", type: "text", width: 250 },
            { name: "출력상품수", type: "text", align: "center", width: 80 },
            { name: "등록일", type: "text", align: "center", width: 80 },
        ]
    });

    var $chk = $("#ebgoods-itemlist .jsgrid-table th:first-child");
    if ($chk.text() == '체크') {
        var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all_img(this.form)"><i></i></label>';
        $chk.html(html);
    }
});

function febgoodsitemlist_submit(f) {
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

function check_all_img(f)
{
    var chk = document.getElementsByName("chk[]");

    for (i=0; i<chk.length; i++)
        chk[i].checked = f.chkall.checked;
}

function close_modal_and_reload() {
    window.closeModal = function(){
        $('.admin-iframe-modal').modal('hide');
    };
    document.location.reload();
}
</script>
<?php } ?>