<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/register_result.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<div class="register-result">
    <div class="heading heading-e4 margin-bottom-40">
        <h2><strong>회원가입</strong>이 완료되었습니다.</h2>
        <p><strong class="color-blue"><?php echo $mb['mb_name']; ?></strong>님의 회원가입을 진심으로 축하합니다.</p>
    </div>
    <?php if ($config['cf_use_email_certify']) { ?>
    <p>
        회원 가입 시 입력하신 이메일 주소로 인증메일이 발송되었습니다.<br>
        <strong class="color-red">발송된 인증메일을 확인하신 후 인증처리</strong>를 하시면 사이트를 원활하게 이용하실 수 있습니다.
    </p>
    <blockquote class="hero">
        <p class="font-size-12">아이디 : <strong><?php echo $mb['mb_id']; ?></strong></p>
        <p class="font-size-12">이메일 주소 : <strong><?php echo $mb['mb_email']; ?></strong></p>
    </blockquote>
    <p>
        이메일 주소를 잘못 입력하셨다면, 사이트 관리자에게 문의해주시기 바랍니다.<br>
    </p>
    <?php } ?>
    <div class="alert alert-success">
        <p>회원님의 비밀번호는 아무도 알 수 없는 암호화 코드로 저장되므로 안심하셔도 좋습니다.<br>아이디, 비밀번호 분실시에는 회원가입시 입력하신 이메일 주소를 이용하여 찾을 수 있습니다.</p>
    </div>
    <div class="cont-text-bg">
        <p class="bg-primary">회원 탈퇴는 언제든지 가능하며 일정기간이 지난 후, 회원님의 정보는 삭제하고 있습니다.<br>감사합니다.</p>
    </div>
    <div class="margin-hr-30"></div>
    <div class="text-center">
        <a href="<?php echo G5_URL; ?>/" class="btn-e btn-e-dark btn-e-xlg">메인으로</a>
    </div>
</div>