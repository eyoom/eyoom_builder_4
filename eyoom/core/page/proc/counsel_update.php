<?php
include_once('../../../../common.php');

// 상담 신청 기능 사용유무 체크
if (!$config['cf_use_counsel']) alert("사용하지 않는 기능입니다.");

include_once(G5_LIB_PATH.'/register.lib.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
include_once(G5_LIB_PATH.'/mailer.lib.php');

if (!chk_captcha()) {
    alert('자동등록방지 숫자가 틀렸습니다.');
}

$cs_part    = clean_xss_tags(trim($_POST['cs_part']));
$cs_company = clean_xss_tags(trim($_POST['cs_company']));
$cs_name    = clean_xss_tags(trim($_POST['cs_name']));
$cs_tel     = clean_xss_tags(trim($_POST['cs_tel']));
$cs_email   = clean_xss_tags(trim($_POST['cs_email']));

$cs_subject = '';
if (isset($_POST['cs_subject'])) {
    $cs_subject = substr(trim($_POST['cs_subject']),0,255);
    $cs_subject = preg_replace("#[\\\]+$#", "", $cs_subject);
}

$cs_content = '';
if (isset($_POST['cs_content'])) {
    $cs_content = substr(trim($_POST['cs_content']),0,65536);
    $cs_content = preg_replace("#[\\\]+$#", "", $cs_content);
    $cs_content = addslashes($cs_content);
}

if (!$cs_part) {
    alert("문의 부분을 선택해 주세요.");
}

if (!$cs_company) {
    alert("회사명을 입력해 주세요.");
}

if (!$cs_name) {
    alert("이름을 입력해 주세요.");
}

if (!$cs_tel) {
    alert("휴대전화를 입력해 주세요.");
} else {
    $cs_tel = $eb->get_phone_number($cs_tel);
}

if (!$cs_email) {
    alert("이메일을 입력해 주세요.");
} else {
    $msg = valid_mb_email($cs_email);
    if ($msg) {
        alert($msg);
    }
}

if (!$cs_subject) {
    alert("제목을 입력해 주세요.");
}

if (!$cs_content) {
    alert("문의 내용을 입력해 주세요.");
}

// 상담접수단계
$counsel_status = explode(',', $config['cf_counsel_status']);

$sql_set = "
    cs_part = '{$cs_part}', 
    cs_company = '{$cs_company}', 
    cs_name = '{$cs_name}', 
    cs_tel = '{$cs_tel}', 
    cs_email = '{$cs_email}', 
    cs_subject = '{$cs_subject}', 
    cs_content = '{$cs_content}', 
    cs_status = '{$counsel_status[0]}', 
    cs_ip = '".$_SERVER['REMOTE_ADDR']."',
";

// 파일개수 체크
$file_count   = 0;
$upload_count = (isset($_FILES['cs_file']['name']) && is_array($_FILES['cs_file']['name'])) ? count($_FILES['cs_file']['name']) : 0;

for ($i=0; $i<$upload_count; $i++) {
    if($_FILES['cs_file']['name'][$i] && is_uploaded_file($_FILES['cs_file']['tmp_name'][$i]))
        $file_count++;
}

// 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
@mkdir(G5_DATA_PATH.'/counsel', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/counsel', G5_DIR_PERMISSION);

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

// 가변 파일 업로드
$upload = array();

if(isset($_FILES['cs_file']['name']) && is_array($_FILES['cs_file']['name'])) {
    for ($i=0; $i<count($_FILES['cs_file']['name']); $i++) {
        $upload['file']     = '';
        $upload['source']   = '';
        $upload['filesize'] = 0;
        $upload['image']    = array();
        $upload['image'][0] = 0;
        $upload['image'][1] = 0;
        $upload['image'][2] = 0;
        $upload['fileurl'] = '';
        $upload['thumburl'] = '';
        $upload['storage'] = '';

        $tmp_file  = $_FILES['cs_file']['tmp_name'][$i];
        $filesize  = $_FILES['cs_file']['size'][$i];
        $filename  = $_FILES['cs_file']['name'][$i];
        $filename  = get_safe_filename($filename);

        if (is_uploaded_file($tmp_file)) {
            $timg = @getimagesize($tmp_file);
            // image type
            if ( preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
                 preg_match("/\.({$config['cf_flash_extension']})$/i", $filename) ) {
                if ($timg['2'] < 1 || $timg['2'] > 18)
                    continue;
            }
            //=================================================================

            $upload['image'] = $timg;

            // 프로그램 원래 파일명
            $upload['source'] = $filename;
            $upload['filesize'] = $filesize;

            // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
            $filename = preg_replace("/\.(php|pht|phtm|htm|cgi|pl|exe|jsp|asp|inc|phar)/i", "$0-x", $filename);

            shuffle($chars_array);
            $shuffle = implode('', $chars_array);

            // 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
            $upload['file'] = md5(sha1($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($filename);

            $dest_file = G5_DATA_PATH.'/counsel/'.$upload['file'];

            // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
            $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['cs_file']['error'][$i]);

            // 올라간 파일의 퍼미션을 변경합니다.
            chmod($dest_file, G5_FILE_PERMISSION);

            $cs_file_key = "cs_file".($i+1);
            $$cs_file_key = serialize($upload);
        }
    }   // end for

    $sql_file = " cs_file1 = '{$cs_file1}', cs_file2 = '{$cs_file2}', ";
}   // end if

$sql = "insert into {$g5['eyoom_counsel']} set {$sql_set} {$sql_file} cs_regdt = '".G5_TIME_YMDHIS."' ";
sql_query($sql);

$cs_id = sql_insert_id();

/**
 * 이메일 발송
 */
if ($config['cf_counsel_sendmail']) {
    $subject = '['.$config['cf_title'].'] '.$cs_name .' 님의 ' . $cs_part . '이(가) 접수되었습니다.';

    if (!$cs_email) $cs_email = $config['cf_admin_email'];

    ob_start();
    include_once (EYOOM_CORE_PATH.'/page/proc/counsel_update.mail.php');
    $content = ob_get_contents();
    ob_end_clean();
    
    if (!$config['cf_counsel_email']) {
        mailer($cs_name, $cs_email, $config['cf_admin_email'], $subject, $content, 1);
    } else {
        $cf_counsel_email_arr = explode(',', $config['cf_counsel_email']);
        foreach ($cf_counsel_email_arr as $k => $counsel_email) {
            mailer($cs_name, $cs_email, $counsel_email, $subject, $content, 1);
        }
    }
}

alert("정상적으로 문의내용을 등록하였습니다.", G5_URL);