<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/sms/history_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'history_list';
$g5_title = '전송내역-건별';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">SMS 관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-history-list">
    <form id="search_form" name="search_form" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    <input type="hidden" name="st" id="st" value="wr_message" >

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
                    <label class="input max-width-250px">
                        <input type="text" name="sv" value="<?php echo $sv; ?>" id="sv" required>
                    </label>
                </div>
            </div>
        </div>

        <div class="confirm-bottom-btn">
            <?php echo $frm_submit; ?>
        </div>
    </div>

    </form>

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="width-60px">번호</th>
                        <th class="width-60px">관리</th>
                        <th>메세지</th>
                        <th>회신번호</th>
                        <th>전송일시</th>
                        <th>예약</th>
                        <th>총건수</th>
                        <th>성공</th>
                        <th>실패</th>
                        <th>중복</th>
                        <th>재전송</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<$sms_count; $i++) { ?>
                    <tr>
                        <th class="text-center"><?php echo $list[$i]['vnum']; ?></th>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=history_view&amp;page=<?php echo $page; ?>&amp;st=<?php echo $st; ?>&amp;sv=<?php echo $sv; ?>&amp;wr_no=<?php echo $list[$i]['wr_no']; ?>"><u>수정</u></a>
                        </td>
                        <td>
                            <span title="<?php echo $list[$i]['wr_message']?>"><?php echo $list[$i]['wr_message']?></span>
                        </td>
                        <td class="text-center"><?php echo $list[$i]['wr_reply']?></td>
                        <td class="text-center"><?php echo date('Y-m-d H:i', strtotime($list[$i]['wr_datetime'])); ?></td>
                        <td class="text-center"><?php echo $list[$i]['wr_booking']!='0000-00-00 00:00:00'? '예약':'';?></td>
                        <td class="text-center"><?php echo number_format($list[$i]['wr_total'])?></td>
                        <td class="text-center"><?php echo number_format($list[$i]['wr_success'])?></td>
                        <td class="text-center"><?php echo number_format($list[$i]['wr_failure'])?></td>
                        <td class="text-center"><?php echo number_format($list[$i]['dupli_count'])?></td>
                        <td class="text-center"><?php echo number_format($list[$i]['wr_re_total'])?></td>
                    </tr>
                    <?php } ?>
                    <?php if($sms_count == 0) { ?>
                    <tr>
                        <td colspan="11" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>
</div>

<script>
function fhistorylist_submit(f) {
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}
</script>