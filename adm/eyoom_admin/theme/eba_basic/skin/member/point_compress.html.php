<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/member/point_compress.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'point_compress';
$g5_title = '포인트 압축하기';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">회원관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-compress-form">
    <form name="fcompressform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fcompress_check(this)" class="eyoom-form">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>압축조건 설정</strong></div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label class="label">테이블 백업</label>
                </div>
                <div class="adm-form-td td-r">
                    <label for="backup_use" class="checkbox">
                        <input type="checkbox" name="backup_use" id="backup_use" value="y" checked="checked"><i></i> 사용 (체크시, <?php echo $g5['point_table']; ?> 테이블을 <?php echo $g5['point_table']; ?>_YmdHis 형식으로 백업)
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label class="label">압축일자 지정</label>
                </div>
                <div class="adm-form-td td-r">
                    <label for="zip_date" class="input max-width-250px">
                        <input type="text" name="zip_date" id="zip_date" value="<?php echo date('Y-m-d', strtotime('-1day')); ?>">
                    </label>
                    <div class="note"><strong>Note:</strong> 지정일을 포함하여 이전의 모든 포인트 내역을 압축합니다.</div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label class="label">단위 압축회원수</label>
                </div>
                <div class="adm-form-td td-r">
                    <label for="zip_count" class="input max-width-250px">
                        <i class="icon-append">명</i>
                        <input type="text" name="zip_count" id="zip_count" value="200">
                    </label>
                    <div class="note"><strong>Note:</strong> DB에 부하를 줄 수 있기 때문에 적당히 숫자를 조절해 주세요. (전체 일괄작업시, 숫자 '0' 입력)</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label class="label">포인트 내역수</label>
                </div>
                <div class="adm-form-td td-r">
                    <label for="zip_item" class="input max-width-250px">
                        <i class="icon-append">건</i>
                        <input type="text" name="zip_item" id="zip_item" value="10">
                    </label>
                    <div class="note"><strong>Note:</strong>포인트 내역이 지정한 숫자 이상인 회원만 압축하기(최소 10건 이상)</div>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($mcnt) || isset($pcnt)) { ?>
    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>압축결과</strong></div>
        <div class="adm-form-cont">
            <div class="text-center m-t-30 m-b-30">
                <h5 class="m-b-10">압축회원수</h5>
                <p><strong><?php echo number_format($mcnt); ?></strong> 명 (압축회원수가 0이 될때까지 적용하시면 됩니다.)</p>
            </div>
        </div>
        <div class="adm-form-cont">
            <div class="text-center m-t-30 m-b-30">
                <h5 class="m-b-10">압축된 포인트 내역</h5>
                <p><strong><?php echo number_format($pcnt); ?></strong> 건의 포인트 내역이 압축되었습니다.</p>
            </div>
        </div>
    </div>
    <?php } ?>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit;?>
    </div>

    </form>
</div>

<script>
function fpointzip_check(f) {
    if($("#zip_date").val().length != '10') {
        alert('압축일자를 정확히 입력해 주세요.');
        f.zip_date.focus();
        return false;
    }
    if($("#zip_count").val() == '') {
        alert('단위 압축회원수를 입력해 주세요.');
        f.zip_count.focus();
        return false;
    }
    if($("#zip_item").val() == '' || parseInt($("#zip_item").val()) < 10) {
        alert('포인트 내역수는 10보다 큰 정수여야 합니다.');
        f.zip_item.focus();
        return false;
    }
    if(!confirm("정말로 그누포인트를 압축하실 건가요?")) return false;
}

$(document).ready(function(){
    $('#zip_date').datepicker({
        dateFormat: 'yy-mm-dd',
        prevText: '◁',
        nextText: '▷',
        showMonthAfterYear: true,
        monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
    });
})
</script>