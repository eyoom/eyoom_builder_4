<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebbanner_form.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999630";

auth_check_menu($auth, $sub_menu, 'w');

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");

$action_url1 = G5_ADMIN_URL . '/?dir=theme&amp;pid=ebbanner_form_update&amp;smode=1';
$action_url2 = G5_ADMIN_URL . '/?dir=theme&amp;pid=ebbanner_itemlist_update&amp;smode=1';

if ($w == 'u') {
    $bn_code = isset($_REQUEST['bn_code']) && $_REQUEST['bn_code'] ? clean_xss_tags($_REQUEST['bn_code']) : '';
    if (!$bn_code) alert("잘못된 접근입니다.");
}

/**
 * EB banner 아이템 테이블 생성
 */
$sql = "
    CREATE TABLE IF NOT EXISTS `" . $g5['eyoom_banner_item'] . "` (
      `bi_no` int(10) unsigned NOT NULL auto_increment,
      `bn_code` varchar(20) NOT NULL,
      `bi_theme` varchar(30) NOT NULL default 'eb4_basic',
      `bi_type` enum('intra','extra') NOT NULL DEFAULT 'intra',
      `bi_state` char(1) NOT NULL default '2',
      `bi_sort` int(10) default '0',
      `bi_title` varchar(255) NOT NULL,
      `bi_subtitle` varchar(255) NOT NULL,
      `bi_script` text NOT NULL,
      `bi_link` varchar(255) NOT NULL DEFAULT '',
      `bi_img` varchar(255) NOT NULL DEFAULT '',
      `bi_period` char(1) NOT NULL default '1',
      `bi_start` varchar(10) NOT NULL,
      `bi_end` varchar(10) NOT NULL,
      `bi_exposed` mediumint(10) NOT NULL DEFAULT '0',
      `bi_clicked` mediumint(10) NOT NULL DEFAULT '0',
      `bi_view_level` tinyint(4) NOT NULL default '1',
      `bi_regdt` datetime NOT NULL default '0000-00-00 00:00:00',
      PRIMARY KEY  (`bi_no`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
$sql = get_db_create_replace($sql);
sql_query($sql, false);

/**
 * EB banner 조회수 테이블 생성
 */
$sql = "
    CREATE TABLE IF NOT EXISTS `" . $g5['eyoom_banner_hit'] . "` (
        `bh_id` int(11) unsigned NOT NULL auto_increment,
        `bn_code` varchar(20) NOT NULL,
        `bi_no` int(11) NOT NULL,
        `bh_ip` varchar(100) NOT NULL DEFAULT '',
        `bh_date` date NOT NULL DEFAULT '0000-00-00',
        `bh_time` time NOT NULL DEFAULT '00:00:00',
        `bh_referer` text NOT NULL,
        `bh_agent` varchar(200) NOT NULL,
        PRIMARY KEY  (`bh_id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
$sql = get_db_create_replace($sql);
sql_query($sql, false);

/**
 * 배너 링크 타겟 필드 추가
 */
if (!sql_query(" select bi_target from {$g5['eyoom_banner_item']} limit 1 ", false)) {
    sql_query("ALTER TABLE `{$g5['eyoom_banner_item']}` ADD `bi_target` ENUM('_self', '_blank') NOT NULL DEFAULT '_blank' AFTER `bi_link`", true);
}

/**
 * 디렉토리가 없다면 생성
 */
@mkdir(G5_DATA_PATH.'/ebbanner/'.$this_theme.'/', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/ebbanner/'.$this_theme.'/', G5_DIR_PERMISSION);

/**
 * 스킨 디렉토리 읽어오기
 */
$ebbanner_skins = get_skin_dir('ebbanner', G5_PATH.'/theme/'.$this_theme.'/skin');

/**
 * 배너 정보 가져오기
 */
if ($w == 'u') {
    $es = sql_fetch("select * from {$g5['eyoom_banner']} where bn_code = '{$bn_code}' and bn_theme='{$this_theme}'");
    $es['bn_img_url'] = G5_DATA_URL.'/ebbanner/'.$this_theme.'/img/'.$es['bn_image'];
    if (!$es) {
        alert('존재하지 않는 배너입니다.', G5_ADMIN_URL . '/?dir=theme&amp;pid=ebbanner_list&amp;page=1');
    }
}

/**
 * 버튼셋
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= !$wmode ? ' <a href="' . G5_ADMIN_URL . '/?dir=theme&amp;pid=ebbanner_list&amp;page='.$page.'&amp;thema='.$this_theme.'" class="btn-e btn-e-lg btn-e-dark">목록</a> ': '';
$frm_submit .= '</div>';

/**
 * 배너 테이블에서 작업테마의 배너 레코드 정보 가져오기
 */
$sql_common = " from {$g5['eyoom_banner_item']} ";

/**
 * 작업테마 조건문
 */
$sql_search = " where bi_theme='{$this_theme}' and bn_code = '{$bn_code}' ";

$sql = " select * {$sql_common} {$sql_search} order by bi_sort asc";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;

    $bi_img = isset($row['bi_img']) ? $eb->mb_unserialize($row['bi_img']): array();
    $bi_file = G5_DATA_PATH.'/ebbanner/'.$row['bi_theme'].'/img/'.$bi_img[0];
    if (file_exists($bi_file) && !is_dir($bi_file) && $bi_img[0]) {
        $bi_url = G5_DATA_URL.'/ebbanner/'.$row['bi_theme'].'/img/'.$bi_img[0];
        $list[$i]['bi_image'] = "<img src='".$bi_url."' class='img-responsive'> ";
    } else {
        $list[$i]['bi_image'] = '-';
    }

    $view_level = get_member_level_select("bi_view_level[$i]", 1, $member['mb_level'], $row['bi_view_level']);
    $list[$i]['view_level'] = preg_replace("/(\\n|\\r)/","",str_replace('"', "'", $view_level));

    $sql2 = "select count(*) as cnt from {$g5['eyoom_banner_hit']} where (1) and bn_code='{$bn_code}' and bi_no='{$row['bi_no']}' ";
    $row2 = sql_fetch($sql2);

    $sql3 = "update {$g5['eyoom_banner_item']} set bi_clicked='{$row2['cnt']}' where (1) and bn_code='{$bn_code}' and bi_no='{$row['bi_no']}'";
    sql_query($sql3);

    $list[$i]['bi_clicked'] = $row2['cnt'];
    $list[$i]['bi_ratio'] = $list[$i]['bi_exposed'] > 0 ? ceil($row2['cnt']*10000/$list[$i]['bi_exposed'])/100: 0;
}
