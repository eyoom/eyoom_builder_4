<?php
/**
 * file : /eyoom/inc/shop.init.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 쇼핑몰 코어 파일
 */
if ($eyoom_shop_controller = $shop->eyoom_shop_controller($pathinfo)) {
    /**
     * /shop/_common.php 역할
     */
    if (isset($_REQUEST['sort']))  {
        $sort = trim($_REQUEST['sort']);
        $sort = preg_replace("/[\<\>\'\"\\\'\\\"\%\=\(\)\s]/", "", $sort);
    } else {
        $sort = '';
    }

    if (isset($_REQUEST['sortodr']))  {
        $sortodr = preg_match("/^(asc|desc)$/i", $sortodr) ? $sortodr : '';
    } else {
        $sortodr = '';
    }

    if (!defined('G5_USE_SHOP') || !G5_USE_SHOP)
        die('<p>쇼핑몰 설치 후 이용해 주십시오.</p>');

    define('_SHOP_', true);

    include_once(EYOOM_INC_PATH . '/html_process.php');

    /**
     * 치환파일 불러오기
     */
    include_once($eyoom_shop_controller);
    exit;
}
