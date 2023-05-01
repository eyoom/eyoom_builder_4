<?php
/**
 * core file : /eyoom/page/proc/mbmemo.php
 */
if (!defined('_EYOOM_')) exit;

$mbmemo_action_url = EYOOM_CORE_URL.'/page/proc/mbmemo_update.php';

$mb_id = isset($mb_id) ? $mb_id : '';

if ($config['cf_use_mbmemo'] && $is_member && $mb_id) {
    $mbinfo = get_member($mb_id);

    /**
     * 회원 메모 정보 가져오기
     */
    $sql = "select * from {$g5['eyoom_mbmemo']} where mm_my_id = '{$member['mb_id']}' and mm_mb_id = '{$mb_id}' ";
    $mbmemo = sql_fetch($sql);

    if ($mbmemo) {
        $mm_memo = $eb->mb_unserialize($mbmemo['mm_memo']);
        if (is_array($mm_memo)) {
            for ($i=0; $i<5; $i++) {
                $j=$i+1;
                $mkey = 'mm_memo_'.$j;
                $mbmemo[$mkey] = $mm_memo[$i];
            }
        }
    }
}