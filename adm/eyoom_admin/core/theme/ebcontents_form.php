<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebcontents_form.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999610";

auth_check_menu($auth, $sub_menu, 'w');

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");

$action_url1 = G5_ADMIN_URL . '/?dir=theme&amp;pid=ebcontents_form_update&amp;smode=1';
if ($w == 'u') {
    $ec_code = isset($_REQUEST['ec_code']) && $_REQUEST['ec_code'] ? clean_xss_tags($_REQUEST['ec_code']) : '';
    if (!$ec_code) alert("잘못된 접근입니다.");
}

/**
 * EB Contents 이미지 아이템 테이블 생성
 */
$sql = "
    CREATE TABLE IF NOT EXISTS `" . $g5['eyoom_contents_item'] . "` (
      `ci_no` int(10) unsigned NOT NULL auto_increment,
      `ec_code` text NOT NULL,
      `ci_theme` varchar(30) NOT NULL default 'eb4_basic',
      `ci_state` char(1) NOT NULL default '2',
      `ci_sort` int(10) default '0',
      `ci_subject` text NOT NULL,
      `ci_text` text NOT NULL,
      `ci_content` text NOT NULL,
      `ci_link` text NOT NULL,
      `ci_target` text NOT NULL,
      `ci_img` text NOT NULL,
      `ci_period` char(1) NOT NULL default '1',
      `ci_start` varchar(10) NOT NULL,
      `ci_end` varchar(10) NOT NULL,
      `ci_view_level` tinyint(4) NOT NULL default '1',
      `ci_regdt` datetime NOT NULL default '0000-00-00 00:00:00',
      PRIMARY KEY  (`ci_no`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
$sql = get_db_create_replace($sql);
sql_query($sql, false);

/**
 * 디렉토리가 없다면 생성
 */
$qfile->make_directory(G5_DATA_PATH.'/ebcontents/'.$this_theme.'/');

/**
 * EB Contents 정보 가져오기
 */
if ($w == 'u') {
    $ec = sql_fetch("select * from {$g5['eyoom_contents']} where ec_code = '{$ec_code}' and ec_theme='{$this_theme}'");

    if (!$ec) {
        alert('존재하지 않는 컨텐츠입니다.', G5_ADMIN_URL . '/?dir=theme&amp;pid=ebcontents_list&amp;page=1');
    } else {
        /**
         * 스킨 디렉토리 정의
         */
        $ec_skin_img = G5_PATH.'/theme/'.$this_theme.'/skin/ebcontents/'.$ec['ec_skin'].'/image/ec_skin_img.png';
        if (file_exists($ec_skin_img)) {
            $ec['ec_skin_img'] = G5_URL.'/theme/'.$this_theme.'/skin/ebcontents/'.$ec['ec_skin'].'/image/ec_skin_img.png';
        }
        
        $ec_subject = $eb->mb_unserialize($ec['ec_subject']);
        if (is_array($ec_subject)) {
            foreach ($ec_subject as $k => $subject) {
                $key = 'ec_subject_'.($k+1);
                $ec[$key] = $subject;
            }
        }
        
        $ec_text = $eb->mb_unserialize($ec['ec_text']);
        if (is_array($ec_text)) {
            foreach ($ec_text as $k => $text) {
                $key = 'ec_text_'.($k+1);
                $ec[$key] = stripslashes($text);
            }
        }
        
        if ($ec['ec_image']) {
            $ec['ec_img_url'] = G5_DATA_URL.'/ebcontents/'.$this_theme.'/img/'.$ec['ec_image'];
        }
    }
}

/**
 * 버튼셋
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= !$wmode ? ' <a href="' . G5_ADMIN_URL . '/?dir=theme&amp;pid=ebcontents_list&amp;page='.$page.'&amp;thema='.$this_theme.'" class="btn-e btn-e-lg btn-e-dark">목록</a> ': '';
$frm_submit .= '</div>';