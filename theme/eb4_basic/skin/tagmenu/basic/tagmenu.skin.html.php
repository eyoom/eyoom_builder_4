<?php
/**
 * skin file : /theme/THEME_NAME/skin/tagmenu/basic/tagmenu.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.tag-menu {position:relative;border:1px solid #e5e5e5;padding:15px 10px;margin:0px 0 25px;background:#fff}
.tag-menu .blind {position:absolute;top:-10px;left:-100000px;display:none}
.tag-menu .tag-list-wrap {position:relative}
.tag-menu .list-inline {margin-left:0}
.tag-menu .list-inline > li {padding-left:1px;padding-right:1px}
.tag-menu .tag-list-wrap .tag-word {background:#f0f0f0;padding:2px 5px;color:#2E3340;font-size:11px;margin-bottom:5px;display:inline-block;line-height:1}
.tag-menu .tag-list-wrap .tag-word:hover {background:#e5e5e5}
.tag-menu .tag-list-wrap .tag-word i:hover {color:#FF2900}
</style>

<div class="tag-menu">
    <div class="headline-short">
        <h5><strong>태그</strong></h5>
        <div class="headline-btn hidden-xs hidden-sm">
            <a href="<?php echo G5_URL; ?>/tag/list.php" class="btn-e btn-e-xs btn-e-default btn-e-split"><i class="fas fa-tags"></i> 태그 더보기</a>
        </div>
    </div>
    <div class="tag-list-wrap">
        <?php for ($i=0; $i<$cnt; $i++) { ?>
        <?php if ($i == 0) { ?>
        <ul class="list-unstyled list-inline margin-bottom-0">
        <?php } ?>
            <li id="dpmenu-<?php echo $list[$i]['tg_id']; ?>">
                <a href="<?php echo $list[$i]['href']; ?>" class="tag-word">
                    <span><?php echo $list[$i]['tag'];?><?php if ($is_admin) { ?><i class="fas fa-times dpmenu-out margin-left-5" onclick="dpmenu_out('<?php echo $list[$i]['tg_id']; ?>');return false;"></i><?php } ?></span>
                </a>
            </li>
        <?php if ($i == ($cnt-1)) { ?>
        </ul>
        <div class="clearfix"></div>
        <?php } ?>
    <?php } ?>
    </div>

    <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
    <div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="bottom:0;right:0;left:inherit;text-align:right">
        <div class="btn-group">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=tag_list&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-xs btn-e-dark btn-e-split"><i class="far fa-edit"></i> 태그관리</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=tag_list" target="_blank" class="btn-e btn-e-xs btn-e-dark btn-e-split-dark dropdown-toggle" title="새창 열기">
                <i class="far fa-window-maximize"></i>
            </a>
        </div>
    </div>
    <?php } ?>
</div>

<?php if ($is_admin) { ?>
<script>
var dpmenu_out = function(id) {
    var url = "<?php echo EYOOM_ADMIN_URL; ?>/?dir=theme&pid=tag_dpmenu";
    $.post(url, {'id':id,'yn':'n'}, function(data) {
        if (data.dpmenu) {
            $('#dpmenu-'+id).addClass('blind');
        }
    },"json");
}
</script>
<?php } ?>