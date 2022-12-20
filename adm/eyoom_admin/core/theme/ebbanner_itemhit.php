<?php
/**
 * @file    /adm/eyoom_admin/core/member/ebbanner_itemhit.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999630";

auth_check_menu($auth, $sub_menu, 'r');

$bn_code = clean_xss_tags(trim($_REQUEST['bn_code']));
$bi_no = clean_xss_tags(trim($_REQUEST['bi_no']));
$hit_mode = clean_xss_tags(trim($_REQUEST['hit_mode']));

if ($bn_code) {
    $qstr .= "&amp;bn_code={$bn_code}";
}
if ($bi_no) {
    $qstr .= "&amp;bi_no={$bi_no}";
}

/**
 * 검색관련 소스
 */
include_once(EYOOM_ADMIN_CORE_PATH . '/theme/ebbanner_itemhit.sub.php');

$sql_common = " from {$g5['eyoom_banner_hit']} ";
$sql_search = " where (1) and bn_code='{$bn_code}' and bi_no='{$bi_no}' ";

if ($fr_date && $to_date) {
    $sql_search .= " and bh_date between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
    $qstr .= "&amp;fr_date={$fr_date}&amp;to_date={$to_date}";
}

$sql = " select count(*) as cnt {$sql_common} {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * {$sql_common} {$sql_search} order by bh_id desc limit {$from_record}, {$rows} ";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $link = '';
    $link2 = '';
    $referer = '';
    $title = '';
    if ($row['bh_referer']) {

        $referer = get_text(cut_str($row['bh_referer'], 255, ''));
        $referer = urldecode($referer);

        if (!is_utf8($referer)) {
            $referer = iconv_utf8($referer);
        }

        $title = str_replace(array('<', '>', '&'), array("&lt;", "&gt;", "&amp;"), $referer);
        $link = "<a href='".get_text($row['bh_referer'])."' target='_blank'>";
        $link = str_replace('&', "&amp;", $link);
        $link2 = '</a>';
    }

    $list[$i] = $row;

    $list[$i]['link'] = $link;
    $list[$i]['title'] = $title;
    $list[$i]['link2'] = $link2;
}

$cnt = count($list);
$qstr .= "&amp;wmode=1&amp;page=";

/**
 * 페이징
 */
$paging = $eb->set_paging('admin', $dir, $pid, $qstr);