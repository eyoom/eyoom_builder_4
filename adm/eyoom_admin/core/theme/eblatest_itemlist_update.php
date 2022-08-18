<?php
/**
 * @file    /adm/eyoom_admin/core/theme/eblatest_itemlist_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999620";

check_demo();

$el_code = isset($_POST['el_code']) ? clean_xss_tags(trim($_POST['el_code'])) : '';
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

    /**
     * 설정된 정보를 기준으로 최신글 파일 생성 - 캐쉬 기능
     */
    $latest->save_item($el_code, $post_theme);

    for ($i=0; $i<$post_count_chk; $i++) {

        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        $post_li_sort = isset($_POST['li_sort'][$k]) ? clean_xss_tags($_POST['li_sort'][$k], 1, 1) : '';
        $post_li_state = isset($_POST['li_state'][$k]) ? clean_xss_tags($_POST['li_state'][$k], 1, 1) : '';
        $li_view_level = isset($_POST['li_view_level'][$k]) ? clean_xss_tags($_POST['li_view_level'][$k], 1, 1) : 1;
        $li_no = isset($_POST['li_no'][$k]) ? clean_xss_tags($_POST['li_no'][$k], 1, 1) : '';

        $sql = " update {$g5['eyoom_latest_item']}
                    set li_sort = '{$post_li_sort}',
                        li_state = '{$post_li_state}',
                        li_view_level = '{$li_view_level}'
                 where li_no = '{$li_no}' and li_theme = '{$post_theme}' ";
        sql_query($sql);

        /**
         * EB최신글 master 파일 경로
         */
        $master_file = G5_DATA_PATH . '/eblatest/'.$post_theme.'/el_master_'.$el_code.'.php';

        /**
         * g5_eyoom_latest 테이블에서 정보 추출
         */
        $el_master = $latest->get_master($el_code);

        /**
         * 파일 캐시
         */
        $qfile->save_file('el_master', $master_file, $el_master);

        /**
         * 설정된 정보를 기준으로 최신글 파일 생성 - 캐쉬 기능
         */
        $latest->save_item($el_code, $post_theme);

        /**
         * 최신글 레코드 파일 생성
         */
        $latest->make_cache_data($el_code, $post_theme, $li_no);
    }

    $msg = "정상적으로 수정하였습니다.";

    if (!$page) $page = 1;
    $qstr = "page={$page}";

} else if ($_POST['act_button'] == "선택삭제") {

    auth_check_menu($auth, $sub_menu, 'd');
    $del_li_no = array();
    for ($i=0; $i<$post_count_chk; $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;
        $li_no = isset($_POST['li_no'][$k]) ? clean_xss_tags($_POST['li_no'][$k], 1, 1) : '';
        $del_li_no[$i] = $li_no; 
    }

    /**
     * EB최신글 아이템 설정 파일 삭제
     */
    $el_item_file = G5_DATA_PATH . '/eblatest/'.$post_theme.'/el_item_'.$el_code.'.php';
    @unlink($el_item_file);

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(li_no, '".implode(',', $del_li_no)."') and li_theme = '{$post_theme}' ";

    /**
     * EB최신글 아이템 레코드 삭제
     */
    $sql = "delete from {$g5['eyoom_latest_item']} where {$where} ";
    sql_query($sql);
    $msg = "선택한 EB최신글의 아이템을 삭제하였습니다.";
}

/**
 * qstr에 wmode추가
 */
$qstr .= $wmode ? '&amp;wmode=1': '';

alert($msg, G5_ADMIN_URL . "/?dir=theme&amp;pid=eblatest_form&amp;el_code={$el_code}&amp;w=u&amp;".$qstr);