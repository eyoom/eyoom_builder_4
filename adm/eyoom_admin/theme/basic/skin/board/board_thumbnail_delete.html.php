<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/board/board_thumbnail_delete.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-thumbnail-file-delete">
    <div class="adm-headline">
        <h3><?php echo $g5['title']; ?></h3>
    </div>

    <div class="cont-text-bg">
        <p class="bg-danger font-size-12"><i class="fas fa-exclamation-circle"></i> 완료 메세지가 나오기 전에 프로그램의 실행을 중지하지 마십시오.</p>
    </div>

    <div class="alert alert-warning padding-all-10 margin-top-30 margin-bottom-30">
        <ul>
            <li>완료됨</li>
            <?php for ($i=0; $i<count((array)$print_html); $i++) { ?>
            <li><?php echo $print_html[$i]; ?></li>
            <?php } ?>
        </ul>
    </div>

    <div class="margin-bottom-15">
        <strong class="font-size-14 color-red">
            <span class="fa-stack fa-lg">
                <i class="fas fa-circle fa-stack-2x"></i>
                <i class="fas fa-check fa-stack-1x fa-inverse"></i>
            </span>
            <span class="color-black">썸네일 <span class="color-red"><?php echo $cnt; ?></span> 건 삭제 완료됐습니다.</span>
        </strong>
    </div>

    <div><a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_form&amp;w=u&amp;bo_table=<?php echo $bo_table; ?>&amp;<?php echo $qstr; ?>" class="btn-e btn-e-lg btn-e-dark">게시판 수정으로 돌아가기</a></div>
</div>