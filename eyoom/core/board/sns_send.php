<?php
/**
 * core file : /eyoom/core/board/sns_send.php
 *
 * /eyoom/common.php $exchange_file 에서 호출
 */
if (!defined('_EYOOM_')) exit;

$title    =  isset($_REQUEST['title']) ? urlencode(str_replace('\"', '"', $_REQUEST['title'])) : '';
$short_url = isset($_REQUEST['longurl']) ? googl_short_url($_REQUEST['longurl']) : '';
$sns = isset($_REQUEST['sns']) ? $_REQUEST['sns'] : '';

if(!$short_url)
    $short_url = isset($_REQUEST['longurl']) ? urlencode($_REQUEST['longurl']) : '';

$title_url = $title.' : '.$short_url;

switch($sns) {
    case 'facebook' :
        header("Location:http://www.facebook.com/sharer/sharer.php?s=100&u=".$short_url."&p=".$title);
        break;
    case 'twitter' :
        header("Location:https://twitter.com/intent/tweet?text=".$title_url);
        break;
    case 'gplus' :
        header("Location:https://plus.google.com/share?url=".$short_url);
        break;
    case 'kakaostory' :
        header("Location:https://story.kakao.com/share?url=".$short_url);
        break;
    case 'band' :
        header("Location:http://www.band.us/plugin/share?body=".$title_url);
        break;
    default :
        echo 'Error';
}