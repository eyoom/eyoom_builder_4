<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/theme/tag_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<style>
.admin-tag-list .chg_dpmenu .fa-check {display:none}
.admin-tag-list .chg_dpmenu .fa-check.check-show {display:inline-block}
.admin-tag-list .chg_dpmenu .default-text {text-decoration:underline}
.admin-tag-list .chg_dpmenu .check-show-text {font-weight:bold;text-decoration:none}
.admin-tag-list .chg_dpmenu .margin-right-3 {margin-right:3px}
</style>

<div class="admin-tag-list">
    <div class="adm-headline">
        <h3>태그 관리</h3>
    </div>

    <?php include_once(EYOOM_ADMIN_THEME_PATH . '/skin/theme/theme_head.html.php'); ?>

    <form id="fsearch" name="fsearch" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    <input type="hidden" name="sst" id="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" id="sod" value="<?php echo $sod; ?>">

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
                            <label class="input form-width-250px">
                                <input type="hidden" name="sfl" id="sfl" value="tg_word">
                                <input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" autocomplete="off">
                            </label>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">노출여부</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="tg_dpmenu_all" class="radio"><input type="radio" name="tg_dpmenu" id="tg_dpmenu_all" value="0" <?php echo $tg_dpmenu_all; ?>><i></i> 전체</label>
                                <label for="tg_dpmenu_yes" class="radio"><input type="radio" name="tg_dpmenu" id="tg_dpmenu_yes" value="y" <?php echo $tg_dpmenu_yes; ?>><i></i> 노출</label>
                                <label for="tg_dpmenu_no" class="radio"><input type="radio" name="tg_dpmenu" id="tg_dpmenu_no" value="n" <?php echo $tg_dpmenu_no; ?>><i></i> 미노출</label>
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

    <?php echo $frm_submit; ?>

    <div class="margin-bottom-30"></div>

    <div class="row">
        <div class="col col-9">
            <div class="padding-top-5 clearfix">
                <span class="font-size-12 color-grey">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="margin-left-10 margin-right-10 color-light-grey">|</span>생성된 게시판수 <?php echo number_format($total_count); ?>개
                </span>
            </div>
        </div>
        <div class="col col-3">
            <section>
                <label for="sort_list" class="select" style="width:200px;float:right;">
                    <select name="sort_list" id="sort_list" onchange="sorting_list(this.form, this.value);">
                        <option value="">:: 정렬방식선택 ::</option>
                        <option value="tg_word|asc" <?php echo $sst=='tg_word' && $sod=='asc' ? 'selected':''; ?>>태그명 정방향 (↓)</option>
                        <option value="tg_word|desc" <?php echo $sst=='tg_word' && $sod=='desc' ? 'selected':''; ?>>태그명 역방향 (↑)</option>
                        <option value="tg_regcnt|asc" <?php echo $sst=='tg_regcnt' && $sod=='asc' ? 'selected':''; ?>>등록수 정방향 (↓)</option>
                        <option value="tg_regcnt|desc" <?php echo $sst=='tg_regcnt' && $sod=='desc' ? 'selected':''; ?>>등록수 역방향 (↑)</option>
                        <option value="tg_scnt|asc" <?php echo $sst=='tg_scnt' && $sod=='asc' ? 'selected':''; ?>>검색수 정방향 (↓)</option>
                        <option value="tg_scnt|desc" <?php echo $sst=='tg_scnt' && $sod=='desc' ? 'selected':''; ?>>검색수 역방향 (↑)</option>
                        <option value="tg_score|asc" <?php echo $sst=='tg_score' && $sod=='asc' ? 'selected':''; ?>>노출점수 정방향 (↓)</option>
                        <option value="tg_score|desc" <?php echo $sst=='tg_score' && $sod=='desc' ? 'selected':''; ?>>노출점수 역방향 (↑)</option>
                        <option value="tg_dpmenu|asc" <?php echo $sst=='tg_dpmenu' && $sod=='asc' ? 'selected':''; ?>>메뉴노출 정방향 (↓)</option>
                        <option value="tg_dpmenu|desc" <?php echo $sst=='tg_dpmenu' && $sod=='desc' ? 'selected':''; ?>>메뉴노출 역방향 (↑)</option>
                        <option value="tg_recommdt|asc" <?php echo $sst=='tg_recommdt' && $sod=='asc' ? 'selected':''; ?>>추천일자 정방향 (↓)</option>
                        <option value="tg_recommdt|desc" <?php echo $sst=='tg_recommdt' && $sod=='desc' ? 'selected':''; ?>>추천일자 역방향 (↑)</option>
                        <option value="tg_regdt|asc" <?php echo $sst=='tg_regdt' && $sod=='asc' ? 'selected':''; ?>>등록일 정방향 (↓)</option>
                        <option value="tg_regdt|desc" <?php echo $sst=='tg_regdt' && $sod=='desc' ? 'selected':''; ?>>등록일 역방향 (↑)</option>
                    </select><i></i>
                </label>
            </section>
        </div>
    </div>

    </form>

    <form name="ftaglist" id="ftaglist" action="<?php echo $action_url2; ?>" method="post" onsubmit="return ftaglist_submit(this);" class="eyoom-form">
    <input type="hidden" name="theme" id="theme" value="<?php echo $this_theme; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="tg_dpmenu" value="<?php echo $tg_dpmenu; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="<?php echo $token; ?>">

    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="tag-list"></div>

    <div class="margin-top-20">
        <div class="row">
            <div class="col col-6">
                <input type="submit" name="act_button" value="선택수정" class="btn-e btn-e-xs btn-e-red" onclick="document.pressed=this.value">
                <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
            </div>
            <div class="col col-6">
                <div class="text-right">
                    <div class="row">
                        <div class="col col-6">
                            <label class="input input-button">
                                <input type="text" name="tg_new_word" value="" id="tg_new_word" placeholder="태그명">
                                <div class="button"><input type="submit" name="act_button" value="태그추가" onclick="document.pressed=this.value">태그추가</div>
                            </label>
                        </div>
                        <div class="col col-4">
                            <label class="select">
                                <select name="target_theme" id="target_theme" onchange="this.form.submit();">
                                    <option value='<?php echo $theme; ?>'>:: 테마선택 ::</option>
                                    <?php foreach ($tlist as $li) { if ($li['theme_name'] == $this_theme) continue; ?>
                                    <option value="<?php echo $li['theme_name']; ?>" <?php echo $li['theme_name'] == $theme ? 'selected':''; ?>><?php echo $li['theme_name']; ?></option>
                                    <?php } ?>
                                </select>
                                <i></i>
                            </label>
                        </div>
                        <div class="col col-2">
                            <div class="text-right">
                                <input type="submit" name="act_button" value="태그복사" class="btn-e btn-e-dark" onclick="document.pressed=this.value">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>
<div class="margin-bottom-20"></div>

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
                return !(filter.체크 && !(client.체크.indexOf(filter.체크) > -1)  )
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        {
            체크: "<label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $i; ?>'><i></i></label><input type='hidden' name='tg_id[<?php echo $i; ?>]' value='<?php echo $list[$i]['tg_id']; ?>'>",
            태그노출: "<a href='javascript:;' id='dpmenu_y_<?php echo $list[$i]['tg_id']; ?>' class='chg_dpmenu' data-tgid='<?php echo $list[$i]['tg_id']; ?>' data-tgyn='y'><i class='fas fa-check color-red margin-right-3 <?php echo $list[$i]['tg_dpmenu'] == 'y' ? 'check-show':''; ?>'></i><span class='default-text <?php echo $list[$i]['tg_dpmenu'] == 'y' ? 'check-show-text':''; ?>'>노출</span></a> <a href='javascript:;' id='dpmenu_n_<?php echo $list[$i]['tg_id']; ?>' class='chg_dpmenu margin-left-10' data-tgid='<?php echo $list[$i]['tg_id']; ?>' data-tgyn='n'><i class='fas fa-check color-red margin-right-3 <?php echo $list[$i]['tg_dpmenu'] == 'n' ? 'check-show':''; ?>'></i><span class='default-text <?php echo $list[$i]['tg_dpmenu'] == 'n' ? 'check-show-text':''; ?>'>미노출</span></a><input type='hidden' name='tg_dpmenu[<?php echo $i; ?>]' value='<?php echo $list[$i]['tg_dpmenu']; ?>'>",
            태그명: "<label for='tg_id_<?php echo $i; ?>' class='input'><input type='text' name='tg_word[<?php echo $i; ?>]' id='tg_id_<?php echo $i; ?>' value='<?php echo $list[$i]['tg_word']; ?>'></label>",
            등록수: "<label for='tg_regcnt_<?php echo $i; ?>' class='input'><input type='text' name='tg_regcnt[<?php echo $i; ?>]' id='tg_regcnt_<?php echo $i; ?>' value='<?php echo $list[$i]['tg_regcnt']; ?>' class='text-right'></label>",
            검색수: "<label for='tg_scnt_<?php echo $i; ?>' class='input'><input type='text' name='tg_scnt[<?php echo $i; ?>]' id='tg_scnt_<?php echo $i; ?>' value='<?php echo $list[$i]['tg_scnt']; ?>' class='text-right'></label>",
            노출점수: "<label for='tg_score_<?php echo $i; ?>' class='input'><input type='text' name='tg_score[<?php echo $i; ?>]' id='tg_score_<?php echo $i; ?>' value='<?php echo $list[$i]['tg_score']; ?>' class='text-right'></label>",
            태그추천: "<a href='javascript:;' id='tg_recommbtn_y_<?php echo $list[$i]['tg_id']; ?>' class='set_recommend' data-tgid='<?php echo $list[$i]['tg_id']; ?>' data-tgyn='y'><u>추천</u></a> <a href='javascript:;' id='tg_recommbtn_n_<?php echo $list[$i]['tg_id']; ?>' class='set_recommend margin-left-10' data-tgid='<?php echo $list[$i]['tg_id']; ?>' data-tgyn='n'><u>취소</u></a>",
            추천일자: "<div id='tg_recommdt_<?php echo $list[$i]['tg_id']; ?>'><?php if ($list[$i]['tg_recommdt'] == '0000-00-00 00:00:00') { echo '-'; } else { echo $list[$i]['tg_recommdt']; ?><input type='hidden' name='tg_recommdt[<?php echo $i; ?>]' value='<?php echo $list[$i]['tg_recommdt']; ?>'><?php } ?></div>",
            등록일: "<?php echo $list[$i]['tg_regdt']; ?><input type='hidden' name='tg_regdt[<?php echo $i; ?>]' value='<?php echo $list[$i]['tg_regdt']; ?>'>",
        },
        <?php } ?>
    ]
}();

$(function() {
    $("#tag-list").jsGrid({
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
            { name: "태그노출", type: "text", align: "center", width: 100, headercss: "set-btn-header", css: "set-btn-field" },
            { name: "태그명", type: "text", width: 150 },
            { name: "등록수", type: "text", width: 70 },
            { name: "검색수", type: "text", width: 70 },
            { name: "노출점수", type: "text", width: 70 },
            { name: "태그추천", type: "text", align: "center", width: 80, headercss: "set-btn-header", css: "set-btn-field" },
            { name: "추천일자", type: "text", align: "center", width: 120 },
            { name: "등록일", type: "text", align: "center", width: 120 },
        ]
    });

    var $chk = $(".jsgrid-table th:first-child");
    if ($chk.text() == '체크') {
        var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>';
        $chk.html(html);
    }

    $(".chg_dpmenu").click(function() {
        var id = $(this).attr('data-tgid');
        var yn = $(this).attr('data-tgyn');
        var url = "<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=tag_dpmenu&smode=1";
        $.post(url, {'id':id,'yn':yn}, function(data) {
            if(data.dpmenu) {
                if (data.dpmenu == 'n') {
                    $('#dpmenu_y_'+id+' .fa-check').show();
                    $('#dpmenu_n_'+id+' .fa-check').hide();
                } else if (data.dpmenu == 'y') {
                    $('#dpmenu_y_'+id+' .fa-check').hide();
                    $('#dpmenu_n_'+id+' .fa-check').show();
                }
            }
        },"json");
    });

    $(".set_recommend").click(function() {
        var id = $(this).attr('data-tgid');
        var yn = $(this).attr('data-tgyn');
        var url = "<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=tag_recommend&smode=1";
        $.post(url, {'id':id,'yn':yn}, function(data) {
            if (data.recommdt && yn == 'y') {
                $("#tg_recommdt_"+id).text(data.recommdt);
            } else {
                $("#tg_recommdt_"+id).text('-');
            }
        },"json");
    });
});

function sorting_list(f, str) {
    var sort = str.split('|');

    $("#sst").val(sort[0]);
    $("#sod").val(sort[1]);

    if (sort[0] && sort[1]) {
        f.submit();
    }
}

function ftaglist_submit(f) {
    if(document.pressed == "태그추가") {
        if(f.tg_new_word.value == '') {
            alert('태그명을 입력해 주세요.');
            f.tg_new_word.focus();
            return false;
        }
    } else {
        if (!is_checked("chk[]")) {
            alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
            return false;
        }

        if(document.pressed == "선택삭제") {
            if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
                return false;
            }
        }
        if(document.pressed == "태그복사") {
            if ($("#target_theme option:selected").val() == '') {
                alert('태그복사할 테마를 선택해 주세요.');
                $("#target_theme").focus();
                return false;
            }
        }
    }

    return true;
}
</script>