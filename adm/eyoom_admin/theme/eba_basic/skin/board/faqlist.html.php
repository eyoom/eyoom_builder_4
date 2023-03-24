<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/member/faqlist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'faqmasterlist';
$g5_title = 'FAQ관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">게시판관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-faqlist">
    <div class="adm-headline">
        <h3>FAQ 상세관리</h3>
        <?php if (!$wmode) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&pid=faqform&amp;fm_id=<?php echo $fm['fm_id']; ?>" class="btn-e btn-e-md btn-e-crimson adm-headline-btn"><i class="las la-plus m-r-7"></i><span>FAQ 상세내용 추가</span></a>
        <?php } ?>
    </div>

    <div class="m-b-5 f-s-13r">
        등록된 FAQ 상세내용 <?php echo number_format($total_count); ?>건
    </div>

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="width-60px">번호</th>
                        <th class="width-120px">관리</th>
                        <th>제목</th>
                        <th>순서</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th class="text-center"><?php echo $list[$i]['num']; ?></th>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=faqform&amp;w=u&amp;fm_id=<?php echo $list[$i]['fm_id']; ?>&amp;fa_id=<?php echo $list[$i]['fa_id']; ?>"><u>수정</u></a><a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=faqformupdate&amp;w=d&amp;fm_id=<?php echo $list[$i]['fm_id']; ?>&amp;fa_id=<?php echo $list[$i]['fa_id']; ?>&amp;smode=1" class="m-l-10" onclick="delete_confirm(this.href); return false;"><u>삭제</u></a>
                        </td>
                        <td><?php echo $list[$i]['fa_subject']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['fa_order']; ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="4" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="confirm-bottom-btn m-b-20">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=faqmasterlist" class="btn-e btn-e-lg btn-e-crimson">FAQ 관리</a>
    </div>

    <div class="cont-text-bg">
        <p class="bg-info">
            <i class="fas fa-info-circle"></i> FAQ는 무제한으로 등록할 수 있습니다.<br>
            <i class="fas fa-info-circle"></i> <strong>FAQ 상세내용 추가</strong>를 눌러 자주하는 질문과 답변을 입력합니다. 
        </p>
    </div>
</div>

<script>
function delete_confirm(href) {
    if (confirm("한번 삭제한 자료는 다시는 복구할 수 없습니다.\n\n정말로 삭제하시겠습니까?")) {
        var token = get_ajax_token(href);
        if(!token) {
            alert("토큰 정보가 올바르지 않습니다.");
            return false;
        }
        href += '&token='+token;
        document.location.href = href;
    } else {
        return false;
    }
}
</script>