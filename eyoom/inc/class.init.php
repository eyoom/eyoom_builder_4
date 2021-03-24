<?php
if (!defined('_EYOOM_')) exit;

/**
 * Include eyoom file class
 */
include_once(EYOOM_CLASS_PATH . '/qfile.class.php');

/**
 * Include eyoom theme class
 */
include_once(EYOOM_CLASS_PATH . '/theme.class.php');

/**
 * Include eyoom common class
 */
include_once(EYOOM_CLASS_PATH . '/eyoom.class.php');

/**
 * Include eyoom bbs class
 */
include_once(EYOOM_CLASS_PATH . '/bbs.class.php');

/**
 * Include eyoom upload class
 */
include_once(EYOOM_CLASS_PATH . '/upload.class.php');

/**
 * Include eyoom latest class
 */
include_once(EYOOM_CLASS_PATH . '/latest.class.php');

/**
 * Include eyoom shop class
 */
include_once(EYOOM_CLASS_PATH.'/shop.class.php');

/**
 * 클래스 오브젝트 생성
 */
$qfile  = new qfile;
$eb     = new eyoom;
$bbs    = new bbs;
$thema  = new theme($eb);
$upload = new upload;
$latest = new latest($eb, $bbs);
$shop   = new shop;
