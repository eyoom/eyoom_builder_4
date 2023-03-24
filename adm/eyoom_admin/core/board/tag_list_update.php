<?php
/**
 * @file    /adm/eyoom_admin/core/board/tag_list_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300710";

check_admin_token();

check_demo();

$post_count_chk = (isset($_POST['chk']) && is_array($_POST['chk'])) ? count($_POST['chk']) : 0;
$chk = (isset($_POST['chk']) && is_array($_POST['chk'])) ? $_POST['chk'] : array();
$act_button = isset($_POST['act_button']) ? strip_tags($_POST['act_button']) : '';

if (! $post_count_chk && $act_button != '태그추가') {
    alert($act_button." 하실 항목을 하나 이상 체크하세요.");
}

if ($act_button == "선택수정") {

    auth_check_menu($auth, $sub_menu, 'w');

    for ($i=0; $i<$post_count_chk; $i++) {

        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;
        $tg_word = isset($_POST['tg_word'][$k]) ? clean_xss_tags($_POST['tg_word'][$k]): '';
        $tg_regcnt = isset($_POST['tg_regcnt'][$k]) ? clean_xss_tags($_POST['tg_regcnt'][$k]): '';
        $tg_scnt = isset($_POST['tg_scnt'][$k]) ? clean_xss_tags($_POST['tg_scnt'][$k]): '';
        $tg_score = isset($_POST['tg_score'][$k]) ? clean_xss_tags($_POST['tg_score'][$k]): '';
        $tg_id = isset($_POST['tg_id'][$k]) ? clean_xss_tags($_POST['tg_id'][$k]): '';

        $sql = " update {$g5['eyoom_tag']}
                    set tg_word = '{$tg_word}',
                        tg_regcnt = '{$tg_regcnt}',
                        tg_scnt = '{$tg_scnt}',
                        tg_score = '{$tg_score}'
                 where tg_id = '{$tg_id}' ";
        sql_query($sql);
    }
    $msg = "정상적으로 수정하였습니다.";

} else if ($act_button == "선택삭제") {

    auth_check_menu($auth, $sub_menu, 'd');
    $del_tg_id = array();
    for ($i=0; $i<$post_count_chk; $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;
        $tg_id = isset($_POST['tg_id'][$k]) ? clean_xss_tags($_POST['tg_id'][$k]): '';
        $del_tg_id[$i] = $tg_id;
    }

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(tg_id, '".implode(',', $del_tg_id)."') ";

    /**
     * 배너/광고 테이블 레코드 삭제
     */
    $sql = "delete from {$g5['eyoom_tag']} where {$where} ";
    sql_query($sql);

    $msg = "선택한 태그를 삭제하였습니다.";

} else if ($act_button == '태그추가') {

    auth_check_menu($auth, $sub_menu, 'w');

    $tg_new_word = isset($_POST['tg_new_word']) && $_POST['tg_new_word'] ? clean_xss_tags(trim($_POST['tg_new_word'])) : '';

    $cnt = sql_fetch(" select count(tg_id) as cnt from {$g5['eyoom_tag']} where tg_word='{$tg_new_word}' ");

    if(!$cnt['cnt']) {
        $sql = " insert into {$g5['eyoom_tag']} set tg_word='{$tg_new_word}', tg_regcnt='0', tg_regdt = '".G5_TIME_YMDHIS."' ";
        sql_query($sql, false);

        $msg = "정상적으로 태그를 추가하였습니다.";
    } else {
        alert('이미 등록된 태그입니다.');
    }
}

alert($msg, G5_ADMIN_URL . '/?dir=board&amp;pid=tag_list&amp;'.$qstr);