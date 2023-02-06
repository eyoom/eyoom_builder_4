<?php
/**
 * @file    head.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit; // 개별 페이지 접근 불가

/**
 * 페이지 로딩 시작 시간
 */
$g5_debug['php']['begin_time'] = $begin_time = get_microtime();

/**
 * 타이틀 정의 - 상태바에 표시될 제목
 */
if (!isset($g5['title'])) {
    $g5['title'] = $config['cf_title'];
    $g5_head_title = $g5['title'];
}
else {
    // 상태바에 표시될 제목
    $g5_head_title = implode(' - ', array_filter(array($g5['title'], $config['cf_title'])));
}

$g5['title'] = strip_tags($g5['title']);
$g5_head_title = strip_tags($g5_head_title);

/**
 * 현재 접속자
 * 게시판 제목에 ' 포함되면 오류 발생
 */
$g5['lo_location'] = addslashes($g5['title']);
if (!$g5['lo_location']) $g5['lo_location'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));

$g5['lo_url'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
if (strstr($g5['lo_url'], '/'.G5_ADMIN_DIR.'/') || $is_admin == 'super') $g5['lo_url'] = '';

/**
 * CSS URL
 */
$shop_css = '';
if (defined('_SHOP_')) $shop_css = '_shop';
$css_href = run_replace('head_css_url', G5_CSS_URL.'/'.(G5_IS_MOBILE?'mobile':'default').$shop_css.'.css?ver='.G5_CSS_VER, G5_URL);

/**
 * body 태그 추가 스크립트
 */
$body_script = isset($g5['body_script']) ? $g5['body_script'] : '';

/**
 * 회원이라면 로그인 중이라는 메세지를 출력해준다.
 */
if ($is_member) {
    $sr_admin_msg = '';
    if ($is_admin == 'super') $sr_admin_msg = "최고관리자 ";
    else if ($is_admin == 'group') $sr_admin_msg = "그룹관리자 ";
    else if ($is_admin == 'board') $sr_admin_msg = "게시판관리자 ";
}

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_ADMIN_USER_PATH . '/head.sub.php');

/**
 * 이윰 테마파일 출력
 */
include_once(EYOOM_ADMIN_THEME_PATH . '/head.sub.html.php');