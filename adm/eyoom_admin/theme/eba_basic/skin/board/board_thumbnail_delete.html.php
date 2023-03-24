<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/board/board_thumbnail_delete.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'board_list';
$g5_title = '게시판 썸네일 삭제';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">게시판관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-thumbnail-file-delete">
    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i><?php echo $g5['title']; ?></strong></div>
        <div class="adm-form-info">
            <div class="cont-text-bg">
                <p class="bg-danger">
                    <i class="fas fa-exclamation-circle"></i> 완료 메세지가 나오기 전에 프로그램의 실행을 중지하지 마십시오.
                </p>
            </div>
        </div>
        <div class="adm-form-cont">
            <h5><i class="far fa-check-circle text-teal m-r-10"></i>완료됨!</h5>
            <?php for ($i=0; $i<count((array)$print_html); $i++) { ?>
            <p class="li-p-sq"><?php echo $print_html[$i]; ?></p>
            <?php } ?>
        </div>
        <div class="adm-form-cont">
            <p class="li-p-sq">썸네일 <span class="text-crimson"><?php echo $cnt; ?></span> 건 삭제 완료됐습니다.</p>
            <p class="li-p-sq text-teal">프로그램의 실행을 끝마치셔도 좋습니다.</p>
        </div>
    </div>
    
    <div class="confirm-bottom-btn">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_form&amp;w=u&amp;bo_table=<?php echo $bo_table; ?>&amp;<?php echo $qstr; ?>" class="btn-e btn-e-lg btn-e-dark">게시판 수정으로 돌아가기</a>
    </div>
</div>