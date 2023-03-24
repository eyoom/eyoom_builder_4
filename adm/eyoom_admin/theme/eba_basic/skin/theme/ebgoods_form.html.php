<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/theme/ebgoods_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'ebgoods_list';
$g5_title = 'EB상품추출관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">테마설정관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-ebgoods-form">
    <?php include_once(EYOOM_ADMIN_THEME_PATH . '/skin/theme/theme_head.html.php'); ?>

    <div class="adm-headline">
        <h3>EB상품 - 마스터 관리</h3>
    </div>

    <form name="febgoodsform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return febgoodsform_submit(this);" enctype="multipart/form-data" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="theme" id="theme" value="<?php echo $this_theme; ?>">
    <input type="hidden" name="eg_no" id="eg_no" value="<?php echo $eg['eg_no']; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>EB상품 마스터 설정정보</strong></div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">코드</label>
            </div>
            <div class="adm-form-td td-r">
                <label for="eg_code" class="input max-width-250px">
                    <input type="text" name="eg_code" id="eg_code" value="<?php echo $eg['eg_code'] ? $eg['eg_code']: time(); ?>" readonly required>
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
                        <div id="substitution_code" class="eb-clipboard-box-cont"><strong>&lt;?php echo eb_goods('<?php echo $eg['eg_code'] ? $eg['eg_code']: time(); ?>'); ?&gt;</strong></div>
                        <div class="eb-clipboard-box-btn" data-clipboard-target="#substitution_code">치환코드 복사</div>
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
                        <label for="eg_state_1" class="radio"><input type="radio" name="eg_state" id="eg_state_1" value="1" <?php echo $eg['eg_state'] == '1' || !$eg['eg_state'] ? 'checked':''; ?>><i></i> 보이기</label>
                        <label for="eg_state_2" class="radio"><input type="radio" name="eg_state" id="eg_state_2" value="2" <?php echo $eg['eg_state'] == '2' ? 'checked':''; ?>><i></i> 숨기기</label>
                    </div>
                    <div class="note"><strong>Note:</strong> 출력여부를 결정합니다.</div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="eg_subject" class="label">상품마스터 제목</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="eg_subject" id="eg_subject" value="<?php echo get_text($eg['eg_subject']); ?>" required>
                    </label>
                    <div class="note"><strong>Note:</strong> 예) 메인 상품, 메인 제품소개 상품...</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="eg_skin" class="label">상품마스터 스킨</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="select max-width-250px">
                        <select name="eg_skin" id="eg_skin">
                            <option value="">::선택::</option>
                            <?php foreach ($ebgoods_skins as $eb_skin) { ?>
                            <option value="<?php echo $eb_skin; ?>" <?php echo get_selected($eg['eg_skin'], $eb_skin); ?>><?php echo $eb_skin; ?></option>
                            <?php } ?>
                        </select><i></i>
                    </label>
                    <div class="note"><strong>Note:</strong> EB상품 마스터에 적용할 스킨을 선택해 주세요.</div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label class="label">대표 연결주소 [링크]</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="select width-150px m-b-10">
                    <select name="eg_target" id="eg_target">
                        <option value="">타겟을 선택하세요.</option>
                        <option value="_blank" <?php echo $eg['eg_target'] == '_blank' ? 'selected':''; ?>>새창</option>
                        <option value="_self" <?php echo $eg['eg_target'] == '_self' ? 'selected':''; ?>>현재창</option>
                    </select><i></i>
                </label>
                <label class="input">
                    <i class="icon-append fas fa-link"></i>
                    <input type="text" name="eg_link" id="eg_link" value="<?php echo $eg['eg_link']; ?>">
                </label>
                <div class="note"><strong>Note:</strong> EB상품 마스터에서 사용할 링크주소를 입력해 주세요. 예) <?php echo G5_URL; ?></div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit;?>
    </div>

    </form>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/clipboard/clipboard.min.js"></script>
<script>
function febgoodsform_submit(f) {
    if (f.eg_code.value == '') {
        alert("코드는 자동생성되며 빈값을 입력하실 수 없습니다.");
        document.location.reload();
        return false;
    }
    if (f.eg_subject.value.length < 2) {
        alert("상품 마스터의 제목을 2자이상으로 입력해 주세요.");
        f.eg_subject.focus();
        return false;
    }
    if (!f.eg_skin.value) {
        alert("상품 마스터의 스킨을 선택해 주세요.");
        f.eg_skin.focus();
        return false;
    }
    return true;
}

new Clipboard('.eb-clipboard-box-btn');
</script>

<?php if ($w == 'u' && $eg_code) { ?>
<div class="admin-ebgoods-itemlist m-t-20">
    <div class="adm-headline">
        <h3>EB상품 - 아이템 관리</h3>
        <?php if (!$wmode) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=ebgoods_itemform&amp;eg_code=<?php echo $eg['eg_code']; ?>&amp;thema=<?php echo $this_theme; ?>&amp;wmode=1" onclick="eb_modal(this.href, 'EB상품 아이템'); return false;" class="btn-e btn-e-md btn-e-crimson adm-headline-btn"><i class="las la-plus m-r-7"></i><span>EB상품 아이템 추가</span></a>
        <?php } ?>
    </div>

    <form name="febgoodsitemlist" id="febgoodsitemlist" action="<?php echo $action_url2; ?>" method="post" onsubmit="return febgoodsitemlist_submit(this);" class="eyoom-form">
    <input type="hidden" name="theme" id="theme" value="<?php echo $this_theme; ?>">
    <input type="hidden" name="eg_code" id="eg_code" value="<?php echo $eg['eg_code']; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="token" value="<?php echo $token; ?>">

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
                        <th>타이틀</th>
                        <th>순서</th>
                        <th>상태</th>
                        <th>보기권한</th>
                        <th>대상카테고리</th>
                        <th>출력상품수</th>
                        <th>등록일</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<$count; $i++) { ?>
                    <tr>
                        <th>
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="chk[]" id="chk_<?php echo $i; ?>" value="<?php echo $i; ?>"><i></i>
                            </label>
                            <input type="hidden" name="gi_no[<?php echo $i; ?>]" value="<?php echo $list[$i]['gi_no']; ?>">
                        </th>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebgoods_itemform&amp;eg_code=<?php echo $list[$i]['eg_code']; ?>&amp;gi_no=<?php echo $list[$i]['gi_no']; ?>&amp;w=u&amp;iw=u&amp;page=<?php echo $page; ?>&amp;wmode=1" onclick="eb_modal(this.href, 'EB상품 아이템관리'); return false;"><u>수정</u></a>
                        </td>
                        <td>
                            <?php echo $list[$i]['gi_title'] ? get_text($list[$i]['gi_title']):'없음'; ?>
                        </td>
                        <td>
                            <label class="input width-100px"><input type="text" name="gi_sort[<?php echo $i; ?>]" id="gi_sort_<?php echo $i; ?>" value="<?php echo $list[$i]['gi_sort']; ?>"></label>
                        </td>
                        <td>
                            <label class="select width-150px"><select name="gi_state[<?php echo $i; ?>]" id="gi_state_<?php echo $i; ?>"><option value="">선택</option><option value="1" <?php echo $list[$i]['gi_state'] == '1' ? 'selected':''; ?>>보이기</option><option value="2" <?php echo $list[$i]['gi_state'] == '2' ? 'selected': ''; ?>>숨기기</option></select><i></i></label>
                        </td>
                        <td>
                            <label class="select width-100px"><?php echo $list[$i]['view_level']; ?><i></i></label>
                        </td>
                        <td class="text-center">
                            <?php echo $list[$i]['gi_ca_ids'] ? $list[$i]['gi_ca_ids']: '전체상품'; ?>
                        </td>
                        <td class="text-center"><?php echo $list[$i]['gi_count']; ?></td>
                        <td class="text-center"><?php echo substr($list[$i]['gi_regdt'], 0, 10); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if($count == 0) { ?>
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

function febgoodsitemlist_submit(f) {
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