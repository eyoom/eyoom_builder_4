<?php
/**
 * @file    /adm/eyoom_admin/core/theme/eblatest_list_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999620";

check_demo();

$post_count_chk = (isset($_POST['chk']) && is_array($_POST['chk'])) ? count($_POST['chk']) : 0;
$chk = (isset($_POST['chk']) && is_array($_POST['chk'])) ? $_POST['chk'] : array();
$post_theme = isset($_POST['theme']) && $_POST['theme'] ? clean_xss_tags(trim($_POST['theme'])) : 'eb4_basic';
$act_button = isset($_POST['act_button']) ? strip_tags($_POST['act_button']) : '';

if (! $post_count_chk) {
    alert($act_button." 하실 항목을 하나 이상 체크하세요.");
}

if ($act_button == "선택수정") {

    auth_check_menu($auth, $sub_menu, 'w');

    for ($i=0; $i<$post_count_chk; $i++) {

        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;
        $el_state = isset($_POST['el_state'][$k]) ? clean_xss_tags($_POST['el_state'][$k]): '';
        $el_no = isset($_POST['el_no'][$k]) ? clean_xss_tags($_POST['el_no'][$k]): '';
        $el_code = isset($_POST['el_code'][$k]) ? clean_xss_tags($_POST['el_code'][$k]): '';

        $sql = " update {$g5['eyoom_latest']}
                    set el_state = '{$el_state}'
                 where el_no = '{$el_no}' and el_theme = '{$post_theme}' ";
        sql_query($sql);

        /**
         * EB최신글 마스터 설정파일
         */
        unset($el_master);
        $el_master_file = G5_DATA_PATH . '/eblatest/'.$post_theme.'/el_master_' . $el_code . '.php';
        include ($el_master_file);
        $el_master['el_state'] = $el_state;

        /**
         * 설정파일 저장
         */
        $qfile->save_file('el_master', $el_master_file, $el_master);
    }
    $msg = "정상적으로 수정하였습니다.";

    if (!$page) $page = 1;
    $qstr = "page={$page}";

} else if ($act_button == "선택삭제") {

    auth_check_menu($auth, $sub_menu, 'd');
    $del_el_no = $del_el_code = array();
    for ($i=0; $i<$post_count_chk; $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;
        $el_no = isset($_POST['el_no'][$k]) ? clean_xss_tags($_POST['el_no'][$k]): '';
        $el_code = isset($_POST['el_code'][$k]) ? clean_xss_tags($_POST['el_code'][$k]): '';

        $del_el_no[$i] = $el_no;
        $del_el_code[$i] = $el_code;
        
        /**
         * EB최신글 마스터 설정파일 삭제
         */
        $el_master_file = G5_DATA_PATH . '/eblatest/'.$post_theme.'/el_master_' . $el_code . '.php';
        $el_item_file = G5_DATA_PATH . '/eblatest/'.$post_theme.'/el_item_' . $el_code . '.php';
        @unlink ($el_master_file);
        @unlink ($el_item_file);
    }

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(el_no, '".implode(',', $del_el_no)."') and el_theme = '{$post_theme}' ";

    /**
     * EB최신글 마스터 테이블 레코드 삭제
     */
    $sql = "delete from {$g5['eyoom_latest']} where {$where} ";
    sql_query($sql);

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(el_code, '".implode(',', $del_el_code)."') and li_theme = '{$post_theme}' ";

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