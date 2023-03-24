<?php
/**
 * @file    /adm/eyoom_admin/core/board/board_extend_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300100";

if ($w == 'u')
    check_demo();

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();

$bo_ex_cnt = clean_xss_tags(trim($_POST['bo_ex_cnt']));
$bo_exadd = clean_xss_tags(trim($_POST['bo_exadd']));

if ($bo_ex_cnt != $board['bo_ex_cnt']) {
    alert("잘못된 접근입니다.");
} else {
    $write_table = $g5['write_prefix'] . $board['bo_table'];
}

if ($eyoom_board['use_gnu_skin'] == 'y') {
    alert("게시판 확장필드 기능은 그누보드스킨에서는 사용하실 수 없습니다.");
}

// 확장필드를 게시판 테이블에 추가하기
$add_set = array();
$k = $bo_ex_cnt + 1;
$add_set = array();
for($i=0; $i<$bo_exadd; $i++) {
    unset($ex_fname, $set_info, $insert);

    $ex_fname = EYOOM_EXBOARD_PREFIX . $k;
    $j = $k - 1;
    if ($k == 1) {
        $add_set[$i] = " ADD `{$ex_fname}` VARCHAR(255) NOT NULL default '' ";
    } else {
        $after_fields = EYOOM_EXBOARD_PREFIX . $j;
        $add_set[$i] = " ADD `{$ex_fname}` VARCHAR(255) NOT NULL default '' AFTER `{$after_fields}`";
    }

    $set_info = "
        bo_table = '{$board['bo_table']}',
        ex_fname = '{$ex_fname}',
        ex_subject = '확장필드 {$k}',
        ex_form = 'text',
        ex_type = 'varchar',
        ex_length = '255'
    ";

    $insert = "insert into {$g5['eyoom_exboard']} set {$set_info}";
    sql_query($insert);
    $k++;
}
$add_fields = implode(',', $add_set);

$sql = " ALTER TABLE `{$write_table}` {$add_fields} ";
sql_query($sql, true);

// 최종 추가된 확장필드 갯수
$sql = "SHOW COLUMNS FROM {$write_table} LIKE 'ex_%'";
$res = sql_query($sql);
$ex = array();
for($i=0; $row=sql_fetch_array($res); $i++) {
    $ex[$i] = $row['Field'];
}
$bo_ex_cnt = count($ex);

sql_query("update {$g5['board_table']} set bo_ex_cnt = '{$bo_ex_cnt}' where bo_table = '{$board['bo_table']}' ");

// query string
$qstr .= $grid ? '&amp;grid='.$grid: '';
$qstr .= $boskin ? '&amp;boskin='.$boskin: '';
$qstr .= $bomobileskin ? '&amp;bomobileskin='.$bomobileskin: '';
$qstr .= $bo_ex ? '&amp;bo_ex='.$bo_ex: '';
$qstr .= $bo_cate ? '&amp;bo_cate='.$bo_cate: '';
$qstr .= $bo_sideview ? '&amp;bo_sideview='.$bo_sideview: '';
$qstr .= $bo_dhtml ? '&amp;bo_dhtml='.$bo_dhtml: '';
$qstr .= $bo_secret ? '&amp;bo_secret='.$bo_secret: '';
$qstr .= $bo_good ? '&amp;bo_good='.$bo_good: '';
$qstr .= $bo_nogood ? '&amp;bo_nogood='.$bo_nogood: '';
$qstr .= $bo_file ? '&amp;bo_file='.$bo_file: '';
$qstr .= $bo_cont ? '&amp;bo_cont='.$bo_cont: '';
$qstr .= $bo_list ? '&amp;bo_list='.$bo_list: '';
$qstr .= $bo_sns ? '&amp;bo_sns='.$bo_sns: '';
$qstr .= $wmode ? '&amp;wmode=1': '';

alert("정상적으로 확장필드를 일괄 추가하였습니다. 세부 설정을 해주세요.", G5_ADMIN_URL . "/?dir=board&amp;pid=board_extend&amp;bo_table={$board['bo_table']}&amp{$qstr}");