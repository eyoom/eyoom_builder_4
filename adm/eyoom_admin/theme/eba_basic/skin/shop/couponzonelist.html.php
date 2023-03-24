<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shop/couponzonelist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'couponzonelist';
$g5_title = '쿠폰존관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">쇼핑몰관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-shop-couponzonelist">
    <div class="adm-headline">
        <h3>쿠폰존 쿠폰리스트</h3>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=couponzoneform" class="btn-e btn-e-md btn-e-crimson adm-headline-btn"><i class="las la-plus m-r-7"></i><span>쿠폰 추가</span></a>
    </div>

    <form id="fsearch" name="fsearch" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
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
                    <label class="input max-width-250px">
                        <input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" autocomplete="off">
                    </label>
                </div>
            </div>
        </div>

        <div class="confirm-bottom-btn">
            <?php echo $frm_submit;?>
        </div>
    </div>

    </form>

    <form name="fcouponzonelist" method="post" action="<?php echo $action_url1; ?>" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">

    <div class="f-s-13r m-b-5">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="m-l-10 m-r-10 text-light-gray">|</span>전체 <?php echo number_format($total_count); ?>개
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
                        <th>쿠폰이름</th>
                        <th>쿠폰종류</th>
                        <th>적용대상</th>
                        <th>쿠폰금액</th>
                        <th>쿠폰사용기한</th>
                        <th>다운로드</th>
                        <th>사용기한</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th>
                            <input type="hidden" name="cz_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['cz_id']; ?>" id="cz_id_<?php echo $i; ?>">
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="chk[]" id="chk_<?php echo $i; ?>" value="<?php echo $i; ?>"><i></i>
                            </label>
                        </th>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=couponzoneform&amp;cz_id=<?php echo $list[$i]['cz_id']; ?>&amp;w=u<?php echo $qstr ? '&amp;'.$qstr:''; ?>"><u>수정</u></a>
                        </td>
                        <td class="text-center"><?php echo $list[$i]['cz_subject']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['cz_type']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['cp_method']; ?></td>
                        <td class="text-right"><?php echo $list[$i]['cp_price']; ?></td>
                        <td class="text-center">다운로드 후 <?php echo $list[$i]['cz_period']; ?>일</td>
                        <td class="text-center"><?php echo number_format($list[$i]['cz_download']); ?></td>
                        <td class="text-center"><?php echo substr($list[$i]['cz_start'], 2, 8); ?> ~ <?php echo substr($list[$i]['cz_end'], 2, 8); ?></td>
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
</script>