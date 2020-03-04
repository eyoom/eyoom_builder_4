<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/board/board_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-board-list">
    <form id="fsearch" name="fsearch" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    <input type="hidden" name="sst" id="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" id="sod" value="<?php echo $sod; ?>">

    <div class="adm-headline adm-headline-btn">
        <h3>게시판 관리</h3>
        <?php if (!$wmode) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&pid=board_form" class="btn-e btn-e-red btn-e-lg"><i class="fas fa-plus"></i> 게시판 추가</a>
        <?php } ?>
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
                    <?php if (!($wmode || G5_IS_MOBILE)) { ?>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">그룹</label>
                        </th>
                        <td>
                            <label class="select form-width-250px">
                                <?php echo get_group_select("grid", $grid); ?><i></i>
                            </label>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">확장필드 사용</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="bo_ex_all" class="radio"><input type="radio" name="bo_ex" id="bo_ex_all" value="0" <?php echo $bo_ex_all; ?>><i></i> 전체</label>
                                <label for="bo_ex_yes" class="radio"><input type="radio" name="bo_ex" id="bo_ex_yes" value="2" <?php echo $bo_ex_yes; ?>><i></i> 예</label>
                                <label for="bo_ex_no" class="radio"><input type="radio" name="bo_ex" id="bo_ex_no" value="1" <?php echo $bo_ex_no; ?>><i></i> 아니오</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">PC스킨</label>
                        </th>
                        <td>
                            <label class="select form-width-250px">
                                <?php echo get_skin_select('board', 'boskin', 'boskin', $boskin); ?><i></i>
                            </label>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">모바일스킨</label>
                        </th>
                        <td>
                            <label class="select form-width-250px">
                                <?php echo get_mobile_skin_select('board', 'bomobileskin', 'bomobileskin', $bomobileskin); ?><i></i>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">분류사용</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="bo_cate_all" class="radio"><input type="radio" name="bo_cate" id="bo_cate_all" value="0" <?php echo $bo_cate_all; ?>><i></i> 전체</label>
                                <label for="bo_cate_yes" class="radio"><input type="radio" name="bo_cate" id="bo_cate_yes" value="2" <?php echo $bo_cate_yes; ?>><i></i> 예</label>
                                <label for="bo_cate_no" class="radio"><input type="radio" name="bo_cate" id="bo_cate_no" value="1" <?php echo $bo_cate_no; ?>><i></i> 아니오</label>
                            </div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">글쓴이 사이드뷰 사용</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="bo_sideview_all" class="radio"><input type="radio" name="bo_sideview" id="bo_sideview_all" value="0" <?php echo $bo_sideview_all; ?>><i></i> 전체</label>
                                <label for="bo_sideview_yes" class="radio"><input type="radio" name="bo_sideview" id="bo_sideview_yes" value="2" <?php echo $bo_sideview_yes; ?>><i></i> 예</label>
                                <label for="bo_sideview_no" class="radio"><input type="radio" name="bo_sideview" id="bo_sideview_no" value="1" <?php echo $bo_sideview_no; ?>><i></i> 아니오</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">DHTML 에디터 사용</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="bo_dhtml_all" class="radio"><input type="radio" name="bo_dhtml" id="bo_dhtml_all" value="0" <?php echo $bo_dhtml_all; ?>><i></i> 전체</label>
                                <label for="bo_dhtml_yes" class="radio"><input type="radio" name="bo_dhtml" id="bo_dhtml_yes" value="2" <?php echo $bo_dhtml_yes; ?>><i></i> 예</label>
                                <label for="bo_dhtml_no" class="radio"><input type="radio" name="bo_dhtml" id="bo_dhtml_no" value="1" <?php echo $bo_dhtml_no; ?>><i></i> 아니오</label>
                            </div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">비밀글 사용</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="bo_secret_all" class="radio"><input type="radio" name="bo_secret" id="bo_secret_all" value="0" <?php echo $bo_secret_all; ?>><i></i> 전체</label>
                                <label for="bo_secret_no" class="radio"><input type="radio" name="bo_secret" id="bo_secret_no" value="1" <?php echo $bo_secret_no; ?>><i></i> 사용안함</label>
                                <label for="bo_secret_chk" class="radio"><input type="radio" name="bo_secret" id="bo_secret_chk" value="2" <?php echo $bo_secret_chk; ?>><i></i> 체크박스</label>
                                <label for="bo_secret_yes" class="radio"><input type="radio" name="bo_secret" id="bo_secret_yes" value="3" <?php echo $bo_secret_yes; ?>><i></i> 무조건사용</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">추천 사용</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="bo_good_all" class="radio"><input type="radio" name="bo_good" id="bo_good_all" value="0" <?php echo $bo_good_all; ?>><i></i> 전체</label>
                                <label for="bo_good_yes" class="radio"><input type="radio" name="bo_good" id="bo_good_yes" value="2" <?php echo $bo_good_yes; ?>><i></i> 예</label>
                                <label for="bo_good_no" class="radio"><input type="radio" name="bo_good" id="bo_good_no" value="1" <?php echo $bo_good_no; ?>><i></i> 아니오</label>
                            </div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">비추천 사용</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="bo_nogood_all" class="radio"><input type="radio" name="bo_nogood" id="bo_nogood_all" value="0" <?php echo $bo_nogood_all; ?>><i></i> 전체</label>
                                <label for="bo_nogood_yes" class="radio"><input type="radio" name="bo_nogood" id="bo_nogood_yes" value="2" <?php echo $bo_nogood_yes; ?>><i></i> 예</label>
                                <label for="bo_nogood_no" class="radio"><input type="radio" name="bo_nogood" id="bo_nogood_no" value="1" <?php echo $bo_nogood_no; ?>><i></i> 아니오</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">목록에서 파일 사용</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="bo_file_all" class="radio"><input type="radio" name="bo_file" id="bo_file_all" value="0" <?php echo $bo_file_all; ?>><i></i> 전체</label>
                                <label for="bo_file_yes" class="radio"><input type="radio" name="bo_file" id="bo_file_yes" value="2" <?php echo $bo_file_yes; ?>><i></i> 예</label>
                                <label for="bo_file_no" class="radio"><input type="radio" name="bo_file" id="bo_file_no" value="1" <?php echo $bo_file_no; ?>><i></i> 아니오</label>
                            </div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">목록에서 내용 사용</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="bo_cont_all" class="radio"><input type="radio" name="bo_cont" id="bo_cont_all" value="0" <?php echo $bo_cont_all; ?>><i></i> 전체</label>
                                <label for="bo_cont_yes" class="radio"><input type="radio" name="bo_cont" id="bo_cont_yes" value="2" <?php echo $bo_cont_yes; ?>><i></i> 예</label>
                                <label for="bo_cont_no" class="radio"><input type="radio" name="bo_cont" id="bo_cont_no" value="1" <?php echo $bo_cont_no; ?>><i></i> 아니오</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">전체목록보이기 사용</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="bo_list_all" class="radio"><input type="radio" name="bo_list" id="bo_list_all" value="0" <?php echo $bo_list_all; ?>><i></i> 전체</label>
                                <label for="bo_list_yes" class="radio"><input type="radio" name="bo_list" id="bo_list_yes" value="2" <?php echo $bo_list_yes; ?>><i></i> 예</label>
                                <label for="bo_list_no" class="radio"><input type="radio" name="bo_list" id="bo_list_no" value="1" <?php echo $bo_list_no; ?>><i></i> 아니오</label>
                            </div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">SNS 사용</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="bo_sns_all" class="radio"><input type="radio" name="bo_sns" id="bo_sns_all" value="0" <?php echo $bo_sns_all; ?>><i></i> 전체</label>
                                <label for="bo_sns_yes" class="radio"><input type="radio" name="bo_sns" id="bo_sns_yes" value="2" <?php echo $bo_sns_yes; ?>><i></i> 예</label>
                                <label for="bo_sns_no" class="radio"><input type="radio" name="bo_sns" id="bo_sns_no" value="1" <?php echo $bo_sns_no; ?>><i></i> 아니오</label>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
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
                        <option value="bo_table|asc" <?php echo $sst=='bo_table' && $sod == 'asc' ? 'selected':''; ?>>TABLE 정방향 (↓)</option>
                        <option value="bo_table|desc" <?php echo $sst=='bo_table' && $sod == 'desc' ? 'selected':''; ?>>TABLE 역방향 (↑) </option>
                        <option value="bo_skin|asc" <?php echo $sst=='bo_skin' && $sod == 'asc' ? 'selected':''; ?>>스킨 정방향 (↓)</option>
                        <option value="bo_skin|desc" <?php echo $sst=='bo_skin' && $sod == 'desc' ? 'selected':''; ?>>스킨 역방향 (↑) </option>
                        <option value="bo_mobile_skin|asc" <?php echo $sst=='bo_mobile_skin' && $sod == 'asc' ? 'selected':''; ?>>모바일스킨 정방향 (↓)</option>
                        <option value="bo_mobile_skin|desc" <?php echo $sst=='bo_mobile_skin' && $sod == 'desc' ? 'selected':''; ?>>모바일스킨 역방향 (↑) </option>
                        <option value="bo_subject|asc" <?php echo $sst=='bo_subject' && $sod == 'asc' ? 'selected':''; ?>>제목 정방향 (↓)</option>
                        <option value="bo_subject|desc" <?php echo $sst=='bo_subject' && $sod == 'desc' ? 'selected':''; ?>>제목 역방향 (↑) </option>
                        <option value="bo_use_sns|asc" <?php echo $sst=='bo_use_sns' && $sod == 'asc' ? 'selected':''; ?>>SNS사용 정방향 (↓)</option>
                        <option value="bo_use_sns|desc" <?php echo $sst=='bo_use_sns' && $sod == 'desc' ? 'selected':''; ?>>SNS사용 역방향 (↑) </option>
                        <option value="bo_use_search|asc" <?php echo $sst=='bo_use_search' && $sod == 'asc' ? 'selected':''; ?>>검색사용 정방향 (↓)</option>
                        <option value="bo_use_search|desc" <?php echo $sst=='bo_use_search' && $sod == 'desc' ? 'selected':''; ?>>검색사용 역방향 (↑) </option>
                        <option value="bo_order|asc" <?php echo $sst=='bo_order' && $sod == 'asc' ? 'selected':''; ?>>출력순서 정방향 (↓)</option>
                        <option value="bo_order|desc" <?php echo $sst=='bo_order' && $sod == 'desc' ? 'selected':''; ?>>출력순서 역방향 (↑) </option>
                    </select><i></i>
                </label>
            </section>
        </div>
    </div>

    </form>

    <form name="fboardlist" id="fboardlist" action="<?php echo $action_url1; ?>" method="post" onsubmit="return fboardlist_submit(this);" class="eyoom-form">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="grid" value="<?php echo $grid; ?>">
    <input type="hidden" name="boskin" value="<?php echo $boskin; ?>">
    <input type="hidden" name="bomobileskin" value="<?php echo $bomobileskin; ?>">
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
    <input type="hidden" name="token" value="<?php echo $token; ?>">

    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="board-list"></div>

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
<div class="margin-bottom-20"></div>

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
        <?php for ($i=0; $i<$bo_cnt; $i++) { ?>
        {
            체크: "<label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $i; ?>'><i></i></label>",
            관리: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_form&amp;w=u&amp;bo_table=<?php echo $list[$i]['bo_table']; ?>&amp;<?php echo $qstr; ?>'><u>수정</u></a> <a href='<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_copy&amp;bo_table=<?php echo $list[$i]['bo_table']; ?>&wmode=1' onclick='eb_modal(this.href); return false;' class='margin-left-5'><u>복사</u></a> <a href='<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_extend&amp;bo_table=<?php echo $list[$i]['bo_table']; ?>&amp;<?php echo $qstr; ?>' class='margin-left-5'><u>확장필드(<?php echo number_format($list[$i]['bo_ex_cnt']); ?>)</u></a>",
            게시판: "<a href='<?php echo get_eyoom_pretty_url($list[$i]['bo_table']); ?>' target='_blank'><u>보기</u></a> <a href='<?php echo short_url_clean(G5_BBS_URL.'/write.php?bo_table='.$list[$i]['bo_table']); ?>' target='_blank' class='margin-left-5'><u>글쓰기</u></a> <a href='<?php echo get_eyoom_pretty_url($list[$i]['bo_table']); ?>' target='_blank' class='margin-left-5'><u>바로가기</u></a>",
            테이블아이디: "<input type='hidden' name='board_table[<?php echo $i; ?>]' value='<?php echo $list[$i]['bo_table']; ?>'><a <?php if (!(G5_IS_MOBILE || $wmode)) { ?>href='<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_form&amp;bo_table=<?php echo $list[$i]['bo_table']; ?>&w=u&amp;wmode=1' onclick='eb_modal(this.href); return false;'<?php } else { ?>href='javascript:void(0);'<?php } ?>><i class='fas fa-external-link-alt color-light-grey margin-right-5 hidden-xs'></i><strong><?php echo $list[$i]['bo_table']; ?></strong></a>",
            그룹: "<label class='select'><?php echo $list[$i]['gr_select']; ?><i></i></label>",
            스킨: "<label class='select'><?php echo $list[$i]['skin_select']; ?><i></i></label>",
            모바일스킨: "<label class='select'><?php echo $list[$i]['mobile_skin_select']; ?><i></i></label>",
            제목: "<label class='input'><input type='text' name='bo_subject[<?php echo $i; ?>]' id='bo_subject_<?php echo $i; ?>' value='<?php echo get_text($list[$i]['bo_subject']); ?>' required></label>",
            읽기P: "<label class='input'><input type='text' name='bo_read_point[<?php echo $i; ?>]' id='bo_read_point_<?php echo $i; ?>' value='<?php echo $list[$i]['bo_read_point']; ?>' style='text-align:right;'></label>",
            쓰기P: "<label class='input'><input type='text' name='bo_write_point[<?php echo $i; ?>]' id='bo_write_point_<?php echo $i; ?>' value='<?php echo $list[$i]['bo_write_point']; ?>' style='text-align:right;'></label>",
            댓글P: "<label class='input'><input type='text' name='bo_comment_point[<?php echo $i; ?>]' id='bo_comment_point_<?php echo $i; ?>' value='<?php echo $list[$i]['bo_comment_point']; ?>' style='text-align:right;'></label>",
            다운P: "<label class='input'><input type='text' name='bo_download_point[<?php echo $i; ?>]' id='bo_download_point_<?php echo $i; ?>' value='<?php echo $list[$i]['bo_download_point']; ?>' style='text-align:right;'></label>",
            SNS사용: "<label class='checkbox'><input type='checkbox' name='bo_use_sns[<?php echo $i; ?>]' id='bo_use_sns_<?php echo $i; ?>' value='1' <?php echo $list[$i]['bo_use_sns'] ? 'checked':''; ?>><i></i></label>",
            검색사용: "<label class='checkbox'><input type='checkbox' name='bo_use_search[<?php echo $i; ?>]' id='bo_use_search_<?php echo $i; ?>' value='1' <?php echo $list[$i]['bo_use_search'] ? 'checked':''; ?>><i></i></label>",
            출력순서: "<label class='input'><input type='text' name='bo_order[<?php echo $i; ?>]' id='bo_order_<?php echo $i; ?>' value='<?php echo $list[$i]['bo_order']; ?>' style='text-align:right;'></label>",
            접속기기: "<label class='select'><select name='bo_device[<?php echo $i; ?>]' id='bo_device_<?php echo $i; ?>'><option value='both' <?php echo $list[$i]['bo_device'] == 'both' ? 'selected':''; ?>>모두</option><option value='pc' <?php echo $list[$i]['bo_device'] == 'pc' ? 'selected':''; ?>>PC</option><option value='mobile' <?php echo $list[$i]['bo_device'] == 'mobile' ? 'selected':''; ?>>모바일</option></select><i></i></label>",
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
            { name: "관리", type: "text", align: "center", width: 140, headercss: "set-btn-header", css: "set-btn-field" },
            { name: "게시판", type: "text", align: "center", width: 130 },
            { name: "테이블아이디", type: "text", width: 160 },
            { name: "그룹", type: "text", width: 150 },
            { name: "스킨", type: "text", width: 105 },
            { name: "모바일스킨", type: "number", width: 105 },
            { name: "제목", type: "text", width: 200 },
            { name: "읽기P", type: "text", width: 60 },
            { name: "쓰기P", type: "text", width: 60 },
            { name: "댓글P", type: "text", width: 60 },
            { name: "다운P", type: "text", width: 60 },
            { name: "SNS사용", type: "text", width: 70 },
            { name: "검색사용", type: "text", width: 70 },
            { name: "출력순서", type: "text", width: 70 },
            { name: "접속기기", type: "text", width: 105 },
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

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}
</script>