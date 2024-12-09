<?php
/**
 * file : /eyoom/config.php
 */

/**
 * 이 상수가 정의되지 않으면 개별 페이지는 별도로 실행될 수 없음
 */
define('_EYOOM_', true);

/**
 * Gnuboard Site URL
 */
define('GNU_SITE', 'http://sir.kr');

/**
 * 암호화, 복호화용 key값 - 값을 자신의 원하는 것으로 변경하여 사용하세요.
 */
define('SALT_KEY', 'svjRGP7M2$F6!VzF=yzvJc5@77+uCy5G!5#F*dGM');

/**
 * 게시판 이윰 확장필드 prefix
 */
define('EYOOM_EXBOARD_PREFIX', 'ex_');

/**
 * 코어 경로 정의
 */
define('EYOOM_CORE_PATH', EYOOM_PATH . '/core');

/**
 * 모바일 코어 경로 정의
 */
define('EYOOM_CORE_MOBILE_PATH', EYOOM_PATH . '/mobile/core');

/**
 * 클래스 경로 정의
 */
define('EYOOM_CLASS_PATH', EYOOM_PATH . '/class');

/**
 * 인크루드 경로 정의
 */
define('EYOOM_INC_PATH', EYOOM_PATH . '/inc');

/**
 * 라이브러리 경로 정의
 */
define('EYOOM_LIB_PATH', EYOOM_PATH . '/lib');

/**
 * 기타 경로 정의
 */
define('EYOOM_MISC_PATH', EYOOM_PATH . '/misc');

/**
 * 설치 경로 정의
 */
define('EYOOM_INSTALL_PATH', EYOOM_PATH . '/install');

/**
 * 개발자 코드 경로 정의
 */
define('EYOOM_USER_PATH', EYOOM_PATH . '/user');

/**
 * 코어 URL
 */
define('EYOOM_CORE_URL', EYOOM_URL . '/core');

/**
 * 이윰빌더 확장하기 경로 정의
 */
define('EYOOM_EXTEND_PATH', EYOOM_PATH.'/extend');

/**
 * 이윰관리자 폴더명
 */
define('EYOOM_ADMIN_DIR', 'eyoom_admin');

/**
 * 이윰관리자 경로
 */
define('EYOOM_ADMIN_PATH', G5_ADMIN_PATH . '/' . EYOOM_ADMIN_DIR);

/**
 * 이윰관리자 URL
 */
define('EYOOM_ADMIN_URL', G5_ADMIN_URL . '/' . EYOOM_ADMIN_DIR);

/**
 * 이윰관리자 코어 경로
 */
define('EYOOM_ADMIN_CORE_PATH', EYOOM_ADMIN_PATH . '/core');

/**
 * 이윰관리자 코어 URL
 */
define('EYOOM_ADMIN_CORE_URL', EYOOM_ADMIN_URL . '/core');

/**
 * 이윰관리자 인크루드 경로
 */
define('EYOOM_ADMIN_INC_PATH', EYOOM_ADMIN_PATH . '/inc');

/**
 * 이윰관리자 라이브러리 경로
 */
define('EYOOM_ADMIN_LIB_PATH', EYOOM_ADMIN_PATH . '/lib');

/**
 * 이윰관리자 개발자 코드
 */
define('EYOOM_ADMIN_USER_PATH', EYOOM_ADMIN_PATH . '/user');

/**
 * 쇼핑몰 관련 상수 정의
 */
if (defined('G5_USE_SHOP') && G5_USE_SHOP) {
    /**
     * 쇼핑몰 경로정의
     */
    define('EYOOM_SHOP_PATH', EYOOM_PATH . '/' . G5_SHOP_DIR);

    /**
     * 쇼핑몰 사용자 경로 정의
     */
    define('EYOOM_USER_SHOP_PATH', EYOOM_USER_PATH . '/' . G5_SHOP_DIR);

    /**
     * 쇼핑몰 URL
     */
    define('EYOOM_SHOP_URL', EYOOM_URL . '/' . G5_SHOP_DIR);
}


/**
 * Eyoom DB tables
 */

/**
 * 회원 확장 기능
 */
$g5['eyoom_member'] = G5_TABLE_PREFIX . 'eyoom_member';

/**
 * 다중관리자 설정 기능
 */
$g5['eyoom_manager'] = G5_TABLE_PREFIX . 'eyoom_manager';

/**
 * 활동내역
 */
$g5['eyoom_activity'] = G5_TABLE_PREFIX . 'eyoom_activity';

/**
 * 보유테마 관리
 */
$g5['eyoom_theme'] = G5_TABLE_PREFIX . 'eyoom_theme';

/**
 * 게시판 확장 기능
 */
$g5['eyoom_board'] = G5_TABLE_PREFIX . 'eyoom_board';

/**
 * 이윰 메뉴 관리
 */
$g5['eyoom_menu'] = G5_TABLE_PREFIX . 'eyoom_menu';

/**
 * 내글반응
 */
$g5['eyoom_respond'] = G5_TABLE_PREFIX . 'eyoom_respond';

/**
 * 출석부
 */
$g5['eyoom_attendance'] = G5_TABLE_PREFIX . 'eyoom_attendance';

/**
 * 블라인드 기능
 */
$g5['eyoom_yellowcard'] = G5_TABLE_PREFIX . 'eyoom_yellowcard';

/**
 * 별점기능
 */
$g5['eyoom_rating'] = G5_TABLE_PREFIX . 'eyoom_rating';

/**
 * 게시물 태그 기능
 */
$g5['eyoom_tag'] = G5_TABLE_PREFIX . 'eyoom_tag';

/**
 * 태그 게시물 저장
 */
$g5['eyoom_tag_write'] = G5_TABLE_PREFIX . 'eyoom_tag_write';

/**
 * 팔로우 기능
 */
$g5['eyoom_follow'] = G5_TABLE_PREFIX . 'eyoom_follow';

/**
 * 좋아요 기능
 */
$g5['eyoom_like'] = G5_TABLE_PREFIX . 'eyoom_like';

/**
 * 구독하기 기능
 */
$g5['eyoom_subscribe'] = G5_TABLE_PREFIX . 'eyoom_subscribe';

/**
 * 핀 모아보기 기능
 */
$g5['eyoom_pin'] = G5_TABLE_PREFIX . 'eyoom_pin';

/**
 * 인기게시물 기능
 */
$g5['eyoom_best'] = G5_TABLE_PREFIX . 'eyoom_best';

/**
 * EB상품 마스터
 */
$g5['eyoom_goods'] = G5_TABLE_PREFIX . 'eyoom_goods';

/**
 * EB상품 마스터
 */
$g5['eyoom_goods_item'] = G5_TABLE_PREFIX . 'eyoom_goods_item';

/**
 * EB슬라이더 마스터
 */
$g5['eyoom_slider'] = G5_TABLE_PREFIX . 'eyoom_slider';

/**
 * EB슬라이더 아이템
 */
$g5['eyoom_slider_item'] = G5_TABLE_PREFIX . 'eyoom_slider_item';

/**
 * EB슬라이더 유튜브 영상
 */
$g5['eyoom_slider_ytitem'] = G5_TABLE_PREFIX . 'eyoom_slider_ytitem';

/**
 * EB컨텐츠 마스터
 */
$g5['eyoom_contents'] = G5_TABLE_PREFIX . 'eyoom_contents';

/**
 * EB컨텐츠 아이템
 */
$g5['eyoom_contents_item'] = G5_TABLE_PREFIX . 'eyoom_contents_item';

/**
 * EB최신글 마스터
 */
$g5['eyoom_latest'] = G5_TABLE_PREFIX . 'eyoom_latest';

/**
 * EB최신글 아이템
 */
$g5['eyoom_latest_item'] = G5_TABLE_PREFIX . 'eyoom_latest_item';

/**
 * EB배너 마스터
 */
$g5['eyoom_banner'] = G5_TABLE_PREFIX . 'eyoom_banner';

/**
 * EB배너 아이템
 */
$g5['eyoom_banner_item'] = G5_TABLE_PREFIX . 'eyoom_banner_item';

/**
 * EB배너 조회수
 */
$g5['eyoom_banner_hit'] = G5_TABLE_PREFIX . 'eyoom_banner_hit';

/**
 * EB배너 날짜별 노출/클릭수
 */
$g5['eyoom_banner_date'] = G5_TABLE_PREFIX . 'eyoom_banner_date';

/**
 * 이윰 게시판 확장필드 관리
 */
$g5['eyoom_exboard'] = G5_TABLE_PREFIX . 'eyoom_exboard';

/**
 * 이윰 브랜드 관리
 */
$g5['eyoom_brand'] = G5_TABLE_PREFIX . 'eyoom_brand';

/**
 * 이윰 상단고정 게시물 관리
 */
$g5['eyoom_wrfixed'] = G5_TABLE_PREFIX . 'eyoom_wrfixed';

/**
 * 포인트게시글 관리
 */
$g5['eyoom_pointpost'] = G5_TABLE_PREFIX . 'eyoom_pointpost';

/**
 * 회원메모 관리
 */
$g5['eyoom_mbmemo'] = G5_TABLE_PREFIX . 'eyoom_mbmemo';

/**
 * 관리자 즐겨찾기 메뉴 관리
 */
$g5['eyoom_favorite_adm'] = G5_TABLE_PREFIX . 'eyoom_favorite_adm';

/**
 * 고객 문의
 */
$g5['eyoom_counsel'] = G5_TABLE_PREFIX . 'eyoom_counsel';

/**
 * 투표 게시물
 */
$g5['eyoom_bbspoll'] = G5_TABLE_PREFIX . 'eyoom_bbspoll';

/**
 * 예약게시물 저장 테이블
 */
$g5['eyoom_scheduled'] = G5_TABLE_PREFIX . 'eyoom_scheduled';

/**
 * 윈도우모드 (window mode)
 */
$wmode = isset($_REQUEST['wmode']) && $_REQUEST['wmode'] ? 1: 0;

/**
 * 다중관리자 체크
 */
$eyoom_admin_theme = $config['cf_eyoom_admin_theme'] ? $config['cf_eyoom_admin_theme']: 'eba_basic';
if ($is_member && !$is_admin) {
    $manager = sql_fetch("select * from {$g5['eyoom_manager']} where mb_id = '{$member['mb_id']}' ");
    if ($manager['mb_id']) {
        $is_admin = 'super';
        $eyoom_admin_theme = $manager['mg_theme'];
    }
}

/**
 * 이윰관리자 테마 경로
 */
define('EYOOM_ADMIN_THEME_PATH', EYOOM_ADMIN_PATH . '/theme/' . $eyoom_admin_theme);

/**
 * 이윰관리자 테마 경로
 */
define('EYOOM_ADMIN_THEME_URL', EYOOM_ADMIN_URL . '/theme/' . $eyoom_admin_theme);