<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shopetc/itemeventlist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'itemevent';
$g5_title = '이벤트일괄처리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">쇼핑몰현황/기타</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<style>
.admin-shop-itemeventlist .itemeventlist-image {width:80px;margin:0 auto}
.admin-shop-itemeventlist .itemeventlist-image img {display:block;max-width:100%;height:auto}
</style>

<div class="admin-shop-itemeventlist">
    <form id="flist" name="flist" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    <input type="hidden" name="sst" id="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" id="sod" value="<?php echo $sod; ?>">

    <div class="adm-form-table adm-search-box m-b-20">
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="ev_id" class="label">이벤트</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="select max-width-250px">
                    <select name="ev_id" id="ev_id" onchange="this.form.submit();">
                        <?php echo $event_option; ?>
                    </select><i></i>
                </label>
                <div class="note"><strong>Note.</strong> 상품을 이벤트별로 일괄 처리합니다.<br><?php echo ($ev_title ? '현재 선택된 이벤트는 '.$ev_title.'입니다.' : '이벤트를 선택해 주세요.'); ?></div>
            </div>
        </div>
    </div>

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
                                    <option value="it_name" <?php echo get_selected($sfl, 'it_name'); ?>>상품명</option>
                                    <option value="a.it_id" <?php echo get_selected($sfl, 'a.it_id'); ?>>상품코드</option>
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
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label class="label">분류선택</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <span>
                            <label class="select width-150px">
                                <select name="cate_a" id="cate_1" onchange="fsearchform_submit(1);">
                                    <option value="">::대분류::</option>
                                    <?php foreach ($cate1 as $ca) { ?>
                                    <option value="<?php echo $ca['ca_id']; ?>" <?php echo $cate_a == $ca['ca_id'] ? 'selected':''; ?>><?php echo $ca['ca_name']; ?></option>
                                    <?php } ?>
                                </select><i></i>
                            </label>
                        </span>
                        <span>
                            <label class="select width-150px">
                                <select name="cate_b" id="cate_2" onchange="fsearchform_submit(2);">
                                    <option value="">::중분류::</option>
                                    <?php foreach ($cate2 as $ca) { ?>
                                    <option value="<?php echo $ca['ca_id']; ?>" <?php echo $cate_b == $ca['ca_id'] ? 'selected':''; ?>><?php echo $ca['ca_name']; ?></option>
                                    <?php } ?>
                                </select><i></i>
                            </label>
                        </span>
                        <span>
                            <label class="select width-150px">
                                <select name="cate_c" id="cate_3" onchange="fsearchform_submit(3);">
                                    <option value="">::소분류::</option>
                                    <?php foreach ($cate3 as $ca) { ?>
                                    <option value="<?php echo $ca['ca_id']; ?>" <?php echo $cate_c == $ca['ca_id'] ? 'selected':''; ?>><?php echo $ca['ca_name']; ?></option>
                                    <?php } ?>
                                </select><i></i>
                            </label>
                        </span>
                        <span>
                            <label class="select width-150px">
                                <select name="cate_d" id="cate_4" onchange="fsearchform_submit(4);">
                                    <option value="">::세분류::</option>
                                    <?php foreach ($cate4 as $ca) { ?>
                                    <option value="<?php echo $ca['ca_id']; ?>" <?php echo $cate_d == $ca['ca_id'] ? 'selected':''; ?>><?php echo $ca['ca_name']; ?></option>
                                    <?php } ?>
                                </select><i></i>
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

    <div class="m-b-5">
        <div class="float-start f-s-13r">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="m-l-10 m-r-10 text-light-gray">|</span>등록된 상품 <?php echo number_format($total_count); ?>건
        </div>
        <div class="float-end xs-float-start">
            <label for="sort_list" class="select width-200px">
                <select name="sort_list" id="sort_list" onchange="sorting_list(this.form, this.value);">
                    <option value="">:: 정렬방식선택 ::</option>
                    <option value="a.it_id|asc" <?php echo $sst=='a.it_id' && $sod == 'asc' ? 'selected':''; ?>>제품코드 정방향 (↓)</option>
                    <option value="a.it_id|desc" <?php echo $sst=='a.it_id' && $sod == 'desc' ? 'selected':''; ?>>제품코드 역방향 (↑) </option>
                    <option value="it_name|asc" <?php echo $sst=='it_name' && $sod == 'asc' ? 'selected':''; ?>>제품명 정방향 (↓)</option>
                    <option value="it_name|desc" <?php echo $sst=='it_name' && $sod == 'desc' ? 'selected':''; ?>>제품명 역방향 (↑) </option>
                </select><i></i>
            </label>
        </div>
        <div class="clearfix"></div>
    </div>

    </form>
    
    <form name="fitemeventlistupdate" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fitemeventlistupdatecheck(this);" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="ev_id" value="<?php echo $ev_id; ?>">
    <input type="hidden" name="sca" value="<?php echo $sca; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="cate_a" value="<?php echo $cate_a; ?>">
    <input type="hidden" name="cate_b" value="<?php echo $cate_b; ?>">
    <input type="hidden" name="cate_c" value="<?php echo $cate_c; ?>">
    <input type="hidden" name="cate_d" value="<?php echo $cate_d; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">

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
                        <th>제품코드</th>
                        <th>이미지</th>
                        <th>제품명</th>
                        <th>판매가능</th>
                        <th>품절</th>
                        <th>재고수량</th>
                        <th>판매가격</th>
                        <th>시중가격</th>
                        <th>등록일</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th>
                            <input type="hidden" name="it_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['it_id']; ?>">
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="ev_chk[<?php echo $i; ?>]" value="1" id="ev_chk_<?php echo $i; ?>" <?php echo ($list[$i]['ev_id'] ? "checked" : ""); ?>><i></i>
                            </label>
                        </th>
                        <td class="text-center">
                            <a <?php if (!(G5_IS_MOBILE || $wmode)) { ?>href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=itemform&amp;it_id=<?php echo $list[$i]['it_id']; ?>&amp;w=u&amp;wmode=1" onclick="eb_modal(this.href); return false;"<?php } else { ?>href="javascript:void(0);"<?php } ?>><u><?php echo $list[$i]['it_id']; ?></u></a>
                        </td>
                        <td>
                            <div class="itemeventlist-image"><a href="<?php echo $list[$i]['href']; ?>" target="_blank"><?php echo $list[$i]['image']; ?></a></div>
                        </td>
                        <td><?php echo get_text($list[$i]['it_name']); ?></td>
                        <td class="text-center"><?php echo $list[$i]['it_use'] ? '<b class="text-teal">YES</b>':'<b class="text-gray">NO</b>'; ?></td>
                        <td class="text-center"><?php echo $list[$i]['it_soldout'] ? '<b class="text-tral">YES</b>':'<b class="text-gray">NO</b>'; ?></td>
                        <td class="text-end"><?php echo $list[$i]['it_stock_qty']; ?></td>
                        <td class="text-end"><?php echo number_format($list[$i]['it_price']); ?></td>
                        <td class="text-end"><?php echo number_format($list[$i]['it_cust_price']); ?></td>
                        <td class="text-center"><?php echo date("Y-m-d", strtotime($list[$i]['it_time'])); ?></td>
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

    <div class="cont-text-bg m-b-15">
        <p class="bg-info">
            <i class="fas fa-info-circle"></i> 상품을 이벤트별로 일괄 처리합니다.<br>
            <i class="fas fa-info-circle"></i> <?php echo ($ev_title ? '현재 선택된 이벤트는 '.$ev_title.'입니다.' : '상단 이벤트를 선택해 주세요.'); ?><br>
            <?php if ($ev_title) { ?>
            <i class="fas fa-info-circle"></i> 현재 선택된 이벤트는 <strong><?php echo $ev_title; ?></strong>입니다.<br>
            <i class="fas fa-info-circle"></i> 선택된 이벤트의 상품 수정 내용을 반영하시려면 일괄수정 버튼을 누르십시오.
            <?php } else { ?>
            <i class="fas fa-info-circle"></i> 이벤트를 선택하지 않으셨습니다. <strong>수정 내용을 반영하기 전에 상단에 있는 이벤트를 선택해 주십시오.</strong>
            <?php } ?>
        </p>
    </div>

    <div class="text-start">
        <input type="submit" value="일괄수정" class="btn-e btn-e-md btn-e-indigo width-120px">
    </div>

    </form>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>
</div>

<div class="modal fade admin-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-700">상품 관리</h5>
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
function fitemeventlistupdatecheck(f) {
    if (!f.ev_id.value) {
        alert('이벤트를 선택하세요');
        return false;
    }

    return true;
}

function fsearchform_submit(num) {
    var f = document.flist;
    var number = parseInt(num)+1;
    
    for (var i=number; i<=4; i++) {
        $("#cate_"+number).val('');
    }
    f.submit();
}

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

window.closeModal = function(url){
    $('.admin-iframe-modal').modal('hide');
    document.location.href = url;
};

function sorting_list(f, str) {
    var sort = str.split('|');

    $("#sst").val(sort[0]);
    $("#sod").val(sort[1]);

    if (sort[0] && sort[1]) {
        f.submit();
    }
}
</script>