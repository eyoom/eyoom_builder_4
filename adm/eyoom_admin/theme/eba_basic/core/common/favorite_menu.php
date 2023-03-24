<?php
require_once './_common.php';

if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.');
}

/**
 * dir 변수 체크
 */
$dir = preg_replace('/[^a-z0-9_]/i', '', trim($_POST['dir']));
$dir = substr($dir, 0, 20);
if (!$dir) return;

/**
 * pid 변수 체크
 */
$pid = preg_replace('/[^a-z0-9_|]/i', '', trim($_POST['pid']));
$pid = substr($pid, 0, 50);
if (!$pid) return;

/**
 * fm_code 변수 체크
 */
$fm_code = preg_replace('/[^0-9]/i', '', trim($_POST['fm_code']));
$fm_code = substr($fm_code, 0, 6);
if (!$fm_code) return;

/**
 * me_name 변수 체크
 */
$me_name = clean_xss_tags(trim($_POST['me_name']));
$me_name = substr($me_name, 0, 255);
if (!$me_name) return;

/**
 * onoff 변수 체크
 * on  : 설정하기 - insert
 * off : 해제하기 - delete
 */
$onoff = clean_xss_tags(trim($_POST['onoff']));
if ($onoff != 'on' && $onoff != 'off') return;

$where = " mb_id='{$member['mb_id']}' and dir='".sql_real_escape_string($dir)."' and pid='".sql_real_escape_string($pid)."' "; 
if ($onoff == 'on') {
    $row = sql_fetch("select count(*) as cnt from {$g5['eyoom_favorite_adm']} where {$where} ");
    if ($row['cnt'] > 0) {
        $sql = "update {$g5['eyoom_favorite_adm']} set fm_code='{$fm_code}', me_name='{$me_name}' where {$where} ";
    } else {
        $sql = "insert into {$g5['eyoom_favorite_adm']} set mb_id='{$member['mb_id']}', dir='".sql_real_escape_string($dir)."', pid='".sql_real_escape_string($pid)."', fm_code='{$fm_code}', me_name='{$me_name}' ";
    }
} else if ($onoff == 'off') {
    $sql = "delete from {$g5['eyoom_favorite_adm']} where {$where} ";
}

sql_query($sql);
