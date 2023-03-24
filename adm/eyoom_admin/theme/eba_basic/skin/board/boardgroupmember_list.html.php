<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/board/boardgroupmember_list.html.php
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
        <h3><?php echo $gr['gr_subject'].' 그룹 접근가능회원 (그룹아이디:'.$gr['gr_id'].')'; ?></h3>
    </div>

    <form id="fsearch" name="fsearch" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    <input type="hidden" name="gr_id" value="<?php echo $gr_id ?>">

    <div class="adm-form-table adm-search-box m-b-20">
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="stx" class="label">검색어</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <span>
                        <label class="select width-100px">
                            <select name="sfl" id="sfl">
                                    <option value="a.mb_id"<?php echo get_selected($_GET['sfl'], "a.mb_id") ?>>회원아이디</option>
                                </select><i></i>
                            </label>
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

    </form>
    <div class="m-b-20"></div>

    <form name="fboardgroupmember" id="fboardgroupmember" action="<?php echo $action_url1; ?>" method="post" onsubmit="return fboardgroupmember_submit(this);" class="eyoom-form">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="<?php echo $token ?>">
    <input type="hidden" name="gr_id" value="<?php echo $gr_id ?>">
    <input type="hidden" name="w" value="ld">

    <div class="m-b-5 f-s-13r">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="m-l-10 m-r-10 text-light-gray">|</span>전체 <?php echo number_format($total_count); ?>명
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
                        <th>그룹</th>
                        <th>회원아이디</th>
                        <th>이름</th>
                        <th>닉네임</th>
                        <th>최종접속</th>
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
                        <td class="text-center">
                            <?php if ($list[$i]['cnt']) { ?><a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=boardgroupmember_form&amp;mb_id=<?php echo $list[$i]['mb_id']; ?>"><?php echo $list[$i]['cnt']; ?></a><?php } ?>
                        </td>
                        <td class="text-center">
                            <a <?php if (!(G5_IS_MOBILE || $wmode)) { ?>href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=member_form&mb_id=<?php echo $list[$i]['mb_id'];; ?>&w=u&amp;wmode=1" onclick="eb_modal(this.href); return false;"<?php } else { ?>href="javascript:void(0);"<?php } ?> ><i class="fas fa-external-link-alt text-light-gray m-r-5 hidden-xs"></i><strong><?php echo $list[$i]['mb_id']; ?></strong></a>
                        </td>
                        <td class="text-center"><?php echo get_text($list[$i]['mb_name']); ?></td>
                        <td class="text-center">
                            <a <?php if (!(G5_IS_MOBILE || $wmode)) { ?>href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=member_form&mb_id=<?php echo $list[$i]['mb_id'];; ?>&w=u&amp;wmode=1" onclick="eb_modal(this.href); return false;"<?php } else { ?>href="javascript:void(0);"<?php } ?> ><?php echo $list[$i]['mb_nick']; ?></a>
                        </td>
                        <td class="text-center"><?php echo substr($list[$i]['mb_today_login'],2,8) ?></td>
                        <td class="text-center"><?php echo $list[$i]['gm_datetime'] ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="7" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
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

<div class="modal fade admin-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-700">회원 정보 수정</h5>
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

function fboardgroupmember_submit(f) {
    if (!is_checked("chk[]")) {
        alert("선택삭제 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    return true;
}
</script>