<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/password.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.password-confirm {position:relative;width:360px;padding:25px 15px;background:#fff;margin:50px auto;border:1px solid #d5d5d5}
@media (max-width:576px) {
    .password-confirm {width:inherit;margin:30px 15px}
}
</style>

<div class="password-confirm">
    <h5 class="m-b-15"><strong>비밀번호 확인</strong></h5>
    <h6 class="m-b-15"><strong>해당글: <span class="text-crimson"><?php echo $g5['title'] ?></span></strong></h6>
    <form name="fboardpassword" action="<?php echo $action; ?>" method="post" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id; ?>">
    <input type="hidden" name="comment_id" value="<?php echo $comment_id; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">

    <section>
        <?php if ($w=='u') { ?>
        <div class="alert alert-warning">
            <p>작성자만 글을 수정할 수 있습니다.<br>작성자 본인이라면, 글 작성시 입력한 비밀번호를 입력하여 글을 수정할 수 있습니다.</p>
        </div>
        <?php } else if ($w=='d' || $w=='x') { ?>
        <div class="alert alert-warning">
            <p>작성자만 글을 삭제할 수 있습니다.<br>작성자 본인이라면, 글 작성시 입력한 비밀번호를 입력하여 글을 삭제할 수 있습니다.</p>
        </div>
        <?php } else { ?>
        <div class="alert alert-warning">
            <p>비밀글 기능으로 보호된 글입니다.<br>작성자와 관리자만 열람하실 수 있습니다. 본인이라면 비밀번호를 입력하세요.</p>
        </div>
        <?php } ?>
    </section>
    <section>
        <label for="pw_wr_password" class="label">비밀번호<strong class="sound_only">필수</strong></label>
        <label class="input required-mark">
            <i class="icon-append fas fa-lock"></i>
            <input type="password" name="wr_password" id="password_wr_password" required size="15" maxLength="20">
        </label>
    </section>
    <div class="text-center m-t-25">
        <input type="submit" value="확인" class="btn-e btn-e-navy btn-e-lg">
    </div>
    </form>
</div>
<div class="text-center">
    <a href="<?php echo $return_url; ?>"><u>이전 페이지로 돌아가기</u></a>
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