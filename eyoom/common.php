<?php
/**
 * core file : /eyoom/common.php
 */
define('_EYOOM_COMMON_', true);

/**
 * 이윰 설정파일 불러오기
 */
include_once(EYOOM_PATH . '/config.php');

/**
 * 기본설정 파일
 */
$eyoom_config_file = G5_DATA_PATH . '/eyoom.config.php';

/**
 * 설정파일이 있다면 이윰빌더가 설치된 상태임
 */
if (file_exists($eyoom_config_file) && !is_dir($eyoom_config_file)) {
    /**
     * 기본설정 파일 불러오기
     */
    include_once($eyoom_config_file);

    /**
     * 기본 설정
     */
    $eyoom_default = $eyoom;

    /**
     * 클래스 초기화
     */
    include_once(EYOOM_INC_PATH . '/class.init.php');

    /**
     * 테마 로딩 : 적용테마, 미리보기테마를 자동으로 구분하여 로딩
     */
    $loaded_theme = $thema->loading_theme();

    /**
     * 공사중으로 설정되어 있다면 공사중 페이지 출력
     */
    if (!$is_admin) $eb->under_construction();

    /**
     * 커뮤니티 테마
     */
    $theme = $loaded_theme['comm'];

    /**
     * 쇼핑몰 테마
     */
    $shop_theme = $loaded_theme['shop'];

    /**
     * 홈페이지 기업정보
     */
    $bizinfo = $thema->get_bizinfo();

    /**
     * 레벨 설정파일
     */
    include_once(G5_DATA_PATH . '/eyoom.levelset.php');

    /**
     * 레벨 정보파일
     */
    include_once(G5_DATA_PATH . '/eyoom.levelinfo.php');

    /**
     * 회원정보 확장
     */
    $eyoomer = array();

    /**
     * 회원이라면 추가 회원 정보 가져오기
     */
    if ($is_member) {
        /**
         * 추가 회원 정보
         */
        $eyoomer = $eb->get_user_info($member['mb_id']);

        /**
         * 읽지 않은 메모 및 관리권한 체크
         */
        $memo_not_read = $eb->check_memo_auth($member['mb_id']);

        /**
         * 내글 반응
         */
        $respond_not_read = $eyoomer['respond'];
    }

    /**
     * 게시판이라면 이윰게시판 설정정보 가져오기
     */
    if ($bo_table) {
        $eyoom_board = $bbs->board_info($bo_table, $theme);

        /**
         * 이윰게시판 설정정보
         */
        include_once(EYOOM_INC_PATH . '/board.init.php');
    }

    /**
     * 스킨 정의
     */
    if (!defined('_INDEX_')) {
        include(EYOOM_INC_PATH . '/skin.path.php');
    }

    /**
     * 라이브러리 함수
     */
    include_once(EYOOM_INC_PATH.'/lib.functions.php');

    /**
     * 일정 기간이 지난 DB 데이터 삭제 및 최적화
     */
    include_once(EYOOM_INC_PATH.'/db_table.optimize.php');

    /**
     * eyoom/common.php 파일을 수정할 필요가 없도록 확장
     */
    $extend_file = array();
    $tmp = @dir(EYOOM_EXTEND_PATH);
    if ($tmp) {
        while ($entry = $tmp->read()) {
            // php 파일만 include 함
            if (preg_match("/(\.php)$/i", $entry))
                $extend_file[] = $entry;
        }

        if(!empty($extend_file) && is_array($extend_file)) {
            natsort($extend_file);

            foreach($extend_file as $exfile) {
                include_once(EYOOM_EXTEND_PATH.'/'.$exfile);
            }
        }
        unset($extend_file);
    }

    /**
     * 특정 기능에 대해서 Eyoom로 파일후킹
     */
    $pathinfo = $eb->get_filename_from_url();
    if ($exchange_file = $eb->exchange_file($pathinfo)) {
        include_once(EYOOM_INC_PATH . '/html_process.php');

        /**
         * 치환파일 불러오기
         */
        include_once($exchange_file);
        exit;
    }

    /**
     * 쇼핑몰 파일 제어 - Eyoom Core Controller
     */
    if (defined('G5_USE_SHOP') && G5_USE_SHOP && defined('G5_SHOP_DIR') && $pathinfo['dirname'] == G5_SHOP_DIR) {
        /**
         * 쇼핑몰 초기화
         */
        include_once(EYOOM_INC_PATH.'/shop.init.php');
    }

} else {
    /**
     * 클래스 초기화
     */
    include_once(EYOOM_INC_PATH . '/class.init.php');

    /**
     * 캐쉬하지 않기
     */
    $eb->eyoom_no_cache();

    /**
     * 이윰빌더 설치하기
     */
    header('location:' . EYOOM_URL . '/install/setup.php');
    exit;
}