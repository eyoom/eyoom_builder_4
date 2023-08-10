<?php
/**
 * core file : /eyoom/core/shop/couponzone.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * sfl변수를 통한 SQL Injection 취약점 패치
 */
if (isset($_REQUEST['sfl'])) {
    alert("잘못된 접근입니다.");
}

$sql_common = " from {$g5['g5_shop_coupon_zone_table']}
                where cz_start <= '".G5_TIME_YMD."'
                  and cz_end >= '".G5_TIME_YMD."' ";

$sql_order  = " order by cz_id desc ";

add_javascript('<script src="'.G5_JS_URL.'/shop.couponzone.js"></script>', 100);

$g5['title'] = '쿠폰존';
include_once(G5_SHOP_PATH.'/_head.php');

define('G5_SHOP_CSS_URL', G5_SHOP_SKIN_URL);
$skin_dir = EYOOM_CORE_PATH.'/'.G5_SHOP_DIR;
$skin_file = $skin_dir.'/couponzone.10.skin.php';

if (is_file($skin_file)) {
    include_once($skin_file);
} else {
    echo '<div class="sct_nofile">'.str_replace(G5_PATH.'/', '', $skin_file).' 파일을 찾을 수 없습니다.<br>관리자에게 알려주시면 감사하겠습니다.</div>';
}

include_once(G5_SHOP_PATH.'/_tail.php');