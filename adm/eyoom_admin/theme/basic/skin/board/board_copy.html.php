<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/board/board_copy.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<script src="<?php echo G5_ADMIN_URL ?>/admin.js?ver=<?php echo G5_JS_VER; ?>"></script>

<div class="admin-board-copy">
    <form name="fboardcopy" id="fboardcopy" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fboardcopy_check(this)" class="eyoom-form">
    <input type="hidden" name="bo_table" id="bo_table" value="<?php echo $bo_table; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-headline">
        <h3>게시판 복사</h3>
    </div>

    <div class="adm-table-form-wrap adm-search-box">
        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">원본 테이블명</label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <input type="text" value="<?php echo $bo_table; ?>" disabled>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="target_table" class="label">복사 테이블명<strong class="sound_only">필수</strong></label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <input type="text" name="target_table" id="target_table" required maxlength="20">
                            </label>
                            <div class="note"><strong>Note:</strong> 영문자, 숫자, _ 만 가능 (공백없이)</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="target_subject" class="label">게시판 제목<strong class="sound_only">필수</strong></label>
                        </th>
                        <td>
                            <label for="target_subject"  class="input">
                                <input type="text" name="target_subject" id="target_subject" value="[복사본] <?php echo get_sanitize_input($board['bo_subject']); ?>" required maxlength="120">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">복사 유형<strong class="sound_only">필수</strong></label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="copy_case1" class="radio"><input type="radio" name="copy_case" id="copy_case1" value="schema_only" checked><i></i>구조만 복사</label>
                                <label for="copy_case2" class="radio"><input type="radio" name="copy_case" id="copy_case2" value="schema_data_both"><i></i>구조와 데이터 모두 복사</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">이윰 게시판설정 복사</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="copy_config1" class="radio"><input type="radio" name="copy_config" id="copy_config1" value="0" checked><i></i>기본값 사용</label>
                                <label for="copy_config2" class="radio"><input type="radio" name="copy_config" id="copy_config2" value="1"><i></i>이윰 게시판설정 복사하기</label>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php if (!G5_IS_MOBILE) { ?>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php echo $frm_submit; ?>

    </form>
</div>

<script>
function fboardcopy_check(f) {
    <?php
    if(!$w){
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

    return true;
}
</script>