<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/board/boardgroupmember_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'boardgroup_list';
$g5_title = '게시판그룹관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">게시판관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';

$frm_eba_submit  = ' <div class="confirm-fixed-btn"> ';
$frm_eba_submit .= ' <input type="submit" value="적용하기" class="btn-e btn-e-md btn-e-crimson" accesskey="s">' ;
$frm_eba_submit .= '</div>';
$frm_submit .= $frm_eba_submit;
?>

<div class="admin-boardgroupmember-form">
    <form name="fboardgroupmember_form" id="fboardgroupmember_form" action="<?php echo $action_url1; ?>" onsubmit="return boardgroupmember_form_check(this)" method="post" class="eyoom-form">
    <input type="hidden" name="mb_id" value="<?php echo $mb['mb_id'] ?>" id="mb_id">
    <input type="hidden" name="token" value="" id="token">

    <div class="adm-form-table">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>접근가능그룹</strong></div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label class="label">회원정보</label>
                </div>
                <div class="adm-form-td td-r">
                    <p class="li-p-sq">아이디 : <?php echo $mb['mb_id'] ?></p>
                    <p class="li-p-sq">이름 : <?php echo get_text($mb['mb_name']); ?></p>
                    <p class="li-p-sq">닉네임 : <?php echo $mb['mb_nick'] ?></p>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label class="label">그룹지정</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <span>
                            <label class="select max-width-200px">
                                <select name="gr_id" id="gr_id">
                                    <option value="">접근가능 그룹을 선택하세요.</option>
                                    <?php for ($i=0; $i<count((array)$grlist); $i++) { ?>
                                    <option value="<?php echo $grlist[$i]['gr_id']; ?>"><?php echo $grlist[$i]['gr_subject']; ?></option>
                                    <?php } ?>
                                </select><i></i>
                            </label>
                        </span>
                        <span>
                            <input type="submit" value="선택" class="btn-e btn-e-lg btn-e-dark" accesskey="s">
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </form>
    <div class="m-b-20"></div>

    <form name="fboardgroupmember" id="fboardgroupmember" action="<?php echo $action_url1; ?>" method="post" onsubmit="return fboardgroupmember_submit(this);" class="eyoom-form">
    <input type="hidden" name="sst" value="<?php echo $sst ?>" id="sst">
    <input type="hidden" name="sod" value="<?php echo $sod ?>" id="sod">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>" id="sfl">
    <input type="hidden" name="stx" value="<?php echo $stx ?>" id="stx">
    <input type="hidden" name="page" value="<?php echo $page ?>" id="page">
    <input type="hidden" name="token" value="<?php echo $token ?>" id="token">
    <input type="hidden" name="mb_id" value="<?php echo $mb['mb_id'] ?>" id="mb_id">
    <input type="hidden" name="w" value="d" id="w">

    <div class="m-b-5 f-s-13r">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="m-l-10 m-r-10 text-light-gray">|</span>전체그룹 <?php echo number_format($total_count); ?>개
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
                        <th>그룹아이디</th>
                        <th>그룹</th>
                        <th>처리일시</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th>
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="chk[]" id="chk_<?php echo $i; ?>" value="<?php echo $list[$i]['gm_id'] ?>"><i></i>
                            </label>
                        </th>
                        <td class="text-center"><a href="<?php echo get_eyoom_pretty_url(G5_GROUP_DIR, $list[$i]['gr_id']); ?>"><?php echo $list[$i]['gr_id']; ?></a></td>
                        <td class="text-center"><?php echo $list[$i]['gr_subject'] ?></td>
                        <td class="text-center"><?php echo $list[$i]['gm_datetime'] ?></td>
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
</div>

<script>
function fboardgroupmember_submit(f) {
    if (!is_checked("chk[]")) {
        alert("선택삭제 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    return true;
}

function boardgroupmember_form_check(f) {
    if (f.gr_id.value == '') {
        alert('접근가능 그룹을 선택하세요.');
        return false;
    }

    return true;
}
</script>