<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebslider_ytitemform_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999600";

auth_check_menu($auth, $sub_menu, 'w');

check_demo();

$es_code        = isset($_POST['es_code']) ? clean_xss_tags(trim($_POST['es_code'])) : '';
$ei_state       = isset($_POST['ei_state']) ? clean_xss_tags(trim($_POST['ei_state'])) : '';
$ei_sort        = isset($_POST['ei_sort']) ? clean_xss_tags(trim($_POST['ei_sort'])) : '';
$ei_ytcode      = isset($_POST['ei_ytcode']) ? clean_xss_tags(trim($_POST['ei_ytcode'])) : '';
$ei_quality     = isset($_POST['ei_quality']) ? clean_xss_tags(trim($_POST['ei_quality'])) : '';
$ei_remember    = isset($_POST['ei_remember']) ? clean_xss_tags(trim($_POST['ei_remember'])) : '';
$ei_autoplay    = isset($_POST['ei_autoplay']) ? clean_xss_tags(trim($_POST['ei_autoplay'])) : '';
$ei_control     = isset($_POST['ei_control']) ? clean_xss_tags(trim($_POST['ei_control'])) : '';
$ei_loop        = isset($_POST['ei_loop']) ? clean_xss_tags(trim($_POST['ei_loop'])) : '';
$ei_mute        = isset($_POST['ei_mute']) ? clean_xss_tags(trim($_POST['ei_mute'])) : '';
$ei_raster      = isset($_POST['ei_raster']) ? clean_xss_tags(trim($_POST['ei_raster'])) : '';
$ei_volumn      = isset($_POST['ei_volumn']) ? clean_xss_tags(trim($_POST['ei_volumn'])) : '';
$ei_stime       = isset($_POST['ei_stime']) ? clean_xss_tags(trim($_POST['ei_stime'])) : '';
$ei_etime       = isset($_POST['ei_etime']) ? clean_xss_tags(trim($_POST['ei_etime'])) : '';
$ei_theme       = isset($_POST['theme']) ? clean_xss_tags(trim($_POST['theme'])) : '';
$ei_period      = isset($_POST['ei_period']) ? clean_xss_tags(trim($_POST['ei_period'])) : '';
$ei_start       = isset($_POST['ei_start']) ? clean_xss_tags(trim($_POST['ei_start'])) : '';
$ei_end         = isset($_POST['ei_end']) ? clean_xss_tags(trim($_POST['ei_end'])) : '';
$ei_view_level  = isset($_POST['ei_view_level']) ? clean_xss_tags(trim($_POST['ei_view_level'])) : '';

if ($ei_period == '1')  {
    $ei_start   = '';
    $ei_end     = '';
} else {
    $ei_start   = $ei_start ? date('Ymd', strtotime($ei_start)) : '';
    $ei_end     = $ei_end ? date('Ymd', strtotime($ei_end)) : '';
}

$sql_common = "
    es_code = '{$es_code}',
    ei_state = '{$ei_state}',
    ei_sort = '{$ei_sort}',
    ei_ytcode = '{$ei_ytcode}',
    ei_quality = '{$ei_quality}',
    ei_remember = '{$ei_remember}',
    ei_autoplay = '{$ei_autoplay}',
    ei_control = '{$ei_control}',
    ei_loop = '{$ei_loop}',
    ei_mute = '{$ei_mute}',
    ei_raster = '{$ei_raster}',
    ei_volumn = '{$ei_volumn}',
    ei_stime = '{$ei_stime}',
    ei_etime = '{$ei_etime}',
    ei_theme = '{$ei_theme}',
    ei_period = '{$ei_period}',
    ei_start = '{$ei_start}',
    ei_end = '{$ei_end}',
    ei_view_level = '{$ei_view_level}',
";

if ($iw == '') {
    $sql = "insert into {$g5['eyoom_slider_ytitem']} set {$sql_common} ei_regdt = '".G5_TIME_YMDHIS."'";
    sql_query($sql);
    $ei_no = sql_insert_id();
    $msg = "유튜브 동영상 아이템을 추가하였습니다.";

} else if ($iw == 'u') {
    $sql = " update {$g5['eyoom_slider_ytitem']} set {$sql_common} ei_regdt=ei_regdt where ei_no = '{$ei_no}' ";
    sql_query($sql);
    $msg = "유튜브 동영상 아이템을 정상적으로 수정하였습니다.";

} else {
    alert('제대로 된 값이 넘어오지 않았습니다.');
}

/**
 * 설정된 정보를 파일로 저장 - 캐쉬 기능
 */
$link_path = G5_DATA_URL.'/ebslider';

$sql = "select * from {$g5['eyoom_slider_ytitem']} where es_code = '{$es_code}' and ei_theme = '{$ei_theme}' and ei_state = '1' order by ei_sort asc ";
$result = sql_query($sql, false);
$this_date = date('Ymd');
$es_ytitem = array();
for($i=0; $row=sql_fetch_array($result); $i++) {
    if($row['ei_period'] == '2') {
        if($this_date >= $row['ei_start'] && $this_date <= $row['ei_end']) {
            $es_ytitem[$i] = $row;
        } else continue;
    } else {
        $es_ytitem[$i] = $row;
    }
}

/**
 * EB슬라이더 아이템파일
 */
$es_ytitem_file = G5_DATA_PATH . '/ebslider/'.$ei_theme.'/es_ytitem_' . $es_code . '.php';

/**
 * 설정파일 저장
 */
$qfile->save_file('es_ytitem', $es_ytitem_file, $es_ytitem, true);

alert($msg, G5_ADMIN_URL . '/?dir=theme&amp;pid=ebslider_ytitemform&amp;es_code='.$es_code.'&amp;'.$qstr.'&amp;w=u&amp;iw=u&amp;wmode=1&amp;ei_no='.$ei_no);