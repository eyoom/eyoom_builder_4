<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebslider_form.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999600";

auth_check_menu($auth, $sub_menu, 'w');

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");

$action_url1 = G5_ADMIN_URL . '/?dir=theme&amp;pid=ebslider_form_update&amp;smode=1';
$action_url2 = G5_ADMIN_URL . '/?dir=theme&amp;pid=ebslider_ytitemlist_update&amp;smode=1';
$action_url3 = G5_ADMIN_URL . '/?dir=theme&amp;pid=ebslider_itemlist_update&amp;smode=1';

if ($w == 'u') {
    $es_code = isset($_REQUEST['es_code']) && $_REQUEST['es_code'] ? clean_xss_tags($_REQUEST['es_code']) : '';
    if (!$es_code) alert("잘못된 접근입니다.");
}

/**
 * EB Slider 유튜브동영상 아이템 테이블 생성
 */
$sql = "
    CREATE TABLE IF NOT EXISTS `" . $g5['eyoom_slider_ytitem'] . "` (
      `ei_no` int(10) unsigned NOT NULL auto_increment,
      `es_code` text NOT NULL,
      `ei_theme` varchar(30) NOT NULL default 'eb4_basic',
      `ei_state` char(1) NOT NULL default '2',
      `ei_sort` int(10) default '0',
      `ei_ytcode` varchar(255) NOT NULL,
      `ei_autoplay` char(1) NOT NULL default '1',
      `ei_control` char(1) NOT NULL default '1',
      `ei_loop` char(1) NOT NULL default '1',
      `ei_mute` char(1) NOT NULL default '1',
      `ei_raster` char(1) NOT NULL default '1',
      `ei_volumn` smallint(3) NOT NULL default '10',
      `ei_stime` smallint(4) NOT NULL default '0',
      `ei_etime` smallint(4) NOT NULL default '0',
      `ei_period` char(1) NOT NULL default '1',
      `ei_start` varchar(10) NOT NULL,
      `ei_end` varchar(10) NOT NULL,
      `ei_view_level` tinyint(4) NOT NULL default '1',
      `ei_regdt` datetime NOT NULL default '0000-00-00 00:00:00',
      PRIMARY KEY  (`ei_no`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
$sql = get_db_create_replace($sql);
sql_query($sql, false);

/**
 * EB Slider 이미지 아이템 테이블 생성
 */
$sql = "
    CREATE TABLE IF NOT EXISTS `" . $g5['eyoom_slider_item'] . "` (
      `ei_no` int(10) unsigned NOT NULL auto_increment,
      `es_code` text NOT NULL,
      `ei_theme` varchar(30) NOT NULL default 'eb4_basic',
      `ei_state` char(1) NOT NULL default '2',
      `ei_sort` int(10) default '0',
      `ei_title` varchar(255) NOT NULL,
      `ei_subtitle` varchar(255) NOT NULL,
      `ei_text` text NOT NULL,
      `ei_link` text NOT NULL,
      `ei_target` text NOT NULL,
      `ei_img` text NOT NULL,
      `ei_period` char(1) NOT NULL default '1',
      `ei_start` varchar(10) NOT NULL,
      `ei_end` varchar(10) NOT NULL,
      `ei_view_level` tinyint(4) NOT NULL default '1',
      `ei_regdt` datetime NOT NULL default '0000-00-00 00:00:00',
      PRIMARY KEY  (`ei_no`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
$sql = get_db_create_replace($sql);
sql_query($sql, false);

// 유튜브동영상 아이템 테이블에 필드 추가
if(!sql_query(" select ei_quality from {$g5['eyoom_slider_ytitem']} limit 1 ")) {
    sql_query(" ALTER TABLE `{$g5['eyoom_slider_ytitem']}`
                    ADD `ei_quality` varchar(10) NOT NULL DEFAULT 'hd1080' AFTER `ei_ytcode`,
                    ADD `ei_remember` char(1) NOT NULL DEFAULT '1' AFTER `ei_quality`", true);
}

/**
 * 디렉토리가 없다면 생성
 */
@mkdir(G5_DATA_PATH.'/ebslider/'.$this_theme.'/', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/ebslider/'.$this_theme.'/', G5_DIR_PERMISSION);

/**
 * 스킨 디렉토리 읽어오기
 */
$ebslider_skins = get_skin_dir('ebslider', G5_PATH.'/theme/'.$this_theme.'/skin');

/**
 * 슬라이더 정보 가져오기
 */
if ($w == 'u') {
    $es = sql_fetch("select * from {$g5['eyoom_slider']} where es_code = '{$es_code}' and es_theme='{$this_theme}'");
    $es['es_img_url'] = G5_DATA_URL.'/ebslider/'.$this_theme.'/img/'.$es['es_image'];
    if (!$es) {
        alert('존재하지 않는 슬라이더입니다.', G5_ADMIN_URL . '/?dir=theme&amp;pid=ebslider_list&amp;page=1');
    }
}

/**
 * 버튼셋
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= !$wmode ? ' <a href="' . G5_ADMIN_URL . '/?dir=theme&amp;pid=ebslider_list&amp;page='.$page.'&amp;thema='.$this_theme.'" class="btn-e btn-e-lg btn-e-dark">목록</a> ': '';
$frm_submit .= '</div>';

/**
 * 배너 테이블에서 작업테마의 슬라이더 레코드 정보 가져오기
 */
$sql_common = " from {$g5['eyoom_slider_item']} ";

/**
 * 작업테마 조건문
 */
$sql_search = " where ei_theme='{$this_theme}' and es_code = '{$es_code}' ";

$sql = " select * {$sql_common} {$sql_search} order by ei_sort asc";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;

    $ei_link = isset($row['ei_link']) ? $eb->mb_unserialize($row['ei_link']): array();
    $ei_target = isset($row['ei_target']) ? $eb->mb_unserialize($row['ei_target']): array();
    $ei_img = isset($row['ei_img']) ? $eb->mb_unserialize($row['ei_img']): array();

    $ei_file = G5_DATA_PATH.'/ebslider/'.$row['ei_theme'].'/img/'.$ei_img[0];
    if (file_exists($ei_file) && $ei_img[0]) {
        $ei_url     = G5_DATA_URL.'/ebslider/'.$row['ei_theme'].'/img/'.$ei_img[0];
        $list[$i]['ei_image'] = "<img src='".$ei_url."' class='img-responsive'> ";
    }

    $view_level = get_member_level_select("ei_view_level[$i]", 1, $member['mb_level'], $row['ei_view_level']);
    $list[$i]['view_level'] = preg_replace("/(\\n|\\r)/","",str_replace('"', "'", $view_level));
}

/*** 유튜브 동영상 아이템 ***/
$sql_common = " from {$g5['eyoom_slider_ytitem']} ";

/**
 * 작업테마 조건문
 */
$sql_search = " where ei_theme='{$this_theme}' and es_code = '{$es_code}' ";

$sql = " select * {$sql_common} {$sql_search} order by ei_sort asc";
$result = sql_query($sql);
$yt_list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $yt_list[$i] = $row;
    $view_level = get_member_level_select("ei_view_level[$i]", 1, $member['mb_level'], $row['ei_view_level']);
    $yt_list[$i]['view_level'] = preg_replace("/(\\n|\\r)/","",str_replace('"', "'", $view_level));
}