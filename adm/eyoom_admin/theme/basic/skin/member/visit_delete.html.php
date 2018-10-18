<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/member/visit_delete.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-visit-delete">
    <form name="fvisitdelete" method="post" action="<?php echo $action_url1; ?>" onsubmit="return form_submit(this);" class="eyoom-form">

    <div class="adm-headline">
        <h3>접속자 로그삭제</h3>
    </div>

    <div class="cont-text-bg">
        <p class="bg-info font-size-12"><i class="fas fa-info-circle"></i> 접속자 로그를 삭제할 년도와 방법을 선택해주십시오.</p>
    </div>
    <div class="margin-bottom-20"></div>

    <div class="adm-table-form-wrap adm-search-box">
        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">삭제 구간 설정</label>
                        </th>
                        <td>
                            <label class="select form-width-150px">
                                <select name="year" id="year">
                                    <option value="">년도 선택</option>
                                    <?php for($year=$min_year; $year<=$now_year; $year++) { ?>
                                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                    <?php } ?>
                                </select><i></i>
                            </label>
                            <label class="select form-width-150px">
                                <select name="month" id="month">
                                    <option value="">월 선택</option>
                                    <?php for($i=1; $i<=12; $i++) { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select><i></i>
                            </label>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label for="method" class="label">삭제 방법 선택</label>
                        </th>
                        <td>
                            <label class="select form-width-250px">
                                <select name="method" id="method">
                                    <option value="before">선택 년월 이전 자료삭제</option>
                                    <option value="specific">선택 년월의 자료삭제</option>
                                </select><i></i>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="method" class="label">관리자 비밀번호<strong class="sound_only">필수</strong></label>
                        </th>
                        <td colspan="3">
                            <label class="input form-width-250px" form="pass">
                                <input type="password" name="pass" id="pass" required>
                            </label>
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

    </form>
</div>

<script>
function form_submit(f) {
    var year = $("#year").val();
    var month = $("#month").val();
    var method = $("#method").val();
    var pass = $("#pass").val();

    if(!year) {
        alert("년도를 선택해 주십시오.");
        return false;
    }

    if(!month) {
        alert("월을 선택해 주십시오.");
        return false;
    }

    if(!pass) {
        alert("관리자 비밀번호를 입력해 주십시오.");
        return false;
    }

    var msg = year+"년 "+month+"월";
    if(method == "before")
        msg += " 이전";
    else
        msg += "의";
    msg += " 자료를 삭제하시겠습니까?";

    return confirm(msg);
}
</script>