<?php
/**
 * @file    /adm/eyoom_admin/core/board/board_exform_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300100";

if ($w == 'u')
    check_demo();

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();

$bo_ex_cnt = clean_xss_tags(trim($_POST['bo_ex_cnt']));
$ex_no = clean_xss_tags(trim($_POST['ex_no']));
$ex_fname = clean_xss_tags(trim($_POST['ex_fname']));
$ex_subject = clean_xss_tags(trim($_POST['ex_subject']));
$ex_use_search = clean_xss_tags(trim($_POST['ex_use_search']));
$ex_form = clean_xss_tags(trim($_POST['ex_form']));
$ex_form_old = clean_xss_tags(trim($_POST['ex_form_old']));
$ex_required = clean_xss_tags(trim($_POST['ex_required']));
$ex_type = clean_xss_tags(trim($_POST['ex_type']));
$ex_type_old = clean_xss_tags(trim($_POST['ex_type_old']));
$ex_length = clean_xss_tags(trim($_POST['ex_length']));
$ex_length_old = clean_xss_tags(trim($_POST['ex_length_old']));
$ex_default = clean_xss_tags(trim($_POST['ex_default']));
$ex_item_value = clean_xss_tags(trim($_POST['ex_item_value']));

if ($bo_ex_cnt != $board['bo_ex_cnt']) {
    alert("잘못된 접근입니다.");
} else {
    $write_table = $g5['write_prefix'] . $board['bo_table'];
}

$add_set = "";
$_default = "";
if (!$ex_length) $ex_length = 255;
if ($ex_default != null) $_default = " default '".$ex_default."' ";

if ($w == '') {
    // 필드 입력값
    $set_info = "
        bo_table = '{$board['bo_table']}',
        ex_fname = '{$ex_fname}',
        ex_subject = '{$ex_subject}',
        ex_use_search = '{$ex_use_search}',
        ex_form = '{$ex_form}',
        ex_required = '{$ex_required}',
        ex_type = '{$ex_type}',
        ex_length = '{$ex_length}',
        ex_default = '{$ex_default}',
        ex_item_value = '{$ex_item_value}'
    ";

    // 확장필드 관리 레코드 추가
    $sql = " insert into {$g5['eyoom_exboard']} set {$set_info}";
    sql_query($sql, true);

    // $write_table의 마지막 컬럼에 확장필드 추가
    if ($ex_type) {
        switch($ex_type) {
            case 'varchar': $add_set = "varchar({$ex_length}) not null {$_default} "; break;
            case 'char': $add_set = "char({$ex_length}) not null {$_default} "; break;
            case 'int': $add_set = "int({$ex_length}) not null {$_default} "; break;
            case 'text': $add_set = "text not null"; break;
        }
    } else if ($ex_form == 'address' || $ex_form == 'textarea') {
        $add_set = "text not null";
    }
    $sql = " alter table `{$write_table}` add `{$ex_fname}` {$add_set} ";
    sql_query($sql, true);

    // 최종 확장필드 갯수
    $sql = "SHOW COLUMNS FROM {$write_table} LIKE 'ex_%'";
    $res = sql_query($sql);
    $ex = array();
    for($i=0; $row=sql_fetch_array($res); $i++) {
        $ex[$i] = $row['Field'];
    }
    $bo_ex_cnt = count($ex);

    // 확장필드 카운트수 증가
    sql_query("update {$g5['board_table']} set bo_ex_cnt = '{$bo_ex_cnt}' where bo_table = '{$board['bo_table']}' ");

    $msg = "확장필드를 정상적으로 추가하였습니다.";

} else if ($w == 'u') {
    $alter_yn = false;

    if ($ex_form != $ex_form_old) {
        $alter_yn = true;
        $set_form = ", ex_form = '{$ex_form}' ";
        switch ($ex_form) {
            case 'text': $ex_item_value = ''; break;
            case 'textarea':
            case 'address':
                $ex_length = '';
                $ex_default = '';
                $ex_item_value = '';
                $ex_type = 'text';
                break;
        }
    }

    if ($ex_type != $ex_type_old) {
        $alter_yn = true;
        $set_type = ", ex_type = '{$ex_type}' ";
    }

    if ($ex_length != $ex_length_old) {
        $alter_yn = true;
        $set_length = ", ex_length = '{$ex_length}' ";
    }

    if ($ex_default != $ex_default_old) {
        $alter_yn = true;
        $set_default = ", ex_default = '{$ex_default}' ";
    }

    /**
     * 필드 입력값
     */
    $set_info = "
        bo_table = '{$board['bo_table']}',
        ex_fname = '{$ex_fname}',
        ex_subject = '{$ex_subject}',
        ex_use_search = '{$ex_use_search}',
        ex_required = '{$ex_required}',
        ex_item_value = '{$ex_item_value}'
        {$set_form}
        {$set_type}
        {$set_length}
        {$set_default}
    ";

    /**
     * 확장필드 관리 레코드 정보 업데이트
     */
    $sql = " update {$g5['eyoom_exboard']} set {$set_info} where ex_no = '{$ex_no}' and bo_table = '{$board['bo_table']}' ";
    sql_query($sql, true);

    if ($alter_yn) {
        // $write_table의 마지막 컬럼에 확장필드 추가
        if ($ex_type) {
            switch($ex_type) {
                case 'varchar': $change_set = "varchar({$ex_length}) not null {$_default} "; break;
                case 'char': $change_set = "char({$ex_length}) not null {$_default} "; break;
                case 'int': $change_set = "int({$ex_length}) not null {$_default} "; break;
                case 'text': $change_set = "text not null"; break;
            }
        }
        if ($ex_form == 'address' || $ex_form == 'textarea') {
            $change_set = "text not null";
        }
        $sql = " alter table `{$write_table}` change `{$ex_fname}` `{$ex_fname}` {$change_set} ";
        sql_query($sql, true);
    }

    $msg = "확장필드를 정상적으로 수정하였습니다.";
}

if ($iw == '') {
    echo "
        <script>alert('{$msg}');window.parent.closeModal();</script>
    ";
}