<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebslider_itemform.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999600";

include_once(G5_EDITOR_LIB);

auth_check_menu($auth, $sub_menu, 'w');

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");

$action_url1 = G5_ADMIN_URL . '/?dir=theme&amp;pid=ebslider_itemform_update&amp;smode=1';

$es_code = isset($_GET['es_code']) ? clean_xss_tags(trim($_GET['es_code'])): '';
$ei_no = isset($_GET['ei_no']) ? clean_xss_tags(trim($_GET['ei_no'])): '';

/**
 * EB슬라이더 마스터 정보
 */
$es = sql_fetch("select * from {$g5['eyoom_slider']} where es_code = '{$es_code}' and es_theme='{$this_theme}'");

/**
 * EB슬라이더 아이템 정보 가져오기
 */
if ($iw == 'u') {
    $ei = sql_fetch("select * from {$g5['eyoom_slider_item']} where ei_no = '{$ei_no}' and ei_theme='{$this_theme}'");
    $ei['ei_start'] = $ei['ei_start'] ? date('Y-m-d', strtotime($ei['ei_start'])) : '';
    $ei['ei_end']   = $ei['ei_end'] ? date('Y-m-d', strtotime($ei['ei_end'])) : '';
    $ei_url = array();
    if ($ei['ei_no']) {
        foreach($ei as $key => $value) {
            $es_item[$key] = stripslashes($value);
        }
        $ei_link = isset($es_item['ei_link']) ? $eb->mb_unserialize($es_item['ei_link']): array();
        $ei_target = isset($es_item['ei_target']) ? $eb->mb_unserialize($es_item['ei_target']): array();
        $ei_img = isset($es_item['ei_img']) ? $eb->mb_unserialize($es_item['ei_img']): array();
        for($i=0; $i<$es['es_image_cnt']; $i++) {
            unset($ei_file);
            $ei_file = G5_DATA_PATH.'/ebslider/'.$ei['ei_theme'].'/img/'.$ei_img[$i];
            if (file_exists($ei_file) && !is_dir($ei_file) && $ei_img[$i]) {
                $ei_url[$i] = G5_DATA_URL.'/ebslider/'.$ei['ei_theme'].'/img/'.$ei_img[$i];
            }
        }
    } else {
        alert('존재하지 않는 아이템입니다.');
    }
}

if ($iw == '') {
    $info = sql_fetch("select max(ei_sort) as max from {$g5['eyoom_slider_item']} where es_code = '{$es_code}' ");
    $es_max_sort = $info['max'] + 1;
}

/**
 * 버튼셋
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= '</div>';