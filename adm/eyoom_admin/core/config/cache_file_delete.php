<?php
/**
 * @file    /adm/eyoom_admin/core/config/cache_file_delete.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = '100900';

if ($is_admin != "super") alert("최고관리자만 접근 가능합니다.", G5_URL);

@include_once('./safe_check.php');
if(function_exists('social_log_file_delete')){
    social_log_file_delete();
}

flush();

if (!$directory=@opendir(G5_DATA_PATH.'/session')) {
  $no_print = "캐시디렉토리를 열지못했습니다.";
}

$cnt=0;
$print_html = array();

$files = glob(G5_DATA_PATH.'/cache/latest-*');
if (is_array($files)) {
    foreach ($files as $cache_file) {
        $cnt++;
        unlink($cache_file);
        $print_html[$cnt] = $cache_file;

        flush();
    }
}