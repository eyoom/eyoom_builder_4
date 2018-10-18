<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebcontents_list_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999610";

check_demo();

if (!count($_POST['chk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

if ($_POST['me_id']) {
    $me_id = clean_xss_tags(trim($_POST['me_id']));
    $meinfo = sql_fetch("select * from {$g5['eyoom_menu']} where me_id = '{$me_id}' ");
}

if ($_POST['act_button'] == "선택수정") {

    auth_check($auth[$sub_menu], 'w');

    for ($i=0; $i<count($_POST['chk']); $i++) {

        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];
        
        $upset = " ec_state = '{$_POST['ec_state'][$k]}' ";
        if ($meinfo) $upset .= ", ec_sort = '{$_POST['ec_sort'][$k]}' ";
        $sql = " update {$g5['eyoom_contents']} set {$upset} where ec_no = '{$_POST['ec_no'][$k]}' and ec_theme = '{$_POST['theme']}' ";
        sql_query($sql);

        /**
         * EB콘텐츠 마스터 설정파일
         */
        unset($ec_master);
        $ec_master_file = G5_DATA_PATH . '/ebcontents/'.$_POST['theme'].'/ec_master_' . $_POST['ec_code'][$k] . '.php';
        include ($ec_master_file);
        $ec_master['ec_state'] = $_POST['ec_state'][$k];
        if ($meinfo) $ec_master['ec_sort'] = $_POST['ec_sort'][$k];

        /**
         * 설정파일 저장
         */
        $qfile->save_file('ec_master', $ec_master_file, $ec_master);
    }
    $msg = "정상적으로 수정하였습니다.";

} else if ($_POST['act_button'] == "선택삭제") {

    auth_check($auth[$sub_menu], 'd');

    for ($i=0; $i<count($_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];
        $del_ec_no[$i] = $_POST['ec_no'][$k];
        $del_ec_code[$i] = $_POST['ec_code'][$k];
    }

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(ec_no, '".implode(',', $del_ec_no)."') and ec_theme = '{$_POST['theme']}' ";

    /**
     * EB컨텐츠 마스터 테이블 레코드 삭제
     */
    $sql = "delete from {$g5['eyoom_contents']} where {$where} ";
    sql_query($sql);

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(ec_code, '".implode(',', $del_ec_code)."') and ci_theme = '{$_POST['theme']}' ";

    /**
     * EB컨텐츠 아이템 파일 경로
     */
    $ebcontents_folder = G5_DATA_PATH.'/ebcontents/' . $_POST['theme'];

    $sql = "select ci_img from {$g5['eyoom_contents_item']} where {$where}";
    $res = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($res); $i++) {
        $ci_img = unserialize($row['ci_img']);
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