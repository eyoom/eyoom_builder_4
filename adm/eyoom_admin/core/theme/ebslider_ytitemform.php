<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebslider_ytitemform.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999600";

auth_check_menu($auth, $sub_menu, 'w');

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");

$action_url1 = G5_ADMIN_URL . '/?dir=theme&amp;pid=ebslider_ytitemform_update&amp;smode=1';

$es_code = clean_xss_tags(trim($_GET['es_code']));
$es_code = isset($_GET['es_code']) ? clean_xss_tags(trim($_GET['es_code'])): '';
$ei_no = isset($_GET['ei_no']) ? clean_xss_tags(trim($_GET['ei_no'])): '';

/**
 * 유튜브 슬라이더 아이템 정보 가져오기
 */
if ($iw == 'u') {
    $ei = sql_fetch("select * from {$g5['eyoom_slider_ytitem']} where ei_no = '{$ei_no}' and ei_theme='{$this_theme}'");
    $ei['ei_start'] = $ei['ei_start'] ? date('Y-m-d', strtotime($ei['ei_start'])) : '';
    $ei['ei_end']   = $ei['ei_end'] ? date('Y-m-d', strtotime($ei['ei_end'])) : '';

    if ($ei) {
        foreach($ei as $key => $value) {
            $es_item[$key] = get_text(stripslashes($value));
        }
    } else {
        alert('존재하지 않는 아이템입니다.');
    }
}

if ($iw == '') {
    $info = sql_fetch("select max(ei_sort) as max from {$g5['eyoom_slider_ytitem']} where es_code = '{$es_code}' ");
    $es_max_sort = $info['max'] + 1;
}

/**
 * 버튼셋
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= '</div>';