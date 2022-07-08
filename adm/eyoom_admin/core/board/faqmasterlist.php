<?php
/**
 * @file    /adm/eyoom_admin/core/board/faqmasterlist.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300700";

auth_check_menu($auth, $sub_menu, "r");

//dbconfig파일에 $g5['faq_table'] , $g5['faq_master_table'] 배열변수가 있는지 체크
if (!isset($g5['faq_table']) || !isset($g5['faq_master_table'])) {
    die('<meta charset="utf-8">/data/dbconfig.php 파일에 <br ><strong>$g5[\'faq_table\'] = G5_TABLE_PREFIX.\'faq\';</strong><br ><strong>$g5[\'faq_master_table\'] = G5_TABLE_PREFIX.\'faq_master\';</strong><br > 를 추가해 주세요.');
}

//자주하시는 질문 마스터 테이블이 있는지 검사한다.
if (!sql_query(" DESCRIBE {$g5['faq_master_table']} ", false)) {
    if (sql_query(" DESCRIBE {$g5['g5_shop_faq_master_table']} ", false)) {
        sql_query(" ALTER TABLE {$g5['g5_shop_faq_master_table']} RENAME TO `{$g5['faq_master_table']}` ;", false);
    } else {
        $query_cp = sql_query(
            " CREATE TABLE IF NOT EXISTS `{$g5['faq_master_table']}` (
                      `fm_id` int(11) NOT NULL AUTO_INCREMENT,
                      `fm_subject` varchar(255) NOT NULL DEFAULT '',
                      `fm_head_html` text NOT NULL,
                      `fm_tail_html` text NOT NULL,
                      `fm_order` int(11) NOT NULL DEFAULT '0',
                      PRIMARY KEY (`fm_id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 ",
            true
        );
    }
    // FAQ Master
    sql_query(" insert into `{$g5['faq_master_table']}` set fm_id = '1', fm_subject = '자주하시는 질문' ", false);
}

//자주하시는 질문 테이블이 있는지 검사한다.
if (!sql_query(" DESCRIBE {$g5['faq_table']} ", false)) {
    if (sql_query(" DESCRIBE {$g5['g5_shop_faq_table']} ", false)) {
        sql_query(" ALTER TABLE {$g5['g5_shop_faq_table']} RENAME TO `{$g5['faq_table']}` ;", false);
    } else {
        $query_cp = sql_query(
            " CREATE TABLE IF NOT EXISTS `{$g5['faq_table']}` (
                      `fa_id` int(11) NOT NULL AUTO_INCREMENT,
                      `fm_id` int(11) NOT NULL DEFAULT '0',
                      `fa_subject` text NOT NULL,
                      `fa_content` text NOT NULL,
                      `fa_order` int(11) NOT NULL DEFAULT '0',
                      PRIMARY KEY (`fa_id`),
                      KEY `fm_id` (`fm_id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 ",
            true
        );
    }
}

$g5['title'] = 'FAQ관리';

$sql_common = " from {$g5['faq_master_table']} ";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) {
    $page = 1;
} // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = "select * $sql_common order by fm_order, fm_id limit $from_record, {$config['cf_page_rows']} ";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $sql1 = " select COUNT(*) as cnt from {$g5['faq_table']} where fm_id = '{$row['fm_id']}' ";
    $row1 = sql_fetch($sql1);
    $cnt = $row1['cnt'];

    $list[$i] = $row;
    $list[$i]['cnt'] = $cnt;
}

/**
 * 페이징
 */
$paging = $eb->set_paging('admin', $dir, $pid, $qstr);