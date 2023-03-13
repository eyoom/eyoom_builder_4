<?php
/**
 * @file    /adm/eyoom_admin/core/theme/menu_form.php
 */
include_once('./_common.php');

$theme      = isset($_POST['thema']) ? clean_xss_tags(trim($_POST['thema'])): '';
$me_code    = isset($_POST['id']) ? clean_xss_tags($_POST['id']): '';
$depth      = strlen($me_code)/3;

/**
 * 영카트5 인가?
 */
$is_youngcart = false;
if (defined('G5_USE_SHOP') && G5_USE_SHOP) {
    $is_youngcart = true;
}

$checked = array();
if($theme && $me_code) {
    $sql = "select * from {$g5['eyoom_menu']} where me_theme='{$theme}' and me_code='{$me_code}' and me_shop = '{$me_shop}'";
    $meinfo = sql_fetch($sql, false);
    if($meinfo['me_side'] == 'y') $checked['me_side1'] = 'checked'; else $checked['me_side2'] = 'checked';
    if($meinfo['me_use'] == 'y') $checked['me_use1'] = 'checked'; else $checked['me_use2'] = 'checked';
    if($meinfo['me_use_nav'] == 'y' || !$meinfo['me_use_nav']) $checked['me_use_nav1'] = 'checked'; else $checked['me_use_nav2'] = 'checked';
    if(!$meinfo['me_path']) {
        $meinfo['me_path'] = $thema->get_path($meinfo['me_code']);
    }
    
    // 짧은주소 사용
    if ($config['cf_bbs_rewrite']) {
        $meinfo['me_url'] = get_pretty_eyoom_menu_url($meinfo['me_type'], $meinfo['me_pid'], $meinfo['me_link']);
    } else {
        $g5_url = parse_url(G5_URL);
        $meinfo['me_link'] = str_replace($g5_url['path'],'',$meinfo['me_link']);
        if(!preg_match('/(http|https):/i',$meinfo['me_link'])) {
            $meinfo['me_url'] = G5_URL.$meinfo['me_link'];
        } else {
            $meinfo['me_url'] = $meinfo['me_link'];
        }
    }
}

/**
 * 페이지 출력
 */
include_once(EYOOM_ADMIN_THEME_PATH . "/skin/theme/menu_form.html.php");