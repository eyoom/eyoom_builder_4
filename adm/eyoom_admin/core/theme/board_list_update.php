<?php
/**
 * @file    /adm/eyoom_admin/core/theme/board_list_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999200";

check_demo();

if (!count($_POST['chk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

if ($_POST['act_button'] == "선택수정") {

    auth_check($auth[$sub_menu], 'w');

    for ($i=0; $i<count($_POST['chk']); $i++) {

        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $sql = " update {$g5['eyoom_board']}
                    set bo_skin             = '{$_POST['bo_skin'][$k]}',
                        bo_write_limit      = '{$_POST['bo_write_limit'][$k]}',
                        use_gnu_skin        = '{$_POST['use_gnu_skin'][$k]}'
                  where bo_table            = '{$_POST['board_table'][$k]}' and bo_theme = '{$_POST['theme']}' ";
        sql_query($sql);
    }
    $msg = "정상적으로 수정하였습니다.";

    if ($page) $qstr .= "page={$page}";
}

alert($msg, G5_ADMIN_URL . '/?dir=theme&amp;pid=board_list&amp;'.$qstr);