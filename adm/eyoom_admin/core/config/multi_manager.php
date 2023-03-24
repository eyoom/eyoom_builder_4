<?php
/**
 * @file    /adm/eyoom_admin/core/config/multi_manager.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "100250";

if ($is_admin != 'super' || $member['mb_id'] != $config['cf_admin']) {
    alert('최고관리자만 접근 가능합니다.');
}

/**
 * 이윰 관리자모드 테마
 */
$cf_eyoom_admin_theme = get_skin_dir('theme', EYOOM_ADMIN_PATH);

/**
 * form action
 */
$action_url1 = G5_ADMIN_URL . '/?dir=config&amp;pid=multi_manager_delete&amp;smode=1';
$action_url2 = G5_ADMIN_URL . '/?dir=config&amp;pid=multi_manager_update&amp;smode=1';

/**
 * 다중관리자 테이블 생성
 */
if (!sql_query(" DESC {$g5['eyoom_manager']} ", false)) {
    $sql = "
        CREATE TABLE IF NOT EXISTS `{$g5['eyoom_manager']}` (
          `mb_id` varchar(20) NOT NULL DEFAULT '',
          `mg_theme` varchar(255) NOT NULL DEFAULT '',
          `mg_menu` varchar(255) NOT NULL,
          PRIMARY KEY (`mb_id`,`mg_theme`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
    ";
    $sql = get_db_create_replace($sql);
    sql_query($sql, false);
}

$sql_common = " from {$g5['eyoom_manager']} a left join {$g5['member_table']} b on (a.mb_id=b.mb_id) ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_level' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        case 'mb_tel' :
        case 'mb_hp' :
            $sql_search .= " ({$sfl} like '%{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst  = "a.mb_id";
    $sod = "";
}
$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
            {$sql_common}
            {$sql_search}
            {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) {
    $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
}
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select *
            {$sql_common}
            {$sql_search}
            {$sql_order}
            limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$count = 0;
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    $mg_menu = $eb->mb_unserialize($row['mg_menu']);
    $j=0;
    unset($manager_menu);
    foreach ($mg_menu as $k => $v) {
        $manager_menu[$j] = $dir_menu[$k];
        $j++;
    }

    $list[$i] = $row;
    $list[$i]['mg_menu'] = implode(', ', $manager_menu);
    $count++;
}

if (strstr($sfl, 'mb_id')) {
    $mb_id = $stx;
} else {
    $mb_id = '';
}

require_once G5_CAPTCHA_PATH.'/captcha.lib.php';
$captcha_html = captcha_html();
$captcha_js   = chk_captcha_js();

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