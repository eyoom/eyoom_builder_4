<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shopetc/itemsellrank.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'itemsellrank';
$g5_title = '상품판매순위';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">쇼핑몰현황/기타</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<style>
.admin-shop-itemsellrank .itemsellrank-image {width:80px;margin:0 auto}
.admin-shop-itemsellrank .itemsellrank-image img {display:block;max-width:100%;height:auto}
</style>

<div class="admin-shop-itemsellrank">
    <div class="adm-headline">
        <h3>상품판매순위</h3>
        <?php if (!$wmode) { ?>
        <div class="adm-headline-btn">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemform" class="btn-e btn-e-md btn-e-crimson"><i class="las la-plus m-r-7"></i><span>상품등록</span></a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemstocklist" class="btn-e btn-e-md btn-e-indigo"><i class="las la-plus m-r-7"></i><span>상품재고관리</span></a>
        </div>
        <?php } ?>
    </div>

    <form id="flist" name="flist" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    <input type="hidden" name="sst" id="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" id="sod" value="<?php echo $sod; ?>">
    
    <?php if (G5_IS_MOBILE) { ?>
    <a class="collapse-search-btn btn-e btn-e-sm btn-e-dark m-b-20" data-bs-toggle="collapse" href="#collapse-search-box"><i class="fas fa-search m-r-7"></i><span>검색 조건 열기</span></a>
    <?php } ?>
    <div id="collapse-search-box" class="<?php if (G5_IS_MOBILE) { ?>panel-collapse collapse<?php } ?> m-b-20">
        <div class="adm-form-table adm-search-box m-b-20">
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label class="label">기간검색</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
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

    </form>

    <?php if(!$wmode) { ?>
    <div class="cont-text-bg m-b-20">
        <p class="bg-info"><i class="fas fa-info-circle"></i> 판매량을 합산하여 상품판매순위를 집계합니다.</p>
    </div>
    <?php } ?>

    <div class="m-b-5">
        <div class="float-start f-s-13r">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="m-l-10 m-r-10 text-light-gray">|</span>등록상품 <?php echo number_format($total_count); ?>건
        </div>
        <div class="float-end xs-float-start eyoom-form">
            <label for="sort_list" class="select width-200px">
                <select name="sort_list" id="sort_list" onchange="sorting_list(this.form, this.value);">
                    <option value="">:: 정렬방식선택 ::</option>
                    <option value="ct_status_1|asc" <?php echo $sort1=='ct_status_1' && $sort2=='asc' ? 'selected':''; ?>>쇼핑 정방향 (↓)</option>
                    <option value="ct_status_1|desc" <?php echo $sort1=='ct_status_1' && $sort2=='desc' ? 'selected':''; ?>>쇼핑 역방향 (↑) </option>
                    <option value="ct_status_2|asc" <?php echo $sort1=='ct_status_2' && $sort2=='asc' ? 'selected':''; ?>>주문 정방향 (↓)</option>
                    <option value="ct_status_2|desc" <?php echo $sort1=='ct_status_2' && $sort2=='desc' ? 'selected':''; ?>>주문 역방향 (↑) </option>
                    <option value="ct_status_3|asc" <?php echo $sort1=='ct_status_3' && $sort2=='asc' ? 'selected':''; ?>>입금 정방향 (↓)</option>
                    <option value="ct_status_3|desc" <?php echo $sort1=='ct_status_3' && $sort2=='desc' ? 'selected':''; ?>>입금 역방향 (↑) </option>
                    <option value="ct_status_4|asc" <?php echo $sort1=='ct_status_4' && $sort2=='asc' ? 'selected':''; ?>>준비 정방향 (↓)</option>
                    <option value="ct_status_4|desc" <?php echo $sort1=='ct_status_4' && $sort2=='desc' ? 'selected':''; ?>>준비 역방향 (↑) </option>
                    <option value="ct_status_5|asc" <?php echo $sort1=='ct_status_5' && $sort2=='asc' ? 'selected':''; ?>>배송 정방향 (↓)</option>
                    <option value="ct_status_5|desc" <?php echo $sort1=='ct_status_5' && $sort2=='desc' ? 'selected':''; ?>>배송 역방향 (↑) </option>
                    <option value="ct_status_6|asc" <?php echo $sort1=='ct_status_6' && $sort2=='asc' ? 'selected':''; ?>>완료 정방향 (↓)</option>
                    <option value="ct_status_6|desc" <?php echo $sort1=='ct_status_6' && $sort2=='desc' ? 'selected':''; ?>>완료 역방향 (↑) </option>
                    <option value="ct_status_7|asc" <?php echo $sort1=='ct_status_7' && $sort2=='asc' ? 'selected':''; ?>>취소 정방향 (↓)</option>
                    <option value="ct_status_7|desc" <?php echo $sort1=='ct_status_7' && $sort2=='desc' ? 'selected':''; ?>>취소 역방향 (↑) </option>
                    <option value="ct_status_8|asc" <?php echo $sort1=='ct_status_8' && $sort2=='asc' ? 'selected':''; ?>>반품 정방향 (↓)</option>
                    <option value="ct_status_8|desc" <?php echo $sort1=='ct_status_8' && $sort2=='desc' ? 'selected':''; ?>>반품 역방향 (↑) </option>
                    <option value="ct_status_9|asc" <?php echo $sort1=='ct_status_9' && $sort2=='asc' ? 'selected':''; ?>>품절 정방향 (↓)</option>
                    <option value="ct_status_9|desc" <?php echo $sort1=='ct_status_9' && $sort2=='desc' ? 'selected':''; ?>>품절 역방향 (↑) </option>
                    <option value="ct_status_sum|asc" <?php echo $sort1=='ct_status_sum' && $sort2=='asc' ? 'selected':''; ?>>합계 정방향 (↓)</option>
                    <option value="ct_status_sum|desc" <?php echo $sort1=='ct_status_sum' && $sort2=='desc' ? 'selected':''; ?>>합계 역방향 (↑) </option>
                </select><i></i>
            </label>
        </div>
        <div class="clearfix"></div>
    </div>

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="width-60px">순위</th>
                        <th>이미지</th>
                        <th>상품명</th>
                        <th>쇼핑</th>
                        <th>주문</th>
                        <th>입금</th>
                        <th>준비</th>
                        <th>배송</th>
                        <th>완료</th>
                        <th>취소</th>
                        <th>반품</th>
                        <th>품절</th>
                        <th>합계</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <td class="text-center"><?php echo $list[$i]['num']; ?></td>
                        <td>
                            <div class="itemsellrank-image"><a href="<?php echo $list[$i]['href']; ?>" target="_blank"><?php echo $list[$i]['image']; ?></a></div>
                        </td>
                        <td>
                            <a href="<?php echo $list[$i]['href']; ?>" target="_blank"><u><?php echo cut_str($list[$i]['it_name'], 30); ?></u></a>
                        </td>
                        <td class="text-end"><?php echo number_format($list[$i]['ct_status_1']); ?></td>
                        <td class="text-end"><?php echo number_format($list[$i]['ct_status_2']); ?></td>
                        <td class="text-end"><?php echo number_format($list[$i]['ct_status_3']); ?></td>
                        <td class="text-end"><?php echo number_format($list[$i]['ct_status_4']); ?></td>
                        <td class="text-end"><?php echo number_format($list[$i]['ct_status_5']); ?></td>
                        <td class="text-end"><?php echo number_format($list[$i]['ct_status_6']); ?></td>
                        <td class="text-end"><?php echo number_format($list[$i]['ct_status_7']); ?></td>
                        <td class="text-end"><?php echo number_format($list[$i]['ct_status_8']); ?></td>
                        <td class="text-end"><?php echo number_format($list[$i]['ct_status_9']); ?></td>
                        <td class="text-end"><?php echo number_format($list[$i]['ct_status_sum']); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="13" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
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
$(document).ready(function() {
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

function sorting_list(f, str) {
    var sort = str.split('|');

    $("#sort1").val(sort[0]);
    $("#sort2").val(sort[1]);

    if (sort[0] && sort[1]) {
        f.action = "<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&pid=<?php echo $pid; ?>";
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
        document.getElementById("fr_date").value = "<?php echo date('Y-m-d', strtotime('-'.($date_term + 6).' days', G5_SERVER_TIME)); ?>";
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