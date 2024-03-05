<?php
/**
 * @file    /adm/eyoom_admin/core/shopetc/itemsellrank.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "500200";

auth_check_menu($auth, $sub_menu, "r");

$fr_date = (isset($_GET['fr_date']) && preg_match("/[0-9]/", $_GET['fr_date'])) ? $_GET['fr_date'] : '';
$to_date = (isset($_GET['to_date']) && preg_match("/[0-9]/", $_GET['to_date'])) ? $_GET['to_date'] : date("Ymd", time());


$sql  = " select *, sum(od_receipt_price) as total_receipt_price from {$g5['g5_shop_order_table']} ";
$sql .= " where (1) and mb_id <> '' ";

if (!$to_date) $to_date = date("Ymd", time());

if ($fr_date && $to_date)
{
    $fr = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3", $fr_date);
    $to = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3", $to_date);
    $sql .= " and od_time between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
}

$sql_order = "order by total_receipt_price desc";

$sql .= " group by mb_id
          $sql_order ";

$result = sql_query($sql);
$total_count = sql_num_rows($result);

$rows = 100;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$rank = ($page - 1) * $rows;

$sql = $sql . " limit $from_record, $rows ";
$result = sql_query($sql);
$qstr .= '&amp;fr_date='.$fr_date.'&amp;to_date='.$to_date;
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    $mbinfo = get_member($row['mb_id']);
    $num = $rank + $i + 1;

    $list[$i] = $row;
    $list[$i]['num'] = $num;
    $list[$i]['mb_name'] = $mbinfo['mb_name'];
    $list[$i]['mb_email'] = $mbinfo['mb_email'];
    $list[$i]['mb_tel'] = $mbinfo['mb_tel'];
    $list[$i]['mb_hp'] = $mbinfo['mb_hp'];
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