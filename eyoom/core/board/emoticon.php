<?php
$g5_path = '../../..';
include_once($g5_path.'/common.php');

@include_once(EYOOM_INC_PATH.'/html_process.php');

$emo = isset($_GET['emo']) ? clean_xss_tags($_GET['emo']): '';
if (!$emo) $emo = 'rabbit';

$emoticon = $bbs->get_emoticon($emo);
$emo_type = $qfile->get_sub_dir('emoticon', EYOOM_THEME_PATH);

/**
 * 스킨 경로 지정
 */
$emoticon_skin_path = EYOOM_THEME_PATH.'/'.G5_SKIN_DIR.'/emoticon/basic';
$emoticon_skin_url = str_replace(G5_PATH, G5_URL, $emoticon_skin_path);

include_once(G5_PATH.'/head.sub.php');

if (!file_exists($emoticon_skin_path.'/emoticon.skin.html.php')) die('skin error');
include_once ($emoticon_skin_path.'/emoticon.skin.html.php');

include_once(G5_PATH.'/tail.sub.php');