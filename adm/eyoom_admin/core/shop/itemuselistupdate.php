<?php
/**
 * @file    /adm/eyoom_admin/core/shop/itemqalist.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400650";

check_demo();

check_admin_token();

if (!count($_POST['chk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

if ($_POST['act_button'] == "선택수정") {
    auth_check($auth[$sub_menu], 'w');
} else if ($_POST['act_button'] == "선택삭제") {
    auth_check($auth[$sub_menu], 'd');
} else {
    alert("선택수정이나 선택삭제 작업이 아닙니다.");
}

for ($i=0; $i<count($_POST['chk']); $i++)
{
    $k = $_POST['chk'][$i]; // 실제 번호를 넘김

    if ($_POST['act_button'] == "선택수정")
    {
        $sql = "update {$g5['g5_shop_item_use_table']}
                   set is_score   = '{$_POST['is_score'][$k]}',
                       is_confirm = '{$_POST['is_confirm'][$k]}'
                 where is_id      = '{$_POST['is_id'][$k]}' ";
        sql_query($sql);

        $msg = "선택한 상품후기를 수정처리하였습니다.";
    }
    else if ($_POST['act_button'] == "선택삭제")
    {
        $sql = "delete from {$g5['g5_shop_item_use_table']} where is_id = '{$_POST['is_id'][$k]}' ";
        sql_query($sql);

        $msg = "선택한 상품후기를 삭제처리하였습니다.";
    }

    update_use_cnt($_POST['it_id'][$k]);
    update_use_avg($_POST['it_id'][$k]);
}

alert($msg, G5_ADMIN_URL . "/?dir=shop&amp;pid=itemuselist&amp;sca=$sca&amp;sst=$sst&amp;sod=$sod&amp;sfl=$sfl&amp;stx=$stx&amp;page=$page");