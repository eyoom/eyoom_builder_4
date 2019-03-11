<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/theme/ebcontents_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/magnific-popup/magnific-popup.min.css" type="text/css" media="screen">',0);
?>

<style>
.eb-clipboard-box {position:relative;overflow:hidden;border:1px solid #4052B5;background:#f7f8ff;text-align:center}
.eb-clipboard-box-cont {height:26px;line-height:26px;padding:0 10px}
.eb-clipboard-box-btn {height:26px;line-height:26px;cursor:pointer;color:#fff;background:#5C6BBF}
.eb-clipboard-box-btn:hover {background:#4052B5}
.admin-ebcontents-form .ec-skin-img {position:relative;overflow:hidden;width:100px;height:100px}
.admin-ebcontents-form .ebcontents-image {max-width:300px;background:#fafafa}
</style>

<div class="admin-ebcontents-form">
    <div class="adm-headline">
        <h3>EB콘텐츠 마스터 관리</h3>
        <?php if ($w == 'u') { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebcontents_itemlist&amp;thema=<?php echo $this_theme ? $this_theme: $theme; ?>&amp;ec_code=<?php echo $ec['ec_code']; ?>&amp;wmode=1" class="btn-e btn-e-dark btn-e-lg"><i class="fas fa-plus"></i> 아이템관리</a>
        <div class="clearfix"></div>
        <?php } ?>
    </div>

    <?php include_once(EYOOM_ADMIN_THEME_PATH . '/skin/theme/theme_head.html.php'); ?>

    <form name="febcontentsform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return febcontentsform_submit(this);" enctype="multipart/form-data" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="theme" id="theme" value="<?php echo $this_theme ? $this_theme: $theme; ?>">
    <input type="hidden" name="ec_no" id="ec_no" value="<?php echo $ec['ec_no']; ?>">
    <input type="hidden" name="me_id" id="me_id" value="<?php echo $ec['me_id'] ? $ec['me_id']: $_GET['me_id']; ?>">
    <input type="hidden" name="ec_sort" id="ec_sort" value="<?php echo $ec['ec_sort']; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-table-form-wrap margin-bottom-30">
        <header><strong><i class="fas fa-caret-right"></i> EB콘텐츠 마스터 설정정보</strong></header>

        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">코드</label>
                        </th>
                        <td colspan="3">
                            <label for="ec_code" class="input form-width-250px">
                                <input type="text" name="ec_code" id="ec_code" value="<?php echo $ec['ec_code'] ? $ec['ec_code']: time(); ?>" readonly required>
                            </label>
                            <div class="note"><strong>Note:</strong> 자동생성되며, 수정하실 수 없습니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">치환코드</label>
                        </th>
                        <td>
                            <div class="eb-clipboard-box">
                                <div id="substitution_code" class="eb-clipboard-box-cont"><strong>&lt;?php echo eb_contents('<?php echo $ec['ec_code'] ? $ec['ec_code']: time(); ?>'); ?&gt;</strong></div>
                                <div class="eb-clipboard-box-btn" data-clipboard-target="#substitution_code">치환코드복사</div>
                            </div>
                            <div class="note"><strong>Note:</strong> 치환코드를 복사하여 출력하고자 하는 위치에 붙여넣기 하세요.</div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">출력여부</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="ec_state_1" class="radio"><input type="radio" name="ec_state" id="ec_state_1" value="1" <?php echo $ec['ec_state'] == '1' || !$ec['ec_state'] ? 'checked':''; ?>><i></i> 보이기</label>
                                <label for="ec_state_2" class="radio"><input type="radio" name="ec_state" id="ec_state_2" value="2" <?php echo $ec['ec_state'] == '2' ? 'checked':''; ?>><i></i> 숨기기</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 출력여부를 결정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">EB콘텐츠 마스터 명칭</label>
                        </th>
                        <td colspan="3">
                            <label for="ec_name" class="input">
                                <input type="text" name="ec_name" id="ec_name" value="<?php echo get_text($ec['ec_name']); ?>" required>
                            </label>
                            <div class="note"><strong>Note:</strong> 예) 회사소개, CEO인사말, 메인 포트폴리오, etc</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">EB콘텐츠 마스터 스킨</label>
                        </th>
                        <td>
                            <button type="button" onclick="popup_sel_skin(); return false;" class="btn-e btn-e-red btn-e-lg width-150px">스킨 선택하기 <i class="far fa-check-square"></i></button>
                            <div class="margin-bottom-10"></div>
                            <div id="ec_skin_img" class="ec-skin-img">
                                <?php if ($ec['ec_skin_img']) { ?>
                                <img src="<?php echo $ec['ec_skin_img']; ?>" class="img-responsive" alt="">
                                <?php } ?>
                            </div>
                            <input type="hidden" name="ec_skin" id="ec_skin" value="<?php echo $ec['ec_skin'] ? $ec['ec_skin']: 'basic'; ?>">
                            <div class="note"><strong>Note:</strong> EB콘텐츠 마스터에 적용할 스킨을 선택해 주세요.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">EB콘텐츠 마스터 타이틀 #1</label>
                        </th>
                        <td colspan="3">
                            <label for="ec_subject_1" class="input">
                                <input type="text" name="ec_subject[]" id="ec_subject_1" value="<?php echo get_text($ec['ec_subject_1']); ?>">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">EB콘텐츠 마스터 타이틀 #2</label>
                        </th>
                        <td colspan="3">
                            <label for="ec_subject_2" class="input">
                                <input type="text" name="ec_subject[]" id="ec_subject_2" value="<?php echo get_text($ec['ec_subject_2']); ?>">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">EB콘텐츠 마스터 설명글 #1</label>
                        </th>
                        <td colspan="3">
                            <label for="ec_text_1" class="textarea">
                                <textarea name="ec_text[]" id="ec_text_1" style="height:80px;"><?php echo $ec['ec_text_1']; ?></textarea>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">EB콘텐츠 마스터 설명글 #2</label>
                        </th>
                        <td colspan="3">
                            <label for="ec_text_2" class="textarea">
                                <textarea name="ec_text[]" id="ec_text_2" style="height:80px;"><?php echo $ec['ec_text_2']; ?></textarea>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">콘텐츠아이템에서 사용할 링크수</label>
                        </th>
                        <td>
                            <label for="ec_link_cnt" class="input form-width-250px">
                                <i class="icon-append">개</i>
                                <input type="text" name="ec_link_cnt" id="ec_link_cnt" value="<?php echo $ec['ec_link_cnt'] ? $ec['ec_link_cnt']: 2; ?>" required maxlength="2">
                            </label>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">콘텐츠아이템에서 사용할 이미지수</label>
                        </th>
                        <td>
                            <label for="ec_image_cnt" class="input form-width-250px">
                                <i class="icon-append">개</i>
                                <input type="text" name="ec_image_cnt" id="ec_image_cnt" value="<?php echo $ec['ec_image_cnt'] ? $ec['ec_image_cnt']: 5; ?>" required maxlength="2">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">콘텐츠아이템에서 사용할 필드수</label>
                        </th>
                        <td colspan="3">
                            <label for="ec_ext_cnt" class="input form-width-250px">
                                <i class="icon-append">개</i>
                                <input type="text" name="ec_ext_cnt" id="ec_ext_cnt" value="<?php echo $ec['ec_ext_cnt'] ? $ec['ec_ext_cnt']: 3; ?>" required maxlength="2">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">대표 연결주소 [링크]</label>
                        </th>
                        <td colspan="3">
                            <div class="inline-group">
                                <span>
                                    <label for="ec_link" class="input form-width-350px">
                                        <i class="icon-prepend fas fa-link"></i>
                                        <input type="text" name="ec_link" id="ec_link" value="<?php echo $ec['ec_link']; ?>">
                                    </label>
                                </span>
                                <span>
                                    <label for="ec_target" class="select form-width-150px">
                                        <select name="ec_target" id="ec_target">
                                            <option value="">타겟을 선택하세요.</option>
                                            <option value="_blank" <?php echo $ec['ec_target'] == '_blank' ? 'selected':''; ?>>새창</option>
                                            <option value="_self" <?php echo $ec['ec_target'] == '_self' || !$ec['ec_target'] ? 'selected':''; ?>>현재창</option>
                                        </select><i></i>
                                    </label>
                                </span>
                            </div>
                            <div class="note"><strong>Note:</strong> EB콘텐츠 마스터에서 사용할 링크주소를 입력해 주세요. 예) <?php echo G5_URL; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">EB콘텐츠 마스터 이미지</label>
                        </th>
                        <td colspan="3">
                            <span class="input input-file form-width-350px">
                                <div class="button"><input type="file" name="ec_image" id="ec_image" onchange="this.parentNode.nextSibling.value = this.value">이미지파일 찾기</div><input type="text" readonly="">
                            </span>
                            <?php if ($ec['ec_image']) { ?>
                            <div class="ec_img_info">
                                <label for="ec_image_del" class="checkbox"><input type="checkbox" id="ec_image_del" name="ec_image_del" value="1"><i></i><?php echo $ec['ec_image']; ?> 파일삭제</label>
                                <input type="hidden" name="del_image_name" value="<?php echo $ec['ec_image']; ?>">
                                <div class="thumbnail ebcontents-image">
                                    <div class="thumb">
                                        <img src="<?php echo $ec['ec_img_url']; ?>" alt="">
                                        <div class="caption-overflow">
                                            <span>
                                                <a href="<?php echo $ec['ec_img_url']; ?>" class="btn-e btn-e-default btn-e-lg btn-e-brd"><i class="fas fa-plus color-white"></i></a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="note"><strong>Note:</strong> EB콘텐츠 마스터의 이미지를 업로드해 주세요.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">EB콘텐츠 마스터 첨부파일</label>
                        </th>
                        <td colspan="3">
                            <span class="input input-file form-width-350px">
                                <div class="button"><input type="file" name="ec_file" id="ec_file" onchange="this.parentNode.nextSibling.value = this.value">파일 찾기</div><input type="text" readonly="">
                            </span>
                            <?php if ($ec['ec_file']) { ?>
                            <div class="ec_file_info">
                                <label for="ec_file_del" class="checkbox"><input type="checkbox" id="ec_file_del" name="ec_file_del" value="1"><i></i><?php echo $ec['ec_filename']; ?> 파일삭제</label>
                                <input type="hidden" name="del_file_name" value="<?php echo $ec['ec_file']; ?>">
                            </div>
                            <?php } ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <?php if (!G5_IS_MOBILE) { ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php echo $frm_submit; ?>

    </form>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/clipboard/clipboard.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/magnific-popup/magnific-popup.min.js"></script>
<script>
function febcontentsform_submit(f) {
    if (f.ec_code.value == '') {
        alert("코드는 자동생성되며 빈값을 입력하실 수 없습니다.");
        document.location.reload();
        return false;
    }
    if (f.ec_subject.value.length < 2) {
        alert("콘텐츠 마스터의 제목을 2자이상으로 입력해 주세요.");
        f.ec_subject.focus();
        return false;
    }
    if (!f.ec_skin.value) {
        alert("콘텐츠 마스터의 스킨을 선택해 주세요.");
        f.ec_skin.focus();
        return false;
    }
    return true;
}

new Clipboard('.eb-clipboard-box-btn');

function popup_sel_skin() {
    var url =  "<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=ebcontents_skins&wmode=1";
    var name = 'ebcontents_skins';
    var opt = 'width=800, height=700';
    window.open(url, name, opt);
}

function set_skin(skin, img='') {
    var imgtag = '';
    $('#ec_skin').val(skin);
    
    if (img) {
        imgtag = '<img src="'+img+'" class="img-responsive">';
        $('#ec_skin_img').html(imgtag);
    }
}

$(document).ready(function() {
    $('.ebcontents-image').magnificPopup({
        delegate: 'a',
        type: 'image',
        tLoading: '로딩중...',
        mainClass: 'mfp-img-mobile',
        image: {
            tError: '이미지를 불러올수 없습니다.'
        }
    });
});
</script>