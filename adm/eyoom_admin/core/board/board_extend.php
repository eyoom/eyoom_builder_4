<?php
/**
 * @file    /adm/eyoom_admin/core/board/board_extend.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300100";

auth_check_menu($auth, $sub_menu, 'w');

if ($is_admin != 'super') alert('최고관리자만 접근 가능합니다.');

if (!$board) alert("잘못된 접근입니다.");

if ($eyoom_board['use_gnu_skin'] == 'y') {
    alert("게시판 확장필드 기능은 그누보드스킨에서는 사용하실 수 없습니다.");
}

$action_url1 = G5_ADMIN_URL . '/?dir=board&amp;pid=board_extend_update&amp;smode=1';
$action_url2 = G5_ADMIN_URL . '/?dir=board&amp;pid=board_exlist_update&amp;smode=1';

/**
 * 탭메뉴
 */
$pg_anchor = array(
    'anc_bo_basic' => '기본 설정',
    'anc_bo_auth' => '권한 설정',
    'anc_bo_function' => '기능 설정',
    'anc_bo_design' => '디자인/양식',
    'anc_bo_point' => '포인트 설정',
    'anc_bo_exfields' => '여분필드'
);

/**
 * 게시판 확장필드 테이블 생성
 */
$sql = "
    CREATE TABLE IF NOT EXISTS `" . $g5['eyoom_exboard'] . "` (
      `ex_no` int(11) unsigned NOT NULL auto_increment,
      `bo_table` varchar(20) NOT NULL,
      `ex_fname` varchar(10) NOT NULL,
      `ex_subject` varchar(50) NOT NULL,
      `ex_use_search` enum('y','n') NOT NULL default 'n',
      `ex_required` enum('y','n') NOT NULL default 'n',
      `ex_form` varchar(20) NOT NULL default 'text',
      `ex_type` varchar(20) NOT NULL,
      `ex_length` mediumint(5) NOT NULL,
      `ex_default` varchar(255) NOT NULL,
      `ex_item_value` text NOT NULL,
      PRIMARY KEY  (`ex_no`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
$sql = get_db_create_replace($sql);
sql_query($sql, true);

/**
 * 배너 테이블에서 작업테마의 배너/광고 레코드 정보 가져오기
 */
$sql_common = " from {$g5['eyoom_exboard']} ";

/**
 * 작업테마 조건문
 */
$sql_search = " where bo_table='{$board['bo_table']}' ";

/**
 * 출력순서
 */
$sql_order = " order by ex_no asc ";

$sql = " select * {$sql_common} {$sql_search} {$sql_order}";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;
    switch($row['ex_form']) {
        case 'text':
            $list[$i]['form'] = "&lt;input type='<strong class='color-red'>text</strong>' name='{$row['ex_fname']}'&gt;";
            break;

        case 'radio':
            $list[$i]['form'] = "&lt;input type='<strong class='color-red'>radio</strong>' name='{$row['ex_fname']}'&gt;";
            break;

        case 'checkbox':
            $list[$i]['form'] = "&lt;input type='<strong class='color-red'>checkbox</strong>' name='{$row['ex_fname']}'&gt;";
            break;

        case 'select':
            $list[$i]['form'] = "&lt;<strong class='color-red'>select</strong> name='{$row['ex_fname']}'&gt;";
            break;

        case 'textarea':
            $list[$i]['form'] = "&lt;<strong class='color-red'>textarea</strong> name='{$row['ex_fname']}'&gt;";
            break;

        case 'address':
            $list[$i]['form'] = "<strong class='color-red'>address</strong>";
            break;
    }
}

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

/**
 * 버튼셋
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="일괄추가" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= !$wmode ? ' <a href="' . G5_ADMIN_URL . '/?dir=board&amp;pid=board_list&amp;'.$qstr.'" class="btn-e btn-e-lg btn-e-dark">목록</a> ': '';
$frm_submit .= '</div>';