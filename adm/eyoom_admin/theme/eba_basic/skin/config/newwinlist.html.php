<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/config/newwinlist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'newwinlist';
$g5_title = '팝업레이어관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">환경설정</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-newwinlist">
    <form id="fsearch" name="fsearch" class="eyoom-form" method="get" class="eyoom-form">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">

    <div class="adm-headline">
        <h3>팝업레이어 리스트</h3>
        <?php if (!$wmode) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=config&pid=newwinform" class="btn-e btn-e-md btn-e-crimson adm-headline-btn"><i class="las la-plus m-r-7"></i><span>팝업레이어 추가</span></a>
        <?php } ?>
    </div>
    
    <?php if (G5_IS_MOBILE) { ?>
    <a class="collapse-search-btn btn-e btn-e-sm btn-e-dark m-b-20" data-bs-toggle="collapse" href="#collapse-search-box"><i class="fas fa-search m-r-7"></i><span>검색 조건 열기</span></a>
    <?php } ?>
    <div id="collapse-search-box" class="<?php if (G5_IS_MOBILE) { ?>panel-collapse collapse<?php } ?> m-b-20">
        <div class="adm-form-table adm-search-box m-b-20">
            <div class="adm-form-tr-wrap">
                <div class="adm-form-tr tr-l">
                    <div class="adm-form-td td-l">
                        <label for="stx" class="label">팝업제목</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input max-width-250px">
                            <input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" autocomplete="off">
                        </label>
                    </div>
                </div>
                <div class="adm-form-tr tr-r">
                    <div class="adm-form-td td-l">
                        <label for="device" class="label">접속기기</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select name="nw_device" id="nw_division">
                                <option value="">전체</option>
                                <option value="both"  <?php echo get_selected($nw['nw_device'], 'both', true); ?>>PC와 모바일</option>
                                <option value="pc"  <?php echo get_selected($nw['nw_device'], 'pc', true); ?>>PC</option>
                                <option value="mobile"  <?php echo get_selected($nw['nw_device'], 'mobile', true); ?>>모바일</option>
                            </select><i></i>
                        </label>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label class="label">날짜검색</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <div class="m-b-5">
                            <label class="select max-width-150px">
                                <select name="sdt" id="sdt">
                                    <option value="nw_begin_time" <?php echo get_selected($sdt, 'nw_begin_time'); ?>>시작일</option>
                                    <option value="nw_end_time" <?php echo get_selected($sdt, 'nw_end_time'); ?>>종료일</option>
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
        </div>
        
        <div class="confirm-bottom-btn">
            <?php echo $frm_submit;?>
        </div>
    </div>

    </form>

    <p class="f-s-13r m-b-5">전체 <?php echo number_format($total_count); ?>건</p>
    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="width-50px">번호</th>
                        <th class="width-120px">관리</th>
                        <th>제목</th>
                        <th>접속기기</th>
                        <th>시작일시</th>
                        <th>종료일시</th>
                        <th>시간</th>
                        <th>Left</th>
                        <th>Top</th>
                        <th>Width</th>
                        <th>Height</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th class="text-center"><?php echo $list[$i]['nw_id']; ?></th>
                        <td class="text-center"><a href="<?php echo G5_ADMIN_URL; ?>/?dir=config&amp;pid=newwinform&amp;w=u<?php if ($qstr) { ?>&amp;<?php echo $qstr; ?><?php } ?>&amp;nw_id=<?php echo $list[$i]['nw_id']; ?>"><u>수정</u></a> <a href="<?php echo G5_ADMIN_URL; ?>/?dir=config&amp;pid=newwinformupdate&amp;w=d<?php if ($qstr) { ?>&amp;<?php echo $qstr; ?><?php } ?>&amp;nw_id=<?php echo $list[$i]['nw_id']; ?>&amp;smode=1" class="m-l-10" onclick="delete_confirm(this.href); return false;"><u>삭제</u></a></td>
                        <td><?php echo $list[$i]['nw_subject']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['device']; ?></td>
                        <td class="text-center"><?php echo substr($list[$i]['nw_begin_time'], 2, 14); ?></td>
                        <td class="text-center"><?php echo substr($list[$i]['nw_end_time'], 2, 14); ?></td>
                        <td class="text-center"><?php echo $list[$i]['nw_disable_hours']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['nw_left']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['nw_top']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['nw_width']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['nw_height']; ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
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

function delete_confirm(href) {
    if (confirm("정말로 해당 팝업을 삭제하시겠습니까?")) {
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