<?php
/**
 * @file    /adm/eyoom_admin/core/theme/theme_form_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999100";

check_demo();

if($is_admin != 'super') alert('최고관리자만 설정을 변경할 수 있습니다.');

$tm_key         = isset($_POST['tm_key']) ? clean_xss_tags(get_text(trim($_POST['tm_key']))): '';
$cm_key         = isset($_POST['cm_key']) ? clean_xss_tags(get_text(trim($_POST['cm_key']))): '';
$cm_salt        = isset($_POST['cm_salt']) ? clean_xss_tags(get_text(trim($_POST['cm_salt']))): '';
$tm_name        = isset($_POST['tm_name']) ? clean_xss_tags(get_text(trim($_POST['tm_name']))): '';
$eyoom_config   = isset($_POST['eyoom_config']) ? $eb->decrypt_aes($_POST['eyoom_config'], $cm_salt): '';

if (!$tm_name) alert('잘못된 접근입니다.');
if (!$tm_key) alert('잘못된 접근입니다.');
if (!$cm_key) alert('잘못된 접근입니다.');
if (!$cm_salt) alert('잘못된 접근입니다.');
if (!$eyoom_config) alert('잘못된 접근입니다.');

$tm_path = G5_PATH . '/' . G5_THEME_DIR . '/' . $tm_name;
if (!is_dir($tm_path)) {
    alert("입력하신 테마 라이선스키와 설치하고자 하는 테마가 서로 일치하지 않습니다.");
}

/**
 * 테마 설정 폴더 업로드 체크
 */
$tmp_dir = G5_PATH.'/tmp';
if (!is_dir($tmp_dir)) {
    alert("다운로드받은 tmp 폴더를 루트 폴더에 업로드하신 후, 진행해 주세요.");
}

// 테마정보 업데이트
$where = " tm_name='{$tm_name}' ";
$info = sql_fetch("select count(*) as cnt from {$g5['eyoom_theme']} where {$where}");

$set = "
	tm_name = '{$tm_name}',
	tm_key = '{$tm_key}',
	cm_key = '{$cm_key}',
	cm_salt = '{$cm_salt}',
	tm_last = '".G5_TIME_YMDHIS."',
	tm_time = '".G5_TIME_YMDHIS."'
";

if($info['cnt']>0) {
	sql_query("update {$g5['eyoom_theme']} set $set where $where");
} else {
	sql_query("insert into {$g5['eyoom_theme']} set $set");
}

/**
 * 테마 전용 파일 및 DB 설정
 */
$g5_root = $eb->g5_root(str_replace("adm/index.php",'',$_SERVER['SCRIPT_NAME']));
$theme_sql_file = G5_PATH.'/tmp/eyoom.'.$tm_name.'.sql';
if (file_exists($theme_sql_file)) {
	/**
     * 해당 테마의 DB레코드 삭제
     */
	sql_query("delete from {$g5['eyoom_menu']} where me_theme = '{$tm_name}' ");
	sql_query("delete from {$g5['eyoom_slider']} where es_theme = '{$tm_name}' ");
	sql_query("delete from {$g5['eyoom_slider_item']} where ei_theme = '{$tm_name}' ");
	sql_query("delete from {$g5['eyoom_slider_ytitem']} where ei_theme = '{$tm_name}' ");
	sql_query("delete from {$g5['eyoom_contents']} where ec_theme = '{$tm_name}' ");
	sql_query("delete from {$g5['eyoom_contents_item']} where ci_theme = '{$tm_name}' ");
	sql_query("delete from {$g5['eyoom_latest']} where el_theme = '{$tm_name}' ");
	sql_query("delete from {$g5['eyoom_latest_item']} where li_theme = '{$tm_name}' ");
	$file = implode('', file($theme_sql_file));
	eval("\$file = \"$file\";");
	
	$file = preg_replace('/`g5_([^`]+`)/', '`'.G5_TABLE_PREFIX.'$1', $file);
	if ($g5_root != '' && $g5_root != '/') {
	    $file = str_replace("`me_link` = '", "`me_link` = '{$g5_root}", $file);
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
$qfile->make_directory(G5_DATA_PATH.'/ebslider');
$qfile->make_directory(G5_DATA_PATH.'/ebcontents');
$qfile->make_directory(G5_DATA_PATH.'/eblatest');
$qfile->make_directory(G5_DATA_PATH.'/ebslider/'.$tm_name);
$qfile->make_directory(G5_DATA_PATH.'/ebcontents/'.$tm_name);
$qfile->make_directory(G5_DATA_PATH.'/eblatest/'.$tm_name);

/**
 * 테마 관련 data 파일 복사
 */
$qfile->copy_dir($tmp_dir.'/ebslider/'.$tm_name, G5_DATA_PATH.'/ebslider/'.$tm_name);
$qfile->copy_dir($tmp_dir.'/ebcontents/'.$tm_name, G5_DATA_PATH.'/ebcontents/'.$tm_name);
$qfile->copy_dir($tmp_dir.'/eblatest/'.$tm_name, G5_DATA_PATH.'/eblatest/'.$tm_name);

/**
 * 설정파일 정의 
 */
$_eyoom = $eb->mb_unserialize($eyoom_config);

/**
 * 홈페이지 주소
 */
$hostname = $eb->eyoom_host();
$_eyoom['work_url'] = $hostname['host'];

$theme_config = G5_DATA_PATH . '/eyoom.'.$tm_name.'.config.php';
$qfile->save_file('eyoom', $theme_config, $_eyoom, false);
?>
<script>
alert("테마설치를 완료하였습니다.\n\n업로드한 테마전용 임시폴더인 /tmp 디렉토리는 삭제해 주세요.");
parent.location.reload();
</script>