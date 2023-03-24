<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/theme/ebslider_ytitemform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-ebslider-form">
    <form name="febsliderform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return febsliderform_submit(this);" class="eyoom-form">
    <input type="hidden" name="iw" value="<?php echo $ei_no ? 'u':$iw; ?>">
    <input type="hidden" name="theme" id="theme" value="<?php echo $this_theme ? $this_theme: $theme; ?>">
    <input type="hidden" name="ei_no" id="ei_no" value="<?php echo $es_item['ei_no']; ?>">
    <input type="hidden" name="es_code" id="es_code" value="<?php echo $es_item['es_code'] ? $es_item['es_code']:$es_code; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>EB슬라이더 유튜브동영상 아이템 설정</strong></div>
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
                <label class="select max-width-150px">
                    <?php echo get_member_level_select('ei_view_level', 1, 10, $es_item['ei_view_level']); ?><i></i>
                </label>
                <div class="note"><strong>Note:</strong> 그누레벨 이상 회원에게 표시</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="ei_ytcode" class="label">유튜브 동영상 공유 코드</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <i class="icon-prepend fab fa-youtube"></i>
                    <input type="text" name="ei_ytcode" id="ei_ytcode" value="<?php echo $es_item['ei_ytcode']; ?>" required>
                </label>
                <div class="note">
                    <strong>Note:</strong> https://www.youtube.com/watch?v=<strong class='color-red'>vr0qNXmkUJ8</strong><br>위의 붉은색과 같은 형식의 추가하고자 하는 동영상의 코드만 입력해 주세요.
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">유튜브 동영상 품질</label>
            </div>
            <div class="adm-form-td td-r">
                <label for="ei_quality" class="select max-width-150px">
                    <select name="ei_quality" id="ei_quality">
                        <option value="small" <?php echo $es_item['ei_quality'] == 'small' ? 'selected':''; ?>>small</option>
                        <option value="medium" <?php echo $es_item['ei_quality'] == 'medium' ? 'selected':''; ?>>medium</option>
                        <option value="large" <?php echo $es_item['ei_quality'] == 'large' ? 'selected':''; ?>>large</option>
                        <option value="hd720" <?php echo $es_item['ei_quality'] == 'hd720' ? 'selected':''; ?>>hd720</option>
                        <option value="hd1080" <?php echo $es_item['ei_quality'] == 'hd1080' || $w == '' ? 'selected':''; ?>>hd1080</option>
                        <option value="highres" <?php echo $es_item['ei_quality'] == 'highres' ? 'selected':''; ?>>highres</option>
                    </select><i></i>
                </label>
                <div class="note"><strong>Note:</strong> 트래픽을 고려하여 적당한 품질의 동영상으로 선택해 주세요. (모바일의 경우 자동으로 small 적용)</div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label class="label">자동실행 여부</label>
                </div>
                <div class="adm-form-td td-r">
                    <label for="ei_autoplay" class="checkbox">
                        <input type="checkbox" name="ei_autoplay" id="ei_autoplay" value="1" <?php echo $es_item['ei_autoplay'] == '1' || $w == '' ? 'checked':''; ?>><i></i> 자동실행
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label class="label">제어판</label>
                </div>
                <div class="adm-form-td td-r">
                    <label for="ei_control" class="checkbox">
                        <input type="checkbox" name="ei_control" id="ei_control" value="1" <?php echo $es_item['ei_control'] == '1' || $w == '' ? 'checked':''; ?>><i></i> 보이기
                    </label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label class="label">무한반복재생</label>
                </div>
                <div class="adm-form-td td-r">
                    <label for="ei_loop" class="checkbox">
                        <input type="checkbox" name="ei_loop" id="ei_loop" value="1" <?php echo $es_item['ei_loop'] == '1' || $w == '' ? 'checked':''; ?>><i></i> 반복 재생하기
                    </label>
                    <div class="note"><strong>Note:</strong> 반복 재생하기 체크 시 동영상 등록을 2개 이상 할 경우 다음 동영상으로 연결 안됨</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label class="label">음소거</label>
                </div>
                <div class="adm-form-td td-r">
                    <label for="ei_mute" class="checkbox">
                        <input type="checkbox" name="ei_mute" id="ei_mute" value="1" <?php echo $es_item['ei_mute'] == '1' || $w == '' ? 'checked':''; ?>><i></i> 음소거
                    </label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="ei_volumn" class="label">음량 (볼륨)</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="select max-width-250px">
                        <select name="ei_volumn" id="ei_volumn">
                            <option value="10" <?php echo $es_item['ei_volumn'] == '10' ? 'selected':''; ?>>10</option>
                            <option value="20" <?php echo $es_item['ei_volumn'] == '20' ? 'selected':''; ?>>20</option>
                            <option value="30" <?php echo $es_item['ei_volumn'] == '30' ? 'selected':''; ?>>30</option>
                            <option value="40" <?php echo $es_item['ei_volumn'] == '40' ? 'selected':''; ?>>40</option>
                            <option value="50" <?php echo $es_item['ei_volumn'] == '50' ? 'selected':''; ?>>50</option>
                            <option value="60" <?php echo $es_item['ei_volumn'] == '60' ? 'selected':''; ?>>60</option>
                            <option value="70" <?php echo $es_item['ei_volumn'] == '70' ? 'selected':''; ?>>70</option>
                            <option value="80" <?php echo $es_item['ei_volumn'] == '80' ? 'selected':''; ?>>80</option>
                            <option value="90" <?php echo $es_item['ei_volumn'] == '90' ? 'selected':''; ?>>90</option>
                            <option value="100" <?php echo $es_item['ei_volumn'] == '100' ? 'selected':''; ?>>100</option>
                        </select><i></i>
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label class="label">투명 패턴</label>
                </div>
                <div class="adm-form-td td-r">
                    <label for="ei_raster" class="checkbox">
                        <input type="checkbox" name="ei_raster" id="ei_raster" value="1" <?php echo $es_item['ei_raster'] == '1' || $iw == '' ? 'checked':''; ?>><i></i> 보이기
                    </label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="ei_stime" class="label">동영상 시작위치</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append">초</i>
                        <input type="text" name="ei_stime" id="ei_stime" value="<?php echo $es_item['ei_stime'] ? $es_item['ei_stime']:'0'; ?>" class="text-end">
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="ei_etime" class="label">동영상 종료위치</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append">초</i>
                        <input type="text" name="ei_etime" id="ei_etime" value="<?php echo $es_item['ei_etime'] ? $es_item['ei_etime']:'0'; ?>" class="text-end">
                    </label>
                    <div class="note"><strong>Note:</strong> 끝까지 플레이할 경우: 0</div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="ei_remember" class="label">디스플레이 최적화</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="checkbox">
                    <input type="checkbox" name="ei_remember" id="ei_remember" value="1" <?php echo $es_item['ei_remember'] == '1' || $iw == '' ? 'checked':''; ?>><i></i> 최적화
                </label>
                <div class="note"><strong>Note:</strong> 최적화는 원본보다 동영상 화면을 확대하여 유튜브 광고를 숨김처리 (체크 해제 시 원본 크기로 출력되며 유튜브 광고가 있을 경우 출력되며 광고는 지울 수 없습니다.)</div>
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
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit; ?>
    </div>

    </form>
</div>

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
    if (f.ei_ytcode.value.length < 5) {
        alert('유튜브 동영상 고유코드를 정확하게 입력해 주세요.');
        f.ei_ytcode.focus();
        f.ei_ytcode.select();
        return false;
    }
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
</script>