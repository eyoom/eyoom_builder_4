<?php
/**
 * lib file : /eyoom/lib/ranking.lib.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 랭킹정보 출력
 */
function eb_ranking($skin_dir='basic', $cnt=10, $return=true) {
    global $config, $eyoom, $member, $g5;

    /**
     * 숨기기 처리
     */
    if (($eyoom['use_ranking_skin'] == 'n' && !defined('_EYOOM_IS_ADMIN_')) || $member['mb_level'] < $eyoom['view_level_ranking']) return;

    if (!$skin_dir) $skin_dir = 'basic';

    $ranking['today'] = get_eyoom_ranking('today', $cnt);
    $ranking['total'] = get_eyoom_ranking('total', $cnt);
    $ranking['level'] = get_eyoom_ranking('level', $cnt);

    if ($return) {
        $ranking_skin_path = EYOOM_THEME_PATH.'/'.G5_SKIN_DIR.'/ranking/'.$skin_dir;
        $ranking_skin_url = str_replace(G5_PATH, G5_URL,$ranking_skin_path);

        ob_start();
        include_once ($ranking_skin_path.'/ranking.skin.html.php');
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    } else {
        return $ranking;
    }
}

/**
 * 랭킹정보 가져오기
 */
function get_eyoom_ranking($type, $cnt=10) {
    global $g5, $eb;
    if (!$type) return array();
    if (!$cnt) $cnt = 10;

    switch ($type) {
        /**
         * 오늘 포인트 랭킹
         */
        case 'today':
            $sql = "select a.mb_id, b.mb_nick, b.mb_name, sum(po_point) as po_point from {$g5['point_table']} as a left join {$g5['member_table']} as b on a.mb_id=b.mb_id where a.po_point > 0 and a.mb_id <> '{$config['cf_admin']}' and (date_format(a.po_datetime, '%Y%m%d%H%i%s') between '".date('Ymd')."000000' and '".date('Ymd')."595959') group by a.mb_id order by sum(po_point) desc limit {$cnt}";
            break;

        /**
         * 전체 포인트 랭킹
         */
        case 'total':
            $sql = "select a.level, b.mb_id, b.mb_nick, b.mb_name, b.mb_point from {$g5['eyoom_member']} as a left join {$g5['member_table']} as b on a.mb_id=b.mb_id where b.mb_email_certify!='0000-00-00 00:00:00' and b.mb_level!='10' order by b.mb_point desc limit {$cnt}";
            break;

        /**
         * 전체 레벨 랭키
         */
        case 'level':
            $sql = "select a.level, a.level_point, b.mb_id, b.mb_nick, b.mb_name, b.mb_point from {$g5['eyoom_member']} as a left join {$g5['member_table']} as b on a.mb_id=b.mb_id where b.mb_email_certify!='0000-00-00 00:00:00' and b.mb_level!='10' order by a.level_point desc limit {$cnt}";
            break;
    }
    //echo $sql; exit;
    $result = sql_query($sql, false);
    $list = array();
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $list[$i] = $row;
        $list[$i]['point'] = $row['level_point'];
        $level_info = $row['mb_level'].'|'.$row['level'];
        $level = $eb->level_info($level_info);
        $list[$i]['eyoom_icon'] = $level['eyoom_icon'];
        $list[$i]['gnu_icon'] = $level['gnu_icon'];
        $list[$i]['mb_photo'] = $eb->mb_photo($row['mb_id'], 'icon');
    }

    if (isset($list)) {
        return $list;
    } else return array();
}