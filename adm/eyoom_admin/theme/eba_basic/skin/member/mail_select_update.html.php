<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/member/mail_select_update.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'mail_list';
$g5_title = '회원메일발송';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">회원관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="mail-select">
    <div class="adm-form-table">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>메일 발송</strong></div>
        <div class="adm-form-cont">
            <h5>메일 발송중 ...</h5>
        </div>
        <div class="adm-form-info">
            <div class="cont-text-bg">
                <p class="bg-info">
                    <i class="fas fa-info-circle"></i> <strong>[끝]</strong> 이라는 단어가 나오기 전에는 중간에 중지하지 마세요.
                </p>
            </div>
        </div>
        <div class="adm-form-cont">
            <div id="mail-select-layer">
                <h5><strong><i class="fas fa-caret-right"></i> 발송중인 메일</strong></h5>
                <p class="li-p-sq"><span id="cont"></span></p>
            </div>
        </div>
    </div>
</div>

<?php
require_once EYOOM_ADMIN_PATH.'/admin.tail.php';

flush();
ob_flush();

$ma_id = isset($_POST['ma_id']) ? (int) $_POST['ma_id'] : 0;
$select_member_list = isset($_POST['ma_list']) ? trim($_POST['ma_list']) : '';

//print_r2($_POST); EXIT;
$member_list = explode("\n", conv_unescape_nl($select_member_list));

// 메일내용 가져오기
$sql = "select ma_subject, ma_content from {$g5['mail_table']} where ma_id = '$ma_id' ";
$ma = sql_fetch($sql);

$subject = $ma['ma_subject'];

$cnt = 0;
for ($i = 0; $i < count($member_list); $i++) {
    list($to_email, $mb_id, $name, $nick, $datetime) = explode("||", trim($member_list[$i]));

    $sw = preg_match("/[0-9a-zA-Z_]+(\.[0-9a-zA-Z_]+)*@[0-9a-zA-Z_]+(\.[0-9a-zA-Z_]+)*/", $to_email);
    // 올바른 메일 주소만
    if ($sw == true) {
        $cnt++;

        $mb_md5 = md5($mb_id . $to_email . $datetime);

        $content = $ma['ma_content'];
        $content = preg_replace("/{이름}/", $name, (string)$content);
        $content = preg_replace("/{닉네임}/", $nick, (string)$content);
        $content = preg_replace("/{회원아이디}/", $mb_id, (string)$content);
        $content = preg_replace("/{이메일}/", $to_email, (string)$content);

        $content = $content . "<hr size=0><p><span style='font-size:9pt; font-family:굴림'>▶ 더 이상 정보 수신을 원치 않으시면 [<a href='" . G5_BBS_URL . "/email_stop.php?mb_id={$mb_id}&amp;mb_md5={$mb_md5}' target='_blank'>수신거부</a>] 해 주십시오.</span></p>";

        mailer($config['cf_admin_email_name'], $config['cf_admin_email'], $to_email, $subject, $content, 1);

        echo "<script> document.all.cont.innerHTML += '$cnt. $to_email ($mb_id : $name)<br>'; </script>\n";
        // echo "+";
        flush();
        ob_flush();
        ob_end_flush();
        usleep($sleepsec);
        if ($cnt % $countgap == 0) {
            echo "<script> document.all.cont.innerHTML += '<br>'; document.body.scrollTop += 1000; </script>\n";
        }

        // 화면을 지운다... 부하를 줄임
        if ($cnt % $maxscreen == 0) {
            echo "<script> document.all.cont.innerHTML = ''; document.body.scrollTop += 1000; </script>\n";
        }
    }
}
?>

<script>
    document.all.cont.innerHTML += "<div class='m-t-20'>총 <?php echo number_format($cnt); ?>건 발송<br><br><strong class='text-teal'>[끝]</strong></div>";
    document.body.scrollTop += 1000;
</script>