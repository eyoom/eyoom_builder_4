<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebbanner_itemform.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999630";

include_once(G5_EDITOR_LIB);

auth_check_menu($auth, $sub_menu, 'w');

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");

$action_url1 = G5_ADMIN_URL . '/?dir=theme&amp;pid=ebbanner_itemform_update&amp;smode=1';

$bn_code = isset($_GET['bn_code']) ? clean_xss_tags(trim($_GET['bn_code'])): '';
$bi_no = isset($_GET['bi_no']) ? clean_xss_tags(trim($_GET['bi_no'])): '';

/**
 * EB배너 마스터 정보
 */
$bn = sql_fetch("select * from {$g5['eyoom_banner']} where bn_code = '{$bn_code}' and bn_theme='{$this_theme}'");

/**
 * EB배너 아이템 정보 가져오기
 */
if ($iw == 'u') {
    $bi = sql_fetch("select * from {$g5['eyoom_banner_item']} where bi_no = '{$bi_no}' and bi_theme='{$this_theme}'");
    $bi['bi_start'] = $bi['bi_start'] ? date('Y-m-d', strtotime($bi['bi_start'])) : '';
    $bi['bi_end']   = $bi['bi_end'] ? date('Y-m-d', strtotime($bi['bi_end'])) : '';

    if ($bi['bi_no']) {
        foreach($bi as $key => $value) {
            $bn_item[$key] = stripslashes($value);
        }

        $bi_img = isset($bi['bi_img']) ? $eb->mb_unserialize($bi['bi_img']): array();
        for($i=0; $i<2; $i++) {
            unset($bi_file);
            $bi_file = G5_DATA_PATH.'/ebbanner/'.$bi['bi_theme'].'/img/'.$bi_img[$i];
            if (file_exists($bi_file) && !is_dir($bi_file) && $bi_file[$i]) {
                $bi_url[$i] = G5_DATA_URL.'/ebbanner/'.$bi['bi_theme'].'/img/'.$bi_img[$i];
            }
        }
    } else {
        alert('존재하지 않는 아이템입니다.');
    }
}

if ($iw == '') {
    $info = sql_fetch("select max(bi_sort) as max from {$g5['eyoom_banner_item']} where bn_code = '{$bn_code}' ");
    $bn_max_sort = $info['max'] + 1;
}

/**
 * 버튼셋
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= '</div>';