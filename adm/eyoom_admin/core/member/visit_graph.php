<?php
/**
 * @file    /adm/eyoom_admin/core/member/visit_graph.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "200800";

auth_check_menu($auth, $sub_menu, 'r');

$fr_date = isset($_REQUEST['fr_date']) ? preg_replace('/[^0-9 :\-]/i', '', $_REQUEST['fr_date']) : G5_TIME_YMD;
$to_date = isset($_REQUEST['to_date']) ? preg_replace('/[^0-9 :\-]/i', '', $_REQUEST['to_date']) : G5_TIME_YMD;

/**
 * 탭메뉴 활성화 구분자
 */
$visit_mode = 'visit_graph';

include_once(EYOOM_ADMIN_CORE_PATH . '/member/visit.sub.php');

if (!($fr_date && $to_date)) {
    $to_date = G5_TIME_YMD;
    $fr_date = date('Y-m-d', strtotime('-100 days'));
}

$period_vi_info = get_visit_info($fr_date, $to_date);

/**
 * 시간별 방문자 및 회원가입
 */
for($i=0; $i<24; $i++) {
    // 방문자
    $period_vi_count[$i] = $period_vi_info['vi_cnt'][$i] ? count((array)$period_vi_info['vi_cnt'][$i]) : 0;
}

/**
 * 접속 브라우저
 */
$period_vi_browser = $period_vi_info['vi_br'];

/**
 * 접속 디바이스
 */
$period_vi_device = $period_vi_info['vi_dev'];

/**
 * 접속 OS
 */
$period_vi_os = $period_vi_info['vi_os'];

/**
 * 접속 도메인
 */
$period_vi_domain = $period_vi_info['vi_domain'];