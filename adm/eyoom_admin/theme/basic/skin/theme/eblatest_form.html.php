<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/theme/eblatest_form.html.php
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

<div class="admin-eblatest-form">
    <div class="adm-headline">
        <h3>EB최신글 마스터 관리</h3>
    </div>

    <?php include_once(EYOOM_ADMIN_THEME_PATH . '/skin/theme/theme_head.html.php'); ?>

    <form name="feblatestform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return feblatestform_submit(this);" enctype="multipart/form-data" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="theme" id="theme" value="<?php echo $this_theme ? $this_theme: $theme; ?>">
    <input type="hidden" name="el_no" id="el_no" value="<?php echo $el['el_no']; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-table-form-wrap margin-bottom-30">
        <header><strong><i class="fas fa-caret-right"></i> EB최신글 마스터 설정정보</strong></header>

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
                            <label for="el_code" class="input form-width-250px">
                                <input type="text" name="el_code" id="el_code" value="<?php echo $el['el_code'] ? $el['el_code']: time(); ?>" readonly required>
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
                                <div id="substitution_code" class="eb-clipboard-box-cont"><strong>&lt;?php echo eb_latest('<?php echo $el['el_code'] ? $el['el_code']: time(); ?>'); ?&gt;</strong></div>
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
                                <label for="el_state_1" class="radio"><input type="radio" name="el_state" id="el_state_1" value="1" <?php echo $el['el_state'] == '1' || !$el['el_state'] ? 'checked':''; ?>><i></i> 보이기</label>
                                <label for="el_state_2" class="radio"><input type="radio" name="el_state" id="el_state_2" value="2" <?php echo $el['el_state'] == '2' ? 'checked':''; ?>><i></i> 숨기기</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 출력여부를 결정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">최신글마스터 제목</label>
                        </th>
                        <td>
                            <label for="el_subject" class="input">
                                <input type="text" name="el_subject" id="el_subject" value="<?php echo get_text($el['el_subject']); ?>" required>
                            </label>
                            <div class="note"><strong>Note:</strong> 예) 메인 최신글, 메인 제품소개 최신글...</div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">최신글마스터 스킨</label>
                        </th>
                        <td>
                            <label for="el_skin" class="select form-width-250px">
                                <select name="el_skin" id="el_skin">
                                    <option value="">::선택::</option>
                                    <?php foreach ($eblatest_skins as $eb_skin) { ?>
                                    <option value="<?php echo $eb_skin; ?>" <?php echo get_selected($el['el_skin'], $eb_skin); ?>><?php echo $eb_skin; ?></option>
                                    <?php } ?>
                                </select><i></i>
                            </label>
                            <div class="note"><strong>Note:</strong> EB최신글 마스터에 적용할 스킨을 선택해 주세요.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">캐시 갱신 시간</label>
                        </th>
                        <td>
                            <label for="el_cache" class="input form-width-250px">
                                <i class="icon-append">초</i>
                                <input type="text" name="el_cache" id="el_cache" value="<?php echo $el['el_cache'] ? $el['el_cache']: 0; ?>" required>
                            </label>
                            <div class="note"><strong>Note:</strong> 지정한 시간(초단위)을 주기로 최신글 캐시를 갱신합니다.<br> 캐시를 사용하지 않으려면 0으로 설정하면 됩니다.</div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">새글 표시 시간</label>
                        </th>
                        <td>
                            <label for="el_new" class="input form-width-250px">
                                <i class="icon-append">시간</i>
                                <input type="text" name="el_new" id="el_new" value="<?php echo $el['el_new'] ? $el['el_new']: 24; ?>" required>
                            </label>
                            <div class="note"><strong>Note:</strong> 지정한 시간 이내에 작성된 글에 새글임을 강조합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">대표 연결주소 [링크]</label>
                        </th>
                        <td colspan="3">
                            <div class="inline-group">
                                <span>
                                    <label for="el_link" class="input form-width-350px">
                                        <i class="icon-prepend fas fa-link"></i>
                                        <input type="text" name="el_link" id="el_link" value="<?php echo $el['el_link']; ?>">
                                    </label>
                                </span>
                                <span>
                                    <label for="el_target" class="select form-width-150px">
                                        <select name="el_target" id="ec_target">
                                            <option value="">타겟을 선택하세요.</option>
                                            <option value="_blank" <?php echo $el['el_target'] == '_blank' ? 'selected':''; ?>>새창</option>
                                            <option value="_self" <?php echo $el['el_target'] == '_self' || !$el['ec_target'] ? 'selected':''; ?>>현재창</option>
                                        </select><i></i>
                                    </label>
                                </span>
                            </div>
                            <div class="note"><strong>Note:</strong> EB최신글 마스터에서 사용할 링크주소를 입력해 주세요. 예) <?php echo G5_URL; ?></div>
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
    function feblatestform_submit(f) {
        if (f.el_code.value == '') {
            alert("코드는 자동생성되며 빈값을 입력하실 수 없습니다.");
            document.location.reload();
            return false;
        }
        if (f.el_subject.value.length < 2) {
            alert("최신글 마스터의 제목을 2자이상으로 입력해 주세요.");
            f.el_subject.focus();
            return false;
        }
        if (!f.el_skin.value) {
            alert("최신글 마스터의 스킨을 선택해 주세요.");
            f.el_skin.focus();
            return false;
        }
        return true;
    }

    new Clipboard('.eb-clipboard-box-btn');
    </script>

    <?php if ($w == 'u' && $el_code) { ?>
    <div class="admin-eblatest-itemlist margin-top-40">
        <form name="feblatestitemlist" id="feblatestitemlist" action="<?php echo $action_url2; ?>" method="post" onsubmit="return feblatestitemlist_submit(this);" class="eyoom-form">
        <input type="hidden" name="theme" id="theme" value="<?php echo $this_theme; ?>">
        <input type="hidden" name="el_code" id="el_code" value="<?php echo $el['el_code']; ?>">
        <input type="hidden" name="page" value="<?php echo $page; ?>">
        <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
        <input type="hidden" name="token" value="<?php echo $token; ?>">

        <div class="adm-headline adm-headline-btn">
            <h3>EB최신글 - 아이템 관리</h3>
            <?php if (!$wmode) { ?>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=eblatest_itemform&amp;el_code=<?php echo $el['el_code']; ?>&amp;thema=<?php echo $this_theme; ?>&amp;wmode=1" onclick="eb_modal(this.href, 'EB최신글 아이템'); return false;" class="btn-e btn-e-red btn-e-lg"><i class="fas fa-plus"></i> EB최신글 아이템 추가</a>
            <div class="clearfix"></div>
            <?php } ?>
        </div>

        <?php if (G5_IS_MOBILE) { ?>
        <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
        <?php } ?>

        <div id="eblatest-itemlist"></div>

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
    // EB최신글 이미지 아이템
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
            체크: "<label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $i; ?>'><i></i></label><input type='hidden' name='li_no[<?php echo $i; ?>]' value='<?php echo $list[$i]['li_no']; ?>'>",
            관리: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=eblatest_itemform&amp;thema=<?php echo $this_theme; ?>&amp;el_code=<?php echo $list[$i]['el_code']; ?>&amp;li_no=<?php echo $list[$i]['li_no']; ?>&amp;w=u&amp;iw=u&amp;page=<?php echo $page; ?>&amp;wmode=1' onclick='eb_modal(this.href,\"EB최신글 아이템관리\"); return false;'><u>수정</u></a>",
            최신글제목: "<?php echo $list[$i]['li_title'] ? get_text($list[$i]['li_title']):'없음'; ?>",
            순서: "<label for='li_sort_<?php echo $list[$i]['index']; ?>' class='input'><input type='text' name='li_sort[<?php echo $i; ?>]' id='li_sort_<?php echo $i; ?>' value='<?php echo $list[$i]['li_sort']; ?>'></label>",
            상태: "<label for='li_state_<?php echo $i; ?>' class='select'><select name='li_state[<?php echo $i; ?>]' id='li_state_<?php echo $i; ?>'><option value=''>선택</option><option value='1' <?php echo $list[$i]['li_state'] == '1' ? 'selected':''; ?>>보이기</option><option value='2' <?php echo $list[$i]['li_state'] == '2' ? 'selected': ''; ?>>숨기기</option></select><i></i></label>",
            보기권한: "<label class='select'><?php echo $list[$i]['view_level']; ?><i></i></label>",
            대상게시판: "<?php echo $list[$i]['li_tables']; ?>",
            게시물수: "<?php echo $list[$i]['li_count']; ?>",
            등록일: "<?php echo substr($list[$i]['li_regdt'], 0, 10); ?>",
        },
        <?php } ?>
    ];
}();

$(function() {
    $("#eblatest-itemlist").jsGrid({
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
            { name: "최신글제목", type: "text", width: 100 },
            { name: "순서", type: "number",width: 60 },
            { name: "상태", type: "text", align: "center", width: 120 },
            { name: "보기권한", type: "text", align: "center", width: 80 },
            { name: "대상게시판", type: "text", width: 250 },
            { name: "게시물수", type: "text", align: "center", width: 80 },
            { name: "등록일", type: "text", align: "center", width: 80 },
        ]
    });

    var $chk = $("#eblatest-itemlist .jsgrid-table th:first-child");
    if ($chk.text() == '체크') {
        var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all_img(this.form)"><i></i></label>';
        $chk.html(html);
    }
});

function feblatestitemlist_submit(f) {
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