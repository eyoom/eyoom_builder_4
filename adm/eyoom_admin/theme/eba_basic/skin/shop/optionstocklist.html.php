<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shop/optionstocklist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'optionstocklist';
$g5_title = '상품옵션재고관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">쇼핑몰관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<style>
.admin-shop-optionstocklist .optionstocklist-image {width:80px;margin:0 auto}
.admin-shop-optionstocklist .optionstocklist-image img {display:block;max-width:100%;height:auto}
</style>

<div class="admin-shop-optionstocklist">
    <form id="fsearch" name="fsearch" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    <input type="hidden" name="sst" id="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" id="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">

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
                                    <option value="it_id" <?php echo get_selected($sfl, 'it_id'); ?>>상품코드</option>
                                    <option value="it_maker" <?php echo get_selected($sfl, 'it_maker'); ?>>제조사</option>
                                    <option value="it_origin" <?php echo get_selected($sfl, 'it_origin'); ?>>원산지</option>
                                    <option value="it_sell_email" <?php echo get_selected($sfl, 'it_sell_email'); ?>>판매자 e-mail</option>
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
                    <label class="label">기간검색</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <div class="m-b-5">
                            <label class="select max-width-150px">
                                <select name="sdt" id="sdt">
                                    <option value="it_time" <?php echo get_selected($sdt, 'it_time'); ?>>등록일</option>
                                    <option value="it_update_time" <?php echo get_selected($sdt, 'it_update_time'); ?>>수정일</option>
                                </select><i></i>
                            </label>
                        </div>
                        <span>
                            <label class="input max-width-150px">
                                <input type="text" id="fr_date" name="fr_date" value="<?php echo $fr_date; ?>" maxlength="10" autocomplete="off">
                            </label>
                        </span>
                        <span> - </span>
                        <span>
                            <label class="input max-width-150px">
                                <input type="text" id="to_date" name="to_date" value="<?php echo $to_date; ?>" maxlength="10" autocomplete="off">
                            </label>
                        </span>
                        <span class="search-btns">
                            <button type="button" onclick="javascript:set_date('오늘');" class="btn-e btn-e-xs btn-e-gray">오늘</button>
                            <button type="button" onclick="javascript:set_date('어제');" class="btn-e btn-e-xs btn-e-gray">어제</button>
                            <button type="button" onclick="javascript:set_date('이번주');" class="btn-e btn-e-xs btn-e-gray">이번주</button>
                            <button type="button" onclick="javascript:set_date('이번달');" class="btn-e btn-e-xs btn-e-gray">이번달</button>
                            <button type="button" onclick="javascript:set_date('지난주');" class="btn-e btn-e-xs btn-e-gray">지난주</button>
                            <button type="button" onclick="javascript:set_date('지난달');" class="btn-e btn-e-xs btn-e-gray">지난달</button>
                            <button type="button" onclick="javascript:set_date('전체');" class="btn-e btn-e-xs btn-e-gray">전체</button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label class="label">카테고리</label>
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
                    <option value="it_id|asc" <?php echo $sst=='it_id' && $sod == 'asc' ? 'selected':''; ?>>제품코드 정방향 (↓)</option>
                    <option value="it_id|desc" <?php echo $sst=='it_id' && $sod == 'desc' ? 'selected':''; ?>>제품코드 역방향 (↑) </option>
                    <option value="it_name|asc" <?php echo $sst=='it_name' && $sod == 'asc' ? 'selected':''; ?>>제품명 정방향 (↓)</option>
                    <option value="it_name|desc" <?php echo $sst=='it_name' && $sod == 'desc' ? 'selected':''; ?>>제품명 역방향 (↑) </option>
                    <option value="it_order|asc" <?php echo $sst=='it_order' && $sod == 'asc' ? 'selected':''; ?>>순서 정방향 (↓)</option>
                    <option value="it_order|desc" <?php echo $sst=='it_order' && $sod == 'desc' ? 'selected':''; ?>>순서 역방향 (↑) </option>
                    <option value="it_stock_qty|asc" <?php echo $sst=='it_stock_qty' && $sod == 'asc' ? 'selected':''; ?>>재고수량 정방향 (↓)</option>
                    <option value="it_stock_qty|desc" <?php echo $sst=='it_stock_qty' && $sod == 'desc' ? 'selected':''; ?>>재고수량 역방향 (↑) </option>
                    <option value="it_price|asc" <?php echo $sst=='it_price' && $sod == 'asc' ? 'selected':''; ?>>판매가격 정방향 (↓)</option>
                    <option value="it_price|desc" <?php echo $sst=='it_price' && $sod == 'desc' ? 'selected':''; ?>>판매가격 역방향 (↑) </option>
                    <option value="it_cust_price|asc" <?php echo $sst=='it_cust_price' && $sod == 'asc' ? 'selected':''; ?>>시중가격 정방향 (↓)</option>
                    <option value="it_cust_price|desc" <?php echo $sst=='it_cust_price' && $sod == 'desc' ? 'selected':''; ?>>시중가격 역방향 (↑) </option>
                    <option value="it_time|asc" <?php echo $sst=='it_time' && $sod == 'asc' ? 'selected':''; ?>>등록일 정방향 (↓)</option>
                    <option value="it_time|desc" <?php echo $sst=='it_time' && $sod == 'desc' ? 'selected':''; ?>>등록일 역방향 (↑) </option>
                    <option value="it_update_time|asc" <?php echo $sst=='it_update_time' && $sod == 'asc' ? 'selected':''; ?>>수정일 정방향 (↓)</option>
                    <option value="it_update_time|desc" <?php echo $sst=='it_update_time' && $sod == 'desc' ? 'selected':''; ?>>수정일 역방향 (↑) </option>
                </select><i></i>
            </label>
        </div>
        <div class="clearfix"></div>
    </div>

    </form>

    <form name="foptionstocklist" method="post" action="<?php echo $action_url1; ?>" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="sca" value="<?php echo $sca; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="sdt" value="<?php echo $sdt; ?>">
    <input type="hidden" name="fr_date" value="<?php echo $fr_date; ?>">
    <input type="hidden" name="to_date" value="<?php echo $to_date; ?>">
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
                        <th class="width-120px">관리</th>
                        <th>제품코드</th>
                        <th>이미지</th>
                        <th>제품명</th>
                        <th>옵션항목</th>
                        <th>옵션타입</th>
                        <th>창고재고</th>
                        <th>주문대기</th>
                        <th>가재고</th>
                        <th>재고수정</th>
                        <th>통보수량</th>
                        <th>판매</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <td class="text-center">
                            <a href='<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=itemform&amp;it_id=<?php echo $list[$i]['it_id']; ?>&amp;w=u&amp;ca_id=<?php echo $list[$i]['ca_id']; ?><?php echo $qstr ? '&amp;'.$qstr:''; ?>'><u>수정</u></a><a href='<?php echo $list[$i]['href']; ?>' target='_blank' class='m-l-10'><u>보기</u></a>
                        </td>
                        <td class="text-center">
                            <input type="hidden" name="it_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['it_id']; ?>">
                            <input type="hidden" name="io_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['io_id']; ?>">
                            <input type="hidden" name="io_type[<?php echo $i; ?>]" value="<?php echo $list[$i]['io_type']; ?>">
                            <a <?php if (!(G5_IS_MOBILE || $wmode)) { ?>href='<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=itemform&amp;it_id=<?php echo $list[$i]['it_id']; ?>&amp;w=u&amp;wmode=1' onclick='eb_modal(this.href); return false;'<?php } else { ?>href='javascript:void(0);'<?php } ?>><u><?php echo $list[$i]['it_id']; ?></u></a>
                        </td>
                        <td>
                            <div class="optionstocklist-image"><a href='<?php echo $list[$i]['href']; ?>' target='_blank'><?php echo $list[$i]['image']; ?></a></div>
                        </td>
                        <td><?php echo get_text($list[$i]['it_name']); ?></td>
                        <td class="text-center"><?php echo $list[$i]['option']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['type']; ?></td>
                        <td class="text-end"><?php echo $list[$i]['io_stock_qty']; ?></td>
                        <td class="text-end"><?php echo number_format($list[$i]['wait_qty']); ?></td>
                        <td class="text-end"><?php echo number_format($list[$i]['temporary_qty']); ?></td>
                        <td>
                            <label class='input width-150px'><input type='text' name='io_stock_qty[<?php echo $i; ?>]' id='stock_qty_<?php echo $i; ?>' value='<?php echo $list[$i]['io_stock_qty']; ?>' autocomplete='off'></label>
                        </td>
                        <td>
                            <label class='input width-150px'><input type='text' name='io_noti_qty[<?php echo $i; ?>]' id='noti_qty_<?php echo $i; ?>' value='<?php echo $list[$i]['io_noti_qty']; ?>' autocomplete='off'>
                        </td>
                        <td>
                            <label class='checkbox adm-table-check'><input type='checkbox' name='io_use[<?php echo $i; ?>]' id='use_<?php echo $i; ?>' value='1' <?php echo $list[$i]['io_use'] ? 'checked':''; ?>><i></i></label>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="12" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <?php if(!$wmode) { ?>
    <div class="text-end">
        <input type="submit" name="act_button" value="일괄수정" class="btn-e btn-e-md btn-e-indigo" onclick="document.pressed=this.value">
    </div>
    <?php } ?>

    </form>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>

    <div class="m-t-20">
        <div class="cont-text-bg">
            <p class="bg-info">
                <i class="fas fa-info-circle"></i> 재고수정의 수치를 수정하시면 창고재고의 수치가 변경됩니다.<br>
                <i class="fas fa-info-circle"></i> 창고재고가 부족한 경우 재고수량 뒤에 <span class="sit_stock_qty_alert">!</span><span class="sound_only"> 혹은 재고부족</span>으로 표시됩니다.
            </p>
        </div>
    </div>
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
function fsearchform_submit(num) {
    var f = document.fsearch;
    var number = parseInt(num)+1;
    
    for (var i=number; i<=4; i++) {
        $("#cate_"+number).val('');
    }
    f.submit();
}

$(document).ready(function(){
    $('#fr_date').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        prevText: '◁',
        nextText: '▷',
        showMonthAfterYear: true,
        monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
        onSelect: function(selectedDate){
            $('#to_date').datepicker('option', 'minDate', selectedDate);
        }
    });
    $('#to_date').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        prevText: '◁',
        nextText: '▷',
        showMonthAfterYear: true,
        monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
        onSelect: function(selectedDate){
            $('#fr_date').datepicker('option', 'maxDate', selectedDate);
        }
    });
});

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

function set_date(today) {
    <?php
    $date_term = date('w', G5_SERVER_TIME);
    $week_term = $date_term + 7;
    $last_term = strtotime(date('Y-m-01', G5_SERVER_TIME));
    ?>
    if (today == "오늘") {
        document.getElementById("fr_date").value = "<?php echo G5_TIME_YMD; ?>";
        document.getElementById("to_date").value = "<?php echo G5_TIME_YMD; ?>";
    } else if (today == "어제") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME - 86400); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME - 86400); ?>";
    } else if (today == "이번주") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-d', strtotime('-'.$date_term.' days', G5_SERVER_TIME)); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME); ?>";
    } else if (today == "이번달") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-01', G5_SERVER_TIME); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME); ?>";
    } else if (today == "지난주") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-d', strtotime('-'.$week_term.' days', G5_SERVER_TIME)); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-d', strtotime('-'.($week_term - 6).' days', G5_SERVER_TIME)); ?>";
    } else if (today == "지난달") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-01', strtotime('-1 Month', $last_term)); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-t', strtotime('-1 Month', $last_term)); ?>";
    } else if (today == "전체") {
        document.getElementById("fr_date").value = "";
        document.getElementById("to_date").value = "";
    }
}
</script>