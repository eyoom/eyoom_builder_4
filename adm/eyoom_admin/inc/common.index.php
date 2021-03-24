<?php
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 현재 접속자 정보
 */
$current = eb_connect($skin, false);

/**
 * 방문자 통계
 */
$visit = eb_visit($skin, false);

/**
 * 회원랭킹 정보
 */
$ranking = eb_ranking($skin, 10, false);

/**
 * 하루 일자 지정
 */
$yesterday = date('Y-m-d', strtotime('-1day'));
$today = date('Y-m-d');

/**
 * 하루 방문자 통계
 */
$this_vi_info = get_visit_info($today);

/**
 * 시간별 방문자 및 회원가입
 */
for($i=0; $i<24; $i++) {
    // 방문자
    $this_vi_count[$i] = $this_vi_info['vi_cnt'][$i] ? count((array)$this_vi_info['vi_cnt'][$i]) : 0;

    // 회원가입
    $this_vi_regist[$i] = $this_vi_info['vi_regist'][$i] ? count((array)$this_vi_info['vi_regist'][$i]) : 0;
}

/**
 * 접속 브라우저
 */
$this_vi_browser = $this_vi_info['vi_br'];

/**
 * 접속 디바이스
 */
$this_vi_device = $this_vi_info['vi_dev'];

/**
 * 접속 OS
 */
$this_vi_os = $this_vi_info['vi_os'];

/**
 * 접속 도메인
 */
$this_vi_domain = $this_vi_info['vi_domain'];