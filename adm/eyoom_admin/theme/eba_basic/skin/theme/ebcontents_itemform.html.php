<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/theme/ebcontents_itemform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/magnific-popup/magnific-popup.min.css" type="text/css" media="screen">',0);
if ($config['cf_editor'] == 'tuieditor') echo tuieditor_resource();
?>

<style>
.admin-ebcontents-form .ebcontents-image {width:200px}
</style>

<div class="admin-ebcontents-form">
    <div class="adm-headline">
        <h3>EB콘텐츠 아이템</h3>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebcontents_itemlist&amp;ec_code=<?php echo $ec_item['ec_code'] ? $ec_item['ec_code']:$ec_code; ?>&amp;wmode=1" class="btn-e btn-e-md btn-e-dark adm-headline-btn"><span>목록보기</span></a>
    </div>

    <blockquote class="hero">
        <p>마스터코드 - <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebcontents_form&amp;thema=<?php echo $this_theme; ?>&amp;ec_code=<?php echo $ec_item['ec_code'] ? $ec_item['ec_code']:$ec_code; ?>&amp;w=u&amp;wmode=1" class="btn-e btn-e-dark btn-e-sm margin-left-10"><?php echo $ec_item['ec_code'] ? $ec_item['ec_code']:$ec_code; ?></a></p>
    </blockquote>

    <form name="fcontentsform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fcontentsform_submit(this);" enctype="multipart/form-data" class="eyoom-form">
    <input type="hidden" name="iw" value="<?php echo $ci_no ? 'u':$iw; ?>">
    <input type="hidden" name="theme" id="theme" value="<?php echo $this_theme ? $this_theme: $theme; ?>">
    <input type="hidden" name="ci_no" id="ci_no" value="<?php echo $ec_item['ci_no']; ?>">
    <input type="hidden" name="ec_code" id="ec_code" value="<?php echo $ec_item['ec_code'] ? $ec_item['ec_code']:$ec_code; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>EB콘텐츠 아이템 설정</strong></div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label class="label">게시여부</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <label for="ci_state_1" class="radio"><input type="radio" name="ci_state" id="ci_state_1" value="1" <?php echo $ec_item['ci_state'] == '1' || !$ec_item['ci_state'] ? 'checked':''; ?>><i></i> 보이기</label>
                        <label for="ci_state_2" class="radio"><input type="radio" name="ci_state" id="ci_state_2" value="2" <?php echo $ec_item['ci_state'] == '2' ? 'checked':''; ?>><i></i> 숨기기</label>
                    </div>
                    <div class="note"><strong>Note:</strong> 콘텐츠 아이템의 출력여부를 설정합니다.</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="ei_sort" class="label">출력순서</label>
                </div>
                <div class="adm-form-td td-r">
                    <label for="ci_sort" class="input max-width-250px">
                        <i class="icon-append fas fa-sort-numeric-down"></i>
                        <input type="text" name="ci_sort" id="ci_sort" value="<?php echo $ec_item['ci_sort'] ? $ec_item['ci_sort']: $ec_max_sort; ?>">
                    </label>
                    <div class="note"><strong>Note:</strong> 출력순서를 결정합니다.</div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">보기권한 설정</label>
            </div>
            <div class="adm-form-td td-r">
                <label for="ci_view_level" class="select max-width-250px">
                    <?php echo get_member_level_select('ci_view_level', 1, 10, $ec_item['ci_view_level']); ?><i></i>
                </label>
                <div class="note"><strong>Note:</strong> 그누레벨 이상 회원에게 표시</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">노출 방식</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <label for="ci_period_1" class="radio"><input type="radio" name="ci_period" id="ci_period_1" value="1" class="period-type" <?php echo $ec_item['ci_period'] == '1' || !$ec_item['ci_period'] ? 'checked':''; ?>><i></i> 무제한 방식</label>
                    <label for="ci_period_2" class="radio"><input type="radio" name="ci_period" id="ci_period_2" value="2" class="period-type" <?php echo $ec_item['ci_period'] == '2' ? 'checked':''; ?>><i></i> 기간제 방식</label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">노출 기간</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <span>
                        <label for="ci_start" class="input width-250px">
                            <i class="icon-prepend">시작</i>
                            <i class="icon-append far fa-calendar-alt"></i>
                            <input type="text" name="ci_start" id="ci_start" value="<?php echo $ec_item['ci_start']; ?>" class="text-end">
                        </label>
                    </span>
                    <span>
                        <label for="ci_start" class="input width-250px">
                            <i class="icon-prepend">종료</i>
                            <i class="icon-append far fa-calendar-alt"></i>
                            <input type="text" name="ci_end" id="ci_end" value="<?php echo $ec_item['ci_end']; ?>" class="text-end">
                        </label>
                    </span>
                </div>
                <div class="note"><strong>Note:</strong> 노출 시작일과 종료일은 기간제 방식에만 적용됩니다.</div>
            </div>
        </div>
        <?php for($i=0; $i<$ec['ec_ext_cnt']; $i++) { ?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">텍스트 필드 #<?php echo $i+1; ?></label>
            </div>
            <div class="adm-form-td td-r">
                <label for="ci_subject_<?php echo $i+1; ?>" class="input">
                    <input type="text" name="ci_subject[]" id="ci_subject_<?php echo $i+1; ?>" value="<?php echo $ec_item['ci_subject_'.($i+1)]; ?>">
                </label>
            </div>
        </div>
        <?php } ?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">설명글 #1</label>
            </div>
            <div class="adm-form-td td-r">
                <label for="ci_text_1" class="textarea">
                    <textarea name="ci_text[]" id="ci_text_1" rows="4"><?php echo $ec_item['ci_text_1']; ?></textarea>
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">설명글 #2</label>
            </div>
            <div class="adm-form-td td-r">
                <label for="ci_text_2" class="textarea">
                    <textarea name="ci_text[]" id="ci_text_2" rows="4"><?php echo $ec_item['ci_text_2']; ?></textarea>
                </label>
            </div>
        </div>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label class="label">내용</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="textarea">
                    <?php echo editor_html("ci_content", stripslashes($ci['ci_content'])); ?>
                </div>
            </div>
        </div>
        <?php for($i=0; $i<$ec['ec_link_cnt']; $i++) { ?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">연결주소 [링크] #<?php echo $i+1; ?></label>
            </div>
            <div class="adm-form-td td-r">
                <label class="select width-150px m-b-10">
                    <select name="ci_target[<?php echo $i; ?>]" id="ci_target_<?php echo $i; ?>">
                        <option value="">타겟을 선택하세요.</option>
                        <option value="_blank" <?php echo $ci_target[$i] == '_blank' ? 'selected':''; ?>>새창</option>
                        <option value="_self" <?php echo $ci_target[$i] == '_self' ? 'selected':''; ?>>현재창</option>
                    </select><i></i>
                </label>
                <label class="input">
                    <i class="icon-prepend fas fa-link"></i>
                    <input type="text" name="ci_link[<?php echo $i; ?>]" id="ci_link_<?php echo $i; ?>" value="<?php echo $ci_link[$i]; ?>">
                </label>
                <div class="note"><strong>Note:</strong> EB콘텐츠 아이템에 사용할 링크주소를 입력해 주세요.</div>
            </div>
        </div>
        <?php } ?>
        <?php for($i=0; $i<$ec['ec_image_cnt']; $i++) { ?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">이미지 #<?php echo $i+1; ?></label>
            </div>
            <div class="adm-form-td td-r">
                <div class="input">
					<input type="file" class="form-control" name="ci_img[<?php echo $i; ?>]" id="ci_img_<?php echo $i; ?>">
				</div>
				<?php if ($ci_img[$i]) { ?>
				<div class="ec_img_info">
                    <label for="ci_img_del_<?php echo $i; ?>" class="checkbox"><input type="checkbox" id="ci_img_del_<?php echo $i; ?>" name="ci_img_del[<?php echo $i; ?>]" value="1"><i></i><?php echo $ci_img[$i]; ?> 파일삭제</label>
					<input type="hidden" name="del_img_name[<?php echo $i; ?>]" value="<?php echo $ci_img[$i]; ?>">
					<div class="thumbnail ebcontents-image">
						<div class="thumb">
							<img src="<?php echo $ci_url[$i]; ?>" class="img-fluid">
							<div class="caption-overflow">
								<span>
									<a href="<?php echo $ci_url[$i]; ?>" class="btn-e btn-e-gray btn-e-lg btn-e-brd"><i class="fas fa-plus text-white"></i></a>
								</span>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
				<div class="note"><strong>Note:</strong> EB콘텐츠 아이템에 사용할 링크주소를 입력해 주세요.</div>
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
    $('#ci_start').datepicker({
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
            $('#ci_end').datepicker('option', 'minDate', selectedDate);
        }
    });
    $('#ci_end').datepicker({
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
            $('#ci_start').datepicker('option', 'maxDate', selectedDate);
        }
    });
});

$(function() {
    var ptype = '<?php echo $ec_item['ci_period']; ?>';
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

function fcontentsform_submit(f) {

    if ($(':radio[name="ci_period"]:checked').val() == '2') {
        if ( !($('#ci_start').val() && $('#ci_end').val()) ) {
            alert('기간제로 선택할 경우, 시작일과 종료일은 필수항목입니다.');
            if (!$('#ci_start').val()) {
                $('#ci_start').focus();
            } else if (!$('#ci_end').val()) {
                $('#ci_end').focus();
            }
            return false;
        }
    }

    <?php echo get_editor_js('ci_content'); ?>

    return true;
}

$(document).ready(function() {
    $('.ebcontents-image').magnificPopup({
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