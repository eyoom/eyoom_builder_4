<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/member/mail_select_update.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="mail-select">
    <div class="adm-headline">
        <h3>메일 발송중</h3>
    </div>

    <p>메일 발송중 ...</p>

    <p><strong class="color-red">[끝]</strong> 이라는 단어가 나오기 전에는 중간에 중지하지 마세요.</p>

    <div class="margin-bottom-30"></div>

    <div id="mail-select-layer">
        <div class="margin-bottom-30">
            <h5><strong><i class="fas fa-caret-right"></i> 발송중인 메일</strong></h5>
            <blockquote class="hero">
                <p><span id="cont"></span></p>
            </blockquote>
        </div>
    </div>
</div>

<script> document.all.cont.innerHTML += "총 <?php echo number_format($cnt); ?>건 발송<br><br><strong class='color-red'>[끝]</strong>"; document.body.scrollTop += 1000; </script>