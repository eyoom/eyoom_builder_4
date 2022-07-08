<?php
/**
 * @file    /adm/eyoom_admin/core/config/newwinlist.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = '100310';

auth_check_menu($auth, $sub_menu, "r");

if (!isset($g5['new_win_table'])) {
    die('<meta charset="utf-8">/data/dbconfig.php 파일에 <strong>$g5[\'new_win_table\'] = G5_TABLE_PREFIX.\'new_win\';</strong> 를 추가해 주세요.');
}
//내용(컨텐츠)정보 테이블이 있는지 검사한다.
if (!sql_query(" DESCRIBE {$g5['new_win_table']} ", false)) {
    if (sql_query(" DESCRIBE {$g5['g5_shop_new_win_table']} ", false)) {
        sql_query(" ALTER TABLE {$g5['g5_shop_new_win_table']} RENAME TO `{$g5['new_win_table']}` ;", false);
    } else {
        $query_cp = sql_query(
            " CREATE TABLE IF NOT EXISTS `{$g5['new_win_table']}` (
                      `nw_id` int(11) NOT NULL AUTO_INCREMENT,
                      `nw_division` varchar(10) NOT NULL DEFAULT 'both',
                      `nw_device` varchar(10) NOT NULL DEFAULT 'both',
                      `nw_begin_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                      `nw_end_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                      `nw_disable_hours` int(11) NOT NULL DEFAULT '0',
                      `nw_left` int(11) NOT NULL DEFAULT '0',
                      `nw_top` int(11) NOT NULL DEFAULT '0',
                      `nw_height` int(11) NOT NULL DEFAULT '0',
                      `nw_width` int(11) NOT NULL DEFAULT '0',
                      `nw_subject` text NOT NULL,
                      `nw_content` text NOT NULL,
                      `nw_content_html` tinyint(4) NOT NULL DEFAULT '0',
                      PRIMARY KEY (`nw_id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 ",
            true
        );
    }
}

$g5['title'] = '팝업레이어 관리';

$sql_common = " from {$g5['new_win_table']} ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and nw_subject like '%{$stx}%' ";
}

// 접속기기 검색
$permit_device = array('both', 'pc', 'mobile');
$device = $_GET['device'] ? (int) $_GET['device']: '';
if (!in_array($device, $permit_device)) $device = '';
if ($device) {
    $sql_search .= " and nw_device = '{$device}' ";
    $qstr .= "&amp;device={$device}";
}

// 기간검색이 있다면
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $fr_date) ) $fr_date = '';
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $to_date) ) $to_date = '';

if ($sdt == 'nw_begin_time') {
    $sdt_target = 'nw_begin_time';
} else if ($sdt == 'nw_end_time') {
    $sdt_target = 'nw_end_time';
}

if ($sdt_target && $fr_date && $to_date) {
    $sql_search .= " and $sdt_target between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
    $qstr .= "&amp;sdt={$sdt_target}&amp;fr_date={$fr_date}&amp;to_date={$to_date}";
}

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt {$sql_common} {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) {
    $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
}
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = "select * {$sql_common} {$sql_search} order by nw_id desc limit {$from_record}, {$rows}";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    switch($row['nw_device']) {
        case 'pc':
            $nw_device = 'PC';
            break;
        case 'mobile':
            $nw_device = '모바일';
            break;
        default:
            $nw_device = '모두';
            break;
    }
    $list[$i] = $row;
    $list[$i]['device'] = $nw_device;
}

/**
 * 페이징
 */
$paging = $eb->set_paging('admin', $dir, $pid, $qstr);

/**
 * 검색버튼
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" value="검색" class="btn-e btn-e-lg btn-e-dark" accesskey="s">' ;
$frm_submit .= '</div>';