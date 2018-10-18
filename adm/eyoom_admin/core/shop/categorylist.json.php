<?php
include_once('./_common.php');

$root_text = '카테고리 루트';
$admin_mode = true;
$category = $shop->get_category();

$output  = '';
$output .= '[{';
$output .= '
    "id":"0",
    "text":"'.$root_text.'",
    "children":[
';
if(is_array($category)) {
    foreach($category as $key => $val) {
        unset($blind);
        if ($val['ca_id'] != '0' && !$val['ca_id']) continue;
        if($val['ca_use'] != '1') $blind = " <span style='color:#f30;'><i class='fa fa-eye-slash'></i></span>";
        $_output[$val['ca_order']] .= '{';
        $_output[$val['ca_order']] .= '"id":"'.$val['ca_id'].'",';
        $_output[$val['ca_order']] .= '"order":"'.$val['ca_order'].'",';
        $_output[$val['ca_order']] .= '"text":"'.$val['ca_name'].$blind.'"';
        if(is_array($val) && count($val)>3) $_output[$val['ca_order']] .= $shop->category_json($val);
        $_output[$val['ca_order']] .= '}';
    }
    ksort($_output);
    $output .= implode(',',$_output);
}
$output .= '
    ]
';
$output .= '}]';

echo $output;

?>