<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebcontents_setup.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999610";

if($is_admin != 'super') alert('최고관리자만 설정을 변경할 수 있습니다.');

$ec_theme = isset($_GET['ec_theme']) ? clean_xss_tags(get_text(trim($_GET['ec_theme']))) : '';
$ec_pid = isset($_GET['ec_pid']) ? clean_xss_tags(get_text(trim($_GET['ec_pid']))): '';

/**
 * 테마 설정 폴더 업로드 체크
 */
$tmp_dir = G5_PATH.'/tmp';
if (!is_dir($tmp_dir)) {
    alert("설치하고자 하는 웹페이지를 업로드하신 후, 진행해 주세요.");
}

/**
 * $html_file 이 없을 경우
 * 메뉴정보 가져오기
 */
$sql = "select * from {$g5['eyoom_menu']} where me_theme='{$ec_theme}' and me_type='pid' and me_pid='{$ec_pid}' order by me_code desc limit 1";
$meinfo = sql_fetch($sql);

/**
 * 테마 전용 파일 및 DB 설정
 */
$g5_root = $eb->g5_root(str_replace("adm/index.php",'',$_SERVER['SCRIPT_NAME']));
$ebcontents_sql_file = G5_PATH.'/tmp/ebcontents.db.sql';
if (file_exists($ebcontents_sql_file)) {
	/**
     * sql 파일
     */
	$file = implode('', file($ebcontents_sql_file));
	eval("\$file = \"$file\";");

	$file = preg_replace('/`g5_([^`]+`)/', '`'.G5_TABLE_PREFIX.'$1', $file);
	$file = preg_replace('/`me_id` = \'([0-9]+)\'/', "`me_id` = '{$meinfo['me_id']}'", $file);
	$file = preg_replace('/`me_code` = \'([0-9]+)\'/', "`me_code` = '{$meinfo['me_code']}'", $file);
	$file = preg_replace('/`ec_theme` = \'(eb4_[a-z0-9_]{5,10})\'/', "`ec_theme` = '{$ec_theme}'", $file);
	$file = preg_replace('/`ci_theme` = \'(eb4_[a-z0-9_]{5,10})\'/', "`ci_theme` = '{$ec_theme}'", $file);

	preg_match_all('/`ec_code` = \'([0-9]{10,15})\'/', $file, $matchs);
	if (isset($matchs[1]) && is_array($matchs[1])) {
    	$add_code = date('H')*3600 + date('i')*60 + date('s') + (ceil(time()-$code)/86400)*86400;
    	foreach ($matchs[1] as $k => $code) {
        	$new_code = $code + $add_code;
        	$file = str_replace("`ec_code` = '".$code."'", "`ec_code` = '".$new_code."'", $file);
    	}
	}

	$q = explode('^|^', $file);

	for ($i=0; $i<count($q); $i++) {
	    if (trim($q[$i]) == '') continue;
	    sql_query($q[$i]);
	}
}

/**
 * data 폴더에 각 테마폴더 생성
 */
$qfile->make_directory(G5_DATA_PATH.'/ebcontents');
$qfile->make_directory(G5_DATA_PATH.'/ebcontents/'.$ec_theme);

/**
 * 테마 관련 data 파일 복사
 */
$qfile->copy_dir($tmp_dir.'/data/ebcontents/'.$ec_theme, G5_DATA_PATH.'/ebcontents/'.$ec_theme);

alert("정상적으로 웹페이지를 설치하였습니다.\\n\\n반드시 /tmp 폴더를 삭제해 주시기 바랍니다.", G5_URL.'/page/?pid='.$ec_pid);