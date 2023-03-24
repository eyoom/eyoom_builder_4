<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/board/tag_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'tag_list';
$g5_title = '태그관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">게시판관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<style>
.admin-tag-list .chg_dpmenu .fa-check {display:none}
.admin-tag-list .chg_dpmenu .fa-check.check-show {display:inline-block}
.admin-tag-list .chg_dpmenu .default-text {text-decoration:underline}
</style>

<div class="admin-tag-list">
    <form id="fsearch" name="fsearch" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    <input type="hidden" name="sst" id="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" id="sod" value="<?php echo $sod; ?>">

    <?php if (G5_IS_MOBILE) { ?>
    <a class="collapse-search-btn btn-e btn-e-sm btn-e-dark m-b-20" data-bs-toggle="collapse" href="#collapse-search-box"><i class="fas fa-search m-r-7"></i><span>검색 조건 열기</span></a>
    <?php } ?>
    <div id="collapse-search-box" class="<?php if (G5_IS_MOBILE) { ?>panel-collapse collapse<?php } ?> m-b-20">
        <div class="adm-form-table adm-search-box m-b-20">
            <div class="adm-form-tr-wrap">
                <div class="adm-form-tr tr-l">
                    <div class="adm-form-td td-l">
                        <label class="label">검색어</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input max-width-250px">
                            <input type="hidden" name="sfl" id="sfl" value="tg_word">
                            <input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" autocomplete="off">
                        </label>
                    </div>
                </div>
                <div class="adm-form-tr tr-r">
                    <div class="adm-form-td td-l">
                        <label class="label">노출여부</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <label for="tg_dpmenu_all" class="radio"><input type="radio" name="tg_dpmenu" id="tg_dpmenu_all" value="0" <?php echo $tg_dpmenu_all; ?>><i></i> 전체</label>
                            <label for="tg_dpmenu_yes" class="radio"><input type="radio" name="tg_dpmenu" id="tg_dpmenu_yes" value="y" <?php echo $tg_dpmenu_yes; ?>><i></i> 노출</label>
                            <label for="tg_dpmenu_no" class="radio"><input type="radio" name="tg_dpmenu" id="tg_dpmenu_no" value="n" <?php echo $tg_dpmenu_no; ?>><i></i> 미노출</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="confirm-bottom-btn">
            <?php echo $frm_submit;?>
        </div>
    </div>

    </form>

    <form name="ftaglist" id="ftaglist" action="<?php echo $action_url2; ?>" method="post" onsubmit="return ftaglist_submit(this);" class="eyoom-form">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="tg_dpmenu" value="<?php echo $tg_dpmenu; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="<?php echo $token; ?>">

    <div class="m-b-5">
        <div class="float-start f-s-13r">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="m-l-10 m-r-10 text-light-gray">|</span>생성된 게시판수 <?php echo number_format($total_count); ?>개
        </div>
        <div class="float-end xs-float-start">
            <label for="sort_list" class="select width-200px">
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
        </div>
        <div class="clearfix"></div>
    </div>

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="width-40px">
                            <label for="chkall" class="sound_only">전체선택</label>
                            <label class="checkbox adm-table-check"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>
                        </th>
                        <th class="width-180px">태그노출</th>
                        <th>태그명</th>
                        <th>등록수</th>
                        <th>검색수</th>
                        <th>노출점수</th>
                        <th class="width-120px">태그추천</th>
                        <th>추천일자</th>
                        <th>등록일</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th>
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="chk[]" id="chk_<?php echo $i; ?>" value="<?php echo $i; ?>"><i></i>
                            </label>
                            <input type="hidden" name="tg_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['tg_id']; ?>">
                        </th>
                        <td class="text-center">
                            <a href="javascript:void(0);" id="dpmenu_y_<?php echo $list[$i]['tg_id']; ?>" class="chg_dpmenu" data-tgid="<?php echo $list[$i]['tg_id']; ?>" data-tgyn="y"><i class="fas fa-check text-crimson m-r-5 <?php echo $list[$i]['tg_dpmenu'] == 'y' ? 'check-show':''; ?>"></i><span class="default-text <?php echo $list[$i]['tg_dpmenu'] == 'y' ? 'check-show-text':''; ?>">노출</span></a><a href="javascript:void(0);" id="dpmenu_n_<?php echo $list[$i]['tg_id']; ?>" class="chg_dpmenu m-l-20" data-tgid="<?php echo $list[$i]['tg_id']; ?>" data-tgyn='n'><i class="fas fa-check text-crimson m-r-5 <?php echo $list[$i]['tg_dpmenu'] == 'n' ? 'check-show':''; ?>"></i><span class="default-text <?php echo $list[$i]['tg_dpmenu'] == 'n' ? 'check-show-text':''; ?>">미노출</span></a><input type="hidden" name="tg_dpmenu[<?php echo $i; ?>]" value="<?php echo $list[$i]['tg_dpmenu']; ?>">
                        </td>
                        <td>
                            <label class="input width-200px"><input type="text" name="tg_word[<?php echo $i; ?>]" id="tg_id_<?php echo $i; ?>" value="<?php echo $list[$i]['tg_word']; ?>"></label>
                        </td>
                        <td>
                            <label class="input width-100px"><input type="text" name="tg_regcnt[<?php echo $i; ?>]" id="tg_regcnt_<?php echo $i; ?>" value="<?php echo $list[$i]['tg_regcnt']; ?>" class="text-end"></label>
                        </td>
                        <td>
                            <label class="input width-100px"><input type="text" name="tg_scnt[<?php echo $i; ?>]" id="tg_scnt_<?php echo $i; ?>" value="<?php echo $list[$i]['tg_scnt']; ?>" class="text-end"></label>
                        </td>
                        <td>
                            <label class="input width-100px"><input type="text" name="tg_score[<?php echo $i; ?>]" id="tg_score_<?php echo $i; ?>" value="<?php echo $list[$i]['tg_score']; ?>" class="text-end"></label>
                        </td>
                        <td class="text-center">
                            <a href="javascript:void(0);" id="tg_recommbtn_y_<?php echo $list[$i]['tg_id']; ?>" class="set_recommend" data-tgid="<?php echo $list[$i]['tg_id']; ?>" data-tgyn="y"><u>추천</u></a><a href="javascript:void(0);" id="tg_recommbtn_n_<?php echo $list[$i]['tg_id']; ?>" class="set_recommend m-l-10" data-tgid="<?php echo $list[$i]['tg_id']; ?>" data-tgyn="n"><u>취소</u></a>
                        </td>
                        <td class="text-center">
                            <div id="tg_recommdt_<?php echo $list[$i]['tg_id']; ?>"><?php if ($list[$i]['tg_recommdt'] == '0000-00-00 00:00:00') { echo '-'; } else { echo $list[$i]['tg_recommdt']; ?><input type="hidden" name="tg_recommdt[<?php echo $i; ?>]" value="<?php echo $list[$i]['tg_recommdt']; ?>"><?php } ?></div>
                        </td>
                        <td class="text-center">
                            <?php echo $list[$i]['tg_regdt']; ?><input type="hidden" name="tg_regdt[<?php echo $i; ?>]" value="<?php echo $list[$i]['tg_regdt']; ?>">
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="9" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="position-relative">
        <div class="float-start">
            <input type="submit" name="act_button" value="선택수정" class="btn-e btn-e-xs btn-e-crimson" onclick="document.pressed=this.value">
            <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
        </div>
        <div class="float-end">
            <label class="input input-button width-200px">
                <input type="text" name="tg_new_word" value="" id="tg_new_word" placeholder="태그명">
                <div class="button"><input type="submit" name="act_button" value="태그추가" onclick="document.pressed=this.value">태그추가</div>
            </label>
        </div>
        <div class="clearfix"></div>
    </div>

    </form>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>
</div>

<script>
$(function() {
    $(".chg_dpmenu").click(function() {
        var id = $(this).attr('data-tgid');
        var yn = $(this).attr('data-tgyn');
        var url = "<?php echo G5_ADMIN_URL; ?>/?dir=board&pid=tag_dpmenu&smode=1";
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
        var url = "<?php echo G5_ADMIN_URL; ?>/?dir=board&pid=tag_recommend&smode=1";
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
    }

    return true;
}
</script>