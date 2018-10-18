<?php
/**
 * @file    /adm/eyoom_admin/core/theme/tag_list_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999700";

check_admin_token();

if (!count($_POST['chk']) && $_POST['act_button'] != "태그추가") {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

if ($_POST['act_button'] == "선택수정") {

    auth_check($auth[$sub_menu], 'w');

    for ($i=0; $i<count($_POST['chk']); $i++) {

        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $sql = " update {$g5['eyoom_tag']}
                    set tg_word = '{$_POST['tg_word'][$k]}',
                        tg_regcnt = '{$_POST['tg_regcnt'][$k]}',
                        tg_scnt = '{$_POST['tg_scnt'][$k]}',
                        tg_score = '{$_POST['tg_score'][$k]}'
                 where tg_id = '{$_POST['tg_id'][$k]}' and tg_theme = '{$_POST['theme']}' ";
        sql_query($sql);
    }
    $msg = "정상적으로 수정하였습니다.";

} else if ($_POST['act_button'] == "선택삭제") {

    auth_check($auth[$sub_menu], 'd');

    for ($i=0; $i<count($_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];
        $del_tg_id[$i] = $_POST['tg_id'][$k];
    }

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(tg_id, '".implode(',', $del_tg_id)."') and tg_theme = '{$_POST['theme']}' ";

    /**
     * 배너/광고 테이블 레코드 삭제
     */
    $sql = "delete from {$g5['eyoom_tag']} where {$where} ";
    sql_query($sql);

    $msg = "선택한 태그를 삭제하였습니다.";

} else if ($_POST['act_button'] == '태그복사') {

    auth_check($auth[$sub_menu], 'w');

    $target = clean_xss_tags(trim($_POST['target_theme']));
    if (!$target) alert('태그를 복사할 테마를 선택해 주세요.');

    for ($i=0; $i<count($_POST['chk']); $i++) {

        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];
        $set = "
            tg_word     = '{$_POST['tg_word'][$k]}',
            tg_regcnt   = '{$_POST['tg_regcnt'][$k]}',
            tg_scnt     = '{$_POST['tg_scnt'][$k]}',
            tg_score    = '{$_POST['tg_score'][$k]}'
        ";

        $where = " tg_word = '{$_POST['tg_word'][$k]}' and tg_theme = '{$target}' ";
        $chk_sql = "select * from {$g5['eyoom_tag']} where {$where} ";
        $info = sql_fetch($chk_sql);

        unset($sql, $add_set);
        if ($info['tg_id']) {
            $sql = "update {$g5['eyoom_tag']} set {$set} where tg_id = '{$info['tg_id']}' ";
        } else {
            $add_set = "
                tg_theme    = '{$target}',
                tg_dpmenu   = '{$_POST['tg_dpmenu'][$k]}',
                tg_recommdt = '{$_POST['tg_recommdt'][$k]}',
                tg_regdt    = '{$_POST['tg_regdt'][$k]}'
            ";
            $sql = "insert into {$g5['eyoom_tag']} set {$set}, {$add_set} ";
        }
        sql_query($sql);
    }

    $msg = "선택한 태그를 [{$target}] 테마에 복사하였습니다.";

} else if ($_POST['act_button'] == '태그추가') {

    auth_check($auth[$sub_menu], 'w');

    $cnt = sql_fetch(" select count(tg_id) as cnt from {$g5['eyoom_tag']} where tg_word='{$tg_new_word}' and tg_theme='{$_POST['theme']}' ");

    if(!$cnt['cnt']) {
        $sql = " insert into {$g5['eyoom_tag']} set tg_word='{$tg_new_word}', tg_theme='{$_POST['theme']}', tg_regcnt='0', tg_regdt = '".G5_TIME_YMDHIS."' ";
        sql_query($sql, false);

        $msg = "정상적으로 태그를 추가하였습니다.";
    } else {
        alert('이미 등록된 태그입니다.');
    }
}

alert($msg, G5_ADMIN_URL . '/?dir=theme&amp;pid=tag_list&amp;'.$qstr);