<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/sms/config.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-member-update">
    <div class="adm-headline">
        <h3><?php echo $g5['title']; ?></h3>
    </div>

    <form name="fconfig" method="post" action="<?php echo $action_url; ?>" enctype="multipart/form-data" class="eyoom-form" >

    <div class="local_desc02 local_desc">
        <p>
            새로운 회원정보로 업데이트 합니다.<br>
            실행 후 '완료' 메세지가 나오기 전에 프로그램의 실행을 중지하지 마십시오.
        </p>
    </div>
    <div class="local_desc01 local_desc">
        <p>
            마지막 업데이트 일시 : <span id="datetime"><?php echo $sms5['cf_datetime']?></span> <br>
        </p>
    </div>

    <div id="res_msg" class="local_desc01 local_desc">
    </div>

    <?php echo $frm_submit; ?>

    </form>
</div>