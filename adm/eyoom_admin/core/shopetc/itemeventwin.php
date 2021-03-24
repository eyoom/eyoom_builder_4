<?php
/**
 * @file    /adm/eyoom_admin/core/shopetc/itemeventwin.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "500300";

auth_check_menu($auth, $sub_menu, "r");

$sql = " select ev_subject from {$g5['g5_shop_event_table']} where ev_id = '$ev_id' ";
$ev = sql_fetch($sql);

$sql = " select b.it_id, b.it_name, b.it_use from {$g5['g5_shop_event_item_table']} a
           left join {$g5['g5_shop_item_table']} b on (a.it_id=b.it_id)
          where a.ev_id = '$ev_id'
          order by b.it_id desc ";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    $href = shop_item_url($row['it_id']);

    $list[$i] = $row;
    $list[$i]['image'] = str_replace('"', "'", get_it_image($row['it_id'], 50, 50));
    $list[$i]['href'] = $href;
}