<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/theme/board_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-board-list">
    <div class="adm-headline">
        <h3>게시판 추가설정 관리</h3>
    </div>

    <?php include_once(EYOOM_ADMIN_THEME_PATH . '/skin/theme/theme_head.html.php'); ?>

    <form id="fsearch" name="fsearch" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    <input type="hidden" name="thema" value="<?php echo $this_theme; ?>" id="thema">
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
                        <td colspan="3">
                            <div <?php if (!G5_IS_MOBILE) { ?>class="inline-group"<?php } ?>>
                                <div class="margin-bottom-5">
                                    <label class="select form-width-150px">
                                        <select name="sfl" id="sfl">
                                            <option value="bo_table"<?php echo get_selected($sfl, "bo_table"); ?>>테이블아이디</option>
                                            <option value="bo_subject"<?php echo get_selected($sfl, "bo_subject"); ?>>게시판명</option>
                                            <option value="bo_category_list"<?php echo get_selected($sfl, "bo_category_list"); ?>>카테고리명</option>
                                        </select><i></i>
                                    </label>
                                </div>
                                <span>
                                    <label class="input form-width-250px">
                                        <input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" autocomplete="off">
                                    </label>
                                </span>
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
                        <option value="a.gr_id|asc" <?php echo $sst=='a.gr_id' && $sod == 'asc' ? 'selected':''; ?>>그룹 정방향 (↓)</option>
                        <option value="a.gr_id|desc" <?php echo $sst=='a.gr_id' && $sod == 'desc' ? 'selected':''; ?>>그룹 역방향 (↑) </option>
                        <option value="bo_table|asc" <?php echo $sst=='bo_table' && $sod == 'asc' ? 'selected':''; ?>>테이블아이디 정방향 (↓)</option>
                        <option value="bo_table|desc" <?php echo $sst=='bo_table' && $sod == 'desc' ? 'selected':''; ?>>테이블아이디 역방향 (↑) </option>
                        <option value="bo_skin|asc" <?php echo $sst=='bo_skin' && $sod == 'asc' ? 'selected':''; ?>>스킨 정방향 (↓)</option>
                        <option value="bo_skin|desc" <?php echo $sst=='bo_skin' && $sod == 'desc' ? 'selected':''; ?>>스킨 역방향 (↑) </option>
                        <option value="bo_subject|asc" <?php echo $sst=='bo_subject' && $sod == 'asc' ? 'selected':''; ?>>제목 정방향 (↓)</option>
                        <option value="bo_subject|desc" <?php echo $sst=='bo_subject' && $sod == 'desc' ? 'selected':''; ?>>제목 역방향 (↑) </option>
                    </select><i></i>
                </label>
            </section>
        </div>
    </div>

    </form>

    <form name="fboardlist" id="fboardlist" action="<?php echo $action_url1; ?>" method="post" onsubmit="return fboardlist_submit(this);" class="eyoom-form">
    <input type="hidden" name="theme" value="<?php echo $this_theme; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="<?php echo $token; ?>">

    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="board-list"></div>

    <div class="margin-top-20">
        <input type="submit" name="act_button" value="선택수정" class="btn-e btn-e-xs btn-e-red" onclick="document.pressed=this.value">
    </div>
    </form>
</div>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>

<div class="modal fade admin-iframe-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">게시판 관리</h4>
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
function eb_modal(href) {
    $('.admin-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#modal-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.admin-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#modal-iframe").attr("src", href);
        $('#modal-iframe').height(parseInt($(window).height() * 0.85));
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

window.closeModal = function(){
    $('.admin-iframe-modal').modal('hide');
};
<?php } ?>

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
                return !(filter.No && !(client.No.indexOf(filter.No) > -1) || filter.회원구분 && !(client.회원구분.indexOf(filter.회원구분) > -1) || filter.아이디 && !(client.아이디.indexOf(filter.아이디) > -1) || filter.이름 && !(client.이름.indexOf(filter.이름) > -1) || filter.휴대전화 && !(client.휴대전화.indexOf(filter.휴대전화) > -1) || filter.전화번호 && !(client.전화번호.indexOf(filter.전화번호) > -1) || filter.이메일 && !(client.이메일.indexOf(filter.이메일) > -1) || filter.가입일 && !(client.가입일.indexOf(filter.가입일) > -1) || filter.최신로그인 && !(client.최신로그인.indexOf(filter.최신로그인) > -1) || filter.상태 && !(client.상태.indexOf(filter.상태) > -1) )
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        {
            체크: "<label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $i; ?>'><i></i></label>",
            관리: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=board_form&amp;w=u&amp;bo_table=<?php echo $list[$i]['bo_table']; ?>&amp;<?php echo $qstr; ?>'><u>수정</u></a>",
            게시판: "<a href='<?php echo get_eyoom_pretty_url($list[$i]['bo_table']); ?>&wmode=1' onclick='eb_modal(this.href); return false;'><u>보기</u></a> <a href='<?php echo short_url_clean(G5_BBS_URL.'/write.php?bo_table='.$list[$i]['bo_table']); ?>&wmode=1' onclick='eb_modal(this.href); return false;' class='margin-left-10'><u>글쓰기</u></a> <a href='<?php echo get_eyoom_pretty_url($list[$i]['bo_table']); ?>?theme=<?php echo $this_theme; ?>' target='_blank' class='margin-left-5'><u>바로가기</u></a>",
            그룹: "<?php echo $list[$i]['gr_subject']; ?>",
            테이블아이디: "<input type='hidden' name='board_table[<?php echo $i; ?>]' value='<?php echo $list[$i]['bo_table']; ?>'><a <?php if (!(G5_IS_MOBILE || $wmode)) { ?>href='<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_form&amp;bo_table=<?php echo $list[$i]['bo_table']; ?>&amp;w=u&amp;wmode=1' onclick='eb_modal(this.href); return false;'<?php } else { ?>href='javascript:void(0);'<?php } ?>><i class='fas fa-external-link-alt color-light-grey margin-right-5 hidden-xs'></i><strong><?php echo $list[$i]['bo_table']; ?></strong></a>",
            제목: "<?php echo get_text($list[$i]['bo_subject']); ?>",
            글작성회수제한: "<label class='input'><input type='text' name='bo_write_limit[<?php echo $i; ?>]' id='bo_write_limit_<?php echo $i; ?>' value='<?php echo $list[$i]['bo_write_limit']; ?>'></label>",
            이윰스킨: "<label class='select'><?php echo $list[$i]['bo_skin_select']; ?><i></i></label>",
            스킨선택: "<label for='use_gnu_skin_<?php echo $i; ?>_1' class='radio' style='width:100px;float:left;margin-right:15px'><input type='radio' name='use_gnu_skin[<?php echo $i; ?>]' id='use_gnu_skin_<?php echo $i; ?>_1' value='n' <?php echo $list[$i]['use_gnu_skin'] == 'n' ? 'checked':''; ?>><i></i> 이윰빌더 스킨</label><label for='use_gnu_skin_<?php echo $i; ?>_2' class='radio' style='width:100px;float:left'><input type='radio' name='use_gnu_skin[<?php echo $i; ?>]' id='use_gnu_skin_<?php echo $i; ?>_2' value='y' <?php echo $list[$i]['use_gnu_skin'] == 'y' ? 'checked':''; ?>><i></i> 그누보드 스킨</label>",
        },
        <?php } ?>
    ]
}();

$(function() {
    $("#board-list").jsGrid({
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
            { name: "게시판", type: "text", align: "center", width: 130 },
            { name: "그룹", type: "text", width: 150 },
            { name: "테이블아이디", type: "text", width: 150 },
            { name: "제목", type: "text", width: 200 },
            { name: "글작성회수제한", type: "number", width: 120 },
            { name: "이윰스킨", type: "text", align: "center", width: 140 },
            { name: "스킨선택", type: "text", align: "center", width: 260 },
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
        f.submit();
    }
}

function fboardlist_submit(f) {
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    return true;
}
</script>