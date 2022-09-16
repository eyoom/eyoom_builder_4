<?php
/**
 * lib file : /eyoom/lib/poll.lib.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 설문조사
 */
function eb_poll($skin_dir='basic', $po_id=false) {
    global $config, $member, $g5, $eyoom, $is_admin;

    /**
     * 숨기기 처리
     */
    if ($eyoom['use_poll_skin'] == 'n' || $member['mb_level'] < $eyoom['view_level_poll']) return;

    /**
     * 투표번호가 넘어오지 않았다면 가장 큰(최근에 등록한) 투표번호를 얻는다
     */
    if (!$po_id) {
        $row = sql_fetch(" select MAX(po_id) as max_po_id from {$g5['poll_table']} where po_use = 1 ", false);
        $po_id = isset($row['max_po_id']) ? $row['max_po_id'] : 0;
    }

    if (!$po_id)
        return;

    $poll_skin_path = EYOOM_THEME_PATH.'/'.G5_SKIN_DIR.'/poll/'.$skin_dir;
    $poll_skin_url = str_replace(G5_PATH, G5_URL, $poll_skin_path);

    $po = sql_fetch(" select * from {$g5['poll_table']} where po_id = '$po_id' and po_use = 1 ");

    for ($i=1; $i<=9 && $po["po_poll{$i}"]; $i++) {
        $poll[$i]['po_poll'] = $po["po_poll{$i}"];
    }

    ob_start();
    include_once ($poll_skin_path.'/poll.skin.html.php');
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}