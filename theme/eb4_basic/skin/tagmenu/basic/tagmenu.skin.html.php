<?php
/**
 * skin file : /theme/THEME_NAME/skin/tagmenu/basic/tagmenu.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 관리자모드 테마에 따라 태그관리 경로 차별 지정
 */
$dir_name = $config['cf_eyoom_admin_theme'] == 'basic' ? 'theme': 'board';
?>

<style>
.tag-menu {position:relative;border:1px solid #e5e5e5;padding:15px 10px;margin:0px 0 30px;background:#fff}
.tag-menu .blind {position:absolute;top:-10px;left:-100000px;display:none}
.tag-menu .tag-list-wrap {position:relative}
.tag-menu .tag-list-wrap ul {margin:0;padding:0}
.tag-menu .tag-list-wrap ul:after {content:"";display:block;clear:both}
.tag-menu .tag-list-wrap li {float:left;margin:0 3px}
.tag-menu .tag-list-wrap .tag-word {background:#e5e5e5;padding:2px 5px;color:#252525;font-size:.875rem;margin-bottom:5px;display:inline-block;line-height:1}
.tag-menu .tag-list-wrap .tag-word:hover {background:#d5d5d5}
</style>

<div class="tag-menu">
    <div class="headline-short">
        <h5>태그</h5>
        <a href="<?php echo G5_URL; ?>/tag/list.php" class="btn-e btn-e-gray headline-btn">태그 더보기</a>
    </div>
    <div class="tag-list-wrap">
        <?php for ($i=0; $i<$cnt; $i++) { ?>
        <?php if ($i == 0) { ?>
        <ul class="list-unstyled">
        <?php } ?>
            <li id="dpmenu-<?php echo $list[$i]['tg_id']; ?>">
                <a href="<?php echo $list[$i]['href']; ?>" class="tag-word">
                    <span><?php echo $list[$i]['tag'];?></span>
                </a>
            </li>
        <?php if ($i == ($cnt-1)) { ?>
        </ul>
        <div class="clearfix"></div>
        <?php } ?>
    <?php } ?>
    </div>
    <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
    <div class="adm-edit-btn btn-edit-mode" style="bottom:0;text-align:right">
        <div class="btn-group">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir_name; ?>&amp;pid=tag_list&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-item-btn"><i class="far fa-edit"></i> 태그관리</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir_name; ?>&amp;pid=tag_list" target="_blank" class="ae-btn-r" title="새창 열기">
                <i class="fas fa-external-link-alt"></i>
            </a>
        </div>
    </div>
    <?php } ?>
</div>