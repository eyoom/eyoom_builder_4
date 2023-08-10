<?php
/**
 * @file    /adm/eyoom_admin/core/shop/brandlist.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400350";

$action_url1 = G5_ADMIN_URL . '/?dir=shop&amp;pid=brandlistupdate&amp;smode=1';

auth_check($auth[$sub_menu], 'r');

if ($wmode) $qstr .= "&amp;wmode=1";

// 브랜드 테이블이 없을 경우 생성
if(!sql_query(" DESC {$g5['eyoom_brand']} ", false)) {
    sql_query(" CREATE TABLE IF NOT EXISTS `{$g5['eyoom_brand']}` (
                  `br_no` int(10) unsigned NOT NULL auto_increment,
                  `br_code` varchar(255) NOT NULL,
                  `br_name` varchar(255) NOT NULL,
                  `br_basic` varchar(255) NULL,
                  `br_sort` smallint(3) NOT NULL DEFAULT '0',
                  `br_open` enum('y','n') NOT NULL DEFAULT 'y',
                  `br_img` varchar(255) NULL,
                  `br_regdt` datetime NOT NULL default '0000-00-00 00:00:00',
                  PRIMARY KEY  (`br_no`)
                ) ", false);
}

$sql_common = " from {$g5['eyoom_brand']} ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst = "br_sort";
    $sod = "asc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    
    if ($row['br_img']) {
        $row['img_url'] = G5_DATA_URL.'/brand/'.$row['br_img'];
    }

    $list[$i] = $row;
    
    $list_num = $total_count - ($page - 1) * $rows;
    $list[$i]['num'] = $list_num - $k;
    $k++;
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
