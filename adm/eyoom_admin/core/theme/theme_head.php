<?php
/**
 * @file    /adm/eyoom_admin/core/theme/theme_head.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 테마관리 메뉴 depth
 */
$sub_key = substr($sub_menu,3,3);
if(!$sub_key) exit;

/**
 * 커뮤니티홈으로 설정된 테마
 */
$theme = $eyoom_default['theme'];

/**
 * 쇼핑몰홈으로 설정된 테마
 */
$shop_theme = $eyoom_default['shop_theme'];

/**
 * 현재 작업중인 테마
 */
$this_theme = isset($_GET['thema']) ? clean_xss_tags($_GET['thema']): '';
if (!$this_theme) $this_theme = isset($_POST['thema']) ? clean_xss_tags($_POST['thema']): '';
if ($this_theme) set_session('work_theme', $this_theme);
if (!$this_theme) $this_theme = get_session('work_theme');
if (!$this_theme) $this_theme = $theme;
if (!$this_shop_theme) $this_shop_theme = $shop_theme;

/**
 * 작업중인 테마의 설정정보 가져오기
 */
$config_file = G5_DATA_PATH.'/eyoom.'.$this_theme.'.config.php';
if (!$this_theme) {
    $config_file = G5_DATA_PATH.'/eyoom.config.php';
}
unset($eyoom);
@include($config_file);
$_eyoom = $eyoom;

/**
 * 게시판 설정 가져오기
 */
if($bo_table) {
    $eyoom_board = $bbs->board_info($bo_table, $this_theme);
    if(!$eyoom_board) {
        $eyoom_board = $bbs->board_default($bo_table);
    }
}

/**
 * 게시판 전체정보
 */
if ($pid == 'board_form') {
    $bo_list = $bbs->get_all_board_info();
    if (!$bo_list) $bo_list = array();
}

/**
 * DB eyoom_theme 테이블에 등록된 테마정보
 */
$sql = "select * from {$g5['eyoom_theme']} where 1 ";
$res = sql_query($sql, false);
$tminfo = array();
for ($i=0; $row=sql_fetch_array($res); $i++) {
    $tminfo[$row['tm_name']] = $row;
}

/**
 * 현재 테마 정보
 */
$this_tminfo = $tminfo[$this_theme];

/**
 * 이윰 테마 디렉토리에 등록된 테마 폴더명 = 테마명
 */
$arr = get_skin_dir ('theme', G5_PATH);
$tlist = array();
for ($i=0; $i<count((array)$arr); $i++) {
    if (!preg_match("/^eb4_*/i", $arr[$i])) continue;
    $config_file = G5_DATA_PATH.'/eyoom.'.$arr[$i].'.config.php';
    if(file_exists($config_file)) {
        $tlist[$i]['is_setup'] = true;
        @include($config_file);
    } else {
        $tlist[$i]['is_setup'] = false;
    }

    if ($eyoom['is_shop_theme'] == 'y') {
        $tlist[$i]['shop_theme'] = true;

        if ($eyoom_default['shop_theme'] == '' && $theme == $arr[$i]) {
            $tlist[$i]['is_shopping_theme'] = true;
        }
    } else {
        $tlist[$i]['shop_theme'] = false;
    }

    $tlist[$i]['theme_name']    = $arr[$i];
    $tlist[$i]['theme_alias']   = $tminfo[$arr[$i]]['tm_alias'];
}
$eyoom = $_eyoom;
unset($arr);