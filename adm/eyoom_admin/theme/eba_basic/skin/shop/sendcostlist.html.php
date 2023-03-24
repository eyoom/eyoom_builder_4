<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/config/sendcostlist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'sendcostlist';
$g5_title = '추가배송비관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">쇼핑몰관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-shop-sendcostlist">
    <div class="adm-headline">
        <h3>추가배송비 내역</h3>
    </div>

    <form id="fsendcost" name="fsendcost" action="<?php echo $action_url1; ?>" method="post" onsubmit="return fsendcost_submit(this);" class="eyoom-form">
    <input type="hidden" name="w" value="d">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="">

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
                        <th>지역명</th>
                        <th>우편번호</th>
                        <th>추가배송비</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th>
                            <input type="hidden" name="sc_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['sc_id']; ?>"><label for="chk_<?php echo $i; ?>" class="checkbox">
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="chk[]" id="chk_<?php echo $i; ?>" value="<?php echo $i; ?>"><i></i>
                            </label>
                        </th>
                        <td class="text-center"><?php echo $list[$i]['sc_name']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['sc_zip1']; ?> ~ <?php echo $list[$i]['sc_zip2']; ?></td>
                        <td class="text-center"><?php echo number_format($list[$i]['sc_price']); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="4" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
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
    <div class="m-b-20">
        <?php echo eb_paging($eyoom['paging_skin']);?>
    </div>

    <form name="fsendcost2" id="fsendcost2" action="<?php echo $action_url1; ?>" method="post" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="token" value="">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>추가배송비 등록</strong></div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="sc_name" class="label">지역명</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="text" name="sc_name" id="sc_name" value="" required>
                </label>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="sc_zip1" class="label">우편번호 시작</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="sc_zip1" id="sc_zip1" value="" required>
                    </label>
                    <div class="note">
                        <strong>Note:</strong> (입력 예 : 01234)
                    </div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="sc_zip2" class="label">우편번호 끝</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="sc_zip2" id="sc_zip2" value="" required>
                    </label>
                    <div class="note">
                        <strong>Note:</strong> (입력 예 : 01234)
                    </div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="sc_price" class="label">추가배송비</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <i class="icon-append">원</i>
                    <input type="text" name="sc_price" id="sc_price" class="text-end" value="" required>
                </label>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit; ?>
    </div>

    </form>
</div>

<script>
function fsendcost_submit(f) {
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