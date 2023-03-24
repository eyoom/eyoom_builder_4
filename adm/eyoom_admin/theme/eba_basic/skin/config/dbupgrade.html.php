<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/config/dbupgrade.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'dbupgrade';
$g5_title = 'DB 업그레이드';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">환경설정</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-session-file-delete">
    <div class="adm-form-table">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>DB 업그레이드</strong></div>
        <div class="adm-form-info">
            <div class="cont-text-bg">
                <p class="bg-info">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $db_upgrade_msg; ?>
                </p>
            </div>
        </div>
    </div>
</div>