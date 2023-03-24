<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/member/faqmasterlist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'faqmasterlist';
$g5_title = 'FAQ관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">게시판관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-faqmasterlist">
    <div class="adm-headline">
        <h3>FAQ마스터 리스트</h3>
        <?php if (!$wmode) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=faqmasterform" class="btn-e btn-e-md btn-e-crimson adm-headline-btn"><i class="las la-plus m-r-7"></i><span>FAQ 추가</span></a>
        <?php } ?>
    </div>
    
    <?php if ($page > 1) { ?>
    <div class="m-b-5 f-s-13r">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[처음으로]</a><span class="m-l-10 m-r-10 text-light-gray">|</span>전체 FAQ <?php echo number_format($total_count); ?>건
    </div>
    <?php } ?>

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="width-60px">번호</th>
                        <th class="width-180px">관리</th>
                        <th>제목</th>
                        <th>FAQ수</th>
                        <th>순서</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th class="text-center"><?php echo $list[$i]['fm_id']; ?></th>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=faqmasterform&amp;w=u&amp;fm_id=<?php echo $list[$i]['fm_id']; ?>"><u>수정</u></a><a href="<?php echo G5_BBS_URL; ?>/faq.php?fm_id=<?php echo $list[$i]['fm_id']; ?>" target="_blank" class="m-l-10"><u>보기</u></a><a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=faqmasterformupdate&amp;w=d&amp;fm_id=<?php echo $list[$i]['fm_id']; ?>&amp;smode=1" class="m-l-10" onclick="delete_confirm(this.href); return false;"><u>삭제</u></a>
                        </td>
                        <td><?php echo stripslashes($list[$i]['fm_subject']); ?></td>
                        <td class="text-center"><?php echo $list[$i]['cnt']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['fm_order']; ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="5" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <?php /* 페이지 */ ?>
    <div class="m-b-20">
        <?php echo eb_paging($eyoom['paging_skin']);?>
    </div>

    <div class="cont-text-bg">
        <p class="bg-info">
            <i class="fas fa-info-circle"></i> FAQ는 무제한으로 등록할 수 있습니다.<br>
            <i class="fas fa-info-circle"></i> <strong>FAQ추가</strong>를 눌러 FAQ Master를 생성합니다. (하나의 FAQ 타이틀 생성 : 자주하시는 질문, 이용안내..등 )<br>
            <i class="fas fa-info-circle"></i> 생성한 FAQ Master 의 <strong>제목</strong>을 눌러 세부 내용을 관리할 수 있습니다.
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