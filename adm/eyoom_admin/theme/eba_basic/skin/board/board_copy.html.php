<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/board/board_copy.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<script src="<?php echo G5_ADMIN_URL ?>/admin.js?ver=<?php echo G5_JS_VER; ?>"></script>

<div class="admin-board-copy">
    <form name="fboardcopy" id="fboardcopy" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fboardcopy_check(this)" class="eyoom-form">
    <input type="hidden" name="bo_table" id="bo_table" value="<?php echo $bo_table; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-form-table adm-search-box m-b-20">
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">원본 테이블명</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="text" value="<?php echo $bo_table; ?>" disabled>
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="target_table" class="label">복사 테이블명<strong class="sound_only">필수</strong></label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="text" name="target_table" id="target_table" required maxlength="20">
                </label>
                <div class="note"><strong>Note:</strong> 영문자, 숫자, _ 만 가능 (공백없이)</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="target_subject" class="label">게시판 제목<strong class="sound_only">필수</strong></label>
            </div>
            <div class="adm-form-td td-r">
                <label for="target_subject"  class="input">
                    <input type="text" name="target_subject" id="target_subject" value="[복사본] <?php echo get_sanitize_input($board['bo_subject']); ?>" required maxlength="120">
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">복사 유형<strong class="sound_only">필수</strong></label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <label for="copy_case1" class="radio"><input type="radio" name="copy_case" id="copy_case1" value="schema_only" checked><i></i>구조만 복사</label>
                    <label for="copy_case2" class="radio"><input type="radio" name="copy_case" id="copy_case2" value="schema_data_both"><i></i>구조와 데이터 모두 복사</label>
                </div>
            </div>
        </div>
        <?php if ($eyoom_board['use_gnu_skin'] == 'n') { ?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">이윰 게시판설정 복사</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <label for="copy_config1" class="radio"><input type="radio" name="copy_config" id="copy_config1" value="0" checked><i></i>기본값 사용</label>
                    <label for="copy_config2" class="radio"><input type="radio" name="copy_config" id="copy_config2" value="1"><i></i>이윰 게시판설정 복사하기</label>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit;?>
    </div>

    </form>
</div>

<script>
function fboardcopy_check(f) {
    <?php
    if($w!=''){
    $js_array = get_bo_table_banned_word();
    echo "var banned_array = ". json_encode($js_array) . ";\n";
    }
    ?>

    // 게시판명이 금지된 단어로 되어 있으면
    if( (typeof banned_array != 'undefined') && jQuery.inArray(f.target_table.value, banned_array) !== -1 ){
        alert("입력한 게시판 TABLE명을 사용할수 없습니다. 다른 이름으로 입력해 주세요.");
        return false;
    }

    if (f.bo_table.value == f.target_table.value) {
        alert("원본 테이블명과 복사할 테이블명이 달라야 합니다.");
        return false;
    }

    // 게시판명 유효성 검사
    var pattern = /^[A-Za-z0-9_]+$/;
    if (!pattern.test(f.target_table.value)) {
        alert('복사할 테이블명 입력값이 유효하지 않습니다. 영문 대소문자, 숫자, 언더스코어(_)만 입력할 수 있습니다.');
        return false;
    }

    // 게시판명의 길이는 20자 이내로 제한
    if (f.target_table.value.length > 20) {
        alert('복사할 테이블명의 입력값은 20자 이내로 제한됩니다.');
        return false;
    }

    return true;
}
</script>