<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/sms/member_update.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-member-update">
    <div class="adm-headline">
        <h3><?php echo $g5['title']; ?></h3>
    </div>

    <form name="fconfig" method="post" action="<?php echo $action_url; ?>" enctype="multipart/form-data" class="eyoom-form" >

    <div class="alert alert-danger">
        <p>
            새로운 회원정보로 업데이트 합니다.<br>
            실행 후 '완료' 메세지가 나오기 전에 프로그램의 실행을 중지하지 마십시오.
        </p>
    </div>
    <div class="alert alert-warning">
        <p>마지막 업데이트 일시 : <span id="datetime"><?php echo $sms5['cf_datetime']?></span> <br></p>
    </div>

    <div class="cont-text-bg">
        <p id="res_msg" class="bg-info"></p>
    </div>

    <?php echo $frm_submit; ?>

    </form>
</div>