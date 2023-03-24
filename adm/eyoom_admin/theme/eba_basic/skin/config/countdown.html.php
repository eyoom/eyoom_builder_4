<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/config/countdown.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'countdown';
$g5_title = '공사중 설정';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">환경설정</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';

$frm_eba_submit  = ' <div class="confirm-fixed-btn"> ';
$frm_eba_submit .= ' <input type="submit" value="적용하기" class="btn-e btn-e-md btn-e-crimson" accesskey="s">' ;
$frm_eba_submit .= '</div>';
$frm_submit .= $frm_eba_submit;
?>

<div class="admin-countdown-form">
    <form name="fcountdownform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fcountdown_check(this)" class="eyoom-form">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>기본설정</strong></div>
        <div class="adm-form-info">
            <div class="cont-text-bg">
                <p class="bg-info">
                    <i class="fas fa-info-circle"></i> 홈페이지 개편이나 신규제작 시, 홈페이지 메인을 공사중 페이지로 설정하실 수 있습니다.<br>
                    <i class="fas fa-info-circle"></i> 오픈 예정일을 설정해 놓으면 자동으로 해당일에 홈페이지가 공개됩니다.
                </p>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">타이틀</label>
            </div>
            <div class="adm-form-td td-r">
                <label for="cd_title" class="input">
                    <input type="text" name="cd_title" id="cd_title" value="<?php echo $countdown['cd_title']; ?>">
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">공사중 사용여부</label>
            </div>
            <div class="adm-form-td td-r">
                <label for="cd_use" class="checkbox">
                    <input type="checkbox" name="cd_use" value="y" id="cd_use" <?php echo $countdown['cd_use'] == 'y' ? 'checked': ''; ?>><i></i> 사용
                </label>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label class="label">스킨선택</label>
                </div>
                <div class="adm-form-td td-r">
                    <label for="cd_skin" class="select max-width-250px">
                        <select name="cd_skin" id="cd_skin">
                            <option value="">::스킨선택::</option>
                            <?php for ($i=0; $i<count((array)$skins); $i++) { ?>
                            <option value="<?php echo $skins[$i]; ?>" <?php echo $skins[$i] == $countdown['cd_skin'] ? 'selected': ''; ?>><?php echo $skins[$i]; ?></option>
                            <?php } ?>
                        </select><i></i>
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label class="label">오픈예정일</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <span>
                            <label for="cd_date" class="input max-width-250px">
                                <i class="icon-append far fa-calendar-alt"></i>
                                <input type="text" name="cd_date" id="cd_date" value="<?php echo $open_date['mktime'] ? date('Y-m-d', $open_date['mktime']): ''; ?>" autocomplete="off">
                            </label>
                        </span>
                        <span>
                            <label for="cd_hour" class="select max-width-150px">
                                <select name="cd_hour" id="cd_hour">
                                    <option value="">::시간 선택::</option>
                                    <?php for ($i=0; $i<24; $i++) { ?>
                                    <option value="<?php echo $i<10 ? '0'.$i: $i; ?>" <?php echo $open_date['hour'] == $i ? 'selected': ''; ?>><?php echo $i<10 ? '0'.$i: $i; ?></option>
                                    <?php } ?>
                                </select><i></i>
                            </label>
                        </span>
                        <span>
                            <label for="cd_time" class="select max-width-150px">
                                <select name="cd_time" id="cd_time">
                                    <option value="">::분 선택::</option>
                                    <?php for ($i=0; $i<6; $i++) { ?>
                                    <option value="<?php echo $i==0 ? '00': $i*10; ?>" <?php echo $open_date['minute'] == $i*10 ? 'selected': ''; ?>><?php echo $i==0 ? '00': $i*10; ?></option>
                                    <?php } ?>
                                </select><i></i>
                            </label>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="confirm-bottom-btn m-b-20">
        <?php echo $frm_submit; ?>
    </div>

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>여분필드 설정</strong></div>
        <?php for ($i=1; $i<=10; $i++) { ?>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label class="label">여분필드 <?php echo $i ?> 제목</label>
                </div>
                <div class="adm-form-td td-r">
                    <label for="cd_<?php echo $i ?>_subj" class="input max-width-250px">
                        <input type="text" name="cd_<?php echo $i ?>_subj" id="cd_<?php echo $i ?>_subj" value="<?php echo get_text($countdown['cd_'.$i.'_subj']); ?>">
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label class="label">여분필드 <?php echo $i ?> 값</label>
                </div>
                <div class="adm-form-td td-r">
                    <label for="cd_<?php echo $i ?>" class="input max-width-250px">
                        <input type="text" name="cd_<?php echo $i ?>" id="cd_<?php echo $i ?>" value="<?php echo get_text($countdown['cd_'.$i]); ?>">
                    </label>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit; ?>
    </div>

    </form>
</div>

<script>
function fcountdown_check(f) {
    if($("input:checkbox[id='cd_use']").is(":checked") == true) {
        if($("#cd_skin option:selected").val() == '') {
            alert('공사중 스킨을 선택해 주세요.');
            f.cd_skin.focus();
            return false;
        }
        if($("#cd_date").val().length != '10') {
            alert('날짜를 정확히 입력해 주세요.');
            f.cd_date.focus();
            return false;
        }
        if($("#cd_hour option:selected").val() == '') {
            alert('시간을 선택해 주세요.');
            f.cd_hour.focus();
            return false;
        }
        if($("#cd_time option:selected").val() == '') {
            alert('분을 선택해 주세요.');
            f.cd_time.focus();
            return false;
        }
    }

    f.target='blank_iframe';
    return true;
}

$(document).ready(function(){
    $('#cd_date').datepicker({
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