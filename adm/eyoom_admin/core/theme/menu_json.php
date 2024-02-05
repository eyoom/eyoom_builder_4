<?php
/**
 * @file    /adm/eyoom_admin/core/theme/menu_json.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$theme      = isset($_GET['thema']) ? clean_xss_tags(trim($_GET['thema'])): '';
$me_shop    = isset($_GET['me_shop']) ? clean_xss_tags(trim($_GET['me_shop'])): 2;

$root_text = $me_shop == 1 ? '쇼핑몰 메뉴':'커뮤니티 메뉴';
if ($_GET['me_ec']) { $root_text = '홈페이지'; }

$admin_mode = true;
$eyoom_menu = $thema->eyoom_menu($me_shop, $theme);

$output  = '';
$output .= '[{';
$output .= '
    "id":"1",
    "text":"'.$root_text.'",
    "children":[
';
if(is_array($eyoom_menu)) {
    $i=0;
    $_output = array();
    foreach($eyoom_menu as $key => $val) {
        unset($blind);
        $me_order = $val['me_order'];
        if($val['me_use'] == 'n') $blind = " <span style='color:#f30;'><i class='fa fa-eye-slash'></i></span>";
        $_output[$key] .= '{';
        $_output[$key] .= '"id":"'.$val['me_code'].'",';
        $_output[$key] .= '"order":"'.$me_order.'",';
        $_output[$key] .= '"text":"'.trim($val['me_name']).$blind.'"';
        if(is_array($val) && count((array)$val)>3) $_output[$key] .= $thema->eyoom_menu_json($val);
        $_output[$key] .= '}';
        $i++;
    }
    $output .= implode(',',$_output);
}
$output .= '
    ]
';
$output .= '}]';

echo $output;