<?php
/**
 * skin file : /theme/THEME_NAME/skin/outlogin/basic/outlogin.skin.1.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert2/sweetalert2.min.css" type="text/css" media="screen">',0);
?>

<style>
.ol-before {position:relative;display:block;background:#fff;border:1px solid #e5e5e5;padding:15px;margin-bottom:30px}
.ol-account {margin-bottom:10px}
.ol-account a:hover {color:#000;text-decoration:underline}
</style>

<div class="ol-before">
    <form name="foutlogin" action="<?php echo $outlogin_action_url; ?>" onsubmit="return fhead_submit(this);" method="post" autocomplete="off" class="eyoom-form">
        <input type="hidden" name="url" value="<?php echo $outlogin_url ?>">

        <div class="headline-short">
            <h5><strong>LOGIN</strong></h5>
        </div>
        <div class="ol-account">
            <span class="float-start"><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a></span>
            <span class="float-end">
                <a href="<?php echo G5_BBS_URL ?>/password_lost.php">아이디/비번찾기</a>
            </span>
            <div class="clearfix"></div>
        </div>
        <section>
            <label class="input">
                <i class="icon-append fa fa-user"></i>
                <input type="text" id="ol_id" name="mb_id" required maxlength="20" placeholder="아이디">
            </label>
        </section>
        <section>
            <label class="input">
                <i class="icon-append fa fa-lock"></i>
                <input type="password" name="mb_password" id="ol_pw" required maxlength="20" placeholder="비밀번호">
            </label>
        </section>
        <div class="width-50 float-start">
            <label class="checkbox"><input type="checkbox" name="auto_login" value="1" id="auto_login"><i></i><span>자동로그인</span></label>
        </div>
        <div class="width-50 float-end text-end">
            <button id="ol_submit" class="btn-e btn-e-md btn-e-dark" type="submit">로그인</button>
        </div>
        <div class="clearfix"></div>

        <?php
        // 소셜로그인 사용시 소셜로그인 버튼
        @include_once($outlogin_skin_path.'/social_outlogin.skin.1.html.php');
        ?>
    </form>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
$omi = $('#ol_id');
$omp = $('#ol_pw');
$omi_label = $('#ol_idlabel');
$omi_label.addClass('ol_idlabel');
$omp_label = $('#ol_pwlabel');
$omp_label.addClass('ol_pwlabel');

$(function() {
    $omi.focus(function() {
        $omi_label.css('visibility','hidden');
    });
    $omp.focus(function() {
        $omp_label.css('visibility','hidden');
    });
    $omi.blur(function() {
        $this = $(this);
        if ($this.attr('id') == "ol_id" && $this.attr('value') == "") $omi_label.css('visibility','visible');
    });
    $omp.blur(function() {
        $this = $(this);
        if ($this.attr('id') == "ol_pw" && $this.attr('value') == "") $omp_label.css('visibility','visible');
    });

    $("#auto_login").click(function(){
        if ($(this).is(":checked")) {
            Swal.fire({
                title: "알림",
                html: "<div class='alert alert-warning text-start word-break-keep-all'>자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.<br>공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.</div><span>자동로그인을 사용하시겠습니까?</span>",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#e53935",
                confirmButtonText: "확인",
                cancelButtonText: "취소"
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#auto_login").attr("checked");
                } else {
                    $("#auto_login").removeAttr("checked");
                }
            });
        }
    });
});

function fhead_submit(f) {
    if (f.mb_id.value == '' || f.mb_id.value == $("#ol_id").attr("placeholder")) {
        alert("아이디를 입력해 주세요.");
        f.mb_id.select();
        f.mb_id.focus();
        return false;
    }
    if (f.mb_password.value == '' || f.mb_password.value == $("#ol_pw").attr("placeholder")) {
        alert("비밀번호를 입력해 주세요.");
        f.mb_password.select();
        f.mb_password.focus();
        return false;
    }
    return true;
}
</script>