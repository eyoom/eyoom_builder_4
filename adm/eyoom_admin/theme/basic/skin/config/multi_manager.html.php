<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/config/multi_manager.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-manager-list">
    <div class="adm-headline">
        <h3>다중관리자 설정관리</h3>
    </div>

    <form name="fmultimanager" id="fmultimanager" action="<?php echo $action_url1; ?>" method="post" onsubmit="return fmultimanager_submit(this);" class="eyoom-form">
    <input type="hidden" name="sst" id="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" id="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="">

    <div class="row">
        <div class="col col-9">
            <div class="padding-top-5">
                <span class="font-size-12 color-grey">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="margin-left-10 margin-right-10 color-light-grey">|</span>설정된 다중관리자 <?php echo number_format($total_count); ?>명
                </span>
            </div>
        </div>
        <div class="col col-3">
            <section>
                <label for="sort_list" class="select" style="width:200px;float:right;">
                    <select name="sort_list" id="sort_list" onchange="sorting_list(this.form, this.value);">
                        <option value="">:: 정렬방식선택 ::</option>
                        <option value="a.mb_id|asc" <?php if ($sst=='a.mb_id' && $sod=='asc') echo 'selected'; ?>>회원아이디 정방향 (↓)</option>
                        <option value="a.mb_id|desc" <?php if ($sst=='a.mb_id' && $sod=='desc') echo 'selected'; ?>>회원아이디 역방향 (↑)</option>
                        <option value="mb_nick|asc" <?php if ($sst=='mb_nick' && $sod=='asc') echo 'selected'; ?>>닉네임 정방향 (↓)</option>
                        <option value="mb_nick|desc" <?php if ($sst=='mb_nick' && $sod=='desc') echo 'selected'; ?>>닉네임 역방향 (↑)</option>
                    </select><i></i>
                </label>
            </section>
        </div>
    </div>
    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="manager-list"></div>

    <div class="margin-top-20">
        <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
    </div>
    </form>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>

    <form name="fmultimanager2" id="fmultimanager2" action="<?php echo $action_url2; ?>" method="post" autocomplete="off" class="eyoom-form" onsubmit="return fmanager_add_submit(this);">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-headline">
        <h3>다중관리자 추가 &amp; 적용</h3>
    </div>

    <div id="manager-form">
        <div class="adm-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 다중관리자 테마 및 메뉴 설정</strong></header>

            <fieldset>
                <div class="cont-text-bg">
                    <p class="bg-info font-size-12 margin-bottom-0">
                        <i class="fas fa-info-circle"></i> 다중관리자로 설정할 회원 아이디를 검색하세요.<br>
                        <i class="fas fa-info-circle"></i> 추가한 관리자의 메뉴노출 여부를 설정하세요.<br>
                        <i class="fas fa-info-circle"></i> 동일한 아이디를 중복하여 추가할 경우, 다중관리자의 정보를 업데이트 합니다.<br>
                    </p>
                </div>
            </fieldset>

            <fieldset>
                <div class="row">
                    <div class="col col-3">
                        <section>
                            <label for="mb_id" class="label">회원아이디</label>
                            <label class="input">
                                <input type="text" name="mb_id" id="mb_id" value="<?php echo $mb_id; ?>" required>
                            </label>
                        </section>
                    </div>
                    <div class="col col-1">
                        <section class="label-height">
                            <a href='<?php echo G5_ADMIN_URL; ?>/?dir=member&amp;pid=member_list&amp;wmode=1' class="btn-e btn-e-sm btn-e-dark" onclick="eb_modal(this.href); return false;">회원검색</a>
                        </section>
                    </div>
                    <div class="col col-3">
                        <section>
                            <label for="mg_theme" class="label">관리자모드 테마선택</label>
                            <label class="select">
                                <select name="mg_theme" id="mg_theme" required>
                                    <option value="">선택</option>
                                    <?php for ($i=0; $i<count((array)$cf_eyoom_admin_theme); $i++) { ?>
                                    <option value="<?php echo $cf_eyoom_admin_theme[$i]; ?>"><?php echo $cf_eyoom_admin_theme[$i]; ?></option>
                                    <?php } ?>
                                </select><i></i>
                            </label>
                        </section>
                    </div>
                </div>
            </fieldset>

            <?php $i=0; foreach ($dir_menu as $dirname => $menuname) { ?>
            <?php if ($i%4==0) { ?>
            <fieldset>
                <div class="row">
            <?php } ?>
                    <div class="col col-3">
                        <section>
                            <label for="me_<?php echo $dirname; ?>" class="label"><?php echo $menuname; ?></label>
                            <label for="me_<?php echo $dirname; ?>" class="checkbox"><input type="checkbox" name="mg_menu[<?php echo $dirname; ?>]" value="1" id="me_<?php echo $dirname; ?>" checked><i></i> 보이기</label>
                        </section>
                    </div>
            <?php if ($i%4==3 || count($dir_menu)-1 == $i) { ?>
                </div>
            </fieldset>
            <?php } ?>
            <?php $i++; } ?>

            <fieldset>
                <div class="row">
                    <div class="col col-12">
                        <label class="label">자동등록방지</label>
                        <div><?php echo $captcha_html; ?></div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>

    <div class="text-center margin-top-30 margin-bottom-30">
        <input type="submit" value="적용하기" class="btn-e btn-e-lg btn-e-red" accesskey="s"></button>
    </div>
    </form>
</div>

<div class="modal fade admin-iframe-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">회원 검색</h4>
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
function eb_modal(href) {
    <?php if (!(G5_IS_MOBILE || $wmode)) { ?>
    $('.admin-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#modal-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.admin-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#modal-iframe").attr("src", href);
        $('#modal-iframe').height(parseInt($(window).height() * 0.85));
        $('html').css({overflow: 'hidden'});
    });
    <?php } ?>
    return false;
}

window.closeModal = function(){
    $('.admin-iframe-modal').modal('hide');
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
                return !(filter.체크 && !(client.체크.indexOf(filter.체크) > -1) )
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
        <?php for ($i=0; $i<$count; $i++) { ?>
        {
            체크: "<input type='hidden' name='mb_id[<?php echo $i; ?>]' value='<?php echo $list[$i]['mb_id']; ?>'><label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $i; ?>'><i></i></label>",
            회원아이디: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=config&amp;pid=multi_manager&amp;sfl=a.mb_id&amp;stx=<?php echo $list[$i]['mb_id']; ?>'><?php echo $list[$i]['mb_id']; ?></a>",
            닉네임: "<?php echo $list[$i]['mb_nick']; ?>",
            관리자테마: "<?php echo $list[$i]['mg_theme']; ?>",
            관리메뉴: "<?php echo $list[$i]['mg_menu']; ?>",
        },
        <?php } ?>
    ]
}();

$(function() {
    $("#manager-list").jsGrid({
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
            { name: "체크", type: "text", align: "center", width: 40 },
            { name: "회원아이디", type: "text", width: 110 },
            { name: "닉네임", type: "text", width: 110 },
            { name: "관리자테마", type: "text", width: 100 },
            { name: "관리메뉴", type: "text", width: 300 },
        ]
    });

    var $chk = $(".jsgrid-table th:first-child");
    if ($chk.text() == '체크') {
        var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>';
        $chk.html(html);
    }
});

function sorting_list(f, str) {
    var sort = str.split('|');

    $("#sst").val(sort[0]);
    $("#sod").val(sort[1]);

    if (sort[0] && sort[1]) {
        f.action = "<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&pid=<?php echo $pid; ?>";
        f.submit();
    }
}

function fmanager_add_submit(f){
    <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>
    return true;
}

function fmultimanager_submit(f) {
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 다중관리자를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }
    return true;
}
</script>