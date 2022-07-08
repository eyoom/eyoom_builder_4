<?php
/**
 * @file    /adm/eyoom_admin/core/config/auth_list.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "100200";

if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.');
}

/**
 * form action
 */
$action_url1    = G5_ADMIN_URL . '/?dir=config&amp;pid=auth_list_delete&amp;smode=1';
$action_url2    = G5_ADMIN_URL . '/?dir=config&amp;pid=auth_update&amp;smode=1';

$sql_common = " from {$g5['auth_table']} a left join {$g5['member_table']} b on (a.mb_id=b.mb_id) ";

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

$au_menu = $_GET['au_menu'] ? (int) $_GET['au_menu']: '';
if ($au_menu) {
    $sql_search .= " and a.au_menu = '{$au_menu}' ";
    $qstr .= "&amp; {$qstr}";
}

if (!$sst) {
    $sst  = "a.mb_id, au_menu";
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
    $is_continue = false;
    // 회원아이디가 없는 메뉴는 삭제함
    if ($row['mb_id'] == '' && $row['mb_nick'] == '') {
        sql_query(" delete from {$g5['auth_table']} where au_menu = '{$row['au_menu']}' ");
        $is_continue = true;
    }

    // 메뉴번호가 바뀌는 경우에 현재 없는 저장된 메뉴는 삭제함
    if (!isset($auth_menu[$row['au_menu']]))
    {
        sql_query(" delete from {$g5['auth_table']} where au_menu = '{$row['au_menu']}' ");
        $is_continue = true;
    }

    if ($is_continue) continue;

    $list[$i] = $row;
    $list[$i]['auth_menu'] = $auth_menu[$row['au_menu']];
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