<?php
/**
 * @file    /adm/eyoom_admin/core/shopetc/itemeventwindel.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "500300";

check_demo();

auth_check($auth[$sub_menu], "d");

$sql = " delete from {$g5['g5_shop_event_item_table']} where ev_id = '$ev_id' and it_id = '$it_id' ";
sql_query($sql);

alert("해당 상품을 이벤트에서 삭제하였습니다.", G5_ADMIN_URL."/?dir=shopetc&amp;pid=itemeventwin&amp;wmode=1&amp;ev_id=$ev_id");