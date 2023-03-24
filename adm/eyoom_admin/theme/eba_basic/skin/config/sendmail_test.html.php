<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/config/sendmail_test.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'sendmail_test';
$g5_title = '메일 테스트';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">환경설정</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-sendmail-test">
    <form name="fsendmailtest" method="post" class="eyoom-form">
    <input type="hidden" name="dir" id="dir" value="<?php echo $dir; ?>">
    <input type="hidden" name="pid" id="pid" value="<?php echo $pid; ?>">

    <div class="adm-form-table">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>테스트 메일 발송</strong></div>
        <div class="adm-form-info">
            <div class="cont-text-bg">
                <p class="bg-info">
                    메일서버가 정상적으로 동작 중인지 확인할 수 있습니다.<br>
                    아래 입력칸에 테스트 메일을 발송하실 메일 주소를 입력하시면, [메일검사] 라는 제목으로 테스트 메일을 발송합니다.<br>
                    보내는 메일주소 : <?php echo get_sanitize_input($config['cf_admin_email']); ?><br>
                    <?php if (function_exists('domain_mail_host') && $config['cf_admin_email'] && stripos($config['cf_admin_email'], domain_mail_host()) === false) { ?>
                    <?php echo '외부메일설정이나 기타 설정을 하지 않았다면, 도메인과 다른 헤더로 여겨 스팸이나 차단될 가능성이 있습니다.<br>기본환경설정에서 관리자 메일 주소를 name'.domain_mail_host().' 과 같은 도메인 형식으로 설정할것을 권장합니다.'; ?>
                    <?php } ?>
                </p>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="email" class="label">받는 메일주소</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="input input-button max-width-500px">
                    <input type="text" name="email" id="email" value="<?php echo $member['mb_email']; ?>">
                    <div class="button"><input type="submit" onclick="this.form.submit();">메일발송<i class="fas fa-paper-plane m-l-7"></i></div>
                </div>
            </div>
        </div>
        <div class="adm-form-cont">
            만약 [메일검사] 라는 내용으로 테스트 메일이 도착하지 않는다면 보내는 메일서버 혹은 받는 메일서버 중 문제가 발생했을 가능성이 있습니다.<br>따라서 보다 정확한 테스트를 원하신다면 여러 곳으로 테스트 메일을 발송하시기 바랍니다.
        </div>
    </div>

    <?php if ($real_email) { ?>
    <div class="adm-form-table m-t-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>결과 메세지</strong></div>
        <div class="adm-form-cont">
            <p class="text-teal">다음 <?php echo count((array)$real_email); ?> 개의 메일 주소로 테스트 메일 발송이 완료되었습니다.</p>
            <div class="alert alert-success m-t-10 m-b-10">
                <?php for ($i=0;$i<count((array)$real_email);$i++) { ?>
                <div><?php echo $real_email[$i]; ?></div>
                <?php } ?>
            </div>
            <p>
                해당 주소로 테스트 메일이 도착했는지 확인해 주십시오.<br>
                만약, 테스트 메일이 오지 않는다면 더 다양한 계정의 메일 주소로 메일을 보내 보십시오.<br>
                그래도 메일이 하나도 도착하지 않는다면 메일 서버(sendmail server)의 오류일 가능성이 높으니, 웹 서버관리자에게 문의하여 주십시오.<br>
                도메인을 소유하고 있을시 SPF, DKIM 설정이 필요할수 있습니다.
            </p>
        </div>
    </div>
    <?php } ?>

    </form>
</div>