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
    $i=0;
    $_output = array();
    foreach($category as $key => $val) {
        unset($blind);
        $ca_order = $val['ca_order'].$i;
        if ($val['ca_id'] != '0' && !$val['ca_id']) continue;
        if($val['ca_use'] != '1') $blind = " <span style='color:#f30;'><i class='fa fa-eye-slash'></i></span>";
        $_output[$ca_order] .= '{';
        $_output[$ca_order] .= '"id":"'.$val['ca_id'].'",';
        $_output[$ca_order] .= '"order":"'.$ca_order.'",';
        $_output[$ca_order] .= '"text":"'.trim($val['ca_name']).$blind.'"';
        if(is_array($val) && count((array)$val)>3) $_output[$ca_order] .= $shop->category_json($val);
        $_output[$ca_order] .= '}';
        $i++;
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