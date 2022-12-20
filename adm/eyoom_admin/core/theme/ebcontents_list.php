<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebcontents_list.php
 */
//$wmode = 1;
include_once('./_common.php');

$action_url1 = G5_ADMIN_URL . '/?dir=theme&amp;pid=ebcontents_list_update&amp;smode=1';
$post_id = isset($_POST['id']) ? clean_xss_tags($_POST['id']) : '';

/**
 * EB Contents 테이블 생성
 */
$sql = "
    CREATE TABLE IF NOT EXISTS `" . $g5['eyoom_contents'] . "` (
      `ec_no` int(10) unsigned NOT NULL auto_increment,
      `ec_code` text NOT NULL,
      `me_id` int(10) unsigned NOT NULL default '0',
      `me_code` varchar(255) NOT NULL default '',
      `ec_name` varchar(255) NOT NULL default '',
      `ec_subject` text NOT NULL,
      `ec_text` text NOT NULL,
      `ec_theme` varchar(30) NOT NULL default 'eb4_basic',
      `ec_skin` varchar(50) NOT NULL default 'basic',
      `ec_state` smallint(1) NOT NULL default '0',
      `ec_link` varchar(255) NOT NULL,
      `ec_target` varchar(10) NOT NULL,
      `ec_image` varchar(255) NOT NULL,
      `ec_file` varchar(255) NOT NULL,
      `ec_filename` varchar(255) NOT NULL,
      `ec_sort` smallint(3) NOT NULL DEFAULT '0',
      `ec_link_cnt` smallint(2) NOT NULL default '2',
      `ec_image_cnt` smallint(2) NOT NULL default '5',
      `ec_ext_cnt` smallint(2) NOT NULL default '5',
      `ec_regdt` datetime NOT NULL default '0000-00-00 00:00:00',
      PRIMARY KEY  (`ec_no`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
$sql = get_db_create_replace($sql);
sql_query($sql, false);

/**
 * EB 컨텐츠 아이템 파일 저장 경로
 */
$ebcontents_folder = G5_DATA_PATH.'/ebcontents/';
$qfile->make_directory($ebcontents_folder);

/**
 * 적용 테마
 */
$_theme = isset($_POST['thema']) ? clean_xss_tags($_POST['thema']): $this_theme;

/**
 * 배너 테이블에서 작업테마의 배너/광고 레코드 정보 가져오기
 */
$sql_common = " from {$g5['eyoom_contents']} as ec ";

/**
 * 작업테마 조건문
 */
$sql_search = " where ec.ec_theme='{$_theme}' ";

/**
 * 메뉴를 선택하였을 경우
 */
if ($post_id && strlen($post_id) >= 3) {
	$sql_common .= " left join {$g5['eyoom_menu']} as me on ec.me_code = me.me_code ";
	$sql_search .= " and me.me_shop='2' and ec.me_code='{$post_id}' and me.me_theme = '{$_theme}' ";
	
	$meinfo = sql_fetch("select * from {$g5['eyoom_menu']} where me_code = '{$post_id}' and me_theme='{$_theme}' and me_shop='2' ");
	$me_title = $meinfo['me_path'];
} else {
    $sql_search .= " and ec.me_code = '' ";
}

$sql_order = " ec.me_code asc, ec.ec_sort asc ";

$sql = " select * {$sql_common} {$sql_search} order by {$sql_order}";
$result = sql_query($sql);

$ec_skin_img_path = G5_PATH.'/theme/'.$_theme.'/skin/ebcontents';
$ec_skin_img_url = G5_URL.'/theme/'.$_theme.'/skin/ebcontents';
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;
    $list[$i]['ec_chg_code'] = "&lt;?php echo eb_contents('{$row['ec_code']}'); ?&gt;";
    $ec_skin_img = $ec_skin_img_path.'/'.$row['ec_skin'].'/image/ec_skin_img.png';
    if (file_exists($ec_skin_img)) {
	    $list[$i]['ec_skin_img'] = $ec_skin_img_url.'/'.$row['ec_skin'].'/image/ec_skin_img.png';
    }
}

/**
 * 페이지 출력
 */
include_once(EYOOM_ADMIN_THEME_PATH . "/skin/theme/ebcontents_list.html.php");