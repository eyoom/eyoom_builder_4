<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/board/board_extend.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'board_list';
$g5_title = '게시판관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">게시판관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-board-form">
    <div class="adm-headline">
        <h3>확장필드 관리 [ <span class="text-crimson"><?php echo $board['bo_table'] . ' : ' . $board['bo_subject']; ?></span> ]</h3>
    </div>

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
    <input type="hidden" name="ac_pid" id="ac_pid" value="">
    <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="token" value="<?php echo $token; ?>">

    <div class="pg-anchor">
        <?php if (!$wmode) { ?>
        <div class="pg-anchor-in">
            <ul class="nav nav-tabs">
                <?php foreach ($pg_anchor as $ac_id => $ac_name) { ?>
                <li role="presentation">
                    <a href="javascript:;" class="anchor-menu anchor-menu-link <?php echo $ac_id; ?>" id="<?php echo $ac_id; ?>"><?php echo $ac_name; ?></a>
                </li>
                <?php } ?>
                <li role="presentation">
                    <a href="<?php echo G5_ADMIN_URL."?dir=board&amp;pid=board_extend&amp;bo_table={$bo_table}"; ?>" class="anchor-menu active" id="eyoom_extend_tab">확장필드</a>
                </li>
                <li role="presentation">
                    <a href="<?php echo G5_ADMIN_URL."?dir=board&amp;pid=board_addon&amp;bo_table={$bo_table}"; ?>" class="anchor-menu" id="eyoom_extend_tab">확장기능</a>
                </li>
            </ul>
            <div class="tab-bottom-line"></div>
        </div>
        <?php } ?>
    </div>

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>게시판 확장필드</strong></div>
        <div class="adm-form-info">
            <div class="cont-text-bg">
                <p class="bg-info">
                    <i class="fas fa-info-circle"></i> 이윰 확장필드는 그누보드의 기본 여분필드인 wr_1 ~ wr_10 여분필드와는 별개로 작동합니다.<br>
                    <i class="fas fa-info-circle"></i> <?php echo EYOOM_EXBOARD_PREFIX; ?>1 ~ <?php echo EYOOM_EXBOARD_PREFIX; ?><strong>숫자</strong> 확장필드를 원하시는 만큼 생성하여 게시판에 활용하여 다양한 게시판 스킨을 개발하실 수 있습니다.
                </p>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label class="label">현재 확장 필드수</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input state-disabled max-width-250px">
                        <i class="icon-append">개</i>
                        <input type="text" name="bo_ex_cnt" id="bo_ex_cnt" value="<?php echo $board['bo_ex_cnt']; ?>" readonly>
                    </label>
                    <div class="note"><strong>Note:</strong> 현재 추가된 확장필드의 개수입니다.</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="bo_exadd" class="label">확장필드 일괄 추가하기</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append">개</i>
                        <input type="text" name="bo_exadd" id="bo_exadd" value="" required>
                    </label>
                    <div class="note"><strong>Note:</strong> 한꺼번에 여러개의 확장필드를 추가할 때 사용합니다. 일괄 추가후, 아래 리스트에서 설정을 변경하실 수 있습니다.</div>
                </div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit;?>
    </div>

    </form>
    <div class="m-b-20"></div>

    <div class="adm-headline">
        <h3>[ <span class="text-crimson"><?php echo $board['bo_subject']; ?></span> ] 확장필드 아이템 리스트</h3>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&pid=board_exform&amp;bo_table=<?php echo $bo_table; ?>&amp;wmode=1" class="btn-e btn-e-md btn-e-crimson adm-headline-btn" onclick="exboard_modal(this.href, '확장필드 설정 관리'); return false;"><i class="las la-plus m-r-7"></i><span>확장필드 추가하기</span></a>
    </div>

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
                        <th class="width-60px">관리</th>
                        <th>코드복사</th>
                        <th>필드명</th>
                        <th>타이틀</th>
                        <th>폼타입</th>
                        <th>필드종류</th>
                        <th>검색사용</th>
                        <th>필수여부</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th>
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="chk[]" id="chk_<?php echo $i; ?>" value="<?php echo $i; ?>"><i></i>
                            </label>
                            <input type="hidden" name="ex_no[<?php echo $i; ?>]" value="<?php echo $list[$i]['ex_no']; ?>">
                            <input type="hidden" name="board_table[<?php echo $i; ?>]" value="<?php echo $list[$i]['bo_table']; ?>">
                        </th>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_exform&amp;bo_table=<?php echo $bo_table; ?>&amp;ex_no=<?php echo $list[$i]['ex_no']; ?>&amp;w=u&amp;wmode=1" onclick="exboard_modal(this.href,'확장필드 설정 수정'); return false;"><u>수정</u></a>
                        </td>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_excode&amp;bo_table=<?php echo $bo_table; ?>&amp;ex_no=<?php echo $list[$i]['ex_no']; ?>&amp;wmode=1" onclick="exboard_modal(this.href,'코드복사하기'); return false;" class="btn-e btn-e-sm btn-e-dark">코드보기</a>
                        </td>
                        <td class="text-center">
                            <strong><?php echo $list[$i]['ex_fname']; ?></strong>
                            <input type="hidden" name="ex_fname[<?php echo $i; ?>]" value="<?php echo $list[$i]['ex_fname']; ?>">
                        </td>
                        <td>
                            <label for="ex_subject" class="input width-250px"><input type="text" name="ex_subject[<?php echo $i; ?>]" id="ex_subject_<?php echo $i; ?>" value="<?php echo get_text($list[$i]['ex_subject']); ?>"></label>
                        </td>
                        <td><?php echo $list[$i]['form']; ?></td>
                        <td>
                            <?php echo $list[$i]['ex_type']; ?> <?php if ($list[$i]['ex_length'] && $list[$i]['ex_type'] != 'text') { echo '('. $list[$i]['ex_length'].')'; } ?>
                        </td>
                        <td>
                            <label class="checkbox adm-table-check" for="ex_use_search_<?php echo $i; ?>"><input type="checkbox" name="ex_use_search[<?php echo $i; ?>]" id="ex_use_search_<?php echo $i; ?>" value="y" <?php echo $list[$i]['ex_use_search'] == 'y' ? 'checked':''; ?>><i></i></label>
                        </td>
                        <td>
                            <label class="checkbox adm-table-check" for="ex_required_<?php echo $i; ?>"><input type="checkbox" name="ex_required[<?php echo $i; ?>]" id="ex_required_<?php echo $i; ?>" value="y" <?php echo $list[$i]['ex_required'] == 'y' ? 'checked':''; ?>><i></i></label>
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

    <div class="text-start">
        <input type="submit" name="act_button" value="선택수정" class="btn-e btn-e-xs btn-e-crimson" onclick="document.pressed=this.value">
        <?php if ($is_admin == 'super') { ?>
        <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
        <?php } ?>
    </div>

    </form>
</div>

<div class="modal fade exboard-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal-title" class="modal-title f-w-700">확장필드 설정 관리</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <iframe id="exboard-iframe" width="100%" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-e btn-e-lg btn-e-dark" data-bs-dismiss="modal">닫기<i class="fas fa-times m-l-5"></i></button>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    $(".anchor-menu-link").on("click", function() {
        var ac_id = $(this).attr('id');
        var f = document.fexboardform;
        var url = "<?php echo G5_ADMIN_URL; ?>/?dir=board&pid=board_form&bo_table=<?php echo $bo_table; ?>&w=u";
        f.ac_pid.value = ac_id;
        f.action = url;
        f.submit();
    });
});

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