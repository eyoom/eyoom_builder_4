<?php
/**
 * @file    /adm/eyoom_admin/core/config/captcha_file_delete.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = '100910';

if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.', G5_URL);
}

flush();

if (!$directory=@opendir(G5_DATA_PATH.'/cache')) {
    $no_print = "캐시 디렉토리를 열지못했습니다.";
}

$cnt=0;
$print_html = array();

$files = glob(G5_DATA_PATH.'/cache/?captcha-*');
if (is_array($files)) {
    $before_time  = G5_SERVER_TIME - 3600; // 한시간전
    foreach ($files as $gcaptcha_file) {
        $modification_time = filemtime($gcaptcha_file); // 파일접근시간

        if ($modification_time > $before_time) {
            continue;
        }

        $cnt++;
        unlink($gcaptcha_file);
        $print_html[$cnt] = $gcaptcha_file;

        flush();
    }
}