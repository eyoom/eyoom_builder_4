<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebbanner_itemlist_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999630";

check_demo();

$bn_code = isset($_POST['bn_code']) ? (int) clean_xss_tags(trim($_POST['bn_code'])) : '';
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

check_admin_token();

if ($act_button === "선택수정") {

    auth_check_menu($auth, $sub_menu, 'w');

    for ($i=0; $i<$post_count_chk; $i++) {

        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        $post_bi_sort = isset($_POST['bi_sort'][$k]) ? (int) clean_xss_tags($_POST['bi_sort'][$k], 1, 1) : '';
        $post_bi_state = isset($_POST['bi_state'][$k]) ? (int) clean_xss_tags($_POST['bi_state'][$k], 1, 1) : '';
        $bi_view_level = isset($_POST['bi_view_level'][$k]) ? (int) clean_xss_tags($_POST['bi_view_level'][$k], 1, 1) : 1;
        $bi_link = isset($_POST['bi_link'][$k]) ? clean_xss_tags($_POST['bi_link'][$k], 1, 1) : '';
        $bi_no = isset($_POST['bi_no'][$k]) ? (int) clean_xss_tags($_POST['bi_no'][$k], 1, 1) : '';

        if ($bi_link) {
            $bi_link = substr($bi_link,0,1000);
            $bi_link = trim(strip_tags($bi_link));
            $bi_link = preg_replace("#[\\\]+$#", "", $bi_link);
        }



        $sql = " update {$g5['eyoom_banner_item']}
                    set bi_sort = '{$post_bi_sort}',
                        bi_state = '{$post_bi_state}',
                        bi_view_level = '{$bi_view_level}',
                        bi_link = '{$bi_link}'
                 where bi_no = '{$bi_no}' and bi_theme = '{$post_theme}' ";
        sql_query($sql);
    }
    $msg = "정상적으로 수정하였습니다.";

    if (!$page) $page = 1;
    $qstr = "page={$page}";

} else if ($act_button == "선택삭제") {

    auth_check_menu($auth, $sub_menu, 'd');
    $del_bi_no = array();
    for ($i=0; $i<count((array)$_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;
        $bi_no = isset($_POST['bi_no'][$k]) ? (int) clean_xss_tags($_POST['bi_no'][$k], 1, 1) : '';
        $del_bi_no[$i] = $bi_no;
    }

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(bi_no, '".implode(',', $del_bi_no)."') and bi_theme = '{$post_theme}' ";

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
    sql_query($sql);
    $msg = "선택한 EB배너의 아이템을 삭제하였습니다.";
}

/**
 * 설정된 정보를 파일로 저장 - 캐쉬 기능
 */
$thema->save_ebbanner_item($bn_code , $post_theme);

/**
 * wmode 상태라면
 */
$qstr .= $wmode ? '&amp;wmode=1': '';

alert($msg, G5_ADMIN_URL . "/?dir=theme&amp;pid=ebbanner_form&amp;bn_code={$bn_code}&amp;thema='{$post_theme}'&amp;w=u&amp;".$qstr);