<?php
include_once('../../../../common.php');

if (!($config['cf_use_mbmemo'] && $mb_id && $is_member)) {
    alert('잘못된 접근입니다.');
}

/**
 * 메모내용 체크
 */
$cnt = 0;
$mm_memo = array();
foreach ($_POST['mm_memo'] as $k => $memo) {
    if ($memo) {
        $memo = substr(trim($memo),0,255);
        $memo = preg_replace("#[\\\]+$#", "", $memo);
        $mm_memo[$k] = $memo;
        if ($memo) $cnt++;
    }
}
$mm_memo = serialize($mm_memo);

$sql_where = " mm_my_id = '{$member['mb_id']}' and mm_mb_id = '{$mb_id}' ";

/**
 * 이미 해당 회원에 대한 회원메모가 있는지 체크
 */
$row = sql_fetch("select * from {$g5['eyoom_mbmemo']} where {$sql_where}");
if ($row['mm_no']) {
    if ($cnt > 0) {
        $sql = "update {$g5['eyoom_mbmemo']} set mm_memo='{$mm_memo}' where {$sql_where}";
    } else {
        $sql = "delete from {$g5['eyoom_mbmemo']} where {$sql_where}";
    }
} else {
    $sql = "insert into {$g5['eyoom_mbmemo']} set mm_my_id = '{$member['mb_id']}', mm_mb_id = '{$mb_id}', mm_memo = '{$mm_memo}' ";
}

sql_query($sql);

goto_url(G5_URL."/page/?pid=mbmemo&amp;mb_id={$mb_id}&amp;wmode=1");