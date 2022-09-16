<?php
/**
 * @file    /adm/eyoom_admin/core/config/sendmail_test.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "100300";

auth_check_menu($auth, $sub_menu, 'r');

if (!$config['cf_email_use'])
    alert('환경설정에서 \'메일발송 사용\'에 체크하셔야 메일을 발송할 수 있습니다.');

include_once(G5_LIB_PATH.'/mailer.lib.php');

if (isset($_POST['email'])) {
    $_POST['email'] = strip_tags($_POST['email']);
    $email = explode(',', $_POST['email']);

    $real_email = array();

    for ($i=0; $i<count($email); $i++){

        if (!preg_match("/([0-9a-zA-Z_-]+)@([0-9a-zA-Z_-]+)\.([0-9a-zA-Z_-]+)/", $email[$i])) continue;
        
        $real_email[] = $email[$i];
        mailer($config['cf_admin_email_name'], $config['cf_admin_email'], trim($email[$i]), '[메일검사] 제목', '<span style="font-size:9pt;">[메일검사] 내용<p>이 내용이 제대로 보인다면 보내는 메일 서버에는 이상이 없는것입니다.<p>'.G5_TIME_YMDHIS.'<p>이 메일 주소로는 회신되지 않습니다.</span>', 1);
    }
}