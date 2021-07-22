<?php
$g5_path = '../../..';
include_once($g5_path.'/common.php');

// clean the output buffer
ob_end_clean();

$no = isset($_REQUEST['no']) ? (int) $_REQUEST['no'] : 0;

// 다운로드 차감일 때 비회원은 다운로드 불가
if($board['bo_download_point'] < 0 && $is_guest)
    alert('다운로드 권한이 없습니다.\\n회원이시라면 로그인 후 이용해 보십시오.', G5_BBS_URL.'/login.php?wr_id='.$wr_id.'&amp;'.$qstr.'&amp;url='.urlencode(get_pretty_url($bo_table, $wr_id)));

$row = sql_fetch("select wr_link2 from {$write_table} where wr_id='{$wr_id}'", false);
if ($row) {
    $cfile = $eb->mb_unserialize($row['wr_link2']);
}
$file = $cfile[$no];
if (!$file['file'])
    alert_close('파일 정보가 존재하지 않습니다.');

// JavaScript 불가일 때
if($js != 'on' && $board['bo_download_point'] < 0) {
    $msg = $file['source'].' 파일을 다운로드 하시면 포인트가 차감('.number_format($board['bo_download_point']).'점)됩니다.\\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\\n그래도 다운로드 하시겠습니까?';
    $url1 = EYOOM_CORE_URL.'/board/cmt_download.php?'.clean_query_string($_SERVER['QUERY_STRING'], false).'&js=on';
    $url2 = clean_xss_tags($_SERVER['HTTP_REFERER']);
    
    if( $url2 && stripos($url2, $_SERVER['REQUEST_URI']) !== false ){
        $url2 = G5_BBS_URL.'/board.php?'.clean_query_string($_SERVER['QUERY_STRING'], false);
    }

    //$url1 = 확인link, $url2=취소link
    // 특정주소로 이동시키려면 $url3 이용
    confirm($msg, $url1, $url2);
}

if ($member['mb_level'] < $board['bo_download_level']) {
    $alert_msg = '다운로드 권한이 없습니다.';
    if ($member['mb_id'])
        alert($alert_msg);
    else
        alert($alert_msg.'\\n회원이시라면 로그인 후 이용해 보십시오.', G5_BBS_URL.'/login.php?wr_id='.$wr_id.'&amp;'.$qstr.'&amp;url='.urlencode(get_pretty_url($bo_table, $wr_id)));
}

$filepath = G5_DATA_PATH.'/file/'.$bo_table.'/'.$file['file'];
$filepath = addslashes($filepath);
$file_exist_check = (!is_file($filepath) || !file_exists($filepath)) ? false : true;

if ( false === run_replace('download_file_exist_check', $file_exist_check, $file) ){
    alert('파일이 존재하지 않습니다.');
}

// 이미 다운로드 받은 파일인지를 검사한 후 게시물당 한번만 포인트를 차감하도록 수정
$ss_name = 'ss_down_'.$bo_table.'_'.$wr_id;
if (!get_session($ss_name))
{
    // 자신의 글이라면 통과
    // 관리자인 경우 통과
    if (($write['mb_id'] && $write['mb_id'] == $member['mb_id']) || $is_admin)
        ;
    else if ($board['bo_download_level'] >= 1) // 회원이상 다운로드가 가능하다면
    {
        // 다운로드 포인트가 음수이고 회원의 포인트가 0 이거나 작다면
        if ($member['mb_point'] + $board['bo_download_point'] < 0)
            alert('보유하신 포인트('.number_format($member['mb_point']).')가 없거나 모자라서 다운로드('.number_format($board['bo_download_point']).')가 불가합니다.\\n\\n포인트를 적립하신 후 다시 다운로드 해 주십시오.');

        // 게시물당 한번만 차감하도록 수정
        insert_point($member['mb_id'], $board['bo_download_point'], "{$board['bo_subject']} $wr_id 파일 다운로드", $bo_table, $wr_id, "다운로드");
    }

    set_session($ss_name, TRUE);
}

// 이미 다운로드 받은 파일인지를 검사한 후 다운로드 카운트 증가 ( SIR 그누위즈 님 코드 제안 )
$ss_name = 'ss_down_'.$bo_table.'_'.$wr_id.'_'.$no;
if (!get_session($ss_name))
{
    // 다운로드 카운트 증가
    $cfile[$no]['download']++;
    $sql = " update {$write_table} set wr_link2 = '".serialize($cfile)."' where wr_id = '$wr_id' ";
    sql_query($sql);
    // 다운로드 카운트를 증가시키고 세션을 생성
    $_SESSION[$ss_name] = true;
}

$original = urlencode($file['source']);

run_event('download_file_header', $file, $file_exist_check);

if(preg_match("/msie/i", $_SERVER['HTTP_USER_AGENT']) && preg_match("/5\.5/", $_SERVER['HTTP_USER_AGENT'])) {
    header("content-type: doesn/matter");
    header("content-length: ".filesize($filepath));
    header("content-disposition: attachment; filename=\"$original\"");
    header("content-transfer-encoding: binary");
} else if (preg_match("/Firefox/i", $_SERVER['HTTP_USER_AGENT'])){
    header("content-type: file/unknown");
    header("content-length: ".filesize($filepath));
    header("content-disposition: attachment; filename=\"".basename($file['source'])."\"");
    header("content-description: php generated data");
} else {
    header("content-type: file/unknown");
    header("content-length: ".filesize($filepath));
    header("content-disposition: attachment; filename=\"$original\"");
    header("content-description: php generated data");
}
header("pragma: no-cache");
header("expires: 0");
flush();

$fp = fopen($filepath, 'rb');

$download_rate = 10;

while(!feof($fp)) {
    print fread($fp, round($download_rate * 1024));
    flush();
    usleep(1000);
}
fclose ($fp);
flush();
?>