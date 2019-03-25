<?php
/**
 * @file    /adm/eyoom_admin/core/shopetc/itemeventlistupdate.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "500310";

check_demo();

auth_check($auth[$sub_menu], "w");

for ($i=0; $i<count($_POST['it_id']); $i++)
{
    $iit_id = preg_replace('/[^a-z0-9_\-]/i', '', $_POST['it_id'][$i]);

    $sql = " delete from {$g5['g5_shop_event_item_table']}
              where ev_id = '$ev_id'
                and it_id = '{$iit_id}' ";
    sql_query($sql);

    if (isset($_POST['ev_chk'][$i]) && $_POST['ev_chk'][$i])
    {
        $sql = "insert into {$g5['g5_shop_event_item_table']}
                   set ev_id = '$ev_id',
                       it_id = '{$iit_id}' ";
        sql_query($sql);
    }

}

// query string
$qstr .= $cate_a ? '&amp;cate_a='.$cate_a: '';
$qstr .= $cate_b ? '&amp;cate_b='.$cate_b: '';
$qstr .= $cate_c ? '&amp;cate_c='.$$cate_c: '';
$qstr .= $cate_d ? '&amp;cate_d='.$cate_d: '';

alert("해당 상품을 선택한 이벤트에 추가하였습니다.", G5_ADMIN_URL . '/?dir=shopetc&amp;pid=itemeventlist&amp;ev_id='.$ev_id.'&amp;'.$qstr.'&amp;page='.$page);