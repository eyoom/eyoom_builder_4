<?php
include_once('./_common.php');

ob_end_clean();

$ec_code = (int)$_GET['ec_code'];

/**
 * EB콘텐츠 마스터 정보
 */
$ebcontents_path = G5_DATA_PATH.'/ebcontents/'.$theme;
$ec_master = sql_fetch("select ec_file, ec_filename from {$g5['eyoom_contents']} where (1) and ec_code = '{$ec_code}' limit 1 ");

/**
 * EB컨텐츠 마스터 첨부파일
 */
if ($ec_master['ec_file']) {
    
    $ec_file_path = $ebcontents_path.'/file/'.$ec_master['ec_file'];
    $ec_file_path = addslashes($ec_file_path);
    if (!is_file($ec_file_path) || !file_exists($ec_file_path))
        alert('파일이 존재하지 않습니다.');

    //파일명에 한글이 있는 경우
    if(preg_match("/[\xA1-\xFE][\xA1-\xFE]/", $ec_master['ec_filename'])){
        $original = iconv('utf-8', 'euc-kr', $ec_master['ec_filename']); // SIR 잉끼님 제안코드
    } else {
        $original = urlencode($ec_master['ec_filename']);
    }

    if(preg_match("/msie/i", $_SERVER['HTTP_USER_AGENT']) && preg_match("/5\.5/", $_SERVER['HTTP_USER_AGENT'])) {
        header("content-type: doesn/matter");
        header("content-length: ".filesize($ec_file_path));
        header("content-disposition: attachment; filename=\"{$ec_master['ec_filename']}\"");
        header("content-transfer-encoding: binary");
    } else if (preg_match("/Firefox/i", $_SERVER['HTTP_USER_AGENT'])){
        header("content-type: file/unknown");
        header("content-length: ".filesize($ec_file_path));
        header("content-disposition: attachment; filename=\"".basename($ec_master['ec_filename'])."\"");
        header("content-description: php generated data");
    } else {
        header("content-type: file/unknown");
        header("content-length: ".filesize($ec_file_path));
        header("content-disposition: attachment; filename=\"{$ec_master['ec_filename']}\"");
        header("content-description: php generated data");
    }
    header("pragma: no-cache");
    header("expires: 0");
    flush();
    
    $fp = fopen($ec_file_path, 'rb');
    
    // 4.00 대체
    // 서버부하를 줄이려면 print 나 echo 또는 while 문을 이용한 방법보다는 이방법이...
    //if (!fpassthru($fp)) {
    //    fclose($fp);
    //}
    
    $download_rate = 10;
    
    while(!feof($fp)) {
        //echo fread($fp, 100*1024);
        /*
        echo fread($fp, 100*1024);
        flush();
        */
    
        print fread($fp, round($download_rate * 1024));
        flush();
        usleep(1000);
    }
    fclose ($fp);
    flush();
} else {
    alert('파일이 존재하지 않습니다.');
}
