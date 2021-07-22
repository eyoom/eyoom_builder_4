<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebcontents_itemform.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999610";

include_once(G5_EDITOR_LIB);

auth_check_menu($auth, $sub_menu, 'w');

$action_url1 = G5_ADMIN_URL . '/?dir=theme&amp;pid=ebcontents_itemform_update&amp;smode=1';

/**
 * 다음 주소 검색 스크립트
 */
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");

$ec_code = isset($_GET['ec_code']) ? clean_xss_tags(trim($_GET['ec_code'])): '';
$ci_no = isset($_GET['ci_no']) ? clean_xss_tags(trim($_GET['ci_no'])): '';

/**
 * EB컨텐츠 마스터 정보
 */
$ec = sql_fetch("select * from {$g5['eyoom_contents']} where ec_code = '{$ec_code}' and ec_theme='{$this_theme}'");

/**
 * EB컨텐츠 아이템 정보 가져오기
 */
if ($iw == 'u') {
    $ci = sql_fetch("select * from {$g5['eyoom_contents_item']} where ci_no = '{$ci_no}' and ci_theme='{$this_theme}'");
    $ci['ci_start'] = $ci['ci_start'] ? date('Y-m-d', strtotime($ci['ci_start'])) : '';
    $ci['ci_end']   = $ci['ci_end'] ? date('Y-m-d', strtotime($ci['ci_end'])) : '';
    $ci_url = $ec_item = array();
    if ($ci['ci_no']) {
        foreach($ci as $key => $value) {
            $ec_item[$key] = stripslashes($value);
        }
        $ci_subject = $eb->mb_unserialize($ec_item['ci_subject']); // 텍스트필드
        $ci_text = $eb->mb_unserialize($ec_item['ci_text']); // 텍스트필드
        $ci_link = $eb->mb_unserialize($ec_item['ci_link']);
        $ci_target = $eb->mb_unserialize($ec_item['ci_target']);
        $ci_img = $eb->mb_unserialize($ec_item['ci_img']);
        for($i=0; $i<$ec['ec_image_cnt']; $i++) {
            unset($ci_file);
            $ci_file = G5_DATA_PATH.'/ebcontents/'.$ci['ci_theme'].'/img/'.$ci_img[$i];
            if (file_exists($ci_file) && !is_dir($ci_file) && $ci_img[$i]) {
                $ci_url[$i] = G5_DATA_URL.'/ebcontents/'.$ci['ci_theme'].'/img/'.$ci_img[$i];
            }
        }
        for($i=0; $i<$ec['ec_ext_cnt']; $i++) {
            $key = 'ci_subject_'.($i+1);
            $ec_item[$key] = $ci_subject[$i];
        }
        
        $ec_item['ci_text_1'] = $ci_text[0];
        $ec_item['ci_text_2'] = $ci_text[1];
    } else {
        alert('존재하지 않는 아이템입니다.');
    }
}

if ($iw == '') {
    $info = sql_fetch("select max(ci_sort) as max from {$g5['eyoom_contents_item']} where ec_code = '{$ec_code}' ");
    $ec_max_sort = $info['max'] + 1;
}

/**
 * 버튼셋
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= '</div>';