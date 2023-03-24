<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/somoim/somo_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'somo_list';
$g5_title = '정식 소모임 리스트';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">소모임관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-somo-list">
    <form id="fsearch" name="fsearch" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">

    <div class="adm-headline">
        <h3>소모임 리스트</h3>
        <?php if (!$wmode && 0) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=somoim&amp;pid=somo_form" class="btn-e btn-e-md btn-e-crimson adm-headline-btn"><i class="las la-plus m-r-7"></i><span>소모임 추가</span></a>
        <?php } ?>
    </div>
    
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
                        <div class="inline-group">
                            <span>
                                <label class="select width-100px">
                                    <select name="sfl" id="sfl">
                                        <option value="sm_subject"<?php echo get_selected($sfl, "sm_subject"); ?>>제목</option>
                                        <option value="sm_id"<?php echo get_selected($sfl, "sm_id"); ?>>소모임ID</option>
                                        <option value="sm_admin"<?php echo get_selected($sfl, "sm_admin"); ?>>소모임관리자</option>
                                    </select><i></i>
                                </label>
                            </span>
                            <span>
                                <label class="input max-width-250px">
                                    <input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" autocomplete="off">
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr tr-r">
                    <div class="adm-form-td td-l">
                        <label class="label">카테고리</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select id="smc" name="smc">
                                <option value=''>선택하세요</option>
                                <?php
                                foreach($sm_category as $key=>$value) {
                                    $selected = $value == $smc ? 'selected': '';
                                    echo '<option value="'.$value.'" '.$selected.'>'.$value.'</option>';
                                }
                                ?>
                            </select><i></i>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="confirm-bottom-btn">
            <?php echo $frm_submit;?>
        </div>
    </div>

    </form>

    <form name="fsomolist" id="fsomolist" action="<?php echo $action_url1; ?>" method="post" onsubmit="return fsomolist_submit(this);" class="eyoom-form">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="<?php echo $token; ?>">

    <div class="f-s-13r m-b-5">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="m-l-10 m-r-10 text-light-gray">|</span>전체 소모임 <?php echo number_format($total_count); ?>개
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
                        <th class="width-60px">관리</th>
                        <th>소모임아이디</th>
                        <th>소모임관리자</th>
                        <th>제목</th>
                        <th>카테고리</th>
                        <th>랭킹</th>
                        <th>공개여부</th>
                        <th>개설일</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count($list); $i++) { ?>
                    <tr>
                        <th>
                            <input type="hidden" name="sm_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['sm_id']; ?>">
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="chk[]" id="chk_<?php echo $i; ?>" value="<?php echo $i; ?>"><i></i>
                            </label>
                        </th>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=somoim&amp;pid=somo_form&amp;w=u&amp;sm_id=<?php echo $list[$i]['sm_id']; ?>&amp;<?php echo $qstr; ?>"><u>수정</u></a>
                        </td>
                        <td class="text-center">
                            <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=<?php echo $list[$i]['sm_id']; ?>" target="_blank"><u><?php echo $list[$i]['sm_id']; ?></u></a>
                        </td>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=member_form&mb_id=<?php echo $list[$i]['sm_admin'];; ?>&w=u&amp;wmode=1" onclick="eb_modal(this.href); return false;"><u><?php echo $list[$i]['sm_admin']; ?></u></a>
                        </td>
                        <td>
                            <label class="input width-200px"><input type="text" name="sm_subject[<?php echo $i; ?>]" id="sm_subject_<?php echo $i; ?>" value="<?php echo get_text($list[$i]['sm_subject']); ?>" required></label>
                        </td>
                        <td class="text-center"><?php echo $list[$i]['sm_category']; ?></td>
                        <td class="text-center">
                            <strong class="text-crimson"><?php echo $list[$i]['sm_ranking']; ?></strong>
                        </td>
                        <td class="text-center">
                            <label class="select width-150px"><select name="sm_open[<?php echo $i; ?>]"><option value="y" <?php echo $list[$i]['sm_open'] == 'y' ? 'selected': ''; ?>>보이기</option><option value="n" <?php echo $list[$i]['sm_open'] == 'n' ? 'selected': ''; ?>>숨기기</option></select><i></i></label>
                        </td>
                        <td class="text-center"><?php echo $list[$i]['sm_regdt']; ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(count($list) == 0) { ?>
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
        <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
    </div>

    </form>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>
</div>

<div class="modal fade admin-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-700">회원 정보</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <iframe id="modal-iframe" width="100%" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-e btn-e-lg btn-e-dark" data-bs-dismiss="modal">닫기<i class="fas fa-times m-l-5"></i></button>
            </div>
        </div>
    </div>
</div>

<script>
<?php if (!$wmode) { ?>
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

function fsomolist_submit(f) {
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