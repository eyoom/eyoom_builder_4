<?php
/**
 * core file : /eyoom/mobile/shop/shop.head.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 반응형 테마를 모바일 버전으로 사용
 */
if ($config['cf_eyoom_mobile_skin'] == '2') { // 반응형웹을 모바일 버전으로 사용할 경우
    include EYOOM_PATH . '/shop/shop.head.php';
    return;
}
