<?php
/**
 * file : /eyoom/head.sub.php
 */
if (!defined('_EYOOM_')) exit;

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
 * 메타태그 설정
 */
$seo_meta_tag = '';
if ($seocfg['mt_verification']) {
    $seo_meta_tag .= htmlspecialchars_decode(stripslashes($seocfg['mt_verification']))."\n";
}

if ($seocfg['mt_title']) {
    $seo_meta_tag .= '<meta name="title" content="'.get_text($seocfg['mt_title']).'" />'."\n";
}

if ($seocfg['mt_keywords']) {
    $seo_meta_tag .= '<meta name="keywords" content="'.get_text($seocfg['mt_keywords']).'" />'."\n";
}

if ($seocfg['mt_description']) {
    $seo_meta_tag .= '<meta name="description" content="'.get_text($seocfg['mt_description']).'" />'."\n";
}

if ($seocfg['mt_robots']) {
    $seo_meta_tag .= '<meta name="robots" content="'.get_text($seocfg['mt_robots']).'" />'."\n";
}

if ($seocfg['mt_author']) {
    $seo_meta_tag .= '<meta name="author" content="'.get_text($seocfg['mt_author']).'" />'."\n";
}

if ($seocfg['mt_publisher']) {
    $seo_meta_tag .= '<meta name="publisher" content="'.get_text($seocfg['mt_publisher']).'" />'."\n";
}

/**
 * 기본 메타태그
 */
if (!$seo_meta_tag) {
    $seo_meta_tag .= '<meta name="title" content="'.get_text($config['cf_title']).'" />'."\n";
    $seo_meta_tag .= '<meta name="description" content="'.get_text($config['cf_title']).'" />'."\n";
}

/**
 * Open Graph 메타태그 적용
 */
if (!$msg) {
    $og_meta = $eb->sns_open_graph();
    $config['cf_add_meta'] = $seo_meta_tag.$og_meta.$config['cf_add_meta'];
    unset($og_meta);
}

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
@include_once(EYOOM_USER_PATH . '/head.sub.php');

/**
 * 이윰 테마파일 출력
 */
include_once(EYOOM_THEME_PATH . '/head.sub.html.php');