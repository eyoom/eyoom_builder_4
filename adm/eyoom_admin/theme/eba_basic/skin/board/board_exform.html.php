<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/board/board_exform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-exboard-form">
    <form name="fexboardform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fexboardform_submit(this);" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="ex_no" id="ex_no" value="<?php echo $exinfo['ex_no']; ?>">
    <input type="hidden" name="bo_table" value="<?php echo $board['bo_table']; ?>">
    <input type="hidden" name="bo_ex_cnt" value="<?php echo $board['bo_ex_cnt']; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-form-table m-b-20" id="exboard-config">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>확장필드 설정</strong></div>
        <div class="adm-form-cont">
            <div class="row">
                <div class="col-lg-4">
                    <section>
                        <label for="ex_fname" class="label">확장필드명</label>
                        <label class="input max-width-250px">
                            <input type="text" name="ex_fname" id="ex_fname" value="<?php echo $exinfo['ex_fname']; ?>" readonly>
                        </label>
                    </section>
                </div>
                <div class="col-lg-4">
                    <section>
                        <label for="ex_subject" class="label">필드명칭</label>
                        <label class="input max-width-250px">
                            <input type="text" name="ex_subject" id="ex_subject" value="<?php echo get_text($exinfo['ex_subject']); ?>" required>
                        </label>
                        <div class="note"><strong>Note:</strong> 예) 회사명, 담장자, 연락처, 핸드폰, 이메일</div>
                    </section>
                </div>
                <div class="col-lg-4">
                    <section>
                        <label for="ex_use_search" class="label">검색필드 적용</label>
                        <label class="checkbox"><input type="checkbox" name="ex_use_search" id="ex_use_search" value="y" <?php echo $exinfo['ex_use_search'] == 'y' ? 'checked':''; ?>><i></i>사용</label>
                        <div class="note"><strong>Note:</strong> 예) 사용시, 게시판 목록에서 검색항목으로 사용이 가능합니다.</div>
                    </section>
                </div>
            </div>
        </div>
        <div class="adm-form-cont">
            <div class="row">
                <div class="col-lg-4">
                    <section>
                        <label for="ex_form" class="label">폼타입</label>
                        <label class="select max-width-250px">
                            <select name="ex_form" id="ex_form">
                                <option value="">:: 선택 ::</option>
                                <option value="text" <?php echo $exinfo['ex_form'] == 'text' ? 'selected':''; ?>>&lt;input type='text' name='<?php echo $exinfo['ex_fname']; ?>'&gt;</option>
                                <option value="radio" <?php echo $exinfo['ex_form'] == 'radio' ? 'selected':''; ?>>&lt;input type='radio' name='<?php echo $exinfo['ex_fname']; ?>'&gt;</option>
                                <option value="checkbox" <?php echo $exinfo['ex_form'] == 'checkbox' ? 'selected':''; ?>>&lt;input type='checkbox' name='<?php echo $exinfo['ex_fname']; ?>[]'&gt;</option>
                                <option value="select" <?php echo $exinfo['ex_form'] == 'select' ? 'selected':''; ?>>&lt;select name='<?php echo $exinfo['ex_fname']; ?>'&gt;</option>
                                <option value="textarea" <?php echo $exinfo['ex_form'] == 'textarea' ? 'selected':''; ?>>&lt;textarea name='<?php echo $exinfo['ex_fname']; ?>'&gt;</option>
                                <option value="address" <?php echo $exinfo['ex_form'] == 'address' ? 'selected':''; ?>>&lt;address&gt;</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> address의 경우, 다음 우편번호검색 API와 자동으로 연동됩니다.</div>
                    </section>
                    <input type="hidden" name="ex_form_old" id="ex_form_old" value="<?php echo $exinfo['ex_form']; ?>">
                </div>
                <div class="col-lg-4">
                    <section>
                        <label for="ex_required" class="label">필수항목 여부</label>
                        <label class="checkbox"><input type="checkbox" name="ex_required" id="ex_required" value="y" <?php echo $exinfo['ex_required'] == 'y' ? 'checked': ''; ?>><i></i>필수</label>
                        <div class="note"><strong>Note:</strong> 예) 체크시, 필수항목으로 처리합니다.</div>
                    </section>
                </div>
            </div>
        </div>
        <div class="adm-form-cont ex_detail_info">
            <div class="row">
                <div class="col-lg-4">
                    <section>
                        <label class="label">필드종류</label>
                        <label for="ex_type" class="select max-width-250px">
                            <select name="ex_type" id="ex_type">
                                <option value="varchar" <?php echo !$exinfo['ex_type'] || $exinfo['ex_type'] == 'varchar' ? 'selected':''; ?>>varchar</option>
                                <option value="char" <?php echo $exinfo['ex_type'] == 'char' ? 'selected':''; ?>>char</option>
                                <option value="int" <?php echo $exinfo['ex_type'] == 'int' ? 'selected':''; ?>>int</option>
                                <option value="text" <?php echo $exinfo['ex_type'] == 'text' ? 'selected':''; ?>>text</option>
                            </select><i></i>
                        </label>
                    </section>
                    <input type="hidden" name="ex_type_old" id="ex_type_old" value="<?php echo $exinfo['ex_type']; ?>">
                </div>
                <div class="col-lg-4 ex_except_info">
                    <section>
                        <label class="label">길이</label>
                        <label for="ex_length" class="input max-width-250px">
                            <input type="text" name="ex_length" id="ex_length" value="<?php echo $exinfo['ex_length'] ? $exinfo['ex_length']: '255'; ?>" required>
                        </label>
                    </section>
                    <input type="hidden" name="ex_length_old" id="ex_length_old" value="<?php echo $exinfo['ex_length']; ?>">
                </div>
                <div class="col-lg-4 ex_except_info">
                    <section>
                        <label class="label">기본값</label>
                        <label for="ex_default" class="input max-width-250px">
                            <input type="text" name="ex_default" id="ex_default" value="<?php echo $exinfo['ex_default']; ?>">
                        </label>
                    </section>
                    <input type="hidden" name="ex_default_old" id="ex_default_old" value="<?php echo $exinfo['ex_default']; ?>">
                </div>
            </div>
        </div>
        <div class="adm-form-cont ex_item_info">
            <section>
                <label for="ex_item_value" class="label">아이템 항목</label>
                <label class="textarea">
                    <textarea name="ex_item_value" id="ex_item_value"><?php echo $exinfo['ex_item_value']; ?></textarea>
                </label>
                <div class="note"><strong>Note:</strong> 구분자(<strong class="text-crimson"> | </strong>)를 이용하여 항목을 입력해 주세요. 예) 예<strong class="ext-crimson">|</strong>아니오</div>
            </section>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit;?>
    </div>

    </form>
</div>

<script>
$(document).ready(function(){
    ex_detail_hide();
    <?php if ($exinfo['ex_no']) { ?>
    var ex_form = '<?php echo $exinfo['ex_form']; ?>';
    ex_detail_show(ex_form);
    <?php } ?>

    $("#ex_form").change(function(){
        var ftype = $(this).val();
        ex_detail_hide();
        ex_detail_show(ftype);
    });
});

function ex_detail_hide() {
    $(".ex_detail_info").hide();
    $(".ex_item_info").hide();
}

function ex_detail_show(t) {
    $(".ex_detail_info").show();
    $(".ex_except_info").show();
    switch(t) {
        case 'text': $("#ex_length").attr("required", true); break;
        case 'radio': $("#ex_length").attr("required", true); $(".ex_item_info").show(); break;
        case 'checkbox': $("#ex_length").attr("required", false); $(".ex_item_info").show(); break;
        case 'select': $("#ex_length").attr("required", true); $(".ex_item_info").show(); break;
        case 'textarea': $("#ex_length").attr("required", false); $(".ex_except_info").hide(); break;
        case 'address': $("#ex_length").attr("required", false); $(".ex_detail_info").hide(); break;
    }
}

function fexboardform_submit(f) {
    return true;
}
</script>