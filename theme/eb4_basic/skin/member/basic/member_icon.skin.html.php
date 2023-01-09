<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/member_icon.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.member-icon-list {position:relative;overflow:hidden}
.member-icon-list .member-icons {list-style:none;margin:0;padding:0;margin-left:-10px;margin-right:-10px}
.member-icon-list .member-icons:after {content:"";display:block;clear:both}
.member-icon-list .member-icons li {float:left;min-height:90px;padding:10px 5px}
.member-icon-list .member-icons li img {width:58px;height:auto}
</style>

<div class="member-icon-list">
    <div class="cont-text-bg m-b-20">
        <p class="bg-info"><i class="fas fa-info-circle"></i> 원하시는 이미지를 선택하여 주세요.</p>
    </div>
    <ul class="member-icons">
        <?php foreach ($micon as $key => $icon) { ?>
        <li><a href="javascript:void(0);" onclick="set_member_icon('<?php echo $icon['file']; ?>');"><img src="<?php echo $icon['url']; ?>"></a></li>
        <?php } ?>
    </ul>
</div>

<script>
function set_member_icon(member_icon) {
    parent.set_member_icon(member_icon);
}
</script>
