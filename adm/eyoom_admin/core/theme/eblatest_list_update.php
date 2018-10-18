<?php
/**
 * @file    /adm/eyoom_admin/core/theme/eblatest_list_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999620";

check_demo();

if (!count($_POST['chk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

if ($_POST['act_button'] == "선택수정") {

    auth_check($auth[$sub_menu], 'w');

    for ($i=0; $i<count($_POST['chk']); $i++) {

        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $sql = " update {$g5['eyoom_latest']}
                    set el_state = '{$_POST['el_state'][$k]}'
                 where el_no = '{$_POST['el_no'][$k]}' and el_theme = '{$_POST['theme']}' ";
        sql_query($sql);

        /**
         * EB최신글 마스터 설정파일
         */
        unset($el_master);
        $el_master_file = G5_DATA_PATH . '/eblatest/'.$_POST['theme'].'/el_master_' . $_POST['el_code'][$k] . '.php';
        include ($el_master_file);
        $el_master['el_state'] = $_POST['el_state'][$k];

        /**
         * 설정파일 저장
         */
        $qfile->save_file('el_master', $el_master_file, $el_master);
    }
    $msg = "정상적으로 수정하였습니다.";

    if (!$page) $page = 1;
    $qstr = "page={$page}";

} else if ($_POST['act_button'] == "선택삭제") {

    auth_check($auth[$sub_menu], 'd');

    for ($i=0; $i<count($_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];
        $del_el_no[$i] = $_POST['el_no'][$k];
        $del_el_code[$i] = $_POST['el_code'][$k];
    }

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(el_no, '".implode(',', $del_el_no)."') and el_theme = '{$_POST['theme']}' ";

    /**
     * EB최신글 마스터 테이블 레코드 삭제
     */
    $sql = "delete from {$g5['eyoom_latest']} where {$where} ";
    sql_query($sql);

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(el_code, '".implode(',', $del_el_code)."') and li_theme = '{$_POST['theme']}' ";

    /**
     * EB최신글 아이템 레코드 삭제
     */
    $sql = "delete from {$g5['eyoom_latest_item']} where {$where} ";
    sql_query($sql);
    $msg = "선택한 EB최신글를 삭제하였습니다.";
}

/**
 * qstr에 wmode추가
 */
$qstr .= $wmode ? '&amp;wmode=1': '';

alert($msg, G5_ADMIN_URL . '/?dir=theme&amp;pid=eblatest_list&amp;'.$qstr);