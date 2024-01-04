<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebslider_list_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999600";

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
        $es_state = isset($_POST['es_state'][$k]) ? (int) clean_xss_tags($_POST['es_state'][$k]): '';
        $es_no = isset($_POST['es_no'][$k]) ? (int) clean_xss_tags($_POST['es_no'][$k]): '';
        $es_code = isset($_POST['es_code'][$k]) ? (int) clean_xss_tags($_POST['es_code'][$k]): '';

        $sql = " update {$g5['eyoom_slider']}
                    set es_state = '{$es_state}'
                 where es_no = '{$es_no}' and es_theme = '{$post_theme}' ";
        sql_query($sql);

        /**
         * EB슬라이더 마스터 설정파일
         */
        unset($es_master);
        $eb_master_file = G5_DATA_PATH . '/ebslider/'.$post_theme.'/es_master_' . $es_code . '.php';
        include ($eb_master_file);
        $es_master['es_state'] = $_POST['es_state'][$k];

        /**
         * 설정파일 저장
         */
        $qfile->save_file('es_master', $eb_master_file, $es_master);
    }
    $msg = "정상적으로 수정하였습니다.";

    if (!$page) $page = 1;
    $qstr = "page={$page}";

} else if ($_POST['act_button'] == "선택삭제") {

    auth_check_menu($auth, $sub_menu, 'd');
    $del_es_no = $del_es_code = array();
    for ($i=0; $i<count((array)$_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;
        $es_no = isset($_POST['es_no'][$k]) ? (int) clean_xss_tags($_POST['es_no'][$k]): '';
        $es_code = isset($_POST['es_code'][$k]) ? (int) clean_xss_tags($_POST['es_code'][$k]): '';

        $del_es_no[$i] = $es_no;
        $del_es_code[$i] = $es_code;
    }

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(es_no, '".implode(',', $del_es_no)."') and es_theme = '{$post_theme}' ";

    /**
     * EB슬라이더 마스터 테이블 레코드 삭제
     */
    $sql = "delete from {$g5['eyoom_slider']} where {$where} ";
    sql_query($sql);

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(es_code, '".implode(',', $del_es_code)."') and ei_theme = '{$post_theme}' ";

    /**
     * EB 슬라이더 아이템 파일 경로
     */
    $ebslider_folder = G5_DATA_PATH.'/ebslider/' . $post_theme;

    $sql = "select ei_img from {$g5['eyoom_slider_item']} where {$where}";
    $res = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($res); $i++) {
        $ei_file = $ebslider_folder . "/{$row['ei_img']}";
        if (!is_dir($ei_file) && file_exists($ei_file)) {
            @unlink($ei_file);
        }
    }

    /**
     * EB슬라이더 아이템 레코드 삭제
     */
    $sql = "delete from {$g5['eyoom_slider_item']} where {$where} ";
    $msg = "선택한 EB슬라이더를 삭제하였습니다.";
}

alert($msg, G5_ADMIN_URL . '/?dir=theme&amp;pid=ebslider_list&amp;'.$qstr);