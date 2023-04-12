<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/theme/ebcontents_itemlist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<style>
.admin-ebcontents-itemlist .ebcontents-itemlist-image {width:150px;margin:0 auto}
</style>

<div class="admin-ebcontents-itemlist">
    <div class="adm-headline">
        <h3>EB콘텐츠 아이템 목록</h3>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=ebcontents_itemform&amp;ec_code=<?php echo $ec_code; ?>&amp;thema=<?php echo $this_theme; ?>&amp;wmode=1" class="btn-e btn-e-md btn-e-crimson adm-headline-btn"><i class="las la-plus m-r-7"></i><span>EB콘텐츠 아이템 추가</span></a>
    </div>

    <form name="febcontentsitemlist" id="febcontentsitemlist" action="<?php echo $action_url1; ?>" method="post" onsubmit="return febcontentsitemlist_submit(this);" class="eyoom-form">
    <input type="hidden" name="theme" id="theme" value="<?php echo $this_theme; ?>">
    <input type="hidden" name="ec_code" id="ec_code" value="<?php echo $ec_code; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="<?php echo $token; ?>">

    <blockquote class="hero m-b-20">
        <p>마스터코드 - <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebcontents_form&amp;thema=<?php echo $this_theme; ?>&amp;ec_code=<?php echo $ec_code; ?>&amp;w=u&amp;wmode=1" class="btn-e btn-e-dark m-l-10"><?php echo $ec_code; ?></a></p>
    </blockquote>

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
                        <th>텍스트필드</th>
                        <th>순서</th>
                        <th>상태</th>
                        <th>보기권한</th>
                        <th>시작일</th>
                        <th>종료일</th>
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
                            <input type="hidden" name="ci_no[<?php echo $i; ?>]" value="<?php echo $list[$i]['ci_no']; ?>">
                        </th>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebcontents_itemform&amp;thema=<?php echo $this_theme; ?>&amp;ec_code=<?php echo $list[$i]['ec_code']; ?>&amp;ci_no=<?php echo $list[$i]['ci_no']; ?>&amp;w=u&amp;iw=u&amp;page=<?php echo $page; ?>&amp;wmode=1" onclick="eb_modal(this.href, 'EB콘텐츠 아이템관리'); return false;""><u>수정</u></a>
                        </td>
                        <td><div class="ebcontents-itemlist-image"><?php echo $list[$i]['ci_image']; ?></div></td>
                        <td><?php echo $list[$i]['ci_subject_1'] ? get_text($list[$i]['ci_subject_1']):'없음'; ?></td>
                        <td>
                            <label class="input width-100px"><input type="text" name="ci_sort[<?php echo $i; ?>]" id="ci_sort_<?php echo $i; ?>" value="<?php echo $list[$i]['ci_sort']; ?>"></label>
                        </td>
                        <td>
                            <label class="select width-150px"><select name="ci_state[<?php echo $i; ?>]" id="ci_state_<?php echo $i; ?>"><option value="">선택</option><option value="1" <?php echo $list[$i]['ci_state'] == '1' ? 'selected':''; ?>>보이기</option><option value="2" <?php echo $list[$i]['ci_state'] == '2' ? 'selected': ''; ?>>숨기기</option></select><i></i></label>
                        </td>
                        <td>
                            <label class="select width-100px"><?php echo $list[$i]['view_level']; ?><i></i></label>
                        </td>
                        <td class="text-center"><?php echo $list[$i]['ci_start'] ? date('Y-m-d',strtotime($list[$i]['ci_start'])):''; ?></td>
                        <td class="text-center"><?php echo $list[$i]['ci_end'] ? date('Y-m-d',strtotime($list[$i]['ci_end'])):''; ?></td>
                        <td class="text-center"><?php echo substr($list[$i]['ci_regdt'], 0, 10); ?></td>
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
</div>

<div class="modal fade admin-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-700"></h5>
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
function eb_modal(href, title) {
    $('.admin-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#modal-iframe").attr("src", "");
        $(".modal-title").text("");
        $('html').css({overflow: ''});
    });
    $('.admin-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#modal-iframe").attr("src", href);
        $('#modal-iframe').height(parseInt($(window).height() * 0.85));
        $(".modal-title").text(title);
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

window.closeModal = function(){
    $('.admin-iframe-modal').modal('hide');
};
<?php } ?>

function popup_sel_skin() {
    var url =  "<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=ebcontents_skins&wmode=1";
    var name = 'ebcontents_skins';
    var opt = 'width=800, height=700';
    window.open(url, name, opt);
}

function febcontentsitemlist_submit(f) {
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

function check_all(f) {
    var chk = document.getElementsByName("chk[]");

    for (i=0; i<chk.length; i++)
        chk[i].checked = f.chkall.checked;
}
</script>