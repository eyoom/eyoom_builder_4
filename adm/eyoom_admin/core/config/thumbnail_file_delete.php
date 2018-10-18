<?php
/**
 * @file    /adm/eyoom_admin/core/config/thumbnail_file_delete.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = '100920';

if ($is_admin != "super") alert("최고관리자만 접근 가능합니다.", G5_URL);

$directory = array();
$dl = array('file', 'editor');

if (is_array($dl)) {
    foreach($dl as $val) {
        if($handle = opendir(G5_DATA_PATH.'/'.$val)) {
            while(false !== ($entry = readdir($handle))) {
                if($entry == '.' || $entry == '..')
                    continue;

                $path = G5_DATA_PATH.'/'.$val.'/'.$entry;

                if(is_dir($path))
                    $directory[] = $path;
            }
        }
    }
}

flush();

if (!$directory=@opendir(G5_DATA_PATH.'/cache')) {
  $no_print = "썸네일디렉토리를 열지못했습니다.";
}

$cnt=0;
$print_html = array();

if (is_array($directory)) {
    foreach($directory as $thumb_dir) {
        $files = glob($thumb_dir.'/thumb-*');
        if (is_array($files)) {
            foreach($files as $thumbnail) {
                $cnt++;
                @unlink($thumbnail);

                $print_html[$cnt] = $thumbnail;

                flush();
            }
        }
    }
}