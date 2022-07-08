<?php
/**
 * @file    /adm/eyoom_admin/core/shop/brandlistupdate.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400350";

check_demo();

if (!count($_POST['chk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

auth_check($auth[$sub_menu], 'w');

check_admin_token();

if ($_POST['act_button'] == "선택수정") {
    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        // 대상 
        $br_no = $_POST['br_no'][$k];

        $sql = " update {$g5['eyoom_brand']}
                    set br_name = '".sql_real_escape_string($_POST['br_name'][$k])."',
                        br_open = '".sql_real_escape_string($_POST['br_open'][$k])."',
                        br_sort = '".sql_real_escape_string($_POST['br_sort'][$k])."'
                    where br_no = '{$br_no}' ";
        sql_query($sql);
    }
    $message = "선택한 브랜드 정보를 수정하였습니다.";

} else if ($_POST['act_button'] == "선택삭제") {

    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        // 대상 
        $br_no = $_POST['br_no'][$k];

        $row = sql_fetch("select * from {$g5['eyoom_brand']} where br_no = '{$br_no}' ");
        $br_logofile = G5_DATA_PATH.'/brand/'.$row['br_img'];
        if (file_exists($br_logofile) && !is_dir($br_logofile)) {
            unlink($br_logofile);
        }
        
        // 브랜드 정보 삭제
        $sql = "delete from {$g5['eyoom_brand']} where br_no = '{$br_no}' ";
        sql_query($sql);
    }
    $message = "선택한 브랜드를 삭제처리하였습니다.";
}

alert($message, G5_ADMIN_URL . '/?dir=shop&amp;pid=brandlist&amp;'.$qstr);