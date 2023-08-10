<?php
/**
 * @file    /adm/eyoom_admin/core/config/newwinformupdate.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = '100310';

$nw_id = isset($_REQUEST['nw_id']) ? (string)preg_replace('/[^0-9]/', '', $_REQUEST['nw_id']) : 0;

if ($w == "u" || $w == "d") {
    check_demo();
}

if ($w == 'd') {
    auth_check_menu($auth, $sub_menu, "d");
} else {
    auth_check_menu($auth, $sub_menu, "w");
}

check_admin_token();

$nw_subject = isset($_POST['nw_subject']) ? strip_tags(clean_xss_attributes($_POST['nw_subject'])) : '';
$posts = array();

$check_keys = array(
    'nw_device'=>'str',
    'nw_division'=>'str',
    'nw_begin_time'=>'time',
    'nw_end_time'=>'time',
    'nw_disable_hours'=>'int',
    'nw_left'=>'int',
    'nw_top'=>'int',
    'nw_height'=>'int',
    'nw_width'=>'int',
    'nw_content'=>'text',
    'nw_content_html'=>'text',
);

foreach($check_keys as $key=>$val){
    if($val === 'int'){
        $posts[$key] = isset($_POST[$key]) ? (int) $_POST[$key] : 0;
    } else if ($val === 'str') {
        $posts[$key] = isset($_POST[$key]) ? clean_xss_tags($_POST[$key], 1, 1) : 0;
    } else if ($val === 'time') {
        $posts[$key] = isset($_POST[$key]) ? date('Y-m-d H:i:s', strtotime($_POST[$key])) : 0;
    } else {
        $posts[$key] = isset($_POST[$key]) ? trim($_POST[$key]) : 0;
    }
}

$sql_common = " nw_device = '{$posts['nw_device']}',
                nw_division = '{$posts['nw_division']}',
                nw_begin_time = '{$posts['nw_begin_time']}',
                nw_end_time = '{$posts['nw_end_time']}',
                nw_disable_hours = '{$posts['nw_disable_hours']}',
                nw_left = '{$posts['nw_left']}',
                nw_top = '{$posts['nw_top']}',
                nw_height = '{$posts['nw_height']}',
                nw_width = '{$posts['nw_width']}',
                nw_subject = '{$nw_subject}',
                nw_content = '{$posts['nw_content']}',
                nw_content_html = '{$posts['nw_content_html']}' ";

if ($w == "") {
    $sql = " insert {$g5['new_win_table']} set $sql_common ";
    sql_query($sql);

    $nw_id = sql_insert_id();
    run_event('admin_newwin_created', $nw_id);
} elseif ($w == "u") {
    $sql = " update {$g5['new_win_table']} set $sql_common where nw_id = '$nw_id' ";
    sql_query($sql);
    run_event('admin_newwin_updated', $nw_id);
} elseif ($w == "d") {
    $sql = " delete from {$g5['new_win_table']} where nw_id = '$nw_id' ";
    sql_query($sql);
    run_event('admin_newwin_deleted', $nw_id);
}

$qstr .= $device ? '&amp;device='.$device: '';
$qstr .= $sdt ? '&amp;sdt='.$sdt: '';
$qstr .= $fr_date ? '&amp;fr_date='.$fr_date: '';
$qstr .= $to_date ? '&amp;to_date='.$to_date: '';

if ($w == "d") {
    alert("해당 팝업정보를 삭제하였습니다.", G5_ADMIN_URL . "/?dir=config&pid=newwinlist");
} else {
    alert("팝업정보를 업데이트하였습니다.", G5_ADMIN_URL . "/?dir=config&pid=newwinform&w=u&amp;{$qstr}&nw_id={$nw_id}");
}