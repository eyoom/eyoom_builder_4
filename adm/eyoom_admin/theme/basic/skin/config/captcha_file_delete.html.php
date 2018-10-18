<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/config/captcha_file_delete.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-captcha-file-delete">
    <div class="adm-headline">
        <h3>캡챠파일 일괄 삭제</h3>
    </div>

    <div class="cont-text-bg">
        <p class="bg-danger font-size-12"><i class="fas fa-exclamation-circle"></i> 완료 메세지가 나오기 전에 프로그램의 실행을 중지하지 마십시오.</p>
    </div>

    <?php if ($no_print) { ?>
    <div class="alert alert-warning padding-all-10 margin-top-30 margin-bottom-30">
        <p><?php echo $no_print; ?></p>
    </div>
    <?php } ?>

    <div class="alert alert-warning padding-all-10 margin-top-30 margin-bottom-30">
        <ul>
            <li>완료됨</li>
            <?php foreach ($print_html as $key => $gcaptcha_file) { ?>
            <li><?php echo $gcaptcha_file; ?></li>
            <?php } ?>
        </ul>
    </div>

    <div class="margin-bottom-15">
        <strong class="font-size-14 color-red">
            <span class="fa-stack fa-lg">
                <i class="fas fa-circle fa-stack-2x"></i>
                <i class="fas fa-check fa-stack-1x fa-inverse"></i>
            </span>
            <span class="color-black">캡챠파일 <span class="color-red"><?php echo $cnt; ?></span> 건 삭제 완료됐습니다.</span>
        </strong>
    </div>

    <div class="cont-text-bg"><p class="bg-info font-size-12">... 프로그램의 실행을 끝마치셔도 좋습니다.</p></div>
</div>