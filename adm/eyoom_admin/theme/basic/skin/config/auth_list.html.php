<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/config/auth_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-auth-list">
    <form id="fsearch" name="fsearch" class="eyoom-form" method="get" class="eyoom-form">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">

    <div class="adm-headline">
        <h3>관리권한 목록</h3>
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
                            <label for="stx" class="label">검색어</label>
                        </th>
                        <td>
                            <div class="margin-bottom-5">
                                <label class="select form-width-150px">
                                    <select name="sfl" id="sfl">
                                        <option value="b.mb_name"<?php echo get_selected($sfl, "b.mb_name"); ?>>이름</option>
                                        <option value="a.mb_id"<?php echo get_selected($sfl, "a.mb_id"); ?>>아이디</option>
                                        <option value="b.mb_nick"<?php echo get_selected($sfl, "b.mb_nick"); ?>>닉네임</option>
                                        <option value="b.mb_email"<?php echo get_selected($sfl, "b.mb_email"); ?>>E-MAIL</option>
                                        <option value="b.mb_tel"<?php echo get_selected($sfl, "b.mb_tel"); ?>>전화번호</option>
                                        <option value="b.mb_hp"<?php echo get_selected($sfl, "b.mb_hp"); ?>>휴대폰번호</option>
                                    </select><i></i>
                                </label>
                            </div>
                            <label class="input form-width-250px">
                                <input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" autocomplete="off">
                            </label>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label for="au_menu" class="label">메뉴 코드</label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <input type="text" name="au_menu" value="<?php echo $au_menu; ?>" id="au_menu" autocomplete="off">
                            </label>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php if (!G5_IS_MOBILE) { ?>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php echo $frm_submit;?>

    </form>
    <div class="margin-bottom-30"></div>

    <form name="fauthlist" id="fauthlist" action="<?php echo $action_url1; ?>" method="post" onsubmit="return fauthlist_submit(this);" class="eyoom-form">
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
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="margin-left-10 margin-right-10 color-light-grey">|</span>설정된 관리권한 <?php echo number_format($total_count); ?>건
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

    <div id="auth-list"></div>

    <div class="margin-top-20">
        <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
    </div>
    </form>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>

    <form name="fauthlist2" id="fauthlist2" action="<?php echo $action_url2; ?>" method="post" autocomplete="off" class="eyoom-form" onsubmit="return fauth_add_submit(this);">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-headline">
        <h3>관리권한 추가</h3>
    </div>

    <div id="auth-form">
        <div class="adm-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 관리권한 설정</strong></header>

            <fieldset>
                <div class="cont-text-bg">
                    <p class="bg-info font-size-12 margin-bottom-0">
                        <i class="fas fa-info-circle"></i> 다음 양식에서 회원에게 관리권한을 부여하실 수 있습니다.<br>
                        <i class="fas fa-info-circle"></i> 권한 <strong class="color-red">r</strong>은 읽기권한, <strong class="color-red">w</strong>는 쓰기권한, <strong class="color-red">d</strong>는 삭제권한입니다.
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
                    <div class="col col-3">
                        <section class="label-height">
                            <a href='<?php echo G5_ADMIN_URL; ?>/?dir=member&amp;pid=member_list&amp;wmode=1' class="btn-e btn-e-sm btn-e-dark" onclick="eb_modal(this.href); return false;">회원검색</a>
                        </section>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <div class="row">
                    <div class="col col-3">
                        <section>
                            <label for="mb_id" class="label">접근가능메뉴</label>
                            <label class="select">
                                <select id="au_menu" name="au_menu" required>
                                    <option value=''>선택하세요</option>
                                    <?php
                                    foreach($auth_menu as $key=>$value)
                                    {
                                        if (!(substr($key, -3) == '000' || $key == '-' || !$key))
                                            echo '<option value="'.$key.'">'.$key.' '.$value.'</option>';
                                    }
                                    ?>
                                </select><i></i>
                            </label>
                        </section>
                    </div>
                    <div class="col col-5">
                        <section>
                            <label for="mb_id" class="label">권한지정</label>
                            <div class="inline-group">
                                <label for="r" class="checkbox"><input type="checkbox" name="r" id="r" value="r" checked><i></i> r (읽기)</label>
                                <label for="w" class="checkbox"><input type="checkbox" name="w" id="w" value="w"><i></i> w (쓰기)</label>
                                <label for="d" class="checkbox"><input type="checkbox" name="d" id="d" value="d"><i></i> d (삭제)</label>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-12">
                        <section>
                            <label for="mb_id" class="label">자동등록방지</label>
                            <div>
                                <?php echo $captcha_html; ?>
                            </div>
                        </section>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>

    <div class="text-center margin-top-30 margin-bottom-30">
        <input type="submit" value="추가하기" class="btn-e btn-e-lg btn-e-red" accesskey="s"></button>
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
            체크: "<input type='hidden' name='au_menu[<?php echo $i; ?>]' value='<?php echo $list[$i]['au_menu']; ?>'><input type='hidden' name='mb_id[<?php echo $i; ?>]' value='<?php echo $list[$i]['mb_id']; ?>'><label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $i; ?>'><i></i></label>",
            회원아이디: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=config&amp;pid=auth_list&amp;sfl=a.mb_id&amp;stx=<?php echo $list[$i]['mb_id']; ?>'><?php echo $list[$i]['mb_id']; ?></a>",
            닉네임: "<?php echo $list[$i]['mb_nick']; ?>",
            메뉴: "<?php echo $list[$i]['au_menu']; ?> <?php echo $list[$i]['auth_menu']; ?>",
            권한: "<?php echo $list[$i]['au_auth']; ?>",
        },
        <?php } ?>
    ]
}();

$(function() {
    $("#auth-list").jsGrid({
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
            { name: "메뉴", type: "text", width: 300 },
            { name: "권한", type: "text", width: 100 },
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

function fauth_add_submit(f){
    <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>
    return true;
}

function fauthlist_submit(f) {
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