<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebbanner_list_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999630";

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
        $bn_state = isset($_POST['bn_state'][$k]) ? (int) clean_xss_tags($_POST['bn_state'][$k]): '';
        $bn_no = isset($_POST['bn_no'][$k]) ? (int) clean_xss_tags($_POST['bn_no'][$k]): '';
        $bn_code = isset($_POST['bn_code'][$k]) ? (int) clean_xss_tags($_POST['bn_code'][$k]): '';

        $sql = " update {$g5['eyoom_banner']}
                    set bn_state = '{$bn_state}'
                 where bn_no = '{$bn_no}' and bn_theme = '{$post_theme}' ";
        sql_query($sql);

        /**
         * EB배너 마스터 설정파일
         */
        unset($bn_master);
        $eb_master_file = G5_DATA_PATH . '/ebbanner/'.$post_theme.'/bn_master_' . $bn_code . '.php';
        include ($eb_master_file);
        $bn_master['bn_state'] = $_POST['bn_state'][$k];

        /**
         * 설정파일 저장
         */
        $qfile->save_file('bn_master', $eb_master_file, $bn_master);
    }
    $msg = "정상적으로 수정하였습니다.";

    if (!$page) $page = 1;
    $qstr = "page={$page}";

} else if ($_POST['act_button'] == "선택삭제") {

    auth_check_menu($auth, $sub_menu, 'd');
    $del_bn_no = $del_bn_code = array();
    for ($i=0; $i<count((array)$_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;
        $bn_no = isset($_POST['bn_no'][$k]) ? (int) clean_xss_tags($_POST['bn_no'][$k]): '';
        $bn_code = isset($_POST['bn_code'][$k]) ? (int) clean_xss_tags($_POST['bn_code'][$k]): '';

        $del_bn_no[$i] = $bn_no;
        $del_bn_code[$i] = $bn_code;
    }

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(bn_no, '".implode(',', $del_bn_no)."') and bn_theme = '{$post_theme}' ";

    /**
     * EB배너 마스터 테이블 레코드 삭제
     */
    $sql = "delete from {$g5['eyoom_banner']} where {$where} ";
    sql_query($sql);

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(bn_code, '".implode(',', $del_bn_code)."') and bi_theme = '{$post_theme}' ";

    /**
     * EB 배너 아이템 파일 경로
     */
    $ebbanner_folder = G5_DATA_PATH.'/ebbanner/' . $post_theme;

    $sql = "select bi_img from {$g5['eyoom_banner_item']} where {$where}";
    $res = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($res); $i++) {
        $bi_file = $ebbanner_folder . "/{$row['bi_img']}";
        if (!is_dir($bi_file) && file_exists($bi_file)) {
            @unlink($bi_file);
        }
    }

    /**
     * EB배너 아이템 레코드 삭제
     */
    $sql = "delete from {$g5['eyoom_banner_item']} where {$where} ";
    $msg = "선택한 EB배너를 삭제하였습니다.";
}

alert($msg, G5_ADMIN_URL . '/?dir=theme&amp;pid=ebbanner_list&amp;'.$qstr);