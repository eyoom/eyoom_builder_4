<?php
/**
 * core file : /eyoom/core/board/group.php
 *
 * /eyoom/common.php $exchange_file 에서 호출
 */
if (!defined('_EYOOM_')) exit;

if (!$is_admin && $group['gr_device'] == 'mobile')
    alert($group['gr_subject'].' 그룹은 모바일에서만 접근할 수 있습니다.');

$g5['title'] = $group['gr_subject'];

/**
 * 헤더 디자인 출력
 */
include_once(G5_PATH . '/_head.php');

// gr_id필터
$gr_id = filter_var($gr_id, FILTER_VALIDATE_REGEXP, array(
    "options" => array("regexp" => "/^[a-z0-9_]+$/i")
));
$gr_id = preg_replace('/[^a-z0-9_]/i', '', $gr_id);

// 모든 그룹정보를 가져온다.
$gr_ids = $bbs->get_group();
if (!$gr_id || !in_array($gr_id, $gr_ids)) {
    alert("잘못된 접근입니다.");
}

$sql = " select bo_table, bo_subject
            from {$g5['board_table']}
            where gr_id = '" . sql_real_escape_string($gr_id) . "'
              and bo_list_level <= '{$member['mb_level']}'
              and bo_device <> 'mobile'
";
if (!$is_admin)
    $sql .= " and bo_use_cert = '' ";
$sql .= " order by bo_order ";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;
    $loop = &$list[$i]['data'];
    if (!$orderby) $orderby = " wr_datetime desc ";
    $write_table = $g5['write_prefix'] . $row['bo_table'];
    $sql2 = "select * from {$write_table} where wr_id = wr_parent order by $orderby limit {$eyoom['group_latest_cnt']}";
    $res = sql_query($sql2, false);
    for ($k=0; $row2 = sql_fetch_array($res); $k++) {
        $loop[$k] = $row2;

        // new 표시
        if ($row2['wr_datetime'] >= date("Y-m-d H:i:s", G5_SERVER_TIME - (24 * 3600))) $loop[$k]['new'] = true;

        if (!$row2['wr_subject']) {
            $loop[$k]['wr_subject'] = conv_subject($row2['wr_content'], 30, '…');
            $loop[$k]['href'] = get_eyoom_pretty_url($row['bo_table'], $row2['wr_id'], '#c_'.$row['wr_id']);
        } else {
            $loop[$k]['wr_subject'] = conv_subject($row2['wr_subject'], 30, '…');
            $loop[$k]['wr_content'] = conv_subject($row2['wr_content'], 30, '…');
            $loop[$k]['href'] = get_eyoom_pretty_url($row['bo_table'],$row2['wr_id']);
        }
        $loop[$k]['datetime'] = $row2['wr_datetime'];
    }
}

$group_cnt = count((array)$list);

/**
 * 테마 경로 지정
 */
$group_skin_path = EYOOM_THEME_PATH.'/'.G5_SKIN_DIR.'/group/basic';
$group_skin_url = str_replace(G5_PATH, G5_URL, $group_skin_path);

if (!file_exists($group_skin_path.'/group.skin.html.php')) die('skin error');
@include_once ($group_skin_path.'/group.skin.html.php');

include_once(G5_PATH . '/_tail.php');