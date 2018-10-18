<?php
/**
 * core file : /eyoom/core/board/sns.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * sns 버튼들
 */
if ($board['bo_use_sns']) {
    $sns_msg = urlencode(str_replace('\"', '"', $view['subject']));

    $facebook_url = $sns_send.'&amp;sns=facebook';
    $twitter_url  = $sns_send.'&amp;sns=twitter';
    $gplus_url    = $sns_send.'&amp;sns=gplus';

    $longurl = urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    $sns_send  = G5_BBS_URL.'/sns_send.php?longurl='.$longurl;
    $sns_send .= '&amp;title='.$sns_msg;

    $facebook_url = $sns_send.'&amp;sns=facebook';
    $twitter_url  = $sns_send.'&amp;sns=twitter';
    $gplus_url    = $sns_send.'&amp;sns=gplus';
    $kakaostory_url   = $sns_send.'&amp;sns=kakaostory';
    $band_url   = $sns_send.'&amp;sns=band';
}

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/board/sns.skin.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['board'].'/sns.skin.html.php');