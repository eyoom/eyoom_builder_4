<?php
/**
 * @file    /adm/eyoom_admin/core/somoim/somo_form_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "350200";

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], 'w');

if ($is_admin != 'super' && $w == '') alert('최고관리자만 접근 가능합니다.');

check_admin_token();

if (!isset($sm_bo_table)) exit;

if (!preg_match("/^([A-Za-z0-9_]{1,15})$/", $_POST['sm_id']))
    alert('소모임 ID는 공백없이 영문자, 숫자, _ 만 사용 가능합니다. (15자 이내)');

if (!$sm_subject) alert('소모임 제목을 입력하세요.');

$sm_id = isset($_POST['sm_id']) ? strip_tags(clean_xss_tags($_POST['sm_id'])) : '';
$wr_id = clean_xss_tags(trim($_POST['wr_id']));
$sm_admin = clean_xss_tags(trim($_POST['mb_id']));
$sm_admin_old = clean_xss_tags(trim($_POST['sm_admin']));
$sm_category = clean_xss_tags(trim($_POST['sm_category']));
$sm_introduce = clean_xss_tags(trim($_POST['sm_introduce']));
$sm_open = clean_xss_tags(trim($_POST['sm_open']));

$sm_subject = '';
if (isset($_POST['sm_subject'])) {
    $sm_subject = substr(trim($_POST['sm_subject']),0,255);
    $sm_subject = preg_replace("#[\\\]+$#", "", $sm_subject);
}

if ($sm_id == $somo['sm_prepned']) {
    alert("소모임 ID를 정확하게 입력해 주세요.");
}

$sql_common = " sm_subject = '{$sm_subject}',
                wr_id  = '{$wr_id}',
                sm_admin  = '{$sm_admin}',
                sm_category  = '{$sm_category}',
                sm_introduce  = '{$sm_introduce}',
                sm_open  = '{$sm_open}'
                ";

if ($w == '') {    
    $sql = " select count(*) as cnt from {$g5['eyoom_somoim']} where sm_id = '{$sm_id}' ";
    $row = sql_fetch($sql);
    if ($row['cnt'])
        alert('이미 존재하는 소모임 ID 입니다.');

    /**
     * 소모임 최대값 가져오기
     */
    $sql = "select max(sm_ranking) as max from {$g5['eyoom_somoim']} where sm_open = 'y' ";
    $row = sql_fetch($sql);
    $sm_ranking = $row['max'] + 1;
    
    /**
     * 소모임 추가
     */
    $sql = " insert into {$g5['eyoom_somoim']} set sm_id = '{$sm_id}', {$sql_common}, sm_ranking='{$sm_ranking}', sm_prev_ranking='{$sm_ranking}', sm_regdt = '".G5_TIME_YMDHIS."' ";
    sql_query($sql);
    
    /**
     * 소모임 게시판 생성
     */
    $sm_chk = sql_fetch("selec count(*) as cnt from {$g5['board_table']} where bo_table = '{$sm_id}' ");
    
    if (!$sm_chk['cnt']) {
        include_once (EYOOM_ADMIN_PATH."/core/somoim/create_somoim.php");
        
        $write_table = $g5['write_prefix'] . $sm_bo_table;
        $sql = "update {$write_table} set wr_nogood = '1' where wr_id = '{$wr_id}' and wr_id = wr_parent ";
        sql_query($sql);
    }
    
    $msg = "소모임을 정상적으로 생성하였습니다.";

} else if ($w == "u") {

    $sql = " update {$g5['eyoom_somoim']} set {$sql_common} where sm_id = '{$sm_id}' ";
    sql_query($sql);
    
    // 소모임 관리자 변경
    if ($sm_admin != $sm_admin_old) {
        $sql = "update {$g5['board_table']} set bo_admin = '{$sm_admin}' where bo_table = '{$sm_id}' ";
        sql_query($sql);
    }
    $msg = "소모임 정보를 정상적으로 수정하였습니다.";

} else {
    alert('제대로 된 값이 넘어오지 않았습니다.');
}

if ($smc) $qstr .= "&amp;smc={$smc}";

alert($msg, G5_ADMIN_URL . '/?dir=somoim&amp;pid=somo_form&amp;w=u&amp;sm_id='.$sm_id.'&amp;'.$qstr);