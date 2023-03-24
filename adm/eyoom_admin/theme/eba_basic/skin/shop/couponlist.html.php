<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shop/couponlist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'couponlist';
$g5_title = '쿠폰관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">쇼핑몰관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-shop-couponlist">
    <div class="adm-headline">
        <h3>쿠폰 리스트</h3>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=couponform" class="btn-e btn-e-md btn-e-crimson adm-headline-btn"><i class="las la-plus m-r-7"></i><span>쿠폰 등록</span></a>
    </div>

    <form id="fsearch" name="fsearch" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    <input type="hidden" name="sst" id="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" id="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">

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
                                    <option value="mb_id"<?php echo get_selected($sfl, "mb_id"); ?>>회원아이디</option>
                                    <option value="cp_subject"<?php echo get_selected($sfl, "cp_subject"); ?>>쿠폰이름</option>
                                    <option value="cp_id"<?php echo get_selected($sfl, "cp_id"); ?>>쿠폰코드</option>
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

    <div class="m-b-5">
        <div class="float-start f-s-13r">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="m-l-10 m-r-10 text-light-gray">|</span>등록된 쿠폰 <?php echo number_format($total_count); ?>건
        </div>
        <div class="float-end xs-float-start">
            <label for="sort_list" class="select width-200px">
                <select name="sort_list" id="sort_list" onchange="sorting_list(this.form, this.value);">
                    <option value="">:: 정렬방식선택 ::</option>
                    <option value="mb_id|asc" <?php echo $sst=='mb_id' && $sod == 'asc' ? 'selected':''; ?>>회원아이디 정방향 (↓)</option>
                    <option value="mb_id|desc" <?php echo $sst=='mb_id' && $sod == 'desc' ? 'selected':''; ?>>회원아이디 역방향 (↑) </option>
                    <option value="cp_end|asc" <?php echo $sst=='cp_end' && $sod == 'asc' ? 'selected':''; ?>>사용기간 정방향 (↓)</option>
                    <option value="cp_end|desc" <?php echo $sst=='cp_end' && $sod == 'desc' ? 'selected':''; ?>>사용기간 역방향 (↑) </option>
                </select><i></i>
            </label>
        </div>
        <div class="clearfix"></div>
    </div>

    </form>

    <form name="fcouponlist" method="post" action="<?php echo $action_url1; ?>" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="sca" value="<?php echo $sca; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">

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
                        <th>쿠폰종류</th>
                        <th>쿠폰코드</th>
                        <th>쿠폰이름</th>
                        <th>적용대상</th>
                        <th>회원아이디</th>
                        <th>사용기한</th>
                        <th>사용회수</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th>
                            <input type="hidden" name="cp_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['cp_id']; ?>" id="cp_id_<?php echo $i; ?>">
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="chk[]" id="chk_<?php echo $i; ?>" value="<?php echo $i; ?>"><i></i>
                            </label>
                        </th>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=couponform&amp;cp_id=<?php echo $list[$i]['cp_id']; ?>&amp;w=u<?php echo $qstr ? '&amp;'.$qstr:''; ?>"><u>수정</u></a>
                        </td>
                        <td class="text-center"><?php echo $list[$i]['cp_method']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['cp_id']; ?></td>
                        <td><?php echo $list[$i]['cp_subject']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['cp_target']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['mb_id']; ?></td>
                        <td class="text-center"><?php echo substr($list[$i]['cp_start'], 2, 8); ?> ~ <?php echo substr($list[$i]['cp_end'], 2, 8); ?></td>
                        <td class="text-center"><?php echo number_format($list[$i]['used_count']); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="8" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-start">
        <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
    </div>

    </form>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>
</div>

<script>
function sorting_list(f, str) {
    var sort = str.split('|');

    $("#sst").val(sort[0]);
    $("#sod").val(sort[1]);

    if (sort[0] && sort[1]) {
        f.submit();
    }
}

function fcouponlist_submit(f) {
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