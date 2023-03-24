<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/theme/eblatest_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'eblatest_list';
$g5_title = 'EB최신글관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">테마설정관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-eblatest-form">
    <?php include_once(EYOOM_ADMIN_THEME_PATH . '/skin/theme/theme_head.html.php'); ?>

    <div class="adm-headline">
        <h3>EB최신글 마스터 관리</h3>
    </div>

    <form name="feblatestform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return feblatestform_submit(this);" enctype="multipart/form-data" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="theme" id="theme" value="<?php echo $this_theme ? $this_theme: $theme; ?>">
    <input type="hidden" name="el_no" id="el_no" value="<?php echo $el['el_no']; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>EB최신글 마스터 설정정보</strong></div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="el_code" class="label">코드</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="text" name="el_code" id="el_code" value="<?php echo $el['el_code'] ? $el['el_code']: time(); ?>" readonly required>
                </label>
                <div class="note"><strong>Note:</strong> 자동생성되며, 수정하실 수 없습니다.</div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l adm-sm-100">
                <div class="adm-form-td td-l">
                    <label class="label">치환코드</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="eb-clipboard-box">
                        <div id="substitution_code" class="eb-clipboard-box-cont"><strong>&lt;?php echo eb_latest('<?php echo $el['el_code'] ? $el['el_code']: time(); ?>'); ?&gt;</strong></div>
                        <div class="eb-clipboard-box-btn" data-clipboard-target="#substitution_code">치환코드복사</div>
                    </div>
                    <div class="note"><strong>Note:</strong> 치환코드를 복사하여 출력하고자 하는 위치에 붙여넣기 하세요.</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label class="label">출력여부</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <label for="el_state_1" class="radio"><input type="radio" name="el_state" id="el_state_1" value="1" <?php echo $el['el_state'] == '1' || !$el['el_state'] ? 'checked':''; ?>><i></i> 보이기</label>
                        <label for="el_state_2" class="radio"><input type="radio" name="el_state" id="el_state_2" value="2" <?php echo $el['el_state'] == '2' ? 'checked':''; ?>><i></i> 숨기기</label>
                    </div>
                    <div class="note"><strong>Note:</strong> 출력여부를 결정합니다.</div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l adm-sm-100">
                <div class="adm-form-td td-l">
                    <label for="el_subject" class="label">최신글마스터 제목</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="el_subject" id="el_subject" value="<?php echo get_text($el['el_subject']); ?>" required>
                    </label>
                    <div class="note"><strong>Note:</strong> 예) 메인 최신글, 메인 제품소개 최신글...</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="el_skin" class="label">최신글마스터 스킨</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="select max-width-250px">
                        <select name="el_skin" id="el_skin">
                            <option value="">::선택::</option>
                            <?php foreach ($eblatest_skins as $eb_skin) { ?>
                            <option value="<?php echo $eb_skin; ?>" <?php echo get_selected($el['el_skin'], $eb_skin); ?>><?php echo $eb_skin; ?></option>
                            <?php } ?>
                        </select><i></i>
                    </label>
                    <div class="note"><strong>Note:</strong> EB최신글 마스터에 적용할 스킨을 선택해 주세요.</div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l adm-sm-100">
                <div class="adm-form-td td-l">
                    <label for="el_cache" class="label">캐시 갱신 시간</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append">초</i>
                        <input type="text" name="el_cache" id="el_cache" value="<?php echo $el['el_cache'] ? $el['el_cache']: 0; ?>" class="text-end" required>
                    </label>
                    <div class="note"><strong>Note:</strong> 지정한 시간(초단위)을 주기로 최신글 캐시를 갱신합니다.<br> 캐시를 사용하지 않으려면 0으로 설정하면 됩니다.</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="el_new" class="label">새글 표시 시간</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append">시간</i>
                        <input type="text" name="el_new" id="el_new" value="<?php echo $el['el_new'] ? $el['el_new']: 24; ?>" class="text-end" required>
                    </label>
                    <div class="note"><strong>Note:</strong> 지정한 시간 이내에 작성된 글에 새글임을 강조합니다.</div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">대표 연결주소 [링크]</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="select width-150px m-b-10">
                    <select name="el_target" id="ec_target">
                        <option value="">타겟을 선택하세요.</option>
                        <option value="_blank" <?php echo $el['el_target'] == '_blank' ? 'selected':''; ?>>새창</option>
                        <option value="_self" <?php echo $el['el_target'] == '_self' ? 'selected':''; ?>>현재창</option>
                    </select><i></i>
                </label>
                <label class="input">
                    <i class="icon-append fas fa-link"></i>
                    <input type="text" name="el_link" id="el_link" value="<?php echo $el['el_link']; ?>">
                </label>
                <div class="note"><strong>Note:</strong> EB최신글 마스터에서 사용할 링크주소를 입력해 주세요. 예) <?php echo G5_URL; ?></div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit; ?>
    </div>

    </form>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/clipboard/clipboard.min.js"></script>
<script>
function feblatestform_submit(f) {
    if (f.el_code.value == '') {
        alert("코드는 자동생성되며 빈값을 입력하실 수 없습니다.");
        document.location.reload();
        return false;
    }
    if (f.el_subject.value.length < 2) {
        alert("최신글 마스터의 제목을 2자이상으로 입력해 주세요.");
        f.el_subject.focus();
        return false;
    }
    if (!f.el_skin.value) {
        alert("최신글 마스터의 스킨을 선택해 주세요.");
        f.el_skin.focus();
        return false;
    }
    return true;
}

new Clipboard('.eb-clipboard-box-btn');
</script>

<?php if ($w == 'u' && $el_code) { ?>
<div class="admin-eblatest-itemlist m-t-20">
    <form name="feblatestitemlist" id="feblatestitemlist" action="<?php echo $action_url2; ?>" method="post" onsubmit="return feblatestitemlist_submit(this);" class="eyoom-form">
    <input type="hidden" name="theme" id="theme" value="<?php echo $this_theme; ?>">
    <input type="hidden" name="el_code" id="el_code" value="<?php echo $el['el_code']; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="token" value="<?php echo $token; ?>">

    <div class="adm-headline adm-headline-btn">
        <h3>EB최신글 - 아이템 관리</h3>
        <?php if (!$wmode) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=eblatest_itemform&amp;el_code=<?php echo $el['el_code']; ?>&amp;thema=<?php echo $this_theme; ?>&amp;wmode=1" onclick="eb_modal(this.href, 'EB최신글 아이템'); return false;" class="btn-e btn-e-md btn-e-crimson adm-headline-btn"><i class="las la-plus m-r-7"></i><span>EB최신글 아이템 추가</span></a>
        <?php } ?>
    </div>

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="width-40px">
                            <label for="chkall" class="sound_only">전체선택</label>
                            <label class="checkbox adm-table-check"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all_img(this.form)"><i></i></label>
                        </th>
                        <th class="width-60px">관리</th>
                        <th>최신글제목</th>
                        <th>순서</th>
                        <th>상태</th>
                        <th>보기권한</th>
                        <th>대상게시판</th>
                        <th>게시물수</th>
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
                            <input type="hidden" name="li_no[<?php echo $i; ?>]" value="<?php echo $list[$i]['li_no']; ?>">
                        </th>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=eblatest_itemform&amp;thema=<?php echo $this_theme; ?>&amp;el_code=<?php echo $list[$i]['el_code']; ?>&amp;li_no=<?php echo $list[$i]['li_no']; ?>&amp;w=u&amp;iw=u&amp;page=<?php echo $page; ?>&amp;wmode=1" onclick="eb_modal(this.href, 'EB최신글 아이템관리'); return false;""><u>수정</u></a>
                        </td>
                        <td>
                            <?php echo $list[$i]['li_title'] ? get_text($list[$i]['li_title']):'없음'; ?>
                        </td>
                        <td>
                            <label class="input width-100px"><input type="text" name="li_sort[<?php echo $i; ?>]" id="li_sort_<?php echo $i; ?>" value="<?php echo $list[$i]['li_sort']; ?>"></label>
                        </td>
                        <td>
                            <label class="select width-150px"><select name="li_state[<?php echo $i; ?>]" id="li_state_<?php echo $i; ?>"><option value="">선택</option><option value="1" <?php echo $list[$i]['li_state'] == '1' ? 'selected':''; ?>>보이기</option><option value="2" <?php echo $list[$i]['li_state'] == '2' ? 'selected': ''; ?>>숨기기</option></select><i></i></label>
                        </td>
                        <td>
                            <label class="select width-100px"><?php echo $list[$i]['view_level']; ?><i></i></label>
                        </td>
                        <td class="text-center"><?php echo $list[$i]['li_tables']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['li_count']; ?></td>
                        <td class="text-center"><?php echo substr($list[$i]['li_regdt'], 0, 10); ?></td>
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

function feblatestitemlist_submit(f) {
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

function check_all_img(f)
{
    var chk = document.getElementsByName("chk[]");

    for (i=0; i<chk.length; i++)
        chk[i].checked = f.chkall.checked;
}

function close_modal_and_reload() {
    window.closeModal = function(){
        $('.admin-iframe-modal').modal('hide');
    };
    document.location.reload();
}
</script>
<?php } ?>