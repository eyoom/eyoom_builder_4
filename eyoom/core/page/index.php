<?php
/**
 * core file : /eyoom/core/page/index.php
 */
if (!defined('_EYOOM_')) exit;

if(!$pid) alert('잘못된 접근입니다.');

$_pid = clean_xss_tags(trim($pid));
$pid = str_replace('|','/',$_pid);
$core_file = $pid.'.php';
$html_file = $pid.'.html.php';

/**
 * ebcontents 예약어처리
 */
if ($pid == 'ebcontents') {
    alert('ebcontents 단어는 pid 값으로 사용하실 수 없습니다.');
}

/**
 * $core_file : 개발로직
 */
@include_once(EYOOM_CORE_PATH . '/page/proc/'. $core_file);

/**
 * smode 에서 스킨출력은 필요없음
 */
if ($smode) return;

/**
 * 메뉴정보 가져오기
 */
$sql = "select * from {$g5['eyoom_menu']} where me_theme='" . sql_real_escape_string($theme) . "' and me_type='pid' and me_pid='" . sql_real_escape_string($_pid) . "' order by me_code desc limit 1";
$meinfo = sql_fetch($sql);

/**
 * 접근권한
 */
if ($member['mb_level'] < $meinfo['me_permit_level']) {
    alert('접근권한이 없습니다.', G5_URL);
    exit;
}

/**
 * 테마 경로 지정
 */
$page_html_path = EYOOM_THEME_PATH.'/page/'.$html_file;
$page_default_path = EYOOM_THEME_PATH.'/page/ebcontents.html.php';
$page_html_url = str_replace(G5_PATH, G5_URL, $page_skin_path);

@include_once(EYOOM_THEME_PATH.'/page/page.head.html.php');

/**
 * pid 관련 기본 파일이 있는지 체크
 */
if (file_exists($page_html_path) && !is_dir($page_html_path)) {
    /**
     * $html_file : 출력
     */
    @include_once($page_html_path);
} else {
    /**
     * EB컨텐츠 마스터 정보
     */
    $ec_master = array();
    if ($meinfo) {
        $sql = "select ec_code from {$g5['eyoom_contents']} where ec_theme='" . sql_real_escape_string($theme) . "' and me_code='{$meinfo['me_code']}' order by ec_sort asc";
        $result = sql_query($sql);
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            $ec_master[$i] = $row;
        }
    }

    /**
     * EB마스터 갯수
     */
    $ec_cnt = count((array)$ec_master);

    /**
     * 기본 페이지 스킨 출력
     */
    include_once($page_default_path);
}

@include_once(EYOOM_THEME_PATH.'/page/page.tail.html.php');