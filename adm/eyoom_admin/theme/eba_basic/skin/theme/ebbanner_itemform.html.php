<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/theme/ebbanner_itemform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/magnific-popup/magnific-popup.min.css" type="text/css" media="screen">',0);
?>

<style>
.admin-ebbanner-form .ebbanner-image {width:200px}
</style>

<div class="admin-ebbanner-form">
    <form name="febbannerform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return febbannerform_submit(this);" enctype="multipart/form-data" class="eyoom-form">
    <input type="hidden" name="iw" value="<?php echo $bi_no ? 'u':$iw; ?>">
    <input type="hidden" name="theme" id="theme" value="<?php echo $this_theme ? $this_theme: $theme; ?>">
    <input type="hidden" name="bi_no" id="bi_no" value="<?php echo $bn_item['bi_no']; ?>">
    <input type="hidden" name="bn_code" id="bn_code" value="<?php echo $bn_item['bn_code'] ? $bn_item['bn_code']:$bn_code; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>EB배너 아이템 설정</strong></div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label class="label">게시여부</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <label for="bi_state_1" class="radio"><input type="radio" name="bi_state" id="bi_state_1" value="1" <?php echo $bn_item['bi_state'] == '1' || !$bn_item['bi_state'] ? 'checked':''; ?>><i></i> 보이기</label>
                        <label for="bi_state_2" class="radio"><input type="radio" name="bi_state" id="bi_state_2" value="2" <?php echo $bn_item['bi_state'] == '2' ? 'checked':''; ?>><i></i> 숨기기</label>
                    </div>
                    <div class="note"><strong>Note:</strong> 배너 아이템의 출력여부를 설정합니다.</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="bi_sort" class="label">출력순서</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append fas fa-sort-numeric-down"></i>
                        <input type="text" name="bi_sort" id="bi_sort" value="<?php echo $bn_item['bi_sort'] ? $bn_item['bi_sort']: $bn_max_sort; ?>">
                    </label>
                    <div class="note"><strong>Note:</strong> 출력순서를 결정합니다.</div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="bi_view_level" class="label">보기권한 설정</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="select max-width-250px">
                        <?php echo get_member_level_select('bi_view_level', 1, 10, $bn_item['bi_view_level']); ?><i></i>
                    </label>
                    <div class="note"><strong>Note:</strong> 그누레벨 이상 회원에게 표시</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label class="label">배너 타입</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <label for="bi_type_1" class="radio"><input type="radio" name="bi_type" id="bi_type_1" class="banner-type" value="intra" <?php echo $bn_item['bi_type'] == 'intra' || !$bn_item['bi_type'] ? 'checked':''; ?>><i></i> 내부 배너</label>
                        <label for="bi_type_2" class="radio"><input type="radio" name="bi_type" id="bi_type_2" class="banner-type" value="extra" <?php echo $bn_item['bi_type'] == 'extra' ? 'checked':''; ?>><i></i> 외부 배너</label>
                    </div>
                    <div class="note"><strong>Note:</strong> 외부 배너의 경우, 제공받은 배너 스크립트 소스를 입력해 주세요. </div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="bi_title" class="label">배너 타이틀</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input">
                    <input type="text" name="bi_title" id="bi_title" value="<?php echo $bn_item['bi_title']; ?>">
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="bi_subtitle" class="label">배너 서브 타이틀</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input">
                    <input type="text" name="bi_subtitle" id="bi_subtitle" value="<?php echo $bn_item['bi_subtitle']; ?>">
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">노출 방식</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <label for="bi_period_1" class="radio"><input type="radio" name="bi_period" id="bi_period_1" value="1" class="period-type" <?php echo $bn_item['bi_period'] == '1' || !$bn_item['bi_period'] ? 'checked':''; ?>><i></i> 무제한 방식</label>
                    <label for="bi_period_2" class="radio"><input type="radio" name="bi_period" id="bi_period_2" value="2" class="period-type" <?php echo $bn_item['bi_period'] == '2' ? 'checked':''; ?>><i></i> 기간제 방식</label>
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
                        <label for="bi_start" class="input width-200px">
                            <i class="icon-prepend">시작</i>
                            <i class="icon-append far fa-calendar-alt"></i>
                            <input type="text" name="bi_start" id="bi_start" value="<?php echo $bn_item['bi_start']; ?>" class="text-end">
                        </label>
                    </span>
                    <span>
                        <label for="bi_start" class="input width-200px">
                            <i class="icon-prepend">종료</i>
                            <i class="icon-append far fa-calendar-alt"></i>
                            <input type="text" name="bi_end" id="bi_end" value="<?php echo $bn_item['bi_end']; ?>" class="text-end">
                        </label>
                    </span>
                </div>
                <div class="note"><strong>Note:</strong> 노출 시작일과 종료일은 기간제 방식에만 적용됩니다.</div>
            </div>
        </div>
        <div class="adm-form-tr in_banner">
            <div class="adm-form-td td-l">
                <label for="bi_link" class="label">연결주소 [링크]</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="select width-150px m-b-10">
                    <select name="bi_target" id="bi_target">
                        <option value="">타겟을 선택하세요.</option>
                        <option value="_blank" <?php echo $bn_item['bi_target'] == '_blank' ? 'selected':''; ?>>새창</option>
                        <option value="_self" <?php echo $bn_item['bi_target'] == '_self' ? 'selected':''; ?>>현재창</option>
                    </select><i></i>
                </label>
                <label class="input">
                    <i class="icon-append fas fa-link"></i>
                    <input type="text" name="bi_link" id="bi_link" value="<?php echo $bn_item['bi_link']; ?>">
                </label>
                <div class="note"><strong>Note:</strong> EB배너 아이템에 사용할 링크주소를 입력해 주세요.</div>
            </div>
        </div>
        <?php for($i=0; $i<2; $i++) { ?>
        <div class="adm-form-tr in_banner">
            <div class="adm-form-td td-l">
                <label class="label"><?php echo $i==0 ? 'PC용 ': '모바일용 '; ?>이미지</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="input">
                    <input type="file" class="form-control" name="bi_img[<?php echo $i; ?>]" id="bi_img_<?php echo $i; ?>">
                </div>
                <?php if ($bi_img[$i]) { ?>
                <div class="bi_img_info">
                    <label for="bi_img_del_<?php echo $i; ?>" class="checkbox"><input type="checkbox" id="bi_img_del_<?php echo $i; ?>" name="bi_img_del[<?php echo $i; ?>]" value="1"><i></i><?php echo $bi_img[$i]; ?> 파일삭제</label>
                    <input type="hidden" name="del_img_name[<?php echo $i; ?>]" value="<?php echo $bi_img[$i]; ?>">
                    <div class="thumbnail ebbanner-image">
                        <div class="thumb">
                            <img src="<?php echo $bi_url[$i]; ?>">
                            <div class="caption-overflow">
                                <span>
                                    <a href="<?php echo $bi_url[$i]; ?>" class="btn-e btn-e-gray btn-e-lg btn-e-brd"><i class="fas fa-plus text-white"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="note"><strong>Note:</strong> EB배너 아이템에 이미지를 업로드해 주세요.</div>
            </div>
        </div>
        <?php } ?>
        <div class="adm-form-tr ex_banner">
            <div class="adm-form-td td-l">
                <label for="bi_script" class="label">배너 스크립트 소스</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="textarea">
                    <textarea name="bi_script" id="bi_script" rows="8"><?php echo $bn_item['bi_script']; ?></textarea>
                </label>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit; ?>
    </div>

    </form>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/magnific-popup/magnific-popup.min.js"></script>
<script>
$(document).ready(function(){
    $('#bi_start').datepicker({
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
            $('#bi_end').datepicker('option', 'minDate', selectedDate);
        }
    });
    $('#bi_end').datepicker({
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
            $('#bi_start').datepicker('option', 'maxDate', selectedDate);
        }
    });
});

$(function() {
    var ptype = '<?php echo $bn_item['bi_period']; ?>';
    if (!ptype) ptype = '1';
    period_showhide(ptype);

    $(".period-type").click(function() {
        var type = $(this).val();
        period_showhide(type);
    });

    var btype = '<?php echo $bn_item['bi_type']; ?>';
    if (!btype) btype = 'intra';
    btype_showhide(btype);

    $(".banner-type").click(function() {
        var type = $(this).val();
        btype_showhide(type);
    });
});

function period_showhide(type) {
    switch(type) {
        case '1': $("#date-period").hide(); break;
        case '2': $("#date-period").show(); break;
    }
}

function btype_showhide(type) {
    switch(type) {
        case 'intra': $(".ex_banner").hide(); $(".in_banner").show(); break;
        case 'extra': $(".ex_banner").show(); $(".in_banner").hide(); break;
    }
}

function febbannerform_submit(f) {

    if ($(':radio[name="bi_period"]:checked').val() == '2') {
        if ( !($('#bi_start').val() && $('#bi_end').val()) ) {
            alert('기간제로 선택할 경우, 시작일과 종료일은 필수항목입니다.');
            if (!$('#bi_start').val()) {
                $('#bi_start').focus();
            } else if (!$('#bi_end').val()) {
                $('#bi_end').focus();
            }
            return false;
        }
    }
    return true;
}

$(document).ready(function() {
    $('.ebbanner-image').magnificPopup({
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