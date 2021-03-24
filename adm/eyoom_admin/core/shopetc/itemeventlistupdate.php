<?php
/**
 * @file    /adm/eyoom_admin/core/shopetc/itemeventlistupdate.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "500310";

check_demo();

auth_check_menu($auth, $sub_menu, "w");

$post_it_id_count = (isset($_POST['it_id']) && is_array($_POST['it_id'])) ? count($_POST['it_id']) : 0;

for ($i=0; $i<$post_it_id_count; $i++)
{
    $iit_id = isset($_POST['it_id'][$i]) ? preg_replace('/[^a-z0-9_\-]/i', '', $_POST['it_id'][$i]) : '';

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
$qstr1 = 'ev_id='.$ev_id.'&amp;cate_a='.$cate_a.'&amp;cate_b='.$cate_b.'&amp;cate_c='.$cate_c.'&amp;sfl='.$sfl.'&amp;stx='.$stx;
$qstr  = $qstr1.'&amp;sst='.$sst.'&amp;sod='.$sod.'&amp;page='.$page;

alert("해당 상품을 선택한 이벤트에 추가하였습니다.", G5_ADMIN_URL . '/?dir=shopetc&amp;pid=itemeventlist&amp;'.$qstr.'&amp;page='.$page);