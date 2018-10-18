<?php
/**
 * @file    /adm/eyoom_admin/core/theme/eblatest_itemlist_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999620";

check_demo();

if (!count($_POST['chk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

if ($_POST['act_button'] == "선택수정") {

    auth_check($auth[$sub_menu], 'w');

    /**
     * 설정된 정보를 기준으로 최신글 파일 생성 - 캐쉬 기능
     */
    $latest->save_item($_POST['el_code'], $_POST['theme']);

    for ($i=0; $i<count($_POST['chk']); $i++) {

        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $sql = " update {$g5['eyoom_latest_item']}
                    set li_sort = '{$_POST['li_sort'][$k]}',
                        li_state = '{$_POST['li_state'][$k]}',
                        li_view_level = '{$_POST['li_view_level'][$k]}'
                 where li_no = '{$_POST['li_no'][$k]}' and li_theme = '{$_POST['theme']}' ";
        sql_query($sql);

        /**
         * EB최신글 master 파일 경로
         */
        $master_file = $eblatest_path.'/'.$_POST['theme'].'/el_master_'.$_POST['el_code'].'.php';

        /**
         * g5_eyoom_latest 테이블에서 정보 추출
         */
        $el_master = $latest->get_master($_POST['el_code']);

        /**
         * 파일 캐시
         */
        $qfile->save_file('el_master', $master_file, $el_master);

        /**
         * 설정된 정보를 기준으로 최신글 파일 생성 - 캐쉬 기능
         */
        $latest->save_item($_POST['el_code'], $_POST['theme']);

        /**
         * 최신글 레코드 파일 생성
         */
        $latest->make_cache_data($_POST['el_code'], $_POST['theme'], $_POST['li_no'][$k]);
    }

    $msg = "정상적으로 수정하였습니다.";

    if (!$page) $page = 1;
    $qstr = "page={$page}";

} else if ($_POST['act_button'] == "선택삭제") {

    auth_check($auth[$sub_menu], 'd');

    for ($i=0; $i<count($_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];
        $del_li_no[$i] = $_POST['li_no'][$k];
    }

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(li_no, '".implode(',', $del_li_no)."') and li_theme = '{$_POST['theme']}' ";

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

alert($msg, G5_ADMIN_URL . "/?dir=theme&amp;pid=eblatest_form&amp;el_code={$_POST['el_code']}&amp;w=u&amp;".$qstr);