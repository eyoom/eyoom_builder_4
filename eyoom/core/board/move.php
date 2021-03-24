<?php
/**
 * core file : /eyoom/core/board/move.php
 *
 * /eyoom/common.php $exchange_file 에서 호출
 */
if (!defined('_EYOOM_')) exit;

if ($sw == 'move')
    $act = '이동';
else if ($sw == 'copy')
    $act = '복사';
else
    alert('sw 값이 제대로 넘어오지 않았습니다.');

// 게시판 관리자 이상 복사, 이동 가능
if ($is_admin != 'board' && $is_admin != 'group' && $is_admin != 'super')
    alert_close("게시판 관리자 이상 접근이 가능합니다.");

$g5['title'] = '게시물 ' . $act;
include_once(G5_PATH.'/head.sub.php');

$wr_id_list = '';
if ($wr_id)
    $wr_id_list = $wr_id;
else {
    $comma = '';
    for ($i=0; $i<count((array)$_POST['chk_wr_id']); $i++) {
        $wr_id_list .= $comma . $_POST['chk_wr_id'][$i];
        $comma = ',';
    }
}

//$sql = " select * from {$g5['board_table']} a, {$g5['group_table']} b where a.gr_id = b.gr_id and bo_table <> '$bo_table' ";
// 원본 게시판을 선택 할 수 있도록 함.
$sql = " select * from {$g5['board_table']} a, {$g5['group_table']} b where a.gr_id = b.gr_id ";
if ($is_admin == 'group')
    $sql .= " and b.gr_admin = '{$member['mb_id']}' ";
else if ($is_admin == 'board')
    $sql .= " and a.bo_admin = '{$member['mb_id']}' ";
$sql .= " order by a.gr_id, a.bo_order, a.bo_table ";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $atc_mark = '';
    $atc_bg = '';
    if ($row['bo_table'] == $bo_table) { // 게시물이 현재 속해 있는 게시판이라면
        $row['atc_mark'] = '<span class="copymove_current">'.$now.'<span class="sound_only">게시판</span></span>';
        $row['atc_bg'] = 'copymove_currentbg';
    }
    $list[$i] = $row;
}

// 사용자 프로그램
@include_once(EYOOM_USER_PATH.'/board/move.skin.php');

/**
 * 테마 경로 지정
 */
$move_skin_path = EYOOM_THEME_PATH.'/'.G5_SKIN_DIR.'/move/basic';
$move_skin_url = str_replace(G5_PATH, G5_URL, $move_skin_path);

if (!file_exists($move_skin_path.'/move.skin.html.php')) die('skin error');
@include_once ($move_skin_path.'/move.skin.html.php');

run_event('move_html_footer');
include_once(G5_PATH.'/tail.sub.php');