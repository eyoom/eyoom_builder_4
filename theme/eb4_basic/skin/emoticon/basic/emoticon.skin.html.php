<?php
/**
 * skin file : /theme/THEME_NAME/skin/emoticon/basic/emoticon.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/eyoom-form/css/eyoom-form.min.css" type="text/css" media="screen">',0);
?>

<style>
body {background:#fff}
.emoticon-list .eyoom-form {margin:15px 15px 25px}
.emoticon-list .emoticon-label {width:110px;float:right;text-align:right;padding:7px 10px 0 0}
.emoticon-list .emoticon-select {width:170px;float:right}
.emoticon-list .emoticons {list-style:none;margin:0;padding:0}
.emoticon-list .emoticons li {float:left;min-height:65px;margin:5px 13px}
.emoticon-list .emoticons li img {width:40px}
</style>

<div class="emoticon-list">
    <div class="eyoom-form">
        <div class="emoticon-select">
            <label class="select">
                <select name="eom" id="emo" onchange="change_emoticon(this.value);">
                    <?php foreach ($emo_type as $key => $value) { ?>
                    <option value="<?php echo $value; ?>" <?php if ($emo == $value) echo 'selected'; ?>><?php echo $value; ?></option>
                    <?php } ?>
                </select>
                <i></i>
            </label>
        </div>
        <div class="emoticon-label">
            <label class="label">이모티콘 선택</label>
        </div>
        <div class="clearfix"></div>
    </div>
    <ul class="emoticons">
        <?php foreach ($emoticon as $key => $emoinfo) { ?>
        <li><a href="javascript:void(0);" onclick="set_emoticon('<?php echo $emoinfo['emoticon']; ?>');"><img src="<?php echo $emoinfo['url']; ?>"></a></li>
        <?php } ?>
    </ul>
</div>

<script>
function change_emoticon(emo) {
    var url = '<?php echo EYOOM_CORE_URL;?>/board/emoticon.php?emo='+emo;
    $(location).attr('href',url);
}
function set_emoticon(emoticon) {
    parent.set_emoticon(emoticon);
    parent.jQuery('.vbox-close, .vbox-overlay').trigger('click');
}
</script>
