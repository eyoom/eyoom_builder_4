<?php
include_once('./_common.php');

// clean the output buffer
ob_end_clean();

$no = isset($_REQUEST['no']) ? (int) $_REQUEST['no'] : 1;
$cs_id = isset($_REQUEST['cs_id']) ? (int) $_REQUEST['cs_id'] : '';

if (!$cs_id) {
    alert("잘못된 접근입니다.");
}

$sc = sql_fetch("select * from {$g5['eyoom_counsel']} where cs_id = '{$cs_id}' ");
$cs_file_key = "cs_file{$no}";
$cs_file_serial = $sc[$cs_file_key];
$cs_file = unserialize($cs_file_serial);

$counsel_file_path = G5_DATA_PATH.'/counsel';
$file_path = $counsel_file_path . '/' . $cs_file['file'];

if (file_exists($file_path) && !is_dir($file_path)) {
    $original = rawurlencode($cs_file['source']);

    if(preg_match("/msie/i", $_SERVER['HTTP_USER_AGENT']) && preg_match("/5\.5/", $_SERVER['HTTP_USER_AGENT'])) {
        header("content-type: doesn/matter");
        header("content-length: ".filesize($file_path));
        header("content-disposition: attachment; filename=\"$original\"");
        header("content-transfer-encoding: binary");
    } else if (preg_match("/Firefox/i", $_SERVER['HTTP_USER_AGENT'])){
        header("content-type: file/unknown");
        header("content-length: ".filesize($file_path));
        //header("content-disposition: attachment; filename=\"".basename($file['bf_source'])."\"");
        header("content-disposition: attachment; filename=\"".$original."\"");
        header("content-description: php generated data");
    } else {
        header("content-type: file/unknown");
        header("content-length: ".filesize($file_path));
        header("content-disposition: attachment; filename=\"$original\"");
        header("content-description: php generated data");
    }
    header("pragma: no-cache");
    header("expires: 0");
    flush();

    $fp = fopen($file_path, 'rb');

    $download_rate = 10;

    while(!feof($fp)) {
        print fread($fp, round($download_rate * 1024));
        flush();
        usleep(1000);
    }
    fclose ($fp);
    flush();
} else {
    alert("파일이 존재하지 않습니다.");
}
