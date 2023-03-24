<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/theme/theme_head.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

if ($wmode) return;
?>

<div class="admin-theme-themehead">
    <form name="fthemehead" method="get" class="eyoom-form">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>">

    <div class="adm-form-table adm-search-box m-b-20">
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label"><strong class="text-deep-purple">작업 테마 선택</strong></label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <span>
                        <label class="select width-200px">
                            <select name="thema" id="thema" onchange="this.form.submit();">
                                <option value=''>:: 테마선택 ::</option>
                                <?php foreach ($tlist as $li) { if (!$li['is_setup']) continue; ?>
                                <option value="<?php echo $li['theme_name']; ?>" <?php echo $li['theme_name'] == $this_theme ? 'selected':''; ?>><?php echo $li['theme_name']; ?></option>
                                <?php } ?>
                            </select><i></i>
                        </label>
                    </span>
                    <?php if (isset($bo_list)) { ?>
                    <span>
                        <label class="select width-200px">
                            <select name="bo_table" id="bo_table" onchange="this.form.submit();">
                                <option value=''>:: 게시판선택 ::</option>
                                <?php foreach ($bo_list as $bo) { ?>
                                <option value="<?php echo $bo['bo_table']; ?>" <?php echo $bo['bo_table'] == $bo_table ? 'selected':''; ?>><?php echo $bo['bo_subject']; ?></option>
                                <?php } ?>
                            </select><i></i>
                        </label>
                    </span>
                    <?php } ?>
                </div>
                <div class="clearfix"></div>
                <div class="note"><strong>Note:</strong> 현재 설정 및 작업하고 있는 테마입니다. 설정을 변경하거나 작업하고자 하는 테마를 선택해 주세요.</div>
            </div>
        </div>
    </div>

    </form>
</div>