<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shop/brandlist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'brandlist';
$g5_title = '브랜드관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">쇼핑몰관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<style>
.admin-shop-brandlist .brand-image {width:80px;margin:0 auto}
.admin-shop-brandlist .brand-image img {display:block;max-width:100%;height:auto}
</style>

<div class="admin-shop-brandlist">
    <div class="adm-headline">
        <h3>브랜드 관리</h3>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=brandform" class="btn-e btn-e-md btn-e-crimson adm-headline-btn"><i class="las la-plus m-r-7"></i><span>브랜드 등록</span></a>
    </div>

    <form id="flist" name="flist" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    <input type="hidden" name="sst" id="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" id="sod" value="<?php echo $sod; ?>">

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
                                    <option value="br_name" <?php echo get_selected($sfl, 'br_name'); ?>>브랜드명</option>
                                    <option value="br_code" <?php echo get_selected($sfl, 'br_code'); ?>>브랜드코드</option>
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

    <form name="fbrandlistupdate" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fbrandlist_submit(this);" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="sca" value="<?php echo $sca; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">

    <div class="m-b-5 f-s-13r">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="m-l-10 m-r-10 text-light-gray">|</span>등록된 브랜드 <?php echo number_format($total_count); ?>건
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
                        <th>이미지</th>
                        <th>브랜드코드</th>
                        <th>브랜드명</th>
                        <th>노출여부</th>
                        <th>순서</th>
                        <th>등록일</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th>
                            <input type="hidden" name="br_no[<?php echo $i; ?>]" value="<?php echo $list[$i]['br_no']; ?>" id="br_no_<?php echo $i; ?>">
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="chk[]" id="chk_<?php echo $i; ?>" value="<?php echo $i; ?>"><i></i>
                            </label>
                        </th>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=brandform&amp;br_no=<?php echo $list[$i]['br_no']; ?>&amp;w=u&amp;ca_id=<?php echo $list[$i]['ca_id']; ?><?php echo $qstr ? '&amp;'.$qstr:''; ?>"><u>수정</u></a>
                        </td>
                        <td class="text-center">
                            <div class="brand-image"><?php if ($list[$i]['img_url']) { ?><img src="<?php echo $list[$i]['img_url']; ?>" class="img-fluid"><?php } ?></div>
                        </td>
                        <td class="text-center">
                            <a href="<?php echo G5_SHOP_URL; ?>/brand.php?br_cd=<?php echo $list[$i]['br_code']; ?>" target="_blank"><u><?php echo $list[$i]['br_code']; ?></u></a>
                        </td>
                        <td>
                            <label class="input width-200px"><input type="text" name="br_name[<?php echo $i; ?>]" id="br_name_<?php echo $i; ?>" value="<?php echo get_text($list[$i]['br_name']); ?>" required></label>
                        </td>
                        <td>
                            <div class="inline-group"><label for="br_open_<?php echo $i; ?>_y" class="radio"><input type="radio" name="br_open[<?php echo $i; ?>]" id="br_open_<?php echo $i; ?>_y" value="y" <?php echo $list[$i]['br_open']=='y' ? 'checked': ''; ?>><i></i> 예</label><label for="br_open_<?php echo $i; ?>_n" class="radio"><input type="radio" name="br_open[<?php echo $i; ?>]" id="br_open_<?php echo $i; ?>_n" value="n" <?php echo $list[$i]['br_open']=='n' ? 'checked': ''; ?>><i></i> 아니오</label></div>
                        </td>
                        <td>
                            <label class="input width-100px"><input type="text" name="br_sort[<?php echo $i; ?>]" id="br_sort_<?php echo $i; ?>" value="<?php echo $list[$i]['br_sort']; ?>"></label>
                        </td>
                        <td class="text-center">
                            <?php echo date("Y-m-d", strtotime($list[$i]['br_regdt'])); ?>
                        </td>
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

    <?php if(!$wmode) { ?>
    <div class="text-start">
        <input type="submit" name="act_button" value="선택수정" class="btn-e btn-e-xs btn-e-crimson" onclick="document.pressed=this.value">
        <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
    </div>
    <?php } ?>

    </form>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>
</div>

<script>
function fbrandlist_submit(f)
{
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

function fsearchform_submit(num) {
    var f = document.flist;
    var number = parseInt(num)+1;
    
    for (var i=number; i<=4; i++) {
        $("#cate_"+number).val('');
    }
    f.submit();
}

function del_confirm() {
    if(confirm('정말로 선택한 브랜드을 삭제하시겠습니까?')) {
        return true;
    } else {
        return false;
    }
}
</script>