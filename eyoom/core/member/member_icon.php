<?php
$g5_path = '../../..';
include_once($g5_path.'/common.php');

@include_once(EYOOM_INC_PATH.'/html_process.php');

$path = EYOOM_MISC_PATH.'/member_icon/';
$url = G5_URL.'/eyoom/misc/member_icon/';
$files = glob($path.'*');

foreach ($files as $k => $file) {
    $temp = explode('/',$file);
    $filename = $temp[(count((array)$temp)-1)];
    $micon[$k]['file'] = $filename;
    $micon[$k]['url'] = $url.$filename;
}

/**
 * 스킨 경로 지정
 */
$micon_skin_path = EYOOM_THEME_PATH.'/'.G5_SKIN_DIR.'/member/basic';
$micon_skin_url = str_replace(G5_PATH, G5_URL, $micon_skin_path);

include_once(G5_PATH.'/head.sub.php');

if (!file_exists($micon_skin_path.'/member_icon.skin.html.php')) die('skin error');
include_once ($micon_skin_path.'/member_icon.skin.html.php');

include_once(G5_PATH.'/tail.sub.php');