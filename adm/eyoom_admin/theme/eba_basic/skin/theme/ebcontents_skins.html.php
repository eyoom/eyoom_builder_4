<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/theme/ebcontents_skins.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<style>
.ebcontents-skin-form {padding:15px}
.ebcontents-skin-form ul {padding:0;margin:0;margin-left:-5px;margin-right:-5px}
.ebcontents-skin-form ul:after {content:"";display:block;clear:both}
.ebcontents-skin-form ul li {width:120px;height:auto;padding:5px;border:1px solid var(--tbc-default);float:left;margin:4px}
.ebcontents-skin-form ul li .skin-img {position:relative;overflow:hidden;width:108px;height:108px}
.ebcontents-skin-form ul li h6 {position:relative;overflow:hidden;height:32px;text-align:center;font-size:.75rem;line-height:1.4;margin:8px 0}
</style>

<div class="ebcontents-skin-form">
    <div class="adm-headline">
        <h3>EB콘텐츠 스킨 선택하기</h3>
    </div>

    <ul class="list-unstyled">
        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        <li>
            <?php if ($list[$i]['ec_skin_img']) { ?>
            <div class="skin-img">
                <img src="<?php echo $list[$i]['ec_skin_img']; ?>" class="img-responsive" alt="">
            </div>
            <?php } ?>
            <h6><?php echo $list[$i]['ec_skin_name']; ?></h6>
            <button type="button" class="btn-e btn-e-dark btn-e-block" onclick="select_skin('<?php echo $list[$i]['ec_skin_name']; ?>', '<?php echo $list[$i]['ec_skin_img']; ?>');">선택하기</button>
        </li>
        <?php } ?>
    </ul>
</div>

<script>
function select_skin(skin, img='') {
    window.opener.set_skin(skin, img);
    window.close();
}
</script>