<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/config/captcha_file_delete.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'captcha_file_delete';
$g5_title = '캡챠파일 일괄삭제';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">환경설정</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-captcha-file-delete">
    <div class="adm-form-table">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>캡챠파일 일괄삭제</strong></div>
        <div class="adm-form-info">
            <div class="cont-text-bg">
                <p class="bg-danger">
                    <i class="fas fa-exclamation-circle"></i> 완료 메세지가 나오기 전에 프로그램의 실행을 중지하지 마십시오.
                </p>
            </div>
        </div>
        <?php if ($no_print) { ?>
        <div class="adm-form-info">
            <div class="cont-text-bg">
                <p class="bg-warning">
                    <?php echo $no_print; ?>
                </p>
            </div>
        </div>
        <?php } ?>
        <div class="adm-form-cont">
            <h5><i class="far fa-check-circle text-teal m-r-10"></i>완료됨!</h5>
            <?php foreach ($print_html as $key => $gcaptcha_file) { ?>
            <p class="li-p-sq"><?php echo $gcaptcha_file; ?></p>
            <?php } ?>
        </div>
        <div class="adm-form-cont">
            <p class="li-p-sq">캡챠파일 <span class="text-crimson"><?php echo $cnt; ?></span> 건 삭제 완료됐습니다.</p>
            <p class="li-p-sq text-teal">프로그램의 실행을 끝마치셔도 좋습니다.</p>
        </div>
    </div>
</div>