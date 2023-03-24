<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/board/contentlist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'contentlist';
$g5_title = '내용관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">게시판관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-contentlist">
    <div class="adm-headline">
        <h3>내용관리 리스트</h3>
        <?php if (!$wmode) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=contentform" class="btn-e btn-e-md btn-e-crimson adm-headline-btn"><i class="las la-plus m-r-7"></i><span>내용 추가</span></a>
        <?php } ?>
    </div>

    <form id="fsearch" name="fsearch" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    
    <?php if (G5_IS_MOBILE) { ?>
    <a class="collapse-search-btn btn-e btn-e-sm btn-e-dark m-b-20" data-bs-toggle="collapse" href="#collapse-search-box"><i class="fas fa-search m-r-7"></i><span>검색 조건 열기</span></a>
    <?php } ?>
    <div id="collapse-search-box" class="<?php if (G5_IS_MOBILE) { ?>panel-collapse collapse<?php } ?> m-b-20">
        <div class="adm-form-table adm-search-box m-b-20">
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label class="label">검색어</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <span>
                            <label class="select width-150px">
                                <select name="sfl" id="sfl">
                                    <option value="co_id"<?php echo get_selected($sfl, "co_id"); ?>>아이디</option>
                                    <option value="co_subject"<?php echo get_selected($sfl, "co_subject"); ?>>제목</option>
                                </select><i></i>
                            </label>
                        </span>
                        <span>
                            <label class="input max-width-250px">
                                <input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" autocomplete="off">
                            </label>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="confirm-bottom-btn">
            <?php echo $frm_submit;?>
        </div>
    </div>

    <div class="m-b-5 f-s-13r">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="m-l-10 m-r-10 text-light-gray">|</span>전체 내용 <?php echo number_format($total_count); ?>건
    </div>

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="width-180px">관리</th>
                        <th>ID</th>
                        <th>제목</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=contentform&amp;w=u&amp;co_id=<?php echo $list[$i]['co_id']; ?>"><u>수정</u></a><a href="<?php echo get_eyoom_pretty_url('content', $list[$i]['co_id']); ?>" target="_blank" class="m-l-10"><u>보기</u></a><a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=contentformupdate&amp;w=d&amp;co_id=<?php echo $list[$i]['co_id']; ?>&amp;smode=1" class="m-l-10" onclick="delete_confirm(this.href); return false;"><u>삭제</u></a>
                        </th>
                        <td><?php echo $list[$i]['co_id']; ?></td>
                        <td><?php echo htmlspecialchars2($list[$i]['co_subject']); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="3" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    </form>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>
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