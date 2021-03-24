<?php
/**
 * @file    /adm/eyoom_admin/core/config/session_file_delete.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "100800";

if ($is_admin != "super") alert("최고관리자만 접근 가능합니다.", G5_URL);

flush();

if (!$directory=@opendir(G5_DATA_PATH.'/session')) {
    $no_print = "세션 디렉토리를 열지못했습니다.";
}

$cnt=0;
$print_html = array();
while($file=readdir($directory)) {

    if (!strstr($file,'sess_')) continue;
    if (strpos($file,'sess_')!=0) continue;

    $session_file = G5_DATA_PATH.'/session/'.$file;

    if (!$atime=@fileatime($session_file)) {
        continue;
    }
    if (time() > $atime + (3600 * 6)) {  // 지난시간을 초로 계산해서 적어주시면 됩니다. default : 6시간전
        $cnt++;
        $return = unlink($session_file);
        $print_html[$cnt] = $session_file;

        flush();
    }
}