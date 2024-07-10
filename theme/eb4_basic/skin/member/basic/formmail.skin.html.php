<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/formmail.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.formmail {position:relative;overflow:hidden}
.formmail .win-title {position:relative;margin:0 0 20px;font-size:1.0625rem}
</style>
<?php if (G5_IS_MOBILE) { ?>
<style>
.formmail {padding:15px}
.formmail .win-title {height:60px;line-height:30px;padding:15px 10px;background:#353535;color:#fff}
.formmail .btn-close {position:absolute;top:19px;right:10px}
</style>
<?php } ?>

<div class="formmail">
    <h4 class="win-title">
        <strong><?php echo $name; ?>님께 메일보내기</strong>
        <?php if (G5_IS_MOBILE) { ?>
        <button type="button" class="btn-close btn-close-white" onclick="window.close();" aria-label="Close"></button>
        <?php } ?>
    </h4>
    <form name="fformmail" action="<?php echo G5_BBS_URL; ?>/formmail_send.php" onsubmit="return fformmail_submit(this);" method="post" enctype="multipart/form-data" class="eyoom-form">
    <input type="hidden" name="to" value="<?php echo $email; ?>">
    <input type="hidden" name="attach" value="2">
    <input type="hidden" name="token" value="<?php echo $token; ?>">
    <?php if ($is_member) { ?>
    <input type="hidden" name="fnick" value="<?php echo $member['mb_nick']; ?>">
    <input type="hidden" name="fmail" value="<?php echo $member['mb_email']; ?>">
    <?php } ?>
    <?php if (!$is_member) { ?>
    <div class="row">
        <section class="col col-6">
            <label for="fnick" class="label">이름<strong class="sound_only">필수</strong></label>
            <label class="input required-mark">
                <i class="icon-append fas fa-user"></i>
                <input type="text" name="fnick" id="fnick" required>
            </label>
        </section>
        <section class="col col-6">
            <label for="fmail" class="label">E-mail<strong class="sound_only">필수</strong></label>
            <label class="input required-mark">
                <i class="icon-append far fa-envelope"></i>
                <input type="text" name="fmail"  id="fmail" required>
            </label>
        </section>
    </div>
    <?php } ?>
    <section>
        <label for="subject" class="label">제목<strong class="sound_only">필수</strong></label>
        <label class="input required-mark">
            <input type="text" name="subject" id="subject" required>
        </label>
    </section>
    <section>
        <label class="label">형식</label>
        <div class="inline-group">
            <label for="type_text" class="radio"><input type="radio" name="type" value="0" id="type_text" checked><i class="rounded-x"></i>TEXT</label>
            <label for="type_html" class="radio"><input type="radio" name="type" value="1" id="type_html"><i class="rounded-x"></i>HTML</label>
            <label for="type_both" class="radio"><input type="radio" name="type" value="2" id="type_both"><i class="rounded-x"></i>TEXT+HTML</label>
        </div>
    </section>
    <section>
        <label for="content" class="label">내용<strong class="sound_only">필수</strong></label>
        <label class="textarea textarea-resizable required-mark">
            <textarea name="content" id="content" rows="15" required></textarea>
        </label>
    </section>
    <section>
        <label for="file1" class="label">첨부파일 1</label>
        <label for="file1" class="input input-file">
            <div class="button bg-color-light-grey"><input type="file" name="file1" id="file1" value="첨부파일1" onchange="this.parentNode.nextSibling.value = this.value">파일선택</div><input type="text" readonly>
        </label>
    </section>
    <section>
        <label for="file2" class="label">첨부파일 2</label>
        <label for="file2" class="input input-file">
            <div class="button bg-color-light-grey"><input type="file" name="file2" id="file2" value="첨부파일2" onchange="this.parentNode.nextSibling.value = this.value">파일선택</div><input type="text" readonly>
        </label>
    </section>
    <section>
        <label class="label">자동등록방지</label>
        <div class="vc-captcha"><?php echo captcha_html(); ?></div>
    </section>

    <div class="text-center margin-bottom-20">
        <input type="submit" value="메일발송" id="btn_submit" class="btn-e btn-e-xlg btn-e-navy">
        <?php if (G5_IS_MOBILE) { ?>
        <button type="button" onclick="window.close();" class="btn-e btn-e-xlg btn-e-dark">창닫기</button>
        <?php } ?>
    </div>
    </form>
</div>

<script>
with (document.fformmail) {
    if (typeof fname != "undefined")
        fname.focus();
    else if (typeof subject != "undefined")
        subject.focus();
}

function fformmail_submit(f) {
    <?php echo chk_captcha_js();  ?>

    if (f.file1.value || f.file2.value) {
        // 4.00.11
        if (!confirm("첨부파일의 용량이 큰경우 전송시간이 오래 걸립니다.\n\n메일보내기가 완료되기 전에 창을 닫거나 새로고침 하지 마십시오."))
            return false;
    }

    document.getElementById('btn_submit').disabled = true;

    window.parent.closeFormmailModal();

    return true;
}

<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$is_iphone = (strpos($user_agent, 'iPhone') !== false);
$is_ipad = (strpos($user_agent, 'iPad') !== false);

if ($is_iphone || $is_ipad) {
?>
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
<?php } ?>
</script>