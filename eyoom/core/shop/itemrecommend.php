<?php
/**
 * core file : /eyoom/core/shop/itemrecommend.php
 */
if (!defined('_EYOOM_')) exit;

if (G5_IS_MOBILE && $config['cf_eyoom_mobile_skin'] == '1') {
    include_once(G5_MSHOP_PATH.'/itemrecommend.php');
    return;
}

if (!$is_member)
    alert_close('회원만 메일을 발송할 수 있습니다.');

// 스팸을 발송할 수 없도록 세션에 아무값이나 저장하여 hidden 으로 넘겨서 다음 페이지에서 비교함
$token = md5(uniqid(rand(), true));
set_session("ss_token", $token);

$sql = " select it_name from {$g5['g5_shop_item_table']} where it_id='$it_id' ";
$it = sql_fetch($sql);
if (!$it['it_name'])
    alert_close("등록된 상품이 아닙니다.");

$g5['title'] =  $it['it_name'].' - 추천하기';
include_once(G5_PATH.'/head.sub.php');

/**
 * 이윰 테마파일 출력
 */
include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/itemrecommend.skin.html.php');

include_once(G5_PATH.'/tail.sub.php');