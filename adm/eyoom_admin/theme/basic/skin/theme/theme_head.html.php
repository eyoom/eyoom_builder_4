<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/theme/theme_head.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

if ($wmode) return;
?>

<style>
.adm-theme-select-box {position:relative;background:#000;background:linear-gradient(to right,#585864 0,#000 100%);height:64px;margin-bottom:30px}
.adm-theme-select-box .theme-select-title {float:left;width:150px;background:#000;height:64px;margin-right:10px}
.adm-theme-select-box .theme-select-title h5 {margin:25px 0;padding:0;color:#fff;font-size:13px;text-align:center}
.adm-theme-select-box .theme-select-form {float:left}
.adm-theme-select-box .theme-select-form .theme-select {float:left;width:200px;height:40px}
.adm-theme-select-box .theme-select-form .board-select {float:left;width:200px;height:40px}
.adm-theme-select-box .theme-select-form .theme-select-divider {float:left;width:14px;text-align:center;height:30px;line-height:30px;color:#fff;padding-top:10px}
.adm-theme-select-box .theme-select-form .select {margin:10px 10px 0}
.adm-theme-select-box .theme-select-form .select select {border:0}
.adm-theme-select-box .theme-select-form .theme-select-note {height:20px;line-height:20px;color:#a8a9ad;font-size:11px;padding:0 10px}
@media (max-width:767px) {
    .adm-theme-select-box {height:auto}
    .adm-theme-select-box .theme-select-title {float:inherit;width:inherit;background:#CA0029;height:auto;padding:10px;margin-right:0}
    .adm-theme-select-box .theme-select-title h5 {margin:0;text-align:left}
    .adm-theme-select-box .theme-select-form .theme-select {width:140px}
    .adm-theme-select-box .theme-select-form .board-select {width:140px}
    .adm-theme-select-box .theme-select-form .theme-select-note {height:auto;line-height:1.3;margin:5px 0 7px}
}
</style>

<div class="admin-theme-themehead">
    <form name="fthemehead" method="get" class="eyoom-form">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>">

    <div class="adm-theme-select-box">
        <div class="theme-select-title">
            <h5><strong>작업 테마 선택</strong></h5>
        </div>
        <div class="theme-select-form">
            <div class="theme-select">
                <label class="select">
                    <select name="thema" id="thema" onchange="this.form.submit();">
                        <option value=''>:: 테마선택 ::</option>
                        <?php foreach ($tlist as $li) { if (!$li['is_setup']) continue; ?>
                        <option value="<?php echo $li['theme_name']; ?>" <?php echo $li['theme_name'] == $this_theme ? 'selected':''; ?>><?php echo $li['theme_name']; ?></option>
                        <?php } ?>
                    </select>
                    <i></i>
                </label>
            </div>
            <?php if (isset($bo_list)) { ?>
            <div class="theme-select-divider"><i class="fas fa-chevron-right"></i></div>
            <div class="board-select">
                <label class="select">
                    <select name="bo_table" id="bo_table" onchange="this.form.submit();">
                        <option value=''>:: 게시판선택 ::</option>
                        <?php foreach ($bo_list as $bo) { ?>
                        <option value="<?php echo $bo['bo_table']; ?>" <?php echo $bo['bo_table'] == $bo_table ? 'selected':''; ?>><?php echo $bo['bo_subject']; ?></option>
                        <?php } ?>
                    </select>
                    <i></i>
                </label>
            </div>
            <?php } ?>
            <div class="clearfix"></div>
            <div class="theme-select-note"><strong>Note:</strong> 현재 설정 및 작업하고 있는 테마입니다. 설정을 변경하거나 작업하고자 하는 테마를 선택해 주세요.</div>
        </div>
        <div class="clearfix"></div>
    </div>

    </form>
</div>