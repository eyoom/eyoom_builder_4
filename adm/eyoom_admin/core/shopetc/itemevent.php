<?php
/**
 * @file    /adm/eyoom_admin/core/shopetc/itemevent.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "500300";

auth_check_menu($auth, $sub_menu, "r");

$sql_common = " from {$g5['g5_shop_event_table']} ";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$sql = "select * $sql_common order by ev_id desc ";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $href = "";
    $sql = " select count(ev_id) as cnt from {$g5['g5_shop_event_item_table']} where ev_id = '{$row['ev_id']}' ";
    $ev = sql_fetch($sql);
    if ($ev['cnt']) {
        $href = "<a href='".G5_ADMIN_URL."/?dir=shopetc&amp;pid=itemeventwin&amp;ev_id={$row['ev_id']}&amp;wmode=1' onclick='eb_modal(this.href); return false;'><b class='color-red'>".$ev['cnt']."</b></a>";
    }
    if ($row['ev_subject_strong']) $subject = '<strong>'.$row['ev_subject'].'</strong>';
    else $subject = $row['ev_subject'];

    $list[$i] = $row;
    $list[$i]['cnt'] = $ev['cnt'];
    $list[$i]['href'] = $href;
    $list[$i]['subject'] = $subject;
}