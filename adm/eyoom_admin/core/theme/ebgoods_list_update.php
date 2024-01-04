<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebgoods_list_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999500";

check_demo();

$post_count_chk = (isset($_POST['chk']) && is_array($_POST['chk'])) ? count($_POST['chk']) : 0;
$chk = (isset($_POST['chk']) && is_array($_POST['chk'])) ? $_POST['chk'] : array();
$act_button = isset($_POST['act_button']) ? strip_tags($_POST['act_button']) : '';

if (isset($_REQUEST['theme'])) {
    if (!is_array($_REQUEST['theme'])) {
        $post_theme = filter_var($_REQUEST['theme'], FILTER_VALIDATE_REGEXP, array(
            "options" => array("regexp" => "/^[a-z0-9_]+$/i")
        ));
        $post_theme = preg_replace('/[^a-z0-9_]/i', '', trim($post_theme));
    }
} else {
    $post_theme = 'eb4_basic';
}

if (! $post_count_chk) {
    alert($act_button." 하실 항목을 하나 이상 체크하세요.");
}

if ($act_button == "선택수정") {

    auth_check_menu($auth, $sub_menu, 'w');

    for ($i=0; $i<$post_count_chk; $i++) {

        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;
        $eg_state = isset($_POST['eg_state'][$k]) ? (int) clean_xss_tags($_POST['eg_state'][$k]): '';
        $eg_no = isset($_POST['eg_no'][$k]) ? (int) clean_xss_tags($_POST['eg_no'][$k]): '';
        $eg_code = isset($_POST['eg_code'][$k]) ? (int) clean_xss_tags($_POST['eg_code'][$k]): '';

        $sql = " update {$g5['eyoom_goods']}
                    set eg_state = '{$eg_state}'
                 where eg_no = '{$eg_no}' and eg_theme = '{$post_theme}' ";
        sql_query($sql);

        /**
         * EB상품추출 마스터 설정파일
         */
        unset($eg_master);
        $eg_master_file = G5_DATA_PATH . '/ebgoods/'.$post_theme.'/eg_master_' . $eg_code . '.php';
        include ($eg_master_file);
        $eg_master['eg_state'] = $_POST['eg_state'][$k];

        /**
         * 설정파일 저장
         */
        $qfile->save_file('eg_master', $eg_master_file, $eg_master);
    }
    $msg = "정상적으로 수정하였습니다.";

    if (!$page) $page = 1;
    $qstr = "page={$page}";

} else if ($act_button == "선택삭제") {

    auth_check_menu($auth, $sub_menu, 'd');
    $del_eg_no = $del_eg_code = array();
    for ($i=0; $i<$post_count_chk; $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;
        $eg_no = isset($_POST['eg_no'][$k]) ? (int) clean_xss_tags($_POST['eg_no'][$k]): '';
        $eg_code = isset($_POST['eg_code'][$k]) ? (int) clean_xss_tags($_POST['eg_code'][$k]): '';

        $del_eg_no[$i] = $eg_no;
        $del_eg_code[$i] = $eg_code;
    }

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(eg_no, '".implode(',', $del_eg_no)."') and eg_theme = '{$post_theme}' ";

    /**
     * EB상품추출 마스터 테이블 레코드 삭제
     */
    $sql = "delete from {$g5['eyoom_goods']} where {$where} ";
    sql_query($sql);

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(eg_code, '".implode(',', $del_eg_code)."') and gi_theme = '{$post_theme}' ";

    /**
     * EB상품추출 아이템 레코드 삭제
     */
    $sql = "delete from {$g5['eyoom_goods_item']} where {$where} ";
    sql_query($sql);
    $msg = "선택한 EB상품추출을 삭제하였습니다.";
}

/**
 * qstr에 wmode추가
 */
$qstr .= $wmode ? '&amp;wmode=1': '';

alert($msg, G5_ADMIN_URL . '/?dir=theme&amp;pid=ebgoods_list&amp;'.$qstr);