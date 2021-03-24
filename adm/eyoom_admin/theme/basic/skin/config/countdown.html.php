<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/config/countdown.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<style>
@media screen and (max-width:600px) {
    .admin-countdown-form .eyoom-form .trans-col .col {width:inherit;float:left;margin-bottom:0}
    .admin-countdown-form .eyoom-form .trans-col .col-4 {width:33.33333%}
}
</style>

<div class="admin-countdown-form">
    <form name="fcountdownform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fcountdown_check(this)" class="eyoom-form">

    <div class="adm-headline">
        <h3>공사중 설정</h3>
    </div>

    <div class="adm-table-form-wrap margin-bottom-30">
        <header><strong><i class="fas fa-caret-right"></i> 기본설정</strong></header>

        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">타이틀</label>
                        </th>
                        <td>
                            <label for="cd_title" class="input">
                                <input type="text" name="cd_title" id="cd_title" value="<?php echo $countdown['cd_title']; ?>">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">공사중 사용여부</label>
                        </th>
                        <td>
                            <label for="cd_use" class="checkbox">
                                <input type="checkbox" name="cd_use" value="y" id="cd_use" <?php echo $countdown['cd_use'] == 'y' ? 'checked': ''; ?>><i></i> 사용
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">스킨선택</label>
                        </th>
                        <td>
                            <label for="cd_skin" class="select form-width-250px">
                                <select name="cd_skin" id="cd_skin">
                                    <option value="">::스킨선택::</option>
                                    <?php for ($i=0; $i<count((array)$skins); $i++) { ?>
                                    <option value="<?php echo $skins[$i]; ?>" <?php echo $skins[$i] == $countdown['cd_skin'] ? 'selected': ''; ?>><?php echo $skins[$i]; ?></option>
                                    <?php } ?>
                                </select><i></i>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">오픈예정일</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <span>
                                    <label for="cd_date" class="input form-width-250px">
                                        <i class="icon-append fas fa-calendar"></i>
                                        <input type="text" name="cd_date" id="cd_date" value="<?php echo $open_date['mktime'] ? date('Y-m-d', $open_date['mktime']): ''; ?>">
                                    </label>
                                </span>
                                <span>
                                    <label for="cd_hour" class="select form-width-150px">
                                        <select name="cd_hour" id="cd_hour">
                                            <option value="">::시간 선택::</option>
                                            <?php for ($i=0; $i<24; $i++) { ?>
                                            <option value="<?php echo $i<10 ? '0'.$i: $i; ?>" <?php echo $open_date['hour'] == $i ? 'selected': ''; ?>><?php echo $i<10 ? '0'.$i: $i; ?></option>
                                            <?php } ?>
                                        </select><i></i>
                                    </label>
                                </span>
                                <span>
                                    <label for="cd_time" class="select form-width-150px">
                                        <select name="cd_time" id="cd_time">
                                            <option value="">::분 선택::</option>
                                            <?php for ($i=0; $i<6; $i++) { ?>
                                            <option value="<?php echo $i==0 ? '00': $i*10; ?>" <?php echo $open_date['minute'] == $i*10 ? 'selected': ''; ?>><?php echo $i==0 ? '00': $i*10; ?></option>
                                            <?php } ?>
                                        </select><i></i>
                                    </label>
                                </span>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
            <?php if (!G5_IS_MOBILE) { ?>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php echo $frm_submit; ?>

    <div class="adm-table-form-wrap margin-bottom-30">
        <header><strong><i class="fas fa-caret-right"></i> 여분필드 설정</strong></header>

        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <?php for ($i=1; $i<=10; $i++) { ?>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">여분필드 <?php echo $i ?> 제목</label>
                        </th>
                        <td>
                            <label for="cd_<?php echo $i ?>_subj" class="input form-width-250px">
                                <input type="text" name="cd_<?php echo $i ?>_subj" id="cd_<?php echo $i ?>_subj" value="<?php echo get_text($countdown['cd_'.$i.'_subj']); ?>">
                            </label>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">여분필드 <?php echo $i ?> 값</label>
                        </th>
                        <td>
                            <label for="cd_<?php echo $i ?>" class="input form-width-250px">
                                <input type="text" name="cd_<?php echo $i ?>" id="cd_<?php echo $i ?>" value="<?php echo get_text($countdown['cd_'.$i]); ?>">
                            </label>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php if (!G5_IS_MOBILE) { ?>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php echo $frm_submit; ?>

    </form>

</div>

<div class="cont-text-bg">
    <p class="bg-info font-size-12 margin-bottom-0">
        <i class="fas fa-info-circle"></i> 홈페이지 개편이나 신규제작 시, 홈페이지 메인을 공사중 페이지로 설정하실 수 있습니다.<br>
        <i class="fas fa-info-circle"></i> 오픈 예정일을 설정해 놓으면 자동으로 해당일에 홈페이지가 공개됩니다.
    </p>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/eyoom-form/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
function fcountdown_check(f) {
    if($("input:checkbox[id='countdown_use']").is(":checked") == true) {
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
}

/*--------------------------------------
    Datepicker
--------------------------------------*/
$(document).ready(function(){
    $('#cd_date').datepicker({
        dateFormat: 'yy-mm-dd',
        prevText: '<i class="fa fa-angle-left"></i>',
        nextText: '<i class="fa fa-angle-right"></i>',
        showMonthAfterYear: true,
        monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
    });
})
</script>