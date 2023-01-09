<?php
/**
 * file : /eyoom/inc/html_process.php
 */
if (!defined('_EYOOM_')) exit;

ob_start();

header('Content-Type: text/html; charset=utf-8');
$eb->eyoom_no_cache();

//$html_process = new html_process();