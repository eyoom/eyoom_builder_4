<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/somoim/somo_apply.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'somo_list';
$g5_title = '소모임 신청 리스트';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">소모임관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-apply-list">
    <form name="fapplylist" id="fapplylist" method="post" action="" onsubmit="return fapplylist_submit(this);" class="eyoom-form">
    <input type="hidden" name="sst" id="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" id="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-headline">
        <h3>소모임 신청 리스트</h3>
    </div>

    <div class="cont-text-bg m-b-20">
        <p class="bg-info">
            <i class="fas fa-info-circle"></i> 아직 미개설된 소모임 신청 목록입니다.<br>
            <i class="fas fa-info-circle"></i> [개설하기] 버튼을 클릭하여 빠르게 소모임을 개설할 수 있습니다.<br>
            <i class="fas fa-info-circle"></i> 개설조건[추천수:<?php echo $somo['sm_goods_for_open']; ?>]이 충족되면 [개설하기] 버튼이 활성화 됩니다.
        </p>
    </div>

    <div class="f-s-13r m-b-5">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="m-l-10 m-r-10 text-light-gray">|</span>전체 <?php echo number_format($total_count); ?>건
    </div>

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="width-60px">번호</th>
                        <th>제목</th>
                        <th>글쓴이</th>
                        <th>아이디</th>
                        <th>작성일</th>
                        <th>조회수</th>
                        <th>추천수</th>
                        <th>개설하기</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count($list); $i++) { ?>
                    <tr>
                        <th class="text-center"><?php echo $list[$i]['num']; ?></th>
                        <td>
                            <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=<?php echo $sm_bo_table; ?>&amp;wr_id=<?php echo $list[$i]['wr_id']; ?>&amp;wmode=1" onclick="eb_modal(this.href); return false;"><u><?php echo $list[$i]['wr_subject']; ?></u></a>
                        </td>
                        <td class="text-center"><?php echo $list[$i]['wr_name']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['mb_id']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['wr_datetime']; ?></td>
                        <td class="text-center"><?php echo number_format($list[$i]['wr_hit']); ?></td>
                        <td class="text-center"><?php echo $list[$i]['wr_good']; ?></td>
                        <td class="text-center">
                            <?php if ($list[$i]['wr_good'] >= $somo['sm_goods_for_open']) { ?><a href="<?php echo G5_ADMIN_URL; ?>/?dir=somoim&amp;pid=somo_form&amp;wr_id=<?php echo $list[$i]['wr_id']; ?>" class="btn-e btn-e-xs btn-e-indigo">개설하기</a><?php } else { ?>-<?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if(count($list) == 0) { ?>
                    <tr>
                        <td colspan="8" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-start">
        <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
    </div>

    </form>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>
</div>

<div class="modal fade admin-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-700">소모임 신청 내역</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <iframe id="modal-iframe" width="100%" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-e btn-e-lg btn-e-dark" data-bs-dismiss="modal">닫기<i class="fas fa-times m-l-5"></i></button>
            </div>
        </div>
    </div>
</div>

<script>
function eb_modal(href) {
    <?php if (!$wmode) { ?>
    $('.admin-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#modal-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.admin-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#modal-iframe").attr("src", href);
        $('#modal-iframe').height(parseInt($(window).height() * 0.85));
        $('html').css({overflow: 'hidden'});
    });
    <?php } ?>
    return false;
}

function sorting_list(f, str) {
    var sort = str.split('|');

    $("#sst").val(sort[0]);
    $("#sod").val(sort[1]);

    if (sort[0] && sort[1]) {
        f.action = "<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&pid=<?php echo $pid; ?>";
        f.submit();
    }
}

function fapplylist_submit(f) {
    if ($("input:checked").length == 0) {
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