<?php
/**
 * @file    /adm/eyoom_admin/core/shop/itemtypelistupdate.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400610";

check_demo();

auth_check_menu($auth, $sub_menu, "w");

check_admin_token();

$count_post_it_id = (isset($_POST['it_id']) && is_array($_POST['it_id'])) ? count($_POST['it_id']) : 0;

for ($i=0; $i<$count_post_it_id; $i++)
{
    $it_type1 = isset($_POST['it_type1'][$i]) ? (int) $_POST['it_type1'][$i] : 0;
    $it_type2 = isset($_POST['it_type2'][$i]) ? (int) $_POST['it_type2'][$i] : 0;
    $it_type3 = isset($_POST['it_type3'][$i]) ? (int) $_POST['it_type3'][$i] : 0;
    $it_type4 = isset($_POST['it_type4'][$i]) ? (int) $_POST['it_type4'][$i] : 0;
    $it_type5 = isset($_POST['it_type5'][$i]) ? (int) $_POST['it_type5'][$i] : 0;

    $it_id = isset($_POST['it_id'][$i]) ? safe_replace_regex($_POST['it_id'][$i], 'it_id') : '';

    $sql = "update {$g5['g5_shop_item_table']}
               set it_type1 = '".$it_type1."',
                   it_type2 = '".$it_type2."',
                   it_type3 = '".$it_type3."',
                   it_type4 = '".$it_type4."',
                   it_type5 = '".$it_type5."'
             where it_id = '".$it_id."' ";
    sql_query($sql);
}

goto_url(G5_ADMIN_URL . "/?dir=shop&amp;pid=itemtypelist&amp;".$qstr."page=$page");