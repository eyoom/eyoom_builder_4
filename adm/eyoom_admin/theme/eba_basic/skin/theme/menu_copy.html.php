<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/theme/menu_copy.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-menu-copy">
    <form name="fmenucopy" id="fmenucopy" action="<?php echo $action_url1; ?>" onsubmit="return fmenucopy_check(this)" method="post" class="eyoom-form">
    <input type="hidden" name="mode" id="mode" value="update">
    <input type="hidden" name="theme" id="theme" value="<?php echo $this_theme; ?>">
    <input type="hidden" name="me_shop" id="me_shop" value="<?php echo $me_shop; ?>">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>메뉴 복사하기</strong></div>
        <div class="adm-form-info">
            <div class="cont-text-bg">
                <p class="bg-info">
                    <i class="fas fa-info-circle"></i> 복사하기를 진행할 경우, 복사 대상 테마의 선택한 메뉴는 초기화된 후 복사가 이루어 집니다.<br>
                    <i class="fas fa-info-circle"></i> 이전에 설정된 메뉴에 덮어쓰기 하여도 문제가 없는지 체크해 주시기 바랍니다.
                </p>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="bo_subject" class="label">원본 메뉴</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <span>
                        <label class="input width-250px m-r-10">
                            <i class="icon-append">테마</i>
                            <input type="text" value="<?php echo $this_theme; ?>" disabled>
                        </label>
                    </span>
                    <span>
                        - <strong class="text-crimson"><?php echo $me_shop == '1' ? '쇼핑몰 메뉴': '홈페이지 메뉴'; ?></strong>
                    </span>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">복사 대상</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <span>
                        <label for="tg_theme" class="select width-250px">
                            <select id="tg_theme" name="tg_theme" required>
                                <option value="">:: 테마선택 ::</option>
                                <?php foreach ($tlist as $li) { if (!$li['is_setup']) continue; ?>
                                <option value="<?php echo $li['theme_name']; ?>"><?php echo $li['theme_name']; ?></option>
                                <?php } ?>
                            </select><i></i>
                        </label>
                    </span>
                    <span>
                        <label for="tg_me_shop" class="select width-250px">
                            <select id="tg_me_shop" name="tg_me_shop" required>
                                <option value="">:: 메뉴선택 ::</option>
                                <option value="2">홈페이지 메뉴</option>
                                <option value="1">쇼핑몰 메뉴</option>
                            </select><i></i>
                        </label>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <input type="submit" name="act_button" value="복사하기" class="btn-e btn-e-lg btn-e-crimson" accesskey="s" onclick="document.pressed=this.value">
    </div>

    </form>
</div>

<script>
function fmenucopy_check(f) {
    var tg_theme = $("#tg_theme option:selected").val();
    var tg_me_shop = '<?php $is_youngcart; ?>' ? $("#tg_me_shop option:selected").val(): $("#tg_me_shop").val();
    if (!tg_theme) {
        alert('복사 대상 테마를 선택해 주세요.');
        $("#tg_theme").focus();
        return false;
    }

    if (!tg_me_shop) {
        alert('복사 대상을 선택해 주세요.');
        return false;
    } else {
        var tg_name = tg_me_shop == '1' ? '쇼핑몰 메뉴': '홈페이지 메뉴';
    }

    if (confirm("선택한 ["+tg_theme+"]테마의 기존 설정된 "+tg_name+"는 모두 사라집니다.\n\n계속 진행할까요?")) {
        return true;
    } else return false;
}
</script>