<?php
/**
 * skin file : /theme/THEME_NAME/skin/best/basic/best.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.best-list {font-size:.9375rem}
.best-list .search-box {margin-bottom:15px}
.best-list .search-top {margin-bottom:15px}
.best-list .search-bottom > span {display:inline-block}
.best-list .search-bottom > span > .input {width:250px}
.best-list .search-bottom > span > .select {width:200px}
.best-list .bl-wrap {position:relative;border-top:2px solid #757575;border-bottom:1px solid #757575}
.best-list .bl-wrap > div:nth-last-child(1), .best-list .bl-wrap > div:nth-last-child(2) {border-bottom:0}
.best-list .bl-head {position:relative;display:table;width:100%;height:50px;border-bottom:1px solid #757575;background-color:#f2f2f2;font-weight:500}
.best-list .bl-head > div {position:relative}
.best-list .bl-head > div:before {content:"";position:absolute;top:50%;right:0;width:1px;height:13px;background-color:#cacaca;transform:translateY(-50%)}
.best-list .bl-head > div:last-child:before {display:none}
.best-list .bl-head .bl-item {display:table-cell;vertical-align:middle;width:120px;text-align:center}
.best-list .bl-head .bl-num {width:90px}
.best-list .bl-head .bl-num-short {width:80px}
.best-list .bl-head .bl-num-checkbox {width:110px}
.best-list .bl-head .bl-author {display:table-cell;vertical-align:middle;width:150px;text-align:center;padding: 0 5px;}
.best-list .bl-head .bl-subj {display:table-cell;vertical-align:middle;text-align:center}
.best-list .bl-list {position:relative;display:table;table-layout:fixed;;width:100%;height:46px;border-bottom:1px solid #eaeaea;padding:8px 0}
.best-list .bl-list .checkbox i {top:5px}
.best-list .bl-list.bl-notice {background-color:#FFF8EC}
.best-list .bl-list > div {position:relative}
.best-list .bl-list > div:before {content:"";position:absolute;top:50%;right:0;width:1px;height:13px;background-color:#dadada;transform:translateY(-50%)}
.best-list .bl-list > div:last-child:before {display:none}
.best-list .bl-list .bl-item {display:table-cell;vertical-align:middle;width:120px;text-align:center}
.best-list .bl-list .bl-author {display:table-cell;vertical-align:middle;width:120px;padding-left:10px}
.best-list .bl-list .bl-num {width:90px}
.best-list .bl-list .bl-num-short {width:80px}
.best-list .bl-list .bl-num-checkbox {width:110px}
.best-list .bl-list .bl-author {width:150px;padding:0 10px;text-align:left}
.best-list .bl-list .bl-subj {display:table-cell;vertical-align:middle;font-weight:500}
.best-list .bl-list .bl-subj a {position:relative;display:inline-block;padding:0 10px}
.best-list .bl-list .bl-subj a:hover {color:#000;text-decoration:underline}
.best-list .bl-list .bl-subj .bl-subj-cate {display:none}
.best-list .bl-list .bl-subj .reply-indication {display:inline-block;width:7px;height:10px;border-left:1px dotted #b5b5b5;border-bottom:1px dotted #b5b5b5}
.best-list .bl-list .bl-new {display:inline-block;width:12px;height:12px;line-height:12px;text-align:center;color:#fff;font-size:10px;font-weight:700;background-color:#ab0000}
.best-list .bl-list .bl-comment {color:#959595}
.best-list .bl-list .bl-comment strong {color:#f4511e}
.best-list .bl-list .blind-subject {color:#b5b5b5;cursor:not-allowed}
.best-list .bl-photo {display:inline-block;margin-right:2px}
.best-list .bl-photo img {width:17px;height:17px;border-radius:50%}
.best-list .bl-photo .bl-user-icon {font-size:.9375rem}
.best-list .bl-mobile {display:none}
.best-list .bl-mobile.bl-notice {background-color:#FFF8EC}
.best-list .star-ratings-list {width:75px;margin:0 auto}
.best-list .star-ratings-list li {padding:0;float:left;margin-right:0}
.best-list .star-ratings-list li .rating {color:#a5a5a5;font-size:.8125rem;line-height:normal}
.best-list .star-ratings-list li .rating-selected {color:#ab0000;font-size:.8125rem}
.best-list .bl-no-list {text-align:center;color:#959595;padding:70px 0}
.best-list .best-list-footer {margin-top:15px}
.best-list .best-list-footer:after {content:"";display:block;clear:both}
.best-list .best-list-footer .nlf-left {float:left;margin-top:5px}
.best-list .best-list-footer .nlf-right {float:right;margin-top:5px}
@media (max-width:1399px) {
    .best-list .bl-head .bl-num, .best-list .bl-list .bl-num {width:60px}
    .best-list .bl-head .bl-item, .best-list .bl-list .bl-item {width:80px}
    .best-list .bl-head .bl-subj, .best-list .bl-list .bl-subj {width:200px}
}
@media (max-width:991px) {
    .best-list .eyoom-form label {margin-bottom:0}
    .best-list .bl-head {display:none}
    .best-list .bl-head-checkbox {display:table}
    .best-list .bl-head > div:before, .best-list .bl-list > div:before, .best-list .bl-head .bl-item, .best-list .bl-list .bl-item, .best-list .bl-list .bl-author {display:none}
    .best-list .bl-head .bl-num-checkbox, .best-list .bl-list .bl-num-checkbox {display:table-cell;width:20px}
    .best-list .bl-head .bl-num-checkbox .bl-txt, .best-list .bl-list .bl-num-checkbox .bl-txt {visibility:visible;opacity:0}
    .best-list .bl-head .checkbox, .best-list .bl-list .checkbox {z-index:1}
    .best-list .bl-list {border-bottom:0}
    .best-list .bl-list .bl-subj a {padding:0}
    .best-list .bl-list .bl-subj a .subj {font-weight:700}
    .best-list .bl-list .bl-subj .bl-subj-cate {display:inline-block}
    .best-list .bl-mobile {position:relative;display:block;border-bottom:1px solid #eaeaea;padding:0 0 8px;color:#959595}
    .best-list .bl-mobile-right {position:absolute;top:0;right:0}
}
@media (max-width:576px) {
    .best-list .search-bottom > span > .input {width:170px}
    .best-list .search-bottom > span > .select {width:200px}
}
</style>
<?php if ($side_layout['use'] == 'yes') { ?>
<style>
@media (max-width:1199px) {
    .best-list .bl-head {display:none}
    .best-list .bl-head-checkbox {display:table}
    .best-list .bl-head > div:before, .best-list .bl-list > div:before, .best-list .bl-head .bl-item, .best-list .bl-list .bl-item, .best-list .bl-list .bl-author {display:none}
    .best-list .bl-head .bl-num-checkbox, .best-list .bl-list .bl-num-checkbox {display:table-cell;width:20px}
    .best-list .bl-head .bl-num-checkbox .bl-txt, .best-list .bl-list .bl-num-checkbox .bl-txt {visibility:visible;opacity:0}
    .best-list .bl-head .checkbox, .best-list .bl-list .checkbox {z-index:1}
    .best-list .bl-list {border-bottom:0}
    .best-list .bl-list .bl-subj a {padding:0}
    .best-list .bl-list .bl-subj a .subj {font-weight:700}
    .best-list .bl-list .bl-subj .bl-subj-cate {display:inline-block}
    .best-list .bl-mobile {position:relative;display:block;border-bottom:1px solid #eaeaea;padding:0 0 8px;color:#959595}
    .best-list .bl-mobile-right {position:absolute;top:0;right:0}
}
</style>
<?php } ?>

<div class="best-list">
    <form name="fbest" method="get" class="eyoom-form">
    <?php if ($bt) { ?>
    <input type="hidden" name="bt" id="bt" value="<?php echo $bt; ?>">
    <?php } ?>
    <div class="search-box">
        <div class="search-top">
            <button type="button" onclick="javascript:set_date('전체');" class="btn-e btn-e-gray hidden-xs">전체</button>
            <button type="button" onclick="javascript:set_date('오늘');" class="btn-e btn-e-gray">오늘</button>
            <button type="button" onclick="javascript:set_date('일주일');" class="btn-e btn-e-gray">일주일</button>
            <button type="button" onclick="javascript:set_date('이번달');" class="btn-e btn-e-gray">이번달</button>
            <button type="button" onclick="javascript:set_date('지난달');" class="btn-e btn-e-gray">지난달</button>
            <button type="button" onclick="javascript:set_date('1개월');" class="btn-e btn-e-gray">1개월</button>
        </div>
        <div class="search-bottom">
            <span>
                <div class="input">
                    <i class="icon-append far fa-calendar-alt"></i>
                    <input type="text" id="fr_date" name="fr_date" value="<?php echo $fr_date; ?>" maxlength="10">
                </div>
            </span>
            <span> - </span>
            <span>
                <div class="input">
                    <i class="icon-append far fa-calendar-alt"></i>
                    <input type="text" id="to_date" name="to_date" value="<?php echo $to_date; ?>" maxlength="10">
                </div>
            </span>
            <span>
                <div class="select">
                    <select name="sort" id="sort" onchange="this.form.submit();">
                        <option value="" <?php echo !$sort ? 'selected': ''; ?>>::출력순서::</option>
                        <option value="a.wr_good" <?php echo $sort == 'a.wr_good' ? 'selected': ''; ?>>추천수</option>
                        <option value="a.wr_hit" <?php echo $sort == 'a.wr_hit' ? 'selected': ''; ?>>조회수</option>
                    </select>
                    <i></i>
                </div>
            </span>
            <span>
                <button type="button" class="btn-e btn-e-lg btn-e-dark" onclick="best_search();">조회하기</button>
            </span>
        </div>
    </div>
    </form>

    <div class="bl-wrap">
        <div class="bl-head <?php if ($is_admin) { ?>bl-head-checkbox<?php } ?>">
            <div class="bl-item bl-num">
                <span class="bl-txt">순위</span>
            </div>
            <div class="bl-item">게시판</div>
            <div class="bl-subj">제목</div>
            <div class="bl-author">작성자</div>
            <div class="bl-item">조회수</div>
            <div class="bl-item">추천수</div>
            <div class="bl-item">작성일</div>
            <?php if(0) { // 숨김처리 시작 ?>
            <div class="bl-item">인기글등록일</div>
            <?php } // 숨김처리 끝 ?>
        </div>
        <?php for ($i=0; $i<count((array)$bestlist); $i++) { ?>
        <div class="bl-list">
            <div class="bl-item bl-num">
                <span class="bl-txt"><?php echo number_format($bestlist[$i]['num']); ?></span>
                <input type="hidden" name="bo_table[<?php echo $i; ?>]" value="<?php echo $bestlist[$i]['bo_table']; ?>">
                <input type="hidden" name="wr_id[<?php echo $i; ?>]" value="<?php echo $bestlist[$i]['wr_id']; ?>">
            </div>
            <div class="bl-item">
                <a href="<?php echo get_eyoom_pretty_url($bestlist[$i]['bo_table']); ?>"><?php echo $bestlist[$i]['bo_subject']; ?></a>
            </div>
            <div class="bl-subj">
                <span class="bl-subj-cate">[<a href="<?php echo get_eyoom_pretty_url($bestlist[$i]['bo_table']); ?>"><?php echo $bestlist[$i]['bo_subject']; ?></a>]</span>
                <a href="<?php echo $bestlist[$i]['href']; ?>"><span><?php echo $bestlist[$i]['wr_subject']; ?></span></a>
            </div>
            <div class="bl-author">
                <?php echo $bestlist[$i]['name']; ?>
            </div>
            <div class="bl-item">
                <?php echo $bestlist[$i]['wr_hit'] ? number_format($bestlist[$i]['wr_hit']): 0; ?>
            </div>
            <div class="bl-item">
                <?php echo $bestlist[$i]['wr_good'] ? number_format($bestlist[$i]['wr_good']): 0; ?>
            </div>
            <div class="bl-item">
                <?php echo $bestlist[$i]['datetime1']; ?>
            </div>
            <?php if(0) { // 숨김처리 시작 ?>
            <div class="bl-item">
                <?php echo $bestlist[$i]['datetime2']; ?>
            </div>
            <?php } // 숨김처리 끝 ?>
        </div>
        <div class="bl-mobile"><?php /* 991px 이하에서만 보임 */ ?>
            <span class="bl-name-in"><?php echo $bestlist[$i]['name']; ?></span>
            <div class="bl-mobile-right">
                <span><i class="far fa-eye"></i> <?php echo $bestlist[$i]['wr_hit'] ? number_format($bestlist[$i]['wr_hit']): 0; ?></span>
                <span class="m-l-5"><i class="far fa-thumbs-up"></i> <?php echo $bestlist[$i]['wr_good'] ? number_format($bestlist[$i]['wr_good']): 0; ?></span>
                <span class="m-l-5"><i class="far fa-clock"></i> <?php echo $bestlist[$i]['datetime1']; ?></span>
            </div>
        </div>
        <?php } ?>
        <?php if (count((array)$bestlist) == 0) { ?>
        <div class="bl-no-list">
            <i class="fas fa-exclamation-circle"></i> 새글 목록이 없습니다.
        </div>
        <?php } ?>
    </div>
    <div class="m-t-20">
        <?php if ($is_admin) { ?>
        <input type="submit" onclick="document.pressed=this.value" value="선택삭제" class="btn-e btn-e-dark">
        <?php } ?>
    </div>

    </form>
</div>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/eyoom-form/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
function best_search() {
    let fr_date = $('#fr_date').val();
    let to_date = $('#to_date').val();
    let sort = $('#sort').val();
    let url = '<?php echo G5_BBS_URL; ?>/best.php?';
    if (fr_date && to_date) {
        url = url + '&fr_date='+fr_date+'&to_date='+to_date;
    }
    if (sort) {
        url = url + '&sort='+sort;
    }
    document.location.href=url;
}

$(document).ready(function(){
    $('#fr_date').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        prevText: '<i class="fas fa-angle-left"></i>',
        nextText: '<i class="fas fa-angle-right"></i>',
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
        prevText: '<i class="fas fa-angle-left"></i>',
        nextText: '<i class="fas fa-angle-right"></i>',
        showMonthAfterYear: true,
        monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
        onSelect: function(selectedDate){
            $('#fr_date').datepicker('option', 'maxDate', selectedDate);
        }
    });
});

function set_date(today) {
    <?php
    $date_term = date('w', G5_SERVER_TIME);
    $week_term = $date_term + 7;
    $last_term = strtotime(date('Y-m-01', G5_SERVER_TIME));
    ?>
    if (today == "오늘") {
        document.getElementById("fr_date").value = "<?php echo G5_TIME_YMD; ?>";
        document.getElementById("to_date").value = "<?php echo G5_TIME_YMD; ?>";
    } else if (today == "일주일") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME - 86400*6); ?>";
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
    } else if (today == "1개월") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-d', strtotime('-1 Month', G5_SERVER_TIME)); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME); ?>";
    } else if (today == "3개월") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-d', strtotime('-3 Month', G5_SERVER_TIME)); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME); ?>";
    } else if (today == "전체") {
        document.getElementById("fr_date").value = "";
        document.getElementById("to_date").value = "";
    }
}
</script>