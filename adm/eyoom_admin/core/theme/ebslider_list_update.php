<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebslider_list_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999600";

check_demo();

if (!count($_POST['chk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

if ($_POST['act_button'] == "선택수정") {

    auth_check($auth[$sub_menu], 'w');

    for ($i=0; $i<count($_POST['chk']); $i++) {

        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $sql = " update {$g5['eyoom_slider']}
                    set es_state = '{$_POST['es_state'][$k]}'
                 where es_no = '{$_POST['es_no'][$k]}' and es_theme = '{$_POST['theme']}' ";
        sql_query($sql);

        /**
         * EB슬라이더 마스터 설정파일
         */
        unset($es_master);
        $eb_master_file = G5_DATA_PATH . '/ebslider/'.$_POST['theme'].'/es_master_' . $_POST['es_code'][$k] . '.php';
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

    auth_check($auth[$sub_menu], 'd');

    for ($i=0; $i<count($_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];
        $del_es_no[$i] = $_POST['es_no'][$k];
        $del_es_code[$i] = $_POST['es_code'][$k];
    }

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(es_no, '".implode(',', $del_es_no)."') and es_theme = '{$_POST['theme']}' ";

    /**
     * EB슬라이더 마스터 테이블 레코드 삭제
     */
    $sql = "delete from {$g5['eyoom_slider']} where {$where} ";
    sql_query($sql);

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(es_code, '".implode(',', $del_es_code)."') and ei_theme = '{$_POST['theme']}' ";

    /**
     * EB 슬라이더 아이템 파일 경로
     */
    $ebslider_folder = G5_DATA_PATH.'/ebslider/' . $_POST['theme'];

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