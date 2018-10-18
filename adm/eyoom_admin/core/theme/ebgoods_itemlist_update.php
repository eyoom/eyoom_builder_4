<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebgoods_itemlist_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999500";

check_demo();

if (!count($_POST['chk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

if ($_POST['act_button'] == "선택수정") {

    auth_check($auth[$sub_menu], 'w');

    for ($i=0; $i<count($_POST['chk']); $i++) {

        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $sql = " update {$g5['eyoom_goods_item']}
                    set gi_sort = '{$_POST['gi_sort'][$k]}',
                        gi_state = '{$_POST['gi_state'][$k]}',
                        gi_view_level = '{$_POST['gi_view_level'][$k]}'
                 where gi_no = '{$_POST['gi_no'][$k]}' and gi_theme = '{$_POST['theme']}' ";
        sql_query($sql);
    }
    $msg = "정상적으로 수정하였습니다.";

    if (!$page) $page = 1;
    $qstr = "page={$page}";

} else if ($_POST['act_button'] == "선택삭제") {

    auth_check($auth[$sub_menu], 'd');

    for ($i=0; $i<count($_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];
        $del_gi_no[$i] = $_POST['gi_no'][$k];
    }

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(gi_no, '".implode(',', $del_gi_no)."') and gi_theme = '{$_POST['theme']}' ";

    /**
     * EB상품추출 아이템 레코드 삭제
     */
    $sql = "delete from {$g5['eyoom_goods_item']} where {$where} ";
    sql_query($sql);
    $msg = "선택한 EB상품추출의 아이템을 삭제하였습니다.";
}

/**
 * qstr에 wmode추가
 */
$qstr .= $wmode ? '&amp;wmode=1': '';

/**
 * 설정된 정보를 파일로 저장 - 캐쉬 기능
 */
$thema->save_ebgoods_item($_POST['eg_code'] , $_POST['theme']);

alert($msg, G5_ADMIN_URL . "/?dir=theme&amp;pid=ebgoods_form&amp;eg_code={$_POST['eg_code']}&amp;thema={$_POST['theme']}&amp;w=u&amp;".$qstr);