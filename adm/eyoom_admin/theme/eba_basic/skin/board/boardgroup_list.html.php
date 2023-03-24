<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/board/boardgroup_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'boardgroup_list';
$g5_title = '게시판그룹관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">게시판관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-boardgroup-list">
    <div class="adm-headline">
        <h3>게시판그룹 리스트</h3>
        <?php if (!$wmode) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=boardgroup_form" class="btn-e btn-e-md btn-e-crimson adm-headline-btn"><i class="las la-plus m-r-7"></i><span>게시판그룹 추가</span></a>
        <?php } ?>
    </div>

    <form id="fsearch" name="fsearch" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    
    <?php if (G5_IS_MOBILE) { ?>
    <a class="collapse-search-btn btn-e btn-e-sm btn-e-dark m-b-20" data-bs-toggle="collapse" href="#collapse-search-box"><i class="fas fa-search m-r-7"></i><span>검색 조건 열기</span></a>
    <?php } ?>
    <div id="collapse-search-box" class="<?php if (G5_IS_MOBILE) { ?>panel-collapse collapse<?php } ?> m-b-20">
        <div class="adm-form-table adm-search-box m-b-20">
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label class="label">검색어</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <span>
                            <label class="select width-150px">
                                <select name="sfl" id="sfl">
                                    <option value="gr_subject"<?php echo get_selected($sfl, "gr_subject"); ?>>제목</option>
                                    <option value="gr_id"<?php echo get_selected($sfl, "gr_id"); ?>>그룹ID</option>
                                    <option value="gr_admin"<?php echo get_selected($sfl, "gr_admin"); ?>>그룹관리자</option>
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
        </div>

        <div class="confirm-bottom-btn">
            <?php echo $frm_submit;?>
        </div>
    </div>

    </form>

    <form name="fboardgrouplist" id="fboardgrouplist" action="<?php echo $action_url1; ?>" method="post" onsubmit="return fboardgrouplist_submit(this);" class="eyoom-form">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="<?php echo $token; ?>">

    <div class="m-b-5 f-s-13r">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="m-l-10 m-r-10 text-light-gray">|</span>전체그룹 <?php echo number_format($total_count); ?>개
    </div>

    <p class="text-end f-s-13r m-b-5 text-gray">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

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
                        <th>그룹아이디</th>
                        <th>제목</th>
                        <th>그룹관리자</th>
                        <th>게시판</th>
                        <th>접근사용</th>
                        <th>접근회원수</th>
                        <th>출력순서</th>
                        <th>접속기기</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th>
                            <input type="hidden" name="group_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['gr_id']; ?>">
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="chk[]" id="chk_<?php echo $i; ?>" value="<?php echo $i; ?>"><i></i>
                            </label>
                        </th>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=boardgroup_form&amp;w=u&amp;gr_id=<?php echo $list[$i]['gr_id']; ?>&amp;<?php echo $qstr; ?>"><u>수정</u></a>
                        </td>
                        <td class="text-center">
                            <a href="<?php echo get_eyoom_pretty_url(G5_GROUP_DIR, $list[$i]['gr_id']); ?>" target="_blank"><?php echo $list[$i]['gr_id']; ?></a>
                        </td>
                        <td>
                            <label class="input width-250px"><input type="text" name="gr_subject[<?php echo $i; ?>]" id="gr_subject_<?php echo $i; ?>" value="<?php echo get_text($list[$i]['gr_subject']); ?>" required></label>
                        </td>
                        <td>
                            <?php if ($is_admin == 'super') { ?><label class="input width-250px"><input type="text" name="gr_admin[<?php echo $i; ?>]" id="gr_admin<?php echo $i; ?>" value="<?php echo get_sanitize_input($list[$i]['gr_admin']); ?>"></label><?php } else { ?><input type="hidden" name="gr_admin[<?php echo $i ?>]" value="<?php echo get_sanitize_input($row['gr_admin']); ?>"><?php echo get_text($row['gr_admin']); ?><?php } ?>
                        </td>
                        <td>
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_list&amp;sfl=a.gr_id&amp;stx=<?php echo $list[$i]['gr_id']; ?>"><?php echo $list[$i]['board_cnt']; ?></a>
                        </td>
                        <td>
                            <label class="checkbox adm-table-check"><input type="checkbox" name="gr_use_access[<?php echo $i; ?>]" id="gr_use_access_<?php echo $i; ?>" value="1" <?php echo $list[$i]['gr_use_access'] ? 'checked':''; ?>><i></i></label>
                        </td>
                        <td>
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=boardgroupmember_list&amp;gr_id=<?php echo $list[$i]['gr_id']; ?>"><?php echo $list[$i]['member_cnt']; ?></a>
                        </td>
                        <td>
                            <label class="input width-150px"><input type="text" name="gr_order[<?php echo $i; ?>]" id="gr_order_<?php echo $i; ?>" value="<?php echo $list[$i]['gr_order']; ?>"></label>
                        </td>
                        <td>
                            <label class="select width-150px"><select name="gr_device[<?php echo $i; ?>]" id="gr_device_<?php echo $i; ?>"><option value="both" <?php echo $list[$i]['gr_device']=='both' ? 'selected':''; ?>>모두</option><option value="pc" <?php echo $list[$i]['gr_device']=='pc' ? 'selected':''; ?>>PC</option><option value="mobile" <?php echo $list[$i]['gr_device']=='mobile' ? 'selected':''; ?>>모바일</option></select><i></i></label>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="10" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
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

    <?php /* 페이지 */ ?>
    <div class="m-b-20">
        <?php echo eb_paging($eyoom['paging_skin']);?>
    </div>

    <?php if (!$wmode) { ?>
    <div class="m-t-20">
        <div class="cont-text-bg">
            <p class="bg-info">
                <i class="fas fa-info-circle"></i> 접근사용 옵션을 설정하시면 관리자가 지정한 회원만 해당 그룹에 접근할 수 있습니다.<br>
                <i class="fas fa-info-circle"></i> 접근사용 옵션은 해당 그룹에 속한 모든 게시판에 적용됩니다.
            </p>
        </div>
    </div>
    <?php } ?>
</div>

<script>
function fboardgrouplist_submit(f) {
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