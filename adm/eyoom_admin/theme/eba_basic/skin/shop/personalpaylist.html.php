<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shop/personalpaylist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'personalpaylist';
$g5_title = '개인결제관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">쇼핑몰관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-shop-personalpaylist">
    <div class="adm-headline">
        <h3>개인결제 관리</h3>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=personalpayform" class="btn-e btn-e-md btn-e-crimson adm-headline-btn"><i class="las la-plus m-r-7"></i><span>개인결제 추가</span></a>
    </div>

    <form name="fsearch" id="fsearch" class="eyoom-form" method="get">
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
                                    <option value="pp_id"<?php echo get_selected($sfl, "pp_id"); ?>>개인결제번호</option>
                                    <option value="pp_name"<?php echo get_selected($sfl, "pp_name"); ?>>이름</option>
                                    <option value="od_id"<?php echo get_selected($sfl, "od_id"); ?>>주문번호</option>
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

    </form>

    <form name="fpersonalpaylist" id="fpersonalpaylist" action="<?php echo $action_url1; ?>" onsubmit="return fpersonalpaylist_submit(this);" method="post" class="eyoom-form">
    <input type="hidden" name="sst" id="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" id="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" id="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" id="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" id="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="">

    <div class="m-b-5 f-s-13r">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="m-l-10 m-r-10 text-light-gray">|</span>전체 <?php echo number_format($total_count); ?>건
    </div>

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="width-40px">
                            <label for="chkall" class="sound_only">전체선택</label>
                            <label class="checkbox adm-table-check"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>
                        </th>
                        <th class="width-120px">관리</th>
                        <th>제목</th>
                        <th>주문번호</th>
                        <th>주문금액</th>
                        <th>입금금액</th>
                        <th>미수금액</th>
                        <th>입금방법</th>
                        <th>입금일</th>
                        <th>사용</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th>
                            <input type="hidden" name="pp_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['pp_id']; ?>" id="pp_id_<?php echo $i; ?>">
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="chk[]" id="chk_<?php echo $i; ?>" value="<?php echo $i; ?>"><i></i>
                            </label>
                        </th>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=personalpayform&w=u&pp_id=<?php echo $list[$i]['pp_id']; ?><?php echo $qstr ? '&'.$qstr:''?>"><u>수정</u></a><a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=personalpaycopy&pp_id=<?php echo $list[$i]['pp_id']; ?>&wmode=1" onclick="return eb_modal(this.href);" class="m-l-10"><u>복사</u></a>
                        </td>
                        <td><?php echo get_text($list[$i]['pp_name']); ?></td>
                        <td class="text-center">
                            <?php if ($list[$i]['od_id']) { ?><a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=orderform&od_id=<?php echo $list[$i]['od_id']; ?>" target="_blank"><?php echo $list[$i]['od_id']; ?></a><?php } ?>
                        </td>
                        <td class="text-end"><?php echo number_format($list[$i]['pp_price']); ?></td>
                        <td class="text-end"><?php echo number_format($list[$i]['pp_receipt_price']); ?></td>
                        <td class="text-end"><?php echo number_format($list[$i]['pp_price'] - $list[$i]['pp_receipt_price']); ?></td>
                        <td class="text-center"><?php echo $list[$i]['pp_settle_case']; ?></td>
                        <td class="text-center"><?php if (!is_null_time($list[$i]['pp_receipt_time'])) { echo substr($list[$i]['pp_receipt_time'],2,8); } ?></td>
                        <td class="text-center"><?php echo $list[$i]['pp_use'] ? '예': '아니오'; ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="10" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <?php if (!$wmode) { ?>
    <div class="text-start">
        <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
    </div>
    <?php } ?>

    </form>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>
</div>

<div class="modal fade personalpay-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-700">개인결제 복사</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <iframe id="personalpay-iframe" width="100%" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-e btn-e-lg btn-e-dark" data-bs-dismiss="modal">닫기<i class="fas fa-times m-l-5"></i></button>
            </div>
        </div>
    </div>
</div>

<script>
function eb_modal(href) {
    $('.personalpay-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#product-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.personalpay-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#personalpay-iframe").attr("src", href);
        $('#personalpay-iframe').height(260);
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

function close_modal_and_reload() {
	window.closeModal = function(){
		$('.personalpay-iframe-modal').modal('hide');
	};
	document.location.href = '<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=personalpaylist';
}

function fpersonalpaylist_submit(f) {
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