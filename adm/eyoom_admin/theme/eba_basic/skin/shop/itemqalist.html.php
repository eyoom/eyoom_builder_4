<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shop/itemqalist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'itemqalist';
$g5_title = '상품문의';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">쇼핑몰관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<style>
.admin-shop-itemqalist .itemqalist-image {width:80px;margin:0 auto}
.admin-shop-itemqalist .itemqalist-image img {display:block;max-width:100%;height:auto}
</style>

<div class="admin-shop-itemqalist">
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
                    <label class="label">기간검색</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <div class="m-b-5">
                            <label class="select max-width-150px">
                                <select name="sdt" id="sdt">
                                    <option value="it_time" <?php echo get_selected($sdt, 'iq_time'); ?>>등록일</option>
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
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="m-l-10 m-r-10 text-light-gray">|</span>상품문의 <?php echo number_format($total_count); ?>건
        </div>
        <div class="float-end xs-float-start">
            <label for="sort_list" class="select width-200px">
                <select name="sort_list" id="sort_list" onchange="sorting_list(this.form, this.value);">
                    <option value="">:: 정렬방식선택 ::</option>
                    <option value="it_name|asc" <?php echo $sst=='it_name' && $sod == 'asc' ? 'selected':''; ?>>제품명 정방향 (↓)</option>
                    <option value="it_name|desc" <?php echo $sst=='it_name' && $sod == 'desc' ? 'selected':''; ?>>제품명 역방향 (↑) </option>
                    <option value="iq_subject|asc" <?php echo $sst=='iq_subject' && $sod == 'asc' ? 'selected':''; ?>>질문 정방향 (↓)</option>
                    <option value="iq_subject|desc" <?php echo $sst=='iq_subject' && $sod == 'desc' ? 'selected':''; ?>>질문 역방향 (↑) </option>
                    <option value="mb_name|asc" <?php echo $sst=='mb_name' && $sod == 'asc' ? 'selected':''; ?>>이름 정방향 (↓)</option>
                    <option value="mb_name|desc" <?php echo $sst=='mb_name' && $sod == 'desc' ? 'selected':''; ?>>이름 역방향 (↑) </option>
                    <option value="iq_answer|asc" <?php echo $sst=='iq_answer' && $sod == 'asc' ? 'selected':''; ?>>답변 정방향 (↓)</option>
                    <option value="iq_answer|desc" <?php echo $sst=='iq_answer' && $sod == 'desc' ? 'selected':''; ?>>답변 역방향 (↑) </option>
                </select><i></i>
            </label>
        </div>
        <div class="clearfix"></div>
    </div>

    </form>

    <form name="fitemqalist" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fitemqalist_submit(this);" autocomplete="off" class="eyoom-form">
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
                        <th class="width-60px">관리</th>
                        <th>이미지</th>
                        <th>상품코드_상품명</th>
                        <th>질문</th>
                        <th>이름</th>
                        <th>답변여부</th>
                        <th>등록일</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th>
                            <input type="hidden" name="iq_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['iq_id']; ?>" id="iq_id_<?php echo $i; ?>">
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="chk[]" id="chk_<?php echo $i; ?>" value="<?php echo $i; ?>"><i></i>
                            </label>
                        </th>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=itemqaform&amp;iq_id=<?php echo $list[$i]['iq_id']; ?>&amp;w=u<?php echo $qstr ? '&amp;'.$qstr:''; ?>"><u>수정</u></a>
                        </td>
                        <td>
                            <div class="itemqalist-image"><a href="<?php echo $list[$i]['href']; ?>" target="_blank"><?php echo $list[$i]['image']; ?></a></div>
                        </td>
                        <td>
                            <a href="<?php echo $list[$i]['href']; ?>" target="_blank"><span class="text-gray"><?php echo $list[$i]['it_id']; ?></span><br><?php echo get_text($list[$i]['it_name']); ?></a>
                        </td>
                        <td><?php echo get_text($list[$i]['iq_subject']); ?></td>
                        <td class="text-center"><?php echo $list[$i]['iq_name']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['answer']; ?></td>
                        <td class="text-center"><?php echo date("Y-m-d", strtotime($list[$i]['iq_time'])); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
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

<script>
function fsearchform_submit(num) {
    var f = document.flist;
    var number = parseInt(num)+1;
    
    for (var i=number; i<=4; i++) {
        $("#cate_"+number).val('');
    }
    f.submit();
}

function fitemqalist_submit (f) {
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