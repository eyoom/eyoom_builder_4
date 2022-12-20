<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/member_icon.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/eyoom-form/css/eyoom-form.min.css" type="text/css" media="screen">',0);
?>

<style>
body {background:#fff}
.member_icon-list .eyoom-form {margin:15px 15px 25px}
.member_icon-list .member_icon-label {width:110px;float:right;text-align:right;padding:7px 10px 0 0}
.member_icon-list .member_icon-select {width:170px;float:right}
.member_icon-list .member_icons {list-style:none;margin:0;padding:0}
.member_icon-list .member_icons li {float:left;min-height:65px;margin:5px 13px}
.member_icon-list .member_icons li img {width:40px}
</style>

<div class="member_icon-list">
    <div class="eyoom-form">
        <div class="member_icon-label">
            <label class="label">아이콘 선택</label>
        </div>
        <div class="clearfix"></div>
    </div>
    <ul class="member_icons">
        <?php foreach ($member_icon as $key => $icon) { ?>
        <li><a href="javascript:void(0);" onclick="set_member_icon('<?php echo $icon['member_icon']; ?>');"><img src="<?php echo $icon['url']; ?>"></a></li>
        <?php } ?>
    </ul>
</div>

<script>
function set_member_icon(member_icon) {
    parent.set_member_icon(member_icon);
}
</script>
