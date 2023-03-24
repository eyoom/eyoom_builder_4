<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/theme/ebgoods_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'ebgoods_list';
$g5_title = 'EB상품추출관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">테마설정관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-ebgoods-list">
    <?php include_once(EYOOM_ADMIN_THEME_PATH . '/skin/theme/theme_head.html.php'); ?>

    <div class="adm-headline">
        <h3>EB상품 - 마스터관리</h3>
        <?php if (!$wmode) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=ebgoods_form&amp;thema=<?php echo $this_theme; ?>" class="btn-e btn-e-md btn-e-crimson adm-headline-btn"><i class="las la-plus m-r-7"></i><span>EB상품 마스터추가</span></a>
        <?php } ?>
    </div>

    <form name="febgoodsform" id="febgoodslist" action="<?php echo $action_url1; ?>" method="post" onsubmit="return febgoodsform_submit(this);" class="eyoom-form">
    <input type="hidden" name="theme" value="<?php echo $this_theme; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="">

    <div class="f-s-13r m-b-5">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="m-l-10 m-r-10 text-light-gray">|</span>EB상품 마스터 <?php echo number_format($total_count); ?>개
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
                        <th>상품마스터제목</th>
                        <th>치환코드</th>
                        <th>상태</th>
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
                            <input type="hidden" name="eg_no[<?php echo $i; ?>]" value="<?php echo $list[$i]['eg_no']; ?>">
                            <input type="hidden" name="eg_code[<?php echo $i; ?>]" value="<?php echo $list[$i]['eg_code']; ?>">
                        </th>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebgoods_form&amp;thema=<?php echo $this_theme; ?>&amp;eg_code=<?php echo $list[$i]['eg_code']; ?>&amp;w=u"><u>수정</u></a>
                        </td>
                        <td><?php echo get_text($list[$i]['eg_subject']); ?></td>
                        <td>
                            <div class="eb-clipboard"><div id="subs_code_<?php echo $i; ?>" class="eb-clipboard-cont"><?php echo $list[$i]['eg_chg_code']; ?></div><div class="eb-clipboard-btn" data-clipboard-target="#subs_code_<?php echo $i; ?>">코드복사</div></div>
                        </td>
                        <td>
                            <label class="select width-200px"><select name="eg_state[<?php echo $i; ?>]" id="eg_state_<?php echo $i; ?>"><option value="">선택</option><option value="1" <?php echo  $list[$i]['eg_state'] == '1' ? 'selected':''; ?>>보이기</option><option value="2" <?php echo  $list[$i]['eg_state'] == '2' ? 'selected':''; ?>>숨기기</option></select><i></i></label>
                        </td>
                        <td class="text-center"><?php echo substr($list[$i]['eg_regdt'], 0, 10); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="6" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
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
    <?php echo eb_paging($eyoom['paging_skin']);?>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/clipboard/clipboard.min.js"></script>
<script>
function febgoodsform_submit(f) {
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

new Clipboard('.eb-clipboard-btn');
</script>