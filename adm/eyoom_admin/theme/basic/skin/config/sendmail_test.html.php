<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/config/sendmail_test.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-sendmail-test">
    <form name="fsendmailtest" method="post" class="eyoom-form">
    <input type="hidden" name="dir" id="dir" value="<?php echo $dir; ?>">
    <input type="hidden" name="pid" id="pid" value="<?php echo $pid; ?>">

    <div class="adm-headline">
        <h3>메일 테스트</h3>
    </div>

    <div class="adm-form-wrap margin-bottom-30">
        <header><strong><i class="fas fa-caret-right"></i> 테스트 메일 발송</strong></header>
        <fieldset>
            <p>
                메일서버가 정상적으로 동작 중인지 확인할 수 있습니다.<br>
                아래 입력칸에 테스트 메일을 발송하실 메일 주소를 입력하시면, [메일검사] 라는 제목으로 테스트 메일을 발송합니다.<br>
            </p>
            <div class="margin-bottom-50"></div>
            <div class="row">
                <div class="col col-3"></div>
                <div class="col col-6">
                    <section>
                        <label for="email" class="label">받는 메일주소</label>
                        <label class="input input-button">
                            <div class="button"><input type="submit" onclick="this.form.submit();">메일발송</div>
                            <input type="text" name="email" id="email" value="<?php echo $member['mb_email']; ?>">
                        </label>
                    </section>
                </div>
                <div class="col col-3"></div>
            </div>
            <div class="margin-bottom-50"></div>
            <p>
                만약 [메일검사] 라는 내용으로 테스트 메일이 도착하지 않는다면 보내는 메일서버 혹은 받는 메일서버 중 문제가 발생했을 가능성이 있습니다.<br>
                따라서 보다 정확한 테스트를 원하신다면 여러 곳으로 테스트 메일을 발송하시기 바랍니다.<br>
            </p>
        </fieldset>
    </div>

    <?php if ($real_email) { ?>
    <div class="margin-bottom-30"></div>
    <div class="adm-form-wrap">
        <header><strong><i class="fas fa-caret-right"></i> 결과메세지</strong></header>
        <fieldset>
            <p class="color-blue">다음 <?php echo count((array)$real_email); ?> 개의 메일 주소로 테스트 메일 발송이 완료되었습니다.</p>
            <div class="alert alert-warning padding-all-10 margin-top-30 margin-bottom-30">
                <?php for ($i=0;$i<count((array)$real_email);$i++) { ?>
                <div><?php echo $real_email[$i]; ?></div>
                <?php } ?>
            </div>
            <p>
                해당 주소로 테스트 메일이 도착했는지 확인해 주십시오.<br>
                만약, 테스트 메일이 오지 않는다면 더 다양한 계정의 메일 주소로 메일을 보내 보십시오.<br>
                그래도 메일이 하나도 도착하지 않는다면 메일 서버(sendmail server)의 오류일 가능성이 높으니, 웹 서버관리자에게 문의하여 주십시오.<br>
            </p>
        </fieldset>
    </div>
    <?php } ?>

    </form>
</div>