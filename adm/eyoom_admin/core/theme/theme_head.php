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
if (isset($_REQUEST['thema'])) {
    if (!is_array($_REQUEST['thema'])) {
        $this_theme = filter_var($_REQUEST['thema'], FILTER_VALIDATE_REGEXP, array(
            "options" => array("regexp" => "/^[a-z0-9_]+$/i")
        ));
        $this_theme = preg_replace('/[^a-z0-9_]/i', '', trim($this_theme));
    }
}
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
    $eyoom_board = $bbs->board_info($bo_table);
    if(!$eyoom_board) {
        $eyoom_board = $bbs->board_default($bo_table);
    }
}

/**
 * 게시판 전체정보
 */
if ($pid == 'board_form' || $pid == 'board_addon') {
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

/**
 * 테마정보 체크
 */
foreach ($loaded_theme as $key => $tm_name) {
    if ($tm_name == 'eb4_basic') continue;

    $info     = $tminfo[$tm_name];
    $last     = new DateTime($info['tm_last']);
    $current  = new DateTime();
    $interval = $current->diff($last);
    
    if ($interval->days > $config['cf_page_rows']) {
        $result = $thema->check_theme_info($info);
        $sql = "update {$g5['eyoom_theme']} set tm_last='".G5_TIME_YMDHIS."' where tm_name='{$tm_name}' ";
        sql_query($sql);
    }

    if ($theme == $shop_theme) {
        break;
    }
}