<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebgoods_itemlist_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999500";

check_demo();

$eg_code = isset($_POST['eg_code']) ? clean_xss_tags(trim($_POST['eg_code'])) : '';
$post_count_chk = (isset($_POST['chk']) && is_array($_POST['chk'])) ? count($_POST['chk']) : 0;
$chk = (isset($_POST['chk']) && is_array($_POST['chk'])) ? $_POST['chk'] : array();
$post_theme = isset($_POST['theme']) && $_POST['theme'] ? clean_xss_tags($_POST['theme']) : 'eb4_basic';
$act_button = isset($_POST['act_button']) ? strip_tags($_POST['act_button']) : '';

if (! $post_count_chk) {
    alert($act_button." 하실 항목을 하나 이상 체크하세요.");
}

check_admin_token();

if ($act_button === "선택수정") {

    auth_check_menu($auth, $sub_menu, 'w');

    for ($i=0; $i<$post_count_chk; $i++) {

        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        $post_gi_sort = isset($_POST['gi_sort'][$k]) ? clean_xss_tags($_POST['gi_sort'][$k], 1, 1) : '';
        $post_gi_state = isset($_POST['gi_state'][$k]) ? clean_xss_tags($_POST['gi_state'][$k], 1, 1) : '';
        $gi_view_level = isset($_POST['gi_view_level'][$k]) ? clean_xss_tags($_POST['gi_view_level'][$k], 1, 1) : 1;
        $gi_no = isset($_POST['gi_no'][$k]) ? clean_xss_tags($_POST['gi_no'][$k], 1, 1) : '';

        $sql = " update {$g5['eyoom_contents_item']}
                    set gi_sort = '{$post_gi_sort}',
                        gi_state = '{$post_gi_state}',
                        gi_view_level = '{$gi_view_level}'
                 where gi_no = '{$gi_no}' and gi_theme = '{$post_theme}' ";
        sql_query($sql);
    }
    $msg = "정상적으로 수정하였습니다.";

    if (!$page) $page = 1;
    $qstr = "page={$page}";

} else if ($act_button == "선택삭제") {

    auth_check_menu($auth, $sub_menu, 'd');
    $del_gi_no = array();
    for ($i=0; $i<$post_count_chk; $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;
        $gi_no = isset($_POST['gi_no'][$k]) ? clean_xss_tags($_POST['gi_no'][$k], 1, 1) : '';
        $del_gi_no[$i] = $gi_no;
    }

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(gi_no, '".implode(',', $del_gi_no)."') and gi_theme = '{$post_theme}' ";

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
$thema->save_ebgoods_item($eg_code , $post_theme);

alert($msg, G5_ADMIN_URL . "/?dir=theme&amp;pid=ebgoods_form&amp;eg_code={$eg_code}&amp;thema={$post_theme}&amp;w=u&amp;".$qstr);