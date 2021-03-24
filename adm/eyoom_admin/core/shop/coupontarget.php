<?php
/**
 * @file    /adm/eyoom_admin/core/shop/coupontarget.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400800";

auth_check_menu($auth, $sub_menu, "w");

$sch_target = isset($_GET['sch_target']) ? substr(preg_replace('/[^a-zA-Z0-9]/', '', strip_tags($_GET['sch_target'])), 0, 1) : '';
$sch_word   = isset($_GET['sch_word']) ? clean_xss_tags(strip_tags($_GET['sch_word'])) : '';

if($_GET['sch_target'] == 1) {
    $html_title = '분류';
    $t_name = '분류명';
    $t_id = '분류코드';
    $t_desc1 = '분류를';
    $t_desc2 = '분류가';
} else {
    $html_title = '상품';
    $t_name = '상품명';
    $t_id = '상품코드';
    $t_desc1 = '상품을';
    $t_desc2 = '상품이';
}

if($sch_target == 1) {
    $sql_common = " from {$g5['g5_shop_category_table']} ";
    $sql_where = " where ca_use = '1' and ca_nocoupon = '0' ";
    if($sch_word)
        $sql_where .= " and ca_name like '%".sql_real_escape_string($sch_word)."%' ";
    $sql_select = " select ca_id as t_id, ca_name as t_name ";
    $sql_order = " order by ca_order, ca_name ";
} else {
    $sql_common = " from {$g5['g5_shop_item_table']} ";
    $sql_where = " where it_use = '1' and it_nocoupon = '0' ";
    if($sch_word)
        $sql_where .= " and it_name like '%".sql_real_escape_string($sch_word)."%' ";
    $sql_select = " select it_id as t_id, it_name as t_name ";
    $sql_order = " order by it_order, it_name ";
}

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common . $sql_where;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = $sql_select . $sql_common . $sql_where . $sql_order . " limit $from_record, $rows ";
$result = sql_query($sql);

$qstr1 = 'sch_target='.$sch_target.'&amp;sch_word='.urlencode($sch_word);

$k = 0;
$list = array();
for($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;

    $list_num = $total_count - ($page - 1) * $rows;
    $list[$i]['num'] = $list_num - $k;
    $k++;
}

/**
 * 페이징
 */
$paging = $eb->set_paging('admin', $dir, $pid, $qstr1.'&amp;wmode=1');