<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/scrap_popin.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.scrap-popin {position:relative;overflow:hidden;padding:15px}
</style>

<div class="scrap-popin">
    <h5 class="f-s-20r m-b-20"><strong>스크랩하기</strong></h5>
    <div class="alert alert-warning">
        <p><i class="fas fa-exclamation-circle"></i> 제목 확인 및 댓글 쓰기</p>
    </div>

    <form name="f_scrap_popin" action="<?php echo G5_BBS_URL; ?>/scrap_popin_update.php" method="post" class="eyoom-form">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id; ?>">
    <section>
        <label class="label">제목</label>
        <h5><strong class="text-crimson f-s-15r"><?php echo $subject; ?></strong></h5>
    </section>
    <div class="margin-hr-15"></div>
    <section>
        <label for="wr_content" class="label">댓글</label>
        <label class="textarea textarea-resizable required-mark">
            <textarea name="wr_content" id="wr_content" required></textarea>
        </label>
    </section>
    <div class="note m-b-20"><strong>Note:</strong> 감사 혹은 격려의 댓글을 남겨주세요.</div>
    <div class="text-center m-b-20">
        <input type="submit" value="스크랩 확인" class="btn-e btn-e-lg btn-dark">
    </div>
    </form>
</div>

<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$is_iphone = (strpos($user_agent, 'iPhone') !== false);
$is_ipad = (strpos($user_agent, 'iPad') !== false);

if ($is_iphone || $is_ipad) {
?>
<script>
$(document).ready(function(){
    var touchStartTimestamp = 0;
    
    $("input, textarea, select").on('touchstart', function(event) {
        zoomDisable();
        touchStartTimestamp = event.timeStamp;
    });

    $("input, textarea, select").on('touchend', function(event) {
        var touchEndTimestamp = event.timeStamp;
        if (touchEndTimestamp - touchStartTimestamp > 500) {
            setTimeout(zoomEnable, 500);
        } else {
            zoomDisable();
            setTimeout(zoomEnable, 500);
        }
    });

    function zoomDisable(){
        $('head meta[name=viewport]').remove();
        $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">');
    }

    function zoomEnable(){
        $('head meta[name=viewport]').remove();
        $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1">');
    }
});
</script>
<?php } ?>