<?php
/**
 * @file    index.php
 */
if (!defined('G5_IS_ADMIN')) exit;

/**
 * 그누관리자 모드로 활성화되어 있는지 체크
 */
if ($config['cf_eyoom_admin'] == 'n' || $use_eyoom_builder === false) return;

/**
 * 이윰관리자모드 정의
 */
define('_EYOOM_IS_ADMIN_', true);

/**
 * 관리자 메인인지 체크
 */
if (!$pid) {
    define('IS_ADMIN_INDEX', true);
}

/**
 * 중요 라이브러리 파일
 */
@include_once(EYOOM_ADMIN_PATH.'/admin.common.php');

/**
 * 관리자모드 헤더 디자인 출력
 */
@include_once(EYOOM_ADMIN_PATH.'/admin.head.php');

/**
 * check pid
 */
if ($pid) {
    /**
     * 관리자모드 서브페이지
     */
    include_once(EYOOM_ADMIN_INC_PATH.'/admin.sub.php');
} else {
    /**
     * 관리자모드 메인 인덱스 페이지
     */
    include_once(EYOOM_ADMIN_INC_PATH . "/admin.index.php");
}

/**
 * 관리자모드 테일 디자인 출력
 */
@include_once(EYOOM_ADMIN_PATH.'/admin.tail.php');
exit;