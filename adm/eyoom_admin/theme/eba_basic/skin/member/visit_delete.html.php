<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/member/visit_delete.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'visit_delete';
$g5_title = '접속자로그삭제';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">회원관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-visit-delete">
    <form name="fvisitdelete" method="post" action="<?php echo $action_url1; ?>" onsubmit="return form_submit(this);" class="eyoom-form">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>접속자 로그삭제</strong></div>
        <div class="adm-form-info">
            <div class="cont-text-bg">
                <p class="bg-info">
                    <i class="fas fa-info-circle"></i> 접속자 로그를 삭제할 년도와 방법을 선택해주십시오.
                </p>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label class="label">삭제 구간 설정</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <span>
                            <label class="select width-150px">
                                <select name="year" id="year">
                                    <option value="">년도 선택</option>
                                    <?php for($year=$min_year; $year<=$now_year; $year++) { ?>
                                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                    <?php } ?>
                                </select><i></i>
                            </label>
                        </span>
                        <span>
                            <label class="select width-150px">
                                <select name="month" id="month">
                                    <option value="">월 선택</option>
                                    <?php for($i=1; $i<=12; $i++) { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select><i></i>
                            </label>
                        </span>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="method" class="label">삭제 방법 선택</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="select max-width-250px">
                        <select name="method" id="method">
                            <option value="before">선택 년월 이전 자료삭제</option>
                            <option value="specific">선택 년월의 자료삭제</option>
                        </select><i></i>
                    </label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="method" class="label">관리자 비밀번호<strong class="sound_only">필수</strong></label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px" form="pass">
                    <input type="password" name="pass" id="pass" required>
                </label>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit;?>
    </div>

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