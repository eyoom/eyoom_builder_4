<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebcontents_list_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999610";

check_demo();

$post_count_chk = (isset($_POST['chk']) && is_array($_POST['chk'])) ? count($_POST['chk']) : 0;
$chk = (isset($_POST['chk']) && is_array($_POST['chk'])) ? $_POST['chk'] : array();
$me_id = isset($_POST['me_id']) ? clean_xss_tags(trim($_POST['me_id'])) : '';
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

if (isset($me_id) && $me_id) {
    $meinfo = sql_fetch("select * from {$g5['eyoom_menu']} where me_id = '{$me_id}' ");
}

if ($act_button == "선택수정") {

    auth_check_menu($auth, $sub_menu, 'w');

    for ($i=0; $i<$post_count_chk; $i++) {

        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;
        $ec_state = isset($_POST['ec_state'][$k]) ? (int) clean_xss_tags($_POST['ec_state'][$k]): '';
        $ec_sort = isset($_POST['ec_sort'][$k]) ? (int) clean_xss_tags($_POST['ec_sort'][$k]): '';
        $ec_no = isset($_POST['ec_no'][$k]) ? (int) clean_xss_tags($_POST['ec_no'][$k]): '';
        $ec_code = isset($_POST['ec_code'][$k]) ? (int) clean_xss_tags($_POST['ec_code'][$k]): '';
        
        $upset = " ec_state = '{$ec_state}' ";
        if (isset($meinfo) && $meinfo) $upset .= ", ec_sort = '{$ec_sort}' ";
        $sql = " update {$g5['eyoom_contents']} set {$upset} where ec_no = '{$ec_no}' and ec_theme = '{$post_theme}' ";
        sql_query($sql);

        /**
         * EB콘텐츠 마스터 설정파일
         */
        unset($ec_master);
        $ec_master_file = G5_DATA_PATH . '/ebcontents/'.$post_theme.'/ec_master_' . $ec_code . '.php';
        include ($ec_master_file);
        $ec_master['ec_state'] = $ec_state;
        if (isset($meinfo) && $meinfo) $ec_master['ec_sort'] = $ec_sort;

        /**
         * 설정파일 저장
         */
        $qfile->save_file('ec_master', $ec_master_file, $ec_master);
    }
    $msg = "정상적으로 수정하였습니다.";

} else if ($act_button == "선택삭제") {

    auth_check_menu($auth, $sub_menu, 'd');
    $del_ec_no = $del_ec_code = array();
    for ($i=0; $i<$post_count_chk; $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;
        $ec_no = isset($_POST['ec_no'][$k]) ? (int) clean_xss_tags($_POST['ec_no'][$k]): '';
        $ec_code = isset($_POST['ec_code'][$k]) ? (int) clean_xss_tags($_POST['ec_code'][$k]): '';

        $del_ec_no[$i] = $ec_no;
        $del_ec_code[$i] = $ec_code;
    }

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(ec_no, '".implode(',', $del_ec_no)."') and ec_theme = '{$post_theme}' ";

    /**
     * EB컨텐츠 마스터 테이블 레코드 삭제
     */
    $sql = "delete from {$g5['eyoom_contents']} where {$where} ";
    sql_query($sql);

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(ec_code, '".implode(',', $del_ec_code)."') and ci_theme = '{$post_theme}' ";

    /**
     * EB컨텐츠 아이템 파일 경로
     */
    $ebcontents_folder = G5_DATA_PATH.'/ebcontents/' . $post_theme;

    $sql = "select ci_img from {$g5['eyoom_contents_item']} where {$where}";
    $res = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($res); $i++) {
        $ci_img = $eb->mb_unserialize($row['ci_img']);
        foreach ($ci_img as $k => $img_name) {
            $ci_file = $ebcontents_folder . '/' . $img_name;
            if (!is_dir($ci_file) && file_exists($ci_file) && $img_name) {
                @unlink($ci_file);
            }
        }
    }

    /**
     * EB컨텐츠 아이템 레코드 삭제
     */
    $sql = "delete from {$g5['eyoom_contents_item']} where {$where} ";
    sql_query($sql);
    $msg = "선택한 EB컨텐츠를 삭제하였습니다.";
}

/**
 * 모달창 닫고 리로드하기
 */
echo "<script>alert('".$msg."');window.parent.reload_contents_list('".$meinfo['me_code']."');</script>";
exit;