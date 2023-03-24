<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/theme/ebslider_itemform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/magnific-popup/magnific-popup.min.css" type="text/css" media="screen">',0);
?>

<style>
.admin-ebslider-form .ebslider-image {width:200px}
</style>

<div class="admin-ebslider-form">
	<form name="febsliderform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return febsliderform_submit(this);" enctype="multipart/form-data" class="eyoom-form">
	<input type="hidden" name="iw" value="<?php echo $ei_no ? 'u':$iw; ?>">
	<input type="hidden" name="theme" id="theme" value="<?php echo $this_theme ? $this_theme: $theme; ?>">
	<input type="hidden" name="ei_no" id="ei_no" value="<?php echo $es_item['ei_no']; ?>">
	<input type="hidden" name="es_code" id="es_code" value="<?php echo $es_item['es_code'] ? $es_item['es_code']:$es_code; ?>">
	<input type="hidden" name="page" value="<?php echo $page; ?>">
	<input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
	<input type="hidden" name="token" value="">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>EB슬라이더 아이템 설정</strong></div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label class="label">게시여부</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <label for="ei_state_1" class="radio"><input type="radio" name="ei_state" id="ei_state_1" value="1" <?php echo $es_item['ei_state'] == '1' || !$es_item['ei_state'] ? 'checked':''; ?>><i></i> 보이기</label>
                        <label for="ei_state_2" class="radio"><input type="radio" name="ei_state" id="ei_state_2" value="2" <?php echo $es_item['ei_state'] == '2' ? 'checked':''; ?>><i></i> 숨기기</label>
                    </div>
                    <div class="note"><strong>Note:</strong> 슬라이더 아이템의 출력여부를 설정합니다.</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="ei_sort" class="label">출력순서</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append fas fa-sort-numeric-down"></i>
                        <input type="text" name="ei_sort" id="ei_sort" value="<?php echo $es_item['ei_sort'] ? $es_item['ei_sort']: $es_max_sort; ?>">
                    </label>
                    <div class="note"><strong>Note:</strong> 출력순서를 결정합니다.</div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="ei_view_level" class="label">보기권한 설정</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="select max-width-250px">
                    <?php echo get_member_level_select('ei_view_level', 1, 10, $es_item['ei_view_level']); ?><i></i>
                </label>
                <div class="note"><strong>Note:</strong> 그누레벨 이상 회원에게 표시</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="ei_title" class="label">대표 타이틀</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input">
                    <input type="text" name="ei_title" id="ei_title" value="<?php echo $es_item['ei_title']; ?>">
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="ei_subtitle" class="label">서브 타이틀</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input">
                    <input type="text" name="ei_subtitle" id="ei_subtitle" value="<?php echo $es_item['ei_subtitle']; ?>">
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="ei_text" class="label">설명문구</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="textarea">
                    <textarea name="ei_text" id="ei_text" rows="4"><?php echo $es_item['ei_text']; ?></textarea>
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">노출 방식</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <label for="ei_period_1" class="radio"><input type="radio" name="ei_period" id="ei_period_1" value="1" class="period-type" <?php echo $es_item['ei_period'] == '1' || !$es_item['ei_period'] ? 'checked':''; ?>><i></i> 무제한 방식</label>
                    <label for="ei_period_2" class="radio"><input type="radio" name="ei_period" id="ei_period_2" value="2" class="period-type" <?php echo $es_item['ei_period'] == '2' ? 'checked':''; ?>><i></i> 기간제 방식</label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr" id="date-period">
            <div class="adm-form-td td-l">
                <label class="label">노출 기간</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <span>
                        <label for="ei_start" class="input width-200px">
                            <i class="icon-prepend">시작</i>
                            <i class="icon-append far fa-calendar-alt"></i>
                            <input type="text" name="ei_start" id="ei_start" value="<?php echo $es_item['ei_start']; ?>" class="text-end">
                        </label>
                    </span>
                    <span>
                        <label for="ei_start" class="input width-200px">
                            <i class="icon-prepend">종료</i>
                            <i class="icon-append far fa-calendar-alt"></i>
                            <input type="text" name="ei_end" id="ei_end" value="<?php echo $es_item['ei_end']; ?>" class="text-end">
                        </label>
                    </span>
                </div>
                <div class="note"><strong>Note:</strong> 노출 시작일과 종료일은 기간제 방식에만 적용됩니다.</div>
            </div>
        </div>
        <?php for($i=0; $i<$es['es_link_cnt']; $i++) { ?>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label class="label">연결주소 [링크] #<?php echo $i+1; ?></label>
            </div>
            <div class="adm-form-td td-r">
                <label class="select width-150px m-b-10">
                    <select name="ei_target[<?php echo $i; ?>]" id="ei_target_<?php echo $i; ?>">
                        <option value="">타겟을 선택하세요.</option>
                        <option value="_blank" <?php echo $ei_target[$i] == '_blank' ? 'selected':''; ?>>새창</option>
                        <option value="_self" <?php echo $ei_target[$i] == '_self' ? 'selected':''; ?>>현재창</option>
                    </select><i></i>
                </label>
                <label class="input">
                    <i class="icon-append fas fa-link"></i>
                    <input type="text" name="ei_link[<?php echo $i; ?>]" id="ei_link_<?php echo $i; ?>" value="<?php echo $ei_link[$i]; ?>">
                </label>
                <div class="note"><strong>Note:</strong> EB슬라이더 아이템에 사용할 링크주소를 입력해 주세요.</div>
            </div>
        </div>
        <?php } ?>
        <?php for($i=0; $i<$es['es_image_cnt']; $i++) { ?>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label class="label">이미지 #<?php echo $i+1; ?></label>
            </div>
            <div class="adm-form-td td-r">
                <div class="input">
                    <input type="file" class="form-control" name="ei_img[<?php echo $i; ?>]" id="ei_img_<?php echo $i; ?>">
                </div>
                <?php if ($ei_img[$i]) { ?>
                <div class="ei_img_info">
                    <label for="ei_img_del_<?php echo $i; ?>" class="checkbox"><input type="checkbox" id="ei_img_del_<?php echo $i; ?>" name="ei_img_del[<?php echo $i; ?>]" value="1"><i></i><?php echo $ei_img[$i]; ?> 파일삭제</label>
                    <input type="hidden" name="del_img_name[<?php echo $i; ?>]" value="<?php echo $ei_img[$i]; ?>">
                    <div class="thumbnail ebslider-image">
                        <div class="thumb">
                            <img src="<?php echo $ei_url[$i]; ?>">
                            <div class="caption-overflow">
                                <span>
                                    <a href="<?php echo $ei_url[$i]; ?>" class="btn-e btn-e-gray btn-e-lg btn-e-brd"><i class="fas fa-plus text-white"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="note"><strong>Note:</strong> EB슬라이더 아이템에 이미지를 업로드해 주세요.</div>
            </div>
        </div>
        <?php } ?>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit; ?>
    </div>

    </form>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/magnific-popup/magnific-popup.min.js"></script>
<script>
$(document).ready(function(){
    $('#ei_start').datepicker({
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
            $('#ei_end').datepicker('option', 'minDate', selectedDate);
        }
    });
    $('#ei_end').datepicker({
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
            $('#ei_start').datepicker('option', 'maxDate', selectedDate);
        }
    });
});

$(function() {
    var ptype = '<?php echo $es_item['ei_period']; ?>';
    if (!ptype) ptype = '1';
    period_showhide(ptype);

    $(".period-type").click(function() {
        var type = $(this).val();
        period_showhide(type);
    });
});

function period_showhide(type) {
    switch(type) {
        case '1': $("#date-period").hide(); break;
        case '2': $("#date-period").show(); break;
    }
}

function febsliderform_submit(f) {

    if ($(':radio[name="ei_period"]:checked').val() == '2') {
        if ( !($('#ei_start').val() && $('#ei_end').val()) ) {
            alert('기간제로 선택할 경우, 시작일과 종료일은 필수항목입니다.');
            if (!$('#ei_start').val()) {
                $('#ei_start').focus();
            } else if (!$('#ei_end').val()) {
                $('#ei_end').focus();
            }
            return false;
        }
    }
    return true;
}

$(document).ready(function() {
    $('.ebslider-image').magnificPopup({
        delegate: 'a',
        type: 'image',
        tLoading: '로딩중...',
        mainClass: 'mfp-img-mobile',
        image: {
            tError: '이미지를 불러올수 없습니다.'
        }
    });
});
</script>