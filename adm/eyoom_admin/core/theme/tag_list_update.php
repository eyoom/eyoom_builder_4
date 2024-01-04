<?php
/**
 * @file    /adm/eyoom_admin/core/theme/tag_list_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999700";

check_admin_token();

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
        $tg_word = isset($_POST['tg_word'][$k]) && is_array($_POST['tg_word']) ? clean_xss_tags($_POST['tg_word'][$k]): '';
        $tg_regcnt = isset($_POST['tg_regcnt'][$k]) ? (int) clean_xss_tags($_POST['tg_regcnt'][$k]): '';
        $tg_scnt = isset($_POST['tg_scnt'][$k]) ? (int) clean_xss_tags($_POST['tg_scnt'][$k]): '';
        $tg_score = isset($_POST['tg_score'][$k]) ? (int) clean_xss_tags($_POST['tg_score'][$k]): '';
        $tg_id = isset($_POST['tg_id'][$k]) ? (int) clean_xss_tags($_POST['tg_id'][$k]): '';

        $sql = " update {$g5['eyoom_tag']}
                    set tg_word = '{$tg_word}',
                        tg_regcnt = '{$tg_regcnt}',
                        tg_scnt = '{$tg_scnt}',
                        tg_score = '{$tg_score}'
                 where tg_id = '{$tg_id}' and tg_theme = '{$post_theme}' ";
        sql_query($sql);
    }
    $msg = "정상적으로 수정하였습니다.";

} else if ($act_button == "선택삭제") {

    auth_check_menu($auth, $sub_menu, 'd');
    $del_tg_id = array();
    for ($i=0; $i<$post_count_chk; $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;
        $tg_id = isset($_POST['tg_id'][$k]) ? (int) clean_xss_tags($_POST['tg_id'][$k]): '';
        $del_tg_id[$i] = $tg_id;
    }

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(tg_id, '".implode(',', $del_tg_id)."') and tg_theme = '{$post_theme}' ";

    /**
     * 배너/광고 테이블 레코드 삭제
     */
    $sql = "delete from {$g5['eyoom_tag']} where {$where} ";
    sql_query($sql);

    $msg = "선택한 태그를 삭제하였습니다.";

} else if ($act_button == '태그복사') {

    auth_check_menu($auth, $sub_menu, 'w');

    $target = isset($_POST['target_theme']) ? clean_xss_tags(trim($_POST['target_theme'])): '';
    if (!$target) alert('태그를 복사할 테마를 선택해 주세요.');

    for ($i=0; $i<$post_count_chk; $i++) {

        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;
        $tg_word = isset($_POST['tg_word'][$k]) ? clean_xss_tags($_POST['tg_word'][$k]): '';
        $tg_regcnt = isset($_POST['tg_regcnt'][$k]) ? clean_xss_tags($_POST['tg_regcnt'][$k]): '';
        $tg_scnt = isset($_POST['tg_scnt'][$k]) ? clean_xss_tags($_POST['tg_scnt'][$k]): '';
        $tg_score = isset($_POST['tg_score'][$k]) ? clean_xss_tags($_POST['tg_score'][$k]): '';
        $tg_dpmenu = isset($_POST['tg_dpmenu'][$k]) ? clean_xss_tags($_POST['tg_dpmenu'][$k]): '';
        $tg_recommdt = isset($_POST['tg_recommdt'][$k]) ? clean_xss_tags($_POST['tg_recommdt'][$k]): '';
        $tg_regdt = isset($_POST['tg_regdt'][$k]) ? clean_xss_tags($_POST['tg_regdt'][$k]): '';

        $set = "
            tg_word     = '{$tg_word}',
            tg_regcnt   = '{$tg_regcnt}',
            tg_scnt     = '{$tg_scnt}',
            tg_score    = '{$tg_score}'
        ";

        $where = " tg_word = '{$tg_word}' and tg_theme = '{$target}' ";
        $chk_sql = "select * from {$g5['eyoom_tag']} where {$where} ";
        $info = sql_fetch($chk_sql);

        unset($sql, $add_set);
        if ($info['tg_id']) {
            $sql = "update {$g5['eyoom_tag']} set {$set} where tg_id = '{$info['tg_id']}' ";
        } else {
            $add_set = "
                tg_theme    = '{$target}',
                tg_dpmenu   = '{$tg_dpmenu}',
                tg_recommdt = '{$tg_recommdt}',
                tg_regdt    = '{$tg_regdt}'
            ";
            $sql = "insert into {$g5['eyoom_tag']} set {$set}, {$add_set} ";
        }
        sql_query($sql);
    }

    $msg = "선택한 태그를 [{$target}] 테마에 복사하였습니다.";

} else if ($act_button == '태그추가') {

    auth_check_menu($auth, $sub_menu, 'w');

    $tg_new_word = isset($_POST['tg_new_word']) && $_POST['tg_new_word'] ? clean_xss_tags(trim($_POST['tg_new_word'])) : '';

    $cnt = sql_fetch(" select count(tg_id) as cnt from {$g5['eyoom_tag']} where tg_word='{$tg_new_word}' and tg_theme='{$post_theme}' ");

    if(!$cnt['cnt']) {
        $sql = " insert into {$g5['eyoom_tag']} set tg_word='{$tg_new_word}', tg_theme='{$post_theme}', tg_regcnt='0', tg_regdt = '".G5_TIME_YMDHIS."' ";
        sql_query($sql, false);

        $msg = "정상적으로 태그를 추가하였습니다.";
    } else {
        alert('이미 등록된 태그입니다.');
    }
}

alert($msg, G5_ADMIN_URL . '/?dir=theme&amp;pid=tag_list&amp;'.$qstr);