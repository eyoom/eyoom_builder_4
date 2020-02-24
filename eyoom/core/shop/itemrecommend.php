<?php
/**
 * core file : /eyoom/core/shop/itemrecommend.php
 */
if (!defined('_EYOOM_')) exit;

if (!$is_member)
    alert_close('회원만 메일을 발송할 수 있습니다.');

// 스팸을 발송할 수 없도록 세션에 아무값이나 저장하여 hidden 으로 넘겨서 다음 페이지에서 비교함
$token = md5(uniqid(rand(), true));
set_session("ss_token", $token);

$it = get_shop_item($it_id, true);
if (!$it['it_name'])
    alert_close("등록된 상품이 아닙니다.");

$g5['title'] =  $it['it_name'].' - 추천하기';
include_once(G5_PATH.'/head.sub.php');

/**
 * 이윰 테마파일 출력
 */
include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/itemrecommend.skin.html.php');

include_once(G5_PATH.'/tail.sub.php');