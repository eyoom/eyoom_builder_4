<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebcontents_itemlist.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999610";

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");

$action_url1 = G5_ADMIN_URL . '/?dir=theme&amp;pid=ebcontents_itemlist_update&amp;smode=1';

$ec_code = isset($_REQUEST['ec_code']) ? clean_xss_tags(trim($_REQUEST['ec_code'])) : '';
if (!$ec_code) {
    alert('잘못된 접근입니다.');
}

/**
 * 작업테마의 EB Contents 아이템 정보 가져오기
 */
$sql_common = " from {$g5['eyoom_contents_item']} ";

/**
 * 작업테마 조건문
 */
$sql_search = " where ci_theme='{$this_theme}' and ec_code = '{$ec_code}' ";

$sql = " select * {$sql_common} {$sql_search} order by ci_sort asc";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;

    $ci_link = $row['ci_link'] ? $eb->mb_unserialize($row['ci_link']) : array();
    $ci_target = $row['ci_target'] ? $eb->mb_unserialize($row['ci_target']) : array();
    $ci_img = $row['ci_img'] ? $eb->mb_unserialize($row['ci_img']) : array();

    $ci_file = G5_DATA_PATH.'/ebcontents/'.$row['ci_theme'].'/img/'.$ci_img[0];
    if (file_exists($ci_file) && $ci_img[0]) {
        $ci_url     = G5_DATA_URL.'/ebcontents/'.$row['ci_theme'].'/img/'.$ci_img[0];
        $list[$i]['ci_image'] = "<img src='".$ci_url."' class='img-responsive'> ";
    }
    $ci_subject = $row['ci_subject'] ? $eb->mb_unserialize($row['ci_subject']) : array();
    $list[$i]['ci_subject_1'] = $ci_subject[0];

    $view_level = get_member_level_select("ci_view_level[$i]", 1, $member['mb_level'], $row['ci_view_level']);
    $list[$i]['view_level'] = preg_replace("/(\\n|\\r)/","",str_replace('"', "'", $view_level));
    
    unset($ci_subject);
}
