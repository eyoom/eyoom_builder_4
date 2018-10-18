<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shop/iteminfo.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<?php if (!G5_IS_MOBILE) { ?>
<div class="table-responsive">
<?php } ?>

<table class="table">
    <tbody>
        <?php foreach ($itinfo as $k => $el) { ?>
        <tr>
            <th class="table-form-th">
                <label for="ii_article_<?php echo $el['el_name']; ?>" class="label"><?php echo $el['el_title']; ?></label>
            </th>
            <td>
                <label class="input form-width-250px">
                    <input type="hidden" name="ii_article[]" value="<?php echo $el['el_name']; ?>">
                    <input type="text" name="ii_value[]" value="<?php echo $el['el_value']; ?>" id="ii_article_<?php echo $el['el_name']; ?>" required>
                </label>
                <?php if ($el['el_example']) { ?>
                <div class="note"><strong>Note:</strong> <?php echo $el['el_example']; ?></div>
                <?php } ?>
            </td>
            <?php if ($el_no == 0) { ?>
            <td rowspan="<?php echo $el_length; ?>" class="table-chk-td">
                <div class="inline-group">
                    <label for="chk_ca_it_info" class="checkbox"><input type="checkbox" name="chk_ca_it_info" value="1" id="chk_ca_it_info"><i></i>분류적용</label>
                    <label for="chk_all_it_info" class="checkbox"><input type="checkbox" name="chk_all_it_info" value="1" id="chk_all_it_info"><i></i>전체적용</label>
                </div>
            </td>
            <?php } $el_no++; ?>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php if (!G5_IS_MOBILE) { ?>
</div>
<?php } ?>