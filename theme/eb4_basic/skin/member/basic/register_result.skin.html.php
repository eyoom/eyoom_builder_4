<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/register_result.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.register-result {max-width:500px;margin:0 auto}
.register-icon-box {font-size:120px;text-align:center;color:#959595;line-height:1;margin:0 0 30px}
.register-info-box {border:1px solid #757575;background-color:#fafafa;padding:20px;margin-bottom:20px}
.register-result-box {border:1px solid #d5d5d5;padding:20px;margin-bottom:30px}
</style>

<div class="register-result">
    <div class="text-center m-t-30 m-b-30">
        <h3 class="m-b-10"><strong>회원가입</strong>이 완료되었습니다.</h3>
        <p class="text-gray f-s-16r"><span class="text-black"><?php echo $mb['mb_name']; ?></span> 님의 회원가입을 진심으로 축하합니다!</p>
    </div>
    <div class="register-icon-box">
        <i class="far fa-address-card"></i>
    </div>
    <?php if ($config['cf_use_email_certify']) { ?>
    <div class="register-info-box">
        <p class="m-b-15">
            회원 가입 시 입력하신 이메일 주소로 인증메일이 발송되었습니다.<br>
            <span class="text-crimson">발송된 인증메일을 확인하신 후 인증처리</span>를 하시면 사이트를 원활하게 이용하실 수 있습니다.
        </p>
        <p>- 아이디 : <span><?php echo $mb['mb_id']; ?></span></p>
        <p class="m-b-15">- 이메일 주소 : <span><?php echo $mb['mb_email']; ?></span></p>
        <p class="text-gray">이메일 주소를 잘못 입력하셨다면, 사이트 관리자에게 문의해주시기 바랍니다.</p>
    </div>
    <?php } ?>
    <div class="register-result-box">
        <p class="m-b-10">회원님의 비밀번호는 아무도 알 수 없는 암호화 코드로 저장되므로 안심하셔도 좋습니다.</p>
        <p class="m-b-10 text-crimson">아이디, 비밀번호 분실시에는 회원가입시 입력하신 <span>이메일 주소</span>를 이용하여 찾을 수 있습니다.</p>
        <p class="m-b-10">회원 탈퇴는 언제든지 가능하며 일정기간이 지난 후, 회원님의 정보는 삭제하고 있습니다.</p>
        <p>감사합니다.</p>
    </div>
    <div class="text-center m-t-30">
        <a href="<?php echo G5_URL; ?>/" class="btn-e btn-e-dark btn-e-xl">메인으로</a>
    </div>
</div>