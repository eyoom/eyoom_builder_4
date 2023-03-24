<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shop/iteminfo.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<?php foreach ($itinfo as $k => $el) { ?>
<div class="adm-form-tr adm-sm-100">
    <div class="adm-form-td td-l">
        <label for="ii_article_<?php echo $el['el_name']; ?>" class="label"><?php echo $el['el_title']; ?></label>
    </div>
    <div class="adm-form-td td-r td-rs">
        <label class="input max-width-250px">
            <input type="hidden" name="ii_article[]" value="<?php echo $el['el_name']; ?>">
            <input type="text" name="ii_value[]" value="<?php echo get_text($el['el_value']); ?>" id="ii_article_<?php echo $el['el_name']; ?>" required>
        </label>
        <?php if ($el['el_example']) { ?>
        <div class="note"><strong>Note:</strong> <?php echo $el['el_example']; ?></div>
        <?php } ?>
    </div>
    <?php if ($el_no == 0) { ?>
    <div class="adm-form-td-rs adm-form-td-rs-all">
        <div class="inline-group">
            <label for="chk_ca_it_info" class="checkbox"><input type="checkbox" name="chk_ca_it_info" value="1" id="chk_ca_it_info"><i></i>분류적용</label>
            <label for="chk_all_it_info" class="checkbox"><input type="checkbox" name="chk_all_it_info" value="1" id="chk_all_it_info"><i></i>전체적용</label>
        </div>
    </div>
    <?php } $el_no++; ?>
</div>
<?php } ?>