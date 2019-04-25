<?php
include_once('./_common.php');

if(!$_REQUEST['pid']) {
    alert('잘못된 접근입니다.');
    exit;
} else {
    $pid = preg_replace('/[^a-z0-9_|]/i', '', trim($_REQUEST['pid']));
    $pid = substr($pid, 0, 20);
}

define('_PAGE_',true);
if(!$smode) include_once('../_head.php');
include_once($page_skin_path.'/index.php');
if(!$smode) include_once('../_tail.php');
