<?php
include_once("./_common.php");

/**
 * Banner Item $_GET Query
 */
$biq = clean_xss_tags(trim($_GET['biq']));
$bi_query = $eb->decrypt_md5($biq, SALT_KEY);

/**
 * 복호화하여 변수 할당
 */
list($bn_code, $bi_no, $ip, $bi_link) = explode('|', $bi_query);

/**
 * 유효성 체크
 */
$bi_no = intval($bi_no);
if(!$bn_code || !$bi_no || !is_int($bi_no) || !$bi_link) { 
    alert('잘못된 접근입니다.', G5_URL);
    exit; 
}

/**
 * 아이피 체크
 */
if ($ip != $_SERVER['REMOTE_ADDR']) {
    alert('잘못된 접근입니다.', G5_URL);
    exit; 
}

/**
 * 클릭시 통계데이터 수집
 */
$ss_banner_item_name = 'ss_bi_name_'.$bi_no;
if (!get_session($ss_banner_item_name)) {
    set_session($ss_banner_item_name, true);

    /**
     * 배너 클릭수 증가
     */
    $sql = "update {$g5['eyoom_banner_item']} set bi_clicked=bi_clicked+1 where bi_no='{$bi_no}' and bn_code='{$bn_code}'";
	sql_query($sql, false);

    /**
     * 클릭 데이터 저장
     */
    $referer = "";
    if (isset($_SERVER['HTTP_REFERER']))
        $referer = escape_trim(clean_xss_tags(strip_tags($_SERVER['HTTP_REFERER'])));
    $user_agent = '';
    if (isset($_SERVER['HTTP_USER_AGENT']))
        $user_agent  = escape_trim(clean_xss_tags(strip_tags($_SERVER['HTTP_USER_AGENT'])));

    $hit_set = "
        bn_code = '{$bn_code}',
        bi_no = '{$bi_no}',
        bh_ip = '{$ip}',
        bh_date = '".G5_TIME_YMD."',
        bh_time = '".G5_TIME_HIS."',
        bh_referer = '{$referer}',
        bh_agent = '{$user_agent}'
    ";
    $sql = "insert into {$g5['eyoom_banner_hit']} set {$hit_set}";
    sql_query($sql, false);

    /**
     * 날짜별 클릭수
     */
    $bs = sql_fetch("select * from {$g5['eyoom_banner_date']} where bs_date='".G5_TIME_YMD."' ");
    if (!$bs['bs_date']) {
        $sql = "insert into {$g5['eyoom_banner_date']} set bs_date = '".G5_TIME_YMD."' ";
        $result = sql_query($sql, FALSE);
        $bs_clicked = array();
    } else {
        $bs_clicked = unserialize($bs['bs_clicked']);
    }
    $bs_clicked[$bi_no]++;

    /**
     * 클릭수 날짜별 업데이트
     */
    if (is_array($bs_clicked)) {
        $_bs_clicked = serialize($bs_clicked);
        $sql = "update {$g5['eyoom_banner_date']} set bs_clicked = '{$_bs_clicked}' where bs_date = '".G5_TIME_YMD."'";
        sql_query($sql);
    }
}

header("location:".$bi_link);